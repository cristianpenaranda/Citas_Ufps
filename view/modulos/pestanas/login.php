<?php
if (isset($_SESSION["Tipo"])) {
    header("Location:inicio");
}
include_once '.\view\modulos\pestanas\registrarme.php';
include_once '.\view\modulos\pestanas\recordarContrasena.php';
?>
<div id="vista_login">
    <br>
    <div class="col-md-4" style="display: block;margin: auto;">
        <form class="login" id="FormLogin" method="POST" autocomplete="off">
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
                    <input value="contraseña" type="password" name="ingresarContraseña" maxlength="20" class="form-control" placeholder="Contraseña" id="ingresarContraseña" required>
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
                    <a class="mt-2" href="#formRegistrarme" data-toggle="modal" id="modal_registro"><ion-icon name="person-add"></ion-icon> Registrarme</a>
                </div>
                <div class="form-group">
                    <a class="mt-2" href="#formRecordarContrasena" data-toggle="modal" id="modal_recordar"><ion-icon name="help"></ion-icon> Olvidé mi contraseña</a>
                </div>
            </div>
            <br>
        </form>


    </div>
    <br>
</div>
