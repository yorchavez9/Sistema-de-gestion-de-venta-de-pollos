/* ==============================
FUNCION PARA FORMATEAR FUNCION
============================== */

function mostrarProductoVenta() {
  $.ajax({
    url: "ajax/Producto.ajax.php",

    type: "GET",

    dataType: "json",

    success: function (productos) {
      var tbody = $("#data_ver_productos_detalle_venta");

      tbody.empty();

      productos.forEach(function (producto) {
        producto.imagen_producto = producto.imagen_producto.substring(3);

        var fila = `
                  <tr>
                      <td class="text-center">
  
                          <a href="#" id="btnAddProductoVenta" class="hover_img_a btnAddProductoVenta" idProductoAdd="${
                            producto.id_producto
                          }" stockProducto="${producto.stock_producto}">
  
                              <img class="hover_img" src="${
                                producto.imagen_producto
                              }" alt="${producto.imagen_producto}">
  
                          </a>
  
                      </td>
  
                      <td>${producto.nombre_categoria}</td>
  
                      <td class="fw-bold">S/ ${producto.precio_producto}</td>
                      <td>${producto.nombre_producto}</td>
  
                      <td class="text-center">
  
                          <button type="button" class="btn btn-sm" style="${getButtonStyles(
                            producto.stock_producto
                          )}">
  
                              ${producto.stock_producto}
  
                          </button>
  
                      </td>
  
                  </tr>`;

        function getButtonStyles(stock) {
          if (stock > 20) {
            return "background-color: #28C76F; color: white; border: none;";
          } else if (stock >= 10 && stock <= 20) {
            return "background-color: #FF9F43; color: white; border: none;";
          } else {
            return "background-color: #FF4D4D; color: white; border: none;";
          }
        }

        tbody.append(fila);
      });

      $("#tabla_ver_add_producto_venta").DataTable();
    },

    error: function (xhr, status, error) {
      console.error("Error al recuperar los usuarios:", error.mensaje);
    },
  });
}

function formateoPrecio(numero) {
  return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
}

/* ===========================
  MOSTRANDO VENTAS
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
          let fechaFormateada =
            partesFecha[2] + "/" + partesFecha[1] + "/" + partesFecha[0];

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
                              ${
                                restantePago == "0.00"
                                  ? '<button class="btn btn-sm rounded" style="background: #28C76F; color:white;">Completado</button>'
                                  : '<button class="btn btn-sm rounded" style="background: #FF4D4D; color:white;">Pendiente</button>'
                              }
                          </td>
                          
                          <td class="text-center">

                            <a href="#" class="me-3 btnPagarVenta" idVenta="${venta.id_venta}" totalCompraVenta="${totalCompra}" pagoRestanteVenta="${formateadoPagoRestante}" restantePago="${restantePago}">
                                <i class="fas fa-money-bill-alt fa-lg" style="color: #28C76F"></i>
                            </a>
                        
                            <a href="#" class="me-3 btnEditarVenta" idVenta="${venta.id_venta}">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>

                            <a href="#" class="me-3 btnVerVenta" idVenta="${venta.id_venta}">
                                <i class="text-primary fa fa-eye fa-lg"></i>
                            </a>

                            <a href="#" class="me-3 btnVerProducto" idVenta="${venta.id_venta}">
                                <i class="fa fa-print fa-lg" style="color: #0084FF"></i>
                            </a>

                            <a href="#" class="me-3 btnDescargarTicket" idVenta="${venta.id_venta}">
                                <i class="fa fa-download fa-lg" style="color: #28C76F"></i>
                            </a>

                            <a href="#" class="me-3 confirm-text btnEliminarVenta" idVentaDelete="${venta.id_venta}">
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

/* ===========================================
     ESCONDIENDO O MOSTRANDO EL TIPO DE PAGO
     =========================================== */

$(".tipo_pago_venta").on("click", function () {
  let valor = $(this).val();

  if (valor == "credito") {
    $("#edit_venta_al_contado").hide();
  } else {
    $("#edit_venta_al_contado").show();
  }
});

/* ===========================
  VER VENTA
  =========================== */

