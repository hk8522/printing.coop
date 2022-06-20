<div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>Order Total Item</label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label id="total_item_label"><?php echo isset($_SESSION['total_item']) ? $_SESSION['total_item']:0;?></label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>Sub Total:</label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>
            <?php

               $sub_total=isset($_SESSION['sub_total']) ? $_SESSION['sub_total']:0;

               echo CURREBCY_SYMBOL.number_format($sub_total,2);
            ?>
            </label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>Coupon Discount:</label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>
            <?php

               $discount_amount=isset($_SESSION['discount_amount']) ? $_SESSION['discount_amount']:0;
               echo "-".CURREBCY_SYMBOL.number_format($discount_amount,2);

            ?>
            </label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>Preffered Customer Discount:</label>
        </div>
    </div>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>
            <?php

               $preffered_customer_discount=isset($_SESSION['preffered_customer_discount']) ? $_SESSION['preffered_customer_discount']:0;
               echo "-".CURREBCY_SYMBOL.number_format($preffered_customer_discount,2);

            ?>
            </label>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>Shipping Method:</label>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>
             <?php
              $shipping_fee=isset($_SESSION['shipping_fee']) ? $_SESSION['shipping_fee']:0;
              echo CURREBCY_SYMBOL.number_format($shipping_fee,2);
              ?>
            </label>
        </div>
    </div>

    <?php if(isset($_SESSION['total_sales_tax']) && !empty($_SESSION['total_sales_tax'])){
        $state_id=isset($_SESSION['state_id']) ? $_SESSION['state_id']:0;
        $salesTaxRatesProvinces_Data=$this->Address_Model->salesTaxRatesProvincesById($state_id);
    ?>
    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label><?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%:</label>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>
              <?php
              $total_sales_tax=isset($_SESSION['total_sales_tax']) ? $_SESSION['total_sales_tax']:0;
              echo CURREBCY_SYMBOL.number_format($total_sales_tax,2);
              ?>
              </label>
        </div>
    </div>
    <?php
    }?>

    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>Total Amount:</label>
        </div>
    </div>

    <div class="col-6 col-md-6">
        <div class="table-filter-fields">
            <label>
              <?php
              $total_amount=isset($_SESSION['total_amount']) ? $_SESSION['total_amount']:0;
              echo CURREBCY_SYMBOL.number_format($total_amount,2);
              ?>
              </label>
        </div>
    </div>

    <input type='hidden' id="shipping_fee" value="<?php echo isset($_SESSION['shipping_fee']) ? $_SESSION['shipping_fee']:0;?>" name="shipping_fee">
    <input type='hidden' id="discount_amount" value="<?php echo isset($_SESSION['discount_amount']) ? $_SESSION['discount_amount']:0;?>" name="coupon_discount_amount">
    <input type='hidden' id="preffered_customer_discount" value="<?php echo isset($_SESSION['preffered_customer_discount']) ? $_SESSION['preffered_customer_discount']:0;?>" name="preffered_customer_discount">

    <input type='hidden' id="total_item" value="<?php echo isset($_SESSION['total_item']) ? $_SESSION['total_item']:0;?>" name="total_items">
    <input type='hidden' id="total_sales_tax" value="<?php echo isset($_SESSION['total_sales_tax']) ? $_SESSION['total_sales_tax']:0;?>" name="total_sales_tax">
    <input type='hidden' id="sub_total" value="<?php echo isset($_SESSION['sub_total']) ? $_SESSION['sub_total']:0;?>" name="sub_total_amount">
    <input type='hidden' id="total_amount" value="<?php echo isset($_SESSION['total_amount']) ? $_SESSION['total_amount']:0;?>" name="total_amount">
