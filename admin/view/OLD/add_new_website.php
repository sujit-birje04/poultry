<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form name="frm_website" method="post" id="frm_website" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="x_title">
                            <h2>Add New Website</h2>
                             <div class="form-group">
                                <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">
                                    <div class="btn">
                                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                                    </div>
                                    <button type="button" frm_id="frm_website" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertwebsite-API&is_close=0" 
                                            name="btn_save" class="btn btn-success save_show_message" >Save</button>

                                    <button type="button" frm_id="frm_website" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertwebsite-API&is_close=1"
                                            name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                    <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_website.php" >Cancel</button>
                                    
                                </div>
                            </div>

                            <div class="clearfix"></div>
                        </div>
                        <div class="x_content">                       
                            <div class="col-md-6">

                                <div class="form-group alert alert-success frm_error_message" >
                                                                     
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >New Domain  
                                        <br><small>(eg: domain-name.com)</small>
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"  required="required" name="web_domain" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Website Name  
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"   required="required" name="web_name" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Contact Email  
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"   required="required" name="web_email" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Folder Path  
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"   required="required" name="web_folder_path" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <div class="col-md-12 col-sm-6 col-xs-12">
                                        <img src="" class="uploaded_img hide_after_save" id="web_logo_output" />
                                        <input name="web_logo_path" id="web_logo_path" type="hidden">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Upload Logo</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12 web_logo_img upload_image" name="file_image" type="file"
                                             image_id="web_logo_path" image_output_id="web_logo_output" frm_id="frm_website" />
                                    </div>
                                </div>

                                <!-- <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">File/Folder path</label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input class="form-control col-md-7 col-xs-12" type="text">
                                    </div>
                                </div> -->

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Website Type</label>
                                    <div class="col-md-9 col-sm-9 col-xs-12">
                                       <div class="radio-inline">
                                            <label>
                                                <input type="radio" checked="" value="1" id="web_type" name="web_type"> Retail  
                                            </label>
                                        </div>

                                        <div class="radio-inline">
                                            <label>
                                                <input type="radio" checked="" value="2" id="web_type" name="web_type"> Informative  
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Shipping charges 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"   required="required" name="web_shipping_charge" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Sort Order 
                                    </label>
                                    <div class="col-md-6 col-sm-6 col-xs-12">
                                        <input type="text"   required="required" name="web_sort_order" class="form-control col-md-7 col-xs-12">
                                    </div>
                                </div>
                            </div>
                        </div>     
                    </form>
                </div>

<div class="clearfix"></div>
                  
 
                                       

                                   





                                

                    </div>
                </div>
                <!-- x_panel -->
            </div>
        </div>


<?php include '../include/footer.php'; ?>            
</body>

</html>
