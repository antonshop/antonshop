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
//  $Id: news_general.php v2.000 2005-01-23 dreamscape <dechantj@pop.belmont.edu>
//

  function news_set_article_status($article_id, $status) {
		global $db;

    if ($status == '1') {
      return $db->Execute("update " . TABLE_NEWS_ARTICLES . " set news_status = '1', news_last_modified = now() where article_id = '" . (int)$article_id . "'");
    } elseif ($status == '0') {
      return $db->Execute("update " .TABLE_NEWS_ARTICLES. " set news_status = '0', news_last_modified = now() where article_id = '" . (int)$article_id . "'");
    } else {
      return -1;
    }
  }

	function news_set_article_sortorder($article_id, $movement) {
		global $db;

		$article = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where article_id = '" . (int)$article_id . "'");

		if ($movement == 'down') {
			$articles = $db->Execute("select article_id, sort_order from " . TABLE_NEWS_ARTICLES . " where news_date_published = '" . $article->fields['news_date_published'] . "' order by sort_order asc");
		} elseif ($movement == 'up') {
			$articles = $db->Execute("select article_id, sort_order from " . TABLE_NEWS_ARTICLES . " where news_date_published = '" . $article->fields['news_date_published'] . "' order by sort_order desc");
		} else {
			return false;
		}

		// first build into array
		$article_array = array();
		while (!$articles->EOF) {
			$article_array[] = $articles->fields['article_id'];

			$articles->MoveNext();
		}

		// now adjust the order
		$new_article_array = array();
		foreach ($article_array as $sort => $id) {
			$i = $sort;

			if ($article_id == $id) {
				$threshold = $sort;
				$i++;
			} elseif (isset($threshold) && ($sort-1) == $threshold) {
				$i--;
			}

			$new_article_array[(int)$i] = $id;
		}

		if ($movement == 'up') {
			krsort($new_article_array);
		} else {
			ksort($new_article_array);
		}

		$i = 0;
		foreach ($new_article_array as $article_id) {
			$db->Execute("update " .TABLE_NEWS_ARTICLES. " set sort_order = '" . (int)$i . "' where article_id = '" . (int)$article_id . "'");

			$i++;
		}
	}

	function news_get_first_article($news_date_published) {
		global $db;

		$article = $db->Execute("select article_id from " . TABLE_NEWS_ARTICLES . " where news_date_published = '" . $news_date_published . "' order by sort_order limit 1");

		return $article->fields['article_id'];
	}

	function news_get_last_article($news_date_published) {
		global $db;

		$article = $db->Execute("select article_id from " . TABLE_NEWS_ARTICLES . " where news_date_published = '" . $news_date_published . "' order by sort_order");

		while (!$article->EOF) {
			$article_id = $article->fields['article_id'];

			$article->MoveNext();
		}

		return $article_id;
	}

	function news_get_next_sortorder($news_date_published) {
		global $db;

		$sort_order = $db->Execute("select max(sort_order) as last_sort_order from " . TABLE_NEWS_ARTICLES . " where date_format(news_date_published, '%Y-%m-%d') = '" . $news_date_published . "'");
		if (zen_not_null($sort_order->fields['last_sort_order'])) {
			return ($sort_order->fields['last_sort_order'] + 1);
		} else {
			return 0;
		}
	}

	function news_gather_listing_url() {
		return (zen_not_null($_GET['pastdays']) ? '&pastdays=' . $_GET['pastdays'] : '') . (zen_not_null($_GET['search']) ? '&search=' . $_GET['search'] : '') . (zen_not_null($_GET['date_published_from']) ? '&date_published_from=' . $_GET['date_published_from'] : '') . (zen_not_null($_GET['date_published_to']) ? '&date_published_to=' . $_GET['date_published_to'] : '');
	}

