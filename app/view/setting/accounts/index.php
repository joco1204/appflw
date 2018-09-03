<section class="content-header">
    <h1>ACCOUNTS</h1>
</section>
<section class="content">
    <div class='box box-success'>
        <div class='box-header with-border'>
            <h3 class='box-title'>
                <b>ACCOUNTS LIST</b>
            </h3>
        </div>
        <div class='box-body'>
            <section class='content'>
                <div class="row">
                    <div class="col col-lg-12 text-center">
                        <button type="button" class="btn btn-success" onclick="javascript: pageContent('setting/accounts/form');">
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
                        <div class="table-responsive" id="data_accounts"></div>
                    </div>
                </div>
            </section>
        </div>
    </div>
</section>
<script src="../../js/accounts.js"></script>