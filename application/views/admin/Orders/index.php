<link href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
<div class="content-wrapper" style="min-height: 687px;">
<section class="content">
	<div class="row">
		<div class="col-xs-12 col-md-12">
			<div class="box">
				<div class="box-body">
				<div class="text-center" style="color:red">
                    <?php echo $this->session->flashdata('message_error');?>
				</div>
				<div class="text-center" style="color:green">
                    <?php echo $this->session->flashdata('message_success');?>
				</div>
				<div class="inner-head-section">
					<div class="row">
						<div class="col-md-6 col-xs-12 text-left">
							<div class="inner-title">
							    <span><?php echo ucfirst($page_title).' List'; ?></span>
							</div>
						</div>
					   <div class="col-md-6 col-xs-12 text-right">
							<div class="all-vol-btn">
								<div class="upload-area">
                                	<a href="<?php echo $BASE_URL?>admin/Orders/exportCSV/<?php echo $status;?>/<?php echo $user_id;?>/<?php echo $fromDate;?>/<?php echo $toDate;?>"/>
									<button><i class="fas fa-file-csv"></i> Export CSV</button>
									</a>
                                </div>
								<?php if(!empty($user_id)){?>
									<div class="upload-area">
										<a href="<?php echo $BASE_URL?>admin/Users"><button><i class="fas fa-arrow-left"></i> Back</button>
										</a>
									</div>
								<?php 
								}?>
							</div>
						</div>
					</div>
				</div>
				
				<div class="inner-head-section">
					<div class="row">
						<div class="col-md-12 col-xs-12 text-left">
							<form action="" method="post">
								<div class="inner-title">
								   From Date <input type="date" name="fromDate" value="<?php echo $fromDate?>"> &nbsp;&nbsp;To Date <input type="date" value="<?php echo $toDate?>" name="toDate"> &nbsp;&nbsp;<button class="upload-area">Search</button>
								</div>
							</form>
						</div>
					</div>
				</div>
                
				<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<div class="col-sm-12 col-md-12 custom-mini-table">
						<table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
							<thead>
								<tr role="row">
								    <th class="hide"></th>
									<th width="20%">Order Id</th>
									<th width="20%">Store Name</th>
									<th width="15%">Customer Name</th>
									<th width="15%">Subtotal Amount</th>
									<th width="15%">Preffered Customer Discount</th>
									<th width="15%">Coupon Discount</th>
									<th width="15%">Shipping Fee</th>
									<th width="15%">Total Sales Tax</th>
									
									<th width="15%">Order Amount</th>
									<th width="5%">Total Items</th>
									<th width="5%">Payment Method </th>
									<th width="5%">Payment Status</th>
									<th width="5%">Change Payment Status</th>
									<th width="3%">Transition Id</th>
									<th width="5%">Created On</th>
									<th width="5%">Updated On</th>
									<th width="3%">Status</th>
									<th width="10%">Change Order Status</th>
									<th width="3%">View Orders</th>
									<th width="20%">Action</th>
								</tr>
							</thead>
							
							<tbody>
							    <?php 
								if(count($lists) > 0){
									
									foreach($lists as $key=>$list){
										
										$currency_id=$list['currency_id'];
										if(empty($currency_id)){
											
											$currency_id=1;
										}
										$OrderCurrencyData=$CurrencyList[$currency_id];
										$order_currency_currency_symbol=$OrderCurrencyData['symbols'];
										
									?>
										<tr id="row-<?php echo $list['id'];?>">
										    <th class="hide"><?php echo $list['id']?></th>
											<td>
											 <?php echo ucfirst($list['order_id']);?>
											</td>
											<td>
											  <?php echo $StoreList[$list['store_id']]['name'];?>
										    </td>
											<td>
											  <?php echo ucwords($list['name']);?>
											 </td>
											 <td><?php echo $order_currency_currency_symbol.number_format($list['sub_total_amount'],2);?></td>
											 <td>
											 <?php if(!empty($list['preffered_customer_discount']) && $list['preffered_customer_discount'] !="0.00"){ 
											  echo $order_currency_currency_symbol.number_format($list['preffered_customer_discount'],2);
											 }else{
												 
											    echo "-";
											 }
											  ?>
											 </td>
											 <td>
											 <?php if(!empty($list['coupon_discount_amount']) && $list['coupon_discount_amount'] !="0.00"){ 
											  echo $order_currency_currency_symbol.number_format($list['coupon_discount_amount'],2);
											 }else{
												 
											    echo "-";
											 }
											  ?>
											 </td>
											 <td>
											 
											 <?php if(!empty($list['delivery_charge']) && $list['delivery_charge'] !="0.00"){ 
											  echo $product_price_currency_symbol.number_format($list['delivery_charge'],2);
											 }else{
												echo "-"; 
											 }
											?> 
											</td>
											<td>
											 <?php if(!empty($list['total_sales_tax']) && $list['total_sales_tax'] !="0.00"){  
											 $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($list['billing_state']);
											 ?>
											 <span>
									        <?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%<br>
                                            <strong>
										    
										   
	                                       <?php 
	                                       echo $product_price_currency_symbol.number_format($list['total_sales_tax'],2);?>
	                                       
										  
										  </strong>
										 </span>
											 <?php 
											 }else{
												echo "-"; 
											 }
											  ?>
											</td>
											
											 <td><?php echo $order_currency_currency_symbol.number_format($list['total_amount'],2);?></td>
                                            <td><?php echo ucfirst($list['total_items']);?></td>
                                            <td><?php echo ucfirst($list['payment_type']);?></td>
											<td>
											<label id="PaymentStatus-<?php echo $list['id']?>">
											<?php echo getOrderPaymentStatus($list['payment_status']);?></label>
											</td>
											<td>
											<?php if($list['payment_status'] !=2 ){?>
											<select class="form-control" onChange="changeOrderPaymentStatus('<?php echo $list['id']?>',$(this).val())">
											    <option value="">
												 Change Payment Status
												</option>
												<?php if($list['payment_status'] !=2 && $list['payment_status'] !=3){?>
												<!--<option value="1" <?php echo $list['payment_status']==1 ? 'selected="selected"':''?>>
												 Pending
												</option>-->
												
												<?php }?>
												<option value="2" <?php echo $list['payment_status']==2 ? 'selected="selected"':''?>>
												 Success
												</option>
												 
											</select>
											<?php }?>
											</td>
											<td>
											<?php echo $list['transition_id'];?>
											</td>
											<td>
						                      <?php echo dateFormate($list['created']);?>
											</td>
											
											<td>
						                      <?php echo dateFormate($list['updated']);?>
											</td>
											<td id="td-<?php echo $list['id']?>">
											<?php echo getOrderSatusClass($list['status']);?>
											</td>
											<td>
											<input type="hidden" id="orderStatus-<?php echo $list['id'];?>" value="<?php echo $list['status']?>">
											<?php
											   $status_array=getOrderSatus();
											   unset($status_array[1],$status_array[7],$status_array[8]);
											   
											    if(in_array($list['status'],array(3))){
												   
											        unset($status_array[2]);
												   
											    }
												
												if(in_array($list['status'],array(4))){
												       
													   unset($status_array[2]);
												       unset($status_array[3]);
													    unset($status_array[9]);
													   
												   
											    }
												if(in_array($list['status'],array(9))){
												       
													   unset($status_array[2]);
												       unset($status_array[3]);
													   unset($status_array[4]);
													   
												   
											    }
												if(in_array($list['status'],array(5))){
													
												       unset($status_array[2]);
												       unset($status_array[3]);
													   unset($status_array[4]);
													   unset($status_array[5]);
													   unset($status_array[6]);
													   unset($status_array[9]);
												   
											    }
												
												if(in_array($list['status'],array(6))){
													   unset($status_array[2]);
												       unset($status_array[3]);
													   unset($status_array[4]);
													   unset($status_array[5]);
													   unset($status_array[6]);
													   unset($status_array[9]);
													   
                                                       													   
												   
											    }
												
												
												
											if(in_array($list['status'],array(2,3,4,9))){	
											?>
											
											<select class="form-control" onChange="changeOrderStatus('<?php echo $list['id']?>',$(this).val(),'<?php echo $page_status?>','<?php echo $list['order_id']?>','<?php echo $list['payment_status']?>')" id="select-<?php echo $list['id'];?>">
											<!--<option value="">
									           Change Order Status		 
											</option>-->
											<?php 
											
											
											foreach($status_array as $k=>$v){  
											 $selected='';
											 if($list['status']==$k){
												 $selected='selected="selected"';
											 }
											
											?>
											
											<option value="<?php echo $k;?>" <?php echo $selected;?>>
									           <?php echo $v;?>		 
											</option>
											<?php 
											}?>
											<select>
											<?php 
											}?>
											</td>
											<td>

												<!--<a class="view-btn" href="<?php echo $BASE_URL.$class_name.$sub_page_view_url?>/<?php echo $list['id'];?>" data-toggle="modal" data-target="#view-details-modal-<?php echo $list['id'];?>">
												 <i class="far fa-eye fa-lg"></i>
												</a>-->
												
												<a class="view-btn" href="<?php echo $BASE_URL.$class_name.$sub_page_view_url?>/<?php echo $list['id'];?>">
												 <i class="far fa-eye fa-lg"></i>
												</a>
												
	
											</td>
                                        
											
											<td> 
											  <?php if(in_array($list['status'],array(5,6,7))){ ?>
											   <a class="view-btn" href="<?php echo $BASE_URL.$class_name.$sub_page_delete_url?>/<?php echo $list['id'];?>/<?php echo $page_status?>" style="color:#d71b23" title="delete" onclick="return confirm('Are you sure you want to delete this order?');">
											        <i class="fa fa-trash fa-lg"></i>
											   </a>
											  <?php
											  } ?>
											  <?php if(in_array($list['status'],array(4,5)) && !empty($list['shipment_id']) && !empty($list['tracking_number']) && !empty($list['labels_regular']) && !empty($list['labels_thermal'])){
												  
											  ?>
											  
                                               <!--<label>Order shipment Id:<?php echo $list['shipment_id']?></label>
                                               <label>Order Tracking Number:<?php echo $list['shipment_id']?></label>-->
											   
											   <a  href="<?php echo $list['labels_regular']?>" target="_blank" title="Shipping  Label (Regular)" style="margin-right:4px;">
											  <i class="fa fa-image fa-lg"></i>
											   </a>
											   <a  href="<?php echo $list['labels_thermal']?>" target="_blank" title="Shipping   Label (Thermal)" style="margin-right:4px;">
											   <i class="fa fa-image fa-lg"></i>
											    
											   </a>
											    <a  href="javascript:void(0)" title="Tracking Order" style="margin-right:4px;" onclick="OrderTracking('<?php echo $list['id'];?>')">
											    <i class="fa fa-shipping-fast fa-lg"></i>
											    
											   </a>
											  <?php
											  } ?>
											</td>
										</tr>
								<?php
                                   								
								    }
								}else{?>
								    <tr>
									<td colspan="14" class="text-center">List Empty.</td>
								    </tr>
								<?php 
								}?>
							</tbody>
						</table>
					</div>
				</div>



				</div><!-- /.box-body -->
			</div><!-- /.box -->
		</div><!-- /.col -->
	</div><!-- /.row -->
