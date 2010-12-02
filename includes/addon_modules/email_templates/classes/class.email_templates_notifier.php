<?php
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

class email_templates_notifier {
  var $pagename;
  function email_templates_notifier() {

  }

  function call($pagename, $notifier, $values = array()) {
    $this->pagename = $pagename;
    if (method_exists($this, $pagename)) {
      $values[] = $notifier;
      return call_user_func_array(array($this, $pagename), $values);
    } else {
      return $this->index();
    }
  }

  function _cleanup_email($email_text) {
    // clean up &amp; and && from email text
    while (strstr($email_text, '&amp;&amp;')) $email_text = str_replace('&amp;&amp;', '&amp;', $email_text);
    while (strstr($email_text, '&amp;')) $email_text = str_replace('&amp;', '&', $email_text);
    while (strstr($email_text, '&&')) $email_text = str_replace('&&', '&', $email_text);

    // fix double quotes
    while (strstr($email_text, '&quot;')) $email_text = str_replace('&quot;', '"', $email_text);

    // fix spaces
    while (strstr($GLOBALS['phpmailer']['Body'], '&nbsp;')) $GLOBALS['phpmailer']['Body'] = str_replace('&nbsp;', ' ', $GLOBALS['phpmailer']['Body']);

    // fix slashes
    $email_text = stripslashes($email_text);

    return $email_text;
  }

  function index() {
    return true;
  }

  function super_batch_status($notifier) {
    global $request_type;
    $language_id = isset($_POST['lang_id']) ? $_POST['lang_id'] : null;
    $redirect = zen_href_link($this->pagename, '', $request_type);
    $order_id = isset($_GET['oID']) ? $_GET['oID'] : null;
    $this->orders($notifier, $redirect, $order_id, $language_id);
  }

  function super_orders($notifier) {
    global $request_type;
    $redirect = zen_href_link($this->pagename, zen_get_all_get_params(array('action')) . 'action=edit', $request_type);
    $this->orders($notifier, $redirect);
  }

