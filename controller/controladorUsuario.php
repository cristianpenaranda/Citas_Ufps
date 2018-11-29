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
    

}