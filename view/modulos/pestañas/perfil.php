<?php
if (isset($_SESSION["Usuario"])) {
    include 'model/dto/PersonaDTO.php';
    $user = unserialize($_SESSION['Usuario']);
    if ($user == "Administrador") {
        header("Location:ErrorPage");
    }
} else {
    header("Location:ErrorPage");
}
?>


<!--MODAL PERFIL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="formPerfil">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <form>
                <h4 style="text-align: center;">Mi Perfil</h4>
                <hr>
                <img src="https://drive.google.com/uc?export=view&id=1VAVdqLOT3aPd8XqyhcBVkV9TVa3n3A-z" alt="" class="img-rounded img-responsive" style="width:40%;display:block;margin:auto;"/>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Documento</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="perfilDocumento" placeholder="col-form-label-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="perfilNombre" placeholder="col-form-label-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="perfilTelefono" placeholder="col-form-label-sm">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Correo Electrónico</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="perfilCorreo" placeholder="col-form-label-sm">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="email" class="form-control form-control-sm" id="perfilCorreo" placeholder="col-form-label-sm">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-md-12">
                            <input type="email" class="form-control form-control-sm" id="perfilCorreo" placeholder="col-form-label-sm">
                        </div>
                    </div>
                </div>
                <!--<button class="btn btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-sm" id="modal"><span class="ion-loop"></span> Cambiar Contraseña</button>     -->
            </form>
        </div>
    </div>
</div>

<!--<div class="container fondoApp">
    <div class="row">
        <div class="col-md-7">
            <div class="well well-sm perfil">
                <h2>Perfil</h2>
                <hr>
                <img src="https://drive.google.com/uc?export=view&id=1VAVdqLOT3aPd8XqyhcBVkV9TVa3n3A-z" alt="" class="img-rounded img-responsive" />
                <div class="info">
                    <h3><span class="ion-person"></span> ' .$user->getNombre().'</h3>
                    <h5 id="UsuarioCambiarContraseña"><span class="ion-card"></span> '.$user->getDocumento().'</h5>
                    <span class="ion-location"></span> 
                    <p>
                        <span class="ion-email"></span> 
                        <br>
                        <span class="ion-android-call"></span> '.$user->getTelefono().'
                        <br>
                        <span class="ion-person-stalker"></span> 
                    </p>
                </div>
                <button class="btn btn-primary" href="" data-toggle="modal" data-target=".bd-example-modal-sm" id="modal"><span class="ion-loop"></span> Cambiar Contraseña</button>                
            </div>
        </div>
    </div>
</div>

MODAL CAMBIAR CONTRAASEÑA
<form class=" modal fade bd-example-modal-sm modalContraseña" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="FormCambiarContraseña" method="POST">
    <div class="modal-dialog">
        <div class="modal-content">
            <h5 class="modal-title mt-3 mb-3" id="exampleModalCenterTitle" style="text-align: center;">Cambiar Contraseña </h5>
            <hr style="width:90%;">
            <div class="modal-body">
                <div class="form-group input-group" style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text ion-unlocked" for="AnteriorCambiarContraseña" id="basic-addon1"></span>
                    </div>
                    <input type="password" maxlength="50"  class="form-control" placeholder="Contraseña Anterior" id="AnteriorCambiarContraseña" name="AnteriorCambiarContraseña" required>
                </div>

                <div class="form-group input-group"  style="color:black">
                    <div class="input-group-prepend">
                        <span class="input-group-text ion-locked" for="NuevaCambiarContraseña" id="basic-addon1"></span>
                    </div>
                    <input type="password" maxlength="50"  class="form-control" placeholder="Contraseña Nueva" id="NuevaCambiarContraseña" name="NuevaCambiarContraseña" required>
                </div>
                <div class="row">
                    <button type="submit" class="btn btn-primary ml-5 mr-3" id="botonCambiarContraseña" style="width:50%;">Cambiar <span class="ion-loop"></span></button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal"><span class="ion-close-round"></span> Cerrar</button></div>
                </div>
        </div>
    </div>
</form>
-->
