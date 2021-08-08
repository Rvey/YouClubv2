<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;

class LikeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $like = Like::with('user')->get();
        return $like;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)



    {

        $request->validate([
            'likes' => ['required '],
            // "post_id" => ['required', 'exists:posts,id']

        ]);

        $like = $request->user()->likes()->create([
            "likes" => $request->likes,
            "post_id" => $request->post_id
        ]);

        $response = (bool)$like
            ? response([
                "data" => $like,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "could not like this post"
            ], 422);

        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $like = Like::where(['id' => $id])->with('user')->first();
        return $like;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function edit(Like $like)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Like $like)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Like  $like
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (
            !$request->user()->likes()->where(['id' => $id])->first()
        )
            return response(["error" => "Unauthorized", 401]);


        $delete = Like::where(['id' => $id])->delete();
        $response = (bool)$delete
            ? response([
                "data" => "comment deleted",
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "could not delete comment"
            ], 422);
        return $response;
    }
}
