<?php
    //include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];
    $list_website1 = $list_website;
?>
<div class="unqiue-website" role="tabpanel" data-example-id="togglable-tabs">
   <ul id="web_myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <?php
        foreach ($list_website as $key => $arr_value) {
          $is_active = ($key == 0) ? "active" : "";
          $type_class = ($arr_value['type'] == 1) ? 'tab_retail' : 'tab_informative';
      ?>
      <li role="presentation" id="web_tab<?=$arr_value['web_id']?>" class="<?=$is_active?>  <?=$type_class?>" >
        <a href="#web_tab_content<?=$arr_value['web_id']?>" id="web1-tab" role="tab" data-toggle="tab" aria-expanded="true"><?=$arr_value['name']?></a>
      </li>
      <?php
        }
      ?>
   </ul>
   <div id="myTabContent2" class="tab-content">
      <?php
        include("../data/TBL_PRODUCT_UNIQUE.php");
        include("../data/TBL_PRODUCT_IMAGES_UNIQUE.php");
        include("../data/TBL_PRODUCT_SPECIAL_PROP_UNIQUE.php");
        include("../data/TBL_PRODUCT_FILES_UNIQUE.php");
        include("../data/TBL_PRODUCT_FEATURES_UNIQUE.php");
        
        foreach ($list_website1 as $key => $arr_value) {
          $is_active = ($key == 0) ? "active in" : "";
          $web_id = $arr_value["web_id"];

          $objInstance = new TBL_PRODUCT_UNIQUE();
          $mainObj = $objInstance->getdetails($product_id, $web_id);
          $details = $mainObj;
          if(empty($details)){
            $details = array(          
              'unique_product_id' => '',
              'product_id' => $product_id,
              'web_id' => $web_id,
              'prc_id' => '',
              'name' => '',
              'code' => '',
              'sku' => '',
              'country_id' => '',
              'sell_on' => '',
              'alise' => '',
              'alttag' => '',
              'type' => '',
              'price' => '',
              'discount' => '',
              'model' => '',
              'color' => '',
              'is_active' => 0,
              'image' => '',
              'short_description' => '',
              'long_description' => '',
              'video_link' => '',
              'video2' => '',
              'video3' => '',
              'created_on' => '',
              'updated_on' => ''
            );
          }
      ?>
      <div role="tabpanel" class="tab-pane fade <?=$is_active?>" id="web_tab_content<?=$arr_value['web_id']?>" aria-labelledby="web1-tab">
         <h2 class="text-center"><?=$arr_value['name']?>
            <?php
              if(!empty($details['unique_product_id'])){
            ?>
              <a href="#" class="pull-right btn btn-danger btn-xs btn_delete" 
                  call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteuniqueproduct-API&id=<?php echo $details['unique_product_id']; ?>" >
                    <i class="fa fa-trash-o"></i> 
                Delete 
              </a>
            <?php
              }
            ?>
         </h2>
         <hr>
        <?php 
          $web_id = $arr_value["web_id"];
          include BASE_DIR.'view/product_edit_unique_basic_inner.php'
        ?>            
        <input type="hidden" name="websites[]" value="<?=$web_id?>"    /> 
      </div>
      <!-- end web_tab_content1 -->
      <?php
        }
      ?>
   </div>
</div>
<!-- end unqiue-website -->  