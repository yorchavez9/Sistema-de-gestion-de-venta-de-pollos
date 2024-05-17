<?php

require_once "../controladores/Vacaciones.controlador.php";
require_once "../modelos/Vacaciones.modelo.php";

class AjaxVacaciones
{

    
    /*=============================================
	EDITAR VACACIONES
	=============================================*/

    public $idVacacion;

    public function ajaxEditarVacacion()
    {

        $item = "id_vacacion";
        $valor = $this->idVacacion;

        $respuesta = ControladorVacaciones::ctrMostrarVacacion($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE VACACIONBES
	=============================================*/

    public $idUsuarioVer;

    public function ajaxVerUsuario()
    {

        $item = "id_usuario";
        $valor = $this->idUsuarioVer;

        $respuesta = ControladorUsuarios::ctrMostrarUsuarios($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR VACACIONES
	=============================================*/

    public $activarVacacion;
    public $activarId;


    public function ajaxActivarVacacion()
    {

        $tabla = "vacaciones";

        $item1 = "estado_vacion";
        $valor1 = $this->activarVacacion;

        $item2 = "id_vacacion";
        $valor2 = $this->activarId;

        $respuesta = ModeloVacaciones::mdlActualizarVacacion($tabla, $item1, $valor1, $item2, $valor2);
    }

    /*=============================================
	VALIDAR NO REPITIR VACACIONES
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
EDITAR VACACION
=============================================*/
if (isset($_POST["idVacacion"])) {

    $editar = new AjaxVacaciones();
    $editar->idVacacion = $_POST["idVacacion"];
    $editar->ajaxEditarVacacion();

}

/* VER VACACION */
elseif (isset($_POST["idUsuarioVer"])) {

    $verDetalle = new AjaxVacaciones();
    $verDetalle->idUsuarioVer = $_POST["idUsuarioVer"];
    $verDetalle->ajaxVerUsuario();
}

/* ACTIVAR VACACION */
elseif (isset($_POST["activarVacacion"])) {

    $activarUsuario = new AjaxVacaciones();
    $activarUsuario->activarVacacion = $_POST["activarVacacion"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarVacacion();

}

/* VALIDAR VACACION */
elseif (isset($_POST["validarUsuario"])) {

    $valUsuario = new AjaxVacaciones();
    $valUsuario->validarUsuario = $_POST["validarUsuario"];
    $valUsuario->ajaxValidarUsuario();
    
}

/* GUARDAR VACACION */
elseif (isset($_POST["fecha_inicio"])) {

    $crearVacacion = new ControladorVacaciones();
    $crearVacacion->ctrCrearVacaciones();

}

/* ACTUALIZAR VACACION */
elseif(isset($_POST["edit_id_vacaciones"])){

    $editVacacion = new ControladorVacaciones();
    $editVacacion->ctrEditarVacacion();

}

/* BORRAR VACACION */
elseif(isset($_POST["idVacacionDelete"])){

    $borrarVacacion = new ControladorVacaciones();
    $borrarVacacion->ctrBorrarVacacion();

}

/* MOSTRAR VACACIONES */
else{

    $item = null;

    $valor = null;

    $mostrarVacaciones = ControladorVacaciones::ctrMostrarVacacion($item, $valor);
    
    $tablaVacaciones = array();
    
    foreach ($mostrarVacaciones as $key => $vacacion) {
        
        $fila = array(
            'id_vacacion' => $vacacion['id_vacacion'],
            'id_trabajador' => $vacacion['id_trabajador'],
            'nombre' => $vacacion['nombre'],
            'fecha_inicio' => $vacacion['fecha_inicio'],
            'fecha_fin' => $vacacion['fecha_fin'],
            'estado_vacion' => $vacacion['estado_vacion']
        );
    
        
        $tablaVacaciones[] = $fila;
    }
    
    
    echo json_encode($tablaVacaciones);
}


?>
