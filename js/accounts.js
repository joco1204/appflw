$(function(){
	
	//Ajax return accounts table
	$.ajax({
			type: 'post',
			url: '../controller/ctraccounts.php',
			data: {
				action: 'accountsTable',
			},
			dataType: 'json',
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				
				html += '<table class="table table-striped table-bordered display" id="table_accounts">';
                html += '<thead>';
                html += '<tr>';
                html += '<th></th>';
                html += '<th>Company Name</th>';
                html += '<th>Phone</th>';
                html += '<th>Contact Name</th>';
                html += '<th>Email</th>';
                html += '</tr>';
                html += '</thead>';
                html += '<tbody>';
				$.each(data, function(i, row){
					html += '<tr>';
					html += '<td><button type="button" class="btn btn-info btn-sm" onclick="javascript: pageContent(\'setting/accounts/form\', \'id='+row.id+'\');"><span class="glyphicon glyphicon-search"></span></button></td>';
					html += '<td>'+row.name_company+'</td>';
					html += '<td>'+row.phone_number+'</td>';
					html += '<td></td>';
					html += '<td></td>';
					html += '</tr>';
				});
				html += '</tbody>';
                html += '<tfoot>';
                html += '<tr>';
                html += '<th></th>';
                html += '<th>Company Name</th>';
                html += '<th>Phone</th>';
                html += '<th>Contact Name</th>';
                html += '<th>Email</th>';
                html += '</tr>';
                html += '</tfoot>';
                html += '</table>';
				$('#data_accounts').html(html);
				$('#table_accounts').DataTable();
			} else {
				console.log('Error: '+result.msg);
			}
		});


		//Ajax return country selection
		$.ajax({
			type: 'post',
			url: '../controller/ctrcountry.php',
			data: {
				action: 'selectCountrys'
			},
			dataType: 'json'
		}).done(function(result){
			if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				$('#country_billing_address').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
				$.each(data, function(i, row){	
					$('#country_billing_address').append($('<option>', {
						value: row.id_country,
						text: row.country
					}));
				});
				$('#country_shipping_address').append($('<option>', {
					value: 0,
					text: "Choose Option"
				}));
				$.each(data, function(i, row){	
					$('#country_shipping_address').append($('<option>', {
						value: row.id_country,
						text: row.country
					}));
				});
			} else {
				console.log('Error: '+result.msg); 
			}
		});


//Submit account form
$('#account_form').submit(function(e){
e.preventDefault();
var data = $(this).serialize();
if($('#action').val() == 'insertAccount'){
$.ajax({
type: 'post',
url: '../controller/ctraccounts.php',
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
console.log('Error: '+result.msg); 
}
});
});

