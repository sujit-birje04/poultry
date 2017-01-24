<?php include '../include/head.php'; ?>
 <link rel="stylesheet" href="css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

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
        include("../data/TBL_USERS.php");
        $objInstance = new TBL_USERS();
        $mainObj = $objInstance->getdetails($id);
        $details = $mainObj;
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_user" name="frm_user" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Add New User</h2>
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=edituser-API&is_close=0" 
                                        name="btn_save" class="btn btn-success edit_show_message" >Save & Stay</button>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=edituser-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                <button  call_url="<?=SERVER_PATH?>view/manage_user.php" type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary">Cancel</button>                                       
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-6">
                            
                            <div class="form-group alert alert-success frm_error_message" >
                                                                 
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Full Name </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?=$details['fname'].''.$details['lname']?>" name="full_name" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Username </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="text" value="<?=$details['username']?>" name="user_name" class="form-control col-md-7 col-xs-12">
                                    <input type="hidden" value="<?=$details['user_id']?>" name="user_id" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Password </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" value="<?=$details['password']?>" name="password" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Confirm Password </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="password" value="<?=$details['password']?>" name="confirm_password" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email Id </label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <input type="email" value="<?=$details['email_id']?>" name="email_id" class="form-control col-md-7 col-xs-12">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">User Type</label>
                                <div class="col-md-6 col-sm-6 col-xs-12">
                                    <select class="form-control" name="user_type" >                                                    
                                        <option value="1" <?=($details['user_type'] == 1? "Selected" : "") ?> >Manager</option>                        
                                        <option value="2" <?=($details['user_type'] == 2? "Selected" : "") ?> >Super Admin</option>                                                                             
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
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
