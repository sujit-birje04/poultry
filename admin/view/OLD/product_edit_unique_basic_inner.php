<?php
    //include("../data/TBL_PRODUCT_CATEGORY.php");
    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->listallparent();
    $list_category = $mainObj["data"];

    //include("../data/TBL_COUNTRY.php");
    $objCountry = new TBL_COUNTRY();
    $mainObj = $objCountry->listall();
    $list_city = $mainObj["data"];
    //echo $web_id;
    //include("../include/utility.php");
    if(!empty($details['unique_product_id'])){
?>
    <script type="text/javascript">
      $("#web_tab<?=$arr_value['web_id']?>").addClass('highlight_tab');
    </script>
<?php
    }
?>


<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Unique Product ID <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" readonly value="<?=$details['unique_product_id']?>" name="productUnique[<?=$web_id?>][unique_product_id]" class="form-control col-md-7 col-xs-12" />
        
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Title <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="hidden" value="<?=$details['unique_product_id']?>" class="product_id_hidden" />
        <input type="hidden" value="<?=$details['product_id']?>" name="productUnique[<?=$web_id?>][product_id]" class="product_id_hidden" />
        <input type="text" value="<?=$details['name']?>" name="productUnique[<?=$web_id?>][name]" required="required" class="form-control col-md-7 col-xs-12">
     </div>
  </div>
  <?php
    $type = json_decode($details['type']);
    if(!is_array($type)){
        $type = array($type);
    }
  ?>
  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Type</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productUnique[<?=$web_id?>][type][]" <?=(in_array('1', $type) ? 'Checked' : '')?> value="1" > Residential
              </label>
          </div>
          <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productUnique[<?=$web_id?>][type][]" <?=(in_array('2', $type) ? 'Checked' : '')?> value="2" > Commercial
              </label>
          </div>
          <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productUnique[<?=$web_id?>][type][]" <?=(in_array('3', $type) ? 'Checked' : '')?> value="3" > Industrial
              </label>
          </div>
      </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Code <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['code']?>" name="productUnique[<?=$web_id?>][code]" class="form-control col-md-7 col-xs-12">
     </div>
  </div>

  <?php
    if(!empty($details['alise'])){
  ?>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Alise <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['alise']?>" name="productUnique[<?=$web_id?>][alise]" class="form-control col-md-7 col-xs-12">
     </div>
  </div>
  <?php
    } else {
  ?>
        <input type="hidden" value="<?=$details['alise']?>" name="productUnique[<?=$web_id?>][alise]" class="form-control col-md-7 col-xs-12">
  <?php
    }
  ?>

  <?php
    if(!empty($details['alise'])){
  ?>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Image Alt <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['alttag']?>" name="productUnique[<?=$web_id?>][alttag]" class="form-control col-md-7 col-xs-12">
     </div>
  </div>
  <?php
    } else {
  ?>
      <input type="hidden" value="<?=$details['alttag']?>" name="productUnique[<?=$web_id?>][alttag]" class="form-control col-md-7 col-xs-12">
  <?php
  }
  ?>
  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sell On</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select  style="width:100%;"  class="select2_multiple form-control" multiple="multiple"  name="productUnique[<?=$web_id?>][sell_on][]" >
            <?php
              var_dump($details['sell_on']);
                foreach ($list_website1 as $key => $arr_val) { 
                  $sell_on = explode(',', $details['sell_on']);
                  if(!is_array($sell_on)){
                      $sell_on = array($sell_on);
                  }
            ?>
                <option <?=(in_array($arr_val['web_id'], $sell_on) ? "Selected" : "")?>  value="<?=$arr_val['web_id']?>" ><?=$arr_val["name"]?></option>
            <?php
                }
            ?>    
        </select>
    </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >SKU  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['sku']?>" class="form-control col-md-7 col-xs-12" name="productUnique[<?=$web_id?>][sku]" >
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Model  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['model']?>" class="form-control col-md-7 col-xs-12" name="productUnique[<?=$web_id?>][model]" >
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Color  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['color']?>" class="form-control col-md-7 col-xs-12" name="productUnique[<?=$web_id?>][color]" >
     </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select  style="width:100%;"  class="select2_multiple form-control" multiple="multiple"  name="productUnique[<?=$web_id?>][country][]" >
            <option vlaue="0">Choose Country</option>
            <?php
                $country = json_decode($details['country_id']);
                if(!is_array($country)){
                    $country = array($country);
                }
                foreach ($list_city as $key => $arr_val) {
            ?>
                <option <?=(in_array($arr_val['country_id'], $country) ? "Selected" : "")?>   value="<?=$arr_val['country_id']?>" ><?=$arr_val["name"]?></option>
            <?php
                }
            ?>   
        </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category<span class="required">*</span></label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select id="product_category_<?=$web_id?>" style="width:100%;"   class="select2_multiple form-control" multiple name="productUnique[<?=$web_id?>][category][]" >
            <option>Choose option</option>
            <?php
                $category = json_decode($details['prc_id']);
                if(!is_array($category)){
                    $category = array($category);
                }
                foreach ($list_category as $key => $arr_val) {
            ?>
                <option <?=(in_array($arr_val['prc_id'], $category) ? "Selected" : "")?> value="<?=$arr_val['prc_id']?>" ><?=$arr_val["name"]?></option>
            <?php
                  $html = Utility::categorySelectHtml($arr_val['prc_id'], $arr_val["name"], "");
                  echo $html;
                }
            ?>
        </select>
        <script type="text/javascript">
          var option = [];
          <?php
            foreach ($category as $key => $val) {
          ?>
          option.push(<?=$val?>);
          <?php
            }
          ?>
          $("#product_category_<?=$web_id?>").val(option);
        </script>
    </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Price 
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['price']?>" name="productUnique[<?=$web_id?>][price]" required="required" class="form-control col-md-7 col-xs-12">
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Discount 
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['discount']?>" name="productUnique[<?=$web_id?>][discount]" required="required" class="form-control col-md-7 col-xs-12">
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sort Order 
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['sort_order']?>" name="productUnique[<?=$web_id?>][sort_order]" class="form-control col-md-7 col-xs-12">
     </div>
  </div>
  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <div class="radio-inline">
              <label>
                  <input type="radio" <?=($details['is_active'] == 1? "checked" : "") ?> value="1" name="productUnique[<?=$web_id?>][is_active]"> Active
              </label>
          </div>

          <div class="radio-inline">
              <label>
                  <input type="radio" <?=($details['is_active'] == 0? "checked" : "") ?>  value="0" name="productUnique[<?=$web_id?>][is_active]"> In Active
              </label>
          </div>
      </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Description</label>
     <div class="col-md-9 col-sm-9 col-xs-12">                                                
        <textarea id="message" required="required" class="form-control" name="productUnique[<?=$web_id?>][short_description]" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=$details['short_description']?></textarea>
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Long Description</label>
     <div class="col-md-9 col-sm-9 col-xs-12">                                                
        <textarea id="product_desc_unique_<?=$web_id?>" name="productUnique[<?=$web_id?>][long_description]" placeholder="This will be a HTML Editor" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=$details['long_description']?></textarea>
        <script>
            CKEDITOR.replace('product_desc_unique_<?=$web_id?>', {
               allowedContent:true 
            });
        </script>
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link</label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input value="<?=$details['video_link']?>" name="productUnique[<?=$web_id?>][video]" class="form-control col-md-7 col-xs-12" type="text">
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link2</label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input value="<?=$details['video2']?>" name="productUnique[<?=$web_id?>][video2]" class="form-control col-md-7 col-xs-12" type="text">
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link3</label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input value="<?=$details['video3']?>" name="productUnique[<?=$web_id?>][video3]" class="form-control col-md-7 col-xs-12" type="text">
     </div>
  </div>


  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Features</label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <div class="x_panel">
           <div class="x_title">
              <h2><i class="fa fa-bars"></i> Enter Values</h2>
              <ul class="nav navbar-right panel_toolbox">
                 <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
              </ul>
              <div class="clearfix"></div>
           </div>

           <div class="x_content">
              <div id="feature_wrapper_u_<?=$web_id?>" >
                <?php
                  $objFeature = new TBL_PRODUCT_FEATURES_UNIQUE();
                  $product_feature = $objFeature->productfeatures($details['product_id'], $web_id);
                  $html = '';
                  foreach ($product_feature as $key => $arr_value) {                  
                    $html .= '
                        <div class="form-group" id="feature_inner_'.$key.'">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="hidden" name="EditProductFeatureIdUnique['.$web_id.'][]" value="'.$arr_value['feature_id'].'" />
                            <input type="text" name="EditProductFeatureLableUnique['.$web_id.'][]" value="'.$arr_value['title'].'" placeholder="lable" class="form-control col-md-7 col-xs-12">
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="text" name="EditProductFeatureOrderUnique['.$web_id.'][]" value="'.$arr_value['sort_order'].'" placeholder="Sort Order" class="form-control col-md-7 col-xs-12">
                          </div>
                          <button type="button" class="btn btn-primary btn delete_product_item" wrapper_id="feature_inner_'.$key.'" 
                                  call_link="'.SERVER_PATH.'controller/controller.php?method=deleteuniquefeature-API&id='.$arr_value['feature_id'].'"
                                  counter="'.$key.'"><i class="fa fa-close"></i></button>
                        </div>';
                  }
                  echo $html;
                  
                ?>

              </div>
              <div class="form-group">
                 <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="add_new_feature_lable_u<?=$web_id?>" placeholder="Enter label"   class="form-control col-md-7 col-xs-12">
                 </div>
                 <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="add_new_feature_order_u<?=$web_id?>" placeholder="Sort Order"   class="form-control col-md-7 col-xs-12">
                 </div>
                 <button type="button" counter="0" class="btn btn-success btn add_new_feature_unique" id="add_new_feature_unique"  counter="0" web_id="<?=$web_id?>" ><i class="fa fa-save"></i></button>
              </div>
            </div>
        </div>
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12">Specification</label>
     <div class="col-md-9 col-sm-9 col-xs-12">

        <div class="x_panel">
             <div class="x_title">
                <h2><i class="fa fa-bars"></i> Parameters</h2>
                <ul class="nav navbar-right panel_toolbox">
                   <li><a class="collapse-link"><i class="fa fa-chevron-up"></i></a></li>
                </ul>
                <div class="clearfix"></div>
             </div>

             <div class="x_content">
                <div id="specification_wrapper_u<?=$web_id?>" >
                   <?php
                    //get product related specifications
                    $objSpec = new TBL_PRODUCT_SPECIAL_PROP_UNIQUE();
                    $product_specials = $objSpec->productspecials($details['product_id'], $web_id);
                    $html = '';
                    foreach ($product_specials as $key => $arr_value) {
                      # code...

                      $html .= '
                            <div class="form-group" id="specification_'.$key.'">
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="hidden" value="'.$arr_value['ps_id'].'" name="EditSpecificationIdUnique['.$web_id.'][]" >
                                <input type="text" value="'.$arr_value['name'].'" name="EditSpecificationLableUnique['.$web_id.'][]" class="form-control col-md-7 col-xs-12">
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                <input value="'.$arr_value['value'].'" type="text" name="EditSpecificationValueUnique['.$web_id.'][]" class="form-control col-md-7 col-xs-12">
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                <input value="'.$arr_value['sort_order'].'" type="text" name="EditSpecificationOrderUnique['.$web_id.'][]" class="form-control col-md-7 col-xs-12">
                              </div>
                              <button type="button" wrapper_id="specification_'.$key.'" class="btn btn-primary btn delete_product_item" 
                              call_link="'.SERVER_PATH.'controller/controller.php?method=deleteuniquespecification-API&id='.$arr_value['ps_id'].'" 
                              counter="'.$key.'"><i class="fa fa-close"></i></button>
                            </div>
                      ';
                    }
                    echo $html;
                  ?>

                </div>
                <div class="form-group">
                   <div class="col-md-4 col-sm-4 col-xs-12">
                      <input id="add_new_spec_lable_u<?=$web_id?>" type="text" placeholder="label"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="add_new_spec_value_u<?=$web_id?>"  type="text" placeholder="Value"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="add_new_spec_order_u<?=$web_id?>"  type="text" placeholder="Order"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <button type="button" class="btn btn-success btn add_new_spec_unique"  counter="<?=$key?>" web_id="<?=$web_id?>" ><i class="fa fa-save"></i></button>
                </div>
              </div>
        </div>
     </div>
  </div>


