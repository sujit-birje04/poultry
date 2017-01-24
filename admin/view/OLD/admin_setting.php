<?php
    // Saving settings
    $file_name = '../config/settings.config';
    if(isset($_REQUEST['save_setting'])){
        $arr_json = array();
        $arr_json['path'] = $_REQUEST['path'];
        $arr_json['host'] = $_REQUEST['host'];
        $arr_json['page'] = $_REQUEST['page'];
        $myfile = fopen($file_name, "w") or die("Unable to open file!");
        $jsonSettings_text = json_encode($arr_json);
        fwrite($myfile, $jsonSettings_text);
    }
?>
<!DOCTYPE html>
<html>
<head>
<style>
    #header {
        background-color:black;
        color:white;
        text-align:center;
        padding:5px;
    }
    #nav {
        line-height:30px;
        background-color:#eeeeee;
        height:300px;
        width:100px;
        float:left;
        padding:5px;
    }
    #section {
        padding:10px;
    }
    #footer {
        background-color:black;
        color:white;
        clear:both;
        text-align:center;
        padding:5px;
    }
    .tbl_settings{
        width: 500px;
        margin: 0 auto;
    }

    .tbl_settings td{
        padding: 5px;
        text-align: left;
    }

    .tbl_settings th{
        padding: 5px;
        text-align: left;
    }

    .text_box{
        height: 30px;
        padding: 5px;
        width: 250px;
        border: #ccc thin solid;
    }

    .home_settings {
        width: 30%;
        display: inline-block;
        height: 40px;
        border: #CCC thin solid;
        line-height: 40px;
        margin: 5px;
        font-size: 15px;
        font-weight: bold;
    }

</style>
</head>
<body>
    <?php
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
    <div id="header">
        <h1>Settings</h1>
    </div>

    <div id="section">
        <form name="frm_setting" method="post" >
            <table class="tbl_settings" >
                <tr>
                    <th>Website Path</th>
                    <td>:</td>
                    <td><input type="text" name="path"  class="text_box" value="<?=$jsonSettings->path?>" > </td>
                </tr>
                <tr>
                    <th>Website Host</th>
                    <td>:</td>
                    <td><input type="text" name="host"  class="text_box" value="<?=$jsonSettings->host?>" > </td>
                </tr>
                <tr>
                    <th>Page Limit</th>
                    <td>:</td>
                    <td><input type="text" name="page"  class="text_box" value="<?=$jsonSettings->page?>" > </td>
                </tr>
                <tr>
                    <td colspan="3" >
                        <input type="submit" name="save_setting" value="Save Settings" class="btn" />
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>

