    <?php
	
	$i=2;
	$j=1;
	$k=2;
	$last=1;
	if(!empty($AtirbuteProductSizes)){
		
		$last=$last+count($AtirbuteProductSizes);
	}
	//echo $last;
	if(!empty($options_size)){
				
		    if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			    $onchange="showSizeQuantity()"; 
		    }
			
	        ?>
			<div class="single-review">
				<label><?php 
							if($language_name=='French'){ ?>
							  Taille
							<?php }else{ ?>
							  Size
							<?php 
							}?><span class="required">*</span></label>
				<select name="product_size_id" required onchange="<?php echo $onchange;?>" <?php if($size_disebal){ echo 'disabled';}?> class="multipal_size">
				<?php echo $options_size;?>
				</select>
			</div>
			
			<?php
			$j++;
	        $k++;
	}?>
	<?php
	
	    #pr($AtirbuteProductSizes,1);
		$l=1;
	    foreach($AtirbuteProductSizes as $mkey=>$mval){
			
			if(!empty($product_quantity_id) && !empty($product_size_id)){
				
				$attribute_items=isset($mval['attribute_items']) ? $mval['attribute_items']:array();
				
			}else if(!empty($product_quantity_id) && empty($product_size_id)){
				
				$attribute_items=array();
			}else{
				
				$attribute_items=array();
			}
			
			if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
				
			    $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
			
			$disabled='disabled';
			if(!empty($product_size_id) && $l==1){
				$disabled='';
			}
			
	?>
	    <div class="single-review">
		<label><?php  #pr($mval);
	                echo $language_name=='French' ? $mval['attributes_name_french'] : $mval['attribute_name'];
					?>
	                <span class="required">*</span>
		</label>
					<select name="multiple_attribute_<?php echo $mkey;?>" required id="product_size_option_<?php echo $j?>" required <?php echo $disabled?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
						<?php echo $options;?>
						<?php   foreach($attribute_items as $akey=>$aval){ ?>
						            <option value="<?php echo $akey;?>"><?php 
								     echo $language_name=='French' ? $aval['attributes_item_name_french'] : $aval['attributes_item_name'];
								 
								 ?> </option>  
						<?php   }?>
					</select>
					
	   </div>
    <?php 
            $j++;
	        $k++;
            $l++;			
		}
	?>
