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
// $Id: password_forgotten.php 290 2004-09-15 19:48:26Z wilt $
//

define('NAVBAR_TITLE_1', '登录');
define('NAVBAR_TITLE_2', '取回密码');

define('HEADING_TITLE', '取回密码');

define('TEXT_MAIN', '请输入您的电子邮件地址，我们会将新的密码发给您');

define('TEXT_NO_EMAIL_ADDRESS_FOUND', '错误: 该电子邮件地址不在记录中，请再试一次。');

define('EMAIL_PASSWORD_REMINDER_SUBJECT', STORE_NAME . ' - 新密码');
define('EMAIL_PASSWORD_REMINDER_BODY', '重置密码的请求来自' . $_SERVER['REMOTE_ADDR']  . '。' . "\n\n" . '您在\'' . STORE_NAME . '\'的新密码是:' . "\n\n" . '   %s' . "\n\n用新的密码登录后，可以在'我的帐号'中修改。");

define('SUCCESS_PASSWORD_SENT', '新密码已经发到您的邮箱了。');
?>