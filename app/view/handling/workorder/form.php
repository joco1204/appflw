<?php
$get                       = ((Object) $_GET);
isset($get->id_wo) ? $idWo = $get->id_wo : $idWo = '0';
?>
<section class="content-header">
    <h1>WORK ORDER</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
                <?php if ($idWo == '0') {
    echo "<b>ADD NEW WORK ORDER</b>";
} else {
    echo "<b>WORK ORDER: " . $idWo . "</b>";
}?>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <form id="workOrder_form" role="form">
                    <div class="row">
                        <div class="col-lg-10  col-lg-offset-1">
                            <div class="panel panel-success">
                                <div class="panel-heading text-center">
                                    <b>
                                        Work Order Information
                                        <input type="hidden" name="action" id="action" />
                                        <input type="hidden" name="idWo" id="idWo" value="<?php echo $idWo; ?>"/>
                                    </b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="customer">Customer:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="customer" id="customer" class="form-control" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="po">P.O #:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="po" id="po" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="contact_number">Contact Number:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="contact_number" id="contact_number" class="form-control"></select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="item">Item #:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select name="item" id="item" class="form-control"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="">Email:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="email" name="email" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="consignee">Consignee:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select id="consignee" name="consignee" class="form-control" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="phone">Phone:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="phone" name="phone" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="ship_via">Ship Via:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="ship_via" id="ship_via" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="mobile">Mobile:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="mobile" name="mobile" readonly="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="ship_date">Ship Date:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <div class="input-group date ship-date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" name="ship_date" id="ship_date" class="form-control" placeholder="yyyy-mm-dd" required="">
                                                    <div class="input-group-addon popup_date">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="cut_off">Cut Off:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <div class="input-group date cut-off" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" name="cut_off" id="cut_off" class="form-control" placeholder="yyyy-mm-dd" required="">
                                                    <div class="input-group-addon popup_date">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="sell_by_date">Sell by Date: </label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group has-feedback">
                                                <div class="input-group date sell-by-date" data-provide="datepicker" data-date-format="yyyy-mm-dd">
                                                    <input type="text" name="sell_by_date" id="sell_by_date" class="form-control" placeholder="yyyy-mm-dd" required="">
                                                    <div class="input-group-addon popup_date">
                                                        <span class="glyphicon glyphicon-th"></span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-2">
                                            <label for="status">Status:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <select class="form-control" name="status" id="status" style="width: 100%;"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row" id="pallets" style="display: none;">
                                        <div class="col-md-2">
                                            <label for="pallet_tag">Pallet Tag:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="pallet_tag" name="pallet_tag" disabled="">
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <label for="pallet_position">Pallet Position:</label>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <input type="text" class="form-control" id="pallet_position" name="pallet_position" disabled="">
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
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="item_description">Item Description:</label>
                                                    <input type="text" class="form-control" name="item_description" id="item_description" placeholder="Item description" readonly="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="box_type_dry">Box Type Dry:</label>
                                                    <input type="text"  class="form-control numerico" name="box_type_dry" id="box_type_dry" placeholder="Box Type Dry" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="boxesqty">Box QTY:</label>
                                                    <input type="text"  class="form-control numerico" name="boxesqty" id="boxesqty" placeholder="Box QTY" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="pack_dry">Pack Dry:</label>
                                                    <input type="text"  class="form-control numerico" name="pack_dry" id="pack_dry" placeholder="Pack Dry" required="">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="wet_per_dry">Wet per Dry:</label>
                                                    <input type="text"  class="form-control numerico" name="wet_per_dry" id="wet_per_dry" placeholder="Wet per Dry" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="pack_per_wet">Pack per Wet:</label>
                                                    <input type="text"  class="form-control numerico" name="pack_per_wet" id="pack_per_wet" placeholder="Pack per Wet" required="">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <div class="input-group">
                                                    <label for="box_type_wet">Box Type Wet:</label>
                                                    <input type="text"  class="form-control numerico" name="box_type_wet" id="box_type_wet" placeholder="Box Type Wet" required="">
                                                </div>
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
                                    <div class="container-fluid">
                                        <div class="panel panel-success">
                                            <div class="panel-heading">
                                                <div class="row">
                                                    <div class="col-md-3"><b>Activity</b></div>
                                                    <div class="col-md-3"><b>Description</b></div>
                                                    <div class="col-md-2"><b>QTY</b></div>
                                                    <div class="col-md-2"><b>Unit Price</b></div>
                                                    <div class="col-md-2"><b>Total</b></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="panel-body">
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="activity_line" id="activity_line" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control" name="description_line" id="description_line" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="quantity_line" id="quantity_line" onkeypress="javascript: price();" onkeyup="javascript: price();" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="unit_price_line" id="unit_price_line" onkeypress="javascript: price();" onkeyup="javascript: price();" required="">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="total_init_price_line" id="total_init_price_line" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8"></div>
                                                <div class="col-md-2"><b>SUBTOTAL:</b></div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="subtotal_price_line" id="subtotal_price_line" readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8"></div>
                                                <div class="col-md-1"><b>TAX %:</b></div>
                                                <div class="col-md-1">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="tax_percent_line" id="tax_percent_line" onkeypress="javascript: price();" onkeyup="javascript: price();">
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="tax_price_line" id="tax_price_line" readonly="">

                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-8"></div>
                                                <div class="col-md-2"><b>TOTAL:</b></div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control numerico" name="total_price_line" id="total_price_line"  readonly="">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <?php if ($idWo == 0) {
    echo '<button type="submit" class="btn btn-success" id="save">Save</button>';
} else {
    echo '<button type="button" class="btn btn-primary" id="workOrder_edit">Edit</button>';
}?>
                            <button type="button" class="btn btn-default" onclick="javascript: pageContent('handling/workorder/index');">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>
<?php if ($idWo == '0') {
    echo '<script src="../../js/workorder/workorder.js"></script>';
} else {
    echo '<script src="../../js/workorder/workorderEdit.js"></script>';
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


