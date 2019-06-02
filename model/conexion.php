<?php
class Conexion {
    
    public static function crearConexion(){
        try{
        //include '../../config.php';            
        //$conexion= new PDO("mysql:host=".$host.";dbname=".$bd_nombre,$bd_usuario,$bd_contrasenia,array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        $conexion= new PDO("mysql:host=localhost;dbname=citasufps","root","",array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        /*$fecha = date("Y")."-".date("m")."-".date("d");
        $stm1 = $conexion->prepare("DELETE FROM cita WHERE horario = (SELECT MAX(id) FROM horario WHERE fecha < ".$fecha.")");
        $stm1->execute();
        $stm2 = $conexion->prepare("DELETE FROM horario WHERE fecha < ".$fecha);   
        $stm2->execute();*/
        return $conexion;
        } catch (Exception $ex) {
            throw new Exception("Error al conectar con la base de datos. Por favor contacta con el soporte de la pagina.");
        }
    }
}

