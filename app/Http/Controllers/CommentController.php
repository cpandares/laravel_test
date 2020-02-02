<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request){

        $user = \Auth::user();

        $validate = $this->validate($request,[
            'image_id' => ['required','integer'],
            'content'=>['required'], 
        ]);

        $content = $request->input('content');
        $image_id = $request->input('image_id');


        $comment = new Comment();
        $comment->user_id = $user->id;
        $comment->content = $content;
        $comment->image_id=$image_id;

        $comment->save();

        return redirect()->route('image.detail', ['id'=>$image_id])->with(['message'=>'Comentario añadido']);
        
    }

    public function delete($id){
        //Conseguir datos del usuario logueado
        $user = \Auth::user();
        //Encontrar el id de la imagen que llega por parametro
        $comment= Comment::find($id);
        //Compruebo que soy el duelo del comentario o de la publicacion
        if($user && $comment->user_id==$user->id || $comment->image->user_id==$user->id){
                $comment->delete();
                return redirect()->route('image.detail', ['id'=>$comment->image->id])->with(['message'=>'Comentario Borrado']);
        }else{
            return redirect()->route('image.detail', ['id'=>$comment->image->id])->with(['message'=>'Error al borrar comentario']);
        }
    }
}
