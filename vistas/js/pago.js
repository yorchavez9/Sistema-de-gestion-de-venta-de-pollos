$(document).ready(function () {

  /* =====================================
  SELECIONANDO LA FECHA AUTOMATICAMENTE
  ===================================== */

  function obtenerFechaActual() {

    var today = new Date();

    var dd = String(today.getDate()).padStart(2, "0");

    var mm = String(today.getMonth() + 1).padStart(2, "0"); // Enero es 0

    var yyyy = today.getFullYear();

    return yyyy + "-" + mm + "-" + dd;

  }

  let fechaActual = obtenerFechaActual();

  $('#fecha_pago_t').val(fechaActual);


  /*=============================================
  FORMATEO DE PRECIOS DE LA VENTA
  =============================================*/

  function formateoPrecio(numero) {

    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  }

  /* ===========================================
  OBTENER EL MONTO DEL PAGO DEL TRABAJADOR
  ===========================================*/

  $("#id_contrato_pago").change(function (e) {

    e.preventDefault();

    let idContratoSelect = $(this).val();

    let datos = new FormData();

    datos.append("idContratoSelect", idContratoSelect);

    $.ajax({
      url: "ajax/Pago.trabajador.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {
        $("#monto_pago_t").val(respuesta["sueldo"]);
      },
    });
  });



  /* ===========================================
  GUARDAR PAGO DEL TRABAJADOR
  ===========================================*/

  $("#btn_guardar_pago_trabajador").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var id_contrato_pago = $("#id_contrato_pago").val();

    var monto_pago_t = $("#monto_pago_t").val();

    var fecha_pago_t = $("#fecha_pago_t").val();

    /* VALIDANDO EL ID TRABAJADOR */

    if (id_contrato_pago == "" || id_contrato_pago == null) {

      $("#error_id_trabjador_pago").html("Por favor, selecione el trabajador").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_id_trabjador_pago").html("").removeClass("text-danger");
    }


    /* SI EL FORMULARIO ES VALIDO ENVIAR */

    if (isValid) {

      var datos = new FormData();

      datos.append("id_contrato_pago", id_contrato_pago);
      datos.append("monto_pago_t", monto_pago_t);
      datos.append("fecha_pago_t", fecha_pago_t);


      $.ajax({
        url: "ajax/Pago.trabajador.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_nuevo_pago_trabajador")[0].reset();

            $("#modalNuevoPagoTrabajador").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El pago se realizó correctamente",
              icon: "success",
            });

            mostrarPagoTrabajador();

          } else {

            console.error("Erro al guardar los datos");

          }
        },
      });
    }
  });

  /* =========================================
  MOSTRANDO PAGOS DE LOS TRABAJADORES
  =========================================*/

  function mostrarPagoTrabajador() {

    $.ajax({
      url: "ajax/Pago.trabajador.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (pagos) {

        //OBTENIENDO LA FECHA ACTUAL

        var fechaActual = new Date();

        // Formatear la fecha en YYYY-MM-DD

        var fecha_actual = fechaActual.toISOString().split('T')[0];
      
        var estadoPago = "";

        var tbody = $("#datos_pago_trabajador");

        var contador = 1;

        tbody.empty();

        pagos.forEach(function (pago) {

          let fecha_pago = pago.fecha_pago.substring(0,10);

          
          
          if (fecha_pago < fecha_actual) {

            var idPago = pago.id_pagos;;

            var estadoPago = 0;

            var datos = new FormData();

            datos.append("activarId", idPago);

            datos.append("activarPago", estadoPago);

            $.ajax({

              url: "ajax/Pago.trabajador.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function (respuesta) {

              },

            });

          }


          var fila = `
                      <tr>
                          <td>${contador}</td>

                          <td>${pago.nombre}</td>

                          <td class="fw-bold">S/ ${formateoPrecio(pago.monto_pago)}</td>

                          <td>${fecha_pago}</td>

                          <td>
                          ${
                            pago.estado_pago != 0
                              ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idPago="' + pago.id_pagos + '" estadoPago="0" disabled>Pagado</button>'
                              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idPago="' + pago.id_pagos + '" estadoPago="1">Pendiente</button>'
                          }
                          </td>
                      
                          
                          <td class="text-center">

                              <a href="#" class="me-3 confirm-text btnEliminarPago" idPago="${pago.id_pagos}">

                                <i class="fa fa-trash fa-lg" style="color: #F52E2F"></i>

                              </a>
    
                          </td>
    
                      </tr>`;

          // Agregar la fila al tbody

          tbody.append(fila);

          contador++;

        });

        // Inicializar DataTables después de cargar los datos

        $("#tabla_pago_trabajador").DataTable();

      },

      error: function (xhr, status, error) {

        console.error("Error al recuperar los usuarios:", error);

      },

    });

  }





 /*=============================================
  ESTADO DE PAGO (PAGADO O PENDIENTE)
  ============================================= */

  $("#tabla_pago_trabajador").on("click", ".btnActivar", function (e) {

    e.preventDefault();

    var idPago = $(this).attr("idPago");

    var estadoPago = $(this).attr("estadoPago");

    var datos = new FormData();

    datos.append("activarId", idPago);

    datos.append("activarPago", estadoPago);

    $.ajax({
      url: "ajax/Pago.trabajador.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {

        Swal.fire({
          position: "top-end",
          icon: "success",
          title: "Pagado",
          showConfirmButton: false,
          timer: 1500
        });

      },

    });

    if (estadoPago == 0) {

      $(this).removeClass("bg-lightgreen").addClass("bg-lightred").html("Pendiente");

      $(this).attr("estadoPago", 1);

      

    } else {

      $(this).removeClass("bg-lightred").addClass("bg-lightgreen").html("Pagado");

      $(this).attr("estadoPago", 0);

      $(this).prop('disabled', true);
      
    }

  });


  /*===========================================
  ELIMINAR PAGO DEL TRABAJADOR
  ==========================================*/

  $("#tabla_pago_trabajador").on("click",".btnEliminarPago", function (e) {

      e.preventDefault();

      var idPagoDelete = $(this).attr("idPago");

      var datos = new FormData();

      datos.append("idPagoDelete", idPagoDelete);

      Swal.fire({
        title: "¿Está seguro de borrar el pago?",
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
            url: "ajax/Pago.trabajador.ajax.php",
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
                  text: "El pago ha sido eliminado",
                  icon: "success",
                });

                mostrarPagoTrabajador();

              } else {

                console.error("Error al eliminar los datos");

              }

            },

          });

        }

      });

    }

  );

  /* =====================================
  MOSTRANDO PAGOS DE LSO TRABJADORES
  ===================================== */

  mostrarPagoTrabajador();

});
