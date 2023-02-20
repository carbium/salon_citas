<?php 

namespace Model;

//esta clase es para la tabla que une a las tres, pero como citaservicio contiene la info de la mayoria, uso esta
class AdminCita extends ActiveRecord {
    protected static $tabla = "citaservicios";
    protected static $columnasDB = ["id", "hora", "cliente", "email", "telefono", "servicio", "precio"];

    public $id;
    public $hora;
    public $cliente;
    public $email;
    public $telefono;
    public $servicio;
    public $precio;

    public function __construct($args = [])
    {
        $this->id =         $args["id"] ?? null;
        $this->hora =       $args["hora"] ?? "";
        $this->cliente =    $args["hora"] ?? "";
        $this->email =      $args["email"] ?? "";
        $this->telefono =   $args["telefono"] ?? "";
        $this->servicio =   $args["servicio"] ?? "";
        $this->precio =     $args["precio"] ?? "";
    }
}
