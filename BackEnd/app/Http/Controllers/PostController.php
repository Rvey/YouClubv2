<?php


namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $post = Post::with('user')->get();
        return $post;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'image' => 'required|image'

        ]);


        $imageFullName = uniqid('p_img_', false);
        $path = "public/images/post_image";
        $request->file('image')->storeAs($path, $imageFullName);

        $post = $request->user()->posts()->create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imageFullName,
            // 'likes' => $request->likes,
            // 'tags' => $request->tags,
        ]);

        $response = (bool)$post
            ? response([
                "data" => $post,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "Could not create post."
            ]);

        return $response;
    }
    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $post = Post::where(['id' => $id])->with('user')->first();
        return $post;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)

    {
          // check autorization
          if (
            !$request->user()->is_Admin() &&
            // !$this->check_perm($request->user()) ||
            !$request->user()->posts()->where(["id" => $id])->first()
            )
           return response(["error" => 'Unauthorized'], 401);


        $request->validate([
            "title" => ['max:255'],
            "content" => ["max:200000000"],
        ]);


        $post = Post::find($id);
        $post->update($request->all());
        return $post;

        $response = (bool)$post
            ? response([
                "data" => $post,
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
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // check autorization
        if (

            !$request->user()->is_Admin() &&
            !$request->user()->posts()->where(["id" => $id])->first()
        )
            return response(["error" => "Unauthorized"], 401);

        $delete = Post::where(['id' => $id])->delete();

        $response = (bool)$delete
            ? response([
                "data" => "Post deleted.",
                "error" => null
            ], 202)
            : response([
                "data" => null,
                "error" => "Could not delete post."
            ], 422);


        return $response;
    }

    /**
     * Search the specified resource from storage.
     *
     * @param str $title
     * @return \Illuminate\Http\Response
     */
    public function search($title)
    {
        return Post::where('title', 'like', '%' . $title . '%')->get();
    }
}
