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

        include("../data/TBL_FORM.php");                     
        $objTemplate = new TBL_FORM();
        $mainObj = $objTemplate->getdetails($id);
        $details = $mainObj;
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_menu" name="frm_menu" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Manage Form</h2>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                              <div class="btn">
                                <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                              </div>
                              <button type="button" frm_id="frm_menu" call_link="<?=SERVER_PATH?>controller/controller.php?method=editform-API&is_close=0" 
                                      name="btn_save" class="btn btn-success save_show_message" >Save</button>

                              <button type="button" frm_id="frm_menu" call_link="<?=SERVER_PATH?>controller/controller.php?method=editform-API&is_close=1"
                                      name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                              <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_form.php" >Cancel</button>        
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-6">
                            <div class="form-group alert alert-success frm_error_message" >                               
                            </div>
                            
                            
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Form Name </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input name="f_id" type="hidden" value="<?=$details['f_id']?>" >
                                    <input type="text" value="<?=$details['name']?>" name="name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Form Path</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" value="<?=$details['file_path']?>" name="path"  type="text">
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


<?php include '../include/footer.php'; ?>            
</body>

</html>
