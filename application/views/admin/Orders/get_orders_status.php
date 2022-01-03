<?php
								if(count($lists) > 0){

									foreach($lists as $key=>$list){
									?>
										<tr id="row-<?php echo $list['id'];?>">
											<td>
											 <?php echo ucfirst($list['order_id']);?>
											</td>
											<td>
											  <?php echo ucwords($list['name']);?>
											 </td>
											 <td><?php echo CURREBCY_SYMBOL.number_format($list['total_amount'],2);?></td>
                                            <td><?php echo ucfirst($list['total_items']);?></td>
											<td>
						                      <?php echo dateFormate($list['created']);?>
											</td>
										</tr>
								<?php

								    }
								}else{?>
								    <tr>
									<td colspan="5" class="text-center">List Empty.</td>
								    </tr>
								<?php
								}?>