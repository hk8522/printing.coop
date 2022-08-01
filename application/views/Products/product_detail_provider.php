<input type="hidden" name="provider_id" value="<?= $provider->id?>">
<input type="hidden" name="product_id" value="<?= $provider->product_id?>">
<div class="col-md-12 col-md-12 col-md-8">
    <?php foreach ($provider->options as $option) {//echo json_encode($option);?>
        <div class="single-review">
            <label><?= ucfirst($option->option_id ? ($language_name == 'French' ? $option->attribute_name_french : $option->attribute_name) : $option->label)?><span class="required">*</span></label>
            <?php if ($option->html_type == 'input' && empty($option->values)) {?>
                <input type="text" class="product-option" name="productOptions[<?= $option->name?>]" required id="attribute-<?=$option->id?>">
            <?php } else { ?>
                <select class="product-option" name="productOptions[<?= $option->name?>]" required id="attribute-<?=$option->id?>">
                    <option value="">
                        <?php if ($option->attribute_id) {?>
                            <?= ucfirst($language_name == 'French' ? "Sélectionnez $option->attribute_name_french" : "Select $option->attribute_name")?>
                        <?php } else {?>
                            Select <?= ucfirst($option->label)?>
                        <?php }?>
                    </option>
                    <?php foreach ($option->values as $value) {?>
                        <option value="<?= $providerProduct->information_type == App\Common\ProviderProductInformationType::RollLabel ? $value->value : $value->id?>"><?= ucfirst($value->value)?></option>
                    <?php }?>
                </select>
            <?php } ?>
            <span style="color:red" id="attribute-<?=$option->id?>_error"></span>
        </div>
    <?php }?>
</div>
<script>
    $(document).ready(function() {
        $('.single-review select').on('change', updatePrice);
        $('.single-review input').on('change', updatePrice);
    });
    function updatePrice()
    {
        var emptyOptions = $('.product-option').filter(function(i, v) {
            return $(this).val() == '';
        }).toArray();
        if (emptyOptions.length == 0) {
            $("#loader-img").show();
            $(".new-price-img").hide();
        } else {
            return;
        }
        $.ajax({
            url: '/Products/ProviderPrice',
            type: 'POST',
            data: {params: $('#cartForm').serialize()},
            headers: { accept: 'application/json' },
            success: function(data) {
                if (emptyOptions.length == 0) {
                    $("#loader-img").hide();
                    $(".new-price-img").show();
                }
                if (data.success) {
                    var price = data.price.price == NaN ? 0 : data.price.price * 1.75;
                    $('[name="price"]').val(price);
                    $('#total-price').html((price * $("#quantity").val()).toFixed(2));
                } else
                    alert(data.message);
            },
            error: function (resp) {
                console.log(resp);
                $("#loader-img").hide();
                $(".new-price-img").show();
            }
        });
        return;
    }
</script>
