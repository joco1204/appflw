

$(function(){
	$('#NewOrderPost').load('production/balance/Relacion_PostOrder.php');
	var idposc=$('#id_poscosecha').val();
	$.ajax({
		type: 'post',
		url: '../controller/ctr_prod_balance.php',
		data: {
			action: 'list_order_posc',
			id_posc:idposc
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$('#ordenes_asoc').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
			$.each(data, function(i, row){
				$('#ordenes_asoc').append($('<option>', {
					value: row.order,
					text: row.order+' - '+row.ORDER_ID+' '+row.CUSTOMER
				}));
			});
		} else {
			console.log('Error: '+result.msg);
		}
	});
	var numday_asoc = $('#dias_total_poscosecha').val();
	var fecini_asoc = $('#fecha_inicial_poscosecha').val();
	var begin = new Date(fecini_asoc);
	var fecha_calculada;
	var dias_print = parseInt(numday_asoc)+1;
	var html='<table class="table table-inbox table-hover">';
	html += '<thead><tr><th><input type="checkbox" class="mail-checkbox mail-group-checkbox" onclick="marcar_lineas_balance();" id="marc_line_balance"></th>';
	html += '<th><a href="#" class="btn mini blue" aria-expanded="false">No. Order</a></th>';
	html += '<th><a href="#" class="btn mini blue" aria-expanded="false">Cliente</a></th>';
	html += '<th><a href="#" class="btn mini blue" aria-expanded="false">Total <br><sub>Ordenes/Cajas</sub></a></th>';
	html += '<th><div class="btn-group hidden-phone" style="writing-mode: vertical-lr;transform: rotate(180deg);">';
	html += '<a href="#" class="btn mini blue" aria-expanded="false">Faltante</a></div></th>';
	var i;
	
	for (i=1;i<=dias_print;i++){
		fecha_calculada = sumarDias(begin, +1)
		var h_fecha = fecha_calculada.getFullYear()+'-'+(fecha_calculada.getMonth()+1)+'-'+fecha_calculada.getDate();
		var h_dia = letraDia(fecha_calculada.getDay());
		html += '<th><div class="btn-group hidden-phone" style="writing-mode: vertical-lr;transform: rotate(180deg);">';
		html += '<a href="#" class="btn mini blue" aria-expanded="false">'+h_dia+'<br />'+h_fecha+'</a></div></th>';
	}
	
	html += '</tr></thead><tbody id="tbody_balance"></tbody></table>';
	$('#table_balance').html(html);
	
});

function valorData(dRow,dCol){
	var faltRow= parseInt($('#faltante'+dRow).val());
	var RowCol= parseInt($('#data'+dRow+'_'+dCol).val());
	/*if (RowCol > faltRow){
		alert('El dato es mayor del faltante');
		$('#data'+dRow+'_'+dCol).val(0);
	}else{*/
		var numday_asoc = $('#dias_total_poscosecha').val();
		var dias_print = parseInt(numday_asoc)+1;
		var totRow= $('#total'+dRow).val();
		var unidades=0;
		for (i=0;i<dias_print;i++){
			var dc= $('#data'+dRow+'_'+i).val();
			if (dc == ""){
				dc = 0;
			}
			unidades = parseInt(unidades)+parseInt(dc);
		}
		unidades = parseInt(totRow)-parseInt(unidades);
		$('#faltante'+dRow).val(unidades);
		if (unidades <= 0){
			if (unidades == 0){
				$('#faltante'+dRow).css('background-color', '#22c222');
				$('#faltante'+dRow).css('border-color', '#22c222');
			}else{
				$('#data'+dRow+'_'+dCol).val(0);
				valorData(dRow,dCol);
			}
		}else{
			$('#faltante'+dRow).css('background-color', '#FFF');
			$('#faltante'+dRow).css('border-color', '#c61e0b');
		}
	//}
}

