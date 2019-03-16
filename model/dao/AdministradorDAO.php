<?php

class AdministradorDAO{

    //busca el administrador en la bd
    static function buscarAdministradorDAO($usuario, $contraseña){
        $conexion = Conexion::crearConexion();
        $persona = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select usuario_admin from administrador where usuario_admin=? and clave=?");
            $stm->bindParam(1, $usuario, PDO::PARAM_STR);
            $stm->bindParam(2, $contraseña, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->rowCount();
            if ($row>0) {
                $persona=true;
            }
        } catch (Exception $ex) {
            throw new Exception("Error al buscar el administrador en bd");
        }
        return $persona;
    }
    
    //busca usuario de administrador
    static function buscarUsuarioAdministradorDAO(){
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select usuario_admin from administrador");
            $stm->execute();
            $persona = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al buscar usuario administrador en bd");
        }
        return $persona;
    }
}

