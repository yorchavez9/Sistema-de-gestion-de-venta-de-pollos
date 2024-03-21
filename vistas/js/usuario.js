$(document).ready(function () {
  /* =====================================
  VISTA PREVIA DE LA IMAGEN DEL USUARIO
  ===================================== */
  $("#imagen_usuario").change(function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $(".vistaPreviaImagenUsuario").attr("src", e.target.result);

        $(".vistaPreviaImagenUsuario").show();
      };

      reader.readAsDataURL(file);
    }
  });

  /* =====================================
   VALIDANDO IMAGEN DEL USUARIO
   ===================================== */
  $("#imagen_usuario").change(function () {
    var imagen = $(this).get(0).files[0];

    if (imagen) {
      var maxSize = 5 * 1024 * 1024;

      if (imagen.size > maxSize) {
        Swal.fire({
          title: "¡Error!",
          text: "El tamaño de la imagen es demasiado grande. Por favor, seleccione una imagen más pequeña.",
          icon: "error",
        });

        $(this).val("");

        return;
      }

      var allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/jpg"];

      if (allowedTypes.indexOf(imagen.type) === -1) {
        Swal.fire({
          title: "¡Error!",
          text: "El tipo de archivo seleccionado no es válido. Por favor, seleccione una imagen en formato JPEG, PNG, GIF o JPG.",
          icon: "error",
        });

        $(this).val("");

        return;
      }

      enviarImagenAlServidor(imagen);
    } else {
      alert("Por favor, seleccione una imagen.");
    }
  });

  /*   ===========================================
  GUARDAR DATOS DEL USUARIO
  =========================================== */
  $("#guardar_usuario").click(function () {
    var isValid = true;

    var nombre = $("#nombre_usuario").val();
    var tipoDocumento = $(".select").val();
    var numeroDocumento = $("#numero_documento").val();
    var direccion = $("#direccion").val();
    var telefono = $("#telefono").val();
    var correo = $("#correo").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var imagen = $("#imagen_usuario").get(0).files[0];

    // Validar el nombre de usuario
    if (nombre == "") {
      $("#errorNombreUsuario")
        .html("Por favor, ingrese el nombre completo")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#errorNombreUsuario").html("").removeClass("text-danger");
    }

    // Validar el tipo de documento
    if (tipoDocumento == null) {
      $("#errorTipoDocumento")
        .html("Por favor, seleccione el tipo de documento")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorTipoDocumento").html("").removeClass("text-danger");
    }

    // Validar el número de documento
    if (numeroDocumento == "") {
      $("#errorNumeroDocumento")
        .html("Por favor, ingrese el número de documento")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorNumeroDocumento").html("").removeClass("text-danger");
    }

    // Validar la dirección
    if (direccion == "") {
      $("#errorDireccionUsuario")
        .html("Por favor, ingrese la dirección")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorDireccionUsuario").html("").removeClass("text-danger");
    }

    // Validar el teléfono
    if (telefono == "") {
      $("#errorTelefonoUsuario")
        .html("Por favor, ingrese el teléfono")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorTelefonoUsuario").html("").removeClass("text-danger");
    }

    // Validar el correo electrónico
    if (correo == "") {
      $("#errorCorreoUsuario")
        .html("Por favor, ingrese el correo electrónico")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorCorreoUsuario").html("").removeClass("text-danger");
    }

    // Validar el usuario
    if (usuario == "") {
      $("#errorUsuario")
        .html("Por favor, ingrese el usuario")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorUsuario").html("").removeClass("text-danger");
    }

    // Validar la contraseña
    if (contrasena == "") {
      $("#errorContrasena")
        .html("Por favor, ingrese la contraseña")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorContrasena").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
    if (isValid) {
      var datos = new FormData();
      datos.append("nombre", nombre);
      datos.append("tipoDocumento", tipoDocumento);
      datos.append("numeroDocumento", numeroDocumento);
      datos.append("direccion", direccion);
      datos.append("telefono", telefono);
      datos.append("correo", correo);
      datos.append("usuario", usuario);
      datos.append("contrasena", contrasena);
      datos.append("imagen", imagen);

      $.ajax({
        url: "ajax/Usuario.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          var res = JSON.parse(respuesta);

          if (res === "ok") {
            $("#nuevoUsuario")[0].reset();
            $(".vistaPreviaImagenUsuario").attr("src", "");
            $("#modalNuevoUsuario").modal("hide");
            Swal.fire({
              title: "¡Correcto!",
              text: "El usuario ha sido guardado",
              icon: "success",
            });
            mostrarUsuarios();
          } else {
            console.error("La carga y guardado de la imagen ha fallado.");
          }
        },
      });
    }
  });

  /* ===========================
  MOSTRANDO DATOS DEL USUARIO
  =========================== */

  function mostrarUsuarios() {
    $.ajax({
      url: "ajax/Usuario.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (usuarios) {

        var tbody = $("#dataUsuarios");


        tbody.empty();


        usuarios.forEach(function (usuario) {
          
          usuario.imagen_usuario = usuario.imagen_usuario.substring(3);
          var fila = `
                    <tr>
                        <td>
                            <a href="javascript:void(0);" class="product-img">
                                <img src="${usuario.imagen_usuario}" alt="product">
                            </a>
                        </td>
                        <td class="productimgname">${usuario.nombre_usuario}</td>
                        <td>${usuario.id_doc}${usuario.numero_documento}</td>
                        <td>${usuario.direccion}</td>
                        <td>${usuario.telefono}</td>
                        <td>${usuario.correo}</td>
                        <td>${usuario.usuario}</td>
                        <td>
                            ${usuario.estado != 0 ? '<button class="btn btn-success btn-sm rounded btnActivar" idUsuario="' + usuario.id_usuario + '" estadoUsuario="0">Activado</button>' : '<button class="btn btn-danger btn-sm rounded btnActivar" idUsuario="' + usuario.id_usuario + '" estadoUsuario="1">Desactivado</button>'}
                        </td>
                        <td>
                            <a class="me-3" href="edituser.html">
                                <img src="vistas/dist/assets/img/icons/edit.svg" alt="img">
                            </a>
                            <a class="me-3 confirm-text" href="javascript:void(0);">
                                <img src="vistas/dist/assets/img/icons/delete.svg" alt="img">
                            </a>
                        </td>
                    </tr>
                `;



          // Agregar la fila al tbody
          tbody.append(fila);
        });
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error);
      },
    });
  }
  mostrarUsuarios();


 /*=============================================
ACTIVAR USUARIO
=============================================*/
$("#tabla_usuarios").on("click", ".btnActivar", function(){

	var idUsuario = $(this).attr("idUsuario");
	var estadoUsuario = $(this).attr("estadoUsuario");

	var datos = new FormData();
 	datos.append("activarId", idUsuario);
  	datos.append("activarUsuario", estadoUsuario);

  	$.ajax({

	  url:"ajax/Usuario.ajax.php",
	  method: "POST",
	  data: datos,
	  cache: false,
      contentType: false,
      processData: false,
      success: function(respuesta){

      		if(window.matchMedia("(max-width:767px)").matches){

	      		 swal({
			      title: "El usuario ha sido actualizado",
			      type: "success",
			      confirmButtonText: "¡Cerrar!"
			    }).then(function(result) {
			        if (result.value) {

			        	window.location = "usuarios";

			        }


				});

	      	}

      }

  	})

  	if(estadoUsuario == 0){

  		$(this).removeClass('btn-success');
  		$(this).addClass('btn-danger');
  		$(this).html('Desactivado');
  		$(this).attr('estadoUsuario',1);

  	}else{

  		$(this).addClass('btn-success');
  		$(this).removeClass('btn-danger');
  		$(this).html('Activado');
  		$(this).attr('estadoUsuario',0);

  	}

})
});
