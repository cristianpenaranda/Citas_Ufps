<?php

class controladorUsuario{
    private $negocioUsuario;
	
    public function __construct(){
	$this->negocioUsuario = new negocio();
    }
    
    //busca el usuario
    public function buscarUsuarioControlador($usuario, $contraseña){
        return $this->negocioUsuario->buscarUsuarioNegocio($usuario, $contraseña);
    }
    
    //registra el usuario
    public function registroUsuarioControlador($usuario, $contraseña){
        return $this->negocioUsuario->registroUsuarioNegocio($usuario, $contraseña);
    }
    
    //LISTAR HORARIOS DE UNA DEPENDENCIA
    public function listarHorarioSolicitudControlador($fecha, $dep){
        return $this->negocioUsuario->listarHorarioSolicitudNegocio($fecha, $dep);
    }
    
     //VALIDAR CANTIDAD DE CITAS PARA UN HORARIO
    public function validarCantidadCitasControlador($fecha, $inicio){
        return $this->negocioUsuario->validarCantidadCitasNegocio($fecha, $inicio);
    }
    
     //CONSULTAR TURNO
    public function consultarTurnoControlador($idHorario, $usuario, $fun){
        return $this->negocioUsuario->consultarTurnoNegocio($idHorario, $usuario, $fun);
    }
    
     //CONSULTAR TURNO ACTUAL 
    public function consultarTurnoActualControlador($idHorario, $fun){
        return $this->negocioUsuario->consultarTurnoActualNegocio($idHorario, $fun);
    }
    
     //INGRESAR CITA
    public function ingresarCitaControlador($citaDTO){
        return $this->negocioUsuario->ingresarCitaNegocio($citaDTO);
    }
    
    //LISTAR CITAS DE UN USUARIO 
    public function listarCitasUsuarioControlador($idUsuario){
        return $this->negocioUsuario->listarCitasUsuarioNegocio($idUsuario);
    }
    
    //LISTAR CITAS POR ATENDER
    public function listarCitasPorAtenderControlador($fecha, $fun){
        return $this->negocioUsuario->listarCitasPorAtenderNegocio($fecha, $fun);
    }
    
    //CANCELAR CITA
    public function cancelarCitaControlador($idCita){
        return $this->negocioUsuario->cancelarCitaNegocio($idCita);
    }

}