<?php

require_once "../controladores/Usuario.controlador.php";
require_once "../modelos/Usuario.modelo.php";

class AjaxUsuarios
{



    /*=============================================
	INGRSO USUARIO
	=============================================*/

    
    /*=============================================
	EDITAR USUARIO
	=============================================*/

    public $idUsuario;

    public function ajaxEditarUsuario()
    {

        $item = "id_usuario";
        $valor = $this->idUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR USUARIO
	=============================================*/

    public $activarUsuario;
    public $activarId;


    public function ajaxActivarUsuario()
    {

        $tabla = "usuarios";

        $item1 = "estado";
        $valor1 = $this->activarUsuario;

        $item2 = "id_usuario";
        $valor2 = $this->activarId;

        $respuesta = ModeloUsuarios::mdlActualizarUsuario($tabla, $item1, $valor1, $item2, $valor2);
    }

    /*=============================================
	VALIDAR NO REPETIR USUARIO
	=============================================*/

    public $validarUsuario;

    public function ajaxValidarUsuario()
    {

        $item = "usuario";
        $valor = $this->validarUsuario;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }
}

/*=============================================
EDITAR USUARIO
=============================================*/
if (isset($_POST["idUsuario"])) {

    $editar = new AjaxUsuarios();
    $editar->idUsuario = $_POST["idUsuario"];
    $editar->ajaxEditarUsuario();
}elseif (isset($_POST["activarUsuario"])) {

    $activarUsuario = new AjaxUsuarios();
    $activarUsuario->activarUsuario = $_POST["activarUsuario"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarUsuario();
}elseif (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxUsuarios();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
}elseif (isset($_POST["nombre"])) {

$crearUsuario = new ControladorUsuarios();
$crearUsuario->ctrCrearUsuario();

}else{

    $item = null;
    $valor = null;
    $mostrarUsuarios = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);
    
    $tablaUsuarios = array();
    
    foreach ($mostrarUsuarios as $key => $usuario) {
        
        $fila = array(
            'id_usuario' => $usuario['id_usuario'],
            'nombre_usuario' => $usuario['nombre_usuario'],
            'id_doc' => $usuario['id_doc'],
            'numero_documento' => $usuario['numero_documento'],
            'direccion' => $usuario['direccion'],
            'telefono' => $usuario['telefono'],
            'correo' => $usuario['correo'],
            'usuario' => $usuario['usuario'],
            'contrasena' => $usuario['contrasena'],
            'imagen_usuario' => $usuario['imagen_usuario'],
            'estado' => $usuario['estado']
        );
    
        
        $tablaUsuarios[] = $fila;
    }
    
    
    echo json_encode($tablaUsuarios);
}


?>

