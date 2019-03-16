<?php

class PersonaDAO{    

    //busca datos de persona en la bd
    static function buscarDatosPersonaDAO($usuario){
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select documento,nombre,telefono,correo from persona where documento=?");
            $stm->bindParam(1, $usuario, PDO::PARAM_STR);
            $stm->execute();
            $persona = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al buscar datos en bd");
        }
        return $persona;
    }
    
    //busca persona en la bd
    static function buscarPersonaDAO($usuario){
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select documento from persona where documento=?");
            $stm->bindParam(1, $usuario, PDO::PARAM_STR);
            $stm->execute();
            $persona = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al buscar persona en bd");
        }
        return $persona;
    }
    
    //registra persona en la bd
    static function registroPersonaDAO($personaDTO){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $documento = $personaDTO->getDocumento();
            $nombre = $personaDTO->getNombre();
            $telefono = $personaDTO->getTelefono();
            $correo = $personaDTO->getCorreo();
            
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("INSERT INTO  persona(documento, nombre, telefono, correo) VALUES (?,?,?,?)");
            $stm->bindParam(1, $documento, PDO::PARAM_STR);
            $stm->bindParam(2, $nombre, PDO::PARAM_STR);
            $stm->bindParam(3, $telefono, PDO::PARAM_STR);
            $stm->bindParam(4, $correo, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al registrar persona en bd");
        }
        return $exito;
    }
    
    //MODIFICAR PERSONA 
    static function modificarPersonaDAO($personaDTO){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {           
            $documento = $personaDTO->getDocumento();
            $nombre = $personaDTO->getNombre();
            $telefono = $personaDTO->getTelefono();
            $correo = $personaDTO->getCorreo();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("UPDATE persona SET documento=?,nombre=?,telefono=?,correo=? WHERE documento=?");
            $stm->bindParam(1, $documento, PDO::PARAM_STR);
            $stm->bindParam(2, $nombre, PDO::PARAM_STR);
            $stm->bindParam(3, $telefono, PDO::PARAM_STR);
            $stm->bindParam(4, $correo, PDO::PARAM_STR);
            $stm->bindParam(5, $documento, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al modificar la persona");
        }
        return $exito;
    }
}

