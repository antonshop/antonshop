
<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_specials.php 17617 2010-09-25 20:13:29Z drbyte $
 */
  $content = "";
  $content .= '<div class="sideBoxContent centeredContent">';
  $specials_box_counter = 0;
  while (!$random_specials_sidebox_product->EOF) {
    $specials_box_counter++;
    $specials_box_price = zen_get_products_display_price($random_specials_sidebox_product->fields['products_id']);
    $content .= "\n" . '  <div class="img">';
    $content .= '<a href="' . zen_href_link(zen_get_info_page($random_specials_sidebox_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_specials_sidebox_product->fields["master_categories_id"]) . '&products_id=' . $random_specials_sidebox_product->fields["products_id"]) . '">' . zen_image(DIR_WS_IMAGES . $random_specials_sidebox_product->fields['products_image'], $random_specials_sidebox_product->fields['products_name'], SMALL_IMAGE_WIDTH, SMALL_IMAGE_HEIGHT)."</a></div>";
    $content .= '<div class="desc"><a class="name" href="' . zen_href_link(zen_get_info_page($random_specials_sidebox_product->fields["products_id"]), 'cPath=' . zen_get_generated_category_path_rev($random_specials_sidebox_product->fields["master_categories_id"]) . '&products_id=' . $random_specials_sidebox_product->fields["products_id"]) . '">' . $random_specials_sidebox_product->fields['products_name'] . '</a>';
    $content .= '<div class="price">' . $specials_box_price . '</div>';
	$content .= '<div class="button"><a href="' . zen_href_link(FILENAME_PRODUCT_INFO, zen_get_all_get_params(array('action')). 'products_id=' . $random_specials_sidebox_product->fields['products_id']). '"><img src="'.DIR_WS_TEMPLATE.'buttons/english/button_goto_prod_details.gif"></a></div>';
    $content .= '</div>';
    $random_specials_sidebox_product->MoveNextRandom();
  }
  $content .= '</div></div>' . "\n";
