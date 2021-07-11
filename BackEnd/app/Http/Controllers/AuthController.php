<?php

namespace App\Http\Controllers;


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
            'fullName' => 'required|string',
            'email' => 'required|string|unique:users,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = User::create([
            'fullName' => $fields['fullName'],
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

        $fields = $request->validate([

            'email' => 'required|email',
            'password' => 'required|string'
        ]);

        // check email

        $user = User::where('email', $fields['email'])->first();

        // check  Password

        if (!$user && !Hash::check($fields['password'])) {

            return response([
                'message' => 'oops !!'
            ] . 401);
        }


        $token = $user->createToken('mytoken')->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }

    public function logout(Request $request)
    {

        $request->user()->currentAccessToken()->delete();
        // Auth::user()->currentAccessToken()->delete();

        return [

            'message' => 'logged out'

        ];
    }
}
