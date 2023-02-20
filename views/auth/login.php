<h1 class="nombre-pagina">Login</h1>
<p class="descripcion-pagina">Iniciar Sesión con tus datos</p>

<!-- foreach para iterar el arreglo de alertas y mostrarlas en caso de que existan -->
<?php include_once __DIR__ . "/../templates/alertas.php"; ?> 

<form action="/" method="POST" class="formulario">
    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" value="<?php echo s($auth->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Ingresa tu Password">
    </div>

    <div class="campo-boton">
    <input type="submit" value="Iniciar Sesión" class="boton">
    </div>
</form>

    <div class="acciones">
        <a href="/crear-cuenta">¿Aún no tienes una cuenta? Crear una</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>