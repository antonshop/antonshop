<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2009 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_success.php 14198 2009-08-18 22:32:11Z drbyte $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

define('NAVBAR_TITLE_1', '结帐');
define('NAVBAR_TITLE_2', '成功 - 谢谢');

define('HEADING_TITLE', '谢谢! 您的订单结帐成功!');

define('TEXT_SUCCESS', '');
define('TEXT_NOTIFY_PRODUCTS', '请通知我下面选择的商品更新:');
define('TEXT_SEE_ORDERS', '要查询订单记录，请到<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '" name="linkMyAccount">我的帐号</a>页面点击查看所有订单。');
define('TEXT_CONTACT_STORE_OWNER', '如有任何疑问，请到<a href="' . zen_href_link(FILENAME_CONTACT_US) . '" name="linkContactUs">客户服务中心</a>。');
define('TEXT_THANKS_FOR_SHOPPING', '谢谢您在我们这里网上购物!');

define('TABLE_HEADING_COMMENTS', '');

define('FOOTER_DOWNLOAD', '或者以后到\'%s\'中下载。');

define('TEXT_YOUR_ORDER_NUMBER', '<strong>您的订单号是:</strong> ');

define('TEXT_CHECKOUT_LOGOFF_GUEST', '说明: 为了完成您的订单，创建了一个临时帐号，您可点击登出按钮关闭。点击登出保证下一个使用本计算机的人不会看到您的订单内容。当然也欢迎您继续购物，在任何时候可以选择登出。');
define('TEXT_CHECKOUT_LOGOFF_CUSTOMER', '多谢惠顾。请点击登出保证下一个使用本计算机的人不会看到您的订单内容。');