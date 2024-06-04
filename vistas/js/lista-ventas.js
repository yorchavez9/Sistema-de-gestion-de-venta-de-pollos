/* ===========================================
MOSTRANDO PRODUCTO PARA LA VENTA
=========================================== */

/*=============================================
SELECCIONANDO LA SECCCION DE LA VENTA
=============================================*/

function showSection(){
    
    $(".seccion_lista_venta").on("click", function () {

      $("#ventas_lista").show();
  
      $("#pos_venta").hide();
  
      $("#ver_pos_venta").hide();
  
      $("#edit_pos_venta").hide();
  
      $("#edit_detalle_venta_producto").empty();
  
      $("#ver_detalle_venta_producto").empty();
  
    });
}

showSection();

/*=============================================
MOSTRANDO PRODUCTOS DE LA VENTA
=============================================*/

function mostrarProductoVenta() {

  $.ajax({

    url: "ajax/Producto.ajax.php",

    type: "GET",

    dataType: "json",

    success: function (productos) {

      var tbody = $("#data_edit_productos_detalle_venta");

      tbody.empty();

      productos.forEach(function (producto) {

        producto.imagen_producto = producto.imagen_producto.substring(3);

        var fila = `
                <tr>
                    <td class="text-center">

                        <a href="#" id="btnAddProductoVenta" class="hover_img_a btnAddEditProductoVenta" idProductoAdd="${producto.id_producto}" stockProducto="${producto.stock_producto}">

                            <img class="hover_img" src="${producto.imagen_producto}" alt="${producto.imagen_producto}">

                        </a>

                    </td>

                    <td>${producto.nombre_categoria}</td>

                    <td class="fw-bold">S/ ${producto.precio_producto}</td>

                    <td>${producto.nombre_producto}</td>

                    <td class="text-center">

                        <button type="button" class="btn btn-sm" style="${getButtonStyles(producto.stock_producto)}">

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

      $("#tabla_edit_add_producto_venta").DataTable();

    },

    error: function (xhr, status, error) {

      console.error("Error al recuperar los usuarios:", error.mensaje);

    },

  });

}

/* ===========================================
FORMATEO DE PRECIOS
=========================================== */
function formateoPrecio(numero) {

  return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}

/* ===========================================
MOSTRANDO VENTAS
=========================================== */

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
                            ${restantePago == "0.00"
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

                            <a href="#" class="me-3 btnImprimirTicket" idVenta="${venta.id_venta}">
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
AGREGANDO PRODUCTO PARA EDITAR
=========================================== */

$("#data_edit_productos_detalle_venta").on("click", ".btnAddEditProductoVenta", function (e) {

  e.preventDefault();

  var id_producto_edit = $(this).attr("idProductoAdd");

  var sotck_producto_edit = $(this).attr("stockProducto");

  if (sotck_producto_edit <= 0) {

    Swal.fire({
      title: "¡Alerta!",
      text: "¡El stock de este producto se agotado!",
      icon: "error",
    });

    return;

  } else if (sotck_producto_edit > 0 && sotck_producto_edit < 10) {

    Swal.fire({
      title: "¡Aviso!",
      text: "¡El stock de este producto se está agotando!",
      icon: "warning",
    });
    
  }


  var datos = new FormData();

  datos.append("id_producto_edit", id_producto_edit);

  $.ajax({

    url: "ajax/Lista.venta.ajax.php",

    method: "POST",

    data: datos,

    cache: false,

    contentType: false,

    processData: false,

    dataType: "json",

    success: function (respuesta) {

      respuesta.imagen_producto = respuesta.imagen_producto.substring(3);

      var nuevaFila = `
                      <tr>
                          <input type="hidden" class="edit_id_producto_venta" value="${respuesta.id_producto}">

                          <th class="text-center align-middle d-none d-md-table-cell">

                              <a href="#" class="me-3 confirm-text btnEliminarAddProductoVentaEdit" idAddProducto="${respuesta.id_producto}"">
                                  <i class="fa fa-trash fa-lg" style="color: #F1666D"></i>
                              </a>

                          </th>

                          <td>
                              <img src="${respuesta.imagen_producto}" alt="Imagen de un pollo" width="50">
                          </td>

                          <td>${respuesta.nombre_producto}</td>

                          <td>
                              <input type="number" class="form-control form-control-sm edit_cantidad_u_v" value="0">
                          </td>

                          <td>
                              <input type="number" class="form-control form-control-sm edit_cantidad_kg_v" value="0">
                          </td>

                          <td>
                              <input type="number" class="form-control form-control-sm edit_precio_venta" value="${respuesta.precio_producto}">
                          </td>

                          <td style="text-align: right;">
                              <p class="price">S/ <span class="edit_precio_sub_total_venta">0.00</span></p>
                          </td>
                          
                      </tr>`;

      $("#edit_detalle_venta_producto").append(nuevaFila);

      calcularSubTotal();

    },
    error: function (err) {

      console.error(err);

    },

  });

  calcularTotal();

  $(document).ready(function () {

    calcularTotal();

  });

});

/* ===========================================
CALCULAR EL SUB TOTAL CON ACCION DE INPUT
=========================================== */

function calcularSubTotal() {

  $(".edit_cantidad_kg_v, .edit_precio_venta").on("input", function () {

    var fila = $(this).closest("tr");

    var cantidad_kg = parseFloat(fila.find(".edit_cantidad_kg_v").val());

    var precio_compra = parseFloat(fila.find(".edit_precio_venta").val());

    if (isNaN(cantidad_kg)) {
      cantidad_kg = 0;
    }
    if (isNaN(precio_compra)) {
      precio_compra = 0;
    }

    var subtotal = cantidad_kg * precio_compra;

    var formateadoSubTotal = formateoPrecio(subtotal.toFixed(2));

    fila.find(".edit_precio_sub_total_venta").text(formateadoSubTotal);

    // Calcular y mostrar el total

    calcularTotal();

  });

}

/* ===========================================
MOSTRAR Y OCULAR EL TIPO DE PAGO
=========================================== */

$(".tipo_pago_venta").on("click", function () {

  let valor = $(this).val();

  if (valor == "credito") {

    $("#edit_venta_al_contado").hide();

  } else {

    $("#edit_venta_al_contado").show();

  }

});

/* ===========================================
EDITANDO VENTA
=========================================== */

$("#data_lista_ventas").on("click", ".btnEditarVenta", function (e) {

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
      $("#ver_pos_venta").hide();
      $("#edit_pos_venta").show();

      mostrarProductoVenta();

      $("#edit_id_venta").val(respuesta["id_venta"]);
      $("#edit_id_usuario_venta").val(respuesta["id_usuario"]);
      $("#edit_id_cliente_venta").val(respuesta["id_persona"]);
      $("#edit_fecha_venta").val(respuesta["fecha_venta"]);
      $("#edit_comprobante_venta").val(respuesta["tipo_comprobante"]);
      $("#edit_serie_venta").val(respuesta["serie_comprobante"]);
      $("#edit_numero_venta").val(respuesta["num_comprobante"]);
      $("#edit_igv_venta").val(respuesta["impuesto"]);



      if (respuesta["tipo_pago"] === "contado") {

        $("input[type=radio][name=edit_forma_pago_v][value=contado]").prop("checked",true);

        $("#edit_venta_al_contado").show();

      } else if (respuesta["tipo_pago"] === "credito") {

        $("input[type=radio][name=edit_forma_pago_v][value=credito]").prop("checked",true);

        $("#edit_venta_al_contado").hide();

      }


      if (respuesta["pago_e_y"] === "efectivo") {

        $("input[type=radio][name=edit_pago_tipo_v][value=efectivo]").prop("checked",true);


      } else if (respuesta["pago_e_y"] === "yape") {

        $("input[type=radio][name=edit_pago_tipo_v][value=yape]").prop("checked",true);

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

                            <th class="text-center align-middle d-none d-md-table-cell">

                                <a href="#" class="me-3 confirm-text btnEliminarAddProductoVentaEdit" idAddProducto="${respuesta.id_producto}"">
                                    <i class="fa fa-trash fa-lg" style="color: #F1666D"></i>
                                </a>

                            </th>

                            <td>
                                <img src="${respuesta.imagen_producto}" alt="Imagen de un pollo" width="50">
                            </td>

                            <td>${respuesta.nombre_producto}</td>

                            <td>
                                <input type="number" class="form-control form-control-sm edit_cantidad_u_v" value="${respuesta.cantidad_u}">
                            </td>

                            <td>
                                <input type="number" class="form-control form-control-sm edit_cantidad_kg_v" value="${respuesta.cantidad_kg}">
                            </td>

                            <td>
                                <input type="number" class="form-control form-control-sm edit_precio_venta" value="${respuesta.precio_venta}">
                            </td>

                            <td style="text-align: right;">
                                <p class="price">S/ <span class="edit_precio_sub_total_venta">0.00</span></p>
                            </td>
                            
                        </tr>`;

        $("#edit_detalle_venta_producto").append(nuevaFila);

      });

      // Función para realizar los cálculos

      function calcularAutomaticamente() {

        $(".edit_cantidad_kg_v, .edit_precio_venta").each(function () {

          var fila = $(this).closest("tr");

          var cantidad_kg = parseFloat(fila.find(".edit_cantidad_kg_v").val());

          var precio_venta = parseFloat(fila.find(".edit_precio_venta").val());

          if (isNaN(cantidad_kg)) {

            cantidad_kg = 0;

          }

          if (isNaN(precio_venta)) {

            precio_venta = 0;

          }

          var subtotal = cantidad_kg * precio_venta;

          var formateadoSubTotal = formateoPrecio(subtotal.toFixed(2));

          fila.find(".edit_precio_sub_total_venta").text(formateadoSubTotal);

        });

        // Calcular y mostrar el total

        calcularTotal();

      }
        
      calcularAutomaticamente();

      calcularSubTotal();

    },
    error: function (respuesta) {

      console.log(respuesta);

    },

  });

});



