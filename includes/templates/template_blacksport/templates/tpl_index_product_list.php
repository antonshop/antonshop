<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays product-listing when a particular category/subcategory is selected for browsing
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_product_list.php 15589 2010-02-27 15:03:49Z ajeh $
 */
?>
<?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));?>
<?php
// categories_description
    if ($current_categories_description != '') {
?>
<div id="indexProductListCatDescription" class="right_list"><?php echo $current_categories_description;  ?></div>
<?php } // categories_description ?>

<?php
  $check_for_alpha = $listing_sql;
  $check_for_alpha = $db->Execute($check_for_alpha);

  if ($do_filter_list || ($check_for_alpha->RecordCount() > 0 && PRODUCT_LIST_ALPHA_SORTER == 'true')) {
  $form = zen_draw_form('filter', zen_href_link(FILENAME_DEFAULT), 'get') . '<label class="inputLabel">' .TEXT_SHOW . '</label>';
?>
<div class="tie2">
	<div class="tie2-indent">
		<?php
          echo $form;
          echo zen_draw_hidden_field('main_page', FILENAME_DEFAULT);
          echo zen_hide_session_id();
        ?>


<?php
  // draw cPath if known
  if (!$getoption_set) {
    echo zen_draw_hidden_field('cPath', $cPath);
  } else {
    // draw manufacturers_id
    echo zen_draw_hidden_field($get_option_variable, $_GET[$get_option_variable]);
  }

  // draw music_genre_id
  if (isset($_GET['music_genre_id']) && $_GET['music_genre_id'] != '') echo zen_draw_hidden_field('music_genre_id', $_GET['music_genre_id']);

  // draw record_company_id
  if (isset($_GET['record_company_id']) && $_GET['record_company_id'] != '') echo zen_draw_hidden_field('record_company_id', $_GET['record_company_id']);

  // draw typefilter
  if (isset($_GET['typefilter']) && $_GET['typefilter'] != '') echo zen_draw_hidden_field('typefilter', $_GET['typefilter']);

  // draw manufacturers_id if not already done earlier
  if ($get_option_variable != 'manufacturers_id' && isset($_GET['manufacturers_id']) && $_GET['manufacturers_id'] > 0) {
    echo zen_draw_hidden_field('manufacturers_id', $_GET['manufacturers_id']);
  }

  // draw sort
  echo zen_draw_hidden_field('sort', $_GET['sort']);

  // draw filter_id (ie: category/mfg depending on $options)
  if ($do_filter_list) {
    echo zen_draw_pull_down_menu('filter_id', $options, (isset($_GET['filter_id']) ? $_GET['filter_id'] : ''), 'onchange="this.form.submit()"');
  }

  // draw alpha sorter
  require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING_ALPHA_SORTER));
?>
</form>
<?php
  }
?>    </div>
</div>


<?php if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
?>
<div id="productsListingTopNumber" class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></div>
<div id="productsListingListingTopLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<br class="clearBoth" />
<?php
}
?>


<table id="cat1Table" class="tabTable" width="100%" cellspacing="0" cellpadding="0" border="0">
<tbody><tr class="productListing-rowheading">
   <th align="center" id="listCell0-0" scope="col" class="productListing-heading">Product Image</th>
   <th id="listCell0-1" scope="col" class="productListing-heading"><a class="productListing-heading" title="Sort products descendingly by Item Name" href="http://www.accessorieslocker.com/bedding-c-1.html?sort=2a&amp;page=1">Item Name-</a></th>
   <th width="125" align="right" id="listCell0-2" scope="col" class="productListing-heading"><a class="productListing-heading" title="Sort products ascendingly by Price" href="http://www.accessorieslocker.com/bedding-c-1.html?sort=3a&amp;page=1">Price</a></th>
  </tr>
  
    <?php
	echo $lc_text;
    ?>
</tbody></table>

<?php if ( ($listing_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div id="productsListingBottomNumber" class="navSplitPagesResult back"><?php echo $listing_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS); ?></div>
<div  id="productsListingListingBottomLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<br class="clearBoth" />
<?php
  }
?>

<?php
// if ($show_top_submit_button == true or $show_bottom_submit_button == true or (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0)) {
  if ($show_top_submit_button == true or $show_bottom_submit_button == true) {
?>
</form>
<?php } ?>



<?php
//// bof: categories error
if ($error_categories==true) {
  // verify lost category and reset category
  $check_category = $db->Execute("select categories_id from " . TABLE_CATEGORIES . " where categories_id='" . $cPath . "'");
  if ($check_category->RecordCount() == 0) {
    $new_products_category_id = '0';
    $cPath= '';
  }
?>


<?php
} //// eof: categories
?>

</div>
