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

    //Get List if orders
    include("../data/TBL_ORDERS.php");
    include("../data/TBL_WEBSITE.php");
                                    
    $objInstance = new TBL_ORDERS();
    $listOrders = $objInstance->listall($page_lower,$page_upper);
    //var_dump($listOrders);
?>
<!-- page content -->
<div class="right_col" role="main">
   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <div class="x_panel">
            <div class="x_title">
                <h2>Manage Order</small></h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Order Id</th>
                            <th>Customer Name</th>  
                            <th>Website</th>                                                
                            <th>Order Status</th>
                            <th>Total</th>
                            <th>Order Date</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach ($listOrders as $key => $arr_value) {
                                # code...
                        ?>
                        <tr>
                            <td><?=$page_lower+1?></td>
                            <td><?=$arr_value['order_id']?></td>
                            <td><?=strtoupper($arr_value['user']['fname'])." ".strtotime($arr_value['user']['lname'])?></td>
                            <td>
                                <?php
                                    $objInstance1 = new TBL_WEBSITE();
                                    $webDetails = $objInstance1->getdetails($arr_value['web_id']);
                                    $web_name = isset($webDetails['name']) ? $webDetails['name'] : ''; 
                                    echo $web_name;
                                ?>

                            </td>
                            <?php
                                if($arr_value['order_status'] == 4){
                                    echo '<td><button type="button" class="btn btn-success btn-xs">Complete</button></td>';

                                } else if($arr_value['order_status'] == 2){
                                    echo '<td><button type="button" class="btn btn-danger btn-xs">Rejected</button></td>';

                                } else if($arr_value['order_status'] == 3){
                                    echo '<td><button type="button" class="btn btn-danger btn-xs">Cancelled</button></td>';

                                } else if($arr_value['order_status'] == 5){
                                    echo '<td><button type="button" class="btn btn-warning btn-xs">In Process</button></td>';

                                } else if($arr_value['order_status'] == 7){
                                    echo '<td><button type="button" class="btn btn-warning btn-xs">Dispatched</button></td>';

                                } else if($arr_value['order_status'] == 6){
                                    echo '<td><button type="button" class="btn btn-warning btn-xs">Shipping</button></td>';

                                } else {
                                    echo '<td><button type="button" class="btn btn-warning btn-xs">Pending</button></td>';        
                                }
                            ?>
                            
                            <td>$<?=round($arr_value['price'], 2)?></td>
                            <td><?=date('F, d Y', strtotime($arr_value['created_on']))?></td>
                            <td>
                                <a href="<?=SERVER_PATH?>view/edit_order.php?id=<?=$arr_value["order_id"]?>" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit </a>
                                <a href="#" class="btn btn-success btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$arr_value['order_id']?>&status=4" ><i class="fa fa-edit"></i> Complete </a>          
                                <a href="#" class="btn btn-danger btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$arr_value['order_id']?>&status=2" ><i class="fa fa-edit"></i> Reject </a>          
                                <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteorder-API&id=<?=$arr_value['order_id']?>" ><i class="fa fa-trash-o"></i> Delete </a>                               
                            </td>
                        </tr>
                        <?php
                            $page_lower+=1;
                            }
                        ?>
                    </tbody>
                </table>

                <div class="pagination pagination-split">
                    <?php    
                        $mainObj = $objInstance->listall();
                        $list = $mainObj;
                        $num = 1;
                        for ($i=0; $i<count($list) ; $i+=PAGE_LIMIT) { 
                            $color = ($i == $page) ? 'background:#EEE;' : '';
                    ?>  
                        <li>
                            <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_order.php?page=<?=$num?>" ><?=$num?></a>
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
