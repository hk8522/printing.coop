<div class="content-wrapper" style="min-height: 687px;">
	<section class="content">
		<div class="row" style="display: flex;justify-content: center;align-items: center;">
			<div class="col-md-12 col-xs-12">
				<div class="box box-success box-solid">
					<div class="box-body">
						<div class="inner-head-section">
                            <div class="inner-title">
                                <span>Support Query</span>
                            </div>
                        </div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
							<div class="custom-mini-table">
								<table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
									<thead>
										<tr role="row">
										   <th>Website</th>
											<th>Name</th>
											<th>Email ID</th>
											<th>Contant No.</th>
											<th>Message</th>
											<th>Created On</th>
											<th>Action</th>

										</tr>
									</thead>
									<tbody>
									<?php foreach($SupportQuery as $row){?>
									    <tr>
										    <td><?php echo $StoreList[$row['store_id']]['name']?></td>
											<td><?php echo $row['name']?></td>
											<td><?php echo $row['email']?></td>
											<td><?php echo $row['phone']?></td>
											<td><?php echo substr($row['comment'],0,50)?></td>
											<td>
											  <?php echo date('d M Y H:i:s',strtotime($row['created']));
											  ?>
											</td>
											<td>
												<div class="action-btns">


										  	 	<a href="<?php echo $BASE_URL.$class_name.$sub_page_view_url?>/<?php echo $row['id'];?>" style="color:#3c8dbc;padding: 5px;" title="view">
											        <i class="far fa-eye fa-lg"></i>
											   	</a>

											   	<a href="<?php echo $BASE_URL.$class_name.$sub_page_delete_url?>/<?php echo $row['id'];?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this query?');">
										         	<i class="fa fa-trash fa-lg"></i>
											   	</a>
										   </div>

											</td>

										</tr>
									<?php
									}?>
									</tbody>
								</table>
							</div>
						</div>
					</div>
				</div><!-- /.box -->
			</div><!-- /.col-->
		</div><!-- ./row -->
	</section><!-- /.content -->
 </div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
$(document).ready(function(){

    /* $('#example1').DataTable({
		"order": [[ 4, "desc" ]]
	}); */

});
</script>