$(document).ready(function () {

  
    /* ===========================================
    GUARDAR USUARIO
    =========================================== */
    $("#guardar_proveedor").click(function (e) {

        e.preventDefault();

      var isValid = true;
  
      var tipo_persona = $("#tipo_persona_proveedor").val();
      var razon_social = $("#razon_social_proveedor").val();
      var id_doc = $("#id_doc_proveedor").val();
      var numero_documento = $("#numero_documento_proveedor").val();
      var direccion = $("#direccion_proveedor").val();
      var ciudad = $("#ciudad_proveedor").val();
      var codigo_postal = $("#codigo_postal_proveedor").val();
      var telefono  = $("#telefono_proveedor").val();
      var email  = $("#correo_proveedor").val();
      var sitio_web  = $("#sitio_web_proveedor").val();
      var tipo_banco  = $("#tipo_banco_proveedor").val();
      var numero_cuenta  = $("#numero_cuenta_proveedor").val();


      
      // Validar el nombre de usuario
      if (razon_social === "") {
        $("#validate_razon_social_proveedor")
          .html("Por favor, ingrese la razón social")
          .addClass("text-danger");
        isValid = false;
      } else if (!isNaN(razon_social)) {
        $("#validate_razon_social_proveedor")
          .html("La razón social no puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#validate_razon_social_proveedor").html("").removeClass("text-danger");
      }
      
      // Validar el nombre de usuario
    if (id_doc === "" || id_doc == null){
      $("#validate_tipo_documento_proveedor")
        .html("Por favor, selecione el tipo de documento")
        .addClass("text-danger");
      isValid = false;
    } else if (isNaN(id_doc)) {
      $("#validate_tipo_documento_proveedor")
        .html("El tipo de documento solo puede contener números")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#validate_tipo_documento_proveedor").html("").removeClass("text-danger");
    }

      
  
    // Validar el número de documento
    if (numero_documento === "") {
        $("#validate_numero_documento_proveedor")
        .html("Por favor, ingrese el número de documento")
        .addClass("text-danger");
        isValid = false;
    } else if (!/^\d{1,11}$/.test(numero_documento)) {
        $("#validate_numero_documento_proveedor")
        .html("El número de documento debe contener solo 11 dígitos")
        .addClass("text-danger");
        isValid = false;
    } else {
        $("#validate_numero_documento_proveedor").html("").removeClass("text-danger");
    }


    // Validar la ciudad
    if (ciudad === "") {
      $("#validate_ciudad_proveedor")
        .html("Por favor, ingrese la ciudad")
        .addClass("text-danger");
      isValid = false;
    } else if (/\d/.test(ciudad)) {
      $("#validate_ciudad_proveedor")
        .html("La ciudad no puede contener números")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#validate_ciudad_proveedor").html("").removeClass("text-danger");
    }
      
  
      // Validar el teléfono
    if (telefono === "") {
      $("#validate_telefono_proveedor")
        .html("Por favor, ingrese el teléfono")
        .addClass("text-danger");
      isValid = false;
    } else if (!(/^\d{1,11}$/.test(telefono))) {
      $("#validate_telefono_proveedor")
        .html("El teléfono debe contener solo números y tener un máximo de 11 dígitos")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#validate_telefono_proveedor").html("").removeClass("text-danger");
    }
  
    //Validar el correo electrónico
    if (email === "") {
      $("#validate_correo_proveedor")
        .html("Por favor, ingrese el correo electrónico")
        .addClass("text-danger");
      isValid = false;
    } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(email)) {
      $("#validate_correo_proveedor")
        .html("Por favor, ingrese un correo electrónico válido")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#validate_correo_proveedor").html("").removeClass("text-danger");
    }
  
      // Si el formulario es válido, envíalo
      if (isValid) {
        var datos = new FormData();
        datos.append("tipo_persona", tipo_persona);
        datos.append("razon_social", razon_social);
        datos.append("id_doc", id_doc);
        datos.append("numero_documento", numero_documento);
        datos.append("direccion", direccion);
        datos.append("ciudad", ciudad);
        datos.append("codigo_postal", codigo_postal);
        datos.append("telefono", telefono);
        datos.append("email", email);
        datos.append("sitio_web", sitio_web);
        datos.append("tipo_banco", tipo_banco);
        datos.append("numero_cuenta", numero_cuenta);
  
        $.ajax({
          url: "ajax/Proveedor.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {
              $("#nuevoProveedor")[0].reset();

              $("#modalNuevoProveedor").modal("hide");
              Swal.fire({
                title: "¡Correcto!",
                text: "El proveedor ha sido guardado",
                icon: "success",
              });
              mostrarProveedores();
            } else {
              console.error("Error al cargar los datos.");
            }
          },
        });
      }
    });
  
    /* ===========================
    MOSTRANDO USUARIOS
    =========================== */
    function mostrarProveedores() {
      $.ajax({
        url: "ajax/Proveedor.ajax.php",
        type: "GET",
        dataType: "json",
        success: function (proveedores) {

          var tbody = $("#dataProveedores");
  
          tbody.empty();
  
          proveedores.forEach(function (proveedores, index) {

            var fila = `
                      <tr>
                          <td>${index++}</td>
                          <td>${proveedores.razon_social}</td>
                          <td class="text-center">
                            <span>${proveedores.nombre_doc}:</span><br>
                            <span>${proveedores.numero_documento}</span>
                          </td>
                          <td>${proveedores.direccion}</td>
                          <td>${proveedores.telefono}</td>
                          <td>${proveedores.email}</td>
                          <td>
                              ${proveedores.estado_persona != 0? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idProveedor="' + proveedores.id_persona + '" estadoProveedor="0">Activado</button>' : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idProveedor="' + proveedores.id_persona + '" estadoProveedor="1">Desactivado</button>'}
                          </td>
                          <td text-center align-middle>
                              <a href="#" class="me-3 btnEditarProveedor" idProveedor="${proveedores.id_persona}" data-bs-toggle="modal" data-bs-target="#modalEditarProveedor">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                              </a>
                              <a href="#" class="me-3 btnVerProveedor" idProveedor="${proveedores.id_usuario}" data-bs-toggle="modal" data-bs-target="#modalVerUsuario">
                                <i class="text-primary fa fa-eye fa-lg"></i>
                              </a>
                              <a href="#" class="me-3 confirm-text btnEliminarUsuario" idProveedor="${proveedores.id_usuario}" fotoUsuario="${proveedores.imagen_usuario}">
                                <i class="text-danger fa fa-trash fa-lg"></i>
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
  
    /*=============================================
    ACTIVAR PROVEEDOR
    =============================================*/
    $("#tabla_proveedores").on("click", ".btnActivar", function () {
      var idProveedor = $(this).attr("idProveedor");
      var estadoProveedor = $(this).attr("estadoProveedor");

      console.log(idProveedor, estadoProveedor);
  
      var datos = new FormData();
      datos.append("activarId", idProveedor);
      datos.append("activarProveedor", estadoProveedor);
  
      $.ajax({
        url: "ajax/Proveedor.ajax.php",
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
              confirmButtonText: "¡Cerrar!",
            }).then(function (result) {
              if (result.value) {
                window.location = "usuarios";
              }
            });
          }
        },
      });
  
      if (estadoProveedor == 0) {
        $(this).removeClass("bg-lightgreen").addClass("bg-lightred").html("Desactivado");
        $(this).attr("estadoProveedor", 1);
    } else {
        $(this).removeClass("bg-lightred").addClass("bg-lightgreen").html("Activado");
        $(this).attr("estadoProveedor", 0);
    }
    });
  
    /*=============================================
    EDITAR EL PROVEEDOR
    =============================================*/
    $("#tabla_proveedores").on("click", ".btnEditarProveedor", function () {

      var idProveedor = $(this).attr("idProveedor");
  
      var datos = new FormData();
      datos.append("idProveedor", idProveedor);
  
      $.ajax({
        url: "ajax/Proveedor.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {

          $("#edit_id_proveedor").val(respuesta["id_persona"]);
          $("#edit_razon_social_proveedor").val(respuesta["razon_social"]);
  
          $("#edit_id_doc_proveedor").append(
            '<option value="' +
              respuesta["id_doc"] +
              '" selected>' +
              respuesta["nombre_doc"] +
              "</option>"
          );
  
          $("#edit_numero_documento_proveedor").val(respuesta["numero_documento"]);
          $("#edit_direccion_proveedor").val(respuesta["direccion"]);
          $("#edit_ciudad_proveedor").val(respuesta["ciudad"]);
          $("#edit_codigo_postal_proveedor").val(respuesta["codigo_postal"]);
          $("#edit_telefono_proveedor").val(respuesta["telefono"]);
          $("#edit_correo_proveedor").val(respuesta["email"]);
          $("#edit_sitio_web_proveedor").val(respuesta["sitio_web"]);


          

          $("#edit_numero_cuenta_proveedor").val(respuesta["numero_cuenta"]);
        },
      });
    });
  
    /*===========================================
    ACTUALIZAR EL USUARIO
    =========================================== */
    $("#actualizar_usuario").click(function (e) {
      e.preventDefault();
  
      var isValid = true;
  
      var edit_idProveedor = $("#editIdProveedor").val();
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
        datos.append("edit_idProveedor", edit_idProveedor);
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
  
        $.ajax({
          url: "ajax/proveedores.ajax.php",
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
  
              mostrarProveedores();
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
    $("#tabla_proveedores").on("click",".btnEliminarUsuario",function (e) {
  
        e.preventDefault();
  
        var deleteUserId = $(this).attr("idProveedor");
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
              url: "ajax/proveedores.ajax.php",
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
      
                  mostrarProveedores();
  
                } else {
  
                  console.error("Error al eliminar los datos");
  
                }
              }
          });
          
          }
        });
      }
    );
  
  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarProveedores();

  });
  