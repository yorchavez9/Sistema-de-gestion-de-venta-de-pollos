<?php

require_once "../controladores/Lista.compra.controlador.php";
require_once "../modelos/Lista.compra.modelo.php";

class AjaxListaEgreso
{

    
    /*=============================================
	EDITAR EGRESO
	=============================================*/

    public $idProducto;

    public function ajaxEditarProducto()
    {

        $item = "id_producto";
        $valor = $this->idProducto;

        $respuesta = ControladorProducto::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE EGRESO
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
	ACTIVAR EGRESO
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
EDITAR PRODUCTO
=============================================*/
if (isset($_POST["idProducto"])) {

    $editar = new AjaxListaEgreso();
    $editar->idProducto = $_POST["idProducto"];
    $editar->ajaxEditarProducto();

}

/* VER DETALLE PRODUCTO */
elseif (isset($_POST["idProductoVer"])) {

    $verDetalle = new AjaxListaEgreso();
    $verDetalle->idProductoVer = $_POST["idProductoVer"];
    $verDetalle->ajaxVerProducto();
}

/* ACTIVAR PRODUCTO */
elseif (isset($_POST["activarProducto"])) {

    $activarProducto = new AjaxListaEgreso();
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
elseif (isset($_POST["id_egreso_pagar"])) {

    $pagoEgreso = new ControladorListaCompra();
    $pagoEgreso->ctrActualizarDeudaEgreso();

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
    $mostrarEgresos = ControladorListaCompra::ctrMostrarListaEgreso($item, $valor);
    
    $tblEgreso = array();
    
    foreach ($mostrarEgresos as $key => $egreso) {
        
        $fila = array(
            'id_detalle_egreso' => $egreso['id_detalle_egreso'],
            'id_egreso' => $egreso['id_egreso'],
            'id_producto' => $egreso['id_producto'],
            'id_persona' => $egreso['id_persona'],
            'precio_compra' => $egreso['precio_compra'],
            'precio_venta' => $egreso['precio_venta'],
            'cantidad_u' => $egreso['cantidad_u'],
            'cantidad_kg' => $egreso['cantidad_kg'],
            'id_egreso' => $egreso['id_egreso'],
            'id_usuario' => $egreso['id_usuario'],
            'fecha_egre' => $egreso['fecha_egre'],
            'tipo_comprobante' => $egreso['tipo_comprobante'],
            'serie_comprobante' => $egreso['serie_comprobante'],
            'num_comprobante' => $egreso['num_comprobante'],
            'impuesto' => $egreso['impuesto'],
            'total_compra' => $egreso['total_compra'],
            'total_pago' => $egreso['total_pago'],
            'subTotal' => $egreso['subTotal'],
            'igv' => $egreso['igv'],
            'tipo_pago' => $egreso['tipo_pago'],
            'estado_pago' => $egreso['estado_pago'],
            'pago_e_y' => $egreso['pago_e_y'],
            'fecha_egreso' => $egreso['fecha_egreso'],
            'razon_social' => $egreso['razon_social']
        );
        
        
        $tblEgreso[] = $fila;
    }
    
    
    echo json_encode($tblEgreso);
}


?>

