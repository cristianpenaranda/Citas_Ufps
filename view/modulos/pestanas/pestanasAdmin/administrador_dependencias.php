<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);
    if ($user != "Administrador") {
        header("Location:errorpage");
    }
} else {
    header("Location:errorpage");
}
?>

<div id="vista_Admin_Dependencias">
    <h1>Administración de Dependencias</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-5 panel">
            <h4>Nueva Dependencia</h4>
            <hr>
            <div style="background:white;border-radius:15px 15px 15px 15px;">
                <form class="login" id="FormDependencia" method="POST" autocomplete="off">
                    <div class="col-auto">

                        <div class="form-group input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="business"></ion-icon></span>
                            </div>
                            <input type="text" name="registroNombreDep" class="form-control" placeholder="Nombre" id="registroNombreDep" onblur="aMayusculas(this.value, this.id)" maxlength="45" required/>
                        </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="locate"></ion-icon></span>
                            </div>
                            <input type="text" name="registroUbicacionDep" class="form-control" placeholder="Ubicación" maxlength="100" id="registroUbicacionDep" onblur="aMayusculas(this.value, this.id)" required>
                        </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="call"></ion-icon></span>
                            </div>
                            <input type="text" name="registroTelefonoDep" class="form-control" onkeypress='return validaNumericos(event)' placeholder="Teléfono" maxlength="15" id="registroTelefonoDep" required>
                        </div>

                        <div class="input-group mb-3">
                            <button id="botonRegistroDependencia" type="submit" class="btn boton_principal mt-3"><ion-icon name="done-all"></ion-icon> Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 panel" id="mensajeDep">
            <h4>Listado de Dependencias</h4>
            <hr> 
            <table class="tabla table table-responsive-md" id="tablaTotalDependencias">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 60%;">Nombre</th>
                        <th scope="col" style="width: 10%;">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaDependencias">

                </tbody>
            </table>
        </div>
    </div>
</div>


<!--MODAL INFORMACION DE LA DEPENDENCIA-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="VerInfoDependencia">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <form id="FormInfoCliente" method="POST" autocomplete="off">
                <h4 style="text-align: center;">Información</h4>
                <hr>
                <div class="form-group input-group mt-3">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><ion-icon name="business"></ion-icon></span>
                    </div>
                    <input type="text" name="ModalNombreDep" class="form-control" placeholder="Nombre" id="ModalNombreDep" onblur="aMayusculas(this.value, this.id)" maxlength="45" required/>
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><ion-icon name="locate"></ion-icon></span>
                    </div>
                    <input type="text" name="ModalUbicacionDep" class="form-control" placeholder="Ubicación" maxlength="100" id="ModalUbicacionDep" onblur="aMayusculas(this.value, this.id)" required>
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><ion-icon name="call"></ion-icon></span>
                    </div>
                    <input type="text" name="ModalTelefonoDep" class="form-control" onkeypress='return validaNumericos(event)' placeholder="Teléfono" maxlength="15" id="ModalTelefonoDep" required>
                </div>
                
                <div class="row">
                    <button type="button" class="btn btn-primary modificarDependencia" title="Actualizar" style="display:block;margin:auto;"><span><ion-icon name="save"></ion-icon></span> Actualizar</button>
                    <!--<button type="button" title="Eliminar" class="btn btn-danger eliminarDependencia" disabled><ion-icon name="trash"></ion-icon> Eliminar</button>-->
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>