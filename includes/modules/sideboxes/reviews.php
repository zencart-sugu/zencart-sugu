<?php
/**
 * reviews sidebox - displays a random product-review 
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: reviews.php 2718 2005-12-28 06:42:39Z drbyte $
 */

// if review must be approved or disabled do not show review
  $review_status = " and r.status = 1 ";

  $random_review_sidebox_select = "select r.reviews_id, r.reviews_rating, p.products_id, p.products_image, pd.products_name
                    from " . TABLE_REVIEWS . " r, " . TABLE_REVIEWS_DESCRIPTION . " rd, "
                           . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd
                    where p.products_status = '1'
                    and p.products_id = r.products_id
                    and r.reviews_id = rd.reviews_id
                    and rd.languages_id = '" . (int)$_SESSION['languages_id'] . "'
                    and p.products_id = pd.products_id
                    and pd.language_id = '" . (int)$_SESSION['languages_id'] . "'" .
                    $review_status;

  if (isset($_GET['products_id'])) {
    $random_review_sidebox_select .= " and p.products_id = '" . (int)$_GET['products_id'] . "'";
  }
  $random_review_sidebox_select .= " limit " . MAX_RANDOM_SELECT_REVIEWS;
  $random_review_sidebox_product = zen_random_select($random_review_sidebox_select);
  if ($random_review_sidebox_product->RecordCount() > 0) {
// display random review box
    $review_box_text_query = "select substring(reviews_text, 1, 60) as reviews_text
                     from " . TABLE_REVIEWS_DESCRIPTION . "
                     where reviews_id = '" . (int)$random_review_sidebox_product->fields['reviews_id'] . "'
                     and languages_id = '" . (int)$_SESSION['languages_id'] . "'";

    $review_box_text = $db->Execute($review_box_text_query);

//    $review_box_text = zen_break_string(zen_output_string_protected($review_box_text->fields['reviews_text']), 15, '-<br />');
    $review_box_text = zen_break_string(nl2br(zen_output_string_protected(stripslashes($review_box_text->fields['reviews_text']))), 60, '-<br />');

    require($template->get_template_dir('tpl_reviews_random.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_reviews_random.php');
  } elseif (isset($_GET['products_id']) and zen_products_id_valid($_GET['products_id'])) {
// display 'write a review' box
    require($template->get_template_dir('tpl_reviews_write.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_reviews_write.php');
  } else {
// display 'no reviews' box
    require($template->get_template_dir('tpl_reviews_none.php',DIR_WS_TEMPLATE, $current_page_base,'sideboxes'). '/tpl_reviews_none.php');
  }
  $title =  BOX_HEADING_REVIEWS;
  $title_link = FILENAME_REVIEWS;
  require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base,'common') . '/' . $column_box_default);
?>