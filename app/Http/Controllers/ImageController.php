<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use App\Image;
use App\Comment;
use App\Like;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function create(){
        return view('images.create');
    }

    public function save(Request $request){

           
        // Validando la imagen
        $validate = $this->validate($request,[
            'image_path' => ['required','image'],
            'description'=>['required'], 
        ]);

        $description = $request->input('description');

        //Subir la imagen
        $image_path = $request->file('image_path');
       

        $user = \Auth::user();
        $image = new Image();
        $image->user_id=$user->id;
        $image->description = $description;

        if($image_path){
            $image_full = time().$image_path->getClientOriginalName();

            Storage::disk('images')->put($image_full, File::get($image_path));

            $image->image_path=$image_full;
        }

        $image->save();

        return redirect()->route('home')->with([
            'message'=>'Imagen Subida'
        ]);
    }

    public function getImages($filename){
        $file = Storage::disk('images')->get($filename);
        return new Response($file, 200);
    }

    public function detail($id){
        //obtengo una imagen con un id especifico
        $image = Image::find($id);
        //rederizo la vista con el id mi imagen 
        return view('images.detail',[
            'image'=>$image
        ]);
    }

    public function delete($id){
        $user = \Auth::user();

        $image = Image::find($id);
        $comments = Comment::where('image_id',$id)->get();
        $likes = Like::where('image_id',$id)->get();

       
        if($user && $image && $image->user_id==$user->id){
            // Eliminar comentarios
                if($comments && count($comments)>=1){
                    foreach($comments as $comment){
                        $comment->delete();
                    }
                }
            // Eliminar Likes
            if($likes && count($likes)>=1){
                foreach($likes as $like){
                    $like->delete();
                }
            }

            // Eliminar fichero del storage
            Storage::disk('images')->delete($image->image_path);

            //Eliminar el objeto

            $image->delete();
           $message=array('message'=>'Imagen Borrada');

        }else{
            $message=array('message'=>'Error al Borrar la Imagen');
        }
        return redirect()->route('home')->with($message);
    }

    public function edit($id){
        $user = \Auth::user();

        $image = Image::find($id);

        if($user && $image && $image->user->id==$user->id){
            return view('images.edit',[
                'image'=>$image
            ]);
        }else{
            return redirect()->route('home');
        }
    }

    public function update( Request $request ){

        //Encontrar el usuario identificado

        $user = \Auth::user();

        //Validando el Formulario
        $id = $user->id;
       
       
        
        $validate = $this->validate($request,[
            'description' => ['required', 'string', 'max:255'],           
            'image_path' => ['Image'],
                      
        ]);

        //Recojer datos 
        $image_id =  $request->input('image_id');
        $description = $request->input('description');
        $imagen = $request->file('image_path');

        //Conseguir la imagen de la base de datos

        $image_path=Image::find($image_id);
        $image_path->description=$description;
        // Subir la imagen ES NECESARIO CARGAR EL STORAGE
       
        
        if($imagen){
            //Nombre unico a mi imagen
            $image_full = time().$imagen->getClientOriginalName();
            //Guardar la imagen en el disco seleccionado
            Storage::disk('images')->put($image_full, \File::get($imagen));
            //Seteo la imagen en el objeto
            $image_path->image_path=$image_full;
        }

        //Guardando la edicion
        
              
        
        $image_path->update();

        return redirect()->route('image.detail',['id'=>$image_id])->with(['message'=>'Imagen Actualizada']);
    }
}
