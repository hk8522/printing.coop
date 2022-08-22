<div class="col-md-12 col-md-12 col-md-8">
    <?php
        $sina = config_item('sina');
        $shipping_extra_days = $sina['shipping_extra_days'];
    ?>
    <?php foreach ($attributes as $attribute) {?>
        <div class="single-review attribute-<?= str_replace(' ', '-', $attribute->attribute_id)?>">
            <label><?= ucfirst($language_name == 'French' ? $attribute->label_fr : $attribute->label)?> <span class="required">*</span></label>
            <?php if ($attribute->use_items == 0) { ?>
                <?php if ($attribute->value_min > 0 || $attribute->value_max > 0) { ?>
                    <input type="number" class="attribute field" name="attributes[<?= $attribute->attribute_id?>]" required id="attribute-<?= $attribute->attribute_id?>" placeholder="<?= ($attribute->value_min > 0 ? $attribute->value_min : '') . ' ~ ' . ($attribute->value_max > 0 ? $attribute->value_max : '') ?>"
                        <?= $attribute->value_min > 0 ? 'min="' . $attribute->value_min . '"' : '' ?>  <?= $attribute->value_max > 0 ? 'max="' . $attribute->value_max . '"' : '' ?>>
                <?php } else { ?>
                    <input type="text" class="attribute field" name="attributes[<?= $attribute->attribute_id?>]" required id="attribute-<?= $attribute->attribute_id?>" placeholder="<?= ($attribute->value_min > 0 ? $attribute->value_min : '') . ' ~ ' . ($attribute->value_max > 0 ? $attribute->value_max : '') ?>">
                <?php } ?>
            <?php } else { ?>
                <select class="attribute field" name="attributes[<?= $attribute->attribute_id?>]" required id="attribute-<?= $attribute->attribute_id?>">
                    <option value="">
                        <?= ucfirst($language_name == 'French' ? "Sélectionnez $attribute->label_fr" : "Select $attribute->label")?>
                    </option>
                    <?php foreach ($attribute_items as $item) {
                        if ($item->attribute_id != $attribute->attribute_id)
                            continue; ?>
                        <option value="<?= $item->attribute_item_id?>">
                            <?= ucfirst($language_name == 'French' ? $item->attribute_item_name_fr : $item->attribute_item_name)?>
                        </option>
                    <?php } ?>
                </select>
            <?php } ?>
            <span style="color:red" id="attribute-<?= $attribute->attribute_id?>_error"></span>
        </div>
    <?php } ?>
</div>
<script>
    var attributes = <?= json_encode($attributes) ?>;
    var attribute_items = <?= json_encode($attribute_items) ?>;

    $(document).ready(function() {
        $('.option-width').hide();
        $('.option-length').hide();
        $('.option-diameter').hide();

        $('.single-review select').on('change', updatePrice);
        $('.single-review input').on('change', updatePrice);
    });
    function parseSize(sizeStr)
    {
        var dims = sizeStr.match(/([\d\.]+)/g);
        if (dims)
            return parseFloat(dims[0]) * parseFloat(dims[1]);
        return 1;
    }
    function updatePrice()
    {
        var quantity = 1, size = 1, width = 1, length = 1, diameter = 1, depth = 1, pages = 1;
        for (var i = 0; i < attributes.length; i++) {
            var attribute = attributes[i];
            var attribute_item_id = $('#attribute-' + attribute.attribute_id).val();
            for (var j = 0; j < attribute_items.length; j++) {
                var item = attribute_items[j];
                if (item.attribute_id != attribute.attribute_id)
                    continue;
                if (item.attribute_item_id != attribute_item_id)
                    continue;
                if (attribute.type == <?= App\Common\AttributeType::Quantity ?>)
                    quantity = parseInt(item.attribute_item_name);
                else if (attribute.type == <?= App\Common\AttributeType::Size ?>)
                    size = parseSize(item.attribute_item_name);
                else if (attribute.type == <?= App\Common\AttributeType::Width ?>)
                    width = parseInt(item.attribute_item_name);
                else if (attribute.type == <?= App\Common\AttributeType::Length ?>)
                    length = parseInt(item.attribute_item_name);
                else if (attribute.type == <?= App\Common\AttributeType::Diameter ?>)
                    diameter = parseInt(item.attribute_item_name);
                else if (attribute.type == <?= App\Common\AttributeType::Depth ?>)
                    depth = parseInt(item.attribute_item_name);
                else if (attribute.type == <?= App\Common\AttributeType::Pages ?>)
                    pages = parseInt(item.attribute_item_name);
            }
        }
        console.log(quantity, size, width, length, diameter, depth, pages);

        var price = <?= $Product['price'] ?>;
        for (var i = 0; i < attributes.length; i++) {
            var attribute = attributes[i];
            var attribute_item_id = $('#attribute-' + attribute.attribute_id).val();
            for (var j = 0; j < attribute_items.length; j++) {
                var item = attribute_items[j];
                if (item.attribute_id != attribute.attribute_id)
                    continue;
                if (item.attribute_item_id != attribute_item_id)
                    continue;

                console.log([attribute.attribute_id, attribute_item_id, attribute.additional_fee, item.additional_fee]);
                var fee = parseFloat(item.additional_fee ?? 0);

                if (attribute.fee_apply_size)
                    fee *= size;
                if (attribute.fee_apply_width)
                    fee *= width;
                if (attribute.fee_apply_length)
                    fee *= length;
                if (attribute.fee_apply_diameter)
                    fee *= diameter;
                if (attribute.fee_apply_depth)
                    fee *= depth;
                if (attribute.fee_apply_pages)
                    fee *= pages;

                price += fee;
            }
            // if (attribute.type != <?= App\Common\AttributeType::Quantity ?>)
            //     fee *= quantity;
        }
        console.log(price);
        $('[name="price"]').val(price * quantity);
        $('#total-price').html((price * quantity * $('#quantity').val()).toFixed(2));
        return;

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
            url: '/Products/Price',
            type: 'POST',
            data: {params: $('#cartForm').serialize()},
            headers: { accept: 'application/json' },
            success: function(data) {
                if (filled == $('.single-review:visible').length) {
                    $('#loader-img').hide();
                    $('.new-price-img').show();
                }
                if (data.success) {
                    var price = data.price.price == NaN ? 0 : data.price.price * '<?= $provider->price_rate?>';
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
