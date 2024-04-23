<?php

require_once "../controladores/Ventas.controlador.php";
require_once "../controladores/Producto.controlador.php";
require_once "../modelos/Ventas.modelo.php";
require_once "../modelos/Producto.modelo.php";

class AjaxListaVentas
{

    /*=============================================
	AGREGAR PRODUCTO A LA LISTA DE VENTAS
	=============================================*/

    public $id_producto_edit;

    public function ajaxAddProducto()
    {

        $item = "id_producto";

        $valor = $this->id_producto_edit;

        $respuesta = ControladorProducto::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }


    /*=============================================
	EDITAR VENTA
	=============================================*/

    public $idVenta;

    public function ajaxEditarVenta()
    {

        $item = "id_venta";
        $valor = $this->idVenta;

        $respuesta = ControladorVenta::ctrMostrarListaVentas($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE VENTAS
	=============================================*/

    public $idProductoVer;

    public function ajaxVerProducto()
    {

        $item = "id_producto";
        $valor = $this->idProductoVer;

        $respuesta = ControladorProducto::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR VENTAS
	=============================================*/

    public $activarProducto;
    public $activarId;


    public function ajaxActivarProducto()
    {

        $tabla = "productos";

        $item1 = "estado_producto";
        $valor1 = $this->activarProducto;

        $item2 = "id_producto";
        $valor2 = $this->activarId;

        $respuesta = ModeloProducto::mdlActualizarProducto($tabla, $item1, $valor1, $item2, $valor2);
    }


}


/*=============================================
AGREGAR PRODUCTO A LA LISTA
=============================================*/

if (isset($_POST["id_producto_edit"])) {

    $editar = new AjaxListaVentas();
    $editar->id_producto_edit = $_POST["id_producto_edit"];
    $editar->ajaxAddProducto();

}

/*=============================================
EDITAR VENTA
=============================================*/
elseif (isset($_POST["idVenta"])) {

    $editar = new AjaxListaVentas();
    $editar->idVenta = $_POST["idVenta"];
    $editar->ajaxEditarVenta();

}

/* VER DETALLE PRODUCTO */
elseif (isset($_POST["idProductoVer"])) {

    $verDetalle = new AjaxListaVentas();
    $verDetalle->idProductoVer = $_POST["idProductoVer"];
    $verDetalle->ajaxVerProducto();
}

/* ACTIVAR PRODUCTO */
elseif (isset($_POST["activarProducto"])) {

    $activarProducto = new AjaxListaVentas();
    $activarProducto->activarProducto = $_POST["activarProducto"];
    $activarProducto->activarId = $_POST["activarId"];
    $activarProducto->ajaxActivarProducto();

}


/* GUARDAR PRODUCTO */
elseif (isset($_POST["id_categoria_P"])) {

    $crearProducto = new ControladorProducto();
    $crearProducto->ctrCrearProducto();

}


/* ACTUALIZAR PAGO DEUDA */
elseif (isset($_POST["id_venta_pagar"])) {

    $pagoVenta = new ControladorVenta();
    $pagoVenta->ctrActualizarDeudaVenta();

}

/* ACTUALIZAR PRODUCTO */
elseif(isset($_POST["edit_id_producto"])){

    $editProducto = new ControladorProducto();
    $editProducto->ctrEditarProducto();

}

/* BORRAR PRODUCTO */
elseif(isset($_POST["idProductoDelete"])){

    $borrarProducto = new ControladorProducto();
    $borrarProducto->ctrBorrarProducto();

}

/* MOSTRAR PRODUCTOS EN LA TABLA */
else{

    $item = null;
    $valor = null;
    $mostrarVentas = ControladorVenta::ctrMostrarListaVentas($item, $valor);
    
    $tblVenta = array();
    
    foreach ($mostrarVentas as $key => $ventas) {
        
        $fila = array(
            'id_detalle_venta' => $ventas['id_detalle_venta'],
            'id_venta' => $ventas['id_venta'],
            'id_producto' => $ventas['id_producto'],
            'id_persona' => $ventas['id_persona'],
            'precio_venta' => $ventas['precio_venta'],
            'cantidad_u' => $ventas['cantidad_u'],
            'cantidad_kg' => $ventas['cantidad_kg'],
            'id_usuario' => $ventas['id_usuario'],
            'fecha_venta' => $ventas['fecha_venta'],
            'tipo_comprobante' => $ventas['tipo_comprobante'],
            'serie_comprobante' => $ventas['serie_comprobante'],
            'num_comprobante' => $ventas['num_comprobante'],
            'impuesto' => $ventas['impuesto'],
            'total_venta' => $ventas['total_venta'],
            'total_pago' => $ventas['total_pago'],
            'sub_total' => $ventas['sub_total'],
            'igv' => $ventas['igv'],
            'tipo_pago' => $ventas['tipo_pago'],
            'estado_pago' => $ventas['estado_pago'],
            'pago_e_y' => $ventas['pago_e_y'],
            'razon_social' => $ventas['razon_social']
        );
        
        
        $tblVenta[] = $fila;
    }
    
    
    echo json_encode($tblVenta);
}


?>
