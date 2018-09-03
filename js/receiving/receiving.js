var obj = {};
$(function(){
	
	//Ajax table receiving
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<table class="table table-striped table-bordered display" id="table_receiving">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>AWB MASTER</th>';
			html += '<th>Date</th>';
			html += '<th>Customer</th>';
			html += '<th>Box QTY</th>';
			html += '<th>Box Receiving</th>';
			html += '<th>Box Pending</th>';
			html += '<th>Status</th>';
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			$.each(data, function(i, row){
				html += '<tr>';
				html += '<td>'+row.awb+'</td>';
				html += '<td>'+row.date_arrival+'</td>';
				html += '<td>'+row.customer+'</td>';
				html += '<td>'+row.box_qty+'</td>';
				html += '<td>'+row.box+'</td>';
				if (row.box_pending == null){
					html += '<td>0</td>';
				} else {
					html += '<td>'+row.box_pending+'</td>';
				}
				
				html += '<td>';
				if (row.status == 'Cool Express'){
					if (row.sub_id_status == 'Incomplete'){
						html += '<span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span><span class="label label-danger pull-left" style="width: 80px;">'+row.awb+'</span><span onclick="status_change('+row.id_receiving+',\''+row.sub_id_status+'\',\''+row.awb+'\', \''+row.id_status+'\');" class="glyphicon glyphicon-refresh" data-toggle="modal" data-target="#change_status" style="cursor:pointer;"></span>';
					}else{
						html += '<span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span><span class="label label-success pull-left" style="width: 80px;">'+row.awb+'</span><span onclick="status_change('+row.id_receiving+',\''+row.sub_id_status+'\',\''+row.awb+'\', \''+row.id_status+'\');" class="glyphicon glyphicon-refresh" data-toggle="modal" data-target="#change_status" style="cursor:pointer;"></span>';
					}
				}else{
					html += '<span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span><span onclick="status_change('+row.id_receiving+',\''+row.sub_id_status+'\',\''+row.awb+'\', \''+row.id_status+'\');" class="glyphicon glyphicon-refresh" data-toggle="modal" data-target="#change_status" style="cursor:pointer;"></span>';
				}
				html += '</td>';
				html += '</tr>';
			});
			html += '</tbody>';
			html += '<tfoot>';
			html += '<tr>';
			html += '<th>AWB MASTER</th>';
			html += '<th>Date</th>';
			html += '<th>Customer</th>';
			html += '<th>Box QTY</th>';
			html += '<th>Box Receiving</th>';
			html += '<th>Box Pending</th>';
			html += '<th>Status</th>';
			html += '</tr>';
			html += '</tfoot>';
			html += '</table>';
			$('#data_awb_list').html(html);
			$('#table_receiving').dataTable();
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Ajax Origin Customer
	$.ajax({
		type: 'post',
		url: '../controller/ctraccounts.php',
		data: {
			action: 'customer',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#customer').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#customer').append($('<option>', {
					value: row.id,
					text: row.name_company
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	// Ajax Origin City
	$( "#origin_country" ).change(function() {
		origin_cityNow=$('#origin_city').val();
		$('#origin_city').empty();
		var selCountry = $( "#origin_country" ).val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: {
				action: 'receivingCity',
				country: selCountry,
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				$('#origin_city').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
				$.each(data, function(i, row){	
					$('#origin_city').append($('<option>', {
						value: row.id,
						text: row.city
					}));
				});			
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});	

	//Ajax Origin Country
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingCountry',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
				$('#origin_country').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#origin_country').append($('<option>', {
					value: row.id_country,
					text: row.country
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Ajax Carrie/Grower
	$.ajax({
		type: 'post',
		url: '../controller/ctraccounts.php',
		data: {
			action: 'grower',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
				$('#carrie_grower').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#carrie_grower').append($('<option>', {
					value: row.id,
					text: row.name_company
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	
	$('#tip_weight').append($('<option>', {
		value: '0',
		text: 'Choose Option'
	}));

	$('#tip_weight').append($('<option>', {
		value: 'KG',
		text: 'KG'
	}));

	$('#tip_weight').append($('<option>', {
		value: 'LBS',
		text: 'LBS'
	}));

	//Submit form receiving
	$('#receiving_form').submit(function(e){
		e.preventDefault();
		$('#action').val('receivingCreate');
		var data = $('#receiving_form').serialize();
		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: data,
			dataType: 'json',
			beforeSend: function() {
				$("#loader").fadeIn("slow");
			}
		}).done(function(result){
			if(result.bool){
				$("#loader").fadeOut("slow");
				swal({
					title: "¡Success!",
					text: result.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					pageContent('handling/receiving/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});

	/********************************************************/

	var awbadd = [""];
	
	var awbEach = "";
	
	$('#change_status').on('shown.bs.modal', function(){

		$('#statusNew').empty();
		$('#divLocation').hide();
		$('#divCool').hide();
		$('#item_status').val('');
		$('#itemAdd').html('');
		$('#addStatus').html('');
		$('#data_lines_up').html('');
		
		while(awbadd.length > 0){
			awbadd.pop(); 
		}

		//Ajax status line
		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: {
				action: 'receivingStatus',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
					$('#statusNew').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
				$.each(data, function(i, row){
					$('#statusNew').append($('<option>', {
						value: row.id_status,
						text: row.status
					}));
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});


	$("#clearBtn").click(function(event){
		$('#itemAdd').html('');
		$('#addStatus').html('');
		$('#item_status').val('');
		while(awbadd.length > 0){
			awbadd.pop(); 
		}
	});
	
	//Ajax status
	$("#item_status").focusout(function(event){
		var tx = $(this);
		alert(tx);
		setTimeout(function() {
		  $(tx).focus();
		  $(tx).select();
		}, 10);
		var item_por_agregar = $('#item_status').val();
		$('#itemAdd').html('');
	});

	//Change status
	$( "#statusNew" ).change(function() {
		var idStatus= $('#statusNew').val();
		var idAWB= $('#awb_status_change').val();
		var awb = $('#awb_number').val();
		
		if (idStatus == 16){
			
			$('#divCool').hide();
			$('#divLocation').load('handling/receiving/modalDivPallet.php?idawb_pallet='+idAWB);
			$('#divLocation').show();

		} else {
			
			$('.labels').val('');
			$('#divLocation').hide();
			if (idStatus == 15){
				$('#divCool').load('handling/receiving/modalDivCool.php?awb='+idAWB);
				$('#divCool').show();
			}else{
				$('#divCool').hide();
			}
		}
	});
});


function txtModal(line){
	$("#lineModal").val(line);
	$('#po').empty();
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingLinesPO',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#po').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
					$('#po').append($('<option>', {
						value: row.po_product,
						text:row.po_product+" Max:"+row.case_total
					}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
}

//function Add Lines
function addlines(){
	var html = '';
	var count = ($('.line').length)+1;
	$('#lines').val(count);
	html += '<div class="row line" id="line_'+count+'">';
	html += '<div class="col-md-2"><div class="form-group"><select name="po_number_'+count+'" id="po_number_'+count+'" class="form-control" onchange="change_prod('+count+');" style="width: 100%;"></select></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><select name="po_prod_id_'+count+'" id="po_prod_id_'+count+'" class="form-control po_prod_id" onchange="show_quality('+count+');" style="width: 100%;"></select></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><select name="boxes_'+count+'" id="boxes_'+count+'" class="form-control boxes" style="width: 100%;"></select></div></div>';
	html += '<div class="col-md-2">';
	html += '<div class="input-group">';
	html += '<input type="number" name="pieces_'+count+'" id="pieces_'+count+'" class="form-control pieces" onkeyup="validcnt('+count+');">';
	html += '<span class="input-group-btn">';
	html += '<button type="button" class="btn btn-warning" style="display:none" id="quallity_prod_'+count+'" onclick="asigQuality('+count+');" style="font-size: 10px;"></button>';
	html += '</span>';
	html += '</div>';
	html += '</div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="text" name="label_init_'+count+'" id="label_init_'+count+'" class="form-control" onkeyup="finalLabel('+count+');" readonly></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="text" name="label_end_'+count+'" id="label_end_'+count+'" class="form-control" readonly=""></div></div>';
	html += '</div>';
	$('#canvas_line').append(html);
	$("select").select2();
	
	//Ajax PO
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'po_number',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
				$('#po_number_'+count).append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#po_number_'+count).append($('<option>', {
					value: row.po_number,
					text: row.po_number
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Ajax Boxes
	$.ajax({
		type: 'post',
		url: '../controller/ctrboxes.php',
		data: {
			action: 'boxSize',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<option value=""></option>';
			$.each(data, function(i, row){
				html += '<option value="'+row.id_box_type+'">'+row.code+' - '+row.dimention+'</option>';
			});
			$('#boxes_'+count).html(html);
		} else {
			console.log('Error: '+result.msg);
		}
	});
}

function sumPieces(){
	var  nlines = $('#lines').val();
	var  sumlines = 0;
	for (var i = 1; i <= nlines; i++) {
		var nsum= "#pieces_"+i;
		var line_i = parseInt($(nsum).val());
		sumlines=sumlines+line_i;
	}
	$('#pieces_master').val(sumlines);
}
//open modal status
function status_change(idawb, sub_status, awb){
	$('#awb_status_change').val(idawb);
	$('#awb_substatus_change').val(sub_status);
	$('#awb_status_changeL').html(awb);
	$('#awb_number').val(awb);
}

function change_prod(n_line){
	var po_n = $('#po_number_'+n_line).val();
	$('#po_prod_id_'+n_line).empty();
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'po_number_prod',
			n_po: po_n,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
				$('#po_prod_id_'+n_line).append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#po_prod_id_'+n_line).append($('<option>', {
					value: row.id,
					text: row.item_code+" - "+row.product_name
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
}

function show_quality(n_line){
	var prod_n=$('#po_prod_id_'+n_line).val();
	$('#pieces_'+n_line).empty();
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'po_quallity_prod',
			n_prod: prod_n,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var countLines = ($('.line').length);
			
			
			var arrayval=t1(prod_n,countLines);
			
					
			$.each(data, function(i, row){
				
				var dato=parseInt(row.quantity)-parseInt(row.in_receiving)-parseInt(arrayval);
				$('#quallity_prod_'+n_line).html('MAX: '+dato);
				$('#quallity_prod_'+n_line).show();
				$('#pieces_'+n_line).attr('max', dato);

			 });
		} else {
			console.log('Error: '+result.msg);
		}
	});
}

function asigQuality(n_line){
	var val = $('#quallity_prod_'+n_line).html();
	var nval = val.replace('MAX: ', '');
	$('#pieces_'+n_line).val(nval);
}

function valQuality(n_line){
	var val=$('#quallity_prod_'+n_line).html();
	var nval = val.replace('MAX: ', '');
	var pieces = $('#pieces_'+n_line).val();
	if (pieces > nval){
		$('#pieces_'+n_line).val(nval);
	}
}	

function  update_status(){
	var awb = $('#awb_status_change').val();

	var validate = "";
	var newStatus = $('#statusNew').val();

	if (newStatus == 15){
		var locStatus = $('#itemAdd').html();
		var isCool = 1;
	} else {
		var locStatus = $('#location_status').val();
		var isCool=0;
	}

	if (newStatus == 16){
		var validate = $('#awb_substatus_change').val();
		updateLinesUp();
	} 

	if (validate != "Incomplete"){

		$('body').removeClass('modal-open');
		$('.modal-backdrop').remove();
		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: {
				action: 'receivingUpdateStatus',
				awbR: awb,
				newR: newStatus,
				coolR: isCool,
				locR: locStatus,
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				swal({
					title: "¡Success!",
					text: result.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					pageContent('handling/receiving/index');
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	} else {
		swal("Error!","Cool Express Incomplete","error");
	}

	$('#change_status').hide();
}

function updateLinesUp(){
	var lineas = $('#Nlines').val();

	for (i = 0; i < lineas; i++) { 
		var id_line = $('#id_line_'+i).val();
		var idL = $('#IdL_'+i).val();
		var loL = $('#LocL_'+i).val();
		var paL = $('#PalL_'+i).val();

		$.ajax({
			type: 'post',
			url: '../controller/ctrreceiving.php',
			data: {
				action: 'receivingUpdateUpLine',
				IdLine: id_line,
				LocLine: loL,
				PalLine: paL,
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				
			} else {
				console.log('Error: '+result.msg);
			}
		});
	}
}

function validcnt(n_line){

	var cntpieces = $('#pieces_'+n_line).val();
	var maxpieces = $('#quallity_prod_'+n_line).html();
	var maxpieces = maxpieces.replace("MAX: ", "");
	
	if(parseInt(cntpieces) > parseInt(maxpieces)){
		$('#pieces_'+n_line).val(maxpieces);
	}else{
		$('#pieces_'+n_line).val(cntpieces);
	}
	var countLines = ($('.line').length);	
	var sum=sumPiecesMaster(countLines);
	$('#pieces_master').val(sum);
	
	$('#label_init_'+n_line).attr("readonly", false);

	if($('#label_init_'+n_line).val() != ''){
		finalLabel(n_line);
	}
}

function finalLabel(n_line){

	var n1 = $('#label_init_'+n_line).val();
	var n2 = $('#pieces_'+n_line).val();
	var oper = parseInt(n1) + parseInt(n2);
	$('#label_end_'+n_line).val(oper);
}
var tagsOTO=[];
	
function OneToOne(){
	var newLabel = $('#inputOneToOne').val();
	if(!tagsOTO.includes(newLabel)){
		if (newLabel!=""){
			tagsOTO.push(newLabel);
		}
	}
	$('#serviceOneToOne').html(tagsOTO.length);
	$('#inputOneToOne').val('');
}
var tagsRFID=[];
function RFID(){
	var tagsRFID=[];
	var text_rfid = $('#txtar').val();
	text_rfid = text_rfid.replace(/\n/g, ",");
	var res = text_rfid.split(",");
	var i;
	for (i = 0; i < res.length; i++) { 
		if(!tagsRFID.includes(res[i])){
			if (res[i]!=""){
				tagsRFID.push(res[i]);
				$('#serviceRFID').html(tagsRFID.length);
			}
		}
	}
}
	
	
function confirmOTO(){
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingReaderFull',
			Lines: tagsOTO
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			console.log(result);
		} else {
			console.log('Error: '+result.msg);
		}
	});
}
	
	