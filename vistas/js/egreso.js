$(document).ready(function () {
  /* ===================================
  SELECCION DE TIPO DE PAGO
  =================================== */
  function tipoPago() {
    // Obtener todos los elementos <a> con la clase "paymentmethod"
    var paymentMethodLinks = document.querySelectorAll("a.paymentmethod");

    // Iterar sobre cada elemento <a>
    paymentMethodLinks.forEach(function (link) {
      // Añadir un evento de clic a cada elemento <a>
      link.addEventListener("click", function () {
        // Obtener el radio button dentro del elemento <a> actual
        var radioButton = this.querySelector(".tipo_pago_egreso");

        // Verificar si el radio button no está marcado
        if (!radioButton.checked) {
          // Marcar el radio button
          radioButton.checked = true;
        }
      });
    });
  }

  tipoPago();

  /*=============================================
  SELECION DE FECHA AUTOMATICO
  =============================================*/
  function seleccionFecha() {
    const today = new Date().toISOString().split("T")[0];

    // Asignar la fecha actual al campo de entrada de fecha
    document.getElementById("fecha_egreso").value = today;
  }

  /*=============================================
  MOSTRAR PRODUCTOS
  =============================================*/
  function mostrarProductos() {
    $.ajax({
      url: "ajax/Producto.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (productos) {
        var tbody = $("#data_productos_detalle");

        tbody.empty();

        productos.forEach(function (producto, index) {
          producto.imagen_producto = producto.imagen_producto.substring(3);

          var fila = `
                      <tr>
                         
                          <td class="text-center">
                              <a href="#" id="btnAddProducto" class=" hover_img_a btnAddProducto" idProductoAdd="${
                                producto.id_producto
                              }">
                                  <img class="hover_img" src="${
                                    producto.imagen_producto
                                  }" alt="${producto.imagen_producto}">
                              </a>
                          </td>
                          <td>${producto.nombre_categoria}</td>
                          <td>${producto.nombre_producto}</td>
                          <td class="text-center"><button type="button" class="btn btn-sm" style="${getButtonStyles(
                            producto.stock_producto
                          )}">${producto.stock_producto}</button></td>

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

        $("#tabla_add_producto").DataTable();
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error.mensaje);
      },
    });
  }

  /* ============================================
  MOSTRAR SERIE Y NUMERO DE VENTA 
  ============================================ */

  function mostrarSerieNumero() {
    $.ajax({
      url: "ajax/SerieNumero.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (respuesta) {

        if(respuesta == "" || respuesta == null){
          $("#serie_comprobante").val("T0001");
          $("#num_comprobante").val("0001");
        }

        respuesta.forEach((data) => {
          var serie = parseInt(data.serie_comprobante.match(/\d+/)[0]);
          var numero = parseInt(data.num_comprobante.match(/\d+/)[0]);

          // Sumar 1 a los números
          serie += 1;
          numero += 1;

          // Formatear serie con ceros a la izquierda
          var seriComprobante = "T" + serie.toString().padStart(4, "0");
          // Formatear número con ceros a la izquierda, calculando la longitud dinámicamente
          var numeroComprobante = numero.toString().padStart(data.num_comprobante.length, "0");

          $("#serie_comprobante").val(seriComprobante);
          $("#num_comprobante").val(numeroComprobante);

        });
      },
      error: function (xhr, status, error) {
        console.error(xhr);
        console.error(status);
        console.error(error);
      },
    });
  }

  /* ====================================
  AGREGAR PRODUCTO A LA TABLA DETALLE
  ===================================== */

  $("#tabla_add_producto").on("click", ".btnAddProducto", function (e) {
    e.preventDefault();

    var idProductoAdd = $(this).attr("idProductoAdd");

    var datos = new FormData();
    datos.append("idProductoAdd", idProductoAdd);

    $.ajax({
      url: "ajax/Compra.ajax.php",
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
                  
                    <input type="hidden" class="id_producto_egreso" value="${respuesta.id_producto}">
                  
                  <th class="text-center align-middle d-none d-md-table-cell">
                      <a href="#" class="me-3 confirm-text btnEliminarAddProducto" idAddProducto="${respuesta.id_producto}" fotoUsuario="${respuesta.imagen_producto}">
                          <i class="fa fa-trash fa-lg" style="color: #F1666D"></i>
                      </a>
                  </th>
                  <td>
                      <img src="${respuesta.imagen_producto}" alt="Imagen de un pollo" width="50">
                  </td>
                  <td>${respuesta.nombre_producto}</td>
                  <td>
                      <input type="number" class="form-control form-control-sm cantidad_u" value="0">
                  </td>
                  <td>
                      <input type="number" class="form-control form-control-sm cantidad_kg" value="0">
                  </td>
                  <td>
                      <input type="number" class="form-control form-control-sm precio_compra" value="0">
                  </td>
                  <td>
                      <input type="number" class="form-control form-control-sm precio_venta" value="0">
                  </td>
                  <td style="text-align: right;">
                      <p class="price">S/ <span class="precio_sub_total">0.00</span></p>
                  </td>
              </tr>`;

        $("#detalle_egreso_producto").append(nuevaFila);

        // Agregar evento para calcular el subtotal al cambiar la cantidad_kg o el precio_compra
        $(".cantidad_kg, .precio_compra").on("input", function () {
          var fila = $(this).closest("tr");

          var cantidad_kg = parseFloat(fila.find(".cantidad_kg").val());

          var precio_compra = parseFloat(fila.find(".precio_compra").val());

          // Verificar si cantidad_kg o precio_compra son NaN y asignar 0 en su lugar
          if (isNaN(cantidad_kg)) {
            cantidad_kg = 0;
          }
          if (isNaN(precio_compra)) {
            precio_compra = 0;
          }

          var subtotal = cantidad_kg * precio_compra;

          var formateadoSubTotal = formateoPrecio(subtotal.toFixed(2));

          fila.find(".precio_sub_total").text(formateadoSubTotal);

          // Calcular y mostrar el total
          calcularTotal();
        });
      },
    });

    calcularTotal();

    $(document).ready(function () {
      calcularTotal();
    });
  });

  /* =============================================
  ELIMINAR EL PRODUCTO AGREGADO DE LA LISTA
  ============================================= */

  $(document).on("click", ".btnEliminarAddProducto", function (e) {
    e.preventDefault();

    var idProductoEliminar = $(this).attr("idAddProducto");

    // Encuentra la fila que corresponde al producto a eliminar y elimínala
    $("#detalle_egreso_producto")
      .find("tr")
      .each(function () {
        var idProducto = $(this)
          .find(".btnEliminarAddProducto")
          .attr("idAddProducto");

        if (idProducto == idProductoEliminar) {
          $(this).remove();

          // Una vez eliminada la fila, recalcular el total
          calcularTotal();

          return false; // Termina el bucle una vez que se ha encontrado y eliminado la fila
        }
      });
  });

  /*============================================
  FORMATEAR LOS PRECIOS
  ============================================ */

  function formateoPrecio(numero) {
    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
  }

  function calcularTotal() {
    var subtotalTotal = 0;

    var impuesto = parseFloat($("#impuesto_egreso").val());

    // Recorrer todas las filas para sumar los subtotales
    $("#detalle_egreso_producto tr").each(function () {
      var subtotalString = $(this)
        .find(".precio_sub_total")
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
    $("#subtotal_egreso").text(subtotalFormateado);
    $("#igv_egreso").text(igvFormateado);
    $("#total_precio_egreso").text(totalFormateado);
  }

  /* ===========================================
  CREAR VENTA EGRESO
  =========================================== */
  $("#btn_crear_venta").click(function (e) {
    e.preventDefault();

    var isValid = true;

    var id_usuario_egreso = $("#id_usuario_egreso").val();
    var id_proveedor_egreso = $("#id_proveedor_egreso").val();
    var fecha_egreso = $("#fecha_egreso").val();
    var tipo_comprobante_egreso = $("#tipo_comprobante_egreso").val();
    var serie_comprobante = $("#serie_comprobante").val();
    var num_comprobante = $("#num_comprobante").val();
    var impuesto_egreso = $("#impuesto_egreso").val();

    // Validar la categoria
    if (id_proveedor_egreso == "" || id_proveedor_egreso == null) {
      $("#error_egreso_proveedor")
        .html("Por favor, selecione el proveedor")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#error_egreso_proveedor").html("").removeClass("text-danger");
    }

    // Validar el codigo de producto
    if (fecha_egreso == "") {
      $("#error_egreso_fecha")
        .html("Por favor, ingrese ingrese la fecha")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#error_egreso_fecha").html("").removeClass("text-danger");
    }

    // Validar el nombre del producto
    if (tipo_comprobante_egreso == "" || tipo_comprobante_egreso == null) {
      $("#error_compra_comprobante")
        .html("Por favor, ingrese el tipo de comprobante")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#error_compra_comprobante").html("").removeClass("text-danger");
    }

    // Array para almacenar los valores de los productos
    var valoresProductos = [];

    // Iterar sobre cada fila de producto
    $("#detalle_egreso_producto tr").each(function () {
      var fila = $(this);

      // Obtener los valores de cada campo en la fila
      var idProductoEgreso = fila.find(".id_producto_egreso").val();
      var cantidadU = fila.find(".cantidad_u").val();
      var cantidadKg = fila.find(".cantidad_kg").val();
      var precioCompra = fila.find(".precio_compra").val();
      var precioVenta = fila.find(".precio_venta").val();

      // Crear un objeto con los valores y agregarlo al array
      var producto = {
        idProductoEgreso: idProductoEgreso,
        cantidad_u: cantidadU,
        cantidad_kg: cantidadKg,
        precio_compra: precioCompra,
        precio_venta: precioVenta,
      };

      valoresProductos.push(producto);
    });

    var productoAddEgreso = JSON.stringify(valoresProductos);

    var subtotal = $("#subtotal_egreso").text().replace(/,/g, "");

    var igv = $("#igv_egreso").text().replace(/,/g, "");

    var total = $("#total_precio_egreso").text().replace(/,/g, "");

    // Captura el valor del tipo de pago (contado o crédito)
    var tipo_pago = $("input[name='forma_pago']:checked").val();

    // Variable para almacenar el estado
    var estado_pago;

    // Verifica el tipo de pago seleccionado
    if (tipo_pago == "contado") {
      estado_pago = "completado";
    } else {
      estado_pago = "pendiente";
    }

    // Captura el valor del tipo de pago (contado o crédito)
    var pago_tipo = $("input[name='pago_tipo']:checked").val();

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

      datos.append("id_proveedor_egreso", id_proveedor_egreso);
      datos.append("id_usuario_egreso", id_usuario_egreso);
      datos.append("fecha_egreso", fecha_egreso);
      datos.append("tipo_comprobante_egreso", tipo_comprobante_egreso);
      datos.append("serie_comprobante", serie_comprobante);
      datos.append("num_comprobante", num_comprobante);
      datos.append("impuesto_egreso", impuesto_egreso);

      datos.append("productoAddEgreso", productoAddEgreso);

      datos.append("subtotal", subtotal);
      datos.append("igv", igv);
      datos.append("total", total);
      datos.append("tipo_pago", tipo_pago);
      datos.append("estado_pago", estado_pago);
      datos.append("pago_e_y", pago_e_y);

      $.ajax({
        url: "ajax/Compra.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {
          var res = JSON.parse(respuesta);

          if (res.estado === "ok") {
            $("#form_compra_producto")[0].reset();
            $("#detalle_egreso_producto").empty();
            $("#subtotal_egreso").text("00.00");
            $("#igv_egreso").text("00.00");
            $("#total_precio_egreso").text("00.00");

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

            mostrarProductos();
            seleccionFecha();
            mostrarSerieNumero();
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

  /* ==========================================
  LIMPIAR MODALES
  ========================================== */
  function limpiarModales(){
    
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

  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarProductos();
  seleccionFecha();
  mostrarSerieNumero();
});
