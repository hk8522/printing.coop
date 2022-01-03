<style>
.shopping-product-display table {
	border-left: 1px solid #ccc;
	border-right: 1px solid #ccc;
}
.shopping-product-display table tr {
	border-bottom: none;
}
</style>
<div class="container-fluid my-account-main-section">
    <div class="container p-0">
        <div class="my-account-section">
            <div class="row">
                <div class="col-md-12">
                    <!--<div class="product-title-section">-->
                    <!--    <div class="today-deal-title">-->
                    <!--        <span>Notifications</span>-->
                    <!--    </div>    -->
                    <!--</div>-->
                </div>
<div class="col-md-9">
    <div class="product-pagination">
        <span><a href="index.php">Home</a> &gt; <a href="notification.php">Notifications</a></span>
    </div>
    <div class="my-account-section-box my-acc-height account-manage-address">
        <div class="new-customer-title">
            <span>My Notifications</span>
        </div>
        <div class="customer-fields" style="min-height: initial;">
        </div>
    </div>
</div>
<div class="col-md-3 desktop-account">
    <?php $this->load->view('elements/my-account-menu');?>
</div>
            </div>
        </div>
    </div>
</div>