$(document).ready(function () {


  /* ===========================================
  GUARDAR PRODUCTO
  =========================================== */
  $("#btn_guardar_producto").click(function () {
    
    var isValid = true;

    var id_categoria_P = $("#id_categoria_P").val();
    var codigo_producto = $("#codigo_producto").val();
    var nombre_producto = $("#nombre_producto").val();
    var stock_producto = $("#stock_producto").val();
    var fecha_vencimiento = $("#fecha_vencimiento").val();
    var descripcion_producto = $("#descripcion_producto").val();
    var imagen_producto = $("#imagen_producto").get(0).files[0];



    // Validar la categoria
    if (id_categoria_P == "" || id_categoria_P == null) {

      $("#error_id_categoria_p").html("Por favor, selecione la cateogría").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_id_categoria_p").html("").removeClass("text-danger");

    }


    // Validar el codigo de producto
    if (codigo_producto == "") {

      $("#error_codigo_p").html("Por favor, ingrese el código del producto").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_codigo_p").html("").removeClass("text-danger");

    }


    // Validar el nombre del producto
    if (nombre_producto == "") {

      $("#error_nombre_p").html("Por favor, ingrese el stock").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_nombre_p").html("").removeClass("text-danger");

    }

    // Validar el stock del producto
    if (
      stock_producto === "" ||
      stock_producto === null ||
      isNaN(stock_producto) ||
      parseInt(stock_producto) !== parseFloat(stock_producto) ||
      parseInt(stock_producto) <= 0
    ) {

      $("#error_stock_p").html("Por favor, ingrese un número entero positivo para el stock").addClass("text-danger");

      isValid = false;

    } else {

      $("#error_stock_p").html("").removeClass("text-danger");

    }


    if (isValid) {

      var datos = new FormData();

      datos.append("id_categoria_P", id_categoria_P);
      datos.append("codigo_producto", codigo_producto);
      datos.append("nombre_producto", nombre_producto);
      datos.append("stock_producto", stock_producto);
      datos.append("fecha_vencimiento", fecha_vencimiento);
      datos.append("descripcion_producto", descripcion_producto);
      datos.append("imagen_producto", imagen_producto);

      $.ajax({
        url: "ajax/Producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res.estado === "ok") {

            $("#form_nuevo_producto")[0].reset();

            $(".vistaPreviaImagenProducto").attr("src", "");

            $("#modalNuevoProducto").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: res.mensaje,
              icon: "success",
            });

            mostrarProductos();

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

        }

      });
    }
  });

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
                            <a href="#" id="btnAddProducto" class="btn btn-sm me-3 btnAddProducto" idProductoAdd="${producto.id_producto}" style="background: #7367F0">
                                <i class="text-white fas fa-plus fa-lg"></i>
                            </a>
                          </td>
                          <td>${producto.codigo_producto}</td>
                          <td class="text-center">
                              <a href="javascript:void(0);" class="product-img">
                                  <img src="${producto.imagen_producto}" alt="${producto.imagen_producto}">
                              </a>
                          </td>
                          <td>${producto.nombre_categoria}</td>
                          <td>${producto.nombre_producto}</td>
                          <td class="text-center"><button type="button" class="btn btn-sm" style="${getButtonStyles(producto.stock_producto)}">${producto.stock_producto}</button></td>
                          <td>${producto.fecha_vencimiento}</td>

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

  /*=============================================
  EDITAR EL PRODUCTO
  =============================================*/
  $("#tabla_productos").on("click", ".btnEditarProducto", function (e) {

    e.preventDefault();

    var idProducto = $(this).attr("idProducto");

    var datos = new FormData();
    datos.append("idProducto", idProducto);

    $.ajax({
      url: "ajax/Producto.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#edit_id_producto").val(respuesta["id_producto"]);
        $("#edit_id_categoria_p").val(respuesta["id_categoria"]);

        $("#edit_codigo_producto").val(respuesta["codigo_producto"]);
        $("#edit_nombre_producto").val(respuesta["nombre_producto"]);
        $("#edit_stock_producto").val(respuesta["stock_producto"]);
        $("#edit_fecha_vencimiento").val(respuesta["fecha_vencimiento"]);
        $("#edit_descripcion_producto").val(respuesta["descripcion_producto"]);
        $("#edit_imagen_actual_p").val(respuesta["imagen_producto"]);

        var imagenUsuario = respuesta["imagen_producto"].substring(3);

        if (respuesta["imagen_producto"] != "") {

          $(".edit_vista_previa_imagen_p").attr("src", imagenUsuario);

        } else {

          $(".edit_vista_previa_imagen_p").attr("src","vistas/img/usuarios/default/anonymous.png"

          );

        }

      },

    });

  });

  /*=============================================
  MOSTRAR DETALLE DEL PRODUCTO
  =============================================*/
  $("#tabla_productos").on("click", ".btnVerProducto", function (e) {

    e.preventDefault();

    var idProductoVer = $(this).attr("idProducto");

    var datos = new FormData();
    datos.append("idProductoVer", idProductoVer);

    $.ajax({
      url: "ajax/Producto.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (respuesta) {

        $("#mostrar_nombre_categoria").text(respuesta["nombre_categoria"]);
        $("#mostrar_codigo_producto").text(respuesta["codigo_producto"]);
        $("#mostrar_nombre_producto").text(respuesta["nombre_producto"]);
        $("#mostrar_stock_producto").text(respuesta["stock_producto"]);
        $("#mostrar_descripcion_producto").text(respuesta["descripcion_producto"]);

        if (respuesta["estado_producto"] == 1) {

          $("#mostrar_estado_producto").html("<button class='btn btn-sm mt-2' style='background: #28C76F; color: white'>Activado</button>");

        } else {

          $("#mostrar_estado_producto").html("<button class='btn btn-sm' style='background: #FF4D4D; color: white'>Desactivado</button>" );

        }

        var fecha = respuesta["fecha_vencimiento"];

        var fecha_obj = new Date(fecha);

        var opciones = { year: "numeric", month: "long", day: "2-digit" };

        var fecha_formateada = fecha_obj.toLocaleDateString("es-ES", opciones);

        $("#mostrar_fecha_producto").text(fecha_formateada);

        var imagenUsuario = respuesta["imagen_producto"].substring(3);

        if (respuesta["imagen_producto"] != "") {

          $(".mostrarImagenProducto").attr("src", imagenUsuario);

        } else {

          $(".mostrarImagenProducto").attr("src","vistas/img/usuarios/default/anonymous.png");

        }

        var data_roles = JSON.parse(respuesta["roles"]);

        var rolesContainer = document.getElementById("mostrar_data_roles");

        data_roles.forEach((role) => {

          var roleSpan = document.createElement("span");

          roleSpan.textContent = role;

          roleSpan.classList.add("badge", "bg-primary", "me-2");

          rolesContainer.appendChild(roleSpan);

        });

      }

    });

  });

  /*===========================================
  ACTUALIZAR EL PRODUCTO
  =========================================== */
  $("#btn_actualizar_producto").click(function (e) {

    e.preventDefault();

    var isValid = true;

    var edit_id_producto = $("#edit_id_producto").val();
    var edit_id_categoria_p = $("#edit_id_categoria_p").val();
    var edit_codigo_producto = $("#edit_codigo_producto").val();
    var edit_nombre_producto = $("#edit_nombre_producto").val();
    var edit_stock_producto = $("#edit_stock_producto").val();
    var edit_fecha_vencimiento = $("#edit_fecha_vencimiento").val();
    var edit_descripcion_producto = $("#edit_descripcion_producto").val();

    var edit_imagen_producto = $("#edit_imagen_producto").get(0).files[0];
    var edit_imagen_actual_p = $("#edit_imagen_actual_p").val();


    // Validar la categoria
    if (edit_id_categoria_p == "" || edit_id_categoria_p == null) {

      $("#edit_error_id_categoria_p").html("Por favor, selecione la cateogría").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_id_categoria_p").html("").removeClass("text-danger");

    }


    // Validar el codigo de producto
    if (edit_codigo_producto == "") {

      $("#edit_error_codigo_p").html("Por favor, ingrese el código del producto").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_codigo_p").html("").removeClass("text-danger");

    }


    // Validar el nombre del producto
    if (edit_nombre_producto == "") {

      $("#edit_error_nombre_p").html("Por favor, ingrese el stock").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_nombre_p").html("").removeClass("text-danger");

    }


    // Validar el stock del producto
    if (
      edit_stock_producto === "" ||
      edit_stock_producto === null ||
      isNaN(edit_stock_producto) ||
      parseInt(edit_stock_producto) !== parseFloat(edit_stock_producto) ||
      parseInt(edit_stock_producto) <= 0
    ) {

      $("#edit_error_stock_p").html("Por favor, ingrese un número entero positivo para el stock").addClass("text-danger");

      isValid = false;

    } else {

      $("#edit_error_stock_p").html("").removeClass("text-danger");

    }


    if (isValid) {
      var datos = new FormData();
      datos.append("edit_id_producto", edit_id_producto);
      datos.append("edit_id_categoria_p", edit_id_categoria_p);
      datos.append("edit_codigo_producto", edit_codigo_producto);
      datos.append("edit_nombre_producto", edit_nombre_producto);
      datos.append("edit_stock_producto", edit_stock_producto);
      datos.append("edit_fecha_vencimiento", edit_fecha_vencimiento);
      datos.append("edit_descripcion_producto", edit_descripcion_producto);
      datos.append("edit_imagen_producto", edit_imagen_producto);
      datos.append("edit_imagen_actual_p", edit_imagen_actual_p);

      $.ajax({
        url: "ajax/Producto.ajax.php",
        method: "POST",
        data: datos,
        cache: false,
        contentType: false,
        processData: false,
        success: function (respuesta) {

          var res = JSON.parse(respuesta);

          if (res === "ok") {

            $("#form_editar_producto")[0].reset();

            $(".edit_vista_previa_imagen_p").attr("src", "");

            $("#modalEditarProducto").modal("hide");

            Swal.fire({
              title: "¡Correcto!",
              text: "El producto ha sido actualizado con éxito",
              icon: "success",
            });

            mostrarProductos();

          } else {

            console.error("Error al actualizar los datos");

          }
        },
        error: function (xhr, status, error) {

          console.error("Error al recuperar los usuarios:", error);
          console.error(xhr);
          console.error(status);

        },
      });
    }
  });

  /*=============================================
    ELIMINAR PRODUCTO
    =============================================*/
  $("#tabla_productos").on("click", ".btnEliminarProducto", function (e) {

    e.preventDefault();

    var idProductoDelete = $(this).attr("idProducto");
    var imagenProductoDelete = $(this).attr("imagenProducto");
    var deleteRutaImagenProducto = "../" + imagenProductoDelete;

    var datos = new FormData();
    datos.append("idProductoDelete", idProductoDelete);
    datos.append("deleteRutaImagenProducto", deleteRutaImagenProducto);

    Swal.fire({
      title: "¿Está seguro de borrar el producto?",
      text: "¡Si no lo está puede cancelar la accíón!",
      icon: "warning",
      showCancelButton: true,
      confirmButtonColor: "#3085d6",
      cancelButtonColor: "#FF4D4D",
      cancelButtonText: "Cancelar",
      confirmButtonText: "Si, borrar!",
    }).then(function (result) {

      if (result.value) {

        $.ajax({
          url: "ajax/Producto.ajax.php",
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
                text: "El producto ha sido eliminado",
                icon: "success",
              });

              mostrarProductos();

            } else {

              console.error("Error al eliminar los datos");

            }
          }
        });
      }
    });
  });



  /* ====================================
  BOTON GREGAR PRODUCTO
  ===================================== */

  $("#tabla_add_producto").on("mouseenter", ".btnAddProducto", function () {

      $(this).css("background", "#28C76F");

  }).on("mouseleave", ".btnAddProducto", function () {

      $(this).css("background", "#7367F0");
  });


  /* ====================================
  MOSTRAR DATOS AL DETALLE COMPRA
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
                  <th class="text-center align-middle d-none d-md-table-cell">
                      <a href="#" class="me-3 confirm-text btnEliminarAddProducto" idAddProducto="${respuesta.id_producto}" fotoUsuario="${respuesta.imagen_producto}">
                          <i class="fa fa-trash fa-lg" style="color: #F1666D"></i>
                      </a>
                  </th>
                  <td>
                      <img src="${respuesta.imagen_producto}" alt="Imagen de un pollo" width="80">
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
                      <p class="price precio_sub_total">0</p>
                  </td>
              </tr>`;

        $("#detalle_egreso_producto").append(nuevaFila);

        // Agregar evento para calcular el subtotal al cambiar la cantidad_kg o el precio_compra
        $(".cantidad_kg, .precio_compra").on("input", function () {

          var fila = $(this).closest("tr");

          var cantidad_kg = parseFloat(fila.find(".cantidad_kg").val());

          var precio_compra = parseFloat(fila.find(".precio_compra").val());

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
    $("#detalle_egreso_producto").find("tr").each(function () {

        var idProducto = $(this).find(".btnEliminarAddProducto").attr("idAddProducto");

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

      var subtotal = parseFloat($(this).find(".precio_sub_total").text().replace("S/ ", ""));

      subtotalTotal += subtotal;

    });

    // Calcular el impuesto
    var igv = subtotalTotal * (impuesto / 100);

    // Calcular el total
    var total = subtotalTotal + igv;

    // Formatear los resultados
    var subtotalFormateado = formateoPrecio(subtotalTotal.toFixed(2));
    var igvFormateado = formateoPrecio(igv.toFixed(2));
    var totalFormateado = formateoPrecio(total.toFixed(2));

    // Mostrar los resultados en el HTML
    $("#subtotal_egreso").text(subtotalFormateado);
    $("#igv_egreso").text(igvFormateado);
    $("#total_precio_egreso").text(totalFormateado);

  }


  /* ==========================================
  LIMPIAR MODALES
  ========================================== */

  $(".btn_modal_ver_close_usuario").click(function () {

    $("#mostrar_data_roles").text("");

  });

  $(".btn_modal_editar_close_usuario").click(function () {

    $("#formEditUsuario")[0].reset();

  });

  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarProductos();

});
