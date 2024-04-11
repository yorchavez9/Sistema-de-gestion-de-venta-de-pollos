
/* ==============================
FUNCION PARA FORMATEAR FUNCION
============================== */

function formateoPrecio(numero) {

  return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}


/* ===========================
MOSTRANDO PRODUCTO
=========================== */

function mostrarVentas() {

  $.ajax({
    url: "ajax/Lista.venta.ajax.php",
    type: "GET",
    dataType: "json",
    success: function (ventas) {

      var tbody = $("#data_lista_ventas");

      tbody.empty();

      // Inicializamos un conjunto vacío para almacenar los id_egreso ya procesados
      var ventasProcesados = new Set();

      ventas.forEach(function (venta, index) {

        // Verificar si el id_egreso ya ha sido procesado
        if (!ventasProcesados.has(venta.id_venta)) {

          var restantePago = (venta.total_venta - venta.total_pago).toFixed(2);

          let fechaOriginal = venta.fecha_venta;

          let partesFecha = fechaOriginal.split("-"); // Dividir la fecha en año, mes y día
          let fechaFormateada = partesFecha[2] + "/" + partesFecha[1] + "/" + partesFecha[0];

          let totalCompra = formateoPrecio(venta.total_venta);
          let formateadoPagoRestante = formateoPrecio(restantePago);

          var fila = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${fechaFormateada}</td>
                        <td>${venta.razon_social}</td>
                        <td>${venta.serie_comprobante}</td>
                        <td>${venta.num_comprobante}</td>
                        <td>${venta.tipo_pago}</td>
                        <td>S/ ${totalCompra}</td>
                        <td>S/ ${formateadoPagoRestante}</td>

                        <td class="text-center">
                            ${restantePago == "0.00" ? '<button class="btn btn-sm rounded" style="background: #28C76F; color:white;">Completado</button>'
                                                     : '<button class="btn btn-sm rounded" style="background: #FF4D4D; color:white;">Pendiente</button>'
                            }
                        </td>
                        
                        <td class="text-center">

                            <a href="#" class="me-3 btnPagarVenta" idVenta="${venta.id_venta}" totalCompraVenta="${totalCompra}" pagoRestanteVenta="${formateadoPagoRestante}" restantePago="${restantePago}">
                                <i class="fas fa-money-bill-alt fa-lg" style="color: #28C76F"></i>
                            </a>
                        
                            <a href="#" class="me-3 btnEditarProducto" idVenta="${venta.id_venta}" data-bs-toggle="modal" data-bs-target="#modalEditarProducto">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>

                            <a href="#" class="me-3 btnVerProducto" idVenta="${venta.id_venta}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                <i class="text-primary fa fa-eye fa-lg"></i>
                            </a>

                            <a href="#" class="me-3 btnVerProducto" idVenta="${venta.id_venta}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                <i class="fa fa-print fa-lg" style="color: #0084FF"></i>
                            </a>

                            <a href="#" class="me-3 btnVerProducto" idVenta="${venta.id_venta}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                <i class="fa fa-download fa-lg" style="color: #28C76F"></i>
                            </a>

                            <a href="#" class="me-3 confirm-text btnEliminarProducto" idVenta="${venta.id_venta}" imagenProducto="${venta.imagen_producto}">
                                <i class="fa fa-trash fa-lg" style="color: #FF4D4D"></i>
                            </a>

                        </td>
                    </tr>`;

          // Agregar la fila al tbody
          tbody.append(fila);

          // Agregar el id_egreso al conjunto de egresos procesados
          ventasProcesados.add(venta.id_venta);

        }

      });

      // Inicializar DataTables después de cargar los datos
      $("#tabla_lista_ventas").DataTable();

    },
    error: function (xhr, status, error) {

      console.error(error);
      console.error(xhr);
      console.error(status);

    },

  });

}

/*=============================================
MOSTRAR DEUDA A PAGAR
=============================================*/

$("#data_lista_ventas").on("click", ".btnPagarVenta", function (e) {

  e.preventDefault();

  let idVenta = $(this).attr("idVenta");
  let totalCompraVenta = $(this).attr("totalCompraVenta");
  let pagoRestanteVenta = $(this).attr("pagoRestanteVenta");
  let restantePago = $(this).attr("restantePago");

  if(restantePago == "0.00"){
      Swal.fire({
          title: "¡Aviso!",
          text: "Esta venta no tiene deudas pendientes.",
          icon: "warning",
      });
  } else {
      // Configura los valores en el modal según los datos del botón pulsado
      $("#id_venta_pagar").val(idVenta);
      $("#total_venta_pagar").text("S/ " + totalCompraVenta);
      $("#pago_restante_pagar").text("S/ " + pagoRestanteVenta);

      // Ahora abre el modal manualmente con JavaScript
      $("#modalPagarVenta").modal('show');
  }

});

/*=============================================
    PAGAR DEUDA
    =============================================*/
$("#btn_pagar_deuda_venta").click(function (e) {

  e.preventDefault();

  var isValid = true;

  var id_venta_pagar = $("#id_venta_pagar").val();

  var monto_pagar_venta = $("#monto_pagar_venta").val();

  /* VALIDANDO EL TIPO DE DATOS */
  
  if (monto_pagar_venta === "" || monto_pagar_venta == null) {

    $("#error_monto_pagar_venta")
      .html("Por favor, ingrese el monto")
      .addClass("text-danger");

    isValid = false;

  } else if (isNaN(monto_pagar_venta)) {

    $("#error_monto_pagar_venta")
      .html("El monto solo puede contener números")
      .addClass("text-danger");

    isValid = false;

  } else {

    $("#error_monto_pagar_venta").html("").removeClass("text-danger");

  }

 /*  ENVIAR LOS DATOS SI LA VALIDACION FUE VERDADERO */

  if (isValid) {

    var datos = new FormData();

    datos.append("id_venta_pagar", id_venta_pagar);
    datos.append("monto_pagar_venta", monto_pagar_venta);

    $.ajax({
      url: "ajax/Lista.venta.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {

        var res = JSON.parse(respuesta);

        if (res.estado === "ok") {

          Swal.fire({
            title: "¡Correcto!",
            text: res.mensaje,
            icon: "success",
            showCancelButton: true,
            confirmButtonColor: "#28C76F",
            cancelButtonColor: "#F52E2F",
            confirmButtonText: "¡Imprimir!",

          }).then((result) => {

            if (result.isConfirmed) {

              Swal.fire({
                title: "¡Imprimiendo!",
                text: "Su comprobante se está imprimiento.",
                icon: "success",

              });

            }

          });

          $("#frm_pagar_deuda_venta")[0].reset();

          $("#modalPagarVenta").modal("hide");

        } else {

          Swal.fire({
            title: res.estado,
            text: res.mensaje,
            icon: "error",

          });

        }

        mostrarVentas();
      },

    });

  }

});

/* =====================================
  MSOTRANDO DATOS
  ===================================== */
mostrarVentas();

export { mostrarVentas };
