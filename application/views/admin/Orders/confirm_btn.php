               <?php
			  $total_amount=isset($_SESSION['total_amount']) ? $_SESSION['total_amount']:0;

			  ?>
				<div class="universal-border-sitecolor-btn">
					<button type="submit" onclick="showLoder()">Confirm  <?php echo CURREBCY_SYMBOL.number_format($total_amount,2);?></span></button>
				</div>
