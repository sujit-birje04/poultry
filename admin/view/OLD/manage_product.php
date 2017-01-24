<?php include '../include/head.php'; ?>

</head>

<?php 

    include("../include/utility.php");
    $page_upper = PAGE_LIMIT;    
    $page_lower = 0;
    $page = 0;
    if(isset($_REQUEST['page'])){
        $page_lower = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
        $page = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
    }

    $product_search = "";
    if(isset($_REQUEST['product_search'])){
        $product_search = $_REQUEST['product_search'];
    }

    $category = "-1";
    if(isset($_REQUEST['category'])){
        $category = $_REQUEST['category'];
    }

    $prod_type = "-1";
    if(isset($_REQUEST['type'])){
        $prod_type = $_REQUEST['type'];
    }

    $status = "-1";
    if(isset($_REQUEST['status'])){
        $status = $_REQUEST['status'];
    }

    $web_id = "-1";
    if(isset($_REQUEST['web_id'])){
        $web_id = $_REQUEST['web_id'];
    }


    if (!class_exists('TBL_PRODUCT_CATEGORY')) {
        include("../data/TBL_PRODUCT_CATEGORY.php");
    }
    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->listallparent();
    $list_category = $mainObj["data"];

    if (!class_exists('TBL_WEBSITE')) {
        include("../data/TBL_WEBSITE.php");
    }
    $objWeb = new TBL_WEBSITE();
    $mainObj = $objWeb->listallactive();
    $list_website = $mainObj["data"];


    include '../include/header.php'; 
    include("../data/TBL_PRODUCT.php");
    $objProduct = new TBL_PRODUCT();
    $mainObj = $objProduct->listall($product_search, $prod_type, $category, $status, $web_id,$page_lower,$page_upper);
    $list_product = $mainObj["data"];
    //var_dump($list_product);
?>


