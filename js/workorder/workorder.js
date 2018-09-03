$(function(){

	//Ajax table
	$.ajax({
		type: 'post',
		url: '../controller/ctrworkorder.php',
		data: {
			action: 'workorderTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<table class="table table-striped table-bordered display" id="table_workorder">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>W.O. #</th>';
			html += '<th>Date</th>';
			html += '<th>P.O. #</th>';
			html += '<th>Customer</th>';
			html += '<th>Consignee</th>';
			html += '<th>Boxes Qty</th>';
			html += '<th>Status</th>';
			html += '<th>PDF</th>';
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			$.each(data, function(i, row){
				html += '<tr>';
				html += '<td onclick="javascript: pageContent(\'handling/workorder/form\', \'id_wo='+row.wo+'\' );" style="cursor:pointer;">'+row.wo+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/workorder/form\', \'id_wo='+row.wo+'\' );" style="cursor:pointer;">'+row.ship_date+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/workorder/form\', \'id_wo='+row.wo+'\' );" style="cursor:pointer;">'+row.po+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/workorder/form\', \'id_wo='+row.wo+'\' );" style="cursor:pointer;">'+row.customer+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/workorder/form\', \'id_wo='+row.wo+'\' );" style="cursor:pointer;">'+row.consignee+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/workorder/form\', \'id_wo='+row.wo+'\' );" style="cursor:pointer;">'+row.quantity+'</td>';
				html += '<td><span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span></td>';
				html += '<td onclick="window.open(\'handling/workorder/pdf.php?id_po='+row.po+'\',\'_blank\');"> <span class=" label label-warning glyphicon glyphicon-file" style="width: 80px; cursor:pointer;">PDF</span></td>';
				html += '</tr>';
			});
			html += '</tbody>';
			html += '<tfoot>';
			html += '<tr>';
			html += '<th>W.O. #</th>';
			html += '<th>Date</th>';
			html += '<th>P.O. #</th>';
			html += '<th>Customer</th>';
			html += '<th>Consignee</th>';
			html += '<th>Boxes Qty</th>';
			html += '<th>Status</th>';
			html += '<th>PDF</th>';
			html += '</tr>';
			html += '</tfoot>';
			html += '</table>';
			$('#data_work_order_list').html(html);
			$('#table_workorder').dataTable({
				"order": [ 1, "desc" ],
				"pageLength": 25
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	$('#quantity_line').val('0');
	$('#unit_price_line').val('0');
	$('#total_init_price_line').val('0');
	$('#subtotal_price_line').val('0');
	$('#tax_percent_line').val('0');
	$('#tax_price_line').val('0');
	$('#total_price_line').val('0');

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

	//Contact Customer
	$("#customer" ).change(function(){
		$('#contact_number').empty();
		var sel_customer = $( "#customer" ).val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrworkorder.php',
			data: {
				action: 'contactCustomer',
				customer: sel_customer,
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				$('#contact_number').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
				$.each(data, function(i, row){
					$('#contact_number').append($('<option>', {
						value: row.id_contact,
						text: row.first_name
					}));
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});

	//Data Contact Customers
	$("#contact_number" ).change(function() {
		var contact_number = $( "#contact_number" ).val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrworkorder.php',
			data: {
				action: 'contactCustomerInfo',
				contact_number: contact_number,
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				$.each(data, function(i, row){
					$( "#mobile" ).val(row.mobile);
					$( "#phone" ).val(row.home_phone);
					$( "#email" ).val(row.email);
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});

	//Ajax PO
	$.ajax({
		type: 'post',
		url: '../controller/ctrworkorder.php',
		data: {
			action: 'poWo',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
				$('#po').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#po').append($('<option>', {
					value: row.po_number,
					text: row.po_number
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Change P.O.
	$('#po').change(function(){
		var po = $(this).val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrworkorder.php',
			data: {
				action: 'productItemCode',
				po: po
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				$('#item').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
				$.each(data, function(i, row){
					$('#item').append($('<option>', {
						value: row.id_product,
						text: row.item_code
					}));
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});

	//Item Po
	$('#item').change(function(){
		var po = $('#po').val();
		var product = $(this).val();
		$.ajax({
			type: 'post',
			url: '../controller/ctrworkorder.php',
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
					$('#id_product_name').val(row.id_product);
					$('#item_description').val(row.item_description);
					$('#box_type_dry').val(row.box_type_dry);
					$('#boxesqty').val(row.box_qty);
					$('#pack_dry').val(row.pack_dry);
					$('#wet_per_dry').val(row.wet_per_dry);
					$('#pack_per_wet').val(row.pack_per_wet);
					$('#box_type_wet').val(row.box_type_wet)
				});
				$.each(data, function(i, row){
					$('#boxestypes').append($('<option>', {
						value: row.id_box_type,
						text: row.code+' - '+row.length+'x'+row.width+'x'+row.height
					}));
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});

	//Consignee 
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
			$('#ship_via').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				var row = $.parseJSON(row);
				$('#ship_via').append($('<option>', {
					value: row.id,
					text: row.name_company
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	
	//Status Work Order
	$.ajax({
		type: 'post',
		url: '../controller/ctrworkorder.php',
		data: {
			action: 'status',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#status').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#status').append($('<option>', {
					value: row.id_status,
					text: row.status
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Submit Work Order
	$('#workOrder_form').submit(function(e){
		e.preventDefault();
		$('#action').val('workorderCreate');
		var data = $('#workOrder_form').serialize();
		$.ajax({
			type: 'post',
			url: '../controller/ctrworkorder.php',
			data: data,
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
					pageContent('handling/workorder/index');
				});
    		} else {
    			swal("Error!",result.msg,"error");
    		}
		});
	});

});

//Function price
function price(){
	if($('#quantity_line').val() == ''){
		$('#quantity_line').val('0');
	}
	if($('#unit_price_line').val() == ''){
		$('#unit_price_line').val('0');
	}
	if($('#tax_percent_line').val() == ''){
		$('#tax_percent_line').val('0');
	}
	var total_init = (parseFloat($('#quantity_line').val()) * parseFloat($('#unit_price_line').val()));
	var tax_price = ((parseFloat($('#tax_percent_line').val())/100)*total_init);
	$('#tax_price_line').val(tax_price);
	var total_price = (parseFloat($('#tax_price_line').val()) + parseFloat(total_init));
	$('#total_init_price_line').val(total_init);
	$('#subtotal_price_line').val(total_init);
	$('#total_price_line').val(total_price);
}



	
		