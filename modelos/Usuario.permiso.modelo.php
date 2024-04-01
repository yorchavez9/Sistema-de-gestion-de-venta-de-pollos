<?php

require_once "Conexion.php";

class ModeloUsuarioPermiso
{

	/*=============================================
	MOSTRAR PERMISO
	=============================================*/

	static public function mdlMostrarUsuarioPermiso($tablaUsuario, $tablaRol, $tablaPermiso, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaPermiso WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tablaUsuario JOIN $tablaPermiso ON $tablaUsuario.id_usuario = $tablaPermiso.id_usuario JOIN $tablaRol ON $tablaPermiso.id_rol = $tablaRol.id_rol");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

	/*=============================================
	REGISTRAR PERMISO
	=============================================*/

	static public function mdlIngresarUsuarioPermiso($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(id_usuario, id_rol) VALUES (:id_usuario, :id_rol)");

		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":id_rol", $datos["id_rol"], PDO::PARAM_INT);


		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR PERMISO
	=============================================*/

	static public function mdlEditarUsuarioPermiso($tabla, $datos){
	
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
	ACTUALIZAR PERMISO
	=============================================*/

	static public function mdlActualizarUsuarioPermiso($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR PERMISO
	=============================================*/

	static public function mdlBorrarUsuarioPermiso($tabla, $datos){

		


		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_usuario = :id_usuario");

		$stmt -> bindParam(":id_usuario", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}