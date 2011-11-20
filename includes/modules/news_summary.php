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
// $Id: news_summary.php v2.110 2005-02-04 dreamscape <dechantj@pop.belmont.edu>
//

	// News Summary
	if (DISPLAY_NEWS_SUMMARY == 'true') {
		require(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . FILENAME_NEWS_INDEX . '.php');

		require_once(DIR_WS_CLASSES . 'news.php');

		require_once(DIR_WS_FUNCTIONS . 'news.php');

		$date_selector = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_status = '1' and to_days(news_date_published) >= to_days(now())-" . (int)DISPLAY_NEWS_SUMMARY_DAYS . " and to_days(news_date_published) <= to_days(now()) order by news_date_published desc limit 1");
		if ($date_selector->RecordCount() > 0) {

			$article = $db->Execute("select n.article_id, nt.news_article_name, nt.news_article_text, nt.news_article_shorttext, n.news_image, nt.news_image_text, n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.news_date_published = '" . $date_selector->fields['news_date_published'] . "' order by n.sort_order limit 1");

// modified by zen-cart.cn
//			$newsDate = strtoupper(zen_date_long($date_selector->fields['news_date_published']));
			$newsDate = zen_date_long($date_selector->fields['news_date_published']);

			$newsHeaderLinks[] = array(
				'link' => zen_href_link(FILENAME_NEWS_RSS, '', 'NONSSL', false),
				'text' => TEXT_NEWS_RSS_FEED,
			);

			if ((zen_not_null($article->fields['news_image'])) && file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . $article->fields['news_image'])) {
				$articleImage = zen_image(DIR_WS_IMAGES . $article->fields['news_image'], $article->fields['news_image_text'], '', '', ' align="right" class="articleImage"');
			}

			$articleLink = zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $article->fields['article_id']);
			$articleName = stripslashes($article->fields['news_article_name']);
			$articleSummary = news_create_news_summary($article->fields['news_article_text'], $article->fields['news_article_shorttext']);

			$news_subfooter = $db->Execute("select n.article_id, nt.news_article_name, n.news_date_published, n.news_status from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.news_date_published = '" . $date_selector->fields['news_date_published'] . "' and n.article_id != '" . $article->fields['article_id'] . "' order by n.sort_order");
			if ($news_subfooter->RecordCount() > 0) {
				$news_subfooter_array = array();
				while (!$news_subfooter->EOF) {
					$news_subfooter_array[] = array(
						'link' => zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $news_subfooter->fields['article_id']),
						'text' => stripslashes($news_subfooter->fields['news_article_name']),
					);
	
					$news_subfooter->MoveNext();
				}

				$newsSubFooter = $news_subfooter_array;
				$newsSubFooterDate = zen_date_long($date_selector->fields['news_date_published']);
				$newsSubFooterDateURL = zen_href_link(FILENAME_NEWS_INDEX, 'date=' . substr($date_selector->fields['news_date_published'], 0, 10));
			}

			// Now display the news summary
			// Start the news display class
			$newsDisplay = new newsDisplay();

			// News header
			$newsDisplay->newsHeader(HEADING_NEWS_SUMMARY, $newsDate, $newsHeaderLinks);

			// News article summary
			$newsDisplay->articleSummary($articleName, $articleSummary, $articleLink, TEXT_READ_FULL_ARTICLE, $articleImage);

			// News SubFooter
			$newsDisplay->articleFooter(sprintf(TEXT_NEWS_FOOTER_OTHER, $newsSubFooterDate), $newsSubFooter, $newsSubFooterDateURL, sprintf(TEXT_NEWS_FOOTER_URL, $newsSubFooterDate));

			// Archive link
			$newsDisplay->archiveLink(zen_href_link(FILENAME_NEWS_ARCHIVE), TEXT_NEWS_ARCHIVE_LINK);

			$newsDisplay->clearSplit();
			$newsDisplay->clearSplit();

			// Display this news page
			// New page content is output in valid XHTML
			// You can change how it displays in the stylesheet_news.css file
			$newsDisplay->displayNewsPage();
		}
	}
?>