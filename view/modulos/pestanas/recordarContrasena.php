<!--MODAL RECORDAR CONTRASEÑA-->
<form class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="formRecordarContrasena" method="POST" autocomplete="off">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Olvidé mi Contraseña</h5>
            </div>
            <div class="modal-body">
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="card"></ion-icon>
                        </span>
                    </div>
                    <input type="text" name="recordar_Documento" class="form-control" placeholder="Documento de identidad" id="recordar_Documento" required onkeypress='return validaNumericos(event)' maxlength="12">
                </div>
            </div>

            <div class="modal-footer">
                <button type="submit" class="btn boton_principal" id="botonRecordarContrasena">Recordar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
        </div>
    </div>
</form>