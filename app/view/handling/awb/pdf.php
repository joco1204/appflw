<?php
require('../../../../libs/plugins/pdf/fpdf.php');
class PDF extends FPDF
{
	function BasicTable($header)
	{
		// Cabecera
		foreach($header as $col)
			$this->Cell(40,7,$col,1);
		$this->Ln();
	}
}
$pdf = new PDF('P', 'mm', 'A3');
$pdf->AddFont('Impact','','impact.php');
$pdf->AddPage();
require ('../../../model/functions_PDF.php');
$work = new functions_PDF();
$result = $work->GetAWB($_GET['id_receiving']);
$pdf->SetTitle('AWB REPORT');
$pdf->SetFont('Arial','B',24);
$pdf->SetMargins(10, 10 , 6); 
$pdf->SetAutoPageBreak(true,10);
$pdf->Cell(0,20,'AWB REPORT',0,0,'C');
$pdf->Ln(20);
$pdf->SetFont('Arial','',9);
$pdf->Cell(50,20,'AWB MASTER',0,0);
$pdf->Cell(30,20,$result[0]->awb.' ',0,0);
$pdf->Cell(30,20,$result[0]->awb_hija.' ',0,0);
$pdf->Cell(30,20,$result[0]->awb_nieta.' ',0,0);
$pdf->Cell(50,20,'',0,0);
$pdf->Cell(25,20,'DATE',0,0);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(20,20,$result[0]->truck_date.' ',0,0);
$pdf->Ln(20);
$pdf->Cell(20,20,$result[0]->customer.' ',0,0);
$pdf->Ln(20);
$pdf->SetFont('Arial','',9);
$pdf->Cell(30,10,'PO#',1,0,'C');
$pdf->Cell(70,10,'ITEM DESCRIPTION',1,0,'C');
$pdf->Cell(35,10,'BOX TYPE DRY',1,0,'C');
$pdf->Cell(60,5,'BOX DRY DIMENSION',1,0,'C');
$pdf->Cell(30,10,'PACK',1,0,'C');
$pdf->Cell(30,10,'0',1,0,'C');
$pdf->Cell(30,10,'FULLS',1,0,'C');
$pdf->Ln(5);
$pdf->Cell(135,5,'',0,0);
$pdf->Cell(20,5,'Length',1,0,'C');
$pdf->Cell(20,5,'Width',1,0,'C');
$pdf->Cell(20,5,'Height',1,0,'C');
$pdf->Ln();
$pdf->Cell(30,10,$result[0]->po.' ',1,0,'C');
$pdf->Cell(70,10,$result[0]->item_description.' ',1,0,'C');
$pdf->Cell(35,10,$result[0]->box_type_dry.' ',1,0,'C');
$pdf->Cell(20,10,$result[0]->length.' ',1,0,'C');
$pdf->Cell(20,10,$result[0]->width.' ',1,0,'C');
$pdf->Cell(20,10,$result[0]->height.' ',1,0,'C');
$pdf->Cell(30,10,$result[0]->pack_system.' ',1,0,'C');
$pdf->Cell(30,10,'',1,0,'C');
$pdf->Cell(30,10,'',1,0,'C');
$pdf->Cell(0,0.1,'',1,0);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',9);
$pdf->Cell(195,10,'',0,0);
$pdf->Cell(30,10,'TOTAL',0,0,'C');
$pdf->Cell(30,10,'12',0,0,'C');
$pdf->Cell(30,10,'6.00',0,0,'C');
$pdf->Ln(11);
$pdf->Cell(0,0.1,'',1,0);
$pdf->Ln(10);
$pdf->SetFont('Arial','B',14);
$pdf->Cell(200,10,'',0,0,'C');
$pdf->Cell(25,10,'TOTAL',0,0,'C');
$pdf->SetTextColor(255,0,0);
$pdf->Cell(25,10,'113',0,0,'C');
$pdf->SetTextColor(0,0,0);
$pdf->Cell(25,10,'25.21',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(165,10,'',0,0,'C');
$pdf->Cell(60,10,'TOTAL PALLET PER REF.PIECE',0,0,'C');
$pdf->Cell(25,10,'2',0,0,'C');
$pdf->Ln(10);
$pdf->Cell(175,10,'',0,0,'C');
$pdf->Cell(50,10,'TOTAL PALLET AVERANCE',0,0,'C');
$pdf->SetTextColor(255,0,0);
$pdf->Cell(25,10,'3',0,0,'C');
$pdf->Output();
?>