<?php
require_once "../modelos/Ventas.modelo.php";
require_once "../controladores/Ventas.controlador.php";



$item = null;

$valor = null;

$SerieNumero = ControladorVenta::ctrMostrarSerieNumero($item, $valor);

$datosSerieNumero = array();

foreach ($SerieNumero as $key => $serieNumero) {

    $fila = array(
        'id_venta' => $serieNumero['id_venta'],
        'serie_comprobante' => $serieNumero['serie_comprobante'],
        'num_comprobante' => $serieNumero['num_comprobante']
    );


    $datosSerieNumero[] = $fila;
}


echo json_encode($datosSerieNumero);
