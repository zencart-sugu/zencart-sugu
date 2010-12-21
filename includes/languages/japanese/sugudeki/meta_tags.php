<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: meta_tags.php 2555 2005-12-13 05:37:01Z drbyte $
 */


// Site Tagline
define('SITE_TAGLINE', '');

// Custom Keywords
define('CUSTOM_KEYWORDS', '');

// Review Page can have a lead in:
define('META_TAGS_REVIEW', 'Reviews: ');

// separators for meta tag definitions
// Define Primary Section Output
  define('PRIMARY_SECTION', ' : ');

// Define Secondary Section Output
  define('SECONDARY_SECTION', ' - ');

// Define Tertiary Section Output
  define('TERTIARY_SECTION', ', ');

// Define which pages to tell robots/spiders not to index
// This is generally used for account-management pages or typical SSL pages, and usually doesn't need to be touched.
  define('ROBOTS_PAGES_TO_SKIP','login,logoff,create_account,account,account_edit,account_history,account_history_info,account_newsletters,account_notifications,account_password,address_book,advanced_search,advanced_search_result,checkout_success,checkout_process,checkout_shipping,checkout_payment,checkout_confirmation,cookie_usage,create_account_success,contact_us,download,download_timeout,customers_authorization,down_for_maintenance,password_forgotten,time_out,unsubscribe');


// favicon setting
// There is usually NO need to enable this unless you wish to specify a path and/or a different filename
//  define('FAVICON','favicon.ico');


// page title
if (isset($_GET['cPath'])) {
  $title_categories_name_array = array();
  $path_array = explode('_', $_GET['cPath']);
  for ($i=0, $j=sizeof($path_array); $i<$j-1; $i++) {
    $sql = "select cd.categories_name from " . TABLE_CATEGORIES . ' c, ' . TABLE_CATEGORIES_DESCRIPTION . " cd where c.categories_id = cd.categories_id and cd.categories_id = '" . (int)$path_array[$i] . "' and cd.language_id = '" . (int)$_SESSION['languages_id'] . "' and c.categories_status=1";
    $categories_name = $db->Execute($sql);
    if (!$categories_name->EOF) {
      $title_categories_name_array[] = $categories_name->fields['categories_name'];
    }
  }
  $title_categories_name_array = array_reverse($title_categories_name_array);
  $title_categories_name = implode(PRIMARY_SECTION, $title_categories_name_array);
  define('TITLE', $title_categories_name . PRIMARY_SECTION . STORE_NAME);
} else {
  define('TITLE', STORE_NAME);
}

?>