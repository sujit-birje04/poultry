<div class="unqiue-website" role="tabpanel" data-example-id="togglable-tabs">
   <ul id="web_myTab" class="nav nav-tabs bar_tabs" role="tablist">
      <li role="presentation" class="active"><a href="#web_tab_content1" id="web1-tab" role="tab" data-toggle="tab" aria-expanded="true">Equator Appliances</a>
      </li>
      <li role="presentation" class=""><a href="#web_tab_content2" role="tab" id="web2-tab" data-toggle="tab" aria-expanded="false">Pinnacle Combos</a>
      </li>
      <li role="presentation" class=""><a href="#web_tab_content3" role="tab" id="web3-tab2" data-toggle="tab" aria-expanded="false">Indoor Appliances</a>
      </li>
   </ul>

   <div id="myTabContent2" class="tab-content">
      <div role="tabpanel" class="tab-pane fade active in" id="web_tab_content1" aria-labelledby="web1-tab">
         <h2 class="text-center">Equator Appliances</h2>
         <hr>
        <?php include BASE_DIR.'include/product_unique.php'; ?>                   
         
      </div>
      <!-- end web_tab_content1 -->


      <div role="tabpanel" class="tab-pane fade" id="web_tab_content2" aria-labelledby="web2-tab">
          <h2 class="text-center">Pinnacle Combos</h2>
          <hr>
          <?php include BASE_DIR.'include/product_unique.php'; ?>                  
         
      </div>
      <!-- end web_tab_content1 -->


      <div role="tabpanel" class="tab-pane fade" id="web_tab_content3" aria-labelledby="web3-tab">
          <h2 class="text-center">Indoor Appliances</h2>
          <hr>
          <?php include BASE_DIR.'include/product_unique.php'; ?>                  
         
      </div>
      <!-- end web_tab_content1 -->

      
   </div>
</div>
<!-- end unqiue-website -->  