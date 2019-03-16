<?php

class Conexion {
    
    public static function crearConexion(){
        try{
            
        $conexion= new PDO("mysql:host=localhost;dbname=citasufps","root","",array(PDO::ATTR_PERSISTENT => true,PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES  \'UTF8\''));
        return $conexion;
        } catch (Exception $ex) {
            throw new Exception("Error al conectar con la base de datos. Por favor contacta con el soporte de la pagina.");
        }
    }
}