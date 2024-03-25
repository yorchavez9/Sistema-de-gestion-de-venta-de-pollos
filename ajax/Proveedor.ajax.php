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

    /*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario()
    {

        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorProveedores::ctrMostrarProveedor($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR USUARIO
=============================================*/
if (isset($_POST["idProveedor"])) {

    $editar = new AjaxProveedores();
    $editar->idProveedor = $_POST["idProveedor"];
    $editar->ajaxEditarProveedor();
}
//ACTIVAR PROVEEDOR
elseif (isset($_POST["activarProveedor"])) {
    $activarProveedor = new AjaxProveedores();
    $activarProveedor->activarProveedor = $_POST["activarProveedor"];
    $activarProveedor->activarId = $_POST["activarId"];
    $activarProveedor->ajaxActivarProveedor();
}
//VALIDAR REPETIR PROVEEDOR
elseif (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxProveedores();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}

//GUARDAR PROVEEDOR
elseif (isset($_POST["tipo_persona"])) {

    $crearProveedor = new ControladorProveedores();
    $crearProveedor->ctrCrearProveedor();

}

//EDITAR PROVEEDOR
elseif(isset($_POST["edit_idProveedor"])){

    $editusuario = new ControladorProveedores();
    $editusuario->ctrEditarProveedor();

}

//ELIMINAR PROVEEDOR
elseif(isset($_POST["deleteUserId"])){

    $borrarUsuario = new ControladorProveedores();
    $borrarUsuario->ctrBorraProveedor();

}

//MOSTRAR PROVEEDOR
else{

    $item = null;
    $valor = null;
    $mostrarUsuarios = ControladorProveedores::ctrMostrarProveedor($item, $valor);
    
    $tablaUsuarios = array();
    
    foreach ($mostrarUsuarios as $key => $usuario) {
        
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

