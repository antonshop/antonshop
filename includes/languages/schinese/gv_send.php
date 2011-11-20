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
// $Id: gv_send.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_TITLE', '发送' . TEXT_GV_NAME);
define('HEADING_TITLE_CONFIRM_SEND', '发送' . TEXT_GV_NAME . '确认');
define('HEADING_TITLE_COMPLETED', TEXT_GV_NAME . '已发出');
define('NAVBAR_TITLE', '发送' . TEXT_GV_NAME);
define('EMAIL_SUBJECT', '邮件自 ' . STORE_NAME);

define('HEADING_TEXT','请在下面输入姓名、电子邮件地址以及您要发送的' . TEXT_GV_NAME . '金额。详细说明见<a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '。</a>');
define('ENTRY_NAME', '接收人姓名:');
define('ENTRY_EMAIL', '接收人邮件:');
define('ENTRY_MESSAGE', '给接收人的留言:');
define('ENTRY_AMOUNT', '发送金额:');
define('ERROR_ENTRY_TO_NAME_CHECK', '没有接收人姓名。请在下面输入。');
define('ERROR_ENTRY_AMOUNT_CHECK', TEXT_GV_NAME . '金额不对。请再试一次。');
define('ERROR_ENTRY_EMAIL_ADDRESS_CHECK', '电子邮件地址正确吗？请再试一次。');
define('MAIN_MESSAGE', '您正在发送的' . TEXT_GV_NAME . '金额为%s到%s，电子邮件地址为%s。如果不正确，请点击<strong>编辑</strong>按钮修改。<br /><br />您正在发送的内容为:<br /><br />');
define('SECONDARY_MESSAGE', '亲爱的%s，<br /><br />' . '您发送了一张' . TEXT_GV_NAME . '，金额为%s，通过%s');
define('PERSONAL_MESSAGE', '%s写到:');
define('TEXT_SUCCESS', '恭喜，您的' . TEXT_GV_NAME . '已发送。');
define('TEXT_SEND_ANOTHER', '您想发送另外一张' . TEXT_GV_NAME . '吗？');
define('TEXT_AVAILABLE_BALANCE',  '礼券帐号');

define('EMAIL_GV_TEXT_SUBJECT', '来自%s的礼物');
define('EMAIL_SEPARATOR', '----------------------------------------------------------------------------------------');
define('EMAIL_GV_TEXT_HEADER', '恭喜，您收到了一份' . TEXT_GV_NAME . '，金额为%s');
define('EMAIL_GV_FROM', '该' . TEXT_GV_NAME . '来自%s');
define('EMAIL_GV_MESSAGE', '留言内容: ');
define('EMAIL_GV_SEND_TO', '您好，%s');
define('EMAIL_GV_REDEEM', '要兑现该' . TEXT_GV_NAME . '，请点击下面的链接。同时记下' . TEXT_GV_REDEEM . ': %s 以备查询。');
define('EMAIL_GV_LINK', '要兑现请点击这里');
define('EMAIL_GV_VISIT', '，或访问');
define('EMAIL_GV_ENTER', '，并输入' . TEXT_GV_REDEEM . ' ');
define('EMAIL_GV_FIXED_FOOTER', '如果您不能通过上面的链接兑现' . TEXT_GV_NAME . '，' . "\n" .
                                '可以在我们的商店结帐时输入' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . '。');
define('EMAIL_GV_SHOP_FOOTER', '');
?>