<?php include '../include/head.php'; ?>

</head>

<?php 
    ini_set('display_errors', '1');     # don't show any errors...
    error_reporting(1);
    error_reporting(E_ALL);  # ...but do log them

    include("../include/utility.php");
    include '../include/header.php'; 

    if (!class_exists('TBL_WEBSITE')) {
        include("../data/TBL_WEBSITE.php");
    }
    include("../data/TBL_PRODUCT_UNIQUE.php");
    $objProduct = new TBL_PRODUCT_UNIQUE();
    $mainObj = $objProduct->listdubble();
    $list_product = $mainObj;
?>


<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <table border="2" width="400">
                <tr>
                    <td>Unique Product Id</td>
                    <td>Product Id</td>
                    <td>Web Id</td>
                    <td>Action</td>
                </tr>
            <?php
                foreach ($list_product as $key => $product) {
                    $innerObj = $objProduct->listallproduct($product['product_id']);
                    $inner_product = $innerObj;
                    $web_id = '';//$product['web_id'];
                    $product_id = '';//$product['product_id'];
                    $is_found = '';
                    foreach ($inner_product as $key => $arr_value) {
            ?>
                        <tr>
                            <td><?=$arr_value['unique_product_id']?></td>
                            <td><?=$arr_value['product_id']?></td>
                            <td><?=$arr_value['web_id']?></td>
                            <td>
                                <?php
                                    if(empty($is_found)){
                                        //if($web_id != $arr_value['web_id'] && $product_id != $arr_value['product_id']){
                                            echo count($inner_product);
                                        //}
                                        $is_found = 1;
                                    } else {
                                    ?>
                                    <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletedubproduct-API&id=<?php echo $arr_value['unique_product_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
                                    <?php
                                    }
                                ?>
                            </td>
                        </tr>
            <?php
                    }
                }
            ?>
            </table>
        </div>
    </div>

<?php include '../include/footer.php'; ?>            
</body>

</html>
