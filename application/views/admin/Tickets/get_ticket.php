                                <table id="example1" class="table table-bordered table-striped dataTable no-footer">
									<thead>
										<tr>
											<th >Ticket No.</th>
											<th >Name</th>
											<th >Email Id</th>
											<th >Contact no</th>
											<th >Subject</th>
											<th >Message</th>
											<th >Created On</th>
											<th >Updated On</th>
											<th >Status</th>
											<th >Action</th>
										</tr>
									</thead>
									<tbody>


									<?php
            					if(count($lists) >0){
            						foreach($lists as $list){
            					?>

									    <tr>
											<td>
											<?php echo "#".$list['id'];?>
											</td>
											<td>
											<?php echo $list['name'];?>
											</td>
											<td>
											<?php echo $list['email'];?>
											</td>
											<td>
											<?php echo $list['contact_no'];?>
											</td>
											<td>
											<?php echo $list['subject'];?>
											</td>
											<td>
											<?php echo $list['message'];?>
											</td>

											<td>
						                      <?php echo dateFormate($list['created']);?>
											</td>
											<td>
						                      <?php echo dateFormate($list['updated']);?>
											</td>
											<td>

												<?php if($list['status']==1){?>

												    <button type="submit" class="custon-active btn-success">Resolved
													</button>

												<?php
												}else{?>
												  	<button type="submit" class="custon-delete btn-danger">Unresolved</button>
												<?php }?>
											</td>
											<td>

											    <div class="action-btns">
    												<?php if($list['status']==0){ ?>
													<a href="javascript:void(0)" class="comments-counts" style="color:green; padding: 5px;" title="Message" onclick="getChats('<?php echo base64_encode($list['id']);?>')">
    											        <i class="fas fa-comment-dots fa-lg"></i>
    											        <span>
													<?php
			echo $this->Ticket_Model->getMessageCountAdmin($list['id']);
													?>
														</span>
    											   	</a>
													<?php }?>
													<a href="<?php echo $BASE_URL;?>/Tickets/deleteTicket/<?php echo base64_encode($list['id'])?>" style="color:#d71b23; padding: 5px;" title="delete" onclick="return confirm('Are you sure you want to delete this ticket?');">
											         	<i class="fa fa-trash fa-lg"></i>
												   	</a>
											   	</div>


											</td>
										</tr>
									<?php
								}
								}else{?>
										<tr>
											<td colspan="10" class="text-center"> Ticket list empty</td>
										</tr>
								<?php
								}?>
									</tbody>
								</table>


<script>
$(document).ready(function(){

    $('#example1').DataTable({
		"order": [[ 6, "asc" ]]
	});

});
</script>