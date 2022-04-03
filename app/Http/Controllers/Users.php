<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use DB;
use \Dingo\Api\Exception\StoreResourceFailedException;
use Illuminate\Support\Str;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use App\Mail\VerifyAccount;
use App\Mail\Welcome;
use App\Mail\ForgotPassword;
use App\Mail\ResetPassword;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\Http\Resources\User as UserResource;
use JWTAuth;

class Users extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyProfile(Request $request, $token)
    {
        $user = Auth::user();
        
        try {
            if (!$user) {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'User not found!',
                ], 422);
            } else {
                $user = User::where('email', $user->email)->first();

                return response()->json([
                    'status' => 'Success',
                    'code' => 200,
                    'message' => 'You have successfully fetched your details!',
                    'user' => new UserResource($user)
                ], 200);
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
    public function updateMyProfile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'mobile' => 'required|string|numeric',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            $user = new User;
            $user->first_name = $request->first_name;
            $user->last_name = $request->last_name;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->role = 'user';
            $user->status = 0;
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

            $link = 'http://frontend.example.com/'. 'verify/email/'. $token;

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
     * Update a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function changePassword(Request $request)
    {

        try {
            $old_password = $request->old_password;

            $user = $this->user;
            $current_password = $user->password;
            
            if (Hash::check($old_password, $current_password)) {
                $new_password = Hash::make($request->password);
                $user->password = $new_password;
                $user->password_expired_at = date('Y-m-d', strtotime('+1 years')) ;
                $user->save();

                $permissions = $user->userNotificationPermission->notification_permissions;

                if (in_array('profile-push', $permissions)) {
                    $user_notification  = new UserNotification;
                    $user_notification->user_id = $user->id;
                    $user_notification->text = 'Your Password has been changed successfully.';
                    $user_notification->save();
                }

                if (in_array('profile-email', $permissions)) {
                    Mail::to($user->email)->send(new ChangePassword($user->first_name));
                }

                return response()->json([
                    'status' => 'Success',
                    'code' => 200,
                    'message' => 'Password changed successfully!',
                ], 200);
            } else {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'You have entered wrong current password!',
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
}
