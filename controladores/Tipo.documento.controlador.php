<?php

class ControladorTipoDocumento
{


	/*=============================================
	REGISTRO DE TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrCrearTipoUsuario()
	{


		$tabla = "tipo_documentos";


		$datos = array(
			"nombre_doc" => $_POST["tipoNombre"]
		);

		$respuesta = ModeloTipoDocumento::mdlIngresarTipoDocumento($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		} else {
			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrMostrarTipoDocumento($item, $valor)
	{

		$tabla = "tipo_documentos";

		$respuesta = ModeloTipoDocumento::mdlMostrarTipoDocumento($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrEditarTipoDocumento()
	{
        $tabla = "tipo_documentos";

        $datos = array(
            "id_doc" => $_POST["editIdDoc"],
            "nombre_doc" => $_POST["editNombreDoc"]
        );

        $respuesta = ModeloTipoDocumento::mdlEditarTipoDocumento($tabla, $datos);

        if ($respuesta == "ok") {

            echo json_encode("ok");
        }else{
            echo json_encode("error");
        }
	}

	/*=============================================
	BORRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function ctrBorrarTipoDocumento()
	{

        $tabla = "tipo_documentos";

        
         $datos =  $_POST["idDocumento"];
       

        $respuesta = ModeloTipoDocumento::mdlBorrarTipoDocumento($tabla, $datos);

        if ($respuesta == "ok") {

            echo json_encode("ok");

        } else {

            echo json_encode("ok");

        }
	}
}
