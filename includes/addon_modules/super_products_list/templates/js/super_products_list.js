$(document).ready(function() {
alert('ready');
  $('#open_manufacturer').click(function() {
alert('open');
    $.fancybox({
      'padding':       0,
      'autoScale':     false,
      'transitionIn':  'none',
      'transitionOut': 'none',
      'width':         '75%',
      'height':        '75%',
      'href':          '',
      'type':          'iframe'
    });
  });
});
