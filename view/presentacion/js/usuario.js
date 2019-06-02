var id = "";
$(document).ready(function () {
    document.querySelector("#buscar").onkeyup = function () {
        $TableFilter("#tablaSolicitud", this.value);
    };

    $TableFilter = function (id, value) {
        var rows = document.querySelectorAll(id + ' tbody tr');

        for (var i = 0; i < rows.length; i++) {
            var showRow = false;

            var row = rows[i];
            row.style.display = 'none';

            for (var x = 0; x < row.childElementCount; x++) {
                if (row.children[x].textContent.toLowerCase().indexOf(value.toLowerCase().trim()) > -1) {
                    showRow = true;
                    break;
                }
            }

            if (showRow) {
                row.style.display = null;
            }
        }
    };



    //CARGAR DEPENDENCIAS 
    if ($('#vista_usuario_solicitud').is(':visible')) {
        //LISTAR DEPENDENCIAS
        listarDependencias();
    }

    function listarDependencias() {
        $.ajax({
            url: 'view/modulos/ajax.php?listarDependenciasSolicitud=true',
            dataType: 'text',
            success: function (respuesta) {
                document.getElementById("bodyTablaSolicitud").innerHTML = respuesta;
                $(".verDepSolicitud").bind("click", function () {
                    id = $(this).attr('id');
                });

                //VER HORARIOS DE CITAS 
                $(".verDepSolicitud").bind("click", function () {
                    var hoy = new Date();
                    var dd = hoy.getDate();
                    var mm = hoy.getMonth() + 1;
                    var yyyy = hoy.getFullYear();
                    var datos = {
                        dateSolicitud: yyyy + "-" + mm + "-" + dd,
                        idDepSolicitud: id
                    };
                    $.ajax({
                        url: 'view/modulos/ajax.php',
                        method: 'post',
                        data: datos,
                        dataType: "text",

                        success: function (respuesta) {
                            if (respuesta.trim() === "false") {
                                $('#horariosOcultos').css('display', 'none');
                                $('#MensajeErrorHorario').html("No hay Horarios Disponibles para la fecha seleccionada");
                                $('#MensajeErrorHorario').css('color', 'red');
                            } else {
                                $('#MensajeErrorHorario').css('color', 'black');
                                $('#MensajeErrorHorario').html("Horarios para el día seleccionado:");
                                $('#horariosOcultos').html(respuesta);
                                $('#horariosOcultos').css('display', 'block');

                                //SOLICITAR TURNO
                                $(".solicitarTurno").bind("click", function () {
                                    var f = $(this).attr('id').split("-")[1];
                                    var u = $('#oculto').val();
                                    if (f === u) {
                                        respuestaError("ERROR", "No puede solicitarse turnos usted mismo");
                                    } else {
                                        var datos = {
                                            idSolicitudTurno: $(this).attr('id').split("-")[0],
                                            funcionarioSolicitudTurno: $(this).attr('id').split("-")[1],
                                            usuarioSolicitudTurno: $('#oculto').val()
                                        };
                                        $.ajax({
                                            url: 'view/modulos/ajax.php',
                                            method: 'post',
                                            data: datos,
                                            dataType: "text",

                                            success: function (respuesta) {
                                                if (respuesta.trim() === "error1") {
                                                    respuestaError("ERROR", "Ya solicitó un turno!");
                                                } else {
                                                    exito("Su turno es: #" + respuesta, "\nPor favor capturar imagen de éste mensaje en caso necesitar constancia del turno\n\nTambién hemos enviado un correo eléctrónico con la información.");
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



    //CARGAR MIS CITAS 
    $('#mis_citas').bind("click", function () {
        listarMisCitas();
    });

    function listarMisCitas() {
        var datos = {
            idListarCitas: $('#oculto').val()
        };
        $.ajax({
            url: 'view/modulos/ajax.php',
            method: 'post',
            data: datos,
            dataType: "text",

            success: function (respuesta) {
                if (respuesta.trim() === "false") {
                    $('#mensajesCitasTabla').html("<label style='color:red;'>No tiene citas registradas</label>");
                } else {
                    $('#mensajesCitasTabla').html("<table class='tabla table table-sm'>" +
                        "<thead>" +
                        "<tr>" +
                        "<th scope='col' style='width: 10%;'>Turno</th>" +
                        "<th scope='col' style='width: 20%;'>Hora</th>" +
                        "<th scope='col' style='width: 20%;'>Lugar</th>" +
                        "<th scope='col' style='width: 20%;'>Funcionario</th>" +
                        "<th scope='col' style='width: 10%;'>Estado</th>" +
                        "<th scope='col' style='width: 10%;'>Opciones</th>" +
                        "</tr>" +
                        "</thead>" +
                        "<tbody id='tablaMisCitas'>" +
                        "</tbody>" +
                        "</table> ");
                    document.getElementById("tablaMisCitas").innerHTML = respuesta;
                    //CANCELAR CITA
                    $(".cancelarCita").bind("click", function () {
                        swal({
                            title: "¿Está seguro de cancelar la cita?",
                            text: "",
                            icon: "warning",
                            buttons: ["Cancelar", "Aceptar"],
                            dangerMode: true
                        })
                            .then((willDelete) => {
                                if (willDelete) {
                                    var datos = {
                                        idCancelarCita: $(this).attr('id')
                                    };
                                    $.ajax({
                                        url: 'view/modulos/ajax.php',
                                        method: 'post',
                                        data: datos,
                                        dataType: "json",

                                        success: function (respuesta) {
                                            if (respuesta["exito"]) {
                                                exito("Cita Cancelada", "");
                                                $('#mis_citas').click();
                                            } else if (!respuesta["exito"]) {
                                                respuestaError("Error al cancelar", respuesta["error"]);
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
    }
    ;


});



//VER CONTRASEÑAS
$("#verContraseñas").click(function () {
    var password1, check;

    password1 = document.getElementById("cambiar_Contrasena");
    check = document.getElementById("verContraseñas");

    if (check.checked == true) // Si la checkbox de mostrar contraseña está activada
    {
        password1.type = "text";
    }
    else // Si no está activada
    {
        password1.type = "password";
    }
});


$("#headerContraseña").click(function () {
    document.getElementById("label_cambiarContrasena").innerHTML = "";
});

//CAMBIAR CONTRASEÑA
$("#botonCambiarContrasena").click(function () {
    var clave = $("#cambiar_Contrasena").val();
    var usuario = $('#oculto').val();
    if(clave.length == 0){
        document.getElementById("label_cambiarContrasena").innerHTML = "Ingrese la nueva contraseña";
        document.getElementById('label_cambiarContrasena').style.color='red';
    }else if (clave.length <= 9) {
        document.getElementById('label_cambiarContrasena').style.color='red';
        document.getElementById("label_cambiarContrasena").innerHTML = "La contraseña debe tener mínimo 10 caracteres";
    } else {
        var datos = {
            idUsuarioCambiarContrasena: usuario,
            nuevaContrasena: clave
        };
        $.ajax({
            url: 'view/modulos/ajax.php',
            method: 'post',
            data: datos,
            dataType: "text",
            success: function (respuesta) {
                if (respuesta.trim()==="exito") {
                    document.getElementById("label_cambiarContrasena").innerHTML = "La contraseña se ha cambiado con éxito!";
                    document.getElementById('label_cambiarContrasena').style.color='green';
                    $('#cambiar_Contrasena').val("");
                } else {
                    document.getElementById("label_cambiarContrasena").innerHTML = respuesta;
                    document.getElementById('label_cambiarContrasena').style.color='red';
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
