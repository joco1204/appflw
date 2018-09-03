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
<section class="content-header">
    <h1>PURCHASING ORDER</h1>
</section>
<section class="content">
    <div class="row">
        <div class="col col-md-3">
			  <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#load_file_po_full">
                Load P.O. Full
                <span class="glyphicon glyphicon-file"></span>
            </button>
        </div>
        <!--<div class="col-md-3 text-center">
            <label><?php //echo $one_date; ?></label>
            <input type="hidden" name="one_date_complete" id="one_date_complete" value="">
            <input type="hidden" name="one_date_incomplete" id="one_date_incomplete" value="">
            <canvas id="pieChart"></canvas>
        </div>
        <div class="col col-md-3 text-center">
            <label><?php //echo $two_date; ?></label>
            <input type="hidden" name="two_date_complete" id="two_date_complete" value="">
            <input type="hidden" name="two_date_incomplete" id="two_date_incomplete" value="">
            <canvas id="pieChart2"></canvas>
        </div>
        <div class="col col-md-3 text-center">
            <label><?php //echo $tree_date; ?></label>
            <input type="hidden" name="tree_date_complete" id="tree_date_complete" value="">
            <input type="hidden" name="tree_date_incomplete" id="tree_date_incomplete" value="">
            <canvas id="pieChart3"></canvas>
        </div>-->
    </div>
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>
                        <b>P.O. LIST</b>
                    </h3>
                </div>
                <div class='box-body'>
                    <section class='content'>
                        <div class="row">
                            <div class="col col-lg-12">
                                <div class="table-responsive" id="data_po_list" style="font-size: 11px;"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>

<div id="load_file_po_full" class="modal fade" role="dialog">
    <form id="load_file_form_po_full">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE P.O. FULL</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file master of P.O. Full</label>
                                <input type="file" class="form-control" name="file_po_full" id="file_po_full">
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

<div id="load_file_po" class="modal fade" role="dialog">
    <form id="load_file_form_po">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE P.O.</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_po">Load file master of P.O.</label>
                                <input type="file" class="form-control" name="file_po" id="file_po">
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

<div id="product" class="modal fade" role="dialog">
    <form id="load_file_form_product">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>LOAD FILE PRODUCTS P.O.</b></h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group has-feedback">
                                <label for="file_products">Load file master of P.O.</label>
                                <input type="file" class="form-control" name="file_products" id="file_products">
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

<script src="../../js/purchasing_order/purchasing_order.js"></script>
<!--<script src="../../js/purchasing_order/purchasing_order_dashboard.js"></script>-->
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