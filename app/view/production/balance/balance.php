
<style>
.mail-box {
    border-collapse: collapse;
    border-spacing: 0;
    display: table;
    table-layout: fixed;
    width: 100%;
	height: 400px;
	max-height: 400px;
	min-height: 400px;
}
.mail-box aside {
    display: table-cell;
    float: none;
    height: 100%;
    padding: 0;
    vertical-align: top;
}
.mail-box .sm-side {
    background: none repeat scroll 0 0 #e5e8ef;
    border-radius: 4px 0 0 4px;
    width: 25%;
}
.mail-box .lg-side {
    background: none repeat scroll 0 0 #fff;
    border-radius: 0 4px 4px 0;
    width: 75%;
}
.mail-box .sm-side .user-head {
    background: none repeat scroll 0 0 #00a8b3;
    border-radius: 4px 0 0;
    color: #fff;
    min-height: 80px;
    padding: 10px;
}
.inbox-body {
    padding: 20px;
}
.btn-compose {
    background: none repeat scroll 0 0 #ff6c60;
    color: #fff;
    padding: 12px 0;
    text-align: center;
    width: 100%;
}
.btn-compose:hover {
    background: none repeat scroll 0 0 #f5675c;
    color: #fff;
}
ul.inbox-nav {
    display: inline-block;
    margin: 0;
    padding: 0;
    width: 100%;
}
.inbox-divider {
    border-bottom: 1px solid #d5d8df;
}
ul.inbox-nav li {
    display: inline-block;
    line-height: 45px;
    width: 100%;
}
ul.inbox-nav li a {
    color: #6a6a6a;
    display: inline-block;
    line-height: 45px;
    padding: 0 20px;
    width: 100%;
}
ul.inbox-nav li a:hover, ul.inbox-nav li.active a, ul.inbox-nav li a:focus {
    background: none repeat scroll 0 0 #d5d7de;
    color: #6a6a6a;
}
ul.inbox-nav li a i {
    color: #6a6a6a;
    font-size: 16px;
    padding-right: 10px;
}
ul.inbox-nav li a span.label {
    margin-top: 13px;
}
ul.labels-info li h4 {
    color: #5c5c5e;
    font-size: 13px;
    padding-left: 15px;
    padding-right: 15px;
    padding-top: 5px;	
    text-transform: uppercase;
}
ul.labels-info li {
    margin: 0;
}
ul.labels-info li a {
    border-radius: 0;
    color: #6a6a6a;
}
ul.labels-info li a:hover, ul.labels-info li a:focus {
    background: none repeat scroll 0 0 #d5d7de;
    color: #6a6a6a;
}
ul.labels-info li a i {
    padding-right: 10px;
}
.nav.nav-pills.nav-stacked.labels-info p {
    color: #9d9f9e;
    font-size: 11px;
    margin-bottom: 0;
    padding: 0 22px;
}
.inbox-head {
    background: none repeat scroll 0 0 #41cac0;
    border-radius: 0 4px 0 0;
    color: #fff;
    min-height: 80px;
    padding: 20px;
}
.inbox-head h3 {
    display: inline-block;
    font-weight: 300;
    margin: 0;
    padding-top: 6px;
}
.inbox-head .sr-input {
    border: medium none;
    border-radius: 4px 0 0 4px;
    box-shadow: none;
    color: #8a8a8a;
    float: left;
    height: 40px;
    padding: 0 10px;
}
.inbox-head .sr-btn {
    background: none repeat scroll 0 0 #00a6b2;
    border: medium none;
    border-radius: 0 4px 4px 0;
    color: #fff;
    height: 40px;
    padding: 0 20px;
}
.table-inbox {
    border: 1px solid #d3d3d3;
    margin-bottom: 0;
}
.table-inbox tr td {
    padding: 12px !important;
}
.table-inbox tr td:hover {
    cursor: pointer;
}
.table-inbox tr td .fa-star.inbox-started, .table-inbox tr td .fa-star:hover {
    color: #f78a09;
}
.table-inbox tr td .fa-star {
    color: #d5d5d5;
}
.table-inbox tr.unread td {
    background: none repeat scroll 0 0 #f7f7f7;
    font-weight: 600;
}
ul.inbox-pagination {
    float: right;
}
ul.inbox-pagination li {
    float: left;
}
.mail-option {
    display: inline-block;
    margin-bottom: 10px;
    width: 100%;
}
.mail-option .chk-all, .mail-option .btn-group {
    margin-right: 5px;
}
.mail-option .chk-all, .mail-option .btn-group a.btn {
    background: none repeat scroll 0 0 #fcfcfc;
    border: 1px solid #e7e7e7;
    border-radius: 3px !important;
    color: #afafaf;
    display: inline-block;
    padding: 5px 10px;
}
.inbox-pagination a.np-btn {
    background: none repeat scroll 0 0 #fcfcfc;
    border: 1px solid #e7e7e7;
    border-radius: 3px !important;
    color: #afafaf;
    display: inline-block;
    padding: 5px 15px;
}
.mail-option .chk-all input[type="checkbox"] {
    margin-top: 0;
}
.mail-option .btn-group a.all {
    border: medium none;
    padding: 0;
}
.inbox-pagination a.np-btn {
    margin-left: 5px;
}
.inbox-pagination li span {
    display: inline-block;
    margin-right: 5px;
    margin-top: 7px;
}
.fileinput-button {
    background: none repeat scroll 0 0 #eeeeee;
    border: 1px solid #e6e6e6;
}
.inbox-body .modal .modal-body input, .inbox-body .modal .modal-body textarea {
    border: 1px solid #e6e6e6;
    box-shadow: none;
}
.btn-send, .btn-send:hover {
    background: none repeat scroll 0 0 #00a8b3;
    color: #fff;
}
.btn-send:hover {
    background: none repeat scroll 0 0 #009da7;
}
.modal-header h4.modal-title {
    font-family: "Open Sans",sans-serif;
    font-weight: 300;
}
.modal-body label {
    font-family: "Open Sans",sans-serif;
    font-weight: 400;
}
.heading-inbox h4 {
    border-bottom: 1px solid #ddd;
    color: #444;
    font-size: 18px;
    margin-top: 20px;
    padding-bottom: 10px;
}
.sender-info {
    margin-bottom: 20px;
}
.sender-info img {
    height: 30px;
    width: 30px;
}
.sender-dropdown {
    background: none repeat scroll 0 0 #eaeaea;
    color: #777;
    font-size: 10px;
    padding: 0 3px;
}
.view-mail a {
    color: #ff6c60;
}
.attachment-mail {
    margin-top: 30px;
}
.attachment-mail ul {
    display: inline-block;
    margin-bottom: 30px;
    width: 100%;
}
.attachment-mail ul li {
    float: left;
    margin-bottom: 10px;
    margin-right: 10px;
    width: 150px;
}
.attachment-mail ul li img {
    width: 100%;
}
.attachment-mail ul li span {
    float: right;
}
.attachment-mail .file-name {
    float: left;
}
.attachment-mail .links {
    display: inline-block;
    width: 100%;
}

