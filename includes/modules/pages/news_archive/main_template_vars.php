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
// $Id: main_template_vars.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

  $news = $db->Execute("select n.article_id, nt.news_article_name, n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.news_date_published like '" . $archive_date . "%' and to_days(n.news_date_published) <= to_days(now()) order by n.news_date_published DESC, n.sort_order");

  ////
  // set template variables
//modified by zen-cart.cn
//$newsDate = strtoupper(news_date_archive($archive_date));
  $newsDate = news_date_archive($archive_date);
  
  $newsHeaderLinks[] = array(
		'link' => $_SERVER['REQUEST_URI'] . '#archive',
		'text' => TEXT_VIEW_ARCHIVE_LIST,
	);

  /*$newsHeaderLinks[] = array(
		'link' => zen_href_link(FILENAME_NEWS_RSS, '', 'NONSSL', false),
		'text' => TEXT_NEWS_RSS_FEED,
	);*/

	if ($news->RecordCount() > 0) {
		$articles_array = array();
		while (!$news->EOF) {
			$articles_array[substr($news->fields['news_date_published'], 0, 10)][] = array(
				'link' => zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $news->fields['article_id']),
				'text' => stripslashes($news->fields['news_article_name']),
			);

			$news->MoveNext();
		}

		$articles_block_array = array();
		foreach ($articles_array as $date_published => $article) {
			$articles_block_array[] = array(
				'articlesDate' => zen_date_long($date_published),
				'articlesList' => $articles_array[$date_published],
				'articlesFooterDate' => zen_date_long($date_published),
				'articlesFooterDateURL' => zen_href_link(FILENAME_NEWS_INDEX, 'date=' . $date_published),
			);
		}

		$newsArticlesBlock = $articles_block_array;
	} else {
		$noneFound = true;
		$newsCurrentDate = news_date_archive($curren_date);
	}

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

	$newsArchiveList = $archive_array;

	$tpl_page_body = 'tpl_' . $_GET['main_page'] . '_default.php';
  require($template->get_template_dir($tpl_page_body, DIR_WS_TEMPLATE, $current_page_base,'templates') . '/' . $tpl_page_body);
?>