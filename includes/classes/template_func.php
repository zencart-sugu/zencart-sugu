<?php
/**
 * template_func Class.
 *
 * @package classes
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: template_func.php 3041 2006-02-15 21:56:45Z wilt $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * template_func Class.
 * This class is used to for template-override calculations
 *
 * @package classes
 */
class template_func extends base {

  function template_func($template_dir = 'default') {
    $this->info  = array();
  }

  function get_template_part($page_directory, $template_part, $file_extension = '.php') {
    $directory_array = array();
    if ($dir = @dir($page_directory)) {
      while ($file = $dir->read()) {
        if (!is_dir($page_directory . $file)) {
          if (substr($file, strrpos($file, '.')) == $file_extension && preg_match($template_part, $file)) {
            $directory_array[] = $file;
          }
        }
      }

      sort($directory_array);
      $dir->close();
    }
    return $directory_array;
  }

  function get_template_dir($template_code, $current_template, $current_page, $template_dir, $debug=false) {
    //	echo 'template_default/' . $template_dir . '=' . $template_code;
    if ($this->file_exists($current_template . $current_page, $template_code)) {
      return $current_template . $current_page . '/';
    } elseif ($this->file_exists(DIR_WS_TEMPLATES . 'template_default/' . $current_page, ereg_replace('/', '', $template_code), $debug)) {
      return DIR_WS_TEMPLATES . 'template_default/' . $current_page;
    } elseif ($this->file_exists($current_template . $template_dir, ereg_replace('/', '', $template_code), $debug)) {
      return $current_template . $template_dir;
    } else {
      return DIR_WS_TEMPLATES . 'template_default/' . $template_dir;
      //        return $current_template . $template_dir;
    }
  }
  function file_exists($file_dir, $file_pattern, $debug=false) {
    $file_found = false;
    if ($mydir = @dir($file_dir)) {
      while ($file = $mydir->read()) {
        if ( strstr($file, $file_pattern) ) {
          $file_found = true;
          break;
        }
      }
    }
    return $file_found;
  }
}
?>