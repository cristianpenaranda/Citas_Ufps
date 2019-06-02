<?php

class DependenciaDAO{

    //INGRESAR NUEVA DEPENDENCIA
    static function regiastroDependenciaDAO($DepDTO) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $nombre = $DepDTO->getNombre();
            $ubicacion = $DepDTO->getUbicacion();
            $telefono = $DepDTO->getTelefono();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("INSERT INTO  dependencia(nombre,ubicacion,telefono) VALUES (?,?,?)");
            $stm->bindParam(1, $nombre, PDO::PARAM_STR);
            $stm->bindParam(2, $ubicacion, PDO::PARAM_STR);
            $stm->bindParam(3, $telefono, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }

    //LISTAR DEPENDENCIAS
    static function listarDependenciaDAO() {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id,nombre from dependencia");
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $depDTO = new DependenciaDTO($consulta['id'],$consulta['nombre'],null,null,null);
                array_push($pila, $depDTO);
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $pila;
    }

    //LISTAR DEPENDENCIAS VISTA SOLICITUD
    static function listarDependenciaSolicitudDAO() {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT p.documento id,d.nombre,d.ubicacion,d.telefono,p.nombre funcionario FROM dependencia d INNER JOIN funcionario f ON f.dependencia=d.id LEFT JOIN persona p ON p.documento=f.documento");
            $stm->execute();
            $pila = $stm->fetchAll();
            /*$pila = array();
            while ($consulta = $stm->fetch()) {
                $depDTO = new DependenciaDTO($consulta['id'],$consulta['nombre'],$consulta['ubicacion'],$consulta['telefono']);
                array_push($pila, $depDTO);
            }*/
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $pila;
    }
    
    //BUSCA DATOS DE LAS DEPENDENCIAS
    static function mostrarInfoDependenciaDAO($idDep){
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT d.nombre,d.ubicacion,d.telefono FROM dependencia d WHERE id=?");
            $stm->bindParam(1, $idDep, PDO::PARAM_STR);
            $stm->execute();
            $dep = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $dep;
    } 
    
    //LISTAR DEPENDECIAS PARA EL REGISTRO UN FUNCIONARIO
    static function listarDependenciasRegistroDAO(){
        $conexion = Conexion::crearConexion();
        try {
            $dep = "";
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT id,nombre FROM dependencia");
            $stm->execute();
            $dep = array();
            while ($consulta = $stm->fetch()) {
                $depDTO = new DependenciaDTO($consulta['id'], $consulta['nombre'], null, null);
                array_push($dep, $depDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar dependencias para el registro de un funcionario");
        }
        return $dep;
    }
    
    //MODIFICAR DEPENDENCIA
    static function modificarDependenciaDAO($DepDTO){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {           
            $id = $DepDTO->getId();
            $nombre = $DepDTO->getNombre();
            $ubicacion = $DepDTO->getUbicacion();
            $telefono = $DepDTO->getTelefono();          
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("UPDATE dependencia SET nombre=?,ubicacion=?,telefono=? WHERE id=?");
            $stm->bindParam(1, $nombre, PDO::PARAM_STR);
            $stm->bindParam(2, $ubicacion, PDO::PARAM_STR);
            $stm->bindParam(3, $telefono, PDO::PARAM_STR);
            $stm->bindParam(4, $id, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }
    
    //TOTAL DEPENDENCIAS REGISTRADAS
    static function mostrarTotalDepDAO(){
        $conexion = Conexion::crearConexion();
        try {           
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT COUNT(id) cantidad FROM dependencia");
            $stm->execute();
            $exito = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }

}