////
// Function to remove a news article & its associated images & comments. 
  function news_remove_article($article_id) {
		global $db;

    $article_image = $db->Execute("select news_image, news_image_two from " . TABLE_NEWS_ARTICLES . " where article_id = '" . (int)$article_id . "'");
    if ($article_image->RecordCount() < 1) {
			return false;
		}

		// Only delete images if no other article is using them!
    $duplicate_image = $db->Execute("select count(*) as total from " . TABLE_NEWS_ARTICLES . " where news_image = '" . zen_db_input($article_image->fields['news_image']) . "'");

    if ($duplicate_image->fields['total'] < 2) {
      if (file_exists(DIR_FS_CATALOG_IMAGES . $article_image->fields['news_image'])) {
        @unlink(DIR_FS_CATALOG_IMAGES . $article_image->fields['news_image']);
      }
    }
    
    $duplicate_image_two = $db->Execute("select count(*) as total from " . TABLE_NEWS_ARTICLES . " where news_image_two = '" . zen_db_input($article_image->fields['news_image_two']) . "'");

    if ($duplicate_image_two->fields['total'] < 2) {
      if (file_exists(DIR_FS_CATALOG_IMAGES . $article_image->fields['news_image_two'])) {
        @unlink(DIR_FS_CATALOG_IMAGES . $article_image->fields['news_image_two']);
      }
    }

		// Remove this article from TABLE_NEWS_ARTICLES
    $db->Execute("delete from " . TABLE_NEWS_ARTICLES . " where article_id = '" . (int)$article_id . "'");

		// Remove this article from TABLE_NEWS_ARTICLES_TEXT
    $db->Execute("delete from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "'");

		// Remove this articles comments from TABLE_NEWS_COMMENTS_DESCRIPTION
    $article_comments = $db->Execute("select comments_id from " . TABLE_NEWS_COMMENTS . " where article_id = '" . (int)$article_id . "'");
    while (!$article_comments->EOF) {
      $db->Execute("delete from " . TABLE_NEWS_COMMENTS_DESCRIPTION . " where comments_id = '" . (int)$article_comments->fields['comments_id'] . "'");

			$article_comments->MoveNext();
    }

		// Remove this articles comments from TABLE_NEWS_COMMENTS
    $db->Execute("delete from " . TABLE_NEWS_COMMENTS . " where article_id = '" . (int)$article_id . "'");
    
    return true;
  }

  function news_draw_file_field($name, $parameters = '', $required = false) {
    $field = zen_draw_input_field($name, '', $parameters, $required, 'file');
    return $field;
  }

  function news_get_news_authors_name($authors_id) {
		global $db;

    $authors = $db->Execute("select author_name from " . TABLE_NEWS_AUTHORS . " where authors_id = '" . (int)$authors_id . "'");
    
		return $authors->fields['author_name'];
  }

  function news_get_news_article_name($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}
    
    $news = $db->Execute("select news_article_name from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");
    
    return $news->fields['news_article_name'];
  }

  function news_get_news_article_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_text'];
  }
  
  function news_get_news_article_shorttext($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_shorttext from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_shorttext'];
  }

  function news_get_news_article_url($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url'];
  }

  function news_get_news_article_url_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_text'];
  }

  function news_get_news_article_url_2($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_2 from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_2'];
  }

  function news_get_news_article_url_2_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_2_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_2_text'];
  }

  function news_get_news_article_url_3($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_3 from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_3'];
  }

  function news_get_news_article_url_3_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_3_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_3_text'];
  }

  function news_get_news_article_url_4($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_4 from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_4'];
  }

  function news_get_news_article_url_4_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_4_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_4_text'];
  }

  function news_get_news_article_url_store($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_store from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_store'];
  }

  function news_get_news_article_url_store_2($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_store_2 from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_store_2'];
  }

  function news_get_news_article_url_store_misc($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_store_misc from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_store_misc'];
  }

  function news_get_news_article_url_store_misc_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_store_misc_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_store_misc_text'];
  }

  function news_get_news_article_url_store_misc_2($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_store_misc_2 from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_store_misc_2'];
  }

  function news_get_news_article_url_store_misc_2_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_article_url_store_misc_2_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_article_url_store_misc_2_text'];
  }

  function news_get_news_image_text($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_image_text from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_image_text'];
  }

  function news_get_news_image_text_two($article_id, $language_id = false) {
		global $db;

    if (!$language_id) {
			$language_id = $_SESSION['languages_id'];
		}

    $news = $db->Execute("select news_image_text_two from " . TABLE_NEWS_ARTICLES_TEXT . " where article_id = '" . (int)$article_id . "' and language_id = '" . (int)$language_id . "'");

    return $news->fields['news_image_text_two'];
  }
?>
