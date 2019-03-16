<?php

include_once '../../model/dto/PersonaDTO.php';
include_once '../../model/dto/NoticiaDTO.php';
include_once '../../model/dto/DependenciaDTO.php';
include_once '../../model/dto/HorarioDTO.php';
include_once '../../model/dto/CitaDTO.php';

require_once '../../model/dao/UsuarioDAO.php';
require_once '../../model/dao/PersonaDAO.php';
require_once '../../model/dao/AdministradorDAO.php';
require_once '../../model/dao/FuncionarioDAO.php';
require_once '../../model/dao/NoticiaDAO.php';
require_once '../../model/dao/DependenciaDAO.php';
require_once '../../model/dao/HorarioDAO.php';
require_once '../../model/dao/CitaDAO.php';

require_once '../../controller/controlador.php';
require_once '../../controller/controladorAdministrador.php';
require_once '../../controller/controladorFuncionario.php';
require_once '../../controller/controladorUsuario.php';

require_once '../../model/negocio.php';
require_once '../../model/conexion.php';

class Ajax {

    private $controlador;
    private $controladorAdministrador;
    private $controladorFuncionario;
    private $controladorUsuario;

    public function __construct() {
        $this->controlador = new controlador();
        $this->controladorAdministrador = new controladorAdministrador();
        $this->controladorFuncionario = new controladorFuncionario();
        $this->controladorUsuario = new controladorUsuario();
    }

    //ENCRIPTAR UNA CONTRASEÑA
    private static function encriptar($string) {
        $output = FALSE;
        $key = hash('sha256', '$CRISTIAN@2018sv');
        $iv = substr(hash('sha256', '1151190'), 0, 16);
        $output = openssl_encrypt($string, 'AES-256-CBC', $key, 0, $iv);
        $output = base64_encode($output);
        return $output;
    }

    //DESENCRIPTAR UNA CONTRASEÑA
    private static function desencriptar($string) {
        $key = hash('sha256', '$CRISTIAN@2018sv');
        $iv = substr(hash('sha256', '1151190'), 0, 16);
        $output = openssl_decrypt(base64_decode($string), 'AES-256-CBC', $key, 0, $iv);
        return $output;
    }

    //MOSTRAR TOTALES EN PESTAÑA INICIO DE ADMIN
    public function mostrarTotalesAjax(){
        $consultaDep = $this->controladorAdministrador->mostrarTotalDepControlador();
        $consultaFun = $this->controladorAdministrador->mostrarTotalFunControlador();
        $consultaNot = $this->controladorAdministrador->mostrarTotalNotControlador();
        $consultaUsu = $this->controladorAdministrador->mostrarTotalUsuControlador();
        $totales = $consultaDep['cantidad'].'ª'.$consultaFun['cantidad'].'ª'.$consultaNot['cantidad'].'ª'.$consultaUsu['cantidad'];        
        echo $totales;
    }


