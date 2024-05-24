<?php

require_once "../controladores/Ventas.controlador.php";
require_once "../controladores/Producto.controlador.php";
require_once "../modelos/Ventas.modelo.php";
require_once "../modelos/Producto.modelo.php";




/*=============================================
MOSTRAR DATOS PARA EL REPORTE
=============================================*/
if(isset($_POST["id_cliente_reporte"])){

    $fecha_desde = $_POST["fecha_desde_r"];

    $fecha_hasta = $_POST["fecha_hasta_r"];

    $id_usuario = $_POST["id_usuario_r"];

    $tipo_pago = $_POST["tipo_pago_r"];

    $descuento_producto = $_POST["descuento_producto_r"];

    $id_cliente_reporte = $_POST["id_cliente_reporte"];


    $mostrarReporteVentas = ControladorVenta::ctrMostrarReporteVentasCreditoCliente($fecha_desde, $fecha_hasta, $id_usuario, $tipo_pago, $descuento_producto, $id_cliente_reporte);
    
    $tblReporteVenta = array();
    
    foreach ($mostrarReporteVentas as $venta) {
        
        $fila = array(
            'id_venta' => $venta['id_venta'],
            'id_persona' => $venta['id_persona'],
            'id_usuario' => $venta['id_usuario'],
            'fecha_venta' => $venta['fecha_venta'],
            'tipo_comprobante' => $venta['tipo_comprobante'],
            'serie_comprobante' => $venta['serie_comprobante'],
            'num_comprobante' => $venta['num_comprobante'],
            'impuesto' => $venta['impuesto'],
            'total_venta' => $venta['total_venta'],
            'total_pago' => $venta['total_pago'],
            'sub_total' => $venta['sub_total'],
            'igv' => $venta['igv'],
            'tipo_pago' => $venta['tipo_pago'],
            'estado_pago' => $venta['estado_pago'],
            'pago_e_y' => $venta['pago_e_y'],
            'razon_social' => $venta['razon_social']
        );
        
        
        $tblReporteVenta[] = $fila;
    }
    
    
    echo json_encode($tblReporteVenta);
}


?>
