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
    var telefono = $("#telefono_proveedor").val();
    var email = $("#correo_proveedor").val();
    var sitio_web = $("#sitio_web_proveedor").val();
    var tipo_banco = $("#tipo_banco_proveedor").val();
    var numero_cuenta = $("#numero_cuenta_proveedor").val();



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
    if (id_doc === "" || id_doc == null) {
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

        proveedores.forEach(function (proveedor, index) {
          if (proveedor.tipo_persona == "proveedor") {
            var fila = `
                      <tr>
                          <td>${index + 1}</td>
                          <td>${proveedor.razon_social}</td>
                          <td class="text-center">
                              <span>${proveedor.nombre_doc}:</span><br>
                              <span>${proveedor.numero_documento}</span>
                          </td>
                          <td>${proveedor.direccion}</td>
                          <td>${proveedor.telefono}</td>
                          <td>${proveedor.email}</td>
                          <td>
                              ${proveedor.estado_persona != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idProveedor="' + proveedor.id_persona + '" estadoProveedor="0">Activado</button>' : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idProveedor="' + proveedor.id_persona + '" estadoProveedor="1">Desactivado</button>'}
                          </td>
                          <td class="text-center">
                              <a href="#" class="me-3 btnEditarProveedor" idProveedor="${proveedor.id_persona}" data-bs-toggle="modal" data-bs-target="#modalEditarProveedor">
                                  <i class="text-warning fas fa-edit fa-lg"></i>
                              </a>
                              <a href="#" class="me-3 btnVerProveedor" idProveedor="${proveedor.id_persona}" data-bs-toggle="modal" data-bs-target="#modalVerProveedor">
                                  <i class="text-primary fa fa-eye fa-lg"></i>
                              </a>
                              <a href="#" class="me-3 confirm-text btnEliminarProveedor" idProveedor="${proveedor.id_persona}">
                                  <i class="text-danger fa fa-trash fa-lg"></i>
                              </a>
                          </td>
                      </tr>
                  `;
          }
          tbody.append(fila);
        });

        // Inicializar DataTables después de cargar los datos
        $('#tabla_proveedores').DataTable();
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los proveedores:", error);
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


        $("#edit_id_doc_proveedor").val(respuesta["id_doc"]);


        $("#edit_numero_documento_proveedor").val(respuesta["numero_documento"]);
        $("#edit_direccion_proveedor").val(respuesta["direccion"]);
        $("#edit_ciudad_proveedor").val(respuesta["ciudad"]);
        $("#edit_codigo_postal_proveedor").val(respuesta["codigo_postal"]);
        $("#edit_telefono_proveedor").val(respuesta["telefono"]);
        $("#edit_correo_proveedor").val(respuesta["email"]);
        $("#edit_sitio_web_proveedor").val(respuesta["sitio_web"]);


        $("#edit_tipo_banco_proveedor").val(respuesta["tipo_banco"]);


        $("#edit_numero_cuenta_proveedor").val(respuesta["numero_cuenta"]);

      },
    });
  });



  /*=============================================
  VER PROVEEDOR
  =============================================*/
  $("#tabla_proveedores").on("click", ".btnVerProveedor", function () {

    let idVerProveedor = $(this).attr("idProveedor");

    let datos = new FormData();
    datos.append("idVerProveedor", idVerProveedor);

    $.ajax({
      url: "ajax/Proveedor.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#ver_razon_social_p").text(respuesta["razon_social"]);
        $("#ver_tipo_documento_p").text(respuesta["nombre_doc"]);
        $("#ver_numero_documento_p").text(respuesta["numero_documento"]);
        $("#ver_direccion_p").text(respuesta["direccion"]);
        $("#ver_ciudad_p").text(respuesta["ciudad"]);
        $("#ver_codigo_postal_p").text(respuesta["codigo_postal"]);
        $("#ver_telefono_p").text(respuesta["telefono"]);
        $("#ver_correo_p").text(respuesta["email"]);
        $("#ver_sitio_web_p").attr("href", respuesta["sitio_web"]).text("Visite el sitio web");
        $("#ver_tipo_banco_p").val(respuesta["tipo_banco"]);
        $("#ver_numero_cuenta_p").text(respuesta["numero_cuenta"]);


      },
    });
  });



  /*===========================================
  ACTUALIZAR PROVEEDOR
  =========================================== */
  $("#actualizar_proveedor").click(function (e) {

    e.preventDefault();


    var isValid = true;

    var edit_id_proveedor = $("#edit_id_proveedor").val();
    var edit_razon_social = $("#edit_razon_social_proveedor").val();
    var edit_id_doc = $("#edit_id_doc_proveedor").val();
    var edit_numero_documento = $("#edit_numero_documento_proveedor").val();
    var edit_direccion = $("#edit_direccion_proveedor").val();
    var edit_ciudad = $("#edit_ciudad_proveedor").val();
    var edit_codigo_postal = $("#edit_codigo_postal_proveedor").val();
    var edit_telefono = $("#edit_telefono_proveedor").val();
    var edit_email = $("#edit_correo_proveedor").val();
    var edit_sitio_web = $("#edit_sitio_web_proveedor").val();
    var edit_tipo_banco = $("#edit_tipo_banco_proveedor").val();
    var edit_numero_cuenta = $("#edit_numero_cuenta_proveedor").val();


    // Validar el nombre de usuario
    if (edit_razon_social === "") {
      $("#edit_error_rz")
        .html("Por favor, ingrese la razón social")
        .addClass("text-danger");
      isValid = false;
    } else if (!isNaN(edit_razon_social)) {
      $("#edit_error_rz")
        .html("La razón social no puede contener números")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_rz").html("").removeClass("text-danger");
    }

    // Validar el nombre de usuario
    if (edit_id_doc === "" || edit_id_doc == null) {
      $("#edit_error_id_doc")
        .html("Por favor, selecione el tipo de documento")
        .addClass("text-danger");
      isValid = false;
    } else if (isNaN(edit_id_doc)) {
      $("#edit_error_id_doc")
        .html("El tipo de documento solo puede contener números")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_id_doc").html("").removeClass("text-danger");
    }



    // Validar el número de documento
    if (edit_numero_documento === "") {
      $("#edit_error_nd")
        .html("Por favor, ingrese el número de documento")
        .addClass("text-danger");
      isValid = false;
    } else if (!/^\d{1,11}$/.test(edit_numero_documento)) {
      $("#edit_error_nd")
        .html("El número de documento debe contener solo 11 dígitos")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_nd").html("").removeClass("text-danger");
    }



    // Validar el teléfono
    if (edit_telefono === "") {
      $("#edit_error_t")
        .html("Por favor, ingrese el teléfono")
        .addClass("text-danger");
      isValid = false;
    } else if (!(/^\d{1,11}$/.test(edit_telefono))) {
      $("#edit_error_t")
        .html("El teléfono debe contener solo números y tener un máximo de 11 dígitos")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_t").html("").removeClass("text-danger");
    }

    //Validar el correo electrónico
    if (edit_email === "") {
      $("#edit_error_c")
        .html("Por favor, ingrese el correo electrónico")
        .addClass("text-danger");
      isValid = false;
    } else if (!/^[\w-\.]+@([\w-]+\.)+[\w-]{2,4}$/.test(edit_email)) {
      $("#edit_error_c")
        .html("Por favor, ingrese un correo electrónico válido")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_c").html("").removeClass("text-danger");
    }


    if (isValid) {
      var datos = new FormData();
      datos.append("edit_id_proveedor", edit_id_proveedor);
      datos.append("edit_razon_social", edit_razon_social);
      datos.append("edit_id_doc", edit_id_doc);
      datos.append("edit_numero_documento", edit_numero_documento);
      datos.append("edit_direccion", edit_direccion);
      datos.append("edit_ciudad", edit_ciudad);
      datos.append("edit_codigo_postal", edit_codigo_postal);
      datos.append("edit_telefono", edit_telefono);
      datos.append("edit_email", edit_email);
      datos.append("edit_sitio_web", edit_sitio_web);
      datos.append("edit_tipo_banco", edit_tipo_banco);
      datos.append("edit_numero_cuenta", edit_numero_cuenta);

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
            $("#formEditProveedor")[0].reset();

            $("#modalEditarProveedor").modal("hide");
            Swal.fire({
              title: "¡Correcto!",
              text: "El proveedor ha sido actualizado",
              icon: "success",
            });
            mostrarProveedores();
          } else {
            console.error("Error al cargar los datos.");
          }
        }
      });
    }
  });

  /*=============================================
    ELIMINAR PROVEEDOR
    =============================================*/
  $("#tabla_proveedores").on("click", ".btnEliminarProveedor", function (e) {

    e.preventDefault();

    var deleteIdProveedor = $(this).attr("idProveedor");

    var datos = new FormData();
    datos.append("deleteIdProveedor", deleteIdProveedor);

    Swal.fire({
      title: "¿Está seguro de borrar el proveedor?",
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#0084FF",
      cancelButtonColor: "#F1666D",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
    }).then(function (result) {
      if (result.value) {
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

              Swal.fire({
                title: "¡Eliminado!",
                text: "El proveedor ha sido eliminado",
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



  /* =========================================
  MOSTRANDO REPORTE DE PROVEEDORES
  ============================================ */

  function mostrarReporteProveedores() {
    $.ajax({
      url: "ajax/Proveedor.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (proveedores) {

        var tbody = $("#dataReporteProveedro");

        tbody.empty();

        let contador = 1;

        proveedores.forEach(function (proveedor) {

          var fila = `
                <tr>
                    <td>
                        ${contador}
                    </td>
                    <td>${proveedor.razon_social}</td>
                    <td>
                        <span>${proveedor.nombre_doc}: </span>
                        <span>${proveedor.numero_documento}</span>
                    </td>
                    <td>
                        <span>${proveedor.telefono} </span>
                    </td>
                    <td>
                        <span>${proveedor.email} </span>
                    </td>
                    <td>
                        ${proveedor.estado_persona != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idUsuario="' + proveedor.id_persona + '" estadoUsuario="0">Activado</button>'
                                              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idUsuario="' + proveedor.id_persona + '" estadoUsuario="1">Desactivado</button>'
                         }
                    </td>
                    
                </tr>`;


          // Agregar la fila al tbody

          tbody.append(fila);

          contador++;

        });

        // Inicializar DataTables después de cargar los datos
        
        $('#tabla_reporte_proveedor').DataTable();

      },
      error: function (xhr, status, error) {

        console.error("Error al recuperar los usuarios:", error);

      },
    });
  }

  mostrarReporteProveedores();


  /*=============================================
  DESCARGAR REPORTE DE PROVEEDORES
  =============================================*/

  $("#btn_descargar_reporte_proveedor").click(function (e) {


    e.preventDefault();

    var idProveedor = $(this).attr("idVenta");

    window.open("extensiones/reportes/reporte.proveedor.php?idProveedor=" + idProveedor, "_blank");

  });

});
