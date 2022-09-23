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
    <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;">
        <font style="color: #222"><?=$attribute_name?>:</font>
        <?=$item_name?>
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
    <div style="font-size: 14px;color: #666; font-weight: 400; margin: 0px 0px 5px 0px;">
        <font style="color: #222"><?="$attribute_name ($custom_label)"?>:</font>
        <?=$item_name?>
    </div>
<?php }?>