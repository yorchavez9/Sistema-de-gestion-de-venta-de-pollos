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
  VISTA PREVIA DE LA IMAGEN DEL USUARIO
  ===================================== */
  $("#edit_imagen_usuario").change(function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $(".editVistaPreviaImagenUsuario").attr("src", e.target.result);

        $(".editVistaPreviaImagenUsuario").show();
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

    } else {
      alert("Por favor, seleccione una imagen.");
    }
  });

  /* ===========================================
  GUARDAR USUARIO
  =========================================== */
  $("#guardar_usuario").click(function () {

    var isValid = true;

    var nombre = $("#nombre_usuario").val();
    var tipoDocumento = $("#id_doc").val();
    var numeroDocumento = $("#numero_documento").val();
    var direccion = $("#direccion").val();
    var telefono = $("#telefono").val();
    var correo = $("#correo").val();
    var usuario = $("#usuario").val();
    var contrasena = $("#contrasena").val();
    var imagen = $("#imagen_usuario").get(0).files[0];

    var roles = [];

    $('.data_rol:checked').each(function () {
      roles.push($(this).val());
    });

    var data_roles = JSON.stringify(roles);


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
      datos.append("data_roles", data_roles);

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
  MOSTRANDO USUARIOS
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
                            <img src="${usuario.imagen_usuario}" alt="${usuario.nombre_usuario}">
                        </a>
                    </td>
                    <td>${usuario.nombre_usuario}</td>
                    <td>${usuario.usuario}</td>
                    <td>
                        <span>${usuario.nombre_doc}: </span>
                        <span>${usuario.numero_documento}</span>
                    </td>
                    <td>${usuario.direccion}</td>
                    <td>${usuario.telefono}</td>
                    <td>${usuario.correo}</td>

                    <td>
                        ${usuario.estado != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idUsuario="' + usuario.id_usuario + '" estadoUsuario="0">Activado</button>'
              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idUsuario="' + usuario.id_usuario + '" estadoUsuario="1">Desactivado</button>'
            }
                    </td>
                    
                    <td>
                        <a href="#" class="me-3 btnEditarUsuario" idUsuario="${usuario.id_usuario}" data-bs-toggle="modal" data-bs-target="#modalEditarUsuario">
                            <i class="text-warning fas fa-edit fa-lg"></i>
                        </a>
                        <a href="#" class="me-3 btnVerUsuario" idUsuario="${usuario.id_usuario}" data-bs-toggle="modal" data-bs-target="#modalVerUsuario">
                            <i class="text-primary fa fa-eye fa-lg"></i>
                        </a>
                        <a href="#" class="me-3 confirm-text btnEliminarUsuario" idUsuario="${usuario.id_usuario}" fotoUsuario="${usuario.imagen_usuario}">
                            <i class="fa fa-trash fa-lg" style="color: #F52E2F"></i>
                        </a>
                    </td>
                </tr>`;


          // Agregar la fila al tbody
          tbody.append(fila);
          
        });

        // Inicializar DataTables después de cargar los datos
        $('#tabla_usuarios').DataTable();
        
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error);
      },
    });
  }

  /*=============================================
  ACTIVAR USUARIO
  =============================================*/
  $("#tabla_usuarios").on("click", ".btnActivar", function () {

    var idUsuario = $(this).attr("idUsuario");
    var estadoUsuario = $(this).attr("estadoUsuario");

    var datos = new FormData();
    datos.append("activarId", idUsuario);
    datos.append("activarUsuario", estadoUsuario);

    $.ajax({

      url: "ajax/Usuario.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {

        if (window.matchMedia("(max-width:767px)").matches) {

          swal({
            title: "El usuario ha sido actualizado",
            type: "success",
            confirmButtonText: "¡Cerrar!"
          }).then(function (result) {
            if (result.value) {

              window.location = "usuarios";

            }


          });

        }

      }

    })

    if (estadoUsuario == 0) {
      $(this)
        .removeClass("bg-lightgreen")
        .addClass("bg-lightred")
        .html("Desactivado");
      $(this).attr("estadoUsuario", 1);
    } else {
      $(this)
        .removeClass("bg-lightred")
        .addClass("bg-lightgreen")
        .html("Activado");
      $(this).attr("estadoUsuario", 0);
    }

  })

  /*=============================================
  EDITAR EL USUARIO
  =============================================*/
  $("#tabla_usuarios").on("click", ".btnEditarUsuario", function () {
    var idUsuario = $(this).attr("idUsuario");

    var datos = new FormData();
    datos.append("idUsuario", idUsuario);

    $.ajax({
      url: "ajax/Usuario.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#editIdUsuario").val(respuesta["id_usuario"]);
        $("#edit_nombre_usuario").val(respuesta["nombre_usuario"]);

        $("#edit_id_doc").append(
          '<option value="' +
          respuesta["id_doc"] +
          '" selected>' +
          respuesta["nombre_doc"] +
          "</option>"
        );

        $("#edit_numero_documento").val(respuesta["numero_documento"]);
        $("#edit_direccion").val(respuesta["direccion"]);
        $("#edit_telefono").val(respuesta["telefono"]);
        $("#edit_correo").val(respuesta["correo"]);
        $("#edit_usuario").val(respuesta["usuario"]);
        $("#passwordActual").val(respuesta["contrasena"]);

        var imagenUsuario = respuesta["imagen_usuario"].substring(3);

        if (respuesta["imagen_usuario"] != "") {
          $(".editVistaPreviaImagenUsuario").attr("src", imagenUsuario);
        } else {
          $(".editVistaPreviaImagenUsuario").attr(
            "src",
            "vistas/img/usuarios/default/anonymous.png"
          );
        }

        $("#imagenActualUsuario").val(respuesta["imagen_usuario"]);

        var data_roles = JSON.parse(respuesta["roles"])

        data_roles.forEach(function (rol) {
          // Concatena "edit_rol_" con el nombre del rol para obtener el ID del checkbox
          var checkboxId = "edit_rol_" + rol;
          // Busca el checkbox por su ID y márcalo
          document.getElementById(checkboxId).checked = true;
        });

      },
    });
  });

  /*=============================================
  MOSTRAR DETALLE DEL USUARIO
  =============================================*/
  $("#tabla_usuarios").on("click", ".btnVerUsuario", function () {

    var idUsuarioVer = $(this).attr("idUsuario");


    var datos = new FormData();
    datos.append("idUsuarioVer", idUsuarioVer);

    $.ajax({
      url: "ajax/Usuario.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $("#mostrar_nombre_usuario").text(respuesta["nombre_usuario"]);
        $("#mostrar_tipo_documento").text(respuesta["nombre_doc"]);
        $("#mostrar_numero_documento_usuario").text(respuesta["numero_documento"]);
        $("#mostrar_direccion_usuario").text(respuesta["direccion"]);
        $("#mostrar_telefono_usuario").text(respuesta["telefono"]);
        $("#mostrar_correo_usuario").text(respuesta["correo"]);
        $("#mostrar_usuario").text(respuesta["usuario"]);

        var imagenUsuario = respuesta["imagen_usuario"].substring(3);

        if (respuesta["imagen_usuario"] != "") {
          $(".mostrarFotoUsuario").attr("src", imagenUsuario);
        } else {
          $(".mostrarFotoUsuario").attr(
            "src",
            "vistas/img/usuarios/default/anonymous.png"
          );
        }

        var data_roles = JSON.parse(respuesta["roles"])

        var rolesContainer = document.getElementById("mostrar_roles");

        data_roles.forEach(role => {
          var roleSpan = document.createElement("span");
          roleSpan.textContent = role;
          roleSpan.classList.add("badge", "bg-primary", "me-2"); // Añade clases de Bootstrap para hacer que los roles se vean como insignias coloridas
          rolesContainer.appendChild(roleSpan);
        });

      },
    });
  });

  /*===========================================
  ACTUALIZAR EL USUARIO
  =========================================== */
  $("#actualizar_usuario").click(function (e) {
    e.preventDefault();

    var isValid = true;

    var edit_idUsuario = $("#editIdUsuario").val();
    var edit_nombre = $("#edit_nombre_usuario").val();
    var edit_tipoDocumento = $("#edit_id_doc").val();
    var edit_numeroDocumento = $("#edit_numero_documento").val();
    var edit_direccion = $("#edit_direccion").val();
    var edit_telefono = $("#edit_telefono").val();
    var edit_correo = $("#edit_correo").val();
    var edit_usuario = $("#edit_usuario").val();

    var edit_contrasena = $("#edit_contrasena").val();
    var edit_actualContrasena = $("#passwordActual").val();

    var edit_imagen = $("#edit_imagen_usuario").get(0).files[0];
    var edit_imagenActualUsuario = $("#imagenActualUsuario").val();

    var roles = [];

    $('.edit_data_rol:checked').each(function () {
      roles.push($(this).val());
    });

    var data_roles = JSON.stringify(roles);



    // Validar el nombre de usuario
    if (edit_nombre == "") {
      $("#editerrorNombreUsuario")
        .html("Por favor, ingrese el nombre completo")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#editerrorNombreUsuario").html("").removeClass("text-danger");
    }

    // Validar el tipo de documento
    if (edit_tipoDocumento == null) {
      $("#editerrorTipoDocumento")
        .html("Por favor, seleccione el tipo de documento")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#editerrorTipoDocumento").html("").removeClass("text-danger");
    }

    // Validar el número de documento
    if (edit_numeroDocumento == "") {
      $("#errorNumeroDocumento")
        .html("Por favor, ingrese el número de documento")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#errorNumeroDocumento").html("").removeClass("text-danger");
    }

    // Validar la dirección
    if (edit_direccion == "") {
      $("#editerrorDireccionUsuario")
        .html("Por favor, ingrese la dirección")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#editerrorDireccionUsuario").html("").removeClass("text-danger");
    }

    // Validar el teléfono
    if (edit_telefono == "") {
      $("#editerrorTelefonoUsuario")
        .html("Por favor, ingrese el teléfono")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#editerrorTelefonoUsuario").html("").removeClass("text-danger");
    }

    // Validar el correo electrónico
    if (edit_correo == "") {
      $("#editerrorCorreoUsuario")
        .html("Por favor, ingrese el correo electrónico")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#editerrorCorreoUsuario").html("").removeClass("text-danger");
    }

    // Validar el usuario
    if (edit_usuario == "") {
      $("#editerrorUsuario")
        .html("Por favor, ingrese el usuario")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#editerrorUsuario").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
    if (isValid) {
      var datos = new FormData();
      datos.append("edit_idUsuario", edit_idUsuario);
      datos.append("edit_nombre", edit_nombre);
      datos.append("edit_tipoDocumento", edit_tipoDocumento);
      datos.append("edit_numeroDocumento", edit_numeroDocumento);
      datos.append("edit_direccion", edit_direccion);
      datos.append("edit_telefono", edit_telefono);
      datos.append("edit_correo", edit_correo);
      datos.append("edit_usuario", edit_usuario);
      datos.append("edit_contrasena", edit_contrasena);
      datos.append("edit_actualContrasena", edit_actualContrasena);
      datos.append("edit_imagen", edit_imagen);
      datos.append("edit_imagenActualUsuario", edit_imagenActualUsuario);
      datos.append("data_roles", data_roles);

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
            $("#formEditUsuario")[0].reset();
            $(".editVistaPreviaImagenUsuario").attr("src", "");
            $("#modalEditarUsuario").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El usuario ha sido actualizado con éxito",
              icon: "success",
            });

            mostrarUsuarios();
          } else {
            console.error("Error al actualizar los datos");
          }
        },
      });
    }
  });

  /*=============================================
    ELIMINAR USUARIO
    =============================================*/
  $("#tabla_usuarios").on("click", ".btnEliminarUsuario", function (e) {

    e.preventDefault();

    var deleteUserId = $(this).attr("idUsuario");
    var deletefotoUser = $(this).attr("fotoUsuario");
    var deleteRutaUser = "../" + deletefotoUser;


    var datos = new FormData();
    datos.append("deleteUserId", deleteUserId);
    datos.append("deleteRutaUser", deleteRutaUser);

    Swal.fire({
      title: "¿Está seguro de borrar el usuario?",
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
    }).then(function (result) {
      if (result.value) {
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

              Swal.fire({
                title: "¡Eliminado!",
                text: "El usuario ha sido eliminado",
                icon: "success",
              });

              mostrarUsuarios();

            } else {

              console.error("Error al eliminar los datos");

            }
          }
        });

      }
    });
  }
  );

  /*   ==========================================
    LIMPIAR MODALES
    ========================================== */

  $(".btn_modal_ver_close_usuario").click(function () {

    $("#mostrar_roles").text('');
  });

  $(".btn_modal_editar_close_usuario").click(function () {

    $("#formEditUsuario")[0].reset();
  });

  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarUsuarios();

  /* ===========================
  MOSTRANDO REPORTE USUARIO
  =========================== */

  function mostrarReporteUsuarios() {
    $.ajax({
      url: "ajax/Usuario.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (usuarios) {

        var tbody = $("#dataReporteUsuarios");

        tbody.empty();

        usuarios.forEach(function (usuario) {

          usuario.imagen_usuario = usuario.imagen_usuario.substring(3);

          var fila = `
                <tr>
                    <td>
                        <a href="javascript:void(0);" class="product-img">
                            <img src="${usuario.imagen_usuario}" alt="${usuario.nombre_usuario}">
                        </a>
                    </td>
                    <td>${usuario.nombre_usuario}</td>
                    <td>${usuario.usuario}</td>
                    <td>
                        <span>${usuario.nombre_doc}: </span>
                        <span>${usuario.numero_documento}</span>
                    </td>
                    <td>${usuario.direccion}</td>
                    <td>${usuario.telefono}</td>
                    <td>${usuario.correo}</td>

                    <td>
                        ${usuario.estado != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idUsuario="' + usuario.id_usuario + '" estadoUsuario="0">Activado</button>'
              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idUsuario="' + usuario.id_usuario + '" estadoUsuario="1">Desactivado</button>'
            }
                    </td>
                    
                </tr>`;


          // Agregar la fila al tbody

          tbody.append(fila);

        });

        // Inicializar DataTables después de cargar los datos
        
        $('#tabla_reporte_usuarios').DataTable();

      },
      error: function (xhr, status, error) {

        console.error("Error al recuperar los usuarios:", error);

      },
    });
  }

  mostrarReporteUsuarios();


  /*=============================================
  DESCARGAR REPORTE DE USUARIO
  =============================================*/

  $("#btn_descargar_reporte_usuario").click(function (e) {

    e.preventDefault();

    var idVentaTicket = $(this).attr("idVenta");

    window.open("extensiones/reportes/reporte.usuario.php?idVentaTicket=" + idVentaTicket, "_blank");

  });


});
