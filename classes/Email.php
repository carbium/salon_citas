<?php

namespace Classes;

use PHPMailer\PHPMailer\PHPMailer;

class Email {
//Definimos la forma en que esta construido el objeto
    public $nombre;
    public $email;
    public $token;

    public function __construct($nombre, $email, $token)
    {
        $this->nombre = $nombre;
        $this->email = $email;
        $this->token = $token;
    }

    public function enviarConfirmacion() {

        //Crear el objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '4480809c67a2c5';
        $mail->Password = 'addafcf7da81b8';

        $mail->setFrom("cesar@appsalon.com");
        $mail->addAddress("salon@appsalon.com", "appsalon.com");
        $mail->Subject = "Confirma tu Cuenta para AppSalon";

        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has creado tu cuenta en AppSalon, solo debes confirmar presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/confirmar-cuenta?token=" . $this->token . "'>Confirmar Cuenta</a> </p>";
        $contenido .= "<p>Si tu no solicitaste esta cuenta, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar mail
        $mail->send();

    }

    public function enviarInstrucciones() {
        //Crear el objeto email
        $mail = new PHPMailer();
        $mail->isSMTP();
        $mail->Host = 'sandbox.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Port = 2525;
        $mail->Username = '4480809c67a2c5';
        $mail->Password = 'addafcf7da81b8';

        $mail->setFrom("cesar@appsalon.com");
        $mail->addAddress("salon@appsalon.com", "appsalon.com");
        $mail->Subject = "Reestablece tu password para AppSalon";

        $mail->isHTML(TRUE);
        $mail->CharSet = "UTF-8";
        $contenido = "<html>";
        $contenido .= "<p><strong>Hola " . $this->nombre . "</strong> Has solicitado reestablecer tu password en AppSalon, solo debes confirmar presionando el siguiente enlace</p>";
        $contenido .= "<p>Presiona aqui: <a href='http://localhost:3000/recuperar?token=" . $this->token . "'>Reestablecer Password</a> </p>";
        $contenido .= "<p>Si tu no solicitaste este Email, puedes ignorar el mensaje </p>";
        $contenido .= "</html>";

        $mail->Body = $contenido;

        //Enviar mail
        $mail->send();
    }
}

?>