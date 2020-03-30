<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\LoginHandleRequest;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Carbon\Carbon;

use App\Models\User;

class UserController extends Controller
{
    /**
     * Handles Login Request
     *
     * @param LoginHandleRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginHandleRequest $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'phone_number' => 'required',
        // ]);

        // if ($validator->fails()) {
        //     // retrieve only first error
        //     $error = $validator->errors()->all()[0];
        //     return response()->json(['status'=> false, 'message' => $error], 401);
        // }

        $user = User::where('phone', $request->phone_number)->first();
        if ($user){
            Auth::loginUsingId($user->id);
            $data['token'] = $user->createToken('eDemic Access Token')->accessToken;
            $data['user_id'] = $user->id;

            // $user->deviceToken = $request->device_token;
            // $user->save();

            return response()->json(['status' => true, 'message'=> 'You have successfully logged in', 'data'=> $data], self::STATUS_OK);
        } else{
            return response()->json(['status' => false, 'message'=> 'No such user match our records'], self::STATUS_UNAUTHORIZED);
        }
    }

    // // check if currently authenticated user is the owner of the book
    // if ($request->user()->id !== $book->user_id) {
    //     return response()->json(['error' => 'You are not authorized to perform this action'], 403);
    // }

}