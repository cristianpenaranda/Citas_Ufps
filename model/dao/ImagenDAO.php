<?php

class ImagenDAO{

    //LISTAR IMAGENES DEL CARRUSEL
    static function listarImagenesDAO() {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT * FROM imagenes_anuncios");
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $imgDTO = new ImagenDTO($consulta['id'], $consulta['nombre'], $consulta['archivo']);
                array_push($pila, $imgDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar imagenes");
        }
        return $pila;
    }

    //MOSTRAR IMAGEN LISTADO
    static function mostrarImagenListadoDAO($img) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT * FROM imagenes_anuncios WHERE id=?");
            $stm->bindParam(1, $img, PDO::PARAM_STR);
            $stm->execute();
            $consulta = $stm->fetch();
            $imgDTO = new ImagenDTO($consulta['id'], $consulta['nombre'], $consulta['archivo']);
        } catch (Exception $ex) {
            throw new Exception("Error al mostrar imagen listado");
        }
        return $imgDTO;
    }
    
    //ELIMINAR IMAGEN
    static function eliminarImagenDAO($img){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {           
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("DELETE FROM imagenes_anuncios WHERE id=?");
            $stm->bindParam(1, $img, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al eliminar la imagen");
        }
        return $exito;
    }
    
    //TOTAL IMAGENES
    static function mostrarTotalImaDAO(){
        $conexion = Conexion::crearConexion();
        try {           
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT COUNT(id) cantidad FROM imagenes_anuncios");
            $stm->execute();
            $exito = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }
}

