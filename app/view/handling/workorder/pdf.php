<?php
require('../../../../libs/plugins/pdf/fpdf.php');
class PDF extends FPDF
{
	function BasicTable($header)
	{
		foreach($header as $col)
			$this->Cell(40,15,$col,1);
		$this->Ln();
	}
}
$pdf = new PDF('L', 'mm', 'Legal');
$pdf->AddFont('Impact','','impact.php');
$pdf->AddPage();
$pdf->SetTitle('PO#'.$_GET['id_po']);
$pdf->SetFont('Arial','B',36);
$pdf->SetMargins(10, 10 , 10); 
$pdf->SetAutoPageBreak(true,10);
$pdf->SetTextColor(45,158,95);
require ('../../../model/functions_PDF.php');
$work = new functions_PDF();
$result = $work->GetPO($_GET['id_po']);
$pdf->Cell(0,20,$result[0]->customer,1,0,'C');
$pdf->Ln(25);
$pdf->SetTextColor(255,255,255);
$pdf->SetFillColor(50,167,70);
$pdf->Cell(0,20,$result[0]->consignee,1,0,'C', True);
$pdf->SetFont('Arial','B',11);
$pdf->SetTextColor(0,0,0);
$pdf->Ln(20);
$pdf->Cell(50,20,'Consignee State',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(42,20,$result[0]->state,0);
$pdf->SetFont('Arial','B',11);
$pdf->Ln(10);
$pdf->Cell(50,20,'Consignee D.C. #',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(42,20,$result[0]->dc_number,0);
$pdf->SetFont('Arial','B',11);
$pdf->Ln(10);
$pdf->Cell(50,20,'Consignee ZIP code',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(100,20,$result[0]->zip_code,0);
$pdf->SetFont('Arial','B',40);
$pdf->Cell(70,20,'PO#',0);
$pdf->SetTextColor(255,0,0);
$pdf->Cell(50,20,$_GET['id_po'],0);
$pdf->Ln(10);
$pdf->SetTextColor(0,0,0);
$pdf->SetFont('Arial','B',11);
$pdf->Cell(50,20,'Consignee Address',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(42,20,$result[0]->address,0);
$pdf->SetFont('Arial','B',11);
$pdf->Ln(10);
$pdf->Cell(50,20,'Consignee City',0);
$pdf->SetFont('Arial','',11);
$pdf->Cell(42,20,$result[0]->city,0);
$pdf->Ln(20);
$header = array('ITEM CODE', 'DELIVERED DATE', 'TRUCK DATE', 'ITEM DESCRIPTION', 'BOX TYPE DRY', 'PACK SYSTEM', 'BOX QTY', 'STATUS');
$pdf->SetFont('Arial','',11);
$pdf->BasicTable($header);
$result = $work->GetLinePO($_GET['id_po']);
$total = 0;
for ($aux =0; $aux<count($result); $aux++){
		$pdf->Cell(40,6,$result[$aux]->item_code,1);
		$pdf->Cell(40,6,$result[$aux]->delivered_date,1);
		$pdf->Cell(40,6,$result[$aux]->truck_date,1);
		$pdf->Cell(40,6,$result[$aux]->item_description,1);
		$pdf->Cell(40,6,$result[$aux]->box_type_dry,1);
		$pdf->Cell(40,6,$result[$aux]->pack_system,1);
		$pdf->Cell(40,6,$result[$aux]->box_qty,1);
		$pdf->Cell(40,6,$result[$aux]->status,1);
		$total = $total + $result[$aux]->box_qty;
	$pdf->Ln();
}
$pdf->SetFont('Arial','B',16);
$pdf->Cell(50,20,'Total Box P.O: '.$total,0);

$pdf->Output();
?>
