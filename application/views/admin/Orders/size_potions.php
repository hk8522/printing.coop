    <?php 
	$i=1;
	?>
	<?php 
	$j=1;
	$k=2;
	?>
	<?php if(!empty($options_qty)){
		
		    if($j==$last){
				
                $onchange="getPaperPrice('$i')"; 
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }	
	?>
	<div class="single-review">
		<label>Quantity <span class="required">*</span></label>
		<select name="product_size_quantity"  id="product_size_option_<?php echo $j?>" required onchange="<?php echo $onchange;?>">
		<?php echo $options_qty;?>
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
		<label>NCR Number Of Parts <span class="required">*</span></label>
		<select name="product_size_ncr_number_parts" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange;?>">
		<?php echo $options_ncr_number_parts;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($options_paper_size)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label>Paper <span class="required">*</span></label>
		<select name="product_size_paper_size" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $options_paper_size;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($paper_quality)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label>Paper Quality <span class="required">*</span></label>
		<select name="paper_quality" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $paper_quality;?>
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
		<label>Stock <span class="required">*</span></label>
		<select name="stock" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
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
		<label>Color <span class="required">*</span></label>
		<select name="color" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $color;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($coating)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label>Coating <span class="required">*</span></label>
		<select name="coating" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $coating;?>
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
		<label>Diameter <span class="required">*</span></label>
		<select name="diameter" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $diameter;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($envelope)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label>Envelope <span class="required">*</span></label>
		<select name="envelope" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $envelope;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	<?php if(!empty($bundling)){
		
	        if($j==$last){
				
                $onchange="getPaperPrice('$i')";
				
		    }else{
			     $onchange="getQuantityPrice('product_size_option_$k')"; 
		    }
	?>
	<div class="single-review">
		<label>Bundling <span class="required">*</span></label>
		<select name="bundling" required id="product_size_option_<?php echo $j?>" required <?php if($j > 1){ echo 'disabled';}?> onchange="<?php echo $onchange?>">
			<?php echo $bundling;?>
		</select>
	</div>
	<?php 
	   $j++;
	   $k++;
	}?>
	
	
