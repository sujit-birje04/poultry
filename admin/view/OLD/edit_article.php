<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php

    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
    include("../data/TBL_ARTICLE_CATEGORY.php");
    $objArticleCat = new TBL_ARTICLE_CATEGORY();
    $mainObj = $objArticleCat->listallactive();
    $list_category = $mainObj["data"];
    unset($mainObj);

    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];
    unset($mainObj);

?>

<!-- page content -->
<div class="right_col" role="main">
  <?php
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

    include("../data/TBL_ARTICLE.php");
    $objInstance = new TBL_ARTICLE();
    $mainObj = $objInstance->getdetails($id);
    $details = $mainObj;
    unset($mainObj);

    include("../data/TBL_ARTICLE_PUBLISHED.php");
    $objInstance = new TBL_ARTICLE_PUBLISHED();
    $published_on = $objInstance->listwebsites($details["a_id"]);
?>
   <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
          <div class="x_panel">
              <form id="frm_article" name="frm_article" data-parsley-validate class="form-horizontal form-label-left">
                <div class="x_title">
                    <h2>Add New Article</h2>
                     <div class="form-group">
                        <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                          <div class="btn">
                            <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                          </div>
                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=editarticle-API&is_close=0" 
                                  name="btn_save" class="btn btn-success edit_show_message" >Save</button>

                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=editarticle-API&is_close=1"
                                  name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                          <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_article.php" >Cancel</button>        
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">                                    
                  <div class="col-md-9">
                    
                    <div class="form-group alert alert-success frm_error_message" >
                                                                     
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Article Title </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" value="<?=$details["title"]?>" name="art_title" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" value="<?=$details["a_id"]?>" name="art_id" required="required" >
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Note </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=$details["note"]?>" name="art_note" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="art_parent_id" >
                              <option>Choose option</option>
                              <?php
                                  foreach ($list_category as $key => $arr_val) {
                                      $cat_id =  $details["category"]["ac_id"]; 
                              ?>
                                  <option <?=($cat_id == $arr_val['ac_id']) ? "Selected" : ""?> value="<?=$arr_val['ac_id']?>" ><?=$arr_val["title"]?></option>
                              <?php
                                  }
                              ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish on Website</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_multiple form-control" multiple="multiple" name="web_id[]" >
                              <option>Choose option</option>
                                <?php
                                    foreach ($list_website as $key => $arr_val) {
                                ?>
                                    <option <?=(in_array($arr_val['web_id'],$published_on)) ? "selected" : ""?> value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                                <?php
                                    }
                                ?>
                          </select>
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <div class="radio-inline">
                                <label>
                                    <input <?=($details["is_active"] == 1) ? "Checked" : "" ?> type="radio"  value="1" id="is_active" name="is_active"> Active
                                </label>
                            </div>

                            <div class="radio-inline">
                                <label>
                                    <input <?=($details["is_active"] == 0) ? "Checked" : "" ?> type="radio"  value="0" id="is_active" name="is_active"> In Active
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Display on Home Page</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_featured" <?=($details["is_featured"] == 1) ? "Checked" : "" ?> value="1" id="is_featured" > Featured
                                </label>
                            </div>                                                
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Content</label>
                       <div class="col-md-9 col-sm-9 col-xs-12">                                                
                          <textarea name="html_content_short" id="html_content_short" rows="100" cols="80"><?=$details["html_content_short"]?></textarea>
                          <script>
                              CKEDITOR.replace( 'html_content_short', {
                                 allowedContent:true 
                              });
                          </script> 
                          <!--<textarea placeholder="This will be a HTML Editor" class="form-control" name="html_content_short" ><?=$details["html_content_short"]?></textarea>-->
                       </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                       <div class="col-md-9 col-sm-9 col-xs-12"> 
                          <textarea name="html_content" id="html_content" rows="100" cols="80"><?=$details["html_content"]?></textarea>
                          <script>
                              CKEDITOR.replace( 'html_content', {
                                 allowedContent:true 
                              });
                          </script>                                                
                          <!--<textarea placeholder="This will be a HTML Editor" class="form-control" name="html_content" ><?=$details["html_content"]?></textarea>-->
                       </div>
                    </div>

                      <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Image </label>
                          <div class="col-md-9">
                              <?php
                                $is_hide = (empty($details['image'])) ? 'display:none;' : 'display:block;';
                              ?>
                              <div style="<?=$is_hide?>" class="delete_and_hide_item remove_uploaded_img" input_id="art_image" output_id="art_image_output" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletearticleimage-API&id=<?=$id?>" >X</div>
                              <img style="<?=$is_hide?>" src="../<?=$details['image']?>" class="uploaded_img hide_after_save" id="art_image_output" />
                              <input value="<?=$details['image']?>" name="art_image" id="art_image" type="hidden">
                          </div>
                      </div>

                      <div class="form-group">
                          <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Article Image</label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input class="form-control col-md-7 col-xs-12 upload_image" name="file_image" type="file"
                                   image_id="art_image" image_output_id="art_image_output" frm_id="frm_article" />
                          </div>
                      </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Video </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=$details["video"]?>" name="art_video" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Published date </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=date('m/d/Y', strtotime($details["updated_on"]))?>" name="art_updated_date" class="form-control col-md-7 col-xs-12 date_picker">
                        </div>
                    </div>

                  </div>
                </div>
              </form>
            </div><!-- x_panel -->
          </div>
      </div>
    <?php
    }
    ?>

<?php include '../include/footer.php'; ?>            
</body>

</html>
