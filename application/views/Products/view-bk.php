<style>
color: #303030;
font-size: 14px;
font-weight: 600;
display: block;
line-height: 28px;
width: 100%;
overflow: hidden;
</style>
<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
			   <?php 
			if($language_name=='French'){
				
			   $multipalCategoryData=$Product['multipalCategoryData'];	
			 
				
			?>
                <a href="<?php echo $BASE_URL;?>">Accueil</a>
				<?php if(!empty($Product['category_name_french'])){?>
				/
				<a href="<?php echo $BASE_URL;?>Products/?category_id=<?php echo base64_encode($Product['category_id'])?>"><?php echo $Product['category_name_french'];?></a>
				<?php 
				}?>
				<?php if(!empty($Product['sub_category_name_french'])){?>
				/
				<a href="<?php echo $BASE_URL;?>Products/?category_id=<?php echo base64_encode($Product['category_id'])?>&sub_category_id=<?php echo base64_encode($Product['sub_category_id'])?>"><?php echo $Product['sub_category_name_french'];?></a>
				<?php 
				}?>
                /<span class="current"><?php echo $Product['name_french'] ?></span>
				
			<?php }else{ ?>
				
				<a href="<?php echo $BASE_URL;?>">Home</a>
				<?php if(!empty($Product['category_name'])){?>
				/
				<a href="<?php echo $BASE_URL;?>Products/?category_id=<?php echo base64_encode($Product['category_id'])?>"><?php echo $Product['category_name'];?></a>
				<?php 
				}?>
				<?php if(!empty($Product['sub_category_name'])){?>
				/
				<a href="<?php echo $BASE_URL;?>Products/?category_id=<?php echo base64_encode($Product['category_id'])?>&sub_category_id=<?php echo base64_encode($Product['sub_category_id'])?>"><?php echo $Product['sub_category_name'];?></a>
				<?php 
				}?>
                /<span class="current"><?php echo $Product['name'] ?></span>
				
			<?php 
			}?>	
            </div>
        </div>
    </div>
