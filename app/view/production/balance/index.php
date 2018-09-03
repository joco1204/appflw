<style>
@import url(http://fonts.googleapis.com/css?family=Roboto+Condensed:400,700);
/* written by riliwan balogun http://www.facebook.com/riliwan.rabo*/
.board{
	width: 100%;
	margin: 0px auto;
	height: 500px;
	background: #fff;
	/*box-shadow: 10px 10px #ccc,-10px 20px #ddd;*/
}
.board .nav-tabs {
	position: relative;
	/* border-bottom: 0; */
	/* width: 80%; */
	margin: 40px auto;
	margin-bottom: 0;
	box-sizing: border-box;
}

.board > div.board-inner{
	background-color:#222d32;
	background-size: 30%;
}

p.narrow{
	width: 60%;
	margin: 10px auto;
}

.liner{
	height: 2px;
	background: #ddd;
	position: absolute;
	width: 80%;
	margin: 0 auto;
	left: 0;
	right: 0;
	top: 50%;
	z-index: 1;
}

.nav-tabs > li.active > a, .nav-tabs > li.active > a:hover, .nav-tabs > li.active > a:focus {
	color: #555555;
	cursor: default;
	/* background-color: #ffffff; */
	border: 0;
	border-bottom-color: transparent;
}

span.round-tabs{
	width: 70px;
	height: 70px;
	line-height: 70px;
	display: inline-block;
	border-radius: 100px;
	background: white;
	z-index: 2;
	position: absolute;
	left: 0;
	text-align: center;
	font-size: 25px;
}

span.round-tabs.one{
	color: rgb(34, 194, 34);border: 2px solid rgb(34, 194, 34);
}

li.active span.round-tabs.one{
	background: #fff !important;
	border: 2px solid #ddd;
	color: rgb(34, 194, 34);
}

span.round-tabs.two{
	color: #febe29;border: 2px solid #febe29;
}

li.active span.round-tabs.two{
	background: #fff !important;
	border: 2px solid #ddd;
	color: #febe29;
}

span.round-tabs.three{
	color: #3e5e9a;border: 2px solid #3e5e9a;
}

li.active span.round-tabs.three{
	background: #fff !important;
	border: 2px solid #ddd;
	color: #3e5e9a;
}

span.round-tabs.four{
	color: #f1685e;border: 2px solid #f1685e;
}

li.active span.round-tabs.four{
	background: #fff !important;
	border: 2px solid #ddd;
	color: #f1685e;
}

span.round-tabs.five{
	color: #999;border: 2px solid #999;
}

li.active span.round-tabs.five{
	background: #fff !important;
	border: 2px solid #ddd;
	color: #999;
}

.nav-tabs > li.active > a span.round-tabs{
	background: #fafafa;
}
.nav-tabs > li {
	width: 20%;
}
/*li.active:before {
	content: " ";
	position: absolute;
	left: 45%;
	opacity:0;
	margin: 0 auto;
	bottom: -2px;
	border: 10px solid transparent;
	border-bottom-color: #fff;
	z-index: 1;
	transition:0.2s ease-in-out;
}*/
.nav-tabs > li:after {
	content: " ";
	position: absolute;
	left: 45%;
	opacity:0;
	margin: 0 auto;
	bottom: 0px;
	border: 5px solid transparent;
	border-bottom-color: #ddd;
    transition:0.1s ease-in-out;
}
.nav-tabs > li.active:after {
	content: " ";
	position: absolute;
	left: 45%;
	opacity:1;
	margin: 0 auto;
	bottom: 0px;
	border: 10px solid transparent;
	border-bottom-color: #ddd;
}
.nav-tabs > li a{
	width: 70px;
	height: 70px;
	margin: 20px auto;
	border-radius: 100%;
	padding: 0;
}

.nav-tabs > li a:hover{
	background: transparent;
}

.tab-content{
}
.tab-pane{
	position: relative;
	padding-top: 50px;
}
.tab-content .head{
	font-family: 'Roboto Condensed', sans-serif;
	font-size: 25px;
	text-transform: uppercase;
	padding-bottom: 10px;
}
.btn-outline-rounded{
	padding: 10px 40px;
	margin: 20px 0;
	border: 2px solid transparent;
	border-radius: 25px;
}

.btn.green{
	background-color:#5cb85c;
	/*border: 2px solid #5cb85c;*/
	color: #ffffff;
}



@media( max-width : 585px ){

	.board {
		width: 90%;
		height:auto !important;
	}
	span.round-tabs {
		font-size:16px;
		width: 50px;
		height: 50px;
		line-height: 50px;
	}
	.tab-content .head{
		font-size:20px;
	}
	.nav-tabs > li a {
		width: 50px;
		height: 50px;
		line-height:50px;
	}

	.nav-tabs > li.active:after {
		content: " ";
		position: absolute;
		left: 35%;
	}

	.btn-outline-rounded {
		padding:12px 20px;
	}
}
.not-active {
	pointer-events: none;
	cursor: default;
	text-decoration: none;
	color: black;
}
</style>
<script src="../../js/prod/balance/balance.js"></script>
<section style="background:#efefe9;">
	<div class="container">
		<div class="row">
			<div class="board">
				<div class="board-inner">
					<ul class="nav nav-tabs" id="myTab">
						<div class="liner"></div>
						<li class="active">
							<a href="#home" data-toggle="tab" title="Nuevo / Existente" id="paso1">
								<span class="round-tabs one">
									<i class="glyphicon glyphicon-home"></i>
								</span> 
							</a>
						</li>
						<li>
							<a href="#lista" data-toggle="tab" title="Listar / Adicionar" id="paso2" class="not-active">
								<span class="round-tabs two">
									<i class="glyphicon glyphicon-list-alt"></i>
								</span> 
							</a>
						</li>
						<li>
							<a href="#edicion" data-toggle="tab" title="Edicion" id="paso3" class="not-active">
								<span class="round-tabs three">
									<i class="glyphicon glyphicon-edit"></i>
								</span> 
							</a>
						</li>

						<li>
							<a href="#list_item" data-toggle="tab" title="blah blah" id="paso4" class="not-active">
								<span class="round-tabs four">
									<i class="glyphicon glyphicon-comment"></i>
								</span> 
							</a>
						</li>

						<li>
							<a href="#doner" data-toggle="tab" title="completed" id="paso5" class="not-active">
								<span class="round-tabs five">
									<i class="glyphicon glyphicon-ok"></i>
								</span> 
							</a>
						</li>

					</ul>
				</div>

				<div class="tab-content">
					<div class="tab-pane fade in active" id="home">
						<p class="text-center">
							<a href="#"  data-toggle="collapse" data-target="#add_poscosecha" class="btn btn-success btn-outline-rounded green"> Nueva Poscosecha<span style="margin-left:10px;" class="glyphicon glyphicon-search"></span></a>
							<a href="#" onclick="$('#lista').load('production/balance/list_poscosecha.php');$('#paso2').click();" class="btn btn-pruimary btn-outline-rounded green"> Poscosecha Existente<span style="margin-left:10px;" class="glyphicon glyphicon-plus"></span></a>
							<div id="add_poscosecha" class="container collapse out" style="width:75%">
								<form id="newpos_form" role="form"" autocomplete="off">
									<div class="panel panel-danger text-center" id="msg_posc" style="display:none;color:red;">
									</div>
									<div class="panel panel-success">
										<div class="panel-heading">
											<b> Nueva Poscosecha</b>
											<input type="hidden" name="action" id="action" value="Create_Posc" /> 
										</div>
										<div class="panel-body">
											<div class="row">
												<div class="col-md-3">
													<label for="pos_nombre">Nombre:</label>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input type="text" class="form-control" name="pos_nombre" id="pos_nombre" placeholder="Nombre" required="">
													</div>
												</div>
												<div class="col-md-3">
													<label for="pos_estado">Estado:</label>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<select name="pos_estado" id="pos_estado" class="form-control" style="width: 100%;">
															<option value="">...</option>
															<option value="0">Activo</option>
															<option value="1">Inactivo</option>
														</select>
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<label for="pos_finicial">Fecha Inicial:</label>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input type="date" class="form-control" name="pos_finicial" id="pos_finicial" placeholder="Fecha Inicial" >
													</div>
												</div>
												<div class="col-md-3">
													<label for="pos_ffinal">Fecha Final:</label>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input type="date" class="form-control" name="pos_ffinal" id="pos_ffinal" placeholder="Fecha Final" >
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-3">
													<label for="pos_shipmin">Miami Ship mínimo:</label>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input type="number" class="form-control" name="pos_shipmin" id="pos_shipmin" placeholder="Miami Ship mínimo" >
													</div>
												</div>
												<div class="col-md-3">
													<label for="pos_shipmax">Miami Ship máximo:</label>
												</div>
												<div class="col-md-3">
													<div class="form-group">
														<input type="number" class="form-control" name="pos_shipmax" id="pos_shipmax" placeholder="Miami Ship máximo" >
													</div>
												</div>
											</div>
											<div class="row">
												<div class="col-md-12 text-center">
													<a href="#" type="submit"  onclick="newpos_form_button()" class="btn btn-pruimary btn-outline-rounded green"> Crear<span style="margin-left:10px;" class="glyphicon glyphicon-plus"></span></a>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</p>
					</div>
					<div class="tab-pane fade" id="lista">
					</div>
					<div class="tab-pane fade" id="edicion">
						
					</div>
					<div class="tab-pane fade" id="list_item">
						<a href="#" onclick="$('#paso5').click();" class="btn btn-pruimary btn-outline-rounded green"> Siguiente<span style="margin-left:10px;" class="glyphicon glyphicon-plus"></span></a>
					</div>
					<div class="tab-pane fade" id="doner">
						<a href="#" onclick="$('#paso1').click();" class="btn btn-pruimary btn-outline-rounded green"> Primer Paso<span style="margin-left:10px;" class="glyphicon glyphicon-plus"></span></a>
					</div>
					<div class="clearfix"></div>
					</div>

				</div>
			</div>
		</div>
	</div>
</section>
