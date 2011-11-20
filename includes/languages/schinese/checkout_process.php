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
// $Id: checkout_process.php 896 2005-01-07 18:54:48Z ajeh $
//

define('EMAIL_TEXT_SUBJECT', '订单确认');
define('EMAIL_TEXT_HEADER', '订单确认');
define('EMAIL_TEXT_FROM','来自: ');  //added to the EMAIL_TEXT_HEADER, above on text-only emails
define('EMAIL_THANKS_FOR_SHOPPING','谢谢您在我店购物!');
define('EMAIL_DETAILS_FOLLOW','下面是您的订单的详细信息.');
define('EMAIL_TEXT_ORDER_NUMBER', '订单号:');
define('EMAIL_TEXT_INVOICE_URL', '详细发票:');
define('EMAIL_TEXT_INVOICE_URL_CLICK', '详细发票请点击这里');
define('EMAIL_TEXT_DATE_ORDERED', '订单日期:');
define('EMAIL_TEXT_PRODUCTS', '商品');
define('EMAIL_TEXT_SUBTOTAL', '小计:');
define('EMAIL_TEXT_TAX', '税:        ');
define('EMAIL_TEXT_SHIPPING', '运费: ');
define('EMAIL_TEXT_TOTAL', '总额:    ');
define('EMAIL_TEXT_DELIVERY_ADDRESS', '送货地址');
define('EMAIL_TEXT_BILLING_ADDRESS', '帐单地址');
define('EMAIL_TEXT_PAYMENT_METHOD', '支付方式');

define('EMAIL_SEPARATOR', '------------------------------------------------------');
define('TEXT_EMAIL_VIA', '通过');

define('EMAIL_ORDER_NUMBER_SUBJECT', ' 编号');
define('HEADING_ADDRESS_INFORMATION','地址信息');
define('HEADING_SHIPPING_METHOD','配送方式');
?>