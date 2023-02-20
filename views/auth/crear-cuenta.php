<h1 class="nombre-pagina">Crear Cuenta de Usuario</h1>
<p class="descripcion-pagina">Llena el siguiente formulario para crear una cuenta</p>

<!-- foreach para iterar el arreglo de alertas y mostrarlas en caso de que existan -->
<?php include_once __DIR__ . "/../templates/alertas.php"; ?> 

<form action="/crear-cuenta" method="POST" class="formulario">
    
    <div class="campo">
        <label for="nombre">Nombre</label>
        <input type="text" name="nombre" id="nombre" placeholder="Ingresa tu nombre" value="<?php echo s($usuario->nombre); ?>">
    </div>

    <div class="campo">
        <label for="apellido">Apellido</label>
        <input type="text" name="apellido" id="apellido" placeholder="Ingresa tu apellido" value="<?php echo s($usuario->apellido); ?>">
    </div>

    <div class="campo">
        <label for="telefono">Teléfono</label>
        <input type="tel" name="telefono" id="telefono" placeholder="Ingresa tu teléfono" value="<?php echo s($usuario->telefono); ?>">
    </div>

    <div class="campo">
        <label for="email">E-mail</label>
        <input type="email" name="email" id="email" placeholder="Ingresa tu E-mail" value="<?php echo s($usuario->email); ?>">
    </div>

    <div class="campo">
        <label for="password">Password</label>
        <input type="password" name="password" id="password" placeholder="Ingresa tu Password">
    </div>

    <div class="campo-boton">
    <input type="submit" value="Crear Cuenta" class="boton">
    </div>

</form>

    <div class="acciones">
        <a href="/">¿Ya tienes una Cuenta? Inicia sesión</a>
        <a href="/olvide">¿Olvidaste tu password?</a>
    </div>