</section><!-- /.content -->

<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	     <h4 class="modal-title">Comment for Customer </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
	  <form class="form-horizontal" name="commentform" method="post" action="" id="commentform">
	  
	  <input type="hidden" name="order_id" id="order_id">
	  <input type="hidden" name="status" id="status">
	  <input type="hidden" name="page_status" id="page_status">
	  <input type="hidden" name="order_id_new" id="order_id_new">
	  
      <div class="modal-body" id="myModalBody">
	        <label>Loading...</label>
            <!--<div id="MsgError"></div>
			<div class="col-xs-12">
				<div class="form-group">
					<label for="InputMessage" class="col-lg-12 control-label">Email Message</label>
					<div class="col-lg-12">
					    <input type="hidden" name="mobileMsg" id="mobileMsg" >
						<textarea name="emailMsg" id="webMsg" class="form-control" rows="5" required></textarea>
					</div>
				</div>
			</div>-->
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btnSubmit">Submit</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<div id="myPaymentModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	     <h4 class="modal-title">Change Payment Status</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
	  <form class="form-horizontal" name="commentform" method="post" action="" id="PaymentFrom">
	  <input type="hidden" name="order_id" id="payment_order_id">
	   <input type="hidden" name="payment_status" id="payment_status">
      <div class="modal-body">
            <div id="PMsgError"></div>
			<div class="col-xs-12">
			    <div class="form-group">
					<label for="InputMessage" class="col-lg-12 control-label">Payment Method</label>
					<div class="col-lg-12">
					    <select name="payment_type"  class="form-control" id="payment_type"><option value="paypal">PayPal</option></select>
					</div>
				</div>
				<div class="form-group">
					<label for="InputMessage" class="col-lg-12 control-label">Transition Id</label>
					<div class="col-lg-12">
					    <input type="text" name="transition_id" id="transition_id" required  class="form-control">
					</div>
				</div>
			</div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="PbtnSubmit">Submit</button>
      </div>
	  </form>
    </div>
  </div>
