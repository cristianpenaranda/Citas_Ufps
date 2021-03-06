<?php
if (isset($_SESSION["Tipo"])) {
    $user = unserialize($_SESSION['Tipo']);
    if($user != "Administrador"){
        header("Location:errorpage");
    }
} else {
    header("Location:errorpage");
}
?>

<div id="vista_Admin_Noticias">
    <h1>Administración de Noticias</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-5 panel">
            <h4>Nueva Noticia</h4>
            <hr>
                <div style="background:white;border-radius:15px 15px 15px 15px;">
                <form class="login" id="FormNoticiaAdmin" method="POST" autocomplete="off">
                    <div class="col-auto">

                        <div class="form-group input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="bookmark"></ion-icon></span>
                            </div>
                            <textarea type="text" name="registroTituloAdmin" class="form-control" placeholder="Título" id="registroTituloAdmin" required></textarea>
                        </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="book"></ion-icon></span>
                            </div>
                            <textarea type="text" name="registroDescAdmin" class="form-control" placeholder="Descripción" id="registroDescAdmin" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <button id="botonRegistroNoticiaAdmin" type="submit" class="btn boton_principal mt-3"><ion-icon name="done-all"></ion-icon> Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 panel" id="mensajeNoticiasAdm">
            
        </div>
    </div>
</div>


<!--MODAL INFORMACION DE LA NOTICIA-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="VerInfoNoticiaAdmin">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <form id="FormInfoCliente" method="POST" autocomplete="off">
                <h4 style="text-align: center;">Información</h4>
                <hr>
                <div class="form-group">
                    <label>Titulo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><ion-icon name="bookmark"></ion-icon></span>
                        </div>
                        <textarea type="text" class="form-control" id="ModalNoticiaAdminTitulo"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><ion-icon name="book"></ion-icon></span>
                        </div>
                        <textarea type="text" class="form-control" id="ModalNoticiaAdminDescripcion"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><ion-icon name="calendar"></ion-icon></span>
                        </div>
                        <input type="text" class="form-control" id="ModalNoticiaAdminFecha" disabled>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary modificarNoticiaAdmin" title="Actualizar" style="display:block;margin:auto;"><span><ion-icon name="save"></ion-icon></span> Actualizar</button>
                    <button type="button" title="Eliminar" class="btn btn-danger eliminarNoticiaAdmin"><ion-icon name="trash"></ion-icon> Eliminar</button>
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>