<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;
use App\Http\Resources\V1\UserResource;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Session as FacadesSession;
use Symfony\Component\HttpFoundation\Session\Session;

class AuthController extends Controller
{
    public function register (Request $request){
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'name' => 'required|max:55',
            'username' => 'required|max:55',
            'email' => 'email|required|unique:users,name|',
            'password' => 'required|max:55'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }

        $requestData['password'] = Hash::make($requestData['password']);

        $user = User::create($requestData);

        return response([ 'status' => true, 'message' => 'User registered potang ina.' ], 200);
    }

    public function login (Request $request){
        $requestData = $request->all();
        $validator = Validator::make($requestData,[
            'email' => 'email|required',
            'password' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json([
                'errors' => $validator->errors()
            ], 422);
        }
        if (! auth()->attempt($requestData)) {
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }

        $accessToken = auth()->user()->createToken('authToken')->accessToken;
        return response (['user' => auth()->user(), 'access_token' => $accessToken], 200)->cookie('access_token', $accessToken, 360);
    }

    public function me() {
        if (auth('api')->user()){
            $user = auth('api')->user();
        }
            
        return new UserResource($user);;
    }

    public function logout(Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $token->delete();
        $response = ['message' => 'Logged out task failed successfully'];

        return response($response, 200);
    }
}
