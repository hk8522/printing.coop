<style>
.account-area-inner-box-single {
    padding: 35px 25px 40px 25px;
    border: 1px solid rgba(0,0,0,0.1);
    margin-top: 20px;
    background: #fff;
}
.account-area-inner-box-single .universal-small-dark-title {
    padding-bottom: 20px;
    border-bottom: 2px dashed rgba(0,0,0,0.1);
}
.account-area-inner-box-single .quote-bottom-row {
    margin-top: 25px;
}
.summary-deatil-inner ul {
    list-style: none;
    margin: 0px;
    padding: 0px;
}
.summary-deatil-inner ul li {
    padding: 10px 10px 10px 10px;
    border-bottom: 1px solid rgba(0,0,0,0.1);
}
.summary-deatil-inner ul li span {
    font-weight: 300;
    color: #555;
    font-size: 15px;
}
.summary-deatil-inner ul li strong {
    font-weight: 400;
    display: inline-block;
    color: #000;
    font-size: 15px;
}
.summary-deatil-inner ul li:last-child {
    border-bottom: none;
}
.account-area .product-information {
    margin: 60px 0px 0px 0px;
    border: none;
}
.quant-cart.text-left {
    justify-content: left !important;
}
.account-area .shop-cart-table {
    border-collapse: collapse;
    width: 100%;
}
.account-area .shop-cart-table thead th {
    font-size: 14px;
    font-weight: 500;
    color: #aaa;
    text-transform: uppercase;
    padding: 15px 5px;
    vertical-align: middle;
}
.account-area .quant-cart button:last-child {
    margin-left: 10px;
}
.account-area .shop-cart-table tbody td {
    padding: 20px 5px;
}
.account-area .shop-cart-table tr {
    border-bottom: 1px solid rgba(0,0,0,0.1);
    transition: .3s;
    vertical-align: top;
}
.account-area .shop-cart-table a.remove {
    width: 30px;
    height: 30px;
    font-size: 25px;
    color: #fff;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #193e73;
    transition: .3s;
    border-radius: 50%;
}
.account-area .shop-cart-table a.remove:hover {
    color: #fff;
    background-color: #193e73;
    transition: .3s;
}
.account-area .shop-cart-table .product-thumbnail img {
    width: 100px;
    height: auto;
}
.account-area .shop-cart-table td.product-name a {
    font-size: 15px;
    font-weight: 600;
    color: #303030;
    transition: .3s;
}
.account-area .shop-cart-table td.product-name a:hover {
    color: #f58634;
    transition: .3s;
}
.account-area .shop-cart-table td.product-price1 {
    font-size: 15px;
    color: #303030;
    font-weight: 400;
    white-space: nowrap;
}
.account-area .shop-cart-table td.product-subtotal {
    font-size: 15px;
    color: #303030;
    font-weight: 400;
    white-space: nowrap;
}
.account-area .shop-cart-table .quant-cart {
    margin-top: 0px;
    justify-content: center;
}
.account-area .shop-cart-table .quant-cart input {
    width: 50px;
}
.account-area .shop-cart-table .coupon button {
    border: 1px solid #f58634;
    height: 40px;
    color: #fff;
    background: #f58634;
    padding: 5px 20px;
    font-size: 14px;
    font-weight: 600;
    text-transform: uppercase;
    transition: 0.3s;
    white-space: nowrap;
}
.account-area .shop-cart-table .coupon {
    text-align: left;
}
.account-area .shop-cart-table .checkout {
    display: flex;
    justify-content: flex-end;
    align-items: center;
    width: 100%;
}
.account-area .shop-cart-table .cart-total span {
    font-size: 15px;
    font-weight: 400;
    color: #303030;
    word-spacing: 2px;
}
.account-area .shop-cart-table .cart-total {
    margin-right: 40px;
}
.account-area .cart-total span font {
    color: #193e73;
    font-size: 22px;
    font-weight: 600;
}
.account-area .shopping-product-display {
    overflow: initial;
    height: auto;
}
.account-area .shopping-product-display table {
    border-left: none;
    border-right: none;
}
</style>
<?php
$currency_id=$orderData['currency_id'];
if (empty($currency_id)) {
    $currency_id = 1;
}
$OrderCurrencyData = $CurrencyList[$currency_id];
$order_currency_currency_symbol = $OrderCurrencyData['symbols'];
?>
<div class="content-wrapper" style="min-height: 687px;">
    <section class="content">
        <div class="row">
            <div class="col-xs-12 col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="inner-head-section">
                            <div class="inner-title">
                                <span><?=ucfirst($page_title)?></span>
                            </div>
                        </div>

                        <div class="my-account-main-section universal-spacing universal-bg-white">
                            <div class="my-account-section">
                                <div class="account-area">
                                    <div class="account-area-inner-boxes">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="account-area-inner-box-single">
                                                    <div class="universal-small-dark-title">
                                                        <span>Order Information</span>
                                                    </div>
                                                    <div class="quote-bottom-row summary-deatil">
                                                        <div class="summary-deatil-inner">
                                                            <ul>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Order Id</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=$orderData['order_id']?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Customer Code:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?php if (!empty($orderData['user_id'])) {
                                                                                echo CUSTOMER_ID_PREFIX.$orderData['user_id'];
                                                                            } else {
                                                                                echo "-";
                                                                            }?>																		</strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Website:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=$StoreList[$orderData['store_id']]['name']?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Customer Name:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=ucfirst($orderData['name'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Customer Mobile:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=ucfirst($orderData['mobile'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Customer Email:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=ucfirst($orderData['email'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Order Amount:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=$order_currency_currency_symbol.number_format($orderData['total_amount'], 2)?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Order Status:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=getOrderSatusClass($orderData['status'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Order Date:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=dateFormate($orderData['created'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>

                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Shipping Method:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
                                                                                <?php
                                                                                $Method = getShipingName($orderData);
                                                                                if (!empty($Method)) {
                                                                                    echo $Method;
                                                                                } else {
                                                                                    $shipping_method_formate = explode('-',$orderData['shipping_method_formate']);
                                                                                    if ($shipping_method_formate[0] == "pickupinstore") {
                                                                                        $pickupStore = $this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
                                                                                        echo 'Pickup In Store<br>'.$pickupStore['name']."<br>".$pickupStore['address']."<br>".$pickupStore['phone'];
                                                                                    }
                                                                                }?>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php
                                                                $shipping_method_formate = explode('-',$orderData['shipping_method_formate']);
                                                                $flag_shiping_cost = $orderData['flag_shiping_cost'];
                                                                if ($shipping_method_formate[0] == "flagship" && $flag_shiping_cost != 0.00 && !empty($flag_shiping_cost)) {
                                                                ?>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Flagship Shipping Cost:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
                                                                                <?=$order_currency_currency_symbol . "" . number_format($flag_shiping_cost, 2)?>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <?php }?>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="account-area-inner-box-single">
                                                    <div class="universal-small-dark-title">
                                                        <span>Payment Information</span>
                                                    </div>
                                                    <div class="quote-bottom-row summary-deatil">
                                                        <div class="summary-deatil-inner">
                                                            <ul>
                                                                <!--<li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Payment Type:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=ucfirst($orderData['payment_type'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>-->
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Payment Method:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=ucfirst($orderData['payment_type'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Payment Status:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=getOrderPaymentStatus($orderData['payment_status'])?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Payment Transition Id:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?=$orderData['transition_id']?></strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="account-area-inner-box-single">
                                                    <div class="universal-small-dark-title">
                                                        <span>Billing Information</span>
                                                    </div>
                                                    <div class="quote-bottom-row summary-deatil">
                                                        <div class="summary-deatil-inner">
                                                            <ul>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Billing Address:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
                                                                                <?=ucfirst($orderData['billing_name'])?>
                                                                                <br>
                                                                                Mobile: <?=ucfirst($orderData['billing_mobile'])?><?=!empty($orderData['billing_alternate_phone']) ? ',' . $orderData['billing_alternate_phone'] : ''?>
                                                                                <br>
                                                                                <?php if (!empty($orderData['billing_company'])) {?>
                                                                                    Company:<?=$orderData['billing_company']?>
                                                                                    <br>
                                                                                <?php }?>

                                                                                <?=$orderData['billing_address']?>

                                                                                <br>
                                                                                <?=$cityData['name']?>,<?=$stateData['name']?>,<?=$countryData['iso2']?>,<?=$orderData['billing_pin_code']?>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="account-area-inner-box-single">
                                                    <div class="universal-small-dark-title">
                                                        <span>Shipping Information</span>
                                                    </div>
                                                    <div class="quote-bottom-row summary-deatil">
                                                        <div class="summary-deatil-inner">
                                                            <ul>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Shipping Address:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
                                                                                <?=ucfirst($orderData['shipping_name'])?>
                                                                                <br>
                                                                                Mobile: <?=ucfirst($orderData['shipping_mobile'])?><?=!empty($orderData['shipping_alternate_phone']) ? ',' . $orderData['shipping_alternate_phone'] : ''?>

                                                                                <?php if (!empty($orderData['shipping_company'])) {?>
                                                                                    <br>
                                                                                    Company:<?=$orderData['shipping_company']?>
                                                                                <?php }?>
                                                                                <br>
                                                                                <?=$orderData['shipping_address']?>

                                                                                <br>
                                                                                <?=$cityData['name']?>,<?=$stateData['name']?> ,<?=$cityData['name']?> <?=$countryData['iso2']?>,<?=$orderData['shipping_pin_code']?>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="account-area-inner-box-single">
                                                    <div class="universal-small-dark-title">
                                                        <span>Invoice Download</span>
                                                    </div>
                                                    <div class="quote-bottom-row summary-deatil">
                                                        <div class="summary-deatil-inner">
                                                            <ul>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Invoice PDF</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
                                                                                <?php
                                                                                $file_name = $orderData['order_id'] . ($langue_id == 2 ? '-fr' : '') . "-invoice.pdf";
                                                                                $file_name = strtolower($file_name);
                                                                                $location = FILE_BASE_PATH.'pdf/'.$file_name;
                                                                                $linkInvoice = $BASE_URL."admin/Orders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
                                                                                ?>
                                                                                <a href="<?=$linkInvoice?>">
                                                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-file-download"></i> Download</button>
                                                                                </a>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>Order PDF</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong>
                                                                                <?php
                                                                                $file_name = $orderData['order_id'] . ($langue_id == 2 ? '-fr' : '') . "-order.pdf";
                                                                                $file_name = strtolower($file_name);
                                                                                $location = FILE_BASE_PATH.'pdf/'.$file_name;
                                                                                $linkOrder = $BASE_URL."admin/Orders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
                                                                                //$linkOrder=$BASE_URL."admin/Orders/download/".urlencode($location);
                                                                                ?>
                                                                                <a href="<?=$linkOrder?>">
                                                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-file-download"></i> Download</button>
                                                                                </a>
                                                                            </strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="product-information">
                                        <div class="shopping-product-section">
                                            <div class="shopping-product-display">
                                                <table class="shop-cart-table">
                                                    <thead>
                                                        <tr>
                                                            <th></th>
                                                            <th>Items Details</th>
                                                            <th>Price</th>
                                                            <th>Quantity</th>
                                                            <th>Subtotal</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                        foreach ($OrderItemData as $rowid => $item) {
                                                            $cart_images = $item['cart_images'];

                                                            $cart_images = !empty($cart_images) ? json_decode($cart_images, true) : array();
                                                            $cart_images = (array) $cart_images;

                                                            if ($item['provider_product_id']) {
                                                                $attribute_ids = sina_options_map($item['attribute_ids']);
                                                            } else {
                                                                $attribute_ids = json_decode($item['attribute_ids'], true);
                                                            }

                                                            $product_size = json_decode($item['product_size'], true);
                                                            $product_width_length = $item['product_width_length'];

                                                            $product_width_length = json_decode($item['product_width_length'], true);
                                                            $page_product_width_length = json_decode($item['page_product_width_length'], true);

                                                            $product_depth_length_width = json_decode($item['product_depth_length_width'], true);

                                                            $votre_text = $item['votre_text'];
                                                            $recto_verso = $item['recto_verso'];
                                                            $product_id = $item['product_id'];
                                                            //$AttributesData=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
                                                        ?>
                                                        <tr>
                                                            <td class="product-thumbnail">
                                                                <a href="<?=$BASE_URL?>Products/view/<?=base64_encode($item['id'])?>">
                                                                    <?php $imageurl = getProductImage($item['product_image']);?>
                                                                    <img src="<?=$imageurl?>">
                                                                </a>
                                                            </td>
                                                            <td class="product-name">
                                                                <a href="<?=$BASE_URL?>Products/view/<?=base64_encode($item['id'])?>"><?=ucfirst($item['name'])?></a>
                                                                <div class="product-name-detail">
                                                                    <div class="row">
                                                                        <?php if (!empty($product_width_length)) {?>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Length(Inch): <?=$product_width_length['product_length']?></strong></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Width(Inch): <?=$product_width_length['product_width']?></strong></span>
                                                                            </div>
                                                                            <?php if (!empty($product_width_length['length_width_color_show'])) {?>
                                                                                <div class="col-md-6">
                                                                                    <span><strong>Colors: <?=$product_width_length['length_width_color']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                            <?php if (!empty($product_width_length['product_total_page'])) {?>
                                                                                <div class="col-md-6">
                                                                                    <span><strong>Quantity: <?=$product_width_length['product_total_page']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                        <?php }?>
                                                                        <?php if (!empty($product_depth_length_width)) {?>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Length(Inch): <?=$product_depth_length_width['product_depth_length']?></strong></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Width(Inch): <?=$product_depth_length_width['product_depth_width']?></strong></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Depth(Inch): <?=$product_depth_length_width['product_depth']?></strong></span>
                                                                            </div>
                                                                            <?php if (!empty($product_depth_length_width['depth_color_show'])) {?>
                                                                                <div class="col-md-6">
                                                                                    <span><strong>Colors: <?=$product_depth_length_width['depth_color']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                            <?php if (!empty($product_depth_length_width['product_depth_total_page'])) {?>
                                                                                <div class="col-md-6">
                                                                                    <span><strong>Quantity: <?=$product_depth_length_width['product_depth_total_page']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                        <?php }?>

                                                                        <?php
                                                                        if (!empty($page_product_width_length)) {?>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Page Length(Inch): <?=$page_product_width_length['page_product_length']?></strong></span>
                                                                            </div>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Page Width(Inch): <?=$page_product_width_length['page_product_width']?></strong></span>
                                                                            </div>
                                                                            <?php if (!empty($page_product_width_length['page_length_width_color_show'])) {?>
                                                                                <div class="col-md-6">
                                                                                    <span><strong>Colors: <?=$page_product_width_length['page_length_width_color']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                            <?php if (!empty($page_product_width_length['page_product_total_page'])) {?>
                                                                                <div class="col-md-6">
                                                                                    <span><strong>Pages: <?=$page_product_width_length['page_product_total_page']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                            <?php if (!empty($page_product_width_length['page_product_total_sheets'])) {?>
                                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                                    <span><strong>Sheet Per Pad: <?= $page_product_width_length['page_product_total_sheets']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                            <?php
                                                                            if (!empty($page_product_width_length['page_product_total_quantity'])) { ?>
                                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                                    <span><strong>Quantity: <?=$page_product_width_length['page_product_total_quantity']?></strong></span>
                                                                                </div>
                                                                            <?php }?>
                                                                        <?php }?>
                                                                        <?php
                                                                        if (!empty($product_size)) {
                                                                            $size_name = $product_size['product_size'];
                                                                            $label_qty = $product_size['product_quantity'];
                                                                            $attribute = isset($product_size['attribute']) ? $product_size['attribute'] : '';

                                                                            if ($label_qty) { ?>
                                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                                    <span><strong>Quantity: <?=$label_qty?></strong></span>
                                                                                </div>
                                                                            <?php }?>

                                                                            <?php
                                                                            if ($size_name) { ?>
                                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                                    <span><strong>Size: <?=$size_name?></strong></span>
                                                                                </div>
                                                                            <?php }?>

                                                                            <?php
                                                                            if ($attribute) {
                                                                                foreach ($attribute as $akey => $aval) {
                                                                                    $multiple_attribute_name = $aval['attributes_name'];
                                                                                    $multiple_attribute_item_name = $aval['attributes_item_name'];
                                                                            ?>

                                                                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                                                                        <span>
                                                                                            <strong><?= $multiple_attribute_name?>: <?=$multiple_attribute_item_name?></strong>
                                                                                        </span>
                                                                                    </div>
                                                                                <?php }
                                                                            }?>
                                                                        <?php }?>
                                                                        <?php
                                                                        foreach ($attribute_ids as $key => $val) {
                                                                            $attribute_name = $val['attribute_name'];
                                                                            $item_name = $val['item_name'];
                                                                        ?>
                                                                            <div class="col-md-12 col-lg-6 col-xl-6">
                                                                                <span><strong><?=$attribute_name?>: <?=$item_name?></strong></span>
                                                                            </div>
                                                                        <?php }?>
                                                                        <?php if (!empty($recto_verso)) {?>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Recto/Verso: <?=$recto_verso?></strong></span>
                                                                            </div>
                                                                        <?php }?>

                                                                        <?php if (!empty($votre_text)) {?>
                                                                            <div class="col-md-6">
                                                                                <span><strong>Your TEXT - Votre TEXT: <?=$votre_text?></strong></span>
                                                                            </div>
                                                                        <?php }?>
                                                                    </div>
                                                                </div>
                                                                <div class="uploaded-file-detail" id="upload-file-data">
                                                                    <?php if (!empty($cart_images)) {
                                                                        foreach ($cart_images as $key=>$return_arr) {
                                                                            //pr($return_arr);?>
                                                                            <div class="uploaded-file-single" id="teb-<?=$return_arr['skey']?>">
                                                                                <div class="uploaded-file-single-inner">
                                                                                    <div class="uploaded-file-img" style="background-image: url(<?=$return_arr['src']?>)">

                                                                                    </div>

                                                                                    <img src="<?=$return_arr['src']?>" width="150">
                                                                                    <?php
                                                                                    $link = $BASE_URL."admin/Orders/download/".urlencode($return_arr['location'])."/".urlencode($return_arr['name']);
                                                                                    ?>
                                                                                    <br>

                                                                                    <div class="uploaded-file-info">
                                                                                        <div class="uploaded-file-name">
                                                                                            <span><?=$return_arr['name']?></span>
                                                                                        </div>

                                                                                        <?php
                                                                                        if (!empty($return_arr['cumment'])) {?>
                                                                                            <div class="upload-field">
                                                                                                Comment: <?=$return_arr['cumment']?>
                                                                                            </div>
                                                                                        <?php }?>

                                                                                        <a href="<?=$link?>">
                                                                                            <i class="fas fa-file-download"></i> Download
                                                                                        </a>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        <?php }
                                                                    }?>
                                                                </div>
                                                            </td>
                                                            <td class="product-price1">
                                                                <span>
                                                                    <?=$order_currency_currency_symbol.number_format($item['price'], 2)?>
                                                                </span>
                                                            </td>
                                                            <td class="quant-cart text-left">
                                                                <?=$item['quantity']?>
                                                            </td>
                                                            <td class="product-subtotal">
                                                                <span>
                                                                    <?php
                                                                    $subtotal = ($item['price'] * $item['quantity']);
                                                                    echo $order_currency_currency_symbol.number_format($subtotal, 2);
                                                                    ?>
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <?php }?>
                                                        <tr>
                                                            <td colspan="5" class="text-right">
                                                                <div class="cart-total">
                                                                    <span>Subtotal Amount: <font class="cart-sub-total"><?=$order_currency_currency_symbol."".number_format($orderData['sub_total_amount'], 2)?></font>
                                                                </div>
                                                                <?php
                                                                if (!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] !="0.00") {?>
                                                                    <div class="cart-total">
                                                                        <span>
                                                                            Preffered Customer Discount:
                                                                            <font class="cart-sub-total">
                                                                            <?='-'.$order_currency_currency_symbol.number_format($orderData['preffered_customer_discount'], 2)?></font>
                                                                        </span>
                                                                    </div>
                                                                <?php }?>
                                                                <?php if (!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] !="0.00") {?>
                                                                    <div class="cart-total">
                                                                        <span>Coupon Discount:
                                                                            <font class="cart-sub-total"><?='-'.$order_currency_currency_symbol.number_format($orderData['coupon_discount_amount'], 2)?></font>
                                                                        </span>
                                                                    </div>
                                                                <?php }?>
                                                                <div class="cart-total">
                                                                    <span>Shipping Fee:
                                                                        <font class="cart-sub-total">
                                                                            <?= $order_currency_currency_symbol.number_format($orderData['delivery_charge'], 2)?>
                                                                        </font>
                                                                    </span>
                                                                </div>

                                                                <?php
                                                                if (!empty($orderData['total_sales_tax']) &&  $orderData['total_sales_tax'] != 0) {
                                                                ?>
                                                                    <div class="cart-total">
                                                                        <span>Total <?=$salesTaxRatesProvinces_Data['type']?> <?=number_format($salesTaxRatesProvinces_Data['total_tax_rate'], 2)?>%:
                                                                            <font class="cart-sub-total"><?= $order_currency_currency_symbol.number_format($orderData['total_sales_tax'], 2)?></font>
                                                                        </span>
                                                                    </div>
                                                                <?php }?>
                                                                <div class="cart-total">
                                                                    <span>
                                                                        Order Total Amount:
                                                                        <font class="cart-sub-total">
                                                                            <?= $order_currency_currency_symbol . "" . number_format($orderData['total_amount'], 2)?>
                                                                        </font>
                                                                    </span>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
