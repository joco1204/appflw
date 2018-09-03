$(function(){
	$.ajax({
		type: 'post',
		url: '../controller/ctrinventory.php',
		data: {
			action: 'inventoryTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<table class="table table-striped table-bordered display" id="table_receiving">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>PO #</th>';
			html += '<th>Item Description</th>';
			html += '<th>Pack System</th>';
			html += '<th>Box QTY</th>';
			html += '<th>Pallet Position</th>';
			html += '<th>Pallet Tag</th>';
			html += '<th>Truck Line</th>';
			html += '<th>Truck Day</th>';
			html += '<th>Send</th>';
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			$.each(data, function(i, row){
				html += '<tr>';
				html += '<td>'+row.po_number+'</td>';
				html += '<td>'+row.item_description+'</td>';
				html += '<td>'+row.pack_system+'</td>';
				html += '<td>'+row.box_qty+'</td>';
				html += '<td>'+row.pallet_position+'</td>';
				html += '<td>'+row.pallet_tag+'</td>';
				html += '<td>'+row.truck_line+'</td>';
				html += '<td>'+row.truck_day+'</td>';
				html += '<td><button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#change_status_'+row.id_product+'"><span class="glyphicon glyphicon-refresh"></span></button></td>';
				html += '</tr>';
			});
			html += '</tbody>';
			html += '<tfoot>';
			html += '<tr>';
			html += '<th>PO #</th>';
			html += '<th>Item Description</th>';
			html += '<th>Pack System</th>';
			html += '<th>Box QTY</th>';
			html += '<th>Pallet Position</th>';
			html += '<th>Pallet Tag</th>';
			html += '<th>Truck Line</th>';
			html += '<th>Truck Day</th>';
			html += '<th>Send</th>';
			html += '</tr>';
			html += '</tfoot>';
			html += '</table>';

			$.each(data, function(i, row){
				html += '<div id="change_status_'+row.id_product+'" class="modal fade" role="dialog">';
				html += '<div class="modal-dialog modal-lg">';
				html += '<div class="modal-content">';
				html += '<div class="modal-header text-center bg-green">';
				html += '<button type="button" class="close" data-dismiss="modal">&times;</button>';
				html += '<h4 class="modal-title">Change Inventory Product: </h4>';
				html += '</div>';
				html += '<div class="modal-body">';
				html += '<div class="row">';
				html += '<div class="col-md-2">';
				html += '<label for="status">Status:</label>';
				html += '</div>';
				html += '<div class="col-md-6">';
				html += '<div class="form-group">';
				html += '<select name="status_inventory" id="status_inventory_'+row.id_product+'" class="form-control" style="width: 100%;" onchange="javascript: pdfShipment('+row.po_number+', '+row.id_product+');">';
				html += '<option value="">Chooese Option</option>';
				if(row.pack_system == 'Dry'){
					html += '<option value="18">Shipment</option>';
					var status_inventory = '18';
				} else {
					html += '<option value="19">Work Order</option>';
					var status_inventory = '19';
				}
				html += '</select>';
				html += '</div>';
				html += '</div>';
				html += '<div id="pdf_shipment_'+row.id_product+'" style="display: none;"></div>';
				html += '</div>';
				html += '</div>';
				html += '<div class="modal-footer">';
				html += '<button type="button" class="btn btn-primary btn-sm" data-dismiss="modal" onclick="javascript: status_change(\''+row.po_number+'\',\''+row.id_product+'\', '+status_inventory+', '+row.pallet_position+', '+row.pallet_tag+');">Save</button>';
				html += '<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
				html += '</div>';
			});

			$('#data_awb_list').html(html);
			$('#table_receiving').dataTable({
				"order": [ 1, "desc" ],
				"pageLength": 25
			});
			$("select").select2();
		} else {
			console.log('Error: '+result.msg);
		}
	});
});

function status_change(po, product, status, position, tag){
	if(status > 0){
		$.ajax({
			type: 'post',
			url: '../controller/ctrinventory.php',
			data: {
				action: 'inventoryUpdateStatus',
				po: po,
				product: product,
				status: status,
				position: position, 
				tag: tag
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
					pageContent('handling/inventory/index');
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	} else {
		swal("Error","Choose an option","error");
	}
}


function pdfShipment(po_number, id_product){
	var html = '';
	var status = $('#status_inventory_'+id_product).val();
	if(status == '18'){
		$('#pdf_shipment_'+id_product).show();
		html += '<div class="col-md-2">';
		html += '<label for="status">PDF Shipment Report:</label>';
		html += '</div>';
		html += '<div class="col-md-2">';
		html += '<a href="../model/inventory_reposrt.php?po_number='+po_number+'&id_product='+id_product+'" target="_blank" class="btn btn-danger" role="button"><span class="glyphicon glyphicon-file"></span></a>';
		html += '</div>';
		$('#pdf_shipment_'+id_product).html(html);
	}
}

	