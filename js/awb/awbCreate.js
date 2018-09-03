$(function(){
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
			url: '../controller/ctrawb.php',
			data: {
				action: 'awbCity',
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
		url: '../controller/ctrawb.php',
		data: {
			action: 'awbCountry',
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

	$('#ship_date_origin').change(function(){
		var format = Date.parse($(this).val());
		var date = new Date(format);
		var dd = date.getDate()+2;
		var mm = date.getMonth();
		var yyyy = date.getFullYear();
		if(dd<10){
		    dd = '0'+dd;
		} 
		if(mm<10){
		    mm = '0'+mm;
		}
		var dateTowmorro = yyyy+"-"+mm+"-"+dd
		$('#date_arrival').val(dateTowmorro);
	});

	$('#time_ship_origin').change(function(){
		var time = $(this).val();
		time = time.split(':');
		var hh = time[0];
		var mm = time[1];
		var ha = parseInt(hh)+parseInt(18);
		if(ha >= 24){
			ha = parseInt(ha)-parseInt(24);
		}
		if(ha < 10){
			ha = '0'+ha;
		}
		var time_arrival = ha+':'+mm;
		$('#time_arrival').val(time_arrival);
	});

	//Submit form receiving
	$('#receiving_form').submit(function(e){
		e.preventDefault();
		$('#action').val('awbCreate');
		var data = $('#receiving_form').serialize();
		$.ajax({
			type: 'post',
			url: '../controller/ctrawb.php',
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
					pageContent('handling/awb/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
});

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
		url: '../controller/ctrawb.php',
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

function change_prod(n_line){
	var po_n = $('#po_number_'+n_line).val();
	$('#po_prod_id_'+n_line).empty();
	$.ajax({
		type: 'post',
		url: '../controller/ctrawb.php',
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
					text: row.item_code+" - "+row.item_description
				}));
			});
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

function show_quality(n_line){
	var prod_n=$('#po_prod_id_'+n_line).val();
	$('#pieces_'+n_line).empty();
	$.ajax({
		type: 'post',
		url: '../controller/ctrawb.php',
		data: {
			action: 'po_quallity_prod',
			n_prod: prod_n,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var countLines = ($('.line').length);
			var arrayval = t1(prod_n, countLines);
			$.each(data, function(i, row){
				var dato = parseInt(row.box_qty)-parseInt(row.in_receiving)-parseInt(arrayval);
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
	if($('#label_init_'+n_line).val() !=''){
		finalLabel(n_line);
	}
}

function finalLabel(n_line){
	var n1 = $('#label_init_'+n_line).val();
	var n2 = $('#pieces_'+n_line).val();
	var oper = parseInt(n1) + (parseInt(n2)-1);
	$('#label_end_'+n_line).val(oper);
}