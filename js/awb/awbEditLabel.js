var arrayproductos = {};
var arraylimites = {};
var iR = $('#awb_number').val();
alert(iR);
var posarray=0;
var prodarray=0;
$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingLines',
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
			html += row.item_description+'<br /><br />'+row.item_code;
			html += '</th>';
			html += '<th rowspan="2" width="10%">';
			html += '<div id="tot_pieces_'+i+'">'+row.pieces+'</div>';	
			html += '</th>';
			html += '<th width="50%" class="text-center bg-green">';
			html += 'Admitted:  <input type="text" style="color:black;" id="admitted_'+i+'" value="0"';
			html += '</th>';
			html += '<th width="20%">';
			html += 'Begin Label: '+row.label_init;	
			html += '</th>';
			html += '</tr>';
			html += '<tr>';
			html += '<th class="text-center bg-orange">';
			var valpieces_missing=parseInt(row.pieces)+1;
			html += 'Missing:  <input type="text" style="color:black;" id="missing_'+i+'" value="'+valpieces_missing+'"';
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
			/*html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="po_number_'+i+'" 	id="po_number_'+i+'" 	class="form-control" value="'+row.po+'" 			readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="po_prod_id_'+i+'" id="po_prod_id_'+i+'"	class="form-control" value="'+row.product_name+'" 	readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="boxes_'+i+'" 		id="boxes_'+i+'" 		class="form-control" value="'+row.box+'" 			readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text"	name="pieces_'+i+'" 	id="pieces_'+i+'" 		class="form-control" value="'+row.pieces+'" 		readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text"	name="label_init_'+i+'" id="label_init_'+i+'" 	class="form-control" value="'+row.label_init+'" 	readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text"	name="label_end_'+i+'" 	id="label_end_'+i+'" 	class="form-control" value="'+row.label_end+'" 		readonly=""></div></div>';
			*/	
			html += '</div>';
		});
		console.log(arrayproductos);
		console.log(arraylimites);
		$('#line_to_awb').html(html);
	});
	
	
	var awbadd = [""];
	var awbEach = "";
	
$("#item_status").focusout(function(event){
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
							console.log('pertenece a la linea '+linea_in);
							var val_in=$('#admitted_'+linea_in).val();
							var new_in=parseInt(val_in)+1;
							$('#admitted_'+linea_in).val(new_in);
							
							var val_out=$('#missing_'+linea_in).val();
							var new_out=parseInt(val_out)-1;
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
				//$('#itemAdd').append(awbEach);
			}
		});
	});
	