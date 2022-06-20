<?php
$currency_id=$orderData['currency_id'];
if(empty($currency_id)){
    $currency_id=1;
}
$OrderCurrencyData=$CurrencyList[$currency_id];
$order_currency_currency_symbol=$OrderCurrencyData['symbols'];

?>
<div class="my-account-main-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="my-account-section">
            <?php $this->load->view('elements/my-account-menu') ?>
                <div class="account-area">
                    <div class="universal-dark-title">
                        <span><?php echo $page_title;?></span>
                        <!--<button type="button" onclick="window.print();">Print Order</button>-->
                    </div>
                    <div class="text-center" style="color:red">
                      <?php echo $this->session->flashdata('message_error');?>
                    </div>
                    <div class="text-center" style="color:green">
                    <?php echo $this->session->flashdata('message_success');?>
                    </div><br>

                    <div class="account-area-inner-boxes">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="account-area-inner-box-single">
                                    <div class="universal-small-dark-title">
                                        <span>
                                        <?php
                                        if($language_name=='French'){ ?>
                                          Informations sur la commande
                                        <?php }else{ ?>
                                          Order Information
                                        <?php
                                        }?></span>
                                    </div>
                                    <div class="quote-bottom-row summary-deatil">
                                        <div class="summary-deatil-inner">
                                            <ul>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span>
                                                            <?php
                                                            if($language_name=='French'){ ?>
                                                              Numéro de commande
                                                            <?php }else{ ?>
                                                             Order Id
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php
                                        //echo $language_name =='French' ? ORDER_ID_PREFIX_FRENCH.$orderData['id']:$orderData['order_id'];
                                        echo $orderData['order_id'];
                                        ?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                                    <div class="row">
                                                                        <div class="col-md-6">
                                                                            <span>
                                                                            <?php
                                                                            if($language_name=='French'){ ?>
                                                                              Code client
                                                                            <?php }else{ ?>
                                                                              Customer Code
                                                                            <?php
                                                                            }?>Customer Code:</span>
                                                                        </div>
                                                                        <div class="col-md-6">
                                                                            <strong><?php if(!empty($orderData['user_id'])){
                                                                                    echo CUSTOMER_ID_PREFIX.$orderData['user_id'];
                                                                            }else{
                                                                                echo "-";
                                                                            }
    ?>																		</strong>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span>
                                                            <?php
                                                            if($language_name=='French'){ ?>
                                                              Nom du client
                                                            <?php }else{ ?>
                                                              Customer Name
                                                            <?php
                                                            }?>:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo ucfirst($orderData['name']);?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Mobile client
                                                            <?php }else{ ?>
                                                              Customer Mobile
                                                            <?php
                                                            }?>:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo ucfirst($orderData['mobile']);?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Email client:
                                                            <?php }else{ ?>
                                                              Customer Email:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo ucfirst($orderData['email']);?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Remise client privilégiée:
                                                            <?php }else{ ?>
                                                              Preffered Customer Discount:
                                                            <?php
                                                            }?>Order Amount:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo $order_currency_currency_symbol.number_format($orderData['total_amount'],2);?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Statut de la commande:
                                                            <?php }else{ ?>
                                                              Order Status:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php
                                        echo $language_name =='French' ? getOrderSatusClassFrench($orderData['status']):getOrderSatusClass($orderData['status']);
                                        ;?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Date de commande
                                                            <?php }else{ ?>
                                                              Order Date
                                                            <?php
                                                            }?>:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo dateFormate($orderData['created']);?></strong>
                                                        </div>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Mode de livraison
                                                            <?php }else{ ?>
                                                              Shipping Method
                                                            <?php
                                                            }?>:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>
                                                        <?php

                                                        $Method = getShipingName($orderData);

                                                        if(!empty($Method)){
                                                            echo $Method;
                                                        }else{
            $shipping_method_formate=explode('-',$orderData['shipping_method_formate']);
                            if($shipping_method_formate[0]=="pickupinstore"){
                                                                $pickupStore=$this->Store_Model->getPickupStoreDataById($shipping_method_formate[2]);
                                                                echo 'Pickup In Store<br>'.$pickupStore['name']."<br>".$pickupStore['address']."<br>".$pickupStore['phone'];
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
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                            Commentaire de commande

                                                            <?php }else{ ?>
                                                           Order Comment
                                                            <?php
                                                            }?>:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo $orderData['order_comment'];?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                                <div class="account-area-inner-box-single">
                                    <div class="universal-small-dark-title">
                                        <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Informations de paiement
                                                            <?php }else{ ?>
                                                              Payment Information
                                                            <?php
                                                            }?></span>
                                    </div>
                                    <div class="quote-bottom-row summary-deatil">
                                        <div class="summary-deatil-inner">
                                            <ul>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Remise client privilégiée:
                                                            <?php }else{ ?>
                                                              Preffered Customer Discount:
                                                            <?php
                                                            }?>Payment Type:</span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo ucfirst($orderData['payment_type']);?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Mode de paiement:
                                                            <?php }else{ ?>
                                                              Payment Method:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo ucfirst($orderData['payment_type']);?></strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Statut de paiement:
                                                            <?php }else{ ?>
                                                              Payment Status:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>
                                                            <?php echo $language_name=='French' ? getOrderPaymentStatusFrench($orderData['payment_status']):getOrderPaymentStatus($orderData['payment_status']);
                                                            ?>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              ID de transition de paiement:
                                                            <?php }else{ ?>
                                                              Payment Transition Id:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong><?php echo $orderData['transition_id'];?></strong>
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
                                        <span><?php
                                                            if($language_name=='French'){ ?>
                                                              détails de facturation
                                                            <?php }else{ ?>
                                                              Billing Information
                                                            <?php
                                                            }?></span>
                                    </div>
                                    <div class="quote-bottom-row summary-deatil">
                                        <div class="summary-deatil-inner">
                                            <ul>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Adresse de facturation:
                                                            <?php }else{ ?>
                                                              Billing Address:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>
                                                                <?php echo ucfirst($orderData['billing_name']);?>
                                                                                <br>
                                                                                Mobile: <?php echo ucfirst($orderData['billing_mobile']);?><?php echo !empty($orderData['billing_alternate_phone']) ? ','.$orderData['billing_alternate_phone']:'';?>

                                                                                <br>	<?php if(!empty($orderData['billing_company'])){?>

    Company:<?php echo $orderData['billing_company'];?>
    <br>
                                                                                <?php }?>

                                                                                <?php echo $orderData['billing_address'];?>

                                            <br>
          <?php echo $cityData['name'];?>,<?php echo $stateData['name'];?>,<?php echo $countryData['iso2'];?>,<?php echo $orderData['billing_pin_code'];?>
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
                                        <span><?php
                                                            if($language_name=='French'){ ?>
                                                             Informations sur la livraison
                                                            <?php }else{ ?>
                                                              Shipping Information
                                                            <?php
                                                            }?></span>
                                    </div>
                                    <div class="quote-bottom-row summary-deatil">
                                        <div class="summary-deatil-inner">
                                            <ul>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Adresse de livraison:
                                                            <?php }else{ ?>
                                                              Shipping Address:
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>
                                                                <?php echo ucfirst($orderData['shipping_name']);?>
                                                                                <br>
                                                                                Mobile: <?php echo ucfirst($orderData['shipping_mobile']);?><?php echo !empty($orderData['shipping_alternate_phone']) ? ','.$orderData['shipping_alternate_phone']:'';?>

    <?php if(!empty($orderData['shipping_company'])){?>
    <br>
    Company:<?php echo $orderData['shipping_company'];?>

                                                                                <?php }?>
                                                                                <br>
                                      <?php echo $orderData['shipping_address'];?>

                                                                                <br>
      <?php echo $cityData['name'];?>,<?php echo $stateData['name'];?> ,<?php echo $cityData['name'];?> <?php echo $countryData['iso2'];?>,<?php echo $orderData['shipping_pin_code'];?>
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
                                        <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Facture PDF
                                                            <?php }else{ ?>
                                                              Invoice PDF
                                                            <?php
                                                            }?></span>
                                    </div>
                                    <div class="quote-bottom-row summary-deatil">
                                        <div class="summary-deatil-inner">
                                            <ul>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Facture PDF
                                                            <?php }else{ ?>
                                                              Invoice PDF
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>
                                                             <?php
        if($language_name=='French'){
           $file_name=$orderData['order_id']."-fr-invoice.pdf";
           $file_name=strtolower($file_name);
           $location=FILE_BASE_PATH.'pdf/'.$file_name;
           $linkInvoice=$BASE_URL."MyOrders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
        }else{
           $file_name=$orderData['order_id']."-invoice.pdf";
           $file_name=strtolower($file_name);
           $location=FILE_BASE_PATH.'pdf/'.$file_name;
           $linkInvoice=$BASE_URL."MyOrders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
        }
         $linkInvoice=$BASE_URL."MyOrders/downloadOrderPdf/".$orderData['id'].'/invoice';
        ?>
                                                                <a href="<?php echo $linkInvoice?>">
                                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-file-download"></i> <?php
                                                            if($language_name=='French'){ ?>
                                                             Télécharger
                                                            <?php }else{ ?>
                                                              Download
                                                            <?php
                                                            }?></button>
                                                                </a>
                                                            </strong>
                                                        </div>
                                                    </div>
                                                </li>
                                                <li>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Commander le PDF
                                                            <?php }else{ ?>
                                                              Order PDF
                                                            <?php
                                                            }?></span>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <strong>
                                                                <?php
        if($language_name=='French'){
           $file_name=$orderData['order_id']."-fr-order.pdf";
           $file_name=strtolower($file_name);
           $location=FILE_BASE_PATH.'pdf/'.$file_name;
           $linkOrder=$BASE_URL."MyOrders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
        }else{
           $file_name=$orderData['order_id']."-order.pdf";
           $file_name=strtolower($file_name);
           $location=FILE_BASE_PATH.'pdf/'.$file_name;
           $linkOrder=$BASE_URL."MyOrders/downloadOrderPdf/".urlencode($location)."/".urlencode($file_name).'/'.urlencode($orderData['id']);
        }

        $linkOrder=$BASE_URL."MyOrders/downloadOrderPdf/".$orderData['id'].'/order';
        ?>
                                                                <a href="<?php echo $linkOrder?>">
                                                                    <button type="button" class="btn btn-sm btn-danger"><i class="fas fa-file-download"></i> <?php
                                                            if($language_name=='French'){ ?>
                                                              Télécharger
                                                            <?php }else{ ?>
                                                              Download
                                                            <?php
                                                            }?></button>
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
                                            <th><?php
                                                            if($language_name=='French'){ ?>
                                                             Détails des articles
                                                            <?php }else{ ?>
                                                              Items Details
                                                            <?php
                                                            }?></th>
                                            <th><?php
                                                            if($language_name=='French'){ ?>
                                                              Prix
                                                            <?php }else{ ?>
                                                              Price
                                                            <?php
                                                            }?></th>
                                            <th><?php
                                                            if($language_name=='French'){ ?>
                                                              Quantité
                                                            <?php }else{ ?>
                                                              Quantity
                                                            <?php
                                                            }?></th>
                                            <th><?php
                                                            if($language_name=='French'){ ?>
                                                              Total
                                                            <?php }else{ ?>
                                                             Subtotal
                                                            <?php
                                                            }?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        #pr($OrderItemData);
                                        foreach ($OrderItemData as $rowid=>$items){
                                          $cart_images=json_decode($items['cart_images'],true);
                                          $attribute_ids=json_decode($items['attribute_ids'],true);

                                          $product_size=json_decode($items['product_size'],true);
                                          //pr($product_size);

                                          $product_width_length=json_decode($items['product_width_length'],true);

                                          $page_product_width_length=json_decode($items['page_product_width_length'],true);
                                          $product_depth_length_width=json_decode($items['product_depth_length_width'],true);

                                        $votre_text=$items['votre_text'];

                                        $recto_verso=$items['recto_verso'];

                                        $product_id=$items['product_id'];
                                       //$AttributesData=$this->Product_Model->getProductAttributesByItemIdFrontEnd($product_id);
                                       ?>
                                        <tr>
                                            <td class="product-thumbnail">
                                                <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>">
                                                    <?php $imageurl=getProductImage($items['product_image']);
                                                     $personailise=$items['personailise'];
                                                     $personailise_image=$items['personailise_image'];
                                                     $Personalised='Unpersonalised';
                                                     if($personailise==1 && $personailise_image !=''){
                                                         $Personalised='Personalised';
                                                         $imageurl=FILE_UPLOAD_BASE_URL.'personailise/'.$personailise_image;
                                                     }?>
                                                    <img src="<?php echo $imageurl?>">
                                                </a>
                                            </td>
                                            <td class="product-name">
                                                <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['id']);?>"><?php
                                                if($language_name=='French'){
                                                echo ucfirst($items['name_french']);
                                                }else{
                                                    echo ucfirst($items['name']);
                                                }?>
                                                </a>

                                                <div class="product-name-detail">
                                <div class="row">
    <?php if(!empty($product_width_length)){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){ ?>
                                                  Longueur(pouces)
                                                <?php }else{ ?>
                                                  Length(Inch)
                                                <?php
                                                }?>: <?php echo $product_width_length['product_length'];?></strong> </span>
                                    </div>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php
                                                if($language_name=='French'){ ?>
                                                  Largeur (pouces)
                                                <?php }else{ ?>
                                                  Width(Inch)
                                                <?php
                                                }?>: <?php echo $product_width_length['product_width'];?></strong> </span>
                                    </div>
                            <?php if(!empty($product_width_length['length_width_color_show'])){?>
                                    <div class="col-md-6">
                                            <span><strong> <?php
                                       if($language_name=='French'){
                                                  echo 'Couleursv:'.$product_width_length['length_width_color_french'];
                                        }else{
                                            echo 'Colors:'.$product_width_length['length_width_color'];
                                        }?>
                                        </strong> </span>
                                    </div>
                            <?php
                            }?>
                            <?php if(!empty($product_width_length['product_total_page'])){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php
                                                if($language_name=='French'){ ?>
                                                  Quantité
                                                <?php }else{ ?>
                                                  Quantity
                                                <?php
                                                }?>: <?php echo $product_width_length['product_total_page'];?></strong> </span>
                                    </div>
                            <?php
                            }?>
                                <?php
                                }?>

                                <?php if(!empty($product_depth_length_width)){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){ ?>
                                                  Longueur (pouces)
                                                <?php }else{ ?>
                                                  Length(Inch)
                                                <?php
                                                }?>: <?php echo $product_depth_length_width['product_depth_length'];?></strong> </span>
                                    </div>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php
                                                if($language_name=='French'){ ?>
                                                 Largeur (pouces)
                                                <?php }else{ ?>
                                                  Width(Inch)
                                                <?php
                                                }?>: <?php echo $product_depth_length_width['product_depth_width'];?></strong> </span>
                                    </div>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php
                                                if($language_name=='French'){ ?>
                                                  Profondeur (pouces)
                                                <?php }else{ ?>
                                                  Depth(Inch)
                                                <?php
                                                }?>: <?php echo $product_depth_length_width['product_depth'];?></strong> </span>
                                    </div>
                            <?php if(!empty($product_depth_length_width['depth_color_show'])){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php
                                                 if($language_name=='French'){
                                                  echo 'Couleursv:'.$product_depth_length_width['depth_color_french'];
                                        }else{
                                            echo 'Colors:'.$product_depth_length_width['depth_color'];
                                        }?></strong> </span>
                                    </div>
                            <?php
                            }?>
                            <?php if(!empty($product_depth_length_width['product_depth_total_page'])){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php
                                                if($language_name=='French'){ ?>
                                                  Quantité
                                                <?php }else{ ?>
                                                  Quantity
                                                <?php
                                                }?>: <?php echo $product_depth_length_width['product_depth_total_page'];?></strong> </span>
                                    </div>
                            <?php
                            }?>
                       <?php
                        }?>
                                <?php if(!empty($page_product_width_length)){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){ ?>
                                                  Longueur (pouces)
                                                <?php }else{ ?>
                                                  Length(Inch)
                                                <?php
                                                }?>: <?php echo $page_product_width_length['page_product_length'];?></strong> </span>
                                    </div>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){ ?>
                                                  Largeur(pouces)
                                                <?php }else{ ?>
                                                  Width(Inch)
                                                <?php
                                                }?>: <?php echo $page_product_width_length['page_product_width'];?></strong> </span>
                                    </div>

                                <?php if(!empty($page_product_width_length['page_length_width_color_show'])){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong> <?php

                                        if($language_name=='French'){
                                                  echo 'Couleursv:'.$page_product_width_length['page_length_width_color_french'];
                                        }else{
                                            echo 'Colors:'.$page_product_width_length['page_length_width_color'];
                                        }

                                                ?></strong> </span>
                                    </div>
                            <?php
                            }?>
                                <?php if(!empty($page_product_width_length['page_product_total_page'])){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){
                                                  echo 'Des pages:'.$page_product_width_length['page_product_total_page_french'];
                                                }else{
                                       echo 'Pages:'.$page_product_width_length['page_product_total_page'];
                                                }
                                                ?></strong> </span>
                                    </div>
                                <?php
                                }?>
                                <?php if(!empty($page_product_width_length['page_product_total_sheets'])){?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){
                                                  echo ' Feuille par bloc:'.$page_product_width_length['page_product_total_sheets_french'];
                                                }else{
                                       echo 'Sheet Per Pad:'.$page_product_width_length['page_product_total_sheets'];
                                                }
                                                ?></strong> </span>
                                    </div>
                                <?php
                                }?>
                                <?php
                                if(!empty($page_product_width_length['page_product_total_quantity'])){ ?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){
                                                  echo 'Quantité:'.$page_product_width_length['page_product_total_quantity'];
                                                }else{
                                       echo 'Quantity:'.$page_product_width_length['page_product_total_quantity'];
                                                }
                                                ?></strong> </span>
                                    </div>
                                <?php
                                }?>
                            <?php
                            }?>
                            <?php
                            if(!empty($product_size)){
                                if($language_name=='French'){
                                    $size_name= $product_size['product_size_french'];
                                    $label_qty=$product_size['product_quantity_french'];
                                }else{
                                    $size_name = $product_size['product_size'];
                                    $label_qty=$product_size['product_quantity'];
                                }

                                $attribute=isset($product_size['attribute']) ? $product_size['attribute']:'';

                                ?>
                                <?php
                                if($label_qty){ ?>
                                   <div class="col-md-12 col-lg-6 col-xl-6">
                                            <span><strong><?php
                                                if($language_name=='French'){ ?>
                                                  Quantité
                                                <?php }else{ ?>
                                                  Quantity
                                                <?php
                                                }?> : <?php echo $label_qty;?></strong> </span>
                                    </div>
                                <?php
                                }?>

                                <?php
                                if($size_name){ ?>
                                    <div class="col-md-12 col-lg-6 col-xl-6">
                                        <span><strong><?php
                                            if($language_name=='French'){ ?>
                                              Taille
                                            <?php }else{ ?>
                                              Size
                                            <?php
                                            }?>: <?php echo $size_name;?></strong> </span>
                                    </div>
                                <?php
                                }?>

                                <?php
                                if($attribute){
                                    foreach($attribute as $akey=>$aval){
                                        $multiple_attribute_name=$aval['attributes_name'];
                                        $multiple_attribute_item_name=$aval['attributes_item_name'];

                                        if($language_name=='French'){
                                            $multiple_attribute_name=$aval['attributes_name_french'];
                                            $multiple_attribute_item_name=$aval['attributes_item_name_french'];
                                        }
                                ?>

                                        <div class="col-md-12 col-lg-6 col-xl-6">
                                            <span>
                                            <strong>
                                               <?php
                                                echo $multiple_attribute_name
                                                 .':'. $multiple_attribute_item_name;
                                                ?>
                                                 </strong>
                                            </span>
                                        </div>
                                        <?php
                                    }
                                }?>

                            <?php
                            }
                            ?>

                            <?php
                            #pr($attribute_ids);
                            foreach($attribute_ids as $key=>$val){
                                if($language_name=='French'){
                                    $attribute_name=$val['attribute_name_french'];
                                    $item_name=$val['item_name_french'];
                                }else{
                                    $attribute_name=$val['attribute_name'];
                                    $item_name=$val['item_name'];
                                }
                                ?>
                                <div class="col-md-12 col-lg-6 col-xl-6">
                                <span><strong><?php echo $attribute_name;?>: <?php echo $item_name;?></strong> </span>
                                </div>

                                <?php
                            }?>

                                 <?php if(!empty($recto_verso)){ ?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong>
                                                <?php
                        if($language_name=='French'){
                        echo 'Recto verso:'.$recto_verso_french;
                                                }else{
                        echo 'Recto/Verso:'.$recto_verso;
                                                }?></strong> </span>
                                    </div>

                                <?php
                                }?>

                                <?php if(!empty($votre_text)){?>
                                   <div class="col-md-12 col-lg-12 col-xl-6">
                                            <span><strong>
                                                <?php
                                                if($language_name=='French'){ ?>
                                                  Votre TEXTE - Votre TEXTE
                                                <?php }else{ ?>
                                                  Your TEXT - Votre TEXT
                                                <?php
                                                }?>: <?php echo $votre_text?></strong> </span>
                                    </div>

                                <?php
                                }?>
                                </div>
                            </div>

                                                <div class="uploaded-file-detail" id="upload-file-data">
                                                    <?php if(!empty($cart_images)){
                                                               foreach($cart_images as $key=>$return_arr){
                                                                    #pr($return_arr);

                                                     ?>

                                                       <div class="uploaded-file-single" id="teb-<?php echo $return_arr['skey']?>">
                                                            <div class="uploaded-file-single-inner">
                                                                <div class="uploaded-file-img" style="background-image: url(<?php echo $return_arr['src']?>)"></div>
                                                                <div class="uploaded-file-info">
                                                                              <div class="uploaded-file-name">
                                                                                  <span><?php echo $return_arr['name']?></span>
                                                                              </div>
                                                                              <div class="upload-field">
                                                                                  <?php
                                                                $link=$BASE_URL."MyOrders/download/".urlencode($return_arr['location'])."/".urlencode($return_arr['name']);
                                                                ?><br>

                <div class="uploaded-file-info">
     <a href="<?php echo $link?>">
                                                                        <i class="fas fa-file-download"></i> <?php
                                                            if($language_name=='French'){ ?>
                                                              Télécharger
                                                            <?php }else{ ?>
                                                              Download
                                                            <?php
                                                            }?>

    </a>

                                               <?php
                                                                    if(!empty($return_arr['cumment'])){?>
                                                                        <div class="upload-field">
                                                                            <?php
                                                            if($language_name=='French'){ ?>
                                                              Commentaire
                                                            <?php }else{ ?>
                                                              Comment
                                                            <?php
                                                            }?> : <?php echo $return_arr['cumment']?>
                                                                        </div>
                                                                    <?php
                                                                    }?>

                                                                 </div>
                                                                              </div>
                                                                 </div>

                                                            </div>
                                                        </div>
                                                    <?php
                                                               }
                                                         }

                                                    ?>

                                                </div>

                                            </td>
                                            <td class="product-price1">
                                                <span>
                                                    <?php echo $order_currency_currency_symbol.number_format(
                                                    $items['price'],2);?>
                                                </span>
                                            </td>
                                            <td class="quant-cart text-left">
                                                <?php
                                                    echo $items['quantity']
                                                ?>
                                            </td>
                                            <td class="product-subtotal">
                                                <span>
                                                    <?php
                                                    $subtotal=($items['price']*
                                                    $items['quantity']);
                                                    echo $order_currency_currency_symbol.number_format( $subtotal,2);

                                                   ?>
                                                </span>
                                            </td>
                                        </tr>
                                        <?php }?>
                                        <tr>
                                            <td colspan="5" class="text-right">

                                                <div class="cart-total">
                                                    <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Montant sous-total
                                                            <?php }else{ ?>
                                                              Subtotal Amount
                                                            <?php
                                                            }?>: <font class="cart-sub-total"><?php echo $order_currency_currency_symbol."".number_format($orderData['sub_total_amount'],2);?></font>
                                                    </span>
                                                </div>
                                        <?php if(!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] !="0.00"){?>
                                                <div class="cart-total">
                                                    <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Remise client privilégiée:
                                                            <?php }else{ ?>
                                                              Preffered Customer Discount:
                                                            <?php
                                                            }?> <font class="cart-sub-total">
