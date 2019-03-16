<span class="flechaSubir btn"><ion-icon name="arrow-dropup-circle"></ion-icon></span>
<div id="header">
    <nav class="navbar navbar-expand-lg">
        <img src="https://drive.google.com/uc?export=view&id=1hveoYFwoY2ySyhetUN2dvVHJ8yzQnPY9">
        <a class="navbar-brand" href="inicio">Citas UFPS</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <ion-icon name="menu" id="menu"></ion-icon>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <div class="navbar-nav">
                <?php
                if (isset($_SESSION["Tipo"])) {
                    //include 'model/dto/PersonaDTO.php';
                    $tipo = unserialize($_SESSION['Tipo']);
                    if ($tipo == "Administrador") {
                        echo '<ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="inicio" id="Inicio" title="Inicio"><ion-icon name="home"></ion-icon> Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="administrador_dependencias" id="Administrador_Dependencias" title="Dependencias"><ion-icon name="business"></ion-icon> Dependencias</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="administrador_funcionarios" id="Administrador_Funcionarios" title="Funcionarios"><ion-icon name="people"></ion-icon> Funcionarios</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="administrador_noticias" id="Administrador_Noticias" title="Noticias"><ion-icon name="chatboxes"></ion-icon> Noticias</a>
                    </li>
                  </ul>';
                    } else if ($tipo == "Funcionario") {
                        echo '<ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="inicio" id="Inicio" title="Inicio"><ion-icon name="home"></ion-icon> Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="funcionario_horarios" id="Funcionario_Horarios" title="Horarios de Atención"><ion-icon name="calendar"></ion-icon> Horarios de Atención</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="funcionario_noticias" id="Funcionario_Noticias" title="Noticias"><ion-icon name="chatboxes"></ion-icon> Noticias</a>
                    </li>
                  </ul>';
                    } else {
                        echo '<ul class="navbar-nav">
                    <li class="nav-item">
                      <a class="nav-link" href="inicio" id="Inicio" title="Inicio"><ion-icon name="home"></ion-icon> Inicio</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="usuario_solicitud" id="Usuario_Solicitud" title="Solicitar Cita"><ion-icon name="checkbox-outline"></ion-icon> Solicitar Cita</a>
                    </li>
                    <li class="nav-item">
                      <a class="nav-link" href="#miscitas" id="mis_citas" title="Mis Citas" data-toggle="modal"><ion-icon name="list"></ion-icon> Mis Citas</a>
                    </li>
                  </ul>';
                    }
                }
                ?>
            </div>
            <ul class="navbar-nav ml-auto mr-5">
                <li class="nav-item ml-5">
                    <div class="dropdown">
                        <button class="btn btn-dark dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <?php
                            if (isset($_SESSION["Tipo"])) {
                                if ($tipo == "Administrador") {
                                    echo '<ion-icon name="construct"></ion-icon> ' . $tipo;
                                } else if ($tipo == "Funcionario") {
                                    echo '<ion-icon name="contact"></ion-icon> ' . $tipo;
                                } else {
                                    echo '<ion-icon name="person"></ion-icon> ' . $tipo;
                                }
                            }
                            ?>
                        </button>
                        <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                            <!--<a class="nav-link opciones" href="" title="Buzón de Mensajes"><ion-icon name="mail"></ion-icon> Buzón de Mensajes</a>-->
                            <?php
                            if (isset($_SESSION["Tipo"])) {
                                if ($tipo == "Usuario" || $tipo == "Funcionario") {
                                    echo '<a class="nav-link opciones" data-toggle="modal" href="#formPerfil" title="Perfil" id="botonMostrarPerfil"><ion-icon name="person"></ion-icon> Perfil</a>';
                                }
                            }
                            ?>
                            <a class="nav-link opciones" href="salir" title="Cerrar Sesión"><ion-icon name="log-out"></ion-icon> Salir</a>

                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</div>
<?php
    if(isset($_SESSION["Usuario"])){
        include_once 'view/modulos/pestanas/perfil.php';
        include_once 'view/modulos/pestanas/pestanasUser/mis_citas.php';
        include 'model/dto/PersonaDTO.php';
        $persona = unserialize($_SESSION["Usuario"]);
        echo '<input value="'.$persona->getDocumento().'" style="display:none;" id="oculto">';
    }

