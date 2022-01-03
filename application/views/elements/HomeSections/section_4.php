<?php
    #Montreal book printing Section
	if($language_name=='French'){

	   $background_image=$section_4['french_background_image'];
	}else{

	  $background_image=$section_4['background_image'];
	}
	$imageUrl=$BASE_URL.'assets/images/parallax2-1.jpg';

	if(!empty($background_image)){

		$imageUrl=getSectionImage($background_image);
	}
?>
<div class="tab-products-section universal-spacing" style="background-image: url(<?php echo $imageUrl;?>)">
    <div class="container">
        <div class="tab-products-section-inner">
			<div class="universal-light-title">
              <span><?php
			    if($language_name=='French'){

					 echo $section_4['name_france'] ?? '';
					}else{

					  echo $section_4['name'] ?? '';

					} ?></span>
            </div>
            <div class="universal-light-info">
              <span><?php if($language_name=='French'){

					 echo $section_4['description_france'] ?? '';
					}else{

					  echo $section_4['description'] ?? '';

					}?></span>
            </div>
		    <div class="universal-light-info">
              <span><?php
			        if($language_name=='French'){

					    echo $section_4['content_france'] ?? '';
					}else{

					    echo $section_4['content'] ?? '';
					}
					?></span>
            </div>

            <div class="product-tabs">
                <ul class="nav nav-pills">
				    <?php
					foreach($montreal_book_printing_tags as $key=>$val){

				    $active='';
					if($key==0){

						$active='active';
					}
				    $href="#Product1".$val['id'];
					$label=ucwords($val['name']);

					if($language_name=='French'){

						$label=ucwords($val['name_french']);
					}

					$font_class=$val['font_class'];
				   ?>
                    <li><a class="<?php echo $active;?>" data-toggle="pill" href="<?php echo $href;?>">

					 <i class="<?php echo $font_class;?>"></i><br>
					 <?php echo $label;?>
					</a>
					</li>

				   <?php
				   }?>
                </ul>
            </div>
        </div>
    </div>
</div>
<div class="products-tabs-content">
    <div class="container">
        <div class="tab-content">
		<?php foreach($montreal_book_printing_tags as $key=>$val){

				    $active='';

					if($key==0){

						$active='active show';

					}

				    $div_id="Product1".$val['id'];
					$label=ucwords($val['name']);
					if($language_name=='French'){

						$label=ucwords($val['name_french']);

					}
					$tag_id=$val['id'];

		?>

		    <div id="<?php echo $div_id?>" class="tab-pane fade  <?php echo $active;?>">
                <div class="trend-all-products">
                  <div class="row">
                    <?php
					  $cartNameProducts=$this->Product_Model->getProductByTagId($tag_id);

                      if ($cartNameProducts) {

                        foreach ($cartNameProducts as $key => $cartNameProduct) {
                          ?>
                          <div class="col-6 col-md-4 col-lg-3 col-xl-3">
                            <div class="single-products">
                              <div class="product-img">
                                <?php $imageurl = getProductImage($cartNameProduct['product_image'], 'medium'); ?>
                                <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($cartNameProduct['id']);?>"><img src="<?php echo $imageurl?>"></a>
                              </div>
                              <div class="product-detail">
                                <div class="product-detail-inner">
                                  <div class="product-name">
                                    <span>
                                      <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($cartNameProduct['id']);?>">
                                        <?php echo $cartNameProduct['name'] ?>
                                      </a>
                                    </span>
                                  </div>
                                  <div class="product-cat">
                                    <span>
                                      <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($cartNameProduct['id']);?>">
                                        <?php echo $cartNameProduct['category_name'] ?>
                                      </a>
                                    </span>
                                  </div>
                                  <div class="product-price-area">
                                    <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($cartNameProduct['id']);?>" class="cart-btn">
                                      <i class="las la-search"></i>
                                      <span><?php
                                              if($language_name=='French'){ ?>
                                              Aperçu rapide
                                            <?php }else{ ?>
                                              Quick View
                                            <?php
                                            }?></span>
                                    </a>
                                    <div class="product-price">
                                      <span><?php echo $product_price_currency_symbol.number_format($cartNameProduct[$product_price_currency],2);?></span>
                                    </div>
                                  </div>
                                </div>
                              </div>
                            </div>
                          </div>
                          <?php
                        }
                      } else {
                        ?>
                          <div class="text-center col-md-12">
                              <p class="lead font-weight-bold text-white">
                              <?php
                                if($language_name=='French'){ ?>
                                Aucun produit trouvé
                              <?php }else{ ?>
                                No Product Found
                              <?php
                              }?></p>
                          </div>
                        <?php
                      }
                    ?>
                  </div>
                </div>
            </div>
		<?php
		}?>
        </div>
    </div>
</div>
