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
//  $Id: news.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

define('HEADING_TITLE', 'News & Article Management');
define('HEADING_TITLE_SEARCH', 'Search:');
define('HEADING_TITLE_SEARCH_PASTDAYS', 'Number of news days to show:');
define('HEADING_TITLE_GOTO_FROM', 'Show articles published from:');
define('HEADING_TITLE_GOTO_TO', 'to:');

define('TABLE_HEADING_NEWS', 'News Articles for %s');
define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_SORT_ORDER', 'Sort Order');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('IMAGE_NEW_NEWS_ARTICLE', 'New Article');
define('IMAGE_NEWS_COMMENTS', 'News Comments');

define('ICON_COMMENTS', 'Comments');

define('TEXT_NEWS_ARTICLES', 'News Articles:');
define('TEXT_NEW_NEWS', 'News Article');

define('TEXT_INFO_HEADING_DELETE_NEWS', 'Delete News');
define('TEXT_DELETE_NEWS_INTRO', 'Are you sure you want to permanently delete this news article?');

define('TEXT_INFO_HEADING_ARTICLE_NOT_FOUND', 'No Articles Found');
define('TEXT_ARTICLE_NOT_FOUND', 'No news artciles were found.');

define('TEXT_NEWS_STATUS', 'News Article Status:');
define('TEXT_NEWS_DATE_PUBLISHED', 'Date Published:');
define('TEXT_NEWS_AVAILABLE', 'In Print');
define('TEXT_NEWS_NOT_AVAILABLE', 'Out of Print');
define('TEXT_NEWS_SORT_ORDER', 'Sort Order:');
define('TEXT_NEWS_AUTHOR', 'Author:');

define('TEXT_NEWS_TEXT', 'News Article Text');
define('TEXT_NEWS_SUMMARY', 'Summary:');
define('TEXT_NEWS_CONTENT', 'Content:');
define('TEXT_NEWS_HEADLINE', 'Headline:');
define('TEXT_NEWS_CONTENT_PREVIEW', '[preview content]');

define('TEXT_NEWS_LINKS', 'News Article Links');
define('TEXT_NEWS_URL', 'Outside link:');
define('TEXT_NEWS_URL_2', 'Outside link 2:');
define('TEXT_NEWS_URL_3', 'Outside link 3:');
define('TEXT_NEWS_URL_4', 'Outside link 4:');
define('TEXT_NEWS_URL_TEXT', 'Link 1 text:');
define('TEXT_NEWS_URL_2_TEXT', 'Link 2 text:');
define('TEXT_NEWS_URL_3_TEXT', 'Link 3 text:');
define('TEXT_NEWS_URL_4_TEXT', 'Link 4 text:');
define('TEXT_NEWS_URL_STORE', 'Store product link:');
define('TEXT_NEWS_URL_STORE_2', 'Store product link 2:');
define('TEXT_NEWS_URL_STORE_MISC', 'Store misc. link <small>(ex. contact_us)</small>:');
define('TEXT_NEWS_URL_STORE_MISC_2', 'Store misc. link 2 <small>(ex. shippinginfo)</small>:');
define('TEXT_NEWS_URL_STORE_MISC_TEXT', 'Misc link text:');
define('TEXT_NEWS_URL_STORE_MISC_2_TEXT', 'Misc link 2 text:');
define('TEXT_NEWS_URL_WITHOUT_HTTP', '<small>(without http://)</small>');
define('TEXT_NEWS_ARTICLE_LINK', '<a href="http://%s" target="_blank"><u>%s</u></a>');
define('TEXT_NEWS_ARTICLE_STORE_LINK', '<a href="%s" target="_blank"><u>%s</u></a>');

define('TEXT_PLEASE_SELECT', '-- None --');

define('TEXT_NEWS_DATE_ADDED', 'This story was submitted on:');

define('TEXT_DATE_ADDED', 'Date Added:');
define('TEXT_DATE_AVAILABLE', 'Date Available:');
define('TEXT_LAST_MODIFIED', 'Last Modified:');
define('TEXT_IMAGE_NONEXISTENT', 'SUMMARY IMAGE DOES NOT EXIST');
define('TEXT_NO_NEWS', 'Please insert a new news article.');
define('NO_NEWS_ITEMS', 'No New Articles');

define('TEXT_DELETE_IMAGE_INTRO', 'NOTICE: This article\'s images will be deleted only if they are not being used by another news article.');

define('TEXT_NEWS_IMAGE_ONE', 'Article Summary Image:');
define('TEXT_NEWS_IMAGE_TWO', 'Main Text Image:');
define('TEXT_NEWS_IMAGE_SUBTITLE', 'Article Summary Image Title:');
define('TEXT_NEWS_IMAGE_SUBTITLE_TWO', 'Main Text Image Title:');

define('ERROR_NEWS_IMAGE_SM_DIRECTORY_NOT_WRITEABLE', 'Error: News small images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES . 'news/images_small/');
define('ERROR_NEWS_IMAGE_SM_DIRECTORY_DOES_NOT_EXIST', 'Error: News small images directory does not exist: ' . DIR_FS_CATALOG_IMAGES . 'news/images_small/');
define('ERROR_NEWS_IMAGE_MED_DIRECTORY_NOT_WRITEABLE', 'Error: News medium images directory is not writeable: ' . DIR_FS_CATALOG_IMAGES . 'news/images_med/');
define('ERROR_NEWS_IMAGE_MED_DIRECTORY_DOES_NOT_EXIST', 'Error: News medium images directory does not exist: ' . DIR_FS_CATALOG_IMAGES . 'news/images_med/');
?>