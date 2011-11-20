<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: document_general_info.php 6371 2007-05-25 19:55:59Z ajeh $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

define('TEXT_PRODUCT_NOT_FOUND', '对不起，没有找到该商品。');
define('TEXT_CURRENT_REVIEWS', '当前评论:');
define('TEXT_MORE_INFORMATION', '详情请访问该商品的<a href="%s" target="_blank">网页</a>。');
define('TEXT_DATE_ADDED', '该商品加入分类的日期为%s');
define('TEXT_DATE_AVAILABLE', '该商品到货日期为%s');
define('TEXT_ALSO_PURCHASED_PRODUCTS', '客户同时购买的商品');
define('TEXT_PRODUCT_OPTIONS', '请选择: ');
define('TEXT_PRODUCT_MANUFACTURER', '厂商: ');
define('TEXT_PRODUCT_WEIGHT', '重量: ');
define('TEXT_PRODUCT_QUANTITY', ' 库存');
define('TEXT_PRODUCT_MODEL', '型号: ');



// previous next product
define('PREV_NEXT_PRODUCT', '商品 ');
define('PREV_NEXT_FROM', ' 来自 ');
define('IMAGE_BUTTON_PREVIOUS','上一商品');
define('IMAGE_BUTTON_NEXT','下一商品');
define('IMAGE_BUTTON_RETURN_TO_PRODUCT_LIST','回到商品目录');

// missing products
//define('TABLE_HEADING_NEW_PRODUCTS', '新商品 - %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', '预售商品');
//define('TABLE_HEADING_DATE_EXPECTED', '上市日期');

define('TEXT_ATTRIBUTES_PRICE_WAS',' [原价: ');
define('TEXT_ATTRIBUTE_IS_FREE',' 现在: 免费]');
define('TEXT_ONETIME_CHARGE_SYMBOL', ' *');
define('TEXT_ONETIME_CHARGE_DESCRIPTION', ' 可能有基本费');
define('TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK','大批量有优惠');
define('ATTRIBUTES_QTY_PRICE_SYMBOL', zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;');

define('ATTRIBUTES_PRICE_DELIMITER_PREFIX', ' ( ');
define('ATTRIBUTES_PRICE_DELIMITER_SUFFIX', ' )');
define('ATTRIBUTES_WEIGHT_DELIMITER_PREFIX', ' (');
define('ATTRIBUTES_WEIGHT_DELIMITER_SUFFIX', ') ');

?>