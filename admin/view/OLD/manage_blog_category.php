<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_country" name="frm_country" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Manage Country</h2>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                              <div class="btn">
                                <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                              </div>
                              <button type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary"  call_url="<?=SERVER_PATH?>view/manage_country.php" >Cancel</button>        
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                    <div class="x_content">                       
                        <div class="col-md-12">
                            <div class="form-group alert alert-success frm_error_message" >                               
                            </div>             
                            <div class="table-responsive">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                        <tr>
                                          <th class="text-center">Sn.no</th>
                                          <th class="text-center">ID</th>
                                          <th class="text-center">Name</th>
                                          <th class="text-center">status</th>
                                          <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php

                                        include("../data/TBL_ARTICLE_CATEGORY.php");                     
                                        $objCat = new TBL_ARTICLE_CATEGORY();
                                        $mainObj = $objCat->listall();
                                        $list_cat = $mainObj["data"];
                                        foreach ($list_cat as $key => $arr_value) {  
                                        ?>
                                        <tr>
                                            <td><?=$key+1?></td>
                                            <td><?=$arr_value['ac_id']?></td>
                                            <td><?=$arr_value['title']?></td>
                                            <?php
                                                if($arr_value['is_active'] == 1){
                                            ?>
                                                 <td><button type="button" class="btn btn-success btn-xs">Active</button></td>
                                            <?php
                                                } else {
                                            ?>
                                                <td><button type="button" class="btn btn-danger btn-xs">In-Active</button></td>
                                            <?php
                                                }
                                            ?>
                                            <td>
                                              <a class="btn btn-info btn-xs" href="<?=SERVER_PATH?>view/edit_blog_category.php?id=<?=$arr_value['ac_id']?>" ><i class="fa fa-edit"></i> Edit </a>          
                                              <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteblogcategory-API&id=<?=$arr_value['ac_id']?>" ><i class="fa fa-trash-o"></i> Delete </a>              
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                          <th class="text-left">
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    #
                                                </div>
                                            </div>
                                          </th>
                                          <th class="text-left">

                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    #
                                                </div>
                                            </div>
                                          </th>
                                          <th class="text-right">                                
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <input type="text" name="title" required="required" class="form-control col-md-7 col-xs-12">
                                                    <input type="hidden" name="description" required="required" class="form-control col-md-7 col-xs-12">
                                                </div>
                                            </div>
                                          </th>
                                          <th class="text-right">         
                                            <div class="form-group">
                                                <div class="col-md-12 col-sm-12 col-xs-12">
                                                    <select class="form-control"  name="is_active" data-parsley-id="4353" >
                                                        <option value="0" >In Active</option>
                                                        <option value="1" >Active</option>                          
                                                    </select>
                                                </div>
                                            </div>
                                          </th>
                                          <th>
                                            <button type="button" frm_id="frm_country" call_link="<?=SERVER_PATH?>controller/controller.php?method=insertblogcategory-API&is_close=1"
                                            name="btn_save_close" id="btn_save_close" class="btn btn-warning btn_save_close">Save & Close</button>
                                          </th>
                                        </tr>
                                    </tfoot>
                                </table>
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
