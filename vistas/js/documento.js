$(document).ready(function () {
  /*   ===========================================
    GUARDAR DATOS DE TIPO DE DOCUMENTO
    =========================================== */
  $("#guardar_tipo_documento").click(function () {
    var isValid = true;

    var tipoNombre = $("#nombre_tipo_documento").val();

    // Validar el nombre de usuario
    if (tipoNombre == "") {
      $("#errorNombreTipoDocumento")
        .html("Por favor, ingrese el nombre")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#errorNombreTipoDocumento").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
    if (isValid) {
      var datos = new FormData();
      datos.append("tipoNombre", tipoNombre);

      $.ajax({
        url: "ajax/Tipo.documento.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          var res = JSON.parse(respuesta);

          if (res === "ok") {
            $("#nuevoTipoDocumento")[0].reset();

            $("#modalNuevoTipoDocumento").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El tipo de documento ha sido guardado",
              icon: "success",
            });

            mostrarTipoDocumentos();
          } else {
            console.error("La carga y guardado de la imagen ha fallado.");
          }
        },
      });
    }
  });

  /* ====================================
    MOSTRANDO DATOS TIPO DE DOCUMENTO
    ==================================== */

  function mostrarTipoDocumentos() {
    $.ajax({
      url: "ajax/Tipo.documento.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (TipoDocumentos) {
        var tbody = $("#dataTipoDocumentos");

        tbody.empty();

        TipoDocumentos.forEach(function (documentos, index) {
          var filaNumero = index + 1;
          var fila = `
                      <tr>
                          <td>${filaNumero}</td>
                          <td class="productimgname">${documentos.nombre_doc}</td>
                          <td>${documentos.fecha_doc}</td>
                          <td class="text-center">
                              <a href="#" class="me-3 btnEditarTipoDocumento" idTipoDocumento="${documentos.id_doc}" data-bs-toggle="modal" data-bs-target="#modalEditarTipoDocumento">
                                  <img src="vistas/dist/assets/img/icons/edit.svg" alt="img">
                              </a>
                              <a href="#" class="me-3 confirm-text btnEliminarTipoDocumento" idTipoDocumento="${documentos.id_doc}">
                                  <img src="vistas/dist/assets/img/icons/delete.svg" alt="img">
                              </a>
                          </td>
                      </tr>
                  `;

          // Agregar la fila al tbody
          tbody.append(fila);
        });
        $('#tabla_tipo_documento').DataTable();
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error);
      },
    });
  }
  mostrarTipoDocumentos();

  /*=============================================
    EDITAR TIPO DE DOCUMENTO
    =============================================*/
  $("#tabla_tipo_documento").on("click",".btnEditarTipoDocumento", function () {
      var idTipoDocumento = $(this).attr("idTipoDocumento");

      var datos = new FormData();
      datos.append("idTipoDocumento", idTipoDocumento);

      $.ajax({
        url: "ajax/Tipo.documento.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
          $("#edit_id_doc").val(respuesta["id_doc"]);
          $("#edit_nombre_tipo_documento").val(respuesta["nombre_doc"]);
        },
      });
    }
  );

  /*===========================================
    EDITAR TIPO DE DOCUMENTO
    =========================================== */
  $("#editar_tipo_documento").click(function () {
    var isValid = true;

    var editIdDoc = $("#edit_id_doc").val();
    var editNombreDoc = $("#edit_nombre_tipo_documento").val();

    // Validar el nombre de usuario
    if (editNombreDoc == "") {
      $("#errorNombreTipoDocumento")
        .html("Por favor, ingrese el nombre")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#errorNombreTipoDocumento").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
    if (isValid) {
      var datos = new FormData();

      datos.append("editIdDoc", editIdDoc);
      datos.append("editNombreDoc", editNombreDoc);

      $.ajax({
        url: "ajax/Tipo.documento.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          var res = JSON.parse(respuesta);

          if (res === "ok") {
            $("#formEditTipoDocumento")[0].reset();

            $("#modalEditarTipoDocumento").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El tipo de documento ha sido editado",
              icon: "success",
            });

            mostrarTipoDocumentos();
          } else {
            console.error("La carga y guardado de la imagen ha fallado.");
          }
        },
      });
    }
  });

  /*=============================================
    ELIMINAR USUARIO
    =============================================*/
  $("#tabla_tipo_documento").on("click", ".btnEliminarTipoDocumento", function () {

    var idDocumento = $(this).attr("idTipoDocumento");

    var datos = new FormData();
    datos.append("idDocumento", idDocumento);

    Swal.fire({
      title: "¿Está seguro de borrar el documento?",
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
    }).then(function (result) {
        if(result.value){

            $.ajax({
                url: "ajax/Tipo.documento.ajax.php",
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
                      text: "El tipo de documento ha sido eliminado",
                      icon: "success",
                    });
        
                    mostrarTipoDocumentos();
    
                  } else {
    
                    console.error("Error al eliminar los datos");
    
                  }
                },
              });
      
          }
        
    });
  });


});
