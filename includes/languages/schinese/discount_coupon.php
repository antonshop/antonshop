<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @$Id: discount_coupon.php 14712 2009-10-28 22:05:08Z ajeh $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

define('NAVBAR_TITLE', '优惠券');
define('HEADING_TITLE', '优惠券');

define('TEXT_INFORMATION', '');
define('TEXT_COUPON_FAILED', '<span class="alert important">%s</span>不是有效的优惠券兑现号码。请再输入一次。');

define('HEADING_COUPON_HELP', '优惠券帮助');
define('TEXT_CLOSE_WINDOW', '关闭窗口 [x]');
define('TEXT_COUPON_HELP_HEADER', '<p class="bold">输入的优惠券兑现代码用于');
define('TEXT_COUPON_HELP_NAME', '\'%s\'. </p>');
define('TEXT_COUPON_HELP_FIXED', '');
define('TEXT_COUPON_HELP_MINORDER', '<p>本优惠券在指定商品的最低消费额%s</p>');
define('TEXT_COUPON_HELP_FREESHIP', '');
define('TEXT_COUPON_HELP_DESC', '<p><span class="bold">优惠券适用:</span> %s</p><p class="smallText">可能有其他限制。细节详见下面。</p>');
define('TEXT_COUPON_HELP_DATE', '<p>本优惠券有效期为%s到%s</p>');
define('TEXT_COUPON_HELP_RESTRICT', '<p class="biggerText bold">优惠券限制</p>');
define('TEXT_COUPON_HELP_CATEGORIES', '<p class="bold">分类限制:</p>');
define('TEXT_COUPON_HELP_PRODUCTS', '<p class="bold">商品显著:</p>');
define('TEXT_ALLOW', '有效');
define('TEXT_DENY', '无效');
define('TEXT_NO_CAT_RESTRICTIONS', '<p>本优惠券适用所有分类。</p>');
define('TEXT_NO_PROD_RESTRICTIONS', '<p>本优惠券适用所有商品。</p>');
define('TEXT_CAT_ALLOWED', ' (适用分类)');
define('TEXT_CAT_DENIED', ' (不适用分类)');
define('TEXT_PROD_ALLOWED', ' (适用商品)');
define('TEXT_PROD_DENIED', ' (不适用商品)');
// gift certificates cannot be purchased with Discount Coupons
define('TEXT_COUPON_GV_RESTRICTION','<p class="smallText">优惠券不能用于购买' . TEXT_GV_NAMES . '。每个订单只能用一个优惠券。</p>');

define('TEXT_DISCOUNT_COUPON_ID_INFO', '查找优惠券 ... ');
define('TEXT_DISCOUNT_COUPON_ID', '您的号码: ');

define('TEXT_COUPON_GV_RESTRICTION_ZONES', '帐单地址有限制。');
?>