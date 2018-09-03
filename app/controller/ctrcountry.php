<?php
include '../../config/business.php';
$bsn = new Business();
$country = new Country();
$ps = $bsn->post;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'selectCountrys':
			$result = $country->selectCountrys();
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