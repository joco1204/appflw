$(function(){
	$('#table_boxes').dataTable({
		"order": [ 1, "desc" ],
		"pageLength": 25
	});
	$.ajax({
		type: 'post',
		url: '../controller/ctrboxes.php',
		data: {
			action: 'boxesTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				html += '<tr>';
				html += '<td><button type="button" class="btn btn-info btn-sm" onclick="javascript: pageContent(\'setting/boxes/form\', \'id_Boxes='+row.id_box_type+'\');"><span class="glyphicon glyphicon-search"></span></button>'+row.code+'</td>';
				html += '<td>'+row.box_name+'</td>';
				html += '<td>'+row.length+'</td>';
				html += '<td>'+row.width+'</td>';
				html += '<td>'+row.height+'</td>';
				html += '<td>'+row.fbe+'</td>';
				html += '</tr>';
			});
			$('#data_boxes_list').html(html);
		} else {
			console.log('Error: '+result.msg);
		}
	});
	$('#boxes_form').submit(function(e){
		e.preventDefault();
		$('#action').val('boxesCreate');
		var data = $('#boxes_form').serialize();
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
		

	});
	
});