</div>
<div class="shop-single-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="shop-single-section-inner">
            <div class="row">
                <div class="col-md-5 col-lg-6 col-xl-6">
                      <div class="swiper-container-gallery-top">
                          <div class="swiper-wrapper">
                             <?php foreach ($ProductImages as $key => $ProductImage) {
                              
                          ?>
                            <div class="swiper-slide">
                                <div class="shop-product-img">
                                    <img src="<?php echo getProductImage($ProductImage['image'],'large'); ?>">
                                </div>
                            </div>
                            <?php
                          }
                        ?>
                          </div>
                          <!-- Slider Arrow -->
						  <?php if(count($ProductImages) > 1){?>
                          <div class="swiper-button-next"></div>
                          <div class="swiper-button-prev"></div>
						  <?php 
						  }?>
                      </div>                        
                      <div class="product-sample-image">
                        <div class="swiper-container-gallery-thumbs">
                          <div class="swiper-wrapper">
                              <?php foreach ($ProductImages as $key => $ProductImage) {
                              
                          ?>
                            <div class="swiper-slide">
                                    <div class="latest-single-product">
                                      <div class="latest-product-img">
                                        <img src="<?php echo getProductImage($ProductImage['image']); ?>">
                                      </div>
                                    </div>
                            </div>
                            <?php
                          }
                        ?>
                          </div>
                          <div class="swiper-pagination"></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 col-lg-6 col-xl-6">
                    <div class="shop-product-detail-section">
                        <div class="shop-product-detail">
                            <span><?php echo $language_name=='French' ? $Product['name_french'] :$Product['name'];?></span>
                            <div class="wishlist-area">
                              <a data-toggle="tooltip" title="Add to wishlist" href="javascript:void(0)" onclick="addProductWishList('<?php echo $Product['id']?>')">
                                  <i class="la la-heart-o"></i>
                              </a>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-8">
                                <?php //if(!empty($Product['category_name']) ){
								$multipalCategoryData=$Product['multipalCategoryData'];	
								?>
                                <div class="shop-category">
                                    <span><?php 
							                if($language_name=='French'){ ?>
							                  Catégorie
							                <?php }else{ ?>
							                  Category
							                <?php 
							                }?> : 
									<?php foreach($multipalCategoryData as $key=>$val){?>
									<font><?php echo $language_name=='French' ? $val['name_french'] :$val['name'];?></font>
									<?php }?>
									</span>
                                </div>
        						<?php //}?>
                            </div>
                            <div class="col-md-4 text-right">
                                <div class="shop-category">
                                    <span><?php 
							                if($language_name=='French'){ ?>
							                  Disponibilité
							                <?php }else{ ?>
							                  Availability
							                <?php 
							                }?> : <font> 
											<?php 
											if($language_name=='French'){
											echo (empty($Product['is_stock'])) ? 'En Stock' : 'En rupture de stock';
											}else{
												
												echo (empty($Product['is_stock'])) ? 'In Stock' : 'Out of Stock';
											}
											?> 
											</font></span>
                                </div>
                            </div>
                        </div>
                        <div class="universal-dark-info">
                            <span><?php echo $language_name=='French' ? $Product['short_description_french'] :$Product['short_description'];?></span>
                        </div>
                        <?php
						    $product_id=$Product['id'];
							
							$buyNow = checkBuyNowProduct($Product['is_stock'],$Product['total_stock']);
							
                          if ($buyNow) { ?>
						    <form method="post" id="cardFrom">
							
							 <input type="hidden" id="product_id" value="<?php echo $Product['id']?>" name="product_id">
                             <input type="hidden" id="product_price" value="<?php echo $Product[$product_price_currency]?>" name="price">							
                             <div class="product-fields">
                                <div class="row">
                                    <div class="col-md-12 col-md-12 col-md-8">
									<input type="hidden" name="add_length_width" value="<?php echo $Product['add_length_width'];?>">
									<input type="hidden" name="length_width_quantity_show" value="<?php echo $Product['length_width_quantity_show'];?>">
									<input type="hidden" name="page_add_length_width" value="<?php echo $Product['page_add_length_width'];?>">
									<input type="hidden" name="page_length_width_pages_show" value="<?php echo $Product['page_length_width_pages_show'];?>">
									<input type="hidden" name="page_length_width_quantity_show" value="<?php echo $Product['page_length_width_quantity_show'];?>">
									
									<input type="hidden" name="depth_add_length_width" value="<?php echo $Product['depth_add_length_width'];?>">
									<input type="hidden" name="depth_width_length_quantity_show" value="<?php echo $Product['depth_width_length_quantity_show'];?>">
									
									
									<?php
									if($Product['add_length_width']==1){
										
									?> 
									  
						             <div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Longueur (pouces)
							                <?php }else{ ?>
							                  Length (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
										<input type="text" name="product_length" id="product_length" required value="0" onkeypress="javascript:return isNumber(event)">
										<span style="color:red" id="product_length_error"><span>
									</div>
									
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Largeur (pouces)
							                <?php }else{ ?>
							                  Width (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
									    <input type="text" name="product_width" id="product_width" required value="0" onkeypress="javascript:return isNumber(event)" ><span style="color:red" id="product_width_error"><span>        
									</div>
									<?php if($Product['length_width_color_show']==1){?>	
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Couleurs
							                <?php }else{ ?>
							                  Colors
							                <?php 
							                }?> 
<span class="required">*</span></label>
										
									    <select name="length_width_color" id="length_width_color" required>
										
										<option value=""><?php echo $language_name=='French'?'Sélectionnez la couleur':'Select Color';?> 
                                        </option>
										<option value="black">
										 <?php echo $language_name=='French'?'Noire':'Black';?></option>
										<option value="color">
								       <?php echo $language_name=='French'?'Couleur':'Color';?></option>
										</select>
										<span>        
									</div>
									<?php 
									}?>	
									
							<?php if($Product['length_width_quantity_show']==1){?>		
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Quantité
							                <?php }else{ ?>
							                  Quantity
							                <?php 
							                }?><span class="required">*</span></label>
									    <?php //if($Product['length_width_pages_type']=='input'){?>
										<input type="number" name="product_total_page" id="product_total_page" required  onkeypress="javascript:return isNumber(event)" value="<?php echo $Product['length_width_min_quantity']?>" onkeypress="javascript:return isNumber(event)">
										
										<?php //}else{?>
										   <!--<select name="product_total_page" required id="product_total_page">
										   <option value="">
										   Select Quantity
										   </option>
										   <?php foreach($quantity as $val){ ?>
										   <option value="<?php echo $val;?>">
										    <?php echo $val;?>
										   </option>
										   <?php }?>
                                           </select>-->
										   
										<?php 
										//}?>
										<span style="color:red" 
					id="product_total_page_error"><span>        
									</div>
									<?php
									}?>
				                    <!--<label> <?php echo $Product['min_length']?> X <?php echo $Product['min_width']?> Inch Price :<span class="required"><?php echo $product_price_currency_symbol.number_format($Product['min_lenght_min_width_price'],2)?></span></label>-->
									            
									
									
									<?php 
									}?>
									
									
								    <?php	
									 if($Product['page_add_length_width']==1){
									?> 
									  
						             <div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Longueur de page (pouces)
							                <?php }else{ ?>
							                  Page Length (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
										<input type="text" name="page_product_length" id="page_product_length" required value="0" onkeypress="javascript:return isNumber(event)">
										<span style="color:red" id="page_product_length_error"><span>
									</div>
									
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Largeur de page (pouces)
							                <?php }else{ ?>
							                  Page Width (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
									    <input type="text" name="page_product_width" id="page_product_width" required value="0" onkeypress="javascript:return isNumber(event)" ><span style="color:red" id="page_product_width_error"><span>        
									</div>
								<?php if($Product['page_length_width_color_show']==1){?>	
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Couleurs
							                <?php }else{ ?>
							                  Colors
							                <?php 
							                }?> 
<span class="required">*</span></label>
										
									    <select name="page_length_width_color" required id="page_length_width_color">
										<option value=""><?php echo $language_name=='French'?'Sélectionnez la couleur':'Select Color';?>
                                        </option>
										<option value="black">
										 <?php echo $language_name=='French'?'Noire':'Black';?></option>
										<option value="color">
								       <?php echo $language_name=='French'?'Couleur':'Color';?></option>
										</select>
										
										<span>        
									</div>
								<?php 
								}?>
									
								<?php if($Product['page_length_width_pages_show']==1){?>
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                 Des pages
							                <?php }else{ ?>
							                  Pages
							                <?php 
							                }?><span class="required">*</span></label>
										<?php if($Product['page_length_width_pages_type']=='input'){?>
									    <input type="text" name="page_product_total_page" id="page_product_total_page" required value="1" onkeypress="javascript:return isNumber(event)" >
										<?php }else{?>
										 <select name="page_product_total_page" required id="page_product_total_page">
										 	<?php 
							                if($language_name=='French'){ ?>
							                  <option value="">
										   Sélectionner des pages
										   </option>
										   
							                <?php }else{ ?>
							                  <option value="">
										   Select Pages
										   </option>
							                <?php 
							                }?>
										   
										   <?php foreach($ProductPages as $Pages){?>
										   <option value="<?php echo $Pages['total_page'].'-'.$Pages['name'];?>-<?php echo $Pages['name_french'];?>">
										    <?php 
											if($language_name=='French'){
												
											   echo $Pages['name_french'];
											}else{
												echo $Pages['name'];
											}?>
										   </option>
										   <?php }?>
                                           </select>
										<?php }?>
										<span style="color:red" id="page_product_total_page_error"><span>        
									</div>
									<?php 
									}?>
									
									<?php if($Product['page_length_width_quantity_show']==1){?>		
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Quantité
							                <?php }else{ ?>
							                  Quantity
							                <?php 
							                }?><span class="required">*</span></label>
									  
			<input type="text" name="page_product_total_quantity" id="page_product_total_quantity" required  onkeypress="javascript:return isNumber(event)" value="0">
										<span style="color:red" 
					id="page_product_total_quantity_error"><span>        
									</div>
									<?php
									}?>
				                    <!--<label> <?php echo $Product['page_min_length']?> X <?php echo $Product['page_min_width']?> Inch Price :<span class="required"><?php echo $product_price_currency_symbol.number_format($Product['page_min_lenght_min_width_price'],2)?></span></label>-->
									            
									
									<?php 
									}?>
									
									<?php
									if($Product['depth_add_length_width']==1){
										
									?> 
									  
						             <div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Longueur (pouces)
							                <?php }else{ ?>
							                  Length (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
										<input type="text" name="product_depth_length" id="product_depth_length" required value="0" onkeypress="javascript:return isNumber(event)">
										<span style="color:red" id="product_depth_length_error"><span>
									</div>
									
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Largeur (pouces)
							                <?php }else{ ?>
							                  Width (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
									    <input type="text" name="product_depth_width" id="product_depth_width" required value="0" onkeypress="javascript:return isNumber(event)" ><span style="color:red" id="product_depth_width_error"><span>        
									</div>
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Profondeur (pouces)
							                <?php }else{ ?>
							                  Depth (Inch)
							                <?php 
							                }?>  <span class="required">*</span></label>
									    <input type="text" name="product_depth" id="product_depth" required value="0" onkeypress="javascript:return isNumber(event)" ><span style="color:red" id="product_depth_error"><span>        
									</div>
									<?php if($Product['depth_color_show']==1){?>	
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Couleurs
							                <?php }else{ ?>
							                  Colors
							                <?php 
							                }?><span class="required">*</span></label>
										
									    <select name="depth_color"  id ="depth_color" required>
										<option value=""> <?php echo $language_name=='French'?'Sélectionnez la couleur':'Select Color';?></option>
										
										<option value="black">
										 <?php echo $language_name=='French'?'Noire':'Black';?></option>
										<option value="color">
								       <?php echo $language_name=='French'?'Couleur':'Color';?></option>
										</select>
										<span>        
									</div>
									<?php 
									}?>	
							<?php if($Product['depth_width_length_quantity_show']==1){?>		
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Quantité
							                <?php }else{ ?>
							                  Quantity
							                <?php 
							                }?><span class="required">*</span></label>
									    <?php /*if($Product['depth_width_length_type']=='input'){*/?>
										<input type="number" name="product_depth_total_page" id="product_depth_total_page" required value="<?php echo $Product['depth_min_quantity']?>" onkeypress="javascript:return isNumber(event)" >
										<?php //}else{?>
										   <!--<select name="product_depth_total_page" required id="product_depth_total_page">
										   <option value="">
										   Select Quantity
										   </option>
										   <?php foreach($quantity as $val){ ?>
										   <option value="<?php echo $val;?>">
										    <?php echo $val;?>
										   </option>
										   <?php }?>
                                           </select>-->
										   
										<?php 
										//}?>
										<span style="color:red" 
					id="product_depth_total_page_error"><span>        
									</div>
									<?php
									}?>
									<?php 
									}?>
								    <?php 
									
									$i=1;
									
									//pr($ProductSizes);
									
									if(!empty($ProductSizes)){
									$i=2;	
									?>
										
										   <div class="single-review">
												<label><?php 
							                if($language_name=='French'){ ?>
							                  Quantité
							                <?php }else{ ?>
							                  Quantity
							                <?php 
							                }?><span class="required">*</span></label>
												<select name="product_quantity_id" required id="product_quantity_id" onchange="showQuenty()">
										        <option value=""><?php echo $language_name=='French'?'Choisis une option...':'Choose an option...';?></option>
												
			        <?php 
					
				    foreach($ProductSizes as $key=>$val){
						
						
						$qty_name='';
						$qty_extra_price='';
						$qty_name = $language_name=='French' ? $val['qty_name_french']:$val['qty_name'];    	
				    ?>
														      <option value='<?php echo $key;?>'>
	<?php echo $qty_name.$qty_extra_price?>
															  </option>
													    <?php 
														}
					
					?>
												</select>
												
											</div>
											
										<div id="SiZeOPrions">
										
											
										</div>
									 <?php 
									 
										
									 }?>
									 
									 
									 
								    <?php 
									//pr($ProductAttributes,1);
									foreach($ProductAttributes as $key=>$val){
                                    
									    $items=$val['items'];
																				
									?>
										
											<div class="single-review">
												<label>
									<?php echo $language_name=='French' ? $val['data']['attribute_name_french']:$val['data']['attribute_name'];
												?><span class="required">*</span></label>
												<?php $items=$val['items'];?>
												<?php 
												   if(!empty($items)){ 
												   ?>
													<select name="attribute_id_<?php echo $key;?>" required <?php if($i > 1){echo 'disabled';}?> onchange="showAttribute(<?php echo $i?>,'<?php echo $i+1;?>')" id="attribute_id_<?php echo $i;?>">
														<option value=""><?php echo $language_name=='French' ? 'Choisis une option...':'Choose an option...'?> </option>
														<?php foreach($items as $subkey=>$subval){
	$extra_price='';														
    if(!empty($subval['extra_price']) && $subval['extra_price'] !='0.00'){
		//$extra_price=" (+ ".$product_price_currency_symbol.$subval['extra_price'].")";
	}														
?>
														      <option value="<?php echo $subval['attribute_item_id']?>">
															  <?php echo $language_name=='French' ? $subval['item_name_french'].$extra_price:$subval['item_name'].$extra_price;?>
															  </option>
													    <?php 
														}?>
													</select>
													
												<?php
												 $i++;
												}?>
											</div>
										
									 <?php 
										
									 }?>
									
								   <?php  
								    if($Product['recto_verso']==1){
									?> 
									<div class="single-review">
									<label><?php 
							                if($language_name=='French'){ ?>
							                  Recto verso
							                <?php }else{ ?>
							                  Recto/Verso
							                <?php 
							                }?> <span class="required">*</span></label>
									<select name="recto_verso" required id="attribute_id_<?php echo $i;?>" <?php if($i > 1){echo 'disabled';}?> 
									onchange="showAttribute(<?php echo $i?>,'<?php echo $i+1;?>')">
										<option value=""><?php echo $language_name=='French' ? 'Choisis une option...':'Choose an option...'?></option>
										<option value="Yes"><?php echo $language_name=='French' ? 'Oui':'Yes'?></option>
										<option value="No"><?php echo $language_name=='French' ? 'Non':'No'?></option>
									</select>
									<!--<span>Recto/verso will add <?php echo $Product['recto_verso_price'];?>% more to the price</span>-->
									</div>
									 <input type="hidden" name="recto_verso_price" value="<?php echo $Product['recto_verso_price'];?>">
									<?php 
									}?>	
								    <?php	
									if($Product['votre_text']==1){
									?>
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Votre TEXTE - Votre TEXTE
							                <?php }else{ ?>
							                  Your TEXT - Votre TEXT
							                <?php 
							                }?> <span class="required">*</span></label>
									    <input type="text" name="votre_text" id="votre_text" required value="" >       
									</div>
							        <?php 
									}?>
									
									<?php	
									if($Product['call']==1){
									?>
									<div class="single-review">
										<label><?php 
							                if($language_name=='French'){ ?>
							                  Appel
							                <?php }else{ ?>
							                  Call
							                <?php 
							                }?><span class="required"></span></label>
									    <label>
										<?php echo $Product['phone_number'];
										?><span class="required"></span>
										</label>       
									</div>
							        <?php 
									}?>
							
                   </div>
                                </div>
                            </div>
							
                            <div class="set-price-area">
                                <div class="row align-items-center">
                                    <div class="col-6 col-md-6">
                                        <div class="shop-product-price">
                                            <span>
											  <img src="<?php echo $BASE_URL?>/assets/images/loder.gif" width="30" style="display:none" id="loder-img"> 
                                              <font class="new-price">
											  <?php
                                           
		echo $product_price_currency_symbol.'<span id="total-price">'.$Product[$product_price_currency].'</span>'?>
											  </font>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-6 col-md-6">
                                        <div class="quant-cart">
                                            <label><?php 
							                if($language_name=='French'){ ?>
							                  Combien d'ensembles
							                <?php }else{ ?>
							                  How many sets
							                <?php 
							                }?> </label>
                                            <input type="text" value="1" id="quenty" name="quenty"  onkeypress="javascript:return isNumber(event)" onchange="setQuenty()">
                                        </div>
                                    </div>
                                </div>
                            </div>
							
							
                            <div class="file-upload-section">
                                <div class="file-upload-area">
								    <input type="file" name="file" id="file" style="display:none">
                                     <span class="info-span"><?php 
							                if($language_name=='French'){ ?>
							                  Soumettre et télécharger le fichier (Taille autorisée par fichier: 30 Mo. Autoriser le type de fichier: jpeg, png, jpg)
							                <?php }else{ ?>
							                  Submit and Upload File (Allow size per file: 30 Mb. Allow file type:jpeg,png,jpg)
							                <?php 
							                }?></span>
                                     <div class="upload-file upload-area" id="uploadfile">
									 
                                        <span class="file-btn"><?php 
							                if($language_name=='French'){ ?>
							                  Soumettre le téléchargement
							                <?php }else{ ?>
							                 Submit Upload
							                <?php 
							                }?></span>
										
                                        <span id="file-drop"><?php 
							                if($language_name=='French'){ ?>
							                  Glisser-déposer des fichiers
							                <?php }else{ ?>
							                  Drag & Drop Files
							                <?php 
							                }?></span>
                                    </div>
                                </div>
								
                                <div class="uploaded-file-detail" id="upload-file-data">
								    <?php if(isset($_SESSION['product_id'][$Product['id']])){
										
										       $file_data=$_SESSION['product_id'][$Product['id']];
											   #pr($file_data);
											   foreach($file_data as $key=>$return_arr){
												    #pr($return_arr);
											    
                                     ?>
									            
									   <div class="uploaded-file-single" id="teb-<?php echo $return_arr['skey']?>">
											<div class="uploaded-file-single-inner">
												<div class="uploaded-file-img" style="background-image: url(<?php echo $return_arr['src']?>)"></div>
												<div class="uploaded-file-info">
													<div class="row align-items-center">
														<div class="col-md-7">
															<div class="uploaded-file-name"><span><?php echo $return_arr['name']?></span></div>
														</div>
														<div class="col-md-5">
															<div class="upload-action-btn">
																<button type="button" onclick="update_cumment('<?php echo $return_arr['skey']?>')" id="smc-<?php echo $return_arr['skey']?>"><?php 
							                if($language_name=='French'){ ?>
							                  Note de mise à jour
							                <?php }else{ ?>
							                 Update Note
							                <?php 
							                }?></button>
																<button type="button" title="Delete" onclick="delete_image('<?php echo $return_arr['skey']?>')" id="smd-<?php echo $return_arr['skey']?>"><i class="las la-trash"></i></button>
																<input type="hidden" value="<?php echo $return_arr['location'];?>" id="location-<?php echo $return_arr['skey']?>">
															</div>
														</div>
													</div>
													<div class="upload-field">
														<textarea id="cumment-<?php echo $return_arr['skey']?>"><?php echo $return_arr['cumment']?></textarea>
													</div>
												</div>
											</div>
										</div>
                                    <?php 
											
											   }	   
											   
									     }
										 
									?>
                                </div>
                            </div>
                            <div class="quant-cart">
                                <input type="hidden" id="<?php echo $Product['id']?>-rowid" value="<?php echo $productRowid?>">
                                <input type="hidden" id="<?php echo $Product['id']?>-Productid">
								
                                <button class="cart-adder" type="submit" id="btnsubmit">
									<span><?php 
							                if($language_name=='French'){ ?>
							                  Ajouter au chariot
							                <?php }else{ ?>
							                  Add to Cart
							                <?php 
							                }?></span>
                                </button>
                            </div>
							
							</form>
                          <?php
                        }
                        ?>
					  	
                    </div>
                </div>
            </div>
        </div>
        <div class="shop-single-elements">
            <div class="featured-tabs tab">
                <button class="tablinks active" id="defaultOpen" onclick="openCity(event, 'Description')"><?php 
							                if($language_name=='French'){ ?>
							                  La description
							                <?php }else{ ?>
							                  Description
							                <?php 
							                }?></button>
				<?php 
				
				if(!empty($ProductDescriptions)){
					
					foreach($ProductDescriptions as $key=>$val){
				?>	
				    <button class="tablinks" id="defaultOpen<?php echo $val['id'];?>" onclick="openCity(event, 'Description<?php echo $val['id']?>')"><?php echo $language_name=='French' ? $val['title_french']:$val['title'];?></button>  
				<?php 
					}
				}?>
				<?php if(!empty($ProductTemplates)){?>
				<button class="tablinks" id="defaultOpen-Template" onclick="openCity(event, 'template')"><?php 
							                if($language_name=='French'){ ?>
							                  Modèles
							                <?php }else{ ?>
							                  Templates
							                <?php 
							                }?></button>
				<?php }?>
                <!--<button class="tablinks" onclick="openCity(event, 'Reviews')">Reviews (<?php echo count($ratings) ?>)</button>-->
            </div>
            <div class="featured-tab-output">
                <div id="Description" class="tabcontent">
                    <div class="tabcontent-inner">
                        <div class="universal-dark-title">
                            <span><?php 
							                if($language_name=='French'){ ?>
							                  La description
							                <?php }else{ ?>
							                  Description
							                <?php 
							                }?></span>
                        </div>
                        <div class="universal-dark-info">
                            <span>
							
							<?php echo $language_name=='French' ? $Product['full_description_french']:$Product['full_description']; ?>
							
							</span>
                        </div>
                    </div>
                </div>
				<?php
				if(!empty($ProductDescriptions)){
					foreach($ProductDescriptions as $key=>$val){
				?>	
				    <div id="Description<?php echo $val['id']?>" class="tabcontent" style="display:none">
                    <div class="tabcontent-inner">
                        <div class="universal-dark-title">
                            <span><?php 
							
							echo $language_name=='French' ? $val['title_french']:$val['title'];
							?></span>
                        </div>
                        <div class="universal-dark-info">
                            <span><?php 
							
							echo $language_name=='French' ? $val['description_french']:$val['description'];
							?></span>
                        </div>
                    </div>
                    </div> 
				<?php 
					}
				}?>
				
				<?php
				if(!empty($ProductTemplates)){
					
				?>	
				    <div id="template" class="tabcontent" style="display:none">
                    <div class="tabcontent-inner">
                        <div class="universal-dark-title">
                            <span><?php 
							                if($language_name=='French'){ ?>
							                  Modèles
							                <?php }else{ ?>
							                  Template
							                <?php 
							                }?></span>
                        </div>
						
                        <div class="universal-dark-info">
							<table class="table table-striped">
								<thead>
									<tr>
										<th scope="col"><?php 
							                if($language_name=='French'){ ?>
							                  Dimensions finales
							                <?php }else{ ?>
							                  Final Dimensions
							                <?php 
							                }?></th>
										<th scope="col"><?php 
							                if($language_name=='French'){ ?>
							                  La description
							                <?php }else{ ?>
							                  Description
							                <?php 
							                }?></th>
										<th scope="col"><?php 
							                if($language_name=='French'){ ?>
							                  Télécharger
							                <?php }else{ ?>
							                  Download
							                <?php 
							                }?></th>
									</tr>
								</thead>
							<tbody>
							<?php 
						    foreach($ProductTemplates as $key=>$val){
						    ?>	
							<tr>
								
								<td><?php
                                echo $language_name=='French' ? $val['final_dimensions_french']:$val['final_dimensions']; 								
								?></td>
								<td><?php 
								echo $language_name=='French' ? $val['template_description_french']:$val['template_description'];
								?></td>
								<td>
							    <?php 	
								$link=$BASE_URL."Products/download/".urlencode(TEMPLATE_FILE_BASE_PATH.$val['template_file'])."/".urlencode($val['template_file']);
								?>
								<a href="<?php echo $link;?>">
								<i class="fa fa-download" aria-hidden="true"></i>
								</a>
</td>
							</tr>
                            <?php 
						     }?>
							</tbody>
							</table>


                        </div>
						
                    </div>
                    </div> 
				<?php
				}?>
				
				
                <!--<div id="Reviews" class="tabcontent">
                    <div class="tabcontent-inner">
                      <?php
                        if (count($ratings)) {
                          ?>
                          <div class="universal-dark-title">
                            <span>Reviews</span>
                          </div>
                          <?php
                        }
                      ?>
                        <?php
                            foreach ($ratings as $key => $rating) {
                              ?>
                              <div class="single-review-display">
                                  <div class="row">
                                      <div class="col-6 col-sm-6 col-md-6">
                                          <div class="review-person">
                                              <span><?php echo $rating['name'];?></span>
                                              <span class="review-person-time"><?php echo dateFormate($rating['created'])?></span>
                                          </div>
                                      </div>
                                      <div class="col-6 col-sm-6 col-md-6">
                                          <div class="star-given-review">
                                              <span>
                                                  <?php echo getRate($rating['rate']);?>
                                              </span>
                                          </div>
                                      </div>
                                  </div>
                                  <div class="review-text-box-section">
                                        <span><?php echo $rating['review']?></span>
                                  </div>
                              </div>
                              <?php
                            }
                        ?>
                        <?php
                            if ($loginId) {
                              ?>
                              <div class="write-review">
                                <div class="tabcontent-inner-title">
                                    <span>Share your views with other customers</span>
                                </div>
                                <div class="tabcontent-inner-info">
                                  <span>Your email address will not be published. Required fields are marked *</span>
                                </div>
                                <div class="review-form">
                                    <form id="ratting-form" method="post">
                                      <input type="hidden" name="product_id"  id="product_id" value="<?php echo $Product['id'];?>">
                                      <div class="row">
                                        <div class="col-md-12">
                                          <div class="single-review">
                                            <label>Your Rating</label>
                                            <div class="rating set-rating">
                                              <div class="rate">
                                                <input type="radio" id="star5" name="rate" value="5" />
                                                <label for="star5" title="text"></label>
                                                <input type="radio" id="star4" name="rate" value="4" />
                                                <label for="star4" title="text"></label>
                                                <input type="radio" id="star3" name="rate" value="3" />
                                                <label for="star3" title="text"></label>
                                                <input type="radio" id="star2" name="rate" value="2" />
                                                <label for="star2" title="text"></label>
                                                <input type="radio" id="star1" name="rate" value="1" />
                                                <label for="star1" title="text"></label>
                                              </div>
                                            </div>
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <div class="single-review">
                                            <label>Your Review *</label>
                                            <textarea type="text" name="review" required="" id="review"></textarea>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="single-review">
                                            <label>Your Name *</label>
                                            <input type="text" name="name"  value="<?php echo $loginName?>" readonly>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="single-review">
                                            <label>Your Email *</label>
                                            <input type="email" name="email" readonly value="<?php echo $loginEmail?>">
                                          </div>
                                        </div>
                                        <div class="col-md-12">
                                          <button type="submit">Submit</button>
                                        </div>
                                      </div>
                                    </form>
                                </div>
                              </div>
                              <?php
                            }
                        else {
                            ?>
                            <div class="write-review text-center">
                                <p class="lead">You Need Login To Write A Review.</p>
                            </div>
                          <?php
                        }
                      ?>
                    </div>
                </div>-->
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script src="<?php echo $BASE_URL?>assets/file-upload/script.js" type="text/javascript"></script>
<script>

    function showAttribute(cid,nid){
	
	        $("#loder-img").show();
            $(".new-price-img").hide();			
	        var item_val=$("#attribute_id_"+cid).val();
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#attribute_id_"+nid).attr("disabled", false);
						$("#total-price").html(json.price);	
					}
					
				}
          });
	
    }
	
	function showQuenty(){
		
	        $("#loder-img").show();
            $(".new-price-img").hide();
			$(".multipal_size").html('<option value="">Choose an option...</option>');
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/GetQuenty',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#SiZeOPrions").html(json.sizeoprions);
						$("#total-price").html(json.price);	
					}
					
				}
            });
    }
	
	function showSizeQuenty(){
		
	        $("#loder-img").show();
            $(".new-price-img").hide();
			$(".multipal_size_item").html('<option value="">Choose an option...</option>');
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/GetQuenty',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#SiZeOPrions").html(json.sizeoprions);
						$("#total-price").html(json.price);	
					}
					
				}
            });
    }
	
	var countsize ='<?php echo count($ProductSizes)?>';
	if(countsize !=''){
		
	    getSizeOptions('<?php echo $product_id?>','0');
		
	}
	function getSizeOptions(product_id,make_a_default_qty_id){
		    
	        $("#loder-img").show();
			$.ajax({
				type: 'GET',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/getSizeOptions/'+product_id+'/'+make_a_default_qty_id,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					$("#loder-img").hide();
					$("#SiZeOPrions").html(data);
				}
            });
    }
	function getQuentyPrice(nid){
		    //alert(nid);
	        $("#loder-img").show();
            $(".new-price-img").hide();
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#"+nid).attr("disabled", false);
						
						$("#total-price").html(json.price);		
					}
					
				}
            });
    }
	
	function getPaperPrice(nid){
		
	        $("#loder-img").show();
            $(".new-price-img").hide();
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#attribute_id_"+nid).attr("disabled", false);
						
						$("#total-price").html(json.price);		
					}
					
				}
            });
    }
	 
    function setQuenty(){
		 
			quenty=$("#quenty").val();
			if(quenty=='' || quenty==0){
				$("#quenty").val('1');
			}
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			 $("#loder-img").show();
            $(".new-price-img").hide();
           		
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					
					$("#loder-img").hide();
                     $(".new-price-img").show();
					var json = JSON.parse(data);
					 
					if(json.success==1){
						
						$("#total-price").html(json.price);	
						
					}
					
				}
          });
     }

	 
	 function update_cumment(skey){
		    
		    var cumment=$("#cumment-"+skey).val();
            var product_id='<?php echo $product_id;?>';	
			if(cumment ==''){ alert('Enter cumment'); return false}
			
			$("#smc-"+skey).prop('disabled', true);
			$("#smc-"+skey).html('<img src="<?php echo $BASE_URL?>/assets/images/loder.gif" width=20>');
			$("#loder-img").show();
			$.ajax({
				
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/updateCumment',
				data: ({'cumment':cumment,'product_id':product_id,'skey':skey}),
				success: function (data) {
					$("#loder-img").hide();
					$("#smc-"+skey).prop('disabled', false);
					$("#smc-"+skey).html('Update Note');
					
				}
          });
		  
     }
	 
	 function delete_image(skey){
		 
		    var location=$("#location-"+skey).val();
            var product_id='<?php echo $product_id;?>';	
			if(location ==''){ return false}
			
			$("#smd-"+skey).prop('disabled', true);
			$("#smd-"+skey).html('<img src="<?php echo $BASE_URL?>/assets/images/loder.gif" width=20>');
			$("#loder-img").show();
			$.ajax({
				
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/deleteImage',
				data: ({'location':location,'product_id':product_id,'skey':skey}),
				success: function (data) {
					 $("#loder-img").hide();
					 //$("#smd-"+skey).prop('disabled', false);
					//$("#smd-"+skey).html('<i class="las la-trash"></i>');
					 $("#upload-file-data #teb-"+skey).remove();
					
					
					
					
				}
          });
		  
     }
	 
		function isNumber(evt) {
			
			var iKeyCode = (evt.which) ? evt.which : evt.keyCode
			if (iKeyCode != 46 && iKeyCode > 31 && (iKeyCode < 48 || iKeyCode > 57))
				return false;

			return true;
		}
		
	    $('form#cardFrom').on('submit', function (e) {
		
		      $("#loder-img").show();	
			   $("#btnsubmit").prop('disabled',true);
				var formData = new FormData(this);
				e.preventDefault();
				var url ='<?php echo $BASE_URL ?>ShoppingCarts/addToCard';
				$.ajax({
				  type: "POST",
				  url: url,
				  data: formData,
				  cache: false,
				  contentType: false,
				  processData: false,
				  success: function(data) {
					  $("#loder-img").hide();
					   var json = JSON.parse(data);
					   var status = json.status;
					   var msg = json.msg;
					   $("#btnsubmit").prop('disabled',false);
					   if (status == 1 ) {
						   
							 $(".cart-contents-count").html(json.total_item);
							 getCardItem();
							 //$(".after-click").show();
							 //$(".before-click").hide();
							 $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>'+msg+'.</span>').addClass("active");
							 
							 setTimeout(function() {
								 
								 $('.addtocart-message').removeClass("active");
								 
								location.assign("<?php echo $BASE_URL?>ShoppingCarts"); 
                                    								 
							 }, 1000);
					   } else {
						   
							 $('.addtocart-message').html('<span><i class="la la-cart-plus"></i>'+msg+'.</span>').addClass("active");
							 setTimeout(function() {
								 $('.addtocart-message').removeClass("active");
							 }, 2000);
					   }
				  },
				  error: function (error) {
				 }
			 });	
		});
		
		function getLengthWidthPrice(){
	        $("#loder-img").show();
            $(".new-price-img").hide();
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#total-price").html(json.price);
						$("#product_width").val(json.product_width);
						$("#product_length").val(json.product_length);
						
						$("#product_total_page").val(json.product_total_page);
						
						$("#product_width_error").html(json.product_width_error);
						$("#product_length_error").html(json.product_length_error);
						
						$("#product_total_page_error").html(json.product_total_page_error);
                        						
					}
					
				}
            });
        }
		function getDepthLengthWidthPrice(){
	        $("#loder-img").show();
            $(".new-price-img").hide();
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					if(json.success==1){
						
						$("#total-price").html(json.price);
						
						$("#product_depth_width").val(json.product_depth_width);
						$("#product_depth_length").val(json.product_depth_length);
						
						$("#product_depth_total_page").val(json.product_depth_total_page);
						
						$("#product_depth").val(json.product_depth);
						
						
						
						$("#product_depth_width_error").html(json.product_depth_width_error);
						$("#product_depth_length_error").html(json.product_depth_length_error);
						
						$("#product_depth_total_page_error").html(json.product_depth_total_page_error);
						
						$("#product_depth_error").html(json.product_depth_error);
                        						
					}
					
				}
            });
        }
		function getPageLengthWidthPrice(){
	        $("#loder-img").show();
            $(".new-price-img").hide();
			var myForm = document.getElementById('cardFrom');
			var formData = new FormData(myForm);
			$.ajax({
				type: 'POST',
				dataType: 'html',
				url: '<?php echo $BASE_URL?>Products/calculatePrice',
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function (data) {
					var json = JSON.parse(data);
					 $("#loder-img").hide();
                     $(".new-price-img").show();
					 
					if(json.success==1){
						
						$("#total-price").html(json.price);
						$("#page_product_width").val(json.page_product_width);
						$("#page_product_length").val(json.page_product_length);
						
						$("#page_product_total_page").val(json.page_product_total_page);
						$("#page_product_total_quantity").val(json.page_product_total_quantity);
						
						$("#page_product_width_error").html(json.page_product_width_error);
						$("#page_product_length_error").html(json.page_product_length_error);
                        $("#page_product_total_page_error").html(json.page_product_total_page_error);
						$("#page_product_total_quantity_error").html(json.page_product_total_quantity_error);
                        						
					}
					
				}
            });
        }
		$("#product_width" ).change(function(){
			
			product_width=$(this).val();
			getLengthWidthPrice();
        });
		
		$("#product_total_page" ).change(function(){
			
			product_width=$(this).val();
			getLengthWidthPrice();
        });
		
		$("#product_length" ).change(function(){
			
			product_length=$(this).val();
			getLengthWidthPrice();
        });
		
		$("#length_width_color" ).change(function(){
			
			product_length=$(this).val();
			getLengthWidthPrice();
			
        });
		
		$("#page_product_width" ).change(function(){
			
			getPageLengthWidthPrice();
        });
		
		$("#page_product_length" ).change(function(){
			
			getPageLengthWidthPrice();
        });
		
		$("#page_product_total_page" ).change(function(){
			
			getPageLengthWidthPrice();
        });
		$("#page_length_width_color" ).change(function(){
			
			getPageLengthWidthPrice();
        });
		$("#page_product_total_quantity" ).change(function(){
			
			getPageLengthWidthPrice();
        });
		
		
		$("#product_depth_width" ).change(function(){
			getDepthLengthWidthPrice();
        });
		$("#product_depth_total_page" ).change(function(){
			
			
			getDepthLengthWidthPrice();
        });
		
		$("#product_depth_length" ).change(function(){
			getDepthLengthWidthPrice();
        });
		
		$("#product_depth" ).change(function(){
			getDepthLengthWidthPrice();
        });
		$("#depth_color" ).change(function(){
			getDepthLengthWidthPrice();
        });
		
		
</script>
