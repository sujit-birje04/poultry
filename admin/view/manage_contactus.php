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
    include("../data/CONTACT_US.php");
    $objInstance = new CONTACT_US();
    $mainObj = $objInstance->listall($page_lower,$page_upper);
    $list = $mainObj["data"];
?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manage Contact Us</small></h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email Id</th>
                                <th>Phone</th>
                                <th>Subject</th>
                                <th>Message</th>
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
                                        <td><?=$arr_value['id']?></td>
                                        <td><?=$arr_value['name']?></td>
                                        <td><?=$arr_value['email']?></td>
                                        <td><?=$arr_value['phone']?></td>
                                        <td><?=$arr_value['subject']?></td>
                                        <td><?=$arr_value['message']?></td>
                                        
                                        <td>
                                            <a href="<?=SERVER_PATH?>view/edit_contactus.php?id=<?=$arr_value['id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> View </a>
                                            <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletecontactmessage-API&id=<?php echo $arr_value['id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
                                        </td>
                                    </tr>
                            <?php
                                        $page_lower +=1;
                                    }
                                } else {
                            ?>
                                    <tr>
                                        <td>No message present</td>
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
                                <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_contactus.php?page=<?=$num?>" ><?=$num?></a>
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
