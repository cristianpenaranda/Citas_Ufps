<?php

class UsuarioDAO{

    //busca el Usuario en la bd
    static function buscarUsuarioDAO($usuario, $contraseña){
        $conexion = Conexion::crearConexion();
        $persona = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT f.documento FROM usuario f INNER JOIN persona p ON f.documento=? AND p.clave=?");
            $stm->bindParam(1, $usuario, PDO::PARAM_STR);
            $stm->bindParam(2, $contraseña, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->rowCount();
            if ($row>0) {
                $persona=true;
            }
        } catch (Exception $ex) {
            throw new Exception("Error al buscar el Usuario en bd");
        }
        return $persona;
    } 
    
    //registra usuario en la bd
    static function registroUsuarioDAO($documento){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("INSERT INTO  usuario(documento) VALUES (?)");
            $stm->bindParam(1, $documento, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al registrar usuario en bd");
        }
        return $exito;
    }
    
    
    
    //TOTAL USUARIOS REGISTRADOS
    static function mostrarTotalUsuDAO(){
        $conexion = Conexion::crearConexion();
        try {           
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT COUNT(documento) cantidad FROM usuario");
            $stm->execute();
            $exito = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }
}

