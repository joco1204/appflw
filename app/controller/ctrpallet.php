<?php
include '../../config/business.php';
$bsn = new Business();
$pallet = new Pallet();
$post = $bsn->post;
//Validate the existence of the action
if(isset($post->action)){
	switch ($post->action){
		case 'palletTable':
			$result = $pallet->palletTable();
			$bsn->return = $result;
		break;
		case 'insertPallet':
			$result = $pallet->insertPallet($post);
			$bsn->return = $result;
		break;
		case 'updateStatus':
			$result = $pallet->updateStatus($post);
			$bsn->return = $result;
		break;
		case 'positionNumber':
			$result = $pallet->positionNumber();
			$bsn->return = $result;
		break;
		case 'tagNumber':
			$result = $pallet->tagNumber();
			$bsn->return = $result;
		break;
		case 'pallets_tag_number':
			$result = $pallet->pallets_tag_number();
			$bsn->return = $result;
		break;
		case 'pallets_position_number':
			$result = $pallet->pallets_position_number();
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