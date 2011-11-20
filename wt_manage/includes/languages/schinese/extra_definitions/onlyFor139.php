<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: onlyFor139.php 15788 2010-04-02 10:44:40Z drbyte $
 *
 *
 * NOTE: This file is only for v1.3.9, and should be deleted when upgrading to v2.x, since its contents will be merged with the main language files.
 *
 *
 */
if (!defined('IS_ADMIN_FLAG'))
{
  die('Illegal Access');
}

define('WARNING_ADMIN_FOLDERNAME_VULNERABLE', '注意: <a href="http://www.zen-cart.cn/forum/topic88.html" target="_blank">您的 /admin/ 目录要修改</a>以防止他人使用。');
define('WARNING_EMAIL_SYSTEM_DISABLED', '警告: 邮件系统是未打开，要在管理页面->商店设置->电子邮件选项下打开后系统才会发送邮件。');
define('TEXT_CURRENT_VER_IS', '您正在使用: ');
define('ERROR_NO_DATA_TO_SAVE', '错误: 提交的数据为空，修改没有保存。可能您的浏览器或者Internet有问题。');
define('TEXT_HIDDEN', '隐藏');
define('TEXT_VISIBLE', '可见');
define('TEXT_HIDE', '隐藏');
define('TEXT_EMAIL', '邮件');
define('TEXT_NOEMAIL', '没有邮件');
