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
// $Id: gv_redeem.php 4155 2006-08-16 17:14:52Z ajeh $
//

define('NAVBAR_TITLE', '兑现' . TEXT_GV_NAME);
define('HEADING_TITLE', '兑现' . TEXT_GV_NAME);
define('TEXT_INFORMATION', '有关' . TEXT_GV_NAME . '的详细说明, 请参阅 <a href="' . zen_href_link(FILENAME_GV_FAQ, '', 'NONSSL').'">' . GV_FAQ . '.</a>');
define('TEXT_INVALID_GV', '该' . TEXT_GV_NAME . '代码%s无效或者已经兑现。要联系我们，请使用联系页面。');
define('TEXT_VALID_GV', '恭喜，您兑现了一张' . TEXT_GV_NAME . '，价值%s');
?>