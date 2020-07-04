<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FrutaController extends Controller
{
   public function index(){
       $frutas = DB::table('fruteria')
                                    ->orderBy('id','desc')
                                    ->get();

       return view('fruta.index', [
           'frutas'=> $frutas
       ]);
   }

   public function detail($id){
       $fruta = DB::table('fruteria')->where('id','=', $id)->first();

       return view('fruta.detail', [
           'fruta'=>$fruta
       ]);
   }
   public function create(){
       return view('fruta.create');
     
   }

   public function save(Request $request){
       //guardar registros
       $fruta = DB::table('fruteria')->insert(array(
           'nombre'=>$request->input('nombre'),
           'descripcion'=>$request->input('descripcion'),
           'precio'=>$request->input('precio'),
           'fecha'=>date('Y-m-d')
       ));
       return redirect()->action('FrutaController@index')->with('status', 'Fruta Creada Correctamente');
   }
   public function delete($id){
       //Eliminar Registro de la DB
       $fruta = DB::table('fruteria')->where('id', '=', $id)->delete();

       return redirect()->action('FrutaController@index')->with('status', 'Fruta Borrada Correctamente');
   }

   public function edit($id){

       // Saco el dato de la Db
       $fruta = DB::table('fruteria')->where('id', $id)->first();
       //Devuelvo una vista con los datos de la Base de Datos
       return view('fruta.create', [
           'fruta' => $fruta
       ]);
   }
}
