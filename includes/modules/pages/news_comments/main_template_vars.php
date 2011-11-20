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

  $news = $db->Execute("select n.article_id, na.author_name, nt.news_article_name, n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "'), " . TABLE_NEWS_AUTHORS . " na where n.authors_id = na.authors_id and n.news_status = '1' and n.article_id = '" . (int)$_GET['article_id'] . "'");

  $comments = $db->Execute("select nc.customers_name, nc.date_added, ncd.comments_subject, ncd.comments_text from " .  TABLE_NEWS_COMMENTS . " nc left join " . TABLE_NEWS_COMMENTS_DESCRIPTION . " ncd on nc.comments_id = ncd.comments_id and ncd.language_id = '" . (int)$_SESSION['languages_id'] . "' where nc.approved = '1' and nc.article_id = '" . (int)$_GET['article_id'] . "' order by nc.date_added DESC");

  ////
  // set template variables
//modified by zen-cart.cn
//$newsDate = strtoupper(zen_date_long($date));
  $newsDate = zen_date_long($date);

  $newsHeaderLinks[] = array(
		'link' => zen_href_link(FILENAME_NEWS_RSS, '', 'NONSSL', false),
		'text' => TEXT_NEWS_RSS_FEED,
	);

	$articleName = stripslashes($news->fields['news_article_name']);
	$articleAuthor = $news->fields['author_name'];

	if ($comments->RecordCount() > 0) {
		$comments_array = array();
		while (!$comments->EOF) {
			$comments_array[] = array(
				'customersName' => stripslashes($comments->fields['customers_name']),
				'commentsSubject' => ((zen_not_null($comments->fields['comments_subject'])) ? stripslashes($comments->fields['comments_subject']) : false),
				'commentsText' => stripslashes($comments->fields['comments_text']),
				'dateAdded' => news_date_time($comments->fields['date_added']),
			);

			$comments->MoveNext();
		}

		$commentsBlock = $comments_array;
	} else {
		$commentsNotFound = true;
	}

	$backButtonURL = zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $news->fields['article_id']);
	$backButton = zen_image_button(BUTTON_IMAGE_BACK, BUTTON_BACK_ALT);

	if ((NEWS_COMMENTS_REQUIRE_CUSTOMER == 'true' && isset($_SESSION['customer_id'])) || NEWS_COMMENTS_REQUIRE_CUSTOMER == 'false') {
		$formActionURL = zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $news->fields['article_id']);
		$nameInput = zen_draw_input_field('customers_name');
		$subjectInput = zen_draw_input_field('comments_subject');
		$commentsInput = zen_draw_textarea_field('comments_text', 'soft', 60, 10);
		$commentsSubmitButton = zen_image_submit(BUTTON_IMAGE_CONTINUE, BUTTON_CONTINUE_ALT);
	} else {
		$mustLogin = true;
	}

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