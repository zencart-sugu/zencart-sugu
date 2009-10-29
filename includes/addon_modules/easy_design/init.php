<?php
  // 文言の展開
  $objection = getObjectionWords();
  for ($i=0; $i<count($objection); $i++) {
    $easy_design_language_key   = $objection[$i]['key'];
    $easy_design_language_value = $objection[$i]['value'];
    define($easy_design_language_key, $easy_design_language_value);
  }
?>
