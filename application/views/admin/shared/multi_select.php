<?php
    /**
     * @param items (list of [text, value])
     * @param id (optional)
     * @param name
     * @param value (optional, array)
     * @param class (optional)
     * @param index (optional) true => option value will be index of item
     * @param required (optional)
     * @param disabled (optional)
     */
    $id = isset($id) ? $id : $name;
    if (!isset($index))
        $index = false;
?>
<?php if (isset($items)) { ?>
<select class="form-control {{isset($class) ? $class : ''}}" id="<?= $id?>" name="<?= $name?>[]" multiple="multiple" {{isset($required) && $required ? 'required' : ''}} {{isset($disabled) && $disabled ? 'disabled' : ''}}>
    <?php
    foreach ($items as $key => $item) {
        if (is_array($item) && isset($item['text']))
            echo '<option ' . (((isset($value) && in_array($item['value'], $value)) || (isset($item['selected']) && $item['selected'])) ? 'selected="selected"' : '') . ' value="' . ($index ? $key : $item['value']) . '">' . $item['text'] . '</option>';
        elseif (is_array($item) && isset($item['name']))
            echo '<option ' . (((isset($value) && in_array($item['value'], $value)) || (isset($item['selected']) && $item['selected'])) ? 'selected="selected"' : '') . ' value="' . ($index ? $key : $item['value']) . '">' . $item['name'] . '</option>';
        elseif (is_array($item) && isset($item['title']))
            echo '<option ' . (((isset($value) && in_array($item['value'], $value)) || (isset($item['selected']) && $item['selected'])) ? 'selected="selected"' : '') . ' value="' . ($index ? $key : $item['value']) . '">' . $item['title'] . '</option>';
        elseif (is_object($item) && isset($item->name))
            echo '<option ' . (((isset($value) && in_array($item->id, $value)) || (isset($item->selected) && $item->selected)) ? 'selected="selected"' : '') . ' value="' . ($index ? $key : $item->id) . '">' . $item->name . '</option>';
        else
            echo '<option ' . ((isset($value) && in_array($index ? $key : $item, $value)) ? 'selected="selected"' : '') . ' value="' . ($index ? $key : $item) . '">' . $item . '</option>';
   } ?>
</select>
<script>
    $(document).ready(function() {
        $('#<?= name2id($id)?>').kendoMultiSelect({
            select: function (e) {
                var current = this.value();
                if (this.dataSource.view()[e.item.index()].value === "0") {
                    this.value("");
                }
                else if (current.indexOf("0") !== -1) {
                    current = $.grep(current, function (value) {
                        return value !== "0";
                    });

                    this.value(current);
                }
            },
            change: function (e) {
                if (this.value().length === 0)
                    this.value(["0"]);
            }
        });
    });
</script>
<?php } ?>
