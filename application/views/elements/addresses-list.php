<?php if ($address) {
  $checked = '';
  if ($address['default_delivery_address']==1) {
      $checked = 'checked';
  }
  ?>
<div class="email-field-t">
    <div class="email-text-t">
        <span class="address-type-name <?= $address['address_type'] ?>"><?= ucfirst($address['address_type']) ?>
        <?php if ($address['default_delivery_address']==1) {
           echo ' (Default Delivery Address)';
        }
        ?>
        <span><?= ucfirst($address['name'])?> <?php  $address['mobile'] ?> <?= !empty($address['alternate_phone']) ? ','.$address['alternate_phone'] : '' ?>
        <?= !empty($address['company_name']) ? '('.$address['company_name'].")":'' ?>
        </span>

        <br>
        <span class="tt-t"><?= $address['address'] ?>,
        <?= $address['cityName'] ?>, <?= $address['StateName'] ?>, <?= $address['CountryName'] ?> - <strong><?= $address['pin_code']  ?></strong></span>

    </div>
</div>
<?php } ?>
