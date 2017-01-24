
</head>

<body class="nav-md">
<!-- container body, .main_container end in footer.php-->
    <div class="container body">
        <div class="main_container">


           <div class="col-md-3 left_col">
                <div class="left_col scroll-view">

                    <div class="navbar nav_title" style="border: 0;">
                        <a href="index.php" class="site_title"><i class="fa fa-paw"></i> <span>Poultry Farm</span></a>
                    </div>
                    <div class="clearfix"></div>

                    <!-- menu prile quick info -->
                    <div class="profile">
                        <div class="profile_pic">
                            <img src="<?=SERVER_PATH?>images/user.png" alt="..." class="img-circle profile_img">
                        </div>
                        <div class="profile_info">
                            <span>Welcome, <?=$user_data["fname"]." ".$user_data["lname"]?></span>
                            <h2><?=($user_data["user_type"] == 2 ? "Admin" : "Manager") ?></h2>
                        </div>
                    </div>
                    <!-- /menu prile quick info -->

                    <br />

                    <!-- sidebar menu -->
                    <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">

                        <div class="menu_section">
                            <h3>General</h3>
                            <ul class="nav side-menu">
                                <li>
                                    <a><i class="fa fa-bar-chart-o"></i>User Manager<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">                                       
                                        <li><a href="manage_user.php">Manage User</a></li>
                                        <li><a href="add_new_user.php">Add New</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-bar-chart-o"></i>Product Manager<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">                                       
                                        <li><a href="manage_product.php">Manage Product</a></li>
                                        <li><a href="add_product.php">Add New</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-bar-chart-o"></i>Customer Manager<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_customer" style="display: none">                                       
                                        <li><a href="manage_customer.php">Manage Customer</a></li>
                                    </ul>
                                </li>
                                <li>
                                    <a><i class="fa fa-bar-chart-o"></i>ContactUs Manager<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">                                       
                                        <li><a href="manage_contactus.php">Manage ContactUs</a></li>
                                        <!--<li><a href="add_contactus.php">Add New</a></li>-->
                                    </ul>
                                </li>
                                 <li>

                                  <li>
                                    <a><i class="fa fa-bar-chart-o"></i>Enquiry Manager<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">                                       
                                        <li><a href="manage_enquiry.php">Manage Enquiry</a></li>
                                        <!--<li><a href="add_enquiry.php">Add New</a></li>-->
                                    </ul>
                                </li>
                                 <li>
                                    <a><i class="fa fa-bar-chart-o"></i>Blog Manager<span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu" style="display: none">                                       
                                        <li><a href="manage_blog.php">Manage Blog</a></li>
                                        <li><a href="add_blog.php">Add New</a></li>
                                    </ul>
                                    
                                </li>
                            </ul>
                        </div>
                        
                    </div>
                    <!-- /sidebar menu -->

                    <!-- /menu footer buttons -->
                    <div class="sidebar-footer hidden-small">
                        <a data-toggle="tooltip" data-placement="top" href="<?=SERVER_PATH?>controller/controller.php?method=logout-API" title="Logout">
                            <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
                        </a>
                    </div>
                    <!-- /menu footer buttons -->
                </div>
            </div>
            <!-- left_col -->

            <!-- top navigation -->
            <div class="top_nav">

                <div class="nav_menu">
                    <nav class="" role="navigation">
                        <div class="nav toggle">
                            <a id="menu_toggle"><i class="fa fa-bars"></i></a>
                        </div>

                        <ul class="nav navbar-nav navbar-right">
                            <li class="">
                                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <img src="<?=SERVER_PATH?>images/user.png" alt="">Admin
                                    <span class=" fa fa-angle-down"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-usermenu animated fadeInDown pull-right">
                                    <li><a href="<?=SERVER_PATH?>controller/controller.php?method=logout-API"><i class="fa fa-sign-out pull-right"></i> Log Out</a>
                                    </li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>

            </div>
            <!-- /top navigation -->