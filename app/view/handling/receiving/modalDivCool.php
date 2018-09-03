<style>
.Validate_Button{
    position: relative;
    background-color: #4CAF50;
	background-image:url('../../img/botonvalidate.png');
	background-repeat:no-repeat;
    border: none;
    font-size: 28px;
    color: #FFFFFF;
    padding: 20px;
    width: 150px;
    text-align: center;
    -webkit-transition-duration: 0.4s; /* Safari */
    transition-duration: 0.4s;
    text-decoration: none;
    overflow: hidden;
    cursor: pointer;
}

.Validate_Button:after {
    content: "";
    background: #90EE90;
    display: block;
    position: absolute;
    padding-top: 300%;
    padding-left: 350%;
    margin-left: -20px!important;
    margin-top: -120%;
    opacity: 0;
    transition: all 0.8s
}

.Validate_Button:active:after {
    padding: 0;
    margin: 0;
    opacity: 1;
    transition: 0s
}

</style>
<input id="awb" value="<?php echo $_GET['awb'];?>" type="hidden"/>
<div class="row">
		<div class="col-md-12 text-right">
			<select onclick="changeMethod();" id="changeMethod">
				<option value="">Choose Option</option>
				<option value="AUTOMATICO">HANDHEHLD</option>
				<option value="RFID">RFID</option>
			</select>
		</div>
</div>
<div style="display:none;" id="auto_div">
	<div id="div_for_auto">
		
		<div class="row">
			<div class="col-md-3">
				<label for="statusNew">Label: </label>
			</div>
			<div class="col-md-4">
				<div class="form-group">
					<input type="text" class="form-control statusAddes" id="item_status"/>
				</div>
			</div>
			<div class="col-md-5">
				<span id="addStatus" class="statusAddes"></span>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div id="line_to_awb"></div>
		</div>
	</div>
</div>
<div style="display:none;" id="rfid_div">
	<div class="row" style="padding-top:20px;">
		<div class="col-lg-9">
			<textarea id="text_rfid" rows="3" cols="100%"></textarea>
		</div>
		<div class="col-lg-1">
			<button class="btn btn-primary" id="btn_rfid">SAVE</button>
		</div>
		<div class="col-lg-2">
		</div>
	</div>
	<div class="row" style="padding-top:20px; display:none;" id="item_code_rfid">
		<div class="col-lg-9" id="result_item_code_rfid_preg">
		</div>
	</div>
	<div class="row" style="padding-top:20px; display:none;" id="result_rfid">
		<div class="col-lg-9 text-center">
			<textarea id="rfid_result" rows="1" cols="1%" style="background-color_#CCC;-moz-border-radius: 10px;
        -webkit-border-radius: 25%;
        border-radius: 50px;
        border: 1px solid green;
        padding: 0 4px 0 4px;" readonly></textarea>
		</div>
		<div class="col-lg-3">
		</div>
	</div>
</div>
<script src="../../js/receiving/receivingEditLabel.js"></script>
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