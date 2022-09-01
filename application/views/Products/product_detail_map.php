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
                    <input type="text" class="attribute field" name="attributes[<?= $attribute->attribute_id?>]" required id="attribute-<?= $attribute->attribute_id?>">
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
    function parseValue(str)
    {
        var v = parseFloat(str);
        if (isNaN(v))
            return null;
        else
            return v;
    }
    function parseSize(sizeStr)
    {
        var dims = sizeStr.match(/([\d\.]+)/g);
        if (dims)
            return (parseValue(dims[0]) ?? 1) * (parseValue(dims[1]) ?? 1);
        return 1;
    }
    function updatePrice()
    {
        var quantity = 1, size = 1, width = 1, length = 1, diameter = 1, depth = 1, pages = 1, rectoVerso = 100;
        var sizePrice = 1, sizePriceUsed = false;
        for (var i = 0; i < attributes.length; i++) {
            var attribute = attributes[i];
            if (attribute.use_items == 1) {
                var attribute_item_id = $('#attribute-' + attribute.attribute_id).val();
                for (var j = 0; j < attribute_items.length; j++) {
                    var item = attribute_items[j];
                    if (item.attribute_id != attribute.attribute_id)
                        continue;
                    if (item.attribute_item_id != attribute_item_id)
                        continue;
                    if (attribute.type == <?= App\Common\AttributeType::Quantity ?>)
                        quantity = parseValue(item.attribute_item_name) ?? 1;
                    else if (attribute.type == <?= App\Common\AttributeType::Size ?>) {
                        size = parseSize(item.attribute_item_name);
                        sizePrice = parseValue(attribute.additional_fee) ?? 0;
                        sizePriceUsed = true;
                    } else if (attribute.type == <?= App\Common\AttributeType::Width ?>) {
                        width = parseValue(item.attribute_item_name) ?? 1;
                        sizePrice *= parseValue(attribute.additional_fee) ?? 0;
                        sizePriceUsed = true;
                    } else if (attribute.type == <?= App\Common\AttributeType::Length ?>) {
                        length = parseValue(item.attribute_item_name) ?? 1;
                        sizePrice *= parseValue(attribute.additional_fee) ?? 0;
                        sizePriceUsed = true;
                    } else if (attribute.type == <?= App\Common\AttributeType::Diameter ?>) {
                        diameter = parseValue(item.attribute_item_name) ?? 1;
                        sizePice = parseValue(attribute.additional_fee) ?? 0;
                        sizePriceUsed = true;
                    } else if (attribute.type == <?= App\Common\AttributeType::Depth ?>) {
                        depth = parseValue(item.attribute_item_name) ?? 1;
                        sizePrice *= parseValue(attribute.additional_fee) ?? 0;
                        sizePriceUsed = true;
                    } else if (attribute.type == <?= App\Common\AttributeType::Pages ?>) {
                        pages = parseValue(item.attribute_item_name) ?? 1;
                    } else if (attribute.type == <?= App\Common\AttributeType::RectoVerso ?>) {
                        rectoVerso = parseValue(item.additional_fee) ?? 0;
                    }
                }
            } else {
                var value = $('#attribute-' + attribute.attribute_id).val();
                if (attribute.type == <?= App\Common\AttributeType::Quantity ?>)
                    quantity = parseValue(value) ?? 1;
                else if (attribute.type == <?= App\Common\AttributeType::Size ?>) {
                    size = parseSize(value);
                    sizePrice = parseValue(attribute.additional_fee) ?? 0;
                    sizePriceUsed = true;
                } else if (attribute.type == <?= App\Common\AttributeType::Width ?>) {
                    width = parseValue(value) ?? 1;
                    sizePrice *= parseValue(attribute.additional_fee) ?? 0;
                    sizePriceUsed = true;
                } else if (attribute.type == <?= App\Common\AttributeType::Length ?>) {
                    length = parseValue(value) ?? 1;
                    sizePrice *= parseValue(attribute.additional_fee) ?? 0;
                    sizePriceUsed = true;
                } else if (attribute.type == <?= App\Common\AttributeType::Diameter ?>) {
                    diameter = parseValue(value) ?? 1;
                    sizePrice = parseValue(attribute.additional_fee) ?? 0;
                    sizePriceUsed = true;
                } else if (attribute.type == <?= App\Common\AttributeType::Depth ?>) {
                    depth = parseValue(value) ?? 1;
                    sizePrice *= parseValue(attribute.additional_fee) ?? 0;
                    sizePriceUsed = true;
                } else if (attribute.type == <?= App\Common\AttributeType::Pages ?>) {
                    pages = parseValue(value) ?? 1;
                } else if (attribute.type == <?= App\Common\AttributeType::RectoVerso ?>) {
                    rectoVerso = parseValue(value) ?? 0;
                }
            }
        }
        console.log(quantity, size, width, length, diameter, depth, pages);

        var price = <?= $Product['price'] ?>;
        if (sizePriceUsed)
            price += sizePrice * size * width * length * (diameter * diameter) * depth;
        for (var i = 0; i < attributes.length; i++) {
            var attribute = attributes[i];
            if ((attribute.type == <?= App\Common\AttributeType::Quantity ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Size ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Width ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Length ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Diameter ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Depth ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Pages ?>) ||
                (attribute.type == <?= App\Common\AttributeType::RectoVerso ?>))
                continue;
            if (attribute.use_items == 1) {
                var attribute_item_id = $('#attribute-' + attribute.attribute_id).val();
                for (var j = 0; j < attribute_items.length; j++) {
                    var item = attribute_items[j];
                    if (item.attribute_id != attribute.attribute_id)
                        continue;
                    if (item.attribute_item_id != attribute_item_id)
                        continue;

                    console.log([attribute.attribute_id, attribute_item_id, attribute.additional_fee, item.additional_fee]);
                    var fee = parseFloat(item.additional_fee ?? 0);

                    if (attribute.fee_apply_size == 1)
                        fee *= size;
                    if (attribute.fee_apply_width == 1)
                        fee *= width;
                    if (attribute.fee_apply_length == 1)
                        fee *= length;
                    if (attribute.fee_apply_diameter == 1)
                        fee *= diameter * diameter;
                    if (attribute.fee_apply_depth == 1)
                        fee *= depth;
                    if (attribute.fee_apply_pages == 1)
                        fee *= pages;

                    price += fee;
                }
            } else {
                var fee = parseFloat(attribute.additional_fee ?? 0);

                if (attribute.fee_apply_size == 1)
                    fee *= size;
                if (attribute.fee_apply_width == 1)
                    fee *= width;
                if (attribute.fee_apply_length == 1)
                    fee *= length;
                if (attribute.fee_apply_diameter == 1)
                    fee *= diameter * diameter;
                if (attribute.fee_apply_depth == 1)
                    fee *= depth;
                if (attribute.fee_apply_pages == 1)
                    fee *= pages;

                price += fee;
            }
        }
        if (rectoVerso > 0)
            price += price * rectoVerso / 100.0;
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
                    var price = isNaN(Number(data.price.price)) ? 0 : Number(data.price.price) * '<?= $provider->price_rate?>';
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
