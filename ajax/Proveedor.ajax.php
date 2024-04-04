<?php

require_once "../controladores/Proveedor.controlador.php";
require_once "../modelos/Proveedor.modelo.php";

class AjaxProveedores
{

    
    /*=============================================
	EDITAR PROVEEDOR
	=============================================*/

    public $idProveedor;

    public function ajaxEditarProveedor()
    {

        $item = "id_persona";
        $valor = $this->idProveedor;

        $respuesta = ControladorProveedores::ctrMostrarProveedor($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	VER PROVEEDOR
	=============================================*/

    public $idVerProveedor;

    public function ajaxVerProveedor()
    {

        $item = "id_persona";
        $valor = $this->idVerProveedor;

        $respuesta = ControladorProveedores::ctrMostrarProveedor($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR PROVEEDOR
	=============================================*/

    public $activarProveedor;
    public $activarId;


    public function ajaxActivarProveedor()
    {

        $tabla = "personas";

        $item1 = "estado_persona";
        $valor1 = $this->activarProveedor;

        $item2 = "id_persona";
        $valor2 = $this->activarId;

        $respuesta = ModeloProveedor::mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2);
    }


}

/*=============================================
EDITAR PROVEEDOR
=============================================*/
if (isset($_POST["idProveedor"])) {

    $editar = new AjaxProveedores();
    $editar->idProveedor = $_POST["idProveedor"];
    $editar->ajaxEditarProveedor();
}
/*=============================================
VER PROVEEDOR
=============================================*/
elseif(isset($_POST["idVerProveedor"])) {

    $ver = new AjaxProveedores();
    $ver->idVerProveedor = $_POST["idVerProveedor"];
    $ver->ajaxVerProveedor();
}
//ACTIVAR PROVEEDOR
elseif (isset($_POST["activarProveedor"])) {
    $activarProveedor = new AjaxProveedores();
    $activarProveedor->activarProveedor = $_POST["activarProveedor"];
    $activarProveedor->activarId = $_POST["activarId"];
    $activarProveedor->ajaxActivarProveedor();
}

//GUARDAR PROVEEDOR
elseif (isset($_POST["tipo_persona"])) {

    $crearProveedor = new ControladorProveedores();
    $crearProveedor->ctrCrearProveedor();

}

//EDITAR PROVEEDOR
elseif(isset($_POST["edit_id_proveedor"])){

    $editProveedor = new ControladorProveedores();
    $editProveedor->ctrEditarProveedor();

}

//ELIMINAR PROVEEDOR
elseif(isset($_POST["deleteIdProveedor"])){

    $borrarProveedor = new ControladorProveedores();
    $borrarProveedor->ctrBorraProveedor();

}

//MOSTRAR PROVEEDOR
else{

    $item = null;
    $valor = null;
    $mostrarProveedores = ControladorProveedores::ctrMostrarProveedor($item, $valor);
    
    $tablaUsuarios = array();
    
    foreach ($mostrarProveedores as $key => $usuario) {
        
        $fila = array(
            'id_persona' => $usuario['id_persona'],
            'tipo_persona' => $usuario['tipo_persona'],
            'razon_social' => $usuario['razon_social'],
            'id_doc' => $usuario['id_doc'],
            'nombre_doc' => $usuario['nombre_doc'],
            'numero_documento' => $usuario['numero_documento'],
            'direccion' => $usuario['direccion'],
            'ciudad' => $usuario['ciudad'],
            'codigo_postal' => $usuario['codigo_postal'],
            'telefono' => $usuario['telefono'],
            'email' => $usuario['email'],
            'sitio_web' => $usuario['sitio_web'],
            'estado_persona' => $usuario['estado_persona'],
            'tipo_banco' => $usuario['tipo_banco'],
            'numero_cuenta' => $usuario['numero_cuenta'],
            'fecha_persona' => $usuario['fecha_persona']
        );
    
        
        $tablaUsuarios[] = $fila;
    }
    
    
    echo json_encode($tablaUsuarios);
}


?>