<?php echo '-'.$order_currency_currency_symbol.number_format($orderData['preffered_customer_discount'],2);?></font>
                                                    </span>
                                                </div>
                                        <?php
                                        }?>

                                        <?php if(!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] !="0.00"){?>
                                                <div class="cart-total">
                                                    <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Remise de coupon
                                                            <?php }else{ ?>
                                                              Coupon Discount
                                                            <?php
                                                            }?> : <font class="cart-sub-total">
<?php echo '-'.$order_currency_currency_symbol.number_format($orderData['coupon_discount_amount'],2);?></font>
                                                    </span>
                                                </div>
                                        <?php
                                        }?>

                                        <div class="cart-total">
                                            <span><?php
                                                            if($language_name=='French'){ ?>
                                                             Frais d'expédition
                                                            <?php }else{ ?>
                                                              Shipping Fee
                                                            <?php
                                                            }?> :
                                        <font class="cart-sub-total">
                                            <?php
    echo $order_currency_currency_symbol.number_format($orderData['delivery_charge'],2);?>
                                            </font>
                                                    </span>
                                                </div>
                                         <?php if(!empty($orderData['total_sales_tax']) &&  $orderData['total_sales_tax'] !='0.00'){
                                //pr($salesTaxRatesProvinces_Data);
                                            ?>
                                                <div class="cart-total">
                                                    <span>Total <?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%: <font class="cart-sub-total"><?php
    echo $order_currency_currency_symbol.number_format($orderData['total_sales_tax'],2);?></font>
                                                    </span>
                                                </div>
                                            <?php }?>

                                                <div class="cart-total">
                                                    <span><?php
                                                            if($language_name=='French'){ ?>
                                                              Montant total de la commande
                                                            <?php }else{ ?>
                                                              Order Total Amount
                                                            <?php
                                                            }?> : <font class="cart-sub-total"><?php
    echo $order_currency_currency_symbol."".number_format($orderData['total_amount'],2);?></font>
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
