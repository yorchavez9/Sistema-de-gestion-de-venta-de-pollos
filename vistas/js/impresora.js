$(document).ready(function () {


  /* ===========================================
  GUARDAR IMPRESORA
  =========================================== */
  $("#btn_guardar_configuracion_impresora").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var nombre_impresora = $("#nombre_impresora").val();
    var ip_impresora = $("#ip_impresora").val();


    // Validar el nombre de categoríua
    if (nombre_impresora === "") {

      $("#error_nombre_impresora").html("Por favor, ingrese el nombre").addClass("text-danger");

      isValid = false;

    } else if (!isNaN(nombre_impresora)) {

      $("#error_nombre_impresora").html("El nombre no puede contener números").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_nombre_impresora").html("").removeClass("text-danger");

    }



    // Si el formulario es válido, envíalo
    if (isValid) {

      var datos = new FormData();

      datos.append("nombre_impresora", nombre_impresora);
      datos.append("ip_impresora", ip_impresora);


      $.ajax({
        url: "ajax/Impresora.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_nuevo_configuracion_impresora")[0].reset();

            $("#modalNuevoConfiguracionImpresora").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "La configuración ha sido guardado",
              icon: "success",
            });

            mostrarImpresora();

          } else {
            console.error("Error al cargar los datos.");
          }
        },
      });
    }
  });

  /* ===========================
  MOSTRANDO IMPRESORA
  =========================== */
  function mostrarImpresora() {

    $.ajax({
      url: "ajax/Impresora.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (impresoras) {

        let tbody = $("#data_configuracion_impresora");

        tbody.empty();

        impresoras.forEach(function (impresora, index) {

          var fila = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${impresora.nombre}</td>
                        <td>${impresora.ip_impresora}</td>
                        <td>${impresora.fecha}</td>
                        <td class="text-center">
                            <a href="#" class="me-3 btnEditarImpresora" idImpresora="${impresora.id_impresora}" data-bs-toggle="modal" data-bs-target="#modalEditarConfiguracionImpresora">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>
                            <a href="#" class="me-3 confirm-text btnEliminarImpresora" idImpresora="${impresora.id_impresora}">
                                <i class="text-danger fa fa-trash fa-lg"></i>
                            </a>
                        </td>
                    </tr>
                `;

          tbody.append(fila);

        });

        // Inicializar DataTables después de cargar los datos

        $('#tabla_configuracion_impresora').DataTable();

      },
      error: function (xhr, status, error) {

        console.error("Error al recuperar los proveedores:", error);

      },

    });

  }


  /*=============================================
  EDITAR LA IMPRESORA
  =============================================*/
  $("#tabla_configuracion_impresora").on("click", ".btnEditarImpresora", function (e) {

    e.preventDefault();

    var idImpresora = $(this).attr("idImpresora");

    var datos = new FormData();
    datos.append("idImpresora", idImpresora);

    $.ajax({
      url: "ajax/Impresora.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#id_impresora_edit").val(respuesta["id_impresora"]);
        $("#edit_nombre_impresora").val(respuesta["nombre"]);
        $("#edit_ip_impresora").val(respuesta["ip_impresora"]);

      },
    });
  });


  /*===========================================
  ACTUALIZAR IMPRESORA
  =========================================== */
  $("#btn_actualizar_configuracion_impresora").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var id_impresora_edit = $("#id_impresora_edit").val();
    var edit_nombre_impresora = $("#edit_nombre_impresora").val();
    var edit_ip_impresora = $("#edit_ip_impresora").val();

    // Validar el nombre de categoríua
    if (edit_nombre_impresora === "") {

      $("#edit_error_nombre_impresora").html("Por favor, ingrese el nombre").addClass("text-danger");

      isValid = false;

    } else if (!isNaN(edit_nombre_impresora)) {

      $("#edit_error_nombre_impresora").html("El nombre no puede contener números").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_nombre_impresora").html("").removeClass("text-danger");

    }



    if (isValid) {

      var datos = new FormData();

      datos.append("id_impresora_edit", id_impresora_edit);
      datos.append("edit_nombre_impresora", edit_nombre_impresora);
      datos.append("edit_ip_impresora", edit_ip_impresora);

      $.ajax({
        url: "ajax/Impresora.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          console.log(respuesta);

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_impresora_configuracion_impresora")[0].reset();

            $("#modalEditarConfiguracionImpresora").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "La impresora ha sido actualizado",
              icon: "success",
            });

            mostrarImpresora();

          } else {

            console.error("Error al cargar los datos.");

          }
        }
      });
    }
  });

  /*=============================================
  ELIMINAR IMPRESORA
  =============================================*/

  $("#tabla_configuracion_impresora").on("click", ".btnEliminarImpresora", function (e) {

    e.preventDefault();

    let idImpresoraDelete = $(this).attr("idImpresora");

    let datos = new FormData();

    datos.append("idImpresoraDelete", idImpresoraDelete);

    Swal.fire({
      title: "¿Está seguro de borrar la configuración?",
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
          url: "ajax/Impresora.ajax.php",
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
                text: "La categoria ha sido eliminado",
                icon: "success",
              });

              mostrarImpresora();

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
  MOSTRANDO DATOS DE LA IMPRESORA
  ===================================== */
  mostrarImpresora();

});