    //METODO PARA LOGUEARSE EN LA APLICACION
    public function LoguearUsuarioAjax($usuario, $contraseña, $tipoUsuario) {
        $exito = false;
        try {
            $encriptar = $this->encriptar($contraseña);
            if ($tipoUsuario == "Administrador") {
                $exito = $this->controladorAdministrador->buscarAdministradorControlador($usuario, $encriptar);
                if ($exito) {
                    session_start();
                    $tipo = "Administrador";
                    $_SESSION["Tipo"] = serialize($tipo);
                    echo json_encode(array("exito" => true));
                } else {
                    echo json_encode(array("exito" => false, "error" => "Revise su Usuario y contraseña"));
                }
            } else if ($tipoUsuario == "Funcionario") {
                $exito = $this->controladorFuncionario->buscarFuncionarioControlador($usuario, $encriptar);
                if ($exito) {
                    session_start();
                    $tipo = "Funcionario";
                    $datos = $this->controlador->buscarDatosControlador($usuario);
                    $personaDTO = new PersonaDTO($datos['documento'], $datos['nombre'], $datos['telefono'], $datos['correo']);
                    $_SESSION["Tipo"] = serialize($tipo);
                    $_SESSION["Usuario"] = serialize($personaDTO);
                    echo json_encode(array("exito" => true));
                } else {
                    echo json_encode(array("exito" => false, "error" => "Revise su Usuario y contraseña"));
                }
            } else {
                $exito = $this->controladorUsuario->buscarUsuarioControlador($usuario, $encriptar);
                if ($exito) {
                    session_start();
                    $tipo = "Usuario";
                    $datos = $this->controlador->buscarDatosControlador($usuario);
                    $personaDTO = new PersonaDTO($datos['documento'], $datos['nombre'], $datos['telefono'], $datos['correo']);
                    $_SESSION["Tipo"] = serialize($tipo);
                    $_SESSION["Usuario"] = serialize($personaDTO);
                    echo json_encode(array("exito" => true));
                } else {
                    echo json_encode(array("exito" => false, "error" => "Revise su Usuario y contraseña"));
                }
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
    }

    //REGISTRO DE UN USUARIO NUEVO
    public function RegistroUsuarioAjax($documento, $nombre, $telefono, $correo, $clave) {
        $exito = false;
        try {
            $encriptar = $this->encriptar($clave);
            $consulta = $this->controlador->buscarPersonaControlador($documento);
            if (!$consulta) {
                //registra en tabla persona
                $personaDTO = new PersonaDTO($documento, $nombre, $telefono, $correo);
                $registroPersona = $this->controlador->registroPersonaControlador($personaDTO);
                //registra en tabla cliente
                $registroCliente = $this->controladorUsuario->registroUsuarioControlador($documento, $encriptar);
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo registrar el usuario"));
        }
    }   
    
    
    //MOSTRAR PERFIL 
    public function mostrarPerfilAjax($id) {
        $exito = false;
        $respuesta = "";
        try {
            $consulta = $this->controlador->buscarDatosControlador($id);
            $respuesta = $consulta['documento'].'ª'.$consulta['nombre'].'ª'.$consulta['telefono'].'ª'.$consulta['correo'];
            $exito = true;
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("respuesta" => $respuesta));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo mostrar perfil"));
        }
    }
    
    

    //REGISTRO DE UNA NOTICIA
    public function RegistroNoticiaAjax($titulo, $descripcion, $tipo) {
        $exito = false;
        try {
            if($tipo == "Administrador"){
                $consulta = $this->controladorAdministrador->buscarUsuarioAdministradorControlador();
                $admin = $consulta['usuario_admin'];
                $noticiaDTO = new NoticiaDTO(NULL, $titulo, $descripcion, NULL, $admin, NULL);
                $exito = $this->controladorAdministrador->ingresarNuevaNoticiaControlador($noticiaDTO);                
            }else{
                $noticiaDTO = new NoticiaDTO(NULL, $titulo, $descripcion, NULL, NULL, $tipo);
                $exito = $this->controladorFuncionario->ingresarNuevaNoticiaControlador($noticiaDTO);
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo ingresar la noticia"));
        }
    }

    //LISTAR NOTICIAS EN INICIO
    public function listarNoticiasAjax() {
        $consulta = $this->controlador->listarNoticiasInicioControlador();
        $noticias="";
        $creador = "";
        if(count($consulta)== 0){
            $noticias = '<h4 class="mt-2 mb-4" style="display:block;margin:auto;">¡¡¡ No hay noticias !!!</h4>';
        }else{
            for ($index = 0; $index < count($consulta); $index++) {                
                if($consulta[$index]->getAdministrador() != null){
                    $creador = $consulta[$index]->getAdministrador();
                }else{
                    $creador = $consulta[$index]->getFuncionario();
                }
                $noticias .= '<div class="col-md-3 carousel-item-inicio">
                                    <h5>' . $consulta[$index]->getTitulo() . '</h5>
                                    <hr>
                                    <p>' . $consulta[$index]->getDescripcion() . '</p>
                                    <span><ion-icon name="person"></ion-icon> ' . $creador . ' - <ion-icon name="calendar"></ion-icon> ' . $consulta[$index]->getFecha() . '</span>
                                  </div>';
            }
        }
        echo $noticias;
    }

    //LISTAR NOTICIAS DEL ADMINISTRADOR
    public function listarNoticiasAdminAjax() {
        $consulta = $this->controladorAdministrador->listarNoticiasAdminControlador();
        $noticias="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $noticias .= '<tr>
                                <th scope="row">'.$consulta[$index]->getId().'</th>
                                <td>'.$consulta[$index]->getFecha().'</td>
                                <td>'.$consulta[$index]->getTitulo().'</td>
                                <td style="display:block;margin:auto;"><button href="#VerInfoNoticiaAdmin" data-toggle="modal" type="button" id="'.$consulta[$index]->getId().'" title="Ver" class="btn btn-outline-success verNoticiaAdmin"><ion-icon name="eye"></ion-icon></button></td>
                            </tr>';
            }
        }else{
            $noticias = "false";
        }
        echo $noticias;
    }

    //LISTAR NOTICIAS DEL FUNCIONARIO
    public function listarNoticiasFunAjax($idFun) {
        $consulta = $this->controladorFuncionario->listarNoticiasFunControlador($idFun);
        $noticias="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $noticias .= '<tr>
                                <th scope="row">'.$consulta[$index]->getId().'</th>
                                <td>'.$consulta[$index]->getFecha().'</td>
                                <td>'.$consulta[$index]->getTitulo().'</td>
                                <td style="display:block;margin:auto;"><button href="#VerInfoNoticiaFun" data-toggle="modal" type="button" id="'.$consulta[$index]->getId().'" title="Ver" class="btn btn-outline-success verNoticiaFun"><ion-icon name="eye"></ion-icon></button></td>
                            </tr>';
            }
        }else{
            $noticias = "false";
        }
        echo $noticias;
    }
    
    //MOSTRAR LA INFORAMCION DE LA NOTICIA
    public function mostrarInfoNoticiaAjax($idNoticia) {
        $exito = false;
        $respuesta = "";
        try {
            $consultaNoticia = $this->controladorAdministrador->mostrarInfoNoticiaControlador($idNoticia);
            $respuesta = $consultaNoticia['titulo'].'ª'.$consultaNoticia['descripcion'].'ª'.$consultaNoticia['fecha'];
            $exito = true;
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("respuesta" => $respuesta));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo mostrar la informacion"));
        }
    }
    
    //MODIFICAR NOTICIA
    public function modificarNoticiaAjax($idNoticia,$titulo,$descripcion) {
        $exito = false;
        try {
            $noticiaDTO = new NoticiaDTO($idNoticia, $titulo, $descripcion, NULL, NULL, NULL);
            $consulta = $this->controladorAdministrador->modificarNoticiaControlador($noticiaDTO);
            if ($consulta) {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo modificar"));
        }
    }
    
    //ELIMINAR NOTICIA
    public function eliminarNoticiaAjax($idNoticia) {
        $exito = false;
        try {
            $consulta = $this->controladorAdministrador->eliminarNoticiaControlador($idNoticia);
            if ($consulta) {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo eliminar"));
        }
    }
    
    
    
    
    //REGISTRO DE UN USUARIO FUNCIONARIO
    public function RegistroFuncionarioAjax($documento, $nombre, $telefono, $correo, $clave) {
        $exito = false;
        try {
            $encriptar = $this->encriptar($clave);
            $consulta = $this->controlador->buscarPersonaControlador($documento);
            if (!$consulta) {
                //registra en tabla persona
                $personaDTO = new PersonaDTO($documento, $nombre, $telefono, $correo);
                $registroPersona = $this->controlador->registroPersonaControlador($personaDTO);
                //registra en tabla cliente
                $registroFuncionario = $this->controladorAdministrador->registroFuncionarioControlador($documento, $encriptar);
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo registrar el funcionario"));
        }
    }
        
    //LISTAR FUNCIONARIOS 
    public function listarFuncionariosAjax() {
        $consulta = $this->controladorAdministrador->listarFuncionariosControlador();
        $funcionarios="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $funcionarios .= '<tr>
                                    <th scope="row">'.$consulta[$index]->getDocumento().'</th>
                                    <td>'.$consulta[$index]->getNombre().'</td>
                                    <td style="display:block;margin:auto;"><button href="#VerInfoFuncionario" data-toggle="modal" type="button" id="'.$consulta[$index]->getDocumento().'" title="Ver" class="btn btn-outline-success verFuncionario"><ion-icon name="eye"></ion-icon></button></td>
                                </tr>';
            }
        }
        echo $funcionarios;
    }
    
    //LISTAR FUNCIONARIOS PARA EL REGISTRO UNA DEPENDENCIA
    public function listarFuncionariosRegistroAjax() {
        $consulta = $this->controladorAdministrador->listarFuncionariosRegistroControlador();
        $funcionarios="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $funcionarios .= '<option value="">Seleccione Funcionario</option>
                                  <option value="'.$consulta[$index]->getDocumento().'">'.$consulta[$index]->getNombre().'</option>';
            }
        }else{
            $funcionarios = '<option value="">Seleccione Funcionario</option>';
        }
        echo $funcionarios;
    }
    
    //MOSTRAR LA INFORAMCION DEL FUNCIONARIO
    public function mostrarInfoFuncionarioAjax($idFuncionario) {
        $exito = false;
        $respuesta = "";
        try {
            $consultaFuncionario = $this->controladorAdministrador->mostrarInfoFuncionarioControlador($idFuncionario);
            $respuesta = $consultaFuncionario['documento'].'ª'.$consultaFuncionario['nombre'].'ª'.$consultaFuncionario['telefono'].'ª'.$consultaFuncionario['correo'].'ª'.$consultaFuncionario['dependencia'];
            $exito = true;
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("respuesta" => $respuesta));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo mostrar la informacion"));
        }
    }
    
    //MODIFICAR FUNCIONARIO
    public function modificarFuncionarioAjax($documento,$nombre,$telefono, $correo) {
        $exito = false;
        try {
            $personaDTO = new PersonaDTO($documento,$nombre,$telefono, $correo);
            $consulta = $this->controlador->modificarPersonaControlador($personaDTO);
            if ($consulta) {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo modificar"));
        }
    }
    
    
    
    
    //REGISTRO DE UNA DEPENDENCIAS
    public function RegistroDependenciaAjax($nombre, $ubicacion, $telefono, $funcionario) {
        $exito = false;
        try {
            $depDTO = new DependenciaDTO(NULL, $nombre, $ubicacion, $telefono, $funcionario);
            $registroDep = $this->controladorAdministrador->registroDependenciaControlador($depDTO);
            $exito = $registroDep;
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo registrar dependencia"));
        }
    }
        
    //LISTAR DEPENDENCIAS 
    public function listarDependenciasAjax() {
        $consulta = $this->controladorAdministrador->listarDependenciasControlador();
        $dep="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $dep .= '<tr>
                                    <th scope="row">'.$consulta[$index]->getId().'</th>
                                    <td>'.$consulta[$index]->getNombre().'</td>
                                    <td style="display:block;margin:auto;"><button href="#VerInfoDependencia" data-toggle="modal" type="button" id="'.$consulta[$index]->getId().'" title="Ver" class="btn btn-outline-success verDependencia"><ion-icon name="eye"></ion-icon></button></td>
                                </tr>';
            }
        }
        echo $dep;
    }
    
    //MOSTRAR LA INFORAMCION DE LA DEPENDENCIA
    public function mostrarInfoDependenciaAjax($idDep) {
        $respuesta = "";
        try {
            $consulta = $this->controladorAdministrador->mostrarInfoDependenciaControlador($idDep);
            $respuesta = $consulta['nombre'].'ª'.$consulta['ubicacion'].'ª'.$consulta['telefono'].'ª'.$consulta['funcionario'];
            $exito = true;
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("respuesta" => $respuesta));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo mostrar la informacion"));
        }
    }
    
    //MODIFICAR DEPENDENCIA
    public function modificarDependenciaAjax($idDep,$nombre,$ubicacion, $telefono) {
        $exito = false;
        try {
            $depDTO = new DependenciaDTO($idDep, $nombre, $ubicacion, $telefono, NULL);
            $consulta = $this->controladorAdministrador->modificarDependenciaControlador($depDTO);
            if ($consulta) {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo modificar"));
        }
    }
    
    
    
    
    
    //REGISTRO DE HORARIO DE ATENCION DE UN FUNCIONARIO
    public function RegistroHorarioAjax($id, $fecha, $inicio, $fin) {
        try {
            $horarioDTO = new HorarioDTO(NULL, $fecha, $inicio, $fin, $id);
            $registro = $this->controladorFuncionario->registroHorarioControlador($horarioDTO);
            $exito = $registro;
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo registrar horario"));
        }
    }
        
    //LISTAR HORARIOS 
    public function listarHorarioAjax($id) {
        $consulta = $this->controladorFuncionario->listarHorarioControlador($id);
        $horario = "";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $horario .= '<tr>
                            <th scope="row">'.$consulta[$index]->getId().'</th>
                            <td>'.$consulta[$index]->getFecha().'</td>
                            <td>'.$consulta[$index]->getInicio().'</td>
                            <td>'.$consulta[$index]->getFin().'</td>
                            <td style="display:block;margin:auto;"><button href="#VerCitasPorHorario" data-toggle="modal" type="button" id="'.$consulta[$index]->getId().'" title="Ver Citas" class="btn btn-outline-success verHorario"><ion-icon name="eye"></ion-icon></button></td>
                        </tr>';
            }
        }
        echo $horario;
    }
        
    
    
    //LISTAR DEPENDENCIAS VISTA SOLICITUD
    public function listarDependenciasSolicitudAjax() {
        $consulta = $this->controladorAdministrador->listarDependenciasSolicitudControlador();
        $dep="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $dep .= '<tr>
                                    <td>'.$consulta[$index]->getNombre().'</td>
                                    <td>'.$consulta[$index]->getUbicacion().'</td>
                                    <td>'.$consulta[$index]->getTelefono().'</td>
                                    <td>'.$consulta[$index]->getFuncionario().'</td>
                                    <td style="display:block;margin:auto;"><button href="#VerDepSolicitud" data-toggle="modal" type="button" id="'.$consulta[$index]->getId().'" title="Ver" class="btn btn-outline-success verDepSolicitud"><ion-icon name="eye"></ion-icon></button></td>
                                </tr>';
            }
        }
        echo $dep;
    }   
    
    //LISTAR HORARIOS DE UNA DEPENDENCIA
    public function mostrarHorariosDepAjax($fecha, $dep) {
        $consulta = $this->controladorUsuario->listarHorarioSolicitudControlador($fecha, $dep);
        $horarios = "";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $horarios .= '<div class="row">
                                 <button '.$this->validarCantidadCitas($consulta[$index]->getFecha(),$consulta[$index]->getInicio()).' type="button" id="'.$consulta[$index]->getId().'-'.$consulta[$index]->getFuncionario().'">'.$consulta[$index]->getInicio().'-'.$consulta[$index]->getFin().'</button>
                              </div>';
            }
        }else{
            $horarios = "false";
        }
        echo $horarios;
    }
    
    //VALIDAR CANTIDAD DE CITAS PARA UN HORARIO
    private function validarCantidadCitas($fecha, $inicio){
        $consulta = $this->controladorUsuario->validarCantidadCitasControlador($fecha, $inicio);
        if($consulta['cantidad'] == 5){
            return "disabled style='background-color:red;display:block;margin:auto;' title='No hay turnos disponibles' class='btn btn-success mb-3'";
        }else{
            return "style='display:block;margin:auto;' title='Solicitar Turno' class='btn btn-success mb-3 solicitarTurno'";
        }
        
    }
    
    //SOLICITAR TURNO
    public function solicitarTurnoAjax($idHorario, $fun, $usuario) {
        $consulta = $this->controladorUsuario->consultarTurnoControlador($idHorario, $usuario, $fun);
        if($consulta){
            $respuesta="error1";            
        }else{
             $turno = $this->controladorUsuario->consultarTurnoActualControlador($idHorario, $fun);
             if($turno==""){
                 $turno = 1;
             }else{
                 $suma = intval($turno)+1;
                 $turno = $suma;
             }
             $citaDTO = new CitaDTO(null, ($turno), "PENDIENTE", $idHorario, $usuario, $fun);
             $ingreso = $this->controladorUsuario->ingresarCitaControlador($citaDTO);
             if($ingreso){
                 $respuesta = $turno;
             }
        }
        
        echo $respuesta;
    }   
        
    //LISTAR CITAS DE UN USUARIO 
    public function listarCitasUsuarioAjax($idUsuario) {
        $consulta = $this->controladorUsuario->listarCitasUsuarioControlador($idUsuario);
        $lista="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $lista .= '<tr>
                                <th scope="row">'.$consulta[$index]->getTurno().'</th>
                                <td>'.$consulta[$index]->getHorario().'</td>
                                <td>'.$consulta[$index]->getFuncionario().'</td>
                                <td>'.$this->validarEstadoCita(1,$consulta[$index]->getEstado()).'</td>
                                <td style="display:block;margin:auto;"><button type="button" id="'.$consulta[$index]->getId().'" title="Cancelar Cita" class="btn btn-outline-danger cancelarCita"><ion-icon name="trash"></ion-icon></button></td>
                            </tr>';
            }
        }else{
            $lista = "false";
        }
        echo $lista;
    }
    
    //VALIDAR ESTADO DE LA CITA
    private function validarEstadoCita($metodo, $estado){
        if($metodo==1){
            if(strcmp($estado, "PENDIENTE") === 0){
                return "<a class='badge badge-pill badge-secondary'>Pendiente</a>";
            }else{
                return "<a class='badge badge-pill badge-success'>Atendida</a>";
            }
        }else{
            if(strcmp($estado, "ATENDIDA") === 0){
                return "disabled";
            }else{
                return "";
            }
        }
    }
            
    //CANCELAR CITA
    public function cancelarCitaAjax($idCita) {
        $exito = false;
        try {
            $consulta = $this->controladorUsuario->cancelarCitaControlador($idCita);
            if ($consulta) {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo cancelar"));
        }
    }
            
    //LISTAR CITAS POR ATENDER
    public function listarCitasPorAtenderAjax($fecha, $fun) {
        $consulta = $this->controladorUsuario->listarCitasPorAtenderControlador($fecha, $fun);
        $lista="";
        if(count($consulta)> 0){
            for ($index = 0; $index < count($consulta); $index++) {
                $lista .= '<tr>
                                <th scope="row">'.$consulta[$index]->getTurno().'</th>
                                <td>'.$consulta[$index]->getHorario().'</td>
                                <td>'.$consulta[$index]->getUsuario().'</td>
                                <td>'.$this->validarEstadoCita(1,$consulta[$index]->getEstado()).'</td>
                                <td style="display:block;margin:auto;"><button type="button" id="'.$consulta[$index]->getId().'" title="Cambiar el Estado de la Cita" class="btn btn-success cambiarEstadoCita" '.$this->validarEstadoCita(2,$consulta[$index]->getEstado()).'><ion-icon name="checkmark-circle"></ion-icon></button></td>
                            </tr>';
            }
        }else{
            $lista = "false";
        }
        echo $lista;
    }
    
    
    //MODIFICAR ESTADO DE LA CITA
    public function cambiarEstadoCitaAjax($cita) {
        $exito = false;
        try {
            $consulta = $this->controladorFuncionario->cambiarEstadoCitaControlador($cita);
            if ($consulta) {
                $exito = true;
            }
        } catch (Exception $exc) {
            echo json_encode(array("exito" => false, "error" => $exc->getMessage()));
        }
        if ($exito) {
            echo json_encode(array("exito" => true));
        } else {
            echo json_encode(array("exito" => false, "error" => "No se pudo cambiar"));
        }
    }
}

