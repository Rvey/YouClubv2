<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tag = Tag::all();
        return $tag;
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
            'tagName' => 'required'
        ]);

        $tag = Tag::create([
            'tagName' => $request->tagName,

        ]);
        $response = (bool)$tag
            ? response([
                "data" => $tag,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "Could not create tag"
            ]);
        return $response;
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        $tag = Tag::where(['id' => $id])->fist();
        return $tag;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (
            !$request->user()->is_Admin()
        )
            return response(["error" => "Unauthorized"], 401);

        $request->validate([
            "tagName" => ['max:10'],

        ]);
        $tag = Tag::find($id);
        $tag->update($request->all());

        return $tag;

        $response = (bool)$tag
            ? response([
                "data" => $tag,
                "error" => null
            ], 201)
            : response([
                "data" => null,
                "error" => "Could not edit tag."
            ], 422);

        return $response;
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\tag  $tag
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        // if (
        //     !$request->user()->is_Admin()
        // )
        //     return response(["error" => "Unauthorized"], 401);

        $delete = Tag::where(['id' => $id])->delete();
        $response = (bool)$delete
            ? response([
                "data" => "tag deleted",
                "error" => null
            ], 202)
            : response([
                "data" => null,
                "error" => "could not delete tag"

            ], 422);
        return $response;
    }
}
