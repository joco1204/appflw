<?php
include '../../config/business.php';
$bsn = new Business();
$accounts = new Accounts();
$post = $bsn->post;
//Validate the existence of the action
if(isset($post->action)){
	switch ($post->action){
		case 'accountsTable':
			$result = $accounts->accountsTable();
			$bsn->return = $result;
		break;
		case 'insertAccounts':
			$result = $accounts->insertAccounts($post);
			$bsn->return = $result;
		break;
		case 'customer':
			$result = $accounts->customer();
			$bsn->return = $result;
		break;
		case 'grower':
			$result = $accounts->grower();
			$bsn->return = $result;
		break;
		case 'truck':
			$result = $accounts->truck();
			$bsn->return = $result;
		break;
		case 'consignee':
			$result = $accounts->consignee();
			$bsn->return = $result;
		break;
		case 'selectState':
			$result = $accounts->selectState($post);
			$bsn->return = $result;
		break;
		case 'selectCity':
			$result = $accounts->selectCity($post);
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