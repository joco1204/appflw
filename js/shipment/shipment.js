$(function(){

	$('#btn_data_list').click(function(){
		$('#data_shipment_next').html('');
		$.ajax({
			type: 'post',
			url: '../controller/ctrshipment.php',
			data: {
				action: 'shipmentTable',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_shipment">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>BOL #</th>';
				html += '<th>Ship Date</th>';
				html += '<th>Customer</th>';
				html += '<th>Trucking Company</th>';
				html += '<th>Consignee</th>';
				html += '<th>Status</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr style="cursor:pointer;">';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.bol+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.date_shipping+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.customer+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.trucking_c+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.consignee+'</td>';
					html += '<td><span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span></td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>BOL #</th>';
				html += '<th>Ship Date</th>';
				html += '<th>Customer</th>';
				html += '<th>Trucking Company</th>';
				html += '<th>Consignee</th>';
				html += '<th>Status</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				$('#data_shipment').html(html);
				$('#table_shipment').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});	
	$('#btn_data_next').click(function(){
		$('#data_shipment').html('');
		$.ajax({
			type: 'post',
			url: '../controller/ctrshipment.php',
			data: {
				action: 'shipmentTable',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_shipment_next">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>BOL #</th>';
				html += '<th>Ship Date</th>';
				html += '<th>Customer</th>';
				html += '<th>Trucking Company</th>';
				html += '<th>Consignee</th>';
				html += '<th>Traccar</th>';
				html += '<th>Temperature</th>';
				html += '<th>Status</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr style="cursor:pointer;">';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.bol+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.date_shipping+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.customer+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.trucking_c+'</td>';
					html += '<td onclick="javascript: pageContent(\'handling/shipment/form\', \'id_shipment='+row.bol+'\');">'+row.consignee+'</td>';
					html += '<td  onclick="loadTraccar();"><span class="fa fa-automobile" data-toggle="modal" data-target="#modal_traccar" style="cursor:pointer;"></span></td>';
					html += '<td><span class="fa fa-compass" data-toggle="modal" data-target="#modal_tempearature" style="cursor:pointer;"></span></td>';
					html += '<td><span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span></td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>BOL #</th>';
				html += '<th>Ship Date</th>';
				html += '<th>Customer</th>';
				html += '<th>Trucking Company</th>';
				html += '<th>Consignee</th>';
				html += '<th>Traccar</th>';
				html += '<th>Temperature</th>';
				html += '<th>Status</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				$('#data_shipment_next').html(html);
				$('#table_shipment_next').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});

	//Ajax customer
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

	//Ship Via truck
	$.ajax({
		type: 'post',
		url: '../controller/ctraccounts.php',
		data: {
			action: 'truck',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#truck_company').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				var row = $.parseJSON(row);
				$('#truck_company').append($('<option>', {
					value: row.id,
					text: row.name_company
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});


	//Ajax Consignee
	$.ajax({
		type: 'post',
		url: '../controller/ctraccounts.php',
		data: {
			action: 'consignee',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#consignee').append($('<option>', {
				value: 0,
				text: "Choose Option"
			}));
			$.each(data, function(i, row){
				$('#consignee').append($('<option>', {
					value: row.id,
					text: row.name_company
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Status
	$('#status').append($('<option>', {
		value: 33,
		text: "Pending"
	}));

	var date = new Date();
	var d = date.getDate();
	d < 10 ? d = '0'+d : d = d;
	var m = date.getMonth()+1;
	m < 10 ? m = '0'+m : m = m;
	var y = date.getFullYear();
	var today = y+'-'+m+'-'+d;

	$('.date').datepicker({
        pickTime: true,
        autoclose: true,
        opens: "center",
        startDate: today,
    });

    //Ajax Create Shipment
    $('#shipment_form').submit(function(e){
    	$('#action').val('shipmentCreate');
    	e.preventDefault();
    	var data = $(this).serialize();
    	$.ajax({
    		type: 'post',
			url: '../controller/ctrshipment.php',
			data: data,
			dataType: 'json',
    	}).done(function(resultd){
    		if(resultd.bool){
    			swal({
					title: "¡Success!",
					text: resultd.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					$("#change_status").modal('hide');
					$('body').removeClass('modal-open');
					$('.modal-backdrop').remove();
					pageContent('handling/shipment/index');
				});
    		} else {
    			swal("Error!",resultd.msg,"error");
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
	html += '<div class="col-md-3"><div class="form-group"><select class="form-control" 		name="po_number_'+count+'" 		id="po_number_'+count+'" style="width: 100%"></select></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><select class="form-control" 		name="id_product_'+count+'" 	id="id_product_'+count+'" style="width: 100%"></select></div></div>';
	html += '<div class="col-md-3"><div class="form-group" id="item_name_'+count+'"></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="number" class="form-control" 		name="quantity_'+count+'" 		id="quantity_'+count+'"></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="number" class="form-control awb" 	name="awb_'+count+'" 			id="awb_'+count+'" readonly=""></div></div>';
	html += '<input type="hidden" name="lines" id="lines" value="'+count+'">';
	html += '</div>';
	$('#canvas_line').append(html);
	$("select").select2();
	//Ajax PO
	$.ajax({
		type: 'post',
		url: '../controller/ctrshipment.php',
		data: {
			action: 'poShipment',
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
	//Change P.O.
	$('#po_number_'+count).change(function(){
		var po = $(this).val();

		$.ajax({
			type: 'post',
			url: '../controller/ctrshipment.php',
			data: {
				action: 'productItemCode',
				po: po
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);

				$('#id_product_'+count).append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
				$.each(data, function(i, row){
					$('#id_product_'+count).append($('<option>', {
						value: row.id_product,
						text: row.item_code
					}));
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});

	$('#id_product_'+count).change(function(){
		var po = $('#po_number_'+count).val();
		var product = $(this).val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrshipment.php',
			data: {
				action: 'productItemName',
				po: po,
				product: product
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				$.each(data, function(i, row){
					$('#item_name_'+count).html(row.item_description);
				});
				$.each(data, function(i, row){
					$('#quantity_'+count).val(row.quantity);
				});
				$('#awb_'+count).val(0);
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
}

function loadTraccar(){
	
	//$('#load_traccar').load('http://172.246.126.64:8082/');
	
}