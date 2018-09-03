<div class="container" style="background-color:#FFF;">
	<div class="row">
        <div class="col-md-3">
            <form action="#" method="get">
                <div class="input-group">
                    <!-- USE TWITTER TYPEAHEAD JSON WITH API TO SEARCH -->
                    <input class="form-control" id="system-search" name="q" placeholder="Search for" required>
                    <span class="input-group-btn">
                        <button type="submit" class="btn btn-default"><i class="glyphicon glyphicon-search"></i></button>
                    </span>
                </div>
            </form>
			
        </div>
		<div class="col-md-9">
    	 <table class="table table-list-search" style="background-color:white;">
                    <thead>
                        <tr>
							<th></th>
                            <th>Nombre</th>
                            <th>Fecha Inicial</th>
							<th>Fecha Final</th>
							<th>Dias Total</th>
							<th>Miami Ship Mínimo</th>
							<th>Miami Ship Máximo</th>
                            <th>Estado</th>
                        </tr>
                    </thead>
                    <tbody id="table_list">
                       
                    </tbody>
                </table>   
		</div>
	</div>
</div>

<script src="../../js/prod/balance/lista.js"></script>