<?php

namespace App\Http\Controllers\API\v1;

// use Illuminate\Http\Request;
use App\Http\Requests\API\LoginHandleRequest;
use App\Http\Controllers\Controller;

use Auth;
use Validator;
use Carbon\Carbon;
use ConstantHelper;

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
        $user = User::where('phone', $request->phone_number)->first();
        if ($user){
            Auth::loginUsingId($user->id);
            $data['token'] = $user->createToken('eDemic Access Token')->accessToken;
            $data['user_id'] = $user->id;

            // $user->deviceToken = $request->device_token;
            // $user->save();

            return response()->json(['status' => true, 'message'=> 'You have successfully logged in', 'data'=> $data], ConstantHelper::STATUS_OK);
        } else{
            return response()->json(['status' => false, 'message'=> 'No such user match our records'], ConstantHelper::STATUS_UNAUTHORIZED);
        }
    }

}