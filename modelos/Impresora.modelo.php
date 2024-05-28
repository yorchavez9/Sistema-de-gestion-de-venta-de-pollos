<?php

require_once "Conexion.php";

class ModeloImpresora
{

	/*=============================================
	MOSTRAR IMPRESORA
	=============================================*/

	static public function mdlMostrarImpresora($tabla, $item, $valor){

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
	REGISTRAR IMPRESORA
	=============================================*/

	static public function mdlIngresarImpresora($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
                                                                    nombre, 
                                                                    ip_impresora
                                                                    )
                                                                    VALUES (
                                                                    :nombre, 
                                                                    :ip_impresora
                                                                    )");

		$stmt->bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt->bindParam(":ip_impresora", $datos["ip_impresora"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR IMPRESORA
	=============================================*/

	static public function mdlEditarImpresora($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																nombre = :nombre, 
																ip_impresora = :ip_impresora
																WHERE id_impresora = :id_impresora");

		$stmt -> bindParam(":nombre", $datos["nombre"], PDO::PARAM_STR);
		$stmt -> bindParam(":ip_impresora", $datos["ip_impresora"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_impresora", $datos["id_impresora"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR IMPRESORA
	=============================================*/

	static public function mdlActualizarImpresora($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR IMPRESORA
	=============================================*/

	static public function mdlBorrarImpresora($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_impresora = :id_impresora");

		$stmt -> bindParam(":id_impresora", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}
