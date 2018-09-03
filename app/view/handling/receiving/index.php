<style>
#serviceOneToOne {
	width: 50px;
	height: 50px;
	padding: 10px;
	background-color: #0073b7;
	color: #fff;
	border-radius: 50%;
	margin: 5px;
	font-size:20px;
	border: solid 1px #0073b7;
}
#serviceRFID {
	width: 50px;
	height: 50px;
	padding: 10px;
	background-color: #00a65a;
	color: #fff;
	border-radius: 50%;
	margin: 5px;
	font-size:20px;
	border: solid 1px #00a65a;
}
</style>
<section class="content-header">
	<div class="row">
        <div class="col-md-6 text-left">
			<h1>RECEIVING</h1>
		</div>
		<div class="col-md-6 text-right">
			<button class="btn btn-success btn-lg" data-toggle="modal" data-target="#modalRead">Read</button>
			<div id="modalRead" class="modal fade" role="dialog">
			  <div class="modal-dialog modal-lg">

				<!-- Modal content-->
				<div class="modal-content">
				  <div class="modal-header text-center bg-green">
					<button type="button" class="close" data-dismiss="modal">&times;</button>
					<h4 class="modal-title">
							Read Label AWB. 
					</h4>
				  </div>
				  <div class="modal-body"  style="padding:40px;">
					<div class="row">
						<div class="col-md-6 text-left bg-blue text-center" style="border:1px;border-radius: 10px 10px 0px 0px;">
							READ HANDHELD
						</div>
						<div class="col-md-6 text-left bg-green text-center" style="border:1px;border-radius: 10px 10px 0px 0px;">
							READ RFID
						</div>
					</div>
					<div class="row">
						<div class="col-md-6 text-center" style="border-radius: 0px 0px 10px 10px; border-style: dashed; border-width: 1px; border-top:0px; padding-top:20px;">
							<input type="text" id="inputOneToOne" onkeydown="if (event.keyCode == 13){ OneToOne();}"/>
							<br />
							<label id="serviceOneToOne" class="text-center">0</label>
							<hr>
							<button type="button" class="btn btn-primary" onclick="confirmOTO();">Confirm</button>
						</div>
						<div class="col-md-6 text-center" style="border-radius: 0px 0px 10px 10px; border-style: dashed; border-width: 1px; border-top:0px; padding-top:20px;">
							<textarea cols="50" rows="5" id="txtar" onkeyup="RFID();"></textarea>
							<br />
							<label id="serviceRFID" class="text-center">0</label>
							<hr>
							<button type="button" class="btn btn-primary" onclick="confirmRFID();">Confirm</button>
						</div>
					</div>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
						
					</div>
				</div>

			  </div>
			</div>
		</div>
</section>
<section class="content">
	<!--<div class="row">
		<div class="col col-md-4 text-center">
			<label>Receiving Month</label>
			<canvas id="areaChart" style="height:250px"></canvas>
		</div>
		<div class="col col-md-4 text-center">
			<label>Customer Receiving</label>
			<canvas id="lineChart" style="height:250px"></canvas>
		</div>
	</div>-->
    <div class="row">
        <div class="col-md-12">
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>
                        <b>RECEIVING LIST</b>
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

			
			
			
<div id="change_status" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center bg-green">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">
					Change Status AWB: 
					<span id="awb_status_changeL"></span>
				</h4>
                <input type="hidden" id="awb_number"/>
				<input type="hidden" id="awb_status_change"/>
				<input type="hidden" id="awb_substatus_change"/>
            </div>
            <div class="modal-body">
            	<div class="row">
            		<div class="col-md-3">
            			<label for="statusNew">Status:</label>	
            		</div>
            		<div class="col-md-8">
            			<div class="form-group">
            				<select name="status" id="statusNew" class="form-control" style="width: 100%;"></select>
            			</div>
            		</div>
            	</div>
            	<hr>
                <div style="display:none;" id="divLocation">
                </div>
            	<div style="display:none;" id="divCool"></div>
				</div>
            <div class="modal-footer">
				<div id="btn_change_status_receiving">
            	<button type="button" class="btn btn-primary btn-sm" onclick="javascript: update_status();" data-dismiss="modal">
					<span class="glyphicon glyphicon-plus"></span> Change Status
				</button>
                <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>



<script src="../../js/receiving/receiving.js"></script>
<!--<script src="../../js/receiving/receiving_dashboard.js"></script>-->
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

