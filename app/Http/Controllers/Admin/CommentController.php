<?php

namespace App\Http\Controllers\Admin;

use App\Comment;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{

  public function update(Request $request, Comment $comment)
  {
    //aggiornamento
    $comment->approved = true;
    $comment->save();
    //redirect al commento modificato
    return redirect()->route("posts.show", $comment->post_id);
  }


  public function destroy(Comment $comment)
  {
    $post_id = $comment->post_id;
    $comment->delete();

    return redirect()->route("posts.show", $post_id);
  }
}
