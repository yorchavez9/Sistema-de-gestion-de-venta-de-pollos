<?php

require_once "Conexion.php";

class ModeloCompra{

	/*=============================================
	MOSTRAR COMPRA
	=============================================*/

	static public function mdlMostrarCompra($tablaE, $tablaDE, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tablaDE as detalle_egreso inner join $tablaE as egreso on detalle_egreso.id_egreso = egreso.id_egreso WHERE $item = :$item");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * from $tablaDE as detalle_egreso inner join $tablaE as egreso on detalle_egreso.id_egreso = egreso.id_egreso ORDER BY p.id_egreso DESC");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		


		$stmt = null;

	}

	/*=============================================
	MOSTRAR SERIE Y NUMERO DE COMPRA O EGRESO
	=============================================*/

	static public function mdlMostrarSerieNumero($tabla, $item, $valor){

		$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_egreso DESC LIMIT 1");
		
		$stmt->execute();

		return $stmt->fetchAll();

		$stmt = null;

	}

	/*=============================================
	MOSTRAR EGRESO
	=============================================*/

	static public function mdlMostrarEgreso($tabla, $item, $valor){

		if($item != null){

			$stmt = Conexion::conectar()->prepare("SELECT * from $tabla WHERE $item = :$item ORDER BY id_egreso DESC LIMIT 1");

			$stmt -> bindParam(":".$item, $valor, PDO::PARAM_STR);

			$stmt -> execute();

			return $stmt -> fetch();

		}else{

			$stmt = Conexion::conectar()->prepare("SELECT * FROM $tabla ORDER BY id_egreso DESC LIMIT 1");

			$stmt -> execute();

			return $stmt -> fetchAll();

		}
		

		$stmt = null;

	}


	/*=============================================
	REGISTRO DE COMPRA
	=============================================*/

	static public function mdlIngresarCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
                                                                id_persona,
                                                                id_usuario, 
                                                                fecha_egre, 
                                                                tipo_comprobante, 
                                                                serie_comprobante, 
                                                                num_comprobante, 
                                                                impuesto,
                                                                total_compra,
                                                                total_pago,
                                                                subTotal,
                                                                igv,
                                                                tipo_pago,
                                                                estado_pago,
                                                                pago_e_y) 
                                                                VALUES (
                                                                :id_persona, 
                                                                :id_usuario, 
                                                                :fecha_egre, 
                                                                :tipo_comprobante, 
                                                                :serie_comprobante, 
                                                                :num_comprobante, 
                                                                :impuesto,
                                                                :total_compra,
                                                                :total_pago,
                                                                :subTotal,
                                                                :igv,
                                                                :tipo_pago,
                                                                :estado_pago,
                                                                :pago_e_y)");

		$stmt->bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt->bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_INT);
		$stmt->bindParam(":fecha_egre", $datos["fecha_egre"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_comprobante", $datos["tipo_comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":serie_comprobante", $datos["serie_comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":num_comprobante", $datos["num_comprobante"], PDO::PARAM_STR);
		$stmt->bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt->bindParam(":total_compra", $datos["total_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":total_pago", $datos["total_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":subTotal", $datos["subTotal"], PDO::PARAM_STR);
		$stmt->bindParam(":igv", $datos["igv"], PDO::PARAM_STR);
		$stmt->bindParam(":tipo_pago", $datos["tipo_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":estado_pago", $datos["estado_pago"], PDO::PARAM_STR);
		$stmt->bindParam(":pago_e_y", $datos["pago_e_y"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	REGISTRO DETALLE COMPRA
	=============================================*/

	static public function mdlIngresarDetalleCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("INSERT INTO $tabla(
                                                                id_egreso,
                                                                id_producto, 
                                                                precio_compra, 
                                                                precio_venta, 
                                                                cantidad_u, 
                                                                cantidad_kg) 
                                                                VALUES (
                                                                :id_egreso, 
                                                                :id_producto, 
                                                                :precio_compra, 
                                                                :precio_venta, 
                                                                :cantidad_u, 
                                                                :cantidad_kg)");

		$stmt->bindParam(":id_egreso", $datos["id_egreso"], PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);
		$stmt->bindParam(":precio_compra", $datos["precio_compra"], PDO::PARAM_STR);
		$stmt->bindParam(":precio_venta", $datos["precio_venta"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_u", $datos["cantidad_u"], PDO::PARAM_STR);
		$stmt->bindParam(":cantidad_kg", $datos["cantidad_kg"], PDO::PARAM_STR);

		if($stmt->execute()){

			return "ok";	

		}else{

			return "error";
		
		}

		
		$stmt = null;

	}

	/*=============================================
	EDITAR COMPRA
	=============================================*/

	static public function mdlEditarCompra($tabla, $datos){
	
		$stmt = Conexion::conectar()->prepare("UPDATE $tabla SET 
																id_persona = :id_persona, 
																id_usuario = :id_usuario, 
																fecha_egre = :fecha_egre, 
																tipo_comprobante = :tipo_comprobante, 
																serie_comprobante = :serie_comprobante, 
																num_comprobante = :num_comprobante, 
																impuesto = :impuesto
																WHERE id_producto = :id_producto");

		$stmt -> bindParam(":id_persona", $datos["id_persona"], PDO::PARAM_INT);
		$stmt -> bindParam(":id_usuario", $datos["id_usuario"], PDO::PARAM_STR);
		$stmt -> bindParam(":fecha_egre", $datos["fecha_egre"], PDO::PARAM_STR);
		$stmt -> bindParam(":tipo_comprobante", $datos["tipo_comprobante"], PDO::PARAM_INT);
		$stmt -> bindParam(":serie_comprobante", $datos["serie_comprobante"], PDO::PARAM_STR);
		$stmt -> bindParam(":num_comprobante", $datos["num_comprobante"], PDO::PARAM_STR);
		$stmt -> bindParam(":impuesto", $datos["impuesto"], PDO::PARAM_STR);
		$stmt -> bindParam(":id_producto", $datos["id_producto"], PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;

	}

	/*=============================================
	ACTUALIZAR COMPRA
	=============================================*/

	static public function mdlActualizarCompra($tabla, $item1, $valor1, $item2, $valor2){

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
	ACTUALIZAR STOCK PRODUCTO
	=============================================*/

	static public function mdlActualizarStockProducto($tblProducto, $idProducto, $cantidad) {
		
		$stmt = Conexion::conectar()->prepare("UPDATE $tblProducto SET stock_producto = stock_producto + :cantidad WHERE id_producto = :id_producto");
	
		$stmt->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
		$stmt->bindParam(":id_producto", $idProducto, PDO::PARAM_INT);
	
		if ($stmt->execute()) {
			return "ok";
		} else {
			return "error";
		}
	
		$stmt = null;
	}


	/*=============================================
	BORRAR COMPRA
	=============================================*/

	static public function mdlBorrarCompra($tabla, $datos){

		$stmt = Conexion::conectar()->prepare("DELETE FROM $tabla WHERE id_producto = :id_producto");

		$stmt -> bindParam(":id_producto", $datos, PDO::PARAM_INT);

		if($stmt -> execute()){

			return "ok";
		
		}else{

			return "error";	

		}


		$stmt = null;


	}

}