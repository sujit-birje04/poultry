<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php
    include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallretail();
    $list_retail = $mainObj["data"];
    unset($mainObj);

    $mainObj = $objInstance->listallinformative();
    $list_informative = $mainObj["data"];
    
?>

<!-- page content -->
<div class="right_col" role="main">

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
			<div class="x_title">
				<h2>Retail Websites</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Sn.No</th>
							<th>Website Id</th>
							<th>Domain</th>
							<th>Website Name</th>     
                            <th>Logo</th>                                           
							<th>Sort Order</th>                                                
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
                        <?php
                        if(!empty($list_retail)){
                            foreach ($list_retail as $key => $cur_array) {                            
                        ?>
								<tr>
									<th scope="row"><?=$key+1?></th>
									<td><?=$cur_array["web_id"]?></td>
									<td> <a href="<?=$cur_array["domain"]?>"><?=$cur_array["domain"]?></a></td>
									<td><?=$cur_array["name"]?></td>
		                            <td>
		                                <img src="../<?=$cur_array['logo_path']?>" width="30" />
		                            </td>      
		                            <td><?=$cur_array["sort_order"]?></td>                                               
									<td>
									   <a href="<?=SERVER_PATH?>view/edit_website.php?id=<?=$cur_array['web_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
							   		   <a href="<?=SERVER_PATH?>view/web-setting.php?web_id=<?=$cur_array['web_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Settings </a>
									   <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletewebsite-API&id=<?php echo $cur_array['web_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
									</td>
								</tr>
                         <?php
                            }
                        } else {
                        ?>
                        	<tr>
                        		<td colspan="6" >No website Present</td>
                        	</tr>

                        <?php
                        }
                            ?>
					</tbody>
				</table>

				<h2>Informative Websites</h2>
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Sn.No.</th>
							<th>Website Id</th>
							<th>Domain</th>
							<th>Website Name</th>   
                            <th>Logo</th>    
							<th>Sort Order</th>    
							<th>Action</th>
						</tr>
					</thead>
					<tbody>

                        <?php
                        if(!empty($list_informative)){
                            foreach ($list_informative as $key=>$cur_array) {
                            
                        ?>
						<tr>
							<th scope="row"><?=$key+1?></th>
							<td><?=$cur_array["web_id"]?></td>
							<td> <a href="<?=$cur_array["domain"]?>"><?=$cur_array["domain"]?></a></td>
							<td><?=$cur_array["name"]?></td>
                            <td>
                                <img src="../<?=$cur_array['logo_path']?>" width="30" />
                            </td>      
                            <td><?=$cur_array["sort_order"]?></td>                                               
							<td>
							   <a href="<?=SERVER_PATH?>view/edit_website.php?id=<?=$cur_array['web_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
							   <a href="<?=SERVER_PATH?>view/web-setting.php?web_id=<?=$cur_array['web_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Settings </a>
							   <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletewebsite-API&id=<?php echo $cur_array['web_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
							</td>
						</tr>
                            <?php
                            }
                           } else {
                        ?>
                        	<tr>
                        		<td colspan="6" >No website Present</td>
                        	</tr>

                        <?php
                           }
                            ?>

					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<?php include '../include/footer.php'; ?>            
</body>

</html>
