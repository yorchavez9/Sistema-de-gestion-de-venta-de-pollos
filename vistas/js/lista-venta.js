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
                            ${
                                restantePago == '0.00' ? '<button class="btn btn-sm rounded" style="background: #28C76F; color:white;">Completado</button>' 
                            : '<button class="btn btn-sm rounded" style="background: #FF4D4D; color:white;">Pendiente</button>'
                            }
                        </td>
                        
                        <td class="text-center">

                            <a href="#" class="me-3 btnPagarCompra" idVenta="${venta.id_venta}" totalCompraVenta=${totalCompra} pagoRestanteVenta=${formateadoPagoRestante} data-bs-toggle="modal" data-bs-target="#modalPagarCompra">
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
          $('#tabla_lista_ventas').DataTable();
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
            
            mostrarVentas();
          },
        });
      }


    });


  

  
  /* =====================================
  MSOTRANDO DATOS
  ===================================== */
  mostrarVentas();
  });
  