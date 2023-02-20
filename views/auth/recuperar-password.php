<h1 class="nombre-pagina">Recuperar Password</h1>
<p class="descripcion-pagina">Coloca tu nuevo Password a continuación:</p>

<!-- foreach para iterar el arreglo de alertas y mostrarlas en caso de que existan -->
<?php include_once __DIR__ . "/../templates/alertas.php"; ?> 

<?php if($error) return; ?> <!-- Elimina el form en caso de que el token no sea valido -->

<form method="POST" class="formulario">
    <div class="campo">
        <label for="password">Password:</label>    
        <input type="password" id="password" name="password" placeholder="Ingresa nuevo password">

    </div>
    
    <div class="campo-boton">
        <input type="submit" value="Guardar Nuevo Password" class="boton">
    </div>

</form>

<div class="acciones">
    <a href="/">¿Ya tienes cuenta?Iniciar Sesión</a>
    <a href="/crear-cuenta">¿Aún no tienes cuenta? Obtener una</a>
</div>