<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <!--<div class="title_right">
            <form name="product_search" action="" >
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                    <div class="input-group">
                        <input prod_type="text" name="product_search" value="<?=$product_search?>" class="form-control" placeholder="Search for...">
                        <span class="input-group-btn">
                            <button class="btn btn-default" type="submit">Go!</button>
                        </span>
                    </div>
                </div>
            </form>
        </div>-->

        <div class="x_panel">

            <div class="form-group">
                <form name="product_search" action="">
                    <div class="col-md-2 col-sm-2 col-xs-12">                                            
                       <input type="text" value="<?=$product_search?>" placeholder="Title"  class="form-control" name="product_search" >
                    </div> 
                    <div class="col-md-2 col-sm-2 col-xs-12">
                       <select class="form-control" name="category" >
                            <option value="-1">Choose Category</option>
                            <?php
                                //$category = '';
                                foreach ($list_category as $key => $arr_val) {
                            ?>
                                <option <?=($arr_val['prc_id'] == $category) ? "Selected" : ""?> value="<?=$arr_val['prc_id']?>" ><?=$arr_val["name"]?></option>
                            <?php
                                  $html = Utility::categorySelectHtml($arr_val['prc_id'], $arr_val["name"], "");
                                  echo $html;
                                }
                            ?>
                        </select>
                    </div>
                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="form-control" name="type" data-parsley-id="4353">
                            <option  value="-1">All Type</option>   
                            <option <?=$prod_type == 1 ? 'Selected' : ''?> value="1">Residential</option>  
                            <option <?=$prod_type == 2 ? 'Selected' : ''?> value="2">Commercial</option>  
                            <option <?=$prod_type == 3 ? 'Selected' : ''?> value="3">Industrial</option>  
                        </select>
                    </div>

                    <div class="col-md-2 col-sm-2 col-xs-12">                                            
                        <select name="status" class="form-control" data-parsley-id="4353">
                            <option <?=($status=='-1') ? 'selected' : '' ?> value="-1" >Select Status</option>
                            <option <?=($status=='1') ? 'selected' : '' ?> value="1" >Active</option>
                            <option <?=($status=='0') ? 'selected' : '' ?> value="0" >In Active</option>
                        </select>
                     </div>


                    <div class="col-md-2 col-sm-2 col-xs-12">
                        <select name="web_id" class="form-control " data-parsley-id="4353" >
                            <option value="-1" >Choose option</option>
                            <?php
                                foreach ($list_website as $key => $arr_val) {
                            ?>
                                <option <?=$web_id == $arr_val['web_id'] ? "Selected" : ""?> value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                            <?php
                                }
                            ?>             
                        </select>
                    
                    </div>

                    <button type="submit" class="btn btn-dark">Filter</button>
                </form>
            </div>

            <div class="x_title">
                <h2>Manage Product</h2>
                <div class="clearfix"></div>
            </div>

            <div class="form-group alert alert-success frm_error_message" >
            </div>
            
            <div class="x_content table-responsive">
                <table class="table table-hover ">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Product Id</th>
                            <th>Product Name</th>                                                
                            <th>Assigned Category</th>                                           
                            <th>Available on</th>                                                   
                            <th>Sell on</th>                                                
                            <th>Product Type</th>                                                
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($list_product as $key => $arr_value) {
                        ?>
                         <tr>
                            <th scope="row"><?=$page_lower+1?></th>
                            <td><?=$arr_value['product_id']?></td>
                            <td><?=$arr_value['name']?></td>                                               
                            <td>
                                <?php
                                    $arr_category = is_array($arr_value['category']) ? $arr_value['category'] : array($arr_value['category']);
                                    foreach ($arr_category as $key => $cat_value) {
                                        echo '<p>'.$cat_value['name'].'</p>';
                                    }
                                ?>
                            </td>
                            <td>
                                <?php
                                    $html = Utility::getProductAvailableOn($arr_value['product_id']);
                                    echo $html;
                                ?>
                            </td>
                            <td>
                                <?php
                                    $html = Utility::getProductSellOn($arr_value['product_id']);
                                    echo $html;
                                ?>
                            </td>
                            <td>
                                <?php
                                    $product_type=json_decode(PRODUCT_TYPES);

                                    $product_type_db = json_decode($arr_value['type']);
                                    $product_type_db = is_array($product_type_db) ? $product_type_db : array($product_type_db);
                                    foreach ($product_type as $type_key => $type) {
                                        if(in_array($type_key, $product_type_db)){
                                            echo '<p>'.$type.'</p>';
                                        }
                                    }

                                ?>
                            </td>
                            <?php
                                if(empty($arr_value["is_active"])){
                            ?>
                            <td><button type="button" class="btn btn-danger btn-xs">In-Active</button></td>
                            <?php
                                } else {
                            ?>
                            <td><button type="button" class="btn btn-success btn-xs">Active</button></td>
                            <?php
                                }
                            ?>
                            <td>
                               <!--<a href="#" class="btn btn-success btn-xs btn_perform_redirect" call_link="<?=SERVER_PATH?>controller/controller.php?method=copyproduct-API&id=<?php echo $arr_value['product_id']; ?>" ><i class="fa fa-trash-o"></i> Duplicate </a>-->
                               <a href="<?=SERVER_PATH?>view/edit_product.php?id=<?=$arr_value["product_id"]?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                               <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteproduct-API&id=<?php echo $arr_value['product_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
                               
                            </td>
                        </tr>

                        <?php
                            $page_lower +=1;
                            }
                        ?>
                    </tbody>
                </table>

                <div class="pagination pagination-split">
                    <?php    
                        $mainObj = $objProduct->listall($product_search, $prod_type, $category, $status, $web_id);
                        $list = $mainObj["data"];
                        $num = 1;
                        for ($i=0; $i<count($list) ; $i+=PAGE_LIMIT) { 
                            $color = ($i == $page) ? 'background:#EEE;' : '';
                    ?>  
                        <li>
                            <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_product.php?page=<?=$num?>" ><?=$num?></a>
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
