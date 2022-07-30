<div class="cart-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="cart-section-inner" id="shoping-cart-container">
            <?php if (!empty($this->cart->contents())) {?>
                <table class="shop-cart-table" id="shop-cart-table">
                    <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th><?= ($language_name == 'French') ? 'Produit' : 'Product'?></th>
                            <th><?= ($language_name == 'French') ? 'Prix' : 'Price'?></th>
                            <th><?= ($language_name == 'French') ? "Combien d'ensembles" : "How many sets"?></th>
                            <th><?= ($language_name == 'French') ? 'Total' : 'Total'?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        foreach ($this->cart->contents() as $rowid => $item) {
                            $imageurl = getProductImage($item['options']['product_image']);
                            $cart_images = $item['options']['cart_images'];
                            $product_id = $item['options']['product_id'];
                            $Product = $this->Product_Model->getProductList($product_id);

                            $attribute_ids = $item['options']['attribute_ids'];
                            $provider_id = 1;
                            $provider_product = $this->Provider_Model->getProductByProductId($provider_id, $item['options']['product_id']);
                            if ($provider_product) {
                                $attribute_ids = sina_attributes_map($attribute_ids);
                            }

                            $product_size = $item['options']['product_size'];

                            $product_width_length = $item['options']['product_width_length'];
                            $page_product_width_length = $item['options']['page_product_width_length'];
                            $product_depth_length_width = $item['options']['product_depth_length_width'];

                            $votre_text = $item['options']['votre_text'];

                            $recto_verso = $item['options']['recto_verso'];
                            $recto_verso_french = $item['options']['recto_verso_french'];
                        ?>
                            <tr class="<?= $rowid?> mobile-hide">
                                <td class="product-remove">
                                    <a href="javascript:void(0)"
                                        onclick="removeCartItem('<?= $rowid?>','<?= $item['id']?>')"
                                        class="remove">×</a>
                                </td>
                                <td class="product-thumbnail">
                                    <a href="<?= $BASE_URL?>Products/view/<?= base64_encode($item['id'])?>">
                                        <img src="<?= $imageurl?>">
                                    </a>
                                </td>
                                <td class="product-name">
                                    <a href="<?= $BASE_URL?>Products/view/<?= base64_encode($item['id'])?>">
                                        <?php
                                        if ($language_name == 'French') {
                                            echo ucfirst($Product['name_french']);
                                        } else {
                                            echo ucfirst($Product['name']);
                                        }
                                    ?>
                                    </a>
                                    <div class="product-name-detail">
                                        <div class="row">
                                            <?php if (!empty($product_width_length)) {?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Longueur(pouces)' : 'Length(Inch)'?>: <?= $product_width_length['product_length']?></strong></span>
                                                </div>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Largeur (pouces)' : 'Width(Inch)'?>: <?= $product_width_length['product_width']?></strong></span>
                                                </div>
                                                <?php if (!empty($product_width_length['length_width_color_show'])) {?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Couleursv:'.$product_width_length['length_width_color_french'] : 'Colors:'.$product_width_length['length_width_color']?></strong></span>
                                                    </div>
                                                <?php }?>
                                                <?php if (!empty($product_width_length['product_total_page'])) {?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity'?>: <?= $product_width_length['product_total_page']?></strong></span>
                                                    </div>
                                                <?php }?>
                                            <?php }?>

                                            <?php if (!empty($product_depth_length_width)) {?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Longueur (pouces)': 'Length(Inch)'?>: <?= $product_depth_length_width['product_depth_length']?></strong></span>
                                                </div>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Largeur (pouces)' : 'Width(Inch)'?>: <?= $product_depth_length_width['product_depth_width']?></strong></span>
                                                </div>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Profondeur (pouces)' : 'Depth(Inch)'?>: <?= $product_depth_length_width['product_depth']?></strong></span>
                                                </div>
                                                <?php if (!empty($product_depth_length_width['depth_color_show'])) {?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Couleursv:'.$product_depth_length_width['depth_color_french'] : 'Colors:'.$product_depth_length_width['depth_color']?></strong></span>
                                                </div>
                                                <?php }?>
                                                <?php if (!empty($product_depth_length_width['product_depth_total_page'])) {?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity'?>: <?= $product_depth_length_width['product_depth_total_page']?></strong></span>
                                                    </div>
                                                <?php }?>
                                            <?php }?>
                                            <?php if (!empty($page_product_width_length)) {?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Longueur(pouces)' : 'Length(Inch)'?>: <?= $page_product_width_length['page_product_length']?></strong></span>
                                                </div>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Largeur(pouces)' : 'Width(Inch)'?>: <?= $page_product_width_length['page_product_width']?></strong></span>
                                                </div>

                                                <?php if (!empty($page_product_width_length['page_length_width_color_show'])) {?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Couleursv:'.$page_product_width_length['page_length_width_color_french'] : 'Colors:'.$page_product_width_length['page_length_width_color']?></strong></span>
                                                    </div>
                                                <?php }?>
                                                <?php if (!empty($page_product_width_length['page_product_total_page'])) {?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Des pages:'.$page_product_width_length['page_product_total_page_french'] : 'Pages:'.$page_product_width_length['page_product_total_page']?></strong></span>
                                                    </div>
                                                <?php }?>
                                                <?php if (!empty($page_product_width_length['page_product_total_sheets'])) {?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Feuille par bloc:'.$page_product_width_length['page_product_total_sheets_french'] : 'Sheet Per Pad:'.$page_product_width_length['page_product_total_sheets']?></strong></span>
                                                    </div>
                                                <?php }?>
                                                <?php
                                                if (!empty($page_product_width_length['page_product_total_quantity'])) { ?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Quantité:'.$page_product_width_length['page_product_total_quantity'] : 'Quantity:'.$page_product_width_length['page_product_total_quantity']?></strong></span>
                                                    </div>
                                                <?php }?>
                                            <?php }?>
                                            <?php
                                            if (!empty($product_size)) {
                                                if ($language_name == 'French') {
                                                    $size_name = $product_size['product_size_french'] ?? '';
                                                    $label_qty = $product_size['product_quantity_french'] ?? '';
                                                } else {
                                                    $size_name = $product_size['product_size'] ?? '';
                                                    $label_qty = $product_size['product_quantity'] ?? '';
                                                }

                                                $attribute = isset($product_size['attribute']) ? $product_size['attribute'] : '';
                                                ?>
                                                <?php if ($label_qty) { ?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity'?>: <?= $label_qty?></strong></span>
                                                    </div>
                                                <?php }?>
                                                <?php if ($size_name) { ?>
                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                        <span><strong><?= ($language_name == 'French') ? 'Taille' : 'Size'?>: <?= $size_name?></strong></span>
                                                    </div>
                                                <?php }?>

                                                <?php
                                                if ($attribute) {
                                                    foreach ($attribute as $akey => $aval) {
                                                        $multiple_attribute_name = $aval['attributes_name'];
                                                        $multiple_attribute_item_name = $aval['attributes_item_name'];

                                                        if ($language_name == 'French') {
                                                            $multiple_attribute_name = $aval['attributes_name_french'];
                                                            $multiple_attribute_item_name = $aval['attributes_item_name_french'];
                                                        }
                                                ?>

                                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                                            <span>
                                                                <strong>
                                                                    <?= $multiple_attribute_name . ':' . $multiple_attribute_item_name?>
                                                                </strong>
                                                            </span>
                                                        </div>
                                                    <?php }
                                                }
                                            }?>

                                            <?php
                                            foreach ($attribute_ids as $key => $val) {
                                                if ($language_name == 'French') {
                                                    $attribute_name = $val['attribute_name_french'];
                                                    $item_name = $val['item_name_french'];
                                                } else {
                                                    $attribute_name = $val['attribute_name'];
                                                    $item_name = $val['item_name'];
                                                }
                                                ?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= $attribute_name?>: <?= $item_name?></strong></span>
                                                </div>

                                            <?php }?>
                                            <?php
                                            if (!empty($recto_verso)) {?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Recto verso:'.$recto_verso_french : 'Recto/Verso:'.$recto_verso?></strong></span>
                                                </div>
                                            <?php }?>
                                            <?php if (!empty($votre_text)) {?>
                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                    <span><strong><?= ($language_name == 'French') ? 'Votre TEXTE - Votre TEXTE' : 'Your TEXT - Votre TEXT'?>: <?= $votre_text?></strong></span>
                                                </div>
                                            <?php }?>
                                        </div>
                                    </div>
                                    <div class="uploaded-file-detail" id="upload-file-data">
                                        <?php if (!empty($cart_images)) {
                                            foreach ($cart_images as $key=>$return_arr) {
                                            ?>
                                                <div class="uploaded-file-single" id="teb-<?= $return_arr['skey']?>">
                                                    <div class="uploaded-file-single-inner">
                                                        <a href="<?= $return_arr['file_base_url']?>" target="_blank">
                                                            <div class="uploaded-file-img" style="background-image: url(<?= $return_arr['src']?>)"></div>
                                                        </a>
                                                        <div class="uploaded-file-info">
                                                            <div class="uploaded-file-name">
                                                                <span><a href="<?= $return_arr['file_base_url']?>" target="_blank"><?= $return_arr['name']?></a></span>
                                                            </div>
                                                            <div class="upload-field">
                                                                <textarea readonly><?= $return_arr['cumment']?></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?php }
                                        }?>
                                    </div>
                                </td>
                                <td class="product-price1" id="">
                                    <span><?= $product_price_currency_symbol.number_format($item['price'], 2)?></span>
                                </td>
                                <td>
                                    <div class="quant-cart">
                                        <input type="text" onchange="updateCartItem('<?= $item['id']?>', '<?= $rowid?>',$(this).val())" value="<?= $item['qty'];?>" onkeypress="javascript:return isNumber(event)">
                                        <?php /*
                                        <select>
                                            <?php
                                            $quantity = $item['qty'];
                                            $total_stock = $item['options']['stock'] ?? '';
                                            $options_array = range(1, $total_stock);
                                            foreach ($options_array as $v) {
                                                $selected = '';
                                                if ($v == $quantity) {
                                                    $selected='selected="selected"';
                                                }
                                                ?>
                                                <option value="<?= $v?>" <?= $selected?>><?= $v?></option>
                                            <?php } ?>
                                        </select>
                                        */ ?>
                                    </div>
                                </td>
                                <td class="product-subtotal">
                                    <span class="<?= $rowid?>-product-row-sub-total"><?= $product_price_currency_symbol.number_format($item['subtotal'], 2)?></span>
                                </td>
                            </tr>
                        <?php }?>
                        <tr>
                            <td colspan="2" class="actions">
                                <div class="coupon">
                                    <a href="<?= $BASE_URL?>Products"><button type="submit">
                                        <?= ($language_name == 'French') ? 'Continuer vos achats' : 'Continue Shopping'?></button>
                                    </a>
                                </div>
                            </td>
                            <td colspan="4">
                                <div class="checkout">
                                    <div class="cart-total">
                                        <span>
                                            <?= ($language_name == 'French') ? 'Sous-total' : 'Sub Total'?>:
                                            <font class="cart-sub-total">
                                                <?= $product_price_currency_symbol.number_format($this->cart->total(), 2)?>
                                            </font>
                                        </span>
                                    </div>
                                    <div class="coupon">
                                        <a href="<?= $BASE_URL?>Checkouts">
                                            <button type="submit">
                                                <?= ($language_name == 'French') ? 'Passer à la caisse' : 'Proceed to Checkout'?>
                                            </button>
                                        </a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            <?php } else {?>
                <div class="text-center">
                    <h4 class="lead"><?= ($language_name == 'French') ? 'Le panier d\'achat est vide' : 'Shopping Cart Is Empty'?></h4>
                </div>
            <?php }?>
        </div>
    </div>
</div>
<script>
function isNumber(evt) {
    var iKeyCode = (evt.which) ? evt.which : evt.keyCode
    if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
        return false;
    return true;
}
</script>
