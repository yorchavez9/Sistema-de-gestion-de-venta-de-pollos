<?php

require_once "../controladores/Roles.controlador.php";
require_once "../modelos/Roles.modelo.php";

class AjaxRol
{

    
    /*=============================================
	EDITAR ROL
	=============================================*/

    public $idRol;

    public function ajaxEditarRol()
    {

        $item = "id_rol";
        $valor = $this->idRol;

        $respuesta = ControladorRoles::ctrMostrarRol($item, $valor);

        echo json_encode($respuesta);
    }
    


}

/*=============================================
EDITAR ROL
=============================================*/
if (isset($_POST["idRol"])) {

    $editar = new AjaxRol();
    $editar->idRol = $_POST["idRol"];
    $editar->ajaxEditarRol();
}


//GUARDAR ROL
elseif (isset($_POST["nombre_rol"])) {

    $crearRol = new ControladorRoles();
    $crearRol->ctrCrearRoles();

}

//ACTUALIZAR CATEGORIA
elseif(isset($_POST["edit_id_rol"])){

    $editRol = new ControladorRoles();
    $editRol->ctrEditarRol();

}

//ELIMINAR CATEGORIA
elseif(isset($_POST["deleteIdRol"])){

    $borrarRol = new ControladorRoles();
    $borrarRol->ctrBorraRol();

}

//MOSTRAR CATEGORIA
else{

    $item = null;
    $valor = null;
    $mostrarRoles = ControladorRoles::ctrMostrarRol($item, $valor);
    
    $tablaUsuarios = array();
    
    foreach ($mostrarRoles as $key => $usuario) {
        
        $fila = array(
            'id_rol' => $usuario['id_rol'],
            'nombre_rol' => $usuario['nombre_rol'],
            'fecha_rol' => $usuario['fecha_rol']
        );
    
        
        $tablaUsuarios[] = $fila;
    }
    
    
    echo json_encode($tablaUsuarios);
}


?>

