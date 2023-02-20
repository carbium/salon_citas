<h1 class="nombre-pagina">Crear Servicios</h1>
<p class="descripcion-pagina">Llena todos los campos para añadir nuevo servicio</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php"
?>

<form class="formulario" action="/servicios/crear" method="POST">

    <?php include_once __DIR__ . "/formulario.php" ?>

    <div class="barra-servicios">
        <input type="submit" value="Guardar Servicio" class="boton">
        <a href="/servicios" class="boton">Ver Servicios</a>
    </div>

</form>