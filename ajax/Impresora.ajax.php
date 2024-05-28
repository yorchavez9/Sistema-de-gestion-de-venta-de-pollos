<?php

require_once "../controladores/Impresora.controlador.php";
require_once "../modelos/Impresora.modelo.php";

class AjaxImpresora
{

    
    /*=============================================
	EDITAR IMPRESORA
	=============================================*/

    public $idImpresora;

    public function ajaxEditarImpresora()
    {

        $item = "id_impresora";
        $valor = $this->idImpresora;

        $respuesta = ControladorImpresora::ctrMostrarImpresora($item, $valor);

        echo json_encode($respuesta);
    }
    


}

/*=============================================
EDITAR IMPRESORA
=============================================*/
if (isset($_POST["idImpresora"])) {

    $editar = new AjaxImpresora();
    $editar->idImpresora = $_POST["idImpresora"];
    $editar->ajaxEditarImpresora();
}


//GUARDAR CATEGORIA
elseif (isset($_POST["nombre_impresora"])) {

    $crearImpresora = new ControladorImpresora();
    $crearImpresora->ctrCrearImpresora();

}

//ACTUALIZAR IMPRESORA
elseif(isset($_POST["id_impresora_edit"])){

    $editImpresora = new ControladorImpresora();
    $editImpresora->ctrEditarImpresora();

}

//ELIMINAR CATEGORIA
elseif(isset($_POST["idImpresoraDelete"])){

    $borrarImpresora = new ControladorImpresora();
    $borrarImpresora->ctrBorraImpresora();

}

//MOSTRAR CATEGORIA
else{

    $item = null;
    $valor = null;
    $mostrarImpresora = ControladorImpresora::ctrMostrarImpresora($item, $valor);
    
    $tablaImpresora = array();
    
    foreach ($mostrarImpresora as $key => $impresora) {
        
        $fila = array(
            'id_impresora' => $impresora['id_impresora'],
            'nombre' => $impresora['nombre'],
            'ip_impresora' => $impresora['ip_impresora'],
            'fecha' => $impresora['fecha']
        );
    
        
        $tablaImpresora[] = $fila;
    }
    
    
    echo json_encode($tablaImpresora);
}


?>
