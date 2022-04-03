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

class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        try
        {
            $users = User::all();

            return response()->json([
                'status' => 'Success',
                'code' => 201,
                'users' => $users,
                'message' => 'You have successfully fetched users!',
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewUser(Request $request, $user_slug)
    {
        try {
            $user = User::where('slug', $user_slug)->first();

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
                    'message' => 'You have successfully fetched user details!',
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteUser(Request $request, $user_slug)
    {
        try {
            $user = User::where('slug', $user_slug)->first();

            if (!$user) {
                return response()->json([
                    'status' => 'Fail',
                    'code' => 422,
                    'message' => 'User not found!',
                ], 422);
            } else {
                $user->delete();

                return response()->json([
                    'status' => 'Success',
                    'code' => 200,
                    'message' => 'You have successfully deleted user!'
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
}