function new_con(){
var nowContact=$('#newsContact').html();
var name=$('#dato1').val();
var laname=$('#dato2').val();
var cotype=$('#dato3').val();
var depar=$('#dato4').val();
var jobt=$('#dato5').val();
var hophone=$('#dato6').val();
var mob=$('#dato7').val();
var email=$('#dato8').val();
var pconta=$('#dato9').val();
var error = "";
if(name==""){
	error= error + "First Name<br\>";
} if (laname==""){
	error= error + "Last Name<br\>";
} 

if(cotype==""){
	error= error + "Contact Type<br\>";
}
if (depar==""){
error= error + "Department<br\>";
}
if (jobt==""){
error= error + "Job Title<br\>";
}
if (hophone==""){
error= error + "Home Phone<br\>";
}
if (mob==""){
error= error + "Mobile<br\>";
}
if (email==""){
error= error + "Email<br\>";
}
if (pconta==""){
error= error + "Primary Contact<br\>";
}
if (error==""){
var nactual=$('#n_contact').val();
var nactualInt=parseInt(nactual);
var new_n=nactualInt+1;
var contacto ='<div class="row">';
contacto =contacto+'<div class="col-lg-12">';
contacto =contacto+'<div class="panel panel-success">';
contacto =contacto+'Contact # '+new_n;
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="row">';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="toll_free">First name:</label>';
contacto =contacto+'<input type="text" class="form-control" name="fname'+new_n+'" id="fname" placeholder="" value="'+name+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="cut_off">Last name:</label>';
contacto =contacto+'<input type="text" class="form-control" name="lname'+new_n+'" id="lname" placeholder="" value="'+laname+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="row">';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="toll_free">Contact type:</label>';
contacto =contacto+'<input type="text" class="form-control" name="ctype'+new_n+'" id="ctype" placeholder="" value="'+cotype+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="cut_off">Departament:</label>';
contacto =contacto+'<input type="text" class="form-control" name="department'+new_n+'" id="department" placeholder="" value="'+depar+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="row">';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="toll_free">Job Title:</label>';
contacto =contacto+'<input type="text" class="form-control" name="job'+new_n+'" id="job" placeholder="" value="'+jobt+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="cut_off">Home phone:</label>';
contacto =contacto+'<input type="text" class="form-control" name="hphone'+new_n+'" id="hphone" placeholder="" value="'+hophone+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="row">';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="toll_free">Mobile:</label>';
contacto =contacto+'<input type="text" class="form-control" name="mobile'+new_n+'" id="mobile" placeholder="" value="'+mob+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="cut_off">Email:</label>';
contacto =contacto+'<input type="text" class="form-control" name="email'+new_n+'" id="email" placeholder="" value="'+email+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="row">';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'<label for="toll_free">Primary contact:</label>';
contacto =contacto+'<input type="text" class="form-control" name="pcontact'+new_n+'" id="pcontact" placeholder="" value="'+pconta+'">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'<div class="col-md-6">';
contacto =contacto+'<div class="form-group">';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
contacto =contacto+'</div>';
$('#newsContact').html(nowContact+contacto);
$('#n_contact').val(new_n);
$('#dato1').val('');
$('#dato2').val('');
$('#dato3').val('');
$('#dato4').val('');
$('#dato5').val('');
$('#dato6').val('');
$('#dato7').val('');
$('#dato8').val('');
$('#dato9').val('');
$('#msg').html("");
}else{
$('#msg').html("The next fields are empty: " + error);
$('#newContact').modal("show");
}
}
function saveAccount(option){
var data = $('#account_form').serialize();
$.ajax({
type: 'post',
        url: '../controller/ctraccounts.php',
        data: data,
        dataType: 'json',
}).done(function(result){
if (result.bool){
swal({
title: "¡Success!",
text: result.msg,
type: '',
showCancelButton: false,
confirmButtonClass: "btn-success",
confirmButtonText: "Aceptar",
closeOnConfirm: true,
},function(){
if (option==0){
pageContent('setting/accounts/index');
}else{
pageContent('setting/accounts/form');
}
});
}else{
if (result.msg=="Empty data"){
swal({
title: "¡Danger!",
text: result.msg,
type: '',
showCancelButton: false,
confirmButtonClass: "btn-danger",
confirmButtonText: "Aceptar",
closeOnConfirm: true,
},function(){
});
} 
}
});
}

function changeState(field){
	// Ajax return state selection
	
	var actual_country = $('#country_'+field+'_address').val();
		if (actual_country==2){
			$('#city_'+field+'_address').empty();
			$('#state_'+field+'_address').empty();
			$.ajax({
				type: 'post',
				url: '../controller/ctraccounts.php',
				data: {
					action: 'selectState', 
					countryactual: actual_country,
						},
				dataType: 'json'
		}).done(function(result){
		if(result.bool){
				var data = $.parseJSON(result.msg);
				var html = '';
				$('#state_'+field+'_address').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
				$.each(data, function(i, row){	
					$('#state_'+field+'_address').append($('<option>', {
						value: row.id,
						text: row.state
					}));
				});			
				}
		});
		}else{
			$('#city_'+field+'_address').empty();
			$('#state_'+field+'_address').empty();
			$('#state_'+field+'_address').append($('<option>', {
				value: 0,
				text: "Not applicable"
			}));
			$.ajax({
				type: 'post',
				url: '../controller/ctraccounts.php',
				data: {
					action: 'selectCity', 
					actual: actual_country,
					search: 'country',
						},
				dataType: 'json'
			}).done(function(result){
				if(result.bool){
					var data = $.parseJSON(result.msg);
					var html = '';
					$('#city_'+field+'_address').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
					$.each(data, function(i, row){	
						$('#city_'+field+'_address').append($('<option>', {
							value: row.id,
							text: row.city
						}));
					});		
				}
			});				
		}
	}
	function changeCity(field){
		var actual_country = $('#country_'+field+'_address').val();
		if (actual_country ==2){
			$('#city_'+field+'_address').empty();
			var actual_state = $('#state_'+field+'_address').val();
			$.ajax({
					type: 'post',
					url: '../controller/ctraccounts.php',
					data: {
						action: 'selectCity', 
						actual: actual_state,
						search: 'state', 
							},
					dataType: 'json'
			}).done(function(result){
			if(result.bool){
					var data = $.parseJSON(result.msg);
					var html = '';
					$('#city_'+field+'_address').append($('<option>', {
						value: 0,
						text: "Choose Option"
					}));
					$.each(data, function(i, row){	
						$('#city_'+field+'_address').append($('<option>', {
						value: row.id,
						text: row.city
					}));
				});			
			}
			});
		}
		
	}

