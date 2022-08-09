<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<style>
color: #303030;
font-size: 14px;
font-weight: 600;
display: block;
line-height: 28px;
width: 100%;
overflow: hidden;
</style>
<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <?php
                if ($language_name == 'French') {
                    $multipalCategoryData = $Product['multipalCategoryData'];
                ?>
                <a href="<?= $BASE_URL?>">Accueil</a>
                <?php if (!empty($Product['category_name_french'])) { ?>
                /
                <a
                    href="<?= $BASE_URL?>Products/?category_id=<?= base64_encode($Product['category_id'])?>"><?= $Product['category_name_french']?></a>
                <?php } ?>
                <?php if (!empty($Product['sub_category_name_french'])) { ?>
                /
                <a
                    href="<?= $BASE_URL?>Products/?category_id=<?= base64_encode($Product['category_id'])?>&sub_category_id=<?= base64_encode($Product['sub_category_id'])?>"><?= $Product['sub_category_name_french']?></a>
                <?php } ?>
                /<span class="current"><?= $Product['name_french']?></span>

                <?php } else { ?>

                <a href="<?= $BASE_URL?>">Home</a>
                <?php if (!empty($Product['category_name'])) { ?>
                /
                <a
                    href="<?= $BASE_URL?>Products/?category_id=<?= base64_encode($Product['category_id'])?>"><?= $Product['category_name']?></a>
                <?php } ?>
                <?php if (!empty($Product['sub_category_name'])) { ?>
                /
                <a
                    href="<?= $BASE_URL?>Products/?category_id=<?= base64_encode($Product['category_id'])?>&sub_category_id=<?= base64_encode($Product['sub_category_id'])?>"><?= $Product['sub_category_name']?></a>
                <?php } ?>
                /<span class="current"><?= $Product['name']?></span>

                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="shop-single-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="shop-single-section-inner">
            <div class="row">
                <div class="col-md-5 col-lg-6 col-xl-6">
                    <div class="swiper-container-gallery-top">
                        <div class="swiper-wrapper">
                            <?php foreach ($ProductImages as $key => $ProductImage) { ?>
                            <div class="swiper-slide">
                                <div class="shop-product-img">
                                    <img src="<?= getProductImage($ProductImage['image'],'large')?>">
                                </div>
                            </div>
                            <?php } ?>
                        </div>
                        <!-- Slider Arrow -->
                        <?php if (count($ProductImages) > 1) { ?>
                        <div class="swiper-button-next"></div>
                        <div class="swiper-button-prev"></div>
                        <?php } ?>
                    </div>
                    <div class="product-sample-image">
                        <div class="swiper-container-gallery-thumbs">
                            <div class="swiper-wrapper">
                                <?php foreach ($ProductImages as $key => $ProductImage) { ?>
                                <div class="swiper-slide">
                                    <div class="latest-single-product">
                                        <div class="latest-product-img">
                                            <img src="<?= getProductImage($ProductImage['image'])?>">
                                        </div>
                                    </div>
                                </div>
                                <?php } ?>
                            </div>
                            <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-6">
                    <div class="shop-product-detail-section">
                        <div class="shop-product-detail">
                            <span><?= $language_name == 'French' ? $Product['name_french'] : $Product['name']?></span>
                            <div class="wishlist-area">
                                <a data-toggle="tooltip" title="Add to wishlist" href="javascript:void(0)"
                                    onclick="addProductWishList('<?= $Product['id']?>')">
                                    <i class="la la-heart-o"></i>
                                </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <?php //if (!empty($Product['category_name']) ) {
                                    $multipalCategoryData = $Product['multipalCategoryData'];
                                ?>
                                <div class="shop-category">
                                    <span><?= ($language_name == 'French') ? 'Catégorie' : 'Category'?> :
                                        <?php foreach ($multipalCategoryData as $key => $val) { ?>
                                        <font><?= $language_name == 'French' ? $val['name_french'] : $val['name']?>
                                        </font>
                                        <?php } ?>
                                    </span>
                                </div>
                                <?php //}?>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="shop-category">
                                    <span><?= $language_name == 'French' ? 'Disponibilité' : 'Availability'?> :
                                        <font>
                                            <?php
                                                if ($language_name == 'French') {
                                                    echo (empty($Product['is_stock'])) ? 'En Stock' : 'En rupture de stock';
                                                } else {
                                                    echo (empty($Product['is_stock'])) ? 'In Stock' : 'Out of Stock';
                                                }
                                            ?>
                                        </font>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="universal-dark-info">
                            <span><?= $language_name == 'French' ? $Product['short_description_french'] : $Product['short_description']?></span>
                        </div>
                        <?php
                            $product_id = $Product['id'];
                            $buyNow = checkBuyNowProduct($Product['is_stock'], $Product['total_stock']);

                            if ($buyNow) {
                            ?>
                        <form method="post" id="cartForm">
                            <input type="hidden" id="product_id" value="<?= $Product['id']?>" name="product_id">
                            <input type="hidden" id="product_price" value="<?= $Product[$product_price_currency]?>"
                                name="price">
                            <div class="product-fields">
                                <div class="row">
                                    <?php if ($provider) { ?>
                                    <?php $this->view('Products/product_detail_provider'); ?>
                                    <?php } else{ ?>
                                    <?php $this->view('Products/product_detail'); ?>
                                    <?php } ?>
                                </div>
                            </div>

                            <div class="set-price-area">
                                <div class="row align-items-center">
                                    <div class="col-6 col-md-6">
                                        <div class="shop-product-price">
                                            <span>
                                                <img src="<?= $BASE_URL?>/assets/images/loder.gif" width="30"
                                                    style="display:none" id="loader-img">
                                                <font class="new-price">
                                                    <?= $product_price_currency_symbol.'<span id="total-price">'.$Product[$product_price_currency].'</span>'?>
                                                </font>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="quant-cart">
                                            <label><?= $language_name == 'French' ? "Combien d'ensembles" : 'How many sets'?></label>
                                            <input type="text" value="1" id="quantity" name="quantity"
                                                onkeypress="javascript:return isNumber(event)" onchange="setQuantity()">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php if ($website_store_id != 5) { ?>
                            <div class="file-upload-section">
                                <div class="file-upload-area">
                                    <input type="file" name="file" id="file" style="display:none"
                                        accept="application/pdf">
                                    <span
                                        class="info-span"><?= $language_name == 'French' ? "Soumettre et télécharger le fichier (Taille autorisée par fichier: 250 Mo. Type de fichier autorisé: pdf)" : "Submit and Upload File (Allow size per file: 250 Mb. Allow file type:pdf)"?></span>
                                    <div class="upload-file upload-area" id="uploadfile">
                                        <span
                                            class="file-btn"><?= $language_name == 'French' ? 'Soumettre le téléchargement' : 'Submit Upload'?></span>
                                        <span
                                            id="file-drop"><?= $language_name == 'French' ? 'Glisser-déposer des fichiers' : 'Drag & Drop Files'?></span>
                                    </div>
                                </div>

                                <div class="uploaded-file-detail" id="upload-file-data">
                                    <?php if (isset($_SESSION['product_id'][$Product['id']])) {
                                                $file_data = $_SESSION['product_id'][$Product['id']];
                                                #pr($file_data);
                                                foreach ($file_data as $key => $return_arr) {
                                                    #pr($return_arr);
                                                ?>

                                    <div class="uploaded-file-single" id="teb-<?= $return_arr['skey']?>">
                                        <div class="uploaded-file-single-inner">
                                            <a href="<?= $return_arr['file_base_url']?>" target="_blank">
                                                <div class="uploaded-file-img"
                                                    style="background-image: url(<?= $return_arr['src']?>)"></div>
                                            </a>
                                            <div class="uploaded-file-info">
                                                <div class="row align-items-center">
                                                    <div class="col-md-7">
                                                        <div class="uploaded-file-name"><span><a
                                                                    href="<?= $return_arr['file_base_url']?>"
                                                                    target="_blank"><?= $return_arr['name']?></a></span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-5">
                                                        <div class="upload-action-btn">
                                                            <button type="button"
                                                                onclick="update_cumment('<?= $return_arr['skey']?>')"
                                                                id="smc-<?= $return_arr['skey']?>">
                                                                <?= $language_name == 'French' ? 'Note de mise à jour' : 'Update Note'?>
                                                            </button>
                                                            <button type="button" title="Delete"
                                                                onclick="delete_image('<?= $return_arr['skey']?>')"
                                                                id="smd-<?= $return_arr['skey']?>">
                                                                <i class="las la-trash"></i>
                                                            </button>
                                                            <input type="hidden" value="<?= $return_arr['location']?>"
                                                                id="location-<?= $return_arr['skey']?>">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="upload-field">
                                                    <textarea
                                                        id="cumment-<?= $return_arr['skey']?>"><?= $return_arr['cumment']?></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php }
                                           } ?>
                                </div>
                            </div>
                            <?php } ?>
                            <div class="quant-cart">
                                <input type="hidden" id="<?= $Product['id']?>-rowid" value="<?= $productRowid?>">
                                <input type="hidden" id="<?= $Product['id']?>-productId">

                                <button class="cart-adder" type="submit" id="btnSubmit">
                                    <span><?= $language_name == 'French' ? 'Ajouter au chariot' : 'Add to Cart'?></span>
                                </button>
                            </div>

                        </form>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-single-elements">
            <div class="featured-tabs tab">
                <button class="tablinks active" id="defaultOpen"
                    onclick="openCity(event, 'Description')"><?= $language_name == 'French' ? 'La description' : 'Description'?></button>
                <?php if (!empty($ProductDescriptions)) {
                    foreach ($ProductDescriptions as $key => $val) {
                ?>
                <button class="tablinks" id="defaultOpen<?= $val['id']?>"
                    onclick="openCity(event, 'Description<?= $val['id']?>')"><?= $language_name == 'French' ? $val['title_french']:$val['title']?></button>
                <?php }
               } ?>
                <?php if (!empty($ProductTemplates)) { ?>
                <button class="tablinks" id="defaultOpen-Template"
                    onclick="openCity(event, 'template')"><?= $language_name == 'French' ? 'Modèles' : 'Templates'?></button>
                <?php } ?>
                <!--<button class="tablinks" onclick="openCity(event, 'Reviews')">Reviews (<?= count($ratings)?>)</button>-->
            </div>
            <div class="featured-tab-output">
                <div id="Description" class="tabcontent">
                    <div class="tabcontent-inner">
                        <div class="universal-dark-title">
                            <span><?= $language_name == 'French' ? 'La description' : 'Description'?></span>
                        </div>
                        <div class="universal-dark-info">
                            <span><?= $language_name == 'French' ? $Product['full_description_french']:$Product['full_description']?></span>
                        </div>
                    </div>
                </div>
                <?php if (!empty($ProductDescriptions)) {
                    foreach ($ProductDescriptions as $key => $val) {
                    ?>
                <div id="Description<?= $val['id']?>" class="tabcontent" style="display:none">
                    <div class="tabcontent-inner">
                        <div class="universal-dark-title">
                            <span><?= $language_name == 'French' ? $val['title_french'] : $val['title']?></span>
                        </div>
                        <div class="universal-dark-info">
                            <span><?= $language_name == 'French' ? $val['description_french']:$val['description']?></span>
                        </div>
                    </div>
                </div>
                <?php }
               } ?>

                <?php if (!empty($ProductTemplates)) { ?>
                <div id="template" class="tabcontent" style="display:none">
                    <div class="tabcontent-inner">
                        <div class="universal-dark-title">
                            <span><?= $language_name == 'French' ? 'Modèles' : 'Template'?></span>
                        </div>

                        <div class="universal-dark-info">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th scope="col">
                                            <?= $language_name == 'French' ? 'Dimensions finales' : 'Final Dimensions'?>
                                        </th>
                                        <th scope="col">
                                            <?= $language_name == 'French' ? 'La description' : 'Description'?></th>
                                        <th scope="col"><?= $language_name == 'French' ? 'Télécharger' : 'Download'?>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($ProductTemplates as $key => $val) { ?>
                                    <tr>
                                        <td><?= $language_name == 'French' ? $val['final_dimensions_french'] : $val['final_dimensions']?>
                                        </td>
                                        <td><?= $language_name == 'French' ? $val['template_description_french'] : $val['template_description']?>
                                        </td>
                                        <td>
                                            <a
                                                href="<?= $BASE_URL."Products/download/".urlencode(TEMPLATE_FILE_BASE_PATH.$val['template_file'])."/".urlencode($val['template_file'])?>">
                                                <i class="fa fa-download" aria-hidden="true"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<?php if ($language_name == 'French') { ?>
<script src="<?= $BASE_URL?>assets/file-upload/script-french.js" type="text/javascript"></script>
<?php } else{ ?>
<script src="<?= $BASE_URL?>assets/file-upload/script.js" type="text/javascript"></script>
<?php } ?>
<script>
function setQuantity() {
    var quantity = $('#quantity').val();
    <?php if ($provider) { ?>
    if (quantity == '' || quantity == 0) {
        $('#quantity').val('1');
    }
    $('#total-price').html($('[name="price"]').val() * $('#quantity').val());
    <?php } else{ ?>
    if (quantity == '' || quantity == 0) {
        $('#quantity').val('1');
    }
    var formData = new FormData($('#cartForm')[0]);
    $('#loader-img').show();
    $('.new-price-img').hide();

    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: '<?= $BASE_URL?>Products/calculatePrice',
        data: formData,
        cache: false,
        contentType: false,
        processData: false,
        success: function(data) {
            $('#loader-img').hide();
            $('.new-price-img').show();

            var json = JSON.parse(data);
            if (json.success == 1) {
                $('#total-price').html(json.price);
            }
        }
    });
    <?php } ?>
}

function update_cumment(skey) {
    var cumment = $('#cumment-' + skey).val();
    var product_id = '<?= $product_id?>';
    if (cumment == '') {
        alert('Enter cumment');
        return false
    }

    $('#smc-' + skey).prop('disabled', true);
    $('#smc-' + skey).html('<img src="<?= $BASE_URL?>/assets/images/loder.gif" width=20>');
    $('#loader-img').show();
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: '<?= $BASE_URL?>Products/updateCumment',
        data: ({
            'cumment': cumment,
            'product_id': product_id,
            'skey': skey
        }),
        success: function(data) {
            $('#loader-img').hide();
            $('#smc-' + skey).prop('disabled', false);
            $('#smc-' + skey).html('Update Note');
        }
    });
}

