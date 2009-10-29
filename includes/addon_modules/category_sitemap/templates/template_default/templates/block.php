<ul>
<?php
  output_categories("current subs-parent", $categories);
?>
</ul>

<?php
  function output_categories($class, $categories) {
    for ($i=0; $i<count($categories); $i++) {
      echo '<li class="'.$class.'">'."\n";
      echo '<a href="'.zen_href_link(FILENAME_DEFAULT).'&cPath='.$categories[$i]['path'].'">'.$categories[$i]['name'].'</a>'."\n";
      if (count($categories[$i]['child'])>0) {
        echo '<ul class="subs">'."\n";
        output_categories("subs", $categories[$i]['child']);
        echo '</ul>'."\n";
      }
      echo '</li>'."\n";
    }
  }
?>
