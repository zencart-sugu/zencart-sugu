<script language="javascript" type="text/javascript">
  //<![CDATA[
  <?php echo JQUERY_ALIAS; ?>(function() {
    <?php echo JQUERY_ALIAS; ?>(".carouselUI-<?php echo $module . '-' . $block; ?>").jCarouselLite({
      btnNext: ".next-<?php echo $module . '-' . $block; ?>",
      btnPrev: ".prev-<?php echo $module . '-' . $block; ?>",
      auto: <?php echo (int)MODULE_CAROUSEL_UI_CONF_AUTO_XSELL_PRODUCTS; ?>,
      speed: <?php echo (int)MODULE_CAROUSEL_UI_CONF_SPEED_XSELL_PRODUCTS; ?>,
      vertical: <?php echo (MODULE_CAROUSEL_UI_CONF_VERTICAL_XSELL_PRODUCTS == 'true' ? 'true' : 'false'); ?>,
      circular: <?php echo (MODULE_CAROUSEL_UI_CONF_CIRCULAR_XSELL_PRODUCTS == 'true' ? 'true' : 'false'); ?>,
      visible: <?php echo (int)MODULE_CAROUSEL_UI_CONF_VISIBLE_XSELL_PRODUCTS; ?>,
      scroll: <?php echo (int)MODULE_CAROUSEL_UI_CONF_SCROLL_XSELL_PRODUCTS; ?>,
      page: "<?php echo BUTTON_CAROUSEL_UI_PAGE; ?>",
      btnSmall:  "#id-font-small",
      btnNormal: "#id-font-normal",
      btnLarge:  "#id-font-large"
    });
  });
  //]]>
//--></script>
