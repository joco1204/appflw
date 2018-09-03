//Function to load the content of each module
var pageContent = function(page, settings){
	//Valid whether the configuration parameters are defined or not
	if (settings === undefined || settings === null || settings  === ''){
		//Make the page load in the container
		$("#content-index").load(page+".php", function(response, status, xhr){
			//Valid if the status of the file's upload is correct or not
			if (status == "error"){
				$("#content-index").load("config/error.php");
			}
		});
	} else {
		try{
			var params 	= JSON.parse(settings);
			var bool 	= true;
		} catch(e){
			var params 	= settings;
			var bool 	= false;
		}
		//Make the page load in the container
		$("#content-index").load(page+".php", params, function(response, status, xhr){
			//Valid if the status of the file's upload is correct or not
			if(status == "error"){
				$("#content-index").load("config/error.php");
			} else {
				//Validate that the Boolean variable is true
				if (bool){
					//The parameters are loaded in the form
					if(params.length){
						$.each(params, function(n, v){
							if ($("[name="+n+"]").length){
								$("[name="+n+"]").val(v);
							}
						});
					}
				}
			}
		});
	}
}
//Remove Session Storage 
var removeSession = function(){
	sessionStorage.removeItem('iduser');
	sessionStorage.removeItem('idprofile');
	sessionStorage.removeItem('userprofile');
	sessionStorage.removeItem('username');
	sessionStorage.removeItem('lastname');
	sessionStorage.removeItem('ncompany');
	sessionStorage.removeItem('company');
	sessionStorage.removeItem('companyweb');
	sessionStorage.removeItem('companylogo');
	sessionStorage.removeItem('logo_long');
	sessionStorage.removeItem('logo_mini');
	sessionStorage.removeItem('color');
	sessionStorage.removeItem('headquarters');
	sessionStorage.removeItem('country');
	sessionStorage.removeItem('city');
	sessionStorage.removeItem('position');
	sessionStorage.removeItem('token');
	sessionStorage.clear();
}
//Function to close session of the application
var logout = function(){
	$.ajax({
		type: "POST", 
		url: "../controller/ctrlogout.php",
		data: {
			action: 'logout',
		},
		dataType: 'json'
	}).done(function(result){
		if (result.bool){
			removeSession();
			window.location.href = "../../";
		} else {
			console.log('Error: '+result.msg)
		}
	});	
};
//Start timeout
var timeout;
function startTimeOut() {
	timeout = setTimeout(function(){redirectTimeOut()}, 1200000);
}
function stopTimeOut() {
  clearTimeout(timeout);
  timeout = setTimeout('location="../../"', 1200000);
}
function redirectTimeOut(){
	$.ajax({
		type: "POST", 
		url: "../controller/ctrlogout.php",
		data: {
			action: 'logout',
		},
		dataType: 'json'
	}).done(function(result){
		if (result.bool){
			window.location.href = "../../";
			removeSession();	
		} else {
			console.log('Error: '+result.msg)
		}
	});	
}