/*=============================================
IMPRIMIR TICKET
=============================================*/

$("#data_lista_ventas").on("click", ".btnImprimirTicket", function(e) {
  e.preventDefault();

  var idVentaTicket = $(this).attr("idVenta");

  // Guardar el ticket en el servidor
  $.ajax({
      url: "extensiones/ticketPrint.php",
      type: "GET",
      data: { idVentaTicket: idVentaTicket },
      success: function(response) {
          const $estado = document.querySelector("#section_imprimir_mensaje_ventas");
          $estado.textContent = "Imprimiendo ...";

          // URL del PDF
          const urlPDF = `http://localhost/sis_venta_pollo/vistas/ticket/ticket${idVentaTicket}.pdf`;

          // Nombre de la impresora
          const nombreImpresora = "EPSON L310 Series";

          // URL del servicio de impresión
          const url = `http://localhost:8080/url?urlPdf=${encodeURIComponent(urlPDF)}&impresora=${encodeURIComponent(nombreImpresora)}`;

          fetch(url)
              .then(respuesta => {
                  if (respuesta.ok) {
                      $estado.textContent = "Impreso correctamente";
                  } else {
                      respuesta.json().then(mensaje => {
                          $estado.textContent = "Error imprimiendo: " + mensaje.message;
                          console.log("Error: ", mensaje);
                      });
                  }
              })
              .catch(error => {
                  $estado.textContent = "Error haciendo petición: " + error.message;
                  console.log("Error: ", error);
              });
      },
      error: function(error) {
          console.log("Error guardando el ticket: ", error);
      }
  });
});



