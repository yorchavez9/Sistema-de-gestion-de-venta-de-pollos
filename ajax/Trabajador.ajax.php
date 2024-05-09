<?php

require_once "../controladores/Trabajador.controlador.php";
require_once "../modelos/Trabajador.modelo.php";

class AjaxTrabajador
{

    
    /*=============================================
	EDITAR TRABAJADOR
	=============================================*/

    public $idTrabajador;

    public function ajaxEditarTrabajador()
    {

        $item = "id_trabajador";

        $valor = $this->idTrabajador;

        $respuesta = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);

        echo json_encode($respuesta);
    }
    
    /*=============================================
	MOSTRAR DETALLE TRABAJAODR
	=============================================*/

    public $id_trabajador_ver;

    public function ajaxVerTrabajador()
    {

        $item = "id_trabajador";

        $valor = $this->id_trabajador_ver;

        $respuesta = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);

        echo json_encode($respuesta);
    }

    /*=============================================
	ACTIVAR TRABAJADOR
	=============================================*/

    public $activarTrabajador;
    public $activarId;


    public function ajaxActivarTrabajador()
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
EDITAR USUARIO
=============================================*/
if (isset($_POST["idTrabajador"])) {

    $editar = new AjaxTrabajador();
    $editar->idTrabajador = $_POST["idTrabajador"];
    $editar->ajaxEditarTrabajador();

}

/*=============================================
VER DETALLE TRABAJADOR
=============================================*/
elseif (isset($_POST["id_trabajador_ver"])) {

    $verDetalle = new AjaxTrabajador();
    $verDetalle->id_trabajador_ver = $_POST["id_trabajador_ver"];
    $verDetalle->ajaxVerTrabajador();
}

/*=============================================
ACTIVAR TRABAJADOR
=============================================*/
elseif (isset($_POST["activarTrabajador"])) {

    $activarTrabajador = new AjaxTrabajador();
    $activarTrabajador->activarTrabajador = $_POST["activarTrabajador"];
    $activarTrabajador->activarId = $_POST["activarId"];
    $activarTrabajador->ajaxActivarTrabajador();

}


/*=============================================
GUARDAR TRABAJADOR
=============================================*/
elseif (isset($_POST["nombre"])) {

    $crearTrabajador = new ControladorTrabajador();
    $crearTrabajador->ctrCrearTrabajador();

}

/*=============================================
ACTUALIZAR TRABAJADOR
=============================================*/
elseif(isset($_POST["edit_id_trabajador"])){

    $editTrabajador = new ControladorTrabajador();
    $editTrabajador->ctrEditarTrabajador();

}

/*=============================================
BORRAR TRABAJADOR
=============================================*/
elseif(isset($_POST["deleleteIdTrabajador"])){

    $borrarTrabajador = new ControladorTrabajador();
    $borrarTrabajador->ctrBorrarTrabajador();

}

/*=============================================
MOSTRAR LISTA DE TRABAJADORES
=============================================*/
else{

    $item = null;

    $valor = null;

    $mostrarTrabajadores = ControladorTrabajador::ctrMostrarTrabajadores($item, $valor);
    
    $tablaTrabajador = array();
    
    foreach ($mostrarTrabajadores as $key => $trabajador) {
        
        $fila = array(
            'id_trabajador' => $trabajador['id_trabajador'],
            'nombre' => $trabajador['nombre'],
            'num_documento' => $trabajador['num_documento'],
            'telefono' => $trabajador['telefono'],
            'correo' => $trabajador['correo'],
            'foto' => $trabajador['foto'],
            'cv' => $trabajador['cv'],
            'tipo_pago' => $trabajador['tipo_pago'],
            'num_cuenta' => $trabajador['num_cuenta'],
            'estado_trabajador' => $trabajador['estado_trabajador']
        );
    
        
        $tablaTrabajador[] = $fila;
    }
    
    
    echo json_encode($tablaTrabajador);
}


?>
