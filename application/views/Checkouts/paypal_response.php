
<div class="product-title-section">
    <div class="product-title-section-img">
    </div>
</div>
<div class="container-fluid checkout-main-section">
    <div class="container p-0" style="margin-bottom: 200px;
    margin-top:100px;">
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
								   <td>Order Id</td>
								   <td>
								     <?php
									 //pr($orderData);
									 echo $orderData['order_id']?>
								   </td>
								</tr>
								<!--<tr>
								   <td>Order Amount </td>
								   <td>
								     <?php CURREBCY_SYMBOL.number_format($orderData['total_amount'],2)?>
								   </td>
								</tr>-->

								<tr>
								   <td>Payment Status </td>
								   <td>
								     <?php echo $orderData["payment_status"]=='2' ? 'Success':'Failed';?>
								   </td>
								</tr>
								<tr>
								   <td>Payment Transition Id  </td>
								   <td>
								     <?php echo isset($orderData['transition_id']) ? $orderData['transition_id']:'';?>
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