<input type="hidden" name="provider_id" value="<?= $provider->id?>">
<input type="hidden" name="product_id" value="<?= $provider->product_id?>">
<div class="col-md-12 col-md-12 col-md-8">
    <?php
        $sina = config_item('sina');
        $shipping_extra_days = $sina['shipping_extra_days'];
    ?>
    <?php foreach ($provider->options as $option) {//echo json_encode($option);?>
        <div class="single-review option-<?= str_replace(' ', '-', $option->name)?>">
            <label><?= ucfirst($option->option_id ? ($language_name == 'French' ? $option->attribute_name_french : $option->attribute_name) : $option->label)?> <span class="required">*</span></label>
            <?php if ($option->html_type == 'input' /*&& empty($option->values)*/) { ?>
                <input type="text" class="product-option field" name="productOptions[<?= $option->name?>]" required id="attribute-<?= $option->id?>">
            <?php } else if ($option->html_type == 'radio') { ?>
                <div class="field">
                    <?php foreach ($option->values as $item) { ?>
                        <div class="shape-icon radio-icon">
                            <input id="attribute-<?= $item->provider_option_value_id?>" type="radio" class="product-option" name="productOptions[<?= $option->name?>]" value="<?= $providerProduct->information_type == App\Common\ProviderProductInformationType::RollLabel ? $item->value : $item->provider_option_value_id?>">
                            <label for="attribute-<?= $item->provider_option_value_id?>">
                                <?php if ($item->img_src) { ?>
                                    <img class="no-lazy" src="https://sinalite.com/pub/<?= $item->img_src?>" style="width: 32px;margin-top: 8px;cursor: pointer;">
                                <?php } ?>
                                <div><?= $item->value?></div>
                            </label>
                        </div>
                    <?php } ?>
                </div>
            <?php } else { ?>
                <select class="product-option field" name="productOptions[<?= $option->name?>]" required id="attribute-<?= $option->id?>">
                    <option value="">
                        <?php if ($option->attribute_id) { ?>
                            <?= ucfirst($language_name == 'French' ? "Sélectionnez $option->attribute_name_french" : "Select $option->attribute_name")?>
                        <?php } else{ ?>
                            Select <?= ucfirst($option->label)?>
                        <?php } ?>
                    </option>
                    <?php foreach ($option->values as $item) { ?>
                        <option value="<?= $providerProduct->information_type == App\Common\ProviderProductInformationType::RollLabel ? $item->value : $item->provider_option_value_id?>">
                            <?= ucfirst($item->option_type == App\Common\AttributeType::Turnaround ? option_turnaround_add_days($item->value, $shipping_extra_days) : $item->value)?>
                        </option>
                    <?php } ?>
                </select>
            <?php } ?>
            <span style="color:red" id="attribute-<?= $option->id?>_error"></span>
        </div>
    <?php } ?>
</div>
<script>
    $(document).ready(function() {
        $('.option-width').hide();
        $('.option-length').hide();
        $('.option-diameter').hide();

        $('.single-review select').on('change', updatePrice);
        $('.single-review input').on('change', updatePrice);
    });
    function updatePrice()
    {
        if ($(this).attr('name') == 'productOptions[shape]') {
            var value = $(this).val();
            if (value == 'circle') {
                $('.option-width').hide();
                $('.option-length').hide();
                $('.option-diameter').show();
            } else {
                $('.option-width').show();
                $('.option-length').show();
                $('.option-diameter').hide();
            }
        }

        var formData = $('#cartForm').serializeArray();
        var filled = 0;
        for (var i = 0; i < formData.length; i++) {
            const regex = /productOptions\[(.*)\]/;
            const found = formData[i].name.match(regex);
            if (found) {
                var fieldName = found[1];
                if ($(`.single-review.option-${fieldName.replaceAll(' ', '-')}`).is(":visible")) {
                    if (formData[i].value != null && formData[i].value != '')
                        filled++;
                }
            }
        }
        if (filled < $('.single-review:visible').length)
            return;

        $('#loader-img').show();
        $('.new-price-img').hide();
        $.ajax({
            url: '/Products/ProviderPrice',
            type: 'POST',
            data: {params: $('#cartForm').serialize()},
            headers: { accept: 'application/json' },
            success: function(data) {
                if (filled == $('.single-review:visible').length) {
                    $('#loader-img').hide();
                    $('.new-price-img').show();
                }
                if (data.success) {
                    var price = data.price.price == NaN ? 0 : data.price.price * <?= $provider->price_rate?>;
                    $('[name="price"]').val(price);
                    $('#total-price').html((price * $('#quantity').val()).toFixed(2));
                } else
                    alert(data.message);
            },
            error: function (resp) {
                console.log(resp);
                $('#loader-img').hide();
                $('.new-price-img').show();
            }
        });
        return;
    }
</script>
