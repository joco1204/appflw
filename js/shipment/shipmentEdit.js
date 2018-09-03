$(function(){
	$('#customer').prop('disabled', true);
	$('#truck_company').prop('disabled', true);
	$('#consignee').prop('disabled', true);
	$('#shipping_date').prop('disabled', true);
	$('.popup_date').hide();
	$('#temp').prop('readonly', true);
	$('#received_damage').prop('readonly', true);
	$('#tqoc').prop('readonly', true);
	$('#cro').prop('readonly', true);
	$('#status').prop('disabled', true);
	$('#comments').prop('readonly', true);
	//Ajax get shipment
	var iS = $('#idShipment').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctrshipment.php',
		data: {
			action: 'shipmentGet',
			id: iS,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$.each(data, function(i, row){
				$('#customer').append($('<option>', {
					value: row.id_customer,
					text: row.customer
				}));
				$('#truck_company').append($('<option>', {
					value: row.id_truck,
					text: row.truck
				}));
				$('#consignee').append($('<option>', {
					value: row.id_consignee,
					text: row.consignee
				}));
				$('#consignee').val(row.id_consignee);
				$('#shipping_date').val(row.date_shipping);
				$('#temp').val(row.temp);
				$('#received_damage').val(row.received_damage);
				$('#tqoc').val(row.total_quantity);
				$('#cro').val(row.cases_received);
				$('#status').append($('<option>', {
					value: row.id_status,
					text: row.status
				}));
				$('#comments').val(row.comments);
				if(row.id_status == '24'){
					$('#shipment_edit').hide();
				}
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	//Ajax get lines shipment
	$.ajax({
		type: 'post',
		url: '../controller/ctrshipment.php',
		data: {
			action: 'shipmentLines',
			id: iS,
		},
		dataType: 'json',
	}).done(function(result){
		var data = $.parseJSON(result.msg);
		var html = '';
		$.each(data, function(i, row){
			var i = i+1;
			html += '<div class="row line" id="line_'+i+'">';
			html += '<div class="col-md-3">'+row.po_number+'</div>';
			html += '<div class="col-md-2">'+row.item_code+'</div>';
			html += '<div class="col-md-3">'+row.item_description+'</div>';
			html += '<div class="col-md-2">'+row.quantity+'</div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="number" class="form-control awb" name="awb_'+i+'" id="awb_'+i+'" value="'+row.delivered_awb+'" readonly=""></div></div>';
			html += '<input type="hidden" name="number_lines" id="i" value="'+i+'">';
			html += '</div>';
		});
		$('#canvas_line').html(html);
	});
	//Edit shipment function
	$('#shipment_edit').click(function(e){
		e.preventDefault();
		if($('#shipment_edit').html() == 'Edit'){
			$('#status').prop('disabled', false);
			$('#shipment_edit').html('Save');
			var status = $('#status').val();
			$('#status').empty();
			

			//Ajax status
			$.ajax({
				type: 'post',
				url: '../controller/ctrshipment.php',
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
						if(status == row.id_status){
							$('#status').append($('<option>', {
								value: row.id_status,
								text: row.status
							}).attr("selected", true));
						} else {	
							$('#status').append($('<option>', {
								value: row.id_status,
								text: row.status
							}));
						}
					});
				} else {
					console.log('Error: '+result.msg);
				}
			});
			
			//Status change
			$('#status').change(function(){
				if($(this).val() == '24'){
					$('#received_damage').prop('readonly', false);
					$('#tqoc').prop('readonly', false);
					$('#cro').prop('readonly', false);
					$('.awb').prop('readonly', false);
					$('#pod').prop('disabled', false);
				}
				if($(this).val() != '24'){
					$('#received_damage').prop('readonly', true);
					$('#tqoc').prop('readonly', true);
					$('#cro').prop('readonly', true);
					$('.awb').prop('readonly', true);
					$('#pod').prop('disabled', true);
				}
			});
		} else {
			$('#action').val('shipmentUpdate');
			var data = $('#shipment_form').serialize();
			$.ajax({
				type: 'post',
				url: '../controller/ctrshipment.php',
				data: data,
				dataType: 'json',
			}).done(function(result){
				if(result.bool){
					if($('#status').val() == '24'){
						var pod = $('#pod').prop('files')[0];
						var data = new FormData();
						data.append('action', 'pod');
						data.append('id', $('#idShipment').val());
						data.append('pod', pod);
						$.ajax({
							url: '../controller/ctrshipment.php',
							type: 'post',
							data: data,
							processData: false,
							contentType: false,
							success: function (res){
								swal({
									title: "¡Success!",
									text: result.msg,
									type: 'success',
									showCancelButton: false,
									confirmButtonClass: "btn-success",
									confirmButtonText: "Aceptar",
									closeOnConfirm: true,
								},function(){
									pageContent('handling/shipment/index');
								});
							}
						});
					} else {
						swal({
							title: "¡Success!",
							text: result.msg,
							type: 'success',
							showCancelButton: false,
							confirmButtonClass: "btn-success",
							confirmButtonText: "Aceptar",
							closeOnConfirm: true,
						},function(){
							pageContent('handling/shipment/index');
						});
					}
				} else {
					console.log('Error: '+result.msg);
				}
			});
		}
	});
});