<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);
    if ($user != "Funcionario") {
        header("Location:errorpage");
    }
} else {
    header("Location:errorpage");
}
?>

<div id="vista_Fun_Horarios">
    <h1>Horario de Atención</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-5 panel">
            <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert" style="width:90%;display:block;margin:auto;">
                <strong>AVISO IMPORTATANTE!</strong> Podrá registrar los horarios que desee cumpliento las siguientes reglas: <br>
                - Dias hábiles de Lunes a Viernes. <br>
                - Horarios entre las 8 am y 6 pm.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div style="background:white;border-radius:15px 15px 15px 15px;">
                <form class="login" id="FormNoticiaFun" method="POST">
                    <div class="row">
                        <div class="col-md-12"> 
                            <div class="form-group row">
                                <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Fecha </label>
                                <div class="col-sm-10">
                                    <div class="form-group input-group">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text" id="basic-addon1"><ion-icon name="time"></ion-icon></span>
                                        </div>
                                        <input id="dateHorario" name="dateHorario" type="date" style="width: 80%;" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6"> 
                            <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Hora de Inicio</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><ion-icon name="time"></ion-icon></span>
                                </div>
                                <select style="width: 80%;" id="comboHoraInicio" name="comboHoraInicio" required>
                                    <option>Seleccione</option>
                                    <option value="8:00">8:00 am</option>
                                    <option value="9:00">9:00 am</option>
                                    <option value="10:00">10:00 am</option>
                                    <option value="11:00">11:00 am</option>
                                    <option value="12:00">12:00 pm</option>
                                    <option value="13:00">1:00 pm</option>
                                    <option value="14:00">2:00 pm</option>
                                    <option value="15:00">3:00 pm</option>
                                    <option value="16:00">4:00 pm</option>
                                    <option value="17:00">5:00 pm</option>
                                    <option value="18:00">6:00 pm</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6"> 
                            <label for="colFormLabelSm" class="col-sm-12 col-form-label col-form-label-sm">Hora de Fin</label>
                            <div class="form-group input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="basic-addon1"><ion-icon name="time"></ion-icon></span>
                                </div>
                                <select style="width: 80%;" id="comboHoraFin" name="comboHoraFin" required>
                                    <option>Seleccione</option>
                                    <option value="8:00">8:00 am</option>
                                    <option value="9:00">9:00 am</option>
                                    <option value="10:00">10:00 am</option>
                                    <option value="11:00">11:00 am</option>
                                    <option value="12:00">12:00 pm</option>
                                    <option value="13:00">1:00 pm</option>
                                    <option value="14:00">2:00 pm</option>
                                    <option value="15:00">3:00 pm</option>
                                    <option value="16:00">4:00 pm</option>
                                    <option value="17:00">5:00 pm</option>
                                    <option value="18:00">6:00 pm</option>
                                </select>
                            </div>
                        </div>                      
                        <label id="MensajeErrorHorario" style="color:red;"></label>

                        <div class="input-group mb-3">
                            <button id="botonRegistroHorario" type="submit" class="btn boton_principal mt-3"><ion-icon name="done-all"></ion-icon> Registrar Horario</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 panel">
            <h4>Mi Horario de Atención</h4>
            <hr>
            <table class="tabla table">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 20%;">Fecha</th>
                        <th scope="col" style="width: 20%;">Hora Inicio</th>
                        <th scope="col" style="width: 20%;">Hora Fin</th>
                        <th scope="col" style="width: 20%;">Estado</th>
                    </tr>
                </thead>
                <tbody id="tablaHorario">

                </tbody>
            </table>
        </div>
    </div>
</div>


<!--MODAL CITAS EN ESE HORARIO-->
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true" id="VerCitasPorHorario">
    <div class="modal-dialog modal-lg">
        <div class="modal-content" style="padding: 5%;">
            <form id="FormCitasAtender" method="POST" autocomplete="off">
                <h4 style="text-align: center;">Listado de Citas por Atender</h4>
                <hr>
                <label id="MensajeErrorCitasFun"></label>
                <div id="citasOcultos" style="display: none;">
                        
                </div>
                <br>
                <div class="row">
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>