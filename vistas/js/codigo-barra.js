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
      $("#error_id_categoria_p")
        .html("Por favor, selecione la cateogría")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#error_id_categoria_p").html("").removeClass("text-danger");
    }

    // Validar el codigo de producto
    if (codigo_producto == "") {
      $("#error_codigo_p")
        .html("Por favor, ingrese el código del producto")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#error_codigo_p").html("").removeClass("text-danger");
    }

    // Validar el nombre del producto
    if (nombre_producto == "") {
      $("#error_nombre_p")
        .html("Por favor, ingrese el stock")
        .addClass("text-danger");
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
      $("#error_stock_p")
        .html("Por favor, ingrese un número entero positivo para el stock")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#error_stock_p").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
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
        },
      });
    }
  });

  /* ===========================
    MOSTRANDO PRODUCTO
    =========================== */
  function mostrarProductos() {
    $.ajax({
      url: "ajax/Producto.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (productos) {
        var tbody = $("#data_productos_codigo_barra");

        tbody.empty();

        productos.forEach(function (producto, index) {
          producto.imagen_producto = producto.imagen_producto.substring(3);

          var fila = `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${producto.codigo_producto}</td>

                            <td class="text-center">
                                <a href="javascript:void(0);" class="product-img">
                                    <img src="${
                                      producto.imagen_producto
                                    }" alt="${producto.imagen_producto}">
                                </a>
                            </td>

                            <td>${producto.nombre_categoria}</td>

                            <td>${producto.nombre_producto}</td>

                            <td class="text-center"><button type="button" class="btn btn-sm" style="${getButtonStyles(
                              producto.stock_producto
                            )}">${producto.stock_producto}</button></td>

                            <td>${producto.fecha_vencimiento}</td>
                            
                            <td class="text-center">

                                <button href="#" class="me- btn btn-primary btnGenerarCodigoBarra" idProducto="${
                                  producto.id_producto
                                }" nombreProducto="${
            producto.nombre_producto
          }" codigoProducto="${
            producto.codigo_producto
          }" data-bs-toggle="modal" data-bs-target="#modalEditarProducto">
                                    <i class="text-white me-2 fas fa-barcode fa-lg"></i>Código de barra
                                </button>

                            </td>
                        </tr>`;

          function getButtonStyles(stock) {
            if (stock > 20) {
              return "background-color: #28C76F; color: white; border: none;"; // Verde
            } else if (stock >= 10 && stock <= 20) {
              return "background-color: #FF9F43; color: white; border: none;"; // Naranja
            } else {
              return "background-color: #FF4D4D; color: white; border: none;"; // Rojo
            }
          }

          // Agregar la fila al tbody
          tbody.append(fila);
        });
        // Inicializar DataTables después de cargar los datos
        $("#tabla_productos_codigo_barra").DataTable();
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error.mensaje);
      },
    });
  }

  /* =============================================
    MOSTRANDO DATOS PARA CODIGO DE BARRA
    ============================================= */

  $("#tabla_productos_codigo_barra").on(
    "click",
    ".btnGenerarCodigoBarra",
    function (e) {
      e.preventDefault();

      let idProducto = $(this).attr("idProducto");
      let nombreProducto = $(this).attr("nombreProducto");
      let codigoProducto = $(this).attr("codigoProducto");

      $("#id_producto_codigo_barrar").val(idProducto);
      $("#show_data_nombre_producto").text(nombreProducto);
      $("#show_data_codigo_producto").text(codigoProducto);
    }
  );

  $("#generate").click(function () {
    // Obtener el código de producto, que incluye letras y números
    let codigoProducto = $("#show_data_codigo_producto").text();

    let quantity = parseFloat($("#quantity").val());
    let barWidth = parseFloat($("#barWidth").val());
    let barHeight = parseFloat($("#barHeight").val());

    // Limpiar el contenedor de códigos de barras antes de generar nuevos
    let container = $("#barcodeContainer");
    container.empty();

    // Crear y configurar códigos de barras según la cantidad especificada
    for (var i = 0; i < quantity; i++) {
      var svg = document.createElementNS("http://www.w3.org/2000/svg", "svg");
      $(svg).addClass("barcode");
      container.append(svg);

      JsBarcode(svg, codigoProducto, {
        format: "CODE128", // Cambiar el formato a Code 128 para manejar caracteres alfanuméricos
        lineColor: "#000",
        width: barWidth,
        height: barHeight,
        displayValue: true,
      });
    }
  });

  /*=============================================
    EDITAR EL PRODUCTO
    =============================================*/
  $("#tabla_productos").on("click", ".btnEditarProducto", function () {
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
          $(".edit_vista_previa_imagen_p").attr(
            "src",
            "vistas/img/usuarios/default/anonymous.png"
          );
        }
      },
    });
  });

  /*=============================================
    MOSTRAR DETALLE DEL PRODUCTO
    =============================================*/
  $("#tabla_productos").on("click", ".btnVerProducto", function () {
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
        $("#mostrar_descripcion_producto").text(
          respuesta["descripcion_producto"]
        );

        if (respuesta["estado_producto"] == 1) {
          $("#mostrar_estado_producto").html(
            "<button class='btn btn-sm mt-2' style='background: #28C76F; color: white'>Activado</button>"
          );
        } else {
          $("#mostrar_estado_producto").html(
            "<button class='btn btn-sm' style='background: #FF4D4D; color: white'>Desactivado</button>"
          );
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
          $(".mostrarImagenProducto").attr(
            "src",
            "vistas/img/usuarios/default/anonymous.png"
          );
        }

        var data_roles = JSON.parse(respuesta["roles"]);

        var rolesContainer = document.getElementById("mostrar_data_roles");

        data_roles.forEach((role) => {
          var roleSpan = document.createElement("span");
          roleSpan.textContent = role;
          roleSpan.classList.add("badge", "bg-primary", "me-2"); // Añade clases de Bootstrap para hacer que los roles se vean como insignias coloridas
          rolesContainer.appendChild(roleSpan);
        });
      },
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
      $("#edit_error_id_categoria_p")
        .html("Por favor, selecione la cateogría")
        .addClass("text-danger");

      isValid = false;
    } else {
      $("#edit_error_id_categoria_p").html("").removeClass("text-danger");
    }

    // Validar el codigo de producto
    if (edit_codigo_producto == "") {
      $("#edit_error_codigo_p")
        .html("Por favor, ingrese el código del producto")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_codigo_p").html("").removeClass("text-danger");
    }

    // Validar el nombre del producto
    if (edit_nombre_producto == "") {
      $("#edit_error_nombre_p")
        .html("Por favor, ingrese el stock")
        .addClass("text-danger");
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
      $("#edit_error_stock_p")
        .html("Por favor, ingrese un número entero positivo para el stock")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#edit_error_stock_p").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
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
          },
        });
      }
    });
  });

  /*   ==========================================
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

  /* =====================================
  IMPRIMIR CODIGO DE CORRAS
  ===================================== */

  $("#printBtnBarra").click(function () {

    var divContents = $("#barcodeContainer").html();
    var printWindow = window.open("", "", "height=400,width=800");
    printWindow.document.write("<html><head><title>Impresión</title>");
    printWindow.document.write("</head><body >");
    printWindow.document.write(divContents);
    printWindow.document.write("</body></html>");
    printWindow.document.close();
    printWindow.print();

  });

  $("#btnSalirCodigoBarra").click(function () {

    $("#barcodeContainer").empty();

  });
});
