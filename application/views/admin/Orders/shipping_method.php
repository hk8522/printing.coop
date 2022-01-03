<div class="step-fields-inner universal-bg-white">
						<div class="universal-small-dark-title">
							<span>Shipping Method</span>
						</div>
						<div class="quote-bottom-row summary-deatil">
							<div class="summary-deatil-inner">
								<div class="shipping-method-fields">

									    <?php
									     $shipping_method_formate=$PostData['shipping_method_formate'];
									    ?>

										 <?php
										      $upsServiceCode=upsServiceCode();
										      //pr($total_charges_ups);
                                              foreach($total_charges_ups as $key=>$val){

												$value='ups-'.$val->TotalCharges->MonetaryValue.'-'.$val->Service->Code;
										  ?>
                                          <div class="shipping-metthod-single">
                                              <label>
                                                  <input type="radio" name="shipping_method_formate" value="<?php echo $value?>" <?php echo $shipping_method_formate == $value ? "checked":"" ?> class="shipping_method_formate">
                                                  <div class="row">
                                                      <div class="col-md-12 col-lg-3 col-xl-2">
                                                          <strong><?php echo CURREBCY_SYMBOL.$val->TotalCharges->MonetaryValue;?></strong>
                                                      </div>
                                                      <div class="col-md-9 col-lg-6 col-xl-7 p-0">
														   <span><?php echo $upsServiceCode[$val->Service->Code];?></span>
                                                          <!--<span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>-->
                                                      </div>
                                                      <div class="col-md-3 col-lg-3 col-xl-3">
                                                          <span>UPS</span>
                                                      </div>
                                                  </div>
                                              </label>
                                          </div>

							           <?php

									   }?>
									   <?php

                                            foreach($CanedaPostShiping['list'] as $key=>$val){

												$value='canadapost-'.$val['price'].'-'.$val['service_name'];
										  ?>
                                          <div class="shipping-metthod-single">
                                              <label>
                                                  <input type="radio" name="shipping_method_formate" value="<?php echo $value?>" <?php echo $shipping_method_formate==$value ? "checked":"" ?>  class="shipping_method_formate">
                                                  <div class="row">
                                                      <div class="col-md-12 col-lg-3 col-xl-2">
                                                          <strong><?php echo CURREBCY_SYMBOL.$val['price'];?></strong>
                                                      </div>
                                                      <div class="col-md-9 col-lg-6 col-xl-7 p-0">
														   <span>
														   <?php echo $val['service_name'];?>
														   </span>
                                                          <!--<span>Expedited Parcel - Est. Delivery Jan 19, 2020</span>-->
                                                      </div>
                                                      <div class="col-md-3 col-lg-3 col-xl-3">
                                                          <span>Canada Post</span>
                                                      </div>
                                                  </div>
                                              </label>
                                          </div>

							           <?php

									    }?>
										<?php
									    foreach($PickupStoresList as $key=>$val){

										   $value='pickupinstore-0.00-'.$val['id'];

										?>

                                        <div class="shipping-metthod-single">
                                              <label>
                                                  <input type="radio" name="shipping_method_formate" value="<?php echo $value?>" <?php echo $shipping_method_formate==$value ? "checked":"" ?> class="shipping_method_formate">
                                                  <div class="row">
                                                      <div class="col-md-2">
                                                          <strong>Free Delivery</strong>
                                                      </div>
                                                      <div class="col-md-7 p-0">
                                                          <span>
														  <?php echo $val['name']?>
														  </span><br>
														  <span>
														  <?php echo $val['address']?>
														  </span><br>
														  <span>
														  <?php echo $val['phone']?>
														  </span>
                                                      </div>
                                                      <div class="col-md-3">
                                                          <span>Pickup In Store</span>
                                                      </div>
                                                  </div>
                                              </label>
                                          </div>
										<?php
										}?>

								</div>
							</div>
						</div>
					</div>