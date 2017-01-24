<?php include('./include/head.php'); ?>

<body>
    <?php include('./include/header.php'); ?>

    <?php
        include('./include/LocalDB.php');
        $blog_id = isset($_REQUEST['blog']) ? $_REQUEST['blog'] : ''; 
            //echo $product_id;
        $blog = LocalDB::getBlogDetails($blog_id);
        if(empty($blog_id) || empty($blog)){
            echo "Product not present";
    ?>
                <script type="text/javascript">
                    document.location = "404.php";
                </script>
        <?php

        } else {     
    ?>

    <div id="page-header" class="content-contrast">
        <div class="page-title-container">
            <div class="background-overlay"></div>
            <div class="container centered-container">    
                <div class="centered-inner-container">
                    <h1 class="page-title"><?=$blog['title']?></h1>
                    <ul class="post-meta">
                        <li><i class="fa fa-calendar" aria-hidden="true"></i><?=date('d M Y', strtotime($blog['created_on']))?></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <a class="breadcrumb-item" href="#">Blog</a>
                            <span class="breadcrumb-item active">Single Post</span>
                        </nav>                    
                    </div>
                </div>
            </div>            
        </div>
    </div>
    
    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-12">
                    <article class="post-item single-post">
                        <div class="post-media">
                            <img src="<?=$blog['image']?>" alt="Blog Image" style="width:100%;" /> 
                        </div>
                        
                        <div class="post-container">
                            <div class="post-content">
                                <p>
                                    <?=$blog['html_short'] ?>
                                </p>
                                <hr/>
                                <?=$blog['html_full'] ?>
                            </div>
                        </div>

                        <div class="post-footer">
                            <div class="post-tag pull-left">
                                <a href="#">Share on</a>
                            </div>

                            <ul class="social-icon social-bg-color post-share pull-right">
                                <li><a class="facebook-color" href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a class="twitter-color" href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a class="google-color" href="#"><i class="fa fa-google-plus"></i></a></li>
                                <li><a class="pinterest-color" href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a class="rss-color" href="#"><i class="fa fa-rss"></i></a></li>
                            </ul>
                        </div>

                    </article>
                </div>

                <!-- sidebar -->
                <div class="col-lg-4 col-md-12">
                    <aside class="sidebar">
                        <div class="widget">
                            <div class="promo-box green content-contrast">
                                <div class="heading-title widget-title">
                                    <h5>About ZenGarden</h5>
                                </div>
                                <p>Zen Garden is Garden and Landscape Company, provides all you need to know about Garden and Landscape Design to get better garden decorations.</p>
                            </div>
                        </div>

                        <div class="widget">
                            <div class="heading-title widget-title">
                                <h5>Recent Post</h5>
                            </div>
                            <ul class="popular-widget">
                                <?php

                                $blogList = LocalDB::listAllBlogs($blog['type']);
                                foreach ($blogList as $key => $ind_blog) {
                                    # code...
                                ?>
                                <li>
                                    <a href="#">    
                                        <img src="<?=$ind_blog['image']?>" alt="Popular Image">
                                        <div class="popular-description">
                                            <p><?=$ind_blog['title']?></p>
                                        </div>
                                    </a>
                                </li>
                                <?php
                                    }
                                ?>
                            </ul>
                        </div>

                    </aside>
                </div>
                <!-- sidebar end here -->
            </div>
        </div>
    </div>
   <?php
    }
   ?>
    <?php include('include/footer.php'); ?>

    <?php include('include/footer_script.php'); ?>



</body>

<!-- Mirrored from themedemo.foundstrap.com/zengarden/single-post.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 18:33:27 GMT -->
</html>