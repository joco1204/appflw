<?php
include '../../config/business.php';
$bsn = new Business();
$boxes = new Boxes();
$ps = $bsn->post;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'boxesTable':
			$result = $boxes->boxesTable();
			$bsn->return = $result;
		break;
		case 'boxesCreate':
			$result = $boxes->boxesCreate($ps);
			$bsn->return = $result;
		break;
		case 'boxesGet':
			$result = $boxes->boxesGet($ps);
			$bsn->return = $result;
		break;
		case 'boxesUpdate':
			$result = $boxes->boxesUpdate($ps);
			$bsn->return = $result;
		break;
		case 'boxSize':
			$result = $boxes->boxSize();
			$bsn->return = $result;
		break;
		case 'boxFbe':
			$result = $boxes->boxFbe($ps->id);
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