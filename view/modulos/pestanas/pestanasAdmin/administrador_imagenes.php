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

<div id="vista_Admin_imagenes">
    <h1>Administración de Imágenes del Inicio</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-5 panel">
            <h4>Nueva Imágen</h4>
            <hr>
            <div style="background:white;border-radius:15px 15px 15px 15px;">
                <div class="alert alert-primary alert-dismissible fade show mt-3" role="alert" style="width:90%;display:block;margin:auto;">
                    <strong>AVISO IMPORTATANTE!</strong> Para el ingreso de una imágen al inicio, se recomienda que tenga una resolución mayor o igual a 1024x600 px.
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form class="login" action="guardarImagen" method="POST" autocomplete="off" enctype="multipart/form-data">
                    <div class="col-auto">

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <ion-icon name="done-all"></ion-icon>
                                </span>
                            </div>
                            <input type="text" name="nombreNuevaImagen" class="form-control" placeholder="Nombre" id="nombreNuevaImagen" onblur="aMayusculas(this.value, this.id)" maxlength="100" required />
                        </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1">
                                    <ion-icon name="attach"></ion-icon>
                                </span>
                            </div>
                            <input type='file' class='form-control' placeholder='Imágen' aria-label='titulo' aria-describedby='basic-addon1' name='enlaceNuevaImagen' id='enlaceNuevaImagen' required>
                        </div>

                        <div class="input-group mb-3">
                            <button id="botonRegistroImagen" type="submit" class="btn boton_principal mt-3" title="Guardar imágen">
                                <ion-icon name="save"></ion-icon> Guardar
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 panel" id="mensajeDep">
            <h4>Listado de Imágenes</h4>
            <hr>
            <table class="tabla table table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 60%;">Nombre</th>
                        <th scope="col" style="width: 20%;">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaImagenes">

                </tbody>
            </table>
        </div>
    </div>
</div>


<!--MODAL INFORMACION DE LA IMAGEN-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="VerInfoImagen">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <form id="FormInfoImagen" method="POST">
                <h4 style="text-align: center;">Imágen</h4>
                <hr>
                <img src="" alt="vista_imagen" id="vistaImagenListado" style="width:100%;">
                <br><br>
                <div class="row">
                    <!--<button type="button" title="Eliminar" class="btn btn-danger eliminarDependencia" disabled><ion-icon name="trash"></ion-icon> Eliminar</button>-->
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>