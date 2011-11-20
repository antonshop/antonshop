<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_featured.php 17617 2010-09-25 20:13:29Z drbyte $
 */
  $content = "";
 /* $content = '

	  <div class="fea_list">
		  <span><var>$156.25</var><em>$50.00</em></span>
		  <span class="pro_inf">Save:68% off</span>
	  </div>

  ';*/
  $content .= '<div class="cate_con">';
  $featured_box_counter = 0;
  while (!$random_featured_product->EOF) {
	  
    $featured_box_counter++;
    $featured_box_price = zen_get_products_display_price($random_featured_product->fields['products_id']);
	
    $content .= '<div class="fea_list">';
	
    $content .= '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '" class="a_pic">' . zen_image(DIR_WS_IMAGES . $random_featured_product->fields['products_image'], $random_featured_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT).'</a>';
	
    $content .= '<a href="' . zen_href_link(zen_get_info_page($random_featured_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_featured_product->fields["master_categories_id"]) . '&products_id=' . $random_featured_product->fields["products_id"]) . '" class="pro_inf">'.$random_featured_product->fields['products_name'].'</a><br />';
	
   /* $content .= '
	<span><var>$156.25</var><em>$50.00</em></span>
	<span class="pro_inf">Save:68% off</span>
	';*/
	$content .= $featured_box_price;
    $content .= '</div>';
	
    $random_featured_product->MoveNextRandom();
	
  }
  $content .= '</div>';