/*=============================================
DESCARGAR TICKET
=============================================*/

$("#data_lista_ventas").on("click", ".btnDescargarTicket", function(e) {
  e.preventDefault();

  var idVentaTicket = $(this).attr("idVenta");

  // Crea un enlace temporal
  var link = document.createElement('a');
  link.href = "extensiones/ticket.php?idVentaTicket=" + idVentaTicket;

  // Establece el atributo download en el enlace con el nombre deseado
  link.setAttribute('download', 'ticket' + idVentaTicket + '.pdf');

  // Agrega el enlace temporal al DOM
  document.body.appendChild(link);

  // Simula un clic en el enlace
  link.click();

  // Remueve el enlace temporal del DOM
  document.body.removeChild(link);
});




/*=============================================
ELIMINAR VENTA
=============================================*/

$("#data_lista_ventas").on("click", ".btnEliminarVenta", function(e) {

  e.preventDefault();
  
  var ventaIdDelete = $(this).attr("idVentaDelete");

  var datos = new FormData();

  datos.append("ventaIdDelete", ventaIdDelete);

  Swal.fire({
      title: "¿Está seguro de borrar la venta?",
      text: "¡Si no lo está puede cancelar la acción!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#d33",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
  }).then(function(result) {

      if (result.value) {

          $.ajax({
              url: "ajax/Lista.venta.ajax.php",
              method: "POST",
              data: datos,
              cache: false,
              contentType: false,
              processData: false,
              success: function(respuesta) {

                  var res = JSON.parse(respuesta);
                  if (res === "ok") {

                      Swal.fire({
                          title: "¡Eliminado!",
                          text: "La venta ha sido eliminada",
                          icon: "success",
                      });

                      mostrarVentas();
                  } else {

                      console.error("Error al eliminar los datos");
                  }
              }
          });
      }
  });
});



