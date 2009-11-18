<script language="javascript" type="text/javascript">
  //<![CDATA[
  <?php echo JQUERY_ALIAS; ?>(function() {
    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI").jCarouselLite({
      btnNext: ".next-<?php echo $module . '-' . $block; ?>",
      btnPrev: ".prev-<?php echo $module . '-' . $block; ?>",
      auto: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_AUTO; ?>,
      speed: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SPEED; ?>,
      vertical: <?php echo (MODULE_FEATURE_AREA_UI_CONF_VERTICAL == 'true' ? 'true' : 'false'); ?>,
      circular: <?php echo (MODULE_FEATURE_AREA_UI_CONF_CIRCULAR == 'true' ? 'true' : 'false'); ?>,
      visible: <?php echo $this->getVisibleCount(); ?>,
      scroll: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SCROLL; ?>
    });
  });

  var featureMainImage = '';
  $(document).ready( function() {
    $(".<?php echo $block . '-' . $module; ?> a").hover( function() {
        var mainImage = this.rel;
        if (featureMainImage!=""){ $("#"+featureMainImage).css('display','none'); }
          else{  $("#feature_main_images .start").css('display','none');}
        $("#"+mainImage).css('display','block');
        featureMainImage = mainImage;
    });
    $(".<?php echo $block . '-' . $module; ?> a").focus( function() {
        var mainImage = this.rel;
        if (featureMainImage!=""){ $("#"+featureMainImage).css('display','none'); }
          else{  $("#feature_main_images .start").css('display','none');}
        $("#"+mainImage).css('display','block');
        featureMainImage = mainImage;
    });
  });

  //]]>
//--></script>
