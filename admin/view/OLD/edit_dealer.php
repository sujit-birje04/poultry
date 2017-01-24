<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;

    if(empty($id)){
?>

    <div class="right_col" role="main">
        <div class="row">
            <div class="col-md-12 col-sm-12 col-xs-12">
                    <div class="x_panel">
                        Please check your input.
                    </div>
            </div>
        </div>
    </div>
<?php
    } else {

        include("../data/TBL_DEALER.php");
        $objInstance = new TBL_DEALER();
        $mainObj = $objInstance->getdetails($id);
        $details = $mainObj;

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
                    <form name="frm_dealer" method="post" id="frm_dealer" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="x_title">
                            <h2>Add New Dealer</h2>
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <button type="button" frm_id="frm_dealer" call_link="<?=SERVER_PATH?>controller/controller.php?method=editdealer-API&is_close=0" 
                                        name="btn_save" class="btn btn-success edit_show_message" >Save</button>

                                <button type="button" frm_id="frm_dealer" call_link="<?=SERVER_PATH?>controller/controller.php?method=editdealer-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_dealer.php" >Cancel</button>        
                            </div>
                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">                       
                           <div class="col-md-6">
                                <div class="form-group alert alert-success frm_error_message" >
                                                                     
                                </div>
                                 <div class="form-group">
                                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Publish on Website</label>
                                  <div class="col-md-9 col-sm-9 col-xs-12">
                                      <select class="select2_multiple form-control"  name="publish_on" >
                                          <option>Choose option</option>
                                            <?php
                                            $arr_publish_on =  $details['website_id'];

                                                foreach ($list_website as $key => $arr_val) {
                                            ?>
                                                <option value="<?=$arr_val['web_id']?>"  <?= $arr_val['web_id']==$arr_publish_on ? "selected" : ""?> ><?=$arr_val["domain"]?></option>
                                            <?php
                                                }
                                            ?>
                                      </select>
                                  </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dealer Name <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_name" id="dealer_name" required="required" class="form-control col-md-7 col-xs-12" value="<?=$details['name']?>">
                                        <input type="hidden"  value="<?=$details['dealer_id']?>" required="required" name="dealer_id" />
                                    </div>
                                </div>
                              
                              <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dealer Address <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <textarea name="dealer_address" id="dealer_address" data-parsley-minlength="20" data-parsley-maxlength="100"  class="form-control"><?=$details['address']?></textarea>
                                    </div>
                                </div>
                                
                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >City <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_city"  class="form-control col-md-7 col-xs-12" value="<?=$details['City']?>">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >State <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_state"  class="form-control col-md-7 col-xs-12" value="<?=$details['State']?>">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Zipcode <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_zipcode" required="required" class="form-control col-md-7 col-xs-12" value="<?=$details['zipcode']?>">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Phone Number <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_phone" required="required" class="form-control col-md-7 col-xs-12" value="<?=$details['phone_number']?>">
                                    </div>
                                </div>

                                 <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Fax <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_fax"  class="form-control col-md-7 col-xs-12" value="<?=$details['fax']?>">
                                    </div>
                                </div>
                                
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email <span class="required"></span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="email" name="dealer_email"  class="form-control col-md-7 col-xs-12" value="<?=$details['email']?>">
                                    </div>
                                </div>

                                   <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Website <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_website" id="dealer_website" required="required" value="<?=$details['dealer_website']?>" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Working Hours <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_hour"  class="form-control col-md-7 col-xs-12" value="<?=$details['working_hours']?>">
                                    </div>
                                </div>
                                    
                              <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sort Order <span class="required">*</span>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text" name="dealer_sort"  class="form-control col-md-7 col-xs-12" value="<?=$details['sort_order']?>">
                                    </div>
                                </div>
                               
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                       <div class="radio">
                                            <label>
                                                <input type="radio" checked="" <?=($details["is_active"] == 1)? "checked" : ""?> value="1" id="cat_is_active" name="del_is_active">Active
                                            </label>
                                        </div>
                                        <div class="radio">
                                            <label>
                                                <input type="radio" checked="" <?=($details["is_active"] == 0)? "checked" : ""?>  value="0" id="cat_is_active" name="del_is_active"> Inactive
                                            </label>
                                        </div>
                                    </div>
                                </div>
         
                                
                            </div>
                            <!-- end col-md-6 -->
                        </div>
                     </form>
                </div>
                <div class="clearfix"></div>
        </div>
    </div>
                <!-- x_panel -->
</div>
    <?php
    }
    ?>
</div>


<?php include '../include/footer.php'; ?>            
</body>

</html>
