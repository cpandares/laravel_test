
<h1>{{ $fruta->nombre }}</h1>
<p>
    {{ $fruta->descripcion }}
</p>

<a href="{{ action('FrutaController@delete', ['id'=>$fruta->id]) }}">
   Eliminar Fruta
</a>
<br>

<a href="{{ action('FrutaController@edit', ['id'=>$fruta->id]) }}">
   Editar Fruta
</a>

