<?php

require_once "Conexion.php";

class ModeloTipoDocumento{

	/*=============================================
	MOSTRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlMostrarTipoDocumento($tabla, $item, $valor){

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
	REGISTRO DE TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlIngresarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_doc) 
		                                                  VALUES (:nombre_doc)");

		$stmt->bindParam(":nombre_doc", $datos["nombre_doc"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlEditarTipoDocumento($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET nombre_doc = :nombre_doc WHERE id_doc = :id_doc");

		$stmt -> bindParam(":nombre_doc", $datos["nombre_doc"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_doc", $datos["id_doc"], PDO::PARAM_INT);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlActualizarTipoDocumento($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR TIPO DE DOCUMENTO
	=============================================*/

	static public function mdlBorrarTipoDocumento($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_doc = :id_doc");

		$stmt -> bindParam(":id_doc", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}