//   SE CREA UNA INSTANCIA DE LA CALSE AJAX PARA PODER ACCEDER A LOS METODOS QUE CONTIENE
$ajax = new Ajax();

//   SI ESTA VARIABLE ES DIFERENTE DE NULL SE DEBE INGRESAR EL USUARIO
$loguear = isset($_POST["ingresarUsuario"], $_POST["ingresarContraseña"], $_POST["ingresarTipo"]);
$registroUsuario = isset($_POST["registroDocumento"], $_POST["registroNombre"], $_POST["registroTelefono"], $_POST["registroCorreo"], $_POST["registroClave"]);
$registroFuncionario = isset($_POST["registroDocumentoFuncionario"], $_POST["registroNombreFuncionario"], $_POST["registroTelefonoFuncionario"], $_POST["registroCorreoFuncionario"], $_POST["registroClaveFuncionario"]);
$registroNoticia = isset($_POST["registroTitulo"], $_POST["registroDesc"], $_POST["tipoRegistro"]);
$registroDependencia = isset($_POST["registroNombreDep"], $_POST["registroUbicacionDep"], $_POST["registroTelefonoDep"], $_POST["ingresarFuncionarioDep"]);
$registroHorario = isset($_POST["idFuncionario"], $_POST["dateHorario"], $_POST["comboHoraInicio"], $_POST["comboHoraFin"]);
$mostrarTotales = isset($_GET["mostrarTotales"]);
$listarNoticias = isset($_GET["listarNoticias"]);
$listarFuncionarios = isset($_GET["listarFuncionarios"]);
$listarNoticiasAdmin = isset($_GET["listarNoticiasAdmin"]);
$listarNoticiasFun = isset($_POST["idNoticiaFunListar"]);
$listarHorario = isset($_POST["idFuncionarioHorario"]);
$listarFuncionariosRegistro = isset($_GET["listarFuncionariosRegistro"]);
$listarDependencias = isset($_GET["listarDependencias"]);
$listarDependenciasSolicitud = isset($_GET["listarDependenciasSolicitud"]);
$mostrarInfoNoticia = isset($_POST["idNoticia"]);
$mostrarInfoFuncionario = isset($_POST["idFuncionario"]);
$mostrarInfoDependencia = isset($_POST["idDependencia"]);
$mostrarPerfil = isset($_POST["personaPerfil"]);
$mostrarHorariosDep = isset($_POST["dateSolicitud"],$_POST["idDepSolicitud"]);
$eliminarNoticia = isset($_POST["idNoticiaEliminar"]);  
$modificarNoticia = isset($_POST["idNoticiaModificar"],$_POST["tituloNoticiaModificar"],$_POST["descNoticiaModificar"]);    
$modificarFuncionario = isset($_POST["idFuncionarioModificar"],$_POST["nombreFuncionarioModificar"],$_POST["telefonoFuncionarioModificar"],$_POST["correoFuncionarioModificar"]);    
$modificarDependencia = isset($_POST["idDepModificar"],$_POST["nombreDepModificar"],$_POST["ubicacionDepModificar"],$_POST["telefonoDepModificar"]);    
$solicitarTurno = isset($_POST["idSolicitudTurno"],$_POST["funcionarioSolicitudTurno"],$_POST["usuarioSolicitudTurno"]);    
$listarCitasUsuario = isset($_POST["idListarCitas"]);    
$cancelarCita = isset($_POST["idCancelarCita"]);      
$listarCitasPorAtender = isset($_POST["dateListadoCitas"],$_POST["idFuncionarioCitas"]);    
$cambiarEstadoCita = isset($_POST["idCambiarEstadoTurno"]);    


