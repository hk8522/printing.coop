<?php include("header.php"); ?>

<div class="page-title-section universal-bg-white">
    <div class="container">
        <div class="page-title-section-inner universal-half-spacing">
            <div class="inner-breadcrum">
                <a href="index.php">Home</a> 
                / 
                <span class="current">Wishlist</span>
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
                        </td>
                        <td class="product-price1">
                            <span>£</span>738.00</span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2" class="actions">
                            <div class="coupon">
                                <a href="products.php"><button type="submit">Update Wishlist</button></a>
                            </div>
                        </td>
                        <td colspan="4">
                            
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include("footer.php"); ?>