<style>
/*!
 * bootstrap-vertical-tabs - v1.1.0
 * https://dbtek.github.io/bootstrap-vertical-tabs
 * 2014-06-06
 * Copyright (c) 2014 Ä°smail Demirbilek
 * License: MIT
 */
.tabs-left, .tabs-right {
  border-bottom: none;
  padding-top: 2px;
}
.tabs-left {
  border-right: 1px solid #ddd;
}
.tabs-right {
  border-left: 1px solid #ddd;
}
.tabs-left>li, .tabs-right>li {
  float: none;
  margin-bottom: 2px;
}
.tabs-left>li {
  margin-right: -1px;
}
.tabs-right>li {
  margin-left: -1px;
}
.tabs-left>li.active>a,
.tabs-left>li.active>a:hover,
.tabs-left>li.active>a:focus {
  border-bottom-color: #ddd;
  border-right-color: transparent;
}

.tabs-right>li.active>a,
.tabs-right>li.active>a:hover,
.tabs-right>li.active>a:focus {
  border-bottom: 1px solid #ddd;
  border-left-color: transparent;
}
.tabs-left>li>a {
  border-radius: 4px 0 0 4px;
  margin-right: 0;
  display:block;
}
.tabs-right>li>a {
  border-radius: 0 4px 4px 0;
  margin-right: 0;
}
.vertical-text {
  margin-top:50px;
  border: none;
  position: relative;
}
.vertical-text>li {
  height: 20px;
  width: 120px;
  margin-bottom: 100px;
}
.vertical-text>li>a {
  border-bottom: 1px solid #ddd;
  border-right-color: transparent;
  text-align: center;
  border-radius: 4px 4px 0px 0px;
}
.vertical-text>li.active>a,
.vertical-text>li.active>a:hover,
.vertical-text>li.active>a:focus {
  border-bottom-color: transparent;
  border-right-color: #ddd;
  border-left-color: #ddd;
}
.vertical-text.tabs-left {
  left: -50px;
}
.vertical-text.tabs-right {
  right: -50px;
}
.vertical-text.tabs-right>li {
  -webkit-transform: rotate(90deg);
  -moz-transform: rotate(90deg);
  -ms-transform: rotate(90deg);
  -o-transform: rotate(90deg);
  transform: rotate(90deg);
}
.vertical-text.tabs-left>li {
  -webkit-transform: rotate(-90deg);
  -moz-transform: rotate(-90deg);
  -ms-transform: rotate(-90deg);
  -o-transform: rotate(-90deg);
  transform: rotate(-90deg);
}
</style>
<section class="content-header">
    <h1>SHIPMENT</h1>
</section>
<section class="content">
    <!--<div class="row">
        <div class="col col-md-3">
            <button type="button" class="btn btn-primary btn-sm" onclick="javascript: pageContent('handling/shipment/form');">
                Add New <span class="glyphicon glyphicon-plus"></span>
            </button>
        </div>
    </div>-->
    <br>
    <div class="row">
        <div class="col-md-12">
            <div class='box box-success'>
                <div class='box-header with-border'>
                    <h3 class='box-title'>
                        <b>SHIPMENT LIST</b>
                    </h3>
                </div>
                <div class='box-body'>
                    <section class='content'>
                        <!-- <div class="row">
                            <div class="col col-lg-12">
                                <div class="table-responsive" id="data_shipment" style="font-size: 11px;"></div>
                            </div>
                        </div> -->
						<div class="col-xs-1">
							<!-- required for floating -->
							<!-- Nav tabs -->
							<ul class="nav nav-tabs tabs-left vertical-text">
								<li class="active"><a href="#list_incomplete" data-toggle="tab" id="btn_data_list">Pending</a></li>
								<li><a href="#list_next" data-toggle="tab" id="btn_data_next">Shipment</a></li>
							</ul>
						</div>
						<div class="col-xs-11">
							<!-- Tab panes -->
							<div class="tab-content">
								<div class="tab-pane active" id="list_incomplete">
									<div class="table-responsive" id="data_shipment" style="font-size: 11px;"></div>
								</div>
								<div class="tab-pane" id="list_next">
									<div class="table-responsive" id="data_shipment_next" style="font-size: 11px;"></div>
								</div>
							</div>
						</div>
                    </section>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="modal_traccar" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center bg-green">
			</div>
            <div class="modal-body" id="load_traccar">
				<iframe width="860" height="615" src="http://172.246.126.64:8082/" frameborder="0" allowfullscreen></iframe>

			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>
<div id="modal_temperature" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header text-center bg-green">
			</div>
            <div class="modal-body" id="load_temperature">

			</div>
            <div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal" >Close</button>
            </div>
        </div>
    </div>
</div>
<script src="../../js/shipment/shipment.js"></script>