/*=============================================
ACTUALIZANDO LA VENTA
=============================================*/

$("#btn_actualizar_venta").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var edit_id_usuario_venta = $("#edit_id_usuario_venta").val();

    var edit_id_venta = $("#edit_id_venta").val();

    var edit_id_cliente_venta = $("#edit_id_cliente_venta").val();

    var edit_fecha_venta = $("#edit_fecha_venta").val();

    var edit_comprobante_venta = $("#edit_comprobante_venta").val();

    var edit_serie_venta = $("#edit_serie_venta").val();

    var edit_numero_venta = $("#edit_numero_venta").val();

    var edit_igv_venta = $("#edit_igv_venta").val();

    // Validar la categoria

    if (edit_id_cliente_venta == "" || edit_id_cliente_venta == null) {

      $("#edit_error_cliente_venta")

        .html("Por favor, selecione el cliente")

        .addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_cliente_venta").html("").removeClass("text-danger");

    }

    // Array para almacenar los valores de los productos

    var valoresProductos = [];

    // Iterar sobre cada fila de producto

    $("#edit_detalle_venta_producto tr").each(function () {

      var fila = $(this);

      // Obtener los valores de cada campo en la fila

      var idProductoVenta = fila.find(".edit_id_producto_venta").val();

      var cantidadU = fila.find(".edit_cantidad_u_v").val();

      var cantidadKg = fila.find(".edit_cantidad_kg_v").val();

      var precioVenta = fila.find(".edit_precio_venta").val();

      // Crear un objeto con los valores y agregarlo al array

      var producto = {

        id_producto: idProductoVenta,

        cantidad_u: cantidadU,

        cantidad_kg: cantidadKg,

        precio_venta: precioVenta,

      };

      valoresProductos.push(producto);

    });

    var productoAddVenta = JSON.stringify(valoresProductos);

    var subtotal = $("#edit_subtotal_venta").text().replace(/,/g, "");

    var igv = $("#edit_igv_venta_show").text().replace(/,/g, "");

    var total = $("#edit_total_precio_venta").text().replace(/,/g, "");

    // Captura el valor del tipo de pago (contado o crédito)

    var tipo_pago = $("input[name='edit_forma_pago_v']:checked").val();

    // Variable para almacenar el estado

    var estado_pago;

    // Verifica el tipo de pago seleccionado

    if (tipo_pago == "contado") {

      estado_pago = "completado";

    } else {

      estado_pago = "pendiente";

    }

    // Captura el valor del tipo de pago (contado o crédito)

    var pago_tipo = $("input[name='edit_pago_tipo_v']:checked").val();

    // Variable para almacenar el estado

    var pago_e_y;

    // Verifica el tipo de pago seleccionado

    if (pago_tipo == "efectivo") {

      pago_e_y = "efectivo";

    } else {

      pago_e_y = "yape";

    }

    var edit_id_usuario_venta = $("#edit_id_usuario_venta").val();

    var edit_id_venta = $("#edit_id_venta").val();

    var edit_id_cliente_venta = $("#edit_id_cliente_venta").val();

    var edit_fecha_venta = $("#edit_fecha_venta").val();

    var edit_comprobante_venta = $("#edit_comprobante_venta").val();

    var edit_serie_venta = $("#edit_serie_venta").val();

    var edit_numero_venta = $("#edit_numero_venta").val();

    var edit_igv_venta = $("#edit_igv_venta").val();

    if (isValid) {

      var datos = new FormData();

      datos.append("edit_id_venta", edit_id_venta);
      datos.append("id_cliente_venta", edit_id_cliente_venta);
      datos.append("id_usuario_venta", edit_id_usuario_venta);
      datos.append("fecha_venta", edit_fecha_venta);
      datos.append("comprobante_venta", edit_comprobante_venta);
      datos.append("serie_venta", edit_serie_venta);
      datos.append("numero_venta", edit_numero_venta);
      datos.append("igv_venta", edit_igv_venta);
      datos.append("productoAddVenta", productoAddVenta);
      datos.append("subtotal", subtotal);
      datos.append("igv", igv);
      datos.append("total", total);
      datos.append("tipo_pago", tipo_pago);
      datos.append("estado_pago", estado_pago);
      datos.append("pago_e_y", pago_e_y);

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
              text: "¡La venta se actualizó correctamente!",
              icon: "success"
            });
            
            $("#ventas_lista").show();
          
            $("#pos_venta").hide();
          
            $("#ver_pos_venta").hide();
          
            $("#edit_pos_venta").hide();
          
            $("#edit_detalle_venta_producto").empty();
          
            $("#ver_detalle_venta_producto").empty();
          
            mostrarVentas();
            
          } else {

            Swal.fire({

              title: "¡Error!",

              text: res.mensaje,

              icon: "error",
            });

          }

        },

        error: function (xhr, status, error) {

          console.error(xhr);

          console.error(status);

          console.error(error);
        },

      });

    }

});



