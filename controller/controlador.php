<?php

class controlador{
    private $negocio;
	
    public function __construct(){
	$this->negocio = new negocio();
    }

    public function generarPlantilla(){
	return negocio::generarPlantilla();
    }

    //CARGA ARCHIVO DEL ENLACE
    public function generarVista(){
	$enlace = filter_input(INPUT_GET, "ubicacion");
	if($enlace){
        	$enlace = $this->negocio->generarEnlace($enlace);
	}else {
		$enlace = $this->negocio->generarEnlace("login");
	}
      	include_once $enlace;
    }
    
    //busca datos del usuario
    public function buscarDatosControlador($usuario){
        return $this->negocio->buscarDatosNegocio($usuario);
    }
    
    //busca persona
    public function buscarPersonaControlador($usuario){
        return $this->negocio->buscarPersonaNegocio($usuario);
    }
    
    //registra la persona 
    public function registroPersonaControlador($personaDTO){
        return $this->negocio->registroPersonaNegocio($personaDTO);
    }

    //listar noticias inicio
    public function listarNoticiasInicioControlador(){
        return $this->negocio->listarNoticiasInicioNegocio();
    }
    
    //MODIFICAR PERSONA
    public function modificarPersonaControlador($personaDTO){
        return $this->negocio->modificarPersonaNegocio($personaDTO);
    }


}