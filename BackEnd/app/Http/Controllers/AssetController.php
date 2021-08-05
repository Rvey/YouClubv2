<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AssetController extends Controller
{
    public function postImage($image_name) {
        $path = storage_path('/app/public/images/post_image/' . DIRECTORY_SEPARATOR . $image_name);

        return response()->file($path);
    }
}
