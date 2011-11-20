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
//  $Id: news.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

define('HEADING_TITLE', '新闻管理');
define('HEADING_TITLE_SEARCH', '搜索:');
define('HEADING_TITLE_SEARCH_PASTDAYS', '显示新闻的天数:');
define('HEADING_TITLE_GOTO_FROM', '显示新闻的起始日期:');
define('HEADING_TITLE_GOTO_TO', '终止日期:');

define('TABLE_HEADING_NEWS', '%s的新闻');
define('TABLE_HEADING_AUTHOR', '作者');
define('TABLE_HEADING_SORT_ORDER', '排序');
define('TABLE_HEADING_STATUS', '状态');
define('TABLE_HEADING_ACTION', '操作');

define('IMAGE_NEW_NEWS_ARTICLE', '新文章');
define('IMAGE_NEWS_COMMENTS', '新闻评论');

define('ICON_COMMENTS', '评论');

define('TEXT_NEWS_ARTICLES', '新闻:');
define('TEXT_NEW_NEWS', '新闻');

define('TEXT_INFO_HEADING_DELETE_NEWS', '删除新闻');
define('TEXT_DELETE_NEWS_INTRO', '您要删除该新闻吗?');

define('TEXT_INFO_HEADING_ARTICLE_NOT_FOUND', '没有找到新闻');
define('TEXT_ARTICLE_NOT_FOUND', '没有找到新闻。');

define('TEXT_NEWS_STATUS', '新闻状态:');
define('TEXT_NEWS_DATE_PUBLISHED', '提交日期:');
define('TEXT_NEWS_AVAILABLE', '发表日期');
define('TEXT_NEWS_NOT_AVAILABLE', '有效日期');
define('TEXT_NEWS_SORT_ORDER', '排序:');
define('TEXT_NEWS_AUTHOR', '作者:');

define('TEXT_NEWS_TEXT', '新闻内容');
define('TEXT_NEWS_SUMMARY', '摘要:');
define('TEXT_NEWS_CONTENT', '内容:');
define('TEXT_NEWS_HEADLINE', '标题:');
define('TEXT_NEWS_CONTENT_PREVIEW', '[预览内容]');

define('TEXT_NEWS_LINKS', '新闻链接');
define('TEXT_NEWS_URL', '外部链接:');
define('TEXT_NEWS_URL_2', '外部链接 2:');
define('TEXT_NEWS_URL_3', '外部链接 3:');
define('TEXT_NEWS_URL_4', '外部链接 4:');
define('TEXT_NEWS_URL_TEXT', '链接 1 文字:');
define('TEXT_NEWS_URL_2_TEXT', '链接 2 文字:');
define('TEXT_NEWS_URL_3_TEXT', '链接 3 文字:');
define('TEXT_NEWS_URL_4_TEXT', '链接 4 文字:');
define('TEXT_NEWS_URL_STORE', '商店商品链接:');
define('TEXT_NEWS_URL_STORE_2', '商店商品链接 2:');
define('TEXT_NEWS_URL_STORE_MISC', '商店其它链接 <small>(例如. 联系我们)</small>:');
define('TEXT_NEWS_URL_STORE_MISC_2', '商店其它链接 2 <small>(例如. 配送须知)</small>:');
define('TEXT_NEWS_URL_STORE_MISC_TEXT', '其它链接文字:');
define('TEXT_NEWS_URL_STORE_MISC_2_TEXT', '其它链接 2 文字:');
define('TEXT_NEWS_URL_WITHOUT_HTTP', '<small>(不含 http://)</small>');
define('TEXT_NEWS_ARTICLE_LINK', '<a href="http://%s" target="_blank"><u>%s</u></a>');
define('TEXT_NEWS_ARTICLE_STORE_LINK', '<a href="%s" target="_blank"><u>%s</u></a>');

define('TEXT_PLEASE_SELECT', '-- 无 --');

define('TEXT_NEWS_DATE_ADDED', '该新闻提交日期:');

define('TEXT_DATE_ADDED', '提交日期:');
define('TEXT_DATE_AVAILABLE', '发表日期:');
define('TEXT_LAST_MODIFIED', '最后修改:');
define('TEXT_IMAGE_NONEXISTENT', '新闻摘要图像不存在');
define('TEXT_NO_NEWS', '请输入一篇新闻。');
define('NO_NEWS_ITEMS', '没有新闻');

define('TEXT_DELETE_IMAGE_INTRO', '提示: 该新闻图像仅在其它新闻都不使用时，才会被删除。');

define('TEXT_NEWS_IMAGE_ONE', '新闻摘要图像:');
define('TEXT_NEWS_IMAGE_TWO', '新闻内容图像:');
define('TEXT_NEWS_IMAGE_SUBTITLE', '新闻摘要图像标题:');
define('TEXT_NEWS_IMAGE_SUBTITLE_TWO', '新闻内容图像标题:');

define('ERROR_NEWS_IMAGE_SM_DIRECTORY_NOT_WRITEABLE', '错误: 新闻的小图像目录不可写: ' . DIR_FS_CATALOG_IMAGES . 'news/images_small/');
define('ERROR_NEWS_IMAGE_SM_DIRECTORY_DOES_NOT_EXIST', '错误: 新闻的小图像目录不存在: ' . DIR_FS_CATALOG_IMAGES . 'news/images_small/');
define('ERROR_NEWS_IMAGE_MED_DIRECTORY_NOT_WRITEABLE', '错误: 新闻的中图像目录不可写: ' . DIR_FS_CATALOG_IMAGES . 'news/images_med/');
define('ERROR_NEWS_IMAGE_MED_DIRECTORY_DOES_NOT_EXIST', '错误: 新闻的中图像目录不存在: ' . DIR_FS_CATALOG_IMAGES . 'news/images_med/');
?>