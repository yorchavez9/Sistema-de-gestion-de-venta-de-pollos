$(document).ready(function () {

    function formateoPrecio(numero) {
        return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");
    }

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

              mostrarEgresos();

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
    function mostrarEgresos() {
      
      $.ajax({
        url: "ajax/Lista.compra.ajax.php",
        type: "GET",
        dataType: "json",
        success: function (egresos) {

          var tbody = $("#data_lista_egresos");
  
          tbody.empty();
  
         // Inicializamos un conjunto vacío para almacenar los id_egreso ya procesados
        var egresosProcesados = new Set();

        egresos.forEach(function (egreso, index) {
            // Verificar si el id_egreso ya ha sido procesado
            if (!egresosProcesados.has(egreso.id_egreso)) {
                
                var restantePago = (egreso.total_compra - egreso.total_pago).toFixed(2);

                let fechaOriginal = egreso.fecha_egre;
                let partesFecha = fechaOriginal.split("-"); // Dividir la fecha en año, mes y día
                let fechaFormateada = partesFecha[2] + "/" + partesFecha[1] + "/" + partesFecha[0];

                let totalCompra = formateoPrecio(egreso.total_compra);
                let formateadoPagoRestante = formateoPrecio(restantePago);

                var fila = `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${fechaFormateada}</td>
                        <td>${egreso.razon_social}</td>
                        <td>${egreso.serie_comprobante}</td>
                        <td>${egreso.num_comprobante}</td>
                        <td>${egreso.tipo_pago}</td>
                        <td>S/ ${totalCompra}</td>
                        <td>S/ ${formateadoPagoRestante}</td>
                        <td class="text-center">
                            ${
                                restantePago == '0.00' ? '<button class="btn btn-sm rounded" style="background: #28C76F; color:white;">Completado</button>' 
                            : '<button class="btn btn-sm rounded" style="background: #FF4D4D; color:white;">Pendiente</button>'
                            }
                        </td>
                        
                        <td class="text-center">

                            <a href="#" class="me-3 btnPagarCompra" idEgreso="${egreso.id_egreso}" totalCompraEgreso=${totalCompra} pagoRestanteEgreso=${formateadoPagoRestante} data-bs-toggle="modal" data-bs-target="#modalPagarCompra">
                                <i class="fas fa-money-bill-alt fa-lg" style="color: #28C76F"></i>
                            </a>

                            <a href="#" class="me-3 btnEditarProducto" idEgreso="${egreso.id_egreso}" data-bs-toggle="modal" data-bs-target="#modalEditarProducto">
                                <i class="text-warning fas fa-edit fa-lg"></i>
                            </a>
                            <a href="#" class="me-3 btnVerProducto" idEgreso="${egreso.id_egreso}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                <i class="text-primary fa fa-eye fa-lg"></i>
                            </a>
                            <a href="#" class="me-3 btnVerProducto" idEgreso="${egreso.id_egreso}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                <i class="fa fa-print fa-lg" style="color: #0084FF"></i>
                            </a>
                            <a href="#" class="me-3 btnVerProducto" idEgreso="${egreso.id_egreso}" data-bs-toggle="modal" data-bs-target="#modalVerProducto">
                                <i class="fa fa-download fa-lg" style="color: #28C76F"></i>
                            </a>
                            <a href="#" class="me-3 confirm-text btnEliminarProducto" idEgreso="${egreso.id_egreso}" imagenProducto="${egreso.imagen_producto}">
                                <i class="fa fa-trash fa-lg" style="color: #FF4D4D"></i>
                            </a>
                        </td>
                    </tr>`;

                // Agregar la fila al tbody
                tbody.append(fila);

                // Agregar el id_egreso al conjunto de egresos procesados
                egresosProcesados.add(egreso.id_egreso);
            }
        });

          // Inicializar DataTables después de cargar los datos
          $('#tabla_lista_agreso').DataTable();
        },
        error: function (xhr, status, error) {
          console.error("Error al recuperar los usuarios:", error.mensaje);
        },
      });
    }
  
    /*=============================================
    MOSTRAR DEUDA A PAGAR
    =============================================*/

    $("#data_lista_egresos").on("click", ".btnPagarCompra", function(e){

      e.preventDefault();
      
      let idEgreso = $(this).attr("idEgreso");
      let totalCompraEgreso = $(this).attr("totalCompraEgreso");
      let pagoRestanteEgreso = $(this).attr("pagoRestanteEgreso");

      $("#id_egreso_pagar").val(idEgreso);
      $("#total_compra_show").text("S/ "+totalCompraEgreso);
      $("#total_restante_show").text("S/ "+pagoRestanteEgreso);

    })

    /*=============================================
    PAGAR DEUDA
    =============================================*/
    $("#btn_pagar_deuda_egreso").click(function (e) {

      e.preventDefault();

      var isValid = true;
  
      var id_egreso_pagar = $("#id_egreso_pagar").val();

      var monto_pagar_compra = $("#monto_pagar_compra").val();


      var total_restante_texto = $("#total_restante_show").text();


      var numero_decimal = parseFloat(
        total_restante_texto.match(/-?\d+(\.\d+)?/)[0]
      );

      if (numero_decimal <= 0.0) {
        Swal.fire({
          title: "¡Aviso!",
          text: "No tiene deudas",
          icon: "warning",
        });

        $("#frm_pagar_deuda")[0].reset();

        $("#modalPagarCompra").modal("hide");

        return;
      }



      
      // Validar el tipo de documento
      if (monto_pagar_compra === "" || monto_pagar_compra == null){
        $("#error_monto_pagar_egreso")
          .html("Por favor, ingrese el monto")
          .addClass("text-danger");
        isValid = false;
      } else if (isNaN(monto_pagar_compra)) {
        $("#error_monto_pagar_egreso")
          .html("El monto solo puede contener números")
          .addClass("text-danger");
        isValid = false;
      } else {
        $("#error_monto_pagar_egreso").html("").removeClass("text-danger");
      }
  
      // Si el formulario es válido, envíalo
      if (isValid) {

        var datos = new FormData();
        datos.append("id_egreso_pagar", id_egreso_pagar);
        datos.append("monto_pagar_compra", monto_pagar_compra);
  
        $.ajax({
          url: "ajax/Lista.compra.ajax.php",
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
              });

              $("#frm_pagar_deuda")[0].reset();

              $("#modalPagarCompra").modal("hide");
            } else {

              Swal.fire({
                title: res.estado,
                text: res.mensaje,
                icon: "error",
              });

            }
            
            mostrarEgresos();
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
          if (window.matchMedia("(max-width:767px)").matches) {
            swal({
              title: "El producto ha sido actualizado",
              type: "success",
              confirmButtonText: "¡Cerrar!",
            }).then(function (result) {
              if (result.value) {
                window.location = "usuarios";
              }
            });
          }
        },
      });
  
      if (estadoProducto == 0) {
        $(this).removeClass("btn-success").addClass("btn-danger").css({
            "background-color": "#FF4D4D",
            "color": "white",
            "border": "none" // Quita el borde del botón
        }).html("Desactivado").attr("estadoProducto", 1);
    } else {
        $(this).addClass("btn-success").removeClass("btn-danger").css({
            "background-color": "#28C76F",
            "color": "white",
            "border": "none" // Quita el borde del botón
        }).html("Activado").attr("estadoProducto", 0);
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

          if(respuesta["estado_producto"] == 1){
            $("#mostrar_estado_producto").html("<button class='btn btn-sm mt-2' style='background: #28C76F; color: white'>Activado</button>");

          }else{
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
  
              mostrarEgresos();

            } else {

              console.error("Error al actualizar los datos");

            }
          },error: function (xhr, status, error) {
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
    $("#tabla_productos").on("click",".btnEliminarProducto",function (e) {
  
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
      
                  mostrarEgresos();
  
                } else {
  
                  console.error("Error al eliminar los datos");
  
                }
              }
          });
          
          }
        });
      }
    );
  
  /*   ==========================================
    LIMPIAR MODALES
    ========================================== */
  
    $(".btn_modal_ver_close_usuario").click(function() {
  
      $("#mostrar_data_roles").text('');
    });
  
    $(".btn_modal_editar_close_usuario").click(function() {
  
      $("#formEditUsuario")[0].reset();
    });
  
  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarEgresos();
  });
  