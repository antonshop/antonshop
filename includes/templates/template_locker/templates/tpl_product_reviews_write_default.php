<?php
/**
 * Page Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_product_reviews_write_default.php 4365 2006-09-03 19:16:58Z wilt $
 */
?>
<div class="centerColumn" id="reviewsWrite">
<?php echo zen_draw_form('product_reviews_write', zen_href_link(FILENAME_PRODUCT_REVIEWS_WRITE, 'action=process&products_id=' . $_GET['products_id'], 'SSL'), 'post', 'onsubmit="return checkForm(product_reviews_write);"'); ?>


<?php if ($messageStack->size('review_text') > 0) echo $messageStack->output('review_text'); ?>

<div id="reviewsWriteReviewsRate" class="center"><?php echo SUB_TITLE_RATING; ?></div>

<div class="ratingRow">
<?php echo zen_draw_radio_field('rating', '1', '', 'id="rating-1"'); ?>
<?php echo '<label class="" for="rating-1">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_ONE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_ONE, OTHER_REVIEWS_RATING_STARS_ONE_ALT) . '</label> '; ?>

<?php echo zen_draw_radio_field('rating', '2', '', 'id="rating-2"'); ?>
<?php echo '<label class="" for="rating-2">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_TWO, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_TWO, OTHER_REVIEWS_RATING_STARS_TWO_ALT) . '</label>'; ?>

<?php echo zen_draw_radio_field('rating', '3', '', 'id="rating-3"'); ?>
<?php echo '<label class="" for="rating-3">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_THREE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_THREE, OTHER_REVIEWS_RATING_STARS_THREE_ALT) . '</label>'; ?>

<?php echo zen_draw_radio_field('rating', '4', '', 'id="rating-4"'); ?>
<?php echo '<label class="" for="rating-4">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_FOUR, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_FOUR, OTHER_REVIEWS_RATING_STARS_FOUR_ALT) . '</label>'; ?>

<?php echo zen_draw_radio_field('rating', '5', '', 'id="rating-5"'); ?>
<?php echo '<label class="" for="rating-5">' . zen_image($template->get_template_dir(OTHER_IMAGE_REVIEWS_RATING_STARS_FIVE, DIR_WS_TEMPLATE, $current_page_base,'images'). '/' . OTHER_IMAGE_REVIEWS_RATING_STARS_FIVE, OTHER_REVIEWS_RATING_STARS_FIVE_ALT) . '</label>'; ?>
</div>

<label id="textAreaReviews" for="review-text"><?php echo SUB_TITLE_REVIEW; ?></label>
<?php echo zen_draw_textarea_field('review_text', 60, 5, '', 'id="review-text"'); ?>

    <div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_SUBMIT, BUTTON_SUBMIT_ALT); ?></div>
<br class="clearBoth" />

<div id="" class="notice">NOTE: HTML tags are not allowed.</div>
</form>
</div>
