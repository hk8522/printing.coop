<?php
    /**
     * @param id (optional)
     * @param name
     * @param value (optional)
     * @param msg_required (optional)
     * @param class (optional)
     * @param placeholder (optional)
     * @param required (optional)
     * @param min (optional)
     * @param max (optional)
     */
     $id = isset($id) ? $id : $name;
?>
<input data-val="true" <?= (isset($msg_required)) ? "data-val-required=\"$msg_required\"" : '' ?> id="<?= $id ?>" name="<?= $name ?>" type="text" value="<?= isset($value) ? $value : '' ?>" class="<?= isset($class) ? $class : '' ?>" placeholder="<?= isset($placeholder) ? $placehoclder : '' ?>" <?= isset($required) && $required ? 'required' : '' ?> />
<script>
    $(document).ready(function() {
        $('#<?= name2id($id) ?>').kendoNumericTextBox({
            format: "0.############",
            decimals: 12,
            <?php if (isset($min)) { ?>
                min: <?= $min ?>,
            <?php } ?>
            <?php if (isset($max)) { ?>
                max: <?= $max ?>,
            <?php } ?>
        });
    });
</script>
