<?php
$facebook_ogp_language_file = DIR_WS_ADDON_MODULES . 'facebook_ogp/languages/' . $_SESSION['language'] . '.php';
if (file_exists($facebook_ogp_language_file)) {
  require_once($facebook_ogp_language_file);
}