.fileinput-button {
    float: left;
    margin-right: 4px;
    overflow: hidden;
    position: relative;
}
.fileinput-button input {
    cursor: pointer;
    direction: ltr;
    font-size: 23px;
    margin: 0;
    opacity: 0;
    position: absolute;
    right: 0;
    top: 0;
    transform: translate(-300px, 0px) scale(4);
}
.fileupload-buttonbar .btn, .fileupload-buttonbar .toggle {
    margin-bottom: 5px;
}
.files .progress {
    width: 200px;
}
.fileupload-processing .fileupload-loading {
    display: block;
}
* html .fileinput-button {
    line-height: 24px;
    margin: 1px -3px 0 0;
}
* + html .fileinput-button {
    margin: 1px 0 0;
    padding: 2px 15px;
}
@media (max-width: 767px) {
.files .btn span {
    display: none;
}
.files .preview * {
    width: 40px;
}
.files .name * {
    display: inline-block;
    width: 80px;
    word-wrap: break-word;
}
.files .progress {
    width: 20px;
}
.files .delete {
    width: 60px;
}
}
ul {
    list-style-type: none;
    padding: 0px;
    margin: 0px;
}
 .campo_val_day{
	 width:50px;
	 max-width:50px;
	 min-width:50px;
 }
</style>
<script src="../../js/prod/balance/balance_box.js"></script>


