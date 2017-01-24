<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    include("../include/utility.php");

    $page_upper = PAGE_LIMIT;    
    $page_lower = 0;
    $page = 0;
    if(isset($_REQUEST['page'])){
        $page_lower = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
        $page = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
    }


    include("../data/TBL_PRODUCT_CATEGORY.php");
    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->listall($page_lower,$page_upper);
    $list = $mainObj["data"];
?>


<!-- page content -->
<div class="right_col" role="main">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Manage Category</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Category Id</th>
                            <th>Category Name</th>
                            <th>Publish on</th>
                            <th>Parent Category</th>
                            <th>Sort Order</th>
                            <th>Note</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($list as $key => $arr_value) {
                                if(empty($arr_value['parent_cat_id'])){
                                    $parent_category = "None";
                                } else {
                                    $parent_category = (isset($arr_value["parent_cat"]["name"]) ? $arr_value["parent_cat"]["name"] : "DELETED");    
                                }

                                $publish_on = 'none';
                                if($arr_value['publish_on'] != ''){
                                    $publish_on = Utility::getWebsiteList($arr_value['publish_on']);
                                    $publish_on = $publish_on['nameHTML'];
                                }
                                
                        ?>
                         <tr>
                            <th scope="row"><?=$page_lower+1?></th>
                            <td><?=$arr_value["prc_id"]?></td>
                            <td><?=$arr_value["name"]?></td>
                            <td><?=$publish_on?></td>
                            <td><?=$parent_category?></td>
                            <td><?=$arr_value["sort_order"]?></td>
                            <td><?=$arr_value["note"]?></td>
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
                                <a href="<?=SERVER_PATH?>view/edit_category.php?id=<?=$arr_value['prc_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletecategory-API&id=<?php echo $arr_value['prc_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
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
                        $mainObj = $objInstance->listall();
                        $list = $mainObj["data"];
                        $num = 1;
                        for ($i=0; $i<count($list) ; $i+=PAGE_LIMIT) { 
                            $color = ($i == $page) ? 'background:#EEE;' : '';
                    ?>  
                        <li>
                            <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_category.php?page=<?=$num?>" ><?=$num?></a>
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
