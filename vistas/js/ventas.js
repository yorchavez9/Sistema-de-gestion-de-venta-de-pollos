/*=============================================
IMPORTANTO LA FUNCION MOSTRAR VENTAS
=============================================*/

import { mostrarVentas } from "./lista-venta.js";


$(document).ready(function () {


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
  SELECION DE TIPO DE PAGO (EFECYIVO O YAPE)
  =============================================*/

  function tipoPagoYE() {

    // Obtener todos los elementos <a> con la clase "paymentmethod"

    var paymentMethodLinks = document.querySelectorAll("a.tipo_pago_e_y");

    // Iterar sobre cada elemento <a>

    paymentMethodLinks.forEach(function (link) {

      // Añadir un evento de clic a cada elemento <a>

      link.addEventListener("click", function () {

        // Obtener el radio button dentro del elemento <a> actual

        var radioButton = this.querySelector(".tipo_pago_venta");

        // Verificar si el radio button no está marcado

        if (!radioButton.checked) {

          // Marcar el radio button

          radioButton.checked = true;

        }

      });

    });

  }

  /*=============================================
  SELECION DE FECHA AUTOMATICO
  =============================================*/

  function seleccionFecha() {

    const today = new Date().toISOString().split("T")[0];

    // Asignar la fecha actual al campo de entrada de fecha

    document.getElementById("fecha_venta").value = today;

  }

 /*=============================================
  MOSTRANDO SERIE Y NUMERO DE VENTA
  =============================================*/

  function mostrarSerieNumero() {

    $.ajax({

      url: "ajax/Serie.numero.venta.ajax.php",

      type: "GET",

      dataType: "json",

      success: function (respuesta) {

        if (respuesta == "" || respuesta == null) {

          $("#serie_venta").val("T0001");

          $("#numero_venta").val("0001");
        }

        respuesta.forEach((data) => {

          var serie = parseInt(data.serie_comprobante.match(/\d+/)[0]);

          var numero = parseInt(data.num_comprobante.match(/\d+/)[0]);

          serie += 1;

          numero += 1;

          var seriComprobante = "T" + serie.toString().padStart(4, "0");

          var numeroComprobante = numero

            .toString()

            .padStart(data.num_comprobante.length, "0");

          $("#serie_venta").val(seriComprobante);

          $("#numero_venta").val(numeroComprobante);

        });

      },

      error: function (xhr, status, error) {

        console.error(xhr);

        console.error(status);

        console.error(error);
      },

    });

  }

  /*=============================================
  MOSTRANDO TAABLE DE PRODUCTOS PARA VENTA
  =============================================*/

  function mostrarProductoVenta() {

    $.ajax({

      url: "ajax/Producto.ajax.php",

      type: "GET",

      dataType: "json",

      success: function (productos) {

        var tbody = $("#data_productos_detalle_venta");

        tbody.empty();

        productos.forEach(function (producto) {

          producto.imagen_producto = producto.imagen_producto.substring(3);

          var fila = `
                  <tr>
                      <td class="text-center">

                          <a href="#" id="btnAddProductoVenta" class="hover_img_a btnAddProductoVenta" idProductoAdd="${producto.id_producto}" stockProducto="${producto.stock_producto}">

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

        $("#tabla_add_producto_venta").DataTable();

      },

      error: function (xhr, status, error) {

        console.error("Error al recuperar los usuarios:", error.mensaje);

      },

    });

  }

  /*=============================================
  FORMATEO DE PRECIOS DE LA VENTA
  =============================================*/

  function formateoPrecio(numero) {

    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

  }

  /*=============================================
  CALCULAR EL TOTAL DE LA VENTA
  =============================================*/

  function calcularTotal() {

    var subtotalTotal = 0;

    var impuesto = parseFloat($("#igv_venta").val());

    // Recorrer todas las filas para sumar los subtotales

    $("#detalle_venta_producto tr").each(function () {

      var subtotalString = $(this)
        .find(".precio_sub_total_venta")
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

    $("#subtotal_venta").text(subtotalFormateado);

    $("#igv_venta_show").text(igvFormateado);

    $("#total_precio_venta").text(totalFormateado);
  }

  /*=============================================
  AGREGANDO EL PRODUCTO AL DETALLE VENTA
  =============================================*/

  $("#tabla_add_producto_venta").on("click", ".btnAddProductoVenta", function (e) {

      e.preventDefault();

      var idProductoAdd = $(this).attr("idProductoAdd");

      var stockProducto = $(this).attr("stockProducto");

      if (stockProducto <= 0) {

        Swal.fire({
          title: "¡Alerta!",
          text: "¡El stock de este producto se agotado!",
          icon: "error",
        });

        return;

      } else if (stockProducto > 0 && stockProducto < 10) {

        Swal.fire({
          title: "¡Aviso!",
          text: "¡El stock de este producto se está agotando!",
          icon: "warning",
        });

      }

      var datos = new FormData();

      datos.append("idProductoAdd", idProductoAdd);

      $.ajax({

        url: "ajax/ventas.ajax.php",

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
                            <input type="hidden" class="id_producto_venta" value="${respuesta.id_producto}">

                            <th class="text-center align-middle d-none d-md-table-cell">
                                <a href="#" class="me-3 confirm-text btnEliminarAddProductoVenta" idAddProducto="${respuesta.id_producto}"">
                                    <i class="fa fa-trash fa-lg" style="color: #F1666D"></i>
                                </a>
                            </th>

                            <td>
                                <img src="${respuesta.imagen_producto}" alt="Imagen de un pollo" width="50">
                            </td>

                            <td>${respuesta.nombre_producto}</td>

                            <td>
                                <input type="number" class="form-control form-control-sm cantidad_u_v" value="0">
                            </td>

                            <td>
                                <input type="number" class="form-control form-control-sm cantidad_kg_v" value="0">
                            </td>

                            <td>
                                <input type="number" class="form-control form-control-sm precio_venta" value="${respuesta.precio_producto}">
                            </td>

                            <td style="text-align: right;">
                                <p class="price">S/ <span class="precio_sub_total_venta">0.00</span></p>
                            </td>
                            
                        </tr>`;

          $("#detalle_venta_producto").append(nuevaFila);

          var input = document.querySelector(".cantidad_u_v");

          input.focus();

          input.value = "";

          $(".cantidad_kg_v, .precio_venta").on("input", function () {

            var fila = $(this).closest("tr");

            var cantidad_kg = parseFloat(fila.find(".cantidad_kg_v").val());

            var precio_compra = parseFloat(fila.find(".precio_venta").val());

            if (isNaN(cantidad_kg)) {

              cantidad_kg = 0;

            }

            if (isNaN(precio_compra)) {

              precio_compra = 0;

            }

            var subtotal = cantidad_kg * precio_compra;

            var formateadoSubTotal = formateoPrecio(subtotal.toFixed(2));

            fila.find(".precio_sub_total_venta").text(formateadoSubTotal);

            // Calcular y mostrar el total

            calcularTotal();

          });

        },

        error: function (err) {

          console.error(err);

        },

      });

      calcularTotal();

      $(document).ready(function () {

        calcularTotal();

      });

    }

  );


  /*=============================================
  ELIMINANDO EL PRODUCTO AGREGADO AL DETALLE VENT.
  =============================================*/

  $(document).on("click", ".btnEliminarAddProductoVenta", function (e) {

    e.preventDefault();

    var idProductoEliminar = $(this).attr("idAddProducto");

    // Encuentra la fila que corresponde al producto a eliminar y elimínala

    $("#detalle_venta_producto")

      .find("tr")

      .each(function () {

        var idProducto = $(this)

          .find(".btnEliminarAddProductoVenta")

          .attr("idAddProducto");

        if (idProducto == idProductoEliminar) {

          $(this).remove();

          // Una vez eliminada la fila, recalcular el total

          calcularTotal();

          return false; // Termina el bucle una vez que se ha encontrado y eliminado la fila
        }

      });

  });

 /*=============================================
  MOSTRANDO Y ESCONDIENDO EL TIPO DE PAGO 
  =============================================*/

  $(".tipo_pago_venta").on("click", function () {

    let valor = $(this).val();

    if (valor == "credito") {

      $("#venta_al_contado").hide();

    } else {

      $("#venta_al_contado").show();

    }

  });

  /*=============================================
  CREANDO NUEVA VENTA
  =============================================*/

  $("#btn_crear_nueva_venta").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var id_usuario_venta = $("#id_usuario_venta").val();

    var id_cliente_venta = $("#id_cliente_venta").val();

    var fecha_venta = $("#fecha_venta").val();

    var comprobante_venta = $("#comprobante_venta").val();

    var serie_venta = $("#serie_venta").val();

    var numero_venta = $("#numero_venta").val();

    var igv_venta = $("#igv_venta").val();

    // Validar la categoria

    if (id_cliente_venta == "" || id_cliente_venta == null) {

      $("#error_cliente_venta")

        .html("Por favor, selecione el cliente")

        .addClass("text-danger");

      isValid = false;

    } else {

      $("#error_cliente_venta").html("").removeClass("text-danger");

    }

    // Array para almacenar los valores de los productos

    var valoresProductos = [];

    // Iterar sobre cada fila de producto

    $("#detalle_venta_producto tr").each(function () {
      var fila = $(this);

      // Obtener los valores de cada campo en la fila

      var idProductoVenta = fila.find(".id_producto_venta").val();

      var cantidadU = fila.find(".cantidad_u_v").val();

      var cantidadKg = fila.find(".cantidad_kg_v").val();

      var precioVenta = fila.find(".precio_venta").val();

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

    var subtotal = $("#subtotal_venta").text().replace(/,/g, "");

    var igv = $("#igv_venta_show").text().replace(/,/g, "");

    var total = $("#total_precio_venta").text().replace(/,/g, "");

    // Captura el valor del tipo de pago (contado o crédito)

    var tipo_pago = $("input[name='forma_pago_v']:checked").val();

    // Variable para almacenar el estado

    var estado_pago;

    // Verifica el tipo de pago seleccionado

    if (tipo_pago == "contado") {

      estado_pago = "completado";

    } else {

      estado_pago = "pendiente";

    }

    // Captura el valor del tipo de pago (contado o crédito)

    var pago_tipo = $("input[name='pago_tipo_v']:checked").val();

    // Variable para almacenar el estado

    var pago_e_y;

    // Verifica el tipo de pago seleccionado

    if (pago_tipo == "efectivo") {

      pago_e_y = "efectivo";

    } else {

      pago_e_y = "yape";

    }

    if (isValid) {

      var datos = new FormData();

      datos.append("id_usuario_venta", id_usuario_venta);
      datos.append("id_cliente_venta", id_cliente_venta);
      datos.append("fecha_venta", fecha_venta);
      datos.append("comprobante_venta", comprobante_venta);
      datos.append("serie_venta", serie_venta);
      datos.append("numero_venta", numero_venta);
      datos.append("igv_venta", igv_venta);
      datos.append("productoAddVenta", productoAddVenta);
      datos.append("subtotal", subtotal);
      datos.append("igv", igv);
      datos.append("total", total);
      datos.append("tipo_pago", tipo_pago);
      datos.append("estado_pago", estado_pago);
      datos.append("pago_e_y", pago_e_y);

      $.ajax({

        url: "ajax/ventas.ajax.php",

        method: "POST",

        data: datos,

        cache: false,

        contentType: false,

        processData: false,

        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res.estado === "ok") {
            $("#form_venta_producto")[0].reset();

            $("#detalle_venta_producto").empty();

            $("#subtotal_venta").text("00.00");

            $("#igv_venta_show").text("00.00");

            $("#total_precio_venta").text("00.00");

            Swal.fire({

              title: "¿Quiere imprimir comprobante?",

              text: "¡No podrás revertir esto!",

              icon: "warning",

              showCancelButton: true,

              confirmButtonColor: "#28C76F",

              cancelButtonColor: "#F52E2F",

              confirmButtonText: "¡Sí, imprimir!",
            }).then((result) => {

              if (result.isConfirmed) {

                Swal.fire({

                  title: "¡Imprimiendo!",

                  text: "Su comprobante se está imprimiento.",

                  icon: "success",
                });
              }
            });

            mostrarProductoVenta();

            seleccionFecha();

            mostrarSerieNumero();

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

  /*=============================================
  LIMPINADO LOS MODALES
  =============================================*/

  function limpiarModales() {

    $(".btn_modal_ver_close_usuario").click(function () {

      $("#mostrar_data_roles").text("");

    });

    $(".btn_modal_editar_close_usuario").click(function () {

      $("#formEditUsuario")[0].reset();

    });

    // Cuando el mouse entra en la imagen

    $(".hover_img").mouseenter(function () {

      $(this).css("transform", "scale(1.2)"); // Agranda la imagen

    });

    // Cuando el mouse sale de la imagen

    $(".hover_img").mouseleave(function () {

      $(this).css("transform", "scale(1)"); // Restaura el tamaño original

    });
    
  }

  limpiarModales();

  /*=============================================
  MOSTRANDO LOS PRODUCTOS DE LA VENTA
  =============================================*/

  mostrarProductoVenta();

  /*=============================================
  SELECCION DE LA FECHA AUTOMATICO
  =============================================*/

  seleccionFecha();

  /*=============================================
  MOSTRANDO SERIE Y NUMERO DE LA VENTA
  =============================================*/

  mostrarSerieNumero();

  /*=============================================
  MOSTRANDO EL TIPO DE PAGO (yape o efectivo)
  =============================================*/

  tipoPagoYE();

});
