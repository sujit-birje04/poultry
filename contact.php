<?php include('./include/head.php'); ?>
<body>
    
    <?php include('./include/header.php'); ?>

    <div id="page-header" class="content-contrast">
        <div class="page-title-container">
            <div class="background-overlay"></div>
            <div class="container centered-container">    
                <div class="centered-inner-container">
                    <h1 class="page-title">Contact Us</h1>
                    <hr class="separator small-separator">
                    <div class="heading-caption">Let's Talk Business, Get in Touch!</div>
                </div>
            </div>
        </div>
        <div class="breadcrumb-container">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <nav class="breadcrumb">
                            <a class="breadcrumb-item" href="#">Home</a>
                            <span class="breadcrumb-item active">Contact</span>
                        </nav>                    
                    </div>
                </div>
            </div>            
        </div>
    </div>

    <section class="section">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-12">
                    <div class="map-wrapper no-margin-lg">
                        <div id="map"></div>
                    </div>
                </div>
                <div class="col-lg-8 col-md-12">
                    <form class="contact-form" name="contact_form" id="contact_form" action="controller.php" >
                        <input type="hidden" name="method" value="save_contact" /> 
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" name="name" id="name" class="form-control {required:true}" placeholder="Your name">
                                </div>
                                <div class="form-group">
                                    <input type="email" name="email" id="email" class="form-control {required:true, email:true}" placeholder="Your Email">
                                </div>
                                <div class="form-group">
                                    <input type="number" name="mobile" id="mobile" class="form-control {required:true, number:true}" placeholder="Your Mobile">
                                </div>
                            </div>
                            <div class="col-sm-6"> 
                                <div class="form-group">
                                    <input type="text" name="subject" id="subject" class="form-control {required:true}" placeholder="Subject">
                                </div>
                                <div class="form-group">
                                    <textarea name="message" id="message" class="form-control {required:true}" placeholder="Your Message"></textarea>
                                </div>
                                <button type="button" frm_id="contact_form" id="frm_submit" class=" frm_submit btn btn-default btn-block">Send Message</button>
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
            <div class="row">
                <div class="col-md-12">
                    <hr class="separator">
                </div>
                <div class="col-md-4">
                    <div class="content-box small left no-margin-lg">    
                        <div class="icon-shape-disable">
                            <i class="fa fa-building-o" aria-hidden="true"></i>
                        </div>                    
                        <h5 class="text-color">Office Address</h5>
                        <p>
                            2158 Madison Avenue <br>
                            Montgomery, AL(Alabama) 36107
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-box small left no-margin-lg">    
                        <div class="icon-shape-disable">
                            <i class="fa fa-clock-o" aria-hidden="true"></i>
                        </div>                    
                        <h5 class="text-color">Office Hours</h5>
                        <p>
                            Monday to Friday : 7:00 - 18:00 <br> 
                            Saturday : 9:00 - 15:00
                        </p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="content-box small left no-margin-lg">    
                        <div class="icon-shape-disable">
                            <i class="fa fa-phone" aria-hidden="true"></i>
                        </div>                    
                        <h5 class="text-color">Phone and Fax</h5>
                        <p>
                            Phone : (111) 234 5678 <br> 
                            Fax : (111) 432 5678
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!--
    <div class="section no-padding">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <div id="map" class="contact-map"></div>
                </div>
            </div>
        </div>
    </div>
    --> 
    <?php include('include/footer.php'); ?>

    <?php include('include/footer_script.php'); ?>


    <script type="text/javascript">
        $(document).ready(function() {
            var map = new GMaps({
                el: '#map',
                lat: 40.776883,
                lng: -73.982504,
                zoom: 17,
                zoomControl : true,
                zoomControlOpt: {
                    style : 'SMALL',
                    position: 'TOP_LEFT'
                },
                panControl : false,
                streetViewControl : false,
                mapTypeControl: false,
                overviewMapControl: false,
                scrollwheel: false
            });

            map.addMarker({
                lat: 40.776883,
                lng: -73.982504,
                icon: "img/map-marker.png"
            });

            var styles = [
            {
                featureType: "road",
                elementType: "geometry",
                stylers: [
                { lightness: 100 },
                { visibility: "simplified" }
                ]
            }, {
                featureType: "road",
                elementType: "labels",
                stylers: [
                { visibility: "off" }
                ]
            }
            ];

            map.addStyle({
                styledMapName:"Styled Map",
                styles: styles,
                mapTypeId: "map_style"  
            });

            map.setStyle("map_style");
        });
    </script>
</body>

<!-- Mirrored from themedemo.foundstrap.com/zengarden/contact.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 17 Jan 2017 18:33:28 GMT -->
</html>