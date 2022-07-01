<?php
    /**
     * @param id (optional)
     * @param name
     * @param value (optional)
     * @param format (optional)
     * @param class (optional)
     * @param placeholder (optional)
     * @param required (optional)
     * @param min (optional)
     * @param max (optional)
     */
    $id = isset($id) ? $id : $name;
?>
<input id="<?=$id?>" name="<?=$name?>" value="<?=isset($value) && $value != null ? date(isset($format) ? $format : 'l, F j, Y g:i:s a', strtotime($value)) : ''?>" class="<?=isset($class) ? $class : ''?>" placeholder="<?=isset($placeholder) ? $placeholder : ''?>" <?=isset($required) && $required ? 'required' : ''?> />
<script>
    $(document).ready(function () {
        $("#<?=str_replace(['[', ']'], ['\\\\[', '\\\\]'], $id)?>").kendoDatePicker({
            //culture: "@System.Globalization.CultureInfo.CurrentCulture.Name"
            parseFormat: "yyyy-MM-dd",
            format: "yyyy-MM-dd",
            <?php if (isset($min)) {?>
                min: new Date('<?=$min?>'),
            <?php }
            if (isset($max)) {?>
                min: new Date('<?=$max?>'),
            <?php } ?>
        });
    });
</script>
