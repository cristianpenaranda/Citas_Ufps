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

}