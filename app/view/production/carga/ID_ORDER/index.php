	<style>
.div_load {
    background: -webkit-radial-gradient(#FFF,#f77604); /* Safari 5.1 to 6.0 */
	background: -o-radial-gradient(#FFF,#f77604); /* For Opera 11.6 to 12.0 */
	background: -moz-radial-gradient(#FFF,#f77604); /* For Firefox 3.6 to 15 */
	background: radial-gradient(#FFF,#f77604); /* Standard syntax */
	padding-top:20px;
	padding-bottom:20px;
	border: 0px solid red;
    border-radius: 25px;
	margin:5px;
}
</style>
<?php

$date = date('Y-m-d');
//
$date1 = strtotime ( '+1 day' , strtotime ($date));
$one_date = date ( 'Y-m-d' , $date1);
//
$date2 = strtotime ( '+2 day' , strtotime ($date));
$two_date = date ( 'Y-m-d' , $date2);
//
$date3 = strtotime ( '+3 day' , strtotime ($date));
$tree_date = date ( 'Y-m-d' , $date3);

?>
<script src="../../libs/plugins/fullcalendar/fullcalendar.min.js"></script>
<link rel="stylesheet" href="../../libs/plugins/fullcalendar/fullcalendar.min.css">
<link rel="stylesheet" href="../../libs/plugins/fullcalendar/fullcalendar.print.css" media="print">
<section class="content">
    <div class="row">
        <div class="col col-md-2 text-center div_load">
			<label>ID ORDER <span class="glyphicon glyphicon-upload"></span></label>
			<br />
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#load_id_order">
                Archivo.
                <span class="glyphicon glyphicon-file"></span>
            </button>
			<button type="button" class="btn btn-success btn-sm" id="view_id_order">
				Mostrar:
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
		</div>
		<div class="col col-md-2 text-center div_load">
			<label>INVENTARIO FLOR <span class="glyphicon glyphicon-upload"></span></label>
			<br />
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#load_inventario_flor">
                Archivo.
                <span class="glyphicon glyphicon-file"></span>
            </button>
			<button type="button" class="btn btn-success btn-sm" id="view_inventario_flor">
				Mostrar:
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
		</div>
		<div class="col col-md-2 text-center div_load">
			<label>INVENTARIO HARD GODS <span class="glyphicon glyphicon-upload"></span></label>
			<br />
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#load_inventario_hg">
                Archivo.
                <span class="glyphicon glyphicon-file"></span>
            </button>
			<button type="button" class="btn btn-success btn-sm" id="view_inventario_hg">
				Mostrar:
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
		</div>
		<div class="col col-md-2 text-center div_load">
			<label>ORDEN DE COMPRA FLOR <span class="glyphicon glyphicon-upload"></span></label>
			<br />
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#load_orden_compra_flor">
                Archivo.
                <span class="glyphicon glyphicon-file"></span>
            </button>
			<button type="button" class="btn btn-success btn-sm" id="view_orden_compra_flor">
				Mostrar:
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
		</div>
		<div class="col col-md-3 text-center div_load">
			<label>ORDEN DE COMPRA HARD GODS <span class="glyphicon glyphicon-upload"></span></label>
			<br />
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#load_orden_compra_hg">
                Archivo.
                <span class="glyphicon glyphicon-file"></span>
            </button>
			<button type="button" class="btn btn-success btn-sm" id="view_orden_compra_hg">
				Mostrar:
				<span class="glyphicon glyphicon-zoom-in"></span>
			</button>
		</div>
		
	</div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <div class="container">
                        <h3 class='box-title'>
                            <b>LIST UPLOAD</b>
                        </h3>
                    </div>
                </div>
                <div class='box-body'>
                    <section class='content'>
                        <div class="row">
                            <div class="col col-lg-12">
                                <div class="table-responsive" id="data_po_list" style="font-size: 12px;"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- MODAL LOAD ID ORDER-->
<div id="load_id_order" class="modal fade" role="dialog">
    <form id="load_file_id_order">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE ID ORDER</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file.</label>
                                <input type="file" class="form-control" name="file_id_order" id="file_id_order">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- MODAL LOAD INVENTARIO FLOR-->
<div id="load_inventario_flor" class="modal fade" role="dialog">
    <form id="load_file_inventario_flor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE INVENTARIO FLOR</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file.</label>
                                <input type="file" class="form-control" name="file_inventario_flor" id="file_inventario_flor">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>
<!-- MODAL LOAD INVENTARIO HG-->
<div id="load_inventario_hg" class="modal fade" role="dialog">
    <form id="load_file_inventario_hg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE INVENTARIO HARD GODS</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file.</label>
                                <input type="file" class="form-control" name="file_inventario_hg" id="file_inventario_hg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- MODAL LOAD ORDEN DE COMPRA FLOR-->
<div id="load_orden_compra_flor" class="modal fade" role="dialog">
    <form id="load_file_orden_compra_flor">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE ORDEN DE COMPRA FLOR</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file.</label>
                                <input type="file" class="form-control" name="file_orden_compra_flor" id="file_orden_compra_flor">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<!-- MODAL LOAD ORDEN DE COMPRA HG-->
<div id="load_orden_compra_hg" class="modal fade" role="dialog">
    <form id="load_file_orden_compra_hg">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE ORDEN DE COMPRA HARD GODS</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file.</label>
                                <input type="file" class="form-control" name="file_orden_compra_hg" id="file_orden_compra_hg">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script src="../../js/prod/carga/carga.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $("select").select2();
        $('.date').datepicker({
            pickTime: true,
            autoclose: true,
            language: 'es',
            opens: "center",
            startDate: '<?php echo date("Y-m-d"); ?>',
        });
    });
</script>