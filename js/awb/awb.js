$(function(){
	
	//Ajax table receiving
	$.ajax({
		type: 'post',
		url: '../controller/ctrawb.php',
		data: {
			action: 'awbTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<table class="table table-striped table-bordered display" id="table_receiving">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>AWB Master</th>';
			html += '<th>Truck Date</th>';
			html += '<th>City</th>';
			html += '<th>Carrier</th>';
			html += '<th>Customer</th>';
			html += '<th>Box Qty</th>';
			html += '<th>Status</th>';
			html += '<th>PDF</th>';
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			$.each(data, function(i, row){
				html += '<tr>';
				html += '<td onclick="javascript: pageContent(\'handling/awb/form\', \'id_receiving='+row.id_receiving+'\');" style="cursor:pointer;">'+row.awb+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/awb/form\', \'id_receiving='+row.id_receiving+'\');" style="cursor:pointer;">'+row.truck_date+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/awb/form\', \'id_receiving='+row.id_receiving+'\');" style="cursor:pointer;">'+row.city+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/awb/form\', \'id_receiving='+row.id_receiving+'\');" style="cursor:pointer;">'+row.carrie_grower+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/awb/form\', \'id_receiving='+row.id_receiving+'\');" style="cursor:pointer;">'+row.customer+'</td>';
				html += '<td onclick="javascript: pageContent(\'handling/awb/form\', \'id_receiving='+row.id_receiving+'\');" style="cursor:pointer;">'+row.box_qty+'</td>';
				html += '<td>';
				if (row.id_status == '32'){
					html += '<span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span>';
				} else {
					html += '<span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span><span onclick="javascript: status_change('+row.id_receiving+',\''+row.awb+'\');" class="glyphicon glyphicon-refresh" data-toggle="modal" data-target="#change_status" style="cursor:pointer;"></span>';
				}
					
				html += '<td onclick="window.open(\'handling/awb/pdf.php?id_receiving='+row.id_receiving+'\',\'_blank\');"> <span class=" label label-warning glyphicon glyphicon-file" style="width: 80px; cursor:pointer;">PDF</span></td>';
				html += '</td>';
				html += '</tr>';
			});
			html += '</tbody>';
			html += '<tfoot>';
			html += '<tr>';
			html += '<th>AWB Master</th>';
			html += '<th>Truck Date</th>';
			html += '<th>City</th>';
			html += '<th>Carrier</th>';
			html += '<th>Customer</th>';
			html += '<th>Box Qty</th>';
			html += '<th>Status</th>';
			html += '<th>PDF</th>';
			html += '</tr>';
			html += '</tfoot>';
			html += '</table>';

			$('#data_awb_list').html(html);
			$('#table_receiving').dataTable({
				"order": [ 1, "desc" ],
				"pageLength": 25
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});


	//Ajax upload file po FULL
	$('#load_file_awb').submit(function(e){
		e.preventDefault();
		$('#awb_file').modal('toggle');
		var file = $('#file_awb').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insert_file_awb');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/ctrawb.php',
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
					pageContent('handling/awb/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});



	$('#change_status').on('shown.bs.modal', function(){
		//Ajax status line
		$.ajax({
			type: 'post',
			url: '../controller/ctrawb.php',
			data: {
				action: 'awbStatus',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
					$('#status_new').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
				$.each(data, function(i, row){
					$('#status_new').append($('<option>', {
						value: row.id_status,
						text: row.status
					}));
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
});


//open modal status
function status_change(idawb, awb){
	$('#awb_status_change').val(idawb);
	$('#awb_n').html(awb);
}

function  update_status(){
	$.ajax({
		type: 'post',
		url: '../controller/ctrawb.php',
		data: {
			action: 'awbUpdateStatus',
			id_status: $('#status_new').val(),
			awb: $('#awb_status_change').val()
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
				pageContent('handling/awb/index');
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
}
