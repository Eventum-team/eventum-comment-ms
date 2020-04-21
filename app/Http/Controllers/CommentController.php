<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Like;


class CommentController extends Controller
{
    public function show($id,$idUsr)
    {
        $comment = Comment::where('idEvent', $id)->get();
        
        foreach ($comment as $comm) {
            $likes=0;
            $dislikes=0;
            $tmp = Like::where('idComment', $comm->id)->get();
            foreach ($tmp as $tmp2) {
                if($tmp2->like){
                    $likes+=1;
                }else{
                    $dislikes+=1;
                }
                if($tmp2->idUser == $idUsr){
                    $comm->reacted = $tmp2->like;
                }
            }
            
            $comm->likes=$likes;
            $comm->dislikes=$dislikes;
            
            
        }
        return response()->json($comment, 200);;
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

        $likes = Like::where('idComment', $id)->get();
        foreach ($likes as $like) {
            $like->delete();
        }

        return response()->json(null, 204);
    }
    public function react(Request $request)
    {
        $idUsr = $request->idUser;
        $idComment = $request->idComment;
        $isLike = $request->isLike;
        
        $like = Like::where('idUser', '=', $idUsr)->where('idComment', '=', $idComment)->first();

        if($like){
            $like->update($request->all());
            return response()->json( $like, 200);
        }else{
            $like = Like::create($request->all());
            return response()->json( $like, 200);
        }
        
    }
    public function unReact($id,$idUsr)
    {
        $likes = Like::where('idComment', $id)->get();
        foreach ($likes as $like) {
            if($like->idUser==$idUsr){
                $like->delete();
                
                return response()->json($like, 200);;
            }
        }
        return response()->json(null, 204);;
        
    }
}
