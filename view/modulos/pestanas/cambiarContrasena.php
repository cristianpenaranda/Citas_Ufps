<!--MODAL CAMBIAR CONTRASEÑA-->
<form class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="modalCambiarContrasena" method="POST">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalCenterTitle">Cambiar Contraseña</h5>
            </div>
            <div class="modal-body">
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text">
                            <ion-icon name="lock"></ion-icon>
                        </span>
                    </div>
                    <input type="password" name="cambiar_Contrasena" class="form-control" placeholder="Nueva Contraseña" id="cambiar_Contrasena" required maxlength="20">
                </div>                
                <small>
                    <input type="checkbox" id="verContraseñas" class="ver"/>
                    <label class="text">Mostrar contraseñas</label>
                </small><br>
                <label id="label_cambiarContrasena" style="color:red;"></label>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn boton_principal" id="botonCambiarContrasena">Actualizar</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
            </div>
        </div>
    </div>
</form>