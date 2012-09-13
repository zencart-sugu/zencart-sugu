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
//  $Id: cache.php 1105 2005-04-04 22:05:35Z birdbrain $
//

define('HEADING_TITLE',       'Admin Simple Setting');

define('TEXT_INFORMATION',    'Please set the items on display or no display the admin.');

define('TEXT_DISPLAY',        'Display');
define('TEXT_CHANGE',         'Not Change');

define('TEXT_UPDATE',         'Update');
define('TEXT_UPDATE_SUCCESS', 'Set up successful');

$easy_admin_simplify_config   = array();
$easy_admin_simplify_config[] = array(
  'title' => 'Categories',
  'item'  => array(
    array('type'=>'D', 'key'=>'CATEGORY_LANGUAGE',          'description'=>'Input fields other than Japanese'),
    array('type'=>'D', 'key'=>'CATEGORY_PRICE_LINK',        'description'=>'Link to product price management'),
    array('type'=>'D', 'key'=>'CATEGORY_PRODUCT_TYPE',      'description'=>'Product Category pull-down of new products'),
    array('type'=>'C', 'key'=>'CATEGORY_PRODUCT_ATTRIBUTE', 'description'=>'Link to product options'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Products',
  'item'  => array(
    array('type'=>'D', 'key'=>'PRODUCT_LANGUAGE',             'description'=>'Input fields other than Japanese'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_ATTRIBUTE',      'description'=>'Product Priced by Attributes'),
    array('type'=>'D', 'key'=>'PRODUCT_TAX_CLASS',            'description'=>'Tax Class'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_GROSS',          'description'=>'Products Price (Gross)'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_FREE',           'description'=>'Product is Free'),
    array('type'=>'D', 'key'=>'PRODUCT_PRICE_CALL',           'description'=>'Product is Call for Price'),
    array('type'=>'D', 'key'=>'PRODUCT_VIRTUAL',              'description'=>'Product is Virtual'),
    array('type'=>'D', 'key'=>'PRODUCT_ALWAYS_FREE_SHIPPING', 'description'=>'Always Free Shipping'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_ORDER_MAX',   'description'=>'Product Qty Minimum'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_ORDER_MIN',   'description'=>'Product Qty Maximum'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_ORDER_UNIT',  'description'=>'Product Qty Units'),
    array('type'=>'D', 'key'=>'PRODUCT_QUANTITY_MIXED',       'description'=>'Product Qty Min/Unit Mix'),
    array('type'=>'D', 'key'=>'PRODUCT_WEIGHT',               'description'=>'Products Shipping Weight'),
    array('type'=>'D', 'key'=>'PRODUCT_NUMBER_UNIT',          'description'=>'Number Unit'),
    array('type'=>'D', 'key'=>'PRODUCT_META_TAGS_USAGE',      'description'=>'Meta tag notes'),
    array('type'=>'D', 'key'=>'PRODUCT_CATEGORY_MANAGER',     'description'=>'Link to multiple categories manager'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Orders Status',
  'item'  => array(
    array('type'=>'D', 'key'=>'ORDER_STATUS_LANGUAGE', 'description'=>'Input fields other than Japanese'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Customers',
  'item'  => array(
    array('type'=>'D', 'key'=>'CUSTOMERS_GROUP_PRICING', 'description'=>'Group Pricing'),
    array('type'=>'D', 'key'=>'CUSTOMERS_REFERRAL',      'description'=>'Gift Coupon'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Manufacturers',
  'item'  => array(
    array('type'=>'D', 'key'=>'MANUFACTURERS_LANGUAGE', 'description'=>'Input fields other than Japanese'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Specials',
  'item'  => array(
    array('type'=>'D', 'key'=>'SPECIALS_PRICE_LINK',  'description'=>'Link to the management of price'),
    array('type'=>'D', 'key'=>'SPECIALS_EDIT_LINK',   'description'=>'Link to Edit'),
    array('type'=>'D', 'key'=>'SPECIALS_PRE_ADD',     'description'=>'Link to Selection'),
    array('type'=>'D', 'key'=>'SPECIALS_NUMBER_UNIT', 'description'=>'Number Unit'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Featured Products',
  'item'  => array(
    array('type'=>'D', 'key'=>'FEATURED_PRICE_LINK', 'description'=>'Link to the management of price'),
    array('type'=>'D', 'key'=>'FEATURED_EDIT_LINK',  'description'=>'Link to Edit'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Option Name Manager',
  'item'  => array(
    array('type'=>'D', 'key'=>'OPTIONS_NAME_LANGUAGE',   'description'=>'Input fields other than Japanese'),
    array('type'=>'D', 'key'=>'OPTIONS_NAME_BIG_MODIFY', 'description'=>'Making global changes'),
    array('type'=>'D', 'key'=>'OPTIONS_NAME_LENGTH',     'description'=>'The length of the text attributes'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Option Value Manager',
  'item'  => array(
    array('type'=>'D', 'key'=>'OPTIONS_VALUES_LANGUAGE', 'description'=>'Input fields other than Japanese'),
    array('type'=>'D', 'key'=>'OPTIONS_VALUES_COPY',     'description'=>'Copy Operations'),
    array('type'=>'D', 'key'=>'OPTIONS_VALUES_COPIER',   'description'=>'Featured Products Pulldown'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Attributes Controller',
  'item'  => array(
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_MODIFY',       'description'=>'Editing Products and Price Button'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_CATEGORY',     'description'=>'Link to Link Management of Multiple Category'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_NUMBER_UNIT',  'description'=>'Number Unit'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_WEIGHT',       'description'=>'Weight'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_ONETIME',      'description'=>'One Time'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_PRICE_FACTOR', 'description'=>'Price Factor'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_QTY_PRICES',   'description'=>'Quantity Discounts'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_PRICE_WORDS',  'description'=>'Word / Characters Discount'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_FLAGS',        'description'=>'Flags'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_IMAGE',        'description'=>'Images'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_CATEGORIES',   'description'=>'Categories Selection Pulldown'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_PRODUCTS',     'description'=>'Products Selection Pulldown'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_LEGEND',       'description'=>'Legend'),
    array('type'=>'D', 'key'=>'ATTRIBUTES_CONTROLLER_COLUMN',       'description'=>'Weight, Attribute, Column Discount'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Banner Manager',
  'item'  => array(
    array('type'=>'D', 'key'=>'BANNER_MANAGER_NEW_GROUP',    'description'=>'New Banner'),
    array('type'=>'D', 'key'=>'BANNER_MANAGER_IMAGE_LOCAL',  'description'=>'Image'),
    array('type'=>'D', 'key'=>'BANNER_MANAGER_IMAGE_TARGET', 'description'=>'Image Target (Save To)'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'General Store Configuration',
  'item'  => array(
    array('type'=>'D', 'key'=>'CONFIGURATION_1_2',  'description'=>'Store Owner'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_5',  'description'=>'Stock Product Sort'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_6',  'description'=>'Sort used in the field of Stock items'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_7',  'description'=>'Integration of language and currency'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_8',  'description'=>'Select language'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_10', 'description'=>'Display Cart After Adding Product'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_11', 'description'=>'The default search operator'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_13', 'description'=>'Show items in the category'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_14', 'description'=>'Tax decimal point'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_15', 'description'=>'Show price including tax'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_16', 'description'=>'Show price including tax - Admin Screen'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_17', 'description'=>'Tax applied to products assessment standard'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_18', 'description'=>'Tax applied to shipping assessment standard'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_19', 'description'=>'Show tax'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_23', 'description'=>'Store Status'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_20', 'description'=>'Admin Timeout Settings (in seconds)'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_21', 'description'=>'Maximum time (seconds) setting processing program management screen.'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_22', 'description'=>'Automatically check for new version of Zen Cart(Whether announced on the header)'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_24', 'description'=>'Server uptime'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_25', 'description'=>'Check out the links page'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_26', 'description'=>'HTML Editor'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_27', 'description'=>'Show the link to phpBB'),
    array('type'=>'D', 'key'=>'CONFIGURATION_1_28', 'description'=>'Show items in the category - Admin Screen'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'E-Mail Options',
  'item'  => array(
    array('type'=>'D', 'key'=>'CONFIGURATION_12_206', 'description'=>'E-Mail Transport Method'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_212', 'description'=>'E-Mail Linefeeds'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_213', 'description'=>'Use MIME HTML When Sending Emails'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_214', 'description'=>'E-mail Address in DNS Check'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_215', 'description'=>'Send E-Mails'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_216', 'description'=>'Email Archiving Active?'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_217', 'description'=>'E-Mail Friendly-Errors'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_220', 'description'=>'Emails must send from known domain?'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_221', 'description'=>'Email Admin Format?'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_227', 'description'=>'Send Copy of Customer GV Send Emails To - Status'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_228', 'description'=>'Send Copy of Customer GV Send Emails To'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_229', 'description'=>'Send Copy of Admin GV Mail Emails To - Status'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_230', 'description'=>'Send Copy of Customer Admin GV Mail Emails To'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_231', 'description'=>'Send Copy of Admin Discount Coupon Mail Emails To - Status'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_232', 'description'=>'Send Copy of Customer Admin Discount Coupon Mail Emails To'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_233', 'description'=>'Send Copy of Admin Orders Status Emails To - Status'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_234', 'description'=>'Send Copy of Admin Orders Status Emails To'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_235', 'description'=>'Send Notice of Pending Reviews Emails To - Status'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_236', 'description'=>'Send Notice of Pending Reviews Emails To'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_237', 'description'=>'Set "Contact Us" Email Dropdown List'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_238', 'description'=>'Allow Guest To Tell A Friend'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_239', 'description'=>'Contact Us - Show Store Name and Address'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_240', 'description'=>'Send Low Stock Emails'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_242', 'description'=>'Display "Newsletter Unsubscribe" Link?'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_243', 'description'=>'Audience-Select Count Display'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_207', 'description'=>'SMTP Email Account Mailbox'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_208', 'description'=>'SMTP Email Account Password'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_209', 'description'=>'SMTP Email Mail Host'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_210', 'description'=>'SMTP Email Mail Server Port'),
    array('type'=>'D', 'key'=>'CONFIGURATION_12_211', 'description'=>'Convert currencies for Text emails'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Order Total Modules',
  'item'  => array(
    array('type'=>'D', 'key'=>'MODULES_OT_SHIPPING', 'description'=>'Shipping'),
    array('type'=>'D', 'key'=>'MODULES_OT_SUBTOTAL', 'description'=>'Sub-Total'),
    array('type'=>'D', 'key'=>'MODULES_OT_TOTAL',    'description'=>'Total'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'Super orders',
  'item'  => array(
    array('type'=>'D', 'key'=>'SUPER_ORDERS_PAYMENT',     'description'=>'Payment information'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_FINAL',       'description'=>'Finalizing Order'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_SPLIT',       'description'=>'Split pack'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_PRODUCTS',    'description'=>'Modify Products'),
    array('type'=>'D', 'key'=>'SUPER_ORDERS_NUMBER_UNIT', 'description'=>'Number Unit'),
  )
);
$easy_admin_simplify_config[] = array(
  'title' => 'SaleMaker',
  'item'  => array(
    array('type'=>'D', 'key'=>'SALEMAKER_NUMBER_UNIT', 'description'=>'Number Unit'),
  )
);
?>