<div class="contact-section-detail universal-spacing universal-bg-white">
    <div class="container">
        <?php
            if ($language_name == 'French') {
                echo $pageData['description_french'];
            } else {
                echo $pageData['description'];
            }
        ?>
    </div>
</div>
