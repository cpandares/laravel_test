<h1>Formulario</h1>

<form action="{{action('PeliculaController@recibir')}}" method="post">
    {{ csrf_field() }}
    <label for="nombre">Nombre</label>
    <input type="text" name="nombre">

    <label for="email">Correo</label>
    <input type="email" name="email" >

    <input type="submit" value="Enviar">
</form>