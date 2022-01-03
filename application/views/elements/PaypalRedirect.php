<html>
<head>
<title><?php echo $language_name=='French' ? 'Page de paiement PayPal':'PayPal Check Out Page';?></title>
</head>
<body>
    <?php
	$currency_id=$ProductOrder['currency_id'];
	if(empty($currency_id)){
		$currency_id=1;
	}
    $OrderCurrencyData=$CurrencyList[$currency_id];
	$paypal_payment_mode=$MainStoreData['paypal_payment_mode'];
	$paypal_business_email=$MainStoreData['paypal_business_email'];
	$paypal_sandbox_business_email=$MainStoreData['paypal_sandbox_business_email'];
	$url='https://www.paypal.com/cgi-bin/webscr';

	$paypal_email=!empty($paypal_business_email) ? $paypal_business_email:'imprimeur.coop@gmail.com';
	if($paypal_payment_mode=='sendbox'){

		$paypal_email=!empty($paypal_sandbox_business_email) ? $paypal_sandbox_business_email:'sb-ks2ro721209@business.example.com';
		$url='https://www.sandbox.paypal.com/cgi-bin/webscr';

	}
	$store_name=$MainStoreData['name'];
	$store_url=$MainStoreData['url'];

	?>
	<center><h1><?php echo $language_name=='French' ? 'Veuillez ne pas actualiser cette page ...':'Please do not refresh this page...';?></h1></center>
		<form action="<?php echo $url;?>" method="post"  name="f1">
		<table border="1">

			<tbody>
			  <input type="hidden" name="order_id" value="<?php echo $ProductOrder['id']?>">
			  <input type="hidden" name="cmd" value="_xclick">
			  <input type="hidden" name="business" value="<?php echo $paypal_email?>">
			  <input type="hidden" name="item_number" value="<?php echo $ProductOrder['id']?>">
			  <input type="hidden" name="item_total" value="<?php echo $ProductOrder['total_items']?>">
			  <input type="hidden" name="amount" value="<?php echo $ProductOrder['total_amount'];?>">
			  <input type="hidden" name="first_name" value="<?php echo $ProductOrder['shipping_name']?>">
			  <input type="hidden" name="return" value="<?php echo $store_url?>Checkouts/PayPalSuccessResponse/<?php echo $ProductOrder['id'];?>">
			  <input type="hidden" name="cancel_return" value="<?php echo $store_url?>Checkouts/PayPalCancelResponse/<?php echo $ProductOrder['id'];?>">
			  <input type="hidden" name="email" value="<?php echo $ProductOrder['email']?>" >
			  <input type="hidden" name="currency_code" value="CAD">
			  <input type="hidden" name="notify_url" value="<?php echo $store_url?>Checkouts/PayPalIPNResponse/<?php echo $ProductOrder['id'];?>">
			  <input type="hidden" name="cbt" value="Return to Merchant">
			  <input type="hidden" name="rm" value="2">
			  <!--<input type="image" name="submit"
				src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
				alt="PayPal - The safer, easier way to pay online">-->
			</tbody>
		</table>
		<script type="text/javascript">
			document.f1.submit();
		</script>
	</form>

<form action="https://www.sandbox.paypal.com/cgi-bin/webscr" method="post">

  <input type="hidden" name="business" value="sb-ks2ro721209@business.example.com">
  <input type="hidden" name="cmd" value="_xclick">
  <input type="hidden" name="item_name" value="Hot Sauce-12oz. Bottle">
  <input type="hidden" name="amount" value="5.95">
  <input type="hidden" name="currency_code" value="USD">

  <!-- Display the payment button. -->
  <!--<input type="image" name="submit" border="0"
  src="https://www.paypalobjects.com/en_US/i/btn/btn_buynow_LG.gif"
  alt="Buy Now">
  <img alt="" border="0" width="1" height="1"
  src="https://www.paypalobjects.com/en_US/i/scr/pixel.gif" >
</form>-->
</body>
</html>