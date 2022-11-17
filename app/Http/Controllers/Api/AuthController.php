<?php

namespace App\Http\Controllers\Api;

use App\Events\UserRegister;
use App\Http\Controllers\Controller;
use App\Http\Traits\apiTrait;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Pusher\Pusher;

class AuthController extends Controller
{
    use apiTrait;

    public function registerUser(Request $request)
    {
//        $validator = Validator::make($request->all(), [
//            'name' => 'required|String',
//            'email' => 'required|email|unique:users,email',
//            'password' => 'required|min:6',
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json([
//                'status' => false,
//                'response_message' => 'validation error',
//                'data' => $validator->errors(),
//            ]);
//        }
//        $user = User::create([
//            'name' => $request->name,
//            'email' => $request->email,
//            'password' => Hash::make($request->password),
//        ]);
//        $token = $user->createToken("API TOKEN")->plainTextToken;
        event(new UserRegister('New user has been registered'));
        return '';
//        return response()->json([
//            'token' => $token,
//            'status' => true,
//            'response_message' => 'User Created Successfully',
//            'data' => $user,
//
//        ]);

    }


    public function loginUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            return $this->apiResponse($validator->errors(), 'validation error', 401);
        }
        if (!Auth::attempt($request->only(['email', 'password']))) {
            return $this->apiResponse(null, 'User does not match our record!', 401);
        }

        $user = User::where('email', $request->email)->first();
        $token = $user->createToken("API TOKEN")->plainTextToken;

        return response()->json([
            'token' => $token,
            'status' => true,
            'response_message' => 'User Logged In Successfully',
            'data' => $user,

        ]);
    }


}
