<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];
    unset($mainObj);
?>

<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_menu" name="frm_menu" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Add New Menu Item</h2>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                              <div class="btn">
                                <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                              </div>
                              <button type="button" frm_id="frm_menu" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertmenu-API&is_close=0" 
                                      name="btn_save" class="btn btn-success save_show_message" >Save</button>

                              <button type="button" frm_id="frm_menu" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertmenu-API&is_close=1"
                                      name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                              <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_menu_item.php" >Cancel</button>        
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-6">

                            <div class="form-group alert alert-success frm_error_message" >
                                                                 
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Menu Item Name </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" name="menu_name" required="required" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                           <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Assign Website</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select name="web_id" class="form-control change_on_select" frm_id="frm_menu" data-parsley-id="4353" target_id="parent_menu_id" call_link="<?=SERVER_PATH?>controller/controller.php?method=menuitems-API" >
                                        <option value="0" >Choose option</option>
                                        <?php
                                            foreach ($list_website as $key => $arr_val) {
                                        ?>
                                            <option value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                                        <?php
                                            }
                                        ?>             
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Parent Item</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" data-parsley-id="4353" id="parent_menu_id" name="parent_menu_id"  >
                                        <option value="0" >Choose option</option>                                                  
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Target</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control"  name="menu_target" data-parsley-id="4353" >
                                        <option value="0" >None</option>
                                        <option value="1" >New Tab</option>                          
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Sort Order</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input class="form-control col-md-7 col-xs-12" name="menu_sort_order"  type="text">
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

                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Menu Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" data-parsley-id="4353" name="menu_type" id="menu_type" >
                                        <option value="" >Choose option</option>
                                        <?php
                                            $arr_menu_type=json_decode(MENU_TYPES);
                                            foreach ($arr_menu_type as $menu_key => $menu_name) {
                                        ?>
                                            <option value="<?=$menu_key?>" ><?=$menu_name?></option>
                                        <?php 
                                            }
                                        ?>       
                                    </select>
                                </div>
                            </div>       
                            <div id="unique_prop_wrapper" >
                                <div id="menu_PMU" class="unique_menu" >
                                        <input name="unique_prop" type="hidden" value="0"/>
                                        <input name="unique_prop2" type="hidden" value="0"/>
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
