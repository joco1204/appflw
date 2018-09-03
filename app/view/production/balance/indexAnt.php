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
        <div class="col-md-12">
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <div class="container">
                        <h3 class='box-title'>
                            <b>Balance de Producción</b>
                        </h3>
                    </div>
                </div>
                <div class='box-body'>
                    <section class='content'>
                        <div class="row">
                            <div class="col col-lg-12">
                                <div class="table-responsive" id="data_balance" style="font-size: 12px;"></div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</div>

<script src="../../js/prod/balance/balance.js"></script>
