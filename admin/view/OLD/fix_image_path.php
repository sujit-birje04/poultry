<?php include '../include/head.php'; ?>

</head>

<?php 
    ini_set('display_errors', '1');     # don't show any errors...
    error_reporting(1);
    error_reporting(E_ALL);  # ...but do log them

    include("../include/utility.php");
    include '../include/header.php'; 
?>

<!-- page content -->
<div class="right_col" role="main">
<?php

    /*
    if (!class_exists('TBL_WEBSITE')) {
        include("../data/TBL_WEBSITE.php");
    }
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['logo_path'];
        $web_id = $arr_val['web_id'];
        $arr_image = explode('/admin/', $image_path);
        $new_image_path = '../admin/'.$arr_image[1];
        echo $image_path."--".$new_image_path."<br/>";
        $objInstance->editImage($web_id,$new_image_path);
    }
    */

    /*
    if (!class_exists('TBL_ARTICLE')) {
        include("../data/TBL_ARTICLE.php");
    }
    $objInstance = new TBL_ARTICLE();
    $mainObj = $objInstance->listallactive();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['image'];
        $web_id = $arr_val['a_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $objInstance->editImage($web_id,$new_image_path);
        }
    }
    */

    /*
    if (!class_exists('TBL_PRODUCT')) {
        include("../data/TBL_PRODUCT.php");
    }
    $objInstance = new TBL_PRODUCT();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['image'];
        $web_id = $arr_val['product_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $result = $objInstance->editImage($web_id,$new_image_path);
            echo $result['msg'];
        }
    }
    */

    /*
    if (!class_exists('Configuration')) {
        include("../config/database.php");
    }
    if (!class_exists('TBL_PRODUCT_UNIQUE')) {
        include("../data/TBL_PRODUCT_UNIQUE.php");
    }
    $objInstance = new TBL_PRODUCT_UNIQUE();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj;
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['image'];
        $web_id = $arr_val['unique_product_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $result = $objInstance->editImage($web_id,$new_image_path);
            echo $result['msg'];
        }
    }
    */

    /*
    if (!class_exists('TBL_PRODUCT_CATEGORY')) {
        include("../data/TBL_PRODUCT_CATEGORY.php");
    }
    $objInstance = new TBL_PRODUCT_CATEGORY();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['image'];
        $web_id = $arr_val['prc_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $result = $objInstance->editImage($web_id,$new_image_path);
            echo $result['msg'];
        }
    }
    */

    /*
    if (!class_exists('TBL_PRODUCT_IMAGES')) {
        include("../data/TBL_PRODUCT_IMAGES.php");
    }
    $objInstance = new TBL_PRODUCT_IMAGES();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['image_link'];
        $web_id = $arr_val['p_image_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $result = $objInstance->editImage($web_id,$new_image_path);
            echo $result['msg'];
        }
    }
    */
    /*
    if (!class_exists('Configuration')) {
        include("../config/database.php");
    }
    if (!class_exists('TBL_PRODUCT_IMAGES_UNIQUE')) {
        include("../data/TBL_PRODUCT_IMAGES_UNIQUE.php");
    }
    $objInstance = new TBL_PRODUCT_IMAGES_UNIQUE();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['image_link'];
        $web_id = $arr_val['p_image_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $result = $objInstance->editImage($web_id,$new_image_path);
            echo $result['msg'];
        }
    }
    */

    if (!class_exists('Configuration')) {
        include("../config/database.php");
    }
    if (!class_exists('TBL_PRODUCT_FILES_UNIQUE')) {
        include("../data/TBL_PRODUCT_FILES_UNIQUE.php");
    }
    $objInstance = new TBL_PRODUCT_FILES_UNIQUE();
    $mainObj = $objInstance->listall();
    $list_web = $mainObj['data'];
    foreach ($list_web as $key => $arr_val) {
        $image_path = $arr_val['file_link'];
        $web_id = $arr_val['p_file_id'];
        if(!empty($image_path)){
            $arr_image = explode('/admin/', $image_path);
            $new_image_path = '../admin/'.$arr_image[1];
            echo $image_path."--".$new_image_path."<br/>";
            $result = $objInstance->editImage($web_id,$new_image_path);
            echo $result['msg'];
        }
    }
        

?>

<?php include '../include/footer.php'; ?>            
</body>

</html>
