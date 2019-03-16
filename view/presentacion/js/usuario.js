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
            },
            error: function (jqXHR, estado, error) {
                console.log(estado);
                console.log(error);
                console.log(jqXHR);
            }
        });
    }
    ;


    //VER HORARIOS DE CITAS 
    $("#botonBuscarHorarios").bind("click", function () {
        $("#FormSolicitudModal").validate({
            rules: {
                dateSolicitud: {required: true}
            },
            messages:
                    {
                        dateSolicitud: "<span style='color:red'> ✘ </span>"
                    },

            submitHandler: function (form) {

                var datos = {
                    dateSolicitud: $("#dateSolicitud").val(),
                    idDepSolicitud: id
                };
                $.ajax({
                    url: 'view/modulos/ajax.php',
                    method: 'post',
                    data: datos,
                    dataType: "text",

                    success: function (respuesta)
                    {
                        if (respuesta === "false") {
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

                                    success: function (respuesta)
                                    {
                                        if (respuesta === "error1") {
                                            respuestaError("ERROR", "Ya solicitó un turno!");
                                        } else {
                                            exito("Su turno es: #" + respuesta, "\nPor favor capturar imagen de éste mensaje en caso necesitar constancia del turno");
                                        }

                                    },
                                    error: function (jqXHR, estado, error) {
                                        console.log(estado);
                                        console.log(error);
                                        console.log(jqXHR);
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
        });
    });

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

            success: function (respuesta)
            {
                if (respuesta === "false") {
                    $('#mensajesCitasTabla').html("<label style='color:red;'>No tiene citas registradas</label>");
                } else {
                    $('#mensajesCitasTabla').html("<table class='tabla table table-sm'>"+
                                                        "<thead>"+
                                                            "<tr>"+
                                                                "<th scope='col' style='width: 10%;'>Turno</th>"+
                                                                "<th scope='col' style='width: 20%;'>Hora</th>"+
                                                                "<th scope='col' style='width: 20%;'>Lugar</th>"+
                                                                "<th scope='col' style='width: 10%;'>Estado</th>"+
                                                                "<th scope='col' style='width: 10%;'>Opciones</th>"+
                                                            "</tr>"+
                                                        "</thead>"+
                                                        "<tbody id='tablaMisCitas'>"+
                                                        "</tbody>"+
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

                                            success: function (respuesta)
                                            {
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