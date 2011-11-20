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
// $Id: header_php.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

  require(DIR_WS_MODULES . 'require_languages.php');

	require_once(DIR_WS_CLASSES . 'rss.php');

	require_once(DIR_WS_FUNCTIONS . 'news.php');

	$rss = new rssFeed();

	$rss->rssBegin(CHARSET);

	if (file_exists($template->get_template_dir('news_rss_logo.gif', DIR_WS_TEMPLATE, $current_page_base, 'images') . '/' . 'news_rss_logo.gif')) {
		$image = zen_href_link($template->get_template_dir('news_rss_logo.gif', DIR_WS_TEMPLATE, $current_page_base, 'images') . '/' . 'news_rss_logo.gif', '', 'NONSSL', false, true, true);
	} else {
		$image = false;
	}

	$rss->rssBeginChannel(NEWS_RSS_TITLE, zen_href_link(FILENAME_NEWS_INDEX, '', 'NONSSL', false), NEWS_RSS_DESCRIPTION, NEWS_RSS_LANGUAGE, $image, NEWS_RSS_COPYRIGHT, NEWS_RSS_MANAGING_EDITOR, NEWS_RSS_WEBMASTER);

  $date_selector = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_status = '1' and to_days(news_date_published) <= to_days(now()) group by news_date_published desc limit " . (int)NEWS_RSS_FEED_NUMBER_OF_DAYS);
  while (!$date_selector->EOF) {

		$article = $db->Execute("select n.article_id, na.author_name, na.author_email, nt.news_article_name, nt.news_article_text, nt.news_article_shorttext, n.news_image, nt.news_image_text, n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "'), " . TABLE_NEWS_AUTHORS . " na where n.authors_id = na.authors_id and n.news_status = '1' and n.news_date_published = '" . $date_selector->fields['news_date_published'] . "' order by n.sort_order");
		while (!$article->EOF) {
			$rss->rssItem(stripslashes($article->fields['news_article_name']), zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $article->fields['article_id'], 'NONSSL', false), news_create_news_summary($article->fields['news_article_text'], $article->fields['news_article_shorttext']), $article->fields['author_name'] . ' <' . $article->fields['author_email'] . '>', false, zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $article->fields['article_id'], 'NONSSL', false), zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $article->fields['article_id'], 'NONSSL', false), news_date_rss($article->fields['news_date_published']));

			$article->MoveNext();
		}

		$date_selector->MoveNext();
  }

	$rss->rssChannelEnd();

	$rss->rssEnd();

	$rss->displayRSS();

	require(DIR_WS_INCLUDES . 'application_bottom.php');

	zen_exit();
?>
