<div id="navbar_right" align="right">
  <ul class="nde-menu-system">
<?php
//  <ul class="nde-menu-system" onmouseover="hide_dropdowns('in')" onmouseout="hide_dropdowns('out')">
for ($i=0; $i<count($menus); $i++) {
  echo '<li class="">'."\n";
  echo '  <a target="_top" href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/altnavi').'&id='.$menus[$i]['id'].'">'.$menus[$i]['name'].'</a>'."\n";
  echo '  <ul>'."\n";

//  for ($j=0; $j<count($menus[$i]['menu']); $j++) {
    // ページは許可されているか？
//    $page = $menus[$i]['menu'][$j]['url'];
//    $page = str_replace(DIR_WS_ADMIN, "", $page);
//    if (page_allowed($page) != 'true')
//      continue;

//    echo '<li>';
//    echo   '<a href="'.$menus[$i]['menu'][$j]['url'].'">'.$menus[$i]['menu'][$j]['name'].'</a>';
//    echo '</li>'."\n";
//  }

  echo '  </ul>'."\n";
  echo '</li>'."\n";
}
?>
  </ul>
</div>

<script type="text/javascript">
  <!--
//    cssjsmenu('navbar_right');
  // -->
</script>
