<?php

class ControladorCategoria
{



	/*=============================================
	REGISTRO DE CATEGORIA
	=============================================*/

	static public function ctrCrearCategoria()
	{



		$tabla = "categorias";

		$datos = array(
			"nombre_categoria" => $_POST["nombre_categoria"],
			"descripcion" => $_POST["descripcion_categoria"]
		);

		$respuesta = ModeloCategoria::mdlIngresarCategoria($tabla,	$datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
		} else {
			echo json_encode("error");
		}
	}

	/*=============================================
	MOSTRAR CATEGORIA
	=============================================*/

	static public function ctrMostrarCategoria($item, $valor)
	{

		$tabla = "categorias";

		$respuesta = ModeloCategoria::mdlMostrarCategoria($tabla, $item, $valor);

		return $respuesta;
	}

	/*=============================================
	EDITAR CATEGORIA
	=============================================*/

	static public function ctrEditarCategoria()
	{
		if (preg_match('/^[a-zA-Z0-9ñÑáéíóúÁÉÍÓÚ ]+$/', $_POST["edit_nombre_categoria"])) {

			$tabla = "categorias";

			$datos = array(
				"id_categoria" => $_POST["edit_id_categoria"],
				"nombre_categoria" => $_POST["edit_nombre_categoria"],
				"descripcion" => $_POST["edit_descripcion_categoria"]
			);

			$respuesta = ModeloCategoria::mdlEditarCategoria($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}

		} else {

			echo json_encode("ok");
		}
	}

	/*=============================================
	BORRAR CATEGORIA
	=============================================*/

	static public function ctrBorraCategoria()
	{

		if (isset($_POST["deleteIdCategoria"])) {

			$tabla = "categorias";

			$datos = $_POST["deleteIdCategoria"];
			
			

			$respuesta = ModeloCategoria::mdlBorrarCategoria($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}
