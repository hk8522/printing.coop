<div class="product-title-section">
    <div class="product-title-section-img">
        <img src="<?= $BASE_URL ?>assets/images/dry-fruits.jpg">
    </div>
    <!-- <div class="product-title-section-info">
        <div class="product-title-section-info-inner">
            <div class="today-deal-title">
                <span><?= $page_title ?></span>
            </div>

        </div>
    </div> -->
</div>
<div class="product-pagination">
    <span>
        <a href="<?= $BASE_URL ?>">Home</a> >
        <a href="javascript:void(0)"><?= $page_title ?></a>
    </span>
</div>
<div class="container-fluid checkout-main-section">
    <div class="container p-0">
        <div class="checkout-section">
            <div class="row">
                <div class="col-md-12">
                    <div class="checkout-section-box">
                        <div class="text-center" style="color:red">
                            <?= $this->session->flashdata('message_error') ?>
                        </div>
                        <div class="text-center" style="color:green">
                            <?= $this->session->flashdata('message_success') ?>
                        </div>
                        <?php //pr($PostData);?>
                        <div class="shopping-product-display">
                            <table>
                                <tr>
                                    <td>Order Id</td>
                                    <td>
                                        <?= $orderData['order_id'] ?>
                                    </td>
                                </tr>
                                <!---<tr>
                                   <td>Order Amount</td>
                                   <td>
                                     <?php CURREBCY_SYMBOL . number_format($orderData['total_amount'], 2)?>
                                   </td>
                                </tr>-->
                                <tr>
                                    <td>Payment Status</td>
                                    <td>
                                        <?= $PostData['STATUS'] ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Payment Transition Id</td>
                                    <td>
                                        <?= isset($PostData['TXNID']) ? $PostData['TXNID'] : '' ?>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
setTimeout(function() {
        window.location.href = "<?= $BASE_URL ?>MyOrders";
    }, 2000);
</script>