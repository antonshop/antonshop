<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: logoff.php 6992 2007-09-13 02:54:24Z ajeh $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

define('HEADING_TITLE', '退出');
define('NAVBAR_TITLE', '退出');
define('TEXT_MAIN', '您已经成功退出您的帐号，可以安全离开电脑了。<br /><br />如果购物车中有商品，将会保存，<a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">重新登录时</span></a>，能看到所有保存的商品。<br />');
?>