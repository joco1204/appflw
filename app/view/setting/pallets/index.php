<?php 
$get = ((Object) $_GET);
 //Validate id account
if(isset($get->id)){
    $id = $get->id;
    $action = 'updatePallet';
} else {
    $id = '';
    $action = 'insertPallet';
}
?>
<section class="content-header">
    <h1>PALLET</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
                <b>PALLET</b>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <div class="row">
                    <div class="col col-lg-12 text-center">
                        <button type="button" class="btn btn-success" data-toggle="modal" data-target="#newPallet"">
                            Add New
                            <span class="glyphicon glyphicon-plus"></span>
                        </button>
                        <button type="button" class="btn btn-primary" onclick="javascript: pageContent('setting/setting');">
                            Back
                            <span class="glyphicon glyphicon-share-alt"></span>
                        </button>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col col-lg-12">
                        <div class="table-responsive" id="data_pallet"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>


<div id="newPallet" class="modal fade" role="dialog">
    <form id="new_pallet">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
					<input type="hidden" name="action" id="action" value="<?= $action ?>">
                    <h4 class="modal-title text-center"><b>New Pallet Tag</b></h4>
                </div>
                <div class="modal-body">
				<div class = "row">
				<div class = "col-md-12" id= "msg" style= "color: #FF0000;" name= "msg">
				</div>
				</div>
                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="toll_free">Number:</label>
								<input type="text" class="form-control" name="name" id="name" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cut_off">Status:</label>
								<select class="form-control" name="status" id="status">
									<option value = ""> </option>
									<option value = "30">Enabled</option>
									<option value = "31">Disabled</option>
								</select>		
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
                            <div class="form-group">
                                <label for="groups">Type:</label>
								<div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="position_number" id="position_number" value="1">Position Number
                                    </label>
                                </div>
                                <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="tag_number" id="tag_number" value="1">Tag Number
                                </label>
                                </div>
                            </div>
                        </div>
                    </div>
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="toll_free">Description:</label>
								<textarea class="form-control" name="description" id="description"  placeholder=""></textarea>
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="saveAccount();" data-dismiss="modal">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
                </div>
            </div>
        </div>
    </form>  
</div>
<script src="../../js/pallet.js"></script>
<script type="text/javascript">
    $(document).ready(function(){
        $('.date').datepicker({
            pickTime: true,
            autoclose: true,
            opens: "center",
            startDate: '<?php echo date("Y-m-d"); ?>',
        });
    });
</script>