<div class="col-md-12 col-md-12 col-md-8">
    <?php
        $sina = config_item('sina');
        $shipping_extra_days = $sina['shipping_extra_days'];
    ?>
    <?php foreach ($attributes as $attribute) {?>
        <div class="single-review attribute-<?= str_replace(' ', '-', $attribute->attribute_id)?> <?= ($attribute->type == App\Common\AttributeType::Size) ? 'size' : '' ?>">
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
        <?php if ($attribute->use_items != 0 && $attribute->type == App\Common\AttributeType::Size) { ?>
            <div class="single-review">
                <label for="custom_size">Need a custom size?</label>
                <label for="custom_size" class="attribute field">
                    <input type="checkbox" id="custom_size" name="custom[size][use]" value="1">
                    Yes
                </label>
            </div>
            <div class="single-review custom-field custom-size d-none">
                <label for="custom_size_width"><?= $language_name == 'French' ? 'Largeur' : 'Width' ?> <span class="required">*</span></label>
                <input class="attribute field" type="number" id="custom_size_width" name="custom[size][width]" data-field="width">
            </div>
            <div class="single-review custom-field custom-size d-none">
                <label for="custom_size_length"><?= $language_name == 'French' ? 'Longueur' : 'Length' ?> <span class="required">*</span></label>
                <input class="attribute field" type="number" id="custom_size_length" name="custom[size][length]" data-field="length">
            </div>
        <?php } ?>
    <?php } ?>
