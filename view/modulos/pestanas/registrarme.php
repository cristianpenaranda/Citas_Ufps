<!--MODAL REGISTRARME-->
<form class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" autocomplete="off" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="formRegistrarme" method="POST">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Registrarme</h5>
            </div>
            <div class="modal-body">
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="card"></ion-icon>
                        </span>
                    </div>
                    <input type="text" name="registroDocumento" class="form-control" placeholder="Documento de identidad" id="registroDocumento" required onkeypress='return validaNumericos(event)' maxlength="12">
                </div>
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="person"></ion-icon>
                        </span>
                    </div>
                    <input type="text" name="registroNombre" class="form-control" placeholder="Nombre" id="registroNombre" required onblur="aMayusculas(this.value,this.id)" maxlength="50">
                </div>
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="call"></ion-icon>
                        </span>
                    </div>
                    <input type="text" name="registroTelefono" class="form-control" placeholder="Teléfono" id="registroTelefono" required onkeypress='return validaNumericos(event)' maxlength="15">
                </div>
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="mail"></ion-icon>
                        </span>
                    </div>
                    <input type="email" name="registroCorreo" class="form-control" placeholder="Correo Electrónico" id="registroCorreo" required maxlength="100">
                </div>
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="lock"></ion-icon>
                        </span>
                    </div>
                    <input type="password" name="registroClave" class="form-control" placeholder="Contraseña" id="registroClave" required maxlength="20">
                </div>
                <label id="label_registro_Usuario" style="color:red;"></label>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn boton_principal" id="botonRegistroUsuario">Registrar <ion-icon name="person-add"></ion-icon></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
        </div>
    </div>
</form>