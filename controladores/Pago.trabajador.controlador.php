<?php

class ControladorContrato
{


	/*=============================================
	REGISTRO DE CONTRATO
	=============================================*/

	static public function ctrCrearContrato()
	{


		$tabla = "contratos_trabajadores";


		$datos = array(
			"id_trabajador" => $_POST["id_trabajador_c"],
			"tiempo_contrato" => $_POST["tiempo_contrato_t"],
			"tipo_sueldo" => $_POST["tipo_sueldo_c"],
			"sueldo" => $_POST["sueldo_trabajador"]
		);


		$respuesta = ModeloContrato::mdlIngresarContrato($tabla, $datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
            
		} else {

			echo json_encode("error");

		}
	}

	/*=============================================
	MOSTRAR CONTRATO
	=============================================*/

	static public function ctrMostrarContratos($item, $valor)
	{

		$tablaT = "trabajadores";
		$tablaC = "contratos_trabajadores";

		$respuesta = ModeloContrato::mdlMostrarContratos($tablaT, $tablaC, $item, $valor);

		return $respuesta;
	}

    /*=============================================
	EDITAR CONTRATO
	=============================================*/

    static public function ctrEditarContrato()
    {



        $tabla = "contratos_trabajadores";

        $datos = array(
            "id_contrato" => $_POST["edit_id_contrato"],
            "id_trabajador" => $_POST["edit_id_trabajador_contrato"],
            "tiempo_contrato" => $_POST["edit_tiempo_contrato_t"],
            "tipo_sueldo" => $_POST["edit_tipo_sueldo_c"],
            "sueldo" => $_POST["edit_sueldo_trabajador"]
        );


        $respuesta = ModeloContrato::mdlEditarContrato($tabla, $datos);

        if ($respuesta == "ok") {

            echo json_encode("ok");
        }
    }

	/*=============================================
	BORRAR CONTRATO
	=============================================*/

	static public function ctrBorrarContrato()
	{

		if (isset($_POST["idContratoDelete"])) {

			$tabla = "contratos_trabajadores";

			$datos = $_POST["idContratoDelete"];

			$respuesta = ModeloContrato::mdlBorrarContrato($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}
