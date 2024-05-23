<?php

require_once "../../controladores/Ventas.controlador.php";
require_once "../../modelos/Ventas.modelo.php";
require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Times', 'B', 18);
        $this->Image('img/triangulosrecortados.png', 0, 0, 50); // imagen(archivo, png/jpg || x,y,tamaño)
        $this->setXY(60, 15);
        $this->Cell(100, 8, utf8_decode('Reporte de descuentos de precios de productos'), 0, 1, 'C', 0);
        $this->Image('img/shinheky.png', 180, 5, 25); // imagen(archivo, png/jpg || x,y,tamaño)
        $this->Ln(20);
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'B', 10);
        // Número de página
        $this->Cell(195, 10, utf8_decode('Todos los derechos reservados'), 0, 0, 'C', 0);
        $this->Cell(40, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF(); // hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); // añade la página / en blanco
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 20); // salto de página automático
$pdf->SetX(10); // Ajuste para los márgenes
$pdf->SetFont('Helvetica', 'B', 11);

// Ajustar anchos de columnas para un total de 190 unidades
$anchoTotalPagina = 190; // Total de unidades en la página
$anchoN = 10;
$anchoUsuario = 35;
$anchoNombreProducto = 45;
$anchoPrecioProducto = 35;
$anchoPrecioDescuento = 35;
$anchoFechaVenta = 30;

$pdf->Cell($anchoN, 8, 'N', 'B', 0, 'C', 0);
$pdf->Cell($anchoUsuario, 8, utf8_decode('Usuario'), 'B', 0, 'C', 0);
$pdf->Cell($anchoNombreProducto, 8, utf8_decode('Nombre producto'), 'B', 0, 'C', 0);
$pdf->Cell($anchoPrecioProducto, 8, utf8_decode('Precio producto'), 'B', 0, 'C', 0);
$pdf->Cell($anchoPrecioDescuento, 8, utf8_decode('Precio descuento'), 'B', 0, 'C', 0);
$pdf->Cell($anchoFechaVenta, 8, utf8_decode('Fecha venta'), 'B', 1, 'C', 0);

$pdf->SetFillColor(233, 229, 235); // color de fondo rgb
$pdf->SetDrawColor(61, 61, 61); // color de línea rgb

$pdf->SetFont('Arial', '', 10);

/* ======================================
CAPTURANDO DATOS 
====================================== */

if (isset($_GET["descuento_producto_r"])) {

    $fecha_desde = $_GET["fecha_desde_r"];
    $fecha_hasta = $_GET["fecha_hasta_r"];
    $id_usuario = $_GET["id_usuario_r"];
    $tipo_pago = $_GET["tipo_pago_r"];
    $descuento_producto = $_GET["descuento_producto_r"];

    // Obtener datos de ventas
    $ventas = ControladorVenta::ctrMostrarReporteVentasPrecioProducto($fecha_desde, $fecha_hasta, $id_usuario, $tipo_pago, $descuento_producto);

    $contador = 1;

    foreach ($ventas as $venta) {

        $pdf->setX(10); // Ajuste para los márgenes
        $pdf->Cell($anchoN, 8, $contador, 'B', 0, 'C', 1);
        $pdf->Cell($anchoUsuario, 8, utf8_decode($venta['nombre_usuario']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoNombreProducto, 8, utf8_decode($venta['nombre_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoPrecioProducto, 8, utf8_decode('S/ '.$venta['precio_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoPrecioDescuento, 8, utf8_decode('S/ '.$venta['precio_venta']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoFechaVenta, 8, utf8_decode($venta['fecha_venta']), 'B', 1, 'C', 1);

        $contador++;
    }

    $pdf->Output();
}
?>
