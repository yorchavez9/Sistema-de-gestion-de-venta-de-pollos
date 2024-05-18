<?php

require_once "../controladores/Asistencia.controlador.php";
require_once "../modelos/Asistencia.modelo.php";

class AjaxAsistencia
{

    
    /*=============================================
	EDITAR ASISTENCIA
	=============================================*/

    public $fechaAsistencia;

    public function ajaxEditarAsistencia()
    {

        $item = "fecha_asistencia";

        $valor = $this->fechaAsistencia;

        $respuesta = ControladorAsistencia::ctrMostrarAsistencia($item, $valor);

        echo json_encode($respuesta);
    }
    

        
    /*=============================================
	VER ASISTENCIA
	=============================================*/

    public $fechaAsistenciaVer;

    public function ajaxVerAsistencia()
    {

        $item = "fecha_asistencia";

        $valor = $this->fechaAsistenciaVer;

        $respuesta = ControladorAsistencia::ctrMostrarAsistencia($item, $valor);

        echo json_encode($respuesta);
    }


    /*=============================================
	VER ASISTENCIA LISTA
	=============================================*/

    public $fechaAsistenciaVerLista;

    public function fechaAsistenciaVerLista()
    {

        $item = "fecha_asistencia";

        $valor = $this->fechaAsistenciaVerLista;

        $respuesta = ControladorAsistencia::ctrMostrarListaAsistenciaVer($item, $valor);

        echo json_encode($respuesta);
    }



}

/*=============================================
EDITAR ASISTENCIA
=============================================*/
if (isset($_POST["fechaAsistencia"])) {

    $editar = new AjaxAsistencia();
    $editar->fechaAsistencia = $_POST["fechaAsistencia"];
    $editar->ajaxEditarAsistencia();

}

/*=============================================
VER ASISTENCIA
=============================================*/
elseif (isset($_POST["fechaAsistenciaVer"])) {

    $verDetalle = new AjaxAsistencia();
    $verDetalle->fechaAsistenciaVer = $_POST["fechaAsistenciaVer"];
    $verDetalle->ajaxVerAsistencia();
}

/*=============================================
VER ASISTENCIA LISTA
=============================================*/
elseif (isset($_POST["fechaAsistenciaVerLista"])) {

    $verDetalle = new AjaxAsistencia();
    $verDetalle->fechaAsistenciaVerLista = $_POST["fechaAsistenciaVerLista"];
    $verDetalle->fechaAsistenciaVerLista();
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
elseif(isset($_POST["fechaAsistenciaDelete"])){

    $borrarAsistencia = new ControladorAsistencia();
    $borrarAsistencia->ctrBorrarAsistencia();

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
