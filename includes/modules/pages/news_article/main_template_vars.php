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

  $news = $db->Execute("select n.article_id, na.author_name, nt.news_article_name, nt.news_article_text, nt.news_article_url, nt.news_article_url_text, nt.news_article_url_2, nt.news_article_url_2_text, nt.news_article_url_3, nt.news_article_url_3_text, nt.news_article_url_4, nt.news_article_url_4_text, nt.news_article_url_store, nt.news_article_url_store_2, nt.news_article_url_store_misc, nt.news_article_url_store_misc_text, nt.news_article_url_store_misc_2, nt.news_article_url_store_misc_2_text, nt.news_image_text, nt.news_image_text_two, n.news_image, n.news_image_two, n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "'), " . TABLE_NEWS_AUTHORS . " na where n.authors_id = na.authors_id and n.news_status = '1' and n.article_id = '" . (int)$_GET['article_id'] . "'");

	$comments = $db->Execute("select count(*) as count from " . TABLE_NEWS_COMMENTS . " where approved = '1' and article_id = '" . (int)$_GET['article_id'] . "'");

  ////
  // set template variables
//modified by zen-cart.cn
//$newsDate = strtoupper(zen_date_long($date));
  $newsDate = zen_date_long($date);

 /* $newsHeaderLinks[] = array(
		'link' => zen_href_link(FILENAME_NEWS_RSS, '', 'NONSSL', false),
		'text' => TEXT_NEWS_RSS_FEED,
	);*/

	$articleName = stripslashes($news->fields['news_article_name']);
	$articleAuthor = $news->fields['author_name'];
	$commentsURL = zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $news->fields['article_id']);
	$comments = $comments->fields['count'];
	$articleText = stripslashes($news->fields['news_article_text']);
	
	if ((zen_not_null($news->fields['news_image_two'])) && file_exists(DIR_FS_CATALOG . DIR_WS_IMAGES . $news->fields['news_image_two'])) {
		$articleImage = zen_image(DIR_WS_IMAGES . $news->fields['news_image_two'], $news->fields['news_image_text_two'], '', '', 'align="right" class="articleImage"');
	}
      
///
// Article Links
	$article_links_array = array();

	// Article Links - Offsite
	$addon = '';
	$offsite_links_array = array();
	for ($n=1; $n<=4; $n++) {
		if ($n != 1) $addon = "_$n";
		if (zen_not_null($news->fields['news_article_url' . $addon])) {
			$offsite_links_array[] = array(
				'link' => zen_href_link(FILENAME_REDIRECT, 'action=url&goto=' . urlencode($news->fields['news_article_url' . $addon]), 'NONSSL', true, false),
				'text' => stripslashes($news->fields['news_article_url' . $addon . '_text']),
			 );
		}
	}

	$article_links_array[0]['offsiteLinks'] = $offsite_links_array;

	// Article Links - Store Product
	$addon = '';
	$product_links_array = array();
	for ($n=1; $n<=2; $n++) {
		if ($n != 1) $addon = "_$n";
		if ($news->fields['news_article_url_store' . $addon] > 0) {
			$product_links_array[] = array(
				'link' => zen_href_link(FILENAME_PRODUCT_INFO, 'products_id=' . $news->fields['news_article_url_store' . $addon]),
				'text' => sprintf(TEXT_BUY_PRODUCT_FROM_US, zen_get_products_name($news->fields['news_article_url_store' . $addon])),
			);
		}
	}

	$article_links_array[0]['productLinks'] = $product_links_array;

	// Article Links - Onsite
	$addon = '';
	$store_links_array = array();
	for ($n=1; $n<=2; $n++) {
		if ($n != 1) $addon = "_$n";
		if (zen_not_null($news->fields['news_article_url_store_misc' . $addon])) {
			$store_links_array[] = array(
				'link' => zen_href_link($news->fields['news_article_url_store_misc' . $addon]),
				'text' => stripslashes($news->fields['news_article_url_store_misc' . $addon . '_text']),
			);
		}
	}    

	$article_links_array[0]['storeLinks'] = $store_links_array;

	$articleLinks = $article_links_array;

	// News SubFooter
	$news_subfooter= $db->Execute("select n.article_id, nt.news_article_name, n.news_date_published, n.news_status from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.news_date_published = '" . $date_selector_array[0]['date'] . "' and n.article_id != '" . (int)$_GET['article_id'] . "' order by n.sort_order");
	if ($news_subfooter->RecordCount() > 0) {
		$news_subfooter_array = array();
		while (!$news_subfooter->EOF) {
			$news_subfooter_array[] = array(
				'link' => zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $news_subfooter->fields['article_id']),
				'text' => stripslashes($news_subfooter->fields['news_article_name']),
			);

			$news_subfooter->MoveNext();
		}

		$newsSubFooterDate = zen_date_long($date_selector_array[0]['date']);
		$newsSubFooterDateURL = zen_href_link(FILENAME_NEWS_INDEX, 'date=' . substr($date_selector_array[0]['date'], 0, 10));
		$newsSubFooter = $news_subfooter_array;
	}

	// News Footer
	if ($date_selector_array[1]['date']) {
		$news_footer = $db->Execute("select n.article_id, nt.news_article_name from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.news_date_published = '" . $date_selector_array[1]['date'] . "' order by n.sort_order");
		if ($news_footer->RecordCount() > 0) {
			$news_footer_array = array();
			while (!$news_footer->EOF) {
				$news_footer_array[] = array(
					'link' => zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $news_footer->fields['article_id']),
					'text' => stripslashes($news_footer->fields['news_article_name']),
				);

				$news_footer->MoveNext();
			}

			$newsFooterDate = zen_date_long($date_selector_array[1]['date']);
			$newsFooterDateURL = zen_href_link(FILENAME_NEWS_INDEX, 'date=' . substr($date_selector_array[1]['date'], 0, 10));
			$newsFooter = $news_footer_array;
		}
	}

	// News Recent Footer
  if ($date_selector_array[2]['date']) {
    $recent_footer_array = array();
    for ($i=2; $i<sizeof($date_selector_array); $i++) {
      $recent_footer_array[] = array(
				'link' => zen_href_link(FILENAME_NEWS_INDEX, 'date=' . substr($date_selector_array[$i]['date'], 0, 10)),
				'text' => zen_date_long($date_selector_array[$i]['date']),
			);
    }

    $newsRecentFooter = $recent_footer_array;
  }

	$tpl_page_body = 'tpl_' . $_GET['main_page'] . '_default.php';
  require($template->get_template_dir($tpl_page_body, DIR_WS_TEMPLATE, $current_page_base,'templates') . '/' . $tpl_page_body);
?>