<div class="product-title-section">
    <div class="product-title-section-img">
        <img src="<?php echo $BASE_URL;?>assets/images/dry-fruits.jpg">
    </div>
    <div class="product-title-section-info">
        <div class="product-title-section-info-inner">
            <div class="today-deal-title">
                <span><?php echo $page_title; ?></span>
            </div>
            <div class="product-pagination">
                <span><a href="<?php echo $BASE_URL?>">Home</a> > <a href="javascript:void(0)"><?php echo $page_title; ?></a></span>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid checkout-main-section">
    <div class="container p-0">
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
											<span> <?php echo $ProductOrder['payment_type'];?></span>
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