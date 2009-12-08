<div id="navbar_drop">
  <ul class="nde-menu-system" onmouseover="hide_dropdowns('in')" onmouseout="hide_dropdowns('out')">
<?php
for ($i=0; $i<count($menus); $i++) {
  echo '<li class="submenu">'."\n";
//  echo '  <a target="_top" href="'.zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_EASY_ADMIN.'/altnavi').'&id='.$menus[$i]['id'].'">'.$menus[$i]['name'].'</a>'."\n";
  echo '  '.$menus[$i]['name']."\n";
  echo '  <ul>'."\n";

  for ($j=0; $j<count($menus[$i]['menu']); $j++) {
    // ページは許可されているか？
    $page = $menus[$i]['menu'][$j]['url'];
    $page = str_replace(DIR_WS_ADMIN, "", $page);
    if (function_exists("page_allowed") && page_allowed($page) != 'true')
      continue;

    echo '<li>';
    echo   '<a href="'.$menus[$i]['menu'][$j]['url'].'">'.$menus[$i]['menu'][$j]['name'].'</a>';
    echo '</li>'."\n";
  }

  echo '  </ul>'."\n";
  echo '</li>'."\n";
}
?>
  </ul>
</div>

<script type="text/javascript">
  <!--
    cssjsmenu('navbar_drop');
  // -->
</script>
