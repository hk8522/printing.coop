<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>

<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0" />
        <title><?php echo WEBSITE_NAME.'-'.'Admin-'.$page_title;?></title>
        <?php echo $before_head;?>
        <link rel="shortcut icon" type="image/png" href="<?php echo $BASE_URL;?>assets/images/favicon.png"/>
        <link href="<?php echo $BASE_URL;?>assets/admin/css/bootstrap.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/bootstrap-select.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/font-awesome.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/ionicons.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/morris.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/blueAdminLTE.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/_all-skins.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/custom.css" rel="stylesheet" type="text/css" />
        <link href="<?php echo $BASE_URL;?>assets/admin/css/BsMultiSelect.min.css" rel="stylesheet" type="text/css" />
        <link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
        <link href="<?php echo $BASE_URL;?>assets/admin/css/jquery.datetimepicker.min.css" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    </head>
    <body class="skin-blue sidebar-mini">
        <div class="wrapper">
            <header class="main-header">
                <!-- Logo -->
                <a href="javascript:void(0)" class="logo">
                    <!-- mini logo for sidebar mini 50x50 pixels -->
                    <span class="logo-mini"><img src="<?php echo $BASE_URL;?>assets/admin/images/printing.coopLogo.png"></span>
                    <!-- logo for regular state and mobile devices -->
                    <span class="logo-lg"><img src="<?php echo $BASE_URL;?>assets/admin/images/printing.coopLogo.png"></span>
                </a>
                <nav class="navbar navbar-static-top" role="navigation">
                    <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
                    <i class="fas fa-bars"></i>
                    </a>
                    <div class="logo-section for-mobile text-center">
                        <img src="<?php echo $BASE_URL;?>assets/admin/images/printing.coopLogo.png">
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
                                        <img src="<?php echo $BASE_URL;?>assets/admin/images/user2-160x160.jpg" class="img-circle" alt="User Image" />
                                        <p>
                                            <span class="large">Welcome <?php echo ucfirst($loginUserData['name']);?></span><br>
                                        </p>
                                    </li>
                                    <!-- Menu Body -->
                                    <!-- Menu Footer-->
                                    <li class="user-footer">
                                        <div class="pull-right">
                                            <a href="<?php echo $BASE_URL_ADMIN ?>Dashboards/logout" class="btn btn-warning btn-flat">Logout</a>
                                        </div>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                </nav>
            </header>
			<?php
		//pr($ModuleList);
		//pr($AdminSubModule);
		 //pr($AdminModule,1);

            ?>
            <div class="after-header"></div>
            <aside class="main-sidebar">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <ul class="sidebar-menu">
                        <li class="treeview <?php if(in_array($CLASS_NAME,array('dashboards'))) echo 'active'?>">
                            <a href="<?php echo $BASE_URL_ADMIN ?>Dashboards">
                            <i class="fas fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                            </a>
                        </li>
					  <?php
					   foreach($ModuleList as $key=>$val){

					      $module=$val['module'];
						  $sub_module=$val['sub_module'];
						  $module_class_array=explode(',',strtolower($module['url']));
						  $module_name=$module['module_name'];
						  $class=$module['class'];
						  if (in_array($key, $AdminModule)) {
					  ?>
                        <li class="treeview <?php echo in_array($CLASS_NAME, $module_class_array) ? 'active':''?>">
                            <a href="javascript:void(0)">
                            <i class="<?php echo $class; ?>"></i>
                            <span><?php echo $module_name;?></span>
                             <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
								<?php
								foreach($sub_module as $skey=>$sval){

								    $action=strtolower($sval['action']);
									$class=strtolower($sval['class']);
									$show_menu=$sval['show_menu'];
									$url=$sval['url'];
									$sub_module_name=$sval['sub_module_name'];
									$sub_module_class=$module['sub_module_class'];
									$url_prem=explode("/",$url);
									$url_prem=isset($url_prem['2']) ? $url_prem['2']:'';
								    if ($show_menu && in_array($skey, $AdminSubModule)) {
								    ?>
										<li class="<?php echo $CLASS_NAME==$class && $METHOD_NAME==$action && $PARAMETER_NAME == $url_prem ? 'active':''?>">
											<a href="<?php echo $BASE_URL_ADMIN.$url?>">
											<i class="<?php echo $sub_module_class;?>"></i><?php echo $sub_module_name;?>
											</a>
										</li>
									<?php }
								 }?>
                            </ul>
                        </li>
						 <?php
						  }
						 }?>
						<!--<li class="treeview <?php echo in_array($CLASS_NAME,array('products')) ? 'active':''?>">
                            <a href="javascript:void(0)">
                            <i class="fab fa-product-hunt"></i>
                            <span>Product Management</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('products')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Products">
                                    <i class="fas fa-circle"></i>Products List
                                    </a>
                                </li>
								<li class="<?php echo in_array($CLASS_NAME,array('products')) && in_array($METHOD_NAME,array('attributes'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Products/attributes">
                                    <i class="fas fa-circle"></i>Product Attributes
                                    </a>
                                </li>

                                <li class="<?php echo in_array($CLASS_NAME,array('products')) && in_array($METHOD_NAME,array('subscribeEmail'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Products/subscribeEmail">
                                    <i class="fas fa-circle"></i>Subscribe Email
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('products')) && in_array($METHOD_NAME,array('estimates'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Products/estimates">
                                    <i class="fas fa-circle"></i>Product Estimates
                                    </a>
                                </li>
                            </ul>
                        </li>
                       <li class="treeview <?php if(in_array($CLASS_NAME,array('users'))) echo 'active'?>">
                            <a href="javascript:void()">
                            <i class="fas fa-user-friends"></i>
                            <span>Customer Management</span>
                            <i class="fas fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('users')) && in_array($METHOD_NAME,array('index')) && !in_array($PARAMETER_NAME,array('active','inactive')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Users">
                                    <i class="fas fa-circle"></i>All Customers
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('users')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('active')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Users/index/active">
                                    <i class="fas fa-circle"></i>Active Customers
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('users')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('inactive')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Users/index/inactive">
                                    <i class="fas fa-circle"></i>Inactive Customers
                                    </a>
                                </li>
								<li class="<?php echo in_array($CLASS_NAME,array('users')) && in_array($METHOD_NAME,array('preferredCustomer')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Users/preferredCustomer">
                                    <i class="fas fa-circle"></i>Preferred Customer
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php if(in_array($CLASS_NAME,array('orders'))) echo 'active'?>">
                            <a href="javascript:void()">
                            <i class="fas fa-sync-alt"></i>
                            <span>Orders Management</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('createOrder')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/createOrder">
                                    <i class="fas fa-circle"></i>Create Orders
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('all')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/all">
                                    <i class="fas fa-circle"></i>All Orders
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('New')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/<?php echo getOrderSatus(2)?>">
                                    <i class="fas fa-circle"></i>New Orders
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('Processing')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/<?php echo getOrderSatus(3)?>">
                                    <i class="fas fa-circle"></i>Processing Orders
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('Shipped')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/<?php echo getOrderSatus(4)?>">
                                    <i class="fas fa-circle"></i>Shipped Orders
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('Delivered')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/<?php echo getOrderSatus(5)?>">
                                    <i class="fas fa-circle"></i>Delivered Orders
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('orders')) && in_array($METHOD_NAME,array('index')) && in_array($PARAMETER_NAME,array('Cancelled')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Orders/index/<?php echo getOrderSatus(6)?>">
                                    <i class="fas fa-circle"></i>Cancelled Orders
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="treeview <?php echo in_array($CLASS_NAME,array('categories')) ? 'active':''?>">
                            <a href="javascript:void()">
                              <i class="fas fa-th-large"></i>
                                <span>Category Management</span>
                              <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('categories')) && in_array($METHOD_NAME,array('index')) && !in_array($PARAMETER_NAME,array('menu','subcategories')) ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Categories">
                                      <i class="fas fa-circle"></i>Categories
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('categories')) && in_array($METHOD_NAME,array('subcategories'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Categories/SubCategories">
                                      <i class="fas fa-circle"></i>Sub Categories
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo in_array($CLASS_NAME,array('pages', 'sections', 'banners', 'services')) ? 'active':''?>">
                            <a href="javascript:void(0)">
                            <i class="fab fa-product-hunt"></i>
                            <span>Content Management</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('pages')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Pages">
                                    <i class="fas fa-circle"></i>Pages
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('banners')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                  <a href="<?php echo $BASE_URL_ADMIN ?>Banners">
                                    <i class="fas fa-circle"></i>Banners
                                  </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('services')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Services">
                                    <i class="fas fa-circle"></i>Services
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('sections')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Sections">
                                    <i class="fas fa-circle"></i>Home Page Sections
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview <?php echo in_array($CLASS_NAME,array('discounts')) ? 'active':''?>">
                            <a href="javascript:void(0)">
                            <i class="fab fa-product-hunt"></i>
                            <span>Discount & Promotion Management</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('discounts')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Discounts/addEdit">
                                    <i class="fas fa-circle"></i>Create Discount Coupon
                                    </a>
                                </li>
                                <li class="<?php echo in_array($CLASS_NAME,array('discounts')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Discounts/index">
                                    <i class="fas fa-circle"></i>Manage Discount
                                    </a>
                                </li>
                            </ul>
                        </li>

                        <li class="treeview <?php echo in_array($CLASS_NAME,array('Accounts','configrations')) ? 'active':''?>">
                            <a href="javascript:void(0)">
                            <i class="fas fa-cog"></i>
                            <span>Settings</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="<?php echo in_array($CLASS_NAME,array('Accounts')) && in_array($METHOD_NAME,array('changePassword'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Accounts/changePassword">
                                    <i class="fas fa-circle"></i>Change Password
                                    </a>
                                </li>

                                <li class="<?php echo in_array($CLASS_NAME,array('configrations')) && in_array($METHOD_NAME,array('index'))  ? 'active':''?>">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Configrations">
                                    <i class="fas fa-circle"></i>Site Configrations
                                    </a>
                                </li>

                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="javascript:void(0)">
                            <i class="fas fa-cog"></i>
                            <span>Manage Store</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="">
                                    <a href="#">
                                    <i class="fas fa-circle"></i>Printing.coop
                                    </a>
                                </li>

                                <li class="">
                                    <a href="#">
                                    <i class="fas fa-circle"></i>fr.imprimeur.coop
                                    </a>
                                </li>
                            </ul>
                        </li>
                        <li class="treeview">
                            <a href="javascript:void(0)">
                            <i class="fas fa-cog"></i>
                            <span>Manage Sub Admin</span>
                            <i class="fa fa-chevron-left pull-right"></i>
                            </a>
                            <ul class="treeview-menu">
                                <li class="">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Accounts">
                                    <i class="fas fa-circle"></i>All Sub Admin List
                                    </a>
                                </li>
								 <li class="">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Accounts/index/active">
                                    <i class="fas fa-circle"></i> Active Sub Admin List
                                    </a>
                                </li>
								<li class="">
                                    <a href="<?php echo $BASE_URL_ADMIN ?>Accounts/index/inactive">
                                    <i class="fas fa-circle"></i> Inactive Sub Admin List
                                    </a>
                                </li>

                            </ul>
                        </li>-->
                        <li class="treeview">
                            <a href="<?php echo $BASE_URL_ADMIN ?>Accounts/logout">
                            <i class="fa fa-unlock-alt"></i> <span>Logout</span>
                            </a>
                        </li>
                    </ul>
                </section>
                <!-- /.sidebar -->
            </aside>
        </div>

<div id="loder-img"><div id="loder-img-inner"><img src="<?php echo $BASE_URL;?>assets/images/loder.gif" width="100"></div></div>