<?php include 'include/head.php'; ?>
 <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

</head>

<?php include 'include/header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                     <form id="demo-form2" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Add New Customer</h2>
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <button type="submit" class="btn btn-success">Save & Stay</button>
                                <button type="submit" class="btn btn-warning">Save & Close</button>
                                <button type="submit" class="btn btn-primary">Cancel</button>
                                
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                   
                                   
                        <div class="col-md-6">
                                        
                                        <div class="form-group alert alert-success frm_error_message" >
                                                                             
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Username </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text"    class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                         <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Password </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text"    class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Confirm Password </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="text"    class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>
                                      
                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email Id </label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <input type="email"    class="form-control col-md-7 col-xs-12">
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">User Type</label>
                                            <div class="col-md-6 col-sm-6 col-xs-12">
                                                <select class="form-control" >                                                    
                                                    <option>Manager</option>                        
                                                    <option>Super Admin</option>                                                                             
                                                </select>
                                            </div>
                                        </div>

                                                                          

                                        <div class="form-group">
                                            <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                            <div class="col-md-9 col-sm-9 col-xs-12">
                                               <div class="radio-inline">
                                                    <label>
                                                        <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> Active
                                                    </label>
                                                </div>

                                                <div class="radio-inline">
                                                    <label>
                                                        <input type="radio" checked="" value="option1" id="optionsRadios1" name="optionsRadios"> In Active
                                                    </label>
                                                </div>
                                            </div>
                                        </div>

                        </div>                                

                    </div>
                     </form>
                </div>
                <!-- x_panel -->
            </div>
        </div>


<?php include 'include/footer.php'; ?>    
  <script src="js/star-rating.js" type="text/javascript"></script>  
  <script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled:true
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>      
</body>

</html>
