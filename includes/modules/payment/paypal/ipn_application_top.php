<?php
/**
 * special application_top for Paypal IPN payment method
 *
 * @package paymentMethod
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ipn_application_top.php 3054 2006-02-19 12:01:34Z wilt $
 */

/**
 * boolean used to see if we are in the admin script, obviously set to false here.
 */
define('IS_ADMIN_FLAG', false);

  
  error_reporting(0);

  @ini_set("arg_separator.output","&");

// Set the local configuration parameters - mainly for developers
  if (file_exists('includes/local/configure.php')) {
    include('includes/local/configure.php');
  }
// include server parameters
  if (file_exists('includes/configure.php')) {
    include('includes/configure.php');
  }

  require('includes/classes/class.base.php');
  require('includes/classes/class.notifier.php');
  require('includes/classes/class.phpmailer.php');
  require('includes/classes/class.smtp.php');
  $zco_notifier = new notifier();

  require('includes/classes/db/' .DB_TYPE . '/query_factory.php');
  $db = new queryFactory();
  if ( !$db->connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE, USE_PCONNECT, false) ) {
    die('Cannot connect to database. Please notify webmaster.');
    exit;
  }


// set the type of request (secure or not)
  $request_type = (strtolower($_SERVER['HTTPS']) == 'on' || $_SERVER['HTTPS'] == '1' || strstr(strtoupper($_SERVER['HTTP_X_FORWARDED_BY']),'SSL') || strstr(strtoupper($_SERVER['HTTP_X_FORWARDED_HOST']),'SSL'))  ? 'SSL' : 'NONSSL';

// set php_self in the local scope
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

// include the list of project filenames
  require(DIR_WS_INCLUDES . 'filenames.php');

// include the list of project database tables
  require(DIR_WS_INCLUDES . 'database_tables.php');

// include the list of compatibility issues
  require(DIR_WS_FUNCTIONS . 'compatibility.php');

// include the list of extra database tables and filenames
//  include(DIR_WS_MODULES . 'extra_datafiles.php');
  if ($za_dir = @dir(DIR_WS_INCLUDES . 'extra_datafiles')) {
    while ($zv_file = $za_dir->read()) {
      if (preg_match('/\.php$/', $zv_file) > 0) {
        require(DIR_WS_INCLUDES . 'extra_datafiles/' . $zv_file);
      }
    }
  }

