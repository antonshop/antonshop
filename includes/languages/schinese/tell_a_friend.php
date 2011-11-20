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
// $Id: tell_a_friend.php 290 2004-09-15 19:48:26Z wilt $
//

define('NAVBAR_TITLE', '推荐给朋友');

define('HEADING_TITLE', '向朋友介绍 \'%s\'');

define('FORM_TITLE_CUSTOMER_DETAILS', '您的资料');
define('FORM_TITLE_FRIEND_DETAILS', '您朋友的资料');
define('FORM_TITLE_FRIEND_MESSAGE', '您的留言');

define('FORM_FIELD_CUSTOMER_NAME', '您的姓名:');
define('FORM_FIELD_CUSTOMER_EMAIL', '您的电子邮件:');
define('FORM_FIELD_FRIEND_NAME', '朋友的姓名:');
define('FORM_FIELD_FRIEND_EMAIL', '朋友的电子邮件:');

define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');

define('TEXT_EMAIL_SUCCESSFUL_SENT', '您的<strong>%s</strong>电子邮件已经成功发送到<strong>%s</strong>。');

define('EMAIL_TEXT_HEADER','重要通知!');

define('EMAIL_TEXT_SUBJECT', '您的朋友%s向您介绍%s的一件商品' );
define('EMAIL_TEXT_GREET', '您好，%s!' . "\n\n");
define('EMAIL_TEXT_INTRO', '您的朋友%s，觉得您也许有兴趣看看%s，来自%s。');

define('EMAIL_TELL_A_FRIEND_MESSAGE','%s发了消息：');

define('EMAIL_TEXT_LINK', '要查看该商品, 点击下面的连接或者复制和粘贴链接到浏览器:' . "\n\n" . '%s');
define('EMAIL_TEXT_SIGNATURE', '谢谢，' . "\n\n" . '%s');

define('ERROR_TO_NAME', '错误: 您朋友的姓名不能为空。');
define('ERROR_TO_ADDRESS', '错误: 您朋友的电子邮件地址不对，请再输入一次。');
define('ERROR_FROM_NAME', '错误: 您的姓名不能为空。');
define('ERROR_FROM_ADDRESS', '错误: 您的电子邮件地址不对，请再输入一次。');
?>
