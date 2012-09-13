<?php
/**
 * @package languageDefines
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: visitor_to_account.php $
 */


define('NAVBAR_TITLE', 'Create Account');

define('HEADING_TITLE', 'Create Account');

define('TEXT_ORIGIN_LOGIN', '<strong class="note">Attention:</strong>If you already have Customer Account in our store, please login <a href="%s">here.</a>');

// greeting salutation
define('EMAIL_SUBJECT', 'Welcome to ' . STORE_NAME);
define('EMAIL_GREET_MR', 'Mr %s' . "\n\n");
define('EMAIL_GREET_MS', 'Ms %s' . "\n\n");
define('EMAIL_GREET_NONE', 'For %s' . "\n\n");

// First line of the greeting
define('EMAIL_WELCOME', 'Dear Sir/Madam, <strong>Thank you for registering in ' . STORE_NAME . ' for this time.</strong>');
define('EMAIL_SEPARATOR', '--------------------');
define('EMAIL_COUPON_INCENTIVE_HEADER', 'When the next <strong>' . STORE_NAME . '</strong> is used, "Discount Coupon" that can be used is sent to the registered reward.' . "\n\n");
// your Discount Coupon Description will be inserted before this next define
define('EMAIL_COUPON_REDEEM', 'Coupon Code： <strong>%s</strong>' . "\n\n" . 'Please input the above-mentioned code to use this discount coupon when you adjust shopping.' . "\n\n");

define('EMAIL_GV_INCENTIVE_HEADER', TEXT_GV_NAME . ' of %s is sent only today.' . "\n");
define('EMAIL_GV_REDEEM', 'The ' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . ': %s ' . "\n\n" . 'After choose your items in our store, You can use it to enter ' . TEXT_GV_REDEEM . ' thing at the time of checkout.');
define('EMAIL_GV_LINK', 'You can now redeem the links below.' . "\n");
// GV link will automatically be included before this line

define('EMAIL_GV_LINK_OTHER','If ' . TEXT_GV_NAME . ' is added to the customer own account, ' . TEXT_GV_NAME . ' can be used for myself. You can also gift your acquaintance.' . "\n\n");

define('EMAIL_TEXT',
 'Following convenient services can be used for the customer by the account registered in this shop.' . "\n" .
 "\n" .
 '・<strong>Shopping Cart</strong>' . "\n" .
 'Products put in shopping cart can be hold  until delete or checkout.' . "\n" .
 "\n" .
 '・<strong>Address Book</strong>' . "\n" .
 'As a convenience to the gifts, Addressees can be registered up to five besides home.' . "\n" .
 "\n" .
 '・<strong>Order History</strong>' . "\n" .
 'The list of the commodity ordered in our shop can be confirmed on a My Account.' . "\n" .
 "\n" .
 '・<strong>Product Reviews</strong>' . "\n" .
 'You can write a review (impression) for our store\'s products.' . "\n" .
 'Please tell your thoughts to other customers.' . "\n\n");
define('EMAIL_CONTACT', 'If you have any questions on our store\'s online service, Please feel free to inquire by Email.: <a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a>\n\n");
define('EMAIL_GV_CLOSURE','Yours truly,;' . "\n\nStore Owner " . STORE_OWNER . "\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is separate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', 'This mail address was registered in our store by the customer oneself. If you do not register the account, please contact %s.');

//moved definitions to english.php
//define('TABLE_HEADING_PRIVACY_CONDITIONS', 'Privacy Statement');
//define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', 'Please acknowledge you agree with our privacy statement by ticking the following box. The privacy statement can be read <a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">here</span></a>.');
//define('TEXT_PRIVACY_CONDITIONS_CONFIRM', 'I have read and agreed to your privacy statement.');
//define('TABLE_HEADING_ADDRESS_DETAILS', 'Address Details');
//define('TABLE_HEADING_PHONE_FAX_DETAILS', 'Additional Contact Details');
//define('TABLE_HEADING_DATE_OF_BIRTH', 'Verify Your Age');
//define('TABLE_HEADING_LOGIN_DETAILS', 'Login Details');
//define('TABLE_HEADING_REFERRAL_DETAILS', 'Were You Referred to Us?');
