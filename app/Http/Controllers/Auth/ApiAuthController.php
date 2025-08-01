<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class ApiAuthController extends Controller
{
    public function register (Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $request['password']=Hash::make($request['password']);
        $request['remember_token'] = Str::random(10);
        $user = User::create($request->toArray());
        $token = $user->createToken('Laravel Password Grant Client')->accessToken;
        $response = [
            'status'=> true,
            'statusCode'=> 200,
            'message'=> 'ok',
            'data' => $token
        ];
        return response($response, 200);
    }

    public function login (Request $request) {
         
        $validator = Validator::make($request->all(), [
            'username' => 'required|string|email|max:255',
            'password' => 'required|string|min:6',
        ]);
        if ($validator->fails())
        {
            return response(['errors'=>$validator->errors()->all()], 422);
        }
        $user = User::where('login', $request->username)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = $user->createToken('token-name')->plainTextToken;
                // dd($token);
                // $token = $user->createToken('Laravel Password Grant Client')->accessToken;
                $response = [
                    'status'=> true,
                    'statusCode'=> 200,
                    'message'=> 'ok',
                    'data' => $token
                ];
                return response($response, 200);
            } else {
                $response = [
                    'status'=> false,
                    'statusCode'=> 400,
                    "message" => "Password mismatch",
                    'data'=>null
                ];
                return response($response, 422);
            }
        } else {
            $response = [
                'status'=> false,
                'statusCode'=> 404,
                "message" => "User does not exist",
                'data'=>null
            ];
            return response($response, 422);
        }
    }

    public function logout (Request $request) {
        $token = $request->user()->token();
        $token->revoke();
        $response = ['message' => 'You have been successfully logged out!'];
        return response($response, 200);
    }
}
