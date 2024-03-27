<?php

require_once "../controladores/Categoria.controlador.php";
require_once "../modelos/Categoria.modelo.php";

class AjaxCategoria
{

    
    /*=============================================
	EDITAR CATEGORIA
	=============================================*/

    public $idCategoria;

    public function ajaxEditarCategoria()
    {

        $item = "id_categoria";
        $valor = $this->idCategoria;

        $respuesta = ControladorCategoria::ctrMostrarCategoria($item, $valor);

        echo json_encode($respuesta);
    }
    


}

/*=============================================
EDITAR CATEGORIA
=============================================*/
if (isset($_POST["idCategoria"])) {

    $editar = new AjaxCategoria();
    $editar->idCategoria = $_POST["idCategoria"];
    $editar->ajaxEditarCategoria();
}


//GUARDAR CATEGORIA
elseif (isset($_POST["nombre_categoria"])) {

    $crearCategoria = new ControladorCategoria();
    $crearCategoria->ctrCrearCategoria();

}

//ACTUALIZAR CATEGORIA
elseif(isset($_POST["edit_id_categoria"])){

    $editCategoria = new ControladorCategoria();
    $editCategoria->ctrEditarCategoria();

}

//ELIMINAR CATEGORIA
elseif(isset($_POST["deleteIdCategoria"])){

    $borrarCategoria = new ControladorCategoria();
    $borrarCategoria->ctrBorraCategoria();

}

//MOSTRAR CATEGORIA
else{

    $item = null;
    $valor = null;
    $mostrarCategorias = ControladorCategoria::ctrMostrarCategoria($item, $valor);
    
    $tablaUsuarios = array();
    
    foreach ($mostrarCategorias as $key => $usuario) {
        
        $fila = array(
            'id_categoria' => $usuario['id_categoria'],
            'nombre_categoria' => $usuario['nombre_categoria'],
            'descripcion' => $usuario['descripcion'],
            'fecha' => $usuario['fecha']
        );
    
        
        $tablaUsuarios[] = $fila;
    }
    
    
    echo json_encode($tablaUsuarios);
}


?>

