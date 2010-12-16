<?php
/**
 * easy_reviews Module
 *
 * @package Viewed_products
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: addon_modules_example.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class easy_reviews extends addonModuleBase {
    var $author                        = array("saito",
                                               "kohata",
                                               "Koji Sasaki");
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $title = MODULE_EASY_REVIEWS_TITLE;
    var $description = MODULE_EASY_REVIEWS_DESCRIPTION;
    var $sort_order = MODULE_EASY_REVIEWS_SORT_ORDER;
    var $icon;
    var $status = MODULE_EASY_REVIEWS_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_EASY_REVIEWS_STATUS_TITLE,
            'configuration_key' => 'MODULE_EASY_REVIEWS_STATUS',
            'configuration_value' => MODULE_EASY_REVIEWS_STATUS_DEFAULT,
            'configuration_description' => MODULE_EASY_REVIEWS_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_TITLE,
            'configuration_key' => 'MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS',
            'configuration_value' => MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_DEFAULT,
            'configuration_description' => MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_TITLE,
            'configuration_key' => 'MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN',
            'configuration_value' => MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_DEFAULT,
            'configuration_description' => MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_EASY_REVIEWS_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_EASY_REVIEWS_SORT_ORDER',
            'configuration_value' => MODULE_EASY_REVIEWS_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_EASY_REVIEWS_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $notifier = array(
          );

    // class constructer for php4
    function easy_reviews() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    // blocks
    function block() {
      global $db, $messageStack;
      $return = array();
      if (!strstr($_GET['main_page'], 'product_') && !strstr($_GET['main_page'], 'document_')){ return $return; }
      if (strstr($_GET['main_page'], 'reviews_info')||strstr($_GET['main_page'], 'reviews_write')){ return $return; }
      define('TEXT_OF_5_STARS', '');

      $display_form = true;
      $display_list = true;
      if (!$_SESSION['customer_id'] || !empty($_SESSION['visitors_id'])) {
        $display_form = false;
        if (MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN == 'true') {
          $display_list = false;
        }
      }
      if (!zen_products_id_valid($_GET['products_id']) ) {
        $display_form = false;
        $display_list = false;
      }

      if ($display_form) {
        $query = "
          SELECT customers_firstname, customers_lastname, customers_email_address
          FROM " . TABLE_CUSTOMERS . "
          WHERE customers_id = :customersID
          ;";
        $query = $db->bindVars($query, ':customersID', $_SESSION['customer_id'], 'integer');
        $customer = $db->Execute($query);
      }

      $reviews = array();

      if ($display_list) {
        $query = "
          SELECT r.reviews_id, reviews_text, r.reviews_rating, r.date_added, r.customers_name
          FROM " . TABLE_REVIEWS . " r
            , " . TABLE_REVIEWS_DESCRIPTION . " rd
          WHERE r.products_id = :productsID
            AND r.reviews_id = rd.reviews_id
            AND rd.languages_id = :languagesID
            AND r.status = 1
          ORDER BY r.reviews_id desc
          LIMIT :limit
          ;";
        $query = $db->bindVars($query, ':productsID', $_GET['products_id'], 'integer');
        $query = $db->bindVars($query, ':languagesID', $_SESSION['languages_id'], 'integer');
        $query = $db->bindVars($query, ':limit', MODULE_EASY_REVIEWS_MAX_DISPLAY_NEW_REVIEWS, 'integer');
        $result = $db->Execute($query);

        while (!$result->EOF) {
          $reviews[] = array(
            'id' => $result->fields['reviews_id'],
            'customersName' => $result->fields['customers_name'],
            'dateAdded' => $result->fields['date_added'],
            'reviewsText' => $result->fields['reviews_text'],
            'reviewsRating' => $result->fields['reviews_rating'],
          );
          $result->MoveNext();
        }
      }

      if ($display_form || $display_list) {
        $return['title'] = MODULE_EASY_REVIEWS_BLOCK_TITLE;
        $return['display_form'] = $display_form;
        $return['display_list'] = $display_list;
        $return['messageStack'] = $messageStack;
        $return['customer'] = $customer;
        $return['reviews'] = $reviews;
      }
      return $return;
    }

    // page methods
    function page_product_reviews() {
      global $db,$template,$breadcrumb,$products_image,$current_page_base,$review,$products_name,$products_model,$products_price,$reviews_split,$reviewsArray;

      // check product exists and current
      // if product does not exist or is status 0 send to _info page
	    $products_reviews_check_query = "SELECT count(*) AS count
	                                     FROM " . TABLE_PRODUCTS . " p
	                                     WHERE p.products_id= :productsID
	                                     AND p.products_status = 1";

      $products_reviews_check_query = $db->bindVars($products_reviews_check_query, ':productsID', $_GET['products_id'], 'integer');
      $products_reviews_check = $db->Execute($products_reviews_check_query);

      if ($products_reviews_check->fields['count'] < 1) {
        zen_redirect(zen_href_link(zen_get_info_page((int)$_GET['products_id']), 'products_id=' . (int)$_GET['products_id']));
      }

      $review_query_raw = "SELECT p.products_id, p.products_price, p.products_tax_class_id, p.products_image, p.products_model, pd.products_name
                           FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                           WHERE p.products_id = :productsID
                           AND p.products_status = 1
                           AND p.products_id = pd.products_id
                           AND pd.language_id = :languagesID";

      $review_query_raw = $db->bindVars($review_query_raw, ':productsID', $_GET['products_id'], 'integer');
      $review_query_raw = $db->bindVars($review_query_raw, ':languagesID', $_SESSION['languages_id'], 'integer');
      $review = $db->Execute($review_query_raw);

      $products_price = zen_get_products_display_price($review->fields['products_id']);

      if (zen_not_null($review->fields['products_model'])) {
        $products_name = $review->fields['products_name'] . '<br /><span class="smallText">[' . $review->fields['products_model'] . ']</span>';
      } else {
        $products_name = $review->fields['products_name'];
      }

      // set image
      //  $products_image = $review->fields['products_image'];
      if ($review->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
        $products_image = PRODUCTS_IMAGE_NO_IMAGE;
      } else {
        $products_image = $review->fields['products_image'];
      }

      $reviews_available = true;
      if (MODULE_EASY_REVIEWS_LIST_DISPLAY_FORCE_LOGIN == 'true' && (empty($_SESSION['customer_id']) || !empty($_SESSION['visitors_id'])) ) {
        $reviews_available = false;
      }

      if ($reviews_available) {
      $review_status = " and r.status = 1";

      $reviews_query_raw = "SELECT r.reviews_id, reviews_text, r.reviews_rating, r.date_added, r.customers_name
                            FROM " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd
                            WHERE r.products_id = :productsID
                            AND r.reviews_id = rd.reviews_id
                            AND rd.languages_id = :languagesID " . $review_status . "
                            ORDER BY r.reviews_id desc";

      $reviews_query_raw = $db->bindVars($reviews_query_raw, ':productsID', $_GET['products_id'], 'integer');
      $reviews_query_raw = $db->bindVars($reviews_query_raw, ':languagesID', $_SESSION['languages_id'], 'integer');
      $reviews_split = new splitPageResults($reviews_query_raw, MAX_DISPLAY_NEW_REVIEWS);
      $reviews = $db->Execute($reviews_split->sql_query);
      $reviewsArray = array();
      while (!$reviews->EOF) {
      	$reviewsArray[] = array('id'=>$reviews->fields['reviews_id'],
      	                        'customersName'=>$reviews->fields['customers_name'],
      	                        'dateAdded'=>$reviews->fields['date_added'],
      	                        'reviewsText'=>$reviews->fields['reviews_text'],
      	                        'reviewsRating'=>$reviews->fields['reviews_rating']);
        $reviews->MoveNext();
      }
      }



      require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
      $breadcrumb->add(MODULE_EASY_REVIEWS_NAVBAR_TITLE);

    	$return = array();
      $return['title'] = 'aaa';

      $return['var_1'] = TEXT_VAR_1;
      $return['var_2'] = TEXT_VAR_2;
      $return['var_3'] = TEXT_VAR_3;
      return $return;
    }
    function page_product_reviews_write() {
      global $db,$template,$breadcrumb,$products_image,$current_page_base,$customer,$products_name,$products_model,$products_price,$messageStack;

      if (!$_SESSION['customer_id'] || !empty($_SESSION['visitors_id'])) {
        $_SESSION['navigation']->set_snapshot();
        zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
      }

      require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

      $product_info_query = "SELECT p.products_id, p.products_model, p.products_image,
                                    p.products_price, p.products_tax_class_id, pd.products_name
                             FROM " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                             WHERE p.products_id = :productsID
                             AND p.products_status = '1'
                             AND p.products_id = pd.products_id
                             AND pd.language_id = :languagesID";

      $product_info_query = $db->bindVars($product_info_query, ':productsID', $_GET['products_id'], 'integer');
      $product_info_query = $db->bindVars($product_info_query, ':languagesID', $_SESSION['languages_id'], 'integer');
      $product_info = $db->Execute($product_info_query);

      if (!$product_info->RecordCount()) {
        zen_redirect(zen_href_link(FILENAME_PRODUCT_REVIEWS, zen_get_all_get_params(array('action'))));
      }

      $customer_query = "SELECT customers_firstname, customers_lastname, customers_email_address
                         FROM " . TABLE_CUSTOMERS . "
                         WHERE customers_id = :customersID";


      $customer_query = $db->bindVars($customer_query, ':customersID', $_SESSION['customer_id'], 'integer');
      $customer = $db->Execute($customer_query);

      if (isset($_GET['action']) && ($_GET['action'] == 'process')) {
        $rating = zen_db_prepare_input($_POST['rating']);
        $review_text = zen_db_prepare_input($_POST['review_text']);

        $error = false;
        if (strlen($review_text) < REVIEW_TEXT_MIN_LENGTH) {
          $error = true;

          $messageStack->add('review_text', JS_REVIEW_TEXT);
        }

        if (($rating < 1) || ($rating > 5)) {
          $error = true;

          $messageStack->add('review_text', JS_REVIEW_RATING);
        }

        if ($error == false) {
          if (REVIEWS_APPROVAL == '1') {
            $review_status = '0';
          } else {
            $review_status = '1';
          }

          $sql = "INSERT INTO " . TABLE_REVIEWS . " (products_id, customers_id, customers_name, reviews_rating, date_added, status)
                  VALUES (:productsID, :cutomersID, :customersName, :rating, now(), " . $review_status . ")";


          $sql = $db->bindVars($sql, ':productsID', $_GET['products_id'], 'integer');
          $sql = $db->bindVars($sql, ':cutomersID', $_SESSION['customer_id'], 'integer');
          $sql = $db->bindVars($sql, ':customersName', $customer->fields['customers_firstname'] . ' ' . $customer->fields['customers_lastname'], 'string');
          $sql = $db->bindVars($sql, ':rating', $rating, 'string');

          $db->Execute($sql);

          $insert_id = $db->Insert_ID();

          $sql = "INSERT INTO " . TABLE_REVIEWS_DESCRIPTION . " (reviews_id, languages_id, reviews_text)
                  VALUES (:insertID, :languagesID, :reviewText)";

          $sql = $db->bindVars($sql, ':insertID', $insert_id, 'integer');
          $sql = $db->bindVars($sql, ':languagesID', $_SESSION['languages_id'], 'integer');
          $sql = $db->bindVars($sql, ':reviewText', $review_text, 'string');

          $db->Execute($sql);
          // send review-notification email to admin
          if (REVIEWS_APPROVAL == '1' && SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO_STATUS == '1' and defined('SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO') and SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO !='') {
            $email_text  = sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_INTRO, $product_info->fields['products_name']) . "\n\n" ;
            $email_text .= sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS, $review_text)."\n\n";
            $email_subject = sprintf(EMAIL_REVIEW_PENDING_SUBJECT,$product_info->fields['products_name']);
            $html_msg['EMAIL_SUBJECT'] = sprintf(EMAIL_REVIEW_PENDING_SUBJECT,$product_info->fields['products_name']);
            $html_msg['EMAIL_MESSAGE_HTML'] = str_replace('\n','',sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_INTRO, $product_info->fields['products_name']));
            $html_msg['EMAIL_MESSAGE_HTML'] .= '<br />';
            $html_msg['EMAIL_MESSAGE_HTML'] .= str_replace('\n','',sprintf(EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS, $review_text));
            $extra_info=email_collect_extra_info($name,$email_address, $customer->fields['customers_firstname'] . ' ' . $customer->fields['customers_lastname'] , $customer->fields['customers_email_address'] );
            $html_msg['EXTRA_INFO'] = $extra_info['HTML'];
            zen_mail('', SEND_EXTRA_REVIEW_NOTIFICATION_EMAILS_TO, $email_subject ,
            $email_text . $extra_info['TEXT'], STORE_NAME, EMAIL_FROM, $html_msg, 'reviews_extra');
          }
          // end send email

          zen_redirect(zen_href_link(FILENAME_ADDON,'module=easy_reviews/product_reviews_write_complete&products_id='.$_GET['products_id'] ));

        }
      }

      $products_price = zen_get_products_display_price($product_info->fields['products_id']);

      $products_name = $product_info->fields['products_name'];

      if ($product_info->fields['products_model'] != '') {
        $products_model = '<br /><span class="smallText">[' . $product_info->fields['products_model'] . ']</span>';
      } else {
        $products_model = '';
      }

      // set image
      //  $products_image = $product_info->fields['products_image'];
      if ($product_info->fields['products_image'] == '' and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
        $products_image = PRODUCTS_IMAGE_NO_IMAGE;
      } else {
        $products_image = $product_info->fields['products_image'];
      }

      $breadcrumb->add(MODULE_EASY_REVIEWS_NAVBAR_TITLE);

      $return = array();
      return $return;
    }
    function page_product_reviews_write_complete() {
      $return = array();
      return $return;

    }
    function _page_metatags() {
      $return = array();
      $return['title'] = 'addon_modules_example meta tag title';
      $return['description'] = 'addon_modules_example meta tag description';
      $return['keywords'] = 'addon_modules_example meta tag keywords';
      return $return;
    }
    function _page_breadcrumb() {
      $return = array();
      $return[] = array('title' => MODULE_EASY_REVIEWS_NAVBAR_TITLE, 'link' => null);
      return $return;
    }
    function _page_product_reviews_write_complete_breadcrumb() {
      $return = array();
      $return[] = array('title' => MODULE_EASY_REVIEWS_NAVBAR_TITLE, 'link' => null);
      return $return;
    }

  }
?>