function delete_image(skey) {
    var location = $('#location-' + skey).val();
    var product_id = '<?= $product_id ?>';
    if (location == '') {
        return false
    }

    $('#smd-' + skey).prop('disabled', true);
    $('#smd-' + skey).html('<img src="<?= $BASE_URL?>/assets/images/loder.gif" width=20>');
    $('#loader-img').show();
    $.ajax({
        type: 'POST',
        dataType: 'html',
        url: '<?= $BASE_URL?>Products/deleteImage',
        data: ({
            'location': location,
            'product_id': product_id,
            'skey': skey
        }),
        success: function(data) {
            $('#loader-img').hide();
            //$('#smd-' + skey).prop('disabled', false);
            //$('#smd-' + skey).html('<i class="las la-trash"></i>');
            $('#upload-file-data #teb-' + skey).remove();
        }
    });
}

function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;
    return true;
}

$('form#cartForm').on('submit', function(e) {
    $('#loader-img').show();
    $('#btnSubmit').prop('disabled', true);
    e.preventDefault();
    var url = '<?= $BASE_URL ?>ShoppingCarts/addToCart';
    $.ajax({
        type: 'POST',
        url: url,
        data: {
            params: $(this).serialize()
        },
        cache: false,
        headers: {
            accept: 'application/json'
        },
        success: function(data) {
            $('#loader-img').hide();
            var json = JSON.parse(data);
            var status = json.status;
            var msg = json.msg;
            $('#btnSubmit').prop('disabled', false);
            if (status == 1) {
                $('.cart-contents-count').html(json.total_item);
                getCartItem();
                //$('.after-click').show();
                //$('.before-click').hide();
                $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>' + msg +
                    '.</span>').addClass('active');

                setTimeout(function() {
                    $('.addtocart-message').removeClass('active');
                    location.assign('<?= $BASE_URL?>ShoppingCarts');
                }, 1000);
            } else {
                $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>' + msg +
                    '.</span>').addClass('active');
                setTimeout(function() {
                    $('.addtocart-message').removeClass('active');
                }, 2000);
            }
        },
        error: function(error) {}
    });
});
</script>