<?php include '../include/head.php'; ?>
 <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

</head>

<?php include '../include/header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
    <?php
    
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
    if(empty($id)){
    ?>
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        Please check your input.
                    </div>
            </div>
        </div>
    <?php
    } else {
        include("../data/BLOGS.php");
        $objInstance = new BLOGS();
        $mainObj = $objInstance->getdetails($id);
        $details = $mainObj;
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_user" name="frm_user" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Edit Blog</h2>
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=editblog-API&is_close=0" 
                                        name="btn_save" class="btn btn-success save_show_message" >Save & Stay</button>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=editblog-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_blog.php" >Cancel</button>                                       
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        
                        <div class="x_content">                       
                            <div class="col-md-9">
                                <div class="form-group alert alert-success frm_error_message" >
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Title </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$details['title']?>" name="title" class="form-control col-md-7 col-xs-12">
                                        <input type="hidden" value="<?=$details['blog_id']?>" name="blog_id" >
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Short Html </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="html_short" id="html_short" rows="10" cols="80"><?=$details['html_short']?></textarea>
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
                                        <textarea name="html_full" id="html_full" rows="10" cols="80"><?=$details['html_full']?></textarea>
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
                                            <option value="0" <?=$details['type'] == 0 ? 'selected' : ''?> >choose Type</option>
                                            <option value="1" <?=$details['type'] == 1 ? 'selected' : ''?> >Article</option>
                                            <option value="2" <?=$details['type'] == 2 ? 'selected' : ''?> >Newsletter</option>
                                            <option value="3" <?=$details['type'] == 3 ? 'selected' : ''?> >R & D</option>
                                      </select>
                                  </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sort Code </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$details['sort_code']?>" name="sort_code" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                  <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
                                      <div class="col-md-9">
                                          <?php
                                            $is_hide = (empty($details['image'])) ? 'display:none;' : 'display:block;';
                                          ?>
                                          <div style="<?=$is_hide?>" class="delete_and_hide_item remove_uploaded_img" input_id="image" output_id="image_output" call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteblogimage-API&id=<?=$id?>" >X</div>
                                          <img style="<?=$is_hide?>" src="../../<?=$details['image']?>" class="uploaded_img hide_after_save" id="image_output" />
                                          <input value="<?=$details['image']?>" name="image" id="image" type="hidden">
                                      </div>
                                  </div>

                                  <div class="form-group">
                                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Article Image</label>
                                      <div class="col-md-6 col-sm-6 col-xs-12">
                                          <input class="form-control col-md-7 col-xs-12 upload_image" name="file_image" type="file"
                                               image_id="image" image_output_id="image_output" frm_id="frm_user" />
                                      </div>
                                  </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Video </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=$details['video']?>" name="video" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <input type="hidden" value="<?=date('m/d/Y', strtotime($details['start_date']))?>" name="start_date" id="start_date" >
                                <input type="hidden" value="<?=date('m/d/Y', strtotime($details['end_date']))?>" name="end_date" id="end_date" >
                                <!--
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Start date </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=date('m/d/Y', strtotime($details['start_date']))?>" name="start_date" id="start_date" class="form-control col-md-7 col-xs-12 date_picker">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >End date </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" value="<?=date('m/d/Y', strtotime($details['end_date']))?>" name="end_date" id="end_date" class="form-control col-md-7 col-xs-12 date_picker">
                                    </div>
                                </div>
                                -->
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                       <div class="radio-inline">
                                            <label>
                                                <input type="radio" <?=$details['is_active'] == 1 ? 'checked' : ''?> value="1" id="is_active" name="is_active"> Active
                                            </label>
                                        </div>

                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" <?=$details['is_active'] == 0 ? 'checked' : ''?> value="0" id="is_active" name="is_active"> In Active
                                            </label>
                                        </div>
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
    <?php
        }
    ?>


<?php include '../include/footer.php'; ?>       

<script type="text/javascript">
$("#start_date").datepicker("setDate", "<?=date('d/m/Y', strtotime($details['start_date']))?>");

</script>

</body>

</html>
