<?php
    session_start();
    //var_dump($_SESSION['new_page_message']);
    if(isset($_REQUEST['success'])){
        $returnMessage = json_decode($_SESSION['new_page_message']);
        //var_dump($returnMessage);
        if(!empty($returnMessage)){  
            $msg = $returnMessage->msg;
            $msg_class = ($returnMessage->status == true) ? 'msg_success' : 'msg_error';
        } else {
            $returnMessage = array();
        }
        if(!empty($returnMessage)){
?>
        <div class="<?=$msg_class?> page_info_msg" ><?=$msg?></div>
<?php     
            $_SESSION['new_page_message'] = null;
        }
    }
    
    include('include/Utility.php');
?>


    <header id="header">
        <!-- header-top -->
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="header-info pull-left">
                            <li><i class="fa fa-phone" aria-hidden="true"></i> Phone: +91 83 79 837903</li>
                            <li><a href="mailto:hello@zengarden.com"><i class="fa fa-envelope" aria-hidden="true"></i> hello@econutrivet.com</a></li>
                            <li><i class="fa fa-clock-o" aria-hidden="true"></i> Mon-Fri: 7:00 - 18:00</li>
                        </ul>
                        <div class="pull-right">    
                            <ul class="header-social social-icon">
                                <li><a class="facebook-color" href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a></li>
                                <li><a class="twitter-color" href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a></li>
                                <li><a class="google-color" href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a></li>
                                <li><a class="instagram-color" href="#"><i class="fa fa-instagram" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- header-top end here -->

        <div class="header-main">
            <div class="container">
                <div class="row">
                    <div class="col-md-12" style="height:95px;" >
                        <div class="header-logo">
                            <a href="index.php">
                                <img src="img/logo-all.png" alt="logo">
                                <img class="logo-responsive" src="img/logo-all.png" alt="logo">
                                <img class="logo-sticky" src="img/logo-all.png" alt="logo">
                            </a>
                        </div>
                        <nav class="menu-container">
                            <ul id="menu" class="sm me-menu">
                                <li class="active"><a href="index.php">Home</a></li>
                                <li><a href="company-profile.php">Company Profile</a></li>
                                <li><a href="products.php">Products</a>
                                    <!--
                                    <ul>
                                        <li><a href="single-product.php?q=p1-pellet-binder">pellet Binder</a></li>
                                        <li><a href="single-product.php?q=p2-toxic-binder">Toxic Binder</a></li>
                                        <li><a href="single-product.php?q=p3-insectovat">Insectovate</a></li>
                                    </ul>
                                    -->
                                </li>
                                <li><a href="research-manufacturing.php">RESEARCH & MANUFACTURING</a></li>
                                <li><a href="knowledge-center.php">KNOWLEDGE CENTER</a></li>
                                <!--<li><a href="blog.php">Blogs</a></li>-->
                                <!--
                                <li><a href="blog.php">Blogs</a></li>
                                -->
                                <!--
                                <li><a href="#">Pages</a>
                                    <ul>
                                        <li><a href="about-us.html">About Us</a></li>
                                        <li><a href="team.html">Team</a></li>
                                        <li><a href="testimonial.html">Testimonials</a></li>
                                        <li><a href="pricing-plan.html">Pricing Plans</a></li>
                                        <li><a href="faq.html">FAQ</a></li>
                                        <li><a href="sitemap.html">Sitemap</a></li>
                                        <li><a href="gallery-single.html">Gallery Single</a></li>
                                        <li><a href="404.html">404 Error</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Gallery</a>
                                    <ul>
                                        <li><a href="gallery-2column.html">Gallery 2 Column</a></li>
                                        <li><a href="gallery-3column.html">Gallery 3 Column</a></li>
                                        <li><a href="gallery-4column.html">Gallery 4 Column</a></li>
                                        <li><a href="#">Dropdown Level 1</a>
                                            <ul>
                                                <li><a href="#">Dropdown Level 2</a></li>
                                                <li><a href="#">Dropdown Level 2</a></li>
                                                <li><a href="#">Dropdown Level 2</a>
                                                    <ul>
                                                        <li><a href="#">Dropdown Level 3</a></li>
                                                        <li><a href="#">Dropdown Level 3</a></li>
                                                        <li><a href="#">Dropdown Level 3</a></li>
                                                    </ul>
                                                </li>
                                            </ul>
                                        </li>
                                    </ul>
                                </li>
                                <li><a href="blog.html">Blog</a>
                                    <ul>
                                        <li><a href="blog-sidebar.html">Blog - Sidebar</a></li>
                                        <li><a href="single-post.html">Blog - Single Post</a></li>
                                    </ul>
                                </li>
                                <li class="mega-menu"><a href="#">Mega menu</a>
                                    <ul class="mega-menu">
                                        <li>
                                            <div class="mega-menu-container">
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <h5 class="mega-menu-title">Element</h5>
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <ul class="mega-menu-list">
                                                                    <li><a href="column.html"><i class="fa fa-columns icon-margin"></i>  Column</a></li>
                                                                    <li><a href="button-list.html"><i class="fa fa-list-ul icon-margin"></i> Button &amp; List</a></li>
                                                                    <li><a href="icon-list.html"><i class="fa fa-leaf icon-margin"></i> Icon List</a></li>
                                                                    <li><a href="icon-use.html"><i class="fa fa-flag icon-margin"></i> Icon Use</a></li>
                                                                    <li><a href="feature.html"><i class="fa fa-tags icon-margin"></i> Feature Box</a></li>
                                                                    <li><a href="typography.html"><i class="fa fa-font icon-margin"></i> Typography</a></li>
                                                                </ul>
                                                            </div>
                                                            <div class="col-md-6">
                                                                <ul class="mega-menu-list responsive-no-border">
                                                                    <li><a href="promo-box.html"><i class="fa fa-th-large icon-margin"></i> Promo Box</a></li>
                                                                    <li><a href="table.html"><i class="fa fa-table icon-margin"></i> Table</a></li>
                                                                    <li><a href="tab-accordion.html"><i class="fa fa-archive icon-margin"></i> Tab &amp; Accordion</a></li>
                                                                    <li><a href="alert-progress.html"><i class="fa fa-bar-chart icon-margin"></i> Alert &amp; Progress Bar</a></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5 class="mega-menu-title">Our Servicess</h5>
                                                        <ul class="mega-menu-list me-list arrow-list">
                                                            <li><a href="lawn-garden-maintenance.html">Lawn and Garden Maintenance</a></li>
                                                            <li><a href="decoration-and-landscaping.html">Decoration and Landscaping</a></li>
                                                            <li><a href="design-and-planting.html">Design and Planting</a></li>
                                                            <li><a href="garden-clearance.html">Garden Clearance</a></li>
                                                            <li><a href="stone-hardscaping.html">Stone Hardscaping</a></li>
                                                            <li><a href="watering-and-irigation.html">Watering and Irigation</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <h5 class="mega-menu-title">Quick Link</h5>
                                                        <ul class="mega-menu-list">
                                                            <li><a href="#"><i class="fa fa-users icon-margin"></i> About Us</a></li>
                                                            <li><a href="#"><i class="fa fa-picture-o icon-margin"></i> Our Gallery</a></li>
                                                            <li><a href="#"><i class="fa fa-sticky-note-o icon-margin"></i> Term &amp; Condiitons</a></li>
                                                            <li><a href="#"><i class="fa fa-exclamation-circle icon-margin"></i> Privacy Policy</a></li>
                                                            <li><a href="#"><i class="fa fa-envelope-o icon-margin"></i> Contact</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <h5 class="mega-menu-title">About ZenGarden</h5>
                                                        <div class="mega-menu-content">
                                                            <p>
                                                                Zen Garden is Garden and Landscape Company, provides all you need to know about Garden and Landscape Design for get better garden decorations.
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <img class="mega-menu-img" src="img/megamenu-bg.png" data-position="right bottom" alt="mega menu image">
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                -->
                                <li><a href="contact.php">Contact</a></li>
                            </ul>
                            <!--
                            <div class="additional-menu">
                                <a class="search-btn" href="#"><i class="fa fa-search" aria-hidden="true"></i></a>
                                <div class="search-panel">
                                    <form action="#" class="form-search form-search-rounded">
                                        <div class="input-group-placeholder addon-right">
                                            <input name="search" type="text" class="form-control" placeholder="Search here..">
                                        </div>
                                    </form>
                                </div>
                            </div>
                            -->
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </header>   