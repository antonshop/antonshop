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
// $Id: popup_cvv_help.php 290 2004-09-15 19:48:26Z wilt $
//

define('HEADING_CVV', '什么是 CVV?');
define('TEXT_CVV_HELP1', 'Visa, Mastercard, Discover 三位数字校验码<br /><br />
                    为了您的安全, 请您输入信用卡的校验码.<br /><br />
                    该校验码是印在卡后的三位数字.
                    该号码紧接在信用卡号的后面.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2visa.gif'));

define('TEXT_CVV_HELP2', 'American Express 四位数字校验码<br /><br />
                    为了您的安全, 请您输入信用卡的校验码.<br /><br />
                    American Express校验码是印在卡正面上的四位数字.
                    该号码紧接在信用卡号的后面.<br />' .
                    zen_image(DIR_WS_TEMPLATE_ICONS . 'cvv2amex.gif'));

define('TEXT_CLOSE_CVV_WINDOW', '关闭窗口 [x]');
?>