<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: index.php 6550 2007-07-05 03:54:54Z drbyte $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

define('TEXT_MAIN','如果没有定义模板文件，这里就是该页的简体中文定义语句. 位于: <strong>/includes/languages/schinese/index.php</strong>');

// Showcase vs Store
if (STORE_STATUS == '0') {
  define('TEXT_GREETING_GUEST', '欢迎您 <span class="greetUser">客人!</span> 您可以在这里 <a href="%s">登录</a>?');
} else {
  define('TEXT_GREETING_GUEST', '欢迎您, 请参观我们的网上商品。');
}

define('TEXT_GREETING_PERSONAL', '您好 <span class="greetUser">%s</span>! 您可以点这里查看 <a href="%s">新进商品</a>?');

define('TEXT_INFORMATION', '在这里定义主索引页');

//moved to english
//define('TABLE_HEADING_FEATURED_PRODUCTS','推荐商品');

//define('TABLE_HEADING_NEW_PRODUCTS', '新商品 - %s');
//define('TABLE_HEADING_UPCOMING_PRODUCTS', '预售商品');
//define('TABLE_HEADING_DATE_EXPECTED', '上市日期');

if ( ($category_depth == 'products') || (zen_check_url_get_terms()) ) {
  define('HEADING_TITLE', '现有商品');
  define('TABLE_HEADING_IMAGE', '商品图像');
  define('TABLE_HEADING_MODEL', '型号');
  define('TABLE_HEADING_PRODUCTS', '商品名称');
  define('TABLE_HEADING_MANUFACTURER', '厂商');
  define('TABLE_HEADING_QUANTITY', '数量');
  define('TABLE_HEADING_PRICE', '价格');
  define('TABLE_HEADING_WEIGHT', '重量');
  define('TABLE_HEADING_BUY_NOW', '购买');
  define('TEXT_NO_PRODUCTS', '本分类中没有商品。');
  define('TEXT_NO_PRODUCTS2', '本厂商没有商品。');
  define('TEXT_NUMBER_OF_PRODUCTS', '商品类型: ');
  define('TEXT_SHOW', '排序:');
  define('TEXT_BUY', '现在就购买\'');
  define('TEXT_NOW', '\'');
  define('TEXT_ALL_CATEGORIES', '所有分类');
  define('TEXT_ALL_MANUFACTURERS', '所有厂商');
} elseif ($category_depth == 'top') {
  // This section deals with the "home" page at the top level with no options/products selected
  /*Replace this text with the headline you would like for your shop. For example: 'Welcome to My SHOP!'*/
  define('HEADING_TITLE', '恭喜您成功安装了zen cart中文版！');
} elseif ($category_depth == 'nested') {
  // This section deals with displaying a subcategory
  /*Replace this line with the headline you would like for your shop. For example: 'Welcome to My SHOP!'*/
  define('HEADING_TITLE', '恭喜您成功安装了zen cart中文版！'); 
}
?>