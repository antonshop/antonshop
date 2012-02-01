<?php
/**
 * product_listing module
 *
 * @package modules
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: product_listing.php 17051 2010-07-29 07:25:09Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
$show_submit = zen_run_normal();
$listing_split = new splitPageResults($listing_sql, MAX_DISPLAY_PRODUCTS_LISTING, 'p.products_id', 'page');
$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $listing_split->number_of_rows);
$how_many = 0;

//$list_box_contents[0] = array('params' => 'class="productListing-rowheading"');

$zc_col_count_description = 0;
$lc_align = '';


?>

<?php
	if ($listing_split->number_of_rows > 0) {
	  $rows = 0;
	  $listing = $db->Execute($listing_split->sql_query);
	  $extra_row = 0;
	  while (!$listing->EOF) {
		$rows++;
		$lc_price = zen_get_products_display_price($listing->fields['products_id']) . '<br />';
		//echo "<pre>";print_r($listing->fields);echo "</pre>";exit;
		$rows == 1 ? $mav_special = 'mav_special' : $mav_special = '' ;
        $lc_text .= '<div class="mav_list ' . $mav_special . '">
        <a class="mav_list_pic" href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id'] > 0) ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">' .zen_image(DIR_WS_IMAGES . $listing->fields['products_image'], $listing->fields['products_name'], IMAGE_PRODUCT_LISTING_WIDTH, IMAGE_PRODUCT_LISTING_HEIGHT, '') . '</a>
        <div class="mav_list_words">
            <h3 class="mav_list_tit"><a href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id'] > 0) ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">' . $listing->fields['products_name'] . '</a></h3>
            <p class="mav_inf">'. zen_trunc_string(zen_clean_html(stripslashes(zen_get_products_description($listing->fields['products_id'], $_SESSION['languages_id']))), PRODUCT_LIST_DESCRIPTION) . '</p>
            <a class="big_cart" href="' . zen_href_link(zen_get_info_page($listing->fields['products_id']), 'cPath=' . (($_GET['manufacturers_id'] > 0 and $_GET['filter_id'] > 0) ?  zen_get_generated_category_path_rev($_GET['filter_id']) : ($_GET['cPath'] > 0 ? zen_get_generated_category_path_rev($_GET['cPath']) : zen_get_generated_category_path_rev($listing->fields['master_categories_id']))) . '&products_id=' . $listing->fields['products_id']) . '">Add this to Cart</a> 
        </div>
        <div class="mav_price">
            '. $lc_price .'
        </div>
    </div>';
	
		$listing->MoveNext();
	  }
	}else {
  $list_box_contents = array();
  $lc_text = '<div style="text-align:center;padding:10px 0px;">No Product List</div>';
  /*$list_box_contents[0] = array('params' => 'class="productListing-odd"');
  $list_box_contents[0][] = array('params' => 'class="productListing-data"',
                                              'text' => TEXT_NO_PRODUCTS);*/

  $error_categories = true;
}


/*
  $error_categories = true;
}
 */
if (($how_many > 0 and $show_submit == true and $listing_split->number_of_rows > 0) and (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART == 1 or  PRODUCT_LISTING_MULTIPLE_ADD_TO_CART == 3) ) {
  $show_top_submit_button = true;
} else {
  $show_top_submit_button = false;
}
if (($how_many > 0 and $show_submit == true and $listing_split->number_of_rows > 0) and (PRODUCT_LISTING_MULTIPLE_ADD_TO_CART >= 2) ) {
  $show_bottom_submit_button = true;
} else {
  $show_bottom_submit_button = false;
}



  if ($how_many > 0 && PRODUCT_LISTING_MULTIPLE_ADD_TO_CART != 0 and $show_submit == true and $listing_split->number_of_rows > 0) {
  // bof: multiple products
    echo zen_draw_form('multiple_products_cart_quantity', zen_href_link(FILENAME_DEFAULT, zen_get_all_get_params(array('action')) . 'action=multiple_products_add_product'), 'post', 'enctype="multipart/form-data"');
  }

?>