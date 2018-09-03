<?php 
include '../../config/business.php';
$bsn = new Business();
$shipment = new Shipment();
$ps = $bsn->post;
$files = $bsn->files;
//Validate the existence of the action
if(isset($ps->action)){
	switch ($ps->action){
		case 'shipmentTable':
			$result = $shipment->shipmentTable();
			$bsn->return = $result;
		break;
		case 'status':
			$result = $shipment->status();
			$bsn->return = $result;
		break;
		case 'shipmentCreate':
			$result = $shipment->shipmentCreate($ps);
			$bsn->return = $result;
		break;
		case 'shipmentLines':
			$result = $shipment->shipmentLines($ps);
			$bsn->return = $result;
		break;
		case 'shipmentGet':
			$result = $shipment->shipmentGet($ps->id);
			$bsn->return = $result;
		break;
		case 'poShipment':
			$result = $shipment->poShipment();
			$bsn->return = $result;
		break;
		case 'productItemCode':
			$result = $shipment->productItemCode($ps);
			$bsn->return = $result;
		break;
		case 'productItemName':
			$result = $shipment->productItemName($ps);
			$bsn->return = $result;
		break;
		case 'shipmentUpdate':
			$result = $shipment->shipmentUpdate($ps);
			$bsn->return = $result;
		break;
		case 'pod':
			$file = ((object) $files->pod);
			//Se define el directorio base.
			define('DIRPROJECT', dirname(__DIR__));
			//Directorio de facturas general
			$dir = str_replace('\\', '/', DIRPROJECT);
			$dir = str_replace('app/', '', $dir);
			$dir = $dir.'/files_pod/'; 
			//POD Directory
			if(!is_dir($dir)){
				mkdir($dir, 0777);
			}
			//File extension
			$fexp = explode('.', $file->name);
			$fext = $fexp[1];
			$namefile = md5($fext[0]);
			$namefilext = $ps->id."_".$namefile.".".$fext;
			//Valid directory created.
			$dirfile = $dir.basename($namefilext);
			$repdirfile = str_replace($dir, "", $dirfile);
			$dirfiledb = '../../files_pod/'.$repdirfile;
			if(move_uploaded_file($file->tmp_name, $dirfile)){
				if(is_file($dirfile)){
					$result = $shipment->pod($ps, $dirfiledb);
					$bsn->return = $result;
				} else {
					$bsn->return->bool = false;
					$bsn->return->msg = 'The file could not be loaded';
				}
			} else {
				$bsn->return->bool = false;
				$bsn->return->msg = 'The file could not be loaded';
			}
		break;
		case 'deliveredTable':
			$result = $shipment->deliveredTable();
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