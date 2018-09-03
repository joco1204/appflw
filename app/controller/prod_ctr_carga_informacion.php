<?php
include '../../config/business.php';
$bsn = new Business();
$carga = new CargaInformacionOrder();
$ps = $bsn->post;
$files = $bsn->files;
if(isset($ps->action)){
	switch ($ps->action){
		case 'insertFileIDOrder':
			$file = ((object) $files->file);
			$result = $carga->insertFileIDOrder($file);
			$bsn->return = $result;
		break;
		case 'insertFileInventarioFlor':
			$file = ((object) $files->file);
			$result = $carga->insertFileInventarioFlor($file);
			$bsn->return = $result;
		break;
		case 'insertFileInventarioHg':
			$file = ((object) $files->file);
			$result = $carga->insertFileInventarioHg($file);
			$bsn->return = $result;
		break;
		case 'insertFileOrdenCompraFlor':
			$file = ((object) $files->file);
			$result = $carga->insertFileOrdenCompraFlor($file);
			$bsn->return = $result;
		break;
		case 'insertFileOrdenCompraHg':
			$file = ((object) $files->file);
			$result = $carga->insertFileOrdenCompraHg($file);
			$bsn->return = $result;
		break;
		case 'TableIdOrder':
			$result = $carga->TableIdOrder();
			$bsn->return = $result;
		break;
		case 'TableInventarioFlor':
			$result = $carga->TableInventarioFlor();
			$bsn->return = $result;
		break;
		case 'TableInventarioHg':
			$result = $carga->TableInventarioHg();
			$bsn->return = $result;
		break;
		case 'TableOrdenCompraFlor':
			$result = $carga->TableOrdenCompraFlor();
			$bsn->return = $result;
		break;
		case 'TableOrdenCompraHg':
			$result = $carga->TableOrdenCompraHg();
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