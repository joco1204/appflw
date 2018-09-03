$('[data-toggle="tooltip"]').tooltip({
	html: "true", 
    placement: "auto-right", 
    delay: {show: 500, hide: 500}
});
$(function(){
	//Ajax dashboard
	/*$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'datePo',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$.each(data, function(i, row){
				if(row.depart_miami_date == row.one_date){
					$('#one_date_complete').val(row.total);
					$('#one_date_incomplete').val(row.total);
				}
				if(row.depart_miami_date == row.two_date){
					$('#two_date_complete').val(row.total);
					$('#two_date_incomplete').val(row.total);
				}
				if(row.depart_miami_date == row.two_date){
					$('#tree_date_complete').val(row.total);
					$('#tree_date_incomplete').val(row.total);
				}
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});*/
	//Ajax table
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'poTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<table class="table table-striped table-bordered display" id="table_po">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>Customer</th>';
			html += '<th>Truck Date</th>';
			html += '<th>Day</th>';
			html += '<th>Truck Line</th>';
			html += '<th>PO #</th>';
			html += '<th>Consignee</th>';
			html += '<th>Status</th>';
			/*html += '<th>PDF</th>';*/
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			$.each(data, function(i, row){
				/*pageContent(\'handling/purchasing_order/form\', \'id='+row.id+'\');" style="cursor:pointer;"*/
				html += '<tr>';
				html += '<td style="cursor:pointer;" data-toggle="modal" data-target="#product_'+i+'"><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="Click to see products of P.O. '+row.po_number+'"></span> '+row.customer_name+'</td>';
				html += '<td>'+row.truck_date+'</td>';
				html += '<td>'+row.truck_date_day+'</td>';
				html += '<td>'+row.truck_line+'</td>';
				html += '<td>'+row.po_number+'</td>';
				html += '<td>'+row.consignee_name+'</td>';
				html += '<td><span class="label label-'+row.background+' pull-left" style="width: 60px;">'+row.status+'</span></td>';
				/*html += '<td onclick="window.open(\'handling/purchasing_order/pdf.php?id_po='+row.po_number+'\',\'_blank\');"> <span class=" label label-warning glyphicon glyphicon-file" style="width: 80px; cursor:pointer;">PDF</span></td>';*/
				html += '</tr>';
			});
			html += '</tbody>';
			html += '<tfoot>';
			html += '<tr>';
			html += '<th>Customer</th>';
			html += '<th>Truck Date</th>';
			html += '<th>Day</th>';
			html += '<th>Truck Line</th>';
			html += '<th>PO #</th>';
			html += '<th>Consignee</th>';
			html += '<th>Status</th>';
			/*html += '<th>PDF</th>';*/
			html += '</tr>';
			html += '</tfoot>';
			html += '</table>';
			$.each(data, function(i, row){
				html += '<div id="product_'+i+'" class="modal fade" role="dialog">';
				html += '<div class="modal-dialog modal-lg">';
				html += '<div class="modal-content">';
				html += '<div class="modal-header text-center bg-green">';
				html += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
				html += '<h4 style="background-color:white;border:1px;color:green;font-size:26px;"><b>'+row.customer_name+'</b></h4>';
				html += '<h4 class="modal-title" style="font-size:26px;"><b>'+row.consignee_name+'</b></h4>';
				html += '</div>';
				html += '<div class="modal-body">';
				html += '<div class="row">';
				html += '<div class="col col-lg-12">';
				html += '<div class="table-responsive">';
				html += '<table class="table table-striped table-bordered display" id="table_pp_product_po_'+i+'" style="font-size: 12px;">';
				html += '<tr>';
				html += '<th>Consignee State</th><td>'+row.consignee_state+'</td><td colspan="6"></td>';
				html += '</tr>';
				html += '<tr>';
				html += '<th>Consignee D.C. #</th><td>'+row.consignee_dc_number+'</td><td colspan="6" rowspan="2" width="60%" align="center"><span style="font-size:48px;">PO #</span><span style="font-size:48px; color:red;">'+row.po_number+'</span></td>';
				html += '</tr>';
				html += '<tr>';
				html += '<th>Consignee ZIP code</th><td>'+row.consignee_zip_code+'</td>';
				html += '</tr>';
				html += '<tr>';
				html += '<th>Consignee Address</th><td>'+row.consignee_addrees+'</td>';
				html += '</tr>';
				html += '<tr>';
				html += '<th>Consignee City</th><td>'+row.consignee_city+'</td><td colspan="6"></td>';
				html += '</tr>';
				html += '</table>';
				html += '<table class="table table-striped table-bordered display" id="table_product_po_'+i+'" style="font-size: 12px;">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>ITEM CODE</th>';
				html += '<th>DELIVERED DATE</th>';
				html += '<th>TRUCK DATE</th>';
				html += '<th>ITEM DESCRIPTION</th>';
				html += '<th>BOX TYPE DRY</th>';
				html += '<th>PACK SYSTEM</th>';
				html += '<th>BOX QTY</th>';
				html += '<th>STATUS</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody id="products_po_'+i+'">';
				var delivereddate= row.delivered_date;
				var truckdate = row.truck_date;
				$.ajax({
					type: 'post',
					url: '../controller/ctrpurchasingorder.php',
					data: {
						action: 'productsTable',
						po_number: row.po_number,
					},
					dataType: 'json',
				}).done(function(result2){
					var data2 = $.parseJSON(result2.msg);
					var html2 = '';
					$.each(data2, function(j, row2){
						html2 += '<tr>';
						html2 += '<td>'+row2.item_code+'</td>';
						html2 += '<td>'+delivereddate+'</td>';
						html2 += '<td>'+truckdate+'</td>';
						html2 += '<td>'+row2.item_description+'</td>';
						html2 += '<td>'+row2.box_type_dry+'</td>';
						html2 += '<td>'+row2.pack_system+'</td>';
						html2 += '<td>'+row2.box_qty+'</td>';
						html2 += '<td><span class="label label-'+row2.background+' pull-left" style="width: 60px;">'+row2.status+'</span></td>';
						html2 += '</tr>';
					});
					$('#products_po_'+i).html(html2);
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>ITEM CODE</th>';
				html += '<th>DELIVERED DATE</th>';
				html += '<th>TRUCK DATE</th>';
				html += '<th>ITEM DESCRIPTION</th>';
				html += '<th>BOX TYPE DRY</th>';
				html += '<th>PACK SYSTEM</th>';
				html += '<th>BOX QTY</th>';
				html += '<th>STATUS</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '<div class="modal-footer">';
				html += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});
			$('#data_po_list').html(html);

			$('#table_po').dataTable();
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Ajax dc name
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'dc_name',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#dc_came').append($('<option>', {
				value: 0,
				text: "Choose Option"
			}));
			$.each(data, function(i, row){
				$('#dc_came').append($('<option>', {
					value: row.id_city,
					text: row.dc_name
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Ajax client
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'client',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#client').append($('<option>', {
				value: 0,
				text: "Choose Option"
			}));
			$.each(data, function(i, row){
				$('#client').append($('<option>', {
					value: row.id,
					text: row.client_name
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Ajax supplier
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'supplier',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#supplier').append($('<option>', {
				value: 0,
				text: "Choose Option"
			}));
			$.each(data, function(i, row){
				$('#supplier').append($('<option>', {
					value: row.id,
					text: row.supplier_name
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Submit P.O. Ajax
	$('#po_form').submit(function(e){
		e.preventDefault();
		$('#action').val('poCreate');
		var data = $(this).serialize();
		$.ajax({
			type: 'post',
			url: '../controller/ctrpurchasingorder.php',
			data: data,
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				swal({
					title: "Success!",
					text: result.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					pageContent('handling/purchasing_order/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	//Ajax status
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'status',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
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
	//Ajax upload file po FULL
	$('#load_file_form_po_full').submit(function(e){
		e.preventDefault();
		$('#load_file_po_full').modal('toggle');
		var file = $('#file_po_full').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFilePo_Full');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/ctrpurchasingorder.php',
			data: data,
			processData: false,
			contentType: false,
			dataType: 'json'
		}).done(function(result){
			if(result.bool){
				swal({
					title: "Success!",
					text: result.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					pageContent('handling/purchasing_order/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	//Ajax upload file po
	$('#load_file_form_po').submit(function(e){
		e.preventDefault();
		$('#load_file_po').modal('toggle');
		var file = $('#file_po').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFilePo');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/ctrpurchasingorder.php',
			data: data,
			processData: false,
			contentType: false,
			dataType: 'json'
		}).done(function(result){
			if(result.bool){
				swal({
					title: "Success!",
					text: result.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					pageContent('handling/purchasing_order/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	//Ajax upload file product
	$('#load_file_form_product').submit(function(e){
		e.preventDefault();
		$('#product').modal('toggle');
		var file = $('#file_products').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFileProduct');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/ctrpurchasingorder.php',
			data: data,
			processData: false,
			contentType: false,
			dataType: 'json'
		}).done(function(result){
			if(result.bool){
				swal({
					title: "Success!",
					text: result.msg,
					type: 'success',
					showCancelButton: false,
					confirmButtonClass: "btn-success",
					confirmButtonText: "Aceptar",
					closeOnConfirm: true,
				},function(){
					pageContent('handling/purchasing_order/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
});
//
function number_format(id){
	var id = '#'+id;
	var idh = id+'_h';
	$.extend($.fn.autoNumeric.defaults,{       
        aSep: '',
        aDec: '.',
        vMin: '0', 
        vMax: '99999999999999999999',
    });
    $(id).autoNumeric('init');
	$(idh).val($(id).autoNumeric('get'));
}
//
function number_format_d(id){
	var id = '#'+id;
	var idh = id+'_h';
	$.extend($.fn.autoNumeric.defaults, {              
        aSep: '',
        aDec: '.',
        vMin: '0', 
        vMax: '99999999999999999999.99',
    });
    $(id).autoNumeric('init');
	$(idh).val($(id).autoNumeric('get'));
}
//
//function Add Lines
function addlines(){
	var html = '';
	var count = ($('.line').length)+1;
	$('#lines').val(count);
	html += '<div class="row line" id="line_'+count+'">';
	html += '<div class="col-md-2"><div class="form-group"><input type="text" name="item_code_'+count+'" id="item_code_'+count+'" class="form-control"></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="text" name="product_name_'+count+'" id="product_name_'+count+'" class="form-control"></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><select name="box_type_'+count+'" id="box_type_'+count+'" class="form-control"></select></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><select name="pack_'+count+'" id="pack_'+count+'" class="form-control"></select></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="text" name="quantity_'+count+'" id="quantity_'+count+'" class="form-control"></div></div>';
	html += '<div class="col-md-2"><div class="form-group"><input type="text" name="fulls_'+count+'" id="fulls_'+count+'" class="form-control"></div></div>';
	html += '</div>';
	$('#canvas_line').append(html);
	$("select").select2();

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
			$('#box_type_'+count).append($('<option>', {
				value: 0,
				text: "Choose Option"
			}));
			$.each(data, function(i, row){
				$('#box_type_'+count).append($('<option>', {
					value: row.id_box_type,
					text: row.code+' - '+row.dimention
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Pack
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'pack',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#pack_'+count).append($('<option>', {
				value: 0,
				text: "Choose Option"
			}));
			$.each(data, function(i, row){
				$('#pack_'+count).append($('<option>', {
					value: row.id_status,
					text: row.status
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
}






