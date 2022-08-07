<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php $this->load->view('elements/my-account-menu')?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span>
                        <?= ($language_name == 'French') ? 'Vos commandes' : 'Your Orders' ?></span>
                </div>
                <div class="text-center" style="color:red">
                    <?= $this->session->flashdata('message_error') ?>
                </div>
                <div class="text-center" style="color:green">
                    <?= $this->session->flashdata('message_success') ?>
                </div><br>
                <div class="order-display-section">
                    <?php if (!empty($orderData)) { ?>
                        <?php foreach ($orderData as $list) {
                            $currency_id = $list['currency_id'];
                            if (empty($currency_id)) {
                                $currency_id = 1;
                            }
                            $OrderCurrencyData = $CurrencyList[$currency_id];
                            $order_currency_currency_symbol = $OrderCurrencyData['symbols'];
                            ?>
                            <div class="single-order-display">

                                <div class="email-field1">
                                    <div class="row align-items-center">
                                        <div class="col-7 col-md-4 col-lg-3 col-xl-3">
                                            <div class="order-id">
                                                <button type="submit"><?= $list['order_id'] ?></button>
                                            </div>
                                        </div>
                                        <div class="col-5 col-md-3 col-lg-3 col-xl-3">
                                            <div class="status-btn">
                                                <?= $language_name == 'French' ? getOrderSatusClassFrench($list['status']) : getOrderSatusClass($list['status']) ?>
                                            </div>
                                        </div>

                                        <div class="col-12 col-md-5 col-lg-6 col-xl-6 text-right">
                                            <div class="order-id-button">
                                                <?php if (in_array($list['status'], array(6, 7, 8))) { ?>
                                                    <a href="<?= $BASE_URL ?>MyOrders/deleteOrder/<?= base64_encode($list['id']) ?>"
                                                        onclick="return confirm('Are you sure you want to delete this order?');">
                                                        <button type="button">
                                                            <?= ($language_name == 'French') ? 'supprimer' : 'delete' ?></button>
                                                    </a>
                                                <?php
                                                }
                                                if (in_array($list['status'], array(2, 3, 4))) { ?>
                                                    <a href="javascript:void(0)" onclick="changeOrderStatus('<?= $list['id'] ?>',6)">
                                                        <button type="submit">
                                                            <?= ($language_name == 'French') ? 'Annuler' : 'cancel' ?>
                                                        </button>
                                                    </a>
                                                <?php } ?>
                                                <a href="<?= $BASE_URL ?>MyOrders/view/<?= base64_encode($list['id']) ?>">
                                                    <button class="view-details-btn" type="button">
                                                        <?= $language_name == 'French' ? "Voir l'ordre" : 'View Order' ?>
                                                    </button>
                                                </a>
                                                <?php
                                                if ($language_name == 'French') {
                                                    $file_name = $list['order_id'] . "-fr-invoice.pdf";
                                                    $file_name = strtolower($file_name);
                                                    $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                    $linkInvoice = $BASE_URL . "MyOrders/download/" . urlencode($location) . "/" . urlencode($file_name);
                                                    $InvoiceText = 'Facture Pdf';
                                                } else {
                                                    $file_name = $list['order_id'] . "-invoice.pdf";
                                                    $file_name = strtolower($file_name);
                                                    $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                    $linkInvoice = $BASE_URL . "MyOrders/download/" . urlencode($location) . "/" . urlencode($file_name);
                                                    $InvoiceText = 'Invoice Pdf';
                                                }
                                                $linkInvoice = $BASE_URL . "MyOrders/downloadOrderPdf/" . $list['id'] . '/invoice';
                                                ?>

                                                <a href="<?= $linkInvoice ?>">
                                                    <button class="view-details-btn" type="button">
                                                        <i class="fas fa-file-download"></i> <?= $InvoiceText ?>
                                                    </button>
                                                </a>
                                                <?php
                                                if ($language_name == 'French') {
                                                    $file_name = $list['order_id'] . "-fr-order.pdf";
                                                    $file_name = strtolower($file_name);
                                                    $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                    $linkOrder = $BASE_URL . "MyOrders/download/" . urlencode($location) . "/" . urlencode($file_name);
                                                } else {
                                                    $file_name = $list['order_id'] . "-order.pdf";
                                                    $file_name = strtolower($file_name);
                                                    $location = FILE_BASE_PATH . 'pdf/' . $file_name;
                                                    $linkOrder = $BASE_URL . "MyOrders/download/" . urlencode($location) . "/" . urlencode($file_name);
                                                }
                                                $linkOrder = $BASE_URL . "MyOrders/downloadOrderPdf/" . $list['id'] . '/order';
                                                ?>
                                                <a href="<?= $linkOrder ?>">
                                                    <button class="view-details-btn" type="button">
                                                        <i class="fas fa-file-download"></i> <?= ($language_name == 'French') ? 'Commander Pdf' : 'Order Pdf' ?>
                                                    </button>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="cart-product-display">
                                    <table>
                                        <tbody>
                                            <?php foreach ($list['OrderItem'] as $rowid => $item) { ?>
                                            <tr>
                                                <td style="width: 80px;">
                                                    <div class="cart-product-img">
                                                        <a href="<?= $BASE_URL ?>Products/view/<?= base64_encode($item['product_id']) ?>">
                                                            <?php
                                                            $imageurl = getProductImage($item['product_image']);
                                                            $personailise = $item['personailise'];
                                                            $personailise_image = $item['personailise_image'];
                                                            $Personalised = 'Unpersonalised';
                                                            if ($personailise == 1 && $personailise_image != '') {
                                                                $Personalised = 'Personalised';
                                                                $imageurl = FILE_UPLOAD_BASE_URL . 'personailise/' . $personailise_image;
                                                            }
                                                            ?>
                                                            <img src="<?= $imageurl ?>">
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart-product-desc">
                                                        <div class="cart-product-title">
                                                            <a href="<?= $BASE_URL ?>Products/view/<?= base64_encode($item['product_id']) ?>">
                                                                <span>
                                                                    <?= ($language_name == 'French') ? $item['name_french'] : $item['name'] ?>
                                                                </span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="cart-product-price">
                                                        <span><?= $item['quantity'] ?></span>X<span><?= $order_currency_currency_symbol . number_format($item['price'], 2) ?></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="email-text1">
                                                        <div class="cart-product-price">
                                                            <span><?= $order_currency_currency_symbol . number_format($item['subtotal'], 2) ?></span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <?php } ?>
                                        </tbody>
                                    </table>
                                </div>
                                <div class="email-field1">
                                    <div class="row align-items-center">
                                        <div class="col-12 col-sm-7 col-md-7">
                                            <div class="order-id">
                                                <span>
                                                    <?= ($language_name == 'French') ? 'Commandé le' : 'Ordered On' ?>
                                                    <strong><?= dateFormate($list['created']) ?></strong>
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-12 col-sm-5 col-md-5 text-right">
                                            <div class="order-id">
                                                <span>
                                                    <?= ($language_name == 'French') ? 'Sous-total' : 'Sub Total' ?>:
                                                    <strong>
                                                        <?= $order_currency_currency_symbol . number_format($list['sub_total_amount'], 2) ?>
                                                    </strong>
                                                </span>
                                            </div>
                                            <?php if (!empty($list['preffered_customer_discount']) && $list['preffered_customer_discount'] != "0.00") { ?>
                                                <div class="order-id">
                                                    <span>
                                                        <?= ($language_name == 'French') ? 'Remise client privilégiée' : 'Preffered Customer Discount' ?>:
                                                        <strong>
                                                            <?= '-' . $order_currency_currency_symbol . "" . number_format($list['preffered_customer_discount'], 2) ?>
                                                        </strong>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                            <?php if (!empty($list['coupon_discount_amount']) && $list['coupon_discount_amount'] != "0.00") { ?>
                                                <div class="order-id">
                                                    <span>
                                                        <?= ($language_name == 'French') ? 'Remise du coupon' : 'Coupon Discount' ?>:
                                                        <strong>
                                                            <?= '-' . $order_currency_currency_symbol . "" . number_format($list['coupon_discount_amount'], 2) ?>
                                                        </strong>
                                                    </span>
                                                </div>
                                            <?php } ?>
                                            <div class="order-id">
                                                <span>
                                                    <?= ($language_name == 'French') ? "Frais d'expédition" : 'Shipping Fee' ?>:
                                                    <strong>
                                                        <?= $product_price_currency_symbol . number_format($list['delivery_charge'], 2) ?>
                                                    </strong>
                                                </span>
                                            </div>
                                            <?php if (!empty($list['total_sales_tax']) && $list['total_sales_tax'] != '0.00') {
                                                $salesTaxRatesProvinces_Data = $this->Address_Model->salesTaxRatesProvincesById($list['billing_state']);
                                                ?>
                                                <div class="order-id">
                                                    <span>
                                                        Total <?= $salesTaxRatesProvinces_Data['type'] ?>
                                                        <?= number_format($salesTaxRatesProvinces_Data['total_tax_rate'], 2) ?>%:
                                                        <strong>
                                                            <?= $product_price_currency_symbol . number_format($list['total_sales_tax'], 2) ?>
                                                        </strong>
                                                    </span>
                                                </div>
                                            <?php } ?>

                                            <div class="order-id">
                                                <span><?= ($language_name == 'French') ? "Total de la commande" : 'Order Total' ?>:
                                                    <strong>
                                                        <?= $order_currency_currency_symbol . "" . number_format($list['total_amount'], 2) ?>
                                                    </strong>
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    <?php } else{ ?>
                        <div class="text-center">
                            <h2 class="lead"><?= ($language_name == 'French') ? "L'historique des commandes est vide" : 'Order History Is Empty' ?></h2>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title"><?= ($language_name == 'French') ? "Raison de l'annulation" : 'Cancellation Reason' ?></h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <form class="form-horizontal" name="commentform" method="post" action="" id="changeOrderStatusForm">

                    <input type="hidden" name="order_id" id="cl_order_id">
                    <input type="hidden" name="status" id="cl_status">

                    <div class="modal-body">
                        <div id="MsgError"></div>
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label for="InputMessage" class="col-lg-12 control-label"><?= ($language_name == 'French') ? 'Raison' : 'Reason' ?></label>
                                <div class="col-lg-12">
                                    <textarea name="mobileMsg" id="mobileMsg" class="form-control" rows="5"
                                        required></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success" id="btnSubmit"><?= ($language_name == 'French') ? 'Soumettre' : 'Submit' ?></button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>