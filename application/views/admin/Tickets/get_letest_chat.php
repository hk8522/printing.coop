

										<?php if(!empty($lists)){

                                        foreach($lists as $list){
                                          $send_message_detail='send-message-detail';
										   $send_message='send-message';
     									   $sender_name='sender-name';
										   $Username=$loginName;

										   if($list['comment_author'] !=0){
											    $send_message_detail='recieve-message-detail';
										        $send_message='recieve-message';
     									        $sender_name='reciever-name';
										        $Username=$list['name'];

										   }
										?>
			      						<li class="<?php echo  $send_message;?>">
			      						    <div class="<?php echo $sender_name?>">
			      						        <span><?php  echo $Username?></span>
			      						    </div>
			              					<div class="<?php echo $send_message_detail;?>">
			              						<span><?php echo $list['message']?></span>
												<br>
												<span><?php echo dateFormate($list['created']);?></span>
			              					</div>
			      						</li>
										<?php
										}
										}?>