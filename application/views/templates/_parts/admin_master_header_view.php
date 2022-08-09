<?php defined('BASEPATH') or exit('No direct script access allowed');?>

<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
    <title><?=WEBSITE_NAME . '-' . 'Admin-' . $page_title?></title>
    <?=$before_head?>
    <link rel="shortcut icon" type="image/png" href="<?=$BASE_URL?>assets/images/favicon.png" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/bootstrap.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/bootstrap-select.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/css/font-awesome.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/ionicons.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/morris.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/blueAdminLTE.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/_all-skins.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/custom.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/BsMultiSelect.min.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/admin/css/jquery.datetimepicker.min.css" />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

    <?php $kendoVersion = "2021.3.914";?>
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/bootstrap/css/daterangepicker.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/build/css/font-awesome.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/simple-line-icons/simple-line-icons.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/bootstrap/css/bootstrap.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/magnific-popup/magnific-popup.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/summernote/summernote.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/jquery-ui-themes/smoothness/jquery-ui-1.10.3.custom.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/elfinder/css/elfinder.full.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/elfinder/css/theme.css" />

    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/kendo/styles/<?=$kendoVersion?>/kendo.material.mobile.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/kendo/styles/<?=$kendoVersion?>/kendo.material.min.css" />
    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/kendo/styles/<?=$kendoVersion?>/kendo.common-material.min.css" />

    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/build/css/custom.css" />

    <link rel="stylesheet" type="text/css" href="<?=$BASE_URL?>assets/administration/fineuploader/fineuploader-4.2.2.min.css" />

    <script src="<?=$BASE_URL?>assets/administration/build/js/jquery.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/jquery-ui/jquery-ui.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/build/js/moment.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/bootstrap/js/daterangepicker.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/typeahead.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/admin.search.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/jquery.validate.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/jquery.validate.unobtrusive.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/admin.common.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/kendo/scripts/<?=$kendoVersion?>/kendo.ui.core.min.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/kendo/scripts/<?=$kendoVersion?>/kendo.grid.js"></script>
    <script src="<?=$BASE_URL?>assets/administration/kendo/scripts/<?=$kendoVersion?>/cultures/kendo.culture.en-US.min.js"></script>
</head>

<body class="skin-blue sidebar-mini">
    <div class="wrapper">
        <header class="main-header">
            <!-- Logo -->
            <a href="javascript:void(0)" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><img src="<?=$BASE_URL?>assets/admin/images/printing.coopLogo.png"></span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><img src="<?=$BASE_URL?>assets/admin/images/printing.coopLogo.png"></span>
            </a>
            <nav class="navbar navbar-static-top" role="navigation">
                <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <i class="fa fas fa-bars"></i>
                </a>
                <div class="logo-section for-mobile text-center">
                    <img src="<?=$BASE_URL?>assets/admin/images/printing.coopLogo.png">
                </div>
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-user"></i>
                                <span class="hidden-xs">
                                    <span class="large">Admin Detail</span>
                                </span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="<?=$BASE_URL?>assets/admin/images/user2-160x160.jpg" class="img-circle"
                                        alt="User Image" />
                                    <p>
                                        <span class="large">Welcome <?=ucfirst($loginUserData['name'])?></span><br>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="<?=$BASE_URL_ADMIN?>Dashboards/logout"
                                            class="btn btn-warning btn-flat">Logout</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </nav>
        </header>
        <div class="after-header"></div>
        <aside class="main-sidebar">
            <!-- sidebar: style can be found in sidebar.less -->
            <section class="sidebar">
                <ul class="sidebar-menu">
                    <li class="treeview <?php if (in_array($CLASS_NAME, array('dashboards'))) { echo 'active'; } ?>">
                        <a href="<?=$BASE_URL_ADMIN?>Dashboards">
                            <i class="fa fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <?php
                    foreach ($ModuleList as $key => $val) {
                        $module = $val['module'];
                        $sub_modules = $val['sub_modules'];
                        $module_class_array = explode(',', strtolower($module['url']));
                        $module_name = $module['module_name'];
                        $class = $module['class'];
                        if (in_array($key, $AdminModule)) {
                            ?>
                            <li class="treeview <?=in_array($CLASS_NAME, $module_class_array) ? 'active' : ''?>">
                                <a href="javascript:void(0)">
                                    <i class="<?=$class?>"></i>
                                    <span><?=$module_name?></span>
                                    <i class="fa fa-chevron-left pull-right"></i>
                                </a>
                                <ul class="treeview-menu">
                                    <?php
                                    foreach ($sub_modules as $skey => $sval) {
                                        $action = strtolower($sval['action']);
                                        $class = strtolower($sval['class']);
                                        $show_menu = $sval['show_menu'];
                                        $url = $sval['url'];
                                        $sub_module_name = $sval['sub_module_name'];
                                        $sub_module_class = $module['sub_module_class'] ?? '';
                                        $url_prem = explode("/", $url);
                                        $url_prem = isset($url_prem['2']) ? $url_prem['2'] : '';
                                        if ($show_menu && in_array($skey, $AdminSubModule)) {
                                            ?>
                                            <li class="<?=$CLASS_NAME == $class && $METHOD_NAME == $action && $PARAMETER_NAME == $url_prem ? 'active' : ''?>">
                                                <a href="<?=$BASE_URL_ADMIN . $url?>">
                                                    <i class="<?=$sub_module_class?>"></i><?=$sub_module_name?>
                                                </a>
                                            </li>
                                        <?php }
                                    } ?>
                                </ul>
                            </li>
                        <?php }
                    } ?>
                    <li class="treeview">
                        <a href="<?=$BASE_URL_ADMIN?>Accounts/logout">
                            <i class="fa fa-unlock-alt"></i> <span>Logout</span>
                        </a>
                    </li>
                </ul>
            </section>
            <!-- /.sidebar -->
        </aside>
    </div>
    <div id="loader-img">
        <div id="loader-img-inner"><img src="<?=$BASE_URL?>assets/images/loder.gif" width="100"></div>
    </div>