<?php

class negocio{

	//GENERA LA PLANTILLA
	public function generarPlantilla(){
		include 'view/plantilla.php';
	}

	//GENERA ENLACE DE LA BARRA DE NAVEGACION
	public function generarEnlace($enlace){
        if($this->validarPestañas($enlace)){
           return "view/modulos/pestañas/".$enlace.".php";
       }else if($this->validarPestañasAdmin($enlace)){
           return "view/modulos/pestañas/pestañasAdmin/".$enlace.".php";
       }else if($this->validarPestañasFun($enlace)){
           return "view/modulos/pestañas/pestañasFun/".$enlace.".php";
       }else if($this->validarPestañasUser($enlace)){
           return "view/modulos/pestañas/pestañasUser/".$enlace.".php";
       }else{
           return "view/modulos/pestañas/errorpage.php";
       }
   }

    //OBTIENE A PESTAÑA DEL MENU DE ADIMINISTRADOR
    private function validarPestañasAdmin($pestaña){
      $exito=false;
      $pestañas=array("Administrador_Noticias","Administrador_Dependencias","Administrador_Funcionarios");
      if(in_array($pestaña, $pestañas)){
           $exito=true;
       }
       return $exito;
    }

    //OBTIENE A PESTAÑA DEL MENU DE FUNCIONARIO
    private function validarPestañasFun($pestaña){
      $exito=false;
      $pestañas=array("Funcionario_Noticias","Funcionario_Horarios");
      if(in_array($pestaña, $pestañas)){
           $exito=true;
        }
        return $exito;
    }   

    //OBTIENE A PESTAÑA DEL MENU DE USUARIO
    private function validarPestañasUser($pestaña){
      $exito=false;
      $pestañas=array();
      if(in_array($pestaña, $pestañas)){
           $exito=true;
        }
        return $exito;
    }

	//OBTIENE A PESTAÑA DEL MENU
    private function validarPestañas($pestaña){
        $exito=false;
        $pestañas=array("Login","Inicio","ErrorPage","Perfil","Salir");
        if(in_array($pestaña, $pestañas)){
            $exito=true;
        }
        return $exito;
    }

    //////////////////GENERALES//////////////////////////
    //LISTAR NOTICIAS DE INICIO
    public function listarNoticiasInicioNegocio(){
        return NoticiaDAO::listarNoticiasInicioDAO();
    }    
    
    
    //////////////////ADMINISTRADOR//////////////////////////
    //BUSCA ADMINISTRADOR PARA LOGUEAR
    public function buscarAdministradorNegocio($usuario, $contraseña){
        return AdministradorDAO::buscarAdministradorDAO($usuario, $contraseña);
    }    
    //BUSCA USUARIO DE ADMINISTRADOR
    public function buscarUsuarioAdministradorNegocio(){
        return AdministradorDAO::buscarUsuarioAdministradorDAO();
    }      
    //INGRESAR NUEVA NOTICIA DE ADMINISTRADOR
    public function ingresarNuevaNoticiaNegocio($noticiaDTO){
        return NoticiaDAO::ingresarNuevaNoticiaDAO($noticiaDTO);
    }          
    //INGRESAR NUEVA DEPENDENCIA 
    public function registroDependenciaNegocio($depDTO){
        return DependenciaDAO::regiastroDependenciaDAO($depDTO);
    }      
    //LISTAR NOTICIAS DE ADMINISTRADOR
    public function listarNoticiasAdminNegocio(){
        return NoticiaDAO::listarNoticiasAdminDAO();
    }      
    //LISTAR FUNCIONARIOS PARA EL REGISTRO UNA DEPENDENCIA
    public function listarFuncionariosRegistroNegocio(){
        return FuncionarioDAO::listarFuncionariosRegistroDAO();
    }      
    //LISTAR FUNCIONARIOS 
    public function listarFuncionariosNegocio(){
        return FuncionarioDAO::listarFuncionariosDAO();
    }       
    //LISTAR DEPENDENCIAS 
    public function listarDependenciasNegocio(){
        return DependenciaDAO::listarDependenciaDAO();
    }       
    //MOSTRAR INFORMACION NOTICIA ADMINISTRADOR
    public function mostrarInfoNoticiaNegocio($idNoticia){
        return NoticiaDAO::mostrarInfoNoticiaDAO($idNoticia);
    }       
    //MOSTRAR INFORMACION FUNCIONARIO
    public function mostrarInfoFuncionarioNegocio($idFuncionario){
        return FuncionarioDAO::mostrarInfoFuncionarioDAO($idFuncionario);
    }         
    //MOSTRAR INFORMACION DEPENDENCIA
    public function mostrarInfoDependenciaNegocio($idDep){
        return DependenciaDAO::mostrarInfoDependenciaDAO($idDep);
    }         
    //ELIMINAR NOTICIA ADMINISTRADOR
    public function eliminarNoticiaNegocio($idNoticia){
        return NoticiaDAO::eliminarNoticiaDAO($idNoticia);
    }          
    //MODIFICAR NOTICIA ADMINISTRADOR
    public function modificarNoticiaNegocio($noticiaDTO){
        return NoticiaDAO::modificarNoticiaDAO($noticiaDTO);
    }              
    //MODIFICAR FUNCIONARIO
    public function modificarFuncionarioNegocio($personaDTO){
        return FuncionarioDAO::modificarFuncionarioDAO($personaDTO);
    }              
    //MODIFICAR DEPENDENCIA
    public function modificarDependenciaNegocio($depDTO){
        return DependenciaDAO::modificarDependenciaDAO($depDTO);
    }      
    //REGISTRA FUNCIONARIO
    public function registroFuncionarioNegocio($usuario, $contraseña){
        return FuncionarioDAO::registroFuncionarioDAO($usuario, $contraseña);
    }       
    
    
    //////////////////USUARIO//////////////////////////
    //BUSCAR USUARIO
    public function buscarUsuarioNegocio($usuario, $contraseña){
        return UsuarioDAO::buscarUsuarioDAO($usuario, $contraseña);
    } 

    //REGISTRAR USUARIO
    public function registroUsuarioNegocio($usuario, $contraseña){
        return UsuarioDAO::registroUsuarioDAO($usuario, $contraseña);
    } 
    
    
    //////////////////FUNCIONARIO//////////////////////////
    //BUSCAR FUNCIONARIO 
    public function buscarFuncionarioNegocio($usuario, $contraseña){
        return FuncionarioDAO::buscarFuncionarioDAO($usuario, $contraseña);
    }       
    //LISTAR NOTICIAS DE FUNCIONARIO
    public function listarNoticiasFunNegocio($idFun){
        return NoticiaDAO::listarNoticiasFunDAO($idFun);
    }    
    
    
    //////////////////PERSONA//////////////////////////
    //REGISTRA PERSONA
    public function registroPersonaNegocio($personaDTO){
        return PersonaDAO::registroPersonaDAO($personaDTO);
    }    
    //BUSCA PERSONA
    public function buscarPersonaNegocio($persona){
        return PersonaDAO::buscarPersonaDAO($persona);
    } 
    //BUSCA DATOS DE PERSONA
    public function buscarDatosNegocio($persona){
        return PersonaDAO::buscarDatosPersonaDAO($persona);
    }       
    //MODIFICAR PERSONA
    public function modificarPersonaNegocio($personaDTO){
        return PersonaDAO::modificarPersonaDAO($personaDTO);
    }  
}