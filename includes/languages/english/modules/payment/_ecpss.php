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
//  $Id: ECPSS.php v1.0 2008-03-20 zhangMR $
//
  define('MODULE_PAYMENT_ECPSS_TEXT_ADMIN_TITLE', 'ECPSS Payment Gateway');
  define('MODULE_PAYMENT_ECPSS_TEXT_CATALOG_TITLE', 'ECPSS Payment Gateway');
  define('MODULE_PAYMENT_ECPSS_TEXT_DESCRIPTION', 'ECPSS Payment Gateway');

  define('MODULE_PAYMENT_ECPSS_MARK_BUTTON_IMG', DIR_WS_MODULES . 'payment/ecpss/ecpss.png');
  define('MODULE_PAYMENT_ECPSS_PAY_BUTTON_IMG', DIR_WS_MODULES . 'payment/ecpss/ecpss_submit_button.gif');
  define('MODULE_PAYMENT_ECPSS_PAY_BUTTON_ALT', 'Go to checkout with ECPSS');
  define('MODULE_PAYMENT_ECPSS_MARK_BUTTON_ALT', 'Checkout with ECPSS');
  define('MODULE_PAYMENT_ECPSS_ACCEPTANCE_MARK_TEXT', 'ECPSS Payment Gateway<br/>');

  define('MODULE_PAYMENT_ECPSS_TEXT_CATALOG_LOGO', '<img src="' . MODULE_PAYMENT_ECPSS_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_ECPSS_MARK_BUTTON_ALT . '" title="' . MODULE_PAYMENT_ECPSS_MARK_BUTTON_ALT . '" />'.MODULE_PAYMENT_ECPSS_ACCEPTANCE_MARK_TEXT );

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_1_1', 'Enable ECPSS Module');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_1_2', 'Do you want to accept ECPSS payments?');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_2_1', 'ECPSS ID');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_2_2', 'ECPSS ID');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_3_1', 'ECPSS MD5 key');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_3_2', 'ECPSS MD5 key');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_4_1', 'Currency');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_4_2', 'Currency Type: 1-USD, 2-EUR,3-CNY,4-GBP');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_5_1', 'Language');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_5_2', 'Language: 1-Chinese, 2-English, 3-Français,4-Español,5-Deutsch');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_6_1', 'Payment Zone');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_6_2', 'If a zone is selected, only enable this payment method for that zone.');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_7_1', 'Set Pending Notification Status');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_7_2', 'Set the status of orders made with this payment module to this value<br />(Processing recommended)');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_8_1', 'Sort order of display');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_8_2', 'Sort order of display. Lowest is displayed first.');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_9_1', 'ECPSS transaction URL<br />Default: <code>https://security.sslepay.com/sslpayment</code><br />');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_9_2', 'ECPSS transaction URL');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_10_1', 'ECPSS Return URL');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_10_2', 'ECPSS Return URL');

  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_11_1', 'Filished order status');
  define('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_11_2', 'Set your order status for order filished');

?>