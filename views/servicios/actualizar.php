<h1 class="nombre-pagina">Actualizar Servicios</h1>
<p class="descripcion-pagina">Modifica los valores del formulario</p>

<?php 
    include_once __DIR__ . "/../templates/alertas.php";
?>

<form class="formulario" method="POST">

    <?php include_once __DIR__ . "/formulario.php" ?>

    <div class="barra-servicios">
        <input type="submit" value="Actualizar Servicio" class="boton">
        <a href="/servicios" class="boton">Ver Servicios</a>
    </div>

</form>