    <?php
	FILE_BASE_PATH.'dompdf-master/vendor/autoload.php';
	include FILE_BASE_PATH.'dompdf-master/vendor/autoload.php';
	use Dompdf\Dompdf;
	$dompdf = new Dompdf();
	ob_start();
	//pr($orderData,1);
    ?>
<!DOCTYPE html>
<html>
<head>
	<title>Facture d'achat  PDF</title>
</head>
<body style="margin: 0px; padding: 0px;">
	<table style="width:100%">
		<tr>
			<td style="width: 50%;">
				<div>
				  <?php //$url=$StoreData['url'].'/uploads/logo/'. $StoreData['pdf_template_logo'];
				        $url='uploads/logo/'.$StoreData['pdf_template_logo'];
				   ?>
				   <img src="<?php echo $url;?>" width="200">
					<!--<img src="assets/images/printing.coop_logo.png" width="200">-->
				</div>
			</td>
			<td style="width: 50%;">
				<div style="text-align: right;">
					<h2 style="margin: 0px; font-size: 24px; font-weight: 600; color: #000;">Facture d'achat</h2>
					<h2 style="margin: 0px; font-size: 24px; font-weight: 600; color: #000;">Réf. : F-00<?php echo $orderData['id'];?></h2>
					<p style="margin: 15px 0px 0px 0px; font-size: 18px; font-weight: 400; color: #000;">Réf. ordre: <?php echo ORDER_ID_PREFIX_FRENCH.$orderData['id']?> (GAL inc.) / <?php echo date('d/m/Y',strtotime($orderData['created']))?></p>
				</div>
			</td>
		</tr>
	</table>
	<table style="width: 100%; margin-top: 40px;">
		<tr>
			<td style="width: 50%;">
				<div>
				   <?php  echo $StoreData['invoice_pdf_company'];?>
					<!--<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>Impression Coop Inc.</b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">9166 Rue Lajeunesse</p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">Montreal, Quebec, H2M 1S2</p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">Canada</p>-->
				</div>
			</td>
			<td style="width: 50%;">
				<div>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"><b><?php echo ucfirst($orderData['billing_name']);?></b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"><?php echo $orderData['billing_address'];?></p>
					<p style="margin: 15px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"><?php echo $cityData['name'];?>,<?php echo $stateData['name'];?>,<?php echo $countryData['iso2'];?>,<?php echo $orderData['billing_pin_code'];?></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">Téléphone: <?php echo ucfirst($orderData['billing_mobile']);?></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">Email: <?php echo ucfirst($orderData['email']);?></p>
				</div>
			</td>
		</tr>
	</table>
	<table style="width: 100%; margin-top: 40px;">
		<tr>
			<td style="width: 20%;">
				<div style="text-align: center;">
					<p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>Date de facturation</b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"><?php echo date('d/m/Y',strtotime($orderData['created']))?></p>
				</div>
			</td>
			<!--<td style="width: 20%;">
				<div style="text-align: center;">
					<p style="margin: 0px 0px 10px 0px; font-size: 20px; font-weight: 400; color: #000;"><b>Date deadline</b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 20px; font-weight: 400; color: #000;"><?php echo date('d/m/Y',strtotime($orderData['created']))?></p>
				</div>
			</td>-->

			<td style="width: 20%;">
				<div style="text-align: center;">
					<p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>Réf. client</b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;">GAL inc.</p>
				</div>
			</td>
			<td style="width: 20%;">
				<div style="text-align: center;">
					<p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>Code client</b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"><?php if(!empty($orderData['user_id'])){

																																			                                             echo CUSTOMER_ID_PREFIX.$orderData['user_id'];
																												}else{
																													echo "-";
																												}?></p>
				</div>
			</td>
			<td style="width: 20%;">
				<div style="text-align: center;">
					<p style="margin: 0px 0px 10px 0px; font-size: 16px; font-weight: 400; color: #000;"><b>numéro de TVA</b></p>
					<p style="margin: 0px 0px 0px 0px; font-size: 16px; font-weight: 400; color: #000;"></p>
				</div>
			</td>
		</tr>
	</table>
	<table style="width: 100%;border: 2px solid #ff0000; text-align: left; border-collapse: collapse; margin-top: 20px;">
    	<thead>
    		<tr>
    		    <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">La désignation</th>
    		    <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Prix</th>
    		    <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Quantité</th>
    		    <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Unité</th>
    		    <th style="background: #aad4ff; color: #000; vertical-align: middle;font-size: 16px; text-transform: capitalize; font-weight: 400; white-space: nowrap; padding: 10px 10px !important; border-right: 2px solid #ff0000;">Total</th>
    	    </tr>
    	</thead>
    	<tbody>
		<?php
		foreach ($OrderItemData as $rowid=>$items){

				$cart_images=json_decode($items['cart_images'],true);
				$attribute_ids=json_decode($items['attribute_ids'],true);
				$product_size=json_decode($items['product_size'],true);
				$product_width_length=json_decode($items['product_width_length'],true);
				$page_product_width_length=json_decode($items['page_product_width_length'],true);
				$product_depth_length_width=json_decode($items['product_depth_length_width'],true);
				$votre_text=$items['votre_text'];
				$recto_verso=$items['recto_verso'];
				$product_id=$items['product_id'];

		?>
    		<tr style="background-color: #fff; border-bottom: 1px dashed #ccc !important;">
    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
				<?php echo ucfirst($items['name_french']);?><br>
				<?php
				if(!empty($product_width_length)){?>
					    <span><strong>Longueur (pouces):<?php echo $product_width_length['product_length'];?></strong> </span>,
					    <span><strong>Largeur (pouces):<?php echo $product_width_length['product_width'];?></strong>
						</span>,
						<?php if(!empty($product_width_length['length_width_color_show'])){?>
						 <span><strong>Couleurs:<?php echo $product_width_length['length_width_color_french'];?></strong>
						</span>,
						<?php }?>
						<?php if(!empty($product_width_length['product_total_page'])){?>
						 <span><strong>Qualité:<?php echo $product_width_length['product_total_page'];?></strong>
						</span>
						<?php
						}?>
					   <?php
					   }?>
					   <?php

				       if(!empty($product_depth_length_width)){?>
					    <span><strong>Longueur (pouces):<?php echo $product_depth_length_width['product_depth_length'];?></strong> </span>,
					    <span><strong>Largeur (pouces):<?php echo $product_depth_length_width['product_depth_width'];?></strong>
						</span>,
						 <span><strong>Profondeur (pouces):<?php echo $product_depth_length_width['product_depth'];?></strong>
						</span>,
						<?php if(!empty($product_depth_length_width['depth_color_show'])){?>
						 <span><strong>Couleurs:<?php echo $product_depth_length_width['depth_color_french'];?></strong>
						</span>,
						<?php }?>
						<?php if(!empty($product_depth_length_width['product_depth_total_page'])){?>
						 <span><strong>Qualité:<?php echo $product_depth_length_width['product_depth_total_page'];?></strong>
						</span>
						<?php
						}?>
					   <?php
					   }?>
					   <?php if(!empty($page_product_width_length)){?>
					    <span><strong>Longueur de page (pouces):<?php echo $page_product_width_length['page_product_length'];?></strong> </span>,
					    <span><strong>Largeur de page (pouces):<?php echo $page_product_width_length['page_product_width'];?></strong> </span>,
						<?php if(!empty($page_product_width_length['page_length_width_color_show'])){?>
						 <span><strong>Couleurs:<?php echo $page_product_width_length['page_length_width_color_french'];?></strong>
						</span>,
						<?php }?>
						<?php if(!empty($page_product_width_length['page_product_total_page'])){?>
						<span><strong>Des pages:<?php echo $page_product_width_length['page_product_total_page_french'];?></strong> </span>
						<?php
						}?>
						<?php if(!empty($page_product_width_length['page_product_total_sheets_french'])){?>
						<span><strong>Feuille par bloc:<?php echo $page_product_width_length['page_product_total_sheets_french'];?></strong> </span>
						<?php
						}?>
						<?php if(!empty($page_product_width_length['page_product_total_quantity'])){?>
						<span><strong>Quantité:<?php echo $page_product_width_length['page_product_total_quantity'];?></strong> </span>
						<?php
						}?>
					<?php
					  }?>
				       <?php
					    if(!empty($product_size)){

							    $size_name = $product_size['product_size_french'];
								$label_qty=$product_size['product_quantity_french'];
								$attribute=isset($product_size['attribute']) ? $product_size['attribute']:'';

								?>
							     <?php if($label_qty){ ?>
                                   <span><strong>Quantité:<?php echo $label_qty;?></strong> </span>
									<?php
									}?>
							    <?php
								if($size_name){ ?>
									  <span><strong>Taille:<?php echo $size_name;?></strong> </span>
									<?php
								}?>


								<?php
								if($attribute){

								    foreach($attribute as $akey=>$aval){

										$multiple_attribute_name=$aval['attributes_name_french'];
									    $multiple_attribute_item_name=$aval['attributes_item_name_french'];
								?>

                                   <span><strong><?php echo $multiple_attribute_name;?>:<?php echo $multiple_attribute_item_name;?></strong> </span>
								<?php
									}
								}?>

							<?php
						}
					    ?>
				         <?php
							#pr($attribute_ids);
							foreach($attribute_ids as $key=>$val){

								$attribute_name=$val['attribute_name_french'];
								$item_name=$val['item_name_french'];
								?>
								 <span><strong><?php echo $attribute_name;?>:<?php echo $item_name;?></strong> </span>
							<?php
						    }?>
						<?php if($recto_verso){?>
									<span><strong>Recto verso: <?php echo $recto_verso;?></strong> </span>,
									<?php
						}?>


					   <?php if($votre_text){?>
									<span><strong>Votre TEXTE - Votre TEXTE: <?php echo $votre_text;?></strong> </span>,
									<?php
						}?>

				</td>
    			<!--<td style="color: #000; vertical-align: middle; font-size: 18px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">14,975%</td>-->

    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;"><?php echo $order_currency_currency_symbol.number_format($items['price'],2);?>
				</td>
    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
				<?php
					echo $items['quantity'];
				?>
				</td>
    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">u.</td>
    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 10px 10px !important; border-bottom: 1px dashed #ccc; border-right: 2px solid #ff0000;">
				    <?php
					$subtotal=($items['price']*
					$items['quantity']);
					echo $order_currency_currency_symbol.number_format( $subtotal,2);
		            ?>
				    </td>
    		</tr>
		<?php
		}?>
    	</tbody>
    </table>
    <table style="width: 100%; margin-top: 20px;">
		<tr style="vertical-align: top;">
			<td style="width: 50%;">
				<!--<div style="">
					<p style="margin: 0px 0px 0px 0px; font-size: 20px; font-weight: 400; color: #000;"><b>Payment terms</b> : 50% deposit</p>
				</div>-->
			</td>
			<td style="width: 50%;">
				<table style="width: 100%; text-align: left; border-collapse: collapse;">
			    	<tbody>
			    		<tr style="background-color: #fff;">
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Total:</td>
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;"><?php echo $order_currency_currency_symbol."".number_format($orderData['sub_total_amount'],2);?>
							</td>
			    		</tr>
						<?php if(!empty($orderData['preffered_customer_discount']) && $orderData['preffered_customer_discount'] !="0.00"){?>
						<tr style="background-color: #fff;">
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Remise client privilégiée:</td>
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;"><?php echo '-'.$order_currency_currency_symbol.number_format($orderData['preffered_customer_discount'],2);?>
							</td>
			    		</tr>
						<?php
						}?>
						<?php if(!empty($orderData['coupon_discount_amount']) && $orderData['coupon_discount_amount'] !="0.00"){?>
						<tr style="background-color: #fff;">
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Remise de coupon:</td>
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;"><?php echo '-'.$order_currency_currency_symbol.number_format($orderData['coupon_discount_amount'],2);?>
							</td>
			    		</tr>
						<?php
						}?>
						<?php if(!empty($orderData['delivery_charge']) && $orderData['delivery_charge'] !="0.00"){?>
						<tr style="background-color: #fff;">
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;">Frais d'expédition:</td>
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;"><?php echo $order_currency_currency_symbol.number_format($orderData['delivery_charge'],2);?>
							</td>
			    		</tr>
						<?php
						}?>
						 <?php if(!empty($orderData['total_sales_tax']) &&  $orderData['total_sales_tax'] !='0.00'){ ?>
			    		<tr style="background-color: #fff;">
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important;"><?php echo $salesTaxRatesProvinces_Data['type']?> <?php echo number_format($salesTaxRatesProvinces_Data['total_tax_rate'],2);?>%:</td>
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 400; padding: 5px 5px !important; text-align: right;"><?php
	echo $order_currency_currency_symbol.number_format($orderData['total_sales_tax'],2);?></td>
			    		</tr>
						<?php
						}?>
			    		<tr style="background-color: #fff;">
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 600; padding: 5px 5px !important; background: #e7e7e7;">Total:</td>
			    			<td style="color: #000; vertical-align: middle; font-size: 16px; font-weight: 600; padding: 5px 5px !important; background: #e7e7e7; text-align: right;"><?php
	echo $order_currency_currency_symbol."".number_format($orderData['total_amount'],2);?></td>
			    		</tr>
			    	</tbody>
			    </table>
			</td>
		</tr>
		<tr>
			<td>
				<!--<p style="margin: 10px 0px 0px 0px; font-size: 20px; font-weight: 400; color: #000;">Current outstanding bill:<b><?php
	echo $order_currency_currency_symbol."".number_format($orderData['total_amount'],2);?></b></p>-->

			</td>
		</tr>
	</table>
	<!--<table style="width: 100%; margin-top: 40px;">
		<tr>
			<td>
				<p style="margin: 0px 0px 5px 0px; font-size: 15px; font-weight: 400; color: #000;">CONDITION 2% 10 JOURS SUR SOUS-TOTAL UNIQUEMENT</p>
				<p style="margin: 0px 0px 5px 0px; font-size: 15px; font-weight: 400; color: #000;">DURÉE: 2% 10 JOURS SUR SOUS-TOTAL ONLE / NET 30 JOURS</p>
				<p style="margin: 0px 0px 5px 0px; font-size: 15px; font-weight: 400; color: #000;">VEUILLEZ PAYER CETTE FACTURE, AUCUN COMPTE ENVOYÉ.</p>
				<p style="margin: 0px 0px 5px 0px; font-size: 15px; font-weight: 400; color: #000;">VEUILLEZ PAYER CETTE FACTURE, AUCUN DÉCLARATION À VENIR.</p>
				<p style="margin: 0px 0px 5px 0px; font-size: 15px; font-weight: 400; color: #000;">UN RETOUR ACCEPTÉ A 10 JOURS DE LA RÉCEPTION DE LA MARCHANDISE.</p>
				<p style="margin: 0px 0px 5px 0px; font-size: 15px; font-weight: 400; color: #000;">RETOUR ACCEPTÉ APRÈS 10 JOURS DE RÉCEPTION DE LA MARCHANDISE.</p>
				<p style="margin: 0px 0px 0px 0px; font-size: 15px; font-weight: 400; color: #000;">Mrcandise a reçu en bon état: X____________________________</p>
			</td>
		</tr>
	</table>-->
</body>
</html>
    <?php
	    $dompdf->loadHtml(ob_get_clean());
		$dompdf->render();
		//$dompdf->setPaper('A4','landscape');
		$file=$orderData['order_id'].'-fr-invoice.pdf';
		$file=strtolower($file);
		//$dompdf->stream($file);
		$output = $dompdf->output();
        file_put_contents(FILE_BASE_PATH.'pdf/'.$file, $output);
	?>