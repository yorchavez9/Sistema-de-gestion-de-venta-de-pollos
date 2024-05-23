<?php

require_once "Conexion.php";

class ModeloConfiguracionTicket
{

	/*=============================================
	MOSTRAR CONFIGURACION TICKET
	=============================================*/

	static public function mdlMostrarConfiguracionTicket($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

	/*=============================================
	REGISTRAR CONFIGURACION TICKET
	=============================================*/

	static public function mdlIngresarConfiguracionTicket($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_empresa, 
                                                                  telefono,
                                                                  correo,
                                                                  direccion,
                                                                  logo,
                                                                  mensaje)
                                                            VALUES(:nombre_empresa,
                                                                   :telefono,
                                                                   :correo,
                                                                   :direccion,
                                                                   :logo,
                                                                   :mensaje)");

		$stmt->bindParam(":nombre_empresa", $datos["nombre_empresa"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		$stmt->bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}


	}

	/*=============================================
	EDITAR CONFIGURACION TICKET
	=============================================*/

	static public function mdlEditarConfiguracionTicket($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																nombre_empresa = :nombre_empresa, 
																telefono = :telefono, 
																correo = :correo, 
																direccion = :direccion, 
																logo = :logo, 
																mensaje = :mensaje
																WHERE id_config_ticket = :id_config_ticket");

		$stmt -> bindParam(":nombre_empresa", $datos["nombre_empresa"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":correo", $datos["correo"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":logo", $datos["logo"], PDO::PARAM_STR);
		$stmt -> bindParam(":mensaje", $datos["mensaje"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_config_ticket", $datos["id_config_ticket"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}


	/*=============================================
	BORRAR CONFIGURACION TICKET
	=============================================*/

	static public function mdlBorrarConfiguracionTicket($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_config_ticket = :id_config_ticket");

		$stmt -> bindParam(":id_config_ticket", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}
