<?php
FILE_BASE_PATH . 'dompdf-master/vendor/autoload.php';
include FILE_BASE_PATH . 'dompdf-master/vendor/autoload.php';
use Dompdf\Dompdf;
$dompdf = new Dompdf();
ob_start();
?><!DOCTYPE html>
<html>
<head>
  <title>Invoice PDF</title>
</head>
<body style="margin: 0px; padding: 0px;">
  <table style="width:100%">
    <tr>
      <td style="width: 50%;">
        <div>
          <?php $url = 'uploads/logo/' . $StoreData['pdf_template_logo'];?>
          <img src="<?=$url?>" width="200">
        </div>
      </td>
      <td style="width: 50%;">
        <div style="text-align: right;">
          <h2 style="margin: 0px; font-size: 24px; font-weight: 600; color: #000;">Invoice</h2>
          <h3 style="margin: 0px; font-size: 18px; font-weight: 600; color: #000;">Ref.: F-00<?=$orderData['id']?></h3>
          <p style="margin: 15px 0px 0px 0px; font-size: 18px; font-weight: 400; color: #000;">Ref. order:
            <?=$orderData['order_id']?> (GAL inc.) /
            <?=date('d/m/Y', strtotime($orderData['created']))?>
          </p>
        </div>
      </td>
    </tr>
  </table>
  <table style="width: 100%; margin-top: 20px;">
    <tr>
      <td style="width: 50%;">
        <div>
          <?=$StoreData['invoice_pdf_company']?>
        </div>
      </td>

      <td style="width: 50%;">
        <div>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <b><?=ucfirst($orderData['billing_name'])?></b>
          </p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <?=$orderData['billing_address']?>
          </p>
          <p style="margin: 15px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <?=$cityData['name']?>, <?=$stateData['name']?>, <?=$countryData['iso2']?>, <?=$orderData['billing_pin_code']?>
          </p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">Phone:
            <?=ucfirst($orderData['billing_mobile'])?>
          </p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">Email:
            <?=ucfirst($orderData['email'])?>
          </p>
        </div>
      </td>
    </tr>
  </table>
  <table style="width: 100%; margin-top: 20px;">
    <tr>
      <td style="width: 20%;">
        <div style="text-align: center;">
          <p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <b>Billing date</b>
          </p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <?=date('d/m/Y', strtotime($orderData['created']))?>
          </p>
        </div>
      </td>
      <td style="width: 20%;">
        <div style="text-align: center;">
          <p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <b>Ref. customer</b>
          </p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">GAL inc.</p>
        </div>
      </td>
      <td style="width: 20%;">
        <div style="text-align: center;">
          <p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>Customer code</b></p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">
            <?=(!empty($orderData['user_id'])) ? CUSTOMER_ID_PREFIX . $orderData['user_id'] : '-'?>
          </p>
        </div>
      </td>
      <td style="width: 20%;">
        <div style="text-align: center;">
          <p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>VAT number</b></p>
          <p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"></p>
        </div>
      </td>
    </tr>
  </table>
  <table style="width: 100%;border: 2px solid #ff0000; text-align: left; border-collapse: collapse; margin-top: 20px;">
    <thead>
      <tr>
        <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Designation</th>
        <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Price</th>
        <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Quantity</th>
        <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Unit</th>
        <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Total</th>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($OrderItemData as $rowid => $item) {
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
        <tr style="background-color: #fff; border-bottom: 1px dashed #ccc !important;">
          <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
            <?=ucfirst($item['name'])?><br>
            <?php if (!empty($product_width_length)) {?>
              <span><strong>Length(Inch):<?=$product_width_length['product_length']?></strong></span><br>
              <span><strong>Width(Inch):<?=$product_width_length['product_width']?></strong></span><br>
              <?php if (!empty($product_width_length['length_width_color_show'])) {?>
                <span><strong>Colors:<?=$product_width_length['length_width_color']?></strong></span><br>
              <?php }?>
              <?php if (!empty($product_width_length['product_total_page'])) {?>
                <span><strong>Quality:<?=$product_width_length['product_total_page']?></strong></span><br>
              <?php }?>
            <?php }?>
            <?php if (!empty($product_depth_length_width)) {?>
              <span><strong>Length(Inch):<?=$product_depth_length_width['product_depth_length']?></strong></span><br>
              <span><strong>Width(Inch):<?=$product_depth_length_width['product_depth_width']?></strong></span><br>
              <span><strong>Depth(Inch):<?=$product_depth_length_width['product_depth']?></strong></span><br>
              <?php if (!empty($product_depth_length_width['depth_color_show'])) {?>
                <span><strong>Colors:<?=$product_depth_length_width['depth_color']?></strong></span><br>
              <?php }?>
              <?php if (!empty($product_depth_length_width['product_depth_total_page'])) {?>
                <span><strong>Quality:<?=$product_depth_length_width['product_depth_total_page']?></strong></span><br>
              <?php }?>
            <?php }?>
            <?php if (!empty($page_product_width_length)) {?>
              <span><strong>Page Length(Inch):<?=$page_product_width_length['page_product_length']?></strong></span><br>
              <span><strong>Page Width(Inch):<?=$page_product_width_length['page_product_width']?></strong></span><br>
              <?php if (!empty($page_product_width_length['page_length_width_color_show'])) {?>
                <span><strong>Colors:<?=$page_product_width_length['page_length_width_color']?></strong></span><br>
              <?php }?>
              <?php if (!empty($page_product_width_length['page_product_total_page'])) {?>
                <span><strong>Pages:<?=$page_product_width_length['page_product_total_page']?></strong></span><br>
              <?php }?>
              <?php if (!empty($page_product_width_length['page_product_total_sheets'])) {?>
                <span><strong>Sheet Per Pad:<?=$page_product_width_length['page_product_total_sheets']?></strong></span><br>
              <?php }?>
              <?php if (!empty($page_product_width_length['page_product_total_quantity'])) {?>
                <span><strong>Quantity:<?=$page_product_width_length['page_product_total_quantity']?></strong></span><br>
              <?php }?>
            <?php }?>
            <?php if (!empty($product_size)) {
              $size_name = $product_size['product_size'];
              $label_qty = $product_size['product_quantity'];
              $attribute = isset($product_size['attribute']) ? $product_size['attribute'] : '';
              ?>
              <?php if ($label_qty) {?>
                <span><strong>Quantity:<?=$label_qty?></strong></span><br>
              <?php }?>
              <?php if ($size_name) {?>
                <span><strong>Size:<?=$size_name?></strong></span><br>
              <?php }?>
              <?php if ($attribute) {
                foreach ($attribute as $akey => $aval) {
                  $multiple_attribute_name = $aval['attributes_name'];
                  $multiple_attribute_item_name = $aval['attributes_item_name'];
                  ?>
                  <span><strong><?=$multiple_attribute_name?>:<?=$multiple_attribute_item_name?></strong></span><br>
                <?php }
              }?>
            <?php }?>

            <?php $this->view('pdf/expand_attribute_ids', ['attribute_ids' => $attribute_ids]); ?>

            <?php if ($recto_verso) {?>
              <span><strong>Recto/Verso: <?=$recto_verso?></strong></span><br>
            <?php }?>

            <?php if ($votre_text) {?>
              <span><strong>Your TEXT - Votre TEXT: <?=$votre_text?></strong></span><br>
            <?php }?>
          </td>

          <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
            <?=$order_currency_currency_symbol . number_format($item['price'], 2)?>
          </td>
          <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
            <?=$item['quantity']?>
          </td>
          <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">u.</td>
          <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
            <?php
            $subtotal = ($item['price'] * $item['quantity']);
            echo $order_currency_currency_symbol . number_format($subtotal, 2);
            ?>
          </td>
        </tr>
      <?php }?>
    </tbody>
  </table>
  <table style="width: 100%; margin-top: 20px;">
    <tr style="vertical-align: top;">
      <td style="width: 50%;"></td>
      <td style="width: 50%;">
        <table style="width: 100%; text-align: left; border-collapse: collapse;">
          <tbody>
            <tr style="background-color: #fff;">
              <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Subtotal:</td>
              <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;">
                <?=$order_currency_currency_symbol . "" . number_format($orderData['sub_total_amount'], 2)?>
              </td>
            </tr>
            <?php if (!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] != "0.00") {?>
              <tr style="background-color: #fff;">
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Preffered Customer Discount:</td>
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;">
                  <?='-' . $order_currency_currency_symbol . number_format($orderData['preffered_customer_discount'], 2)?>
                </td>
              </tr>
            <?php }?>
            <?php if (!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] != "0.00") {?>
              <tr style="background-color: #fff;">
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Coupon Discount:</td>
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;">
                  <?='-' . $order_currency_currency_symbol . number_format($orderData['coupon_discount_amount'], 2)?>
                </td>
              </tr>
            <?php }?>
            <?php if (!empty($orderData['delivery_charge']) && $orderData['delivery_charge'] != "0.00") {?>
              <tr style="background-color: #fff;">
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Shipping Fee:</td>
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;">
                  <?=$order_currency_currency_symbol . number_format($orderData['delivery_charge'], 2)?>
                </td>
              </tr>
            <?php }?>
            <?php if (!empty($orderData['total_sales_tax']) && $orderData['total_sales_tax'] != '0.00') {?>
              <tr style="background-color: #fff;">
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">
                  <?=$salesTaxRatesProvinces_Data['type']?>
                  <?=number_format($salesTaxRatesProvinces_Data['total_tax_rate'], 2)?>%:
                </td>
                <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;">
                  <?=$order_currency_currency_symbol . number_format($orderData['total_sales_tax'], 2)?>
                </td>
              </tr>
            <?php }?>
            <tr style="background-color: #fff;">
              <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 600; padding: 5px 5px !important; background: #e7e7e7;">Total:</td>
              <td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 600; padding: 5px 5px !important; background: #e7e7e7; text-align: right;">
                <?=$order_currency_currency_symbol . "" . number_format($orderData['total_amount'], 2)?>
              </td>
            </tr>
          </tbody>
        </table>
      </td>
    </tr>
    <tr>
      <td></td>
    </tr>
  </table>
</body>

</html><?php
$dompdf->loadHtml(ob_get_clean());
$dompdf->render();
//$dompdf->setPaper('A4','landscape');
$file = $orderData['order_id'] . '-invoice.pdf';
$file = strtolower($file);
//$dompdf->stream($file);
$output = $dompdf->output();
file_put_contents(FILE_BASE_PATH . 'pdf/' . $file, $output);
