<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;


class CommentController extends Controller
{
    public function show($id)
    {
        return Comment::where('idEvent', $id)->get();
    }

    public function store(Request $request)
    {
        $comment = Comment::create($request->all());

        return response()->json($comment, 201);
    }

    public function update(Request $request, $id)
    {
        $comment = Comment::where('id', '=', $id)->first();

        $comment->update($request->all());
      

        return response()->json($comment, 200);
    }

    public function delete($id)
    {
        $comment = Comment::find($id); 

        $comment->delete();

        return response()->json(null, 204);
    }
}
