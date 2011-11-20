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
// $Id: ssl_check.php 290 2004-09-15 19:48:26Z wilt $
//

define('NAVBAR_TITLE', '安全检查');
define('HEADING_TITLE', '安全检查');

define('TEXT_INFORMATION', '您的浏览器生成了不同的SSL Session ID.');
define('TEXT_INFORMATION_2', '出于安去方面的考虑, 请您重新登录后再购物.');
define('TEXT_INFORMATION_3','某些浏览器, 例如 Konqueror 3.1, 无法自动生成安全的 SSL Session ID. 如果您使用该类浏览器, 我们建议您换一个浏览器以继续在线购物. 如果您的电脑上没有其它的浏览器, 您可以到这里下载: <a href="http://www.microsoft.com/ie/" target="_blank">Microsoft Internet Explorer</a>, <a href="http://channels.netscape.com/ns/browsers/download_other.jsp" target="_blank">Netscape</a>, 或者 <a href="http://www.mozilla.org/releases/" target="_blank">Mozilla</a>.');
define('TEXT_INFORMATION_4','我们为了您的安全才这么做, 如果带来不便请谅解.');
define('TEXT_INFORMATION_5','如果您有任何疑问, 请联系我们.');

define('BOX_INFORMATION_HEADING', '隐私和安全');
define('BOX_INFORMATION', '我们自动核对您的浏览器生成的SSL Session ID.<br /><br />该验证保证只有您能用您的帐号访问我们的网站.');
?>
