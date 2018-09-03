$(function(){
	//Ajax upload file id order
	$('#load_file_id_order').submit(function(e){
		e.preventDefault();
		$('#load_id_order').modal('toggle');
		var file = $('#file_id_order').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFileIDOrder');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
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
					pageContent('production/carga/ID_ORDER/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	//Ajax upload file invenatrio flor
	$('#load_file_inventario_flor').submit(function(e){
		e.preventDefault();
		$('#load_inventario_flor').modal('toggle');
		var file = $('#file_inventario_flor').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFileInventarioFlor');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
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
					pageContent('production/carga/ID_ORDER/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	
	
	//Ajax upload file invenatrio hg
	$('#load_file_inventario_hg').submit(function(e){
		e.preventDefault();
		$('#load_inventario_hg').modal('toggle');
		var file = $('#file_inventario_hg').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFileInventarioHg');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
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
					pageContent('production/carga/ID_ORDER/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	
	//Ajax upload file orden de compra flor
	$('#load_file_orden_compra_flor').submit(function(e){
		e.preventDefault();
		$('#load_orden_compra_flor').modal('toggle');
		var file = $('#file_orden_compra_flor').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFileOrdenCompraFlor');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
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
					pageContent('production/carga/ID_ORDER/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	
	//Ajax upload file orden de compra hg
	$('#load_file_orden_compra_hg').submit(function(e){
		e.preventDefault();
		$('#load_orden_compra_hg').modal('toggle');
		var file = $('#file_orden_compra_hg').prop('files')[0];
		var data = new FormData();
		data.append('action', 'insertFileOrdenCompraHg');
		data.append('file', file);
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
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
					pageContent('production/carga/ID_ORDER/index');
				});
			} else {
				swal('Error!',result.msg,'error');
				console.log('Error: '+result.msg);
			}
		});
	});
	
	
	//Ajax table ID ORDER
	$('#view_id_order').click(function(e){
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
			data: {
				action: 'TableIdOrder',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_po">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>ORDER ID</th>';
				html += '<th>CUSTOMER</th>';
				html += '<th>MIAMI SHIP</th>';
				html += '<th>TOTAL BOX</th>';
				html += '<th>N° RECETA</th>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td style="cursor:pointer;" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="ORDER ID. '+row.order_id+'"></span> '+row.ORDER_ID+'</td>';
					html += '<td style="cursor:pointer;">'+row.CUSTOMER+'</td>';
					html += '<td style="cursor:pointer;">'+row.MIAMI_SHIP+'</td>';
					html += '<td style="cursor:pointer;">'+row.TOTAL_BOX+'</td>';
					html += '<td style="cursor:pointer;">'+row.N_RECETA+'</td>';
					html += '<td style="cursor:pointer;">'+row.PRODUCTO+'</td>';
					html += '<td style="cursor:pointer;">'+row.COLOR+'</td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>ORDER ID</th>';
				html += '<th>CUSTOMER</th>';
				html += '<th>MIAMI SHIP</th>';
				html += '<th>TOTAL BOX</th>';
				html += '<th>N° RECETA</th>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				
				$('#data_po_list').html(html);
				$('#table_po').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
	
	
	
	//Ajax table Inventario flor
	$('#view_inventario_flor').click(function(e){
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
			data: {
				action: 'TableInventarioFlor',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_po">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>GRADE</th>';
				html += '<th>CANTIDAD</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td style="cursor:pointer;" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="ORDER ID. '+row.PRODUCTO+'"></span> '+row.PRODUCTO+'</td>';
					html += '<td style="cursor:pointer;">'+row.COLOR+'</td>';
					html += '<td style="cursor:pointer;">'+row.GRADE+'</td>';
					html += '<td style="cursor:pointer;">'+row.CANTIDAD+'</td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>GRADE</th>';
				html += '<th>CANTIDAD</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				
				$('#data_po_list').html(html);
				$('#table_po').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
	
	
	//Ajax table Inventario flor
	$('#view_inventario_hg').click(function(e){
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
			data: {
				action: 'TableInventarioHg',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_po">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>TAMAÑO</th>';
				html += '<th>CANTIDAD</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td style="cursor:pointer;" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="ORDER ID. '+row.PRODUCTO+'"></span> '+row.PRODUCTO+'</td>';
					html += '<td style="cursor:pointer;">'+row.COLOR+'</td>';
					html += '<td style="cursor:pointer;">'+row.TAMANO+'</td>';
					html += '<td style="cursor:pointer;">'+row.CANTIDAD+'</td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>TAMAÑO</th>';
				html += '<th>CANTIDAD</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				
				$('#data_po_list').html(html);
				$('#table_po').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
	
	//Ajax table orden de compra flor
	$('#view_orden_compra_flor').click(function(e){
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
			data: {
				action: 'TableOrdenCompraFlor',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_po">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>N ORDEN</th>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>GRADE</th>';
				html += '<th>CANTIDAD</th>';
				html += '<th>DATE ARRIVE</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td style="cursor:pointer;" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="ORDER ID. '+row.N_ORDEN+'"></span> '+row.N_ORDEN+'</td>';
					html += '<td style="cursor:pointer;">'+row.PRODUCTO+'</td>';
					html += '<td style="cursor:pointer;">'+row.COLOR+'</td>';
					html += '<td style="cursor:pointer;">'+row.TAMANO+'</td>';
					html += '<td style="cursor:pointer;">'+row.CANTIDAD+'</td>';
					html += '<td style="cursor:pointer;">'+row.DATE_ARRIVE+'</td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>N ORDEN</th>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>GRADE</th>';
				html += '<th>CANTIDAD</th>';
				html += '<th>DATE ARRIVE</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				
				$('#data_po_list').html(html);
				$('#table_po').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
	
	//Ajax orden de compra hg
	$('#view_orden_compra_hg').click(function(e){
		$.ajax({
			type: 'post',
			url: '../controller/prod_ctr_carga_informacion.php',
			data: {
				action: 'TableOrdenCompraHg',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				html += '<table class="table table-striped table-bordered display" id="table_po">';
				html += '<thead>';
				html += '<tr>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>TAMAÑO</th>';
				html += '<th>CANTIDAD</th>';
				html += '<th>DATE ARRIVE</th>';
				html += '</tr>';
				html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td style="cursor:pointer;" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="ORDER ID. '+row.PRODUCTO+'"></span> '+row.PRODUCTO+'</td>';
					html += '<td style="cursor:pointer;">'+row.COLOR+'</td>';
					html += '<td style="cursor:pointer;">'+row.TAMANO+'</td>';
					html += '<td style="cursor:pointer;">'+row.CANTIDAD+'</td>';
					html += '<td style="cursor:pointer;">'+row.DATE_ARRIVE+'</td>';
					html += '</tr>';
				});
				html += '</tbody>';
				html += '<tfoot>';
				html += '<tr>';
				html += '<th>PRODUCTO</th>';
				html += '<th>COLOR</th>';
				html += '<th>TAMAÑO</th>';
				html += '<th>CANTIDAD</th>';
				html += '<th>DATE ARRIVE</th>';
				html += '</tr>';
				html += '</tfoot>';
				html += '</table>';
				
				$('#data_po_list').html(html);
				$('#table_po').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});
			} else {
				console.log('Error: '+result.msg);
			}
		});
	});
});







