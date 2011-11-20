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
//  $Id: news.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

  require('includes/application_top.php');

  require('includes/functions/news_general.php');

  $action = ((isset($_POST['action'])) ? $_POST['action'] : ((isset($_GET['action'])) ? $_GET['action'] : false));

  if ($action) {
    switch ($action) {
      case 'setflag':
        if ((isset($_GET['flag'])) && (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) && (isset($_GET['aID']))) {
          news_set_article_status($_GET['aID'], $_GET['flag']);
        }
        break;

			case 'setorder':
        if ((isset($_GET['order'])) && (($_GET['order'] == 'up') || ($_GET['order'] == 'down')) && (isset($_GET['aID']))) {
          news_set_article_sortorder($_GET['aID'], $_GET['order']);
        }
        break;

      case 'delete_article_confirm':
        if (isset($_POST['article_id']) && zen_not_null($_POST['article_id'])) {
          news_remove_article($_POST['article_id']);
        }
        
        zen_redirect(zen_href_link(FILENAME_NEWS));
      break;

      case 'insert_article':
      case 'update_article':
        if (($_POST['edit_x']) || ($_POST['edit_y'])) {
          $action = 'new_article';
        } else {
          $article_id = zen_db_prepare_input($_GET['aID']);
          $authors_id = zen_db_prepare_input($_POST['authors_id']);
          $news_image = (($_POST['news_image'] == 'none') ? '' : zen_db_prepare_input($_POST['news_image']));
          $news_image_two = (($_POST['news_image_two'] == 'none') ? '' : zen_db_prepare_input($_POST['news_image_two']));
          $date_published = ((zen_not_null($_POST['news_date_published'])) ? zen_db_prepare_input($_POST['news_date_published']) : zen_db_prepare_input(date('Y-m-d')));
          $news_status = zen_db_prepare_input($_POST['news_status']);
          $sort_order = ((zen_not_null($_POST['sort_order'])) ? zen_db_prepare_input($_POST['sort_order']) : news_get_next_sortorder($date_published));
          
          $sql_data_array = array(
						'authors_id' => $authors_id,
						'news_image' => $news_image,
						'news_image_two' => $news_image_two,
						'news_date_published' => $date_published,
						'news_status' => $news_status,
						'sort_order' => $sort_order,
					);

          if ($action == 'insert_article') {
            $insert_sql_data = array('news_date_added' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

            zen_db_perform(TABLE_NEWS_ARTICLES, $sql_data_array);

            $article_id = $db->Insert_ID();

          } elseif ($_GET['action'] == 'update_article') {
            $update_sql_data = array('news_last_modified' => 'now()');

            $sql_data_array = array_merge($sql_data_array, $update_sql_data);

            zen_db_perform(TABLE_NEWS_ARTICLES, $sql_data_array, 'update', 'article_id = \'' . (int)$article_id . '\'');
          }
         
          foreach (zen_get_languages() as $lang) {
            $news_article_name = zen_db_prepare_input($_POST['news_article_name'][$lang['id']]);
            $news_article_text = zen_db_prepare_input($_POST['news_article_text'][$lang['id']]);
            $news_article_shorttext = zen_db_prepare_input($_POST['news_article_shorttext'][$lang['id']]);
            $news_article_url = zen_db_prepare_input($_POST['news_article_url'][$lang['id']]);
            $news_article_url_text = zen_db_prepare_input($_POST['news_article_url_text'][$lang['id']]);
            $news_article_url_2 = zen_db_prepare_input($_POST['news_article_url_2'][$lang['id']]);
            $news_article_url_2_text = zen_db_prepare_input($_POST['news_article_url_2_text'][$lang['id']]);
            $news_article_url_3 = zen_db_prepare_input($_POST['news_article_url_3'][$lang['id']]);
            $news_article_url_3_text = zen_db_prepare_input($_POST['news_article_url_3_text'][$lang['id']]);
            $news_article_url_4 = zen_db_prepare_input($_POST['news_article_url_4'][$lang['id']]);
            $news_article_url_4_text = zen_db_prepare_input($_POST['news_article_url_4_text'][$lang['id']]);
            $news_article_url_store = zen_db_prepare_input($_POST['news_article_url_store'][$lang['id']]);
            $news_article_url_store_2 = zen_db_prepare_input($_POST['news_article_url_store_2'][$lang['id']]);
            $news_article_url_store_misc = zen_db_prepare_input($_POST['news_article_url_store_misc'][$lang['id']]);
            $news_article_url_store_misc_text = zen_db_prepare_input($_POST['news_article_url_store_misc_text'][$lang['id']]);
            $news_article_url_store_misc_2 = zen_db_prepare_input($_POST['news_article_url_store_misc_2'][$lang['id']]);
            $news_article_url_store_misc_2_text = zen_db_prepare_input($_POST['news_article_url_store_misc_2_text'][$lang['id']]);
            $news_image_text = zen_db_prepare_input($_POST['news_image_text'][$lang['id']]);
            $news_image_text_two = zen_db_prepare_input($_POST['news_image_text_two'][$lang['id']]);

						$sql_data_array = array(
							'news_article_name' => $news_article_name,
							'news_article_text' => $news_article_text,
							'news_article_shorttext' => $news_article_shorttext,
							'news_article_url' => $news_article_url,
							'news_article_url_text' => $news_article_url_text,
							'news_article_url_2' => $news_article_url_2,
							'news_article_url_2_text' => $news_article_url_2_text,
							'news_article_url_3' => $news_article_url_3,
							'news_article_url_3_text' => $news_article_url_3_text,
							'news_article_url_4' => $news_article_url_4,
							'news_article_url_4_text' => $news_article_url_4_text,
							'news_article_url_store' => $news_article_url_store,
							'news_article_url_store_2' => $news_article_url_store_2,
							'news_article_url_store_misc' => $news_article_url_store_misc,
							'news_article_url_store_misc_text' => $news_article_url_store_misc_text,
							'news_article_url_store_misc_2' => $news_article_url_store_misc_2,
							'news_article_url_store_misc_2_text' => $news_article_url_store_misc_2_text,
							'news_image_text' => $news_image_text,
							'news_image_text_two' => $news_image_text_two,
						);

            if ($action == 'insert_article') {
              $insert_sql_data = array('article_id' => $article_id,
                                       'language_id' => $lang['id']);

              $sql_data_array = array_merge($sql_data_array, $insert_sql_data);

              zen_db_perform(TABLE_NEWS_ARTICLES_TEXT, $sql_data_array);

            } elseif ($action == 'update_article') {
              zen_db_perform(TABLE_NEWS_ARTICLES_TEXT, $sql_data_array, 'update', 'article_id = \'' . (int)$article_id . '\' and language_id = \'' . (int)$lang['id'] . '\'');
            }
          }

          zen_redirect(zen_href_link(FILENAME_NEWS, 'aID=' . $article_id));
        }
        break;

    }
  }

// check if the news sm image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES . 'news/images_small/')) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES . 'news/images_small/')) {
			$messageStack->add(ERROR_NEWS_IMAGE_SM_DIRECTORY_NOT_WRITEABLE, 'error');
		}
  } else {
    $messageStack->add(ERROR_NEWS_IMAGE_SM_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

// check if the news med image directory exists
  if (is_dir(DIR_FS_CATALOG_IMAGES . 'news/images_med/')) {
    if (!is_writeable(DIR_FS_CATALOG_IMAGES . 'news/images_med/')) {
			$messageStack->add(ERROR_NEWS_IMAGE_MED_DIRECTORY_NOT_WRITEABLE, 'error');
		}
  } else {
    $messageStack->add(ERROR_NEWS_IMAGE_MED_DIRECTORY_DOES_NOT_EXIST, 'error');
  }

// start page output
	echo
'<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">'. "\n" .
'<html ' . HTML_PARAMS . '>' .
'<head>' .
	'<meta http-equiv="Content-Type" content="text/html; charset=' . CHARSET . '">' .
	'<title>' . TITLE . '</title>' .
	'<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">' .
	'<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">' .
	'<script language="javascript" type="text/javascript" src="includes/general.js"></script>' .
	'<script language="javascript" type="text/javascript" src="includes/menu.js"></script>' .
	'<script language="javascript" type="text/javascript"><!--
  function commentsEditor(url) {
    window.open(url,\'commentsEditor\',\'toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=750,height=500,screenX=150,screenY=150,top=150,left=150\');
  }

  function preview(theText) {
    window.open(\'news_preview.php?text=\'+encodeURI(document.new_article[theText].value),\'preview\',\'toolbar=no,location=no,directories=no,status=yes,menubar=no,scrollbars=yes,resizable=yes,copyhistory=no,width=550,height=400,screenX=150,screenY=150,top=150,left=150\');
  }

  function init()
  {
    cssjsmenu(\'navbar\');
    if (document.getElementById)
    {
      var kill = document.getElementById(\'hoverJS\');
      kill.disabled = true;
    }
  if (typeof _editor_url == "string") HTMLArea.replaceAll();
  }
//--></script>';

	// HTML Editors support
	if (HTML_EDITOR_PREFERENCE == 'FCKEDITOR') {
		require(DIR_WS_INCLUDES . 'fckeditor.php');
	} elseif (HTML_EDITOR_PREFERENCE == 'HTMLAREA') {
		require(DIR_WS_INCLUDES . 'htmlarea.php');
	}

	echo
'</head>' .
'<body onload="init();">' .
'<div id="spiffycalendar" class="text"></div>' .
'<!-- header //-->';

	require(DIR_WS_INCLUDES . 'header.php');

	echo
'<!-- header_eof //-->' .
'<!-- body //-->' .
'<table border="0" width="100%" cellspacing="2" cellpadding="2">' .
	'<tr>' .
	'<!-- body_text //-->' .
		'<td width="100%" valign="top">' .
			'<table border="0" width="100%" cellspacing="0" cellpadding="2">';

  if ($action == 'new_article') {
    if ((isset($_GET['aID'])) && (!$_POST)) {
			$news = $db->Execute("select 
														n.article_id, 
														n.authors_id,
														n.news_image, 
														n.news_image_two, 
														n.news_date_added, 
														n.news_last_modified, 
														date_format(n.news_date_published, '%Y-%m-%d') as news_date_published, 
														n.news_status,
														n.sort_order,
														nt.news_article_name, 
														nt.news_article_text, 
														nt.news_article_shorttext, 
														nt.news_article_url,
														nt.news_article_url_text,
														nt.news_article_url_2,
														nt.news_article_url_2_text,
														nt.news_article_url_3,
														nt.news_article_url_3_text,
														nt.news_article_url_4,
														nt.news_article_url_4_text,
														nt.news_article_url_store,
														nt.news_article_url_store_2,
														nt.news_article_url_store_misc,
														nt.news_article_url_store_misc_text,
														nt.news_article_url_store_misc_2,
														nt.news_article_url_store_misc_2_text,
														nt.news_image_text, 
														nt.news_image_text_two
														from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "') where n.article_id = '" . (int)$_GET['aID'] . "'");

      $nInfo = new objectInfo($news->fields);
    } elseif ($_POST) {
      $nInfo = new objectInfo($_POST);
      $news_article_name = $_POST['news_article_name'];
      $news_article_text = $_POST['news_article_text'];
      $news_article_shorttext = $_POST['news_article_shorttext'];
      $news_article_url = $_POST['news_article_url'];
      $news_article_url_text = $_POST['news_article_url_text'];
      $news_article_url_2 = $_POST['news_article_url_2'];
      $news_article_url_2_text = $_POST['news_article_url_2_text'];
      $news_article_url_3 = $_POST['news_article_url_3'];
      $news_article_url_3_text = $_POST['news_article_url_3_text'];
      $news_article_url_4 = $_POST['news_article_url_4'];
      $news_article_url_4_text = $_POST['news_article_url_4_text'];
      $news_article_url_store = $_POST['news_article_url_store'];
      $news_article_url_store_2 = $_POST['news_article_url_store_2'];
      $news_article_url_store_misc = $_POST['news_article_url_store_misc'];
      $news_article_url_store_misc_text = $_POST['news_article_url_store_misc_text'];
      $news_article_url_store_misc_2 = $_POST['news_article_url_store_misc_2'];
      $news_article_url_store_misc_2_text = $_POST['news_article_url_store_misc_2_text'];
      $news_image_text = $_POST['news_image_text'];
      $news_image_text_two = $_POST['news_image_text_two'];
      $news_image = $_POST['news_image'];
      $news_image_two = $_POST['news_image_two'];
    } else {
      $nInfo = new objectInfo(array());
    }

		$authors_array = array();
		$authors = $db->Execute("select authors_id, author_name from " . TABLE_NEWS_AUTHORS . " order by author_name");
		while (!$authors->EOF) {
			$authors_array[] = array(
				'id' => $authors->fields['authors_id'],
				'text' => $authors->fields['author_name'],
			);

			$authors->MoveNext();
		}

		$languages = zen_get_languages();
    
		switch ($nInfo->news_status) {
			case '0':
				$in_status = false;
				$out_status = true;
				break;

			case '1':
			default:
				$in_status = true;
				$out_status = false;
				break;
		}

		echo
			'<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">' .
			'<script language="javascript" type="text/javascript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>' .
			'<script language="javascript" type="text/javascript"><!--
	var datePublished = new ctlSpiffyCalendarBox("datePublished", "new_article", "news_date_published","btnDate1","' . $nInfo->news_date_published . '",scBTNMODE_CUSTOMBLUE);
//--></script>' .
			'<tr>' .
				'<td width="100%">' .
					zen_draw_form('new_article', FILENAME_NEWS, 'aID=' . $_GET['aID'] . '&action=new_article_preview', 'post', 'enctype="multipart/form-data"') .
					'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
						'<tr>' .
							'<td class="pageHeading">' . TEXT_NEW_NEWS . '</td>' .
							'<td class="pageHeading" align="right">' . zen_draw_hidden_field('news_date_added', (($nInfo->news_date_added) ? $nInfo->news_date_added : date('Y-m-d'))) . zen_image_submit('button_preview.gif', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $_GET['aID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a></td>' .
						'</tr>' .
					'</table>' .
					'<table border="0" width="100%" cellspacing="0" cellpadding="2">' .
						'<tr class="dataTableHeadingRow">' .
							'<td class="dataTableHeadingContent" align="left" width="16.66%" nowrap>' . TEXT_NEWS_STATUS . '</td>' .
							'<td class="dataTableHeadingContent" align="left" width="16.66%" nowrap>' . TEXT_NEWS_AUTHOR . '</td>' .
							'<td class="dataTableHeadingContent" align="left" width="16.66%" nowrap>' . TEXT_NEWS_DATE_PUBLISHED . '&nbsp;<small>(YYYY-MM-DD)</small></td>' .
							'<td class="dataTableHeadingContent" align="left" width="16.66%" nowrap>' . TEXT_NEWS_SORT_ORDER . '</td>' .
							'<td class="dataTableHeadingContent" align="left" width="16.66%">&nbsp;</td>' .
							'<td class="dataTableHeadingContent" align="left" width="16.66%">&nbsp;</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="left" nowrap>' . zen_draw_radio_field('news_status', '1', $in_status) . '&nbsp;' . TEXT_NEWS_AVAILABLE . zen_draw_radio_field('news_status', '0', $out_status) . '&nbsp;' . TEXT_NEWS_NOT_AVAILABLE . '</td>' .
							'<td class="dataTableContent" align="left" nowrap>' . zen_draw_pull_down_menu('authors_id', $authors_array, $nInfo->authors_id) . '</td>' .
							'<td class="dataTableContent" align="left" nowrap><script language="javascript">datePublished.writeControl(); datePublished.dateFormat="yyyy-MM-dd";</script></td>' .
							'<td class="dataTableContent" align="left" nowrap>' . zen_draw_input_field('sort_order', $nInfo->sort_order, 'size="5"') . '</td>' .
							'<td class="dataTableContent" align="left">&nbsp;</td>' .
							'<td class="dataTableContent" align="left">&nbsp;</td>' .
						'</tr>';

		// News Article Headline, Summary, & Content input
		//	鈥?Start langauge support
		foreach ($languages as $i => $lang) {
			echo
						'<tr class="dataTableHeadingRow">' .
							'<td class="dataTableHeadingContent" align="left" colspan="6">' . zen_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']) . '&nbsp;&nbsp;' . TEXT_NEWS_TEXT . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="left">' . TEXT_NEWS_HEADLINE . '</td>' .
							'<td class="dataTableContent" align="left" colspan="4">' . zen_draw_input_field('news_article_name[' . $lang['id'] . ']', (($news_article_name[$lang['id']]) ? stripslashes($news_article_name[$lang['id']]) : news_get_news_article_name($nInfo->article_id, $lang['id'])), 'style="width: 100%"') . '</td>' .
							'<td class="dataTableContent" align="left">&nbsp;</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="left" valign="top">' . TEXT_NEWS_SUMMARY . '</td>';

			// News Article Headline, Summary, & Content input
			//	鈥?HTML Editors support for summary input
			if (HTML_EDITOR_PREFERENCE == 'FCKEDITOR') {
				echo '<td class="dataTableContent" align="left" colspan="4">';
				$oFCKeditor = new FCKeditor;
				$oFCKeditor->Value = (($news_article_shorttext[$lang['id']]) ? stripslashes($news_article_shorttext[$lang['id']]) : news_get_news_article_shorttext($nInfo->article_id, $lang['id']));
				$oFCKeditor->CreateFCKeditor('news_article_shorttext[' . $lang['id'] . ']', '100%', '130') ;  //instanceName, width, height (px or %)
				echo '</td>';
			} elseif (HTML_EDITOR_PREFERENCE == 'HTMLAREA') {
				echo '<td class="dataTableContent" align="left" colspan="4">' . zen_draw_textarea_field('news_article_shorttext[' . $lang['id'] . ']', 'soft', '70', '10', (($news_article_shorttext[$lang['id']]) ? stripslashes($news_article_shorttext[$lang['id']]) : news_get_news_article_shorttext($nInfo->article_id, $lang['id'])), 'style="width: 100%"') . '</td>';
			} else {
				echo '<td class="dataTableContent" align="left" colspan="4">' . zen_draw_textarea_field('news_article_shorttext[' . $lang['id'] . ']', 'soft', '70', '5', (($news_article_shorttext[$lang['id']]) ? stripslashes($news_article_shorttext[$lang['id']]) : news_get_news_article_shorttext($nInfo->article_id, $lang['id'])), 'style="width: 100%"') . '</td>';
			}

			echo
							'<td class="dataTableContent" align="left">&nbsp;</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="left" valign="top">' . TEXT_NEWS_CONTENT . '<br /><a href="javascript:preview(\'news_article_text[' . $lang['id'] . ']\');"><em>' . TEXT_NEWS_CONTENT_PREVIEW . '</em></a></td>';

			// News Article Headline, Summary, & Content input
			//	鈥?HTML Editors support for content input
			if (HTML_EDITOR_PREFERENCE == 'FCKEDITOR') {
				echo '<td class="dataTableContent" align="left" colspan="4">';
				$oFCKeditor = new FCKeditor;
				$oFCKeditor->Value = (($news_article_text[$lang['id']]) ? stripslashes($news_article_text[$lang['id']]) : news_get_news_article_text($nInfo->article_id, $lang['id']));
				$oFCKeditor->CreateFCKeditor('news_article_text[' . $lang['id'] . ']', '100%', '250') ;  //instanceName, width, height (px or %)
				echo '</td>';
			} elseif (HTML_EDITOR_PREFERENCE == 'HTMLAREA') {
				echo '<td class="dataTableContent" align="left" colspan="4">' . zen_draw_textarea_field('news_article_text[' . $lang['id'] . ']', 'soft', '70', '20', (($news_article_text[$lang['id']]) ? stripslashes($news_article_text[$lang['id']]) : news_get_news_article_text($nInfo->article_id, $lang['id'])), 'style="width: 100%"') . '</td>';
			} else {
				echo '<td class="dataTableContent" align="left" colspan="4">' . zen_draw_textarea_field('news_article_text[' . $lang['id'] . ']', 'soft', '70', '15', (($news_article_text[$lang['id']]) ? stripslashes($news_article_text[$lang['id']]) : news_get_news_article_text($nInfo->article_id, $lang['id'])), 'style="width: 100%"') . '</td>';
			}

			echo
							'<td class="dataTableContent" align="left">&nbsp;</td>' .
						'</tr>';
    }

		echo
						'<tr class="dataTableRowEven">' .
							'<td colspan="6" style="height: 15px;">&nbsp;</td>' .
						'</tr>' .
						'<tr class="dataTableHeadingRow">' .
							'<td class="dataTableHeadingContent" align="left" colspan="3">' . TEXT_NEWS_IMAGE_ONE . '</td>' .
							'<td class="dataTableHeadingContent" align="left" colspan="3">' . TEXT_NEWS_IMAGE_TWO . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="left" colspan="3">' . news_draw_file_field('news_image') . '<br />' . zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $nInfo->news_image . zen_draw_hidden_field('previous_image', $nInfo->news_image) . '</td>' .
							'<td class="dataTableContent" align="left" colspan="3">' . news_draw_file_field('news_image_two') . '<br />' . zen_draw_separator('pixel_trans.gif', '24', '15') . '&nbsp;' . $nInfo->news_image_two . zen_draw_hidden_field('previous_image_two', $nInfo->news_image_two) . '</td>' .
						'</tr>';

    foreach ($languages as $i => $lang) {
      if ($i == 0) {
				echo
						'<tr class="dataTableHeadingRow">' .
							'<td class="dataTableHeadingContent" align="left" colspan="3">' . zen_draw_separator('pixel_trans.gif', '24', '1') . '&nbsp;&nbsp;' . TEXT_NEWS_IMAGE_SUBTITLE . '</td>' .
							'<td class="dataTableHeadingContent" align="left" colspan="3">' . zen_draw_separator('pixel_trans.gif', '24', '1') . '&nbsp;&nbsp;' . TEXT_NEWS_IMAGE_SUBTITLE_TWO . '</td>' .
						'</tr>';
      }

			echo
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="left" colspan="3">' . zen_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']) . '&nbsp;' . zen_draw_input_field('news_image_text[' . $lang['id'] . ']', (($news_image_text[$lang['id']]) ? stripslashes($news_image_text[$lang['id']]) : news_get_news_image_text($nInfo->article_id, $lang['id'])), 'style="width: 90%"') . '</td>' .
							'<td class="dataTableContent" align="left" colspan="3">' . zen_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']) . '&nbsp;' . zen_draw_input_field('news_image_text_two[' . $lang['id'] . ']', (($news_image_text_two[$lang['id']]) ? stripslashes($news_image_text_two[$lang['id']]) : news_get_news_image_text_two($nInfo->article_id, $lang['id'])), 'style="width: 90%"') . '</td>' .
						'</tr>';
    }

		echo
						'<tr class="dataTableRowEven">' .
							'<td colspan="6" style="height: 15px;">&nbsp;</td>' .
						'</tr>';

		// News Article Links
		//	鈥?Start langauge support
		foreach ($languages as $i => $lang) {

			// News Article Links
			//	鈥?Start product links
			$dropdown_products = $db->Execute("select p.products_id, pd.products_name from " . TABLE_PRODUCTS . " p, " . TABLE_PRODUCTS_DESCRIPTION . " pd where pd.products_id = p.products_id and pd.language_id = '" . (int)$lang['id'] . "' order by pd.products_name");
			$dropdown_products_array[] = array(
				'id' => '', 
				'text' => TEXT_PLEASE_SELECT,
			);

			while (!$dropdown_products->EOF) {
				$dropdown_products_array[] = array(
					'id' => $dropdown_products->fields['products_id'],
					'text' => $dropdown_products->fields['products_name'],
				);
			
				$dropdown_products->MoveNext();
			}

			echo
						'<tr class="dataTableHeadingRow">' .
							'<td class="dataTableHeadingContent" align="left" colspan="6">' . zen_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']) . '&nbsp;&nbsp;' . TEXT_NEWS_LINKS . '&nbsp;<small>' . TEXT_NEWS_URL_WITHOUT_HTTP . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url[' . $lang['id'] . ']', (($news_article_url[$lang['id']]) ? stripslashes($news_article_url[$lang['id']]) : news_get_news_article_url($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_TEXT . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_text[' . $lang['id'] . ']', (($news_article_url_text[$lang['id']]) ? stripslashes($news_article_url_text[$lang['id']]) : news_get_news_article_url_text($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_2 . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_2[' . $lang['id'] . ']', (($news_article_url_2[$lang['id']]) ? stripslashes($news_article_url_2[$lang['id']]) : news_get_news_article_url_2($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_2_TEXT . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_2_text[' . $lang['id'] . ']', (($news_article_url_2_text[$lang['id']]) ? stripslashes($news_article_url_2_text[$lang['id']]) : news_get_news_article_url_2_text($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_3 . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_3[' . $lang['id'] . ']', (($news_article_url_3[$lang['id']]) ? stripslashes($news_article_url_3[$lang['id']]) : news_get_news_article_url_3($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_3_TEXT . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_3_text[' . $lang['id'] . ']', (($news_article_url_3_text[$lang['id']]) ? stripslashes($news_article_url_3_text[$lang['id']]) : news_get_news_article_url_3_text($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_4 . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_4[' . $lang['id'] . ']', (($news_article_url_4[$lang['id']]) ? stripslashes($news_article_url_4[$lang['id']]) : news_get_news_article_url_4($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_4_TEXT . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_4_text[' . $lang['id'] . ']', (($news_article_url_4_text[$lang['id']]) ? stripslashes($news_article_url_4_text[$lang['id']]) : news_get_news_article_url_4_text($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_STORE . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_pull_down_menu('news_article_url_store[' . $lang['id'] . ']', $dropdown_products_array, (($news_article_url_store[$lang['id']]) ? $news_article_url_store[$lang['id']] : news_get_news_article_url_store($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_STORE_2 . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_pull_down_menu('news_article_url_store_2[' . $lang['id'] . ']', $dropdown_products_array, (($news_article_url_store_2[$lang['id']]) ? $news_article_url_store_2[$lang['id']] : news_get_news_article_url_store_2($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_STORE_MISC . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_store_misc[' . $lang['id'] . ']', (($news_article_url_store_misc[$lang['id']]) ? stripslashes($news_article_url_store_misc[$lang['id']]) : news_get_news_article_url_store_misc($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_STORE_MISC_TEXT . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_store_misc_text[' . $lang['id'] . ']', (($news_article_url_store_misc_text[$lang['id']]) ? stripslashes($news_article_url_store_misc_text[$lang['id']]) : news_get_news_article_url_store_misc_text($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_STORE_MISC_2 . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_store_misc_2[' . $lang['id'] . ']', (($news_article_url_store_misc_2[$lang['id']]) ? stripslashes($news_article_url_store_misc_2[$lang['id']]) : news_get_news_article_url_store_misc_2($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
							'<td class="dataTableContent" align="right">' . TEXT_NEWS_URL_STORE_MISC_2_TEXT . '</td>' .
							'<td class="dataTableContent" align="left" colspan="2">' . zen_draw_input_field('news_article_url_store_misc_2_text[' . $lang['id'] . ']', (($news_article_url_store_misc_2_text[$lang['id']]) ? stripslashes($news_article_url_store_misc_2_text[$lang['id']]) : news_get_news_article_url_store_misc_2_text($nInfo->article_id, $lang['id'])), 'style="width: 100%;"') . '</td>' .
						'</tr>';
    }

		echo
						'<tr>' .
							'<td colspan="6" style="height: 15px;">&nbsp;</td>' .
						'</tr>' .
					'</table>' .
					'<table width="100%" border="0" cellspacing="0" cellpadding="2">' .
						'<tr>' .
							'<td valign="middle" class="smallText" align="right">' . zen_image_submit('button_preview.gif', IMAGE_PREVIEW) . '&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $_GET['aID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a></td>' .
						'</tr>' .
					'</table>' .
					'</form>' .
				'</td>' .
			'</tr>';

	} elseif ($_GET['action'] == 'new_article_preview') {
		if ($_POST) {
			$nInfo = new objectInfo($_POST);
			$news_article_name = $_POST['news_article_name'];
			$news_article_text = $_POST['news_article_text'];
			$news_article_shorttext = $_POST['news_article_shorttext'];
			$news_article_url = $_POST['news_article_url'];
			$news_article_url_text = $_POST['news_article_url_text'];
			$news_article_url_2 = $_POST['news_article_url_2'];
			$news_article_url_2_text = $_POST['news_article_url_2_text'];
			$news_article_url_3 = $_POST['news_article_url_3'];
			$news_article_url_3_text = $_POST['news_article_url_3_text'];
			$news_article_url_4 = $_POST['news_article_url_4'];
			$news_article_url_4_text = $_POST['news_article_url_4_text'];
			$news_article_url_store = $_POST['news_article_url_store'];
			$news_article_url_store_2 = $_POST['news_article_url_store_2'];
			$news_article_url_store_misc = $_POST['news_article_url_store_misc'];
			$news_article_url_store_misc_text = $_POST['news_article_url_store_misc_text'];
			$news_article_url_store_misc_2 = $_POST['news_article_url_store_misc_2'];
			$news_article_url_store_misc_2_text = $_POST['news_article_url_store_misc_2_text'];
			$news_image_text = $_POST['news_image_text'];
			$news_image_text_two = $_POST['news_image_text_two'];

			if ($news_image = new upload('news_image')) {
				$news_image->set_destination(DIR_FS_CATALOG_IMAGES . 'news/images_small/');
				if ($news_image->parse() && $news_image->save()) {
					if ($news_image->filename != 'none' && $news_image->filename != '') {
						$news_image_name = 'news/images_small/' . $news_image->filename;
					} else {
						// remove when set to none
						if ($news_image->filename == 'none') {
							$news_image_name = '';
						}
					}
				} else {
					$news_image_name = $_POST['previous_image'];
				}
			}

			if ($news_image_two = new upload('news_image_two')) {
				$news_image_two->set_destination(DIR_FS_CATALOG_IMAGES . 'news/images_med/');
				if ($news_image_two->parse() && $news_image_two->save()) {
					if ($news_image_two->filename != 'none' && $news_image_two->filename != '') {
						$news_image_name_two = 'news/images_med/' . $news_image_two->filename;
					} else {
						// remove when set to none
						if ($news_image_two->filename == 'none') {
							$news_image_name_two = '';
						}
					}
				} else {
					$news_image_name_two = $_POST['previous_image_two'];
				}
			}

		} else {
			$news = $db->Execute("select n.article_id, n.authors_id, nt.language_id, nt.news_article_name, nt.news_article_text, nt.news_article_shorttext, nt.news_article_url, nt.news_image_text, nt.news_image_text_two, n.news_image, n.news_image_two, n.news_date_added, n.news_last_modified, n.news_date_published, n.news_status from " . TABLE_NEWS_ARTICLES . " n, " . TABLE_NEWS_ARTICLES_TEXT . " nt where n.article_id = '" . (int)$_GET['aID'] . "' and n.article_id = nt.article_id");

			$nInfo = new objectInfo($news->fields);
			$news_image_name = $nInfo->news_image;
			$news_image_name_two = $nInfo->news_image_two;
		}

		$form_action = ((isset($_GET['aID']) && (zen_not_null($_GET['aID']))) ? 'update_article' : 'insert_article');
		echo zen_draw_form($form_action, FILENAME_NEWS, '&aID=' . $_GET['aID'] . '&action=' . $form_action, 'post', 'enctype="multipart/form-data"');

		$languages = zen_get_languages();
		foreach ($languages as $i => $lang) {
			if ($_GET['read'] == 'only') {
				$nInfo->news_article_name = news_get_news_article_name($nInfo->article_id, $lang['id']);
				$nInfo->news_article_text = news_get_news_article_text($nInfo->article_id, $lang['id']);
				$nInfo->news_article_shorttext = news_get_news_article_shorttext($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url = news_get_news_article_url($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_text = news_get_news_article_url_text($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_2 = news_get_news_article_url_2($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_2_text = news_get_news_article_url_2_text($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_3 = news_get_news_article_url_3($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_3_text = news_get_news_article_url_3_text($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_4 = news_get_news_article_url_4($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_4_text = news_get_news_article_url_4_text($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_store = news_get_news_article_url_store($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_store_2 = news_get_news_article_url_store_2($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_store_misc = news_get_news_article_url_store_misc($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_store_misc_text = news_get_news_article_url_store_misc_text($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_store_misc_2 = news_get_news_article_url_store_misc_2($nInfo->article_id, $lang['id']);
				$nInfo->news_article_url_store_misc_2_text = news_get_news_article_url_store_misc_2_text($nInfo->article_id, $lang['id']);
				$nInfo->news_image_text = news_get_news_image_text($nInfo->article_id, $lang['id']);
				$nInfo->news_image_text_two = news_get_news_image_text_two($nInfo->article_id, $lang['id']);
			} else {
				$nInfo->news_article_name = zen_db_prepare_input($news_article_name[$lang['id']]);
				$nInfo->news_article_text = zen_db_prepare_input($news_article_text[$lang['id']]);
				$nInfo->news_article_shorttext = zen_db_prepare_input($news_article_shorttext[$lang['id']]);
				$nInfo->news_article_url = zen_db_prepare_input($news_article_url[$lang['id']]);
				$nInfo->news_article_url_text = zen_db_prepare_input($news_article_url_text[$lang['id']]);
				$nInfo->news_article_url_2 = zen_db_prepare_input($news_article_url_2[$lang['id']]);
				$nInfo->news_article_url_2_text = zen_db_prepare_input($news_article_url_2_text[$lang['id']]);
				$nInfo->news_article_url_3 = zen_db_prepare_input($news_article_url_3[$lang['id']]);
				$nInfo->news_article_url_3_text = zen_db_prepare_input($news_article_url_3_text[$lang['id']]);
				$nInfo->news_article_url_4 = zen_db_prepare_input($news_article_url_4[$lang['id']]);
				$nInfo->news_article_url_4_text = zen_db_prepare_input($news_article_url_4_text[$lang['id']]);
				$nInfo->news_article_url_store = zen_db_prepare_input($news_article_url_store[$lang['id']]);
				$nInfo->news_article_url_store_2 = zen_db_prepare_input($news_article_url_store_2[$lang['id']]);
				$nInfo->news_article_url_store_misc = zen_db_prepare_input($news_article_url_store_misc[$lang['id']]);
				$nInfo->news_article_url_store_misc_text = zen_db_prepare_input($news_article_url_store_misc_text[$lang['id']]);
				$nInfo->news_article_url_store_misc_2 = zen_db_prepare_input($news_article_url_store_misc_2[$lang['id']]);
				$nInfo->news_article_url_store_misc_2_text = zen_db_prepare_input($news_article_url_store_misc_2_text[$lang['id']]);
				$nInfo->news_image_text = zen_db_prepare_input($news_image_text[$lang['id']]);
				$nInfo->news_image_text_two = zen_db_prepare_input($news_image_text_two[$lang['id']]);
			}

			echo
			'<tr>' .
				'<td align="center">' .
					'<table border="0" width="90%" cellspacing="0" cellpadding="3">' .
						'<tr class="headerBar">' .
							'<td rowspan="3" valign="top" align="center" nowrap>' . zen_image(DIR_WS_CATALOG_LANGUAGES . $lang['directory'] . '/images/' . $lang['image'], $lang['name']) . '</td>' .
							'<td width="100%">' .
								'<table border="0" width="100%" cellspacing="0" cellpadding="3">' .
									'<tr class="dataTableHeadingRow">' .
										'<td class="pageHeading">' . $nInfo->news_article_name . '</td>' .
									'</tr>' .
								'</table>' .
							'</td>' .
						'</tr>' .
						'<tr>' .
							'<td align="center">' .
								'<table border="0" width="100%" cellspacing="0" cellpadding="3">' .
									'<tr>' .
										'<td>' .
											'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_AUTHOR . '</strong> ' . news_get_news_authors_name($nInfo->authors_id) . '</td>' .
												'</tr>' .
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_DATE_PUBLISHED . '</strong> ' . zen_date_long($nInfo->news_date_published) . '</td>' .
												'</tr>' .
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_DATE_ADDED . '</strong> ' . zen_date_long($nInfo->news_date_added) . '</td>' .
												'</tr>';

			if ($nInfo->news_article_url) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL . '</strong> ' . sprintf(TEXT_NEWS_ARTICLE_LINK, $nInfo->news_article_url, $nInfo->news_article_url_text) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_2) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_2 . '</strong> ' . sprintf(TEXT_NEWS_ARTICLE_LINK, $nInfo->news_article_url_2, $nInfo->news_article_url_2_text) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_3) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_3 . '</strong> ' . sprintf(TEXT_NEWS_ARTICLE_LINK, $nInfo->news_article_url_3, $nInfo->news_article_url_3_text) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_4) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_4 . '</strong> ' . sprintf(TEXT_NEWS_ARTICLE_LINK, $nInfo->news_article_url_4, $nInfo->news_article_url_4_text) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_store) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_STORE . '</strong> ' . zen_get_products_name($nInfo->news_article_url_store) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_store_2) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_STORE_2 . '</strong> ' . zen_get_products_name($nInfo->news_article_url_store_2) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_store_misc) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_STORE_MISC . '</strong> ' . sprintf(TEXT_NEWS_ARTICLE_STORE_LINK, zen_catalog_href_link($nInfo->news_article_url_store_misc), $nInfo->news_article_url_store_misc_text) . '</td>' .
												'</tr>';
			}

			if ($nInfo->news_article_url_store_misc_2) {
				echo
												'<tr>' .
													'<td class="smallText"><strong>' . TEXT_NEWS_URL_STORE_MISC_2 . '</strong> ' . sprintf(TEXT_NEWS_ARTICLE_STORE_LINK, zen_catalog_href_link($nInfo->news_article_url_store_misc_2), $nInfo->news_article_url_store_misc_2_text) . '</td>' .
												'</tr>';
			}

			echo
											'</table>' .
										'</td>' .
									'</tr>' .
									'<tr>' .
										'<td>' . zen_draw_separator('pixel_trans.gif', '1', '10') . '</td>' .
									'</tr>' .
									'<tr class="dataTableHeadingRow">' .
										'<td class="dataTableHeadingContent">' . TEXT_NEWS_SUMMARY . '</td>' .
									'</tr>' .
									'<tr>' .
										'<td class="smallText">' . (($news_image_name) ? zen_image(DIR_WS_CATALOG_IMAGES . $news_image_name, $nInfo->news_image_text, '', '', 'align="right" hspace="5" vspace="5"') : '') . $nInfo->news_article_shorttext . '</td>' .
									'</tr>' .
									'<tr>' .
										'<td>' . zen_draw_separator('pixel_trans.gif', '1', '10') . '</td>' .
									'</tr>' .
									'<tr class="dataTableHeadingRow">' .
										'<td class="dataTableHeadingContent">' . TEXT_NEWS_CONTENT . '</td>' .
									'</tr>' .
									'<tr>' .
										'<td class="smallText">' . (($news_image_name_two) ? zen_image(DIR_WS_CATALOG_IMAGES . $news_image_name_two, $nInfo->news_image_text_two, '', '', 'align="right" hspace="5" vspace="5"') : '') . $nInfo->news_article_text . '</td>' .
									'</tr>' .
								'</table>' .
							'</td>'.
						'</tr>' .
					'</table>' .
				'</td>' .
			'</tr>' .
			'<tr>' .
				'<td>' . zen_draw_separator('pixel_trans.gif', '1', '10') . '</td>' .
			'</tr>';
		}

    if ($_GET['read'] == 'only') {
      if ($_GET['origin']) {
        $pos_params = strpos($_GET['origin'], '?', 0);
        if ($pos_params != false) {
          $back_url = substr($_GET['origin'], 0, $pos_params);
          $back_url_params = substr($_GET['origin'], $pos_params + 1);
        } else {
          $back_url = $_GET['origin'];
          $back_url_params = '';
        }
      } else {
        $back_url = FILENAME_NEWS;
        $back_url_params = 'aID=' . $nInfo->article_id;
      }

			echo
			'<tr>' .
				'<td align="right" colspan="2"><a href="' . zen_href_link($back_url, $back_url_params, 'NONSSL') . '">' . zen_image_button('button_back.gif', IMAGE_BACK) . '</a></td>' .
			'</tr>';

    } else {
    
    ////
    // repost data
      echo
			'<tr>' .
				'<td align="right" class="smallText">';

      foreach ($_POST as $key => $value) {
        if (!is_array($_POST[$key])) {
          echo zen_draw_hidden_field($key, htmlspecialchars(stripslashes($value)));
        }
      }
      
      foreach (zen_get_languages() as $lang) {
        echo zen_draw_hidden_field('news_article_name[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_name[$lang['id']])));
        echo zen_draw_hidden_field('news_article_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_text[$lang['id']])));
        echo zen_draw_hidden_field('news_article_shorttext[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_shorttext[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_text[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_2[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_2[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_2_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_2_text[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_3[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_3[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_3_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_3_text[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_4[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_4[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_4_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_4_text[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_store[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_store[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_store_2[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_store_2[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_store_misc[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_store_misc[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_store_misc_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_store_misc_text[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_store_misc_2[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_store_misc_2[$lang['id']])));
        echo zen_draw_hidden_field('news_article_url_store_misc_2_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_article_url_store_misc_2_text[$lang['id']])));
        echo zen_draw_hidden_field('news_image_text[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_image_text[$lang['id']])));
        echo zen_draw_hidden_field('news_image_text_two[' . $lang['id'] . ']', htmlspecialchars(stripslashes($news_image_text_two[$lang['id']])));
      }
      
      echo zen_draw_hidden_field('news_image', stripslashes($news_image_name));
      echo zen_draw_hidden_field('news_image_two', stripslashes($news_image_name_two));
      
      echo zen_image_submit('button_back.gif', IMAGE_BACK, 'name="edit"') . '&nbsp;&nbsp;';
      
      if (isset($_GET['aID']) && (zen_not_null($_GET['aID']))) {
        echo zen_image_submit('button_update.gif', IMAGE_UPDATE);
      } else {
        echo zen_image_submit('button_insert.gif', IMAGE_INSERT);
      }
      
      echo
					'&nbsp;&nbsp;<a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $_GET['aID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>' .
				'</td>' . 
			'</tr>' .
			'</form>';
    }
  } else {
  
  ////
  // article listing page
    $dropdown_days_array = array(
			array(
				'id' => '7',
				'text' => '7 days',
			),
			array(
				'id' => '15',
				'text' => '15 days',
			),
			array(
				'id' => '30',
				'text' => '30 days',
			),
			array(
				'id' => '45',
				'text' => '45 days',
			),
			array(
				'id' => '60',
				'text' => '60 days',
			),
			array(
				'id' => '90',
				'text' => '90 days',
			),
			array(
				'id' => '120',
				'text' => '120 days',
			),
			array(
				'id' => '180',
				'text' => '180 days',
			),
			array(
				'id' => '365',
				'text' => '365 days',
			),
		);

    if (isset($_GET['search']) && zen_not_null($_GET['search'])) {
      $date = date('Y-m-d');
      $date_selector = $db->Execute("select n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "') where nt.news_article_name like '%" . $_GET['search'] . "%' group by n.news_date_published DESC");
    
      // too few search results; search in article text as well
      if ($date_selector->RecordCount() < 5) {
        $date_selector = $db->Execute("select n.news_date_published from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "') where nt.news_article_name like '%" . $_GET['search'] . "%' OR nt.news_article_text like '%" . $_GET['search'] . "%' OR nt.news_article_shorttext like '%" . $_GET['search'] . "%' group by n.news_date_published DESC");
        $news = $db->Execute("select n.article_id, n.authors_id, nt.news_article_name, n.news_image, n.news_image_two, n.news_date_added, n.news_last_modified, n.news_date_published, n.news_status, n.sort_order from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "') where nt.news_article_name like '%" . $_GET['search'] . "%' OR nt.news_article_text like '%" . $_GET['search'] . "%' OR nt.news_article_shorttext like '%" . $_GET['search'] . "%' order by n.news_date_published DESC, n.sort_order");
      } else {
        $news = $db->Execute("select n.article_id, n.authors_id, nt.news_article_name, n.news_image, n.news_image_two, n.news_date_added, n.news_last_modified, n.news_date_published, n.news_status, n.sort_order from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on (n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "') where nt.news_article_name like '%" . $_GET['search'] . "%' order by n.news_date_published DESC, n.sort_order");
      }
      
      while (!$date_selector->EOF) {
        $date_selector_array[] = array('date' => $date_selector->fields['news_date_published']);

				$date_selector->MoveNext();
      }
    } elseif ( (isset($_GET['date_published_from']) && zen_not_null($_GET['date_published_from'])) || (isset($_GET['date_published_to']) && zen_not_null($_GET['date_published_to'])) ) {
      if (!zen_not_null($_GET['date_published_to'])) {
				$_GET['date_published_to'] = date('Y-m-d');
			}

      $date_selector = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_date_published >= '" . $_GET['date_published_from'] . "' and news_date_published <= '" . $_GET['date_published_to'] . "' group by news_date_published desc");
        
      while (!$date_selector->EOF) {
        $date_selector_array[] = array('date' => $date_selector->fields['news_date_published']);

				$date_selector->MoveNext();
      }

      $news = $db->Execute("select n.article_id, n.authors_id, nt.news_article_name, n.news_image, n.news_image_two, n.news_date_added, n.news_last_modified, n.news_date_published, n.news_status, n.sort_order from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_date_published >= '" . $_GET['date_published_from'] . "' and n.news_date_published <= '" . $_GET['date_published_to'] . "' order by n.news_date_published DESC, n.sort_order");
    } else {
      $date = date('Y-m-d');
      $pastdays = ((isset($_GET['pastdays'])) ? (int)$_GET['pastdays'] : 7);
      $date_selector = $db->Execute("select news_date_published from " . TABLE_NEWS_ARTICLES . " where news_date_published <= '" . $date . "' group by news_date_published DESC limit " . $pastdays);
      
      while (!$date_selector->EOF) {
        $date_selector_array[] = array('date' => $date_selector->fields['news_date_published']);

				$date_selector->MoveNext();
      }
      
      $news = $db->Execute("select n.article_id, n.authors_id, nt.news_article_name, n.news_image, n.news_image_two, n.news_date_added, n.news_last_modified, n.news_date_published, n.news_status, n.sort_order from " . TABLE_NEWS_ARTICLES . " n left join " . TABLE_NEWS_ARTICLES_TEXT . " nt on n.article_id = nt.article_id and nt.language_id = '" . (int)$_SESSION['languages_id'] . "' where n.news_date_published >= '" . $date_selector_array[$pastdays-1]['date'] . "' and n.news_date_published <= '" . $date_selector_array[0]['date'] . "' order by n.news_date_published DESC, n.sort_order");
    }

		echo
			'<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">' .
			'<script language="javascript" type="text/javascript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>'.
			'<script language="javascript" type="text/javascript"><!--
	var SearchdatePublishedfrom = new ctlSpiffyCalendarBox("SearchdatePublishedfrom", "goto_date", "date_published_from", "btnDate1", "' . $_GET['date_published_from'] . '", scBTNMODE_CUSTOMBLUE);
	var SearchdatePublishedto = new ctlSpiffyCalendarBox("SearchdatePublishedto", "goto_date", "date_published_to", "btnDate2", "' . $_GET['date_published_to'] . '", scBTNMODE_CUSTOMBLUE);
//--></script>' .
			'<tr>' .
				'<td width="100%">' .
					'<table border="0" cellspacing="0" cellpadding="2">' .
						'<tr class="infoBoxHeading">' .
							'<td class="infoBoxHeading" valign="middle" align="center" width="60" rowspan="3"><strong>图示</strong></td>' .
						'</tr>' .
						'<tr class="dataTableHeadingRow">' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_PREVIEW . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_MOVE_UP . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_MOVE_DOWN . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_STATUS_OFF . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_STATUS_ON . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_COMMENTS . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_EDIT . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_DELETE . '</td>' .
							'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_INFO . '</td>' .
						'</tr>' .
						'<tr class="dataTableRow">' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_news_preview.gif', ICON_PREVIEW) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_arrow_up_active.gif', IMAGE_ICON_MOVE_UP) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_arrow_down_active.gif', IMAGE_ICON_MOVE_DOWN) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_comments.gif', ICON_COMMENTS) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</td>' .
							'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</td>' .
						'</tr>' .
					'</table>' .
				'</td>' .
			'</tr>' .
			'<tr>' . 
				'<td>' . zen_draw_separator('pixel_trans.gif', '1', '10') . '</td>' .
			'</tr>' .
			'<tr>' .
				'<td width="100%">' .
					zen_draw_form('search', FILENAME_NEWS, '', 'get') .
					'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
						'<tr>' .
							'<td class="pageHeading">' . HEADING_TITLE . '</td>' .
							'<td class="smallText" align="right">' . HEADING_TITLE_SEARCH . ' ' . zen_draw_input_field('search', $_GET['search']) . '</td>' .
						'</tr>' .
					'</table>' .
					'</form>' .
					'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
						'<tr>' .
							'<td class="smallText" align="left" colspan="2">' .
							 zen_draw_form('goto_date', FILENAME_NEWS, '', 'get') .
							 HEADING_TITLE_GOTO_FROM . '&nbsp;<script language="javascript">SearchdatePublishedfrom.writeControl(); SearchdatePublishedfrom.dateFormat="yyyy-MM-dd";</script>' .
							 '&nbsp;' . HEADING_TITLE_GOTO_TO . '&nbsp;<script language="javascript">SearchdatePublishedto.writeControl(); SearchdatePublishedto.dateFormat="yyyy-MM-dd";</script>&nbsp;<input type="submit">' .
							 '</form>' .
						 '</td>' .
						 '<td class="smallText" align="right">' .
							 zen_draw_form('displaydays', FILENAME_NEWS, '', 'get') .
							 HEADING_TITLE_SEARCH_PASTDAYS .
							 zen_draw_pull_down_menu('pastdays', $dropdown_days_array, $pastdays, 'onchange="this.form.submit();"') .
							 '</form>' .
						 '</td>' .
					 '</tr>' .
					'</table>' .
					'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
						'<tr>' .
							'<td valign="top" class="tableLeft">' .
								'<table border="0" width="100%" cellspacing="0" cellpadding="2">';

		$date_group = 0;
		$article_count = 0;
		while (!$news->EOF) {
			$article_count++;

			if ($news->fields['news_date_published'] == $date_selector_array[$date_group]['date']) {
				echo
									'<tr class="dataTableHeadingRow">' .
										'<td class="dataTableHeadingContent">' . sprintf(TABLE_HEADING_NEWS, zen_date_long($date_selector_array[$date_group]['date'])) . '</td>' .
										'<td class="dataTableHeadingContent" align="left">' . TABLE_HEADING_AUTHOR . '</td>' .
										'<td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_SORT_ORDER . '</td>' .
										'<td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_STATUS . '</td>' .
										'<td class="dataTableHeadingContent" align="right">' . TABLE_HEADING_ACTION . '</td>' .
									'</tr>';

				$date_group++;
			}
      
			if ( ((!isset($_GET['aID'])) || ($_GET['aID'] == $news->fields['article_id'])) && (!$nInfo) && (substr($_GET['action'], 0, 4) != 'new_') ) {
				$nInfo = new objectInfo($news->fields);
			}
      
			if ( (is_object($nInfo)) && ($news->fields['article_id'] == $nInfo->article_id) ) {
				echo '<tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEWS, 'aID=' . $news->fields['article_id'] . '&action=new_article_preview&read=only') . '\'">';
			} else {
				echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEWS, 'aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '\'">';
			}
      
      echo 
										'<td class="dataTableContent"><a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $news->fields['article_id'] . '&action=new_article_preview&read=only') . '">' . zen_image(DIR_WS_IMAGES . 'icon_news_preview.gif', ICON_PREVIEW) . '</a>&nbsp;' . $news->fields['news_article_name'] . '</td>' .
										'<td class="dataTableContent" align="left">' . news_get_news_authors_name($news->fields['authors_id']) . '</td>' .
										'<td class="dataTableContent" align="center">';

			if ($news->fields['article_id'] == news_get_first_article($news->fields['news_date_published']) && $news->fields['article_id'] == news_get_last_article($news->fields['news_date_published'])) {
        echo zen_image(DIR_WS_IMAGES . 'icon_arrow_up_deactive.gif', '') . zen_image(DIR_WS_IMAGES . 'icon_arrow_down_deactive.gif', '');
			} elseif ($news->fields['article_id'] == news_get_first_article($news->fields['news_date_published'])) {
        echo zen_image(DIR_WS_IMAGES . 'icon_arrow_up_deactive.gif', '') . '<a href="' . zen_href_link(FILENAME_NEWS, 'action=setorder&order=down&aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_arrow_down_active.gif', IMAGE_ICON_MOVE_DOWN) . '</a>';
			} elseif ($news->fields['article_id'] == news_get_last_article($news->fields['news_date_published'])) {
        echo '<a href="' . zen_href_link(FILENAME_NEWS, 'action=setorder&order=up&aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_arrow_up_active.gif', IMAGE_ICON_MOVE_UP) . '</a>' . zen_image(DIR_WS_IMAGES . 'icon_arrow_down_deactive.gif', '');
			} else {
        echo '<a href="' . zen_href_link(FILENAME_NEWS, 'action=setorder&order=up&aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_arrow_up_active.gif', IMAGE_ICON_MOVE_UP) . '</a><a href="' . zen_href_link(FILENAME_NEWS, 'action=setorder&order=down&aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_arrow_down_active.gif', IMAGE_ICON_MOVE_DOWN) . '</a>';
			}

//			echo $news->fields['sort_order'];
										
      echo
										'</td>' .
										'<td class="dataTableContent" align="center">';

      if ($news->fields['news_status'] == '1') {
        echo '<a href="' . zen_href_link(FILENAME_NEWS, 'action=setflag&flag=0&aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
      } else {
        echo '<a href="' . zen_href_link(FILENAME_NEWS, 'action=setflag&flag=1&aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
      }

      echo 
										'</td>' .
										'<td class="dataTableContent" align="right" valign="middle">' .
											'<a href="#" onclick="commentsEditor(\'' . zen_href_link(FILENAME_NEWS_COMMENTS, 'aID=' . $news->fields['article_id']) . '\');">' . zen_image(DIR_WS_IMAGES . 'icon_comments.gif', ICON_COMMENTS) . '</a>&nbsp;' .
											'<a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $news->fields['article_id'] . '&action=new_article') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>&nbsp;' .
											'<a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $news->fields['article_id'] . '&action=delete_article') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>&nbsp;';

			if ( (is_object($nInfo)) && ($news->fields['article_id'] == $nInfo->article_id) ) {
				echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', '');
			} else {
				echo '<a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $news->fields['article_id'] . news_gather_listing_url()) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>';
			}
      
      echo   
											'&nbsp;' .
										'</td>' .
									'</tr>';

			$news->MoveNext();
    }
    
    echo
								'</table>' .
								'<table border="0" width="100%" cellspacing="0" cellpadding="2">' .
									'<tr>' . 
										'<td colspan="2">' . zen_draw_separator('pixel_trans.gif', '1', '10') . '</td>' .
									'</tr>' .
									'<tr>' .
										'<td class="smallText">' . TEXT_NEWS_ARTICLES . '&nbsp;' . $article_count . '</td>' .
										'<td class="smallText" align="right"><a href="' . zen_href_link(FILENAME_NEWS, 'action=new_article') . '">' . zen_image_button('button_new_news_article.gif', IMAGE_NEW_NEWS_ARTICLE) . '</a></td>' .
									'</tr>' .
								'</table>' .
							'</td>';

		$heading = array();
		$contents = array();
		switch ($action) {
			case 'delete_article':
				$heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_DELETE_NEWS . '</strong>');
        
				$contents = array('form' => zen_draw_form('delete_article', FILENAME_NEWS, 'action=delete_article_confirm') . zen_draw_hidden_field('article_id', $nInfo->article_id));
				$contents[] = array('text' => TEXT_DELETE_NEWS_INTRO);
				$contents[] = array('text' => '<br><strong>' . $nInfo->news_article_name . '</strong>');
				$contents[] = array('text' => '<br>' . TEXT_DELETE_IMAGE_INTRO);
				$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $nInfo->article_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
				break;

			default:
				if (($article_count > 0) || (isset($_GET['search']))) {
					if (is_object($nInfo)) {
						$heading[] = array('text' => '<strong>' . news_get_news_article_name($nInfo->article_id, $languages_id) . '</strong>');
						$contents[] = array('align' => 'center', 'text' => '<a href="#" onclick="commentsEditor(\'' . zen_href_link(FILENAME_NEWS_COMMENTS, 'aID=' . $nInfo->article_id) . '\');">' . zen_image_button('button_news_comments.gif', IMAGE_NEWS_COMMENTS) . '</a> <a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $nInfo->article_id . '&action=new_article') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_NEWS, 'aID=' . $nInfo->article_id . '&action=delete_article') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');

						$contents[] = array('text' => '<br>' . TEXT_DATE_ADDED . ' ' . zen_date_short($nInfo->news_date_added));
            
						if (zen_not_null($nInfo->news_last_modified)) {
							$contents[] = array('text' => TEXT_LAST_MODIFIED . ' ' . zen_date_short($nInfo->news_last_modified));
						}
            
						$contents[] = array('text' => TEXT_NEWS_DATE_PUBLISHED . ' ' . zen_date_short($nInfo->news_date_published));
						$contents[] = array('text' => '<br>' . zen_info_image($nInfo->news_image, $nInfo->news_article_name) . '<br>' . $nInfo->news_image);
					} else {
						$heading[] = array('text' => '<strong>' . TEXT_INFO_HEADING_ARTICLE_NOT_FOUND . '</strong>');
						$contents[] = array('text' => TEXT_ARTICLE_NOT_FOUND);
					}
				} else {
					$heading[] = array('text' => '<strong>' . NO_NEWS_ITEMS . '</strong>');
					$contents[] = array('text' => TEXT_NO_NEWS);
				}
          
				break;
		}
      
    if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
      $box = new box;

      echo '<td width="25%" valign="top" class="tableRight">' . $box->infoBox($heading, $contents) . '</td>';
    }

		echo
						'</tr>' .
					'</table>' .
				'</td>' .
			'</tr>';
  }

	echo
			'</table>' . 
		'</td>' .
	'<!-- body_text_eof //-->' .
	'</tr>' .
'</table>' .
'<!-- body_eof //-->' .
'<!-- footer //-->';

	require(DIR_WS_INCLUDES . 'footer.php');

	echo
'<!-- footer_eof //-->' .
'</body>' .
'</html>';

	require(DIR_WS_INCLUDES . 'application_bottom.php');
?>