</div>
<script>
    var attributes = <?= json_encode($attributes) ?>;
    var attribute_items = <?= json_encode($attribute_items) ?>;

    $(document).ready(function() {
        $('.option-width').hide();
        $('.option-length').hide();
        $('.option-diameter').hide();

        $('.single-review #custom_size').on('change', toggleCustomSize);

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
    function toggleCustomSize(e)
    {
        if ($(this).prop('checked')) {
            $('.single-review.size').addClass('disabled');
            $('.single-review.size .field').prop('disabled', true);
            $('.single-review.custom-size').removeClass('d-none');
            $('.single-review.custom-size .field').prop('required', true);
        } else {
            $('.single-review.size').removeClass('disabled');
            $('.single-review.size .field').prop('disabled', false);
            $('.single-review.custom-size').addClass('d-none');
            $('.single-review.custom-size .field').prop('required', false);
        }
        updatePrice();
    }
    function updatePrice()
    {
        var percentages = [];
        var quantity = 1, size = 1, width = 1, length = 1, diameter = 1, depth = 1, pages = 1;
        var sizePrices = [];
        for (var i = 0; i < attributes.length; i++) {
            var attribute = attributes[i];
            if ($('#attribute-' + attribute.attribute_id).prop('disabled'))
                continue;
            if (attribute.use_items == 1) {
                var attribute_item_id = $('#attribute-' + attribute.attribute_id).val();
                for (var j = 0; j < attribute_items.length; j++) {
                    var item = attribute_items[j];
                    if (item.attribute_id != attribute.attribute_id)
                        continue;
                    if (item.attribute_item_id != attribute_item_id)
                        continue;
                    if (attribute.use_percentage == 1 || attribute.type == <?= App\Common\AttributeType::Quantity ?>) {
                        var percentage = parseValue(item.additional_fee) ?? 0;
                        if (percentage > 0)
                            percentages.push(percentage);
                        // continue;
                    }

                    if (attribute.type == <?= App\Common\AttributeType::Quantity ?>) {
                        quantity = parseValue(item.attribute_item_name) ?? 1;
                        continue;
                    }
                    else if (attribute.type == <?= App\Common\AttributeType::Size ?>)
                        size = value = parseSize(item.attribute_item_name);
                    else if (attribute.type == <?= App\Common\AttributeType::Width ?>)
                        width = value = parseValue(item.attribute_item_name) ?? 1;
                    else if (attribute.type == <?= App\Common\AttributeType::Length ?>)
                        length = value = parseValue(item.attribute_item_name) ?? 1;
                    else if (attribute.type == <?= App\Common\AttributeType::Diameter ?>)
                        diameter = value = parseValue(item.attribute_item_name) ?? 1;
                    else if (attribute.type == <?= App\Common\AttributeType::Depth ?>)
                        depth = value = parseValue(item.attribute_item_name) ?? 1;
                    else if (attribute.type == <?= App\Common\AttributeType::Pages ?>)
                        pages = value = parseValue(item.attribute_item_name) ?? 1;
                    else
                        continue;

                    sizePrices.push({
                        value: attribute.type == <?= App\Common\AttributeType::Diameter ?> ? value * value : value,
                        additional_fee: parseValue(item.additional_fee) ?? 0,
                        use_percentage: attribute.use_percentage == 1,
                    });
                }
            } else {
                var valueStr = $('#attribute-' + attribute.attribute_id).val();
                var value = parseValue(valueStr) ?? 1;
                if (attribute.value_min > 0 && valueStr != '' && value < attribute.value_min) {
                    $('#attribute-' + attribute.attribute_id).focus();
                    kendo.alert(attribute.label<?= $language_name == 'French' ? '_fr' : '' ?> + '<?= $language_name == 'French' ? ' doit être plus grand que ' : ' should be bigger than ' ?>' + attribute.value_min);
                    return;
                }
                if (attribute.value_max > 0 && valueStr != '' && value > attribute.value_max) {
                    $('#attribute-' + attribute.attribute_id).focus();
                    kendo.alert(attribute.label<?= $language_name == 'French' ? '_fr' : '' ?> + '<?= $language_name == 'French' ? ' doit être inférieur à ' : ' should be less than ' ?>' + attribute.value_max);
                    return;
                }
                if (attribute.use_percentage == 1 || attribute.type == <?= App\Common\AttributeType::Quantity ?>) {
                    var percentage = parseValue(attribute.additional_fee) ?? 0;
                    if (percentage > 0)
                        percentages.push(percentage);
                    // continue;
                }
                if (attribute.type == <?= App\Common\AttributeType::Quantity ?>) {
                    quantity = value;
                    continue;
                }
                // else if (attribute.type == <?= App\Common\AttributeType::Size ?>)
                //     size = parseSize(value);
                else if (attribute.type == <?= App\Common\AttributeType::Width ?>)
                    width = value;
                else if (attribute.type == <?= App\Common\AttributeType::Length ?>)
                    length = value;
                else if (attribute.type == <?= App\Common\AttributeType::Diameter ?>)
                    diameter = value;
                else if (attribute.type == <?= App\Common\AttributeType::Depth ?>)
                    depth = value;
                else if (attribute.type == <?= App\Common\AttributeType::Pages ?>)
                    pages = value;
                else
                    continue;

                sizePrices.push({
                    value: attribute.type == <?= App\Common\AttributeType::Diameter ?> ? value * value : value,
                    additional_fee: (parseValue(attribute.additional_fee) ?? 0) * value,
                    use_percentage: attribute.use_percentage == 1,
                });
            }
        }
        if ($('#custom_size').prop('checked')) {
            var customFields = $('.single-review.custom-field input');
            for (var i = 0; i < customFields.length; i++) {
                var fieldName = $(customFields[i]).attr('data-field');
                if (fieldName === 'width')
                    width = parseValue($(customFields[i]).val()) ?? 1;
                else if (fieldName === 'length')
                    length = parseValue($(customFields[i]).val()) ?? 1;
            }
            sizePrices.push({
                value: width * length,
                additional_fee: 0,
                use_percentage: false,
            });
        }
        console.log(quantity, size, width, length, diameter, depth, pages, sizePrices);

        <?php /* Apply size multiplication */ ?>
        var price = <?= $Product['price'] ?>;
        for (var i = 0; i < attributes.length; i++) {
            var attribute = attributes[i];
            if (attribute.use_percentage == 1)
                continue;
            if ((attribute.type == <?= App\Common\AttributeType::Quantity ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Size ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Width ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Length ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Diameter ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Depth ?>) ||
                (attribute.type == <?= App\Common\AttributeType::Pages ?>))
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
        <?php /* Apply size prices */ ?>
        for (var i = 0; i < sizePrices.length; i++) {
            if (sizePrices[i].use_percentage) {
                if (sizePrices[i].additional_fee != 0 && sizePrices[i].additional_fee > -100) {
                    console.log(price, sizePrices[i].additional_fee);
                    price *= (100 + sizePrices[i].additional_fee) / 100;
                }
            } else {
                if (sizePrices[i].additional_fee != 0) {
                    var copies = 1;
                    for (var j = 0; j < sizePrices.length; j++) {
                        if (j == i)
                            continue;
                        copies *= sizePrices[j].value;
                    }
                    price += sizePrices[i].additional_fee * copies;
                    console.log(price, sizePrices[i].additional_fee * copies);
                }
            }
        }
        <?php /* Apply percentages */ ?>
        for (var i = 0; i < percentages.length; i++) {
            if (percentages[i] > -100)
                price *= (100 + percentages[i]) / 100.0;
        }
        console.log(price);
        $('[name="price"]').val(price * quantity);
        $('#total-price').html((price * quantity * $('#quantity').val()).toFixed(2));
    }
</script>
