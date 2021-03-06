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
//  $Id: news.php v2.000 2005-01-23 dreamscape <dechantj@pop.belmont.edu>
//

  define('TABLE_NEWS_ARTICLES', DB_PREFIX . 'news_articles');
  define('TABLE_NEWS_ARTICLES_TEXT', DB_PREFIX . 'news_articles_text');
  define('TABLE_NEWS_AUTHORS', DB_PREFIX . 'news_authors');
  define('TABLE_NEWS_COMMENTS', DB_PREFIX . 'news_comments');
  define('TABLE_NEWS_COMMENTS_DESCRIPTION', DB_PREFIX . 'news_comments_description');

  define('FILENAME_NEWS', 'news.php');
  define('FILENAME_NEWS_AUTHORS', 'news_authors.php');
  define('FILENAME_NEWS_COMMENTS', 'news_comments.php');
?>