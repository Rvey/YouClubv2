<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\User;
use Dotenv\Store\File\Reader;
use Illuminate\Http\Request;

class CommentController extends Controller
{


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function UserComments(Request $request, $id)

    {
        return response([
            "data" => User::where(["id" => $id])->comments()->get()->toArray(),
            "error" => null
        ], 200);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function postComments(Request $request, $id)
    {
        $comments = Comment::where(["post_id" => $id])->get();

        return (bool)$comments
            ? response([
                "data" => $comments,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "you cant comment "

            ], 404);
    }

    public function store(Request $request)
    {
        $request->validate([
            "content" => ['required', 'max:800'],
            "post_id" => ['required']
        ]);

        $comment = $request->user()->comments()->create([
            "content" => $request->content,
            "post_id" => $request->post_id
        ]);

        return (bool)$comment
            ? response([
                "data" => $comment,
                "error" => "success"
            ], 201)
            : response([
                "data" => null,
                "error" => "you cant comment "

            ], 422);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function edit(Comment $comment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            "content" => ['max:900']
        ]);

        $comment = $request->user()->comments()->where(["id" => $id]);

        $comment->update(["content" => $request->content]);

        $response = (bool)$comment
            ? response([
                "data" => $comment,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "Could not edit comment."
            ], 422);

        return $response;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        if (
            $request->user()->id_Admin() ||
            $request->user()->comments()->where(["id" => $id])->first()
        )
            return response(["error" => "Unathorized"], 401);


        $delete = Comment::where(["id" => $id])->delete();

        return (bool)$delete
            ? response([
                "data" => $comment,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "you cant comment "

            ], 422);

        return $response;
    }
}
