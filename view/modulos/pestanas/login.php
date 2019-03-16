<?php
if (isset($_SESSION["Tipo"])) {
    header("Location:inicio");
}
?>
<div id="vista_login">
    <br>
    <div class="col-md-4" style="display: block;margin: auto;">
        <form class="login" id="FormLogin" method="POST">
            <img src="./view/presentacion/img/citas_ufps.png">
            <p class="mt-3">Ingresa tus datos para iniciar sesión</p>
            <div class="col-auto">

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><ion-icon name="person"></ion-icon></span>
                    </div>
                    <input type="text" name="ingresarUsuario" class="form-control" placeholder="Usuario" id="ingresarUsuario" required onkeypress='return validaNumericos(event)' maxlength="12">
                </div>

                <div class="form-group input-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1"><ion-icon name="lock"></ion-icon></span>
                    </div>
                    <input type="password" name="ingresarContraseña" maxlength="10" class="form-control" placeholder="Contraseña" id="ingresarContraseña" required>
                </div>

                <div class="form-group">
                    <div class="input-group-prepend">
                        <span class="input-group-text" id="basic-addon1" for="ingresarTipo"><ion-icon name="list"></ion-icon></span>       
                        <select id="ingresarTipo" name="ingresarTipo" class="form-control" required> 
                            <option value="">Seleccione tipo de usuario</option>
                            <option value="Administrador">Administrador</option>
                            <option value="Funcionario">Funcionario</option>
                            <option value="Usuario">Usuario</option>
                        </select>
                        <label class="bg-danger" id="error-tipoUsuarioI"></label>     
                    </div>
                </div>

                <div class="input-group mb-3">
                    <button type="submit" class="btn boton_principal mt-3"><ion-icon name="log-in"></ion-icon> Ingresar</button>
                </div>

                <div class="form-group">
                    <a class="mt-2" href="#formRegistrarme" data-toggle="modal" data-target=".bd-example-modal-sm" id="modal_registro"><ion-icon name="person-add"></ion-icon> Registrarme</a>
                </div>
            </div>
            <br>
        </form>

        <!--MODAL REGISTRARME-->
        <form class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="formRegistrarme" method="POST">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalCenterTitle">Registrarme</h5>
                    </div>
                    <div class="modal-body">
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="card"></ion-icon></span>
                            </div>
                            <input type="text" name="registroDocumento" class="form-control" placeholder="Documento de identidad" id="registroDocumento" required onkeypress='return validaNumericos(event)' maxlength="12">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="person"></ion-icon></span>
                            </div>
                            <input type="text" name="registroNombre" class="form-control" placeholder="Nombre" id="registroNombre" required onblur="aMayusculas(this.value,this.id)" maxlength="50">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="call"></ion-icon></span>
                            </div>
                            <input type="text" name="registroTelefono" class="form-control" placeholder="Teléfono" id="registroTelefono" required onkeypress='return validaNumericos(event)' maxlength="15">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="mail"></ion-icon></span>
                            </div>
                            <input type="email" name="registroCorreo" class="form-control" placeholder="Correo Electrónico" id="registroCorreo" required maxlength="100">
                        </div>
                        <div class="form-group input-group" style="color:black">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><ion-icon name="lock"></ion-icon></span>
                            </div>
                            <input type="password" name="registroClave" class="form-control" placeholder="Contraseña" id="registroClave" required maxlength="10">
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="submit" class="btn boton_principal" id="botonRegistroUsuario">Registrar <ion-icon name="person-add"></ion-icon></button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal" aria-label="Close">Cerrar</button>
                    </div>
                </div>
            </div>
        </form>

    </div>
    <br>
</div>