if ($loguear) {
    $ajax->LoguearUsuarioAjax($_POST["ingresarUsuario"], $_POST["ingresarContraseña"], $_POST["ingresarTipo"]);
} else if ($registroUsuario) {
    $ajax->RegistroUsuarioAjax($_POST["registroDocumento"], $_POST["registroNombre"], $_POST["registroTelefono"], $_POST["registroCorreo"], $_POST["registroClave"]);
} else if ($registroFuncionario) {
    $ajax->RegistroFuncionarioAjax($_POST["registroDocumentoFuncionario"], $_POST["registroNombreFuncionario"], $_POST["registroTelefonoFuncionario"], $_POST["registroCorreoFuncionario"], $_POST["registroClaveFuncionario"]);
} else if ($registroNoticia) {
    $ajax->RegistroNoticiaAjax($_POST["registroTitulo"], $_POST["registroDesc"], $_POST["tipoRegistro"]);
} else if ($registroDependencia) {
    $ajax->RegistroDependenciaAjax($_POST["registroNombreDep"], $_POST["registroUbicacionDep"], $_POST["registroTelefonoDep"], $_POST["ingresarFuncionarioDep"]);
} else if ($registroHorario) {
    $ajax->RegistroHorarioAjax($_POST["idFuncionario"], $_POST["dateHorario"], $_POST["comboHoraInicio"], $_POST["comboHoraFin"]);
} else if ($listarNoticias && $_GET["listarNoticias"]) {
    $ajax->listarNoticiasAjax();
} else if ($listarFuncionarios && $_GET["listarFuncionarios"]) {
    $ajax->listarFuncionariosAjax();
} else if ($listarNoticiasAdmin && $_GET["listarNoticiasAdmin"]) {
    $ajax->listarNoticiasAdminAjax();
} else if ($mostrarTotales && $_GET["mostrarTotales"]) {
    $ajax->mostrarTotalesAjax();
} else if ($listarNoticiasFun) {
    $ajax->listarNoticiasFunAjax($_POST['idNoticiaFunListar']);
} else if ($listarFuncionariosRegistro && $_GET["listarFuncionariosRegistro"]) {
    $ajax->listarFuncionariosRegistroAjax();
}  else if ($listarDependencias && $_GET["listarDependencias"]) {
    $ajax->listarDependenciasAjax();
}  else if ($listarDependenciasSolicitud && $_GET["listarDependenciasSolicitud"]) {
    $ajax->listarDependenciasSolicitudAjax();
} else if ($listarHorario) {
    $ajax->listarHorarioAjax($_POST['idFuncionarioHorario']);
} else if ($mostrarInfoNoticia) {
    $ajax->mostrarInfoNoticiaAjax($_POST["idNoticia"]);
} else if ($mostrarInfoDependencia) {
    $ajax->mostrarInfoDependenciaAjax($_POST["idDependencia"]);
} else if ($mostrarInfoFuncionario) {
    $ajax->mostrarInfoFuncionarioAjax($_POST["idFuncionario"]);
} else if ($mostrarPerfil) {
    $ajax->mostrarPerfilAjax($_POST["personaPerfil"]);
} else if ($mostrarHorariosDep) {
    $ajax->mostrarHorariosDepAjax($_POST["dateSolicitud"],$_POST["idDepSolicitud"]);
} else if ($eliminarNoticia) {
    $ajax->eliminarNoticiaAjax($_POST["idNoticiaEliminar"]);
} else if ($modificarNoticia) {
    $ajax->modificarNoticiaAjax($_POST["idNoticiaModificar"],$_POST["tituloNoticiaModificar"],$_POST["descNoticiaModificar"]);
} else if ($modificarFuncionario) {
    $ajax->modificarFuncionarioAjax($_POST["idFuncionarioModificar"],$_POST["nombreFuncionarioModificar"],$_POST["telefonoFuncionarioModificar"],$_POST["correoFuncionarioModificar"]);
} else if ($modificarDependencia) {
    $ajax->modificarDependenciaAjax($_POST["idDepModificar"],$_POST["nombreDepModificar"],$_POST["ubicacionDepModificar"],$_POST["telefonoDepModificar"]);
} else if ($solicitarTurno) {
    $ajax->solicitarTurnoAjax($_POST["idSolicitudTurno"],$_POST["funcionarioSolicitudTurno"],$_POST["usuarioSolicitudTurno"]);
} else if ($listarCitasUsuario) {
    $ajax->listarCitasUsuarioAjax($_POST["idListarCitas"]);
} else if ($cancelarCita) {
    $ajax->cancelarCitaAjax($_POST["idCancelarCita"]);
} else if ($listarCitasPorAtender) {
    $ajax->listarCitasPorAtenderAjax($_POST["dateListadoCitas"],$_POST["idFuncionarioCitas"]);
} else if ($cambiarEstadoCita) {
    $ajax->cambiarEstadoCitaAjax($_POST["idCambiarEstadoTurno"]);
}