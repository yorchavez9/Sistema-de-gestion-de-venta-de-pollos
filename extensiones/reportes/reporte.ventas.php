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
        $this->Image('img/triangulosrecortados.png', 0, 0, 50); //imagen(archivo, png/jpg || x,y,tamaño)
        $this->setXY(60, 15);
        $this->Cell(100, 8, utf8_decode('Reporte de ventas'), 0, 1, 'C', 0);
        $this->Image('img/shinheky.png', 170, 5, 25); //imagen(archivo, png/jpg || x,y,tamaño)
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
$pdf = new PDF(); //hacemos una instancia de la clase
$pdf->AliasNbPages();
$pdf->AddPage(); //añade la página / en blanco
$pdf->SetMargins(10, 10, 10);
$pdf->SetAutoPageBreak(true, 20); //salto de página automático
$pdf->SetX(10); // Ajuste para los márgenes
$pdf->SetFont('Helvetica', 'B', 11);

// Ajustar anchos de columnas para un total de 190 unidades
$anchoTotalPagina = 190; // Total de unidades en la página
$anchoN = 5;
$anchoFecha = 25;
$anchoNombre = 40;
$anchoTipoPago = 20;
$anchoPagoEn = 25;
$anchoTotalPago = 20;
$anchoEstado = 20;
$anchoTotalPagoContado = 30; // Nuevo ancho para total_pago

// Calcular ancho disponible para la columna de Nombre
$anchoNombre = $anchoTotalPagina - $anchoN - $anchoFecha - $anchoTipoPago - $anchoPagoEn - $anchoTotalPago - $anchoEstado - $anchoTotalPagoContado;

$pdf->Cell($anchoN, 8, 'N', 'B', 0, 'C', 0);
$pdf->Cell($anchoFecha, 8, utf8_decode('Fecha'), 'B', 0, 'C', 0);
$pdf->Cell($anchoNombre, 8, utf8_decode('Nombre'), 'B', 0, 'C', 0);
$pdf->Cell($anchoTipoPago, 8, utf8_decode('Tipo pago'), 'B', 0, 'C', 0);
$pdf->Cell($anchoPagoEn, 8, utf8_decode('Pago en'), 'B', 0, 'C', 0);
$pdf->Cell($anchoTotalPago, 8, 'Total', 'B', 0, 'C', 0);
$pdf->Cell($anchoTotalPagoContado, 8, 'Total Pago', 'B', 0, 'C', 0);
$pdf->Cell($anchoEstado, 8, 'Estado', 'B', 1, 'C', 0);

$pdf->SetFillColor(233, 229, 235); //color de fondo rgb
$pdf->SetDrawColor(61, 61, 61); //color de línea rgb

$pdf->SetFont('Arial', '', 10);

/* ======================================
CAPTURANDO DATOS 
====================================== */

$fecha_desde = $_GET["fecha_desde_r"];
$fecha_hasta = $_GET["fecha_hasta_r"];
$id_usuario = $_GET["id_usuario_r"];
$tipo_pago = $_GET["tipo_pago_r"];
$descuento_producto = $_GET["descuento_producto_r"];

// Obtener datos de ventas
$ventas = ControladorVenta::ctrMostrarReporteVentas($fecha_desde, $fecha_hasta, $id_usuario, $tipo_pago, $descuento_producto);

$contador = 1;

foreach ($ventas as $venta) {
    $total_venta = $venta['total_venta'];
    $total_venta_formateado = number_format($total_venta, 2, '.', ',');
    
    // Suponiendo que 'total_pago' es el campo que deseas agregar
    $total_pago = $venta['total_pago'];
    $total_pago_formateado = number_format($total_pago, 2, '.', ',');

    $pdf->Ln(0.6);
    $pdf->setX(10); // Ajuste para los márgenes
    $pdf->Cell($anchoN, 8, $contador, 'B', 0, 'C', 1);
    $pdf->Cell($anchoFecha, 8, utf8_decode($venta['fecha_venta']), 'B', 0, 'C', 1);
    $pdf->Cell($anchoNombre, 8, utf8_decode($venta['razon_social']), 'B', 0, 'C', 1);
    $pdf->Cell($anchoTipoPago, 8, utf8_decode($venta['tipo_pago']), 'B', 0, 'C', 1);
    $pdf->Cell($anchoPagoEn, 8, utf8_decode($venta['pago_e_y']), 'B', 0, 'C', 1);
    $pdf->Cell($anchoTotalPago, 8, utf8_decode("S/ " . $total_venta_formateado), 'B', 0, 'C', 1);
    $pdf->Cell($anchoTotalPagoContado, 8, utf8_decode("S/ " . $total_pago_formateado), 'B', 0, 'C', 1);
    $pdf->Cell($anchoEstado, 8, utf8_decode($venta['estado_pago']), 'B', 1, 'C', 1);

    $contador++;
}

$pdf->Output();
?>
