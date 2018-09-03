var obj1 = {};
var init=0;
console.log('crea array');

function t1(prod_n,n_line){
	var rr=0;
	var in_array=0;	

	if (init == 0){
		obj1[prod_n] = 0;
		console.log('crea item inicial '+prod_n);
		init++;
		rr=0;
	}else{	
		$.each(obj1, function(i, row){
				piecesline=0;
				console.log('item'+prod_n+'ya existe');	
				for (clline=1;clline<n_line;clline++){
					var prodline = $('#po_prod_id_'+clline).val();
					if (prodline==prod_n){
						var tr=$('#pieces_'+clline).val()
						if (tr==""){tr=0;}
						var piecesline=piecesline+parseInt(tr);
					}
				}
				obj1[prod_n] = parseInt(piecesline) ;
				rr=obj1[prod_n];
				in_array=1;
			
		});
		if (in_array == 0){
			console.log('crea item'+prod_n);
			obj1[prod_n] = 0;
			rr=0;
					
		}
	}		 
	return rr;
}	

function sumPiecesMaster(n_line){
	var sum=0;
	for (clline=1;clline<=n_line;clline++){
		var tr=$('#pieces_'+clline).val()
		var sum=sum+parseInt(tr);
		console.log('linea'+clline+':'+sum);
	}
	return sum;
}