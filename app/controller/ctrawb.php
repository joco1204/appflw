<?php
include '../../config/business.php';
$bsn = new Business();
$awb = new AWB();
$ps = $bsn->post;
$files = $bsn->files;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'awbTable':
			$result = $awb->awbTable();
			$bsn->return = $result;
		break;
		case 'awbLineUp':
			$result = $awb->awbLineUp($ps);
			$bsn->return = $result;
		break;
		case 'awbCreate':
			$result = $awb->awbCreate($ps);
			$bsn->return = $result;
		break;
		case 'awbGet':
			$result = $awb->awbGet($ps);
			$bsn->return = $result;
		break;
		case 'awbUpdate':
			$result = $awb->awbUpdate($ps);
			$bsn->return = $result;
		break;
		case 'awbUpdateStatus':
			$result = $awb->awbUpdateStatus($ps);
			$bsn->return = $result;
		break;
		case 'awbUpdateUpLine':
			$result = $awb->awbUpdateUpLine($ps);
			$bsn->return = $result;
		break;
		case 'awbCity':
			$result = $awb->awbCity($ps);
			$bsn->return = $result;
		break;
		case 'awbCountry':
			$result = $awb->awbCountry();
			$bsn->return = $result;
		break;	
		case 'awbStatus':
			$result = $awb->awbStatus();
			$bsn->return = $result;
		break;
		case 'awbLines':
			$result = $awb->awbLines($ps);
			$bsn->return = $result;
		break;
		case 'awbLinesPO':
			$result = $awb->awbLinesPO();
			$bsn->return = $result;
		break;
		case 'po_number':
			$result = $awb->po_number();
			$bsn->return = $result;
		break;
		case 'po_number_prod':
			$result = $awb->po_number_prod($ps);
			$bsn->return = $result;
		break;
		case 'po_quallity_prod':
			$result = $awb->po_quallity_prod($ps);
			$bsn->return = $result;
		break;
		case 'awbToWork':
			$result = $awb->awbToWork($ps);
			$bsn->return = $result;
		break;
		case 'insert_file_awb':
			$file = ((object) $files->file);
			$result = $awb->insert_file_awb($file);
			$bsn->return = $result;
		break;
		default:
			$bsn->return->bool = false;
			$bsn->return->msg = 'Action not found';
		break;
	}
} else {
	$bsn->return->bolean = false;
	$bsn->return->msg = 'Action not found';		
}
echo json_encode((array) $bsn->return);
?>