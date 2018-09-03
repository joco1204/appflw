<style>
.statusAddes{
	font-size:18px;
}
</style>

<section class="content-header">
    <h1>A.W.B.</h1>
</section>
<section class="content">
	<div class="row">
		<div class="col col-md-4 text-left">
			<button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#awb_file">
				Load File <span class="glyphicon glyphicon-file"></span>
			</button>
		</div>
	</div>
    <br>
	
    <div class="row">
        <div class="col-md-12">
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>
                        <b>A.W.B. LIST</b>
                    </h3>
                </div>
                <div class='box-body'>
                    <section class='content'>
                        <div class="row">
                            <div class="col col-lg-12">
                                <div class="table-responsive" id="data_awb_list" style="font-size: 11px;"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- change status -->
<div id="change_status" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header text-center bg-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
					Change Status AWB: 
					<span id="awb_n"></span>
				</h4>
				<input type="hidden" id="awb_status_change"/>
            </div>
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-3">
            			<label for="statusNew">Status:</label>	
            		</div>
            		<div class="col-md-8">
            			<div class="form-group">
            				<select name="status_new" id="status_new" class="form-control" style="width: 100%;"></select>
            			</div>
            		</div>
            	</div>
            </div>
            <div class="modal-footer">
            	<button type="button" class="btn btn-primary btn-sm" onclick="javascript: update_status();" data-dismiss="modal">
					<span class="glyphicon glyphicon-plus"></span> Change Status
				</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Load file -->
<div id="awb_file" class="modal fade" role="dialog">
    <form id="load_file_awb">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE AWB</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_awb">Load file master of AWB</label>
                                <input type="file" class="form-control" name="file_awb" id="file_awb">
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
<script src="../../js/awb/awb.js"></script>
<!--<script src="../../js/awb/awb_dashboard.js"></script>-->
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