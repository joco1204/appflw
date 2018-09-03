<?php
include '../../config/business.php';
$bsn = new Business();
$po = new PurchasingOrder();
$ps = $bsn->post;
$files = $bsn->files;
if(isset($ps->action)){
	switch ($ps->action){
		case 'poTable':
			$result = $po->poTable();
			$bsn->return = $result;
		break;
		case 'dc_name':
			$result = $po->dc_name();
			$bsn->return = $result;
		break;
		case 'client':
			$result = $po->client();
			$bsn->return = $result;
		break;
		case 'supplier':
			$result = $po->supplier();
			$bsn->return = $result;
		break;
		case 'status':
			$result = $po->status();
			$bsn->return = $result;
		break;
		case 'pack':
			$result = $po->pack();
			$bsn->return = $result;
		break;
		case 'poCreate':
			$result = $po->poCreate($ps);
			$bsn->return = $result;
		break;
		case 'poGet':
			$result = $po->poGet($ps);
			$bsn->return = $result;
		break;
		case 'productsTable':
			$result = $po->productsTable($ps);
			$bsn->return = $result;
		break;
		case 'productsLines':
			$result = $po->productsLines($ps);
			$bsn->return = $result;
		break;
		case 'insertFilePo_Full':
			$file = ((object) $files->file);
			$result = $po->insertFilePo_Full($file);
			$bsn->return = $result;
		break;
		case 'insertFilePo':
			$file = ((object) $files->file);
			$result = $po->insertFilePo($file);
			$bsn->return = $result;
		break;
		case 'insertFileProduct':
			$file = ((object) $files->file);
			$result = $po->insertFileProduct($file);
			$bsn->return = $result;
		break;
		case 'datePo':
			$result = $po->datePo();
			$bsn->return = $result;
		break;
		case 'grafico1':
			$result = $po->grafico1();
			$bsn->return = $result;
		break;
		default:
			$bsn->return->bool = false;
			$bsn->return->msg = 'Action not found';
		break;
	}
} else {
	$bsn->return->bool = false;
	$bsn->return->msg = 'Action not found';		
}
echo json_encode((array) $bsn->return);
?>