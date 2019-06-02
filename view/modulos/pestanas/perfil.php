
<!--MODAL PERFIL-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="formPerfil">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <div>
                <h4 style="text-align: center;">Mi Perfil</h4>
                <hr>
                <img src="https://drive.google.com/uc?export=view&id=1VAVdqLOT3aPd8XqyhcBVkV9TVa3n3A-z" alt="" class="img-rounded img-responsive" style="width:40%;display:block;margin:auto;"/>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Documento</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="perfilDocumento" placeholder="Documento" required onkeypress='return validaNumericos(event)' maxlength="12">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Nombre</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="perfilNombre" placeholder="Nombre" required onblur="aMayusculas(this.value,this.id)" maxlength="50">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Teléfono</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control form-control-sm" id="perfilTelefono" placeholder="Teléfono" required onkeypress='return validaNumericos(event)' maxlength="15">
                    </div>
                </div>
                <div class="form-group row">
                    <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Correo Electrónico</label>
                    <div class="col-sm-10">
                        <input type="email" class="form-control form-control-sm" id="perfilCorreo" placeholder="Email" required maxlength="100">
                    </div>
                </div>
                <div id="cambiaContraseña" style="display: none;">
                    <hr>
                    <div class="row">
                        <label for="colFormLabelSm" class="col-sm-2 col-form-label col-form-label-sm">Cambiar Contraseña</label>
                        <div class="col-md-5 mt-2">
                            <input type="text" class="form-control form-control-sm" id="perfilClave" placeholder="Antigua Contraseña" required maxlength="10">
                        </div>
                        <div class="col-md-5 mt-2">
                            <input type="text" class="form-control form-control-sm" id="perfilClaveNueva" placeholder="Nueva Contraseña" required maxlength="10">
                        </div>
                    </div>   
                    <!--<div class="col-md-8" style="display: block;margin: auto;">
                        <button class="btn btn-primary mt-3" id="botonCambiarContraseña"><ion-icon name="lock"></ion-icon> Cambiar</button>
                        <button class="btn btn-secondary mt-3" id="botonOcultarCambiarContraseña"><ion-icon name="remove"></ion-icon> Ocultar Panel</button>
                    </div>-->
                    <br>
                </div>
                <!--<div class="col-md-12">
                    <button class="btn btn-success" id="botonActualizarInformacion"><ion-icon name="checkmark-circle-outline"></ion-icon> Actualizar</button>
                    <button class="btn btn-primary" id="botonVerCambiarContraseña"><ion-icon name="add"></ion-icon> Contraseña</button>
                </div>-->
            </div>
        </div>
    </div>
</div>