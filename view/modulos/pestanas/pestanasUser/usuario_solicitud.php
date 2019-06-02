<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);
    if ($user == "Administrador") {
        header("Location:errorpage");
    }
} else {
    header("Location:errorpage");
}
?>

<div id="vista_usuario_solicitud">
    <h1>Solicitud de Cita</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-11 panel">
            <div class="alert alert-primary alert-dismissible fade show mt-3 mb-0" role="alert" style="width:90%;display:block;margin:auto;">
                <strong>AVISO IMPORTATANTE!</strong> A continuación podrá solicitar una cita en alguna dependencia de la Universidad Francisco de Paula Santander dependiendo del horario disponible.<br>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:white;border-radius:15px 15px 15px 15px;"><br><br>
                <div class="col-md-8" style="display: block;margin: auto;">
                    <div class="form-group input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text" id="basic-addon1"><ion-icon name="search"></ion-icon></span>
                        </div>
                       <input id="buscar" type="text" class="form-control" placeholder="Escriba algo para filtrar"/>
                    </div>
                </div>
                <br>        
                <!-- TABLA INICIA -->
                <table id="tablaSolicitud" class="col-md-10 tabla table table-responsive-md" style="width: 100%;">
                    <thead>
                        <tr>
                            <th style="width:20%;">Nombre</th>
                            <th style="width:30%;">Ubicación</th>
                            <th style="width:20%;">Teléfono</th>
                            <th style="width:30%;">Funcionario</th>
                            <th style="width:10%;">Solicitud</th>
                        </tr>
                    </thead>
                    <tbody id="bodyTablaSolicitud">
                        
                    </tbody>
                </table>
                <!-- TABLA FINALIZA -->

            </div>
        </div>
    </div>


    <!--MODAL HORARIOS PARA SOLICITUD-->
    <div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="VerDepSolicitud">
        <div class="modal-dialog">
            <div class="modal-content" style="padding: 5%;">
                <form id="FormSolicitudModal" method="POST">
                    <h4 style="text-align: center;">Horarios Disponibles</h4>
                    <hr>
                    <label id="MensajeErrorHorario"></label>
                    <div id="horariosOcultos" style="display: none;">
                        
                    </div>
                    <br>
                    <div class="row">
                        <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>