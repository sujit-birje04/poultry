<?php include '../include/head.php'; ?>

</head>

<?php include '../include/header.php'; ?>

<?php

    include("../data/TBL_DEALER.php");
     $web_id = "-1";
    if(isset($_REQUEST['website_id'])){
        $web_id = $_REQUEST['website_id'];
    }
    $objInstance = new TBL_DEALER();
    //echo "hi"; 
   
    $mainObj = $objInstance->listallretail($web_id);
    $list_retail = $mainObj["data"];
      // var_dump($list_retail);
   include("../data/TBL_WEBSITE.php");
    $objInstance = new TBL_WEBSITE();
    $mainObj = $objInstance->listallactive();
    $list_website = $mainObj["data"];

    unset($mainObj);

   // $mainObj = $objInstance->listallinformative();
   // $list_informative = $mainObj["data"];
    
?>

<!-- page content -->
<div class="right_col" role="main">

<div class="row">
    <div class="col-md-12 col-sm-12 col-xs-12">
		<div class="x_panel">
		  <div class="form-group">
                <form name="dealer_search" action="">
                   
                    <div class="col-md-2 col-sm-2 col-xs-12">
                      <select class="select2_multiple form-control"  name="website_id" >
                                          <option>Choose Website</option>
                                            <?php
                                            $arr_publish_on =  $details['website_id'];

                                                foreach ($list_website as $key => $arr_val) {
                                            ?>
                                                <option value="<?=$arr_val['web_id']?>"  <?= $arr_val['web_id']=$arr_publish_on ? "selected" : ""?> ><?=$arr_val["domain"]?></option>
                                            <?php
                                                }
                                            ?>
                                      </select>
                    </div>
                   

                   

                   

                    <button type="submit" class="btn btn-dark">Filter</button>
                </form>
            </div>

			<div class="x_title">
				<h2>Dealers</small></h2>
				<div class="clearfix"></div>
			</div>
			<div class="x_content">
				<table class="table table-hover">
					<thead>
						<tr>
							<th>Sn.No</th>
							<th>Dealer Id</th>
							<th>Dealer Name</th>
							<th>Address</th> 
							<th>City</th>
							<th>State</th>
							<th>Zip Code</th>
							
							<th>email</th>
                            <th>Dealer Website</th>
							<th>Working Hours</th>    
                            <th>Sort Order</th>
                            <th>Status</th>                                          
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
									<td><?=$cur_array["dealer_id"]?></td>
								    <td><?=$cur_array["name"];?></td>
									<td> <?=$cur_array["address"];?></td>
									<td> <?=$cur_array["City"];?></td>
									<td> <?=$cur_array["State"];?></td>

		                            <td>
		                                <?=$cur_array["zipcode"];?>
		                            </td> 
		                            <td> <?=$cur_array["email"];?></td>
                                    <td> <?=$cur_array["dealer_website"];?></td>     
		                             <td> <?=$cur_array["working_hours"];?></td>
		                             <td> <?=$cur_array["sort_order"];?></td>
		                             
		                              <?php
                                if(empty($cur_array["is_active"])){
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
									   <a href="<?=SERVER_PATH?>view/edit_dealer.php?id=<?=$cur_array['dealer_id']?>" class="btn btn-info btn-xs"><i class="fa fa-pencil"></i> Edit </a>
							   		   
									   <a href="#" class="btn btn-danger btn-xs btn_delete" call_link="<?=SERVER_PATH?>controller/controller.php?method=deletedealer-API&id=<?php echo $cur_array['dealer_id']; ?>" ><i class="fa fa-trash-o"></i> Delete </a>
									</td>
								</tr>
                         <?php
                            }
                        } else {
                        ?>
                        	<tr>
                        		<td colspan="6" >No Dealer Present</td>
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
