<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function register(Request $request)
    {

        $fields = $request->validate([
            'username' => 'required|string',
            'email' => 'required|string|unique:admins,email',
            'password' => 'required|string|confirmed'
        ]);

        $user = Admin::create([
            'username' => $fields['username'],
            'email' => $fields['email'],
            'password' => bcrypt($fields['password']),
        ]);

        $token = $user->createToken('token_admin', ['admin'])->plainTextToken;

        $response = [
            'user' => $user,
            'token' => $token
        ];

        return response($response, 201);
    }
}