  function orders($notifier, $redirect = null, $order_id = null, $language_id = null) {
    global $messageStack;
    global $request_type;

    if (is_null($order_id)) {
      $order_id = isset($_GET['oID']) ? $_GET['oID'] : null;
    }
    if (is_null($redirect)) {
      $redirect = zen_href_link($this->pagename, zen_get_all_get_params(array('action')) . 'action=edit', $request_type);
    }

    switch( $notifier ){
    case 'NOTIFY_BEFORE_CREATE_HEADER':
      if (!empty($_POST['email_template_id']) && is_numeric($_POST['email_template_id'])) {
        // template本文取得
        $id = $_POST['email_template_id'];
        $subject = get_email_template_contents($id, $order_id, $language_id, 'subject');
        if ($subject === false) {
          // template取得できなければredirect
          $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
          zen_redirect($redirect);
        }
        if (strpos($GLOBALS['phpmailer']['Subject'], SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT) !== false) {
          // admin 宛のメールはsubjectにprefixを付ける
          $GLOBALS['phpmailer']['Subject'] = SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . zen_db_prepare_input($subject) . ' #' . $GLOBALS['oID'];
	} else {
          $GLOBALS['phpmailer']['Subject'] = zen_db_prepare_input($subject) . ' #' . $GLOBALS['oID'];
	}
      } else {
        // idが無効ならredirect
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
        zen_redirect($redirect);
      }
      break;
    case 'NOTIFY_BEFORE_CREATE_BODY':
      if (!empty($_POST['email_template_id']) && is_numeric($_POST['email_template_id'])) {
        // template本文取得
        $id = $_POST['email_template_id'];
        $contents = get_email_template_contents($id, $order_id, $language_id, 'contents');
        if ($contents === false) {
          // template取得できなければredirect
          $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
          zen_redirect($redirect);
        }
        // 注文ステータス変更時にコメントがあれば置換
        $GLOBALS['phpmailer']['Body'] = zen_db_prepare_input($contents);
        if (!empty($GLOBALS['phpmailer']['AltBody'])) {
          $GLOBALS['phpmailer']['AltBody'] = zen_db_prepare_input($contents);
        }
        // 置換開始
        $GLOBALS['phpmailer']['Body'] = replace_status_email($GLOBALS['oID'], $GLOBALS['phpmailer']['Body']);
        $GLOBALS['phpmailer']['Body'] = $this->_cleanup_email($GLOBALS['phpmailer']['Body']);
        if (!empty($GLOBALS['phpmailer']['AltBody'])) {
          $GLOBALS['phpmailer']['AltBody'] = replace_status_email($GLOBALS['oID'], $GLOBALS['phpmailer']['AltBody']);
          $GLOBALS['phpmailer']['AltBody'] = $this->_cleanup_email($GLOBALS['phpmailer']['AltBody']);
        }
        if ($this->pagename == 'orders') {
          // DBへのログ記録用に置換後のコメントをセット(orders.php)
          $GLOBALS['comments'] = zen_db_prepare_input($_POST['comments']);
        }
      } else {
        // idが無効ならredirect
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
        zen_redirect($redirect);
      }
      break;
    }
  }
  function checkout_process($notifier) {
    global $currencies, $order_totals, $order;
    global $messageStack;
    global $request_type;

    // send lowstock email to admin
    if ($order->email_low_stock != '' and SEND_LOWSTOCK_EMAIL=='1') {
      return true;
    }

    // prepare data
    $customer = $order->customer;
    $GLOBALS['phpmailer']['comments'] = $order->info['comments'];
    $GLOBALS['phpmailer']['content_type'] = $order->content_type;
    $oID = $_SESSION['order_number_created'];
    $redirect = '';

    // get template id 
    if ($_SESSION['customer_id'] > 0 && !isset($_SESSION['visitors_id'])) {
      // members
      $email_template_id = MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_MAIL_ID;
    }
    else {
      //visitors
      $email_template_id = MODULE_EMAIL_TEMPLATE_CHECKOUT_SUCCESS_VISITOR_MAIL_ID;
    }

    switch ( $notifier ) {
    case 'NOTIFY_BEFORE_CREATE_HEADER':
      if (!empty($email_template_id) && is_numeric($email_template_id)) {
        // template本文取得
        $id = $email_template_id;
        $order_id = null;
        $language_id = $_SESSION['language_id'];
        $subject = get_email_template_contents($id, $order_id, $language_id, 'subject');
        if ($subject === false) {
          // template取得できなければredirect
          $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
          zen_redirect($redirect);
        }
        if (strpos($GLOBALS['phpmailer']['Subject'], SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT) !== false) {
          // admin 宛のメールはsubjectにprefixを付ける
          $GLOBALS['phpmailer']['Subject'] = SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT . zen_db_prepare_input($subject) . EMAIL_ORDER_NUMBER_SUBJECT . $oID;
	} else {
          $GLOBALS['phpmailer']['Subject'] = zen_db_prepare_input($subject) . EMAIL_ORDER_NUMBER_SUBJECT . $oID;
	}
      } else {
        // idが無効ならredirect
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
        zen_redirect($redirect);
      }
      break;
    case 'NOTIFY_BEFORE_CREATE_BODY':
      if (!empty($email_template_id) && is_numeric($email_template_id)) {
        // template本文取得
        $id = $email_template_id;
        $order_id = null;
        $language_id = $_SESSION['language_id'];
        $contents = get_email_template_contents($id, $order_id, $language_id, 'contents');
        if ($contents === false) {
          // template取得できなければredirect
          $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
          zen_redirect($redirect);
        }
        // GLOBALSにテンプレートをセット
        $GLOBALS['phpmailer']['Body'] = zen_db_prepare_input($contents);
        if (!empty($GLOBALS['phpmailer']['AltBody'])) {
          $GLOBALS['phpmailer']['AltBody'] = zen_db_prepare_input($contents);
        }
        // 置換開始
        $GLOBALS['phpmailer']['Body'] = replace_status_email($oID, $GLOBALS['phpmailer']['Body']);
        $GLOBALS['phpmailer']['Body'] = $this->_cleanup_email($GLOBALS['phpmailer']['Body']);
        if (!empty($GLOBALS['phpmailer']['AltBody'])) {
          $GLOBALS['phpmailer']['AltBody'] = replace_status_email($oID, $GLOBALS['phpmailer']['AltBody']);
          $GLOBALS['phpmailer']['AltBody'] = $this->_cleanup_email($GLOBALS['phpmailer']['AltBody']);
        }
        // admin 宛には追加情報を付加
        if (strpos($GLOBALS['phpmailer']['Subject'], SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT) !== false) {
          $extra_info=email_collect_extra_info('','', $this->customer['firstname'] . ' ' . $this->customer['lastname'], $this->customer['email_address'], $this->customer['telephone']);
          $GLOBALS['phpmailer']['Body'] .= strip_tags($extra_info['TEXT']);
          if (!empty($GLOBALS['phpmailer']['AltBody'])) {
            $GLOBALS['phpmailer']['AltBody'] .= strip_tags($extra_info['TEXT']);
          }
        }
      } else {
        // idが無効ならredirect
        $messageStack->add_session(TEXT_EMAIL_TEMPLATE_NO_TEMPLATE, 'warning');
        zen_redirect($redirect);
      }
      break;
    }

  }
}
?>