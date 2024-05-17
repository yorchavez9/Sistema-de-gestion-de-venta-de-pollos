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

        $respuesta = ControladorAsistencia::ctrMostrarListaAsistencia($item, $valor);

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


?>
