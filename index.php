<?php

require_once "controladores/Plantilla.controlador.php";
require_once "controladores/Usuario.controlador.php";
require_once "controladores/Tipo.documento.controlador.php";
require_once "controladores/Proveedor.controlador.php";
require_once "controladores/Cliente.controlador.php";
require_once "controladores/Categoria.controlador.php";
require_once "controladores/Producto.controlador.php";
require_once "controladores/Compra.controlador.php";
require_once "controladores/Lista.compra.controlador.php";
require_once "controladores/Trabajador.controlador.php";
require_once "controladores/Contrato.trabajador.controlador.php";
require_once "controladores/Pago.trabajador.controlador.php";
require_once "controladores/Vacaciones.controlador.php";
require_once "controladores/Configuracion.ticket.controlador.php";
require_once "controladores/Impresora.controlador.php";



require_once "modelos/Usuario.modelo.php";
require_once "modelos/Tipo.documento.modelo.php";
require_once "modelos/Proveedor.modelo.php";
require_once "modelos/Cliente.modelo.php";
require_once "modelos/Categoria.modelo.php";
require_once "modelos/Producto.modelo.php";
require_once "modelos/Compra.modelo.php";
require_once "modelos/Categoria.modelo.php";
require_once "modelos/Trabajador.modelo.php";
require_once "modelos/Contrato.trabajador.modelo.php";
require_once "modelos/Pago.trabajador.modelo.php";
require_once "modelos/Vacaciones.modelo.php";
require_once "modelos/Configuracion.ticket.modelo.php";
require_once "modelos/Impresora.modelo.php";


$plantilla = new ControladorPlantilla();
$plantilla->ctrPlantilla();
