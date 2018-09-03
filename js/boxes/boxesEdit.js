$(function(){
	
	$('#code').prop('readonly', true);
	$('#box_name').prop('readonly', true);
	$('#brand').prop('readonly', true);
	$('#width').prop('readonly', true);
	$('#length').prop('readonly', true);
	$('#height').prop('readonly', true);
	$('#fbe').prop('readonly', true);
	
	
	
	var iB=$('#idBoxes').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctrboxes.php',
		data: {
			action: 'boxesGet',
			idBoxes: iB,
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				$('#code').val(row.code);
				$('#box_name').val(row.box_name);
				$('#brand').val(row.brand);
				$('#width').val(row.width);
				$('#length').val(row.length);
				$('#height').val(row.height);
				$('#fbe').val(row.fbe);
				
			});
			//$('#data_boxes_list').html(html);
		} else {
			console.log('Error: '+result.msg);
		}
	});
	
	$('#boxes_edit').click(function(e){
		e.preventDefault();
		if ($('#boxes_edit').html()=='Edit'){
			$('#code').prop('readonly', false);
			$('#box_name').prop('readonly', false);
			$('#brand').prop('readonly', false);
			$('#width').prop('readonly', false);
			$('#length').prop('readonly', false);
			$('#height').prop('readonly', false);
			$('#fbe').prop('readonly', false);
			$('#boxes_edit').html('Save');
		}else{
			$('#action').val('boxesUpdate');
			var data = $('#boxes_form').serialize();
			//alert(data);
			$.ajax({
				type: 'post',
				url: '../controller/ctrboxes.php',
				data: data,
				dataType: 'json',
			}).done(function(result){
				if(result.bool){
					swal({
						title: "¡Success!",
						text: result.msg,
						type: '',
						showCancelButton: false,
						confirmButtonClass: "btn-success",
						confirmButtonText: "Aceptar",
						closeOnConfirm: true,
					},function(){
						pageContent('setting/boxes/index');
					});
					
					
				} else {
				console.log('Error: '+result.msg);
			}
			});
		}	
	});
	
});