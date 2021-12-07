<?php if(!empty($this->cart->contents())) {  


    
?>
	<div class="cart-selector-content">
			<div class="cart-product-display">
					<table>
							<tbody>
								<?php
								foreach ($this->cart->contents() as $rowid => $items) { //pr($items);
								
									$productData = $this->Product_Model->getProductDataById($items['id']);
									$imageurl = getProductImage($items['options']['product_image']);
									$Personalised = 'Unpersonalised';
								?>
									<tr>
											<td style="width: 80px;">
													<div class="cart-product-img">
															<a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>">
																	<img src="<?php echo $imageurl?>">
															</a>
													</div>
											</td>
											<td>
													<div class="cart-product-desc">
															<div class="cart-product-title">
																	<a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>">
																		<span><?php echo ucfirst($productData['name'])?></span>
																	</a>
															</div>
													</div>
											</td>
											<td>
													<div class="cart-product-quantity">
															<span><?php echo $items['qty'];?></span>
													</div>
											</td>
											<td>
													<div class="cart-product-price">
															<span><?php echo $product_price_currency_symbol.number_format(
															$items['price'],2)?></span>
													</div>
											</td>
											<td>
													<div class="cart-product-delete">
															<a href="javascript:void(0)" onclick="removeCardItem('<?php echo $rowid;?>','<?php echo $items['id'];?>')"  class="remove">×</a>
													</div>
											</td>
									</tr>
									<?php
								}?>
							</tbody>
					</table>
			</div>
			<div class="cart-product-total-section">
					<div class="row">
							<div class="col-md-4"></div>
							<div class="col-md-8">
									<div class="cart-product-info">
											<span>Subtotal:</span>
											<strong><?php echo $product_price_currency_symbol.number_format($this->cart->total(),2)?></strong>
											<br>
											<span>Total:</span>
											<strong><?php echo $product_price_currency_symbol.number_format($this->cart->total(),2)?></strong>
									</div>
							</div>
					</div>
					<div class="cart-product-button">
							<a href="<?php echo $BASE_URL?>ShoppingCarts"><button type="text" class="cart-view">
							<?php 
		                      if($language_name=='French'){ ?>
		                        Voir le panier
		                      <?php }else{ ?>
		                        View cart
		                      <?php 
		                      }?> </button></a>
							<a href="<?php echo $BASE_URL?>Checkouts"><button type="text" class="cart-checkout">
							<?php 
                              if($language_name=='French'){ ?>
                                Check-out
                              <?php }else{ ?>
                                Checkout
                              <?php 
                              }?> </button></a>
					</div>
			</div>
	</div>
	<?php
} else {
	?>
	<div class="cart-selector-content for-empty">
		<div class="container m-2">
			<div class="universal-small-dark-title text-center">
				<span>
				<?php 
                              if($language_name=='French'){ ?>
                               Vous n'avez aucun article dans votre panier.
                              <?php }else{ ?>
                                You have no items in your shopping cart.
                              <?php 
                              }?></span>
			</div>
			<div class="cart-product-button text-center">
				<a href="<?php echo $BASE_URL?>Products"><button type="text" class="cart-checkout">
				<?php 
                              if($language_name=='French'){ ?>
                                Continuer vos achats
                              <?php }else{ ?>
                                Continue Shopping
                              <?php 
                              }?></button></a>
			</div>
		</div>
	</div>
	<?php
}
?>
