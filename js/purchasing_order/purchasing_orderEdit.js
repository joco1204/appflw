$(function(){
	$('#po_number').prop('readonly', true);
	$('#department_miami_date').prop('disabled', true);
	$('#dc_delivery_date').prop('disabled', true);
	$('#dc_came').prop('disabled', true);
	$('#client').prop('disabled', true);
	$('#supplier').prop('disabled', true);
	$('#pallet_total').prop('readonly', true);
	$('#case_total').prop('readonly', true);
	$('#cube_total').prop('readonly', true);
	$('#mini_boxes').prop('readonly', true);
	$('#start_boxes').prop('readonly', true);
	$('#sell_by_date').prop('disabled', true);
	$('#status').prop('disabled', true);
	$('#comments').prop('readonly', true);
	$('.input-group-addon').hide();
	$('#add_line').prop('disabled', true);

	//Ajax get purchasing order
	var idPo = $('#idPo').val();
	var po_number = 0;
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'poGet',
			id: idPo,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$.each(data, function(i, row){
				$('#po_number').val(row.po_number);
				$('#department_miami_date').val(row.depart_miami_date);
				$('#dc_delivery_date').val(row.delivery_date);
				$('#dc_came').append($('<option>', {
					value: row.id_dc_name,
					text: row.dc_name
				}));
				$('#client').append($('<option>', {
					value: row.id_client,
					text: row.client_name
				}));
				$('#supplier').append($('<option>', {
					value: row.id_supplier,
					text: row.supplier_name
				}));
				$('#pallet_total').val(row.pallet_total);
				$('#case_total').val(row.case_total);
				$('#cube_total').val(row.cube_total);
				$('#mini_boxes').val(row.min_boxes);
				$('#start_boxes').val(row.start_boxes);
				$('#sell_by_date').val(row.sell_by_date);
				$('#comments').val(row.comments);
				$('#status').append($('<option>', {
					value: row.id_status,
					text: row.status_name
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Ajax get lines reciving
	$.ajax({
		type: 'post',
		url: '../controller/ctrpurchasingorder.php',
		data: {
			action: 'productsLines',
			idPo: idPo,
		},
		dataType: 'json',
	}).done(function(result){
		var data = $.parseJSON(result.msg);
		var html = '';
		$.each(data, function(i, row){
			html += '<div class="row line" id="line_'+i+'">';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="item_code_'+i+'" 		id="item_code_'+i+'" 	class="form-control" readonly="" value="'+row.item_code+'"></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="product_name_'+i+'" 	id="product_name_'+i+'" class="form-control" readonly="" value="'+row.product_name+'"></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><select 				name="box_type_'+i+'" 		id="box_type_'+i+'" 	class="form-control" disabled=""><option value="'+row.id_box+'">'+row.box+'</option></select></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><select 				name="pack_'+i+'" 			id="pack_'+i+'" 		class="form-control" disabled=""><option value="'+row.pack+'">'+row.pack_name+'</option></select></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="quantity_'+i+'" 		id="quantity_'+i+'" 	class="form-control" readonly="" value="'+row.quantity+'"></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="fulls_'+i+'" 			id="fulls_'+i+'" 		class="form-control" readonly="" value="'+row.fulls+'"></div></div>';
			html += '</div>';
		});
		$('#canvas_line').html(html);
		$("select").select2();
	});
});