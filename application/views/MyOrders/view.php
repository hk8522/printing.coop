<?php
$currency_id = $orderData['currency_id'];
if (empty($currency_id)) {
    $currency_id = 1;
}
$OrderCurrencyData = $CurrencyList[$currency_id];
$order_currency_currency_symbol = $OrderCurrencyData['symbols'];

?>
<div class="my-account-main-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="my-account-section">
            <?php $this->load->view('elements/my-account-menu')?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span><?= $page_title ?></span>
                    <!--<button type="button" onclick="window.print();">Print Order</button>-->
                </div>
                <div class="text-center" style="color:red">
                    <?= $this->session->flashdata('message_error') ?>
                </div>
                <div class="text-center" style="color:green">
                    <?= $this->session->flashdata('message_success') ?>
                </div><br>

                <div class="account-area-inner-boxes">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="account-area-inner-box-single">
                                <div class="universal-small-dark-title">
                                    <span>
                                        <?= ($language_name == 'French') ? 'Informations sur la commande' : 'Order Information' ?></span>
                                </div>
                                <div class="quote-bottom-row summary-deatil">
                                    <div class="summary-deatil-inner">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span>
                                                            <?= ($language_name == 'French') ? 'Numéro de commande' : 'Order Id' ?></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= $orderData['order_id'] ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span>
                                                            <?= ($language_name == 'French') ? 'Code client' : 'Customer Code' ?>Customer Code:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= (!empty($orderData['user_id'])) ? CUSTOMER_ID_PREFIX . $orderData['user_id'] : '-' ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span>
                                                            <?= ($language_name == 'French') ? 'Nom du client' : 'Customer Name' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= ucfirst($orderData['name']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Mobile client' : 'Customer Mobile' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= ucfirst($orderData['mobile']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Email client' : 'Customer Email' ?></span>:
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= ucfirst($orderData['email']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Remise client privilégiée' : 'Preffered Customer Discount' ?>: Order Amount:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= $order_currency_currency_symbol . number_format($orderData['total_amount'], 2) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Statut de la commande' : 'Order Status' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= $language_name == 'French' ? getOrderSatusClassFrench($orderData['status']) : getOrderSatusClass($orderData['status']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Date de commande' : 'Order Date' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= dateFormate($orderData['created']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Mode de livraison' : 'Shipping Method' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?php
                                                            $Method = getShipingName($orderData);

                                                            if (!empty($Method)) {
                                                                echo $Method;
                                                            } else {
                                                                $shipping_method_formate = explode('-', $orderData['shipping_method_formate']);
                                                                if ($shipping_method_formate[0] == "pickupinstore") {
                                                                    $pickupStore = $this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
                                                                    echo 'Pickup In Store<br>' . $pickupStore['name'] . "<br>" . $pickupStore['address'] . "<br>" . $pickupStore['phone'];
                                                                }
                                                            }
                                                            ?>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </li>

                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French')  ? 'Commentaire de commande' : 'Order Comment' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= $orderData['order_comment'] ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="account-area-inner-box-single">
                                <div class="universal-small-dark-title">
                                    <span><?= ($language_name == 'French') ? 'Informations de paiement': 'Payment Information' ?></span>
                                </div>
                                <div class="quote-bottom-row summary-deatil">
                                    <div class="summary-deatil-inner">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Remise client privilégiée' : 'Preffered Customer Discount' ?>: Payment Type:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= ucfirst($orderData['payment_type']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Mode de paiement' : 'Payment Method' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= ucfirst($orderData['payment_type']) ?></strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Statut de paiement' : 'Payment Status' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?= $language_name == 'French' ? getOrderPaymentStatusFrench($orderData['payment_status']) : getOrderPaymentStatus($orderData['payment_status']) ?>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'ID de transition de paiement' : 'Payment Transition Id' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong><?= $orderData['transition_id'] ?></strong>
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
                                    <span><?= ($language_name == 'French') ? 'détails de facturation' : 'Billing Information' ?></span>
                                </div>
                                <div class="quote-bottom-row summary-deatil">
                                    <div class="summary-deatil-inner">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Adresse de facturation' : 'Billing Address' ?>:</span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?= ucfirst($orderData['billing_name']) ?>
                                                            <br>
                                                            Mobile:
                                                            <?= ucfirst($orderData['billing_mobile']) ?><?= !empty($orderData['billing_alternate_phone']) ? ',' . $orderData['billing_alternate_phone'] : '' ?>

                                                            <br> <?php if (!empty($orderData['billing_company'])) { ?>
                                                                Company: <?= $orderData['billing_company'] ?>
                                                                <br>
                                                            <?php } ?>

                                                            <?= $orderData['billing_address'] ?>

                                                            <br>
                                                            <?= $cityData['name'] ?>, <?= $stateData['name'] ?>, <?= $countryData['iso2'] ?>, <?= $orderData['billing_pin_code'] ?>
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
                                    <span><?= ($language_name == 'French') ? 'Informations sur la livraison' : 'Shipping Information' ?></span>
                                </div>
                                <div class="quote-bottom-row summary-deatil">
                                    <div class="summary-deatil-inner">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Adresse de livraison' : 'Shipping Address' ?></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?= ucfirst($orderData['shipping_name']) ?>
                                                            <br>
                                                            Mobile:
                                                            <?= ucfirst($orderData['shipping_mobile']) ?><?= !empty($orderData['shipping_alternate_phone']) ? ',' . $orderData['shipping_alternate_phone'] : '' ?>

                                                            <?php if (!empty($orderData['shipping_company'])) { ?>
                                                                <br>
                                                                Company: <?= $orderData['shipping_company'] ?>
                                                            <?php } ?>
                                                            <br>
                                                            <?= $orderData['shipping_address'] ?>

                                                            <br>
                                                            <?= $cityData['name'] ?>, <?= $stateData['name'] ?>, <?= $cityData['name'] ?>
                                                            <?= $countryData['iso2'] ?>, <?= $orderData['shipping_pin_code'] ?>
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
                                    <span><?= ($language_name == 'French') ? 'Facture PDF' : 'Invoice PDF' ?></span>
                                </div>
                                <div class="quote-bottom-row summary-deatil">
                                    <div class="summary-deatil-inner">
                                        <ul>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Facture PDF' : 'Invoice PDF' ?></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?php
                                                            if ($language_name == 'French') {
                                                                $file_name = $orderData['order_id'] . "-fr-invoice.pdf";
                                                                $file_name = strtolower($file_name);
                                                                $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                                $linkInvoice = $BASE_URL . "MyOrders/downloadOrderPdf/" . urlencode($location) . "/" . urlencode($file_name) . '/' . urlencode($orderData['id']);
                                                            } else {
                                                                $file_name = $orderData['order_id'] . "-invoice.pdf";
                                                                $file_name = strtolower($file_name);
                                                                $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                                $linkInvoice = $BASE_URL . "MyOrders/downloadOrderPdf/" . urlencode($location) . "/" . urlencode($file_name) . '/' . urlencode($orderData['id']);
                                                            }
                                                            $linkInvoice = $BASE_URL . "MyOrders/downloadOrderPdf/" . $orderData['id'] . '/invoice';
                                                            ?>
                                                            <a href="<?= $linkInvoice ?>">
                                                                <button type="button" class="btn btn-sm btn-danger">
                                                                    <i class="fa fas fa-file-download"></i>
                                                                    <?= ($language_name == 'French') ? 'Télécharger' : 'Download' ?>
                                                                </button>
                                                            </a>
                                                        </strong>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <span><?= ($language_name == 'French') ? 'Commander le PDF' : 'Order PDF' ?></span>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <strong>
                                                            <?php
                                                            if ($language_name == 'French') {
                                                                $file_name = $orderData['order_id'] . "-fr-order.pdf";
                                                                $file_name = strtolower($file_name);
                                                                $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                                $linkOrder = $BASE_URL . "MyOrders/downloadOrderPdf/" . urlencode($location) . "/" . urlencode($file_name) . '/' . urlencode($orderData['id']);
                                                            } else {
                                                                $file_name = $orderData['order_id'] . "-order.pdf";
                                                                $file_name = strtolower($file_name);
                                                                $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                                $linkOrder = $BASE_URL . "MyOrders/downloadOrderPdf/" . urlencode($location) . "/" . urlencode($file_name) . '/' . urlencode($orderData['id']);
                                                            }

                                                            $linkOrder = $BASE_URL . "MyOrders/downloadOrderPdf/" . $orderData['id'] . '/order';
                                                            ?>
                                                            <a href="<?= $linkOrder ?>">
                                                                <button type="button" class="btn btn-sm btn-danger">
                                                                    <i class="fa fas fa-file-download"></i>
                                                                    <?= ($language_name == 'French') ? 'Télécharger' : 'Download' ?></button>
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
                                        <th><?= ($language_name == 'French') ? 'Détails des articles' : 'Items Details' ?></th>
                                        <th><?= ($language_name == 'French') ? 'Prix' : 'Price' ?></th>
                                        <th><?= ($language_name == 'French') ? 'Quantité' : 'Quantity' ?></th>
                                        <th><?= ($language_name == 'French') ? 'Total' : 'Subtotal' ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    foreach ($OrderItemData as $rowid => $item) {
                                        $cart_images = json_decode($item['cart_images'], true);

                                        if ($item['provider_product_id']) {
                                            $attribute_ids = sina_options_map($item['attribute_ids']);
                                        } else {
                                            $attribute_ids = json_decode($item['attribute_ids'], true);
                                        }

                                        $product_size = json_decode($item['product_size'], true);

                                        $product_width_length = json_decode($item['product_width_length'], true);

                                        $page_product_width_length = json_decode($item['page_product_width_length'], true);
                                        $product_depth_length_width = json_decode($item['product_depth_length_width'], true);

                                        $votre_text = $item['votre_text'];

                                        $recto_verso = $item['recto_verso'];

                                        $product_id = $item['product_id'];
                                        ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="<?= $BASE_URL ?>Products/view/<?= base64_encode($item['id']) ?>">
                                                    <?php
                                                    $imageurl = getProductImage($item['product_image']);
                                                    $personailise = $item['personailise'];
                                                    $personailise_image = $item['personailise_image'];
                                                    $Personalised = 'Unpersonalised';
                                                    if ($personailise == 1 && $personailise_image != '') {
                                                        $Personalised = 'Personalised';
                                                        $imageurl = FILE_UPLOAD_BASE_URL . 'personailise/' . $personailise_image;
                                                   } ?>
                                                    <img src="<?= $imageurl ?>">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="<?= $BASE_URL ?>Products/view/<?= base64_encode($item['id']) ?>">
                                                    <?= ($language_name == 'French') ? ucfirst($item['name_french']) : ucfirst($item['name']) ?>
                                                </a>

                                                <div class="product-name-detail">
                                                    <div class="row">
                                                        <?php if (!empty($product_width_length)) { ?>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Longueur(pouces)' : 'Length(Inch)' ?>: <?= $product_width_length['product_length'] ?></strong>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Largeur (pouces)' : 'Width(Inch)' ?>: <?= $product_width_length['product_width'] ?></strong>
                                                                </span>
                                                            </div>
                                                            <?php if (!empty($product_width_length['length_width_color_show'])) { ?>
                                                                <div class="col-md-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Couleursv:' . $product_width_length['length_width_color_french'] : 'Colors:' . $product_width_length['length_width_color'] ?>
                                                                        </strong></span>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (!empty($product_width_length['product_total_page'])) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity' ?>: <?= $product_width_length['product_total_page'] ?></strong>
                                                                    </span>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>

                                                        <?php if (!empty($product_depth_length_width)) { ?>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Longueur (pouces)' : 'Length(Inch)' ?>: <?= $product_depth_length_width['product_depth_length'] ?></strong>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Largeur (pouces)' : 'Width(Inch)' ?>: <?= $product_depth_length_width['product_depth_width'] ?></strong>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Profondeur (pouces)' : 'Depth(Inch)' ?>: <?= $product_depth_length_width['product_depth'] ?></strong>
                                                                </span>
                                                            </div>
                                                            <?php if (!empty($product_depth_length_width['depth_color_show'])) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Couleursv:' . $product_depth_length_width['depth_color_french'] : 'Colors:' . $product_depth_length_width['depth_color'] ?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (!empty($product_depth_length_width['product_depth_total_page'])) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity' ?>: <?= $product_depth_length_width['product_depth_total_page'] ?></strong>
                                                                    </span>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
                                                        <?php if (!empty($page_product_width_length)) { ?>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Longueur (pouces)' : 'Length(Inch)' ?>: <?= $page_product_width_length['page_product_length'] ?></strong>
                                                                </span>
                                                            </div>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Largeur(pouces)' : 'Width(Inch)' ?>: <?= $page_product_width_length['page_product_width'] ?></strong>
                                                                </span>
                                                            </div>

                                                            <?php if (!empty($page_product_width_length['page_length_width_color_show'])) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Couleursv:' . $page_product_width_length['page_length_width_color_french'] : 'Colors:' . $page_product_width_length['page_length_width_color'] ?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (!empty($page_product_width_length['page_product_total_page'])) { ?>
                                                                <div class="col-md-12 col-lg-12 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Des pages:' . $page_product_width_length['page_product_total_page_french'] : 'Pages:' . $page_product_width_length['page_product_total_page'] ?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (!empty($page_product_width_length['page_product_total_sheets'])) { ?>
                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? ' Feuille par bloc:' . $page_product_width_length['page_product_total_sheets_french'] : 'Sheet Per Pad:' . $page_product_width_length['page_product_total_sheets'] ?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                            <?php if (!empty($page_product_width_length['page_product_total_quantity'])) { ?>
                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Quantité:' . $page_product_width_length['page_product_total_quantity'] : 'Quantity:' . $page_product_width_length['page_product_total_quantity'] ?></strong></span>
                                                                </div>
                                                            <?php } ?>
                                                        <?php } ?>
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
                                                                    <span><strong><?= ($language_name == 'French') ? 'Quantité' : 'Quantity' ?> : <?= $label_qty ?></strong></span>
                                                                </div>
                                                            <?php } ?>

                                                            <?php if ($size_name) { ?>
                                                                <div class="col-md-12 col-lg-6 col-xl-6">
                                                                    <span><strong><?= ($language_name == 'French') ? 'Taille' : 'Size' ?>: <?= $size_name ?></strong></span>
                                                                </div>
                                                            <?php } ?>

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
                                                                                <?= $multiple_attribute_name . ':' . $multiple_attribute_item_name ?>
                                                                            </strong>
                                                                        </span>
                                                                    </div>
                                                                <?php }
                                                            }
                                                        }
                                                        ?>

                                                        <?php $this->view('Products/expand_attribute_ids', ['attribute_ids' => $attribute_ids, 'language_name' => $language_name]); ?>

                                                        <?php if (!empty($recto_verso)) { ?>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Recto verso:' . $recto_verso_french : 'Recto/Verso:' . $recto_verso ?></strong></span>
                                                            </div>
                                                        <?php } ?>

                                                        <?php if (!empty($votre_text)) { ?>
                                                            <div class="col-md-12 col-lg-12 col-xl-6">
                                                                <span><strong><?= ($language_name == 'French') ? 'Votre TEXTE - Votre TEXTE' : 'Your TEXT - Votre TEXT' ?>: <?= $votre_text ?></strong></span>
                                                            </div>
                                                        <?php } ?>
                                                    </div>
                                                </div>

                                                <div class="uploaded-file-detail" id="upload-file-data">
                                                    <?php if (!empty($cart_images)) {
                                                        foreach ($cart_images as $key => $return_arr) { ?>
                                                            <div class="uploaded-file-single"
                                                                id="teb-<?= $return_arr['skey'] ?>">
                                                                <div class="uploaded-file-single-inner">
                                                                    <div class="uploaded-file-img"
                                                                        style="background-image: url(<?= $return_arr['src'] ?>)">
                                                                    </div>
                                                                    <div class="uploaded-file-info">
                                                                        <div class="uploaded-file-name">
                                                                            <span><?= $return_arr['name'] ?></span>
                                                                        </div>
                                                                        <div class="upload-field">
                                                                            <?php $link = $BASE_URL . "MyOrders/download/" . urlencode($return_arr['location']) . "/" . urlencode($return_arr['name']); ?><br>

                                                                            <div class="uploaded-file-info">
                                                                                <a href="<?= $link ?>">
                                                                                    <i class="fa fas fa-file-download"></i>
                                                                                    <?= ($language_name == 'French') ? 'Télécharger' : 'Download' ?>
                                                                                </a>

                                                                                <?php if (!empty($return_arr['cumment'])) { ?>
                                                                                    <div class="upload-field">
                                                                                        <?= ($language_name == 'French') ? 'Commentaire' : 'Comment' ?> : <?= $return_arr['cumment'] ?>
                                                                                    </div>
                                                                                <?php } ?>
                                                                            </div>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        <?php }
                                                   } ?>
                                                </div>
                                            </td>
                                            <td class="product-price1">
                                                <span>
                                                    <?= $order_currency_currency_symbol . number_format($item['price'], 2) ?>
                                                </span>
                                            </td>
                                            <td class="quant-cart text-left">
                                                <?= $item['quantity'] ?>
                                            </td>
                                            <td class="product-subtotal">
                                                <span>
                                                    <?php
                                                    $subtotal = ($item['price'] * $item['quantity']);
                                                    echo $order_currency_currency_symbol . number_format($subtotal, 2);
                                                    ?>
                                                </span>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <div class="cart-total">
                                                <span><?= ($language_name == 'French') ? 'Montant sous-total' : 'Subtotal Amount' ?>: <font class="cart-sub-total">
                                                        <?= $order_currency_currency_symbol . "" . number_format($orderData['sub_total_amount'], 2) ?>
                                                    </font>
                                                </span>
                                            </div>
                                            <?php if (!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] != "0.00") { ?>
                                                <div class="cart-total">
                                                    <span>
                                                        <?= ($language_name == 'French') ? 'Remise client privilégiée' : 'Preffered Customer Discount' ?>:
                                                        <font class="cart-sub-total">
                                                            <?= '-' . $order_currency_currency_symbol . number_format($orderData['preffered_customer_discount'], 2) ?>
                                                        </font>
                                                    </span>
                                                </div>
                                            <?php } ?>

                                            <?php if (!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] != "0.00") { ?>
                                                <div class="cart-total">
                                                    <span>
                                                        <?= ($language_name == 'French') ? 'Remise de coupon' : 'Coupon Discount' ?>:
                                                        <font class="cart-sub-total">
                                                            <?= '-' . $order_currency_currency_symbol . number_format($orderData['coupon_discount_amount'], 2) ?>
                                                        </font>
                                                    </span>
                                                </div>
                                            <?php } ?>

                                            <div class="cart-total">
                                                <span><?= ($language_name == 'French') ? "Frais d'expédition" : 'Shipping Fee' ?> :
                                                    <font class="cart-sub-total">
                                                        <?= $order_currency_currency_symbol . number_format($orderData['delivery_charge'], 2) ?>
                                                    </font>
                                                </span>
                                            </div>
                                            <?php if (!empty($orderData['total_sales_tax']) && $orderData['total_sales_tax'] != '0.00') { ?>
                                                <div class="cart-total">
                                                    <span>Total <?= $salesTaxRatesProvinces_Data['type'] ?>
                                                        <?= number_format($salesTaxRatesProvinces_Data['total_tax_rate'], 2) ?>%:
                                                        <font class="cart-sub-total"><?= $order_currency_currency_symbol . number_format($orderData['total_sales_tax'], 2) ?></font>
                                                    </span>
                                                </div>
                                            <?php } ?>

                                            <div class="cart-total">
                                                <span>
                                                    <?= ($language_name == 'French') ? 'Montant total de la commande' : 'Order Total Amount' ?>:
                                                    <font class="cart-sub-total"><?= $order_currency_currency_symbol . "" . number_format($orderData['total_amount'], 2) ?></font>
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
