$(function(){
		//Ajax return pallet table
		$.ajax({
			type: 'post',
			url: '../controller/ctrpallet.php',
			data: {
				action: 'palletTable',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';

				html += '<table class="table table-striped table-bordered display" id="table_pallet">';
                html += '<thead>';
                html += '<tr>';
                html += '<th>Number</th>';
                html += '<th>Position Number</th>';
                html += '<th>Tag Number</th>';
                html += '<th>Status</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td>'+row.name+'</td>';
					if (row.position_number==1){
						html += '<td>'+"YES"+'</td>';
					} else{
						html += '<td>'+"NO"+'</td>';
					} if (row.tag_number==1){
						html += '<td>'+"YES"+'</td>';
					} else{
						html += '<td>'+"NO"+'</td>';
					}
					if (row.status==30){   
						html +='<td> <span class="label label-'+row.background+' pull-left" style="width: 80px;"> '+"Enabled"+'</span> <span onclick= "update_status(31, '+row.id+')" class="glyphicon glyphicon-refresh" style="cursor:pointer;"></span></td>';
					} else {   
						html +='<td> <span class="label label-'+row.background+' pull-left" style="width: 80px;"> '+"Disabled"+'</span> <span onclick= "update_status(30, '+row.id+')" class="glyphicon glyphicon-refresh" style="cursor:pointer;"></span></td>';
					}
					html += '</tr>';
				});
				html += '</tbody>';
                html += '<tfoot>';
                html += '<tr>';
                html += '<th>Number</th>';
                html += '<th>Position Number</th>';
                html += '<th>Tag Number</th>';
                html += '<th>Status</th>';
                html += '</tr>';
                html += '</tfoot>';
                html += '</table>';

				$('#data_pallet').html(html);
				$('#table_pallet').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});

	   //Submit account form
		$('#new_pallet').submit(function(e){
			e.preventDefault();
			var data = $(this).serialize();
			if($('#action').val() == 'insertPallet'){
				$.ajax({
				type: 'post',
				url: '../controller/ctrpallet.php',
				data: data,
				dataType: 'json',
				}).done(function(result){
					if(result.bool){
					var success = $.parseJSON(result.msg);
					} else {
						console.log('Error: '+result.msg);
					}
				});
			} else {

			}
		});
});

	   
function saveAccount(){
	var data = $('#new_pallet').serialize();
	$.ajax({
		type: 'post',
        url: '../controller/ctrpallet.php',
        data: data,
        dataType: 'json',
	}).done(function(result){
		if (result.bool){
			swal({
				title: "¡Success!",
				text: result.msg,
				type: 'success',
				showCancelButton: false,
				confirmButtonClass: "btn-success",
				confirmButtonText: "Aceptar",
				closeOnConfirm: true,
			},function(){
				pageContent('setting/pallets/index');
			});
		}else{
			if (result.msg=="Empty data"){
				console.log('Error: '+result.msg);
			} 
		}
	});
}

function  update_status(option, npallet){
	$.ajax({
		type: 'post',
		url: '../controller/ctrpallet.php',
		data: {
			action: 'updateStatus',
			new_status: option,
			id: npallet
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
				pageContent('setting/pallets/index');
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
}