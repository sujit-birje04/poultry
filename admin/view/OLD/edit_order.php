<?php include '../include/head.php'; ?>
</head>

<?php 
    include '../include/header.php'; 
    include("../include/utility.php");
?>

<?php
    $id = isset($_REQUEST["id"]) ? $_REQUEST["id"] : 0;
?>
<!-- page content -->
<div class="right_col" role="main">
  <?php
    if(empty($id)){

  ?>
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                    Please check your input.
                </div>
        </div>
    </div>
<?php
    } else {

      include("../data/TBL_ORDERS.php");
      include("../data/TBL_ORDERED_PRODUCT.php");
      include("../data/TBL_SHIPPING_BILLING.php");
      include("../data/TBL_USERS.php");
      include("../data/TBL_CUSTOMER.php");
        
      include("../data/TBL_PRODUCT_UNIQUE.php");
      include("../data/TBL_PRODUCT.php");

      include("../data/TBL_SHIPPING_METHODS.php");
      include("../data/TBL_PAYMENT_METHODS.php");

      $objMenu = new TBL_ORDERS();
      $mainObj = $objMenu->getdetails($id);
      $orderDetails = $mainObj;

      $shipping_add = isset($orderDetails['shipping_address']) ? $orderDetails['shipping_address'] : array();
      $billing_add = isset($orderDetails['billing_address']) ? $orderDetails['billing_address'] : array();

      //var_dump($details);
      //die();
?>
   <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12">
            <div class="x_panel">
                <form id="frm_menu" name="frm_menu" data-parsley-validate class="form-horizontal form-label-left">
                    <div class="x_title">
                        <h2>Order Information
                            <?php
                                if($orderDetails['order_status'] == 4){
                                    echo '<b><button type="button" class="btn btn-success btn-xs">Complete</button></b>';

                                } else if($orderDetails['order_status'] == 2){
                                    echo '<b><button type="button" class="btn btn-danger btn-xs">Rejected</button></b>';

                                } else if($orderDetails['order_status'] == 3){
                                    echo '<b><button type="button" class="btn btn-danger btn-xs">Cancelled</button></b>';

                                } else if($orderDetails['order_status'] == 5){
                                    echo '<b><button type="button" class="btn btn-warning btn-xs">In Process</button></b>';

                                } else if($orderDetails['order_status'] == 7){
                                    echo '<b><button type="button" class="btn btn-warning btn-xs">Dispatched</button></b>';

                                } else if($orderDetails['order_status'] == 6){
                                    echo '<b><button type="button" class="btn btn-warning btn-xs">Shipping</button></b>';

                                } else {
                                    echo '<b><button type="button" class="btn btn-warning btn-xs">Pending</button></b>';        
                                }
                            ?>
                        </h2>
                        <div class="form-group">
                            <div class="col-md-6 col-sm-6 col-xs-12 pull-right text-right">                            
                              <div class="btn">
                                <img id="wait_loader" src="<?=SERVER_PATH?>img/loading.gif" />
                              </div>
                                <button  call_url="<?=SERVER_PATH?>view/manage_order.php" type="button" name="btn_cancel" id="btn_cancel" class="btn btn-primary">Cancel</button>        
                            </div>
                        </div>
                        <div class="clearfix"></div>
                    </div>
                     <div class="content-area">               
                        <section class="page-section color">
                            <div class="container">
                                <div class="row">
                                  <div class="account-border">
                                      <table class="table table-bordered table-hover">
                                        <thead>
                                          <tr>
                                              <td class="text-left">              
                                                <b>Order ID:</b> #<?=$orderDetails['order_id']?><br>
                                                <b>Order Date:</b> <?=date('d/m/Y', strtotime($orderDetails['created_on']))?>
                                              </td>
                                              <td class="text-left">    
                                                  <?php
                                                    $paymentDetails = $orderDetails['payment_method_details'];
                                                    $shippingDetails = $orderDetails['shipping_method_details'];
                                                    
                                                  ?>          
                                                  <b>Payment Method : </b><?=!empty($paymentDetails) ? $paymentDetails['method_name'] : 'Not Set' ?><br>
                                                  <b>Shipping Method : </b><?=!empty($shippingDetails) ? $shippingDetails['method_name'] : 'Not Set' ?>              
                                              </td>
                                          </tr>
                                        </thead>
                                      </table>

                                      <table class="table table-bordered table-hover">
                                        <thead>
                                          <tr>
                                            <td class="text-left"><b>Billing Address</b></td>
                                            <td class="text-left"><b>Shipping Address</b></td>
                                          </tr>
                                        </thead> 
                                        <tbody>
                                          <tr>
                                            <td class="text-left">
                                              <?php

                                                include("../data/TBL_COUNTRY.php");                     
                                                $objCountry = new TBL_COUNTRY();
                                                if(!empty($billing_add)){
                                                  $country = $objCountry->getdetails($billing_add['country']);
                                                  $country_name = empty($country) ? '' : $country['name'];

                                              ?>
                                                <?=$billing_add['comp_apt']?>
                                                <br><?=$billing_add['add1']?>
                                                <br><?=$billing_add['add2']?>
                                                <br><?=$billing_add['city']?> <?=$billing_add['postcode']?>
                                                <br><?=$billing_add['state']?>
                                                <br><?=$country_name?>
                                              <?php
                                                } else {
                                              ?>
                                                Billing address is not set
                                              <?php
                                                }
                                              ?>
                                            </td>
                                            <td class="text-left">
                                              <?php
                                                if(!empty($shipping_add)){
                                                  $country = $objCountry->getdetails($shipping_add['country']);
                                                  $country_name = empty($country) ? '' : $country['name'];
                                              ?>
                                                <?=$shipping_add['comp_apt']?>
                                                <br><?=$shipping_add['add1']?>
                                                <br><?=$shipping_add['add2']?>
                                                <br><?=$shipping_add['city']?> <?=$shipping_add['postcode']?>
                                                <br><?=$shipping_add['state']?>
                                                <br><?=$country_name?>
                                              <?php
                                                } else {
                                              ?>
                                                Shipping address is not set
                                              <?php
                                                }
                                              ?>
                                            </td>
                                          </tr>
                                        </tbody>
                                      </table>     
                                      <div class="table-responsive">
                                        <table class="table table-bordered table-hover">
                                          <thead>
                                            <tr>
                                              <th class="text-left">Product Name</th>
                                              <th class="text-left">Product Code</th>
                                              <th class="text-right">Quantity</th>
                                              <th class="text-right">Price</th>
                                              <th class="text-right">Total</th>
                                            </tr>
                                          </thead>
                                          <tbody>
                                            <?php
                                              $product_list = isset($orderDetails['product_list']) ? $orderDetails['product_list'] : array();
                                              foreach ($product_list as $key => $product) {        
                                            ?>
                                            <tr>
                                              <td class="text-left"><?=$product['product']['name']?></td>
                                              <td class="text-left"><?=$product['product']['code']?></td>
                                              <td class="text-right"><?=$product['quantity']?></td>
                                              <td class="text-right">$<?=round($product['price'], 2)?></td>
                                              <td class="text-right">$<?=round(($product['quantity'] * $product['price']), 2)?></td>                    
                                            </tr>
                                            <?php
                                              }
                                            ?>
                                          </tbody>
                                          <tfoot>
                                            <tr>
                                              <td colspan="3"></td>
                                              <td class="text-right"><b>Discount</b></td>
                                              <td class="text-right">$<?=round($orderDetails['discount'], 2)?></td>
                                            </tr>
                                            <tr>
                                              <td colspan="3"></td>
                                              <td class="text-right"><b>Sub-Total</b></td>
                                              <td class="text-right">$<?=round($orderDetails['price'] - $orderDetails['discount'], 2)?></td>
                                            </tr>
                                            <tr>
                                              <td colspan="3"></td>
                                              <td class="text-right"><b>Shipping Cost</b></td>
                                              <td class="text-right">$<?=round($orderDetails['shipping_charge'], 2)?></td>
                                            </tr>
                                            <?php                     
                                            $coupon_id = $orderDetails['coupon_id'];
                                            $coupon_discount = $orderDetails['coupon_discount'];
                                            if($coupon_discount != 0){
                                            ?>
                                            <tr>
                                              <td colspan="3"></td>
                                              <td class="text-right"><b>Coupon Discount</b></td>
                                              <td class="text-right" >$<?=round($coupon_discount, 2)?></td>
                                            </tr>

                                            <?php
                                            }
                                            ?>

                                            <tr>
                                              <td colspan="3"></td>
                                              <td class="text-right"><b>Total</b></td>
                                              <td class="text-right">$<?=round(($orderDetails['price']+$orderDetails['shipping_charge']-$orderDetails['discount']-$coupon_discount), 2)?></td>
                                            </tr>

                                            <tr>
                                                <td colspan="5" align="right" >
                                                  <a href="#" class="btn btn-success btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$orderDetails['order_id']?>&status=4" ><i class="fa fa-edit"></i> Complete </a>          
                                                  <a href="#" class="btn btn-warning btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$orderDetails['order_id']?>&status=5" ><i class="fa fa-edit"></i> In Process </a>          
                                                  <a href="#" class="btn btn-warning btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$orderDetails['order_id']?>&status=7" ><i class="fa fa-edit"></i> Dispatched </a>          
                                                  <a href="#" class="btn btn-warning btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$orderDetails['order_id']?>&status=6" ><i class="fa fa-edit"></i> Shipping</a>          
                                                  <a href="#" class="btn btn-danger btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$orderDetails['order_id']?>&status=2" ><i class="fa fa-edit"></i> Reject </a>          
                                                  <a href="#" class="btn btn-warning btn-xs btn_change" call_link="<?=SERVER_PATH?>controller/controller.php?method=changestatusorder-API&id=<?=$orderDetails['order_id']?>&status=1" ><i class="fa fa-edit"></i> Pending </a>                       
                                                  <div class="form-group alert alert-success frm_error_message" >
                                                                                       
                                                  </div>
                                                </td>
                                            </tr>
                                          </tfoot>
                                        </table>
                                      </div>
                                    </div>
                                  </div>
                                </div>
                              </section>
                            </div>
                          </form>
                        </div><!-- x_panel -->
                      </div>
                    </div>
<?php
    }
?>

<?php include '../include/footer.php'; ?>            
</body>

</html>
