<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: email_welcome.php 2999 2006-02-09 17:21:39Z drbyte $
//

  require('includes/application_top.php');

  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  if (file_exists('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . (($template_dir=='') ? '' : '/'.$template_dir) .'/' . 'create_account.php')) {
    require('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . (($template_dir=='') ? '' : '/'.$template_dir) . '/' . 'create_account.php');
  } else {
    require('../' . DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . 'create_account.php');
  }


// build the message content
      $name = 'Fred Smith';
      $firstname = 'Fred';
      $lastname = 'Smith';
	  $gender='m';
	  $email_address='fredsmith@somewhere.com';

// build the message content

      if (ACCOUNT_GENDER == 'true') {
         if ($gender == 'm') {
           $email_text = sprintf(EMAIL_GREET_MR, $lastname);
         } else {
           $email_text = sprintf(EMAIL_GREET_MS, $lastname);
         }
      } else {
        $email_text = sprintf(EMAIL_GREET_NONE, $firstname);
      }
      $html_msg['EMAIL_GREETING'] = str_replace('\n','',$email_text);
      $html_msg['EMAIL_FIRST_NAME'] = $firstname;
      $html_msg['EMAIL_LAST_NAME']  = $lastname;

      // initial welcome
      $email_text .=  EMAIL_WELCOME;
	  $html_msg['EMAIL_WELCOME'] = str_replace('\n','',EMAIL_WELCOME);

      if (NEW_SIGNUP_DISCOUNT_COUPON != '' and NEW_SIGNUP_DISCOUNT_COUPON != '0') {
        $coupon_id = NEW_SIGNUP_DISCOUNT_COUPON;
        $coupon = $db->Execute("select * from " . TABLE_COUPONS . " where coupon_id = '" . $coupon_id . "'");
        $coupon_desc = $db->Execute("select coupon_description from " . TABLE_COUPONS_DESCRIPTION . " where coupon_id = '" . $coupon_id . "' and language_id = '" . $_SESSION['languages_id'] . "'");
//        $db->Execute("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $coupon_id ."', '0', 'Admin', '" . $email_address . "', now() )");

      // if on, add in Discount Coupon explanation
        $email_text .= "\n" . EMAIL_COUPON_INCENTIVE_HEADER .
                       (!empty($coupon_desc->fields['coupon_description']) ? $coupon_desc->fields['coupon_description'] . "\n\n" : '') .
                       strip_tags(sprintf(EMAIL_COUPON_REDEEM, ' ' . $coupon->fields['coupon_code'])) . EMAIL_SEPARATOR ;
		
      $html_msg['COUPON_TEXT_VOUCHER_IS'] = EMAIL_COUPON_INCENTIVE_HEADER ;
	  $html_msg['COUPON_DESCRIPTION']     = (!empty($coupon_desc->fields['coupon_description']) ? '<strong>' . $coupon_desc->fields['coupon_description'] . '</strong>' : '');
      $html_msg['COUPON_TEXT_TO_REDEEM']  = str_replace("\n", '', sprintf(EMAIL_COUPON_REDEEM, ''));
      $html_msg['COUPON_CODE']  = $coupon->fields['coupon_code'];
      }

      if (NEW_SIGNUP_GIFT_VOUCHER_AMOUNT > 0) {
        $coupon_code = 'ABCDEF';
//        $insert_query = $db->Execute("insert into " . TABLE_COUPONS . " (coupon_code, coupon_type, coupon_amount, date_created) values ('" . $coupon_code . "', 'G', '" . NEW_SIGNUP_GIFT_VOUCHER_AMOUNT . "', now())");
//        $insert_id = $db->Insert_ID();
//        $db->Execute("insert into " . TABLE_COUPON_EMAIL_TRACK . " (coupon_id, customer_id_sent, sent_firstname, emailed_to, date_sent) values ('" . $insert_id ."', '0', 'Admin', '" . $email_address . "', now() )");

      // if on, add in GV explanation
        $email_text .= "\n\n" . sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) .
                       sprintf(EMAIL_GV_REDEEM, $coupon_code) .
                       EMAIL_GV_LINK . zen_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code, 'NONSSL', false) . "\n\n" .
                       EMAIL_GV_LINK_OTHER . EMAIL_SEPARATOR;
		$html_msg['GV_WORTH'] = str_replace('\n','',sprintf(EMAIL_GV_INCENTIVE_HEADER, $currencies->format(NEW_SIGNUP_GIFT_VOUCHER_AMOUNT)) );
		$html_msg['GV_REDEEM'] = str_replace('\n','',str_replace('\n\n','<br />',sprintf(EMAIL_GV_REDEEM, '<strong>' . $coupon_code . '</strong>')));
		$html_msg['GV_CODE_NUM'] = $coupon_code;
		$html_msg['GV_CODE_URL'] = str_replace('\n','',EMAIL_GV_LINK . '<a href="' . zen_href_link(FILENAME_GV_REDEEM, 'gv_no=' . $coupon_code, 'NONSSL', false) . '">' . TEXT_GV_NAME . ': ' . $coupon_code . '</a>');
        $html_msg['GV_LINK_OTHER'] = EMAIL_GV_LINK_OTHER;
      }

      // add in regular email welcome text
      $email_text .= "\n\n" . EMAIL_TEXT . EMAIL_CONTACT . EMAIL_GV_CLOSURE;

	  $html_msg['EMAIL_MESSAGE_HTML']  = str_replace('\n','',EMAIL_TEXT);
	  $html_msg['EMAIL_CONTACT_OWNER'] = str_replace('\n','',EMAIL_CONTACT);
	  $html_msg['EMAIL_CLOSURE']       = nl2br(EMAIL_GV_CLOSURE);

