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
					<div class="row align-items-center">
						<div class="col-md-12 col-lg-6 col-xs-12 text-left">
							<div class="inner-title">
							    <span><?php echo ucfirst($page_title).' List'; ?></span>
							</div>
						</div>
						<div class="col-md-12 col-lg-6 col-xs-12 text-right">
							<div class="all-vol-btn">
								<!--<div class="upload-area">
                                    <input type="file">
                                    <button><i class="fas fa-plus-circle"></i> Upload CSV</button>
                                </div>-->
								<a href="#">
									<button class="dark-btn"><i class="fas fa-file-download"></i>Exporting PDF Reports</button>
								</a>
								<a href="<?php echo $BASE_URL.$this->router->fetch_class().'/'.$sub_page_url?>">
									<button><i class="fas fa-plus-circle"></i><?php echo $sub_page_title ?></button>
								</a>
							</div>
						</div>
					</div>
				</div>

				<div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
				    <div class="table-filter-area">
				        <div class="row">
				            <div class="col-md-12 col-lg-10">
							    <form action="<?php echo $BASE_URL?>SalesReports/search">
				                <div class="table-filter-inner control-group">
				                    <div class="row">
    				                    <div class="col-md-12 col-lg-3">
    				                        <div class="table-filter-fields">
    				                            <label>Start Date</label>
    				                            <input class="form-control" type="date" name="StartDate" required value="<?php echo $StartDate?>">
    				                        </div>
    				                    </div>
    				                    <div class="col-md-12 col-lg-3">
    				                        <div class="table-filter-fields">
    				                            <label>End Date</label>
    				                            <input class="form-control" type="date" name="EndDate" required value="<?php echo $EndDate?>">
    				                        </div>
    				                    </div>
    				                    <div class="col-md-12 col-lg-3">
    				                        <div class="table-filter-fields">
    				                            <label>Campaign Name</label>
    				                            <input class="form-control" type="text" placeholder="Enter Campaign Name" name="CampaignName" required value="<?php echo $CampaignName?>">
    				                        </div>
    				                    </div>
										<div class="col-md-12 col-lg-3">
    				                        <div class="table-filter-fields">
    				                            <label>Keywords </label>
    				                            <select class="form-control" name="keywords" required>
												<option value="">Select Keywords</option>

												<option value="spend" <?php echo $keywords=='spend' ? 'selected="selected"':''?>>Spend</option>

												<option value="revenue" <?php echo $keywords=='revenue' ? 'selected="selected"':''?>>Revenue</option>
												<option value="0-impressions" <?php echo $keywords=='0-impressions' ? 'selected="selected"':''?>>0 Impressions</option>

												</select>
    				                        </div>
    				                    </div>
    				                    <div class="col-md-12 col-lg-3">
    				                        <div class="table-filter-fields">
    				                            <button class="btn btn-success" type="submit">Search</button>
    				                        </div>
    				                    </div>
				                    </div>
				                </div>
								</form>
				            </div>
				        </div>
				    </div>
					<div class="custom-mini-table">
						<table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
							<thead>
								<tr role="row">
								    <th style="display:none"></th>
									<th>Start Date</th>
									<th>end Date </th>
									<th>Portfolio Name </th>
									<th>Currency</th>
									<th>Campaign Name </th>
									<th>Ad grou Name</th>
									<th>Targeting </th>
									<th>Match Type </th>
									<th>Impressions </th>
									<th>Clicks</th>
									<th>Click Thru Rate </th>
									<th>Cost Per Click</th>
									<th>Spend</th>
									<th>Total Advertising Cost of Sales</th>
									<th>Total Return On Advertising Spend</th>
									<th>7 Day Total Sales</th>
									<th>7 Day total Orders</th>
									<th>7 Day total Units </th>
									<th>7 Day Conversion Rate</th>
									<th>7 Day Advertised SKU Units</th>
									<th>7 Day Other SKU Units</th>
									<th>7 Day Advertised SKU Sales</th>
									<th>7 Day Other SKU Sales</th>
									<!--<th>Action</th>-->

								</tr>
							</thead>

							<tbody>
							    <?php
								if(count($lists) > 0){
									foreach($lists as $key=>$list){
									?>
									<tr>
									     <th style="display:none"></th>
										<td>
												<?php echo dateFormate($list['start_date'],false);?>
										</td>
										<td>
												<?php echo dateFormate($list['end_date'],false);?>
										</td>

										<td>
										  	<?php echo $list['portfolio_name']; ?>
									 	</td>
										<td>
										  	<?php echo $list['currency']; ?>
									 	</td>
										<td>
										  	<?php echo $list['campaign_name']; ?>
									 	</td>
										<td>
										  	<?php echo $list['ad_grou_name']; ?>
									 	</td>
										<td>
										  	<?php echo $list['targeting']; ?>
									 	</td>
										<td>
										  	<?php echo $list['match_type']; ?>
									 	</td>
										<td>
										  	<?php echo $list['impressions']; ?>
									 	</td><td>
										  	<?php echo $list['clicks']; ?>
									 	</td>
										<td>
										  	<?php echo $list['click_thru_rate']; ?>
									 	</td>
										<td>
										  	<?php echo $list['cost_per_click']; ?>
									 	</td><td>
										  	<?php echo $list['spend']; ?>
									 	</td><td>
										  	<?php echo $list['total_advertising_cost_of_sales']; ?>
									 	</td><td>
										  	<?php echo $list['total_return_on_advertising_spend']; ?>
									 	</td>
										<td>
										  	<?php echo $list['7_day_total_sales']; ?>
									 	</td>

									 	<td>
										  	<?php echo $list['7_day_total_orders']; ?>
									 	</td>
									 	<td>
										  	<?php echo $list['7_day_total_units']; ?>
									 	</td>
										<td>
										  	<?php echo $list['7_day_conversion_rate']; ?>
									 	</td>
										<td>
										  	<?php echo $list['7_day_advertised_sku_units']; ?>
									 	</td>
										<td>
										  	<?php echo $list['7_day_other_sku_units']; ?>
									 	</td>
										<td>
										  	<?php echo $list['7_day_advertised_sku_sales']; ?>
									 	</td>
										<td>
										  	<?php echo $list['7_day_other_sku_sales']; ?>
									 	</td>

										<!--<td>
											<div class="action-btns">
										  	 	<a href="<?php echo $BASE_URL.$class_name.$sub_page_view_url?>/<?php echo $list['id'];?>" style="color:#3c8dbc;padding: 5px;" title="view">
											        <i class="far fa-eye fa-lg"></i>
											   	</a>
											   	<a href="<?php echo $BASE_URL.$class_name.$sub_page_url?>/<?php echo $list['id'];?>" style="color:green;padding: 5px;" title="edit">
											        <i class="far fa-edit fa-lg"></i>
											   	</a>
											   	<a href="<?php echo $BASE_URL.$class_name.$sub_page_delete_url?>/<?php echo $list['id'];?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this product?');">
										         	<i class="fa fa-trash fa-lg"></i>
											   	</a>
										   </div>
										</td>-->

									</tr>
								<?php
								    }
								}else{?>
								    <tr>
									<td colspan="24" class="text-left">No Records Found</td>
								    </tr>
								<?php
								}?>
							</tbody>
						</table>
						<!--<div class="text-right">
						<nav aria-label="Page navigation example">
						  <ul class="pagination">
							<li class="page-item"><a class="page-link" href="#">Previous</a></li>
							<li class="page-item"><a class="page-link" href="#">1</a></li>
							<li class="page-item"><a class="page-link" href="#">2</a></li>
							<li class="page-item"><a class="page-link" href="#">3</a></li>
							<li class="page-item"><a class="page-link" href="#">Next</a></li>
						  </ul>
						</nav>
						</div>-->

					   <?php echo $links; ?>
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
    $('#example2').DataTable({
		"order": [[ 3, "asc" ]]
	});
});
</script>