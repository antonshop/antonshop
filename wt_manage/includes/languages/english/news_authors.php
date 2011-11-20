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
//  $Id: news_authors.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

define('HEADING_TITLE', 'News & Articles Management - Authors');

define('TABLE_HEADING_AUTHOR', 'Author');
define('TABLE_HEADING_EMAIL', 'E-Mail Address');
define('TABLE_HEADING_STATUS', 'Status');
define('TABLE_HEADING_ACTION', 'Action');

define('TEXT_HEADING_NEW_AUTHOR', 'New Author');
define('TEXT_HEADING_EDIT_AUTHOR', 'Edit Author');
define('TEXT_HEADING_DELETE_AUTHOR', 'Delete Author');

define('TEXT_NEW_INTRO', 'Please fill out the following information for the new author.');
define('TEXT_EDIT_INTRO', 'Modify user details.');
define('TEXT_DELETE_INTRO', 'Are you sure you want to delete this author?');

define('TEXT_DELETE_ARTICLES', 'Delete articles from this author.');
define('TEXT_REASSIGN_ARTICLES', 'Re-assign articles to the following author:');
define('TEXT_DELETE_ARTICLES_PRODUCTS', '<b>WARNING:</b> There are %s articles linked to this author!');

define('TEXT_AUTHOR_NAME', 'Author\'s Name:');
define('TEXT_AUTHOR_EMAIL', 'Author\'s E-Mail:');
define('TEXT_PLEASE_SELECT', 'Please Select');
define('TEXT_NO_OF_ARTICLES', 'No. of Articles:');
define('TEXT_DISPLAY_NUMBER_OF_AUTHORS', 'Displaying <b>%d</b> to <b>%d</b> (of <b>%d</b> news authors)');

define('ERROR_BLANK_AUTHOR_NAME', 'Author\'s Name cannot be blank.');
define('ERROR_BLANK_AUTHOR_EMAIL', 'Author\'s E-Mail cannot be blank.');
define('ERROR_AUTHOR_EXISTS', 'Author\'s Name already exists in the database.');
define('ERROR_EMAIL_EXISTS', 'Author\'s E-Mail already exists in the database.');
define('ERROR_SELECT_AUTHOR', 'You must select an author to re-assign the articles to.');

define('SUCCESS_STATUS', 'The author\'s status has been successfully changed.');
define('SUCCESS_NEW_AUTHOR', 'New author added successfully.');
define('SUCCESS_ARTICLES_DELETED', 'The author\'s articles has been successfully deleted.');
define('SUCCESS_ARTICLES_REASSIGNED', 'The author\'s articles have been successfully re-assigned.');
define('SUCCESS_DELETE_AUTHOR', 'The author has been successfully deleted.');
define('SUCCESS_UPDATE_AUTHOR', 'The author\'s details have been successfully updated.');
?>