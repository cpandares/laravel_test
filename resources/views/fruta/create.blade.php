@if(isset($fruta) && is_object($fruta))

    <h1>Editar Fruta</h1>
@else

    <h1>Crear Fruta</h1>

@endif

<form action="{{ action('FrutaController@save') }}" method="post">
{{ csrf_field() }}

    <label for="nombre">Nombre</label>
    <input type="text" name="nombre" value="{{ $fruta->nombre or '' }}"/><br>

    <label for="descripcion">Descripcion</label>
    <input type="text" name="descripcion"  value="{{ $fruta->descripcion }}" /><br>

    <label for="precio">Precio</label>
    <input type="number" name="precio"  value="{{ $fruta->precio }}" /><br>

    <input type="submit" value="Enviar">

</form>

