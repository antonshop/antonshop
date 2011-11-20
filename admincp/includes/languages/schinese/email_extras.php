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
// $Id: email_extras.php 5454 2006-12-29 20:10:17Z drbyte $
//

// office use only
  define('OFFICE_FROM','来自:');
  define('OFFICE_EMAIL','电子邮件:');

  define('OFFICE_SENT_TO','发给:');
  define('OFFICE_EMAIL_TO','电子邮件:');
  define('OFFICE_USE','网站专用:');
  define('OFFICE_LOGIN_NAME','登录名:');
  define('OFFICE_LOGIN_EMAIL','电子邮件:');
  define('OFFICE_LOGIN_PHONE','<strong>电话号码:</strong>');
  define('OFFICE_IP_ADDRESS','IP地址:');
  define('OFFICE_HOST_ADDRESS','主机地址:');
  define('OFFICE_DATE_TIME','日期和时间:');

// email disclaimer
  define('EMAIL_DISCLAIMER', '该电子邮件地址是您或我们的一个客户提供的. 如果您没有登记帐号, 或者您错误接收了该邮件, 请发邮件到 %s');
  define('EMAIL_SPAM_DISCLAIMER','该电子邮件遵循美国2004年1月1日生效的反垃圾邮件条款. 退订请发到以上地址, 我们尊重您的要求.');
  define('EMAIL_FOOTER_COPYRIGHT','Copyright &copy; ' . date('Y') . ' <a href="http://www.zen-cart.cn" target="_blank">Zen Cart 中文版</a>。Powered by <a href="http://www.zen-cart.cn" target="_blank">Zen Cart</a>');
  define('SEND_EXTRA_GV_ADMIN_EMAILS_TO_SUBJECT','[管理员已发GV]');
  define('SEND_EXTRA_DISCOUNT_COUPON_ADMIN_EMAILS_TO_SUBJECT','[优惠券]');
  define('SEND_EXTRA_ORDERS_STATUS_ADMIN_EMAILS_TO_SUBJECT','[订单状态]');
  define('TEXT_UNSUBSCRIBE', "\n\nTo 如要退订电子商情和促销邮件, 请点击以下链接: \n");

// for whos_online when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', '关闭');
?>