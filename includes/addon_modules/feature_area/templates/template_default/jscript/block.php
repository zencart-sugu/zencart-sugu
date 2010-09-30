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
      btnStart: '#feature_start',
      btnStop: '#feature_stop',
      beforeStart: callback,
      afterEnd: callback,
      visible: 1,
      scroll: 1
    });
  });

  <?php echo JQUERY_ALIAS; ?>(function() {
    thumb = <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI").jCarouselLite({
      btnNext: ".next-<?php echo $module . '-' . $block; ?>",
      btnPrev: ".prev-<?php echo $module . '-' . $block; ?>",
      speed: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SPEED; ?>,
      vertical: <?php echo (MODULE_FEATURE_AREA_UI_CONF_VERTICAL == 'true' ? 'true' : 'false'); ?>,
      //circular: <?php echo (MODULE_FEATURE_AREA_UI_CONF_CIRCULAR == 'true' ? 'true' : 'false'); ?>,
      circular: false,
      visible: <?php echo $this->getVisibleCount(); ?>,
      scroll: <?php echo (int)MODULE_FEATURE_AREA_UI_CONF_SCROLL; ?>
    });
  });

  <?php echo JQUERY_ALIAS; ?>(document).ready( function() {
    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> .carouselUI a").hover( function() {
      var btn = <?php echo JQUERY_ALIAS; ?>('#'+this.rel);
      var stop = <?php echo JQUERY_ALIAS; ?>('#feature_stop');
      if (btn) {
        btn.triggerHandler('click');
        if (stop) {
          stop.triggerHandler('click');
        }
      }
    },
    function () {
      var start = <?php echo JQUERY_ALIAS; ?>('#feature_start');
      if (start) {
        start.triggerHandler('click');
      }
    });
    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> a").focus( function() {
      var btn = <?php echo JQUERY_ALIAS; ?>('#'+this.rel);
      var stop = <?php echo JQUERY_ALIAS; ?>('#feature_stop');
      if (btn) {
        btn.triggerHandler('click');
        if (stop) {
          stop.triggerHandler('click');
        }
      }
    });
    <?php echo JQUERY_ALIAS; ?>(".<?php echo $block . '-' . $module; ?> a").blur( function() {
      var start = <?php echo JQUERY_ALIAS; ?>('#feature_start');
      if (start) {
        start.triggerHandler('click');
      }
    });
  });
  //]]>
//--></script>
