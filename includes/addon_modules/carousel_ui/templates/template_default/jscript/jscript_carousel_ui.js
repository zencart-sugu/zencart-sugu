jQuery(document).ready(function() {
  var els = jQuery('.block-carousel_ui dl');
  var i = 0;
  var j = els.size();
  for (; i<j; i++) {
    var el = els.eq(i);
    el.mouseover(function(ev){
      var t = ev.target;
      while(t.tagName != 'DL') {
        t = t.parentNode;
      }
      t.backup = t.style.backgroundColor;
      t.style.backgroundColor = '#E1EBF5';
    });
    el.mouseout(function(ev){
      var t = ev.target;
      while(t.tagName != 'DL') {
        t = t.parentNode;
      }
      t.style.backgroundColor = t.backup;
    });
  }
});