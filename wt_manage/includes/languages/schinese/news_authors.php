<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2005 Joshua Dechant                               |
// |                                                                      |
// | Portions Copyright (c) 2003 The zen-cart developers                  |
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
//  $Id: news_authors.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

define('HEADING_TITLE', '新闻管理 - 作者');

define('TABLE_HEADING_AUTHOR', '作者');
define('TABLE_HEADING_EMAIL', '电子邮件地址');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_NEW_AUTHOR', '新增作者');
define('TEXT_HEADING_EDIT_AUTHOR', '编辑作者');
define('TEXT_HEADING_DELETE_AUTHOR', '上传作者');

define('TEXT_NEW_INTRO', '请填写下面的作者资料。');
define('TEXT_EDIT_INTRO', '修改作者信息');
define('TEXT_DELETE_INTRO', '您确认要删除该作者吗?');

define('TEXT_DELETE_ARTICLES', '删除该作者的文章。');
define('TEXT_REASSIGN_ARTICLES', '重新指定文章作者:');
define('TEXT_DELETE_ARTICLES_PRODUCTS', '<b>警告:</b> 该作者还有%s篇文章。');

define('TEXT_AUTHOR_NAME', '作者姓名:');
define('TEXT_AUTHOR_EMAIL', '作者电子邮件:');
define('TEXT_PLEASE_SELECT', '请选择');
define('TEXT_NO_OF_ARTICLES', '文章数量:');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', '显示 <b>%d</b> 到 <b>%d</b> (共<b>%d</b>个作者)');

define('ERROR_BLANK_AUTHOR_NAME', '作者姓名不能为空。');
define('ERROR_BLANK_AUTHOR_EMAIL', '作者电子邮件不能为空。');
define('ERROR_AUTHOR_EXISTS', '数据库中已有该作者姓名。');
define('ERROR_EMAIL_EXISTS', '数据库中已有该作者电子邮件。');
define('ERROR_SELECT_AUTHOR', '您必须选择一个新的作者。');

define('SUCCESS_STATUS', '该作者的状态已更新。');
define('SUCCESS_NEW_AUTHOR', '成功添加新的作者。');
define('SUCCESS_ARTICLES_DELETED', '该作者的文章已删除。');
define('SUCCESS_ARTICLES_REASSIGNED', '该作者的文章已重新指定作者。');
define('SUCCESS_DELETE_AUTHOR', '该作者已删除。');
define('SUCCESS_UPDATE_AUTHOR', '该作者的资料已更新。');
?>