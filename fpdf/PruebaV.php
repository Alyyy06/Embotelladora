<?php

require('./fpdf.php');

class PDF extends FPDF
{

   // Cabecera de página
   function Header()
   {
      include '../conexion.php';//llamamos a la conexion BD

      //$consulta_info = $conexion->query(" select *from hotel ");//traemos datos de la empresa desde BD
      //$dato_info = $consulta_info->fetch_object();
      //$this->Image('..', 185, 5, 20); //logo de la empresa,moverDerecha,moverAbajo,tamañoIMG
      $this->SetFont('Arial', 'B', 19); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(45); // Movernos a la derecha
      $this->SetTextColor(0, 0, 0); //color
      //creamos una celda o fila
      $this->Cell(110, 15, utf8_decode('THOMSOM LLENADERO'), 1, 1, 'C', 0); // AnchoCelda,AltoCelda,titulo,borde(1-0),saltoLinea(1-0),posicion(L-C-R),ColorFondo(1-0)
      $this->Ln(3); // Salto de línea
      $this->SetTextColor(103); //color



      /* TITULO DE LA TABLA */
      //color
      $this->SetTextColor(28, 100, 0);
      $this->Cell(50); // mover a la derecha
      $this->SetFont('Arial', 'B', 15);
      $this->Cell(100, 10, utf8_decode("REPORTE DE BOTELLONES LLENADOS "), 0, 1, 'C', 0);
      $this->Ln(7);

      /* CAMPOS DE LA TABLA */
      //color
      $this->SetFillColor(228, 100, 0); //colorFondo
      $this->SetTextColor(255, 255, 255); //colorTexto
      $this->SetDrawColor(163, 163, 163); //colorBorde
      $this->SetFont('Arial', 'B', 11);
      $this->Cell(18, 10, utf8_decode('N°'), 1, 0, 'C', 1);
      $this->Cell(45, 10, utf8_decode('FECHA DE LLENADO'), 1, 0, 'C', 1);
      $this->Cell(26, 10, utf8_decode('CANTIDAD'), 1, 0, 'C', 1);
      $this->Cell(15, 10, utf8_decode('Rif'), 1, 0, 'C', 1);
      $this->Cell(50, 10, utf8_decode('zona'), 1, 1, 'C', 1);
   }

   // Pie de página
   function Footer()
   {
      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, negrita(B-I-U-BIU), tamañoTexto
      $this->Cell(0, 10, utf8_decode('Página ') . $this->PageNo() . '/{nb}', 0, 0, 'C'); //pie de pagina(numero de pagina)

      $this->SetY(-15); // Posición: a 1,5 cm del final
      $this->SetFont('Arial', 'I', 8); //tipo fuente, cursiva, tamañoTexto
      $hoy = date('d/m/Y');
      $this->Cell(355, 10, utf8_decode($hoy), 0, 0, 'C'); // pie de pagina(fecha de pagina)
   }
}

include '../conexion.php';
//require '../../funciones/CortarCadena.php';
/* CONSULTA INFORMACION DEL HOSPEDAJE */
//$consulta_info = $conexion->query(" select *from hotel ");
//$dato_info = $consulta_info->fetch_object();

$pdf = new PDF();
$pdf->AddPage(); /* aqui entran dos para parametros (horientazion,tamaño)V->portrait H->landscape tamaño (A3.A4.A5.letter.legal) */
$pdf->AliasNbPages(); //muestra la pagina / y total de paginas

$i = 0;
$pdf->SetFont('Arial', '', 12);
$pdf->SetDrawColor(163, 163, 163); //colorBorde

$consulta_reporte_alquiler =  mysqli_query($conn,"SELECT idP,Fecha_llenado,CantidadBote,rif,zona_pais,id_Clientes FROM pedidos INNER JOIN cliente ON id_clientes=id") or die(mysqli_error($conn));

while ($datos_reporte = mysqli_fetch_array($consulta_reporte_alquiler)){      
/* TABLA */
$pdf->Cell(18, 10, utf8_decode($datos_reporte['idP']), 1, 0, 'C', 0);
$pdf->Cell(45, 10, utf8_decode($datos_reporte['Fecha_llenado']), 1, 0, 'C', 0);
$pdf->Cell(26, 10, utf8_decode($datos_reporte['CantidadBote']), 1, 0, 'C', 0);
$pdf->Cell(15, 10, utf8_decode($datos_reporte['id_Clientes']), 1, 0, 'C', 0);
$pdf->Cell(50, 10, utf8_decode($datos_reporte['zona_pais']), 1, 1, 'C', 0);
}

$pdf->Output('Prueba.pdf', 'I');//nombreDescarga, Visor(I->visualizar - D->descargar)
