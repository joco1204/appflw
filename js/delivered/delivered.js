$(function(){
	$.ajax({
		type: 'post',
		url: '../controller/ctrshipment.php',
		data: {
			action: 'deliveredTable',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			html += '<table class="table table-striped table-bordered display" id="table_shipment">';
			html += '<thead>';
			html += '<tr>';
			html += '<th>BOL #</th>';
			html += '<th>Ship Date</th>';
			html += '<th>Customer</th>';
			html += '<th>Trucking Company</th>';
			html += '<th>Consignee</th>';
			html += '<th>Status</th>';
			html += '<th>POD</th>';
			html += '</tr>';
			html += '</thead>';
			html += '<tbody>';
			$.each(data, function(i, row){
				html += '<tr>';
				html += '<td>'+row.bol+'</td>';
				html += '<td>'+row.date_shipping+'</td>';
				html += '<td>'+row.customer+'</td>';
				html += '<td>'+row.trucking_c+'</td>';
				html += '<td>'+row.consignee+'</td>';
				html += '<td><span class="label label-'+row.background+' pull-left" style="width: 80px;">'+row.status+'</span></td>';
				html += '<td><a href="'+row.pod+'" class="btn btn-primary" download=""><span class="glyphicon glyphicon-file"></span></a></td>';
				html += '</tr>';
			});
			html += '</tbody>';
			html += '<tfoot>';
			html += '<tr>';
			html += '<th>BOL #</th>';
			html += '<th>Ship Date</th>';
			html += '<th>Customer</th>';
			html += '<th>Trucking Company</th>';
			html += '<th>Consignee</th>';
			html += '<th>Status</th>';
			html += '<th>POD</th>';
			html += '</tr>';
			html += '</tfoot>';
			html += '</table>';
			$('#data_delivered').html(html);
			$('#table_shipment').dataTable({
				"order": [ 1, "desc" ],
				"pageLength": 25
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});	
});