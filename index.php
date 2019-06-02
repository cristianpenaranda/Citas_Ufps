<?php

//incluir archivos externos
require_once './controller/controlador.php';
require_once './controller/controladorAdministrador.php';
require_once './controller/controladorFuncionario.php';
require_once './controller/controladorUsuario.php';

require_once './model/negocio.php';
require_once './model/conexion.php';
require_once './model/mail/Mail.php';

require_once './model/dao/PersonaDAO.php';
require_once './model/dao/AdministradorDAO.php';
require_once './model/dao/FuncionarioDAO.php';
require_once './model/dao/UsuarioDAO.php';
require_once './model/dao/NoticiaDAO.php';
require_once './model/dao/HorarioDAO.php';
require_once './model/dao/CitaDAO.php';

//activar almacenamiento en el bufer de la página
ob_start();
$controlador = new controlador();
$controlador->generarPlantilla();