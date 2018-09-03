$(function(){
	
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
				html += '</thead>';
				
				html += '<tr>';
					html += '<th rowspan="2">N ORDEN</th>';
					html += '<th rowspan="2">CLIENTE</th>';
					html += '<th rowspan="2">TOTAL ORDENES/CAJAS</th>';
					html += '<th rowspan="2">FALTANTE</th>';
				
					html += '<th>martes</th>';
					html += '<th>miércoles</th>';
					html += '<th>jueves</th>';
					html += '<th>viernes</th>';
					html += '<th>sábado</th>';
					html += '<th>domingo</th>';
				html += '</tr>';
				html += '<tr>';
					html += '<th>martes</th>';
					html += '<th>miércoles</th>';
					html += '<th>jueves</th>';
					html += '<th>viernes</th>';
					html += '<th>sábado</th>';
					html += '<th>domingo</th>';
				html += '</tr>';
				//html += '</thead>';
				html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td style="cursor:pointer;" ><span class="glyphicon glyphicon-plus" data-toggle="tooltip" data-placement="right" title="ORDER ID. '+row.N_ORDEN+'"></span> '+row.N_ORDEN+'</td>';
					html += '<td style="cursor:pointer;">'+row.PRODUCTO+'</td>';
					html += '<td style="cursor:pointer;">'+row.CANTIDAD+'</td>';
					html += '<td style="cursor:pointer;"><input type="number" readonly id="text_f'+i+'" value="'+row.CANTIDAD+'"/></td>';
					html += '<td style="cursor:pointer;"><input type="number" onkeyup="opercasilla(\'a'+i+'\','+i+')" id="text_a'+i+'"/></td>';
					html += '<td style="cursor:pointer;"><input type="number" onkeyup="opercasilla(\'b'+i+'\','+i+')" id="text_b'+i+'"/></td>';
					html += '<td style="cursor:pointer;"><input type="number" onkeyup="opercasilla(\'c'+i+'\','+i+')" id="text_c'+i+'"/></td>';
					html += '<td style="cursor:pointer;"><input type="number" onkeyup="opercasilla(\'d'+i+'\','+i+')" id="text_d'+i+'"/></td>';
					html += '<td style="cursor:pointer;"><input type="number" onkeyup="opercasilla(\'e'+i+'\','+i+')" id="text_e'+i+'"/></td>';
					html += '<td style="cursor:pointer;"><input type="number" onkeyup="opercasilla(\'f'+i+'\','+i+')" id="text_f'+i+'"/></td>';
					
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
				
				$('#data_balance').html(html);
				/*$('#table_po').dataTable({
					"order": [ 1, "desc" ],
					"pageLength": 25
				});*/
			} else {
				console.log('Error: '+result.msg);
			}
		});
	
});

function opercasilla(columna,n_linea){
	var dato1=$('#text_'+columna).val();
	var dato2=$('#text_f'+n_linea).val();
	
	if (dato2 !=""){
		if (dato1 !=""){
			var faltantes = parseInt(dato2)-parseInt(dato1);
			$('#text_f'+n_linea).val(faltantes);
		}
	}
}







