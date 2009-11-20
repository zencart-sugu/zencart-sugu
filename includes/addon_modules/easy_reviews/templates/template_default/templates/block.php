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
<?php
if ($display_form):
?>
<div class="centerColumn" id="reviewsWrite">
<a name="product_reviews_form"></a>
<?php //echo zen_draw_form('product_reviews_write', zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'action=process&products_id=' . $_GET['products_id'], 'SSL'), 'post', 'onsubmit="return checkForm(product_reviews_write);"'); ?>
<?php echo zen_draw_form('product_reviews_write', zen_href_link(FILENAME_ADDON, 'module=easy_reviews/product_reviews_write&action=process&products_id=' . $_GET['products_id'], 'SSL'), 'post', 'onsubmit="return checkForm(product_reviews_write);"'); ?>

<?php if ($messageStack->size('review_text') > 0) echo $messageStack->output('review_text'); ?>

<div id="reviewsWriteReviewsRate" class="center"><?php echo SUB_TITLE_RATING; ?></div>

<div class="ratingRow">
<?php echo zen_draw_radio_field('rating', '1', '', 'id="rating-1"'); ?>
<?php echo '<label class="" for="rating-1">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_ONE, DIR_WS_TEMPLATE, $page,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_ONE, OTHER_REVIEWS_RATING_STARS_ONE_ALT) . '</label> '; ?>

<?php echo zen_draw_radio_field('rating', '2', '', 'id="rating-2"'); ?>
<?php echo '<label class="" for="rating-2">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_TWO, DIR_WS_TEMPLATE, $page,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_TWO, OTHER_REVIEWS_RATING_STARS_TWO_ALT) . '</label>'; ?>

<?php echo zen_draw_radio_field('rating', '3', '', 'id="rating-3"'); ?>
<?php echo '<label class="" for="rating-3">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_THREE, DIR_WS_TEMPLATE, $page,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_THREE, OTHER_REVIEWS_RATING_STARS_THREE_ALT) . '</label>'; ?>

<?php echo zen_draw_radio_field('rating', '4', '', 'id="rating-4"'); ?>
<?php echo '<label class="" for="rating-4">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_FOUR, DIR_WS_TEMPLATE, $page,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_FOUR, OTHER_REVIEWS_RATING_STARS_FOUR_ALT) . '</label>'; ?>

<?php echo zen_draw_radio_field('rating', '5', '', 'id="rating-5"'); ?>
<?php echo '<label class="" for="rating-5">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_FIVE, DIR_WS_TEMPLATE, $page,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_FIVE, OTHER_REVIEWS_RATING_STARS_FIVE_ALT) . '</label>'; ?>
</div>

<label id="textAreaReviews" for="review-text"><?php echo SUB_TITLE_REVIEW; ?></label>
<?php echo zen_draw_textarea_field('review_text', 60, 5, '', 'id="review-text"'); ?>

<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
<br class="clearBoth" />

<div id="reviewsWriteReviewsNotice" class="notice"><?php echo TEXT_NO_HTML . (REVIEWS_APPROVAL == '1' ? '<br />' . TEXT_APPROVAL_REQUIRED: ''); ?></div>
</form>
</div>
<?php
endif;
?>
<?php
if ($display_list):
?>
<div class="centerColumn" id="reviewsDefault">

<?php
  if (count($reviews) > 0) {

    foreach ($reviews as $review) {
?>
<hr />

<div  id="productReviewsDefaultReviewer" class="bold"><?php echo sprintf(TEXT_REVIEW_DATE_ADDED, zen_date_short($review['dateAdded'])); ?>&nbsp;<?php echo sprintf(TEXT_REVIEW_BY, zen_output_string_protected($review['customersName'])); ?></div>

<div class="rating"><?php echo zen_image(DIR_WS_TEMPLATE_IMAGES . 'stars_' . $review['reviewsRating'] . '.gif', sprintf(TEXT_OF_5_STARS, $review['reviewsRating'])), sprintf(TEXT_OF_5_STARS, $review['reviewsRating']); ?></div>

<div id="productReviewsDefaultProductMainContent" class="content"><?php echo zen_break_string(nl2br(zen_output_string_protected(stripslashes($review['reviewsText']))), 60, '-<br />'); ?></div>


<br class="clearBoth" />
<?php
    }
    echo '<div class="view_all_reviws"><a href="'.zen_href_link($page='addon',$parameters='module=easy_reviews/product_reviews&products_id='.(int)$_GET['products_id']).'">'.VIEW_ALL_REVIEWS.'</a></div>';
?>
<?php
  } else {
?>
<hr />
<div id="productReviewsDefaultNoReviews" class="content"><?php echo TEXT_NO_REVIEWS . (REVIEWS_APPROVAL == '1' ? '<br />' . TEXT_APPROVAL_REQUIRED: ''); ?></div>
<br class="clearBoth" />
<?php
  }
?>

</div>
<?php
endif;