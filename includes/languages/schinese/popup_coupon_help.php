<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: popup_coupon_help.php 14141 2009-08-10 19:34:47Z wilt $
 */

define('HEADING_COUPON_HELP', '优惠券帮助');
define('TEXT_CLOSE_WINDOW', '关闭窗口 [x]');
define('TEXT_COUPON_HELP_HEADER', '恭喜, 您已经兑现了一张优惠券.');
define('TEXT_COUPON_HELP_NAME', '<br /><br />优惠券名称 : %s');
define('TEXT_COUPON_HELP_FIXED', '<br /><br />当您购物时, 该优惠券值优惠%s');
define('TEXT_COUPON_HELP_MINORDER', '<br /><br />购物满%s时, 可以使用该优惠券');
define('TEXT_COUPON_HELP_FREESHIP', '<br /><br />该优惠券可以免费购物');
define('TEXT_COUPON_HELP_DESC', '<br /><br />优惠券简介 : %s');
define('TEXT_COUPON_HELP_DATE', '<br /><br />该优惠券有效期在%s和%s之间');
define('TEXT_COUPON_HELP_RESTRICT', '<br /><br />商品/分类限制');
define('TEXT_COUPON_HELP_CATEGORIES', '分类');
define('TEXT_COUPON_HELP_PRODUCTS', '商品');
define('TEXT_ALLOW', '允许');
define('TEXT_DENY', '禁止');

define('TEXT_ALLOWED', ' (允许)');
define('TEXT_DENIED', ' (禁止)');

define('TEXT_NO_CAT_RESTRICTIONS', '<p>本优惠券适用所有分类。</p>');
define('TEXT_NO_PROD_RESTRICTIONS', '<p>本优惠券适用所有商品。</p>');

// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','优惠券不能用在购买 ' . TEXT_GV_NAMES . '.');

define('TEXT_COUPON_GV_RESTRICTION_ZONES', '帐单地址有限制。');
?>