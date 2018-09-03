<?php include '../../config/header.php'; ?>
<div class="wrapper">
    <header class="main-header">
        <a href="#" onclick="pageContent('content');" class="logo" id="background-logo">
            <span class="logo-mini">
                <img src="<?php echo $session->getSession('logo_mini'); ?>" class="logo-image" alt="Logo Image" style="max-height: 40px;">
            </span>
            <span class="logo-lg">
				<img src="<?php echo $session->getSession('logo_long'); ?>" class="logo-image" alt="Logo Image" style="max-height: 40px;">
            </span>
        </a>
        <nav class="navbar navbar-static-top">
            <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                <span class="sr-only">MAIN PANEL</span>
            </a>
            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">
                    <li class="dropdown messages-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-envelope-o"></i>
                            <span class="label label-danger">1</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">You have 1 message</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            <h4>
                                                Message
                                                <small><i class="fa fa-clock-o"></i>5 min</small>
                                            </h4>
                                            <p>Header Message</p>
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">more</a></li>
                        </ul>
                    </li>
                    <li class="dropdown notifications-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="fa fa-bell-o"></i>
                            <span class="label label-danger">1</span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="header">Notification</li>
                            <li>
                                <ul class="menu">
                                    <li>
                                        <a href="#">
                                            Notification Header
                                        </a>
                                    </li>
                                </ul>
                            </li>
                            <li class="footer"><a href="#">more</a></li>
                        </ul>
                    </li>
                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <?php if($session->getSession('foto')){ ?>
                                <img src="<?= $session->getSession('foto'); ?>" class="user-image" alt="User Image">
                            <?php } else { ?>
                                <img src="../../img/fotos/default.png" class="user-image" alt="User Image">
                            <?php } ?>
                            <span class="hidden-xs"><?php echo $session->getSession('username')." ".$session->getSession('lastname'); ?></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li class="user-header">
                                <?php if($session->getSession('foto')){ ?>
                                    <img src="<?= $session->getSession('foto'); ?>" class="img-circle" alt="User Image">
                                <?php } else { ?>
                                    <img src="../../img/fotos/default.png" class="img-circle" alt="User Image">
                                <?php } ?>
                                <p>
                                    <?php echo $session->getSession('username')." ".$session->getSession('lastname'); ?>
                                    <br>
                                    <?php echo $session->getSession('userprofile');  ?>
                                </p>
                            </li>
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="#" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="#" onclick="javascript: logout();" class="btn btn-default btn-flat">logout</a>
                                </div>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#" data-toggle="control-sidebar"></a>
                    </li>
                </ul>
            </div>
        </nav>
    </header>
    <aside class="main-sidebar">
        <section class="sidebar">
            <div class="user-panel">
                <div class="pull-left image">
                    <?php if($session->getSession('foto')){ ?>
                        <img src="<?= $session->getSession('foto'); ?>" class="img-circle" alt="User Image">
                    <?php } else { ?>
                        <img src="../../img/fotos/default.png" class="img-circle" alt="User Image">
                    <?php } ?>
                </div>
                <div class="pull-left info">
                    <p><?php echo $session->getSession('username')." ".$session->getSession('lastname'); ?></p>
                    <a href="#"><i class="fa fa-circle text-success"></i>On Line</a>
                </div>
            </div>
            <?php include 'menu.php'; ?>
        </section>
    </aside>
    <div class="content-wrapper">
        <section class="content-header">
            <a href="<?= $session->getSession('companyweb'); ?>" target="_blank">
                <img src="<?= $session->getSession('companylogo'); ?>" style="max-height: 100px;" class="logo-image" alt="Logo Image">
            </a>
        </section>
        <section class="content" id="content-index"></section>
    </div>
</div>
<?php include '../../config/footer.php'; ?>
<script type="text/javascript">
    pageContent('content');
</script>