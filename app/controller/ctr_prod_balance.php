<?php
include '../../config/business.php';
$bsn = new Business();
$carga = new Balance();
$ps = $bsn->post;
$files = $bsn->files;
if(isset($ps->action)){
	switch ($ps->action){
		case 'ListBalance':
			$result = $carga->ListBalance();
			$bsn->return = $result;
		break;
		case 'list_order_posc':
			$result = $carga->list_order_posc($ps);
			$bsn->return = $result;
		break;
		case 'balance_order_posc':
			$result = $carga->balance_order_posc($ps);
			$bsn->return = $result;
		break;
		case 'Create_Posc':
			$result = $carga->Create_Posc($ps);
			$bsn->return = $result;
		break;
		case 'ListAdd_order_ToBalance':
			$result = $carga->ListAdd_order_ToBalance($ps);
			$bsn->return = $result;
		break;
		case 'Asoc_Order_Posc':
			$result = $carga->Asoc_Order_Posc($ps);
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