<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return User::all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // !$this->check_perm($request->user()) ||
        if (!$request->user()->is_admin())

        return response(["error" => 'Unauthorized'], 401);



        $request->validate([
            "username" => ['max:255'],
            "email" => ['max:255']
        ]);

        $user = User::find($id);
        $user->update($request->all());
        return $user;

        $response = (bool)$user
            ? response([
                "data" => $user,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "Could not edit post."
            ], 422);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {

        if (!$request->user()->is_admin())

        return response(["error" => 'Unauthorized'], 401);


        $delete = User::where(['id' => $id])->delete();

        $response = (bool)$delete
            ? response([
                "data" => "user deleted",
                "error" => null
            ], 202)
            : response([
                "data" => null,
                "error" => "could not delete user"
            ], 422);

        return $response;
    }
}
