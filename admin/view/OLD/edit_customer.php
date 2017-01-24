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
        include("../data/TBL_CUSTOMER.php");
        $objInstance = new TBL_CUSTOMER();
        $mainObj = $objInstance->getdetails($id);
        $details = $mainObj;
?>
<div class="row">
   <div class="col-md-12 col-sm-12 col-xs-12">
      <div class="x_panel">
         <form id="frm_customer" name="frm_customer" data-parsley-validate class="form-horizontal form-label-left">
            
            <div class="x_title">
               <h2>Edit Customer Details</h2>
               <div class="form-group">
                  <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <button type="button" frm_id="frm_customer" call_link="<?=SERVER_PATH?>controller/controller.php?method=editcustomer-API&is_close=0" 
                                        name="btn_save" class="btn btn-success edit_show_message" >Save & Stay</button>
                                <button type="button" frm_id="frm_customer" call_link="<?=SERVER_PATH?>controller/controller.php?method=editcustomer-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                <button  call_url="<?=SERVER_PATH?>view/manage_customer.php" type="button" name="btn_cancel" id="btn_cancel" frm_id="frm_customer" class="btn btn-primary">Cancel</button>                                       
                  </div>
               </div>
               <div class="clearfix"></div>
 
              <div class="form-group alert alert-success frm_error_message" >
                                                   
              </div>
            </div>
            
            <div class="x_content">
               <div class="" role="tabpanel" data-example-id="togglable-tabs">
                   <ul id="myTab" class="nav nav-tabs bar_tabs" role="tablist">
                       <li role="presentation" class="active"><a href="#tab_content1" id="general-tab" role="tab" data-toggle="tab" aria-expanded="true">General Info</a>
                       </li>
                       <li role="presentation" class=""><a href="#tab_content2" role="tab" id="contact-tab" data-toggle="tab"  aria-expanded="false">Address</a>
                       </li>
                       <li role="presentation" class=""><a href="#tab_content3" role="tab" id="orderhistory-tab" data-toggle="tab" aria-expanded="false">Order History</a>
                       </li>
                   </ul>
                   <div id="myTabContent" class="tab-content">
                       <div role="tabpanel" class="tab-pane fade active in" id="tab_content1" aria-labelledby="general-tab">
                          <div class="col-md-6">
                              <h2>Personal Details</h2>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >First Name </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" value="<?=$details['fname']?>" required="required" class="form-control col-md-7 col-xs-12" name="fname" >
                                      <input type="hidden" value="<?=$details['user_id']?>" required="required" name="user_id" >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Last Name </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text"  value="<?=$details['lname']?>"  class="form-control col-md-7 col-xs-12" name="lname" >
                                   </div>
                                </div>


                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Gender</label>
                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                      <div class="radio-inline">
                                         <label>
                                         <input type="radio" <?=($details['sex'] == 1? "checked" : "") ?> value="1" id="sex" name="sex"> Male
                                         </label>
                                      </div>
                                      <div class="radio-inline">
                                         <label>
                                         <input type="radio" <?=($details['sex'] == 0? "checked" : "") ?> value="0" id="sex" name="sex"> Female
                                         </label>
                                      </div>
                                   </div>
                                </div>

                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email Id </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="email"  value="<?=$details['email_id']?>" name="email_id"  class="form-control col-md-7 col-xs-12"  >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Reset Password </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text"  value="<?=$details['password']?>"  name="password"  class="form-control col-md-7 col-xs-12" value="">
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Block Customer</label>
                                   <div class="col-md-9 col-sm-9 col-xs-12">
                                      <div class="radio-inline">
                                         <label>
                                         <input type="radio" <?=($details['is_active'] == 1? "checked" : "") ?> value="1" id="is_active" name="is_active"> Active
                                         </label>
                                      </div>
                                      <div class="radio-inline">
                                         <label>
                                         <input type="radio" <?=($details['is_active'] == 0? "checked" : "") ?> value="0" id="is_active" name="is_active"> In Active
                                         </label>
                                      </div>
                                   </div>
                                </div>
                          </div>
                       </div>


                       <div role="tabpanel" class="tab-pane fade" id="tab_content2" aria-labelledby="contact-tab">
                           <div class="col-md-6">
                              <h2>Address & Contact Details</h2>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Phone No.1 </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" class="form-control col-md-7 col-xs-12"  value="<?=$details['mobile']?>" name="mobile" >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Phone No.2 </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text"    class="form-control col-md-7 col-xs-12"  value="<?=$details['phone']?>" name="phone" >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Company/Apartment  </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text"  value="<?=$details['comp_apt']?>"  name="comp_apt" class="form-control col-md-7 col-xs-12"  >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Address1 </label>
                                   <div class="col-md-9 col-sm-9 col-xs-12">                                                
                                      <textarea placeholder=" " class="form-control" name="add1" ><?=$details['add1']?></textarea>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Address2 </label>
                                   <div class="col-md-9 col-sm-9 col-xs-12">                     
                                      <textarea placeholder=" " class="form-control" name="add2" ><?=$details['add2']?></textarea>
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >City </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" name="city" value="<?=$details['city']?>" class="form-control col-md-7 col-xs-12"  >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >State </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text"  value="<?=$details['state']?>" name="state" class="form-control col-md-7 col-xs-12"  >
                                   </div>
                                </div>
                                <div class="form-group">
                                   <label class="control-label col-md-3 col-sm-3 col-xs-12" >Country </label>
                                   <div class="col-md-6 col-sm-6 col-xs-12">
                                      <input type="text" value="<?=$details['country']?>" name="country" class="form-control col-md-7 col-xs-12"  >
                                   </div>
                                </div>
                             </div>
                          </div>
                            
                      
                       <div role="tabpanel" class="tab-pane fade" id="tab_content3" aria-labelledby="orderhistory-tab">
                           <div class="col-md-6">
                            Being updated 

                           </div>
                           
                       </div>  
                   </div>          
               </div>
            </div>
            </div>
         </form>
      </div>
      <!-- x_panel -->
   </div>
</div>
<?php
  }
?>
<?php include '../include/footer.php'; ?>            
</body>
</html>
