<?php
/**
 * addon_modules block Template
 *
 * @package templateSystem
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: block.php $
 */

?>
<div class="centerColumn" id="reviewsDefault">
<?php
  if (zen_not_null($products_image)) {
  /**
   * require the image display code
   */
?>
<div id="productReviewsDefaultProductImage" class="centeredContent back"><?php require($template->get_template_dir('/tpl_modules_main_product_image.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_main_product_image.php'); ?></div>
<?php
  }
?>
<div class="forward">
<div class="buttonRow">
<?php
        // more info in place of buy now
        if (zen_has_product_attributes($review->fields['products_id'] )) {
          //   $link = '<p>' . '<a href="' . zen_href_link(zen_get_info_page($review->fields['products_id']), 'products_id=' . $review->fields['products_id'] ) . '">' . MORE_INFO_TEXT . '</a>' . '</p>';
          $link = '';
        } else {
          $link= '<a href="' . zen_href_link($_GET['main_page'], zen_get_all_get_params(array('action', 'reviews_id')) . 'action=buy_now') . '">' . zen_image_button(BUTTON_IMAGE_IN_CART, BUTTON_IN_CART_ALT) . '</a>';
        }
        $the_button = $link;
        $products_link = '';
        echo zen_get_buy_now_button($review->fields['products_id'], $the_button, $products_link) . '<br />' . zen_get_products_quantity_min_units_display($review->fields['products_id']);
      ?>
</div>
<div id="productReviewsDefaultProductPageLink" class="buttonRow"><?php echo '<a href="' . zen_href_link(zen_get_info_page($_GET['products_id']), zen_get_all_get_params(array('reviews_id'))) . '">' . zen_image_button(BUTTON_IMAGE_GOTO_PROD_DETAILS , BUTTON_GOTO_PROD_DETAILS_ALT) . '</a>'; ?></div>
</div>

<h1 id="productReviewsDefaultHeading"><?php echo $products_name . $products_model; ?></h1>

<h2 id="productReviewsDefaultPrice" class=""><?php echo $products_price; ?></h2>

<br class="clearBoth" />

<?php
  if ($reviews_split->number_of_rows > 0) {
    if ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3')) {
?>

<div id="productReviewsDefaultListingTopNumber" class="navSplitPagesResult"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div>

<div id="productReviewsDefaultListingTopLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>

<?php
    }
    foreach ($reviewsArray as $reviews) {
?>
<hr />

<div  id="productReviewsDefaultReviewer" class="bold"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, zen_date_short($reviews['dateAdded'])); ?>&nbsp;<?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected($reviews['customersName'])); ?></div>

<div class="rating"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $reviews['reviewsRating'] . '.gif', sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating'])), sprintf(TEXT_OF_5_STARS, $reviews['reviewsRating']); ?></div>

<div id="productReviewsDefaultProductMainContent" class="content"><?php echo nl2br(zen_output_string_protected(stripslashes($reviews['reviewsText']))) ; ?></div>

<br class="clearBoth" />
<?php
    }
?>
<?php
  } else {
?>
<hr />
<div id="productReviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS . (REVIEWS_APPROVAL == '1' ? '<br />' . TEXT_APPROVAL_REQUIRED: ''); ?></div>
<br class="clearBoth" />
<?php
  }

  if (($reviews_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<hr />
<div id="productReviewsDefaultListingBottomNumber" class="navSplitPagesResult"><?php echo $reviews_split->display_count(TEXT_DISPLAY_NUMBER_OF_REVIEWS); ?></div>
<div id="productReviewsDefaultListingBottomLinks" class="navSplitPagesLinks"><?php echo TEXT_RESULT_PAGE . ' ' . $reviews_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'main_page'))); ?></div>

<?php
  }
?>

    <div class="buttonRow forward">
<?php
      echo '<a href="' . zen_href_link(FILENAME_ADDON,'module=easy_reviews/product_reviews_write&products_id='.$_GET['products_id']) . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>';
//    if ($_SESSION['customer_id']){
//        echo '<a href="' . zen_href_link(FILENAME_PRODUCT_INFO,'products_id='.$_GET['products_id']) . '#product_reviews_form">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>';
//    }else{
//        echo '<a href="' . zen_href_link(FILENAME_LOGIN,'') . '">' . zen_image_button(BUTTON_IMAGE_WRITE_REVIEW, BUTTON_WRITE_REVIEW_ALT) . '</a>';
//    }
?>

    </div>

</div>

