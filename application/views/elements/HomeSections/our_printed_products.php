<div class="product-main-section service-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="trend-section-inner">
            <div class="universal-dark-title">
              <span>
              <?= ($language_name == 'French') ? 'NOS PRODUITS IMPRIMÉS' : 'Our Printed Products'?>
              </span>
            </div>
            <?php if ($our_printed_products_category) { ?>
              <div class="universal-row">
                  <div class="row justify-content-center">
                    <?php
                    foreach ($our_printed_products_category as $key => $category) {
                            $categoryImages=$category['categoryImages'];
                            $categoryImage=$categoryImages[$website_store_id];
                            $src=geCategoryImage($categoryImage['image']);

                            if ($language_name == 'French') {
                                $src=geCategoryImage($categoryImage['image_french']);
                            }
                      ?>
                          <div class="col-6 col-md-3 col-lg-2 col-xl-2">
                              <div class="all-services">
                                  <div class="single-service">
                                      <div class="single-service-inner">
                                          <!--<a href="#" class="single-service-icon">
                                              <div class="single-service-icon-inner">
                                                  <i class="la la-eyedropper"></i>
                                              </div>
                                          </a>-->

                                          <div class="single-service-content">
                                              <div class="universal-small-dark-title">
                                                  <a href="<?= $BASE_URL ?>Products?category_id=<?= base64_encode($category['id']) ?>">
                                                    <img src="<?= $src ?>">
                                                    <span><?= ($language_name == 'French') ? ucfirst($category['name_french']) : ucfirst($category['name'])?>
                                        </span>
                                                  </a>
                                              </div>
                                              <!--<div class="universal-dark-info">-->
                                              <!--    <span><?= $category['description'] ?></span>-->
                                              <!--</div>-->
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          <?php
                        }
                        ?>
                  </div>
              </div>
                <?php
           } ?>
            <div class="universal-dark-info" style="text-align: center; margin: 0px;">
                <a href="<?= $BASE_URL ?>Products"><button style="margin: 0px;" type="text" class="checkout-view">
                <?= ($language_name == 'French') ? 'Voir tout' : 'View All'?></button></a>
            </div>
        </div>
    </div>
</div>
