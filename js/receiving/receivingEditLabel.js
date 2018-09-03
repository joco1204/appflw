function auto(){
var arrayproductos = {};
var arraylimites = {};
var iR = $('#awb_number').val();
var posarray=0;
var prodarray=0;
$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingCoolexpres',
			id: iR,
		},
		dataType: 'json',
	}).done(function(result){
		var data = $.parseJSON(result.msg);
		var html = '';
		$.each(data, function(i, row){
			arraylimites[posarray] = row.label_init;
			posarray++;
			arraylimites[posarray] = row.label_end;
			posarray++;
			
			arrayproductos[prodarray]= i;
			html += '<div class="row line" id="lineProd_'+i+'">';
			html += '<table class="table table-striped table-bordered display" id="table_prodlabel"">';
				html += '<tr>';
					html += '<th rowspan="3" width="20%" class="modal-header text-center bg-green">';
						html += row.item_description+'<br /><br />'+row.item_code+'<input type="hidden" value="'+row.item_code+'" id="ItemCodeL_'+i+'"/>';
					html += '</th>';
					html += '<th rowspan="2" width="10%">';
						html += '<div id="tot_pieces_'+i+'">'+row.pieces+'</div>';	
					html += '</th>';
					html += '<th width="50%" class="text-center bg-green">';
						html += 'Admitted:  <input type="text" style="color:black;" id="admitted_'+i+'" value="0" readonly="">';
					html += '</th>';
					html += '<th width="20%">';
						html += 'Begin Label: '+row.label_init;	
					html += '	</th>';
				html += '</tr>';
				html += '<tr>';
					html += '<th class="text-center bg-orange">';
						var valpieces_missing = parseInt(row.pieces);
						html += 'Missing:  <input type="text" style="color:black;" id="missing_'+i+'" value="'+valpieces_missing+'" readonly="">';
					html += '</th>';
					html += '<th>';
						html += 'End Label: '+row.label_end;	
					html += '</th>';
				html += '</tr>';
				html += '<tr>';
					html += '<th>';
						html += '<button class="Validate_Button"></button>';
					html += '</th>';
					html += '<th colspan="2">';
						html += '<textarea cols="70%"></textarea>';
					html += '</th>';
				html += '</tr>';
			html += '<Table><hr>';
			html += '</div>';
		});
		console.log(arrayproductos);
		console.log(arraylimites);
		$('#line_to_awb').html(html);
	});

	
var awbadd = [""];
var awbEach = "";
var auxfocus = 0;

