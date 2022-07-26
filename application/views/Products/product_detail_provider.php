<input type="hidden" name="provider_id" value="<?= $provider->id?>">
<input type="hidden" name="product_id" value="<?= $provider->product_id?>">
<div class="col-md-12 col-md-12 col-md-8">
    <?php foreach ($provider->attributes as $attribute) {?>
        <div class="single-review">
            <label><?= $attribute->attribute_id ? ($language_name == 'French' ? $attribute->attribute_name_french : $attribute->attribute_name) : $attribute->name?><span class="required">*</span></label>
            <select name="productOptions[]" required id="attribute-<?=$attribute->id?>">
                <option value="">
                    <?php if ($attribute->attribute_id) {?>
                        <?= $language_name == 'French' ? "Sélectionnez $attribute->attribute_name_french" : "Select $attribute->attribute_name"?>
                    <?php } else {?>
                        Select <?=$attribute->name?>
                    <?php }?>
                </option>
                <?php foreach ($attribute->values as $value) {?>
                    <option value="<?= $value->id?>"><?= $value->value?></option>
                <?php }?>
            </select>
            <span style="color:red" id="attribute-<?=$attribute->id?>_error"></span>
        </div>
    <?php }?>
</div>
<script>
    $(document).ready(function() {
        $('.single-review select').on('change', updatePrice);
    });
    function updatePrice()
    {
        var emptyAttributes = $('[name="productOptions[]"]').filter(function(i, v) {
            return $(this).val() == '';
        }).toArray();
        if (emptyAttributes.length == 0) {
            $("#loader-img").show();
            $(".new-price-img").hide();
        }
        var form = $('#cartForm');
        $.ajax({
            url: '/Products/ProviderPrice',
            type: 'POST',
            data: form.serialize(),
            headers: { accept: 'application/json' },
            success: function(data) {
                if (emptyAttributes.length == 0) {
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
