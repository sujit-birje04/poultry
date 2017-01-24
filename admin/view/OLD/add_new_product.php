<?php include '../include/head.php'; ?>
</head>
<?php 
   include BASE_DIR.'include/header.php'; 
   include BASE_DIR.'include/utility.php'; 
?>
<!-- page content -->
<div class="right_col" role="main">
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <form id="frm_product" name="frm_product" data-parsley-validate class="form-horizontal form-label-left">
         <div class="x_title">
            <h2>Add New Product</h2>
            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                 <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_product.php" >Cancel</button>
                 <!--<button type="button" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_product.php">Cancel</button>-->
            </div>
            <div class="clearfix"></div>
         </div>
         <div class="x_content">
           <div class="" role="tabpanel" data-example-id="togglable-tabs">
               <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                  <li role="presentation" class="active product_tab" id="prodcut_comman_tab" >
                     <a href="#tab_content1" id="common-baisc-tab" role="tab" data-toggle="tab" aria-expanded="true">Common Parameter</a>
                  </li>
                  <li role="presentation" class="product_tab product_tab_hidden" id="product_unique_tab" >
                     <a href="#tab_content2" role="tab" id="unique-basic-tab" data-toggle="tab" aria-expanded="false">Unique Parameter</a>
                  </li>
               </ul>
               <div id="myTabContent" class="tab-content">
                  <!-- tabpanel common tab-->
                  <div role="tabpanel" class="tab-pane fade  active in" id="tab_content1" aria-labelledby="common-tab">
                     <div class="row">
                        <div class="col-md-10 col-sm-10 col-xs-12">
                           <h2 class="">Basic parameter</h2>
                        </div>
                        <div class="col-md-2 col-sm-2 col-xs-12">
                           <button  click_btn="unique-basic-tab" show_btn="product_unique_tab"  id="btn_next_comman" type="button" 
                              frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertproduct-API"
                              class="btn btn-success">save and next</button>
                        </div>
                     </div>
                     <hr>
                     <div class="form-group alert alert-success frm_error_message" >
                                                         
                    </div>
                     <?php include BASE_DIR.'view/product_common_basic.php'; ?>   
                  </div>
                  <!-- end tabpanel common tab-->

                  <!-- tabpanel common tab-->
                  <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="common-tab">
                     <div class="row">
                        <div class="col-md-8 col-sm-8 col-xs-12">
                           <h2 class="">Unique parameters <small>(Comman parameters will be overriden)</small></h2>
                        </div>
                        <div class="col-md-4 col-sm-4 col-xs-12">
                           <button click_btn="common-baisc-tab" id="btn_back_unique"  type="button" class="btn btn-success">back</button>

                           <button id="btn_save_unique" type="button" 
                              frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertproductunique-API"
                              class="btn btn-success">Save</button>

                           <button id="btn_save_close_unique" type="button" 
                              frm_id="frm_product" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertproductunique-API"
                              class="btn btn-success">Save & Close</button>

                        </div>
                     </div>
                     <hr>
                     <div class="form-group alert alert-success frm_error_message" >
                                                         
                     </div>
                     <?php include BASE_DIR.'view/product_unique_basic.php'; ?>   
                  </div>
                  <!-- end tabpanel common tab-->
               </div>
               <!-- tab-content -->
            </div>
            <!-- tabpanel -->
         </div>
         <!-- x_content -->
         </form>
      </div>
      <!-- x_panel -->
   </div>
</div>
<?php include '../include/footer.php'; ?>            
</body>
</html>