// include create-account-specific disclaimer
      $email_text .= "\n\n" . sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, STORE_OWNER_EMAIL_ADDRESS). "\n\n";
	  $html_msg['EMAIL_DISCLAIMER'] = sprintf(EMAIL_DISCLAIMER_NEW_CUSTOMER, '<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS .' </a>');

      $html_msg['EMAIL_TO_NAME'] = $name;
      $html_msg['EMAIL_TO_ADDRESS'] = $email_address;
      $html_msg['EMAIL_SUBJECT'] = $EMAIL_SUBJECT;
      $html_msg['EMAIL_FROM_NAME'] = $STORE_NAME;
      $html_msg['EMAIL_FROM_ADDRESS'] = $EMAIL_FROM;
      $extra_info=email_collect_extra_info(STORE_NAME, EMAIL_FROM, $name, $email_address );
      $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
	  $email_html = zen_build_html_email_from_template('welcome_extra', $html_msg);
//   zen_mail($name, $email_address, EMAIL_SUBJECT, $email_text, STORE_NAME, EMAIL_FROM, $html_msg, 'welcome');



?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  }
  // -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body_text //-->
<table border="0" width="100%" cellspacing="0" cellpadding="2">
  <tr>
    <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
      <tr>
        <td class="pageHeading"><?php echo HEADING_TITLE; ?></td>
        <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
      </tr>
      <tr>
        <td class="errorText" colspan="2"><?php echo HEADING_SUBTITLE; ?></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td><table border="2" width="625" cellspacing="0" cellpadding="20" align="center">
<?php if (EMAIL_USE_HTML=='true') { ?>
      <tr><td width="100%"><table border="0" cellpadding="0" width="100%">
        <tr>
          <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
        </tr>

        <tr>
          <td class="main"><?php echo TEXT_SUBJECT . ' ' . EMAIL_SUBJECT; ?></td>
        </tr>

        <tr>
          <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
        </tr>

        <tr>
          <td class="main"><?php echo $email_html; ?></td>
        </tr>

      </table></td></tr>
<?php } ?>

      <tr><td width="100%"><table border="0" cellpadding="0" width="100%">
        <tr>
          <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '10'); ?></td>
        </tr>

        <tr>
          <td class="main"><?php echo TEXT_SUBJECT . ' ' . EMAIL_SUBJECT; ?></td>
        </tr>

        <tr>
          <td><?php echo zen_draw_separator('pixel_trans.gif', '1', '20'); ?></td>
        </tr>

        <tr>
          <td class="main"><?php echo nl2br(strip_tags($email_text)); ?></td>
        </tr>

      </table></td></tr>
    </table></td>
  </tr>
</table>
<!-- body_text_eof //-->
<br>
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>