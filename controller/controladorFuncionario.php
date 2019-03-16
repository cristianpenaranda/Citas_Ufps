<?php

class controladorFuncionario{
    private $negocioFuncionario;
	
    public function __construct(){
	$this->negocioFuncionario = new negocio();
    }
    
    //BUSCA EL FUNCIONARIO
    public function buscarFuncionarioControlador($usuario, $contraseña){
        return $this->negocioFuncionario->buscarFuncionarioNegocio($usuario, $contraseña);
    }

    //INGRESAR NUEVA NOTICIA
    public function ingresarNuevaNoticiaControlador($noticiaDTO){
        return $this->negocioFuncionario->ingresarNuevaNoticiaNegocio($noticiaDTO);
    }

    //LISTAR NOTICIAS
    public function listarNoticiasFunControlador($idFun){
        return $this->negocioFuncionario->listarNoticiasFunNegocio($idFun);
    }

    //LISTAR HORARIOS
    public function listarHorarioControlador($id){
        return $this->negocioFuncionario->listarHorarioNegocio($id);
    }

    //REGISTRO DE HORARIO
    public function registroHorarioControlador($horarioDTO){
        return $this->negocioFuncionario->registroHorarioNegocio($horarioDTO);
    }

    //CAMBIAR ESTADO DE LA CITA
    public function cambiarEstadoCitaControlador($cita){
        return $this->negocioFuncionario->cambiarEstadoCitaNegocio($cita);
    }

}