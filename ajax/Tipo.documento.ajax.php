<?php

require_once "../controladores/Tipo.documento.controlador.php";
require_once "../modelos/Tipo.documento.modelo.php";

class AjaxTipoDocumento
{


    
    /*=============================================
	EDITAR TIPO DE USUARIO
	=============================================*/

    public $idTipoDocumento;

    public function ajaxEditarTipoDocumento()
    {

        $item = "id_doc";
        $valor = $this->idTipoDocumento;

        $respuesta = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);

        echo json_encode($respuesta);
    }

 
}

if (isset($_POST["idTipoDocumento"])) {

    $editar = new AjaxTipoDocumento();

    $editar->idTipoDocumento = $_POST["idTipoDocumento"];

    $editar->ajaxEditarTipoDocumento();

}elseif (isset($_POST["tipoNombre"])) {

    $creartipoDocumento = new ControladorTipoDocumento();

    $creartipoDocumento->ctrCrearTipoUsuario();

}elseif(isset($_POST["editIdDoc"])){

    $editDocumento = new ControladorTipoDocumento();
    $editDocumento->ctrEditarTipoDocumento();

}elseif(isset($_POST["idDocumento"])){

    $borrarDocumento = new ControladorTipoDocumento();
    $borrarDocumento->ctrBorrarTipoDocumento();

}else{

    $item = null;

    $valor = null;

    $mostrarTipoDocumentos = ControladorTipoDocumento::ctrMostrarTipoDocumento($item, $valor);
    
    $tablaTipoDocumento = array();
    
    foreach ($mostrarTipoDocumentos as $key => $usuario) {
        
        $fila = array(
            'id_doc' => $usuario['id_doc'],
            'nombre_doc' => $usuario['nombre_doc'],
            'fecha_doc' => $usuario['fecha_doc']
        );
    
        
        $tablaTipoDocumento[] = $fila;
    }
    
    
    echo json_encode($tablaTipoDocumento);
}


