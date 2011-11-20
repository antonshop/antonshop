<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
  * @version $Id: login.php 14280 2009-08-29 01:33:18Z drbyte $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

define('NAVBAR_TITLE', '登录');
define('HEADING_TITLE', '您好，请登录');

define('HEADING_NEW_CUSTOMER', '新客户吗？请注册为会员');
define('HEADING_NEW_CUSTOMER_SPLIT', '新客户');

define('TEXT_NEW_CUSTOMER_INTRODUCTION', '注册为<strong>' . STORE_NAME . '</strong>的会员，购物更加便利，同时可以跟踪当前订单状态，也可以随时查看历史订单。');
define('TEXT_NEW_CUSTOMER_INTRODUCTION_SPLIT', '已有PayPal帐号? 要用信用卡快速结帐吗? 用下面的PayPal按钮可以快速结帐。');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_DIVIDER', '<span class="larger">或者</span><br />');
define('TEXT_NEW_CUSTOMER_POST_INTRODUCTION_SPLIT', '注册为<strong>' . STORE_NAME . '</strong>的会员，购物更加便利，同时可以跟踪当前订单状态，也可以随时查看历史订单、享受会员优惠。');

define('HEADING_RETURNING_CUSTOMER', '会员: 请登录');
define('HEADING_RETURNING_CUSTOMER_SPLIT', '会员');

define('TEXT_RETURNING_CUSTOMER_SPLIT', '请登录您的账户');

define('TEXT_PASSWORD_FORGOTTEN', '取回密码');

define('TEXT_LOGIN_ERROR', '错误：对不起，电子邮件地址/密码不正确。');
define('TEXT_VISITORS_CART', '<strong>提示:</strong> 如果您以前访问过本站并且购物车中有商品，登陆后购物车中的商品将合并。<a href="javascript:session_win();">[详情]</a>');

define('TABLE_HEADING_PRIVACY_CONDITIONS', '<span class="privacyconditions">隐私声明</span>');
define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '<span class="privacydescription">请点击下框以确认您同意我们的隐私声明。该隐私声明在</span><a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">这里</span></a>。');
define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '<span class="privacyagree">我已经阅读并同意该隐私声明。</span>');

define('ERROR_SECURITY_ERROR', '登录时出现安全错误。');

define('TEXT_LOGIN_BANNED', '错误: 不能存取。');
