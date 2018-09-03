$(document).ready(function() {
	
	$.ajax({
		type: 'post',
		url: '../controller/ctr_prod_balance.php',
		data: {
			action: 'ListBalance',
		},
		dataType: 'json',
	}).done(function(result){
		if(result.bool){
			var data = $.parseJSON(result.msg);
			var html = '';
			$.each(data, function(i, row){
				
				html += '<tr>';
				html += '<td style="cursor:pointer;"><a href="#" onclick="next_3('+row.id+','+row.dias_tot+',\''+row.fecha_inicial+'\','+row.ship_min+','+row.ship_max+');"><i class="glyphicon glyphicon-edit"></i></a></td>';
				html += '<td style="cursor:pointer;">'+row.nombre+'</td>';
				html += '<td style="cursor:pointer;">'+row.fecha_inicial+'</td>';
				html += '<td style="cursor:pointer;">'+row.fecha_final+'</td>';
				html += '<td style="cursor:pointer;">'+row.dias_tot+'</td>';
				html += '<td style="cursor:pointer;">'+row.ship_min+'</td>';
				html += '<td style="cursor:pointer;">'+row.ship_max+'</td>';
				html += '<td style="cursor:pointer;">'+row.estado+'</td>';
				html += '</tr>';
			});
			$('#table_list').html(html);
			} else {
			console.log('Error: '+result.msg);
		}
	});
    var activeSystemClass = $('.list-group-item.active');

    //something is entered in search form
    $('#system-search').keyup( function() {
       var that = this;
        // affect all table rows on in systems table
        var tableBody = $('.table-list-search tbody');
        var tableRowsClass = $('.table-list-search tbody tr');
        $('.search-sf').remove();
        tableRowsClass.each( function(i, val) {
        
            //Lower text for case insensitive
            var rowText = $(val).text().toLowerCase();
            var inputText = $(that).val().toLowerCase();
            if(inputText != '')
            {
                $('.search-query-sf').remove();
                tableBody.prepend('<tr class="search-query-sf"><td colspan="6"><strong>Searching for: "'
                    + $(that).val()
                    + '"</strong></td></tr>');
            }
            else
            {
                $('.search-query-sf').remove();
            }

            if( rowText.indexOf( inputText ) == -1 )
            {
                //hide rows
                tableRowsClass.eq(i).hide();
                
            }
            else
            {
                $('.search-sf').remove();
                tableRowsClass.eq(i).show();
            }
        });
        //all tr elements are hidden
        if(tableRowsClass.children(':visible').length == 0)
        {
            tableBody.append('<tr class="search-sf"><td class="text-muted" colspan="6">No entries found.</td></tr>');
        }
    });
});