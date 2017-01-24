<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];
    unset($mainObj);
    $web_id = -1;
    if(isset($_REQUEST['web_id'])){
        $web_id = $_REQUEST['web_id'];
    }
    $menu_type = -1;
    if(isset($_REQUEST['menu_type'])){
        $menu_type = $_REQUEST['menu_type'];
    }
    $status = -1;
    if(isset($_REQUEST['status'])){
        $status = $_REQUEST['status'];
    }
    $menu_search = '';
    if(isset($_REQUEST['menu_search'])){
        $menu_search = $_REQUEST['menu_search'];
    }


    $page_upper = PAGE_LIMIT;    
    $page_lower = 0;
    $page = 0;
    if(isset($_REQUEST['page'])){
        $page_lower = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
        $page = ($_REQUEST['page']*PAGE_LIMIT) - PAGE_LIMIT;
    }


    include("../data/TBL_MENUS.php");
    $objMenu = new TBL_MENUS();
    $mainObj = $objMenu->listallparent($web_id, $menu_type, $status, $menu_search, $page_lower, $page_upper);
    $list_parent = $mainObj;
?>


<!-- page content -->
<div class="right_col" role="main">

   <div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
        <form action="" name="frm_menu" >
        <div class="x_panel">
            <div class="x_title">
                <h2>Manage Menu Item </h2>
                <div class="clearfix"></div>
            </div>
            <div class="x_content">
                <div class="form-group">    
                    <div class="col-md-2 col-sm-2 col-xs-12">                                            
                       <input type="text" value="<?=$menu_search?>" placeholder="Search on Id and Name"  class="form-control" name="menu_search" >
                    </div>                                        
                                                     
                    <div class="col-md-2 col-sm-2 col-xs-12">                                            
                        <select name="web_id" class="form-control" data-parsley-id="4353">
                            <option value="-1" >Select Website</option>
                            <?php
                            foreach ($list_website as $key => $arr_web) {
                            ?>
                                <option <?=($arr_web['web_id']==$web_id) ? 'selected' : '' ?> value="<?=$arr_web['web_id']?>" ><?=$arr_web['domain']?></option>
                            <?php
                            }
                            ?>
                        </select>
                     </div>
                     <div class="col-md-2 col-sm-2 col-xs-12">
                        <select class="form-control" name="menu_type" data-parsley-id="4353">
                            <option value="-1" >Select Menu Type</option>
                            <?php
                                $arr_menu_type=json_decode(MENU_TYPES);
                                foreach ($arr_menu_type as $menu_key => $menu_name) {
                            ?>
                                <option <?=($menu_key==$menu_type) ? 'selected' : '' ?> value="<?=$menu_key?>" ><?=$menu_name?></option>
                            <?php 
                                }
                            ?>                                                                                                      
                        </select>
                     </div>                                     
                    <div class="col-md-2 col-sm-2 col-xs-12">                                            
                        <select name="status" class="form-control" data-parsley-id="4353">
                            <option <?=($status=='-1') ? 'selected' : '' ?> value="-1" >Select Status</option>
                            <option <?=($status=='1') ? 'selected' : '' ?> value="1" >Active</option>
                            <option <?=($status=='0') ? 'selected' : '' ?> value="0" >In Active</option>
                        </select>
                     </div>
                     <button type="submit" class="btn btn-dark">Filter</button>
                 </div>
                 <br>
                 <!--<h2>equatorappliances.com</h2>-->
                 <br>
               <table class="table table-hover">
                    <thead>
                        <tr>
                            <th>Sno.</th>
                            <th>Menu Item Id</th>
                            <th>Menu Item</th>                                                                                                                                              
                            <th>Parent Item </th>                                                
                            <th>Menu Type</th>                                                                                                                                             
                            <th>Website</th>                                                
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        include("../include/utility.php");
                                            //var_dump($list_parent);
                        foreach ($list_parent as $key => $arr_value) {
                             # code...
                        ?>
                            <tr>
                                <th scope="row"><?=$page_lower+1?></th>
                                <td><?=$arr_value["menu_id"]?></td>
                                <td><?=$arr_value["name"]?></td>
                                <td>
                                    <?php
                                        $html = "";
                                        if($arr_value["parent_menu_id"] != 0){  
                                            $menu_parent = $objMenu->getdetails($arr_value["parent_menu_id"]);
                                            $html = Utility::menuparents($arr_value["parent_menu_id"],"");
                                        } else {
                                            $html = "none";
                                        }
                                        echo $html;
                                    ?>
                                </td>
                                <td>
                                    <?php

                                        $arr_menu_type=json_decode(MENU_TYPES);
                                        $arr_menu_key = array();
                                        foreach ($arr_menu_type as $menu_key => $menu_name) {
                                            $arr_menu_key[] = $menu_key;
                                        }
                                        echo (in_array($arr_value["menu_type"], $arr_menu_key)) ? $arr_menu_type->$arr_value["menu_type"] : "General";
                                    ?>
                                </td>                                                
                                <td><?=$arr_value["website"]["name"]?></td>                                                                                             
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
                                        <a href="<?=SERVER_PATH?>view/edit_menu_item.php?id=<?=$arr_value['menu_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                        <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletemenu-API&id=<?=$arr_value['menu_id']?>" ><i class="fa fa-trash-o"></i> Delete </a>
                                </td>
                            </tr>

                        <?php
                            $page_lower++;
                         }
                        ?>
                    </tbody>
                </table>
                <div style="display:none;"  class="pagination pagination-split">
                    <?php    
                        $mainObj = $objMenu->listallparent($web_id, $menu_type, $status, $menu_search);
                        $list = $mainObj;
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
        </form>
    </div>
</div>

<?php include '../include/footer.php'; ?>            
</body>

</html>
