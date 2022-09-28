<div class="content-wrapper" style="min-height: 687px;">
  <section class="content">
    <div class="row" style="display: flex;justify-content: center;align-items: center;">
      <div class="col-md-12 col-xs-12">
        <div class="box box-success box-solid">
          <div class="box-body">
            <div class="inner-head-section">
              <div class="inner-title">
                <span><?= $page_title ?></span>
              </div>
            </div>
            <div class="inner-content-area">
              <div class="row justify-content-center">
                <div class="col-md-12">
                  <div class="text-center" style="color:red">
                    <?= $this->session->flashdata('message_error') ?>
                  </div>
                  <div class="form-role-area">
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="selected">Selected Fields</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="product-view-display">
                                  <span><?= ucfirst($Product['menu_name']) ?></span>
                                </div>
                                <label class="form-inner-label">Menu</label>
                              </div>
                              <div class="col-md-6">
                                <div class="product-view-display">
                                   <span><?= ucfirst($Product['category_name']) ?></span>
                                </div>
                                <label class="form-inner-label">Category</label>
                              </div>
                              <div class="col-md-6">
                                <div class="product-view-display">
                                  <span><?= ucfirst($Product['sub_category_name']) ?></span>
                                </div>
                                <label class="form-inner-label">Sub Category</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                          <label class="span2" for="name">Product Name</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <div class="product-view-display">
                              <span><?= ucfirst($Product['name']) ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row align-items-center">
                        <div class="col-md-4">
                           <label class="span2" for="short-description">Product Short Description</label>
                         </div>
                         <div class="col-md-8">
                          <div class="controls">
                            <div class="product-view-display">
                              <span><?= ucfirst($Product['short_description']) ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                           <label class="span2" for="full_description">Product Full Description</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <div class="product-view-display">
                              <span><?= ucfirst($Product['full_description']) ?></span>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="price">Product Price</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <div class="row align-items-center">
                              <div class="col-md-6">
                                <div class="product-view-display">
                                  <span><?= number_format($Product['price'],2) ?></span>
                                </div>
                                <label class="form-inner-label">List Price</label>
                              </div>
                              <div class="col-md-6">
                                <div class="product-view-display">
                                  <span>Your Price here</span>
                                </div>
                                <label class="form-inner-label">Your Price</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="total_stock">Product Attributes</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls">
                            <div class="row">
                              <div class="col-md-4">
                                <div class="product-view-display">
                                  <span><?= $Product['total_stock'] ?></span>
                                </div>
                                <label class="form-inner-label">Stock</label>
                              </div>
                              <div class="col-md-4">
                                <div class="product-view-display">
                                  <span>Min. qty. here</span>
                                </div>
                                <label class="form-inner-label">Min. Order Quantity</label>
                              </div>
                              <div class="col-md-4">
                                <div class="product-view-display">
                                  <span><?= $Product['code'] ?></span>
                                </div>
                                <label class="form-inner-label">Code</label>
                              </div>
                              <div class="col-md-6">
                                <div class="product-view-display">
                                  <span><?= $Product['discount']."%" ?></span>
                                </div>
                                <label class="form-inner-label">Discount</label>
                              </div>
                              <div class="col-md-6">
                                <div class="product-view-display">
                                  <span><?= ucfirst($Product['brand_name']) ?></span>
                                </div>
                                <label class="form-inner-label">Brand</label>
                              </div>
                              <div class="col-md-4">
                                <div class="product-view-display">
                                  <span>Size here</span>
                                </div>
                                <label class="form-inner-label">Size</label>
                              </div>
                              <div class="col-md-4">
                                <div class="product-view-display">
                                  <span>Color here</span>
                                </div>
                                <label class="form-inner-label">Color</label>
                              </div>
                              <div class="col-md-4">
                                <div class="product-view-display">
                                  <span>Weight here</span>
                                </div>
                                <label class="form-inner-label">Weight</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2" for="tags">Product Tags</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls small-controls">
                            <div class="row">
                              <div class="col-md-6">
                                <?php
                                $is_featured=isset($Product['is_featured']) ? $Product['is_featured'] : '';
                                $cehecked='No';
                                if ($is_featured==1) {
                                  $cehecked='Yes';
                                }
                                ?>
                                <div class="product-view-display">
                                  <span>Featured Product: <strong><?= $cehecked ?></strong></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <?php
                                $is_special=isset($Product['is_special']) ? $Product['is_special'] : '';
                                $cehecked='No';
                                if ($is_special==1) {
                                  $cehecked='No';
                                }
                                ?>
                                <div class="product-view-display">
                                  <span>Special: <strong><?= $cehecked ?></strong></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <?php
                                $is_bestseller=isset($Product['is_bestseller']) ? $Product['is_bestseller'] : '';
                                $cehecked='No';
                                if ($is_bestseller==1) {
                                  $cehecked='Yes';
                                }
                                ?>
                                <div class="product-view-display">
                                  <span>Bestseller: <strong><?= $cehecked ?></strong></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <?php
                                $is_bestdeal=isset($Product['is_bestdeal']) ? $Product['is_bestdeal'] : '';
                                $cehecked='No';
                                if ($is_bestdeal==1) {
                                  $cehecked='Yes';
                                }
                                ?>
                                <div class="product-view-display">
                                  <span>Best Deals: <strong><?= $cehecked ?></strong></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <?php
                                $is_stock=isset($Product['is_stock']) ? $Product['is_stock'] : '';
                                $cehecked='No';
                                if ($is_stock==1) {
                                  $cehecked='Yes';
                                }
                                ?>
                                <div class="product-view-display">
                                  <span>Out of Stock: <strong><?= $cehecked ?></strong></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <?php
                                $is_today_deal=isset($Product['is_stock']) ? $Product['is_today_deal'] : '';
                                $cehecked='No';
                                if ($is_today_deal==1) {
                                  $cehecked='Yes';
                                }
                                ?>
                                <div class="product-view-display">
                                  <span>Featured Deal: <strong><?= $cehecked ?></strong></span>
                                </div>
                              </div>
                              <div class="col-md-6">
                                <div class="product-view-display">
                                  <span>Reviews Allowed: <strong>Yes</strong></span>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="product-view-display">
                                  <span><?= dateFormate($Product['is_today_deal_date'],false) ?></span>
                                </div>
                                <label class="form-inner-label">Featured Deal Date</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <div class="col-md-4">
                          <label class="span2">Free Shipping</label>
                        </div>
                        <div class="col-md-8">
                          <div class="controls small-controls">
                            <div class="row">
                              <div class="col-md-12">
                                <div class="product-view-display">
                                  <span>Free Shipping: <strong>No</strong></span>
                                </div>
                              </div>
                              <div class="col-md-12">
                                <div class="product-view-display">
                                  <span>Handling Fee here</span>
                                </div>
                                <label class="form-inner-label">Handling Fee</label>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    <div class="control-group info">
                      <div class="row">
                        <?php
                        foreach ($ProductImages as $key => $list) { ?>
                          <div class="control-group info col-sm-4">
                              <div class="controls">
                                 <?php $imageurl=getProductImage($list['image'],'medium');?>
                                  <img src="<?= $imageurl ?>" width="100%" height="auto">
                              </div>
                           </div>
                        <?php
                         } ?>
                      </div>
                    </div>
                    <div class="text-right">
                      <a href="<?= $BASE_URL.$class_name.$main_page_url ?>" class="btn btn-success">Back</a>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div><!-- /.box -->
      </div><!-- /.col-->
    </div><!-- ./row -->
  </section><!-- /.content -->
 </div>
