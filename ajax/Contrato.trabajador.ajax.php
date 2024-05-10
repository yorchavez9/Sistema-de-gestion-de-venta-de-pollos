<?php

require_once "../controladores/Contrato.trabajador.controlador.php";
require_once "../modelos/Contrato.trabajador.modelo.php";

class AjaxContrato
{

    
    /*=============================================
	EDITAR CONTRATO
	=============================================*/

    public $idContrato;

    public function ajaxEditarContrato()
    {

        $item = "id_contrato";

        $valor = $this->idContrato;

        $respuesta = ControladorContrato::ctrMostrarContratos($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE CONTRATO
	=============================================*/

    public $id_trabajador_ver;

    public function ajaxVerContrato()
    {

        $item = "id_trabajador";

        $valor = $this->id_trabajador_ver;

        $respuesta = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR CONTRATO
	=============================================*/

    public $activarTrabajador;
    public $activarId;


    public function ajaxActivarContrato()
    {

        $tabla = "trabajadores";

        $item1 = "estado_trabajador";
        $valor1 = $this->activarTrabajador;

        $item2 = "id_trabajador";
        $valor2 = $this->activarId;

        $respuesta = ModeloTrabajador::mdlActualizarTrabajador($tabla, $item1, $valor1, $item2, $valor2);
    }


}

/*=============================================
EDITAR CONTRATO
=============================================*/
if (isset($_POST["idContrato"])) {

    $editar = new AjaxContrato();
    $editar->idContrato = $_POST["idContrato"];
    $editar->ajaxEditarContrato();

}

/*=============================================
VER DETALLE CONTRATO
=============================================*/
elseif (isset($_POST["id_trabajador_ver"])) {

    $verDetalle = new AjaxContrato();
    $verDetalle->id_trabajador_ver = $_POST["id_trabajador_ver"];
    $verDetalle->ajaxVerContrato();
}

/*=============================================
ACTIVAR CONTRATO
=============================================*/
elseif (isset($_POST["activarTrabajador"])) {

    $activarTrabajador = new AjaxContrato();
    $activarTrabajador->activarTrabajador = $_POST["activarTrabajador"];
    $activarTrabajador->activarId = $_POST["activarId"];
    $activarTrabajador->ajaxActivarContrato();

}


/*=============================================
GUARDAR CONTRATO
=============================================*/
elseif (isset($_POST["id_trabajador_c"])) {

    $crearContratoTrabajador = new ControladorContrato();
    $crearContratoTrabajador->ctrCrearContrato();

}

/*=============================================
ACTUALIZAR CONTRATO
=============================================*/
elseif(isset($_POST["edit_id_contrato"])){

    $editContratoTrabajador = new ControladorContrato();
    $editContratoTrabajador->ctrEditarContrato();

}

/*=============================================
BORRAR CONTRATO
=============================================*/
elseif(isset($_POST["idContratoDelete"])){

    $borrarContrato = new ControladorContrato();
    $borrarContrato->ctrBorrarContrato();

}

/*=============================================
MOSTRAR LISTA DE CONTRATOS
=============================================*/
else{

    $item = null;

    $valor = null;

    $mostrarContratoTrabajador = ControladorContrato::ctrMostrarContratos($item, $valor);
    
    $tablaTrabajador = array();
    
    foreach ($mostrarContratoTrabajador as $key => $contrato) {
        
        $fila = array(
            'id_contrato' => $contrato['id_contrato'],
            'id_trabajador' => $contrato['id_trabajador'],
            'nombre' => $contrato['nombre'],
            'tiempo_contrato' => $contrato['tiempo_contrato'],
            'tipo_sueldo' => $contrato['tipo_sueldo'],
            'sueldo' => $contrato['sueldo'],
            'fecha_contrato' => $contrato['fecha_contrato']
        );
    
        
        $tablaTrabajador[] = $fila;
    }
    
    
    echo json_encode($tablaTrabajador);
}


?>
