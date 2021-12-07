<div class="product-title-section">
    <div class="product-title-section-img">
      
    </div>
 
</div>

<div class="container-fluid checkout-main-section">
    <div class="container p-0" style="margin-bottom: 200px; margin-top:100px;">
        <div class="checkout-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="checkout-section-box">
                        <div class="text-center" style="color:red">
				           <?php echo $this->session->flashdata('message_error');?>
		                </div>
						<div class="text-center" style="color:green">
				         <?php echo $this->session->flashdata('message_success');?>
		                </div>
						    <div class="shopping-product-display">
								<table>
								<tr>
									<td>
										<div class="cart-product-price">
											<span> Order Id</span>
										</div>
									</td>
									<td>
										<div class="cart-product-price">
											<span> <?php echo $ProductOrder['order_id'];?></span>
									</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="cart-product-price">
											<span> Order Amount</span>
										</div>
									</td>
									<td>
										<div class="cart-product-price">
											<span> <?php echo $ProductOrder['total_amount'];?></span>
									</div>
									</td>
								</tr>
								<tr>
									<td>
										<div class="cart-product-price">
											<span>Payment Type</span>
										</div>
									</td>
									<td>
										<div class="cart-product-price">
											<span> <?php echo strtoupper($payment_type);?></span>
									</div>
									</td>
								</tr>
								</table>
							</div>
                    </div>
					
                </div>
            </div>
        </div>
    </div>
</div>
<script>
        setTimeout(function(){
			window.location.href = "<?php echo $BASE_URL?>MyOrders";
		  }, 5000
		  
        );
</script>