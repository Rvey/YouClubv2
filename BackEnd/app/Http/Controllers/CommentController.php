<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class commentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return  Comment::all();
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
            "content" => ['required', 'max:1000'],
            // "post_id" => ['required']
        ]);

        $comment = $request->user()->comments()->create([
            "content" => $request->content,
            // "post_id" => $request->post_id
        ]);

        $response =  (bool)$comment
            ? response([
                "data" => $comment,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "Could not post comment."
            ], 422);

            return $response;


    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $comment = Comment::where(['id' => $id])->with('user')->first();
        return $comment;
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
        $request->validate([
            "content" => ["max:2000"],
        ]);


        $comment = Post::find($id);
        $comment->update($request->all());
        return $comment;

        $response = (bool)$comment
            ? response([
                "data" => $comment,
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
    public function destroy(Request $request , $id)
    {
        // if($request->user()->post->where(["id" => $id])->first())
        //     return response(["error" => "Unauthorized"]);

        $delete = Comment::where(['id' => $id])->delete();

        $response = (bool)$delete
        ? response([
            "data" => "comment deleted" ,
            "error" => null
        ], 202)
        : response([
            "data" => null ,
            "error" => "Could not delete comment"
        ], 422);

        return $response;

    }
}
