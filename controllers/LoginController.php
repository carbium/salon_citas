<?php

namespace Controllers;

use Classes\Email;
use Model\Usuario;
use MVC\Router;

class LoginController {

        public static function login(Router $router){
            
            $alertas = [];
            $auth = new Usuario; //con esto creo un objeto en caso de no colocar el password, me guarde el email y no volverlo a escribir ( no recomendado)

            if($_SERVER["REQUEST_METHOD"] === "POST") {

                $auth = new Usuario($_POST);
                $alertas = $auth->validarLogin();

                if(empty($alertas)) {
                    //Comprobar que exista usuario
                    $usuario = Usuario::where('email', $auth->email);

                    if($usuario) {
                        //Verificar el password
                        if($usuario->comprobarPasswordAndVerificado($auth->password)) {
                            //Iniciar sesion, isset para evitar notice

                            if(!isset($_SESSION)) {
                                session_start();  
                            }
                            
                            $_SESSION["id"] = $usuario->id;
                            $_SESSION["nombre"] = $usuario->nombre . " " . $usuario->apellido;
                            $_SESSION["email"] = $usuario->email;
                            $_SESSION["login"] = true;

                            //Redireccionamiento
                            if($usuario->admin === "1") {
                                $_SESSION["admin"] = $usuario->admin ?? null;
                                header("location: /admin");
                            } else {
                                header("location: /cita");
                            }

                        }

                    } else {
                        Usuario::setAlerta("error", "Usuario no encontrado");
                    }
                }

            }
            $alertas = Usuario::getAlertas();

            $router->render("auth/login", [
                "alertas" => $alertas,
                "auth" => $auth

            ]);
        }

        public static function logout(){
            session_start();
            $_SESSION = [];

            header("location: /");
        }

        public static function olvide(Router $router){
            
            $alertas = [];

            if($_SERVER["REQUEST_METHOD"] === "POST") {

                $auth = new Usuario($_POST);
                $alertas = $auth->validarEmail();

                if(empty($alertas)){
                    $usuario = Usuario::where("email", $auth->email);

                    if($usuario && $usuario->confirmado === "1") {
                        //Generar token
                        $usuario->crearToken();
                        $usuario->guardar();

                        //Enviar email
                        Usuario::setAlerta("exito", "Revisa tu Email");

                        $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                        $email->enviarInstrucciones();


                    } else {
                        Usuario::setAlerta("error", "Usuario no existe o no esta confirmado");
                    }
                }
            }
            $alertas = Usuario::getAlertas();

            $router->render("auth/olvide-password", [
                "alertas" => $alertas

            ]);
        }

        public static function recuperar(Router $router){
            $alertas = [];
            $error = false;
            $token = s($_GET["token"]);

            //Buscar usuario por su token
            $usuario = Usuario::where("token", $token);
            if(empty($usuario)){
                Usuario::setAlerta("error", "Token No Valido");
                $error = true;
            }

            if($_SERVER["REQUEST_METHOD"] === "POST") {
                // Leer nuevo password y guardarlo
                $password = new Usuario($_POST);
                $alertas = $password->validarPassword();

                if(empty($alertas)) {
                    $usuario->password = null;
                    $usuario->password = $password->password;
                    $usuario->hashPassword();
                    $usuario->token = null;

                    $resultado = $usuario->guardar();

                    if($resultado){
                        header("location: /");
                    }
                }
            }

            $alertas = Usuario::getAlertas();
            $router->render("auth/recuperar-password", [
                "alertas" => $alertas,
                "error" => $error
            ]);
        }

        public static function crear(Router $router){
            
            $usuario = new Usuario;

            //Arreglo para alertas
            $alertas = [];
            if($_SERVER["REQUEST_METHOD"] === "POST") {
                $usuario->sincronizar($_POST);
                $alertas = $usuario->validarNuevaCuenta();

                //Revisar que alertas este vacio
                if(empty($alertas)) {
                   //Verificar que el usuario no este registrado (por email)
                   $resultado = $usuario->existeUsuario();
                   //mandar la alerta a la vista
                        if($resultado->num_rows) {
                            $alertas = Usuario::getAlertas();
                        } else {
                            $usuario->hashPassword();
                            //Generar un token unico
                            $usuario->crearToken();

                            //enviar el email
                            $email = new Email($usuario->nombre, $usuario->email, $usuario->token);
                            //enviar email confirmacion
                            $email->enviarConfirmacion();

                            //crear el usuario
                            $resultado = $usuario->guardar();
                            if($resultado){
                                header("location: /mensaje");
                            }
                        }
                }
            
            }          
            
            $router->render("auth/crear-cuenta", [
                "usuario" => $usuario,
                "alertas" => $alertas
            ]);

        }

        public static function mensaje(Router $router){
            $router->render("auth/mensaje");
        }

        public static function confirmar(Router $router){
            $alertas = [];
            $token = s($_GET["token"]);
            $usuario = Usuario::where('token', $token);

                if(empty($usuario)) {
                    //Mostrar mensaje de error
                    Usuario::setAlerta("error", "Token No Válido");
                } else {
                    //Modificar usuario confirmado
                    $usuario->confirmado = "1";
                    $usuario->token = null;
                    $usuario->guardar();
                    Usuario::setAlerta("exito", "Cuenta Confirmada Correctamente");
                }

            $alertas = Usuario::getAlertas();
            $router->render("auth/confirmar", [
                "alertas" => $alertas
            ]);
        }
}
