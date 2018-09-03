<section class="content-header">
    <h1>BOXES</h1>
</section>
<section class="content">
    <div class='box box-info'>
        <div class='box-header with-border'>
            <div class="row">
                <div class="col col-md-6 text-left">
                    <h3 class='box-title'>
                         <b>BOXES LIST</b>
                    </h3>
                </div>
                <div class="col col-md-6 text-right">
                     
                </div>
            </div>
        </div>
        <div class='box-body'>
            <section class='content'>
                <div class="row">
                    <div class="col col-lg-12 text-center">
                        <button type="button" class="btn btn-info" onclick="javascript: pageContent('setting/boxes/form');">
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
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered display" id="table_boxes">
                                <thead>
                                    <tr>
                                        <th>Code</th>
                                        <th>Box Name</th>
                                        <th>Length</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>FBE</th>
                                    </tr>
                                </thead>
                                <tbody id="data_boxes_list">
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Code</th>
                                        <th>Box Name</th>
                                        <th>Length</th>
                                        <th>Width</th>
                                        <th>Height</th>
                                        <th>FBE</th>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script src="../../js/boxes/boxes.js"></script>
