<?php

session_start();

$nombre_usuario = $_SESSION["nombre_usuario"];

require_once "../controladores/Configuracion.ticket.controlador.php";
require_once "../modelos/Configuracion.ticket.modelo.php";

# Incluyendo librerias necesarias #
require "./code128.php";

$pdf = new PDF_Code128('P', 'mm', array(80, 258));
$pdf->SetMargins(4, 10, 4);
$pdf->AddPage();

$item = null;
$valor = null;


$tickets = ControladorConfiguracionTicket::ctrMostrarConfiguracionTicket($item, $valor);

foreach ($tickets as $ticket) {

    # Encabezado y datos de la empresa #
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetTextColor(0, 0, 0);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper($ticket["nombre_empresa"])), 0, 'C', false);
    $pdf->SetFont('Arial', '', 9);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "RUC: 10234533456234"), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Direccion ".$ticket["direccion"]), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Teléfono: ".$ticket["telefono"]), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Email: ".$ticket["correo"]), 0, 'C', false);

    $pdf->Ln(1);
    $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Fecha: 23/05/2024"), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Usuario: ".$nombre_usuario), 0, 'C', false);
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", strtoupper("Ticket Nro: 000")), 0, 'C', false);
    $pdf->SetFont('Arial', '', 9);

    $pdf->Ln(1);
    $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(5);

    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Cliente: Jorge Chávez Huincho"), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Documento: 72211345"), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Teléfono: 920468502"), 0, 'C', false);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "Dirección: Via Los libertadores"), 0, 'C', false);

    $pdf->Ln(1);
    $pdf->Cell(0, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(3);

    # Tabla de productos #
    $pdf->Cell(10, 5, iconv("UTF-8", "ISO-8859-1", "Cant. U."), 0, 0, 'C');
    $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "Cant. KG."), 0, 0, 'C');
    $pdf->Cell(16, 5, iconv("UTF-8", "ISO-8859-1", "Precio"), 0, 0, 'C');
    $pdf->Cell(28, 5, iconv("UTF-8", "ISO-8859-1", "Total"), 0, 0, 'C');

    $pdf->Ln(3);
    $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');
    $pdf->Ln(3);

    /*----------  Contenido de la tabla  ----------*/


    $pdf->MultiCell(0, 2, iconv("UTF-8", "ISO-8859-1", ""), 0, 'C');
    $pdf->MultiCell(0, 4, iconv("UTF-8", "ISO-8859-1", "Producto"), 0, 'C', false);

    $pdf->Cell(10, 4, iconv("UTF-8", "ISO-8859-1", "0"), 0, 0, 'C');
    $pdf->Cell(22, 4, iconv("UTF-8", "ISO-8859-1", "0"), 0, 0, 'C');
    $pdf->Cell(16, 4, iconv("UTF-8", "ISO-8859-1", "S/ 0.00 "), 0, 0, 'C');
    $pdf->Cell(28, 4, iconv("UTF-8", "ISO-8859-1", "S/ 0.00 "), 0, 0, 'C');
    $pdf->Ln(2);
    $pdf->Ln(2);


    /*----------  Fin Detalles de la tabla  ----------*/


    $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

    $pdf->Ln(5);

    # Impuestos & totales #
    $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
    $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "SUBTOTAL"), 0, 0, 'C');
    $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "S/ 0.00"), 0, 0, 'C');

    $pdf->Ln(5);

    $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
    $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "IVA (%)"), 0, 0, 'C');
    $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "S/ 0.00"), 0, 0, 'C');

    $pdf->Ln(5);

    $pdf->Cell(72, 5, iconv("UTF-8", "ISO-8859-1", "-------------------------------------------------------------------"), 0, 0, 'C');

    $pdf->Ln(5);

    $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
    $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL A PAGAR"), 0, 0, 'C');
    $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "S/ 0.00"), 0, 0, 'C');

    $pdf->Ln(5);

    $pdf->Cell(18, 5, iconv("UTF-8", "ISO-8859-1", ""), 0, 0, 'C');
    $pdf->Cell(22, 5, iconv("UTF-8", "ISO-8859-1", "TOTAL PAGADO"), 0, 0, 'C');
    $pdf->Cell(32, 5, iconv("UTF-8", "ISO-8859-1", "S/ 0.00"), 0, 0, 'C');

    $pdf->Ln(5);

    $pdf->Ln(10);

    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "* ".$ticket["mensaje"]." *"), 0, 'C', false);

    $pdf->SetFont('Arial', 'B', 9);
    $pdf->Cell(0, 7, iconv("UTF-8", "ISO-8859-1", "Gracias por su compra"), '', 0, 'C');

    $pdf->Ln(9);

    # Codigo de barras #
    $pdf->Code128(5, $pdf->GetY(), "COD000001V0001", 70, 20);
    $pdf->SetXY(0, $pdf->GetY() + 21);
    $pdf->SetFont('Arial', '', 14);
    $pdf->MultiCell(0, 5, iconv("UTF-8", "ISO-8859-1", "COD000001V0001"), 0, 'C', false);

    # Nombre del archivo PDF #
    $pdf->Output("I", "Ticket_Nro_1.pdf", true);
}
