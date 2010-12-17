<?php
/**
 * configure.php
 *
 * @package zen-cart addon module google analytics
 * @copyright Copyright 2004-2008 Andrew Berezin eCommerce-Service.com
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: cpmfogire.php $
 * based on tpl_footer_googleanalytics.php, v 2.2.1 01.09.2008 01:23 Andrew Berezin
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
define('MODULE_GOOGLE_ANALYTICS_STATUS_DEFAULT',             'true');
define('MODULE_GOOGLE_ANALYTICS_SORT_ORDER_DEFAULT',         '100');

define('MODULE_GOOGLE_ANALYTICS_ACCOUNT_DEFAULT',                     'UA-XXXXXX-X');
define('MODULE_GOOGLE_ANALYTICS_TARGET_DEFAULT',                      'customers');
define('MODULE_GOOGLE_ANALYTICS_AFFILIATION_DEFAULT',                 '');
define('MODULE_GOOGLE_ANALYTICS_SKU_OR_CODE_DEFAULT',                 'products_id');
define('MODULE_GOOGLE_ANALYTICS_PAGENAME_DEFAULT',                    'false');
define('MODULE_GOOGLE_ANALYTICS_BRACKETS_DEFAULT',                    '[]');
define('MODULE_GOOGLE_ANALYTICS_DELIMITER_DEFAULT',                   ';');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_DEFAULT',                    'false');
define('MODULE_GOOGLE_ANALYTICS_OUTBOUND_LINKS_PREFIX_DEFAULT',       '/outgoing/');
define('MODULE_GOOGLE_ANALYTICS_USE_ADWORDS_CONVERSION_DEFAULT',      'true');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_ID_DEFAULT',       '');
define('MODULE_GOOGLE_ANALYTICS_ADWORDS_CONVERSION_LANGUAGE_DEFAULT', 'ja_JP');

?>