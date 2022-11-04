<?php
/**
 * @param data attribute_ids
 */
?>

<?php
foreach ($attribute_ids as $key => $val) {
    if ($key === 'custom') {
        continue;
    }

    if ($language_name == 'French') {
        $attribute_name = $val['attribute_name_french'] ?? $val['attribute_name'];
        $item_name = $val['item_name_french'] ?? $val['item_name'];
    } else {
        $attribute_name = $val['attribute_name'];
        $item_name = $val['item_name'];
    }
    ?>
    <div class="col-md-12 col-lg-6 col-xl-6">
        <span><strong><?=$attribute_name?>: <?=$item_name?></strong></span><br>
    </div>
<?php }?>
<?php
$custom_label = ($language_name == 'French') ? 'Douane' : 'Custom';
foreach ($attribute_ids['custom'] as $val) {
    if ($language_name == 'French') {
        $attribute_name = $val['attribute_name_french'] ?? $val['attribute_name'];
        $item_name = $val['item_name_french'] ?? $val['item_name'];
    } else {
        $attribute_name = $val['attribute_name'];
        $item_name = $val['item_name'];
    }
    ?>
    <div class="col-md-12 col-lg-6 col-xl-6">
        <span><strong><?="$attribute_name ($custom_label)"?>: <?=$item_name?></strong></span><br>
    </div>
<?php }?>