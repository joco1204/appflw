<?php 
include '../../config/business.php';
$bsn = new Business();
$workorder = new Workorder();
$ps = $bsn->post;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'workorderTable':
			$result = $workorder->workorderTable();
			$bsn->return = $result;
		break;
		
		case 'workorderCreate':
			$result = $workorder->workorderCreate($ps);
			$bsn->return = $result;
		break;
		
		case 'workorderGet':
			$result = $workorder->workorderGet($ps);
			$bsn->return = $result;
		break;
		
		case 'workorderUpdate':
			$result = $workorder->workorderUpdate($ps);
			$bsn->return = $result;
		break;
		
		case 'contactCustomer':
			$result = $workorder->contactCustomer($ps);
			$bsn->return = $result;
		break;
		
		case 'contactCustomerInfo':
			$result = $workorder->contactCustomerInfo($ps);
			$bsn->return = $result;
		break;
		
		case 'status':
			$result = $workorder->status();
			$bsn->return = $result;
		break;

		case 'poWo':
			$result = $workorder->poWo();
			$bsn->return = $result;
		break;

		case 'productItemCode':
			$result = $workorder->productItemCode($ps);
			$bsn->return = $result;
		break;

		case 'productItemName':
			$result = $workorder->productItemName($ps);
			$bsn->return = $result;
		break;
		
		case 'workorderBoxTyp':
			$result = $workorder->workorderBoxTyp();
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