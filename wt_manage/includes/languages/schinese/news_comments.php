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
//  $Id: news_comments.php v2.000 2005-01-23 dreamscape <dechantj@pop.belmont.edu>
//

define('HEADING_TITLE', '新闻管理 - %s - 评论');

define('TABLE_HEADING_COMMENTS_BY', '评论人');
define('TABLE_HEADING_SUBJECT', '主题');
define('TABLE_HEADING_DATE_ADDED', '评论日期时间/时间');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_HEADING_COMMENT', '评论内容');
define('TEXT_HEADING_NEW_COMMENT', '新添评论');
define('TEXT_HEADING_EDIT_COMMENT', '编辑评论');
define('TEXT_HEADING_DELETE_COMMENT', '删除评论');

define('TEXT_NEW_INTRO', '请填写以下评论内容。');
define('TEXT_EDIT_INTRO', '修改评论内容。');
define('TEXT_DELETE_INTRO', '您确认要删除该评论吗?');

define('TEXT_COMMENTS_BY', '评论人:');
define('TEXT_SUBJECT', '主题:');
define('TEXT_COMMENTS', '评论:');

define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', '显示 <b>%d</b> 到 <b>%d</b> (共<b>%d</b>个新闻评论)');

define('ERROR_BLANK_COMMENTS_BY_NAME', '"评论人" 不能为空。');
define('ERROR_BLANK_COMMENTS', '"评论内容" 不能为空。');

define('SUCCESS_STATUS', '该评论状态已更新。');
define('SUCCESS_NEW_COMMENT', '新的评论添加成功。');
define('SUCCESS_UPDATE_COMMENT', '该评论的内容已更新。');
define('SUCCESS_DELETE_COMMENT', '该评论已删除。');
?>