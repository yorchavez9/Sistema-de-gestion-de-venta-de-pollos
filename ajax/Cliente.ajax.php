<?php

require_once "../controladores/Cliente.controlador.php";
require_once "../modelos/Cliente.modelo.php";

class AjaxCliente
{

    
    /*=============================================
	EDITAR CLIENTE
	=============================================*/

    public $idCliente;

    public function ajaxEditarCliente()
    {

        $item = "id_persona";
        $valor = $this->idCliente;

        $respuesta = ControladorCliente::ctrMostrarCliente($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	VER CLIENTE
	=============================================*/

    public $idVerCliente;

    public function ajaxVerCliente()
    {

        $item = "id_persona";
        $valor = $this->idVerCliente;

        $respuesta = ControladorCliente::ctrMostrarCliente($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR CLIENTE
	=============================================*/

    public $activarCliente;
    public $activarId;


    public function ajaxActivarCliente()
    {

        $tabla = "personas";

        $item1 = "estado_persona";
        $valor1 = $this->activarCliente;

        $item2 = "id_persona";
        $valor2 = $this->activarId;

        $respuesta = ModeloCliente::mdlActualizarCliente($tabla, $item1, $valor1, $item2, $valor2);
    }


}

/*=============================================
EDITAR CLIENTE
=============================================*/
if (isset($_POST["idCliente"])) {

    $editar = new AjaxCliente();
    $editar->idCliente = $_POST["idCliente"];
    $editar->ajaxEditarCliente();
}
/*=============================================
VER CLIENTE
=============================================*/
elseif(isset($_POST["idVerCliente"])) {

    $ver = new AjaxCliente();
    $ver->idVerCliente = $_POST["idVerCliente"];
    $ver->ajaxVerCliente();
}
//ACTIVAR CLIENTE
elseif (isset($_POST["activarCliente"])) {
    $activarCliente = new AjaxCliente();
    $activarCliente->activarCliente = $_POST["activarCliente"];
    $activarCliente->activarId = $_POST["activarId"];
    $activarCliente->ajaxActivarCliente();
}

//GUARDAR CLIENTE
elseif (isset($_POST["tipo_persona"])) {

    $crearProveedor = new ControladorCliente();
    $crearProveedor->ctrCrearCliente();

}

//ACTUALIZAR CLIENTE
elseif(isset($_POST["edit_id_cliente"])){

    $editProveedor = new ControladorCliente();
    $editProveedor->ctrEditarCliente();

}

//ELIMINAR CLIENTE
elseif(isset($_POST["deleteIdCliente"])){

    $borrarCliente = new ControladorCliente();
    $borrarCliente->ctrBorraCliente();

}

//MOSTRAR CLIENTE
else{

    $item = null;
    $valor = null;
    $mostrarClientes = ControladorCliente::ctrMostrarCliente($item, $valor);
    
    $tablaCliente = array();
    
    foreach ($mostrarClientes as $key => $usuario) {
        
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
    
        
        $tablaCliente[] = $fila;
    }
    
    
    echo json_encode($tablaCliente);
}


?>

