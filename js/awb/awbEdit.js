$('[data-toggle="tooltip"]').tooltip({
	html: "true", 
    placement: "auto-right", 
    delay: {show: 500, hide: 500}
});

$(function(){
	//Disabled, readonly field and hide label field
	$('#awb_number').prop('readonly', true);
	$('#awb_hija').prop('readonly', true);
	$('#origin_country').prop('disabled', true);
	$('#awb_nieta').prop('readonly', true);
	$('#origin_city').prop('disabled', true);
	$('#carrie_grower').prop('disabled', true);
	$('#customer').prop('disabled', true);
	$('#pieces_master').prop('readonly', true);
	$('#ship_date_origin').prop('disabled', true);
	$('#status').prop('disabled', true);
	$('#time_ship_origin').prop('readonly', true);
	$('#weight').prop('readonly', true);
	$('#tip_weight').prop('disabled', true);
	$('#date_arrival').prop('disabled', true);
	$('#temp').prop('readonly', true);
	$('#time_arrival').prop('readonly', true);
	$('#notes').prop('readonly', true);
	$('.popup_date').hide();

	//Ajax get receiving
	var iR=$('#idReceiving').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctrawb.php',
		data: {
			action: 'awbGet',
			idReceiving: iR,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				$('#awb_number').val(row.awb);
				$('#awb_hija').val(row.awb_hija);
				$('#origin_country').append($('<option>', {
					value: row.id_country,
					text: row.country
				}));
				$('#awb_nieta').val(row.awb_nieta);
				$('#origin_city').append($('<option>', {
					value: row.id_city,
					text: row.city
				}));
				$('#carrie_grower').append($('<option>', {
					value: row.id_carrie,
					text: row.carrie
				}));
				$('#customer').append($('<option>', {
					value: row.id_customer,
					text: row.customer
				}));
				$('#pieces_master').val(row.pieces_master);
				$('#ship_date_origin').val(row.ship_date_origin);
				$('#status').append($('<option>', {
					value: row.id_status,
					text: row.status
				}));
				$('#status_h').val(row.id_status);
				$('#time_ship_origin').val(row.time_ship_origin);
				$('#weight').val(row.weight);
				$('#tip_weight').append($('<option>', {
					value: row.type_weight,
					text: row.type_weight
				}));
				$('#date_arrival').val(row.date_arrival);
				$('#temp').val(row.temp);
				$('#time_arrival').val(row.time_arrival);
				$('#notes').val(row.comments);

				//Ajax get lines reciving
				$.ajax({
					type: 'post',
					url: '../controller/ctrawb.php',
					data: {
						action: 'awbLines',
						awb: row.awb,
					},
					dataType: 'json',
				}).done(function(result1){
					var data1 = $.parseJSON(result1.msg);
					var html1 = '';
					$.each(data1, function(i, row){
						html1 += '<div class="row line" id="line_'+i+'">';
						html1 += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="po_number_'+i+'" 	id="po_number_'+i+'" 	class="form-control" value="'+row.po+'" 			readonly=""></div></div>';
						html1 += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="po_prod_id_'+i+'" id="po_prod_id_'+i+'"	class="form-control" value="'+row.item_code+'" 	readonly=""></div></div>';
						html1 += '<div class="col-md-2"><div class="form-group"><input type="text" 	name="boxes_'+i+'" 		id="boxes_'+i+'" 		class="form-control" value="'+row.box+'" 			readonly=""></div></div>';
						html1 += '<div class="col-md-2"><div class="form-group"><input type="text"	name="pieces_'+i+'" 	id="pieces_'+i+'" 		class="form-control" value="'+row.pallet_qty+'" 		readonly=""></div></div>';
						html1 += '<div class="col-md-2"><div class="form-group"><input type="text"	name="label_init_'+i+'" id="label_init_'+i+'" 	class="form-control" value="'+row.label_init+'" 	readonly=""></div></div>';
						html1 += '<div class="col-md-2"><div class="form-group"><input type="text"	name="label_end_'+i+'" 	id="label_end_'+i+'" 	class="form-control" value="'+row.label_end+'" 		readonly=""></div></div>';
						html1 += '</div>';
					});
					$('#canvas_line').html(html1);
				});

			});
			$('#data_awb_list').html(html);
		} else {
			console.log('Error: '+result.msg);
		}
	});

				


	//Button Save & Edit
	$('#receiving_edit').click(function(e){
		e.preventDefault();
		if ($('#receiving_edit').html() == 'Edit'){
			//Edit Receiving Number
			$('#origin_country').prop('disabled', false)
			$('#origin_city').prop('disabled', false);
			$('#carrie_grower').prop('disabled', false);
			$('#ship_date_origin').prop('disabled', false);
			$('#time_ship_origin').prop('readonly', false);
			$('#date_arrival').prop('disabled', false);
			$('#temp').prop('readonly', false);
			$('#time_arrival').prop('readonly', false);
			$('#notes').prop('readonly', false);
			$('.popup_date').show();
			$('#receiving_edit').html('Save')

			//Add option Type Weight
			tweight = $('#tip_weight').val();
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

			//Ajax Origin Country
			origin_country = $('#origin_country').val();
			$('#origin_country').empty();
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
						if (origin_country == row.id_country){
							$('#origin_country').append($('<option>', {
								value: row.id_country,
								text: row.country
							}).attr("selected", true));
						} else {	
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

			//Ajax Origin City
			var origin_city = $('#origin_city').val();
			$.ajax({
				type: 'post',
				url: '../controller/ctrawb.php',
				data: {
					action: 'awbCity',
					country: origin_country,
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
						if (origin_city == row.id){
							$('#origin_city').append($('<option>', {
								value: row.id,
								text: row.city
							}).attr("selected", true));
						} else {	
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


			$("#origin_country").change(function() {
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
			
			//Ajax Carrier/Grower
			growerNow = $('#carrie_grower').val();
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
		} else {
			//Update Receiving
			$('#action').val('awbUpdate');
			var data = $('#receiving_form').serialize();
			$.ajax({
				type: 'post',
				url: '../controller/ctrawb.php',
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
						pageContent('handling/awb/index');
					});
				} else {
				console.log('Error: '+result.msg);
			}
			});
		}	
	});
	
});