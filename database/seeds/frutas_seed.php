<?php

use Illuminate\Database\Seeder;

class frutas_seed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      for($i=1 ; $i<=20; $i++){
          DB::table('fruteria')->insert(array(
              'nombre'=> 'Cereza'.$i,
              'descripcion'=>'Es la fruta '.$i,
              'precio'=>$i,
              'fecha'=>date('d-m-y')
          ));
      }
    }
}
