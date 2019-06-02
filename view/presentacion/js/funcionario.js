var res = $("#registroFunNoticia").val();
var id = 0;
var pulsado = "";
$(document).ready(function () { 

    //VISTA PERFIL   
    $("#botonVerCambiarContraseña").click(function () {
        $("#cambiaContraseña").css('display', 'block');
    });

    $("#botonOcultarCambiarContraseña").click(function () {
        $("#cambiaContraseña").css('display', 'none');
    });

    $("#botonMostrarPerfil").click(function () {
        var datos = {
            personaPerfil: $('#oculto').val()
        };
        $.ajax({
            url: 'view/modulos/ajax.php',
            method: 'post',
            data: datos,
            dataType: "json",

            success: function (respuesta) {
                var documento = respuesta["respuesta"].toString().split("ª")[0];
                var nombre = respuesta["respuesta"].toString().split("ª")[1];
                var telefono = respuesta["respuesta"].toString().split("ª")[2];
                var email = respuesta["respuesta"].toString().split("ª")[3];
                $('#perfilDocumento').val(documento);
                $('#perfilNombre').val(nombre);
                $('#perfilTelefono').val(telefono);
                $('#perfilCorreo').val(email);
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }

        });
    });

    $("#botonRegistroHorario").click(function () {
        $("#FormNoticiaFun").validate({
            rules: {
                dateHorario: { required: true },
                comboHoraInicio: { required: true },
                comboHoraFin: { required: true }
            },
            messages:
            {
                dateHorario: "<span style='color:red'> ✘ </span>",
                comboHoraInicio: "<span style='color:red'> ✘ </span>",
                comboHoraFin: "<span style='color:red'> ✘ </span>"
            },
            submitHandler: function (form) {
                var datos = {
                    idFuncionario: $("#oculto").val(),
                    dateHorario: $("#dateHorario").val(),
                    comboHoraInicio: $("#comboHoraInicio").val(),
                    comboHoraFin: $("#comboHoraFin").val()
                };
                var fechaSelecccionada = datos['dateHorario'];
                var hoy = new Date();
                var fechaActual = hoy.getFullYear()+"-"+arreglarFecha(hoy.getMonth()+1)+"-"+arreglarFecha(hoy.getDate());
                var inicio = $('#comboHoraInicio').val();
                var fin = $('#comboHoraFin').val();

                if(fechaSelecccionada<fechaActual){
                    $('#MensajeErrorHorario').html("Debe seleccionar una fecha posterior al día de hoy.");
                }else if (inicio === "Seleccione" || fin === "Seleccione") {
                    $('#MensajeErrorHorario').html("Debe seleccionar la hora de inicio y de fin.");
                } else {
                    var inicioTime = parseInt(inicio.split(":"));
                    var finTime = parseInt(fin.split(":"));
                    if (inicioTime === finTime) {
                        $('#MensajeErrorHorario').html("La hora de inicio y de fin no pueden ser la misma");
                    } else if (inicioTime > finTime) {
                        $('#MensajeErrorHorario').html("La hora de fin no puede ser menor que la hora de inicio");
                    } else {
                        $.ajax({
                            url: 'view/modulos/ajax.php',
                            method: 'post',
                            data: datos,
                            dataType: "json",

                            beforeSend: function () {
                                respuestaInfoEspera("Espera un momento por favor.");
                            },
                            success: function (respuesta) {
                                if (respuesta["exito"]) {
                                    exito("Registro de horario exitoso", "");
                                    $('#dateHorario').val("");
                                    $('#comboHoraInicio').val("Seleccione");
                                    $('#comboHoraFin').val("Seleccione");
                                    $('#MensajeErrorHorario').html("");
                                    listarHorarios();
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
                }
            }
        });
    });

    function arreglarFecha(x){
        if(parseInt(x)<=9){
            return "0"+x;
        }
    }

    //CARGAR HORARIOS
    if ($('#vista_Fun_Horarios').is(':visible')) {
        //LISTAR NOTICIAS
        listarHorarios();
    }

    function listarHorarios() {
        var datos = {
            idFuncionarioHorario: $('#oculto').val()
        };
        $.ajax({
            url: 'view/modulos/ajax.php',
            method: 'post',
            data: datos,
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("tablaHorario").innerHTML = respuesta;

                //VER CITAS POR ATENDER
                $(".verHorario").bind("click", function () {
                    var x = $(this).attr('id');
                    var datos = {
                        idFuncionarioCitas: $("#oculto").val(),
                        idHorarioCitas: x
                    };
                    $.ajax({
                        url: 'view/modulos/ajax.php',
                        method: 'post',
                        data: datos,
                        dataType: "text",

                        success: function (respuesta) {
                            if (respuesta.trim() === "false") {
                                $('#citasOcultos').css('display', 'none');
                                $('#MensajeErrorCitasFun').html("No hay Citas para la fecha seleccionada");
                                $('#MensajeErrorCitasFun').css('color', 'red');
                            } else {
                                $('#MensajeErrorCitasFun').css('color', 'black');
                                $('#MensajeErrorCitasFun').html("Citas para el día seleccionado:");
                                $('#citasOcultos').html("<table class='tabla table table-sm'>" +
                                    "<thead>" +
                                    "<tr>" +
                                    "<th scope='col' style='width: 10%;'>Turno</th>" +
                                    "<th scope='col' style='width: 20%;'>Hora</th>" +
                                    "<th scope='col' style='width: 20%;'>Usuario</th>" +
                                    "<th scope='col' style='width: 10%;'>Estado</th>" +
                                    "<th scope='col' style='width: 10%;'>Opciones</th>" +
                                    "</tr>" +
                                    "</thead>" +
                                    "<tbody id='tablaPorAtender'>" +
                                    "</tbody>" +
                                    "</table> ");
                                $('#tablaPorAtender').html(respuesta);
                                $('#citasOcultos').css('display', 'block');


                                //CAMBIAR ESTADO DEL TURNO
                                $(".cambiarEstadoCita").bind("click", function () {
                                    pulsado = $(this).attr('id');
                                    swal({
                                        title: "¿Está seguro de cambiar el estado?",
                                        text: "",
                                        icon: "warning",
                                        buttons: ["Cancelar", "Aceptar"],
                                        dangerMode: true
                                    })
                                        .then((willDelete) => {
                                            if (willDelete) {
                                                var datos = {
                                                    idCambiarEstadoTurno: pulsado
                                                };
                                                $.ajax({
                                                    url: 'view/modulos/ajax.php',
                                                    method: 'post',
                                                    data: datos,
                                                    dataType: "json",

                                                    success: function (respuesta) {
                                                        if (respuesta['exito']) {
                                                            exito("Estado Actualizado", "La cita se completó con éxito");
                                                            $('#botonBuscarHorariosFun').click();
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
                            }

                        },
                        error: function (jqXHR, estado, error) {
                            console.log(estado);
                            console.log(error);
                            console.log(jqXHR);
                        }

                    });

                });
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }


    //INGRESAR NUEVA NOTICIA
    $("#botonRegistroNoticiaFun").click(function () {
        $("#FormNoticiaFun").validate({
            rules: {
                registroTituloFun: { required: true },
                registroDescFun: { required: true }
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
                    success: function (respuesta) {
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
                if (respuesta === "false") {
                    $('#mensajeNoticiasFun').html("<h4>Listado de Noticias</h4><hr><label style='color:red;'>No tiene noticias registradas</label>");
                } else {
                    $('#mensajeNoticiasFun').html("<h4>Listado de Noticias</h4><hr><table class='tabla table table-sm'>" +
                        "<thead>" +
                        "<tr>" +
                        "<th scope='col' style='width: 5%;'>#</th>" +
                        "<th scope='col' style='width: 30%;'>Fecha</th>" +
                        "<th scope='col' style='width: 50%;'>Titulo</th>" +
                        "<th scope='col' style='width: 10%;'>Opciones</th>" +
                        "</tr>" +
                        "</thead>" +
                        "<tbody id='tablaNoticiasFun'>" +
                        "</tbody>" +
                        "</table> ");
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

                            success: function (respuesta) {
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

                                        success: function (respuesta) {
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

                                        success: function (respuesta) {
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
                }
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            },
        });
    }




});