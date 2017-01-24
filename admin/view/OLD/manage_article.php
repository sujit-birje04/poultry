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



    $article_cat = -1;
    if(isset($_REQUEST['article_cat'])){
        $article_cat = $_REQUEST['article_cat'];
    }
    $article_id = '';
    if(isset($_REQUEST['article_id'])){
        $article_id = $_REQUEST['article_id'];
    }
    $article_web = -1;
    if(isset($_REQUEST['article_web'])){
        $article_web = $_REQUEST['article_web'];
    }
    $is_active = -1;
    if(isset($_REQUEST['is_active'])){
        $is_active = $_REQUEST['is_active'];
    }

    /*
    include("../data/TBL_ARTICLE_PUBLISHED.php");
    $objArticlePublish = new TBL_ARTICLE_PUBLISHED();
    $mainObj = $objArticlePublish->listallactive($article_web, $article_cat, $article_id);
    $list_publish = $mainObj["data"];
    //var_dump($list_publish);
    */

    if (!class_exists('TBL_ARTICLE')) {
        include("../data/TBL_ARTICLE.php");
    }
    $objInstance = new TBL_ARTICLE();
    $list_articles = $objInstance->listallarticles($article_cat, $article_id, $article_web, $is_active,$page_lower,$page_upper);


    if (!class_exists('TBL_ARTICLE_CATEGORY')) {
        include("../data/TBL_ARTICLE_CATEGORY.php");
    }
    $objArticleCat = new TBL_ARTICLE_CATEGORY();
    $mainObj = $objArticleCat->listallactive();
    $list_category = $mainObj["data"];

    if (!class_exists('TBL_WEBSITE')) {
        include("../data/TBL_WEBSITE.php");
    }
    $objWeb = new TBL_WEBSITE();
    $mainObj = $objWeb->listallactive();
    $list_website = $mainObj["data"];
    
?>

<!-- page content -->
<div class="right_col" role="main">
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <div class="x_title">
                    <h2>Manage Content</h2>
                    <div class="clearfix"></div>
                </div>
                <div class="x_content">
                    <div class="form-group">
                        <form name="frm_article" action="">
                            <div class="col-md-2 col-sm-2 col-xs-12">                                            
                               <input type="text" value="<?=$article_id?>" placeholder="Search Article"  class="form-control" name="article_id" >
                            </div>                                        
                           
                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select  name="article_cat"  class="form-control" data-parsley-id="4353">
                                    <option value="-1">Select Category</option>
                                    <?php
                                      foreach ($list_category as $key => $arr_val) {
                                    ?>
                                      <option <?=($arr_val['ac_id']==$article_cat) ? 'selected' : '' ?> value="<?=$arr_val['ac_id']?>" ><?=$arr_val["title"]?></option>
                                    <?php
                                      }
                                    ?>
                                </select>
                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-12">
                                <select class="form-control" name="article_web" data-parsley-id="4353">
                                    <option  name="article_web"  value="-1">All Website</option>                                                        
                                    <?php
                                        foreach ($list_website as $key => $arr_val) {
                                    ?>
                                        <option <?=($arr_val['web_id']==$article_web) ? 'selected' : '' ?> value="<?=$arr_val['web_id']?>" ><?=$arr_val["domain"]?></option>
                                    <?php
                                        }
                                    ?>
                                    <option  name="article_web"  value="-2">Unpublished</option>  
                                </select>
                            </div>

                            <div class="col-md-2 col-sm-2 col-xs-12">                                            
                                <select name="is_active" class="form-control" data-parsley-id="4353">
                                    <option <?=($is_active=='-1') ? 'selected' : '' ?> value="-1" >Select Status</option>
                                    <option <?=($is_active=='1') ? 'selected' : '' ?> value="1" >Active</option>
                                    <option <?=($is_active=='0') ? 'selected' : '' ?> value="0" >In Active</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-dark">Filter</button>
                        </form>
                    </div>
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>Sno.</th>
                                <th>Article ID</th>
                                <th>Article Title</th>
                                <th>Published on</th>                                                                                                                                                                                     
                                <th>Date</th>                                                                                                                                                                                         
                                <th>Is Featured</th>                                                                                                                                              
                                <th>Article Category </th>                    
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                                unset($arr_value);
                                foreach ($list_articles as $key => $arr_value) {
                            ?>
                                <tr>
                                    <th scope="row"><?=$page_lower+1?></th>
                                    <td><?=$arr_value["a_id"]?></td>
                                    <td><?=$arr_value["title"]?></td>
                                    <?php
                                        $websites = $arr_value['websites'];
                                        if(empty($websites)){
                                    ?>
                                    <td><button type="button" class="btn btn-danger btn-xs">Un Published</button></td>
                                    <?php
                                        } else {
                                            echo '<td>';
                                            foreach ($websites as $key => $website) {
                                    ?>
                                                <p><?=$website['name']?></p>
                                    <?php
                                            }
                                            echo '</td>';
                                        }
                                    ?>
                                    <td><?=date('Y-m-d', strtotime($arr_value["updated_on"]))?></td>
                                    <td><?=(empty($arr_value["is_featured"])) ? 'No' : 'Yes'?></td>
                                    <td><?=$arr_value["category"]["title"]?></td>
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
                                        <a href="<?=SERVER_PATH?>view/edit_article.php?id=<?=$arr_value['a_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
                                        <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deleteunpublishedarticle-API&id=<?php echo $arr_value['a_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
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
                            $mainObj = $objInstance->listallarticles($article_cat, $article_id, $article_web, $is_active);
                            $list = $mainObj;
                            $num = 1;
                            for ($i=0; $i<count($list) ; $i+=PAGE_LIMIT) { 
                                $color = ($i == $page) ? 'background:#EEE;' : '';
                                $param = "&article_id=$article_id&article_cat=$article_cat&article_web=$article_web";
                        ?>  
                            <li>
                                <a style="<?=$color?>"  href="<?=SERVER_PATH?>view/manage_article.php?page=<?=$num?><?=$param?>" ><?=$num?></a>
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
