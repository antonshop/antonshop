<?php
/**
* Template designed by 12leaves.com
* 12leaves.com - Free ecommerce templates and design services
*
 * @copyright Copyright 2009-2010 12leaves.com
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */
 
  $content ="";
  $product_amount = 0;

  if ($_SESSION['cart']->count_contents() > 0) {
    $products = $_SESSION['cart']->get_products();

    for ($i=0, $n=sizeof($products); $i<$n; $i++) {
		$product_amount = $products[$i]['quantity'] + $product_amount;
	}

	$content .= '<img src="' . DIR_WS_TEMPLATE . 'images/cart_car.gif">&nbsp;<a href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '">'. '<span>' . $product_amount . '</span>&nbsp;' . HEADER_PRODUCT_AMOUNT . '</a> '; 
  } else {
    $content .= '<div id="cartBoxEmpty"><a class="cart" href="' . zen_href_link(FILENAME_SHOPPING_CART, '', 'NONSSL') . '"><img src="' . DIR_WS_TEMPLATE . 'images/cart_car.gif">&nbsp;' . HEADER_SHOPPING_CART_EMPTY . '</a></div>';
  }

  if ($_SESSION['cart']->count_contents() > 0) {
    $content .= HEADER_CART_SUBTOTAL .'<span>' . $currencies->format($_SESSION['cart']->show_total()) . '</span>';
  }

?>
