<h1 class="nombre-pagina">Olvidaste tu password</h1>
<p class="descripcion-pagina">Reestablace tu Password</p>

<!-- foreach para iterar el arreglo de alertas y mostrarlas en caso de que existan -->
<?php include_once __DIR__ . "/../templates/alertas.php"; ?> 

<form action="/olvide" method="POST" class="formulario">
<div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail">
    </div>

    <div class="campo-boton">
    <input type="submit" value="Enviar Instrucciones" class="boton">
    </div>  
</form>

    <div class="acciones">
        <a href="/">Ya tienes una cuenta? Inicia Sesión</a>
        <a href="/crear-cuenta">Aún no tienes una cuenta?</a>
    </div>