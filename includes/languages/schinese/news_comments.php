<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2004-2005 Joshua Dechant                               |
// |                                                                      |   
// | Portions Copyright (c) 2004 The zen-cart developers                  |
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
// $Id: news_comments.php v2.000 2004-01-23 dreamscape <dechantj@pop.belmont.edu>
//

define('NAVBAR_TITLE', '商店新闻');
define('NAVBAR_TITLE_COMMENTS', '评论');
define('HEADING_TITLE', '商店新闻');

define('DATE_FORMAT_NEWS', DATE_FORMAT_SHORT . ' - %I:%M %p');

define('TEXT_ARTICLE_BY_LINE', '作者: %s');

define('TEXT_NO_NEWS_COMMENTS', '还没有评论。');

define('ENTRY_NEWS_NAME_ERROR', '您的姓名至少要' . ENTRY_NEWS_NAME_MIN_LENGTH . '个字符');
define('ENTRY_NEWS_COMMENTS_ERROR', '您的评论至少要' . ENTRY_NEWS_COMMENTS_MIN_LENGTH . '个字符');

define('COMMENTS_FIELDSET_LEGEND', '发表评论');
define('COMMENTS_FIELDSET_NAME', '姓名:');
define('COMMENTS_FIELDSET_SUBJECT', '主题:');
define('COMMENTS_FIELDSET_COMMENTS', '评论:');

define('TEXT_COMMENTS_MUST_LOGIN', '请<a href="%s">登录</a>后再发表评论。');

define('SUCCESS_NEWS_COMMENTS_SUBMITTED', '您的评论已提交。');

define('TEXT_NEWS_FOOTER', '有关%s的新闻');
define('TEXT_NEWS_FOOTER_OTHER', '有关%s的其它新闻');
define('TEXT_NEWS_FOOTER_URL', '<u>一页上查看%s的所有新闻</u>');

define('TEXT_RECENT_NEWS', '最新消息');

define('TEXT_NEWS_ARCHIVE_LINK', '新闻存档');

// email stuff
define('EMAIL_NOTIFICATION_SUBJECT', '一个新闻评论已提交');
define('EMAIL_NOTIFICATION_TEXT_INTRO', '一些新闻评论已提交到' . STORE_NAME . '。');
define('EMAIL_NOTIFICATION_TEXT_BODY', '
提交人:  %s<br>
评论商品:  <a href="%s">%s</a><br>
评论网址:  %s
');
?>