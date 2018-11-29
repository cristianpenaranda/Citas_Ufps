<?php

class FuncionarioDAO{

    //BUSCA EL FUNCIONARIO DE LA BD
    function buscarFuncionarioDAO($usuario, $contraseña){
        $conexion = Conexion::crearConexion();
        $persona = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT documento FROM funcionario WHERE documento=? AND clave=?");
            $stm->bindParam(1, $usuario, PDO::PARAM_STR);
            $stm->bindParam(2, $contraseña, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->rowCount();
            if ($row>0) {
                $persona=true;
            }
        } catch (Exception $ex) {
            throw new Exception("Error al buscar el Funcionario en bd");
        }
        return $persona;
    }
    
    //REGISTRA EL FUNCIONARIO EN LA BD  
    function registroFuncionarioDAO($documento, $contraseña){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("INSERT INTO  funcionario (documento, clave) VALUES (?,?)");
            $stm->bindParam(1, $documento, PDO::PARAM_STR);
            $stm->bindParam(2, $contraseña, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al registrar funcionario en bd");
        }
        return $exito;
    }
    
    //LISTAR FUNCIONARIOS PARA EL REGISTRO UNA DEPENDENCIA
    function listarFuncionariosRegistroDAO(){
        $conexion = Conexion::crearConexion();
        try {
            $fun = "";
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select p.documento,p.nombre from persona p inner join funcionario f on f.documento=p.documento and f.documento not in (select funcionario from dependencia)");
            $stm->execute();
            $fun = array();
            while ($consulta = $stm->fetch()) {
                $personaDTO = new PersonaDTO($consulta['documento'], $consulta['nombre'], Null, null);
                array_push($fun, $personaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar funcionario para el registro de la dependencia");
        }
        return $fun;
    }
    
    //LISTAR FUNCIONARIOS
    function listarFuncionariosDAO(){
        $conexion = Conexion::crearConexion();
        try {
            $fun = "";
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("select p.documento,p.nombre from persona p inner join funcionario f on f.documento=p.documento");
            $stm->execute();
            $fun = array();
            while ($consulta = $stm->fetch()) {
                $personaDTO = new PersonaDTO($consulta['documento'], $consulta['nombre'], Null, null);
                array_push($fun, $personaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar funcionarios");
        }
        return $fun;
    }
    
    //BUSCA DATOS DEL FUNCIONARIO
    function mostrarInfoFuncionarioDAO($idFuncionario){
        $conexion = Conexion::crearConexion();
        $noticia = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT p.documento,p.nombre,p.telefono,p.correo,d.nombre dependencia FROM persona p LEFT JOIN dependencia d ON p.documento=? INNER JOIN funcionario f ON f.documento=p.documento");
            $stm->bindParam(1, $idFuncionario, PDO::PARAM_STR);
            $stm->execute();
            $persona = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al mostrar la informacion del funcionario");
        }
        return $persona;
    }   
    
    //MODIFICAR FUNCIONARIO 
    function modificarFuncionarioDAO($personaDTO){
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {           
            $documento = $personaDTO->getDocumento();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("UPDATE funcionario SET documento=? WHERE documento=?");
            $stm->bindParam(1, $documento, PDO::PARAM_STR);
            $stm->bindParam(2, $documento, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al modificar el funcionario");
        }
        return $exito;
    }
}

