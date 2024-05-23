<?php

require_once "../controladores/Configuracion.ticket.controlador.php";
require_once "../modelos/Configuracion.ticket.modelo.php";

class AjaxConfiguracionTicket
{

    
    /*=============================================
	EDITAR CATEGORIA
	=============================================*/

    public $idTicket;

    public function ajaxEditarConfiguracionTicket()
    {

        $item = "id_config_ticket";
        $valor = $this->idTicket;

        $respuesta = ControladorConfiguracionTicket::ctrMostrarConfiguracionTicket($item, $valor);

        echo json_encode($respuesta);
    }
    


}

/*=============================================
EDITAR CATEGORIA
=============================================*/
if (isset($_POST["idTicket"])) {

    $editar = new AjaxConfiguracionTicket();
    $editar->idTicket = $_POST["idTicket"];
    $editar->ajaxEditarConfiguracionTicket();
}


/*=============================================
GUARDAR CONFIGURACION TICKET
=============================================*/
elseif (isset($_POST["nombre_empresa_ticket"])) {

    $crearConfiguracionTicket = new ControladorConfiguracionTicket();
    $crearConfiguracionTicket->ctrCrearConfiguracionTicket();

}

/*=============================================
ACTUALIZAR CONFIGURACION TICKET
=============================================*/
elseif(isset($_POST["edit_id_config_ticket"])){

    $editConfiguracionTicket = new ControladorConfiguracionTicket();
    $editConfiguracionTicket->ctrEditarConfiguracionTicket();

}

/*=============================================
ELIMINAR CONFIGURACION TICKET
=============================================*/
elseif(isset($_POST["idTicketDelete"])){

    $borrarConfiguracionTicket = new ControladorConfiguracionTicket();
    $borrarConfiguracionTicket->ctrBorrarConfiguracionTicket();

}

/*=============================================
MOSTRAR CONFIGURACION TICKET
=============================================*/
else{

    $item = null;
    $valor = null;
    $configuracionTicket = ControladorConfiguracionTicket::ctrMostrarConfiguracionTicket($item, $valor);
    
    $tablaTicket = array();
    
    foreach ($configuracionTicket as $key => $ticket) {
        
        $fila = array(
            'id_config_ticket' => $ticket['id_config_ticket'],
            'nombre_empresa' => $ticket['nombre_empresa'],
            'telefono' => $ticket['telefono'],
            'correo' => $ticket['correo'],
            'direccion' => $ticket['direccion'],
            'logo' => $ticket['logo'],
            'mensaje' => $ticket['mensaje'],
            'fecha_config_ticket' => $ticket['fecha_config_ticket']
        );
    
        
        $tablaTicket[] = $fila;
    }
    
    
    echo json_encode($tablaTicket);
}


?>
