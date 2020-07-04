<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PeliculaController extends Controller
{

    public function index(){
        $titulo = 'Listado de Peliculas';
        return view('peliculas.index', ['titulo'=>$titulo]);
    }

    public function formulario(){
        return view('peliculas.formulario');
    }

    public function recibir(Request $request){
        $nombre = $request->input('nombre');
        var_dump($nombre);
    } 

   
}
