<?php

class ControladorPagos
{


	/*=============================================
	REGISTRO DE PAGOS
	=============================================*/

	static public function ctrCrearPagos()
	{


		$tabla = "pagos_trabajadores";


		$datos = array(
			"id_contrato" => $_POST["id_contrato_pago"],
			"monto_pago" => $_POST["monto_pago_t"],
			"fecha_pago" => $_POST["fecha_pago_t"]
		);


		$respuesta = ModeloPago::mdlIngresarPagos($tabla, $datos);

		if ($respuesta == "ok") {

			echo json_encode("ok");
            
		} else {

			echo json_encode("error");

		}
	}

	/*=============================================
	MOSTRAR PAGOS
	=============================================*/

	static public function ctrMostrarPagos($item, $valor)
	{

		$tablaT = "trabajadores";
		$tablaC = "contratos_trabajadores";
		$tablaP = "pagos_trabajadores";

		$respuesta = ModeloPago::mdlMostrarPagos($tablaT, $tablaC, $tablaP, $item, $valor);

		return $respuesta;
	}

    /*=============================================
	EDITAR PAGO
	=============================================*/

    static public function ctrEditarPago()
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
	BORRAR PAGO
	=============================================*/

	static public function ctrBorrarPago()
	{

		if (isset($_POST["idPagoDelete"])) {

			$tabla = "pagos_trabajadores";

			$datos = $_POST["idPagoDelete"];

			$respuesta = ModeloPago::mdlBorrarPagos($tabla, $datos);

			if ($respuesta == "ok") {

				echo json_encode("ok");
			}
		}
	}
}
