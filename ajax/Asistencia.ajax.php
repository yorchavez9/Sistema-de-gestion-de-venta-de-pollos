<?php

require_once "../controladores/Asistencia.controlador.php";
require_once "../modelos/Asistencia.modelo.php";

class AjaxAsistencia
{

    
    /*=============================================
	EDITAR ASISTENCIA
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
	MOSTRAR DETALLE ASISTENCIA
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
	ACTIVAR ASISTENCIA
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

}

/*=============================================
EDITAR ASISTENCIA
=============================================*/
if (isset($_POST["idVacacion"])) {

    $editar = new AjaxAsistencia();
    $editar->idVacacion = $_POST["idVacacion"];
    $editar->ajaxEditarVacacion();

}

/*=============================================
VER ASISTENCIA
=============================================*/
elseif (isset($_POST["idUsuarioVer"])) {

    $verDetalle = new AjaxAsistencia();
    $verDetalle->idUsuarioVer = $_POST["idUsuarioVer"];
    $verDetalle->ajaxVerUsuario();
}

/*=============================================
ACTIVAR ASISTENCIA
=============================================*/
elseif (isset($_POST["activarVacacion"])) {

    $activarUsuario = new AjaxAsistencia();
    $activarUsuario->activarVacacion = $_POST["activarVacacion"];
    $activarUsuario->activarId = $_POST["activarId"];
    $activarUsuario->ajaxActivarVacacion();

}


/*=============================================
GUARDAR ASISTENCIA
=============================================*/
elseif (isset($_POST["fecha_asistencia_a"])) {

    $crearAsistencia = new ControladorAsistencia();
    $crearAsistencia->ctrCrearAsistencia();

}

/*=============================================
ACTUALIZAR ASISTENCIA
=============================================*/
elseif(isset($_POST["edit_id_vacaciones"])){

    $editVacacion = new ControladorVacaciones();
    $editVacacion->ctrEditarVacacion();

}

/*=============================================
BORRAR ASISTENCIA
=============================================*/
elseif(isset($_POST["idVacacionDelete"])){

    $borrarVacacion = new ControladorVacaciones();
    $borrarVacacion->ctrBorrarVacacion();

}

/*=============================================
MOSTRAR ASISTENCIA
=============================================*/
else{

    $item = null;

    $valor = null;

    $mostrarAsistencia = ControladorAsistencia::ctrMostrarAsistencia($item, $valor);
    
    $tablaAsistencia = array();
    
    foreach ($mostrarAsistencia as $key => $asistencia) {
        
        $fila = array(
            'id_asistencia' => $asistencia['id_asistencia'],
            'id_trabajador' => $asistencia['id_trabajador'],
            'fecha_asistencia' => $asistencia['fecha_asistencia']
        );
    
        
        $tablaAsistencia[] = $fila;
    }
    
    
    echo json_encode($tablaAsistencia);
}


?>