$("#opt_complete").click(function(event){	
	auxfocus = 1;	
});
$("#item_status").focusout(function(event){
	if (auxfocus==0){
	var flag=0;
		var tx = $(this);
		setTimeout(function() {
		  $(tx).focus();
		  $(tx).select();
		}, 10);
		var item_por_agregar = $('#item_status').val();
		//$('#itemAdd').html('');
		if(awbadd.includes(item_por_agregar) == false){
			var linea_in=0;
				$.each(arraylimites, function(i, row){
					var par = i%2;
					var seglim=parseInt(i)+1;
					if(par==0){
						console.log(arraylimites[i]+' '+arraylimites[seglim]);
						var val1=parseInt(item_por_agregar);
						var val2=parseInt(arraylimites[i]);
						var val3=parseInt(item_por_agregar);
						var val4=parseInt(arraylimites[seglim]);
						if ((val1 >= val2) && (val3 <= val4)){
						//if ((parseInt(item_por_agregar) >= parseInt(arraylimites[i])) && (parseInt(item_por_agregar) <= parseInt(arraylimites[seglim])){
							awbadd.push(item_por_agregar);
							$('#addStatus').html('<span class="label label-info statusAddes">Label: '+item_por_agregar+' added</span>');
							flag=1;
							
							var itemCodeSave=$('#ItemCodeL_'+linea_in).val();
							
							var new_out = 0;

							 $.ajax({
							   type: 'post',
							   url: '../controller/ctrreceiving.php',
							   data: {
							   action: 'receivingAddLabel',
								   receiving: $('#awb_number').val(),
								   item_code: itemCodeSave,
								   Label: item_por_agregar,

							   },
							   dataType: 'json',
							   }).done(function(result){
									new_out = $parseJSON(result.msg);
							   });
							
							
							
							console.log('pertenece a la linea '+linea_in);
							
							var val_in=$('#admitted_'+linea_in).val();
							var new_in=parseInt(val_in)+1;
							
							$('#admitted_'+linea_in).val(new_in);
							
							var val_out=$('#missing_'+linea_in).val();

							
							$('#missing_'+linea_in).val(new_out);
							if (parseInt(new_out)==0){
								$('#tot_pieces_'+linea_in).css('background-color', 'green');
								$('#tot_pieces_'+linea_in).css('color', 'white');
							}
							
						}
						linea_in++;
					}
				});
			if(flag == 0){
				$('#addStatus').html('<span class="label label-danger statusAddes">Label: '+item_por_agregar+' not found</span>');
			}
		} else {
			$('#addStatus').html('<span class="label label-danger statusAddes">Label: '+item_por_agregar+' already entered</span>');
		}
		
		awbadd.forEach(function(element) {
			if(element != ''){
				awbEach = '<div class="row"><div class="col-md-4 col-md-offset-2"><b>Barcode #:</b></div><div class="col-md-4">eeeee'+element+'</div></div><br>';
			}
		});
	}else{
		auxfocus=0;
	}	
	});
	
}
var tags_itemcode=[];
$("#changeMethod").change(function(event){	
	var opt = $('#changeMethod').val();
	if (opt =='RFID'){
		$('#rfid_div').show();
		$('#auto_div').hide();
		var iR = $('#awb_number').val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: {
				action: 'receivingCoolexpres',
				id: iR,
			},
			dataType: 'json',
		}).done(function(result){
			var data = $.parseJSON(result.msg);
			var html = '<table><tr>';
			$.each(data, function(i, row){
				tags_itemcode.push(row.item_code);
				html +="<td>"+row.item_code+"</td>";
				html +="<td>"+row.item_description+"</td>";
				html +="<td>Cnt</td>";
			});
			
			var tags_item=[];
			var cnt_x=0;
			$.each(tags_itemcode, function(j, row1){
				cnt=0;
				tags_item=[]
				$.ajax({
					type: 'post',
					url: '../controller/ctrreceiving.php',
					data: {
					action: 'receivingCoolexpresLabel',
					id: row1,
					awb:iR
					},
				dataType: 'json',
				}).done(function(result){
					var data1 = $.parseJSON(result.msg);
					var html1 = '<table><tr>';
					$.each(data1, function(h, row2){
						tags_item.push(row2.barcode);
						cnt_x++;
					});
					tags_itemcode.push(tags_item);
					tags_itemcode.push(cnt_x);
				});
			});
				
			
			
			
		html +="</tr></table>";
		$('#result_item_code_rfid').html(html);
		//$('#item_code_rfid').show();
		});
		
	}else{
		$('#rfid_div').hide();
		auto();
		$('#auto_div').show();
	}
});


$("#text_rfid").keyup(function(event){	
//$("#btn_rfid").click(function(event){	
	
	
	var cnt_item = tags_itemcode.length / 3;
	var tags=[];
	var valc=-1;
	for (j = 0; j < cnt_item; j++) { 
		valc = valc +3;
		console.log('rfid_itemcode:'+tags_itemcode[cnt_item]);
	}
	console.log('rfid_itemcode:'+tags_itemcode);
	var text_rfid = $('#text_rfid').val();
	text_rfid = text_rfid.replace(/\n/g, ",");
	var res = text_rfid.split(",");
	var i;
	for (i = 0; i < res.length; i++) { 
	
		
		if(!tags.includes(res[i])){
			if (res[i]!=""){
				tags.push(res[i]);
			}
		}
	}
	
	$('#rfid_result').val(tags.length);
	$('#item_code_rfid').show();
	$('#result_rfid').show();
});