function sumarDias(fecha, dias){
  fecha.setDate(fecha.getDate() + dias);
  return fecha;
}
function letraDia(day){
	var Lday="";
	switch (day)
	{
		case 6: 
			Lday="Sabado";
		break;
		case 0: 
			Lday="Domingo";
		break;
		case 1: 
			Lday="Lunes";
		break;
		case 2: 
			Lday="Martes";
		break;
		case 3: 
			Lday="Miercoles";
		break;
		case 4: 
			Lday="Jueves";
		break;
		case 5: 
			Lday="Viernes";
		break;

		default: 
			Lday="Dia de la semana";
		break;
	}
	return Lday;
}
function choose_order(opt){
	if( $('#marc_line_balance').prop('checked') ) {
		$('#marc_line_balance').prop('checked', false);
	}
	var data_row=0;
	var html2 ="";
	var numday_asoc = $('#dias_total_poscosecha').val();
	var poscosecha  = $('#id_poscosecha').val();
	var min_asoc = $('#min_ship').val();
	var max_asoc = $('#max_ship').val();
	var ship_max = (parseInt(numday_asoc)-parseInt(max_asoc))+1;
	var ship_min = (parseInt(numday_asoc)-parseInt(min_asoc))+2;
	var dias_print = parseInt(numday_asoc)+1;
	if(opt==1){
		var ord_asoc = $('#ordenes_asoc').val();
	}else{
		var ord_asoc = 0;
	}
	
	$.ajax({
		type: 'post',
		url: '../controller/ctr_prod_balance.php',
		data: {
			action: 'balance_order_posc',
			id_ord:ord_asoc,
			id_pos : poscosecha
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			$.each(data, function(i, row){
				html2 += "<tr>";
				html2 += '<td><input type="checkbox" id="check'+data_row+'" class="mail-checkbox mail-group-checkbox"></td>';
				html2 += "<td>"+row.ORDER_ID+"</td>";
				html2 += "<td>"+row.CUSTOMER+"</td>";
				html2 += '<td><input type="text" class="campo_val_day" size="2" id="total'+data_row+'" value="'+row.TOTAL_BOX+'" readonly/></td>';
				html2 += '<td><input type="text" class="campo_val_day" size="2" id="faltante'+data_row+'" value="'+row.TOTAL_BOX_REST+'" readonly/></td>';
				var data_col=0;	
				for (i=1;i<=dias_print;i++){
					if(i > ship_max){
						if(i < ship_min){	
							html2 += '<td class="inbox-small-cells"><input type="text" class="campo_val_day" size="2" id="data'+data_row+'_'+data_col+'"  onkeyup="valorData('+data_row+','+data_col+');"/></td>';
						}else{
							html2 += '<td class="inbox-small-cells" ><input type="text" style="background-Color:red;borderColor:red;" class="campo_val_day" size="2" id="data'+data_row+'_'+data_col+'"  onkeyup="valorData('+data_row+','+data_col+');" readonly/></td>';
						}
					}else{
						html2 += '<td class="inbox-small-cells"><input type="text" style="background-Color:red;borderColor:red;" class="campo_val_day" size="2" id="data'+data_row+'_'+data_col+'"  onkeyup="valorData('+data_row+','+data_col+');" readonly/></td>';
					}
					data_col++;
				}
				html2 += "</tr>";
				data_row++;
			});
			var col_botones=dias_print+5;
			html2 +='<tr><td colspan="'+col_botones+'">';
			html2 +='<input type="hidden" value="'+data_row+'" id="row_tot_balance"/><a href="#" type="button" onclick="save_all_balance()" class="btn btn-primary btn-outline-rounded green"> Guardar lineas seleccionadas<span style="margin-left:10px;" class="glyphicon glyphicon-save"></span></a>';
			html2 +='</td></tr>';
			$('#tbody_balance').html(html2);
		} else {
			console.log('Error: '+result.msg);
		}
	});
	
	
	
	
}

function marcar_lineas_balance(){
	var numcheck = $('#row_tot_balance').val();
	if( $('#marc_line_balance').prop('checked') ) {
		for (i=0;i<=numcheck-1;i++){
			alert(i+' <= '+numcheck);
			$('#check'+i).prop('checked', true);
		}
	}else{
		for (i=0;i<=numcheck-1;i++){
			alert(i+' <= '+numcheck);
			$('#check'+i).prop('checked', false);
		}
	}
	
}


function contar_check(){
	contar_check_asoc();
}