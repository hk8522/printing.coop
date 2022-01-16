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
                            </div>
                        </div>
                        <div class="dataTables_wrapper form-inline dt-bootstrap no-footer">
                            <div class="col-sm-12 col-md-12 custom-mini-table">
                                <table id="example1" class="table table-bordered table-striped dataTable no-footer" role="grid" aria-describedby="example1">
                                    <thead>
                                        <tr role="row">
										    <th width="20%">Website</th>
                                            <th width="20%">Contact Name </th>
                                            <th width="15%">Company Name</th>
                                            <th width="15%">Email</th>
                                            <th width="10%">Product Type</th>
                                            <th width="10%">Product Name</th>
                                            <th width="5%">Created On</th>
                                            <!--<th width="15%">Updated On</th>-->
											<th width="5%">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if ($estimates) {
                                            	foreach($estimates as $key => $list) {
                                            	?>
                                        <tr>
										<td>
										   <?php echo $StoreList[$list['store_id']]['name']?>
										</td>
                                            <td class="text-left"><?php echo $list['contact_name'];?></td>
                                            <td class="text-left"><?php echo $list['company_name'];?></td>
                                            <td class="text-left"><?php echo $list['email'];?></td>
                                            <td class="text-left"><?php echo $list['product_type'];?></td>
                                            <td class="text-left"><?php echo $list['product_name'];?></td>
                                            <td>
                                                <?php echo dateFormate($list['created']);?>
                                            </td>
                                            <!--<td>
                                                <?php echo dateFormate($list['updated']);?>
                                            </td>-->
											<td>
											    <div class="action-btns">
										  	 	<a href="<?php echo $BASE_URL.$class_name.$sub_page_view_url?>/<?php echo $list['id'];?>" style="color:#3c8dbc;padding: 5px;" title="view">
											        <i class="far fa-eye fa-lg"></i>
											   	</a>
											   	<a href="<?php echo $BASE_URL.$class_name.$sub_page_delete_url?>/<?php echo $list['id'];?>" style="color:#d71b23;padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this product estimate?');">
										         	<i class="fa fa-trash fa-lg"></i>
											   	</a>
										       </div>

											</td>
                                        </tr>
                                        <?php
                                        }
                                    } else {?>
                                        <tr>
                                            <td colspan="6" class="text-center">List Empty.</td>
                                        </tr>
                                        <?php
                                    }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
<script>
    $(document).ready(function(){
        $('#example1').DataTable({
    		"order": [[ 6, "desc" ]]
    	});
    });
</script>
