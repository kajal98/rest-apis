<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use \Dingo\Api\Exception\StoreResourceFailedException;
use Auth;
use App\Models\User;
use App\Models\Hobby;
use App\Http\Resources\User as UserResource;

class Admin extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getUsers(Request $request)
    {
        try {
            $searched_hobby = $request->hobby;

            $users = User::where([['role', 'user',], ['email_verified_at', '!=', null]])
                    ->when($searched_hobby != null || $searched_hobby != "", function ($q) use ($searched_hobby) {
                        $hobby = Hobby::where('name', 'ILIKE', $searched_hobby)->first();

                        return $q->whereJsonContains('hobby_ids', $hobby ? $hobby->id : null);
                    })
                    ->get();

            return response()->json([
                'status' => 'Success',
                'code' => 200,
                'users' => UserResource::collection($users),
                'message' => 'You have successfully fetched users!',
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
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewUser($user_slug)
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
    public function deleteUser($user_slug)
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
