<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: message_stack.php 3178 2006-03-12 22:30:49Z drbyte $
 */

  class messageStack extends tableBox {

// class constructor
    function messageStack() {

      $this->messages = array();

      if (isset($_SESSION['messageToStack'])) {
        $messageToStack = $_SESSION['messageToStack'];
        for ($i=0, $n=sizeof($messageToStack); $i<$n; $i++) {
          $this->add($messageToStack[$i]['class'], $messageToStack[$i]['text'], $messageToStack[$i]['type']);
        }
        $_SESSION['messageToStack']= '';
      }
    }

// class methods
    function add($class, $message, $type = 'error') {
      global $template;
      if ($type == 'error') {
        $this->messages[] = array('params' => 'class="messageStackError"', 'class' => $class, 'text' => $message);
      } elseif ($type == 'warning') {
        $this->messages[] = array('params' => 'class="messageStackWarning"', 'class' => $class, 'text' => $message);
      } elseif ($type == 'success') {
        $this->messages[] = array('params' => 'class="messageStackSuccess"', 'class' => $class, 'text' => $message);
      } elseif ($type == 'caution') {
        $this->messages[] = array('params' => 'class="messageStackCaution"', 'class' => $class, 'text' => $message);
      } else {
        $this->messages[] = array('params' => 'class="messageStackError"', 'class' => $class, 'text' => $message);
      }
    }

    function add_session($class, $message, $type = 'error') {

      if (!$_SESSION['messageToStack']) {
        $messageToStack = array();
      } else {
        $messageToStack = $_SESSION['messageToStack'];
      }

      $messageToStack[] = array('class' => $class, 'text' => $message, 'type' => $type);
      $_SESSION['messageToStack'] = $messageToStack;
      $this->add($class, $message, $type);
    }

    function reset() {
      $this->messages = array();
    }

    function output($class) {
      $this->table_data_parameters = 'class="messageBox"';

      $output = array();
      for ($i=0, $n=sizeof($this->messages); $i<$n; $i++) {
        if ($this->messages[$i]['class'] == $class) {
          $output[] = $this->messages[$i];
        }
      }
      return $this->tableBox($output);
    }

    function size($class) {
      $count = 0;

      for ($i=0, $n=sizeof($this->messages); $i<$n; $i++) {
        if ($this->messages[$i]['class'] == $class) {
          $count++;
        }
      }

      return $count;
    }
  }
?>