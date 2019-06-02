$(document).ready(function () {
	if ($('#vista_login').is(':visible')) {
		$("#footer").hide();
		$("#header").hide();

		//INICIO DE SESION
		$("#FormLogin").validate({
			rules: {
				ingresarUsuario: { required: true, number: true },
				ingresarContraseña: { required: true },
				ingresarTipo: {
					required: true
				}
			},
			messages:
			{
				ingresarUsuario: { required: "<span style='color:red'> ✘ </span>", number: "<span style='color:red'> ✘ </span>" },
				ingresarContraseña: "<span style='color:red'> ✘ </span>",
				ingresarTipo: {
					required: "<span style='color:red'> ✘ </span>"
				}
			},


			submitHandler: function (form) {

				var datos = {
					ingresarUsuario: $("#ingresarUsuario").val(),
					ingresarContraseña: $("#ingresarContraseña").val(),
					ingresarTipo: $("select[name=ingresarTipo]").val()
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
							ingresoExitoso("Iniciaste Sesión", "Bienvenido a nuestra Aplicación");
						} else {
							respuestaError("Error al Iniciar", "Revisa el Usuario, la Contraseña y el Tipo de Usuario");
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

		//REGISTRO DE USUARIO
		$("#botonRegistroUsuario").click(function () {
			$("#formRegistrarme").validate({
				rules: {
					registroDocumento: { required: true, number: true },
					registroNombre: { required: true },
					registroTelefono: { required: true, number: true },
					registroCorreo: { required: true, email: true },
					registroClave: { required: true }
				},
				messages:
				{
					registroDocumento: { required: "<span style='color:red'> ✘ </span>", number: "<span style='color:red'> ✘ </span>" },
					registroNombre: "<span style='color:red'> ✘ </span>",
					registroTelefono: { required: "<span style='color:red'> ✘ </span>", number: "<span style='color:red'> ✘ </span>" },
					registroCorreo: "<span style='color:red'> ✘ </span>",
					registroClave: "<span style='color:red'> ✘ </span>"
				},

				submitHandler: function (form) {
					var clave = $("#registroClave").val();
					if(clave.length == 0){
						document.getElementById("label_cambiarContrasena").innerHTML = "Ingrese la nueva contraseña";
					}else if (clave.length <= 9) {
						document.getElementById("label_registro_Usuario").innerHTML = "La contraseña debe tener mínimo 10 caracteres";
					} else {

						var datos = {
							registroDocumento: $("#registroDocumento").val(),
							registroNombre: $("#registroNombre").val(),
							registroTelefono: $("#registroTelefono").val(),
							registroCorreo: $("#registroCorreo").val(),
							registroClave: $("#registroClave").val()
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
									ingresoExitoso("Registro Exitoso", "");
								} else {
									respuestaError("Error al Registrar", "Revisa los datos ingresados");
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
			});
		});

	};


	$("#botonRecordarContrasena").click(function () {
		$("#formRecordarContrasena").validate({
			rules: {
				recordar_Documento: { required: true, number: true }
			},
			messages:
			{
				recordar_Documento: { required: "<span style='color:red'> ✘ </span>", number: "<span style='color:red'> ✘ </span>" }
			},


			submitHandler: function (form) {

				var datos = {
					recordar_Documento: $("#recordar_Documento").val()
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
							exito("Se ha enviado un correo electrónico con su información.", "");
						} else {
							respuestaError("El usuario ingresado no se encuentra registrado.");
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


	if ($('#vista_inicio').is(':visible')) {
		$("#footer").show();
		$("#header").show();
	};

	if ($('#vista_error').is(':visible')) {
		$("#footer").hide();
		$("#header").hide();
	};
});