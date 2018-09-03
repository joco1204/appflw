<?php
include '../../config/business.php';
$bsn = new Business();
$login = new Login();
$ps = $bsn->post;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'login':
			$result = $login->login($ps->user, $ps->pass);
			$bsn->return = $result;
		break;
		case 'session':
			$result = $login->session($ps->iduser, $ps->idcompany, $ps->token);
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