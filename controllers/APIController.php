<?php

namespace Controllers;

use Model\Cita;
use Model\Servicio;
use Model\CitaServicio;

class APIController {
   
    //metodo para enviar los servicios al javascript
    public static function index() {
        $servicios = Servicio::all();
        echo json_encode($servicios);
    }

    //metodo para recibir la informacion de la cita y guardarla en las tablas
    public static function guardar () {

        //Almacena la cita y devuelve el id (de la cita)
        $cita = new Cita($_POST);
        $resultado = $cita->guardar();

        $id = $resultado["id"];

        //Almacena la cita ID y el servicio(s) Id en la tabla citaservicios
        $idServicios = explode(",", $_POST["servicios"]);

        foreach($idServicios as $idServicio) {
            $args = [
                "citaId" => $id,
                "servicioId" => $idServicio
            ];
            $citaServicio = new CitaServicio($args);
            $citaServicio->guardar();
        }

        $respuesta = [
            "resultado" => $resultado  
        ];
      
        echo json_encode($respuesta);

    }

    public static function eliminar() {
        

        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];  

            $cita = Cita::find($id);
            
                $cita->eliminar();
                header("location:" . $_SERVER["HTTP_REFERER"]);
            
            }

        }
}