$("#data_lista_ventas").on("click", ".btnVerVenta", function (e) {

  e.preventDefault();


  var idVenta = $(this).attr("idVenta");

  var datos = new FormData();

  datos.append("idVenta", idVenta);

  /* MOSTRANDO DATOS DE VENTA */
  $.ajax({
    url: "ajax/Lista.venta.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (respuesta) {

      $("#pos_venta").hide();
      $("#ventas_lista").hide();
      $("#ventas_lista").hide();
      $("#edit_pos_venta").hide();
      $("#ver_pos_venta").show();
      

      mostrarProductoVenta();

      $("#ver_id_venta").val(respuesta["id_venta"]);
      $("#ver_id_usuario_venta").val(respuesta["id_usuario"]);
      $("#ver_id_cliente_venta").val(respuesta["id_persona"]);
      $("#ver_fecha_venta").val(respuesta["fecha_venta"]);
      $("#ver_comprobante_venta").val(respuesta["tipo_comprobante"]);
      $("#ver_serie_venta").val(respuesta["serie_comprobante"]);
      $("#ver_numero_venta").val(respuesta["num_comprobante"]);
      $("#ver_igv_venta").val(respuesta["impuesto"]);

      $("#ver_subtotal_venta").text(formateoPrecio(respuesta["sub_total"]));
      $("#ver_igv_venta_show").text(formateoPrecio(respuesta["igv"]));
      $("#ver_total_precio_venta").text(
        formateoPrecio(respuesta["total_venta"])
      );

      if (respuesta["tipo_pago"] === "contado") {
        $("input[type=radio][name=forma_pago_v][value=contado]").prop(
          "checked",
          true
        );
        $("#ver_venta_al_contado").show();

      } else if (respuesta["tipo_pago"] === "credito") {
        $("input[type=radio][name=forma_pago_v][value=credito]").prop(
          "checked",
          true
        );

        $("#ver_venta_al_contado").hide();
      }
    },
    error: function (respuesta) {
      console.log(respuesta);
    },
  });

  /* MOSTRANDO DATOS DE DETALLE VENTA */

  $.ajax({
    url: "ajax/Detalle.venta.ajax.php",
    method: "POST",
    data: datos,
    cache: false,
    contentType: false,
    processData: false,
    dataType: "json",
    success: function (productoDetalle) {
      var nuevaFila = "";

      productoDetalle.forEach((respuesta) => {
        respuesta.imagen_producto = respuesta.imagen_producto.substring(3);

        nuevaFila = `
                          <tr>
                              <input type="hidden" class="edit_id_producto_venta" value="${respuesta.id_producto}">
  
                              <td>
                                  <img src="${respuesta.imagen_producto}" alt="Imagen de un pollo" width="50">
                              </td>
  
                              <td>${respuesta.nombre_producto}</td>
  
                              <td>
                                  <input type="number" class="form-control form-control-sm ver_cantidad_u_v" value="${respuesta.cantidad_u}" disabled >
                              </td>
  
                              <td>
                                  <input type="number" class="form-control form-control-sm ver_cantidad_kg_v" value="${respuesta.cantidad_kg}" disabled >
                              </td>
  
                              <td>
                                  <input type="number" class="form-control form-control-sm ver_precio_venta" value="${respuesta.precio_venta}" disabled >
                              </td>
  
                              <td style="text-align: right;">
                                  <p class="price">S/ <span class="ver_precio_sub_total_venta">0.00</span></p>
                              </td>
                              
                          </tr>`;
        $("#ver_detalle_venta_producto").append(nuevaFila);
      });

      $(".ver_cantidad_kg_v, .ver_precio_venta").on("input", function () {
        var fila = $(this).closest("tr");

        var cantidad_kg = parseFloat(fila.find(".ver_cantidad_kg_v").val());

        var precio_compra = parseFloat(fila.find(".ver_precio_venta").val());

        if (isNaN(cantidad_kg)) {
          cantidad_kg = 0;
        }
        if (isNaN(precio_compra)) {
          precio_compra = 0;
        }

        var subtotal = cantidad_kg * precio_compra;

        var formateadoSubTotal = formateoPrecio(subtotal.toFixed(2));

        fila.find(".ver_precio_sub_total_venta").text(formateadoSubTotal);

        // Calcular y mostrar el total
        calcularTotal();
      });
    },
    error: function (respuesta) {
      console.log(respuesta);
    },
  });
});

/* ===========================================
     CALCULAR EL TOTAL DE PRECIO
     =========================================== */
function calcularTotal() {
  var subtotalTotal = 0;

  var impuesto = parseFloat($("#edit_igv_venta").val());

  // Recorrer todas las filas para sumar los subtotales

  $("#edit_detalle_venta_producto tr").each(function () {
    var subtotalString = $(this)
      .find(".edit_precio_sub_total_venta")
      .text()
      .replace("S/ ", "")
      .replace(",", "");

    var subtotal = parseFloat(subtotalString);

    // Si subtotal no es un número válido, asignar 0

    if (isNaN(subtotal)) {
      subtotal = 0;
    }

    subtotalTotal += subtotal;
  });

  // Calcular el impuesto

  var igv = subtotalTotal * (impuesto / 100);

  // Calcular el total

  var total = subtotalTotal + igv;

  // Verificar si el resultado es NaN y mostrar "0.00" en su lugar

  if (isNaN(total)) {
    total = 0;
  }

  // Formatear los resultados

  var subtotalFormateado = formateoPrecio(subtotalTotal.toFixed(2));

  var igvFormateado = formateoPrecio(igv.toFixed(2));

  var totalFormateado = formateoPrecio(total.toFixed(2));

  // Mostrar los resultados en el HTML

  $("#edit_subtotal_venta").text(subtotalFormateado);

  $("#edit_igv_venta_show").text(igvFormateado);

  $("#edit_total_precio_venta").text(totalFormateado);
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

  if (restantePago == "0.00") {
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
    $("#modalPagarVenta").modal("show");
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

calcularTotal();

export { mostrarVentas };
