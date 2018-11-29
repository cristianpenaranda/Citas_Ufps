<?php

class controladorAdministrador{
    private $negocioAdministrador;
	
    public function __construct(){
	$this->negocioAdministrador = new negocio();
    }    

    //BUSCA EL ADMINISTRADOR PARA LOGUEAR
    public function buscarAdministradorControlador($usuario, $contraseña){
        return $this->negocioAdministrador->buscarAdministradorNegocio($usuario, $contraseña);
    } 
    
    //BUSCA EL USUARIO DEL ADMINISTRADOR
    public function buscarUsuarioAdministradorControlador(){
        return $this->negocioAdministrador->buscarUsuarioAdministradorNegocio();
    } 

    //INGRESAR NUEVA NOTICIA DE ADMINISTRADOR
    public function ingresarNuevaNoticiaControlador($noticiaDTO){
        return $this->negocioAdministrador->ingresarNuevaNoticiaNegocio($noticiaDTO);
    }

    //INGRESAR NUEVA DEPENDENCIA
    public function registroDependenciaControlador($depDTO){
        return $this->negocioAdministrador->registroDependenciaNegocio($depDTO);
    }

    //LISTAR FUNCIONARIOS PARA EL REGISTRO UNA DEPENDENCIA
    public function listarFuncionariosRegistroControlador(){
        return $this->negocioAdministrador->listarFuncionariosRegistroNegocio();
    }

    //LISTAR FUNCIONARIOS 
    public function listarFuncionariosControlador(){
        return $this->negocioAdministrador->listarFuncionariosNegocio();
    }

    //LISTAR NOTICIAS DE ADMINISTRADOR
    public function listarNoticiasAdminControlador(){
        return $this->negocioAdministrador->listarNoticiasAdminNegocio();
    }

    //LISTAR DEPENDENCIAS
    public function listarDependenciasControlador(){
        return $this->negocioAdministrador->listarDependenciasNegocio();
    }
    
    //MOSTRAR INFORMACIÓN DE NOTICIA DE ADMINISTRADOR
    public function mostrarInfoNoticiaControlador($idNoticia){
        return $this->negocioAdministrador->mostrarInfoNoticiaNegocio($idNoticia);
    }
    
    //MOSTRAR INFORMACIÓN DEL FUNCIONARIO
    public function mostrarInfoFuncionarioControlador($idFuncionario){
        return $this->negocioAdministrador->mostrarInfoFuncionarioNegocio($idFuncionario);
    }
    
    //MOSTRAR INFORMACIÓN DE LA DEPENDENCIA
    public function mostrarInfoDependenciaControlador($idDep){
        return $this->negocioAdministrador->mostrarInfoDependenciaNegocio($idDep);
    }
    
    //ELIMINAR NOTICIA DE ADMINISTRADOR
    public function eliminarNoticiaControlador($idNoticia){
        return $this->negocioAdministrador->eliminarNoticiaNegocio($idNoticia);
    }
    
    //MODIFICAR NOTICIA DE ADMINISTRADOR
    public function modificarNoticiaControlador($noticiaDTO){
        return $this->negocioAdministrador->modificarNoticiaNegocio($noticiaDTO);
    }
    
    //MODIFICAR PERSONA
    public function modificarFuncionarioControlador($personaDTO){
        return $this->negocioAdministrador->modificarFuncionarioNegocio($personaDTO);
    }
    
    //MODIFICAR DEPENDENCIA
    public function modificarDependenciaControlador($depDTO){
        return $this->negocioAdministrador->modificarDependenciaNegocio($depDTO);
    }
        
    //REGISTRA EL FUNCIONARIO
    public function registroFuncionarioControlador($usuario, $contraseña){
        return $this->negocioAdministrador->registroFuncionarioNegocio($usuario, $contraseña);
    }
}