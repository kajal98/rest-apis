<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Hash;
use \Dingo\Api\Exception\StoreResourceFailedException;
use Auth;
use App\Models\User;
use App\Models\Hobby;
use App\Http\Resources\User as UserResource;
use App\Mail\ChangePassword;

class Users extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getMyProfile(Request $request)
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
            'hobby_ids' => 'required',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            $user = Auth::user();
            // First detach old hobbies
            $user->hobbies()->detach();

            // Then assign new hobbies
            $hobbies = Hobby::find($request->hobby_ids);
            $user->hobbies()->attach($hobbies);

            return response()->json([
                'status' => 'Success',
                'code' => 200,
                'message' => 'You have successfully updated your hobbies!',
            ], 200);
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
        $validator = Validator::make($request->all(), [
            'old_password' => 'required',
            'new_password' => 'required',
            'new_confirm_password' => 'same:new_password',
        ]);

        if ($validator->fails()) {
            throw new StoreResourceFailedException('Please correct following errors!', $validator->errors());
        }

        try {
            $old_password = $request->old_password;

            $user = Auth::user();
            $current_password = $user->password;
            
            if (Hash::check($old_password, $current_password)) {
                $new_password = Hash::make($request->new_password);
                $user->password = $new_password;
                $user->save();

                Mail::to($user->email)->send(new ChangePassword($user->first_name));

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
