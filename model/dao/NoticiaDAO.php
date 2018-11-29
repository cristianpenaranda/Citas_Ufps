<?php

class NoticiaDAO {

    //INGRESAR NUEVA NOTICIA ADMINISTRADOR
    function ingresarNuevaNoticiaDAO($noticiaDTO) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $fun = $noticiaDTO->getFuncionario();
            if($fun != null){
                $titulo = $noticiaDTO->getTitulo();
                $descripcion = $noticiaDTO->getDescripcion();
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stm = $conexion->prepare("INSERT INTO  noticia(titulo,descripcion,fecha,funcionario) VALUES (?,?,NOW(),?)");
                $stm->bindParam(1, $titulo, PDO::PARAM_STR);
                $stm->bindParam(2, $descripcion, PDO::PARAM_STR);
                $stm->bindParam(3, $fun, PDO::PARAM_STR);
                $exito = $stm->execute();                
            }else{                
                $titulo = $noticiaDTO->getTitulo();
                $descripcion = $noticiaDTO->getDescripcion();
                $admin = $noticiaDTO->getAdministrador();
                $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                $stm = $conexion->prepare("INSERT INTO  noticia(titulo,descripcion,fecha,administrador) VALUES (?,?,NOW(),?)");
                $stm->bindParam(1, $titulo, PDO::PARAM_STR);
                $stm->bindParam(2, $descripcion, PDO::PARAM_STR);
                $stm->bindParam(3, $admin, PDO::PARAM_STR);
                $exito = $stm->execute();
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }

    //LISTAR NOTICIAS EN INICIO
    function listarNoticiasInicioDAO() {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select n.id,n.titulo,n.descripcion,REPLACE(n.administrador,administrador,'Administrador') administrador,DATE_FORMAT(n.fecha, '%d-%b-%Y') fecha,REPLACE(n.funcionario,n.funcionario, (SELECT p.nombre from persona p where p.documento=n.funcionario)) funcionario from noticia n order by id desc limit 9");
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $noticiaDTO = new NoticiaDTO($consulta['id'], $consulta['titulo'], $consulta['descripcion'], $consulta['fecha'], $consulta['administrador'], $consulta['funcionario']);
                array_push($pila, $noticiaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar noticias");
        }
        return $pila;
    }

    //LISTAR NOTICIAS DE ADMINISTRADOR
    function listarNoticiasAdminDAO() {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id,titulo,DATE_FORMAT(fecha, '%d-%b-%Y') fecha from noticia where administrador is not null");
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $noticiaDTO = new NoticiaDTO($consulta['id'], $consulta['titulo'], NULL, $consulta['fecha'], NULL, NULL);
                array_push($pila, $noticiaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar noticias administrador");
        }
        return $pila;
    }

    //LISTAR NOTICIAS DE FUNCIONARIO
    function listarNoticiasFunDAO($idFun) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select id,titulo,DATE_FORMAT(fecha, '%d-%b-%Y') fecha from noticia where funcionario=?");
            $stm->bindParam(1, $idFun, PDO::PARAM_STR);
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $noticiaDTO = new NoticiaDTO($consulta['id'], $consulta['titulo'], NULL, $consulta['fecha'], NULL, NULL);
                array_push($pila, $noticiaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar noticias funcionario");
        }
        return $pila;
    }
    
    //BUSCA DATOS DE NOTICIA
    function mostrarInfoNoticiaDAO($idNoticia){
        $conexion = Conexion::crearConexion();
        $noticia = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT titulo,descripcion,DATE_FORMAT(fecha, '%d-%b-%Y') fecha FROM noticia WHERE id=?");
            $stm->bindParam(1, $idNoticia, PDO::PARAM_STR);
            $stm->execute();
            $persona = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al buscar la noticia en bd");
        }
        return $persona;
    }    
    
    //ELIMINAR NOTICIA
    function eliminarNoticiaDAO($idNoticia){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {           
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("DELETE FROM noticia WHERE id=?");
            $stm->bindParam(1, $idNoticia, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al eliminar la noticia");
        }
        return $exito;
    }
    
    //MODIFICAR NOTICIA
    function modificarNoticiaDAO($noticiaDTO){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {           
            $id = $noticiaDTO->getId();
            $titulo = $noticiaDTO->getTitulo();
            $descripcion = $noticiaDTO->getDescripcion();            
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("UPDATE noticia SET titulo=?,descripcion=? WHERE id=?");
            $stm->bindParam(1, $titulo, PDO::PARAM_STR);
            $stm->bindParam(2, $descripcion, PDO::PARAM_STR);
            $stm->bindParam(3, $id, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al modificar la noticia");
        }
        return $exito;
    }

}
