var id = 0;
$(document).ready(function () {
    //CARGAR NOTICIAS EN PESTAÑA INICIO
    if ($('#vista_inicio').is(':visible')) {
        //LISTAR NOTICIAS
        $.ajax({
            url: 'view/modulos/ajax.php?listarNoticias=true',
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("panelNoticias").innerHTML = respuesta;
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }
    
    //CARGAR TOTALES EN PESTAÑA INICIO
    if ($('#totalesAdmin').is(':visible')) {
        $.ajax({
            url: 'view/modulos/ajax.php?mostrarTotales=true',
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("totalDep").innerHTML = respuesta.split('ª')[0];
                document.getElementById("totalFun").innerHTML = respuesta.split('ª')[1];
                document.getElementById("totalNot").innerHTML = respuesta.split('ª')[2];
                document.getElementById("totalUsu").innerHTML = respuesta.split('ª')[3];
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }

    //INGRESAR NUEVA NOTICIA
    $("#botonRegistroNoticiaAdmin").click(function () {
        $("#FormNoticiaAdmin").validate({
            rules: {
                registroTituloAdmin: {required: true},
                registroDescAdmin: {required: true}
            },
            messages:
                    {
                        registroTituloAdmin: "<span style='color:red'> ✘ </span>",
                        registroDescAdmin: "<span style='color:red'> ✘ </span>"
                    },

            submitHandler: function (form) {

                var datos = {
                    registroTitulo: $("#registroTituloAdmin").val(),
                    registroDesc: $("#registroDescAdmin").val(),
                    tipoRegistro: "Administrador"
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
                            $('#registroTituloAdmin').val("");
                            $('#registroDescAdmin').val("");
                            listarNoticiasAdmin();
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

    //CARGAR NOTICIAS DE ADMINISTRADOR
    if ($('#vista_Admin_Noticias').is(':visible')) {
        //LISTAR NOTICIAS
        listarNoticiasAdmin();
    }

    function listarNoticiasAdmin() {
        $.ajax({
            url: 'view/modulos/ajax.php?listarNoticiasAdmin=true',
            dataType: 'text',
            success: function (respuesta) {
                
                if (respuesta === "false") {
                    $('#mensajeNoticiasAdm').html("<h4>Listado de Noticias</h4><hr><label style='color:red;'>No tiene noticias registradas</label>");
                } else {
                    $('#mensajeNoticiasAdm').html("<h4>Listado de Noticias</h4><hr><table class='tabla table table-sm'>"+
                                                        "<thead>"+
                                                            "<tr>"+
                                                                "<th scope='col' style='width: 5%;'>#</th>"+
                                                                "<th scope='col' style='width: 30%;'>Fecha</th>"+
                                                                "<th scope='col' style='width: 50%;'>Titulo</th>"+
                                                                "<th scope='col' style='width: 10%;'>Opciones</th>"+
                                                            "</tr>"+
                                                        "</thead>"+
                                                        "<tbody id='tablaNoticiasAdmin'>"+
                                                        "</tbody>"+
                                                    "</table> ");
                document.getElementById("tablaNoticiasAdmin").innerHTML = respuesta;
                //VER INFORMACION DE LA NOTICIA DEL ADMINISTRADOR
                $(".verNoticiaAdmin").bind("click", function () {
                    var datos = {
                        idNoticia: $(this).attr("id")
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
                            $('#ModalNoticiaAdminFecha').val(fecha);
                            $('#ModalNoticiaAdminTitulo').val(titulo);
                            $('#ModalNoticiaAdminDescripcion').val(descripcion);
                        },
                        error: function (jqXHR, estado, error) {
                            console.log(estado);
                            console.log(error);
                            console.log(jqXHR);
                        }

                    });
                });
                //ELIMINAR NOTICIA DE ADMINISTRADOR
                $(".eliminarNoticiaAdmin").bind("click", function () {
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
                                                listarNoticiasAdmin();
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
                //MODIFICAR NOTICIA DE ADMINISTRADOR
                $(".modificarNoticiaAdmin").bind("click", function () {
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
                                        tituloNoticiaModificar: $("#ModalNoticiaAdminTitulo").val(),
                                        descNoticiaModificar: $("#ModalNoticiaAdminDescripcion").val()
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
                                                listarNoticiasAdmin();
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

    //CARGAR FUNCIONARIOS EN COMBO DEL REGISTRO DE LA DEPENDENCIA
    if ($('#vista_Admin_Dependencias').is(':visible')) {
        //LISTAR FUNCIONARIOS EN COMBO DEL REGISTRO DE LA DEPENDENCIA
        $.ajax({
            url: 'view/modulos/ajax.php?listarFuncionariosRegistro=true',
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("ingresarFuncionarioDep").innerHTML = respuesta;
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            },
        });
    }

    //REGISTRAR NUEVO FUNCIONARIO
    $("#botonRegistroFuncionario").click(function () {
        $("#FormFuncionario").validate({
            rules: {
                registroDocumentoFuncionario: {required: true},
                registroNombreFuncionario: {required: true},
                registroTelefonoFuncionario: {required: true},
                registroCorreoFuncionario: {required: true},
                registroClaveFuncionario: {required: true}
            },
            messages:
                    {
                        registroDocumentoFuncionario: "<span style='color:red'> ✘ </span>",
                        registroNombreFuncionario: "<span style='color:red'> ✘ </span>",
                        registroTelefonoFuncionario: "<span style='color:red'> ✘ </span>",
                        registroCorreoFuncionario: "<span style='color:red'> ✘ </span>",
                        registroClaveFuncionario: "<span style='color:red'> ✘ </span>"
                    },

            submitHandler: function (form) {

                var datos = {
                    registroDocumentoFuncionario: $("#registroDocumentoFuncionario").val(),
                    registroNombreFuncionario: $("#registroNombreFuncionario").val(),
                    registroTelefonoFuncionario: $("#registroTelefonoFuncionario").val(),
                    registroCorreoFuncionario: $("#registroCorreoFuncionario").val(),
                    registroClaveFuncionario: $("#registroClaveFuncionario").val()
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
                            exito("Registro Exitoso!", "");
                            $("#registroDocumentoFuncionario").val("");
                            $("#registroNombreFuncionario").val("");
                            $("#registroTelefonoFuncionario").val("");
                            $("#registroCorreoFuncionario").val("");
                            $("#registroClaveFuncionario").val("");
                            listarFuncionarios();
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

    //CARGAR FUNCIONARIOS 
    if ($('#vista_Admin_Funcionarios').is(':visible')) {
        //LISTAR FUNCIONARIOS
        listarFuncionarios();
    }

    function listarFuncionarios() {
        $.ajax({
            url: 'view/modulos/ajax.php?listarFuncionarios=true',
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("tablaFuncionarios").innerHTML = respuesta;
                //VER INFORMACION DEL FUNCIONARIO
                $(".verFuncionario").bind("click", function () {
                    var datos = {
                        idFuncionario: $(this).attr("id")
                    };
                    id = datos['idFuncionario'];
                    $.ajax({
                        url: 'view/modulos/ajax.php',
                        method: 'post',
                        data: datos,
                        dataType: "json",

                        success: function (respuesta)
                        {
                            var doc = respuesta["respuesta"].toString().split("ª")[0];
                            var nom = respuesta["respuesta"].toString().split("ª")[1];
                            var tel = respuesta["respuesta"].toString().split("ª")[2];
                            var email = respuesta["respuesta"].toString().split("ª")[3];
                            var dep = respuesta["respuesta"].toString().split("ª")[4];
                            $('#ModalDocumentoFuncionario').val(doc);
                            $('#ModalNombreFuncionario').val(nom);
                            $('#ModalTelefonoFuncionario').val(tel);
                            $('#ModalCorreoFuncionario').val(email);
                            if (dep === "") {
                                $('#ModalDepFuncionario').val("No Tiene Asignado Dependencia");
                            } else {
                                $('#ModalDepFuncionario').val(dep);
                            }
                        },
                        error: function (jqXHR, estado, error) {
                            console.log(estado);
                            console.log(error);
                            console.log(jqXHR);
                        }

                    });
                });
                //MODIFICAR DATOS DEL FUNCIONARIO
                $(".modificarFuncionario").bind("click", function () {
                    swal({
                        title: "¿Está seguro de modificar el funcionario?",
                        text: "",
                        icon: "warning",
                        buttons: ["Cancelar", "Aceptar"],
                        dangerMode: false
                    })
                            .then((willDelete) => {
                                if (willDelete) {
                                    var datos = {
                                        idFuncionarioModificar: id,
                                        nombreFuncionarioModificar: $('#ModalNombreFuncionario').val(),
                                        telefonoFuncionarioModificar: $('#ModalTelefonoFuncionario').val(),
                                        correoFuncionarioModificar: $('#ModalCorreoFuncionario').val()
                                    };
                                    $.ajax({
                                        url: 'view/modulos/ajax.php',
                                        method: 'post',
                                        data: datos,
                                        dataType: "json",

                                        success: function (respuesta)
                                        {
                                            if (respuesta["exito"]) {
                                                exito("Funcionario Modificado", "");
                                                listarFuncionarios();
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
    
    
    //REGISTRAR NUEVA DEPENDENCIA
    $("#botonRegistroDependencia").click(function () {
        $("#FormDependencia").validate({
            rules: {
                registroNombreDep: {required: true},
                registroUbicacionDep: {required: true},
                registroTelefonoDep: {required: true},
                ingresarFuncionarioDep: {required: true}
            },
            messages:
                    {
                        registroNombreDep: "<span style='color:red'> ✘ </span>",
                        registroUbicacionDep: "<span style='color:red'> ✘ </span>",
                        registroTelefonoDep: "<span style='color:red'> ✘ </span>",
                        ingresarFuncionarioDep: "<span style='color:red'> ✘ </span>"
                    },

            submitHandler: function (form) {

                var datos = {
                    registroNombreDep: $("#registroNombreDep").val(),
                    registroUbicacionDep: $("#registroUbicacionDep").val(),
                    registroTelefonoDep: $("#registroTelefonoDep").val(),
                    ingresarFuncionarioDep: $("#ingresarFuncionarioDep").val()
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
                            exito("Registro Exitoso!", "");
                            $("#registroNombreDep").val("");
                            $("#registroUbicacionDep").val("");
                            $("#registroTelefonoDep").val("");
                            $("#ingresarFuncionarioDep").val("");
                            listarDependencias()
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

    //CARGAR DEPENDENCIAS 
    if ($('#vista_Admin_Dependencias').is(':visible')) {
        //LISTAR DEPENDENCIAS
        listarDependencias();
    }

    function listarDependencias() {
        $.ajax({
            url: 'view/modulos/ajax.php?listarDependencias=true',
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("tablaDependencias").innerHTML = respuesta;
                //VER INFORMACION DEL DEPENDENCIAS
                $(".verDependencia").bind("click", function () {
                    var datos = {
                        idDependencia: $(this).attr("id")
                    };
                    id = datos['idDependencia'];
                    $.ajax({
                        url: 'view/modulos/ajax.php',
                        method: 'post',
                        data: datos,
                        dataType: "json",

                        success: function (respuesta)
                        {
                            var nom = respuesta["respuesta"].toString().split("ª")[0];
                            var ubi = respuesta["respuesta"].toString().split("ª")[1];
                            var tel = respuesta["respuesta"].toString().split("ª")[2];
                            var fun = respuesta["respuesta"].toString().split("ª")[3];
                            $('#ModalNombreDep').val(nom);
                            $('#ModalUbicacionDep').val(ubi);
                            $('#ModalTelefonoDep').val(tel);
                            if (fun === "") {
                                $('#ModalFuncionarioDep').val("No Tiene Asignado Funcionario");
                            } else {
                                $('#ModalFuncionarioDep').val(fun);
                            }
                        },
                        error: function (jqXHR, estado, error) {
                            console.log(estado);
                            console.log(error);
                            console.log(jqXHR);
                        }

                    });
                });
                //MODIFICAR DATOS DE LA DEPENDENCIA
                $(".modificarDependencia").bind("click", function () {
                    swal({
                        title: "¿Está seguro de modificar la dependencia?",
                        text: "",
                        icon: "warning",
                        buttons: ["Cancelar", "Aceptar"],
                        dangerMode: false
                    })
                            .then((willDelete) => {
                                if (willDelete) {
                                    var datos = {
                                        idDepModificar: id,
                                        nombreDepModificar: $('#ModalNombreDep').val(),
                                        ubicacionDepModificar: $('#ModalUbicacionDep').val(),
                                        telefonoDepModificar: $('#ModalTelefonoDep').val()
                                    };
                                    $.ajax({
                                        url: 'view/modulos/ajax.php',
                                        method: 'post',
                                        data: datos,
                                        dataType: "json",

                                        success: function (respuesta)
                                        {
                                            if (respuesta["exito"]) {
                                                exito("Dependencia Modificada", "");
                                                listarDependencias();
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