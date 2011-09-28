<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ja">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=EUC-JP">
<title><?php echo TITLE; ?></title>
<script language="JavaScript" src="includes/menu.js" type="text/JavaScript"></script>
<link href="includes/stylesheet.css" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS" />
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">

<!-- bof languages dropdown -->
<?php echo $GLOBALS['easy_admin']->getBlock('block_languages_dropdown', $current_page_base); ?>
<!-- eof languages dropdown -->

<!-- bof block_right_top_menu -->
<?php echo $GLOBALS['easy_admin']->getBlock('block_right_top_menu', $current_page_base); ?>
<!-- eof block_right_top_menu -->

<!-- bof block_dropdown_menu -->
<?php echo $GLOBALS['easy_admin']->getBlock('block_dropdown_menu', $current_page_base); ?>
<!-- eof block_dropdown_menu -->
