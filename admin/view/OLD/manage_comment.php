<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    
    $page_upper = PAGE_LIMIT;    
    $page_lower = 0;
    $page = 0;
    if(isset($_REQUEST['page'])){
        $page_lower = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
        $page = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
    }

    $ratting = isset($_REQUEST["ratting"]) ? $_REQUEST["ratting"] : 'all';
    $website = isset($_REQUEST["web_id"]) ? $_REQUEST["web_id"] : 'all';
    $product = isset($_REQUEST["product"]) ? $_REQUEST["product"] : 'all';
    $is_active = isset($_REQUEST["is_active"]) ? $_REQUEST["is_active"] : 'all';
    $comment = isset($_REQUEST["comment"]) ? $_REQUEST["comment"] : '';
    include("../data/TBL_PRODUCT_COMMENTS.php");
    $objInstance2 = new TBL_PRODUCT_COMMENTS();
    $listComments = $objInstance2->listall($ratting, $website, $product, $is_active, $comment,$page_lower,$page_upper);

?>


<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manage Comment</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group">
                        <form name="frm_filter" id="frm_filter" action"" >
                        <div class="col-md-2 col-sm-2 col-xs-12">                                            
                            <input type="text" value="<?=$comment?>" name="comment" placeholder="Search Comment"  class="form-control  ">
                        </div>                                        
                       
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <select name="ratting" class="form-control" data-parsley-id="4353">
                                <option value="all" >Select Rating</option>                                                       
                                <option <?=($ratting == 1) ? 'Selected' : '' ?> value="1" >1</option>                                                                                                    
                                <option <?=($ratting == 2) ? 'Selected' : '' ?> value="2" >2</option>                                                                                                    
                                <option <?=($ratting == 3) ? 'Selected' : '' ?> value="3" >3</option>                                                                                                    
                                <option <?=($ratting == 4) ? 'Selected' : '' ?> value="4" >4</option>                                                                                                    
                                <option <?=($ratting == 5) ? 'Selected' : '' ?> value="5" >5</option>                                                                                                    
                            </select>
                        </div>
                        
                        <?php
                            if (!class_exists('TBL_WEBSITE')) {
                              include("../data/TBL_WEBSITE.php");
                            }
                            $objInstance = new TBL_WEBSITE();
                            $list_website = $objInstance->listallactive();
                            $list_website = $list_website["data"];
                            
                        ?>

                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <select  name="web_id" target_id="product_list" frm_id="frm_filter"  class="change_on_select form-control" data-parsley-id="4353"  call_link="<?=SERVER_PATH?>controller/controller.php?method=productlist-API"  >
                                <option value="all" >Select Website</option>                                                       
                               <?php
                                  foreach ($list_website as $key => $arr_val) {
                              ?>
                                  <option <?=($website == $arr_val['web_id'])? "selected" : ""?> value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                              <?php
                                  }
                              ?>                                                                                                       
                            </select>
                        </div>
                        
                        <div class="col-md-2 col-sm-2 col-xs-12">
                            <select  name="product" id="product_list" class="form-control" data-parsley-id="4353">
                                <option value="all" >All Product</option>                                                                                                                                                                                                                                                             
                            </select>
                        </div>

                        <div class="col-md-2 col-sm-2 col-xs-12">

                            <select name="is_active" class="form-control" data-parsley-id="4353">
                                <option <?=($is_active == 'all')? "selected" : ""?> value="all" >All Status</option>                                                       
                                <option <?=($is_active == "2")? "selected" : ""?> value="2" >Approved</option>                                                                                                    
                                <option <?=($is_active == "1")? "selected" : ""?> value="1" >Pending</option>                                                                                                                                                                                                       
                                <option <?=($is_active == "0")? "selected" : ""?> value="0" >In Active</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-dark">Filter</button>
                        </form>
                    </div>
                    <hr>
                  
                    <!--<div>Note: Bulk delete is required</div>-->
                    <hr>

                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Comment ID</th>
                                <th>Customer Name</th>                                                                                                                                       
                                <th>Email Id</th>
                                <th>Dealer</th>                    
                                <th>Comment Date</th>                    
                                <th>Customer Review</th>
                                <th>Rating</th>
                                <th>Website</th>
                                <th>Product</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                foreach ($listComments as $key => $arr_value) {
                            
                            ?>
                             <tr>
                                <td><?=$page_lower+1?></td>
                                <td><?=$arr_value['p_comment_id']?></td>
                                <td><?=$arr_value['full_name']?></td>  
                                <td><?=$arr_value['email']?></td>    
                                <td><?=$arr_value['dealer']?></td>                                                                                                                                                                                   
                                <td><?=date('F m Y', strtotime($arr_value['created_on']))?></td>
                                <td><?=$arr_value['comment']?>
                                    <br>
                                    <a href="<?=SERVER_PATH?>view/edit_comment.php?id=<?=$arr_value["p_comment_id"]?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                    <!--
                                    <br>
                                      <a href="#" class="btn btn-info btn-xs"><i class="fa fa-reply"></i> Reply </a>
                                      <a href="#" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                      <a href="#" class="btn btn-info btn-xs"><i class="fa fa-check"></i> Approve </a>
                                    -->
                                </td>
                                <td><?=$arr_value['starts']?></td>
                                <td><?=$arr_value['website']['name']?></td>
                                <td><?=$arr_value['product']['name']?></td>
                                <td>
                                    <?php
                                        if($arr_value['is_active'] == 0){
                                            echo '<button type="button" class="btn btn-error btn-xs">in active</button>';
                                        } else if($arr_value['is_active'] == 1) {
                                            echo '<button type="button" class="btn btn-warning btn-xs">pending</button>';
                                        } else {
                                            echo '<button type="button" class="btn btn-success btn-xs">approved</button>';
                                        }    
                                    ?>
                                </td>
                                <td>
                                   <!--<a href="#" class="btn btn-danger btn-xs"><i class="fa fa-trash-o"></i> Delete </a>-->
                                   <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletecomment-API&id=<?=$arr_value['p_comment_id']?>" ><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>
                            <?php
                               # code...
                                    $page_lower+=1;
                                }
                            ?>
                        </tbody>
                    </table>

                    <div class="pagination pagination-split">
                        <?php    
                            $mainObj = $objInstance2->listall($ratting, $website, $product, $is_active, $comment);
                            $list = $mainObj;
                            $num = 1;
                            for ($i=0; $i<count($list) ; $i+=PAGE_LIMIT) { 
                                $color = ($i == $page) ? 'background:#EEE;' : '';
                                $param = "&comment=$comment&ratting=$ratting&web_id=$website&product=$product&is_active=$is_active"
                        ?>  
                            <li>
                                <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_comment.php?page=<?=$num?><?=$param?>" ><?=$num?></a>
                            </li>
                        <?php
                                $num+=1;
                            }
                        ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

<?php include '../include/footer.php'; ?>            
</body>

</html>
