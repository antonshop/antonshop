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

  if (NEWS_COMMENTS_REQUIRE_CUSTOMER == 'true' && !isset($_SESSION['customer_id'])) {
    $_SESSION['navigation']->set_snapshot();
  }

  require(DIR_WS_MODULES . 'require_languages.php');

	require_once(DIR_WS_CLASSES . 'news.php');

	require_once(DIR_WS_FUNCTIONS . 'news.php');

  $article = $db->Execute("select n.news_date_published, nt.news_article_name from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_status = '1' and n.article_id = '" . (int)$_GET['article_id'] . "'");

  // Look buddy, that article does not exist
  if ($article->RecordCount() < 1) {
		zen_redirect(zen_href_link(FILENAME_NEWS_INDEX));
	}

  $date = $article->fields['news_date_published'];

  $date_selector_array = array();
  $date_selector = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_status = '1' and to_days(news_date_published) <= to_days('" . $date . "') group by news_date_published desc limit 7");
  while(!$date_selector->EOF) {
    $date_selector_array[] = array('date' => $date_selector->fields['news_date_published']);

		$date_selector->MoveNext();
  }

	// Oh posting the comments!
  if (isset($_POST['action']) && ($_POST['action'] == 'process')) {
    $error = false;

    $customers_name = zen_db_prepare_input($_POST['customers_name']);
    $comments_subject = zen_db_prepare_input($_POST['comments_subject']);
    $comments_text = zen_db_prepare_input(strip_tags($_POST['comments_text']));

    if (strlen($customers_name) < ENTRY_NEWS_NAME_MIN_LENGTH) {
      $error = true;
			$messageStack->add('news_comments', ENTRY_NEWS_NAME_ERROR);
    }

    if (strlen($comments_text) < ENTRY_NEWS_COMMENTS_MIN_LENGTH) {
      $error = true;
			$messageStack->add('news_comments', ENTRY_NEWS_COMMENTS_ERROR);
    }

    if (!$error) {
      $sql_data_array = array(
				'article_id' => $_GET['article_id'],
				'customers_name' => zen_db_input($customers_name),
				'date_added' => 'now()',
				'approved' => '1',
			);

      if (isset($_SESSION['customer_id'])) {
        $sql_data_array['customers_id'] = $_SESSION['customer_id'];
      }

      zen_db_perform(TABLE_NEWS_COMMENTS, $sql_data_array);

      $insert_id = $db->Insert_ID();

      $sql_data_array = array(
				'comments_id' => $insert_id,
				'language_id' => $_SESSION['languages_id'],
				'comments_subject' => zen_db_input($comments_subject),
				'comments_text' => zen_db_input(nl2br(htmlspecialchars(stripslashes($comments_text)))),
			);

      zen_db_perform(TABLE_NEWS_COMMENTS_DESCRIPTION, $sql_data_array);

			// Admin notification
			if (NEWS_COMMENTS_EMAIL_ADMIN_NOTICE == 'true') {
				$text_message = strip_tags(EMAIL_NOTIFICATION_TEXT_INTRO);
				$html_msg['EMAIL_MESSAGE_INTRO'] = EMAIL_NOTIFICATION_TEXT_INTRO;

				$text_message .= strip_tags(sprintf(EMAIL_NOTIFICATION_TEXT_BODY, $customers_name, zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $_GET['article_id'], 'NONSSL', false), $article->fields['news_article_name'], zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $_GET['article_id'], 'NONSSL', false)));
				$html_msg['EMAIL_MESSAGE_HTML'] = sprintf(EMAIL_NOTIFICATION_TEXT_BODY, $customers_name, zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $_GET['article_id'], 'NONSSL', false), $article->fields['news_article_name'], zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $_GET['article_id'], 'NONSSL', false));

		    $extra_info = email_collect_extra_info(STORE_NAME, EMAIL_FROM, $customers_name, $_SESSION['customers_email_address']);
				$text_message .= $extra_info['TEXT'];
				$html_msg['EXTRA_INFO'] = $extra_info['HTML'];

				// Send message
				zen_mail(STORE_OWNER, STORE_OWNER_EMAIL_ADDRESS, EMAIL_NOTIFICATION_SUBJECT, $text_message, STORE_NAME, EMAIL_FROM, $html_msg, 'news_comments_notice');
			}

			$messageStack->add_session('news_comments', SUCCESS_NEWS_COMMENTS_SUBMITTED, 'success');

      zen_redirect(zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $_GET['article_id']));
		}
	}

	if (isset($_SESSION['customer_id'])) {
		if (!isset($customers_name)) {
			$customers_name = $_SESSION['customer_first_name'];
		}
	}

  $breadcrumb->add(NAVBAR_TITLE, zen_href_link(FILENAME_NEWS_INDEX));
  $breadcrumb->add($article->fields['news_article_name'], zen_href_link(FILENAME_NEWS_ARTICLE, 'article_id=' . $_GET['article_id']));
  $breadcrumb->add(NAVBAR_TITLE_COMMENTS, zen_href_link(FILENAME_NEWS_COMMENTS, 'article_id=' . $_GET['article_id']));
?>