<?php
namespace Controllers;

use Model\Servicio;
use MVC\Router;

class ServicioController {

    public static function index (Router $router) {
        $servicios = Servicio::all();

        isAdmin();
        $router->render("servicios/index", [
            "nombre" => $_SESSION["nombre"],
            "servicios" => $servicios
        
        ]);

    }

    public static function crear (Router $router) {
        isAdmin();
        $servicio = new Servicio;
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                Servicio::setAlerta("exito", "Servicio Creado Correctamente");
                header("refresh:1;url=http:/servicios");
            }

        }
        $alertas = Servicio::getAlertas();
        $router->render("servicios/crear", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        
        ]);
        
    }

    public static function actualizar (Router $router) {
        isAdmin();
        if(!is_numeric($_GET["id"])) return;
        $servicio = Servicio::find($_GET["id"]);
        $alertas = [];

        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $servicio->sincronizar($_POST);
            $alertas = $servicio->validar();

            if (empty($alertas)) {
                $servicio->guardar();
                Servicio::setAlerta("exito", "Servicio Actualizado Correctamente");
                header("refresh:2;url=http:/servicios");
            }
        }
        $alertas = Servicio::getAlertas();
        $router->render("servicios/actualizar", [
            "nombre" => $_SESSION["nombre"],
            "servicio" => $servicio,
            "alertas" => $alertas
        
        ]);
    }

    public static function eliminar () {
        isAdmin();
        if($_SERVER["REQUEST_METHOD"] === "POST") {
            $id = $_POST["id"];
            $servicio = Servicio::find($id);
             $servicio->eliminar();
             header("location: /servicios");

        }
    }


}