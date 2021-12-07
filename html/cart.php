<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a> 
                / 
                <span class="current">Cart</span>
            </div>
        </div>
    </div>
</div>

<div class="cart-section universal-spacing universal-bg-white">
    <div class="container">
        <div class="cart-section-inner">
            <table class="shop-cart-table">
                <thead>
                    <tr>
                        <th></th>
                        <th></th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="product-remove">
                            <a href="#" class="remove">×</a>
                        </td>
                        <td class="product-thumbnail">
                            <a href="product-single.php">
                                <img src="images/product2.jpg">
                            </a>                     
                        </td>
                        <td class="product-name">
                            <a href="product-single.php">Printing Card Gray</a>
                            <div class="product-name-detail">
                                <div class="row">
                                    <div class="col-md-6">
                                        <span><strong>Copy:</strong> 50</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span><strong>Colors:</strong> Full</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span><strong>Paper quality:</strong> Clear vinyl</span>
                                    </div>
                                    <div class="col-md-6">
                                        <span><strong>Size:</strong> 3" x 4"</span>
                                    </div>
                                </div>
                            </div>
                            <div class="uploaded-file-detail">
                                <div class="uploaded-file-single">
                                    <div class="uploaded-file-single-inner">
                                        <div class="uploaded-file-img" style="background-image: url(images/joinus_img.jpg)"></div>
                                        <div class="uploaded-file-info">
                                            <div class="uploaded-file-name">
                                                <span>File name goes here</span>
                                            </div>                                           
                                            <div class="upload-field">
                                                <textarea type="text"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="product-price1">
                            <span>£</span>738.00</span>
                        </td>
                        <td>
                            <div class="quant-cart">
                                <input type="text" value="1">
                            </div>
                        </td>
                        <td class="product-subtotal">
                            <span>£</span>738.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="actions">
                            <div class="coupon">
                                <a href="products.php"><button type="submit">Continue Shopping</button></a>
                            </div>
                        </td>
                        <td colspan="4">
                            <div class="checkout">
                                <div class="cart-total">
                                    <span>Sub Total : <font>£738.00</font></span>
                                </div>
                                <div class="coupon">
                                    <a href="checkout.php"><button type="submit">Proceed to Checkout</button></a>
                                </div>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>