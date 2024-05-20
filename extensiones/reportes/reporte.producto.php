<?php

require_once "../../controladores/Producto.controlador.php";
require_once "../../modelos/Producto.modelo.php";

require('fpdf/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        $this->SetFont('Times', 'B', 18);
        $this->Image('img/triangulosrecortados.png', 0, 0, 50); //imagen(archivo, png/jpg || x,y,tamaño)
        $this->setXY(60, 15);
        $this->Cell(100, 8, utf8_decode('Reporte de productos'), 0, 1, 'C', 0);
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
        $this->Cell(170, 10, utf8_decode('Todos los derechos reservados'), 0, 0, 'C', 0);
        $this->Cell(25, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C');
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
$anchoTotalPagina = 190;
$anchoN = 10;
$anchoNombre = 38;
$anchoDocumento = 20; // Reducido el ancho del documento
$anchoDireccion = 38;
$anchoTelefono = 35;
$anchoCorreo = 50;

$pdf->Cell($anchoN, 8, 'N', 'B', 0, 'C', 0);
$pdf->Cell($anchoNombre, 8, utf8_decode('Código'), 'B', 0, 'C', 0);
$pdf->Cell($anchoDocumento, 8, utf8_decode('Nombre'), 'B', 0, 'C', 0);
$pdf->Cell($anchoDireccion, 8, utf8_decode('Precio'), 'B', 0, 'C', 0);
$pdf->Cell($anchoTelefono, 8, utf8_decode('Stock'), 'B', 0, 'C', 0);
$pdf->Cell($anchoCorreo, 8, 'Fecha V.', 'B', 1, 'C', 0);

$pdf->SetFillColor(233, 229, 235); //color de fondo rgb
$pdf->SetDrawColor(61, 61, 61); //color de línea rgb

$pdf->SetFont('Arial', '', 10);

// Ejemplo de datos en forma de array
$usuarios = array(
    array('nombre' => 'Leche', 'documento' => '123456781', 'direccion' => 'Dirección 1', 'telefono' => '123456781', 'correo' => 'correo1@ejemplo.com'),
    array('nombre' => 'Leche', 'documento' => '123456782', 'direccion' => 'Dirección 2', 'telefono' => '123456782', 'correo' => 'correo2@ejemplo.com'),
    array('nombre' => 'Leche', 'documento' => '123456783', 'direccion' => 'Dirección 3', 'telefono' => '123456783', 'correo' => 'correo3@ejemplo.com'),
    // Agrega más datos aquí si es necesario
);


if (isset($_GET["show_sotck_reporte"])) {

    $item = null;
    $valor = $_GET["show_sotck_reporte"];

    $productos = ControladorProducto::ctrMostrarProductosStock($item, $valor);

    $contador = 1;

    foreach ($productos as $producto) {
        $pdf->Ln(0.6);
        $pdf->setX(10); // Ajuste para los márgenes
        $pdf->Cell($anchoN, 8, $contador, 'B', 0, 'C', 1); // Aquí debería ir el número de registro, adaptar según el contenido
        $pdf->Cell($anchoNombre, 8, utf8_decode($producto['codigo_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoDocumento, 8, utf8_decode($producto['nombre_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoDireccion, 8, utf8_decode($producto['precio_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoTelefono, 8, utf8_decode($producto['stock_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoCorreo, 8, utf8_decode($producto['fecha_vencimiento']), 'B', 1, 'C', 1);

        $contador++;
    }

    // cell(ancho, largo, contenido, borde?, salto de línea?)

    $pdf->Output();

} else {

    $item = null;
    $valor = null;

    $productos = ControladorProducto::ctrMostrarProductos($item, $valor);

    $contador = 1;

    foreach ($productos as $producto) {
        $pdf->Ln(0.6);
        $pdf->setX(10); // Ajuste para los márgenes
        $pdf->Cell($anchoN, 8, $contador, 'B', 0, 'C', 1); // Aquí debería ir el número de registro, adaptar según el contenido
        $pdf->Cell($anchoNombre, 8, utf8_decode($producto['codigo_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoDocumento, 8, utf8_decode($producto['nombre_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoDireccion, 8, utf8_decode($producto['precio_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoTelefono, 8, utf8_decode($producto['stock_producto']), 'B', 0, 'C', 1);
        $pdf->Cell($anchoCorreo, 8, utf8_decode($producto['fecha_vencimiento']), 'B', 1, 'C', 1);

        $contador++;
    }

    // cell(ancho, largo, contenido, borde?, salto de línea?)

    $pdf->Output();
}
