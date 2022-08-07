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
                                        <!--<div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Selected Fields</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row">
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
                                        </div>-->

                                        <div class="control-group info">
                                            <div class="row align-items-center">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Product Name</label>
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
                                                    <label class="span2" for="inputMame">Product Short Description</label>
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
                                                    <label class="span2 " for="inputMame">Product Full Description</label>
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
                                                    <label class="span2" for="inputMame">Product Price</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row align-items-center">
                                                            <div class="col-md-6">
                                                                <div class="product-view-display">
                                                                    <span><?= number_format($Product['price'], 2) ?></span>
                                                                </div>
                                                                <label class="form-inner-label">List Price CAD</label>
                                                            </div>
                                                            <!--<div class="col-md-3">
                                                                <div class="product-view-display">
                                                                    <span><?= number_format($Product['price_euro'], 2) ?></span>
                                                                </div>
                                                                <label class="form-inner-label">List Price EURO</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="product-view-display">
                                                                    <span><?= number_format($Product['price_gbp'], 2) ?></span>
                                                                </div>
                                                                <label class="form-inner-label">List Price GBP</label>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="product-view-display">
                                                                    <span><?= number_format($Product['price_usd'], 2) ?></span>
                                                                </div>
                                                                <label class="form-inner-label">List Price USD</label>
                                                            </div>-->

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Product Attributes</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls">
                                                        <div class="row">
                                                            <div class="col-md-4">
                                                                <div class="product-view-display">
                                                                    <span><?= $Product['code'] ?></span>
                                                                </div>
                                                                <label class="form-inner-label">Code</label>
                                                            </div>

                                                            <!--<div class="col-md-4">
                                                                <div class="product-view-display">
                                                                    <span><?= $Product['total_stock'] ?></span>
                                                                </div>
                                                                <label class="form-inner-label">Total Stock</label>
                                                            </div>-->

                                                            <div class="col-md-4">
                                                                <?php
                                                                $is_stock = isset($Product['is_stock']) ? $Product['is_stock'] : '';
                                                                $cehecked = 'No';
                                                                if ($is_stock == 1) {
                                                                    $cehecked = 'Yes';
                                                                }
                                                                ?>
                                                                <div class="product-view-display">
                                                                    <span><?= $cehecked ?></span>
                                                                </div>
                                                                <label class="form-inner-label">Show Out of Stock</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="control-group info">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <label class="span2 " for="inputMame">Product Tags</label>
                                                </div>
                                                <div class="col-md-8">
                                                    <div class="controls small-controls">
                                                        <div class="row">
                                                            <?php
                                                            $product_tags = isset($Product['product_tag']) ? explode(',', $Product['product_tag']) : array();
                                                            #pr($product_tags,1);

                                                            foreach ($tagList as $key => $val) {
                                                                $tag_id = $val['id'];
                                                                if (in_array($tag_id, $product_tags)) {
                                                                    ?>
                                                                    <div class="col-md-4">

                                                                        <div class="product-view-display">
                                                                            <span>
                                                                                <?= $val['name'] ?>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                <?php }
                                                           } ?>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="control-group info">
                                            <div class="row">
                                                <?php foreach ($ProductImages as $key => $list) { ?>
                                                    <div class="control-group info col-sm-4">
                                                        <div class="controls">
                                                            <?php $imageurl = getProductImage($list['image'], 'medium');?>
                                                            <img src="<?= $imageurl ?>" width="100%" height="auto">
                                                        </div>
                                                    </div>
                                                <?php } ?>
                                            </div>
                                        </div>
                                        <div class="text-right">
                                            <a href="<?= $BASE_URL . $class_name . $main_page_url ?>" class="btn btn-success">Back</a>
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