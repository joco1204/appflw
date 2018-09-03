<script>
$.fn.pageMe = function(opts){
    var $this = this,
        defaults = {
            perPage: 50,
            showPrevNext: false,
            hidePageNumbers: false
        },
        settings = $.extend(defaults, opts);
    
    var listElement = $this;
    var perPage = settings.perPage; 
    var children = listElement.children();
    var pager = $('.pager');
    
    if (typeof settings.childSelector!="undefined") {
        children = listElement.find(settings.childSelector);
    }
    
    if (typeof settings.pagerSelector!="undefined") {
        pager = $(settings.pagerSelector);
    }
    
    var numItems = children.size();
    var numPages = Math.ceil(numItems/perPage);

    pager.data("curr",0);
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="prev_link">«</a></li>').appendTo(pager);
    }
    
    var curr = 0;
    while(numPages > curr && (settings.hidePageNumbers==false)){
        $('<li><a href="#" class="page_link">'+(curr+1)+'</a></li>').appendTo(pager);
        curr++;
    }
    
    if (settings.showPrevNext){
        $('<li><a href="#" class="next_link">»</a></li>').appendTo(pager);
    }
    
    pager.find('.page_link:first').addClass('active');
    pager.find('.prev_link').hide();
    if (numPages<=1) {
        pager.find('.next_link').hide();
    }
      pager.children().eq(1).addClass("active");
    
    children.hide();
    children.slice(0, perPage).show();
    
    pager.find('li .page_link').click(function(){
        var clickedPage = $(this).html().valueOf()-1;
        goTo(clickedPage,perPage);
        return false;
    });
    pager.find('li .prev_link').click(function(){
        previous();
        return false;
    });
    pager.find('li .next_link').click(function(){
        next();
        return false;
    });
    
    function previous(){
        var goToPage = parseInt(pager.data("curr")) - 1;
        goTo(goToPage);
    }
     
    function next(){
        goToPage = parseInt(pager.data("curr")) + 1;
        goTo(goToPage);
    }
    
    function goTo(page){
        var startAt = page * perPage,
            endOn = startAt + perPage;
        
        children.css('display','none').slice(startAt, endOn).show();
        
        if (page>=1) {
            pager.find('.prev_link').show();
        }
        else {
            pager.find('.prev_link').hide();
        }
        
        if (page<(numPages-1)) {
            pager.find('.next_link').show();
        }
        else {
            pager.find('.next_link').hide();
        }
        
        pager.data("curr",page);
      	pager.children().removeClass("active");
        pager.children().eq(page+1).addClass("active");
    
    }
};
function final_check(){
	var input_poscosecha = $('#id_poscosecha').val();
	var input_dias_tot = $('#dias_total_poscosecha').val();
	var input_fec_ini = $('#fecha_inicial_poscosecha').val();
	var input_min_ship = $('#min_ship').val();
	var input_max_ship = $('#max_ship').val();
	
	$('#edicion').load('production/balance/balance.php?idpost='+input_poscosecha+'&diastot='+input_dias_tot+'&fecini='+input_fec_ini+'&fmin='+input_min_ship+'&fmax='+input_max_ship);
	$('#paso3').click();
}
function contar_check_asoc(){
	$('#myModal').modal('hide');
	var line = $('#nlineas_modal').val();
	var line_totales=parseInt(line)-1;
	var valor_now=0;
	var flag_add="NO";
	var input_poscosecha = $('#id_poscosecha').val();
	var input_dias_tot = $('#dias_total_poscosecha').val();
	var input_fec_ini = $('#fecha_inicial_poscosecha').val();
	var input_min_ship = $('#min_ship').val();
	var input_max_ship = $('#max_ship').val();
	for (i=0;i<=line_totales;i++){
		if( $('#check_pidorder'+i).prop('checked') ) {
			valor_now = $('#input'+i).val();
			$.ajax({
				type: 'post',
				url: '../controller/ctr_prod_balance.php',
				data: {
					action: 'Asoc_Order_Posc',
					idorder: valor_now,
					poscosecha:input_poscosecha
				},
				dataType: 'json',
				beforeSend: function() {
						
				}
			}).done(function(result){
				if(result.bool){
					
				} else {
					alert("No se pudo asociar la linea:"+i+" a la poscosecha");
				}
			});	
		}
	}
	
	final_check();
}
$(document).ready(function(){
	var html="";
	var html_d="";
	var lineas_final = 0;
	$.ajax({
		type: 'post',
		url: '../controller/ctr_prod_balance.php',
		data: {
			action: 'ListAdd_order_ToBalance',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				
				html +="<tr>";
				html +="<td ><button class='btn btn-info btn-sm' id='btn_zoom"+i+"'><span class='glyphicon glyphicon-tags'></span> Detalle</button></td>";
				html +="<td><input type='checkbox' id='check_pidorder"+i+"' class='mail-checkbox mail-group-checkbox'><input type='hidden' value='"+row.pid_order+"' id='input"+i+"'";
				html +=row.ORDER_ID+"</td>";
				html +="<td>"+row.CUSTOMER+"</td>";
				html +="<td>"+row.MIAMI_SHIP+"</td>";
				html +="<td>"+row.TOTAL_BOX+"</td>";
				html +="<td>"+row.PACK+"</td>";
				html +="<td>"+row.N_RECETA+"</td>";
				html +="<td>"+row.PRODUCTO+"</td>";
				html +="<td>"+row.COLOR+"</td>";
				html +="</tr>";
				lineas_final++;
			});
			$('#myTable').html(html);
			$('#myTable').pageMe({pagerSelector:'#myPager',showPrevNext:true,hidePageNumbers:false,perPage:50});
			
			$.each(data, function(i, row){
				$('#btn_zoom'+i).tooltip({title: "<h1><strong>"+row.ORDER_ID+"</strong></h1>detalle No. order para"+row.pid_order, html: true, placement: "bottom"}); 
			});
			$('#nlineas_modal').val(lineas_final);
			//$('#detalles_lineas').html("<button data-dismiss='modal' onclick='contar_check("+lineas_final+");final_check();'>ADD No. Order</button>");
			
		} else {
			console.log('Error: '+result.msg);
		}
	});
	
		
		
  
    
});
</script>
<style>
	.table-responsive {height:450px;width:75%}
</style>
<div class="container">
    <div class="row">
      <div class="table-responsive">
        <table class="table table-hover" >
          <thead>
            <tr>
              <th></th>
			  <th></th>
              <th>ORDER_ID</th>
              <th>CUSTOMER</th>
			  <th>MIAMI SHIP</th>
			  <th>TOTAL BOX</th>
			  <th>PACK</th>
			  <th>N. RECETA</th>
			  <th>PRODUCTO</th>
			  <th>COLOR</th>
            </tr>
          </thead>
          <tbody id="myTable">
            
          </tbody>
        </table> 
			
      </div>
      <div class="col-md-10 text-center">
		<ul class="pagination pagination-lg pager" id="myPager"></ul>
		<div id="detalles_lineas"></div>
	  </div>
	</div>
</div>