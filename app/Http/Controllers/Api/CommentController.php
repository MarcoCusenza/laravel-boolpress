<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Comment;
use Illuminate\Support\Facades\Validator;

class CommentController extends Controller
{
  public function store(Request $request)
  {
    $data = $request->all();

    //validazione diversa perché altrimenti mi farebbe un redirect al form
    $validator = Validator::make(
      $data,
      [
        "name" => "nullable|string|max:255",
        "content" => "string|required",
        "post_id" => "exists:posts,id"
      ]
    );

    if ($validator->fails()) {
      return response()->json([
        "success" => false,
        "errors" => $validator->errors()
      ], 400);
    }

    //creazione commento
    $newComment = new Comment();
    if (!empty($data["name"])) {
      $newComment->name = $data["name"];
    }
    $newComment->content = $data["content"];
    $newComment->post_id = $data["post_id"];
    $newComment->save();

    //restituisco risposta
    return response()->json([
      "success" => true
    ]);
  }
}
