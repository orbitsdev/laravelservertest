<?php

namespace App\Http\Controllers\Api;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostApiController extends Controller
{
    public function fetchPost($limit, $offset){
        $data = Post::orderBy('id', 'desc')
        ->skip($offset)
        ->take($limit)
        ->get();
return response()->json($data);
    }
}   
