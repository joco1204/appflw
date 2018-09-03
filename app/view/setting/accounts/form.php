<?php 
$get = ((Object) $_GET);
 //Validate id account
if(isset($get->id)){
    $id = $get->id;
    $action = 'updateAccounts';
} else {
    $id = '';
    $action = 'insertAccounts';
}
?>
<section class="content-header">
    <h1>ACCOUNTS</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
                <b>Add New Account</b>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <form id="account_form">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <b>Company Information <input type="hidden" name="action" id="action" value="<?= $action ?>"></b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="name_company">Company:</label>
                                                <input type="text" class="form-control" name="name_company" id="name_company" placeholder="Company">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for=web_site"">Web Site:</label>
                                                <input type="text" class="form-control" name="web_site" id="web_site" placeholder="Web Site">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="phone_number">Phone</label>
                                                <input type="text" class="form-control" name="phone_number" id="phone_number" placeholder="Phone">
                                                <label for="fax_number">Fax</label>
                                                <input type="text" class="form-control" name="fax_number" id="fax_number" placeholder="Fax">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="groups">Groups:</label>
												<div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="client" id="client" value="1">Client
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="customer" id="customer" value="1">Customer
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="grower" id="grower" value="1">Grower
                                                    </label>
                                                </div>
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="truck" id="truck" value="1">Truck
                                                    </label>
                                                </div>
												<div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name="consignee" id="consignee" value="1">Consignee
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="toll_free">Toll Free:</label>
                                                <input type="text" class="form-control" name="toll_free" id="toll_free" placeholder="Toll Free">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="cut_off">Cut Off:</label>
                                                <input type="time" class="form-control" name="cut_off" id="cut_off">
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
                                    <button type="button" class="btn btn-success btn-sm" data-toggle="modal" data-target="#newContact">
										ADD Contact <span class="glyphicon glyphicon-file"></span>
									</button>
									<b>Contacts Number</b>
									<b><input type="text" id="n_contact" name= "n_contact" value="0" readonly/></b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-12" id="newsContact">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <b>Billing Address</b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="address_billing_address">Address:</label>
                                                <textarea class="form-control" name="address_billing_address" id="address_billing_address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="country_billing_address">Country:</label>
                                                <select class="form-control" name="country_billing_address" id="country_billing_address" onchange= "changeState('billing');" ></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="state_billing_address">State:</label>
                                                <select class="form-control" name="state_billing_address" id="state_billing_address" onchange= "changeCity('billing');" > </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="city_billing_address">City:</label>
                                                <select class="form-control" name="city_billing_address" id="city_billing_address"> </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="zip_code_billing_address">Zip Code:</label>
                                                <input type="text" class="form-control" name="zip_code_billing_address" id="zip_code_billing_address">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel panel-success">
                                <div class="panel-heading">
                                    <b>Shipping Address</b>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="address_shipping_address">Address:</label>
                                                <textarea class="form-control" name="address_shipping_address" id="address_shipping_address"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="country_shipping_address">Country:</label>
                                                <select class="form-control" name="country_shipping_address" id="country_shipping_address" onchange= "changeState('shipping');"></select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="">State:</label>
                                                <select class="form-control" name="state_shipping_address" id="state_shipping_address" onchange= "changeCity('shipping');"> </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="city_shipping_address">City:</label>
                                                <select class="form-control" name="city_shipping_address" id="city_shipping_address"> </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <div class="form-group">
                                                <label for="zip_code_shipping_address">Zip Code:</label>
                                                <input type="text" class="form-control" name="zip_code_shipping_address" id="zip_code_shipping_address">
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
                                                <label for="notes">Notes:</label>
                                                <textarea class="form-control" name="notes" id="notes"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12 text-center">
                            <button type="submit" class="btn btn-success" id="save" onclick="saveAccount(0);" >Save</button>
                            <button type="button" class="btn btn-primary" id="save_new" onclick="saveAccount(1);">Save and New</button>
                            <button type="button" class="btn btn-default" onclick="javascript: pageContent('setting/accounts/index');">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>


<div id="newContact" class="modal fade" role="dialog">
    <form id="new_contact">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header text-center bg-green">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center"><b>New Contact</b></h4>
                </div>
                <div class="modal-body">
				<div class = "row">
				<div class = "col-md-12" id= "msg" style= "color: #FF0000;" name= "msg">
				</div>
				</div>
                    <div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="toll_free">First name:</label>
								<input type="text" class="form-control" name="dato1" id="dato1" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cut_off">Last name:</label>
								<input type="text" class="form-control" name="dato2" id="dato2" placeholder="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="toll_free">Contact type:</label>
								<input type="text" class="form-control" name="dato3" id="dato3" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cut_off">Departament:</label>
								<input type="text" class="form-control" name="dato4" id="dato4" placeholder="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="toll_free">Job Title:</label>
								<input type="text" class="form-control" name="dato5" id="dato5" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cut_off">Home phone:</label>
								<input type="text" class="form-control" name="dato6" id="dato6" placeholder="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="toll_free">Mobile:</label>
								<input type="text" class="form-control" name="dato7" id="dato7" placeholder="">
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="cut_off">Email:</label>
								<input type="text" class="form-control" name="dato8" id="dato8" placeholder="">
							</div>
						</div>
					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="toll_free">Primary contact:</label>
								<select class="form-control" name="dato9" id="dato9">
								<option value="">Choose Option</option>
								<option value="YES">YES</option>
								<option value="NO">NO</option>
								</select>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
							</div>
						</div>
					</div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" onclick="new_con();">Load</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </form>  
</div>

<script src="../../js/accounts.js"></script>