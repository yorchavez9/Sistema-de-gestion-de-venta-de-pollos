
$(document).ready(function () {
    /* ===========================================
      GUARDAR TRABAJADOR
      ===========================================*/
  
    $("#btn_guardar_contrato_trabajador").click(function (e) {
  
      e.preventDefault();
  
      var isValid = true;
  
      var id_trabajador_c = $("#id_trabajador_contrato").val();
      var tiempo_contrato_t = $("#tiempo_contrato_t").val();
      var tipo_sueldo_c = $("#tipo_sueldo_c").val();
      var sueldo_trabajador = $("#sueldo_trabajador").val();
     
  
      /* VALIDANDO EL ID TRABAJADOR */
  
      if (id_trabajador_c == "" || id_trabajador_c == null) {
  
        $("#error_id_trabajador").html("Por favor, selecione el trabajador").addClass("text-danger");
  
        isValid = false;
  
      } else {
  
        $("#error_id_trabajador").html("").removeClass("text-danger");
  
      }
  
  
      /* VALIDANDO EL TIEMPO DE CONTRATO */
  
      if (tiempo_contrato_t === "" || tiempo_contrato_t === null) {
  
          $("#error_tiempo_contrato").html("Por favor, ingrese el tiempo de contrato").addClass("text-danger");
  
          isValid = false;
  
      } else if (!/^[-]?\d+$/.test(tiempo_contrato_t)) {
  
          $("#error_tiempo_contrato").html("Por favor, ingrese un número entero válido").addClass("text-danger");
  
          isValid = false;
  
      } else if (parseInt(tiempo_contrato_t) === 0) {
  
          $("#error_tiempo_contrato").html("El tiempo de contrato no puede ser cero").addClass("text-danger");
  
          isValid = false;
  
      } else {
  
          $("#error_tiempo_contrato").html("").removeClass("text-danger");
  
      }
  
  
      /* VALIDANDO EL TIPO DE SUELDO */
  
      if (tipo_sueldo_c == "" || tipo_sueldo_c == null) {
  
          $("#error_tipo_sueldo").html("Por favor, selecione el tipo de sueldo").addClass("text-danger");
    
          isValid = false;
    
        } else {
    
          $("#error_tipo_sueldo").html("").removeClass("text-danger");
    
        }
  
  
      /* VALIDANDO EL SUELDO DEL TRABJADOR */
  
      if (sueldo_trabajador === "" || sueldo_trabajador === null) {
  
          $("#error_sueldo_trabajador").html("Por favor, ingrese el sueldo").addClass("text-danger");
  
          isValid = false;
  
      } else if (!/^\d+(\.\d+)?$/.test(sueldo_trabajador)) {
  
          $("#error_sueldo_trabajador").html("Por favor, ingrese un sueldo válido").addClass("text-danger");
  
          isValid = false;
  
      } else if (parseFloat(sueldo_trabajador) === 0) {
  
          $("#error_sueldo_trabajador").html("El sueldo no puede ser 0.00").addClass("text-danger");
  
          isValid = false;
  
      } else {
  
          $("#error_sueldo_trabajador").html("").removeClass("text-danger");
  
      }
  
      /* SI EL FORMULARIO ES VALIDO ENVIAR */
  
      if (isValid) {
  
        var datos = new FormData();
  
        datos.append("id_trabajador_c", id_trabajador_c);
        datos.append("tiempo_contrato_t", tiempo_contrato_t);
        datos.append("tipo_sueldo_c", tipo_sueldo_c);
        datos.append("sueldo_trabajador", sueldo_trabajador);
  
  
  
        $.ajax({
          url: "ajax/Contrato.trabajador.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
  
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {
  
              $("#form_nuevo_contrato_trabajador")[0].reset();
  
  
              $("#modalNuevoContratoTrabajador").modal("hide");
  
              Swal.fire({
                title: "¡Correcto!",
                text: "El contrato ha sido registrado",
                icon: "success",
              });
  
              mostrarContratoTrabajador();
  
            } else {
  
              console.error("Erro al guardar los datos");
  
            }
  
          },
  
        });
  
      }
  
    });
  
    /* =========================================
      MOSTRANDO USUARIOS
      =========================================*/
  
    function mostrarContratoTrabajador() {
      
      $.ajax({
        url: "ajax/Contrato.trabajador.ajax.php",
        type: "GET",
        dataType: "json",
        success: function (contratos) {
  
        
  
          var tbody = $("#datos_contrato_trabajador");
  
          var contador = 1;
  
          tbody.empty();
  
          contratos.forEach(function (trabajador) {
  
  
            var fila = `
                      <tr>
                          <td>
                            ${contador}
                          </td>
                          <td>${trabajador.nombre}</td>
                          <td>${trabajador.tiempo_contrato}</td>
                          <td>${trabajador.tipo_sueldo}</td>
                          <td>${trabajador.sueldo}</td>
                          <td>${trabajador.fecha_contrato}</td>
                      
                          
                          <td>
    
                              <a href="#" class="me-3 btnEditarContrato" idContrato="${trabajador.id_contrato}" data-bs-toggle="modal" data-bs-target="#modalEditarContratoTrabajador">
                                  <i class="text-warning fas fa-edit fa-lg"></i>
                              </a>
    
                              <a href="#" class="me-3 confirm-text btnEliminarContrato" idContrato="${trabajador.id_contrato}">
                                  <i class="fa fa-trash fa-lg" style="color: #F52E2F"></i>
                              </a>
    
                          </td>
    
                      </tr>`;
  
            // Agregar la fila al tbody
            tbody.append(fila);
  
            contador++;
          });
          // Inicializar DataTables después de cargar los datos
          $("#tabla_contrato_trabajador").DataTable();
  
        },
  
        error: function (xhr, status, error) {
  
          console.error("Error al recuperar los usuarios:", error);
        },
  
      });
  
    }
  
  
    /*===========================================
      EDITAR EL TRABAJADOR
      ==========================================*/
  
    $("#tabla_contrato_trabajador").on("click", ".btnEditarContrato", function (e) {
  
      e.preventDefault();
  
      let idContrato = $(this).attr("idContrato");
  
      let datos = new FormData();
  
      datos.append("idContrato", idContrato);
  
      $.ajax({
        url: "ajax/Contrato.trabajador.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        dataType: "json",
        success: function (respuesta) {
  
          $("#edit_id_contrato").val(respuesta["id_contrato"]);
          $("#edit_id_trabajador_contrato").val(respuesta["id_trabajador"]);
          $("#edit_tiempo_contrato_t").val(respuesta["tiempo_contrato"]);
          $("#edit_tipo_sueldo_c").val(respuesta["tipo_sueldo"]);
          $("#edit_sueldo_trabajador").val(respuesta["sueldo"]);
          
  
        },
      });
    });
  
  
  
    /*===========================================
      ACTUALIZAR EL TRABAJADOR
      ==========================================*/
  
    $("#btn_actualizar_contrato_trabajador").click(function (e) {
  
      e.preventDefault();
  
      var isValid = true;
  
      var edit_id_contrato = $("#edit_id_contrato").val();
      var edit_id_trabajador_contrato = $("#edit_id_trabajador_contrato").val();
      var edit_tiempo_contrato_t = $("#edit_tiempo_contrato_t").val();
      var edit_tipo_sueldo_c = $("#edit_tipo_sueldo_c").val();
      var edit_sueldo_trabajador = $("#edit_sueldo_trabajador").val();
  
      /* SI EL FORMULARIO ES CORRECTO ENVIARLO */
  
      if (isValid) {
        var datos = new FormData();
  
        datos.append("edit_id_contrato", edit_id_contrato);
        datos.append("edit_id_trabajador_contrato", edit_id_trabajador_contrato);
        datos.append("edit_tiempo_contrato_t", edit_tiempo_contrato_t);
        datos.append("edit_tipo_sueldo_c", edit_tipo_sueldo_c);
        datos.append("edit_sueldo_trabajador", edit_sueldo_trabajador);
  
  
        $.ajax({
          url: "ajax/Contrato.trabajador.ajax.php",
          method: "POST",
          data: datos,
          cache: false,
          contentType: false,
          processData: false,
          success: function (respuesta) {
  
            var res = JSON.parse(respuesta);
  
            if (res === "ok") {
  
              $("#form_editar_contrato_trabajador")[0].reset();
  
              $("#modalEditarContratoTrabajador").modal("hide");
  
              Swal.fire({
                title: "¡Correcto!",
                text: "El contrato ha sido actualizado con éxito",
                icon: "success",
              });
  
              mostrarContratoTrabajador();
  
            } else {
              console.error("Error al actualizar los datos");
            }
          },
        });
      }
    });
  
    /*===========================================
      ELIMINAR TRABAJADOR
      ==========================================*/
    $("#tabla_contrato_trabajador").on("click", ".btnEliminarContrato", function (e) {
  
      e.preventDefault();
  
      var idContratoDelete = $(this).attr("idContrato");
  
  
      var datos = new FormData();
      datos.append("idContratoDelete", idContratoDelete);
  
  
      Swal.fire({
        title: "¿Está seguro de borrar el contrato?",
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
            url: "ajax/Contrato.trabajador.ajax.php",
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
                  text: "El contrato ha sido eliminado",
                  icon: "success",
                });
  
                mostrarContratoTrabajador();
              } else {
                console.error("Error al eliminar los datos");
              }
            },
  
          });
  
        }
  
      });
  
    });
  
    /* =====================================
      MSOTRANDO DATOS
      ===================================== */
    mostrarContratoTrabajador();
  });
  