<?php
if (isset($_SESSION["Tipo"])) {
    include 'model/dto/PersonaDTO.php';
    $user = unserialize($_SESSION['Tipo']);
    $persona = unserialize($_SESSION['Usuario']);
    if($user != "Funcionario"){
        header("Location:ErrorPage");
    }
} else {
    header("Location:ErrorPage");
}
?>

<div id="vista_Fun_Noticias">
    <h1>Noticias</h1>
    <div class="row ml-0 mr-0">
        <div class="col-md-5 panel">
            <h4>Nueva Noticia</h4>
            <hr>
                <div style="background:white;border-radius:15px 15px 15px 15px;">
                <form class="login" id="FormNoticiaFun" method="POST">
                    <div class="col-auto">

                        <div class="form-group input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="person"></ion-icon></span>
                            </div>
                            <?php                            
                                echo '<input type="text" name="registroFunNoticia" class="form-control" placeholder="Funcionario" id="registroFunNoticia" value="'.$persona->getDocumento().'-'.$persona->getNombre().'" disabled>';
                            ?>
                        </div>
                        
                        <div class="form-group input-group mt-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="bookmark"></ion-icon></span>
                            </div>
                            <textarea type="text" name="registroTituloFun" class="form-control" placeholder="Título" id="registroTituloFun" required></textarea>
                        </div>

                        <div class="form-group input-group">
                            <div class="input-group-prepend">
                                <span class="input-group-text" id="basic-addon1"><ion-icon name="book"></ion-icon></span>
                            </div>
                            <textarea type="text" name="registroDescFun" class="form-control" placeholder="Descripción" id="registroDescFun" required></textarea>
                        </div>

                        <div class="input-group mb-3">
                            <button id="botonRegistroNoticiaFun" type="submit" class="btn boton_principal mt-3"><ion-icon name="done-all"></ion-icon> Ingresar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-md-5 panel">
            <h4>Listado de Noticias</h4>
            <hr>
            <table class="tabla table table-sm">
                <thead>
                    <tr>
                        <th scope="col" style="width: 5%;">#</th>
                        <th scope="col" style="width: 30%;">Fecha</th>
                        <th scope="col" style="width: 50%;">Titulo</th>
                        <th scope="col" style="width: 10%;">Opciones</th>
                    </tr>
                </thead>
                <tbody id="tablaNoticiasFun">
                    
                </tbody>
            </table>
        </div>
    </div>
</div>


<!--MODAL INFORMACION DE LA NOTICIA-->
<div class="modal fade bd-example-modal-sm" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true" id="VerInfoNoticiaFun">
    <div class="modal-dialog">
        <div class="modal-content" style="padding: 5%;">
            <form id="FormInfoCliente" method="POST">
                <h4 style="text-align: center;">Información</h4>
                <hr>
                <div class="form-group">
                    <label>Titulo</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><ion-icon name="bookmark"></ion-icon></span>
                        </div>
                        <textarea type="text" class="form-control" id="ModalNoticiaFunTitulo"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Descripción</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><ion-icon name="book"></ion-icon></span>
                        </div>
                        <textarea type="text" class="form-control" id="ModalNoticiaFunDescripcion"></textarea>
                    </div>
                </div>
                <div class="form-group">
                    <label>Fecha</label>
                    <div class="input-group mb-3">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><ion-icon name="calendar"></ion-icon></span>
                        </div>
                        <input type="text" class="form-control" id="ModalNoticiaFunFecha" disabled>
                    </div>
                </div>
                <div class="row">
                    <button type="button" class="btn btn-primary modificarNoticiaFun" title="Actualizar" style="display:block;margin:auto;"><span><ion-icon name="save"></ion-icon></span> Actualizar</button>
                    <button type="button" title="Eliminar" class="btn btn-danger eliminarNoticiaFun"><ion-icon name="trash"></ion-icon> Eliminar</button>
                    <button type="button" class="btn btn-secondary cerrarModal" data-dismiss="modal" title="Cerrar" style="display:block;margin:auto;">X Cerrar</button>
                </div>
            </form>
        </div>
    </div>
</div>