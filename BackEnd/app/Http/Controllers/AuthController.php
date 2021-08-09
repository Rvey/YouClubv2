<?php

namespace App\Http\Controllers;

// use App\Models\Admin;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;



class AuthController extends Controller


{

    public function register(Request $request)
    {

        $fields = $request->validate([
            'username' => 'required|string|max:32|min:8|unique:users,username',
            'email' => 'required|string|unique:users,email|email',
            'password' => 'required|string|confirmed|min:8'
        ]);

        $user = User::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);


        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function login(Request $request)
    {



        $request->validate([

            'email' => ['required', 'email'],
            'password' => ['required']
        ]);



        // check email

        $user = User::where('email', $request->email)->first();
        // $admin = Admin::where('email', $fields['email'])->first();

        // check  Password

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response([
                'message' => 'Invalid Credentials.'
            ], 401);
        }


        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }


    public function user(Request $request)
    {
        return $request->user();
    }

    public function logout(Request $request)
    {
        $request->user()->tokens()->delete();
        return response('log out', 200);
    }
}
