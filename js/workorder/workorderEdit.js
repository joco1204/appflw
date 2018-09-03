$(function(){
	$('#customer').prop('disabled', true);
	$('#po').prop('disabled', true);
	$('#contact_number').prop('disabled', true);
	$('#item').prop('disabled', true);
	$('#email').prop('readonly', true);
	$('#consignee').prop('disabled', true);
	$('#phone').prop('readonly', true);
	$('#ship_via').prop('disabled', true);
	$('#mobile').prop('readonly', true);
	$('#ship_date').prop('disabled', true);
	$('#cut_off').prop('disabled', true);
	$('#sell_by_date').prop('disabled', true);
	$('#status').prop('disabled', true);
	$('#notes').prop('readonly', true);
	
	$('#item_description').prop('readonly', true);
	$('#box_type_dry').prop('readonly', true);
	$('#boxesqty').prop('readonly', true);
	$('#pack_dry').prop('readonly', true);
	$('#wet_per_dry').prop('readonly', true);
	$('#pack_per_wet').prop('readonly', true);
	$('#box_type_wet').prop('readonly', true);

	//Line
	$('#activity_line').prop('readonly', true);
	$('#description_line').prop('readonly', true);
	$('#quantity_line').prop('readonly', true);
	$('#unit_price_line').prop('readonly', true);
	$('#total_init_price_line').prop('readonly', true);
	$('#subtotal_price_line').prop('readonly', true);
	$('#tax_percent_line').prop('readonly', true);
	$('#tax_price_line').prop('readonly', true);
	$('#total_price_line').prop('readonly', true);
	//
	$('.popup_date').hide()
	//
	var id_wo = $('#idWo').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctrworkorder.php',
		data: {
			action: 'workorderGet',
			id_wo: id_wo,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				$('#customer').append($('<option>', {
					value: row.id_customer,
					text: row.customer
				}));
				$('#po').append($('<option>', {
					value: row.po_number,
					text: row.po_number
				}));
				$('#contact_number').append($('<option>', {
					value: row.id_contact,
					text: row.first_name+" "+row.last_name
				}));
				$('#item').append($('<option>', {
					value: row.id_product,
					text: row.item_code
				}));
				$('#email').val(row.email);
				$('#consignee').append($('<option>', {
					value: row.id_consignee,
					text: row.consignee
				}));
				$('#phone').val(row.home_phone);
				$('#ship_via').append($('<option>', {
					value: row.id_truck,
					text: row.truck
				}));
				$('#mobile').val(row.mobile);
				$('#ship_date').val(row.ship_date);
				$('#cut_off').val(row.cut_off);
				$('#sell_by_date').val(row.sell_date);
				$('#status').append($('<option>', {
					value: row.id_status,
					text: row.status
				}));
				$('#notes').val(row.notes);
				$('#item_description').val(row.item_description);
				$('#box_type_dry').val(row.box_type_dry);
				$('#boxesqty').val(row.box_qty);
				$('#pack_dry').val(row.pack_dry);
				$('#wet_per_dry').val(row.wet_per_dry);
				$('#pack_per_wet').val(row.pack_per_wet);
				$('#box_type_wet').val(row.box_type_wet);
				//Line
				$('#activity_line').val(row.activity_line);
				$('#description_line').val(row.description_line);
				$('#quantity_line').val(row.quantity_line);
				$('#unit_price_line').val(row.unit_price_line);
				var total_init = (parseFloat(row.quantity_line)*parseFloat(row.unit_price_line));
				$('#total_init_price_line').val(total_init);
				$('#subtotal_price_line').val(total_init);
				$('#tax_percent_line').val(row.tax_percent_line);
				$('#tax_price_line').val(row.tax_price_line);
				$('#total_price_line').val(row.total_price_line);

				if(row.id_status == '29'){
					$('#workOrder_edit').hide();		
				}
			});
			
			
		} else {
			console.log('Error: '+result.msg);
		}
	});
	$('#workOrder_edit').click(function(e){
		e.preventDefault();
		if ($('#workOrder_edit').html() == 'Edit'){
			$('#customer').prop('disabled', false);
			$('#po').prop('disabled', false);
			$('#contact_number').prop('disabled', false);
			$('#item').prop('disabled', false);
			$('#consignee').prop('disabled', false);
			$('#ship_via').prop('disabled', false);
			$('#ship_date').prop('disabled', false);
			$('#cut_off').prop('disabled', false);
			$('#sell_by_date').prop('disabled', false);
			$('#status').prop('disabled', false);
			$('#notes').prop('readonly', false);
			$('#boxesqty').prop('readonly', false);
			$('#activity_line').prop('readonly', false);
			$('#description_line').prop('readonly', false);
			$('#quantity_line').prop('readonly', false);
			$('#unit_price_line').prop('readonly', false);
			$('#tax_percent_line').prop('readonly', false);
			$('.popup_date').show();
			$('#workOrder_edit').html('Save');

			//Ajax Customer
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

			//Ajax Contact Customer
			var customer = $('#customer').val();
			$.ajax({
				type: 'post',
				url: '../controller/ctrworkorder.php',
				data: {
					action: 'contactCustomer',
					customer: customer,
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

			//Contact Customer Change
			$("#customer" ).change(function() {
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

			//Ajax Item PO
			var po = $('#po').val();
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

			//Change P.O.
			$('#po').change(function(){
				var po = $('#po').val();
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

			//Change Item Po
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
							$('#item_description').val(row.item_description);
							$('#box_type_dry').val(row.box_type_dry);
							$('#boxesqty').val(row.box_qty);
							$('#pack_dry').val(row.pack_dry);
							$('#wet_per_dry').val(row.wet_per_dry);
							$('#pack_per_wet').val(row.pack_per_wet);
							$('#box_type_wet').val(row.box_type_wet);
						});
					} else {
						console.log('Error: '+result.msg);
					}
				});
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

			//
			$('#status').change(function(){
				if($(this).val() == '29'){
					$('#pallets').show();
					$('#pallet_tag').prop('disabled', false);
					$('#pallet_position').prop('disabled', false);

					$.ajax({
						type: 'post',
						url: '../controller/ctrpallet.php',
						data: {
							action: 'pallets_tag_number',
						},
						dataType: 'json',
					}).done(function(result){
						if(result.bool){
							var data = $.parseJSON(result.msg);
							$.each(data, function(i, row){
								$('#pallet_tag').val(row.pallet_tag);
							});
						} else {
							console.log('Error: '+result.msg);
						}
					});
				} else {
					$('#pallet_tag').val('');
					$('#pallet_position').val('');
					$('#pallet_tag').prop('disabled', true);
					$('#pallet_position').prop('disabled', true);
					$('#pallets').hide();
				}

			});

		}else{
			$('#action').val('workorderUpdate');
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
					console.log('Error: '+result.msg);
				}
			});
		}	
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

