<?php

require_once "Conexion.php";

class ModeloProveedor{

	/*=============================================
	MOSTRAR PROVEEDOR
	=============================================*/

	static public function mdlMostrarProveedor($tablaDoc, $tablaPer, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tablaDoc as doc inner join $tablaPer as p on doc.id_doc = p.id_doc WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tablaDoc as doc inner join $tablaPer as p on doc.id_doc = p.id_doc");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

	/*=============================================
	REGISTRAR PROVEEDOR
	=============================================*/

	static public function mdlIngresarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
                                                                    tipo_persona, 
                                                                    razon_social, 
                                                                    id_doc, 
                                                                    numero_documento, 
                                                                    direccion, 
                                                                    ciudad, 
                                                                    codigo_postal, 
                                                                    telefono, 
                                                                    email,
                                                                    sitio_web,
                                                                    tipo_banco,
                                                                    numero_cuenta
                                                                    )
                                                                    VALUES (
                                                                    :tipo_persona, 
                                                                    :razon_social, 
                                                                    :id_doc, 
                                                                    :numero_documento, 
                                                                    :direccion, 
                                                                    :ciudad, 
                                                                    :codigo_postal, 
                                                                    :telefono, 
                                                                    :email,
                                                                    :sitio_web,
                                                                    :tipo_banco,
                                                                    :numero_cuenta
                                                                    )");

		$stmt->bindParam(":tipo_persona", $datos["tipo_persona"], PDO::PARAM_STR);
		$stmt->bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt->bindParam(":id_doc", $datos["id_doc"], PDO::PARAM_INT);
		$stmt->bindParam(":numero_documento", $datos["numero_documento"], PDO::PARAM_STR);
		$stmt->bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt->bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt->bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_STR);
		$stmt->bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt->bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt->bindParam(":sitio_web", $datos["sitio_web"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_banco", $datos["tipo_banco"], PDO::PARAM_STR);
		$stmt->bindParam(":numero_cuenta", $datos["numero_cuenta"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR PROVEEDOR
	=============================================*/

	static public function mdlEditarProveedor($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																razon_social = :razon_social, 
																id_doc = :id_doc, 
																numero_documento = :numero_documento, 
																direccion = :direccion, 
																ciudad = :ciudad, 
																codigo_postal = :codigo_postal, 
																telefono = :telefono, 
																email = :email, 
																sitio_web = :sitio_web, 
																tipo_banco = :tipo_banco,
																numero_cuenta = :numero_cuenta
																WHERE id_persona = :id_persona");

		$stmt -> bindParam(":razon_social", $datos["razon_social"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_doc", $datos["id_doc"], PDO::PARAM_INT);
		$stmt -> bindParam(":numero_documento", $datos["numero_documento"], PDO::PARAM_STR);
		$stmt -> bindParam(":direccion", $datos["direccion"], PDO::PARAM_STR);
		$stmt -> bindParam(":ciudad", $datos["ciudad"], PDO::PARAM_STR);
		$stmt -> bindParam(":codigo_postal", $datos["codigo_postal"], PDO::PARAM_STR);
		$stmt -> bindParam(":telefono", $datos["telefono"], PDO::PARAM_STR);
		$stmt -> bindParam(":email", $datos["email"], PDO::PARAM_STR);
		$stmt -> bindParam(":sitio_web", $datos["sitio_web"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo_banco", $datos["tipo_banco"], PDO::PARAM_STR);
		$stmt -> bindParam(":numero_cuenta", $datos["numero_cuenta"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR PROVEEDOR
	=============================================*/

	static public function mdlActualizarProveedor($tabla, $item1, $valor1, $item2, $valor2){

		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET $item1 = :$item1 WHERE $item2 = :$item2");

		$stmt -> bindParam(":".$item1, $valor1, PDO::PARAM_STR);
		$stmt -> bindParam(":".$item2, $valor2, PDO::PARAM_STR);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	BORRAR PROVEEDOR
	=============================================*/

	static public function mdlBorrarProveedor($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_codigo_postal = :id_codigo_postal");

		$stmt -> bindParam(":id_codigo_postal", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}