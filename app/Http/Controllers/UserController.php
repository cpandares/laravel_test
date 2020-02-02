<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;
use App\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    

    //Buscar usuarios registrados
    public function users($search=null){
         
        if(!empty($search)){
            $users = User::where('nickname', 'LIKE', '%'.$search.'%')
                        ->orWhere('name', 'LIKE', '%'.$search.'%')
                        ->orderBy('id','desc')
                        ->paginate(5);    
        }else{
            $users = User::orderBy('id','desc')->paginate(5);
        }

        return view('user.index',[
            'users'=>$users
        ]);
    }

    public function config(){
        return view('user.config');
    }

    public function update( Request $request ){

        //Encontrar el usuario identificado

        $user = \Auth::user();

        //Validando el Formulario
        $id = $user->id;

        $validate = $this->validate($request,[
            'name' => ['required', 'string', 'max:255'],           
            'lastname' => ['required', 'string', 'max:255'],
            'nickname' => ['required', 'string', 'max:255', 'unique:users,nickname,'.$id],
            'image_path' => ['Image'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$id],
            
        ]);


        
        $name = $request->input('name');
        $lastname = $request->input('lastname');
        $nickname = $request->input('nickname');
        $email = $request->input('email');
        
        
        // Subir la imagen ES NECESARIO CARGAR EL STORAGE
        $imagen = $request->file('image_path');
        
        if($imagen){
            //Nombre unico a mi imagen
            $image_full = time().$imagen->getClientOriginalName();
            //Guardar la imagen en el disco seleccionado
            Storage::disk('users')->put($image_full, \File::get($imagen));
            //Seteo la imagen en el objeto
            $user->image=$image_full;
        }

        //Guardando el usuario

        $user->name=$name;
        $user->lastname=$lastname;
        $user->nickname=$nickname;
        $user->email=$email;
        
        $user->update();

        return redirect()->route('config')->with(['message'=>'Usuario Actualizado']);
    }

    //Sacar imagen de la DB

    public function getImagen($filename){
        $file = Storage::disk('users')->get($filename);
        return new Response($file, 200);
    }

    public function profile($id){

        $user = User::find($id);

        return view('user.profile', [
            'user'=>$user
        ]);
    }

    
}
