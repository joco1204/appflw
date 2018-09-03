<?php
include '../../config/business.php';
$bsn = new Business();
$receiving = new Receiving();
$ps = $bsn->post;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'receivingTable':
			$result = $receiving->receivingTable();
			$bsn->return = $result;
		break;
		case 'receivingLineUp':
			$result = $receiving->receivingLineUp($ps);
			$bsn->return = $result;
		break;
		case 'receivingCreate':
			$result = $receiving->receivingCreate($ps);
			$bsn->return = $result;
		break;
		case 'receivingGet':
			$result = $receiving->receivingGet($ps);
			$bsn->return = $result;
		break;
		case 'receivingUpdate':
			$result = $receiving->receivingUpdate($ps);
			$bsn->return = $result;
		break;
		case 'receivingUpdateStatus':
			$result = $receiving->receivingUpdateStatus($ps);
			$bsn->return = $result;
		break;
		case 'receivingUpdateUpLine':
			$result = $receiving->receivingUpdateUpLine($ps);
			$bsn->return = $result;
		break;
		case 'receivingCity':
			$result = $receiving->receivingCity($ps);
			$bsn->return = $result;
		break;
		case 'receivingCountry':
			$result = $receiving->receivingCountry();
			$bsn->return = $result;
		break;	
		case 'receivingStatus':
			$result = $receiving->receivingStatus();
			$bsn->return = $result;
		break;
		case 'receivingLines':
			$result = $receiving->receivingLines($ps);
			$bsn->return = $result;
		break;
		case 'receivingCoolexpres':
			$result = $receiving->receivingCoolexpres($ps);
			$bsn->return = $result;
		break;
		case 'receivingLinesPO':
			$result = $receiving->receivingLinesPO();
			$bsn->return = $result;
		break;
		case 'po_number':
			$result = $receiving->po_number();
			$bsn->return = $result;
		break;
		case 'po_number_prod':
			$result = $receiving->po_number_prod($ps);
			$bsn->return = $result;
		break;
		case 'po_quallity_prod':
			$result = $receiving->po_quallity_prod($ps);
			$bsn->return = $result;
		break;
		case 'receivingToWork':
			$result = $receiving->receivingToWork($ps);
			$bsn->return = $result;
		break;
		case 'receivingAddLabel':
			$result = $receiving->receivingAddLabel($ps);
			$bsn->return = $result;
		break;
		case 'receivingPallet':
			$result = $receiving->receivingPallet($ps);
			$bsn->return = $result;
		break;
		case 'get_labelAWB':
			$result = $receiving->get_labelAWB($ps);
			$bsn->return = $result;
		break;
		case 'update_labelPallet':
			$result = $receiving->update_labelPallet($ps);
			$bsn->return = $result;
		break;
		case 'get_palletAWB':
			$result = $receiving->get_palletAWB($ps);
			$bsn->return = $result;
		break;
		case 'update_labelPalletPosition':
			$result = $receiving->update_labelPalletPosition($ps);
			$bsn->return = $result;
		break;
		case 'receivingCoolexpresLabel':
			$result = $receiving->receivingCoolexpresLabel($ps);
			$bsn->return = $result;
		break;
		case 'receivingReaderFull':
			$result = $receiving->receivingReaderFull($ps);
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