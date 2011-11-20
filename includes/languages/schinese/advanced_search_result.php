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
// $Id: advanced_search_result.php 290 2004-09-15 19:48:26Z wilt $
//

define('NAVBAR_TITLE_1', '高级搜索');
define('NAVBAR_TITLE_2', '搜索结果');

//define('HEADING_TITLE_1', '高级搜索');
define('HEADING_TITLE', '高级搜索');

define('HEADING_SEARCH_CRITERIA', '搜索条件');

define('TEXT_SEARCH_IN_DESCRIPTION', '搜索商品简介');
define('ENTRY_CATEGORIES', '分类:');
define('ENTRY_INCLUDE_SUBCATEGORIES', '包含子分类');
define('ENTRY_MANUFACTURERS', '厂商:');
define('ENTRY_PRICE_FROM', '最低价格:');
define('ENTRY_PRICE_TO', '最高价格:');
define('ENTRY_DATE_FROM', '起始日期:');
define('ENTRY_DATE_TO', '终止日期:');

define('TEXT_SEARCH_HELP_LINK', '搜索帮助 [?]');

define('TEXT_ALL_CATEGORIES', '所有分类');
define('TEXT_ALL_MANUFACTURERS', '所有厂商');

define('HEADING_SEARCH_HELP', '搜索帮助');
define('TEXT_SEARCH_HELP', '关键字可以用 AND , OR 分开以得到更好的搜索结果.<br /><br />例如, <u>Microsoft AND mouse</u> 的搜索结果是同时含有两个关键字的集合. 反之, 如果用 <u>mouse OR keyboard</u>, 搜索结果是含有两个或任意一个关键字的集合.<br /><br />如果要使用完全匹配, 用双引号分开关键字.<br /><br />例如, <u>"notebook computer"</u> 的搜索结果是完全匹配该字串的集合.<br /><br />用括号能得到更好的搜索结果.<br /><br />例如, <u>Microsoft and (keyboard or mouse or "visual basic")</u>.');
define('TEXT_CLOSE_WINDOW', '关闭窗口 [x]');

define('TABLE_HEADING_IMAGE', '');
define('TABLE_HEADING_MODEL', '型号');
define('TABLE_HEADING_PRODUCTS', '商品名称');
define('TABLE_HEADING_MANUFACTURER', '厂商');
define('TABLE_HEADING_QUANTITY', '数量');
define('TABLE_HEADING_PRICE', '价格');
define('TABLE_HEADING_WEIGHT', '重量');
define('TABLE_HEADING_BUY_NOW', '购买');

define('TEXT_NO_PRODUCTS', '没有找到符合条件的商品.');

define('ERROR_AT_LEAST_ONE_INPUT', '搜索表格中至少一栏不能为空.');
define('ERROR_INVALID_FROM_DATE', '起始日期不对.');
define('ERROR_INVALID_TO_DATE', '终止日期不对.');
define('ERROR_TO_DATE_LESS_THAN_FROM_DATE', '终止日期必须不迟于起始日期.');
define('ERROR_PRICE_FROM_MUST_BE_NUM', '最低价格必须是数字.');
define('ERROR_PRICE_TO_MUST_BE_NUM', '最高价格必须是数字.');
define('ERROR_PRICE_TO_LESS_THAN_PRICE_FROM', '最高价格不能低于最低价格.');
define('ERROR_INVALID_KEYWORDS', '关键字不对.');
?>