// include the cache class
  require(DIR_WS_CLASSES . 'cache.php');
  $zc_cache = new cache;

  $configuration = $db->Execute('select configuration_key as cfgkey, configuration_value as cfgvalue
                                 from ' . TABLE_CONFIGURATION, '', true, 150);

  while (!$configuration->EOF) {
//    define($configuration->fields['cfgkey'], $configuration->fields['cfgvalue']);
    define($configuration->fields['cfgkey'], $configuration->fields['cfgvalue']);
//    echo $configuration->fields['cfgkey'] . '#';
    $configuration->MoveNext();
  }
// Load the database dependant query defines
  if (file_exists(DIR_WS_CLASSES . 'db/' . DB_TYPE . '/define_queries.php')) {
    include(DIR_WS_CLASSES . 'db/' . DB_TYPE . '/define_queries.php');
  }

// define general functions used application-wide
  require(DIR_WS_FUNCTIONS . 'functions_general.php');
  require(DIR_WS_FUNCTIONS . 'html_output.php');
  require(DIR_WS_FUNCTIONS . 'functions_email.php');

// load extra functions
  include(DIR_WS_MODULES . 'extra_functions.php');


// set the top level domains
  $http_domain = zen_get_top_level_domain(HTTP_SERVER);
  $https_domain = zen_get_top_level_domain(HTTPS_SERVER);
  $current_domain = (($request_type == 'NONSSL') ? $http_domain : $https_domain);
  if (SESSION_USE_FQDN == 'False') $current_domain = '.' . $current_domain;


// include shopping cart class
  require(DIR_WS_CLASSES . 'shopping_cart.php');


// include navigation history class
  require(DIR_WS_CLASSES . 'navigation_history.php');

// define how the session functions will be used
  require(DIR_WS_FUNCTIONS . 'sessions.php');

// set the session name and save path
  zen_session_name('zenid');
  zen_session_save_path(SESSION_WRITE_DIRECTORY);

// set the session cookie parameters
    session_set_cookie_params(0, '/', (zen_not_null($current_domain) ? $current_domain : ''));

// set the session ID if it exists
   if (isset($_POST[zen_session_name()])) {
     zen_session_id($_POST[zen_session_name()]);
   } elseif ( ($request_type == 'SSL') && isset($_GET[zen_session_name()]) ) {
     zen_session_id($_GET[zen_session_name()]);
   }

// start the session
  $session_started = false;
  if (SESSION_FORCE_COOKIE_USE == 'True') {
    zen_setcookie('cookie_test', 'please_accept_for_session', time()+60*60*24*30, '/', (zen_not_null($current_domain) ? $current_domain : ''));

    if (isset($_COOKIE['cookie_test'])) {
      zen_session_start();
      $session_started = true;
    }
  } elseif (SESSION_BLOCK_SPIDERS == 'True') {
    $user_agent = strtolower($_SERVER['HTTP_USER_AGENT']);
    $spider_flag = false;

    if (zen_not_null($user_agent)) {
      $spiders = file(DIR_WS_INCLUDES . 'spiders.txt');

      for ($i=0, $n=sizeof($spiders); $i<$n; $i++) {
        if (zen_not_null($spiders[$i])) {
          if (is_integer(strpos($user_agent, trim($spiders[$i])))) {
            $spider_flag = true;
            break;
          }
        }
      }
    }

    if ($spider_flag == false) {
      zen_session_start();
      $session_started = true;
    }
  } else {
    zen_session_start();
    $session_started = true;
  }
  
// need to see if we are in test mode. If so then the data is going to come in as a GET string
  if (MODULE_PAYMENT_PAYPAL_TESTING == 'Test') {
    foreach ($_GET as $key=>$value) {
      $_POST[$key] = $value;
    }
  }  
  if (!$_POST) {
    ipn_debug_email('IPN FATAL ERROR::No POST data available'); 
  }
  
  
  $session_post = $_POST['custom'];
  $session_stuff = explode('=', $session_post);
  $ipnFoundSession = true;
  if (ipn_get_stored_session($session_stuff) === false) {
    ipn_debug_email('IPN FATAL ERROR::No saved session data available'); 
    $ipnFoundSession = false;
  }
// create the shopping cart & fix the cart if necesary
  if (!$_SESSION['cart']) {
    $_SESSION['cart'] = new shoppingCart;
  }


// include currencies class and create an instance
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();


// set the language
  if (!$_SESSION['language'] || isset($_GET['language'])) {

    require(DIR_WS_CLASSES . 'language.php');

    $lng = new language();

    if (isset($_GET['language']) && zen_not_null($_GET['language'])) {
      $lng->set_language($_GET['language']);
    } else {
      $lng->get_browser_language();
      $lng->set_language(DEFAULT_LANGUAGE);
    }

    $_SESSION['language'] = $lng->language['directory'];
    $_SESSION['languages_id'] = $lng->language['id'];

  }

// Set theme related directories
  $sql = "select template_dir
          from " . TABLE_TEMPLATE_SELECT .
         " where template_language = '0'";

  $template_query = $db->Execute($sql);

  $template_dir = $template_query->fields['template_dir'];

  $sql = "select template_dir
          from " . TABLE_TEMPLATE_SELECT .
         " where template_language = '" . $_SESSION['languages_id'] . "'";

  $template_query = $db->Execute($sql);

  if ($template_query->RecordCount() > 0) {
      $template_dir = $template_query->fields['template_dir'];
  }
//if (template_switcher_available=="YES") $template_dir = templateswitch_custom($current_domain);
  define('DIR_WS_TEMPLATE', DIR_WS_TEMPLATES . $template_dir . '/');

  define('DIR_WS_TEMPLATE_IMAGES', DIR_WS_TEMPLATE . 'images/');
  define('DIR_WS_TEMPLATE_ICONS', DIR_WS_TEMPLATE_IMAGES . 'icons/');

  require(DIR_WS_CLASSES . 'template_func.php');
  $template = new template_func(DIR_WS_TEMPLATE);

// include the language translations
// include template specific language files
  if (file_exists(DIR_WS_LANGUAGES . $template_dir . '/' . $_SESSION['language'] . '.php')) {
    $template_dir_select = $template_dir . '/';
//die('Yes ' . DIR_WS_LANGUAGES . $template_dir . '/' . $_SESSION['language'] . '.php');
  } else {
//die('NO ' . DIR_WS_LANGUAGES . $template_dir . '/' . $_SESSION['language'] . '.php');
    $template_dir_select = '';
  }


  include(DIR_WS_LANGUAGES . $template_dir_select . $_SESSION['language'] . '.php');
  ipn_debug_email('IPN NOTICE::Got past language loads'); 

// include the extra language translations
  include(DIR_WS_MODULES . 'extra_definitions.php');

// currency
  if (!$_SESSION['currency'] || isset($_GET['currency']) || ( (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') && (LANGUAGE_CURRENCY != $_SESSION['currency']) ) ) {
    if (isset($_GET['currency'])) {
      if (!$_SESSION['currency'] = zen_currency_exists($_GET['currency'])) $_SESSION['currency'] = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    } else {
      $_SESSION['currency'] = (USE_DEFAULT_LANGUAGE_CURRENCY == 'true') ? LANGUAGE_CURRENCY : DEFAULT_CURRENCY;
    }
  }
?>