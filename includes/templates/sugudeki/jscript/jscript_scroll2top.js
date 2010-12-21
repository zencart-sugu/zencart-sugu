if ($) {
  var zenJQuery = $;
} else if (jQuery) {
  var zenJQuery = jQuery;
}


if (zenJQuery) {
  zenJQuery(document).ready(function() {
    zenJQuery('.pagetop a').click(function(e){
      var target = zenJQuery(e.target);
      var offset = target.offset().top;

      target.animate(
        {opacity: 'toggle'},
        {duration: "slow",
         easing: "linear",
         complete: function() {target.toggle();},
         step: function(s){window.scrollTo(0, offset * s);}
        }
      );
      return false;
    });
  });
}
