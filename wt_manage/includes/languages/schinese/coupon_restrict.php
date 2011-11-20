<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: coupon_restrict.php 16174 2010-05-02 14:10:30Z drbyte $
 */

define('HEADING_TITLE', '优惠券适用的商品和分类');
define('HEADING_TITLE_CATEGORY', '分类限制');
define('HEADING_TITLE_PRODUCT', '商品限制');

define('HEADER_COUPON_ID', '优惠券编号');
define('HEADER_COUPON_NAME', '优惠券名称');
define('HEADER_CATEGORY_ID', '分类编号');
define('HEADER_CATEGORY_NAME', '分类名称');
define('HEADER_PRODUCT_ID', '商品编号');
define('HEADER_PRODUCT_NAME', '商品名称');
define('HEADER_RESTRICT_ALLOW', '允许');
define('HEADER_RESTRICT_DENY', '禁止');
define('HEADER_RESTRICT_REMOVE', '删除');
define('IMAGE_ALLOW', '允许');
define('IMAGE_DENY', '禁止');
define('IMAGE_REMOVE', '删除');
define('TEXT_ALL_CATEGORIES', '所有分类');

define('MAX_DISPLAY_RESTRICT_ENTRIES', 20);
define('TEXT_ALL_PRODUCTS_ADD', '添加所有分类产品');
define('TEXT_ALL_PRODUCTS_REMOVE', '删除所有分类产品');
define('TEXT_INFO_ADD_DENY_ALL', '<strong>要添加所有分类产品，只有未做限制的产品将被添加。<br />
                    要删除所有分类产品，只有指定了禁止或允许的产品将被删除。</strong>');

define('TEXT_MANUFACTURER', '厂家: ');
define('TEXT_CATEGORY', '分类: ');
define('ERROR_DISCOUNT_COUPON_DEFINED_CATEGORY', '分类未完成');
define('ERROR_DISCOUNT_COUPON_DEFINED_PRODUCT', '产品未完成');
