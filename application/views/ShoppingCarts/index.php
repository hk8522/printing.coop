<div class="cart-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="cart-section-inner" id="shoping-cart-container">
            <?php if(!empty($this->cart->contents())) {
              ?>
              <table class="shop-cart-table" id="shop-cart-table">
                  <thead>
                      <tr>
                          <th></th>
                          <th></th>
                          <th><?php
			                if($language_name=='French'){ ?>
			                  Produit
			                <?php }else{ ?>
			                  Product
			                <?php
			                }?></th>
                          <th><?php
			                if($language_name=='French'){ ?>
			                  Prix
			                <?php }else{ ?>
			                  Price
			                <?php
			                }?></th>
                          <th><?php
			                if($language_name=='French'){ ?>
			                  Combien d'ensembles
			                <?php }else{ ?>
			                  How many sets
			                <?php
			                }?></th>
                          <th><?php
			                if($language_name=='French'){ ?>
			                  Total
			                <?php }else{ ?>
			                  Total
			                <?php
			                }?></th>
                      </tr>
                  </thead>
                  <tbody>
                    <?php
                    foreach ($this->cart->contents() as $rowid => $items) {

						  $imageurl = getProductImage($items['options']['product_image']);
						  $cart_images=$items['options']['cart_images'];
						  $product_id=$items['options']['product_id'];
						   $Product = $this->Product_Model->getProductList($product_id);
						  $attribute_ids=$items['options']['attribute_ids'];
						  $product_size=$items['options']['product_size'];

						  $product_width_length=$items['options']['product_width_length'];

						  $page_product_width_length=$items['options']['page_product_width_length'];

						  $product_depth_length_width=$items['options']['product_depth_length_width'];


						  /*$AttributesData=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);*/

						  $votre_text=$items['options']['votre_text'];

						  $recto_verso=$items['options']['recto_verso'];
						  $recto_verso_french=$items['options']['recto_verso_french'];

						  //pr($Product);


                      ?>
                      <tr class="<?php echo $rowid;?> mobile-hide">
                        <td class="product-remove">
                            <a href="javascript:void(0)" onclick="removeCardItem('<?php echo $rowid;?>','<?php echo $items['id'];?>')" class="remove">×</a>
                        </td>
                        <td class="product-thumbnail">
                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>">
                                <img src="<?php echo $imageurl?>">
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>">
							<?php
							    if($language_name=='French'){
							       echo ucfirst($Product['name_french']);
								}else{

									echo ucfirst($Product['name']);
								}
							?>
							</a>
                            <div class="product-name-detail">
                                <div class="row">
	<?php if(!empty($product_width_length)){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){ ?>
								                  Longueur(pouces)
								                <?php }else{ ?>
								                  Length(Inch)
								                <?php
								                }?>: <?php echo $product_width_length['product_length'];?></strong> </span>
									</div>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								                if($language_name=='French'){ ?>
								                  Largeur (pouces)
								                <?php }else{ ?>
								                  Width(Inch)
								                <?php
								                }?>: <?php echo $product_width_length['product_width'];?></strong> </span>
									</div>
							<?php if(!empty($product_width_length['length_width_color_show'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								       if($language_name=='French'){
								                  echo 'Couleursv:'.$product_width_length['length_width_color_french'];

								        }else{
								            echo 'Colors:'.$product_width_length['length_width_color'];

								        }?>
										</strong> </span>
									</div>
							<?php
							}?>
							<?php if(!empty($product_width_length['product_total_page'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								                if($language_name=='French'){ ?>
								                  Quantité
								                <?php }else{ ?>
								                  Quantity
								                <?php
								                }?>: <?php echo $product_width_length['product_total_page'];?></strong> </span>
									</div>
							<?php
							}?>
								<?php
								}?>

								<?php if(!empty($product_depth_length_width)){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){ ?>
								                  Longueur (pouces)
								                <?php }else{ ?>
								                  Length(Inch)
								                <?php
								                }?>: <?php echo $product_depth_length_width['product_depth_length'];?></strong> </span>
									</div>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								                if($language_name=='French'){ ?>
								                 Largeur (pouces)
								                <?php }else{ ?>
								                  Width(Inch)
								                <?php
								                }?>: <?php echo $product_depth_length_width['product_depth_width'];?></strong> </span>
									</div>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								                if($language_name=='French'){ ?>
								                  Profondeur (pouces)
								                <?php }else{ ?>
								                  Depth(Inch)
								                <?php
								                }?>: <?php echo $product_depth_length_width['product_depth'];?></strong> </span>
									</div>
							<?php if(!empty($product_depth_length_width['depth_color_show'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								                 if($language_name=='French'){
								                  echo 'Couleursv:'.$product_depth_length_width['depth_color_french'];

								        }else{
								            echo 'Colors:'.$product_depth_length_width['depth_color'];

								        }?></strong> </span>
									</div>
							<?php
							}?>
							<?php if(!empty($product_depth_length_width['product_depth_total_page'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php
								                if($language_name=='French'){ ?>
								                  Quantité
								                <?php }else{ ?>
								                  Quantity
								                <?php
								                }?>: <?php echo $product_depth_length_width['product_depth_total_page'];?></strong> </span>
									</div>
							<?php
							}?>
					   <?php
						}?>
								<?php if(!empty($page_product_width_length)){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){ ?>
								                  Longueur(pouces)
								                <?php }else{ ?>
								                  Length(Inch)
								                <?php
								                }?>: <?php echo $page_product_width_length['page_product_length'];?></strong> </span>
									</div>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){ ?>
								                  Largeur(pouces)
								                <?php }else{ ?>
								                  Width(Inch)
								                <?php
								                }?>: <?php echo $page_product_width_length['page_product_width'];?></strong> </span>
									</div>

								<?php if(!empty($page_product_width_length['page_length_width_color_show'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong> <?php

									    if($language_name=='French'){
								                  echo 'Couleursv:'.$page_product_width_length['page_length_width_color_french'];

								        }else{
								            echo 'Colors:'.$page_product_width_length['page_length_width_color'];

								        }

												?></strong> </span>
									</div>
							<?php
							}?>
								<?php if(!empty($page_product_width_length['page_product_total_page'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){
								                  echo 'Des pages:'.$page_product_width_length['page_product_total_page_french'];

								                }else{
								       echo 'Pages:'.$page_product_width_length['page_product_total_page'];

								                }
												?></strong> </span>
									</div>
								<?php
								}?>
								<?php if(!empty($page_product_width_length['page_product_total_sheets'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){
								                  echo ' Feuille par bloc:'.$page_product_width_length['page_product_total_sheets_french'];

								                }else{
								       echo 'Sheet Per Pad:'.$page_product_width_length['page_product_total_sheets'];

								                }
												?></strong> </span>
									</div>
								<?php
								}?>
                                <?php
								if(!empty($page_product_width_length['page_product_total_quantity'])){ ?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){
								                  echo 'Quantité:'.$page_product_width_length['page_product_total_quantity'];

								                }else{
								       echo 'Quantity:'.$page_product_width_length['page_product_total_quantity'];

								                }
												?></strong> </span>
									</div>
								<?php
								}?>
								<?php
								}?>
						    <?php
							if(!empty($product_size)){

								if($language_name=='French'){

									$size_name= $product_size['product_size_french'];
									$label_qty=$product_size['product_quantity_french'];

								}else{

									$size_name = $product_size['product_size'];
									$label_qty=$product_size['product_quantity'];
								}

								$attribute=isset($product_size['attribute']) ? $product_size['attribute']:'';



								?>
							    <?php
								if($label_qty){ ?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong><?php
								                if($language_name=='French'){ ?>
								                  Quantité
								                <?php }else{ ?>
								                  Quantity
								                <?php
								                }?> : <?php echo $label_qty;?></strong> </span>
									</div>
								<?php
								}?>

							    <?php
								if($size_name){ ?>
									<div class="col-md-12 col-lg-6 col-xl-6">
										<span><strong><?php
											if($language_name=='French'){ ?>
											  Taille
											<?php }else{ ?>
											  Size
											<?php
											}?>: <?php echo $size_name;?></strong> </span>
									</div>
								<?php
								}?>



								<?php
								if($attribute){

								    foreach($attribute as $akey=>$aval){

										$multiple_attribute_name=$aval['attributes_name'];
									    $multiple_attribute_item_name=$aval['attributes_item_name'];

										if($language_name=='French'){

											$multiple_attribute_name=$aval['attributes_name_french'];
									        $multiple_attribute_item_name=$aval['attributes_item_name_french'];

										}
								?>

                                        <div class="col-md-12 col-lg-6 col-xl-6">
											<span>
											<strong>
											   <?php
								                echo $multiple_attribute_name
								                 .':'. $multiple_attribute_item_name;
												?>
												 </strong>
											</span>
										</div>
										<?php
									}
								}?>


							<?php
							}
							?>

						    <?php

							#pr($attribute_ids);
							foreach($attribute_ids as $key=>$val){



								if($language_name=='French'){

									$attribute_name=$val['attribute_name_french'];
									$item_name=$val['item_name_french'];

								}else{

									$attribute_name=$val['attribute_name'];
									$item_name=$val['item_name'];

								}
								?>
								<div class="col-md-12 col-lg-6 col-xl-6">
								<span><strong><?php echo $attribute_name;?>: <?php echo $item_name;?></strong> </span>
								</div>

								<?php

						    }?>
								 <?php
							if(!empty($recto_verso)){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
										<span><strong>
										<?php
										if($language_name=='French'){

											echo 'Recto verso:'.$recto_verso_french;
										}else{
											echo 'Recto/Verso:'.$recto_verso;
										}
										?>
									    </strong> </span>
									</div>

								<?php
								}?>
                                <?php if(!empty($votre_text)){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
											<span><strong>
												<?php
								                if($language_name=='French'){ ?>
								                  Votre TEXTE - Votre TEXTE
								                <?php }else{ ?>
								                  Your TEXT - Votre TEXT
								                <?php
								                }?>: <?php echo $votre_text?></strong> </span>
									</div>

								<?php
								}?>
                                </div>
                            </div>
							<div class="uploaded-file-detail" id="upload-file-data">
								    <?php if(!empty($cart_images)){


											   foreach($cart_images as $key=>$return_arr){
												    #pr($return_arr);

                                     ?>

									   <div class="uploaded-file-single" id="teb-<?php echo $return_arr['skey']?>">
											<div class="uploaded-file-single-inner">
												 <a href="<?php echo $return_arr['file_base_url']?>" target="_blank"><div class="uploaded-file-img" style="background-image: url(<?php echo $return_arr['src']?>)"></div></a>
												<div class="uploaded-file-info">
                                                              <div class="uploaded-file-name">
                                                                   <span><a href="<?php echo $return_arr['file_base_url']?>" target="_blank"><?php echo $return_arr['name']?></a></span>
                                                              </div>
                                                              <div class="upload-field">
                                                                  <textarea readonly><?php echo $return_arr['cumment']?></textarea>
                                                              </div>
                                                 </div>

											</div>
										</div>
                                    <?php

											   }

									     }

									?>

                                </div>

                        </td>
                        <td class="product-price1" id="">
                            <span><?php echo $product_price_currency_symbol.number_format($items['price'], 2)?></span>
                        </td>
                        <td>
                            <div class="quant-cart">
							  <input type="text" onchange="updateCardItem('<?php echo $items['id'];?>', '<?php echo $rowid;?>',$(this).val())" value="<?php echo $items['qty'];?>"  onkeypress="javascript:return isNumber(event)">

                              <!--<select onchange="updateCardItem('<?php echo $items['id'];?>', '<?php echo $rowid;?>',$(this).val())" class="<?php echo $rowid?>-cradquantity">
                                <?php
                                  $quantity = $items['qty'];
                                  $total_stock = $items['options']['stock'];
                                  $options_array = range(1,$total_stock);
                                ?>
                                <?php
                                    foreach($options_array as $v){
                                    $selected='';
                                    if ($v == $quantity){
                                      $selected='selected="selected"';
                                    }
                                    ?>
                                    <option value="<?php echo $v?>" <?php echo $selected?>><?php echo $v; ?></option>
                                <?php
                                } ?>
                              </select>-->

                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span class="<?php echo $rowid;?>-product-row-sub-total"><?php echo $product_price_currency_symbol.number_format($items['subtotal'], 2)?></span>
                        </td>
                      </tr>
                      <?php
                    }
                    ?>
                      <tr>
                          <td colspan="2" class="actions">
                              <div class="coupon">
                                  <a href="<?php echo $BASE_URL?>Products"><button type="submit"><?php
					                if($language_name=='French'){ ?>
					                  Continuer vos achats
					                <?php }else{ ?>
					                  Continue Shopping
					                <?php
					                }?></button></a>
                              </div>
                          </td>
                          <td colspan="4">
                              <div class="checkout">
                                  <div class="cart-total">
                                      <span><?php
	                if($language_name=='French'){ ?>
	                  Sous-total
	                <?php }else{ ?>
	                  Sub Total
	                <?php
	                }?> : <font class="cart-sub-total"><?php echo $product_price_currency_symbol.number_format($this->cart->total(),2)?></font></span>
                                  </div>
                                  <div class="coupon">
                                      <a href="<?php echo $BASE_URL?>Checkouts"><button type="submit">
									  <?php
					if($language_name=='French'){ ?>
	                 Passer à la caisse
	                <?php }else{ ?>
	                  Proceed to Checkout
	                <?php
	                }?>
									  </button></a>
                                  </div>
                              </div>
                          </td>
                      </tr>
                  </tbody>
              </table>
              <?php
            } else {
                ?>
                <div class="text-center">
                    <h4 class="lead"><?php
	                if($language_name=='French'){ ?>
	                  Le panier d'achat est vide
	                <?php }else{ ?>
	                  Shopping Cart Is Empty
	                <?php
	                }?></h4>
                </div>
                <?php
            }?>

        </div>
    </div>
</div>
<script>
     function isNumber(evt) {

        var iKeyCode = (evt.which) ? evt.which : evt.keyCode
        if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
            return false;

        return true;
    }
</script>