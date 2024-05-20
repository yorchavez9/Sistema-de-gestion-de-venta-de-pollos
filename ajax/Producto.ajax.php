<?php

require_once "../controladores/Producto.controlador.php";
require_once "../modelos/Producto.modelo.php";

class AjaxProducto
{

    
    /*=============================================
	EDITAR PRODUCTO
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

    /*=============================================
	ACTIVAR PRODUCTO
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

    /*=============================================
	VALIDAR NO REPETIR PRODUCTO
	=============================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario()
    {

        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorProducto::ctrMostrarProductos($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR PRODUCTO
=============================================*/
if (isset($_POST["idProducto"])) {

    $editar = new AjaxProducto();
    $editar->idProducto = $_POST["idProducto"];
    $editar->ajaxEditarProducto();

}

/* VER DETALLE PRODUCTO */
elseif (isset($_POST["idProductoVer"])) {

    $verDetalle = new AjaxProducto();
    $verDetalle->idProductoVer = $_POST["idProductoVer"];
    $verDetalle->ajaxVerProducto();
}

/* MOSTRAR PRODUCTO POR STOCK */
elseif (isset($_POST["cantStock"])) {

    $item = null;
    $valor = $_POST["cantStock"];

    $productos = ControladorProducto::ctrMostrarProductosStock($item, $valor);

    echo json_encode($productos);

}

/* ACTIVAR PRODUCTO */
elseif (isset($_POST["activarProducto"])) {

    $activarProducto = new AjaxProducto();
    $activarProducto->activarProducto = $_POST["activarProducto"];
    $activarProducto->activarId = $_POST["activarId"];
    $activarProducto->ajaxActivarProducto();

}

/* VALIDAR PRODUCTO */
elseif (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxProducto();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
    
}

/* GUARDAR PRODUCTO */
elseif (isset($_POST["id_categoria_P"])) {

    $crearProducto = new ControladorProducto();
    $crearProducto->ctrCrearProducto();

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
    $mostrarProductos = ControladorProducto::ctrMostrarProductos($item, $valor);
    
    $tablaProductos = array();
    
    foreach ($mostrarProductos as $key => $usuario) {
        
        $fila = array(
            'id_producto' => $usuario['id_producto'],
            'id_categoria' => $usuario['id_categoria'],
            'nombre_categoria' => $usuario['nombre_categoria'],
            'codigo_producto' => $usuario['codigo_producto'],
            'nombre_producto' => $usuario['nombre_producto'],
            'precio_producto' => $usuario['precio_producto'],
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
