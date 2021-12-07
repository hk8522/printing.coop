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
								<?php if(!empty($user_id)){ ?>
									<div class="upload-area">
										<a href="<?php echo $BASE_URL?>admin/Users/index/<?php echo $page_status?>"><button><i class="fas fa-arrow-left"></i> Back</button>
										</a>
									</div>
								<?php 
								}?>
							</div>
						</div>
					</div>
				</div>
                
				<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
					<div class="custom-mini-table">
						<table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
							<thead>
								<tr role="row">
									<th>Product Image</th>
									<th>Product Name</th>
									<th>Price</th>
									<th>Stock</th>
								</tr>
							</thead>
							<tbody>
							    <?php 
								if(count($lists) > 0){
									
									foreach($lists as $key=>$list){
									?>
										<tr>
											<td>
            									<div class="shopping-product-img">
            										
            									    <?php $imageurl=getProductImage($list['product_image'],'medium');?>
            										<img src="<?php echo $imageurl?>">
                                                  
            									</div>
            								</td>
											
                                            <td><?php echo ucfirst($list['name']);?>
											</td>
                                            
                                            <td>  
											<?php $new_price=getDiscountPrice($list['price'],$list['discount']);?>
            											<?php if(!empty($new_price)){?>
            												<span class="new-price"><?php echo CURREBCY_SYMBOL.$new_price;?></span>
            											    <span class="old-price"  style="text-decoration: line-through;"><?php echo CURREBCY_SYMBOL.number_format($list['price'],2);?></span>
            											<?php 
            											}else{?>
            											    <span class="new-price"><?php echo CURREBCY_SYMBOL.number_format($list['price'],2);?></span>
            											<?php 
            											}?>
											</td>
											
											<td>
						                      <span>
            										<?php 
            										$addToCard=true;
            										if(empty($list['is_stock']) && !empty($list['total_stock'])){ 
            										    echo 'In Stock'; 
            										}else{
            											echo 'Out of Stock';
            											$addToCard=false;
            										}
                                                    ?></span>
											</td>
										</tr>
									<?php
                                   								
								    }
								}else{?>
								    <tr>
									<td colspan="4" class="text-center">No Product In Wishlist</td>
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
</div>
 <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
 </script>
<script>
$(document).ready(function(){
	
    $('#example1').DataTable({
		"order": [[ 1, "asc" ]]
	});

});
</script>