/* ===========================================
CALCULAR EL TOTAL DE LA VENTA
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


/* ===========================================
ELIMINAR EL PRODUCTO AGREGADO DE LA LISTA
=========================================== */

$(document).on("click", ".btnEliminarAddProductoVentaEdit", function (e) {

  e.preventDefault();

  var idProductoEliminar = $(this).attr("idAddProducto");

  // Encuentra la fila que corresponde al producto a eliminar y elimínala

  $("#edit_detalle_venta_producto")

    .find("tr")

    .each(function () {

      var idProducto = $(this)

        .find(".btnEliminarAddProductoVentaEdit")

        .attr("idAddProducto");

      if (idProducto == idProductoEliminar) {

        $(this).remove();

        // Una vez eliminada la fila, recalcular el total

        calcularTotal();

        return false; // Termina el bucle una vez que se ha encontrado y eliminado la fila
      }

    });

});

/* ===========================================
MOSTRAR DEUDA A PAGAR
=========================================== */

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

/* ===========================================
PAGAR DEUDA
=========================================== */

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

/* ===========================================
MOSTRAR VENTAS
=========================================== */
mostrarVentas();

/* ===========================================
CALCULAR EL TOTAL DE LA VENTA
=========================================== */
calcularTotal();



/* ===========================================
EXPORTANDO VENTA
=========================================== */
export {
  mostrarVentas
};
