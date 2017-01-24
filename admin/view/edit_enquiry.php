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
        include("../data/ENQUIRIES.php");
        $objInstance = new ENQUIRIES();
        $mainObj = $objInstance->getdetails($id);
        $details = $mainObj;
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_user" name="frm_user" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Enquiry : <?=$id?></h2>
                         <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                </div>
                                <!--
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=edituser-API&is_close=0" 
                                        name="btn_save" class="btn btn-success edit_show_message" >Save & Stay</button>
                                <button type="button" frm_id="frm_user" call_link="<?=SERVER_PATH?>controller/controller.php?method=edituser-API&is_close=1"
                                        name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                -->
                                <button  call_url="<?=SERVER_PATH?>view/manage_enquiry.php" type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary">Back</button>                                       
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-9">
                            
                            <div class="form-group alert alert-success frm_error_message" >
                                                                 
                            </div>

                            <div class="form-group">
                                <label class="control-label" ><?=$details['name']?></label><br/>
                                <label class="control-label" ><?=$details['email']?></label><br/>
                                <label class="control-label" ><?=$details['phone']?></label><br/>
                                <label class="control-label" ><?=$details['address']?></label><br/>
                                <label class="control-label" ><?=$details['city']?></label><br/>
                                <label class="control-label" ><?=$details['country']?></label><br/>
                                <label class="control-label" ><?=$details['zipcode']?></label><br/>
                                <label class="control-label" ><?=$details['fax']?></label>
                            </div>
                            <div class="form-group">
                                <label class="control-label" >Comment : </label>
                                <div class="">
                                    <p><?=$details['comment']?></p>
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
