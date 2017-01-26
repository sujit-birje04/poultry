<?php include('./include/head.php'); ?>

<body>
    
    <?php include('./include/header.php'); ?>
    <?php
        include('./include/LocalDB.php');
        $q = isset($_REQUEST['q']) ? $_REQUEST['q'] : ''; 
            //echo $product_id;
        $product = LocalDB::getProductDetails($q);
        if(empty($q) || empty($product)){
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
                    <h1 class="page-title"><?=$product['name']?></h1>
                </div>
            </div>
        </div>
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <a class="breadcrumb-item" href="#">Service</a>
                            <span class="breadcrumb-item active">Watering and Irigation</span>
                        </nav>                    
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <div class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12 col-lg-9">
                    <div class="row">
                        <div class="col-lg-12 col-md-12">
                            <img class="img-radius" src="<?=$product['image']?>" style="width:100%;" alt="image service">
                            <p>
                                <?=$product['long_description']?>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 col-lg-3">
                    <aside class="sidebar">
                        <div class="widget">
                            <div class="heading-title widget-title">
                                <h5>Download Brochures</h5>
                            </div>
                            <a href="#" class="btn btn-default btn-block">
                                <i class="fa fa-file-pdf-o" aria-hidden="true"></i> Download Brochure
                            </a>

                            <a href="#" class="btn btn-default btn-block">
                                <i class="fa fa-file-info-o" aria-hidden="true"></i> Ask more
                            </a>
                        </div>
                    </aside>
                </div>
            </div>
        </div>
    </div>
    <?php
        }
    ?>

    
    
    <?php include('include/footer.php'); ?>

    <?php include('include/footer_script.php'); ?>

    
</body>

<!-- Mirrored from themedemo.foundstrap.com/zengarden/watering-and-irigation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 18:32:24 GMT -->
</html>