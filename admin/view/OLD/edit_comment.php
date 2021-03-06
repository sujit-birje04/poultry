<?php include '../include/head.php'; ?>
 <link rel="stylesheet" href="../css/star-rating.css" media="all" rel="stylesheet" type="text/css"/>

</head>

<?php include '../include/header.php'; ?>
<?php  
    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];
    unset($mainObj);

    $comment_id = isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;
?>

<!-- page content -->
<div class="right_col" role="main">
    <?php
      if(empty($comment_id)){
    ?>

    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        Input is not valid
      </div>
    </div>

    <?php
      } else {
        include("../data/TBL_PRODUCT_COMMENTS.php");
        $objInstance2 = new TBL_PRODUCT_COMMENTS();
        $comment_details = $objInstance2->getdetails($comment_id);
        //var_dump($comment_details);
    ?>
    <div class="row">
      <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
          <form id="frm_comment" name="frm_comment" data-parsley-validate class="form-horizontal form-label-left">
            <div class="x_title">
                <h2>Add New Comment</h2>
                <div class="form-group">
                    <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                      <div class="btn">
                        <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                      </div>
                      <button type="button" frm_id="frm_comment" call_link="<?=SERVER_PATH?>controller/controller.php?method=editcomment-API&is_close=0" 
                              name="btn_save" class="btn btn-success save_show_message" >Save</button>

                      <button type="button" frm_id="frm_comment" call_link="<?=SERVER_PATH?>controller/controller.php?method=editcomment-API&is_close=1"
                              name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                      <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_comment.php" >Cancel</button>        
                    </div>
                </div>
                <div class="clearfix"></div>
            </div>

            <div class="x_content">                       
              <div class="col-md-6">
                <div class="form-group alert alert-success frm_error_message" >
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Customer Name </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input name="comment_id" value="<?=$comment_details['p_comment_id']?>" type="hidden" >
                        <input type="text" value="<?=$comment_details['full_name']?>" name="full_name" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <!--
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12" >Image </label>
                  <div class="col-md-6 col-sm-6 col-xs-12">
                      <input type="file"    class="form-control col-md-7 col-xs-12">
                  </div>
                </div>
                -->              
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Email Id </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="email" name="email_id" value="<?=$comment_details['email']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Dealer name </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text" name="dealer" value="<?=$comment_details['dealer']?>" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                <!--
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Comment Date </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">
                        <input type="text"  required="required" class="form-control col-md-7 col-xs-12">
                    </div>
                </div>
                -->
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Select website</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                      <select name="web_id" class="form-control change_on_select" target_id="product_list" frm_id="frm_comment" data-parsley-id="4353" call_link="<?=SERVER_PATH?>controller/controller.php?method=productlist-API" >
                          <option>Choose option</option>
                          <?php
                              foreach ($list_website as $key => $arr_val) {
                          ?>
                              <option <?=($comment_details["web_id"] == $arr_val['web_id'])? "selected" : ""?> value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                          <?php
                              }
                          ?>             
                      </select>
                  </div>
                </div> 
                <div class="form-group">
                  <label class="control-label col-md-3 col-sm-3 col-xs-12">Select product</label>
                  <div class="col-md-9 col-sm-9 col-xs-12">
                      <select class="form-control" name="product_id" id="product_list" >
                          <option value="<?=$comment_details["product_id"]?>" ><?=$comment_details["product"]["name"]?></option>  
                      </select>
                  </div>
                </div>                                    
                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12">Status</label>
                    <div class="col-md-9 col-sm-9 col-xs-12">
                        <div class="radio-inline">
                            <label>
                                <input type="radio" <?=($comment_details["is_active"] == 1)? "checked" : ""?> value="1" id="is_active" name="is_active"> Pending
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" <?=($comment_details["is_active"] == 2)? "checked" : ""?> value="2" id="is_active" name="is_active"> Approved
                            </label>
                        </div>
                        <div class="radio-inline">
                            <label>
                                <input type="radio" <?=($comment_details["is_active"] == 0)? "checked" : ""?> value="0" id="is_active" name="is_active"> In Active
                            </label>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Comment</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">                                                
                      <textarea placeholder="" name="comment" class="form-control" ><?=$comment_details['comment']?></textarea>
                   </div>
                </div>

                <div class="form-group">
                   <label class="control-label col-md-3 col-sm-3 col-xs-12">Rating</label>
                   <div class="col-md-9 col-sm-9 col-xs-12">                                                
                      <input id="input-21e" name="ratting" value="<?=$comment_details['starts']?>" type="number" class="rating" min=0 max=5 step=0.5 data-size="xs" >                                        
                   </div>
                </div>
                

                <div class="form-group">
                    <label class="control-label col-md-3 col-sm-3 col-xs-12" >Published date </label>
                    <div class="col-md-6 col-sm-6 col-xs-12">

                        <input type="text" value="<?=date('m/d/Y', strtotime($comment_details["created_on"]))?>" name="created_on" class="form-control col-md-7 col-xs-12 date_picker">
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
  <script src="../js/star-rating.js" type="text/javascript"></script>  
  <script>
    jQuery(document).ready(function () {
        $("#input-21f").rating({
            starCaptions: function(val) {
                if (val < 3) {
                    return val;
                } else {
                    return 'high';
                }
            },
            starCaptionClasses: function(val) {
                if (val < 3) {
                    return 'label label-danger';
                } else {
                    return 'label label-success';
                }
            },
            hoverOnClear: false
        });
        
        $('#rating-input').rating({
              min: 0,
              max: 5,
              step: 1,
              size: 'lg',
              showClear: false
           });
           
        $('#btn-rating-input').on('click', function() {
            $('#rating-input').rating('refresh', {
                showClear:true, 
                disabled:true
            });
        });
        
        
        $('.btn-danger').on('click', function() {
            $("#kartik").rating('destroy');
        });
        
        $('.btn-success').on('click', function() {
            $("#kartik").rating('create');
        });
        
        $('#rating-input').on('rating.change', function() {
            alert($('#rating-input').val());
        });
        
        
        $('.rb-rating').rating({'showCaption':true, 'stars':'3', 'min':'0', 'max':'3', 'step':'1', 'size':'xs', 'starCaptions': {0:'status:nix', 1:'status:wackelt', 2:'status:geht', 3:'status:laeuft'}});
    });
</script>      
</body>

</html>
