<?php

class Conexion{

	static public function conectar(){

		$link = new PDO("mysql:host=localhost;dbname=sis_pollo_pro",
			            "root",
			            "");

		$link->exec("set names utf8");

		return $link;

	}

}