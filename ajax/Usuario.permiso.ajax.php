<?php

require_once "../controladores/Usuario.permiso.controlador.php";
require_once "../modelos/Usuario.permiso.modelo.php";

class AjaxUsuarioPermiso
{

    
    /*=============================================
	EDITAR USUARIO PERMISO
	=============================================*/

    public $idPermiso;

    public function ajaxEditarUsuarioPermiso()
    {

        $item = "id_roles_usuario";
        $valor = $this->idPermiso;

        $respuesta = ControladorPermisoUsuario::ctrMostrarPermisoUsuario($item, $valor);

        echo json_encode($respuesta);
    }
    


}

/*=============================================
EDITAR USUARIO PERMISO
=============================================*/
if (isset($_POST["idPermiso"])) {

    $editar = new AjaxUsuarioPermiso();
    $editar->idPermiso = $_POST["idPermiso"];
    $editar->ajaxEditarUsuarioPermiso();
}


//GUARDAR USUARIO PERMISO
elseif (isset($_POST["id_usuario"])) {

    $crearPermiso = new ControladorPermisoUsuario();
    $crearPermiso->ctrCrearPermisoUsuario();

}

//ACTUALIZAR CATEGORIA
elseif(isset($_POST["edit_id_rol"])){

    $editRol = new ControladorPermisoUsuario();
    $editRol->ctrEditarPermisoUsuario();

}

//ELIMINAR CATEGORIA
elseif(isset($_POST["deleteIdPermiso"])){

    $borrarRol = new ControladorPermisoUsuario();
    $borrarRol->ctrBorraPermisoUsuario();

}

//MOSTRAR CATEGORIA
else{

    $item = null;
    $valor = null;

    $mostrarPermisos = ControladorPermisoUsuario::ctrMostrarPermisoUsuario($item, $valor);
    
    $tablaPermisos = array();
    
    foreach ($mostrarPermisos as $key => $permiso) {
        
        $fila = array(
            'id_roles_usuario' => $permiso['id_roles_usuario'],
            'id_usuario' => $permiso['id_usuario'],
            'nombre_usuario' => $permiso['nombre_usuario'],
            'id_rol' => $permiso['id_rol'],
            'nombre_rol' => $permiso['nombre_rol']
        );
    
        
        $tablaPermisos[] = $fila;
    }
    
    
    echo json_encode($tablaPermisos);
}


?>

