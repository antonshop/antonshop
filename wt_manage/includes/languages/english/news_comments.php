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
//  $Id: news_comments.php v2.000 2005-01-23 dreamscape <dechantj@pop.belmont.edu>
//

define('HEADING_TITLE', 'News & Articles Management - %s - Comments');

define('TABLE_HEADING_COMMENTS_BY', 'Comments By');
define('TABLE_HEADING_SUBJECT', 'Subject');
define('TABLE_HEADING_DATE_ADDED', 'Date/Time Added');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_HEADING_COMMENT', 'Comment Details');
define('TEXT_HEADING_NEW_COMMENT', 'New Comment');
define('TEXT_HEADING_EDIT_COMMENT', 'Edit Comment');
define('TEXT_HEADING_DELETE_COMMENT', 'Delete Comment');

define('TEXT_NEW_INTRO', 'Please fill out the following information for the new comment.');
define('TEXT_EDIT_INTRO', 'Modify comment details.');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this comment?');

define('TEXT_COMMENTS_BY', 'Comments By:');
define('TEXT_SUBJECT', 'Subject:');
define('TEXT_COMMENTS', 'Comments:');

define('TEXT_DISPLAY_NUMBER_OF_COMMENTS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> news comments)');

define('ERROR_BLANK_COMMENTS_BY_NAME', '"Comments By" cannot be blank.');
define('ERROR_BLANK_COMMENTS', '"Comments" cannot be blank.');

define('SUCCESS_STATUS', 'The comment\'s status has been successfully changed.');
define('SUCCESS_NEW_COMMENT', 'New comment added successfully.');
define('SUCCESS_UPDATE_COMMENT', 'The comment\'s details have been successfully updated.');
define('SUCCESS_DELETE_COMMENT', 'The comment has been successfully deleted.');
?>