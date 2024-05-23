<?php

require_once "../controladores/Ventas.controlador.php";
require_once "../controladores/Producto.controlador.php";
require_once "../modelos/Ventas.modelo.php";
require_once "../modelos/Producto.modelo.php";




/*=============================================
MOSTRAR DATOS PARA EL REPORTE
=============================================*/
if(isset($_POST["descuento_producto_r"])){

    $fecha_desde = $_POST["fecha_desde_r"];

    $fecha_hasta = $_POST["fecha_hasta_r"];

    $id_usuario = $_POST["id_usuario_r"];

    $tipo_pago = $_POST["tipo_pago_r"];

    $descuento_producto = $_POST["descuento_producto_r"];


    $mostrarPreciosModificados = ControladorVenta::ctrMostrarReporteVentasPrecioProducto($fecha_desde, $fecha_hasta, $id_usuario, $tipo_pago, $descuento_producto);
    
    $tblReporteVentaPrecio = array();
    
    foreach ($mostrarPreciosModificados as $venta) {
        
        $fila = array(
            'nombre_usuario' => $venta['nombre_usuario'],
            'nombre_producto' => $venta['nombre_producto'],
            'precio_producto' => $venta['precio_producto'],
            'precio_venta' => $venta['precio_venta'],
            'fecha_venta' => $venta['fecha_venta']
        );
        
        
        $tblReporteVentaPrecio[] = $fila;
    }
    
    
    echo json_encode($tblReporteVentaPrecio);
}


?>
