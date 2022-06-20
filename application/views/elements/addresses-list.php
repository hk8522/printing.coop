<?php if($address) {
  $checked = '';
  if ($address['default_delivery_address']==1) {
      $checked = 'checked';
  }
  ?>
<div class="email-field-t">
    <div class="email-text-t">
        <span class="address-type-name <?php echo $address['address_type'];?>"><?php echo ucfirst($address['address_type']);?>
        <?php if($address['default_delivery_address']==1){
           echo ' (Default Delivery Address)';
        }
        ?>
        <span><?php echo ucfirst($address['name'])?> <?php  $address['mobile'];?> <?php echo !empty($address['alternate_phone']) ? ','.$address['alternate_phone']:'';?>
        <?php echo !empty($address['company_name']) ? '('.$address['company_name'].")":'';?>
        </span>

        <br>
        <span class="tt-t"><?php echo $address['address'];?>,
        <?php echo $address['cityName'];?>,<?php echo $address['StateName'];?>,<?php echo $address['CountryName'];?> - <strong><?php echo $address['pin_code'];?></strong></span>

    </div>
</div>
<?php } ?>
