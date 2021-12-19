<div class="top-mid-section" style="font-family: 'Raleway', sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px 0px 0px 0px;background: #eeeeee;">
	<div>
		<div style="padding: 20px 0px 10px 0px; text-align: center;"><img src="<?php echo $StoreData['url'].'/uploads/logo/'. $StoreData['email_template_logo']?>" width="300px"></div>
		<div class="tem-mid-section" style="text-align: center;">
			<div class="tem-visibility" style="z-index: 99; padding: 20px;">    
				<div class="top-title" style="font-size: 20px; text-align: center;">
					<span><strong><?php echo $heding;?></strong></span>
				</div>
				<?php echo $body;?>
				<!--<div class="top-info" style="margin-top: 25px;text-align: left;">
					<span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;">
						Hi Malle,
					<br>
						Thanks for your order. We'll let you know once your items have been dispatched. Your estimated delivery date is indicated below.
					</span>
				</div>
				<div style="margin: 30px 0px;">
					<span style="color:#303030; font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block;"><b>Arriving:</b> Janurary 9th 2019 to Janurary 20th 2019</span>
				</div>-->
				
				
				<div style="text-align: center;background: #f58634;padding: 10px 0px;margin: 0px 0px;">
					<span style="color:#fff; font-size: 15px;font-weight: 600;">Items in this order</span>
				</div>
				<?php 
				foreach ($OrderItemData as $rowid=>$items){
															
				    $cart_images=json_decode($items['cart_images'],true);
			        $attribute_ids=json_decode($items['attribute_ids'],true);					  
					$product_size=json_decode($items['product_size'],true);					  
					$product_width_length=json_decode($items['product_width_length'],true);			  
					$page_product_width_length=json_decode($items['page_product_width_length'],true);
					$product_depth_length_width=json_decode($items['product_depth_length_width'],true);			  
					$votre_text=$items['votre_text'];
				    $recto_verso=$items['recto_verso'];	
					$product_id=$items['product_id'];
				    $imageurl=getProductImage($items['product_image']);
				?>
				
				<div style="width: 100%;display: flex;align-items: center;border-bottom: 1px solid #ccc;padding: 20px 0px; flex-wrap: wrap;">
					<div style="width: 100%; margin-bottom: 10px;">
						<div style="text-align: left;">
							<div style="width: 100px; float: left; position: relative">
								<img style="margin-bottom: 10px;" src="<?php echo $imageurl?>" width="100%">
								<span style="font-size: 14px; color: #000;">How many sets: <span style="display: inline-block; height: 20px; width: 20px; text-align: center; line-height: 20px; color: #fff; font-weight: 600; font-size: 12px; background: #f58634; border-radius: 50%;"><?php echo $items['quantity'];?></span></span>
							</div>
							<div style="padding-left: 130px;">
								<span style="font-size: 14px;color: #000; font-weight: 600"><?php echo ucfirst($items['name'])?></span>
								
								
								<div style="margin: 10px 0px 0px 0px">
								<?php if(!empty($product_width_length)){?>
					            
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Length(Inch):</font><?php echo $product_width_length['product_length'];?></div>
								
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Width(Inch):</font><?php echo $product_width_length['product_width'];?></div>
								
								<?php if(!empty($product_width_length['length_width_color_show'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Colors:</font><?php echo $product_width_length['length_width_color'];?>
								</div>
								<?php }?>
								
								<?php if(!empty($product_width_length['product_total_page'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantity:</font><?php echo $product_width_length['product_total_page'];?>
								</div>
								<?php }?>
								<?php 
							}?>
							<?php if(!empty($product_depth_length_width)){?>
					            
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Length(Inch):</font><?php echo $product_depth_length_width['product_depth_length'];?></div>
								
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Width(Inch):</font><?php echo $product_depth_length_width['product_depth_width'];?></div>
								
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Depth(Inch):</font><?php echo $product_depth_length_width['product_depth'];?></div>
								
								<?php if(!empty($product_depth_length_width['depth_color_show'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Colors:</font><?php echo $product_depth_length_width['depth_color'];?>
								</div>
								<?php }?>
								
								<?php if(!empty($product_depth_length_width['product_depth_total_page'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantity:</font><?php echo $product_depth_length_width['product_depth_total_page'];?>
								</div>
								<?php }?>
								<?php 
							}?>
							
							<?php if(!empty($page_product_width_length)){?>
					            
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Page Length(Inch):</font><?php echo $page_product_width_length['page_product_length'];?></div>
								
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Page Width(Inch):</font><?php echo $page_product_width_length['page_product_width'];?></div>
								<?php if(!empty($page_product_width_length['page_length_width_color_show'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Colors:</font><?php echo $page_product_width_length['page_length_width_color'];?>
								</div>
								<?php }?>
								<?php if(!empty($page_product_width_length['page_product_total_page'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Pages:</font><?php echo $page_product_width_length['page_product_total_page']?>
								</div>
								<?php }?>
								<?php if(!empty($page_product_width_length['page_product_total_sheets'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Sheet Per Pad:</font><?php echo $page_product_width_length['page_product_total_sheets']?>
								</div>
								<?php }?>
								<?php if(!empty($page_product_width_length['page_product_total_quantity'])){?>
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantity:</font><?php echo $page_product_width_length['page_product_total_quantity']?>
								</div>
								<?php }?>
								<?php 
							}?>	
							<?php 
							if(!empty($product_size)){
								
							    $size_name = $product_size['product_size'];	
								$label_qty=$product_size['product_quantity'];
								$attribute=isset($product_size['attribute']) ? $product_size['attribute']:'';
								
								?>   
							     <?php if($label_qty){ ?>
                                    <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantity:</font><?php echo $label_qty;?></div>
									<?php 
									}?>
							    <?php 
								if($size_name){ ?>
									<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Size:</font><?php echo $size_name;?></div>
									<?php 
								}?>	
										
										
								<?php 
								if($attribute){ 
								
								    foreach($attribute as $akey=>$aval){
										
										$multiple_attribute_name=$aval['attributes_name'];
									    $multiple_attribute_item_name=$aval['attributes_item_name'];
								?>
								
                                 <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222"><?php echo $multiple_attribute_name;?>:</font><?php echo $multiple_attribute_item_name;?></div>		
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
								<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222"><?php echo $attribute_name;?>:</font><?php echo $item_name;?></div>		
							<?php 	  
						    }?>
							<?php if(!empty($recto_verso)){ ?>	
							<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Recto/Verso:</font><?php echo $recto_verso;?>
							</div>   
							<?php 
							}?>
						    
							<?php if(!empty($votre_text)){?>	
							<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Your TEXT - Votre TEXT:</font><?php echo $votre_text;?>
							</div>
                                   
                                    
							<?php 
							}?>
						<br>									   
						<?php 
						    if(!empty($cart_images)){
								
							foreach($cart_images as $key=>$return_arr){	
							
							?>		
				               <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><a href="<?php echo $return_arr['file_base_url']?>">
							   <img src="<?php echo $return_arr['src']?>" width="150"></a></div>
							   <?php 
								$link=$BASE_URL."admin/Orders/download/".urlencode($return_arr['location'])."/".urlencode($return_arr['name']);
								?>
								<!--<a href="<?php echo $link?>">
								Download
								</a>-->
								<?php if(!empty($return_arr['cumment'])){?>
								    <br>
									<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Comment:</font> <?php echo $return_arr['cumment'];
									?>
									</div>
								<?php 
								}?>
								
							<?php 
							}
				        }?>
									
									<!--<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Stands Color:</font> Frame color Silver</div>
									
									<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Stands Color:</font> Frame color Silver</div>
									
									<div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 0px 0px;"><font style="color: #222">Turnaround:</font> Next Day</div>-->
									
								</div>
							</div>
						</div>
					</div>
					<div style="width: 50%; text-align: left;">
						<div style="font-size: 14px;color: #303030;"><font style="color: #000; font-weight: 600;">Price :</font> <?php echo $order_currency_currency_symbol.number_format($items['price'],2);?>
						</div>
					</div>
					<div style="width: 50%; text-align: right">
						<div style="font-size: 14px;color: #303030;"><font style="color: #000; font-weight: 600;">Subtotal :</font> <?php
						                                           
                												    $subtotal=($items['price']*
                											        $items['quantity']);
                													echo $order_currency_currency_symbol.number_format($subtotal,2);
                													
                												    ?>
																   </div>
					</div>
				</div>
				<?php 
				}?>
				
				<div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
					<div style="width: 100%;display: flex;">
						<div style="width: 70%; text-align: right;">
							<span style="font-size: 14px;color: #303030;font-weight: 500;">Subtotal:</span>
						</div>
						<div style="width: 30%; text-align: right;">
							<span style="font-size: 14px;color: #303030;"><?php echo $order_currency_currency_symbol."".number_format($orderData['sub_total_amount'],2);?></span>
						</div>
					</div>
				</div>
				<?php if(!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] !="0.00"){?>
				
				<div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
					<div style="width: 100%;display: flex;">
						<div style="width: 70%; text-align: right;">
							<span style="font-size: 14px;color: #303030;font-weight: 500;">Preffered Customer Discount:</span>
						</div>
						<div style="width: 30%; text-align: right;">
							<span style="font-size: 14px;color: #303030;"><?php echo "-".$order_currency_currency_symbol."".number_format($orderData['preffered_customer_discount'],2);?></span>
						</div>
					</div>
				</div>
				<?php 
				}?>
				<?php if(!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] !="0.00"){?>
				
				<div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
					<div style="width: 100%;display: flex;">
						<div style="width: 70%; text-align: right;">
							<span style="font-size: 14px;color: #303030;font-weight: 500;">Coupon Discount:</span>
						</div>
						<div style="width: 30%; text-align: right;">
							<span style="font-size: 14px;color: #303030;"><?php echo "-".$order_currency_currency_symbol."".number_format($orderData['coupon_discount_amount'],2);?></span>
						</div>
					</div>
				</div>
				<?php 
				}?>
				<div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
					<div style="width: 100%;display: flex;">
						<div style="width: 70%; text-align: right;">
							<span style="font-size: 14px;color: #303030;font-weight: 500;">Shipping Fee:</span>
						</div>
						<div style="width: 30%; text-align: right;">
							<span style="font-size: 14px;color: #303030;"><?php echo $order_currency_currency_symbol.number_format($orderData['delivery_charge'],2);?></span>
						</div>
					</div>
				</div>
				<?php if(!empty($orderData['total_sales_tax']) &&  $orderData['total_sales_tax'] !='0.00'){	
				?>
				<div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
					<div style="width: 100%;display: flex;">
						<div style="width: 70%; text-align: right;">
							<span style="font-size: 14px;color: #303030;font-weight: 500;">Total <?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%:</span>
						</div>
						<div style="width: 30%; text-align: right;">
				         <span style="font-size: 16px;color: #f58634;font-weight: 600;"><?php 
	                    echo $order_currency_currency_symbol.number_format($orderData['total_sales_tax'],2);?></span>
						</div>
					</div>
				</div>
				<?php 
				}?>
				<div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
					<div style="width: 100%;display: flex;">
						<div style="width: 70%; text-align: right;">
							<span style="font-size: 14px;color: #303030;font-weight: 500;">Total:</span>
						</div>
						<div style="width: 30%; text-align: right;">
							<span style="font-size: 16px;color: #f58634;font-weight: 600;"><?php 
	echo $order_currency_currency_symbol."".number_format($orderData['total_amount'],2);?></span>
						</div>
					</div>
				</div>
				<div style="margin: 20px 0px;">
					<div style="padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin-bottom: 10px;">
		            	<div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Order Information</div>
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Order Id</span>
        			        </div>
        			        <div style="width: 50%; margin-left: 5px; text-align: right">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo $orderData['order_id']?></strong>
        			        </div>
        			    </div>
						<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Customer Code:</span>
        			        </div>
        			        <div style="width: 50%; margin-left: 5px; text-align: right">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;"><?php if(!empty($orderData['user_id'])){
																				
																																			                                             echo CUSTOMER_ID_PREFIX.$orderData['user_id'];
																												}else{
																													echo "-";	
																												}?>
																			</strong>
        			        </div>
        			    </div>
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Customer Name:</span>
        			        </div>
        			        <div style="width: 50%; margin-left: 5px; text-align: right">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo ucfirst($orderData['name']);?></strong>
        			        </div>
        			    </div>
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Customer Mobile:</span>
        			        </div>
        			        <div style="width: 50%; margin-left: 5px; text-align: right">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo ucfirst($orderData['mobile']);?></strong>
        			        </div>
        			    </div> 
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Customer Email:</span>
			            	</div>
    			        	<div style="width: 50%; margin-left: 5px; text-align: right">
    			            	<strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo ucfirst($orderData['email']);?></strong>
        			        </div>
        			    </div>
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Order Amount:</span>
        			        </div>
    			        	<div style="width: 50%; margin-left: 5px; text-align: right">
    			            	<strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo $order_currency_currency_symbol.number_format($orderData['total_amount'],2);?></strong>
        			        </div>
        			    </div>
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Order Status:</span>
        			        </div>
    			        	<div style="width: 50%; margin-left: 5px; text-align: right">
    			            	<strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo getOrderSatusClass($orderData['status']);?></strong>
        			        </div>
        			    </div>
						<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Order Date:</span>
        			        </div>
    			        	<div style="width: 50%; margin-left: 5px; text-align: right">
    			            	<strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo dateFormate($orderData['created']);?></strong>
        			        </div>
        			    </div>
						
						<div style="display: flex;">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Shipping Method:</span>
        			        </div>
    			        	<div style="width: 50%; margin-left: 5px; text-align: right">
    			            	<strong style="color: #000; font-weight: 400; font-size: 14px;">
								<?php 
								
							         if(!empty(getShipingName($orderData))){
										 
									    echo getShipingName($orderData);
										
								   }else{
									   
									    if($orderData['shipping_method_formate']){
												
											$shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
											
											if($shipping_method_formate[0]=="pickupinstore"){
														
														$pickupStore=$this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
														
														echo 'Pickup In Store<br>'.$pickupStore['name']."<br>".$pickupStore['address']."<br>".$pickupStore['phone'];			
											}
										}
								    }					
						     ?></strong>
        			        </div>
        			    </div>
						
					</div>
					<div style="padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin-bottom: 10px;">
		            	<div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Payment Information</div>
		            	
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Payment Method:</span>
        			        </div>
        			        <div style="width: 50%; margin-left: 5px; text-align: right">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo ucfirst($orderData['payment_type']);?></strong>
        			        </div>
        			    </div>
						
		            	<div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Payment Status:</span>
        			        </div>
        			        <div style="width: 50%; margin-left: 5px; text-align: right">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo getOrderPaymentStatus($orderData['payment_status']);?></strong>
        			        </div>
        			    </div> 
		            	<div style="display: flex;">
        			        <div style="width: 50%; margin-right: 5px; text-align: left">
        			            <span style="color: #666; font-weight: 400; font-size: 14px;">Payment Transition Id:</span>
			            	</div>
    			        	<div style="width: 50%; margin-left: 5px; text-align: right">
    			            	<strong style="color: #000; font-weight: 400; font-size: 14px;"><?php echo $orderData['transition_id'];?></strong>
        			        </div>
        			    </div>
					</div>
					<div style="display:flex">
						<div style="width: 50%;padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin: 0px 5px 10px 0px;">
			            	<div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Billing Information</div>
			            	<div style="text-align: left;">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;">
        			            <?php echo ucfirst($orderData['billing_name']);?>
                                                                                <br>
                                                                                Mobile: <?php echo ucfirst($orderData['billing_mobile']);?><?php echo !empty($orderData['billing_alternate_phone']) ? ','.$orderData['billing_alternate_phone']:'';?>
																				
                                                                                <br>	<?php if(!empty($orderData['billing_company'])){?>
	
    Company:<?php echo $orderData['billing_company'];?>	
	<br>																			
																				<?php }?>																			
																				
                                                                                <?php echo $orderData['billing_address'];?>
                                                                                
                                        	<br>
                                        										<?php echo $cityData['name'];?>, <?php echo $stateData['name'];?>, <?php echo $countryData['iso2'];?>, <?php echo $orderData['billing_pin_code'];?>	
								</strong>
	        			    </div>
						</div>
						<div style="width: 50%;padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin: 0px 0px 10px 5px;">
			            	<div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Shipping Information</div>
			            	<div style="text-align: left;">
        			            <strong style="color: #000; font-weight: 400; font-size: 14px;">
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
					</div>
				</div>
				<div style="background-color: #183e73 ;margin-top: 20px;">
					<div style="padding: 10px 10px 15px 10px;">
					     <span style="color: #fff;line-height: 25px;"><?php echo $StoreData['email_footer_line']?></span>
					       
						</span>
						<!--<span style="font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block; color:#fff">We are always here to help. You can also contact us directly on email us at info@printing.coop</span>
						<span style="font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block; color:#fff">Call Us:514-544-8043,1-877-384-8043</span>
						<span style="font-size: 14px; letter-spacing: 0.5px; line-height: 22px; word-spacing: 0.5px;display: inline-block; color:#fff">FOLLOW US
                        printing.coop
                        imprimeur.coop</span>
						<span style="font-size: 14px; display: block; margin-top:15px;color: #fff">Copyrights © 2020 by Printing Coop.</span>-->
						
					</div>
				</div>
			</div>
		</div>
		<div class="tem-bottom" style="font-size: 18px; letter-spacing: 0.5px; line-height: 30px; background: #e06b14;; color: #fff; padding: 3px 0px; text-align: center;">
		</div>
	</div>
</div>