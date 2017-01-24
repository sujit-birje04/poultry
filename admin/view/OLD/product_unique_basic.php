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
      <li role="presentation" class="<?=$is_active?> <?=$type_class?>" >
        <a href="#web_tab_content<?=$arr_value['web_id']?>" id="web1-tab" role="tab" data-toggle="tab" aria-expanded="true"><?=$arr_value['name']?></a>
      </li>
      <?php
        }
      ?>
   </ul>
   <div id="myTabContent2" class="tab-content">
      <?php 
        foreach ($list_website1 as $key => $arr_value) {
          $is_active = ($key == 0) ? "active in" : "";
      ?>
      <div role="tabpanel" class="tab-pane fade <?=$is_active?>" id="web_tab_content<?=$arr_value['web_id']?>" aria-labelledby="web1-tab">
         <h2 class="text-center"><?=$arr_value['name']?></h2>
         <hr>
        <?php 
          //$html = Utility::getProductBasicHtml($arr_value['web_id']);
          //echo $html; 
          $web_id = $arr_value["web_id"];
          include BASE_DIR.'view/product_unique_basic_inner.php'
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