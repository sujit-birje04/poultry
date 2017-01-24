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

    include("../data/TBL_CUSTOMER.php");
    $objInstance = new TBL_CUSTOMER();
    $mainObj = $objInstance->listall($page_lower,$page_upper);
    $list = $mainObj["data"];    
?>

<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manage Customer</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Customer Id</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Email Id</th> 
                                <th>Joined Date</th>                                               
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                if(!empty($list)){
                                    foreach ($list as $key => $arr_value) {
                            ?>
                                     <tr>                                               
                                        <td><?=($page_lower+1)?></td>
                                        <td><?=$arr_value['user_id']?></td>
                                        <td><?=$arr_value['fname']?></td>
                                        <td><?=$arr_value['lname']?></td>
                                        <td><?=$arr_value['email_id']?></td>
                                        <td><?=date('Y-d-m', strtotime($arr_value['created_on']))?></td>
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
                                            <a href="<?=SERVER_PATH?>view/edit_customer.php?id=<?=$arr_value['user_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                            <?php
                                                if($user_data['user_type'] == 3){
                                            ?>
                                            <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletecustomer-API&id=<?php echo $arr_value['user_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
                                            <?php
                                                }
                                            ?>
                                        </td>
                                    </tr>
                            <?php
                                    $page_lower += 1;
                                    }
                                } else {
                            ?>
                                    <tr>
                                        <td>No users present</td>
                                    </tr>
                            <?php
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
                                <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_customer.php?page=<?=$num?>" ><?=$num?></a>
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
