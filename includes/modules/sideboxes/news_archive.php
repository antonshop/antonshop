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
// $Id: news_archive.php v1.000 2005-02-04 dreamscape <dechantj@pop.belmont.edu>
//

require_once(DIR_WS_CLASSES . 'news.php');

require_once(DIR_WS_FUNCTIONS . 'news.php');
/*
	// Lets create the archive list between the earliest and latest news dates
	$date_begin = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_status = '1' group by news_date_published ASC limit 1");
	$date_end = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_status = '1' group by news_date_published DESC limit 1");

	$start_date = mktime(0, 0, 0, (int)substr($date_begin->fields['news_date_published'], 5, 2), 1, (int)substr($date_begin->fields['news_date_published'], 0, 4));
	$end_date = mktime(0, 0, 0, (int)substr($date_end->fields['news_date_published'], 5, 2), 1, (int)substr($date_end->fields['news_date_published'], 0, 4));

	$date_split = getdate($end_date);
	$month = $date_split['mon'];
	$year = $date_split['year'];

	$i = 0;
	$archive_array = array();
	while (mktime(0, 0, 0, $month, 1, $year) >= $start_date) {

		// Only show the month in the archive list if there was news for that month	
		$test_date = date('Y-m', mktime(0, 0, 0, $month, 1, $year));
		$test = $db->Execute("select article_id from " . TABLE_NEWS_ARTICLES . " where news_status = '1' and news_date_published like '" . $test_date . "%'");
		if ($test->RecordCount() > 0) {
			$archive_array[$i]['archiveDate'] = strftime('%Y', mktime(0, 0, 0, $month, 1, $year));
			$archive_array[$i]['archiveLinks'][] = array(
				'link' => zen_href_link(FILENAME_NEWS_ARCHIVE, 'date=' . date('Y-m', mktime(0, 0, 0, $month, 1, $year))),
				'text' => strftime('%B', mktime(0, 0, 0, $month, 1, $year)),
			);
		}

		$month--;
		if ($month == 0) {
			$month = 12;
			$year--;
			$i++;
		}
	}
*/
	
$sql = "select n.article_id, nt.news_article_name, n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.news_date_published like '" . $archive_date . "%' and to_days(n.news_date_published) <= to_days(now()) order by n.news_date_published DESC, n.sort_order limit " . NEWS_SIDEBAR_SHOW_NUMBER;
$news = $db->Execute($sql);

if ($news->RecordCount() > 0) {
	$archives_array = array();
	while (!$news->EOF) {
		$news->fields['link'] = zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id='.$news->fields['article_id']);
		$archives_array[] = $news->fields;
		$news->MoveNext();
	}
}

if (sizeof($archives_array) > 0) {
	$newsArchiveList = $archives_array;
	
	require($template->get_template_dir('tpl_news_archive.php',DIR_WS_TEMPLATE, $current_page_base, 'sideboxes'). '/tpl_news_archive.php');
	
	$title =  BOX_HEADING_NEWS_ARCHIVE;
	$left_corner = false;
	$right_corner = false;
	$right_arrow = false;
	$title_link = FILENAME_NEWS_ARCHIVE;
	
	require($template->get_template_dir($column_box_default, DIR_WS_TEMPLATE, $current_page_base, 'common') . '/' . $column_box_default);
}
?>
