<?php
$get                                   = ((object) $_GET);
isset($get->id_shipment) ? $idShipment = $get->id_shipment : $idShipment = '0';
?>
<section class="content-header">
    <h1>SHIPMENT</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
            <?php if ($idShipment == '0') {
    echo "<b>ADD NEW SHIPMENT</b>";
} else {
    echo "<b>SHIPMENT: " . $idShipment . "</b>";
}?>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <form id="shipment_form">
                    <div class="row">
                        <div class="col-lg-10 col-lg-offset-1">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <b>Shipment Information</b>
                                    <input type="hidden" name="action" id="action" />
                                    <input type="hidden" name="idShipment" id="idShipment" value="<?=$idShipment;?>"/>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="customer">Customer:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="customer" id="customer"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="truck_company">Truck Company:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="truck_company" id="truck_company"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="received_damage">Received Damage:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control numerico" name="received_damage" id="received_damage" value="0" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <label for="consignee">Consignee:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="consignee" id="consignee"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="tqoc">Total Qty Of Cases:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control numerico" name="tqoc" id="tqoc" value="0" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <label for="shipping_date">Shipping Date:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <div class="input-group date shipping-date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" name="shipping_date" id="shipping_date" class="form-control" required="">
                                                    <div class="input-group-addon popup_date">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="cro">Cases Received OK:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="text" class="form-control numerico" name="cro" id="cro" value="0" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2"></div>
                                        <div class="col-md-2">
                                            <label for="temp">Temp:</label>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group">
                                                <input type="number" class="form-control numericol" name="temp" id="temp" required="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label>°F</label>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="pod">POD:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="file" class="form-control" name="pod" id="pod" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="status">Status:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="status" id="status" disabled=""></select>
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
                                            <?php if ($idShipment == '0') {?>
                                                <button type="button" class="btn btn-primary btn-sm" onclick="javascript: addlines();">
                                                    <span class="glyphicon glyphicon-plus"></span> Add line
                                                </button>
                                                <input type="hidden" name="lines" id="lines" value="0">
                                            <?php }?>
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body">
                                    <div class="container-fluid">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-3"><b>P.O. #</b></div>
                                                    <div class="col-md-2"><b>Item Code</b></div>
                                                    <div class="col-md-3"><b>Item Desc</b></div>
                                                    <div class="col-md-2"><b>Box QTY</b></div>
                                                    <div class="col-md-2"><b>AWB</b></div>
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
                            <?php if ($idShipment == '0') {
    echo '<button type="submit" class="btn btn-success" id="save">Save</button>';
} else {
    echo '<button type="button" class="btn btn-primary" id="shipment_edit">Edit</button>';
}?>
                            <button type="button" class="btn btn-default" onclick="javascript: pageContent('handling/shipment/index');">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>

<?php if ($idShipment == '0') {
    echo '<script src="../../js/shipment/shipment.js"></script>';
} else {
    echo '<script src="../../js/shipment/shipmentEdit.js"></script>';
}?>
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

