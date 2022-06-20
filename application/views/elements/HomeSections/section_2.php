<div class="trend-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="trend-section-inner">
            <div class="universal-dark-title">
              <span><?php
                   #Proudly Display Your Brand  Section
                   if($language_name=='French'){
                     echo $section_2['name_france'] ?? '';
                    }else{
                      echo $section_2['name'] ?? '';
                    }

                ?>
              </span>
            </div>
            <div class="universal-dark-info">
              <span><?php

                if($language_name=='French'){
                     echo $section_2['description_france'] ?? '';
                    }else{
                      echo $section_2['description'] ?? '';
                }

              ?></span>
            </div>

            <div class="universal-dark-info">
              <span>
                  <?php
                  if($language_name=='French'){
                     echo $section_2['content_france'] ?? '';
                    }else{
                      echo $section_2['content'] ?? '';
                }
                  ?>
                </span>
            </div>
            <div class="trend-tabs">
                <ul class="nav nav-pills">
                   <?php
                foreach($proudly_display_your_brand_tags as $key=>$val){
                    $active='';
                    if($key==0){
                        $active='active';
                    }
                    $href="#Process".$val['id'];
                    $label=ucwords($val['name']);

                    if($language_name=='French'){
                        $label=ucwords($val['name_french']);
                    }
                   ?>
                    <li><a class="<?php echo $active;?>" data-toggle="pill" href="<?php echo $href;?>"><?php echo $label;?></a></li>

                   <?php
                }?>

                </ul>
            </div>
            <div class="trend-tabs-content tab-content">
                <?php foreach($proudly_display_your_brand_tags as $key=>$val){
                    $active='';

                    if($key==0){
                        $active='active show';
                    }

                    $div_id="Process".$val['id'];
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

                            $posterAndPlansProducts=$this->Product_Model->getProductByTagId($tag_id);
                            if ($posterAndPlansProducts) {
                              foreach ($posterAndPlansProducts as  $index=> $posterAndPlansProduct) {
                                ?>
                                <div class="col-6 col-md-4 col-lg-3 col-xl-3">
                                  <div class="single-products">
                                    <div class="product-img">
                                      <?php $imageurl = getProductImage($posterAndPlansProduct['product_image'], 'medium'); ?>
                                      <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($posterAndPlansProduct['id']);?>">
                                          <img src="<?php echo $imageurl?>">
                                      </a>
                                    </div>
                                    <div class="product-detail">
                                      <div class="product-detail-inner">
                                        <div class="product-name">
                                          <span>
                                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($posterAndPlansProduct['id']);?>">
                                              <?php echo $posterAndPlansProduct['name'] ?>
                                            </a>
                                          </span>
                                        </div>
                                        <div class="product-cat">
                                          <span>
                                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($posterAndPlansProduct['id']);?>">
                                              <?php echo $posterAndPlansProduct['category_name'] ?>
                                            </a>
                                          </span>
                                        </div>
                                        <div class="product-price-area">
                                          <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($posterAndPlansProduct['id']);?>" class="cart-btn">
                                            <i class="las la-search"></i>
                                            <span>
                                            <?php
                                              if($language_name=='French'){ ?>
                                              Aperçu rapide
                                            <?php }else{ ?>
                                              Quick View
                                            <?php
                                            }?></span>
                                          </a>
                                          <div class="product-price">
                                            <span><?php echo $product_price_currency_symbol.number_format($posterAndPlansProduct[$product_price_currency],2);?></span>
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
                                    <p class="lead font-weight-bold">
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
</div>
