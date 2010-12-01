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
          $GLOBALS['phpmailer']['Subject'] = zen_db_prepare_input($subject) . ' #' . $GLOBALS['oID'];
	} else {
          // admin 宛のメールはsubjectにprefixを付ける
          $GLOBALS['phpmailer']['Subject'] = SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT . zen_db_prepare_input($subject) . ' #' . $GLOBALS['oID'];
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
        //$CustomMail = new CustomMail();
        $GLOBALS['phpmailer']['Body'] = zen_db_prepare_input($contents);
        if (!empty($GLOBALS['phpmailer']['AltBody'])) {
          $GLOBALS['phpmailer']['AltBody'] = zen_db_prepare_input($contents);
        }
        // 置換開始
        $GLOBALS['phpmailer']['Body'] = replace_status_email($GLOBALS['oID'], $GLOBALS['phpmailer']['Body']);
        $GLOBALS['phpmailer']['AltBody'] = replace_status_email($GLOBALS['oID'], $GLOBALS['phpmailer']['AltBody']);
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
}
?>