<?php

require_once "Conexion.php";

class ModeloAsistencia{

	/*=============================================
	MOSTRAR ASISTENCIAS
	=============================================*/

	static public function mdlMostrarAsistencia($tablaT, $tablaA, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tablaT as t inner join $tablaA as a on t.id_trabajador = a.id_trabajador WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT DISTINCT fecha_asistencia, t.*, a.* FROM $tablaT AS t INNER JOIN $tablaA AS a ON t.id_trabajador = a.id_trabajador  ORDER BY a.id_asistencia DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

    /*=============================================
	REGISTRO DE ASISTENCIAS
	=============================================*/

    static public function mdlIngresarAsistencia($tabla, $datos)
    {

        $stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
                                                                    id_trabajador,
                                                                    fecha_asistencia, 
                                                                    hora_entrada, 
                                                                    hora_salida, 
                                                                    estado, 
                                                                    observaciones) 
                                                                    VALUES (
                                                                        :id_trabajador, 
                                                                        :fecha_asistencia, 
                                                                        :hora_entrada, 
                                                                        :hora_salida, 
                                                                        :estado, 
                                                                        :observaciones)");

        $stmt->bindParam(":id_trabajador", $datos["id_trabajador"], PDO::PARAM_INT);
        $stmt->bindParam(":fecha_asistencia", $datos["fecha_asistencia"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_entrada", $datos["hora_entrada"], PDO::PARAM_STR);
        $stmt->bindParam(":hora_salida", $datos["hora_salida"], PDO::PARAM_STR);
        $stmt->bindParam(":estado", $datos["estado"], PDO::PARAM_STR);
        $stmt->bindParam(":observaciones", $datos["observaciones"], PDO::PARAM_STR);

        if ($stmt->execute()) {

            return "ok";
            
        } else {

            return "error";
        }


        $stmt = null;
    }

	/*=============================================
	EDITAR ASISTENCIAS
	=============================================*/

	static public function mdlEditarAsistencia($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																id_trabajador = :id_trabajador, 
																fecha_inicio = :fecha_inicio, 
																fecha_fin = :fecha_fin
																WHERE id_vacacion = :id_vacacion");

		$stmt -> bindParam(":id_trabajador", $datos["id_trabajador"], PDO::PARAM_INT);
		$stmt -> bindParam(":fecha_inicio", $datos["fecha_inicio"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_fin", $datos["fecha_fin"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_vacacion", $datos["id_vacacion"], PDO::PARAM_INT);


		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR ASISTENCIA
	=============================================*/

	static public function mdlActualizarAsistencia($tabla, $item1, $valor1, $item2, $valor2){

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
	BORRAR ASISTENCIA
	=============================================*/

	static public function mdlBorrarAsistencia($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_vacacion = :id_vacacion");

		$stmt -> bindParam(":id_vacacion", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}
