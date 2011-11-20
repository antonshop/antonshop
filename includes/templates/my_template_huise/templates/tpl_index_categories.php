<?php
/**
 * Page Template
 *
 * Loaded by main_page=index<br />
 * Displays category/sub-category listing<br />
 * Uses tpl_index_category_row.php to render individual items
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_categories.php 4678 2006-10-05 21:02:50Z ajeh $
 */
?>
<?php
// categories_description
    if ($current_categories_description != '') {
?>
<div id="indexProductListCatDescription" class="right_list"><?php echo $current_categories_description;  ?></div>
<?php } // categories_description ?>



<?php
  if (PRODUCT_LIST_CATEGORY_ROW_STATUS == 0) {
    // do nothing
  } else {
    // display subcategories
/**
 * require the code to display the sub-categories-grid, if any exist
 */
   require($template->get_template_dir('tpl_modules_category_row.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_row.php');
   //echo $category_list;exit;
  }
?>



<?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_PRODUCT_LISTING));?>

<h1 class="mav_tit">
	<strong><?php echo $breadcrumb->last(); ?></strong>
    <div class="mavericks_rg">
	<?php if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
    ?>
       <?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?>
    <?php
    }
    ?>
    </div>
</h1>


<div class="mav_con">
    <?php
	echo $lc_text;
    ?>
</div>  
<h1 class="mav_tit">
    <strong><?php echo $breadcrumb->last(); ?></strong>
    <div class="mavericks_rg">
    <?php if ( ($listing_split->number_of_rows > 0) && ( (PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3') ) ) {
    ?>
       <?php echo TEXT_RESULT_PAGE . ' ' . $listing_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?>
    <?php
    }
    ?>
    </div>
</h1>


