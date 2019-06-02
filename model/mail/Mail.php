<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


class Mail {

    public function enviarCorreoRecordarContraseña($nombre, $correo, $mensaje) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        $exito = false;
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "pruebaswebufps@gmail.com";
            $mail->Password = "kakaroto1494";
            $mail->setFrom('palo1493@gmail.com','Citas UFPS');
            $mail->addAddress($correo);
            $mail->isHTML(true);

            $mail->Subject = 'Recordar clave de Citas UFPS'; //asunto

            $mail->Body = $this->plantillaRecordatorio($nombre, $mensaje); //mensaje
            
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->send(); //enviar    
        } catch (Exception $e) {
            throw new Exception('No lograste enviar el correo ');
        }
        return $exito;
    }

    public function plantillaRecordatorio($nombre, $mensaje) {
        $plantilla = '<div style="width:90%;display:block;margin:auto;padding: 1em;border: 2px solid #aa1916;border-radius: 15px 45px 15px 45px;">
        <h1 style=" font-family:arial;font-size: 25px;color: black;font-family: arial;text-align: center;">¡ Estimado(a), ' . $nombre . ' !</h1>
        <hr style="margin-left: 0;width: 100%;border: 3px solid #aa1916;border-radius: 100px /4px;">
        <p style="font-size: 18px;color: black;font-family: arial;"> Te encuentras registrado en nuestra plataforma y has solicitado recordar tu contraseña. <br><br>
        Tu contraseña es = ' . $mensaje . '<br><br> Para mayor seguridad, le recomendamos eliminar este mensaje o cambiar la contraseña desde el sitio.</p><br>
        Si no lo ha solicitado ignore este mensaje.<br><br>
        <a style="font-size: 30px;background: #aa1916;padding: 2px;text-decoration: none;width: 50%;border-radius: .3rem;color: white;display: block;margin: auto;text-align: center;font-family: arial;border:1px solid rgba(83,44,26,.95)" href="http://localhost/citasufps" role="button">Ir al Sitio</a>
        <p style="text-align:center;"> Citas UFPS.<br>
            Sistema de tickets para la atención al usuario. <br>
            &#169;2019<br></p>
      </div>';
        return $plantilla;
    }


    public function enviarCorreoRegistro($nombre, $correo, $clave, $usuario) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        $exito = false;
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "pruebaswebufps@gmail.com";
            $mail->Password = "kakaroto1494";
            $mail->setFrom('palo1493@gmail.com','Citas UFPS');
            $mail->addAddress($correo);
            $mail->isHTML(true);

            $mail->Subject = 'Bienvenido a Citas UFPS!'; //asunto

            $mail->Body = $this->plantillaRegistro($nombre, $usuario, $clave); //mensaje
            
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->send(); //enviar    
        } catch (Exception $e) {
            throw new Exception('No lograste enviar el correo ');
        }
        return $exito;
    }

    public function plantillaRegistro($nombre, $usuario, $clave) {
        $plantilla = '<div style="width:90%;display:block;margin:auto;padding: 1em;border: 2px solid #aa1916;border-radius: 15px 15px 15px 15px;">
        <h1 style=" font-family:arial;font-size: 25px;color: black;font-family: arial;text-align: center;">¡ Estimado(a), ' . $nombre .' !</h1>
        <hr style="margin-left: 0;width: 100%;border: 3px solid #aa1916;border-radius: 100px /5px;">
        <p style="font-size: 18px;color: black;font-family: arial;"> Te damos la bienvenida a Citas UFPS, sitio web de la Universidad Francisco de Paula Santander donde se pueden solicitar citas de atención a usuarios en diferentes dependencias. <br><br>
        Para el ingreso debes ingresar al siguiente enlace: <a href="http://localhost/Citas_Ufps" title="Ir al sitio">Aquí</a><br><br>
        Tus datos son: <br>
        Usuario: ' . $usuario .'<br>
        Contraseña: ' . $clave .'</p>
        <p style="text-align:center;"> Citas UFPS.<br>
            Sistema de tickets para la atención al usuario. <br>
            &#169;2019<br></p>
      </div>';
        return $plantilla;
    }


    
    public function enviarCorreoTurno($turno,$fecha,$hora,$dep,$correo,$nombre) {
        require 'vendor/autoload.php';

        $mail = new PHPMailer(true);
        $exito = false;
        try {
            $mail->isSMTP();
            $mail->SMTPDebug = 0;
            $mail->Host = 'smtp.gmail.com';
            $mail->Port = 587;
            $mail->SMTPSecure = 'tls';
            $mail->SMTPAuth = true;
            $mail->Username = "pruebaswebufps@gmail.com";
            $mail->Password = "kakaroto1494";
            $mail->setFrom('palo1493@gmail.com','Citas UFPS');
            $mail->addAddress($correo);
            $mail->isHTML(true);

            $mail->Subject = 'Turno asignado'; //asunto

            $mail->Body = $this->plantillaTurno($turno,$fecha,$hora,$dep,$nombre); //mensaje
            
            $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name' => false, 'allow_self_signed' => true));

            $exito = $mail->send(); //enviar    
        } catch (Exception $e) {
            throw new Exception($e->getTraceAsString());
        }
        return $exito;
    }

    public function plantillaTurno($turno,$fecha,$hora,$dep,$nombre) {
        $plantilla = '<div style="width:90%;display:block;margin:auto;padding: 1em;border: 2px solid #aa1916;border-radius: 15px 15px 15px 15px;">
        <h1 style=" font-family:arial;font-size: 25px;color: black;font-family: arial;text-align: center;">¡ Turno Asignado !</h1>
        <hr style="margin-left: 0;width: 100%;border: 3px solid #aa1916;border-radius: 100px /5px;">
        <p style="font-size: 18px;color: black;font-family: arial;">Señor(a) '.$nombre.', le notificamos que ha solicitado un turno. <br><br>
        Número del turno: '.$turno.' <br>
        Fecha de la Cita: '.$fecha.' <br>
        Hora de la Cita: '.$hora.' <br>
        Lugar: '.$dep.' <br><br>
        Por favor presentarse 10 minutos antes.
            <p style="text-align:center;"> Citas UFPS.<br>
            Sistema de tickets para la atención al usuario. <br>
            &#169;2019<br></p>
      </div>';
        return $plantilla;
    }
}
