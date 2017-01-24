<?php include '../include/head.php'; ?>
 <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

</head>

<?php include '../include/header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_user" name="frm_user" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Add Blog</h2>
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertblog-API&is_close=0" 
                                        name="btn_save" class="btn btn-success save_show_message" >Save & Stay</button>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertblog-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_blog.php" >Cancel</button>                                       
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-9">

                            <div class="form-group alert alert-success frm_error_message" >
                                         
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Title </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="title" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Short Html </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="html_short" id="html_short" rows="10" cols="80"></textarea>
                                    <script>
                                      CKEDITOR.replace( 'html_short', {
                                         allowedContent:true 
                                      });
                                    </script>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Full Html </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <textarea name="html_full" id="html_full" rows="10" cols="80"></textarea>
                                    <script>
                                      CKEDITOR.replace( 'html_full', {
                                         allowedContent:true 
                                      });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group">
                              <label class="control-label col-md-3 col-sm-3 col-xs-12">Type</label>
                              <div class="col-md-6 col-sm-6 col-xs-12">
                                  <select class="form-control" name="type" >
                                        <option value="0" >choose Type</option>
                                        <option value="1" >Article</option>
                                        <option value="2" >Newsletter</option>
                                        <option value="3" >R & D</option>
                                  </select>
                              </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sort Code </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="sort_code" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 col-sm-6 col-xs-12">
                                  <img src="" class="uploaded_img hide_after_save" id="image_output" />
                                  <input name="image" id="image" type="hidden">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Image</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12 upload_image" name="file_image" type="file"
                                           image_id="image" image_output_id="image_output" frm_id="frm_user" />
                                </div>
                            </div>

                            <!--
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Image </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="sort_code" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            -->

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Video </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="video" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <!--
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Start date </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="" name="start_date" class="form-control col-md-7 col-xs-12 date_picker">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >End date </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="" name="end_date" class="form-control col-md-7 col-xs-12 date_picker">
                                </div>
                            </div>
                            -->
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                <div class="col-md-9 col-sm-9 col-xs-12">
                                   <div class="radio-inline">
                                        <label>
                                            <input type="radio" checked="" value="1" id="is_active" name="is_active"> Active
                                        </label>
                                    </div>

                                    <div class="radio-inline">
                                        <label>
                                            <input type="radio" checked="" value="0" id="is_active" name="is_active"> In Active
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


<?php include '../include/footer.php'; ?>    
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
