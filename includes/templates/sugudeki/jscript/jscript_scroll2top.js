if ($) {
  var zenJQuery = $;
} else if (jQuery) {
  var zenJQuery = jQuery;
}


if (zenJQuery) {
  zenJQuery(document).ready(function() {
    zenJQuery('.pagetop a').click(function(){
      var offset = zenJQuery('.pagetop').offset().top;

      zenJQuery('.pagetop').animate(
        {opacity: 'toggle'},
        {duration: "slow",
         easing: "linear",
         complete: function() {zenJQuery('.pagetop').toggle();},
         step: function(s){window.scrollTo(0, offset * s);}
        }
  
      );
      return false;
    });
  });
}
