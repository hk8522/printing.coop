<style>
.account-area-inner-box-single {
	padding: 35px 25px 40px 25px;
	border: 1px solid rgba(0,0,0,0.1);
	margin-top: 20px;
	background: #fff;
}
.account-area-inner-box-single .universal-small-dark-title {
	padding-bottom: 20px;
	border-bottom: 2px dashed rgba(0,0,0,0.1);
}
.account-area-inner-box-single .quote-bottom-row {
	margin-top: 25px;
}
.summary-deatil-inner ul {
	list-style: none;
	margin: 0px;
	padding: 0px;
}
.summary-deatil-inner ul li {
	padding: 10px 10px 10px 10px;
	border-bottom: 1px solid rgba(0,0,0,0.1);
}
.summary-deatil-inner ul li span {
	font-weight: 300;
	color: #555;
	font-size: 15px;
}
.summary-deatil-inner ul li strong {
	font-weight: 400;
	display: inline-block;
	color: #000;
	font-size: 15px;
}
.summary-deatil-inner ul li:last-child {
	border-bottom: none;
}
.account-area .product-information {
	margin: 60px 0px 0px 0px;
	border: none;
}
.quant-cart.text-left {
	justify-content: left !important;
}
.account-area .shop-cart-table {
    border-collapse: collapse;
    width: 100%;
}
.account-area .shop-cart-table thead th {
    font-size: 14px;
    font-weight: 500;
    color: #aaa;
    text-transform: uppercase;
    padding: 15px 5px;
    vertical-align: middle;
}
.account-area .quant-cart button:last-child {
    margin-left: 10px;
}
.account-area .shop-cart-table tbody td {
    padding: 20px 5px;
}
.account-area .shop-cart-table tr {
    border-bottom: 1px solid rgba(0,0,0,0.1);
    transition: .3s;
    vertical-align: top;
}
.account-area .shop-cart-table a.remove {
    width: 30px;
    height: 30px;
    font-size: 25px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #193e73;
    transition: .3s;
    border-radius: 50%;
}
.account-area .shop-cart-table a.remove:hover {
    color: #fff;
    background-color: #193e73;
    transition: .3s;
}
.account-area .shop-cart-table .product-thumbnail img {
    width: 100px;
    height: auto;
}
.account-area .shop-cart-table td.product-name a {
    font-size: 15px;
    font-weight: 600;
    color: #303030;
    transition: .3s;
}
.account-area .shop-cart-table td.product-name a:hover {
    color: #f58634;
    transition: .3s;
}
.account-area .shop-cart-table td.product-price1 {
	font-size: 15px;
	color: #303030;
	font-weight: 400;
	white-space: nowrap;
}
.account-area .shop-cart-table td.product-subtotal {
    font-size: 15px;
    color: #303030;
    font-weight: 400;
	white-space: nowrap;
}
.account-area .shop-cart-table .quant-cart {
    margin-top: 0px;
    justify-content: center;
}
.account-area .shop-cart-table .quant-cart input {
    width: 50px;
}
.account-area .shop-cart-table .coupon button {
	border: 1px solid #f58634;
	height: 40px;
	color: #fff;
	background: #f58634;
	padding: 5px 20px;
	font-size: 14px;
	font-weight: 600;
	text-transform: uppercase;
	transition: 0.3s;
	white-space: nowrap;
}
.account-area .shop-cart-table .coupon {
    text-align: left;
}
.account-area .shop-cart-table .checkout {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;
}
.account-area .shop-cart-table .cart-total span {
    font-size: 15px;
    font-weight: 400;
    color: #303030;
    word-spacing: 2px;
}
.account-area .shop-cart-table .cart-total {
    margin-right: 40px;
}
.account-area .cart-total span font {
    color: #193e73;
    font-size: 22px;
    font-weight: 600;
}
.account-area .shopping-product-display {
	overflow: initial;
	height: auto;
}
.account-area .shopping-product-display table {
	border-left: none;
	border-right: none;
}
</style>
<?php 
$currency_id=$orderData['currency_id'];
if(empty($currency_id)){
	$currency_id=1;
}
$OrderCurrencyData=$CurrencyList[$currency_id];
$order_currency_currency_symbol=$OrderCurrencyData['symbols'];
?>
<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
    	<div class="row">
    		<div class="col-xs-12 col-md-12">
    			<div class="box">
    				<div class="box-body">
        				<div class="inner-head-section">
        					<div class="inner-title">
        					    <span><?php echo ucfirst($page_title); ?></span>
        					</div>
        				</div>
						
        				<div class="my-account-main-section universal-spacing universal-bg-white">
                            <div class="my-account-section">
                                <div class="account-area">
                                    <div class="account-area-inner-boxes">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="account-area-inner-box-single">
                            		            	<div class="universal-small-dark-title">
                            		            		<span>Order Information</span>
                            		            	</div>
                            		            	<div class="quote-bottom-row summary-deatil">
                            		            		<div class="summary-deatil-inner">
                            			            		<ul>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Order Id</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo $orderData['order_id']?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                                                                 <li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Customer Code:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php if(!empty($orderData['user_id'])){
																				
																			        echo CUSTOMER_ID_PREFIX.$orderData['user_id'];
																			}else{
																			    echo "-";	
																			}
	?>																		</strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li> 
																<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Website:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo $StoreList[$orderData['store_id']]['name']?>
																	</strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>																
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Customer Name:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo ucfirst($orderData['name']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Customer Mobile:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo ucfirst($orderData['mobile']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Customer Email:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo ucfirst($orderData['email']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Order Amount:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo $order_currency_currency_symbol.number_format($orderData['total_amount'],2);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Order Status:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo getOrderSatusClass($orderData['status']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Order Date:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo dateFormate($orderData['created']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
																
													<li>
            			            			    <div class="row">
            			            			        <div class="col-md-6">
            			            			            <span>Shipping Method:</span>
            			            			        </div>
            			            			        <div class="col-md-6">
            			            			            <strong>
														
											   <?php 				
													  $Method = getShipingName($orderData);
														
											            if(!empty($Method)){
															
													        echo $Method;
															
														}else{
															
			                $shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
							if($shipping_method_formate[0]=="pickupinstore"){
																
																$pickupStore=$this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
																echo 'Pickup In Store<br>'.$pickupStore['name']."<br>".$pickupStore['address']."<br>".$pickupStore['phone'];
															}
														}
														
												       
												        ?>
															</strong>
            			            			        </div>
            			            			    </div>
            			            			</li>
												<?php 
							$shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
							$flag_shiping_cost=$orderData['flag_shiping_cost'];
							if($shipping_method_formate[0]=="flagship" && $flag_shiping_cost !=0.00 && !empty($flag_shiping_cost)){
												?>
												<li>
            			            			   <div class="row">
            			            			        <div class="col-md-6">
            			            			            <span>Flagship Shipping Cost:</span>
            			            			        </div>
            			            			        <div class="col-md-6">
            			            			            <strong>
														
											           <?php 
														
													    echo $order_currency_currency_symbol."".number_format($flag_shiping_cost,2)
												       
												        ?>
															</strong>
            			            			        </div>
            			            			    </div>
            			            			</li>
							<?php }?>
                            								</ul>
                            							</div>
                            						</div>
                            					</div>
                                                <div class="account-area-inner-box-single">
                            		            	<div class="universal-small-dark-title">
                            		            		<span>Payment Information</span>
                            		            	</div>
                            		            	<div class="quote-bottom-row summary-deatil">
                            		            		<div class="summary-deatil-inner">
                            			            		<ul>
                            			            			<!--<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Payment Type:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo ucfirst($orderData['payment_type']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>-->
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Payment Method:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo ucfirst($orderData['payment_type']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Payment Status:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo getOrderPaymentStatus($orderData['payment_status']);?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Payment Transition Id:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong><?php echo $orderData['transition_id'];?></strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            								</ul>
                            							</div>
                            						</div>
                            					</div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="account-area-inner-box-single">
                            		            	<div class="universal-small-dark-title">
                            		            		<span>Billing Information</span>
                            		            	</div>
                            		            	<div class="quote-bottom-row summary-deatil">
                            		            		<div class="summary-deatil-inner">
                            			            		<ul>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Billing Address:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong>
                            			            			              <?php echo ucfirst($orderData['billing_name']);?>
                                                                                <br>
                                                                                Mobile: <?php echo ucfirst($orderData['billing_mobile']);?><?php echo !empty($orderData['billing_alternate_phone']) ? ','.$orderData['billing_alternate_phone']:'';?>
																				
                                                                                <br>	<?php if(!empty($orderData['billing_company'])){?>
	
    Company:<?php echo $orderData['billing_company'];?>	
	<br>																			
																				<?php }?>																			
																				
                                                                                <?php echo $orderData['billing_address'];?>
                                                                                
                                        	<br>
          <?php echo $cityData['name'];?>,<?php echo $stateData['name'];?>,<?php echo $countryData['iso2'];?>,<?php echo $orderData['billing_pin_code'];?>  
                                    										</strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            								</ul>
                            							</div>
                            						</div>
                            					</div>
                                                <div class="account-area-inner-box-single">
                            		            	<div class="universal-small-dark-title">
                            		            		<span>Shipping Information</span>
                            		            	</div>
                            		            	<div class="quote-bottom-row summary-deatil">
                            		            		<div class="summary-deatil-inner">
                            			            		<ul>
                            			            			<li>
                            			            			    <div class="row">
                            			            			        <div class="col-md-6">
                            			            			            <span>Shipping Address:</span>
                            			            			        </div>
                            			            			        <div class="col-md-6">
                            			            			            <strong>
																			<?php echo ucfirst($orderData['shipping_name']);?>
                                                                                <br>
                                                                                Mobile: <?php echo ucfirst($orderData['shipping_mobile']);?><?php echo !empty($orderData['shipping_alternate_phone']) ? ','.$orderData['shipping_alternate_phone']:'';?>
																				
	<?php if(!empty($orderData['shipping_company'])){?>
	<br>
    Company:<?php echo $orderData['shipping_company'];?>	
																				
																				<?php }?>																			
                                                                                <br>
                                      <?php echo $orderData['shipping_address'];?>
                                                                                
                                        										<br>
      <?php echo $cityData['name'];?>,<?php echo $stateData['name'];?> ,<?php echo $cityData['name'];?> <?php echo $countryData['iso2'];?>,<?php echo $orderData['shipping_pin_code'];?>
                            			            			                
                                    										</strong>
                            			            			        </div>
                            			            			    </div>
                            			            			</li>
                            								</ul>
                            							</div>
                            						</div>
                            					</div>
                                                <div class="account-area-inner-box-single">
                                                    <div class="universal-small-dark-title">
                                                        <span>Invoice Download</span>
                                                    </div>
                                                    <div class="quote-bottom-row summary-deatil">
                                                        <div class="summary-deatil-inner">
                                                            <ul>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Invoice PDF</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
        <?php 
	       $file_name=$orderData['order_id']."-invoice.pdf";
		   $file_name=strtolower($file_name);
		   $location=FILE_BASE_PATH.'pdf/'.$file_name;
		   $linkInvoice=$BASE_URL."admin/Orders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
		   
	    ?>                                                                           <a href="<?php echo $linkInvoice?>">
                                                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-file-download"></i> Download</button>
                                                                                </a>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Order PDF</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
       <?php 
	       $file_name=$orderData['order_id']."-order.pdf";
		   $file_name=strtolower($file_name);
		   $location=FILE_BASE_PATH.'pdf/'.$file_name;
		   $linkOrder=$BASE_URL."admin/Orders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
		   //$linkOrder=$BASE_URL."admin/Orders/download/".urlencode($location);
	    ?>                                                                         <a href="<?php echo $linkOrder;?>">
                                                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-file-download"></i> Download</button>
                                                                                </a>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-information">
                                        <div class="shopping-product-section">
                                            <div class="shopping-product-display">
                                                <table class="shop-cart-table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Items Details</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php 
                                                        foreach ($OrderItemData as $rowid=>$items){
															
															$cart_images=$items['cart_images'];	
												
												           $cart_images=!empty($cart_images) ? json_decode($cart_images,true) : array();
												           $cart_images=(array) $cart_images;
												
									                      
									$attribute_ids=json_decode($items['attribute_ids'],true);

$product_size=json_decode($items['product_size'],true);
$product_width_length=$items['product_width_length'];
							

$product_width_length=json_decode($items['product_width_length'],true);
$page_product_width_length=json_decode($items['page_product_width_length'],true);
	
							
$product_depth_length_width=json_decode($items['product_depth_length_width'],true);
	
$votre_text=$items['votre_text'];						  
$recto_verso=$items['recto_verso'];								
$product_id=$items['product_id'];													  
//$AttributesData=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);

															
													   ?>    
                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>">
                                            						<?php $imageurl=getProductImage($items['product_image']);
                                            		                 
                                            						 ?>
                                                                   
                                                                    <img src="<?php echo $imageurl?>">
                										        </a>
                                                            </td>
                                                            <td class="product-name">
                                                                <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>"><?php echo ucfirst($items['name'])?></a>
                                                                <div class="product-name-detail">
                                                                    <div class="row">
																	                     <?php if(!empty($product_width_length)){?>	
                                   <div class="col-md-6">
											<span><strong>Length(Inch): <?php echo $product_width_length['product_length'];?></strong> </span>
									</div>
                                    <div class="col-md-6">
											<span><strong> Width(Inch): <?php echo $product_width_length['product_width'];?></strong> </span>
									</div>
									<?php if(!empty($product_width_length['length_width_color_show'])){?>
									<div class="col-md-6">
											<span><strong> Colors: <?php echo $product_width_length['length_width_color'];?></strong> </span>
									</div>
							<?php 
							}?>	
									<?php if(!empty($product_width_length['product_total_page'])){?>
									<div class="col-md-6">
											<span><strong> Quantity: <?php echo $product_width_length['product_total_page'];?></strong> </span>
									</div>
							<?php 
							}?>	
								<?php 
								}?>	
								<?php if(!empty($product_depth_length_width)){?>	
                                   <div class="col-md-6">
											<span><strong>Length(Inch): <?php echo $product_depth_length_width['product_depth_length'];?></strong> </span>
									</div>
                                    <div class="col-md-6">
											<span><strong> Width(Inch): <?php echo $product_depth_length_width['product_depth_width'];?></strong> </span>
									</div>
									<div class="col-md-6">
											<span><strong> Depth(Inch): <?php echo $product_depth_length_width['product_depth'];?></strong> </span>
									</div>
									<?php if(!empty($product_depth_length_width['depth_color_show'])){?>
									<div class="col-md-6">
											<span><strong> Colors: <?php echo $product_depth_length_width['depth_color'];?></strong> </span>
									</div>
							<?php 
							}?>	
							<?php if(!empty($product_depth_length_width['product_depth_total_page'])){?>
									<div class="col-md-6">
											<span><strong> Quantity: <?php echo $product_depth_length_width['product_depth_total_page'];?></strong> </span>
									</div>
							<?php 
							}?>	
					   <?php 
						}?>
						
								<?php 
		if(!empty($page_product_width_length)){?>	
                                   <div class="col-md-6">
											<span><strong>Page Length(Inch): <?php echo $page_product_width_length['page_product_length'];?></strong> </span>
									</div>
                                    <div class="col-md-6">
											<span><strong>Page Width(Inch): <?php echo $page_product_width_length['page_product_width'];?></strong> </span>
									</div>
									<?php if(!empty($page_product_width_length['page_length_width_color_show'])){?>
									<div class="col-md-6">
											<span><strong> Colors: <?php echo $page_product_width_length['page_length_width_color'];?></strong> </span>
									</div>
							<?php 
							}?>	
									<?php if(!empty($page_product_width_length['page_product_total_page'])){?>	
									<div class="col-md-6">
											<span><strong>Pages: <?php echo $page_product_width_length['page_product_total_page'];?></strong> </span>
									</div>
								<?php 
								}?>
                                <?php if(!empty($page_product_width_length['page_product_total_sheets'])){?>	
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php 
								                
								       echo 'Sheet Per Pad:'.$page_product_width_length['page_product_total_sheets'];
								                
								                
												?></strong> </span>
									</div>
								<?php 
								}?>
                                <?php 
								if(!empty($page_product_width_length['page_product_total_quantity'])){ ?>	
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php 
								              
								       echo 'Quantity:'.$page_product_width_length['page_product_total_quantity'];       
										?></strong> </span>
									</div>
								<?php 
								}?>									
								<?php 
								}?>
																	                                                           <?php 
							if(!empty($product_size)){
								
								$size_name = $product_size['product_size'];	
								$label_qty=$product_size['product_quantity'];
								$attribute=isset($product_size['attribute']) ? $product_size['attribute']:'';
										

										 
								?>   
							    <?php 
								if($label_qty){ ?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong>
								              
								               Quantity :<?php echo $label_qty;?></strong> </span>
									</div>
								<?php
								}?>
										
							    <?php 
								if($size_name){ ?>
									<div class="col-md-12 col-lg-6 col-xl-6">
										<span><strong>
											  Size: <?php echo $size_name;?></strong> </span>
									</div>
								<?php 
								}?>
										
										
										
								<?php 
								if($attribute){ 
								
								    foreach($attribute as $akey=>$aval){
										
									    $multipal_attribute_name=$aval['attributes_name'];
									   $multipal_attribute_item_name=$aval['attributes_item_name'];
										
								?>
								
                                        <div class="col-md-12 col-lg-6 col-xl-6">
											<span>
											<strong>
											   <?php 
								                echo $multipal_attribute_name
								                 .':'. $multipal_attribute_item_name;
												?>
												 </strong> 
											</span>
										</div>
										<?php 
									}	
								}?>
							<?php    
							}
							?>										
						   <?php 	   
							#pr($attribute_ids);		   
							foreach($attribute_ids as $key=>$val){
								$attribute_name=$val['attribute_name'];
								$item_name=$val['item_name'];	
						    ?>
								<div class="col-md-12 col-lg-6 col-xl-6">
								<span><strong><?php echo $attribute_name;?>: <?php echo $item_name;?></strong> </span>
								</div>
										
							<?php 
								  
						    }?> 
						    <?php if(!empty($recto_verso)){?>	
                                   <div class="col-md-6">
											<span><strong>Recto/Verso: <?php echo $recto_verso?></strong> </span>
									</div>
                                    
								<?php 
								}?>							   
						
								
								<?php if(!empty($votre_text)){?>	
                                   <div class="col-md-6">
											<span><strong>Your TEXT - Votre TEXT: <?php echo $votre_text?></strong> </span>
									</div>
                                    
								<?php 
								}?>											                  </div>
                                                                </div>
                                                                <div class="uploaded-file-detail" id="upload-file-data">
													<?php if(!empty($cart_images)){
														
															   
													foreach($cart_images as $key=>$return_arr){
															//pr($return_arr);
															
													 ?>
																
													   <div class="uploaded-file-single" id="teb-<?php echo $return_arr['skey']?>">
															<div class="uploaded-file-single-inner">
																<div class="uploaded-file-img" style="background-image: url(<?php echo $return_arr['src']?>)">
																
																</div>
																
																<img src="<?php echo $return_arr['src']?>" width="150">
																<?php 
																$link=$BASE_URL."admin/Orders/download/".urlencode($return_arr['location'])."/".urlencode($return_arr['name']);
																?><br>
																
																
																<div class="uploaded-file-info">
																  <div class="uploaded-file-name">
																	  <span><?php echo $return_arr['name']?></span>
																  </div>
                            										
                                                                    <?php 
                            										if(!empty($return_arr['cumment'])){?>										
                            										    <div class="upload-field">
                            												Comment : <?php echo $return_arr['cumment']?>
                            										    </div>
                            										<?php 
                            										}?>
																	
                                                                    <a href="<?php echo $link?>">
                                                                        <i class="fas fa-file-download"></i> Download
                                                                    </a>  
																 </div>
																
															</div>
														</div>
													<?php 
															
															   }	   
															   
														 }
														 
													?>
													
												</div>
												
                                                            </td>
                                                            <td class="product-price1">
                                                                <span>
                									                <?php echo $order_currency_currency_symbol.number_format(
                								                    $items['price'],2);?>
                									            </span>
                                                            </td>
                											<td class="quant-cart text-left">
                                                                <?php
                										            echo $items['quantity']
                											    ?>
                                                            </td>
                                                            <td class="product-subtotal">
                                                                <span>
                                                                    <?php
                												    $subtotal=($items['price']*
                											        $items['quantity']);
                													echo $order_currency_currency_symbol.number_format($subtotal,2);
                													
                												   ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                    									<?php }?>
                    									<tr>
                    									    <td colspan="5" class="text-right"> 
                    								<div class="cart-total">
                                                    <span>Subtotal Amount : <font class="cart-sub-total"><?php echo $order_currency_currency_symbol."".number_format($orderData['sub_total_amount'],2);?></font>
													</div>
										<?php 
										if(!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] !="0.00"){?>		
												<div class="cart-total">
                                                    <span>       
                                                    Preffered Customer Discount:
                                                    <font class="cart-sub-total">
                                                    <?php echo '-'.$order_currency_currency_symbol.number_format($orderData['preffered_customer_discount'],2);?></font>
													</span>
                                                </div>
										<?php 
										}?>	
										<?php if(!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] !="0.00"){?>		
												<div class="cart-total">
                                                    <span>
                                                              Coupon Discount
                                                            
                                                           : <font class="cart-sub-total">
<?php echo '-'.$order_currency_currency_symbol.number_format($orderData['coupon_discount_amount'],2);?></font>
													</span>
                                                </div>
										<?php 
										}?>	
									<div class="cart-total">
                                            <span>
                                                            
                                        Shipping Fee: 
								        <font class="cart-sub-total">
									        <?php 
	echo $order_currency_currency_symbol.number_format($orderData['delivery_charge'],2);?>
											</font>
													</span>
                                    </div>	
									
									<?php 
									if(!empty($orderData['total_sales_tax']) &&  $orderData['total_sales_tax'] !='0.00'){
									?>
									   <div class="cart-total">
											<span>Total <?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%: <font class="cart-sub-total"><?php 
	echo $order_currency_currency_symbol.number_format($orderData['total_sales_tax'],2);?></font>
											</span>
										</div>
									<?php 
									}?>
									<div class="cart-total">
                                        <span>                 
                                            Order Total Amount
                                             : <font class="cart-sub-total">
										    <?php 
	                                        echo $order_currency_currency_symbol."".number_format($orderData['total_amount'],2);
	                                        ?>
	                                           </font>
										</span>
                                    </div>
									</td>
        								</tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
		