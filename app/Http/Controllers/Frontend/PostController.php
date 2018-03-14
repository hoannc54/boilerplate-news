<?php

namespace App\Http\Controllers\Frontend;

use App\Models\Post;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PostController extends Controller
{
    public function index(){

    }

    public function show($id, $slug){
        $data['post'] = Post::find($id);
        return view('frontend.posts.show', $data);
    }
}
