<div class="eco-search-section">
    <div class="container">
        <form action="<?php echo $BASEURL?>Products" method="get">
            <input type="hidden" name="category_id" value="<?php echo base64_encode('13')?>">
            <div class="ecosearch-inner">
                <span>Ink & Toner Finder</span>
                <div class="ecosearch-select-single">
                    <span>1.</span>
                    <select name="printer_brand" required id="printer_brand" onchange="PrinterSeries($(this).val())">
                        <option value=""><?php echo $language_name =='French' ? "Sélectionnez une marque d'imprimante":'Select a Printer Brand'; ?></option>
                        <?php
                        foreach($PrinterBrandsLists as $key=>$val){
                            $name= $language_name =='French' ? $val['name_french']:$val['name'];
                        ?>
                          <option value="<?php echo $name?>"><?php echo $name;?></option>
                        <?php
                        }?>
                    </select>
                </div>
                <div class="ecosearch-select-single">
                    <span>2.</span>
                    <select name="printer_series" id="printer_series" onchange="PrinterModel($(this).val())">
                        <option value=""> <?php echo $language_name =='French' ? "Sélectionnez une série d'imprimantes":'Select a Printer Series'; ?></option>
                    </select>
                </div>
                <div class="ecosearch-select-single">
                    <span>3.</span>
                    <select name="printer_models" id="printer_models">
                        <option value=""> <?php echo $language_name =='French' ? "Sélectionnez un modèle d'imprimante":'Select a Printer Model'; ?></option>

                    </select>
                </div>
                <button type="submit">Submit</button>
            </div>
        </form>
    </div>
</div>
