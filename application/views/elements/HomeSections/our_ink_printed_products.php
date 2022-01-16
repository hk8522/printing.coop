<div class="product-main-section service-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="trend-section-inner">
            <div class="universal-dark-title">
              <span>
              <?php
                if($language_name=='French'){ ?>
                    Nos produits d'encre
              <?php }else{ ?>
                    Our Ink Products
              <?php
              }?>
              </span>
            </div>
            <?php
			if(!empty($our_ink_printed_products)){ ?>
              <div class="universal-row">
                  <div class="row justify-content-center">
                    <?php
					$i=1;
				    foreach($our_ink_printed_products as $key=>$list) {
						$src = getProductImage($list['product_image'], 'medium');
						$multipalCategory=$this->Product_Model->getProductMultipalCategoriesAndSubCategories($list['id']);

						$category_id=13;
						if(array_key_exists($category_id,$multipalCategory) && $i <= 12){
							$i++;
                        ?>
                            <div class="col-6 col-md-3 col-lg-2 col-xl-2">
                                <div class="all-services">
                                    <div class="single-service">
                                        <div class="single-service-inner">
                                            <div class="single-service-content">
												<div class="universal-small-dark-title">
													<a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id'])?>">
														<img src="<?php echo $src;?>">
														<span>
															<?php
															if($language_name=='French'){
																echo ucfirst($list['name_french']);
															}else{
																echo ucfirst($list['name']);
															}?>
														</span>
													  </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
						<?php
						}
                    }
                        ?>
                  </div>
              </div>
                <?php
            }?>
            <div class="universal-dark-info" style="text-align: center; margin: 0px;">
                <a href="<?php echo $BASE_URL;?>Products"><button style="margin: 0px;" type="text" class="checkout-view">
                <?php
                if($language_name=='French'){ ?>
                  Voir tout
                <?php }else{ ?>
                  View All
                <?php
                }?></button></a>
            </div>
        </div>
    </div>
</div>
