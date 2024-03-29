<div class="top-mid-section" style="font-family: 'Raleway', sans-serif !important; width:100%; max-width:100%; height:auto; text-align:center; padding:0px 0px 0px 0px;background: #eeeeee;">
  <div>
    <div style="padding: 20px 0px 10px 0px; text-align: center;"><img src="<?= $StoreData['url'].'/uploads/logo/'. $StoreData['email_template_logo'] ?>" width="300px"></div>
    <div class="tem-mid-section" style="text-align: center;">
      <div class="tem-visibility" style="z-index: 99; padding: 20px;">
        <div class="top-title" style="font-size: 20px; text-align: center;">
          <span><strong><?= $heding ?></strong></span>
        </div>
        <?= $body ?>
        <div style="text-align: center;background: #7aa93c;padding: 10px 0px;margin: 0px 0px;">
          <span style="color:#fff; font-size: 15px;font-weight: 600;">Articles dans cet ordre</span>
        </div>
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
          $imageurl = getProductImage($item['product_image']);
        ?>
          <div style="width: 100%;display: flex;align-items: center;border-bottom: 1px solid #ccc;padding: 20px 0px; flex-wrap: wrap;">
            <div style="width: 100%; margin-bottom: 10px;">
              <div style="text-align: left;">
                <div style="width: 100px; float: left; position: relative">
                  <img style="margin-bottom: 10px;" src="<?= $imageurl ?>" width="100%">
                  <span style="font-size: 14px; color: #000;">Combien d'ensembles: <span style="display: inline-block; height: 20px; width: 20px; text-align: center; line-height: 20px; color: #fff; font-weight: 600; font-size: 12px; background: #7aa93c; border-radius: 50%;"><?= $item['quantity'] ?></span></span>
                </div>
                <div style="padding-left: 130px;">
                  <span style="font-size: 14px;color: #000; font-weight: 600"><?= ucfirst($item['name_french']) ?></span>

                  <div style="margin: 10px 0px 0px 0px">
                    <?php if (!empty($product_width_length)) { ?>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Longueur (pouces):</font> <?= $product_width_length['product_length'] ?></div>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Largeur (pouces):</font> <?= $product_width_length['product_width'] ?></div>

                      <?php if (!empty($product_width_length['length_width_color_show'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Couleurs:</font> <?= $product_width_length['length_width_color_french'] ?></div>
                      <?php } ?>

                      <?php if (!empty($product_width_length['product_total_page'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantité:</font> <?= $product_width_length['product_total_page'] ?></div>
                      <?php } ?>
                    <?php } ?>
                    <?php if (!empty($product_depth_length_width)) { ?>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Longueur (pouces):</font> <?= $product_depth_length_width['product_depth_length'] ?></div>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Largeur (pouces):</font> <?= $product_depth_length_width['product_depth_width'] ?></div>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Profondeur (pouces):</font> <?= $product_depth_length_width['product_depth'] ?></div>

                      <?php if (!empty($product_depth_length_width['depth_color_show'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Couleurs:</font> <?= $product_depth_length_width['depth_color_french'] ?></div>
                      <?php } ?>

                      <?php if (!empty($product_depth_length_width['product_depth_total_page'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantité:</font> <?= $product_depth_length_width['product_depth_total_page'] ?></div>
                      <?php } ?>
                    <?php } ?>

                    <?php if (!empty($page_product_width_length)) { ?>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Longueur de page (pouces):</font> <?= $page_product_width_length['page_product_length'] ?></div>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Largeur de page (pouces):</font> <?= $page_product_width_length['page_product_width'] ?></div>

                      <?php if (!empty($page_product_width_length['page_length_width_color_show'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Couleurs:</font> <?= $page_product_width_length['page_length_width_color_french'] ?></div>
                      <?php } ?>

                      <?php if (!empty($page_product_width_length['page_product_total_page'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Des pages:</font> <?= $page_product_width_length['page_product_total_page_french'] ?></div>
                      <?php } ?>

                      <?php if (!empty($page_product_width_length['page_product_total_sheets_french'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Feuille par bloc:</font> <?= $page_product_width_length['page_product_total_sheets_french'] ?></div>
                      <?php } ?>

                      <?php if (!empty($page_product_width_length['page_product_total_quantity'])) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantité:</font> <?= $page_product_width_length['page_product_total_quantity'] ?></div>
                      <?php } ?>
                    <?php } ?>

                    <?php if (!empty($product_size)) {
                      $size_name = $product_size['product_size_french'] ?? $product_size['product_size'];
                      $label_qty = $product_size['product_quantity_french'] ?? $product_size['product_quantity'];
                      $attribute = $product_size['attribute'] ?? '';
                      ?>
                      <?php if ($label_qty) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Quantité:</font> <?= $label_qty ?></div>
                      <?php } ?>

                      <?php if ($size_name) { ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Taille:</font> <?= $size_name ?></div>
                      <?php } ?>

                      <?php if ($attribute) {
                        foreach ($attribute as $akey => $aval) {
                          $multiple_attribute_name = $aval['attributes_name_french'];
                          $multiple_attribute_item_name = $aval['attributes_item_name_french'];
                        ?>
                          <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222"><?= $multiple_attribute_name ?>:</font> <?= $multiple_attribute_item_name ?></div>
                        <?php }
                      } ?>
                    <?php } ?>

                    <?php $this->view('Emails/expand_attribute_ids', ['attribute_ids' => $attribute_ids, 'language_name' => 'French']); ?>

                    <?php if (!empty($recto_verso)) { ?>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Recto verso:</font> <?= $recto_verso ?></div>
                    <?php } ?>

                    <?php if (!empty($votre_text)) { ?>
                      <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Votre TEXTE - Votre TEXTE:</font> <?= $votre_text ?></div>
                    <?php } ?>

                    <br>
                    <?php if (!empty($cart_images)) {
                      foreach ($cart_images as $key => $return_arr) {
                      ?>
                        <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;">
                          <a href="<?= $return_arr['file_base_url'] ?>"><img src="<?= $return_arr['src'] ?>" width="150"></a>
                        </div>

                        <?php $link = $BASE_URL."admin/Orders/download/".urlencode($return_arr['location'])."/".urlencode($return_arr['name']); ?>

                        <?php if (!empty($return_arr['cumment'])) { ?>
                          <br>
                          <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;"><font style="color: #222">Commentaire:</font> <?= $return_arr['cumment'] ?></div>
                        <?php } ?>
                      <?php }
                    } ?>
                  </div>
                </div>
              </div>
            </div>
            <div style="width: 50%; text-align: left;">
              <div style="font-size: 14px;color: #303030;"><font style="color: #000; font-weight: 600;">Prix :</font> <?= $order_currency_currency_symbol.number_format($item['price'],2) ?></div>
            </div>
            <div style="width: 50%; text-align: right">
              <div style="font-size: 14px;color: #303030;"><font style="color: #000; font-weight: 600;">Total :</font>
                <?php
                  $subtotal = ($item['price'] * $item['quantity']);
                  echo $order_currency_currency_symbol.number_format($subtotal,2);
                ?>
              </div>
            </div>
          </div>
        <?php } ?>

        <div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
          <div style="width: 100%;display: flex;">
            <div style="width: 70%; text-align: right;">
              <span style="font-size: 14px;color: #303030;font-weight: 500;">Total:</span>
            </div>
            <div style="width: 30%; text-align: right;">
              <span style="font-size: 14px;color: #303030;"><?= $order_currency_currency_symbol."".number_format($orderData['sub_total_amount'],2) ?></span>
            </div>
          </div>
        </div>

        <?php if (!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] !="0.00") { ?>
          <div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
            <div style="width: 100%;display: flex;">
              <div style="width: 70%; text-align: right;">
                <span style="font-size: 14px;color: #303030;font-weight: 500;">Remise client privilégiée:</span>
              </div>
              <div style="width: 30%; text-align: right;">
                <span style="font-size: 14px;color: #303030;"><?= "-".$order_currency_currency_symbol."".number_format($orderData['preffered_customer_discount'],2) ?></span>
              </div>
            </div>
          </div>
        <?php } ?>

        <?php if (!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] !="0.00") { ?>
          <div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
            <div style="width: 100%;display: flex;">
              <div style="width: 70%; text-align: right;">
                <span style="font-size: 14px;color: #303030;font-weight: 500;">Remise de coupon:</span>
              </div>
              <div style="width: 30%; text-align: right;">
                <span style="font-size: 14px;color: #303030;"><?= "-".$order_currency_currency_symbol."".number_format($orderData['coupon_discount_amount'],2) ?></span>
              </div>
            </div>
          </div>
        <?php } ?>

        <div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
          <div style="width: 100%;display: flex;">
            <div style="width: 70%; text-align: right;">
              <span style="font-size: 14px;color: #303030;font-weight: 500;">Frais d'expédition:</span>
            </div>
            <div style="width: 30%; text-align: right;">
              <span style="font-size: 14px;color: #303030;"><?= $order_currency_currency_symbol.number_format($orderData['delivery_charge'],2) ?></span>
            </div>
          </div>
        </div>

        <?php if (!empty($orderData['total_sales_tax']) &&  $orderData['total_sales_tax'] !='0.00') { ?>
          <div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
            <div style="width: 100%;display: flex;">
              <div style="width: 70%; text-align: right;">
                <span style="font-size: 14px;color: #303030;font-weight: 500;">Total <?= $salesTaxRatesProvinces_Data['type']?> <?= number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2) ?>%:</span>
              </div>
              <div style="width: 30%; text-align: right;">
                <span style="font-size: 16px;color: #7aa93c;font-weight: 600;"><?php
              echo $order_currency_currency_symbol.number_format($orderData['total_sales_tax'],2);?></span>
              </div>
            </div>
          </div>
        <?php } ?>

        <div style="width: 100%;display: flex;align-items: center;padding: 10px 0px 0px 0px;">
          <div style="width: 100%;display: flex;">
            <div style="width: 70%; text-align: right;">
              <span style="font-size: 14px;color: #303030;font-weight: 500;">Total:</span>
            </div>
            <div style="width: 30%; text-align: right;">
              <span style="font-size: 16px;color: #7aa93c;font-weight: 600;">
                <?= $order_currency_currency_symbol."".number_format($orderData['total_amount'],2) ?>
              </span>
            </div>
          </div>
        </div>

        <div style="margin: 20px 0px;">
          <div style="padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin-bottom: 10px;">
            <div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Informations sur la commande</div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Numéro de commande</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= $orderData['order_id'] ?></strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Code client:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;">
                  <?= (!empty($orderData['user_id'])) ? CUSTOMER_ID_PREFIX.$orderData['user_id'] : '-' ?>
                </strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Nom du client:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= ucfirst($orderData['name']) ?></strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Client mobile:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= ucfirst($orderData['mobile']) ?></strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Client de messagerie:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= ucfirst($orderData['email']) ?></strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Montant de la commande:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= $order_currency_currency_symbol.number_format($orderData['total_amount'],2) ?></strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Statut de la commande:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= getOrderSatusFrench($orderData['status']) ?></strong>
              </div>
            </div>
            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Date de commande:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= dateFormate($orderData['created']) ?></strong>
              </div>
            </div>

            <div style="display: flex;">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Mode de livraison:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;">
                  <?php
                    if (!empty(getShipingName($orderData))) {
                      echo getShipingName($orderData);
                    } else {
                      if ($orderData['shipping_method_formate']) {
                        $shipping_method_formate = explode('-', $orderData['shipping_method_formate']);

                        if ($shipping_method_formate[0] == "pickupinstore") {
                          $pickupStore = $this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
                          echo 'Pickup In Store<br>'.$pickupStore['name']."<br>".$pickupStore['address']."<br>".$pickupStore['phone'];
                        }
                      }
                    }
                  ?>
                </strong>
              </div>
            </div>
          </div>

          <div style="padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin-bottom: 10px;">
            <div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Informations de paiement</div>

            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Mode de paiement:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= ucfirst($orderData['payment_type']) ?></strong>
              </div>
            </div>

            <div style="display: flex;margin-bottom: 5px;padding-bottom: 5px;border-bottom: 1px solid rgba(0,0,0,0.1);">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">Statut de paiement:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= getOrderPaymentStatusFrench($orderData['payment_status']) ?></strong>
              </div>
            </div>
            <div style="display: flex;">
              <div style="width: 50%; margin-right: 5px; text-align: left">
                <span style="color: #666; font-weight: 400; font-size: 14px;">ID de transition de paiement:</span>
              </div>
              <div style="width: 50%; margin-left: 5px; text-align: right">
                <strong style="color: #000; font-weight: 400; font-size: 14px;"><?= $orderData['transition_id'] ?></strong>
              </div>
            </div>
          </div>
          <div style="display:flex">
            <div style="width: 50%;padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin: 0px 5px 10px 0px;">
              <div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">détails de facturation</div>
              <div style="text-align: left;">
                <strong style="color: #000; font-weight: 400; font-size: 14px;">
                  <?= ucfirst($orderData['billing_name']) ?>
                  <br>
                  Mobile: <?= ucfirst($orderData['billing_mobile']) ?><?= !empty($orderData['billing_alternate_phone']) ? ','.$orderData['billing_alternate_phone'] : '' ?>
                  <br>
                  <?php if (!empty($orderData['billing_company'])) { ?>
                    Company: <?= $orderData['billing_company'] ?>
                    <br>
                  <?php } ?>

                  <?= $orderData['billing_address'] ?>
                  <br>
                  <?= $cityData['name'] ?>, <?= $stateData['name'] ?>, <?= $countryData['iso2'] ?>, <?= $orderData['billing_pin_code']  ?>
                </strong>
              </div>
            </div>
            <div style="width: 50%;padding: 10px;background-color: #f2f2f2; border: 1px solid#ccc; margin: 0px 0px 10px 5px;">
              <div style="text-align: left;font-size: 18px;font-weight: 600;margin-bottom: 10px;border-bottom: 2px dashed rgba(0,0,0,0.1);padding-bottom: 10px;">Informations sur la livraison</div>
              <div style="text-align: left;">
                <strong style="color: #000; font-weight: 400; font-size: 14px;">
                  <?= ucfirst($orderData['shipping_name']) ?>
                  <br>
                  Mobile: <?= ucfirst($orderData['shipping_mobile']) ?><?= !empty($orderData['shipping_alternate_phone']) ? ','.$orderData['shipping_alternate_phone'] : '' ?>
                  <?php if (!empty($orderData['shipping_company'])) { ?>
                    <br>
                    Company: <?= $orderData['shipping_company'] ?>
                  <?php } ?>
                  <br>
                  <?= $orderData['shipping_address'] ?>
                  <br>
                  <?= $cityData['name'] ?>, <?= $stateData['name'] ?>, <?= $cityData['name'] ?> <?= $countryData['iso2'] ?>, <?= $orderData['shipping_pin_code'] ?>
                </strong>
              </div>
            </div>
          </div>
        </div>

        <div style="background-color: #000 ;margin-top: 20px;">
          <div style="padding: 10px 10px 15px 10px;">
            <span style="color: #fff;line-height: 25px;"><?= $StoreData['email_footer_line'] ?></span>
          </div>
        </div>
      </div>
    </div>
    <div class="tem-bottom" style="font-size: 18px; letter-spacing: 0.5px; line-height: 30px; background: #e06b14;; color: #fff; padding: 3px 0px; text-align: center;"></div>
  </div>
</div>