</div>

<div id="OrderTracking" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
	     <h4 class="modal-title">Details</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body" id="OrderTrackingModalBody">
	        <label>Loading...</label>
      </div>
    </div>
  </div>
</div>

</div>

 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
 </script>
<script>
	$(document).ready(function(){
		
		$('#example1').DataTable({
			
			"order": [[ 0, "desc" ]]
		});

	});
	
    function changeOrderStatus(order_id,status,page_status,order_id_new,payment_status) {
		
		$("#btnSubmit").attr("disabled",true);
		var orderStatus =$("#orderStatus-"+order_id).val();
		if(status ==''){
			
			return false;
			
		}else if(orderStatus ==status ){
		
		    return false;
			
	    }else if((status == 3 || status == 4 || status == 5 || status == 8) && (payment_status ==1 || payment_status ==3)){
		   alert("This order payment has been not done so you can't change status");	
		   return false;	  
		}else{
		    $("#myModal").modal('show');
			var url ='<?php echo $BASE_URL ?>admin/Orders/getOrderData/'+order_id+'/'+status;
			$.ajax({
				   type: "GET",
				   url: url,
				    success: function(data)
				    {    
					   	$("#loder-img").hide();
						$("#order_id").val(order_id);
						$("#status").val(status);
						$("#page_status").val(page_status);
						$("#order_id_new").val(order_id_new);
						$("#btnSubmit").attr("disabled",false);
						$("#myModalBody").html(data);
						
				    }
			});
			
			
		}
	}
	
	$("#commentform").submit(function(e) {
		
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(this);
		var formsubmit=true;
		$("#btnSubmit").attr("disabled",true);
		var order_id =$("#order_id").val();
		var status =$("#status").val();
		var page_status =$("#page_status").val();
		var order_id_new =$("#order_id_new").val();
		
		if(formsubmit==true){
			$("#loder-img").show();
			var url ='<?php echo $BASE_URL ?>admin/Orders/changeOrderStatus';
			$.ajax({
				   type: "POST",
				   url: url,
				   data: form.serialize(), // serializes the form's elements.
				   
				   success: function(data)
				   {    
				        
						
						$("#loder-img").hide();
						var json = JSON.parse(data);
				        var res=json.status;
					    var msg=json.msg;
					
						
						if(res==1){
							
							location.reload();
							
							if(page_status=='all'){
								
							  if(status=='3'){
								  
								$("#td-"+order_id).html('<?php echo getOrderSatusClass(3)?>');
								
							  }else if(status=='4') {
								  
							      $("#td-"+order_id).html('<?php echo getOrderSatusClass(4)?>');
								  
								  
						      }else if(status=='5'){
								  
								$("#td-"+order_id).html('<?php echo getOrderSatusClass(5)?>');  
							  }else if(status=='6'){
								  $("#td-"+order_id).html('<?php echo getOrderSatusClass(6)?>');
							  }
							  
						    }else{
							   
							   $("#row-"+order_id).remove();   
						    }
							
							$("#MsgError").html('<label style="color:green">'+msg+'</label>');
							
							setTimeout(function(){
								
								$("#btnSubmit").attr("disabled",false);
								
								$("#MsgError").html('');
							    $("#myModal").modal('hide');
								location.reload(); 
								 
							  }, 2000
							);
						        
						}else{
							$("#btnSubmit").attr("disabled",false);
							$("#MsgError").html('<label style="color:red">'+msg+'</label>');					 
						}
				   },
				   error: function (error) {
					   
					  $("#btnSubmit").attr("disabled",false);
				   }
			});
			
		}else{
			
			$("#btnSubmit").attr("disabled",false);
		}
    });
	
	function changeOrderPaymentStatus(order_id,payment_status){
		
		$("#PMsgError").html('');		
		$("#payment_order_id").val(order_id);
		$("#payment_status").val(payment_status);
		$("#myPaymentModal").modal('show');
		
		/*if(status !='' && order_id !=''){
			
			$("#loder-img").show();	
			var url ='<?php echo $BASE_URL ?>admin/Orders/changeOrderPaymentStatus';
				$.ajax({
					   type: "POST",
					   url: url,
					   data: {order_id:order_id,status:status}, // serializes the form's elements.
					   
					   success: function(data)
						{   $("#loder-img").hide();	
							var json = JSON.parse(data);
							var res=json.status;
							var msg=json.msg;
							
							if(status==1){
								
								location.reload(); 
								$("#PaymentStatus-"+order_id).html('<button type="button" class="btn btn-sm btn-warning  ">Pending</button>');
								
							}else{
								
								$("#PaymentStatus-"+order_id).html('<button type="button" class="btn btn-sm btn-info">Success</button>');
								
							}
							
					   },
					   error: function (error) {
						   
						 
					   }
				});
			}*/	
	}
	
	$("#PaymentFrom").submit(function(e) {
		
		e.preventDefault(); // avoid to execute the actual submit of the form.
		var form = $(this);
		var formsubmit=true;
		$("#btnSubmit").attr("disabled",true);
		var order_id =$("#payment_order_id").val();
		var payment_status =$("#payment_status").val();
		var payment_type =$("#payment_type").val();
		var transition_id =$("#transition_id").val();
		
		if(formsubmit==true){
			
			$("#loder-img").show();
			var url ='<?php echo $BASE_URL ?>admin/Orders/changeOrderPaymentStatus';
			$.ajax({
				   type: "POST",
				   url: url,
				   data: form.serialize(), // serializes the form's elements.
				   
				   success: function(data)
				   {    
						$("#loder-img").hide();
						var json = JSON.parse(data);
				        var res=json.status;
					    var msg=json.msg;
						location.reload(); 
						if(res==1){
							location.reload();   
						}else{
							
							$("#PbtnSubmit").attr("disabled",false);
							$("#PMsgError").html('<label style="color:red">'+msg+'</label>');					 
						}
				   },
				   error: function (error) {
					   
					  $("#PbtnSubmit").attr("disabled",false);
				   }
			});
		}else{
			$("#PbtnSubmit").attr("disabled",false);
		}
    });
	
	function OrderTracking(order_id) {
		if(order_id ==''){
			return false;
		}else{
		    $("#OrderTracking").modal('show');
			var url ='<?php echo $BASE_URL ?>admin/Orders/OrderTracking/'+order_id;;
			$.ajax({
				   type: "GET",
				   url: url,
				    success: function(data)
				    {    
						$("#OrderTrackingModalBody").html(data);
						
				    }
			});
		}
	}
	
</script>