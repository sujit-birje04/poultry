<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    include("../data/TBL_PRODUCT_UNIQUE.php");
    $objProduct = new TBL_PRODUCT_UNIQUE();
    $mainObj = $objProduct->listall();
    $list_product = $mainObj;

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
                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertcoupon-API&is_close=0" 
                                  name="btn_save" class="btn btn-success save_show_message" >Save</button>

                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertcoupon-API&is_close=1"
                                  name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                          <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary" call_url="<?=SERVER_PATH?>view/manage_coupons.php" >Cancel</button>        
                        </div>
                    </div>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">                                    
                  <div class="col-md-9">
                    
                    <div class="form-group alert alert-success frm_error_message" >
                                                                     
                    </div>
                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12" >Name </label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <input type="text" name="name" required="required" class="form-control col-md-7 col-xs-12">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Code </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="code" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Discount </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="discount" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product/s</label>
                      <div class="col-md-9 col-sm-9 col-xs-12">
                          <select class="select2_multiple form-control" multiple="multiple" name="product[]" >
                              <option value="-1" >All</option>
                                <?php
                                    foreach ($list_product as $key => $arr_val) {
                                ?>
                                    <option value="<?=$arr_val['unique_product_id']?>" ><?=$arr_val["name"]?></option>
                                <?php
                                    }
                                ?>
                          </select>
                      </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required" >Start Date </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=date('m/d/Y')?>" name="start_date" class="form-control col-md-7 col-xs-12 date_picker">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required" >End Date </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=date('m/d/Y')?>" name="end_date" class="form-control col-md-7 col-xs-12 date_picker">
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
                  </div>
                </div>
              </form>
            </div><!-- x_panel -->
          </div>
      </div>

<?php include '../include/footer.php'; ?>            
</body>

</html>
