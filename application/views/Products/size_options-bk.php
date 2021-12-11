    <?php
	$i=2;
	?>
	<?php 
	$j=1;
	$k=2;
	?>
	<?php   //echo $language_name;
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
	   if(!empty($product_size_id)){
		   $j=2;
           $k=3;		   
	   }else{
		   
		 $j++;
         $k++;  
	   }
	  
	}?>
	<?php if(!empty($paper_quality)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  Qualité du papier
	                <?php }else{ ?>
	                  Paper Quality
	                <?php 
	                }?> <span class="required">*</span></label>
		<select name="paper_quality" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
			<?php echo $paper_quality;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($options_ncr_number_parts)){ 

            if($j==$last){
				
                $onchange="getPaperPrice('$i')"; 
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }	
	?>
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  NCR Nombre de pièces 
	                <?php }else{ ?>
	                  NCR Number Of Parts 
	                <?php 
	                }?><span class="required">*</span></label>
		<select name="product_size_ncr_number_parts" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange;?>" class="multipal_size multipal_size_item">
		<?php echo $options_ncr_number_parts;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	<?php if(!empty($stock)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  Contexte
	                <?php }else{ ?>
	                  Background
	                <?php 
	                }?> <span class="required">*</span></label>
		<select name="stock" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
			<?php echo $stock;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($color)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  Couleur imprimée
	                <?php }else{ ?>
	                  Printed Color
	                <?php 
	                }?> <span class="required">*</span></label>
		<select name="color" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
			<?php echo $color;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	<?php if(!empty($diameter)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  Diamètre
	                <?php }else{ ?>
	                  Diameter
	                <?php 
	                }?> <span class="required">*</span></label>
		<select name="diameter" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
			<?php echo $diameter;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($shape_paper)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  enrobage
	                <?php }else{ ?>
	                  Coating
	                <?php 
	                }?><span class="required">*</span></label>
		<select name="shape_paper" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
			<?php echo $shape_paper;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($grommets)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label><?php 
	                if($language_name=='French'){ ?>
	                  Grommets
	                <?php }else{ ?>
	                  Grommets
	                <?php 
	                }?><span class="required">*</span></label>
		<select name="grommets" required id="product_size_option_<?php echo $j?>" required <?php if($j > 2){ echo 'disabled';}?> onchange="<?php echo $onchange?>" class="multipal_size multipal_size_item">
			<?php echo $grommets;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	

	
	
