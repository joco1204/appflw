var labelAdd = [];
$( document ).ready(function() {
   var awb=$('#awb').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingLineUp',
			awb: awb
		},
		dataType: 'json',
	}).done(function(result){
		var data = $.parseJSON(result.msg);
		var html ="<table border='1' style='border:0px;width:100%;min-width:100%;max-width:100%;' cellspacing='5' cellpadding='5'>";
		$('#pallet_itemCode').html(html);
		$.each(data, function(i, row){
			html +="<tr>";
			html +="<td rowspan='2' width='10%' align='center'>Item Code:<br>"+row.item_code+"</td>";
			html +="<td width='10%' style='padding-top:10px;paddingBottom:10px;'><button class='btn btn-primary' id='btn_ptag"+i+"' onclick='Tag_ItemCode("+row.item_code+","+i+","+awb+");'>Pallet Closed</button></td>";
			html +="<td rowspan='2' width='80%'><div id='infoPallete_"+i+"'></div></td>";
			html +="</tr>";
			html +="<tr>";
			html +="<td><button class='btn btn-primary' id='btn_pposition"+i+"' onclick='Pos_ItemCode("+row.item_code+","+i+","+awb+");'>Pallet Position</button></td>";
			html +="</tr>";
			$('#pallet_itemCode').append(html);
		});
		$('#pallet_itemCode').append('</table>');
	
	});
	
});


function Tag_ItemCode(item_code,i,awb){
	var labelExist = [];
	labelAdd = [];
	var labelCnt=0;
	var labelRest=0;
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'get_labelAWB',
			awb: awb,
			item_code:item_code
		},
		dataType: 'json',
	}).done(function(result){
		var data = $.parseJSON(result.msg);
		$.each(data, function(i, row){
			labelExist.push(row.barcode);
			labelCnt++;
		});
	});
	
	var html2='<table border="0" width="100%">';
	html2 +='<tr>';
	html2 +='<td width="70%"><input type="text" placeholder="Barcode" size="40" id="Reader_'+i+'" /><button onclick="agruparLabel('+item_code+','+i+','+awb+')">Group</button><div id="message_'+i+'"></div></td>';
	html2 +='<td rowspan="2" width="30%"><div class="divs_item">';
	html2 +='<div id="leidos_'+i+'">Read: '+labelRest+'</div>';
	html2 +='<div id="restantes_'+i+'"></div>';
	html2 +='</div></td>';
	html2 +='</tr>';
	html2 +='<tr>';
	html2 +='<td><textarea rows="6" cols="90" id="text_line_'+i+'"></textarea></td>';
	html2 +='</tr>';
	html2 +='</table>';
	$('#infoPallete_'+i).html(html2);
	$('#Reader_'+i).focusout(function(event){
		$('#message_'+i).html('');
		var leido=$('#Reader_'+i).val();
		if(labelExist.includes(leido) == true){
			if(labelAdd.includes(leido) == false){
				labelAdd.push(leido);
				$('#text_line_'+i).append(leido+',');
				labelRest++;
				labelCnt--;
				$('#leidos_'+i).html('Leidos: '+labelRest);
				$('#restantes_'+i).html('Leidos: '+labelCnt);
				console.log(labelAdd);
			}else{
				$('#message_'+i).html(leido+' ya fue ingresado');
			}
		}else{
			$('#message_'+i).html('Label: '+leido+' not available for this item code');
		}
	});
}

function agruparLabel(item_code,line,awb){
	$.each(labelAdd, function(i, row){
		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: {
				action: 'update_labelPallet',
				awb: awb,
				item_code:item_code,
				label:row
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				
			}
		});	
	});
	Tag_ItemCode(item_code,line,awb);
}

function add_Pos_ItemCode(item_code,line,awb,linePallet){
	var tag=0;
	var position=0;
	var cant=0;
	for (i=0;i<linePallet;i++){
		tag = $('#tag_up_'+i).val();
		position = $('#pos_up_'+i).val();
		cant = $('#cnt_up_'+i).val();
		if (position ==""){
			position =0;	
		}else{	
			$.ajax({
				type: 'post',
				url: '../controller/ctrreceiving.php',
				data: {
					action: 'update_labelPalletPosition',
					id_pallet:tag,
					position:position,
					item_code:item_code,
					awb:awb,
					cnt_box:cant
				},
				dataType: 'json',
			}).done(function(result){
				if(result.bool){
					
				}
			});
		}
	}
	Pos_ItemCode(item_code,line,awb);
	$('#btn_change_status_receiving').show();
}


function Pos_ItemCode(item_code,line,awb){
var numPallet_Tag=0;
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'get_palletAWB',
			awb: awb,
			item_code:item_code
		},
		dataType: 'json',
	}).done(function(result){
		var data = $.parseJSON(result.msg);
		var htmlE ="<table width='100%' align='center' border='0'>";
			htmlE +="<tr><th>Cantidad Label</th><th>Pallet Tag</th><th>Position</th></tr>";
		var htmlL="";
		var html="";
		var valPos="";
		$.each(data, function(i, row){
			htmlL += "<tr>";
				htmlL += "<td><input type='hidden' id='cnt_up_"+numPallet_Tag+"' value='"+row.cnt+"' />"+row.cnt+"</td>";
				htmlL += "<td><input type='hidden' id='tag_up_"+numPallet_Tag+"' value='"+row.pallet+"' />"+row.pallet+"</td>";
				if (row.position == 0){
					valPos=0;
				}else{
					valPos=row.position;
				}
				htmlL += "<td><input type='text' id='pos_up_"+numPallet_Tag+"' value='"+valPos+"' /></td>";
				htmlL += "</tr>";
				numPallet_Tag++;
		});
		htmlL +="<tr><td colspan ='3' align='center'><button onclick='add_Pos_ItemCode("+item_code+","+line+","+awb+","+numPallet_Tag+")'>Add Position</button></td></tr>";
		html=htmlE+htmlL+'</table>';
		$('#infoPallete_'+line).html(html);
				
		
	});
}
