<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php

    $id = isset($_REQUEST["web_id"]) ? $_REQUEST["web_id"] : 0;

    $is_error = 0;
    $message = '';
    if(empty($id)){
        $is_error = 1;
        $message = 'Web id not send.';
    }

    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->getdetails($id);
    $details = $mainObj;
    
    if(empty($details)){
        $is_error = 1;
        $message = 'Website not present.';
    }
    if($is_error == 0){
        $folder_name = $details['web_path'];
        $filename = $folder_name."settings.config";
        if (!file_exists($filename)) {
            $is_error = 1;
            $message = 'Website path is not correct.';
        }
    }

    if($is_error == 0){
        if(isset($_REQUEST['save_setting'])){
            $arr_json = array();
            $arr_json['web_id'] = $_REQUEST['web_id'];
            $arr_json['path'] = $_REQUEST['path'];
            $arr_json['host'] = $_REQUEST['host'];
            $arr_json['theme'] = $_REQUEST['theme'];
            $arr_json['comman_path'] = $_REQUEST['comman_path'];
            $arr_json['admin_path'] = $_REQUEST['admin_path'];
            $arr_json['comment_email'] = $_REQUEST['comment_email'];
            $arr_json['paypal_email'] = $_REQUEST['paypal_email'];

            $arr_json['site_title'] = isset($_REQUEST['site_title']) ? $_REQUEST['site_title'] : '';
            $arr_json['announcement'] = isset($_REQUEST['announcement']) ? 1 : 0;
            $arr_json['home_types'] = isset($_REQUEST['home_types']) ? 1 : 0;
            $arr_json['our_product'] = isset($_REQUEST['our_product']) ? 1 : 0;
            $arr_json['latest_posts'] = isset($_REQUEST['latest_posts']) ? 1 : 0;
            $arr_json['latest_videos'] = isset($_REQUEST['latest_videos']) ? 1 : 0;
            //Get this file from web ID
            $myfile = fopen($filename, "w") or die("Unable to open file!");
            $jsonSettings_text = json_encode($arr_json);
            fwrite($myfile, $jsonSettings_text);
        }
    }



        if($is_error == 1){
?>
        <div class="right_col" role="main">
            <div class="row">
                <div class="col-md-12 col-sm-12 col-xs-12">
                        <div class="x_panel">
                            <?=$message?>
                        </div>
                </div>
            </div>
        </div>
<?php
        } else {

            $myfile = fopen($filename, "r") or die("Unable to open file!");
            $jsonSettings = json_decode(fgets($myfile));
            fclose($myfile);
            if(empty($jsonSettings)){
                $jsonSettings = array(
                        'web_id' => '',
                        'path' => '',
                        'host' => '',
                        'theme' => '',
                        'comman_path' => '',
                        'admin_path' => '',
                        'comment_email' => '',
                        'paypal_email' => '',
                        'site_title' => '',
                        'announcement' => 0,
                        'home_types' => 0,
                        'our_product' => 0,
                        'latest_posts' => 0,
                        'latest_videos' => 0,
                    );
            }

?>

<!-- page content -->
<div class="right_col" role="main">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    <form name="frm_website" method="post" id="frm_website" data-parsley-validate class="form-horizontal form-label-left">
                        <div class="x_title">
                            <h2>Make Website Settings</h2>
                            <div class="clearfix"></div>
                        </div>


                        <div id="section">
                            <form name="frm_setting" method="post" >
                                <table class="tbl_settings col-md-6" >
                                    <tr>
                                        <th>Website Id</th>
                                        <td>:</td>
                                        <td>

                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <input readonly type="text" name="web_id"  class="form-control col-md-7 col-xs-12" value="<?=$id?>" >
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Website Path</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="path"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->path?>" >
                                            </div> 
                                        </td>

                                    </tr>
                                    <tr>
                                        <th>Website Host</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="host"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->host?>" > 
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Website Theme</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="theme"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->theme?>" > 
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Comman Path</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="comman_path"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->comman_path?>" > 
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Admin Path</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="admin_path"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->admin_path?>" > 
                                            </div> 
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>Comment Email</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="comment_email"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->comment_email?>" > 
                                            </div> 
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Paypal Email</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="paypal_email"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->paypal_email?>" > 
                                            </div> 
                                        </td>
                                    </tr>

                                    
                                    <tr>
                                        <th>Website Title</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <textarea name="site_title"  class="form-control col-md-7 col-xs-12" ><?=$jsonSettings->site_title?></textarea> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th style="text-align:center;" colspan="3" >Home page settings
                                            <hr/>
                                        </th>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            <div class="home_settings" >
                                                <lable>
                                                <input type="checkbox" name="announcement" <?=!empty($jsonSettings->announcement)? 'checked' : ''?> /> Announcement
                                                </lable> 
                                            </div>
                                            <div class="home_settings" >
                                                <lable>
                                                <input type="checkbox" name="home_types" <?=!empty($jsonSettings->home_types)? 'checked' : ''?> /> Types
                                                </lable> 
                                            </div>
                                            <div class="home_settings" >
                                                <lable>
                                                <input type="checkbox" name="our_product" <?=!empty($jsonSettings->our_product)? 'checked' : ''?> /> Our products
                                                </lable> 
                                            </div>
                                            <div class="home_settings" >
                                                <lable>
                                                <input type="checkbox" name="latest_posts" <?=!empty($jsonSettings->latest_posts)? 'checked' : ''?> /> Latest Posts
                                                </lable> 
                                            </div>
                                            <div class="home_settings" >
                                                <lable>
                                                <input type="checkbox" name="latest_videos" <?=!empty($jsonSettings->latest_videos)? 'checked' : ''?> /> Latest Video
                                                </lable> 
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3" >
                                            <input type="submit" name="save_setting" value="Save Settings" class="btn" />
                                        </td>
                                    </tr>
                                </table>
                            </form>
                        </div>
                        <hr/>
                        
                    </form>
                </div>

                <div class="clearfix"></div>
        </div>
    </div>
                <!-- x_panel -->
</div>
    <?php
    }
    ?>
</div>


<?php include '../include/footer.php'; ?>            
</body>

</html>
