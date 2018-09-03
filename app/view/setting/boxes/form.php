<?php 
$idBoxes = $_REQUEST['id_Boxes'];
$get = ((Object) $_GET);
isset($get->id_account) ? $id_account = $get->id_account : $id_account = '';
?>
<section class="content-header">
    <h1>BOXES</h1>
</section>
<section class="content">
    <div class='box box-info'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
			<?php 
					if ($idBoxes==0){	
					echo "<b>Add New Boxes</b>";
				}else{	
					echo "<b>Boxes: ".$idBoxes."</b>";
					
				}
				?>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
			
                <form id="boxes_form" role="form"">
				
					<div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <b>Box Information</b>
									<input type="hidden" name="action" id="action" /> 
										<input type="hidden" name="idBoxes" id="idBoxes" value="<?php echo $idBoxes; ?>"/>
                                </div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="code">Box Code:</label>
                                                <input type="text" class="form-control" name="code" id="code" placeholder="Code">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="box_name">Box Name:</label>
                                                <input type="text" class="form-control" name="box_name" id="box_name" placeholder="Box Name">
											</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="brand">Brand</label>
                                                <input type="input" class="form-control" name="brand" id="brand" placeholder="Brand">
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
											<div class="form-group">										
												
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
				
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-info">
                                <div class="panel-heading">
                                    <b>Box Dimensions</b>
								</div>
                                <div class="panel-body">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="length">Length:</label>
                                                <input type="text" class="form-control" name="length" id="length" placeholder="Length">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="width">Width:</label>
                                                <input type="text" class="form-control" name="width" id="width" placeholder="Width">
											</div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label for="height">Height</label>
                                                <input type="input" class="form-control" name="height" id="height" placeholder="Height">
                                            </div>
                                        </div>
                                        <div class="col-md-6"> 
											<div class="form-group">										
												<label for="fbe">FBE</label>
                                                <input type="input" class="form-control" name="fbe" id="fbe" placeholder="FBE">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="row">
                        <div class="col-lg-12 text-center">
							<?php 
							if ($idBoxes==0){	
								echo '<button type="submit" class="btn btn-success" id="save">Save</button>
									<button type="button" class="btn btn-primary" id="save_new">Save and New</button>';
							}else{	
								echo '<button type="button" class="btn btn-primary" id="boxes_edit">Edit</button>';
							}
							?>
                            <button type="button" class="btn btn-default" onclick="javascript: pageContent('setting/boxes/index');">Cancel</button>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
</section>
<?php 
if ($idBoxes==0){	
	echo '<script src="../../js/boxes/boxes.js"></script>';
}else{	
	echo '<script src="../../js/boxes/boxesEdit.js"></script>';
}
?>

