<?php

require_once "Conexion.php";

class ModeloRol
{

	/*=============================================
	MOSTRAR ROL
	=============================================*/

	static public function mdlMostrarRoles($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla ORDER BY id_rol DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

	/*=============================================
	REGISTRAR ROL
	=============================================*/

	static public function mdlIngresarRol($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(nombre_rol) VALUES (:nombre_rol)");

		$stmt->bindParam(":nombre_rol", $datos["nombre_rol"], PDO::PARAM_STR);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR ROL
	=============================================*/

	static public function mdlEditarRol($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																nombre_rol = :nombre_rol
																WHERE id_rol = :id_rol");

		$stmt -> bindParam(":nombre_rol", $datos["nombre_rol"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ROL
	=============================================*/

	static public function mdlActualizarRol($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR ROL
	=============================================*/

	static public function mdlBorrarRol($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_rol = :id_rol");

		$stmt -> bindParam(":id_rol", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}