<?php

require_once "../controladores/Pago.trabajador.controlador.php";
require_once "../modelos/Pago.trabajador.modelo.php";
require_once "../controladores/Contrato.trabajador.controlador.php";
require_once "../modelos/Contrato.trabajador.modelo.php";

class AjaxPago
{

    
    /*=============================================
	EDITAR PAGO
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
	OBTENER MONTO DE PAGO
	=============================================*/

    public $idContratoSelect;

    public function ajaxObtenerMontoPago()
    {

        $item = "id_contrato";

        $valor = $this->idContratoSelect;

        $respuesta = ControladorContrato::ctrMostrarContratos($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE PAGO
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
	ACTIVAR PAGO
	=============================================*/

    public $activarPago;
    public $activarId;


    public function ajaxActivarPago()
    {

        $tabla = "pagos_trabajadores";

        $item1 = "estado_pago";
        $valor1 = $this->activarPago;

        $item2 = "id_pagos";
        $valor2 = $this->activarId;

        $respuesta = ModeloPago::mdlActualizarPagos($tabla, $item1, $valor1, $item2, $valor2);
    }


}

/*=============================================
EDITAR PAGO
=============================================*/
if (isset($_POST["idContrato"])) {

    $editar = new AjaxPago();
    $editar->idContrato = $_POST["idContrato"];
    $editar->ajaxEditarContrato();

}

/*=============================================
OBTENER EL MONTO A PAGAR
=============================================*/
elseif (isset($_POST["idContratoSelect"])) {

    $editar = new AjaxPago();
    $editar->idContratoSelect = $_POST["idContratoSelect"];
    $editar->ajaxObtenerMontoPago();

}

/*=============================================
VER DETALLE PAGO
=============================================*/
elseif (isset($_POST["id_trabajador_ver"])) {

    $verDetalle = new AjaxPago();
    $verDetalle->id_trabajador_ver = $_POST["id_trabajador_ver"];
    $verDetalle->ajaxVerContrato();
}

/*=============================================
ACTIVAR PAGO
=============================================*/
elseif (isset($_POST["activarPago"])) {

    $activarPago = new AjaxPago();
    $activarPago->activarPago = $_POST["activarPago"];
    $activarPago->activarId = $_POST["activarId"];
    $activarPago->ajaxActivarPago();

}


/*=============================================
GUARDAR PAGO
=============================================*/
elseif (isset($_POST["id_contrato_pago"])) {

    $crearPagoTrabajador = new ControladorPagos();
    $crearPagoTrabajador->ctrCrearPagos();

}

/*=============================================
ACTUALIZAR PAGO
=============================================*/
elseif(isset($_POST["edit_id_contrato"])){

    $editContratoTrabajador = new ControladorContrato();
    $editContratoTrabajador->ctrEditarContrato();

}

/*=============================================
BORRAR PAGO
=============================================*/
elseif(isset($_POST["idPagoDelete"])){

    $borrarPago = new ControladorPagos();
    $borrarPago->ctrBorrarPago();

}

/*=============================================
MOSTRAR LISTA DE PAGOS
=============================================*/
else{

    $item = null;

    $valor = null;

    $showPagos = ControladorPagos::ctrMostrarPagos($item, $valor);
    
    $tablaPago = array();
    
    foreach ($showPagos as $key => $pago) {
        
        $fila = array(
            'id_pagos' => $pago['id_pagos'],
            'id_contrato' => $pago['id_contrato'],
            'monto_pago' => $pago['monto_pago'],
            'id_trabajador' => $pago['id_trabajador'],
            'nombre' => $pago['nombre'],
            'fecha_contrato' => $pago['fecha_contrato'],
            'fecha_pago' => $pago['fecha_pago'],
            'estado_pago' => $pago['estado_pago']
        );
    
        
        $tablaPago[] = $fila;
    }
    
    
    echo json_encode($tablaPago);
}


?>
