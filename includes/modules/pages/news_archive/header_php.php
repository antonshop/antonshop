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
// $Id: header_php.php v2.000 2004-01-23 dreamscape <dechantj@pop.belmont.edu>
//

  require(DIR_WS_MODULES . 'require_languages.php');

	require_once(DIR_WS_CLASSES . 'news.php');

	require_once(DIR_WS_FUNCTIONS . 'news.php');

  // People are trying to view the future... the universe will be destroyed if we don't stop them!
  if (isset($_GET['date']) && ($_GET['date'] > date('Y-m') || !zen_not_null($_GET['date'])) ) {
    zen_redirect(zen_href_link(FILENAME_NEWS_ARCHIVE));
  }

  // Set the current date
  $curren_date = ((!isset($_GET['date'])) ? date('Y-m-d') : $_GET['date']);

  // Find the date news was published most recently from the current date (but not the future you dummy)
  $date_selector = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_status = '1' and to_days(news_date_published) <= to_days('" . $curren_date . "') order by news_date_published DESC limit 1");

  // Set the current archive date
  $archive_date = ((!isset($_GET['date'])) ? substr($date_selector->fields['news_date_published'], 0, 7) : $_GET['date']);

  // Everybody loves the breadcrumb
  $breadcrumb->add(NAVBAR_TITLE, zen_href_link(FILENAME_NEWS_INDEX));

	if (isset($_GET['date'])) {
	  $breadcrumb->add(news_date_archive($archive_date), zen_href_link(FILENAME_NEWS_ARCHIVE, 'date=' . $archive_date));
	} else {
	  $breadcrumb->add(news_date_archive($archive_date), zen_href_link(FILENAME_NEWS_ARCHIVE));
	}
?>