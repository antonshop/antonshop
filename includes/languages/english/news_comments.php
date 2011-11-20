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
// $Id: news_comments.php v2.000 2004-01-23 dreamscape <dechantj@pop.belmont.edu>
//

define('NAVBAR_TITLE', 'Store News');
define('NAVBAR_TITLE_COMMENTS', 'Comments');
define('HEADING_TITLE', 'Store News');

define('DATE_FORMAT_NEWS', DATE_FORMAT_SHORT . ' - %I:%M %p');

define('TEXT_ARTICLE_BY_LINE', 'by %s');

define('TEXT_NO_NEWS_COMMENTS', 'No comments have been posted yet.');

define('ENTRY_NEWS_NAME_ERROR', 'Your Name must be ' . ENTRY_NEWS_NAME_MIN_LENGTH . ' characters long');
define('ENTRY_NEWS_COMMENTS_ERROR', 'Your comments must be ' . ENTRY_NEWS_COMMENTS_MIN_LENGTH . ' characters long');

define('COMMENTS_FIELDSET_LEGEND', 'Post A Comment');
define('COMMENTS_FIELDSET_NAME', 'Name:');
define('COMMENTS_FIELDSET_SUBJECT', 'Subject:');
define('COMMENTS_FIELDSET_COMMENTS', 'Comments:');

define('TEXT_COMMENTS_MUST_LOGIN', 'You must be <a href="%s">logged in</a> to submit a comment.');

define('SUCCESS_NEWS_COMMENTS_SUBMITTED', 'Your comments have been successfully submitted');

define('TEXT_NEWS_FOOTER', 'News for %s');
define('TEXT_NEWS_FOOTER_OTHER', 'Other news for %s');
define('TEXT_NEWS_FOOTER_URL', 'View all news for %s ');

define('TEXT_RECENT_NEWS', 'Recent News');

define('TEXT_NEWS_ARCHIVE_LINK', 'News archive');

// email stuff
define('EMAIL_NOTIFICATION_SUBJECT', 'A News Comment Has Been Submitted');
define('EMAIL_NOTIFICATION_TEXT_INTRO', 'Some news comments were submitted at ' . STORE_NAME . '.');
define('EMAIL_NOTIFICATION_TEXT_BODY', '
Submitted by:  %s<br>
Article commented on:  <a href="%s">%s</a><br>
Comments URL:  %s
');
?>