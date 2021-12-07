<div class="content-wrapper" style="min-height: 687px;">
	<section class="content">
		<div class="row" style="display: flex;justify-content: center;align-items: center;">
			<div class="col-md-12 col-xs-12">
				<div class="box box-success box-solid">
					<div class="box-body">
						<div class="inner-head-section">
                            <div class="inner-title">
                                <span>Create Discount</span>
                            </div>
                        </div>
                        <div class="inner-content-area">
                            <div class="row justify-content-center">
                                <div class="col-md-7">
                                	<div class="form-role-area">			
										<div class="control-group info">
											<div class="row align-items-center">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame"> Generate Code</label>
												</div>
                                                <div class="col-md-8">	
													<div class="controls">
														<input class="form-control" type="text">
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame">Select Fields</label>
												</div>
                                                <div class="col-md-8">	
													<div class="controls">
													    <div class="row">
													        <div class="col-md-12">
													            <select id="multiple-category" class="form-control selectpicker" multiple="" data-live-search="true">
													                <option>--Select Category--</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													            </select>
                                                                <label class="form-inner-label">Select Category</label>
													        </div>
													        <div class="col-md-12">
													            <select id="multiple-brand" class="form-control selectpicker" multiple="" data-live-search="true">
													                <option>--Select Brands--</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													            </select>
                                                                <label class="form-inner-label">Select Brands</label>
													        </div>
													        <div class="col-md-12">
													            <select id="multiple-products" class="form-control selectpicker" multiple="" data-live-search="true">
													                <option>--Select Products--</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													                <option>abc</option>
													            </select>
                                                                <label class="form-inner-label">Select Products</label>
													        </div>
													    </div> 
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame"> Discount Type</label>
												</div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="span2" id="show-discount-percent"><input type="radio" name="discount" value="discountpercent" checked=""> Discount Percent</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="span2" id="show-discount-amount"><input type="radio" name="discount" value="discountamount"> Discount Amount</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="discount-percent">
                                                                <input class="form-control">
                                                                <label class="form-inner-label">Discount In Percentage</label>
                                                            </div>
                                                            <div class="discount-amount" style="display: none;">
                                                                <input class="form-control">
                                                                <label class="form-inner-label">Discount In Amount</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame"> Discount Valid</label>
												</div>
                                                <div class="col-md-8">	
													<div class="controls">
													    <div class="row">
													        <div class="col-md-12">
													            <div class="row">
													                <div class="col-md-6">
							<input class="form-control" type="text" id="DiscountValid">
													                </div>
													                <div class="col-md-6">
													                    <input class="form-control" type="time">
													                </div>
													            </div>
                                                                <label class="form-inner-label">Valid From</label>
													        </div>
													        <div class="col-md-12">
													            <div class="row">
													                <div class="col-md-6">
													                    <input class="form-control" type="date">
													                </div>
													                <div class="col-md-6">
													                    <input class="form-control" type="time">
													                </div>
													            </div>
                                                                <label class="form-inner-label">Valid Till</label>
													        </div>
													    </div>
													</div>
												</div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame"> Discount Requirements</label>
												</div>
                                                <div class="col-md-8">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <label class="span2" id="show-minimum"><input type="radio" name="quantity" value="minimum" checked=""> Minimum Quantity</label>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <label class="span2" id="show-maximum"><input type="radio" name="quantity" value="maximum"> Maximum Quantity</label>
                                                        </div>
                                                        <div class="col-md-12">
                                                            <div class="minimum-quantity">
                                                                <input class="form-control">
                                                                <label class="form-inner-label">Minimum Quantity</label>
                                                            </div>
                                                            <div class="maximum-quantity" style="display: none;">
                                                                <input class="form-control">
                                                                <label class="form-inner-label">Maximum Quantity</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
											</div>
										</div>
										<div class="control-group info">
											<div class="row align-items-center">
                                                <div class="col-md-4">	
													<label class="span2 " for="inputMame">Discount Code Limit</label>
												</div>
                                                <div class="col-md-8">	
													<div class="controls">
														<input class="form-control" type="number">
													</div>
												</div>
											</div>
										</div>
										<div class="text-right">
											<button type="submit" class="btn btn-success">Submit</button>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div><!-- /.box -->         
			</div><!-- /.col-->
		</div><!-- ./row -->
	</section><!-- /.content -->
 </div>
 
 <script src="<?php echo $BASE_URL;?>assets/admin/js/jquery.datetimepicker.full.js"></script>
<script>
$(document).ready(function(){
	
    $("#show-discount-percent").click(function(){
        $(".discount-percent").show();
        $(".discount-amount").hide();
    });
    $("#show-discount-amount").click(function(){
        $(".discount-percent").hide();
        $(".discount-amount").show();
    });
	
    $("#show-minimum").click(function(){
        $(".minimum-quantity").show();
        $(".maximum-quantity").hide();
    });
    $("#show-maximum").click(function(){
        $(".minimum-quantity").hide();
        $(".maximum-quantity").show();
    });
	
    /*$('#multiple-category').selectpicker1();
    $('#multiple-brand').selectpicker2();
    $('#multiple-products').selectpicker3();*/
	
	$('#DiscountValid').datetimepicker();
	
});
/*jQuery(document).ready(function () {
                'use strict';

                jQuery('#DiscountValid').datetimepicker();
 });*/
</script>