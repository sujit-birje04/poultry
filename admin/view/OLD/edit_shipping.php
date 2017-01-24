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

        include("../data/TBL_SHIPPING_METHODS.php");                     
        $objTemplate = new TBL_SHIPPING_METHODS();
        $mainObj = $objTemplate->getdetails($id);
        $details = $mainObj;
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_country" name="frm_country" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Manage Shipping Method</h2>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                              <div class="btn">
                                <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                              </div>
                              <button type="button" frm_id="frm_country" call_link="<?=SERVER_PATH?>controller/controller.php?method=editshipping-API&is_close=0" 
                                      name="btn_save" class="btn btn-success save_show_message" >Save</button>

                              <button type="button" frm_id="frm_country" call_link="<?=SERVER_PATH?>controller/controller.php?method=editshipping-API&is_close=1"
                                      name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                              <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_shipping.php" >Cancel</button>        
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-6">
                            <div class="form-group alert alert-success frm_error_message" >                               
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Method Name </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="shipping_id" type="hidden" value="<?=$details['method_id']?>" >
                                    <input type="text" value="<?=$details['method_name']?>" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Method charges </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?=$details['method_charge']?>" name="charges" required="required" class="form-control col-md-7 col-xs-12">
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


<?php include '../include/footer.php'; ?>            
</body>

</html>
