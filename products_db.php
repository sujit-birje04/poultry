
    <?php include('./include/head.php'); ?>
<body>
    <?php include('./include/header.php'); ?>

    <div id="page-header" class="content-contrast" >
        <div class="page-title-container" style="background:url(./img/product-page-header.jpg)">    
            <div class="background-overlay"></div>
            <div class="container centered-container">    
                <div class="centered-inner-container">
                    <h1 class="page-title">Our Services</h1>
                    <hr class="separator small-separator">
                    <div class="heading-caption">We are Expert In All Aspect of Garden and Landscape Design</div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Services</span>
                        </nav>                    
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="service-grid grid-lg-3 grid-md-2 grid-sm-2 no-wrap equal-height">

                        <?php
                        include('./include/LocalDB.php');
                        $productList = LocalDB::listAllProducts();
                        foreach ($productList as $key => $product) {
                            # code...
                        ?>
                        <li>
                            <div class="img-service">
                                <a href="lawn-garden-maintenance.html">    
                                    <div class="overlay-background"></div>
                                    <img src="<?=$product['image']?>" alt="service image">
                                </a>
                            </div>
                            <hr class="separator">
                            <h5 class="title">
                                <a href="single-product.php?q=<?=$product['alise']?>"><?=$product['name']?></a>
                            </h5>
                            <p><?=$product['short_description']?></p>                            
                            <a class="btn btn-sm btn-default" href="single-product.php?q=<?=$product['alise']?>">Read More</a>
                        </li>
                        <?php
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </div>
    </section>
    
    

    <?php include('include/footer.php'); ?>

    <?php include('include/footer_script.php'); ?>


</body>

<!-- Mirrored from themedemo.foundstrap.com/zengarden/services.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 18:31:05 GMT -->
</html>
