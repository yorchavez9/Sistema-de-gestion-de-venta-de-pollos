/* ===========================================
FORMATEO DE PRECIOS
=========================================== */
function formateoPrecio(numero) {

    return numero.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

}

function mostrarVentas() {

    $.ajax({

        url: "ajax/Lista.venta.ajax.php",

        type: "GET",

        dataType: "json",

        success: function (ventas) {


            var tbody = $("#data_ventas_reporte");

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
                      </tr>`;

                    // Agregar la fila al tbody

                    tbody.append(fila);

                    // Agregar el id_egreso al conjunto de egresos procesados

                    ventasProcesados.add(venta.id_venta);

                }

            });

            // Inicializar DataTables después de cargar los datos

            $("#tabla_reporte_ventas").DataTable();

        },
        error: function (xhr, status, error) {

            console.error(error);

            console.error(xhr);

            console.error(status);

        },

    });

}


/* =============================================
CONSULTAR VENTA
============================================= */

$("#btn_ver_reporte_ventas").click(function (e) {

    e.preventDefault();

    var descuento_producto_r = "";

    let fecha_desde_r = $("#fecha_desde_reporte_v").val();

    let fecha_hasta_r = $("#fecha_hasta_reporte_v").val();

    let id_usuario_r = $("#id_usuario_reporte_v").val();

    let tipo_pago_r = $("#tipo_pago_reporte_v").val();

    if ($("#descuento_producto_v").prop("checked")) {

        descuento_producto_r = $("#descuento_producto_v").val();

    } else {

        descuento_producto_r = "";

    }


    if (fecha_desde_r != "" && fecha_hasta_r != "" && id_usuario_r != null && tipo_pago_r != null && descuento_producto_r == "") {


        let datos = new FormData();

        datos.append("fecha_desde_r", fecha_desde_r);
        datos.append("fecha_hasta_r", fecha_hasta_r);
        datos.append("id_usuario_r", id_usuario_r);
        datos.append("tipo_pago_r", tipo_pago_r);
        datos.append("descuento_producto_r", descuento_producto_r);

        $.ajax({
            url: "ajax/Reporte.venta.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (ventas) {


                $('#section_tabla_reporte_ventas').css('display', 'none');
                $('#section_tabla_reporte_ventas_fecha').css('display', 'block');

                ventas = JSON.parse(ventas);

                var tbody = $("#data_ventas_reporte_fecha");

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
                          </tr>`;

                        // Agregar la fila al tbody

                        tbody.append(fila);

                        // Agregar el id_egreso al conjunto de egresos procesados

                        ventasProcesados.add(venta.id_venta);

                    }

                });

                // Inicializar DataTables después de cargar los datos

                $("#tabla_reporte_ventas_fecha").DataTable();

                $('#form_mostrar_venta_reporte')[0].reset();

                window.open("extensiones/reportes/reporte.ventas.php?fecha_desde_r=" + fecha_desde_r + "&fecha_hasta_r=" + fecha_hasta_r + "&id_usuario_r=" + id_usuario_r + "&tipo_pago_r=" + tipo_pago_r + "&descuento_producto_r=" + descuento_producto_r, "_blank");


            },
            error: function (xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            }
        });

    }else if(fecha_desde_r != "" && fecha_hasta_r != "" && id_usuario_r != null && tipo_pago_r == null && descuento_producto_r == ""){

        let datos = new FormData();

        datos.append("fecha_desde_r", fecha_desde_r);
        datos.append("fecha_hasta_r", fecha_hasta_r);
        datos.append("id_usuario_r", id_usuario_r);
        datos.append("tipo_pago_r", tipo_pago_r);
        datos.append("descuento_producto_r", descuento_producto_r);

        $.ajax({
            url: "ajax/Reporte.rango.fecha.venta.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (ventas) {

 

                $('#section_tabla_reporte_ventas').css('display', 'none');
                $('#section_tabla_reporte_ventas_fecha').css('display', 'none');
                $('#section_tabla_reporte_ventas_fecha_tipo_pago').css('display', 'block');

                ventas = JSON.parse(ventas);

                var tbody = $("#data_ventas_reporte_fecha_tipo_pago");

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
                          </tr>`;

                        // Agregar la fila al tbody

                        tbody.append(fila);

                        // Agregar el id_egreso al conjunto de egresos procesados

                        ventasProcesados.add(venta.id_venta);

                    }

                });

                // Inicializar DataTables después de cargar los datos

                $("#tabla_reporte_ventas_fecha").DataTable();

                $('#form_mostrar_venta_reporte')[0].reset();

                window.open("extensiones/reportes/reporte.rango.fecha.php?fecha_desde_r=" + fecha_desde_r + "&fecha_hasta_r=" + fecha_hasta_r + "&id_usuario_r=" + id_usuario_r + "&tipo_pago_r=" + tipo_pago_r + "&descuento_producto_r=" + descuento_producto_r, "_blank");


            },
            error: function (xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            }
        });

    } else {

        let datos = new FormData();

        datos.append("fecha_desde_r", fecha_desde_r);
        datos.append("fecha_hasta_r", fecha_hasta_r);
        datos.append("id_usuario_r", id_usuario_r);
        datos.append("tipo_pago_r", tipo_pago_r);
        datos.append("descuento_producto_r", descuento_producto_r);

        $.ajax({
            url: "ajax/Reporte.precio.producto.ajax.php",
            method: "POST",
            data: datos,
            cache: false,
            contentType: false,
            processData: false,
            success: function (ventasPrecio) {


                $('#section_tabla_reporte_ventas').css('display', 'none');
                $('#section_tabla_reporte_ventas_fecha').css('display', 'none');
                $('#section_tabla_reporte_ventas_precio_producto').css('display', 'block');

  
                ventasPrecio = JSON.parse(ventasPrecio);

                var tbody = $("#data_ventas_reporte_precio_producto");

                tbody.empty();

                let contador = 1;
        
                ventasPrecio.forEach(function (venta) {
        
        
                  var fila = `
                        <tr>
                            <td>${contador}</td>
                            <td>${venta.nombre_usuario}</td>
                            <td>${venta.nombre_producto}</td>
 
                            <td>S/ ${venta.precio_producto}</td>
                            <td>S/ ${venta.precio_venta}</td>
                            <td>${venta.fecha_venta}</td>
        
                        </tr>`;
        
        
                  tbody.append(fila);

                  contador++;

                });

                $("#tabla_reporte_ventas_precio_producto").DataTable();

                $('#form_mostrar_venta_reporte')[0].reset();

                window.open("extensiones/reportes/reporte.precio.producto.php?fecha_desde_r=" + fecha_desde_r + "&fecha_hasta_r=" + fecha_hasta_r + "&id_usuario_r=" + id_usuario_r + "&tipo_pago_r=" + tipo_pago_r + "&descuento_producto_r=" + descuento_producto_r, "_blank");


            },
            error: function (xhr, status, error) {
                console.error(xhr);
                console.error(status);
                console.error(error);
            }
        });
    }





})


mostrarVentas();



/*=============================================
DESCARGAR REPORTE DE USUARIO
=============================================*/

$("#btn_descargar_reporte_ventas").click(function (e) {


    e.preventDefault();

    let fecha_desde_r = $("#fecha_desde_reporte_v").val();

    let fecha_hasta_r = $("#fecha_hasta_reporte_v").val();

    let id_usuario_r = $("#id_usuario_reporte_v").val();

    let tipo_pago_r = $("#tipo_pago_reporte_v").val();

    var descuento_producto_r = "";

    if ($("#descuento_producto_v").prop("checked")) {

        descuento_producto_r = $("#descuento_producto_v").val();

    } else {

        descuento_producto_r = "";

    }

    window.open("extensiones/reportes/reporte.ventas.php?fecha_desde_r=" + fecha_desde_r + "&fecha_hasta_r=" + fecha_hasta_r + "&id_usuario_r=" + id_usuario_r + "&tipo_pago_r=" + tipo_pago_r + "&descuento_producto_r=" + descuento_producto_r, "_blank");

});
