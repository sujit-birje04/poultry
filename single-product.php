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
                    //document.location = "404.php";
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
                            <a class="breadcrumb-item" href="#">Products</a>
                            <span class="breadcrumb-item active"><?=$product['name']?></span>
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

                            <a href="#enquiry_wrapper" class="btn btn-default btn-block">
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

    
    <section class="section" id="enquiry_wrapper" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <h5 class="text-color">Ask for more infomration</h5>
                    <form class="contact-form" name="contact_form" id="contact_form" action="controller.php" >
                        <input type="hidden" name="method" value="save_enquiry" /> 
                        <input type="hidden" name="next_url" value="single-product.php?q=<?=$q?>" /> 
                        <input type="hidden" name="product_name" value="<?=$product['name']?>" /> 
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group col-sm-6">
                                    <input type="text" name="name" id="name" class="form-control {required:true}" placeholder="Your name">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="email" name="email" id="email" class="form-control {required:true, email:true}" placeholder="Your Email">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="number" name="mobile" id="mobile" class="form-control {required:true, number:true}" placeholder="Your Mobile">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="address" id="address" class="form-control {required:true}" placeholder="Your Address">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="city" id="city" class="form-control {required:true}" placeholder="Your City">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="country" id="country" class="form-control {required:true}" placeholder="Your Country">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="zip" id="zip" class="form-control" placeholder="Your Zipcode">
                                </div>
                                <div class="form-group col-sm-6">
                                    <input type="text" name="fax" id="fax" class="form-control" placeholder="Your Fax">
                                </div>
                            </div>
                            <div class="col-sm-12"> 
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control {required:true}" placeholder="Your Message"></textarea>
                                </div>
                                <div class="col-sm-3">
                                    <button type="button" frm_id="contact_form" id="frm_submit" class=" frm_submit btn btn-default btn-block">Send Message</button>
                                </div>
                            </div>
                        </div>
                        <span class="loading"></span>
                        <div class="success-contact">
                            <div class="alert alert-success">
                                <i class="fa fa-check-circle"></i> Your <strong>Email Send</strong> Thank you.
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    
    <?php include('include/footer.php'); ?>

    <?php include('include/footer_script.php'); ?>

    
</body>

<!-- Mirrored from themedemo.foundstrap.com/zengarden/watering-and-irigation.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 18:32:24 GMT -->
</html>