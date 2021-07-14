<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoleController extends Controller
{
    protected $fillable = [
        'title',
        'body',
        'user_id' ,
        'likes',
        // 'tags',


    ];
}
