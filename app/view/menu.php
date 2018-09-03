<ul class="sidebar-menu">
    <li class="header">MAIN MENU</li>
    <li class="treeview">
        <a href="#" class="btn-lg" onclick="javascript: pageContent('content');">
            <i class="fa fa-dashboard"></i>
            <span>START</span>
        </a>
    </li>
    <li class="treeview">
        <a href="#" class="btn-lg" onclick="javascript: pageContent('handling/handling');">
            <i class="glyphicon glyphicon-plane text-green"></i>
            <span>HANDLING</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/purchasing_order/index');"><i class="glyphicon glyphicon glyphicon-check text-green"></i> PURCHASING ORDER</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/awb/index');"><i class="glyphicon glyphicon-list-alt text-green"></i> A.W.B.</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/receiving/index');"><i class="glyphicon glyphicon-download-alt text-green"></i> RECEIVING</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/inventory/index');"><i class="glyphicon glyphicon-home text-green"></i> INVENTORY</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/shipment/index');"><i class="glyphicon glyphicon-send text-green"></i> SHIPMENT</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/workorder/index');"><i class="glyphicon glyphicon-refresh text-green"></i> WORK ORDER</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('handling/delivered/index');"><i class="glyphicon glyphicon-ok text-green"></i> DELIVERED</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="btn-lg" onclick="javascript: pageContent('production/produccion');">
            <i class="glyphicon glyphicon-cog text-orange"></i>
            <span>Production</span>
            <span class="pull-right-container"></span>
        </a>
		<ul class="treeview-menu">
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('production/carga/ID_ORDER/index');"><i class="glyphicon glyphicon glyphicon-check text-orange"></i> Carga Informaci&oacute;n</a></li>
			<li><a href="#" class="btn-lg" onclick="javascript: pageContent('production/balance/index');"><i class="glyphicon glyphicon glyphicon-check text-orange"></i> Balance Producción</a></li>
        </ul>
    </li>
    <li class="treeview">
        <a href="#" class="btn-lg" onclick="javascript: pageContent('setting/setting');">
            <i class="ion ion-settings text-red"></i>
            <span>SETTING</span>
            <span class="pull-right-container"></span>
        </a>
        <ul class="treeview-menu">
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('setting/accounts/index');"><i class="glyphicon glyphicon-list text-red"></i> ACCOUNTS</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('setting/reports/index');"><i class="fa fa-pie-chart text-red"></i> REPORTS</a></li>
            <li><a href="#" class="btn-lg" onclick="javascript: pageContent('setting/boxes/index');"><i class="fa fa-cube text-red"></i> BOXES</a></li>
			<li><a href="#" class="btn-lg" onclick="javascript: pageContent('setting/structure_po/index');"><i class="glyphicon glyphicon-folder-close text-red"></i> STRUCTURE P.O.</a></li>
			<li><a href="#" class="btn-lg" onclick="javascript: pageContent('setting/pallets/index');"><i class="glyphicon glyphicon-tags text-red"></i> PALLET</a></li>
        </ul>
    </li>
</ul>