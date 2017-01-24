                <footer>
                    <div class="">
                        <p class="pull-right">Copyright @ 2016
                            <span class="lead"> <i class="fa fa-paw"></i>Bedmutha</span>
                        </p>
                    </div>
                    <div class="clearfix"></div>
                </footer>
                
            </div>
            <!-- page content right_col - opens in file-->
        </div>
        <!-- main_container - opens in header.php-->
    </div>
    <!--container body  opens in header.php-->

    <div id="custom_notifications" class="custom-notifications dsp_none">
        <ul class="list-unstyled notifications clearfix" data-tabbed_notifications="notif-group">
        </ul>
        <div class="clearfix"></div>
        <div id="notif-group" class="tabbed_notifications"></div>
    </div>

    <script src="<?=SERVER_PATH?>js/bootstrap.min.js"></script>
    <!-- chart js -->
    <script src="<?=SERVER_PATH?>js/chartjs/chart.min.js"></script>
    <!-- bootstrap progress js -->
    <script src="<?=SERVER_PATH?>js/progressbar/bootstrap-progressbar.min.js"></script>
    <script src="<?=SERVER_PATH?>js/nicescroll/jquery.nicescroll.min.js"></script>
    <!-- icheck -->
    <script src="<?=SERVER_PATH?>js/icheck/icheck.min.js"></script>
     <!-- tags -->
    <script src="<?=SERVER_PATH?>js/tags/jquery.tagsinput.min.js"></script>
    <!-- daterangepicker -->
    <script type="text/javascript" src="<?=SERVER_PATH?>js/moment.min.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/datepicker/daterangepicker.js"></script>
    <!-- richtext editor -->
    <script src="<?=SERVER_PATH?>js/editor/bootstrap-wysiwyg.js"></script>
    <script src="<?=SERVER_PATH?>js/editor/external/jquery.hotkeys.js"></script>
    <script src="<?=SERVER_PATH?>js/editor/external/google-code-prettify/prettify.js"></script>
    <!-- select2 -->
    <script src="<?=SERVER_PATH?>js/select/select2.full.js"></script>
    <!-- form validation -->
    <script type="text/javascript" src="<?=SERVER_PATH?>js/parsley/parsley.min.js"></script>
    <!-- textarea resize -->
    <script src="<?=SERVER_PATH?>js/textarea/autosize.min.js"></script>
    <script>
        autosize($('.resizable_textarea'));
    </script>

    <script src="<?=SERVER_PATH?>js/custom.js"></script>

    <!-- flot js -->
    <!--[if lte IE 8]><script type="text/javascript" src="js/excanvas.min.js"></script><![endif]-->
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.pie.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.orderBars.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.time.min.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/date.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.spline.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.stack.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/curvedLines.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/flot/jquery.flot.resize.js"></script>
    

    <!-- worldmap -->
    <script type="text/javascript" src="<?=SERVER_PATH?>js/maps/jquery-jvectormap-2.0.1.min.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/maps/gdp-data.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/maps/jquery-jvectormap-world-mill-en.js"></script>
    <script type="text/javascript" src="<?=SERVER_PATH?>js/maps/jquery-jvectormap-us-aea-en.js"></script>
     <script>
        NProgress.done();
    </script>


     <!-- select2 -->
        <script>
            $(document).ready(function () {
                $(".select2_single").select2({
                    placeholder: "Select a state",
                    allowClear: true
                });
                $(".select2_group").select2({});
                $(".select2_multiple").select2({
                   // maximumSelectionLength: 4,
                   // placeholder: "With Max Selection limit 4",
                    allowClear: true
                });


                var type = $("#menu_type").val();
                $("#menu_type").val(0);
                $("#menu_type").click();
                $("#menu_type").val(type);
                $("#menu_type").click();

            });
        </script>
        <!-- /select2 -->
        <!-- input tags -->
        <script>
            function onAddTag(tag) {
                alert("Added a tag: " + tag);
            }

            function onRemoveTag(tag) {
                alert("Removed a tag: " + tag);
            }

            function onChangeTag(input, tag) {
                alert("Changed a tag: " + tag);
            }

            $(function () {
                $('#tags_1').tagsInput({
                    width: 'auto'
                });
            });
        </script>
        <!-- /input tags -->
        <!-- form validation -->
        <script type="text/javascript">
            $(document).ready(function () {
                $('.date_picker').daterangepicker({
                    singleDatePicker: true,
                    showDropdowns: true,
                    locale: {
                        format: 'MM/DD/YYYY'
                    }
                });

                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form .btn').on('click', function () {
                    $('#demo-form').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });

            $(document).ready(function () {
                $.listen('parsley:field:validate', function () {
                    validateFront();
                });
                $('#demo-form2 .btn').on('click', function () {
                    $('#demo-form2').parsley().validate();
                    validateFront();
                });
                var validateFront = function () {
                    if (true === $('#demo-form2').parsley().isValid()) {
                        $('.bs-callout-info').removeClass('hidden');
                        $('.bs-callout-warning').addClass('hidden');
                    } else {
                        $('.bs-callout-info').addClass('hidden');
                        $('.bs-callout-warning').removeClass('hidden');
                    }
                };
            });
            try {
                hljs.initHighlightingOnLoad();
            } catch (err) {}
        </script>
        <!-- /form validation -->
       


    
    

   
    