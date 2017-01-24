<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    $is_error = 0;
    $message = '';
    $file_name = '../config/settings.config';
    if (!file_exists($file_name)) {
        $is_error = 1;
        $message = 'File not present';
    }
    
    if($is_error == 0){
        if(isset($_REQUEST['save_setting'])){
            $arr_json = array();
            $arr_json['path'] = $_REQUEST['path'];
            $arr_json['host'] = $_REQUEST['host'];
            $arr_json['page'] = $_REQUEST['page'];
            $myfile = fopen($file_name, "w") or die("Unable to open file!");
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

            $myfile = fopen($file_name, "r") or die("Unable to open file!");
            $jsonSettings = json_decode(fgets($myfile));
            fclose($myfile);
            if(empty($jsonSettings)){
                $jsonSettings = array(
                        'web_id' => '',
                        'path' => '',
                        'host' => '',
                        'page' => '',
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
                            <h2>Make Admin Settings</h2>
                            <div class="clearfix"></div>
                        </div>


                        <div id="section">
                            <form name="frm_setting" method="post" >
                                <table class="tbl_settings col-md-6" >
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
                                        <th>Page Limit</th>
                                        <td>:</td>
                                        <td>
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                            <input type="text" name="page"  class="form-control col-md-7 col-xs-12" value="<?=$jsonSettings->page?>" > 
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