<link rel='stylesheet prefetch' href='http://maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css'>
 <div class="mail-box">
  <aside class="sm-side">
	  
	  <div class="inbox-body">
		
		  <a href="#myModal" data-toggle="modal"  title="Compose"    class="btn btn-compose">
			  Add Id Order
		  </a>
		  <!-- Modal -->
		  <div aria-hidden="true" aria-labelledby="myModalLabel"  role="dialog" tabindex="-1" id="myModal" class="modal fade" style="display: none;">
			  <div class="modal-dialog modal-lg">
				  <div class="modal-content">
					  <div class="modal-header">
						  <button aria-hidden="true" data-dismiss="modal" class="close" type="button">×</button>
						  <h4 class="modal-title">Add Id Order</h4>
					  </div>
					  <div class="modal-body" id="NewOrderPost">
					  </div>
					  <div class="modal-footer">
						  <button data-dismiss="modal" type="button" onclick="contar_check();">ADD No. Order</button>
						  <input type="text" id="nlineas_modal" />
					  </div>
				  </div><!-- /.modal-content -->
			  </div><!-- /.modal-dialog -->
		  </div><!-- /.modal -->
	  </div>
	  <ul class="inbox-nav inbox-divider">
		  <li class="active">
			  <a href="#"><i class="fa fa-inbox"></i> SELECCIÓN ORDEN
				<input type="hidden" value="<?php echo $_GET['idpost'];?>" id="id_poscosecha"/>
				<input type="hidden" value="<?php echo $_GET['diastot'];?>" id="dias_total_poscosecha"/>
				<input type="hidden" value="<?php echo $_GET['fecini'];?>" id="fecha_inicial_poscosecha"/>
				<input type="hidden" value="<?php echo $_GET['fmin'];?>" id="min_ship"/>
				<input type="hidden" value="<?php echo $_GET['fmax'];?>" id="max_ship"/>
				<br><a href="#" style="color:#3c8dbc;"><i class="glyphicon glyphicon-minus"></i>Orden No.: 
					<select id="ordenes_asoc" onchange="choose_order(1);"></select>
				<br><a href="#" onclick="choose_order(0);" style="color:#3c8dbc;"><i class="glyphicon glyphicon-asterisk"></i>Todas
			  </a>
		  </li>
		  <li>
			  <a href="#" onclick="$('#paso1').click();"><i class="glyphicon glyphicon-home"></i> CREACIÓN Y SELECCIÓN CENTRO DE PRODUCCIÓN</a>
		  </li>
		  
	  </ul>
	  <ul class="nav nav-pills nav-stacked labels-info ">
		  <li> <h4>Conseciones</h4> </li>
		  <li> <a href="#"> <i class=" fa fa-circle text-success"></i>Completa <p></p></a>  </li>
		  <li> <a href="#"> <i class=" fa fa-circle text-danger"></i>Urgente<p></p></a> </li>
		  <li> <a href="#"> <i class=" fa fa-circle text-warning "></i>Alerta <p></p></a>
		  </li><li> <a href="#"> <i class=" fa fa-circle text-info "></i>Proceso<p></p></a>
		  
		  </li>
	  </ul>

	 
  </aside>
  <aside class="lg-side" >
	  <div class="inbox-body" style="width: 100%; height: 100%; min-height: 100%; max-height: 100%; overflow-y: scroll;overflow-x: scroll;">
			<div id="table_balance">
			</div>
			
	  </div>
  </aside>
</div>
<div width="100%" align="right">
	<a href="#" onclick="$('#list_item').load('production/balance/list_itemCode.php');$('#paso4').click();" class="btn btn-pruimary btn-outline-rounded green"> 
		Siguiente
		<span style="margin-left:10px;" class="glyphicon glyphicon-plus"></span>
	</a>
</div>