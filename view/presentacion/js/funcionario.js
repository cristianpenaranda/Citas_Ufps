var res = $("#registroFunNoticia").val();
var id = 0;
$(document).ready(function () {    
    //INGRESAR NUEVA NOTICIA
    $("#botonRegistroNoticiaFun").click(function () {
        $("#FormNoticiaFun").validate({
            rules: {
                registroTituloFun: {required: true},
                registroDescFun: {required: true}
            },
            messages:
                    {
                        registroTituloFun: "<span style='color:red'> ✘ </span>",
                        registroDescFun: "<span style='color:red'> ✘ </span>"
                    },

            submitHandler: function (form) {
                var datos = {
                    registroTitulo: $("#registroTituloFun").val(),
                    registroDesc: $("#registroDescFun").val(),
                    tipoRegistro: res.split("-")[0]
                };
                $.ajax({
                    url: 'view/modulos/ajax.php',
                    method: 'post',
                    data: datos,
                    dataType: "json",

                    beforeSend: function () {
                        respuestaInfoEspera("Espera un momento por favor.");
                    },
                    success: function (respuesta)
                    {
                        if (respuesta["exito"]) {
                            exito("Ingreso de noticia con éxito !", "");
                            $('#registroTituloFun').val("");
                            $('#registroDescFun').val("");
                            listarNoticiasFun();
                        } else {
                            respuestaError("ERROR", respuesta["error"]);
                        }

                    },
                    error: function (jqXHR, estado, error) {
                        console.log(estado);
                        console.log(error);
                        console.log(jqXHR);
                    }

                });
            }
        });
    });
    
    
    //CARGAR NOTICIAS
    if ($('#vista_Fun_Noticias').is(':visible')) {
        //LISTAR NOTICIAS
        listarNoticiasFun();
    }

    function listarNoticiasFun() {
        var datos = {
            idNoticiaFunListar: res.split("-")[0]
        };
        $.ajax({
            url: 'view/modulos/ajax.php',
            method: 'post',
            data: datos,
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("tablaNoticiasFun").innerHTML = respuesta;
                //VER INFORMACION DE LA NOTICIA
                $(".verNoticiaFun").bind("click", function () {
                    var datos = {
                        idNoticia: $(this).attr('id')
                    };
                    id = datos['idNoticia'];
                    $.ajax({
                        url: 'view/modulos/ajax.php',
                        method: 'post',
                        data: datos,
                        dataType: "json",

                        success: function (respuesta)
                        {
                            var fecha = respuesta["respuesta"].toString().split("ª")[2];
                            var titulo = respuesta["respuesta"].toString().split("ª")[0];
                            var descripcion = respuesta["respuesta"].toString().split("ª")[1];
                            $('#ModalNoticiaFunFecha').val(fecha);
                            $('#ModalNoticiaFunTitulo').val(titulo);
                            $('#ModalNoticiaFunDescripcion').val(descripcion);
                        },
                        error: function (jqXHR, estado, error) {
                            console.log(estado);
                            console.log(error);
                            console.log(jqXHR);
                        }

                    });
                });
                //ELIMINAR NOTICIA
                $(".eliminarNoticiaFun").bind("click", function () {
                    swal({
                        title: "¿Está seguro de eliminar la noticia?",
                        text: "",
                        icon: "warning",
                        buttons: ["Cancelar", "Aceptar"],
                        dangerMode: true
                    })
                            .then((willDelete) => {
                                if (willDelete) {
                                    var datos = {
                                        idNoticiaEliminar: id
                                    };
                                    $.ajax({
                                        url: 'view/modulos/ajax.php',
                                        method: 'post',
                                        data: datos,
                                        dataType: "json",

                                        success: function (respuesta)
                                        {
                                            if (respuesta["exito"]) {
                                                exito("Noticia eliminada", "");
                                                listarNoticiasFun();
                                                $(".cerrarModal").click();
                                            } else if (!respuesta["exito"]) {
                                                respuestaError("Error al eliminar", respuesta["error"]);
                                            }
                                        },
                                        error: function (jqXHR, estado, error) {
                                            console.log(estado);
                                            console.log(error);
                                            console.log(jqXHR);
                                        }

                                    });
                                }
                            });
                });
                //MODIFICAR NOTICIA
                $(".modificarNoticiaFun").bind("click", function () {
                    swal({
                        title: "¿Está seguro de modificar la noticia?",
                        text: "",
                        icon: "warning",
                        buttons: ["Cancelar", "Aceptar"],
                        dangerMode: false
                    })
                            .then((willDelete) => {
                                if (willDelete) {
                                    var datos = {
                                        idNoticiaModificar: id,
                                        tituloNoticiaModificar: $("#ModalNoticiaFunTitulo").val(),
                                        descNoticiaModificar: $("#ModalNoticiaFunDescripcion").val()
                                    };
                                    $.ajax({
                                        url: 'view/modulos/ajax.php',
                                        method: 'post',
                                        data: datos,
                                        dataType: "json",

                                        success: function (respuesta)
                                        {
                                            if (respuesta["exito"]) {
                                                exito("Noticia Modificada", "");
                                                listarNoticiasFun();
                                                $(".cerrarModal").click();
                                            } else if (!respuesta["exito"]) {
                                                respuestaError("Error al modificar", respuesta["error"]);
                                            }
                                        },
                                        error: function (jqXHR, estado, error) {
                                            console.log(estado);
                                            console.log(error);
                                            console.log(jqXHR);
                                        }

                                    });
                                }
                            });
                });
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            },
        });
    }

});