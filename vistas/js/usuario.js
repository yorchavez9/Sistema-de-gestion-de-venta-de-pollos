$(document).ready(function () {
  /* VISTA PREVIA DE NUEVO IMAGEN USUARIO */
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
      isValid = false; // Cambia isValid a falso si hay un campo vacío
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
          console.log(respuesta);
        },
      });
    }

  });
});
