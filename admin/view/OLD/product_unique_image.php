<?php
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
      ?>
      <li role="presentation" class="<?=$is_active?>" >
        <a href="#web_tab_content_image<?=$arr_value['web_id']?>" id="web1-tab" role="tab" data-toggle="tab" aria-expanded="true"><?=$arr_value['name']?></a>
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
      <div role="tabpanel" class="tab-pane fade <?=$is_active?>" id="web_tab_content_image<?=$arr_value['web_id']?>" aria-labelledby="web1-tab">
         <h2 class="text-center"><?=$arr_value["name"]?></h2>
         <hr>
          <?php 
            $html = Utility::getProductImageHtml($arr_value["web_id"]);
            echo $html; 
          ?>                    
      </div>
      <?php
        }
      ?>
      <!-- end web_tab_content1 -->
   </div>
</div>
<!-- end unqiue-website -->  