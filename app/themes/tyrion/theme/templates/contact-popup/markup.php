<div id="contact_popup">
    <?php if( $title ): ?>
    <h1 class="title "><?php echo $title ?></h1>
    <?php endif ?>

    <div class="yitpopup_container">

            <!-- contact form -->
            <?php echo do_shortcode( '[contact_form name="'. $contact .'" ]' ) ?>

            <!-- content -->
            <?php echo do_shortcode( $content ) ?>

    </div>
</div>