<?php
$get = ((object) $_GET);
isset($get->id) ? $idPo = $get->id : $idPo = '0';
?>
<section class="content-header">
    <h1>PURCHASING ORDER</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
                <?php if ($idPo == '0'){ 
                    echo "<b>ADD P.O.</b>";
                }else{  
                    echo "<b>VIEW P.O.</b>";
                } ?>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <form id="po_form" role="form" autocomplete="off">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="panel-group">
                                <div class="panel panel-success">
                                    <div class="panel-heading">
                                        <b>P.O. Information</b>
                                         <input type="hidden" name="action" id="action" /> 
                                        <input type="hidden" name="idPo" id="idPo" value="<?php echo $idPo; ?>"/>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="po_number">P.O. Number:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="po_number" id="po_number" class="form-control" onkeypress="javascript: number_format('po_number');">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="department_miami_date">Department Miami Date:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <div class="input-group date department-miami-date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" name="department_miami_date" id="department_miami_date" class="form-control">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="dc_delivery_date">DC Delivery Date:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <div class="input-group date dc-delivery-date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" name="dc_delivery_date" id="dc_delivery_date" class="form-control">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="dc_came">DC Name:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <select class="form-control" name="dc_came" id="dc_came"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="client">Client:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <select class="form-control" name="client" id="client"></select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="supplier">Supplier:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <select class="form-control" name="supplier" id="supplier"></select>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="pallet_total">Pallet total:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="pallet_total" id="pallet_total" class="form-control" onkeypress="javascript: number_format('pallet_total');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="case_total">Case total:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="case_total" id="case_total" class="form-control" onkeypress="javascript: number_format('case_total');">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="cube_total">Cube total:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="cube_total" id="cube_total" class="form-control" onkeypress="javascript: number_format('cube_total');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="mini_boxes"># Mini Boxes:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="mini_boxes" id="mini_boxes" class="form-control" onkeypress="javascript: number_format('mini_boxes');">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <label for="start_boxes"># Start/Solo Boxes:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <input type="text" name="start_boxes" id="start_boxes" class="form-control" onkeypress="javascript: number_format('start_boxes');">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <label for="sell_by_date">Sell By Date:</label>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group has-feedback">
                                                    <div class="input-group date sell-by-date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                        <input type="text" name="sell_by_date" id="sell_by_date" class="form-control">
                                                        <div class="input-group-addon">
                                                            <span class="glyphicon glyphicon-th"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php if($idPo != '0'){ ?>
                                                <div class="col-md-3">
                                                    <label for="status">Status:</label>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <select name="status" id="status" class="form-control" style="width: 100%;"></select>
                                                    </div>
                                                </div>
                                            <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="comments">Comments:</label>
                                                <textarea class="form-control" name="comments" id="comments"></textarea>
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
                                            <button type="button" class="btn btn-primary btn-sm" onclick="javascript: addlines();" id="add_line">
                                                <span class="glyphicon glyphicon-plus"></span> Add line
                                            </button>
                                            <input type="hidden" name="lines" id="lines" value="0">
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-2"><b>Item Code</b></div>
                                                    <div class="col-md-2"><b>Product Name</b></div>
                                                    <div class="col-md-2"><b>Box Type</b></div>
                                                    <div class="col-md-2"><b>Pack</b></div>
                                                    <div class="col-md-2"><b>Quantity</b></div>
                                                    <div class="col-md-2"><b>Fulls</b></div>
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
                            <?php if ($idPo == '0'){ 
                                echo '<button type="submit" class="btn btn-success" id="save">Save</button>';
                            }else{  
                                echo '<button type="button" class="btn btn-primary" id="po_edit">Edit</button>';
                            } ?>
                            <button type="button" class="btn btn-danger" onclick="javascript: pageContent('handling/purchasing_order/index');">Close</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>
<?php  if($idPo == '0'){ 
    echo '<script src="../../js/purchasing_order/purchasing_order.js"></script>';
}else{  
    echo '<script src="../../js/purchasing_order/purchasing_orderEdit.js"></script>';
} ?>
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
