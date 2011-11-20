<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
// $Id: shopping_cart.php 290 2004-09-15 19:48:26Z wilt $
//

define('NAVBAR_TITLE', '购物车');
define('HEADING_TITLE', '购物车中的商品:');
define('HEADING_TITLE_EMPTY', '您的购物车');
define('TEXT_INFORMATION', '可以在这里输入有关购物车的说明。 (includes/languages/schinese/shopping_cart.php)');
define('TABLE_HEADING_REMOVE', '删除');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_MODEL', '型号');
define('TABLE_HEADING_PRICE','单价');
define('TEXT_CART_EMPTY', '您的购物车是空的.');
define('SUB_TITLE_SUB_TOTAL', '小计:');
define('SUB_TITLE_TOTAL', '总额:');

define('OUT_OF_STOCK_CANT_CHECKOUT', '标记为' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '的商品缺货或库存不足。<br />请修改标记为(' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . ')的商品数量。谢谢！');
define('OUT_OF_STOCK_CAN_CHECKOUT', '标记为' . STOCK_MARK_PRODUCT_OUT_OF_STOCK . '的商品缺货。<br />缺货的商品将稍后发货。');

define('TEXT_TOTAL_ITEMS', '件数: ');
define('TEXT_TOTAL_WEIGHT', '&nbsp;&nbsp;重量: ');
define('TEXT_TOTAL_AMOUNT', '&nbsp;&nbsp;金额: ');

define('TEXT_VISITORS_CART', '<a href="javascript:session_win();">[帮助 (?)]</a>');
define('TEXT_OPTION_DIVIDER', '&nbsp;-&nbsp;');
?>