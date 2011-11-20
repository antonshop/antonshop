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
// $Id: time_out.php 290 2004-09-15 19:48:26Z wilt $
//

define('NAVBAR_TITLE', '登录超时');
define('HEADING_TITLE', '哎哟！超时了 ...');
define('HEADING_TITLE_LOGGED_IN', '哎哟! 对不起，你没有执行权限。');
define('TEXT_INFORMATION', '<p>如果您正在下订单，请登录。您的购物车将保存，然后可以结帐。</p><p>如果您已有订单并想查看' . (DOWNLOAD_ENABLED == 'true' ? '，或者需要下载商品' : '') . '，请访问<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">我的帐号</a>页面查询订单。</p>');

define('TEXT_INFORMATION_LOGGED_IN', '您已经登录，可以继续购物。请从菜单中选择各项功能。');

define('HEADING_RETURNING_CUSTOMER', '登录');
define('TEXT_PASSWORD_FORGOTTEN', '忘记密码？')
?>