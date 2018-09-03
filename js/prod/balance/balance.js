$(function(){
	$('a[title]').tooltip();
});
function next_3(id_pos,tot_day,fechaini,min,max){
	$('#edicion').load('production/balance/balance.php?idpost='+id_pos+'&diastot='+tot_day+'&fecini='+fechaini+'&fmin='+min+'&fmax='+max);
	$('#paso3').click();
}

function newpos_form_button(){
		var data = $('#newpos_form').serialize();
		$.ajax({
			type: 'post',
			url: '../controller/ctr_prod_balance.php',
			data: data,
			dataType: 'json',
			beforeSend: function() {
				
			}
		}).done(function(result){
			if(result.bool){
				$('#msg_posc').hide();
				$('#newpos_form')[0].reset()
				$('#lista').load('production/balance/list_poscosecha.php');
				$('#paso2').click();	
			} else {
				if (result.msg == "Campos Vacios"){
					$('#msg_posc').html(result.msg);
					$('#msg_posc').show();
				}
			}
		});	
		
}





