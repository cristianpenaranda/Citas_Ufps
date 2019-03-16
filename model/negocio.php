<?php

class negocio{

	//GENERA LA PLANTILLA
	public function generarPlantilla(){
		include 'view/plantilla.php';
	}

	//GENERA ENLACE DE LA BARRA DE NAVEGACION
	public function generarEnlace($enlace){
        if($this->validarPestañas($enlace)){
           return "view/modulos/pestanas/".$enlace.".php";
       }else if($this->validarPestañasAdmin($enlace)){
           return "view/modulos/pestanas/pestanasAdmin/".$enlace.".php";
       }else if($this->validarPestañasFun($enlace)){
           return "view/modulos/pestanas/pestanasFun/".$enlace.".php";
       }else if($this->validarPestañasUser($enlace)){
           return "view/modulos/pestanas/pestanasUser/".$enlace.".php";
       }else{
           return "view/modulos/pestanas/errorpage.php";
       }
   }

    //OBTIENE A PESTAÑA DEL MENU DE ADIMINISTRADOR
    private function validarPestañasAdmin($pestaña){
      $exito=false;
      $pestañas=array("administrador_noticias","administrador_dependencias","administrador_funcionarios");
      if(in_array($pestaña, $pestañas)){
           $exito=true;
       }
       return $exito;
    }

    //OBTIENE A PESTAÑA DEL MENU DE FUNCIONARIO
    private function validarPestañasFun($pestaña){
      $exito=false;
      $pestañas=array("funcionario_noticias","funcionario_horarios");
      if(in_array($pestaña, $pestañas)){
           $exito=true;
        }
        return $exito;
    }   

    //OBTIENE A PESTAÑA DEL MENU DE USUARIO
    private function validarPestañasUser($pestaña){
      $exito=false;
      $pestañas=array("usuario_solicitud","mis_citas");
      if(in_array($pestaña, $pestañas)){
           $exito=true;
        }
        return $exito;
    }

	//OBTIENE A PESTAÑA DEL MENU
    private function validarPestañas($pestaña){
        $exito=false;
        $pestañas=array("login","inicio","errorpage","perfil","salir");
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
    //MOSTRAR TOTALES EN PESTAÑA ADMIN
    public function mostrarTotalDepNegocio(){
        return DependenciaDAO::mostrarTotalDepDAO();
    }    
    public function mostrarTotalFunNegocio(){
        return FuncionarioDAO::mostrarTotalFunDAO();
    }    
    public function mostrarTotalNotNegocio(){
        return NoticiaDAO::mostrarTotalNotDAO();
    }    
    public function mostrarTotalUsuNegocio(){
        return UsuarioDAO::mostrarTotalUsuDAO();
    }    
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
    //LISTAR DEPENDENCIAS VISTA SOLICITUD
    public function listarDependenciasSolicitudNegocio(){
        return DependenciaDAO::listarDependenciaSolicitudDAO();
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

    //LISTAR HORARIOS DE UNA DEPENDENCIA
    public function listarHorarioSolicitudNegocio($fecha, $dep){
        return HorarioDAO::listarHorarioSolicitudDAO($fecha, $dep);
    }  

     //VALIDAR CANTIDAD DE CITAS PARA UN HORARIO
    public function validarCantidadCitasNegocio($fecha, $inicio){
        return HorarioDAO::validarCantidadCitasDAO($fecha, $inicio);
    }  

     //CONSULTAR TURNO
    public function consultarTurnoNegocio($idHorario, $usuario, $fun){
        return CitaDAO::consultarTurnoDAO($idHorario, $usuario, $fun);
    }  

     //CONSULTAR TURNO ACTUAL
    public function consultarTurnoActualNegocio($idHorario, $fun){
        return CitaDAO::consultarTurnoActualDAO($idHorario, $fun);
    }  

     //INGRESAR CITA
    public function ingresarCitaNegocio($citaDTO){
        return CitaDAO::ingresarCitaDAO($citaDTO);
    }  

    //LISTAR CITAS DE UN USUARIO 
    public function listarCitasUsuarioNegocio($idUsuario){
        return CitaDAO::listarCitasUsuarioDAO($idUsuario);
    }  

    //LISTAR CITAS POR ATENDER 
    public function listarCitasPorAtenderNegocio($fecha, $fun){
        return CitaDAO::listarCitasPorAtenderDAO($fecha, $fun);
    }  

    //CANCLEAR CITA
    public function cancelarCitaNegocio($idCita){
        return CitaDAO::cancelarCitaDAO($idCita);
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
    //LISTAR HORARIOS
    public function listarHorarioNegocio($id){
        return HorarioDAO::listarHorarioDAO($id);
    }    
    //REGISTRO DE HORARIO
    public function registroHorarioNegocio($horarioDTO){
        return HorarioDAO::registroHorarioDAO($horarioDTO);
    }    
    //CAMBIAR ESTADO DE LA CITA
    public function cambiarEstadoCitaNegocio($cita){
        return CitaDAO::cambiarEstadoCitaDAO($cita);
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