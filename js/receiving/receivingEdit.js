$('[data-toggle="tooltip"]').tooltip({
	html: "true", 
    placement: "auto-right", 
    delay: {show: 500, hide: 500}
});

$(function(){
	//Disabled, readonly field and hide label field
	$('#awb_number').prop('readonly', true);
	$('#origin_country').prop('disabled', true);
	$('#origin_city').prop('disabled', true);
	$('#customer').prop('disabled', true);
	$('#receiving_date').prop('readonly', true);
	$('#time').prop('readonly', true);
	$('#weight').prop('readonly', true);
	$('#tip_weight').prop('disabled', true);
	$('#temp').prop('readonly', true);
	$('#fbe_master').prop('readonly', true);
	$('#pieces_master').prop('readonly', true);
	$('#status').prop('disabled', true);
	$('#carrie_grower').prop('disabled', true);
	$('#notes').prop('readonly', true);

	//Ajax get receiving
	var iR=$('#idReceiving').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctrreceiving.php',
		data: {
			action: 'receivingGet',
			idReceiving: iR,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				$('#awb_number').val(row.awb);
				$('#origin_country').append($('<option>', {
					value: row.id_country,
					text: row.country
				}));
				$('#origin_city').append($('<option>', {
					value: row.id_city,
					text: row.city
				}));
				$('#customer').append($('<option>', {
					value: row.id_customer,
					text: row.customer
				}));
				$('#receiving_date').val(row.date);
				$('#time').val(row.time_arrival);
				$('#weight').val(row.weight);
				$('#tip_weight').append($('<option>', {
					value: row.type_weight,
					text: row.type_weight
				}));
				$('#temp').val(row.temp);
				$('#fbe_master').val(row.fbe_master);
				$('#pieces_master').val(row.pieces_master);
				$('#status').append($('<option>', {
					value: row.id_status,
					text: row.status
				}));
				$('#carrie_grower').append($('<option>', {
					value: row.id_carrie,
					text: row.carrie
				}));
				$('#notes').val(row.comments);	
			});
			$('#data_awb_list').html(html);
		} else {
			console.log('Error: '+result.msg);
		}
	});

	//Ajax get lines reciving
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
			html += '<div class="row line" id="line_'+i+'">';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="po_number_'+i+'" 	id="po_number_'+i+'" 	class="form-control" value="'+row.po+'" 			readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="po_prod_id_'+i+'" id="po_prod_id_'+i+'"	class="form-control" value="'+row.product_name+'" 	readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="boxes_'+i+'" 		id="boxes_'+i+'" 		class="form-control" value="'+row.box+'" 			readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text"	name="pieces_'+i+'" 	id="pieces_'+i+'" 		class="form-control" value="'+row.pieces+'" 		readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text"	name="label_init_'+i+'" id="label_init_'+i+'" 	class="form-control" value="'+row.label_init+'" 	readonly=""></div></div>';
			html += '<div class="col-md-2"><div class="form-group"><input type="text"	name="label_end_'+i+'" 	id="label_end_'+i+'" 	class="form-control" value="'+row.label_end+'" 		readonly=""></div></div>';
			html += '</div>';
		});
		$('#canvas_line').html(html);
	});
	//Button Save & Edit
	$('#receiving_edit').click(function(e){
		e.preventDefault();
		if ($('#receiving_edit').html() == 'Edit'){

			//Edit Receiving Number (n)
			$('#awb_number').prop('readonly', false);
			$('#origin_country').prop('disabled', false);
			$('#origin_city').prop('disabled', false);
			$('#customer').prop('disabled', false);
			$('#receiving_date').prop('readonly', false);
			$('#time').prop('readonly', false);
			$('#weight').prop('readonly', false);
			$('#tip_weight').prop('disabled', false);
			$('#temp').prop('readonly', false);
			$('#status').prop('disabled', false);
			$('#carrie_grower').prop('disabled', false);
			$('#notes').prop('readonly', false);
			$('#receiving_edit').html('Save');

			//Add option Type Weight
			tweight=$('#tip_weight').val();
			$('#tip_weight').empty();
			if (tweight == 'KG'){
				$('#tip_weight').append($('<option>', {
					value: 'KG',
					text: 'KG'
				}).attr("selected", true));
			}else{
				$('#tip_weight').append($('<option>', {
					value: 'KG',
					text: 'KG'
				}));
			}
			if (tweight == 'LBS'){
				$('#tip_weight').append($('<option>', {
					value: 'LBS',
					text: 'LBS'
				}).attr("selected", true));
			}else{
				$('#tip_weight').append($('<option>', {
					value: 'LBS',
					text: 'LBS'
				}));
			}

			//Ajax Origin Customer
			customerNow=$('#customer').val();
			$('#customer').empty();
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
						if (customerNow == row.id){
							$('#customer').append($('<option>', {
								value: row.id,
								text: row.name_company
							}).attr("selected", true));
						}else{	
							$('#customer').append($('<option>', {
								value: row.id,
								text: row.name_company
							}));
						}
					});
				} else {
					console.log('Error: '+result.msg);
				}
			});

			//Ajax Origin City
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
							if (origin_cityNow == row.id){
								$('#origin_city').append($('<option>', {
									value: row.id,
									text: row.city
								}).attr("selected", true));
							}else{	
								$('#origin_city').append($('<option>', {
									value: row.id,
									text: row.city
								}));
							}
						});
					} else {
						console.log('Error: '+result.msg);
					}
				});
			});	

			//Ajax Origin Country
			origin_countryNow=$('#origin_country').val();
			$('#origin_country').empty();
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
						if (origin_countryNow == row.id_country){
							$('#origin_country').append($('<option>', {
								value: row.id_country,
								text: row.country
							}).attr("selected", true));
						}else{	
							$('#origin_country').append($('<option>', {
								value: row.id_country,
								text: row.country
							}));
						}
					});
				} else {
					console.log('Error: '+result.msg);
				}
			});

			//Ajax Status
			statusNow = $('#status').val();
			$('#status').empty();
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
						$('#status').append($('<option>', {
							value: 0,
							text: "Choose Option"
						}));
					$.each(data, function(i, row){
						if (statusNow == row.id_status){
							$('#status').append($('<option>', {
								value: row.id_status,
								text: row.status
							}).attr("selected", true));
						}else{	
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
			
			//Ajax Carrier/Grower
			growerNow=$('#carrie_grower').val();
			$('#carrie_grower').empty();
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
					$('#carrie_grower').append($('<option>', {
							value: 0,
							text: "Choose Option"
						}));
					$.each(data, function(i, row){
						if (growerNow == row.id){
							$('#carrie_grower').append($('<option>', {
								value: row.id,
								text: row.name_company
							}).attr("selected", true));
						}else{	
							$('#carrie_grower').append($('<option>', {
								value: row.id,
								text: row.name_company
							}));
						}
					});
				} else {
					console.log('Error: '+result.msg);
				}
			});		
		} else {

			//Update Receiving
			$('#action').val('receivingUpdate');
			var data = $('#receiving_form').serialize();
			$.ajax({
				type: 'post',
				url: '../controller/ctrreceiving.php',
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
						pageContent('handling/receiving/index');
					});
				} else {
				console.log('Error: '+result.msg);
			}
			});
		}	
	});
	
});