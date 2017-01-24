<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
    

    include("../data/TBL_PRODUCT_CATEGORY.php");
    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->listallparent();
    $list_category = $mainObj["data"];

    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->getdetails($id);
    $details = $mainObj;


    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];
    unset($mainObj); 
    
    include BASE_DIR.'include/utility.php'; 
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
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form name="frm_category" method="post" id="frm_category" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="x_title">
                            <h2>Add New Category</h2>
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                 <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <button type="button" frm_id="frm_category" call_link="<?=SERVER_PATH?>controller/controller.php?method=editproductcat-API&is_close=0" 
                                        name="btn_save" class="btn btn-success edit_show_message" >Save</button>

                                <button type="button" frm_id="frm_category" call_link="<?=SERVER_PATH?>controller/controller.php?method=editproductcat-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                <button  call_url="<?=SERVER_PATH?>view/manage_category.php" type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary">Cancel</button>        
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">                       
                           <div class="col-md-6">

                                <div class="form-group alert alert-success frm_error_message" >
                                                                     
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Category Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input name="cat_id" value="<?=$details['prc_id']?>" id="cat_id" type="hidden">

                                        <input value="<?=$details['name']?>" type="text" name="cat_name" required="required" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Set parent</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <select class="form-control" name="parent_cat_id" id="parent_cat_id" >
                                            <option value="0" >None</option>
                                            <?php
                                                foreach ($list_category as $key => $arr_val) {
                                            ?>
                                                <option value="<?=$arr_val['prc_id']?>" ><?=$arr_val["name"]?></option>
                                            <?php
                                                  $html = Utility::categorySelectHtml($arr_val['prc_id'], $arr_val["name"], "");
                                                  echo $html;
                                                }
                                            ?>
                                        </select>

                                        <script type="text/javascript">
                                          var option = <?=$details['parent_cat_id']?>;
                                          $("#parent_cat_id").val(option);
                                          //alert(<?=$details['prc_id']?>);
                                        </script>
                                    </div>
                                </div>

                                <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish on Website</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                      <select class="select2_multiple form-control" multiple="multiple" name="publish_on[]" >
                                          <option>Choose option</option>
                                            <?php
                                                $arr_publish_on = explode(',', $details['publish_on']);
                                                foreach ($list_website as $key => $arr_val) {
                                            ?>
                                                <option <?=(in_array($arr_val['web_id'],$arr_publish_on)) ? "selected" : ""?> value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                                            <?php
                                                }
                                            ?>
                                      </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <img src="../<?=$details['image']?>" class="uploaded_img hide_after_save" id="cat_logo_output" style="display:block;" />
                                        <input name="cat_logo_path" value="<?=$details['image']?>" id="cat_logo_path" type="hidden">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Category Image</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12 upload_image" name="file_image" type="file"
                                             image_id="cat_logo_path" image_output_id="cat_logo_output" frm_id="frm_category" />
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sort Order</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="cat_sort_order" value="<?=$details['sort_order']?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Note</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" name="cat_note" value="<?=$details['note']?>" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <div class="radio">
                                            <label>
                                                <input type="radio" <?=($details["is_active"] == 1)? "checked" : ""?> value="1" id="cat_is_active" name="cat_is_active">Active
                                            </label>
                                        </div>

                                        <div class="radio">
                                            <label>
                                                <input type="radio" <?=($details["is_active"] == 0)? "checked" : ""?> value="0" id="cat_is_active" name="cat_is_active"> Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                
                            </div>
                            <!-- end col-md-6 -->
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
</body>

</html>
