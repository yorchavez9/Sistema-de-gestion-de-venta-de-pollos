$(document).ready(function () {

  /* ===========================
  MOSTRANDO PRODUCTO
  =========================== */
  function mostrarProductos() {
    $.ajax({
      url: "ajax/Producto.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (productos) {

        console.log(productos);

        var tbody = $("#data_productos");

        tbody.empty();

        productos.forEach(function (producto, index) {

          producto.imagen_producto = producto.imagen_producto.substring(3);


          var fila = `
                        <tr>
                            <td>${index + 1}</td>
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

                            <td>
                              ${producto.estado_producto != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idProducto="' + producto.id_producto + '" estadoProducto="0">Activado</button>'
              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idProducto="' + producto.id_producto + '" estadoProducto="1">Desactivado</button>'}
                            </td>
                            
                            <td class="text-center">
                                <a href="#" class="me-3 btnEditarProducto" idProducto="${producto.id_producto}" data-bs-toggle="modal" data-bs-target="#modalEditarProducto">
                                    <i class="text-warning fas fa-edit fa-lg"></i>
                                </a>
                                <a href="#" class="me-3 btnVerProducto" idProducto="${producto.id_producto}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                    <i class="text-primary fa fa-eye fa-lg"></i>
                                </a>
                                <a href="#" class="me-3 confirm-text btnDeleteProducto" idProducto="${producto.id_producto}" imagenProducto="${producto.imagen_producto}">
                                    <i class="fa fa-trash fa-lg" style="color: #FF4D4D"></i>
                                </a>
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
        $('#tabla_productos').DataTable();
      },
      error: function (xhr, status, error) {
        console.error("Error al recuperar los usuarios:", error.mensaje);
      },
    });
  }

  /* =====================================
  VISTA PREVIA DE IMAGEN PRODUCTO
  ===================================== */
  $("#imagen_producto").change(function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $(".vistaPreviaImagenProducto").attr("src", e.target.result);

        $(".vistaPreviaImagenProducto").show();
      };

      reader.readAsDataURL(file);
    }
  });

  /* =====================================
  VISTA PREVIA IMAGEN PRODUCTO EDIT
  ===================================== */
  $("#edit_imagen_producto").change(function () {
    const file = this.files[0];

    if (file) {
      const reader = new FileReader();

      reader.onload = function (e) {
        $(".edit_vista_previa_imagen_p").attr("src", e.target.result);

        $(".edit_vista_previa_imagen_p").show();
      };

      reader.readAsDataURL(file);
    }
  });

  /* =====================================
   VALIDANDO IMAGEN DEL PRODUCTO
  ===================================== */
  $("#imagen_producto").change(function () {
    var imagen = $(this).get(0).files[0];

    if (imagen) {
      var maxSize = 5 * 1024 * 1024;

      if (imagen.size > maxSize) {
        Swal.fire({
          title: "¡Error!",
          text: "El tamaño de la imagen es demasiado grande. Por favor, seleccione una imagen más pequeña.",
          icon: "error",
        });

        $(this).val("");

        return;
      }

      var allowedTypes = ["image/jpeg", "image/png", "image/gif", "image/jpg"];

      if (allowedTypes.indexOf(imagen.type) === -1) {
        Swal.fire({
          title: "¡Error!",
          text: "El tipo de archivo seleccionado no es válido. Por favor, seleccione una imagen en formato JPEG, PNG, GIF o JPG.",
          icon: "error",
        });

        $(this).val("");

        return;
      }

    } else {
      alert("Por favor, seleccione una imagen.");
    }
  });


  /*  LIMPIADO EL VALOR DE FOCUS */
  $("#stock_producto").focus(function () {
    // Eliminar el valor por defecto si es igual a cero
    if ($(this).val() == "0") {
      $(this).val("");
    }
  });

  /* ===========================================
  GUARDAR PRODUCTO
  =========================================== */
  $("#btn_save_producto").click(function () {

    var isValid = true;

    let id_categoria_P = $("#id_categoria_P").val();
    let codigo_producto = $("#codigo_producto").val();
    let nombre_producto = $("#nombre_producto").val();
    let stock_producto = $("#stock_producto").val();
    let fecha_vencimiento = $("#fecha_vencimiento").val();
    let descripcion_producto = $("#descripcion_producto").val();
    let imagen_producto = $("#imagen_producto").get(0).files[0];



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
    if (stock_producto === "" || stock_producto === null || isNaN(stock_producto) || parseInt(stock_producto) !== parseFloat(stock_producto) || parseInt(stock_producto) <= 0) {
      $("#error_stock_p")
        .html("Por favor, ingrese un número entero positivo para el stock")
        .addClass("text-danger");
      isValid = false;
    } else {
      $("#error_stock_p").html("").removeClass("text-danger");
    }

    // Si el formulario es válido, envíalo
    if (isValid) {

      let  datos = new FormData();
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

  /*=============================================
  ACTIVAR PRODUCTO
  =============================================*/
  $("#tabla_productos").on("click", ".btnActivar", function () {
    var idProducto = $(this).attr("idProducto");
    var estadoProducto = $(this).attr("estadoProducto");

    var datos = new FormData();
    datos.append("activarId", idProducto);
    datos.append("activarProducto", estadoProducto);


    $.ajax({
      url: "ajax/Producto.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      success: function (respuesta) {
        console.log(respuesta)
      },
    });

    if (estadoProducto == 0) {
      $(this)
        .removeClass("bg-lightgreen")
        .addClass("bg-lightred")
        .html("Desactivado");
      $(this).attr("estadoProducto", 0);

    } else {
      $(this)
        .removeClass("bg-lightred")
        .addClass("bg-lightgreen")
        .html("Activado");
      $(this).attr("estadoProducto", 1);

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
        $("#mostrar_descripcion_producto").text(respuesta["descripcion_producto"]);

        if (respuesta["estado_producto"] == 1) {
          $("#mostrar_estado_producto").html("<button class='btn btn-sm mt-2' style='background: #28C76F; color: white'>Activado</button>");

        } else {
          $("#mostrar_estado_producto").html("<button class='btn btn-sm' style='background: #FF4D4D; color: white'>Desactivado</button>");

        }


        var fecha = respuesta["fecha_vencimiento"];

        var fecha_obj = new Date(fecha);

        var opciones = { year: 'numeric', month: 'long', day: '2-digit' };

        var fecha_formateada = fecha_obj.toLocaleDateString('es-ES', opciones);

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

        var data_roles = JSON.parse(respuesta["roles"])

        var rolesContainer = document.getElementById("mostrar_data_roles");

        data_roles.forEach(role => {
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
    if (edit_stock_producto === "" || edit_stock_producto === null || isNaN(edit_stock_producto) || parseInt(edit_stock_producto) !== parseFloat(edit_stock_producto) || parseInt(edit_stock_producto) <= 0) {
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
        }, error: function (xhr, status, error) {
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
  $("#tabla_productos").on("click", ".btnDeleteProducto", function (e) {

    e.preventDefault();

    let idProductoDelete = $(this).attr("idProducto");
    let imagenProductoDelete = $(this).attr("imagenProducto");
    let deleteRutaImagenProducto = "../" + imagenProductoDelete;


    let datos = new FormData();

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

            console.log(respuesta);

            mostrarProductos();

            let res = JSON.parse(respuesta);

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
  }
  );

  /*==========================================
  LIMPIAR MODALES
  ========================================== */

  $(".btn_modal_ver_close_usuario").click(function () {

    $("#mostrar_data_roles").text('');
  });

  $(".btn_modal_editar_close_usuario").click(function () {

    $("#formEditUsuario")[0].reset();
  });



  /* =========================================
  MOSTRANDO TODOS LOS PRODUCTOS PARA EL REPORTE
  ============================================ */

 
  var reporteProductos = function mostrarReporteProductos() {

    $.ajax({
      url: "ajax/Producto.ajax.php",
      type: "GET",
      dataType: "json",
      success: function (productos) {

        var tbody = $("#dataReporteProducto");

        tbody.empty();

        let contador = 1;

        productos.forEach(function (producto) {

          var fila = `
                <tr>
                    <td>
                        ${contador}
                    </td>
                    <td>${producto.codigo_producto}</td>
                    <td>${producto.nombre_producto}</td>
                    <td>S/ ${producto.precio_producto}</td>
                    <td>${producto.stock_producto}</td>
                    <td>${producto.fecha_vencimiento}</td>
                    <td>
                        ${producto.estado_producto != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idUsuario="' + producto.id_producto + '" estadoUsuario="0">Activado</button>'
                                              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idUsuario="' + producto.id_producto + '" estadoUsuario="1">Desactivado</button>'
                         }
                    </td>
                    
                </tr>`;


          // Agregar la fila al tbody

          tbody.append(fila);

          contador++;

        });

        // Inicializar DataTables después de cargar los datos
        
        $('#tabla_reporte_producto').DataTable();

      },
      error: function (xhr, status, error) {

        console.error("Error al recuperar los usuarios:", error);

      },
    });


  }


  /* =========================================
  MOSTRANDO LA BUSQUEDA POR STOCK
  ============================================ */

  var clicEnBoton = false;

  $("#btn_mostrar_producto_stock").click(function (e) {

    e.preventDefault();

    clicEnBoton = true;


    let show_sotck_reporte = $("#show_sotck_reporte").val();

    var seleccion_fecha_r = "";

    if ($("#show_fecha_vencimiento").prop("checked")) {

        seleccion_fecha_r = $("#show_fecha_vencimiento").val();

    } else {

        seleccion_fecha_r = "";

    }


    mostrarReporteProductosStock(show_sotck_reporte);

    window.open("extensiones/reportes/reporte.producto.php?show_sotck_reporte=" + show_sotck_reporte + "&seleccion_fecha_r=" + seleccion_fecha_r, "_blank");

    $('#form_mostrar_producto_stock')[0].reset();


  })


  /* ==========================================
  MOSTRANDO TODOS LOS PRODUCTOS PARA EL REPORTE
  ============================================= */

 
  function mostrarReporteProductosStock(stock) {

    var cantStock = stock;


    var datos = new FormData();

    datos.append("cantStock", cantStock);

    $.ajax({
      url: "ajax/Producto.ajax.php",
      method: "POST",
      data: datos,
      cache: false,
      contentType: false,
      processData: false,
      dataType: "json",
      success: function (productos) {


        var tbody = $("#dataReporteProducto");

        tbody.empty();

        let contador = 1;

        productos.forEach(function (producto) {

          var fila = `
                <tr>
                    <td>
                        ${contador}
                    </td>
                    <td>${producto.codigo_producto}</td>
                    <td>${producto.nombre_producto}</td>
                    <td>S/ ${producto.precio_producto}</td>
                    <td>${producto.stock_producto}</td>
                    <td>${producto.fecha_vencimiento}</td>
                    <td>
                        ${producto.estado_producto != 0 ? '<button class="btn bg-lightgreen badges btn-sm rounded btnActivar" idUsuario="' + producto.id_producto + '" estadoUsuario="0">Activado</button>'
                                              : '<button class="btn bg-lightred badges btn-sm rounded btnActivar" idUsuario="' + producto.id_producto + '" estadoUsuario="1">Desactivado</button>'
                         }
                    </td>
                    
                </tr>`;


          // Agregar la fila al tbody

          tbody.append(fila);

          contador++;

        });

        // Inicializar DataTables después de cargar los datos
        
        $('#tabla_reporte_producto').DataTable();

      },
    });

  }

  /*=============================================
  DESCARGAR REPORTE DE PROVEEDORES
  =============================================*/

  $("#btn_descargar_reporte_producto").click(function (e) {


    e.preventDefault();

    var idProducto = $(this).attr("idVenta");

    window.open("extensiones/reportes/reporte.producto.php?idProducto=" + idProducto, "_blank");

  });

  

  // Condición para verificar si se hizo clic en el botón
  if (clicEnBoton == true) {

    reporteProductos = null;
    
    $('#tabla_reporte_producto').DataTable();

  }else if(clicEnBoton == false){

    reporteProductos();
    
  }
  

  /* =====================================
  MSOTRANDO DATOS
  ===================================== */

  mostrarProductos();

  



});
