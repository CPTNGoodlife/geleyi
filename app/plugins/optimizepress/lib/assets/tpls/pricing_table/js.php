<script type="text/javascript">
    function resizeWindow() {
        if (jQuery(window).width() >= 767) {
            jQuery(".container").each(function () {
                var e = 0;
                var t = jQuery(this).find(".price-table .features");
                t.css({
                    height: "auto"
                });
                t.each(function () {
                    var t = jQuery(this).height();
                    if (t > e) e = t
                });
                t.height(e)
            })
        }
    }
    jQuery(document).ready(function () {
        jQuery(window).bind("resize", resizeWindow);
        jQuery(window).bind("load", resizeWindow);
	
	var width = jQuery('.element-container .border.style-<?php echo $style?>').parent().width();
	jQuery('.element-container .border.style-<?php echo $style?>').parent().css({ textAlign: 'center' });
    })
</script>