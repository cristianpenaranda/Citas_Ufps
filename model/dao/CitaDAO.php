<?php

class CitaDAO {

    //CONSULTAR TURNO
    static function consultarTurnoDAO($idHorario, $usuario, $fun) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT c.id FROM cita c INNER JOIN funcionario f ON f.documento=c.funcionario AND c.funcionario=? INNER JOIN horario h ON h.id=c.horario AND c.horario=? INNER JOIN usuario u ON u.documento=c.usuario AND c.usuario=?");
            $stm->bindParam(1, $fun, PDO::PARAM_STR);
            $stm->bindParam(2, $idHorario, PDO::PARAM_STR);
            $stm->bindParam(3, $usuario, PDO::PARAM_STR);
            $stm->execute();
            $row = $stm->rowCount();
            if ($row > 0) {
                $exito = true;
            }
        } catch (Exception $ex) {
            throw new Exception("Error al buscar turno");
        }
        return $exito;
    }

    //CONSULTAR TURNO ACTUAL
    static function consultarTurnoActualDAO($idHorario, $fun) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT c.turno FROM cita c INNER JOIN funcionario f ON f.documento=c.funcionario AND c.funcionario=? INNER JOIN horario h ON h.id=c.horario AND c.horario=?");
            $stm->bindParam(1, $fun, PDO::PARAM_STR);
            $stm->bindParam(2, $idHorario, PDO::PARAM_STR);
            $stm->execute();
            $exito = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al buscar turno actual");
        }
        return $exito;
    }

    //INGRESAR CITA
    static function ingresarCitaDAO($citaDTO) {
        $conexion = Conexion::crearConexion();
        try {
            $turno = $citaDTO->getTurno();
            $estado = $citaDTO->getEstado();
            $horario = $citaDTO->getHorario();
            $usuario = $citaDTO->getUsuario();
            $fun = $citaDTO->getFuncionario();
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("INSERT INTO  cita(turno,estado,horario,usuario,funcionario) VALUES (?,?,?,?,?)");
            $stm->bindParam(1, $turno, PDO::PARAM_STR);
            $stm->bindParam(2, $estado, PDO::PARAM_STR);
            $stm->bindParam(3, $horario, PDO::PARAM_STR);
            $stm->bindParam(4, $usuario, PDO::PARAM_STR);
            $stm->bindParam(5, $fun, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception($ex->getTraceAsString());
        }
        return $exito;
    }   
    
    //LISTAR CITAS DE UN USUARIO 
    static function listarCitasUsuarioDAO($idUsuario) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT c.id,c.turno,c.estado,h.hora_inicio inicio,d.nombre dependencia,p.nombre funcionario FROM cita c INNER JOIN horario h ON h.id=c.horario INNER JOIN funcionario f ON h.funcionario=f.documento INNER JOIN persona p ON p.documento=f.documento INNER JOIN dependencia d ON d.id=f.dependencia WHERE c.usuario=?");
            $stm->bindParam(1, $idUsuario, PDO::PARAM_STR);
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $citaDTO = new CitaDTO($consulta['id'], $consulta['turno'], $consulta['estado'], $consulta['inicio'], $consulta['funcionario'], $consulta['dependencia']);
                array_push($pila, $citaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar citas de un usuario");
        }
        return $pila;
    }
    
    //LISTAR CITAS POR ATENDER
    static function listarCitasPorAtenderDAO($fun, $horario) {
        $conexion = Conexion::crearConexion();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT c.id,c.turno,h.hora_inicio,p.nombre,c.estado FROM cita c INNER JOIN horario h ON h.id=c.horario INNER JOIN persona p ON p.documento=c.usuario WHERE h.id=? AND c.funcionario=?");
            $stm->bindParam(1, $horario, PDO::PARAM_STR);
            $stm->bindParam(2, $fun, PDO::PARAM_STR);
            $stm->execute();
            $pila = array();
            while ($consulta = $stm->fetch()) {
                $citaDTO = new CitaDTO($consulta['id'],$consulta['turno'], $consulta['estado'], $consulta['hora_inicio'], $consulta['nombre'], null);
                array_push($pila, $citaDTO);
            }
        } catch (Exception $ex) {
            throw new Exception("Error al listar citas por atender");
        }
        return $pila;
    }

    
    //CANCELAR CITA
    static function cancelarCitaDAO($idCita) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("DELETE FROM cita WHERE id=?");
            $stm->bindParam(1, $idCita, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al cancelar la cita");
        }
        return $exito;
    }

    //CAMBIAR ESTADO DE LA CITA
    static function cambiarEstadoCitaDAO($cita) {
        $conexion = Conexion::crearConexion();
        $exito = false;
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("UPDATE cita SET estado='ATENDIDA' WHERE id=?");
            $stm->bindParam(1, $cita, PDO::PARAM_STR);
            $exito = $stm->execute();
        } catch (Exception $ex) {
            throw new Exception("Error al modificar el estado de la cita");
        }
        return $exito;
    }

    
    
    //BUSCAR INFORMACION DE LA CITA
    static function buscarCitaDAO($citaDTO) {
        $conexion = Conexion::crearConexion();
        $turno = $citaDTO->getTurno();
        $horario = $citaDTO->getHorario();
        $usuario = $citaDTO->getUsuario();
        $funcionario = $citaDTO->getFuncionario();
        try {
            $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $stm = $conexion->prepare("SELECT c.turno,DATE_FORMAT(h.fecha, '%d-%b-%Y') fecha,h.hora_inicio,p.nombre,d.nombre dep FROM cita c INNER JOIN horario h ON h.id=c.horario AND h.id=? INNER JOIN persona p ON p.documento=c.usuario AND c.usuario=? INNER JOIN funcionario f ON f.documento=c.funcionario INNER JOIN dependencia d ON d.id=f.dependencia AND c.funcionario=? WHERE c.turno=?");
            $stm->bindParam(1, $horario, PDO::PARAM_STR);
            $stm->bindParam(2, $usuario, PDO::PARAM_STR);
            $stm->bindParam(3, $funcionario, PDO::PARAM_STR);
            $stm->bindParam(4, $turno, PDO::PARAM_STR);
            $stm->execute();
            $consulta = $stm->fetch();
        } catch (Exception $ex) {
            throw new Exception("Error al buscar la cita");
        }
        return $consulta;
    }

}
