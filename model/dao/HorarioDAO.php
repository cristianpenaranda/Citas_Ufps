<?php

class HorarioDAO {

    //INGRESAR NUEVO HORARIO
    static function registroHorarioDAO($horarioDTO) {
        $conexion = Conexion::crearConexion();
        try {
            $fecha = $horarioDTO->getFecha();
            $inicio = $horarioDTO->getInicio();
            $fin = $horarioDTO->getFin();
            $id = $horarioDTO->getFuncionario();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("INSERT INTO  horario(fecha,hora_inicio,hora_fin,funcionario) VALUES (?,?,?,?)");
            $stm->bindParam(1, $fecha, PDO::PARAM_STR);
            $stm->bindParam(2, $inicio, PDO::PARAM_STR);
            $stm->bindParam(3, $fin, PDO::PARAM_STR);
            $stm->bindParam(4, $id, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }

    //LISTAR HORARIOS DE UN FUNCIONARIO
    static function listarHorarioDAO($id) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT id,DATE_FORMAT(fecha,'%d-%b-%Y') fecha,hora_inicio,hora_fin,funcionario FROM horario WHERE funcionario=?");
            $stm->bindParam(1, $id, PDO::PARAM_STR);
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $horarioDTO = new HorarioDTO($consulta['id'], $consulta['fecha'], $consulta['hora_inicio'], $consulta['hora_fin'], $consulta['funcionario']);
                array_push($pila, $horarioDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar horarios");
        }
        return $pila;
    }

    //LISTAR HORARIOS DE UNA DEPENDENCIA
    static function listarHorarioSolicitudDAO($fecha, $dep) {
        $conexion = Conexion::crearConexion();
        $fechaFin = date("y-m-d",strtotime($fecha."+ 8 days"));
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT h.id,DATE_FORMAT(h.fecha,'%d-%M-%Y') fecha,h.hora_inicio,h.hora_fin,h.funcionario FROM horario h WHERE h.funcionario=? AND h.fecha >= ? AND h.fecha <= ? ORDER BY h.fecha ASC");
            $stm->bindParam(1, $dep, PDO::PARAM_STR);
            $stm->bindParam(2, $fecha, PDO::PARAM_STR);
            $stm->bindParam(3, $fechaFin, PDO::PARAM_STR);
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $horarioDTO = new HorarioDTO($consulta['id'], $consulta['fecha'], $consulta['hora_inicio'], $consulta['hora_fin'], $consulta['funcionario']);
                array_push($pila, $horarioDTO);
            }
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $pila;
    }

     //VALIDAR CANTIDAD DE CITAS PARA UN HORARIO
    static function validarCantidadCitasDAO($fecha, $inicio) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT COUNT(c.id) cantidad FROM cita c INNER JOIN horario h ON h.id=c.horario AND h.fecha=? AND h.hora_inicio=?");
            $stm->bindParam(1, $fecha, PDO::PARAM_STR);
            $stm->bindParam(2, $inicio, PDO::PARAM_STR);
            $stm->execute();
            $resultado = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al contar citas");
        }
        return $resultado;
    }


}
