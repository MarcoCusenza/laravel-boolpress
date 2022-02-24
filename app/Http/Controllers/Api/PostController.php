<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Post;

class PostController extends Controller
{
  public function index()
  {
    //leggere solo i post pubblicati
    $posts = Post::where("published", true)->with("category", "tags")->get();

    return response()->json($posts);
  }

  public function show($slug)
  {
    dd($slug);
  }
}
