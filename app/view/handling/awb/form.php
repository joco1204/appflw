<?php
$get = ((object) $_GET);
isset($get->id_receiving) ? $idReceiving = $get->id_receiving : $idReceiving = '0';
?>
<section class="content-header">
    <h1>A.W.B.</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
			<?php if ($idReceiving == '0'){	
				echo "<b>ADD NEW AWB</b>";
            }else{	
                echo "<b>AWB: ".$idReceiving."</b>";
			} ?>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <form id="receiving_form" role="form"" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-10  col-lg-offset-1">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <b>AWB Information</b>
									<input type="hidden" name="action" id="action" /> 
									<input type="hidden" name="idReceiving" id="idReceiving" value="<?php echo $idReceiving; ?>"/>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="awb_number">AWB Master:</label>
										</div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="awb_number" id="awb_number" placeholder="AWB Master" required="">
                                            </div>
										</div>
                                        <div class="col-md-3">
                                            <label for="awb_hija">AWB Hija:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="awb_hija" id="awb_hija" placeholder="AWB Hija" required="">
                                            </div>
                                        </div>
                                    </div>
									<div class="row"> 
                                        <div class="col-md-3">
                                            <label for="origin_country">Origin Country</label>
										</div>
										<div class="col-md-3">
											<select name="origin_country" id="origin_country" class="form-control" style="width: 100%;"></select>
										</div>
                                        <div class="col-md-3">
                                            <label for="awb_number">AWB Nieta:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="awb_nieta" id="awb_nieta" placeholder="AWB Nieta" required="">
                                            </div>
                                        </div>	
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="origin_city">Origin City:</label>
										</div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <select name="origin_city" id="origin_city" class="form-control" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="carrie_grower">Carrier / Grower:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <select name="carrie_grower" id="carrie_grower" class="form-control" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-md-3">
                                            <label for="customer">Customer:</label>
										</div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <select name="customer" id="customer" class="form-control" style="width: 100%;"></select>    
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="pieces_master">Pieces Master:</label>
										</div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <input type="text" class="form-control" name="pieces_master" id="pieces_master" placeholder="Pieces Master" readonly>    
                                            </div>
                                         </div>
                                    </div>
									<div class="row">
                                        <div class="col-md-3">
                                            <label for="ship_date_origin">Ship Date Origin:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" name="ship_date_origin" id="ship_date_origin" class="form-control" placeholder="YYYY-MM-DD">
                                                    <div class="input-group-addon popup_date">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <label for="status">Status:</label>
										</div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <select name="status" id="status" class="form-control" style="width: 100%;">
                                                    <?php 
                                                        if ($idReceiving==0){   
                                                            echo '<option value="">Choose Option</option>';
                                                            echo '<option value="3">Origin</option>';
                                                        }
                                                    ?>
                                                </select>
                                                <input type="hidden" name="status_h" id="status_h">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="time">Time of Ship Origin:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="time_ship_origin" id="time_ship_origin">    
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="weight">Weight:</label>
                                        </div>  
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control" name="weight" id="weight" placeholder="Weight" required="" min="0">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <select name="tip_weight" id="tip_weight" class="form-control" style="width: 100%;"></select>
                                            </div>
                                        </div>  
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <label for="date_arrival">Arrival Date:</label>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group has-feedback">
                                                <div class="input-group date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" name="date_arrival" id="date_arrival" class="form-control" placeholder="YYYY-MM-DD">
                                                    <div class="input-group-addon popup_date">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3"> 
                                            <label for="temp">Temp</label>
                                        </div>  
                                        <div class="col-md-3"> 
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="temp" id="temp" placeholder="Temp">
                                                    <span class="input-group-addon">°F</span>
                                                </div>  
                                            </div>  
                                        </div>
                                    </div>
									<div class="row">
                                        <div class="col-md-3">
                                            <label for="time_arrival">Time of Arrival:</label>
										</div>
										<div class="col-md-3">
                                            <div class="form-group">
                                                <input type="time" class="form-control" name="time_arrival" id="time_arrival">    
                                            </div>
										</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="notes">Comments:</label>
                                                <textarea class="form-control" name="notes" id="notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <div class="row">
										<div class="col-lg-12 text-center">
                                            <?php if ($idReceiving == '0'){ ?>
                                                <button type="button" class="btn btn-primary btn-sm" onclick="javascript: addlines();">
                                                    <span class="glyphicon glyphicon-plus"></span> Add line
                                                </button>
                                                <input type="hidden" name="lines" id="lines" value="0">
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-2"><b># P.O.</b></div>
                                                    <div class="col-md-2"><b>Item Code</b></div>
                                                    <div class="col-md-2"><b>Box Size</b></div>
                                                    <div class="col-md-2"><b>Pieces</b></div>
                                                    <div class="col-md-4"><b>Labels</b></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div id="canvas_line"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
							<?php if ($idReceiving == '0'){	
								echo '<button type="submit" class="btn btn-success" id="save">Save</button>';
							}else{	
								echo '<button type="button" class="btn btn-primary" id="receiving_edit">Edit</button>';
							} ?>
                            <button type="button" class="btn btn-default" onclick="javascript: pageContent('handling/awb/index');">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>

<div class="modal modal fade" id="modal-info">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
                <h4 class="modal-title">Add Line 
                    <input type="hidden" id="lineModal"/>
                </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <label for="po">P.O.:</label>
                                </span>
                                <select name="po" id="po" class="form-control" style="width: 100%;"></select>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <div class="input-group">
                                <span class="input-group-addon">
                                    <label for="pieces_po">Pieces P.O.:</label>
                                </span>
                                <input type="number" class="form-control" name="pieces_po" id="pieces_po" placeholder="Pieces P.O.">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="close"  aria-label="Close" onclick="poTOcomments()";>
                <span class="glyphicon glyphicon-edit"></span> Add PO to Comments
                <button type="button" class="btn btn-outline">Save changes</button>
            </div>
        </div>
    </div>
</div>

<?php  if($idReceiving == '0'){	
	echo '<script src="../../js/awb/awbCreate.js"></script>';
	echo '<script src="../../js/awb/awbCreateLines.js"></script>';
}else{	
	echo '<script src="../../js/awb/awbEdit.js"></script>';
} ?>
<script type="text/javascript">
    $(document).ready(function(){
        $('#popup_date').hide();
        $("select").select2();
        $('.date').datepicker({
            pickTime: true,
            autoclose: true,
            opens: "center",
            startDate: '<?php echo date("Y-m-d"); ?>',
        });
    });
</script>
<div id="loader"></div>
<style type="text/css">
.loader {
    position: fixed;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    z-index: 9999;
    background: url('img/spin.gif') 50% 50% no-repeat rgb(249,249,249);
    opacity: .8;
}
@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>