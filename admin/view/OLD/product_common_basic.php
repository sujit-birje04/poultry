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
    
    //include("../include/utility.php");
?>

<div class="col-md-6">
  <!--
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product ID  <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text"  required="required" class="form-control col-md-7 col-xs-12" readonly>
     </div>
  </div>
  -->
  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Title <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" name="productComman[name]" required="required" class="form-control col-md-7 col-xs-12">
     </div>
  </div>

  <div class="form-group">
      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product Type</label>
      <div class="col-md-9 col-sm-9 col-xs-12">
         <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productComman[type][]" checked="" value="1" > Residential
              </label>
          </div>
          <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productComman[type][]" checked="" value="2" > Commercial
              </label>
          </div>
          <div class="checkbox-inline">
              <label>
                  <input type="checkbox" name="productComman[type][]" checked="" value="3" > Industrial
              </label>
          </div>
      </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Product Code <span class="required">*</span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" name="productComman[code]" class="form-control col-md-7 col-xs-12">
        <input type="hidden" name="productComman[alise]" class="form-control col-md-7 col-xs-12">
        <input type="hidden" name="productComman[alttag]" class="form-control col-md-7 col-xs-12">
     </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Sell On</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="select2_multiple form-control" multiple="multiple"  name="productComman[sell_on][]" >
            <?php
                foreach ($list_retail as $key => $arr_val) {
            ?>
                <option value="<?=$arr_val['web_id']?>" ><?=$arr_val["name"]?></option>
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
        <input type="text" class="form-control col-md-7 col-xs-12" name="productComman[sku]" >
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Model  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" class="form-control col-md-7 col-xs-12" name="productComman[model]" >
     </div>
  </div>

  <div class="form-group">
     <label class="control-label col-md-3 col-sm-3 col-xs-12" >Color  </span>
     </label>
     <div class="col-md-9 col-sm-9 col-xs-12">
        <input type="text" class="form-control col-md-7 col-xs-12" name="productComman[color]" >
     </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Country</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="select2_multiple form-control" multiple="multiple"  name="productComman[country][]" >
            <option vlaue="0">Choose Country</option>
            <?php
                foreach ($list_city as $key => $arr_val) {
            ?>
                <option value="<?=$arr_val['country_id']?>" ><?=$arr_val["name"]?></option>
            <?php
                }
            ?>    
        </select>
    </div>
  </div>

  <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Select Category</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
        <select class="select2_multiple form-control" multiple name="productComman[category][]" >
            <option>Choose option</option>
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
    </div>
  </div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Price 
   </label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" name="productComman[price]" required="required" class="form-control col-md-7 col-xs-12">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Discount 
   </label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input type="text" name="productComman[discount]" required="required" class="form-control col-md-7 col-xs-12">
   </div>
</div>
 <div class="form-group">
    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
    <div class="col-md-9 col-sm-9 col-xs-12">
       <div class="radio-inline">
            <label>
                <input type="radio" checked="" value="1" name="productComman[is_active]"> Active
            </label>
        </div>

        <div class="radio-inline">
            <label>
                <input type="radio" checked=""  value="1" name="productComman[is_active]"> In Active
            </label>
        </div>
    </div>
</div>

<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Short Description</label>
   <div class="col-md-9 col-sm-9 col-xs-12">                                                
      <textarea id="message" required="required" class="form-control" name="productComman[short_description]" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Long Description</label>
   <div class="col-md-9 col-sm-9 col-xs-12">                                                
      <textarea id="product_desc_comman" name="productComman[long_description]" placeholder="This will be a HTML Editor" class="form-control" data-parsley-trigger="keyup" data-parsley-minlength="20" data-parsley-maxlength="100" data-parsley-minlength-message="Come on! You need to enter at least a 20 caracters long comment.." data-parsley-validation-threshold="10"></textarea>
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
      <input name="productComman[video]" class="form-control col-md-7 col-xs-12" type="text">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link2</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input name="productComman[video2]" class="form-control col-md-7 col-xs-12" type="text">
   </div>
</div>
<div class="form-group">
   <label class="control-label col-md-3 col-sm-3 col-xs-12">Video Link3</label>
   <div class="col-md-9 col-sm-9 col-xs-12">
      <input name="productComman[video3]" class="form-control col-md-7 col-xs-12" type="text">
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
                  
                </div>
                <div class="form-group">
                   <div class="col-md-5 col-sm-5 col-xs-12">
                      <input type="text" id="add_new_feature_lable" placeholder="Enter label"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <div class="col-md-5 col-sm-5 col-xs-12">
                      <input type="text" id="add_new_feature_order" placeholder="Sort Order"   class="form-control col-md-7 col-xs-12">
                   </div>
                   <button type="button" counter="0" class="btn btn-success btn" id="add_new_feature" ><i class="fa fa-save"></i></button>
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
                   <button type="button" class="btn btn-success btn" id="add_new_specification" counter="0" ><i class="fa fa-save"></i></button>
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
          <img id="img_product_main_image" class="uploaded_img hide_after_save" name="img_product_main" src="" >
          <input type="hidden" value="" name="productComman[image]" id="product_image"  />
      </div>
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
              
          </div>
        </div>
        <input type="file" frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/product_images.php" 
            required="required" class="form-control col-md-7 col-xs-12" name="additional_image" id="product_image_upload" >
      </div>
  </div>
</div>

<div  class="col-md-10">
 
</div>