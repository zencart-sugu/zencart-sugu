<?php
/** 
 * File contains just the base class
 *
 * @package classes
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: class.base.php 3041 2006-02-15 21:56:45Z wilt $
 */
/**
 * abstract class base
 *
 * any class that wants to notify or listen for events must extend this base class
 *
 * @package classes
 */
class base {
  /**
   * array to hold the list of observer classes
   * @var array
   */
  var $observers = array();
  /**
   * method used to an attach an observer to the notifier object
   * 
   * NB. We have to get a little sneaky here to stop session based classes adding events ad infinitum
   * To do this we first concatenate the class name with the event id, as a class is only ever going to attach to an
   * event id once, this provides a unigue key. To ensure there are no naming problems with the array key, we md5 the unique
   * name to provide a unique hashed key. 
   * 
   * @param object Reference to the observer class
   * @param array An array of eventId's to observe
   */
  function attach(&$observer, $eventIDArray) {
    foreach($eventIDArray as $eventID) {
      $nameHash = md5(get_class($observer).$eventID);
      $this->observers[$nameHash] = array('obs'=>&$observer, 'eventID'=>$eventID);
    }
  }
  /**
   * method used to detach an observer from the notifier object
   * @param object
   * @param array
   */
  function detach($observer, $eventIDArray) {
    foreach($eventIDArray as $eventID) {    
      $nameHash = md5(get_class($observer).$eventID);
      unset($this->observers[$nameHash]);
    }
  }
  /**
   * method to notify observers that an event as occurred in the notifier object
   * 
   * @param string The event ID to notify for
   * @param array paramters to pass to the observer, useful for passing stuff which is outside of the 'scope' of the observed class.
   */
  function notify($eventID, $paramArray = array()) {
    foreach($this->observers as $key=>$obs) {
      if ($obs['eventID'] == $eventID) {
        $obs['obs']->update($this, $eventID, $paramArray);
      }
    }
  }
}
?>