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
//  $Id: 95EPAY.php v1.0 2008-03-20 Jack $
//
   define('MODULE_PAYMENT_95EPAY_TEXT_ADMIN_TITLE', '95EPAY Payment Gateway');
  define('MODULE_PAYMENT_95EPAY_TEXT_CATALOG_TITLE', '95EPAY Payment Gateway');
  define('MODULE_PAYMENT_95EPAY_TEXT_DESCRIPTION', '95EPAY Payment Gateway');

  define('MODULE_PAYMENT_95EPAY_MARK_BUTTON_IMG', DIR_WS_MODULES . 'payment/95epay/95epay.png');
  define('MODULE_PAYMENT_95EPAY_PAY_BUTTON_IMG', DIR_WS_MODULES . 'payment/95epay/95epay_submit_button.gif');
  define('MODULE_PAYMENT_95EPAY_PAY_BUTTON_ALT', 'Go to checkout with 95EPAY');
  define('MODULE_PAYMENT_95EPAY_MARK_BUTTON_ALT', 'Checkout with 95EPAY');
  define('MODULE_PAYMENT_95EPAY_ACCEPTANCE_MARK_TEXT', '95EPAY Payment Gateway');

  define('MODULE_PAYMENT_95EPAY_TEXT_CATALOG_LOGO', '<img src="' . MODULE_PAYMENT_95EPAY_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_95EPAY_MARK_BUTTON_ALT . '" title="' . MODULE_PAYMENT_95EPAY_MARK_BUTTON_ALT . '" />Visa Credit card payment online' );

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_1_1', 'Enable 95EPAY Module');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_1_2', 'Do you want to accept 95EPAY payments?'); 
  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_2_1', '95EPAY ID');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_2_2', '95EPAY ID');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_3_1', '95EPAY MD5 key');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_3_2', '95EPAY MD5 key');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_4_1', 'Currency');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_4_2', 'Currency Type:<br/> 1-USD, 2-EUR,3-CNY,4-GBP,<br/>5-HKD,6-JPY,7-AUD,8-CAD,9-NOK'); 

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_5_1', 'Language');
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_5_2', 'Language:<br/>en-English,es-Spanish, fr-French,<br/>it-Italian,ja-Japanese,de-German,<br/>zh-Chinese'); 
  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_6_1', 'Payment Zone');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_6_2', 'If a zone is selected, only enable this payment method for that zone.');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_7_1', 'Set 95epay Preparing Status');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_7_2', 'Set the status of orders made with this payment module to this value<br />(Preparing [95epay Payment]: recommended)');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_8_1', 'Sort order of display');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_8_2', 'Sort order of display. Lowest is displayed first.');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_9_1', '95EPAY transaction URL<br />Default: <code>https://www.95epay.com/payRequestAction.action</code><br />');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_9_2', '95EPAY transaction URL');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_10_1', '95EPAY Return URL');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_10_2', '95EPAY Return URL');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_11_1', '95epay Declined order status');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_11_2', 'Set your order status for order 95epay Declined');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_12_1', '95epay_pay_success order status');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_12_2', 'Set your order status for order pay_success ');  

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_13_1', '95epay_pay_fail order status');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_13_2', 'Set your order status for order pay_fail');

  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_14_1', '95epay_pay_processing order status');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_14_2', 'Set your order status for order pay_processing'); 

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_15_1', 'Remark');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_15_2', 'Set your remark for 95epay'); 

  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_16_1', 'Trading site');  
  define('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_16_2', 'Set your trading site');

?>