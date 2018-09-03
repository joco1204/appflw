$(function(){
	$('#login').submit(function(e){
		e.preventDefault();
		//Ajax that executes the login
		if ($('#user').val() != "" && $('#pass').val() != ""){
			$.ajax({
				type: 'POST',
				url: 'app/controller/ctrlogin.php',
				data: {
						action: 'login',
						user: $('#user').val(), 
						pass: $('#pass').val()
					},
				dataType: 'json'
			}).done(function(result){
				if(result.bool){
					var data = $.parseJSON(result.msg);
					//Ajax building the session
					$.ajax({
						type: 'POST',
						url: 'app/controller/ctrlogin.php',
						data: {
								action: 'session',
								iduser: data.iduser,
								idcompany: data.idcompany,
								token: data.token
							},
						dataType: 'json'
					}).done(function(result2){
						if(result2.bool){
							var data2 = $.parseJSON(result2.msg);
							//Session storage generator
							sessionStorage.setItem('iduser', data2.iduser);
							sessionStorage.setItem('idprofile', data2.idprofile);
							sessionStorage.setItem('userprofile', data2.userprofile);
							sessionStorage.setItem('username', data2.username);
							sessionStorage.setItem('lastname', data2.lastname);
							sessionStorage.setItem('foto', data2.foto);
							sessionStorage.setItem('ncompany', data2.ncompany);
							sessionStorage.setItem('company', data2.company);
							sessionStorage.setItem('companyweb', data2.companyweb);
							sessionStorage.setItem('companylogo', data2.companylogo);
							sessionStorage.setItem('logo_long', data2.logo_long);
							sessionStorage.setItem('logo_mini', data2.logo_mini);
							sessionStorage.setItem('color', data2.color);
							sessionStorage.setItem('headquarters', data2.headquarters);
							sessionStorage.setItem('country', data2.country);
							sessionStorage.setItem('city', data2.city);
							sessionStorage.setItem('position', data2.position);
							sessionStorage.setItem('token', data2.token);
							//entry to the platform
							window.location.href = "app/view/index.php";
						} else {
							////$('#warning-login').fadeIn(10);
							$('#warning-login').css('display','block');
							$('#warning-login').html(result2.msg);
							////$('#warning-login').fadeOut(7000);
						}
					});
				} else {
					//$('#warning-login').fadeIn(10);
					$('#warning-login').css('display','block');
					$('#warning-login').html(result.msg);
					//$('#warning-login').fadeOut(7000);
				}
			});
		} else if ($('#user').val() != "" && $('#pass').val() == "") {
			//$('#warning-login').fadeIn(10);
			$('#warning-login').css('display','block');
			$('#warning-login').html("Empty password");
			//$('#warning-login').fadeOut(7000);
		} else if ($('#user').val() == "" && $('#pass').val() != ""){
			//$('#warning-login').fadeIn(10);
			$('#warning-login').css('display','block');
			$('#warning-login').html("Empty user");
			//$('#warning-login').fadeOut(7000);
		} else {
			//$('#warning-login').fadeIn(10);
			$('#warning-login').css('display','block');
			$('#warning-login').html("Empty username and password");
			//$('#warning-login').fadeOut(7000);
		}
	});

});