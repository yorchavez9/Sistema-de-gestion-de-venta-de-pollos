<?php

require_once "../controladores/Producto.controlador.php";
require_once "../modelos/Producto.modelo.php";

require_once "../modelos/Ventas.modelo.php";
require_once "../controladores/Ventas.controlador.php";

class AjaxProductoAddVenta
{

    
    /*=============================================
	AGREGAR PRODUCTO A LA LISTA
	=============================================*/

    public $idProductoAdd;

    public function ajaxAddProducto()
    {

        $item = "id_producto";

        $valor = $this->idProductoAdd;

        $respuesta = ControladorProducto::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE PRODUCTO
	=============================================*/

    public $idProductoVer;

    public function ajaxVerProducto()
    {

        $item = "id_producto";

        $valor = $this->idProductoVer;

        $respuesta = ControladorProducto::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }

}

/*=============================================
AGREGAR PRODUCTO A LA LISTA
=============================================*/
if (isset($_POST["idProductoAdd"])) {

    $editar = new AjaxProductoAddVenta();

    $editar->idProductoAdd = $_POST["idProductoAdd"];

    $editar->ajaxAddProducto();

}

/*=============================================
VER DETALLE PRODUCTO
=============================================*/
elseif (isset($_POST["idProductoVer"])) {

    $verDetalle = new AjaxProductoAddVenta();

    $verDetalle->idProductoVer = $_POST["idProductoVer"];

    $verDetalle->ajaxVerProducto();

}


/*=============================================
GUARDAR LA VENTA
=============================================*/
elseif (isset($_POST["id_cliente_venta"])) {

    $crearVenta = new ControladorVenta();

    $crearVenta->ctrCrearVenta();

}

/*=============================================
ACTUALIZAR PRODUCTO
=============================================*/
elseif(isset($_POST["edit_id_producto"])){

    $editProducto = new ControladorProducto();

    $editProducto->ctrEditarProducto();

}

/*=============================================
BORRAR PRODUCTO
=============================================*/
elseif(isset($_POST["idProductoDelete"])){

    $borrarProducto = new ControladorProducto();
    
    $borrarProducto->ctrBorrarProducto();

}

/*=============================================
MOSTRANDO PRODUCTOS EN LA TABLA DE PUNTO VENTA
=============================================*/
else{

    $item = null;

    $valor = null;

    $mostrarProductos = ControladorProducto::ctrMostrarProductos($item, $valor);
    
    $tablaProductos = array();
    
    foreach ($mostrarProductos as $key => $usuario) {
        
        $fila = array(
            'id_producto' => $usuario['id_producto'],
            'id_categoria' => $usuario['id_categoria'],
            'nombre_categoria' => $usuario['nombre_categoria'],
            'codigo_producto' => $usuario['codigo_producto'],
            'nombre_producto' => $usuario['nombre_producto'],
            'stock_producto' => $usuario['stock_producto'],
            'fecha_vencimiento' => $usuario['fecha_vencimiento'],
            'descripcion_producto' => $usuario['descripcion_producto'],
            'imagen_producto' => $usuario['imagen_producto'],
            'estado_producto' => $usuario['estado_producto'],
            'fecha_producto' => $usuario['fecha_producto']
        );
    
        
        $tablaProductos[] = $fila;
    }
    
    
    echo json_encode($tablaProductos);
}


?>
