<div class="cart-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="cart-section-inner">
          <?php
              if ($wishlists) {
                  ?>
                  <table class="shop-cart-table" id="tableWishList">
                      <thead>
                          <tr>
                              <th></th>
                              <th></th>
                              <th>Product</th>
                              <th>Price</th>
                          </tr>
                      </thead>
                      <tbody>
                        <?php
                            foreach($wishlists as $list) {
                                ?>
                                <tr>
                                    <?php $imageurl=getProductImage($list['product_image'],'medium');?>
                                    <td class="product-remove">
                                      <a href="javascript:void(0)" class="remove" onclick="deleteWishlist(<?php echo $list['wishlist_id']?>,1)">
                                          ×
                                      </a>
                                    </td>
                                    <td class="product-thumbnail">
                                        <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>">
                                            <img src="<?php echo $imageurl;?>">
                                        </a>
                                    </td>
                                   <td class="product-name">
                                            <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($list['id']);?>">  <span><?php echo ucfirst($list['name'])?></span></a>
                                    </td>
                                    <td class="product-price1">
                                        <span class="new-price"><?php echo CURREBCY_SYMBOL.number_format($list['price'],2);?></span>
                                    </td>
                                </tr>
                                <?php
                            }
                         ?>
                          <tr>
                              <td colspan="2" class="actions">
                                  <div class="coupon">
                                      <a href="<?php echo $BASE_URL?>Products"><button type="button">Update Wishlist</button>
                                      </a>
                                  </div>
                              </td>
                              <td colspan="4">

                              </td>
                          </tr>

                      </tbody>
                  </table>
                  <?php
              }
              else {
                  ?>
                  <div class="text-center">
                      <h4 class="lead">Wishlist Empty</h4>
                  </div>
                  <?php
              }?>

        </div>
    </div>
</div>