</div>

<div class="col-md-6">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <h2>Upload Product Images</small></h2>
      <div class="product-image">

          <?php
            $is_hide = (empty($details['image'])) ? 'display:none;' : 'display:block;';
          ?>
          <div style="<?=$is_hide?>" class="delete_and_hide_item remove_uploaded_img" input_id="product_image_<?=$web_id?>" output_id="img_product_main_image_<?=$web_id?>" call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteuniqueproductimage-API&id=<?=$details['unique_product_id']?>" >X</div>
          <img id="img_product_main_image_<?=$web_id?>" style="display:block;" class="uploaded_img hide_after_save" name="img_product_main" src="../<?=$details['image']?>" >
          <input type="hidden" value="<?=$details['image']?>" name="productUnique[<?=$web_id?>][image]" id="product_image_<?=$web_id?>"  />
      </div>
      <br/>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input class="form-control col-md-7 col-xs-12 upload_image" name="file_image_<?=$web_id?>" type="file"
            image_id="product_image_<?=$web_id?>" image_output_id="img_product_main_image_<?=$web_id?>" frm_id="frm_product" />
      </div>
  </div>
  <hr class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <h2>Upload Additional Images</small></h2>
      <div class="form-group">
        <div id="comman_image_wrapper" > 
          <div class="product_gallery" id="product_gallery_<?=$web_id?>" >
            <?php
              //get all additional product images
              $objImg = new TBL_PRODUCT_IMAGES_UNIQUE();
              $product_image = $objImg->productimages($details['product_id'], $web_id);
              $html = '';
              foreach ($product_image as $key => $arr_value) {
                $html .= '
                <a  id="additional_unique_image_'.$key.'" >
                  <div wrapper_id="additional_unique_image_'.$key.'" class="delete_product_item remove_uploaded_img" call_link="'.SERVER_PATH.'controller/controller.php?method=deleteuniqueimage-API&id='.$arr_value["p_image_id"].'" >X</div>
                  <input type="hidden" name="editAditionalImageUnique[]" id="" value="'.$arr_value["image_link"].'" >
                  <img src="../'.$arr_value["image_link"].'" class="gallary_images" >
                </a>';
              }
              echo $html;
            ?>
              
          </div>
        </div>
        <input type="file" frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/product_images_unique.php?input_name=additional_image_unique_<?=$web_id?>&web_id=<?=$web_id?>" 
            required="required" output_wrapper="product_gallery_<?=$web_id?>" class="form-control col-md-7 col-xs-12" name="additional_image_unique_<?=$web_id?>" id="product_image_upload_unique" >
      </div>
  </div>

  <hr class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <h2>Upload Additional Files</small></h2>
      <div class="form-group">
        <div id="comman_image_wrapper" > 
          <div class="product_gallery" id="product_file_gallery_<?=$web_id?>" >
            <?php
              
              //get all additional product images
              $objFile = new TBL_PRODUCT_FILES_UNIQUE();
              $product_file = $objFile->productfiles($details['product_id'], $web_id);
              $html = '';
              foreach ($product_file as $key => $arr_value) {
                $html .= '
                <a  id="additional_unique_file_'.$key.'" >
                  <div wrapper_id="additional_unique_file_'.$key.'" class="delete_product_item remove_uploaded_img" call_link="'.SERVER_PATH.'controller/controller.php?method=deleteuniquefile-API&id='.$arr_value["p_file_id"].'" >X</div>
                  <input type="hidden" name="editAditionalFileUnique[]" id="" value="'.$arr_value["file_link"].'" >
                  <i class="gallary_images fa fa-file" ></i>
                  <div class="lbl_file_gallary" >'.$arr_value["description"].'</div>
                </a>';
              }
              echo $html;
              
            ?>
              
          </div>
        </div>
        <input type="file" frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/product_file_unique.php?input_name=additional_file_unique_<?=$web_id?>&web_id=<?=$web_id?>" 
            required="required" output_wrapper="product_file_gallery_<?=$web_id?>" class="form-control col-md-7 col-xs-12" name="additional_file_unique_<?=$web_id?>" id="product_image_upload_unique" >
      </div>
  </div>
</div>

<div  class="col-md-10">
  <!--- Specification removed from here-->
</div>