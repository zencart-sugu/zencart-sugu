<script language="javascript" type="text/javascript">
  //<![CDATA[
  var main;
  var thumb;
  function callback(el) {
    var classes = <?php echo JQUERY_ALIAS; ?>(el.get(0)).attr('class');
    if (classes.match(/(<?php echo $module; ?>\d+)/)) {
      var firstclass = RegExp.$1;
      var target = <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI ."+firstclass);
      target.toggleClass('active');
      target.toggleClass('inactive');
    }
  }
  <?php echo JQUERY_ALIAS; ?>(function() {
    var btns = new Array();
    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI ul li a").each(function(){btns.push('#'+this.rel);});
    main = <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> #feature_main_images").jCarouselLite({
      auto: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_AUTO; ?>,
      speed: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SPEED; ?>,
      vertical: <?php echo (MODULE_FEATURE_AREA_UI_CONF_VERTICAL == 'true' ? 'true' : 'false'); ?>,
      circular: <?php echo (MODULE_FEATURE_AREA_UI_CONF_CIRCULAR == 'true' ? 'true' : 'false'); ?>,
      btnGo: btns,
      btnNext:  ".next-<?php echo $module . '-' . $block; ?>",
      btnPrev:  ".prev-<?php echo $module . '-' . $block; ?>",
      btnStart: ".start-<?php echo $module . '-' . $block; ?>",
      btnStop:  ".stop-<?php echo $module . '-' . $block; ?>",
      beforeStart: callback,
      afterEnd: callback,
      visible: 1,
      scroll: 1
    });
  });

  <?php echo JQUERY_ALIAS; ?>(function() {
    thumb = <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI").jCarouselLite({
      speed: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SPEED; ?>,
      vertical: <?php echo (MODULE_FEATURE_AREA_UI_CONF_VERTICAL == 'true' ? 'true' : 'false'); ?>,
      //circular: <?php echo (MODULE_FEATURE_AREA_UI_CONF_CIRCULAR == 'true' ? 'true' : 'false'); ?>,
      circular: false,
      visible: <?php echo $this->getVisibleCount(); ?>,
      scroll: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SCROLL; ?>
    });
  });

  <?php echo JQUERY_ALIAS; ?>(function() {
    <?php echo JQUERY_ALIAS; ?>(".start-<?php echo $module . '-' . $block; ?>").click( function() {
      <?php echo JQUERY_ALIAS; ?>('.start-<?php echo $module . '-' . $block; ?>').hide();
      <?php echo JQUERY_ALIAS; ?>('.stop-<?php echo $module . '-' . $block; ?>').show();
    });

    <?php echo JQUERY_ALIAS; ?>(".stop-<?php echo $module . '-' . $block; ?>").click( function() {
      <?php echo JQUERY_ALIAS; ?>('.start-<?php echo $module . '-' . $block; ?>').show();
      <?php echo JQUERY_ALIAS; ?>('.stop-<?php echo $module . '-' . $block; ?>').hide();
    });

    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI a").hover(
      function() {
        if (this.rel && this.ref != "") {
          var btn = <?php echo JQUERY_ALIAS; ?>('#'+this.rel);
          var stop = <?php echo JQUERY_ALIAS; ?>('.stop-<?php echo $module . '-' . $block; ?>');
          if (btn) {
            btn.triggerHandler('click');
            if (stop) {
              stop.triggerHandler('click');
            }
          }
        }
      },

      function () {
        if (this.rel && this.ref != "") {
          var start = <?php echo JQUERY_ALIAS; ?>('.start-<?php echo $module . '-' . $block; ?>');
          if (start) {
            start.triggerHandler('click');
          }
        }
      }
    );

    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> a").focus( function() {
      if (this.rel && this.ref != "") {
        var btn = <?php echo JQUERY_ALIAS; ?>('#'+this.rel);
        var stop = <?php echo JQUERY_ALIAS; ?>('.stop-<?php echo $module . '-' . $block; ?>');
        if (btn) {
          btn.triggerHandler('click');
          if (stop) {
            stop.triggerHandler('click');
          }
        }
      }
    });

    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> a").blur( function() {
      if (this.rel && this.ref != "") {
        var start = <?php echo JQUERY_ALIAS; ?>('.start-<?php echo $module . '-' . $block; ?>');
        if (start) {
          start.triggerHandler('click');
        }
      }
    });

    <?php echo JQUERY_ALIAS; ?>('.start-<?php echo $module . '-' . $block; ?>').triggerHandler('click');
  });
  //]]>
//--></script>
