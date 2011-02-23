<?php
/**
 * addoOnModulesObserver Class
 *
 * @package Observer
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.addOnModulesObserver.php $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class addOnModulesObserver extends base {
  var $modules;

  // class constructor
  function addOnModulesObserver() {
    global $zco_notifier;

    $notify_event_id = array();
    $this->modules = zen_addOnModules_get_installed_modules();
    for ($i = 0, $n = count($this->modules); $i < $n; $i++) {
      $class = $this->modules[$i];
      if (!is_object($GLOBALS[$class])) {
        zen_addOnModules_load_module_files($class);
        if (class_exists($class)) {
          $GLOBALS[$class] = new $class;
        }
      }
      if ($GLOBALS[$class]->enabled) {
        $notify_event_id = array_merge($notify_event_id, $GLOBALS[$class]->attachEvent());
      }
    }

    $notify_event_id = array_unique($notify_event_id);
    $notify_event_id = array_merge($notify_event_id);
    $zco_notifier->attach($this, $notify_event_id);
  }

  function update(&$callingClass, $notifier, $paramsArray) {
    if (is_array($this->modules) && count($this->modules) > 0) {
      reset($this->modules);
      for ($i = 0, $n = count($this->modules); $i < $n; $i++) {
        $class = $this->modules[$i];
        if ($GLOBALS[$class]->enabled) {
          $GLOBALS[$class]->notifierUpdate($notifier);
        }
      }
    }
  }
}
?>