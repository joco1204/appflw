<?php
include '../../config/business.php';
$bsn = new Business();
$inventory = new Inventory();
$ps = $bsn->post;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'inventoryTable':
			$result = $inventory->inventoryTable();
			$bsn->return = $result;
		break;
		case 'inventoryUpdateStatus':
			$result = $inventory->inventoryUpdateStatus($ps);
			$bsn->return = $result;
		break;
		/* para shipment y work order */
		case 'inventoryStatus':
			$result = $inventory->inventoryStatus();
			$bsn->return = $result;
		break;
		case 'inventoryContact':
			$result = $inventory->inventoryContact($ps);
			$bsn->return = $result;
		break;
		case 'dataShipment':
			$result = $inventory->dataShipment($ps);
			$bsn->return = $result;
		break;
		case 'inventoryShipmentLines':
			$result = $inventory->inventoryShipmentLines($ps);
			$bsn->return = $result;
		break;
		default:
			$bsn->return->bool = false;
			$bsn->return->msg = 'Action not found'.$ps->action;
		break;
	}
} else {
	$bsn->return->bolean = false;
	$bsn->return->msg = 'Action not found';		
}
echo json_encode((array) $bsn->return);
?>