<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: email_extras.php 7161 2007-10-02 10:58:34Z drbyte $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

// office use only
  define('OFFICE_FROM','<strong>来自:</strong>');
  define('OFFICE_EMAIL','<strong>电子邮件:</strong>');

  define('OFFICE_SENT_TO','<strong>发给:</strong>');
  define('OFFICE_EMAIL_TO','<strong>电子邮件:</strong>');

  define('OFFICE_USE','<strong>保留栏目:</strong>');
  define('OFFICE_LOGIN_NAME','<strong>登录名称:</strong>');
  define('OFFICE_LOGIN_EMAIL','<strong>登录电子邮件:</strong>');
  define('OFFICE_LOGIN_PHONE','<strong>电话:</strong>');
  define('OFFICE_LOGIN_FAX','<strong>传真:</strong>');
  define('OFFICE_IP_ADDRESS','<strong>IP地址:</strong>');
  define('OFFICE_HOST_ADDRESS','<strong>主机地址:</strong>');
  define('OFFICE_DATE_TIME','<strong>日期和时间:</strong>');
  if (!defined('OFFICE_IP_TO_HOST_ADDRESS')) define('OFFICE_IP_TO_HOST_ADDRESS', 'OFF');

// email disclaimer
  define('EMAIL_DISCLAIMER', '本电子邮件地址是您或我们的客户提供的。如果您错误接收了该邮件，请发邮件到%s');
  define('EMAIL_SPAM_DISCLAIMER', '本电子邮件遵循反垃圾邮件条款。退订请发到以上地址，我们会尽快处理。');
  define('EMAIL_FOOTER_COPYRIGHT','版权所有 (c) ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '" target="_blank">' . STORE_NAME . '</a>. Powered by <a href="http://www.zen-cart.cn" target="_blank">Zen Cart</a>');
  define('TEXT_UNSUBSCRIBE', "\n\n退定电子商情和促销邮件，请点下面的链接: \n");

// email advisory for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY', '-----' . "\n" . '<strong>提醒:</strong> 为了您的利益和不被滥用，本网站发送的所有电子邮件都有记录以用于商店管理。如果您错误接收了该邮件，请发电子邮件到' . STORE_OWNER_EMAIL_ADDRESS . "\n\n");

// email advisory included warning for all emails customer generate - tell-a-friend and GV send
  define('EMAIL_ADVISORY_INCLUDED_WARNING', '<strong>本网站发送的所有电子邮件都含有该信息:</strong>');


// Admin additional email subjects
  define('SEND_EXTRA_CREATE_ACCOUNT_EMAILS_TO_SUBJECT','[建立帐号]');
  define('SEND_EXTRA_TELL_A_FRIEND_EMAILS_TO_SUBJECT','[推荐给朋友]');
  define('SEND_EXTRA_GV_CUSTOMER_EMAILS_TO_SUBJECT','[客户发送的礼券]');
  define('SEND_EXTRA_NEW_ORDERS_EMAILS_TO_SUBJECT','[新订单]');
  define('SEND_EXTRA_CC_EMAILS_TO_SUBJECT','[订单信息复件] #');

// Low Stock Emails
  define('EMAIL_TEXT_SUBJECT_LOWSTOCK','商品库存报警');
  define('SEND_EXTRA_LOW_STOCK_EMAIL_TITLE','商品库存报警: ');

// for when gethost is off
  define('OFFICE_IP_TO_HOST_ADDRESS', '关闭');
?>