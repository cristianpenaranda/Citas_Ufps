<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);    
    if($user != "Administrador"){
        header("Location:ErrorPage");
    }
} else {
    header("Location:ErrorPage");
}
?>

<div id="vista_Admin_Funcionarios">
    <h1>Administración de Funcionarios</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-5 panel"">
            <h4>Nuevo Funcionario</h4>
            <hr>
            <div style="background:white;border-radius:15px 15px 15px 15px;">
                <form class="login" id="FormFuncionario" method="POST">
                    <div class="col-auto">
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="card"></ion-icon></span>
                            </div>
                            <input type="text" name="registroDocumentoFuncionario" class="form-control" placeholder="Documento de identidad" id="registroDocumentoFuncionario" required onkeypress='return validaNumericos(event)' maxlength="12">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="person"></ion-icon></span>
                            </div>
                            <input type="text" name="registroNombreFuncionario" class="form-control" placeholder="Nombre" id="registroNombreFuncionario" required onblur="aMayusculas(this.value, this.id)" maxlength="50">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="call"></ion-icon></span>
                            </div>
                            <input type="text" name="registroTelefonoFuncionario" class="form-control" placeholder="Teléfono" id="registroTelefonoFuncionario" required onkeypress='return validaNumericos(event)' maxlength="15">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="mail"></ion-icon></span>
                            </div>
                            <input type="email" name="registroCorreoFuncionario" class="form-control" placeholder="Correo Electrónico" id="registroCorreoFuncionario" required maxlength="100">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="lock"></ion-icon></span>
                            </div>
                            <input type="password" name="registroClaveFuncionario" class="form-control" placeholder="Contraseña" id="registroClaveFuncionario" required maxlength="10">
                        </div>
                        <div class="input-group mb-3">
                            <button id="botonRegistroFuncionario" type="submit" class="btn boton_principal mt-3"><ion-icon name="person-add"></ion-icon> Registrar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 panel">
            <h4>Listado de Funcionarios</h4>
            <hr>
            <table class="tabla table table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="width: 10%;">Documento</th>
                        <th scope="col" style="width: 60%;">Nombre</th>
                        <th scope="col" style="width: 10%;">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaFuncionarios">

                </tbody>
            </table>
        </div>
    </div>
</div>


<!--MODAL INFORMACION DE LA NOTICIA-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="VerInfoFuncionario">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <form id="FormInfoCliente" method="POST">
                <h4 style="text-align: center;">Información</h4>
                <hr>
                <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="card"></ion-icon></span>
                            </div>
                    <input type="text" name="ModalDocumentoFuncionario" class="form-control" placeholder="Documento de identidad" id="ModalDocumentoFuncionario" required onkeypress='return validaNumericos(event)' maxlength="12" disabled>
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="person"></ion-icon></span>
                            </div>
                            <input type="text" name="ModalNombreFuncionario" class="form-control" placeholder="Nombre" id="ModalNombreFuncionario" required onblur="aMayusculas(this.value, this.id)" maxlength="50">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="call"></ion-icon></span>
                            </div>
                            <input type="text" name="ModalTelefonoFuncionario" class="form-control" placeholder="Teléfono" id="ModalTelefonoFuncionario" required onkeypress='return validaNumericos(event)' maxlength="15">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="mail"></ion-icon></span>
                            </div>
                            <input type="email" name="ModalCorreoFuncionario" class="form-control" placeholder="Correo Electrónico" id="ModalCorreoFuncionario" required maxlength="100">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="business"></ion-icon></span>
                            </div>
                            <input type="text" name="ModalDepFuncionario" class="form-control" placeholder="Dependencia" id="ModalDepFuncionario" required maxlength="100" disabled>
                        </div>
                <div class="row">
                    <button type="button" class="btn btn-primary modificarFuncionario" title="Actualizar" style="display:block;margin:auto;"><span><ion-icon name="save"></ion-icon></span> Actualizar</button>
                    <!--<button type="button" title="Eliminar" class="btn btn-danger eliminarFuncionario" disabled><ion-icon name="trash"></ion-icon> Eliminar</button>-->
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>