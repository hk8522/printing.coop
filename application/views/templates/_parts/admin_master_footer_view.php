<footer class="main-footer text-center">
    <strong>&copy; <?php echo date('Y')?> Printingcoop</strong>
</footer>
<div class='control-sidebar-bg'></div>
</div>
<div class="modal" id="MsgModal">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="text-right" style="padding-right: 10px;">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
            </div>
            <!-- Modal body -->
            <div class="modal-body"></div>
        </div>
    </div>
</div>

<div class="cart-modal modal fade view-details-modal" id="personalisemodal" tabindex="-1" role="dialog" aria-labelledby="cartmodalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="personalised-box-inner">
                    <div class="personalised-product-name">
                        <span>Product Name</span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="product-img product-image-zoom single-image zoom-available">
                                <div class="product-image-gallery">
                                    <img id="zoom_05" src="" data-zoom-image=""/>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="personalised-edit-box">
                                <div class="personalised-edit-box-inner">
                                    <div class="personalised-edit-single">
                                        <div class="personalised-edit-single-title">
                                            <span>Choose Color:</span>
                                        </div>
                                        <div class="personalised-edit-single-fields">
                                            <div class="personalised-edit-single-input">
                                                <span>Choose Color:</span>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- title -->
                                    <div class="personalised-edit-single">
                                        <div class="personalised-edit-single-title">
                                            <span>title:</span>
                                        </div>
                                        <div class="personalised-edit-single-fields">
                                            <div class="personalised-edit-single-example">
                                                <span>lable</span>
                                            </div>
                                            <div class="personalised-edit-single-input">
                                                <span>value</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="personalised-edit-single">
                                        <div class="personalised-edit-single-title">
                                            <span> Paragraph</span>
                                        </div>
                                        <div class="personalised-edit-single-fields">
                                            <p>safdbdbdfbfbnrrrthrtbfbrhrbrthrt</p>
                                        </div>
                                    </div>
                                    <div class="personalised-edit-single">
                                        <div class="personalised-edit-single-title">
                                            <span>Photo:</span>
                                        </div>
                                        <div class="personalised-edit-single-fields">
                                            <div class="personalised-upload">
                                                <div class="row">
                                                    <!-- photo -->
                                                    <div class="col-md-4">
                                                        <div class="personalised-single-upload">
                                                            <div class="personalised-single-upload-area">
                                                                <div class="personalised-action-img">
                                                                    <span><i class="fas fa-plus"></i></span>
                                                                    <img  class="personalised-display-img" src="">
                                                                </div>
                                                            </div>
                                                            <div class="personalised-image-num"><span>Photo </span></div>
                                                            </div>
                                                        </div>
                                                        <!-- end -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="<?php echo $BASE_URL;?>assets/admin/js/bootstrap.js" type="text/javascript"></script>
    <script src="<?php echo $BASE_URL;?>assets/admin/js/bootstrap-select.js" type="text/javascript"></script>
    <script src="<?php echo $BASE_URL;?>assets/admin/js/chart.js" type="text/javascript"></script>
    <script src="<?php echo $BASE_URL;?>assets/admin/js/app.js" type="text/javascript"></script>
    <script src="<?php echo $BASE_URL;?>assets/admin/js/jquery.js" type="text/javascript"></script>
    <script src="<?php echo $BASE_URL;?>assets/admin/js/font-awesome.js" type="text/javascript"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js">
    </script>

    <script src="<?php echo $BASE_URL;?>assets/administration/fineuploader/jquery.fineuploader-4.2.2.min.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/bootstrap/js/popper.min.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/bootstrap/js/bootstrap.min.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/build/js/smartresize.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/build/js/custom.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/summernote/summernote.min.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/elfinder/js/elfinder.min.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/magnific-popup/jquery.magnific-popup.min.js"></script>
    <script src="<?php echo $BASE_URL;?>assets/administration/jquery.tmpl.min.js"></script>

<script>
$(document).ready(function(){
    $("#a1").click(function(){
        $(".p-field").show();
    });
    $("#a2").click(function(){
        $(".p-field").hide();
    });
    $("#single").click(function(){
        $(".single").toggle();
    });

    if ($("#example1").length) {
      $('#example1').DataTable();
    }

    $('.has-clear input[type="text"]').on('input propertychange', function() {
        var $this = $(this);
        var visible = Boolean($this.val());
        $this.siblings('.form-control-clear').toggleClass('hidden', !visible);
    }).trigger('propertychange');

    $('.form-control-clear').click(function() {
        $(this).siblings('input[type="text"]').val('')
            .trigger('propertychange').focus();
    });
});
function showpersonale(id){
 // alert(id);
  $.ajax({
            type: 'POST',
            dataType: 'html',
            url: '<?php echo $BASE_URL ?>admin/Orders/personaliseDetail',
            data: {id:id},
            dataType:'json',
            success: function (data) {
             console.log(JSON.parse(data.personaliseDetail));
                $('#personalisemodal').modal('show');
            }
            });
}
</script>
<?php echo $before_body;?>
  </body>
</html>
