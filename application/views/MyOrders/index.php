<div class="account-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="account-section-inner">
            <?php $this->load->view('elements/my-account-menu') ?>
            <div class="account-area">
                <div class="universal-dark-title">
                    <span>
                    <?php
                    if ($language_name == 'French'){ ?>
                      Vos commandes
                    <?php }else{ ?>
                      Your Orders
                    <?php
                    }?></span>
                </div>
                <div class="text-center" style="color:red">
                            <?php echo $this->session->flashdata('message_error');?>
                            </div>
                            <div class="text-center" style="color:green">
                            <?php echo $this->session->flashdata('message_success');?>
                            </div><br>
                <div class="order-display-section">
                    <?php if(!empty($orderData)) { ?>
                    <?php foreach($orderData as $list){
                        $currency_id=$list['currency_id'];
                        if(empty($currency_id)){
                             $currency_id=1;
                        }
                        $OrderCurrencyData=$CurrencyList[$currency_id];
                        $order_currency_currency_symbol=$OrderCurrencyData['symbols'];

                    ?>
                    <div class="single-order-display">

                        <div class="email-field1">
                            <div class="row align-items-center">
                                <div class="col-7 col-md-4 col-lg-3 col-xl-3">
                                    <div class="order-id">
                                        <button type="submit">
                                        <?php
                                        //echo $language_name =='French' ? ORDER_ID_PREFIX_FRENCH.$list['id']:$list['order_id'];
                                        echo $list['order_id'];
                                        ?></button>
                                    </div>
                                </div>
                                <div class="col-5 col-md-3 col-lg-3 col-xl-3">
                                    <div class="status-btn">
                                        <?php
                                        echo $language_name =='French' ? getOrderSatusClassFrench($list['status']):getOrderSatusClass($list['status']);
                                        ;?>
                                    </div>
                                </div>

                                <div class="col-12 col-md-5 col-lg-6 col-xl-6 text-right">
                                    <div class="order-id-button">
                                        <?php if(in_array($list['status'],array(6,7,8))){ ?>
                                        <a href="<?php echo $BASE_URL?>MyOrders/deleteOrder/<?php echo base64_encode($list['id'])?>" onclick="return confirm('Are you sure you want to delete this order?');">
                                           <button type="button">
                                           <?php
                                            if ($language_name == 'French'){ ?>
                                              supprimer
                                            <?php }else{ ?>
                                              delete
                                            <?php
                                            }?></button>
                                         </a>
                                        <?php
                                        }
                                        if(in_array($list['status'],array(2,3,4))){ ?>
                                         <a href="javascript:void(0)" onclick="changeOrderStatus('<?php echo $list['id']?>',6)">
                                        <button  type="submit">
                                        <?php
                                            if ($language_name == 'French'){ ?>
                                              Annuler
                                            <?php }else{ ?>
                                              cancel
                                            <?php
                                            }?></button>
                                        <?php
                                        }?>
                                        <a href="<?php echo $BASE_URL?>MyOrders/view/<?php echo base64_encode($list['id'])?>"><button class="view-details-btn" type="button"> <?php
                                        echo $language_name =='French' ? "Voir l'ordre":'View Order';
                                        ;?></button></a>
                                        <?php
                                        if($language_name  == 'French'){
                                           $file_name=$list['order_id']."-fr-invoice.pdf";
                                           $file_name=strtolower($file_name);
                                           $location=FILE_BASE_PATH.'pdf/'.$file_name;
                                           $linkInvoice=$BASE_URL."MyOrders/download/".urlencode($location)."/".urlencode($file_name);
                                           $InvoiceText='Facture Pdf';
                                        }else{
                                              $file_name=$list['order_id']."-invoice.pdf";
                                              $file_name=strtolower($file_name);
                                              $location=FILE_BASE_PATH.'pdf/'.$file_name;
                                              $linkInvoice=$BASE_URL."MyOrders/download/".urlencode($location)."/".urlencode($file_name);
                                              $InvoiceText='Invoice Pdf';
                                        }
                                        $linkInvoice=$BASE_URL."MyOrders/downloadOrderPdf/".$list['id'].'/invoice';
                                        ?>

                                        <a href="<?php echo $linkInvoice?>"><button class="view-details-btn" type="button"><i class="fas fa-file-download"></i>
                                        <?php echo $InvoiceText;
                                        ?></button></a>
                                        <?php
                                           if($language_name  == 'French'){
                                               $file_name=$list['order_id']."-fr-order.pdf";
                                               $file_name=strtolower($file_name);
                                               $location=FILE_BASE_PATH.'pdf/'.$file_name;
                                               $linkOrder=$BASE_URL."MyOrders/download/".urlencode($location)."/".urlencode($file_name);
                                            }else{
                                                $file_name=$list['order_id']."-order.pdf";
                                                $file_name=strtolower($file_name);
                                                $location=FILE_BASE_PATH.'pdf/'.$file_name;
                                                $linkOrder=$BASE_URL."MyOrders/download/".urlencode($location)."/".urlencode($file_name);
                                            }
                                            $linkOrder=$BASE_URL."MyOrders/downloadOrderPdf/".$list['id'].'/order';

                                        ?>
                                        <a href="<?php echo $linkOrder;?>">
                                        <button class="view-details-btn" type="button"><i class="fas fa-file-download"></i>
                                        <?php
                                            if ($language_name == 'French'){ ?>
                                              Commander Pdf
                                            <?php }else{ ?>
                                              Order Pdf
                                            <?php
                                            }?></button></a>

                                    </div>
                                </div>
                           </div>
                         </div>
                        <div class="cart-product-display">
                            <table>
                                <tbody>
                                  <?php foreach ($list['OrderItem'] as $rowid=>$items){ //pr($items);?>
                                    <tr>
                                        <td style="width: 80px;">
                                            <div class="cart-product-img">
                                                <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['product_id']);?>">
                                                  <?php
                                                    $imageurl = getProductImage($items['product_image']);
                                                    $personailise = $items['personailise'];
                                                    $personailise_image=$items['personailise_image'];
                                                    $Personalised = 'Unpersonalised';
                                                    if ($personailise==1 && $personailise_image !=''){
                                                       $Personalised='Personalised';
                                                       $imageurl=FILE_UPLOAD_BASE_URL.'personailise/'.$personailise_image;
                                                    }
                                                  ?>
                                                <img src="<?php echo $imageurl?>">
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-product-desc">
                                                <div class="cart-product-title">
                                                    <a href="<?php echo $BASE_URL;?>Products/view/<?php echo base64_encode($items['product_id']);?>"><span><?php if ($language_name == 'French'){
                                                     echo $items['name_french'];
                                                    }else{
                                                    echo $items['name'];
                                                    }?></span></a>
                                                </div>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="cart-product-price">
                                                <span>
                                                  <?php echo $items['quantity'];?></span>X<span>
                                                  <?php echo $order_currency_currency_symbol.number_format($items['price'], 2);?></span>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="email-text1">
                                                <div class="cart-product-price">
                                                <span>
                                                  <?php echo $order_currency_currency_symbol.number_format($items['subtotal'], 2);?></span>
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
                                            <?php
                                            if ($language_name == 'French'){ ?>
                                              Commandé le
                                            <?php }else{ ?>
                                              Ordered On
                                            <?php
                                            }?> <strong><?php echo dateFormate($list['created']);?></strong></span>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-5 col-md-5 text-right">
                                    <div class="order-id">
                                       <span>
                                       <?php
                                            if ($language_name == 'French'){ ?>
                                              Sous-total:
                                            <?php }else{ ?>
                                              Sub Total:
                                            <?php
                                            }?>
                                          <strong>
                                          <?php echo $order_currency_currency_symbol.number_format($list['sub_total_amount'], 2);?>
                                          </strong>
                                         </span>
                                    </div>
                                    <?php if(!empty($list['preffered_customer_discount']) && $list['preffered_customer_discount'] !="0.00"){?>
                                    <div class="order-id">
                                         <span>
                                           <?php
                                            if ($language_name == 'French'){ ?>
                                              Remise client privilégiée:
                                            <?php }else{ ?>
                                              Preffered Customer Discount:
                                            <?php
                                            }?>
                                          <strong>
                                          <?php echo '-'.$order_currency_currency_symbol."".number_format($list['preffered_customer_discount'], 2);?>
                                          </strong>
                                         </span>
                                    </div>
                                    <?php
                                    }?>
                                    <?php if(!empty($list['coupon_discount_amount']) && $list['coupon_discount_amount'] !="0.00"){?>
                                    <div class="order-id">
                                         <span>
                                           <?php
                                            if ($language_name == 'French'){ ?>
                                              Remise du coupon:
                                            <?php }else{ ?>
                                              Coupon Discount:
                                            <?php
                                            }?>
                                          <strong>
                                          <?php echo '-'.$order_currency_currency_symbol."".number_format($list['coupon_discount_amount'], 2);?>
                                          </strong>
                                         </span>
                                    </div>
                                    <?php
                                    }?>
                                        <div class="order-id">
                                         <span>
                                           <?php
                                            if ($language_name == 'French'){ ?>
                                              Frais d'expédition
                                            <?php }else{ ?>
                                              Shipping Fee
                                            <?php
                                            }?>:
                                          <strong>

                                            <?php
    echo $product_price_currency_symbol.number_format($list['delivery_charge'],2);?>

                                          </strong>
                                         </span>
                                        </div>
                                <?php if(!empty($list['total_sales_tax']) &&  $list['total_sales_tax'] !='0.00'){
                                   $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($list['billing_state']);
                                ?>
                                        <div class="order-id">
                                           <span>
                                          Total <?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%:
                                            <strong>

                                           <?php
    echo $product_price_currency_symbol.number_format($list['total_sales_tax'],2);?>

                                          </strong>
                                         </span>
                                        </div>
                                <?php }?>

                                        <div class="order-id">
                                        <span><?php
                                            if ($language_name == 'French'){ ?>
                                              Total de la commande
                                            <?php }else{ ?>
                                              Order Total
                                            <?php
                                            }?>:
                                          <strong>
                                          <?php echo $order_currency_currency_symbol."".number_format($list['total_amount'], 2);?>
                                          </strong>
                                         </span>

                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                  <?php  } ?>
                    <?php
                    } else { ?>
                    <div class="text-center">
                        <h2 class="lead"><?php
                                            if ($language_name == 'French'){ ?>
                                              L'historique des commandes est vide
                                            <?php }else{ ?>
                                              Order History Is Empty
                                            <?php
                                            }?></h2>
                    </div>
                    <?php }?>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
         <h4 class="modal-title"><?php
                                            if ($language_name == 'French'){ ?>
                                              Raison de l'annulation
                                            <?php }else{ ?>
                                             Cancellation Reason
                                            <?php
                                            }?> </h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <form class="form-horizontal" name="commentform" method="post" action="" id="changeOrderStatusForm">

      <input type="hidden" name="order_id" id="cl_order_id">
      <input type="hidden" name="status" id="cl_status">

      <div class="modal-body">
            <div id="MsgError"></div>
            <div class="col-xs-12">
                <div class="form-group">
                    <label for="InputMessage" class="col-lg-12 control-label"><?php
                                            if ($language_name == 'French'){ ?>
                                              Raison
                                            <?php }else{ ?>
                                              Reason
                                            <?php
                                            }?></label>
                    <div class="col-lg-12">
                        <textarea name="mobileMsg" id="mobileMsg" class="form-control" rows="5" required></textarea>
                    </div>
                </div>
            </div>
      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-success" id="btnSubmit"><?php
                                            if ($language_name == 'French'){ ?>
                                              Soumettre
                                            <?php }else{ ?>
                                              Submit
                                            <?php
                                            }?></button>
      </div>
      </form>
    </div>
  </div>
</div>
</div>
