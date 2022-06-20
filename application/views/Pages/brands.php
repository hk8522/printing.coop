<div class="product-title-section">
    <div class="product-title-section-img">
        <img src="<?php echo $BASE_URL;?>assets/images/dry-fruits.jpg">
    </div>
    <!--<div class="product-title-section-info">-->
    <!--    <div class="product-title-section-info-inner">-->
    <!--        <div class="today-deal-title">-->
    <!--            <span><?php echo $page_title; ?></span>-->
    <!--        </div>-->

    <!--    </div>-->
    <!--</div>-->
</div>
<div class="product-pagination">
    <span><a href="<?php echo $BASE_URL?>">Home</a> > <a href="javascript:void(0)"><?php echo $page_title; ?></a></span>
</div>
<div class="container-fluid all-products-section">
    <div class="container p-0">
        <div class="row">
            <div class="col-md-12">
                <div class="latest-product-section">

                </div>
                <div class="blog-main-section">
                    <!--
                    <div class="row">
                        <?php foreach($Brands as $list){?>
                        <div class="col-md-3">
                             <?php $imageurl=getBrandImage($list['brand_image'],'large');?>

                             <div class="brand-name">
                                <img src="<?php echo $imageurl;?>"><br>
                                <span><?php echo ucfirst($list['name'])?></span>
                             </div>
                        </div>
                        <?php
                        }?>
                    </div>
                    -->
                    <div class="row">
                        <div class="col-md-2">
                            <div class="single-brand" style="background-image: url(../assets/images/commonLogo20160720-1x.png); background-position: 280% 4%;"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="single-brand" style="background-image: url(../assets/images/commonLogo20160720-1x.png); background-position: 280% 13%;"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="single-brand" style="background-image: url(../assets/images/commonLogo20160720-1x.png); background-position: 280% 22%;"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="single-brand" style="background-image: url(../assets/images/commonLogo20160720-1x.png); background-position: 280% 30.7%;"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="single-brand" style="background-image: url(../assets/images/commonLogo20160720-1x.png); background-position: 280% 39.7%;"></div>
                        </div>
                        <div class="col-md-2">
                            <div class="single-brand" style="background-image: url(../assets/images/commonLogo20160720-1x.png); background-position: 280% 49.5%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
