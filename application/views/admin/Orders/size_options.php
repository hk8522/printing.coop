<?php
$i = 1;
$j = 1;
$k = 2;
if (!empty($options_qty)) {
    if ($j == $last) {
        $onchange="getPaperPrice('$i')";
    } else {
        $onchange="getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Quantity <span class="required">*</span></label>
        <select name="product_size_quantity" id="product_size_option_<?= $j?>" required onchange="<?= $onchange?>">
            <?= $options_qty?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($options_ncr_number_parts)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>NCR Number Of Parts <span class="required">*</span></label>
        <select name="product_size_ncr_number_parts" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $options_ncr_number_parts?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($options_paper_size)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
    ?>
    <div class="single-review">
        <label>Paper <span class="required">*</span></label>
        <select name="product_size_paper_size" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $options_paper_size?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($paper_quality)) {
    if ($j==$last) {
        $onchange="getPaperPrice('$i')";
    } else {
        $onchange="getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Paper Quality <span class="required">*</span></label>
        <select name="paper_quality" required id="product_size_option_<?= $j?>" required <?php if ($j > 1) { echo 'disabled';}?> onchange="<?= $onchange?>">
            <?= $paper_quality?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($stock)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Stock <span class="required">*</span></label>
        <select name="stock" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $stock?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($color)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Color <span class="required">*</span></label>
        <select name="color" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $color?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($coating)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Coating <span class="required">*</span></label>
        <select name="coating" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $coating?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($diameter)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Diameter <span class="required">*</span></label>
        <select name="diameter" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $diameter?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($envelope)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Envelope <span class="required">*</span></label>
        <select name="envelope" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $envelope?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}
if (!empty($bundling)) {
    if ($j == $last) {
        $onchange = "getPaperPrice('$i')";
    } else {
        $onchange = "getQuantityPrice('product_size_option_$k')";
    }
?>
    <div class="single-review">
        <label>Bundling <span class="required">*</span></label>
        <select name="bundling" required id="product_size_option_<?= $j?>" required <?= $j > 1 ? 'disabled' : ''?> onchange="<?= $onchange?>">
            <?= $bundling?>
        </select>
    </div>
<?php
    $j++;
    $k++;
}?>
<script>
    function getQuantityPrice(nid, product_id_key) {
        $('#loader-img').show();
        $('.new-price-img').hide();
        var myForm = document.getElementById('cartForm-' + product_id_key);
        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>admin/Orders/calculatePrice',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#loader-img').hide();
                $('.new-price-img').show();

                var json = JSON.parse(data);
                if (json.success == 1) {
                    $('#' + nid).attr("disabled", false);

                    $('#total-price-' + product_id_key).html(json.price);
                }
            }
        });
    }

    function getPaperPrice(nid,product_id_key) {
        $('#loader-img').show();
        $('.new-price-img').hide();

        var myForm = document.getElementById('cartForm-' + product_id_key);

        var formData = new FormData(myForm);
        $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?= $BASE_URL?>admin/Orders/calculatePrice',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $('#loader-img').hide();
                $('.new-price-img').show();

                var json = JSON.parse(data);
                if (json.success == 1) {
                    $('#attribute_id_' + nid).attr("disabled", false);

                    $('#total-price-' + product_id_key).html(json.price);
                }
            }
        });
    }
</script>
