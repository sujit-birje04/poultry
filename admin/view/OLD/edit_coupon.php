<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
   <?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;    
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

    include("../data/TBL_PRODUCT_UNIQUE.php");
    $objProduct = new TBL_PRODUCT_UNIQUE();
    $mainObj = $objProduct->listall();
    $list_product = $mainObj;


    include("../data/TBL_COUPON.php");                     
    $objTemplate = new TBL_COUPON();
    $mainObj = $objTemplate->getdetails($id);
    $details = $mainObj;
?>
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
                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=editcoupon-API&is_close=0" 
                                  name="btn_save" class="btn btn-success save_show_message" >Save</button>

                          <button type="button" frm_id="frm_article" call_link="<?=SERVER_PATH?>controller/controller.php?method=editcoupon-API&is_close=1"
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
                          <input type="text" name="name" value="<?=$details['name']?>" required="required" class="form-control col-md-7 col-xs-12">
                          <input type="hidden" name="coupon_id" value="<?=$details['coupon_id']?>" required="required">
                      </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >Code </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=$details['code']?>" name="code" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" >discount </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=$details['discount']?>" name="discount" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>

                    <div class="form-group">
                      <label class="control-label col-md-3 col-sm-3 col-xs-12">Product/s</label>
                      <div class="col-md-6 col-sm-6 col-xs-12">
                          <select class="select2_multiple form-control" multiple="multiple" name="product[]" id="product_id" >
                              <option value="-1" >All</option>
                                <?php
                                    $products = explode(',', $details['product_id']);
                                    foreach ($list_product as $key => $arr_val) {
                                ?>
                                    <option value="<?=$arr_val['unique_product_id']?>" <?=( in_array($arr_val['unique_product_id'], $products) ? 'selected' : '')?> ><?=$arr_val["name"]?></option>
                                <?php
                                    }
                                ?>
                          </select>
                      </div>
                    </div>


                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required" >Start Date </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=date('m/d/Y', strtotime($details['start_date']))?>" name="start_date" class="form-control col-md-7 col-xs-12 date_picker">
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" required="required" >End Date </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" value="<?=date('m/d/Y', strtotime($details['end_date']))?>" name="end_date" class="form-control col-md-7 col-xs-12 date_picker">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                        <div class="col-md-9 col-sm-9 col-xs-12">
                           <div class="radio-inline">
                                <label>
                                    <input type="radio" <?=$details['is_active'] == 1 ? 'checked' : ''?>  value="1" id="is_active" name="is_active"> Active
                                </label>
                            </div>

                            <div class="radio-inline">
                                <label>
                                    <input type="radio" <?=$details['is_active'] == 0 ? 'checked' : ''?> value="0" id="is_active" name="is_active"> In Active
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
<?php
  }
?>


    <script type="text/javascript">
      var data = <?=json_encode($details['products'])?>; 
      var dataarray = data.split(",");
      $("#product_id").val(dataarray);
    </script>

<?php include '../include/footer.php'; ?>            
</body>

</html>
