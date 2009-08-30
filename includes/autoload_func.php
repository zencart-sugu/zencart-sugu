<?php
/**
 * File contains the autoloader loop
 * 
 * The autoloader loop takes the array from the auto_loaders directory
 * and uses this this to constuct the InitSysytem. 
 * see {@link http://www.zen-cart.com/wiki/index.php/Developers_API_Tutorials#InitSystem} for more details.
 *
 * @package initSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: autoload_func.php 3019 2006-02-13 03:59:48Z birdbrain $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
reset($autoLoadConfig);
ksort($autoLoadConfig);
foreach ($autoLoadConfig as $actionPoint => $row) {
  $debugOutput = "";
  foreach($row as $entry) {
    $debugOutput = 'actionPoint=>'.$actionPoint . ' ';
    switch($entry['autoType']) {
      case 'include':
      /**
       * include a file as specified by autoloader array
       */
      include($entry['loadFile']);
      $debugOutput .= 'include(\'' . $entry['loadFile'] . '\');' . '</br>';
      break;
      case 'require':
      /**
       * require a file as specified by autoloader array
       */
      require($entry['loadFile']);
      $debugOutput .= 'include(\'' . $entry['loadFile'] . '\');' . '</br>';
      break;
      case 'init_script':
      $baseDir = DIR_WS_INCLUDES . 'init_includes/';
      if (file_exists(DIR_WS_INCLUDES . 'init_includes/overrides/' . $entry['loadFile'])) {
        $baseDir = DIR_WS_INCLUDES . 'init_includes/overrides/';
      }
      /**
       * include an init_script as specified by autoloader array
       */
      include($baseDir . $entry['loadFile']);
      $debugOutput .= 'include(\'' . $baseDir . $entry['loadFile'] . '\');' . '</br>';
      break;
      case 'class':
      if (isset($entry['classPath'])) {
        $classPath = $entry['classPath'];
      } else {
        $classPath = DIR_FS_CATALOG . DIR_WS_CLASSES;
      }
      /**
       * include a class definition as specified by autoloader array
       */
      include($classPath . $entry['loadFile']);
      $debugOutput .= 'include(\'' . $classPath . $entry['loadFile'] . '\');' . '</br>';
      break;
      case 'classInstantiate':
      $objectName = $entry['objectName'];
      $className = $entry['className'];
      if (isset($entry['classSession']) && $entry['classSession'] === true) {
        if (isset($entry['checkInstantiated']) && $entry['checkInstantiated'] === true) {
          if (!isset($_SESSION[$objectName])) {
            $_SESSION[$objectName] = new $className();
            $debugOutput .= 'if (!$_SESSION[' . $objectName . ']) { ';
            $debugOutput .= '$_SESSION[' . $objectName . '] = new ' . $className . '();';
            $debugOutput .= ' }<br />';
          }
        } else {
          $_SESSION[$objectName] = new $className();
          $debugOutput .= '  $_SESSION[' . $objectName . '] = new ' . $className . '();</br>';
        }
      } else {
        $$objectName = new $className();
        $debugOutput .= '$' . $objectName . ' = new ' . $className . '();</br>';
      }
      break;
      case 'objectMethod':
      $objectName = $entry['objectName'];
      $methodName = $entry['methodName'];
      if (is_object($_SESSION[$objectName])) {
        $_SESSION[$objectName]->$methodName();
        $debugOutput .= '$_SESSION[' . $objectName . ']->' . $methodName . '();</br>';
      } else {
        $$objectName->$methodName();
        $debugOutput .= '$' . $objectName . '->' . $methodName . '();</br>';
      }
      break;
    }
    if (DEBUG_AUTOLOAD === true) echo $debugOutput;
  }
}
?>