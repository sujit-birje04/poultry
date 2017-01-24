<?php
    include("../data/TBL_PRODUCT_CATEGORY.php");
    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->listallparent();
    $list_category = $mainObj["data"];

    include("../data/TBL_COUNTRY.php");
    $objCountry = new TBL_COUNTRY();
    $mainObj = $objCountry->listall();
    $list_city = $mainObj["data"];

    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallretail();
    $list_retail = $mainObj["data"];

?>

<div class="col-md-6">
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product ID  <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$product_id?>" required="required" name="productComman[product_id]" class="form-control col-md-7 col-xs-12" readonly>
     </div>
  </div>
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Title <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" value="<?=$details['name']?>" name="productComman[name]" required="required" class="form-control col-md-7 col-xs-12">
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
                  <input type="checkbox" name="productComman[type][]" <?=(in_array('1', $type) ? 'Checked' : '')?> value="1" > Residential
              </label>
          </div>
          <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productComman[type][]" <?=(in_array('2', $type) ? 'Checked' : '')?> value="2" > Commercial
              </label>
          </div>
          <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productComman[type][]" <?=(in_array('3', $type) ? 'Checked' : '')?> value="3" > Industrial
              </label>
          </div>
      </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Code <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text"  value="<?=$details['code']?>" name="productComman[code]" class="form-control col-md-7 col-xs-12">
        <input type="hidden" value="<?=$details['alise']?>" name="productComman[alise]" class="form-control col-md-7 col-xs-12">
        <input type="hidden"  value="<?=$details['alttag']?>" name="productComman[alttag]" class="form-control col-md-7 col-xs-12">
     </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sell On</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="select2_multiple form-control" multiple="multiple"  name="productComman[sell_on][]" >
            <?php
                foreach ($list_retail as $key => $arr_val) { 
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
        <input type="text"  value="<?=$details['sku']?>" class="form-control col-md-7 col-xs-12" name="productComman[sku]" >
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Model  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text"  value="<?=$details['model']?>" class="form-control col-md-7 col-xs-12" name="productComman[model]" >
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Color  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text"  value="<?=$details['color']?>" class="form-control col-md-7 col-xs-12" name="productComman[color]" >
     </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="select2_multiple form-control" multiple="multiple"  name="productComman[country][]" >
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
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select id="product_category" class="select2_multiple form-control" multiple name="productComman[category][]" >
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
          $("#product_category").val(option);
        </script>
    </div>
  </div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Price 
   </label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text"  value="<?=$details['price']?>" name="productComman[price]" required="required" class="form-control col-md-7 col-xs-12">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Discount 
   </label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text"  value="<?=$details['discount']?>" name="productComman[discount]" required="required" class="form-control col-md-7 col-xs-12">
   </div>
</div>
 <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
       <div class="radio-inline">
            <label>
                <input type="radio" <?=($details['is_active'] == 1? "checked" : "") ?> value="1" name="productComman[is_active]"> Active
            </label>
        </div>

        <div class="radio-inline">
            <label>
                <input type="radio" <?=($details['is_active'] == 0? "checked" : "") ?>  value="0" name="productComman[is_active]"> In Active
            </label>
        </div>
    </div>
</div>

<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Description</label>
   <div class="col-md-9 col-sm-9 col-xs-12">                                                
      <textarea id="message" required="required" class="form-control" name="productComman[short_description]" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=$details['short_description']?></textarea>
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Long Description</label>
   <div class="col-md-9 col-sm-9 col-xs-12">                                                
      <textarea id="product_desc_comman" name="productComman[long_description]" placeholder="This will be a HTML Editor" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"><?=$details['long_description']?></textarea>
      <script>
          CKEDITOR.replace('product_desc_comman', {
             allowedContent:true 
          });
      </script>
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input name="productComman[video]" value="<?=$details['video_link']?>" class="form-control col-md-7 col-xs-12" type="text">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link2</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input name="productComman[video2]" value="<?=$details['video2']?>" class="form-control col-md-7 col-xs-12" type="text">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link3</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input name="productComman[video3]" value="<?=$details['video3']?>" class="form-control col-md-7 col-xs-12" type="text">
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
              <div id="feature_wrapper" >
                <?php
                  include("../data/TBL_PRODUCT_FEATURES.php");
                  $objFeature = new TBL_PRODUCT_FEATURES();
                  $product_feature = $objFeature->productfeatures($details['product_id']);
                  $html = '';
                  foreach ($product_feature as $key => $arr_value) {                  
                    $html .= '
                        <div class="form-group" id="feature_inner_'.$key.'">
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="hidden" name="EditProductFeatureId[]" value="'.$arr_value['feature_id'].'" />
                            <input type="text" name="EditProductFeatureLable[]" value="'.$arr_value['title'].'" placeholder="lable" class="form-control col-md-7 col-xs-12">
                          </div>
                          <div class="col-md-5 col-sm-5 col-xs-12">
                            <input type="text" name="EditProductFeatureOrder[]" value="'.$arr_value['sort_order'].'" placeholder="Sort Order" class="form-control col-md-7 col-xs-12">
                          </div>
                          <button type="button" class="btn btn-primary btn delete_product_item" wrapper_id="feature_inner_'.$key.'" 
                                  call_link="'.SERVER_PATH.'controller/controller.php?method=deletecommanfeature-API&id='.$arr_value['feature_id'].'"
                                  counter="'.$key.'"><i class="fa fa-close"></i></button>
                        </div>';
                  }
                  echo $html;
                  
                ?>

              </div>
              <div class="form-group">
                 <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="add_new_feature_lable" placeholder="Enter label"   class="form-control col-md-7 col-xs-12">
                 </div>
                 <div class="col-md-5 col-sm-5 col-xs-12">
                    <input type="text" id="add_new_feature_order" placeholder="Sort Order"   class="form-control col-md-7 col-xs-12">
                 </div>
                 <button type="button" counter="<?=$key?>" class="btn btn-success btn" id="add_new_feature" ><i class="fa fa-save"></i></button>
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
                <div id="specification_wrapper" >
                  <?php
                    //get product related specifications
                    include("../data/TBL_PRODUCT_SPECIAL_PROP.php");
                    $objSpec = new TBL_PRODUCT_SPECIAL_PROP();
                    $product_specials = $objSpec->productspecials($details['product_id']);
                    $html = '';
                    foreach ($product_specials as $key => $arr_value) {
                      # code...

                      $html .= '
                          <div class="form-group" id="specification_'.$key.'">
                              <div class="col-md-4 col-sm-4 col-xs-12">
                                <input type="hidden" value="'.$arr_value['ps_id'].'" name="EditSpecificationId[]" >
                                <input type="text" value="'.$arr_value['name'].'" name="EditSpecificationLable[]" class="form-control col-md-7 col-xs-12">
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                <input value="'.$arr_value['value'].'" type="text" name="EditSpecificationValue[]" class="form-control col-md-7 col-xs-12">
                              </div>
                              <div class="col-md-3 col-sm-3 col-xs-12">
                                <input value="'.$arr_value['sort_order'].'" type="text" name="EditSpecificationOrder[]" class="form-control col-md-7 col-xs-12">
                              </div>
                              <button type="button" class="btn btn-primary btn delete_product_item" wrapper_id="specification_'.$key.'" 
                                  call_link="'.SERVER_PATH.'controller/controller.php?method=deletecommanspecification-API&id='.$arr_value['ps_id'].'"
                                  counter="'.$key.'"><i class="fa fa-close"></i></button>
                            </div>
                      ';
                    }
                    echo $html;
                  ?>
                  
                </div>
                <div class="form-group">
                   <div class="col-md-4 col-sm-4 col-xs-12">
                      <input id="add_new_spec_lable" type="text" placeholder="Enter label"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="add_new_spec_value"  type="text" placeholder="Value"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <div class="col-md-3 col-sm-3 col-xs-12">
                      <input id="add_new_spec_order"  type="text" placeholder="Order"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <button type="button" class="btn btn-success btn" id="add_new_specification" counter="<?=$key?>" ><i class="fa fa-save"></i></button>
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
          <img id="img_product_main_image" style="display:block;" class="uploaded_img hide_after_save" name="img_product_main" src="../<?=$details['image']?>" >
          <input type="hidden" value="<?=$details['image']?>" name="productComman[image]" id="product_image"  />
      </div>
      <br/>
      <div class="col-md-9 col-sm-9 col-xs-12">
        <input class="form-control col-md-7 col-xs-12 upload_image" name="file_image" type="file"
            image_id="product_image" image_output_id="img_product_main_image" frm_id="frm_product" />
      </div>
  </div>
  <hr class="col-md-12 col-sm-12 col-xs-12">
  <div class="col-md-12 col-sm-12 col-xs-12">
      <h2>Upload Additional Images</small></h2>
      <div class="form-group">
        <div id="comman_image_wrapper" > 
          <div class="product_gallery" id="product_gallery" >
            <?php
              //get all additional product images
              include("../data/TBL_PRODUCT_IMAGES.php");
              $objImg = new TBL_PRODUCT_IMAGES();
              $product_image = $objImg->productimages($details['product_id']);
              $html = '';
              foreach ($product_image as $key => $arr_value) {
                # code...

                $html .= '
                <a id="additional_image_'.$key.'">
                  <div class="delete_product_item remove_uploaded_img" wrapper_id="additional_image_'.$key.'" call_link="'.SERVER_PATH.'controller/controller.php?method=deletecommanimage-API&id='.$arr_value["p_image_id"].'" >X</div>
                  <input type="hidden" name="editAditionalImage[]" id="" value="'.$arr_value["image_link"].'" >
                  <img src="../'.$arr_value["image_link"].'" class="gallary_images" >
                </a>';
              }
              echo $html;
            ?>
              
          </div>
        </div>
        <input type="file" frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/product_images.php" 
            required="required" class="form-control col-md-7 col-xs-12" name="additional_image" id="product_image_upload" >
      </div>
  </div>
</div>

<div  class="col-md-10">
  
</div>