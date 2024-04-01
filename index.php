<?php

require_once "controladores/Plantilla.controlador.php";
require_once "controladores/Usuario.controlador.php";
require_once "controladores/Tipo.documento.controlador.php";
require_once "controladores/Proveedor.controlador.php";
require_once "controladores/Cliente.controlador.php";
require_once "controladores/Categoria.controlador.php";



require_once "modelos/Usuario.modelo.php";
require_once "modelos/Tipo.documento.modelo.php";
require_once "modelos/Proveedor.modelo.php";
require_once "modelos/Cliente.modelo.php";
require_once "modelos/Categoria.modelo.php";





$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();