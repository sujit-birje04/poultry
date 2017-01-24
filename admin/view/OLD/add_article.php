<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    include("../data/TBL_ARTICLE_CATEGORY.php");
    $objArticleCat = new TBL_ARTICLE_CATEGORY();
    $mainObj = $objArticleCat->listallactive();
    $list_category = $mainObj["data"];

    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];

?>

<!-- page content -->
<div class="right_col" role="main">
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
                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertarticle-API&is_close=0" 
                                  name="btn_save" class="btn btn-success save_show_message" >Save</button>

                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertarticle-API&is_close=1"
                                  name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                          <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary" call_url="<?=SERVER_PATH?>view/manage_article.php" >Cancel</button>        
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
                          <input type="text" name="art_title" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Note </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="art_note" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="form-control" name="art_parent_id" >
                              <option>Choose option</option>
                              <?php
                                  foreach ($list_category as $key => $arr_val) {
                              ?>
                                  <option value="<?=$arr_val['ac_id']?>" ><?=$arr_val["title"]?></option>
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
                                    <option value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
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
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Display on Home Page</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="is_featured" checked="" value="1" id="is_featured" > Featured
                                </label>
                            </div>                                                
                        </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Content Short</label>
                       <div class="col-md-9 col-sm-9 col-xs-12">                                                
                          <textarea name="html_content_short" id="html_content_short" rows="10" cols="80"></textarea>
                          <script>
                              CKEDITOR.replace( 'html_content_short', {
                                 allowedContent:true 
                              });
                          </script>
                          <!--<textarea placeholder="This will be a HTML Editor" class="form-control" name="html_content_short" ></textarea>-->
                       </div>
                    </div>
                    <div class="form-group">
                       <label class="control-label col-md-3 col-sm-3 col-xs-12">Content</label>
                       <div class="col-md-9 col-sm-9 col-xs-12">  
                          <textarea name="html_content" id="html_content" rows="100" cols="80"></textarea>
                          <script>
                              CKEDITOR.replace( 'html_content', {
                                 allowedContent:true 
                              });
                          </script>                                              
                          <!--<textarea placeholder="This will be a HTML Editor" class="form-control" name="html_content" ></textarea>-->
                       </div>
                    </div>


                      <div class="form-group">
                          <div class="col-md-12 col-sm-6 col-xs-12">
                              <img src="" class="uploaded_img hide_after_save" id="art_image_output" />
                              <input name="art_image" id="art_image" type="hidden">
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
                          <label class="control-label col-md-3 col-sm-3 col-xs-12" >Video <small>(if any)</small> </label>
                          <div class="col-md-6 col-sm-6 col-xs-12">
                              <input type="text"  name="art_video" class="form-control col-md-7 col-xs-12">
                          </div>
                      </div>


                  </div>
                </div>
              </form>
            </div><!-- x_panel -->
          </div>
      </div>

<?php include '../include/footer.php'; ?>            
</body>

</html>
