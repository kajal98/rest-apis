<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use \Dingo\Api\Exception\StoreResourceFailedException;
use Tymon\JWTAuth\Exceptions\JWTException;
use Carbon\Carbon;
use JWTAuth;
use DB;
use App\Models\User;
use App\Mail\VerifyAccount;
use App\Mail\Welcome;
use App\Mail\ForgotPassword;
use App\Mail\ResetPassword;
use App\Http\Resources\User as UserResource;

class Sessions extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function registration(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|numeric|digits:10',
            'photo' => 'required|string',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            // If front end side passing you base64 format of image then you have to convert that into image and then have to store it in local or s3 bucket like below, here I have assumed that front end side is passing direct url after uploading it to the s3 bucket or some where else.

            // if (preg_match("/data:*/", $request->photo)) {
            //     $image = $request->photo;  // base64 encoded from front end side
            //     $image = str_replace('data:image/png;base64,', '', $image);
            //     $image = str_replace(' ', '+', $image);
            //     $imageName = str_random(10) . '.png';

            //     Storage::disk('local')->put($imageName, base64_decode($image));
            // }

            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'user';
            $user->status = 0;
            $user->photo = $request->photo;
            $user->mobile = $request->mobile;
            $user->save();

            DB::table('verify_users')->where('email', $request->email)->delete();

            DB::table('verify_users')->insert([
                'user_id' => $user->id,
                'email' => $request->email,
                'token' => Str::random(65),
                'created_at' => Carbon::now(),
                'user_id' => $user->id
            ]);

            $token = DB::table('verify_users')->where('email', $request->email)->first()->token;

            $link = config('domain.domain_url'). 'verify/email/'. $token;

            Mail::to($request->email)->send(new VerifyAccount($user->first_name, $link, $user->role));

            return response()->json([
                'status' => 'Success',
                'code' => 201,
                'message' => 'You have successfully registered your account!',
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Fail',
                'code' => 422,
                'message' => 'Something went wrong, Please try after sometime!',
            ], 422);
        }
    }

    /**
     * Get and verify user account by email.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verifyAccount(Request $request, $token)
    {
        $verify = DB::table('verify_users')->where('token', $token)->first();
        
        try {
            if (!$verify) {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'Token expired!',
                ], 422);
            } else {
                $user = User::where('email', $verify->email)->first();

                if (!$user) {
                    return response()->json([
                        'status' => 'Fail',
                        'code' => 422,
                        'message' => 'User not found!',
                    ], 422);
                } else {
                    $user = User::where('slug', $user->slug)->first();
                    $user->email_verified_at = Carbon::now();
                    $user->status = 1;
                    $user->save();

                    DB::table('verify_users')->where('token', $token)->delete();
                    
                    Mail::to($user->email)->send(new Welcome($user->first_name));

                    return response()->json([
                        'status' => 'Success',
                        'code' => 200,
                        'message' => 'You have successfully verified your account!',
                        'user' => new UserResource($user)
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Fail',
                'code' => 422,
                'message' => 'Something went wrong, Please try after sometime!',
            ], 422);
        }
    }

    /**
     * Login using credentials for newly created record.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            $credentials = $request->only('email', 'password');

            $user = User::where('email', $credentials['email'])->first();

            if ($user) {
                if (!$user->email_verified_at) {
                    return response()->json([
                        'status' => 'Fail',
                        'code' => 422,
                        'message' => 'You have not confirmed your email, please confirm it first!',
                    ], 422);
                } elseif (! $token = JWTAuth::attempt($credentials)) {
                    return response()->json([
                        'status' => 'Fail',
                        'code' => 422,
                        'message' => 'The username or password that you have entered are incorrect!',
                    ], 422);
                } else {
                    return response()->json([
                        'status' => 'Success',
                        'code' => 200,
                        'message' => 'You have successfully logged in!',
                        'token' => $token,
                        'user' => new UserResource($user)
                    ], 201);
                }
            } else {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'User not found!',
                ], 422);
            }
        } catch (JWTException $e) {
            return response()->json([
                'status' => 'Fail',
                'code' => 422,
                'message' => 'Could not create token!',
            ], 500);
        }
    }

    /**
     * Refresh the token if expired.
     *
     */
    public function refreshToken()
    {
        return $this->respondWithToken(auth()->refresh());
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'status' => 'Success',
            'code' => 200,
            'token' => $token,
        ], 200);
    }

    /**
     * Update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function forgotPassword(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            $user=User::where('email', '=', $request->get('email'))->first();

            if ($user) {
                if (!$user->email_verified_at) {
                    return response()->json([
                        'status' => 'Fail',
                        'code' => 422,
                        'message' => 'You have not confirmed your email, please confirm it first!',
                    ], 422);
                } else {
                    DB::table('password_resets')->where('email', $user->email)->delete();

                    DB::table('password_resets')->insert([
                        'email' => $request->email,
                        'token' => Str::random(65),
                        'created_at' => Carbon::now()
                    ]);

                    $token = DB::table('password_resets')->where('email', $request->get('email'))->first()->token;


                    $link =  config('domain.domain_url') . 'reset-password/'.$token;

                    Mail::to($request->get('email'))->send(new ForgotPassword($user->first_name, $link));

                    return response()->json([
                        'status' => 'Success',
                        'code' => 200,
                        'message' => $request->get('email'),
                    ], 200);
                }
            } else {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'User with this email id not found in our database!',
                ], 422);
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Fail',
                'code' => 422,
                'message' => 'Something went wrong, Please try after sometime!',
            ], 422);
        }
    }

    /**
     * Update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function resetPassword(Request $request, $token)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'password_confirmation' => 'required'
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            $reset = DB::table('password_resets')->where('token', $token)->first();
            if (!$reset) {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'Token not found!',
                ], 422);
            } else {
                $user = User::where('email', '=', $reset->email)->first();
                if (!$user) {
                    return response()->json([
                        'status' => 'Fail',
                        'code' => 422,
                        'message' => 'User not found!',
                    ], 422);
                } elseif (!$user->email_verified_at) {
                    return response()->json([
                        'status' => 'Fail',
                        'code' => 422,
                        'message' => 'You have not confirmed your email, please confirm it first!',
                    ], 422);
                } else {
                    $user->password = Hash::make($request->get('password'));
                    $user->save();

                    DB::table('password_resets')->where('email', $user->email)->delete();
                    
                    $link =  config('domain.domain_url') . 'login';

                    Mail::to($user->email)->send(new ResetPassword($user->first_name));

                    return response()->json([
                        'status' => 'Success',
                        'code' => 200,
                        'message' => 'Password updated successfully!',
                    ], 200);
                }
            }
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'Fail',
                'code' => 422,
                'message' => 'Something went wrong, Please try after sometime!',
            ], 422);
        }
    }
}
