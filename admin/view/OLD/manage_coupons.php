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


    include("../data/TBL_COUPON.php");
    $objInstance = new TBL_COUPON();
    $mainObj = $objInstance->listall($page_lower,$page_upper);
    $list = $mainObj["data"];
?>


<!-- page content -->
<div class="right_col" role="main">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Manage Coupon</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Coupon Id</th>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Discount</th>
                            <th>From Date</th>
                            <th>To Date</th>
                            <th>Product</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($list as $key => $arr_value) {      
                        ?>
                         <tr>
                            <th scope="row"><?=$page_lower+1?></th>
                            <td><?=$arr_value["coupon_id"]?></td>
                            <td><?=$arr_value["name"]?></td>
                            <td><?=$arr_value['code']?></td>
                            <td><?=$arr_value['discount']?></td>
                            <td><?=$arr_value['start_date']?></td>
                            <td><?=$arr_value["end_date"]?></td>
                            <td>
                                <?php
                                    if($arr_value["product_id"] == -1){
                                        echo 'All';
                                    } else {
                                        echo $arr_value["product_id"];
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
                                <a href="<?=SERVER_PATH?>view/edit_coupon.php?id=<?=$arr_value['coupon_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletecoupon-API&id=<?php echo $arr_value['coupon_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
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
