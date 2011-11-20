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
//  $Id: news_comments.php v2.000 2005-01-23 dreamscape <dechantj@pop.belmont.edu>
//

  require('includes/application_top.php');

  require('includes/functions/news_general.php');

	if (!isset($_GET['aID']) || !zen_not_null($_GET['aID'])) {
		zen_redirect(zen_href_link(FILENAME_NEWS));
	}

  if (isset($_GET['action'])) {
    switch ($_GET['action']) {
      case 'setflag':
        if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
          if (isset($_GET['cID']) && zen_not_null($_GET['cID'])) {
            $sql_data_array = array('approved' => zen_db_prepare_input($_GET['flag']));

            zen_db_perform(TABLE_NEWS_COMMENTS, $sql_data_array, 'update', 'comments_id = \'' . (int)$_GET['cID'] . '\'');

            $messageStack->add(SUCCESS_STATUS, 'success');
          }
        }

      break;
    }
  }

  if ($_POST) {
    $article_id = zen_db_prepare_input($_GET['aID']);
    $comments_id = zen_db_prepare_input($_GET['cID']);
		$customers_name = zen_db_prepare_input($_POST['customers_name']);
		$comments_subject = zen_db_prepare_input($_POST['comments_subject']);
		$comments_text = zen_db_prepare_input($_POST['comments_text']);
  }

  switch ($_GET['query']) {  
		case 'add_comment':

      // Check if all fields are filled up
      if (!zen_not_null($customers_name)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_COMMENTS_BY_NAME, 'error');
      }

      if (!zen_not_null($comments_text)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_COMMENTS, 'error');
      }

			// Good to go
      if (!$error) {
        $sql_data_array = array(
					'article_id' => $article_id,
					'customers_name' => $customers_name,
					'date_added' => 'now()',
					'approved' => '1',
				);

        zen_db_perform(TABLE_NEWS_COMMENTS, $sql_data_array);

        $comments_id = $db->Insert_ID();

        $sql_data_array = array(
					'comments_id' => $comments_id,
					'language_id' => $_SESSION['languages_id'],
					'comments_subject' => $comments_subject,
					'comments_text' => $comments_text,
				);

        zen_db_perform(TABLE_NEWS_COMMENTS_DESCRIPTION, $sql_data_array);

        $messageStack->add_session(SUCCESS_NEW_COMMENT, 'success');
        
        zen_redirect(zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $article_id . '&cID=' . $comments_id));
      }

			break;

		case 'update_comment':

      // Check if all fields are filled up
      if (!zen_not_null($customers_name)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_COMMENTS_BY_NAME, 'error');
      }

      if (!zen_not_null($comments_text)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_COMMENTS, 'error');
      }

			// Good to go
      if (!$error) {
        $sql_data_array = array(
					'customers_name' => $customers_name,
					'last_modified' => 'now()',
				);

        zen_db_perform(TABLE_NEWS_COMMENTS, $sql_data_array, 'update', 'comments_id = \'' . (int)$comments_id . '\'');

        $sql_data_array = array(
					'comments_subject' => $comments_subject,
					'comments_text' => $comments_text,
				);

        zen_db_perform(TABLE_NEWS_COMMENTS_DESCRIPTION, $sql_data_array, 'update', 'comments_id = \'' . (int)$comments_id . '\'');

        $messageStack->add_session(SUCCESS_NEW_COMMENT, 'success');
        
        zen_redirect(zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $article_id . '&cID=' . $comments_id));
      }

			break;

		case 'delete_comment':
			$db->Execute("DELETE FROM " . TABLE_NEWS_COMMENTS . " WHERE comments_id = '" . (int)$comments_id . "'");
			$db->Execute("DELETE FROM " . TABLE_NEWS_COMMENTS_DESCRIPTION . " WHERE comments_id = '" . (int)$comments_id . "'");
			
			$messageStack->add_session(SUCCESS_DELETE_COMMENT, 'success');
	
      zen_redirect(zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $article_id));

			break;
  }

// start page output
echo
'<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">'. "\n" .
'<html ' . HTML_PARAMS . '>' .
'<head>' .
	'<meta http-equiv="Content-Type" content="text/html; charset=' . CHARSET . '">' .
	'<title>' . TITLE . '</title>' .
	'<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">' .
	'<script language="javascript" src="includes/general.js"></script>' .
'</head>' .
'<body>' .
'<!-- body //-->' .
'<table border="0" width="100%" cellspacing="2" cellpadding="2">' .
	'<tr>' .
	'<!-- body_text //-->' .
		'<td width="100%" valign="top">' .
			'<table border="0" width="100%" cellspacing="0" cellpadding="2">' .
				'<tr>' .
					'<td width="100%">' .
						'<table border="0" cellspacing="0" cellpadding="2">' .
							'<tr class="infoBoxHeading">' .
								'<td class="infoBoxHeading" valign="middle" align="center" width="60" rowspan="3"><strong>图示</strong></td>' .
							'</tr>' .
							'<tr class="dataTableHeadingRow">' .
								'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_STATUS_OFF . '</td>' .
								'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_STATUS_ON . '</td>' .
								'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_EDIT . '</td>' .
								'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_DELETE . '</td>' .
								'<td class="dataTableHeadingContent" valign="top" align="center" width="75">' . TEXT_NEWS_LEGEND_INFO . '</td>' .
							'</tr>' .
							'<tr class="dataTableRow">' .
								'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</td>' .
								'<td class="dataTableContent" valign="middle" align="center" width="75">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</td>' .
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
						'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
							'<tr>' .
								'<td class="pageHeading">' . sprintf(HEADING_TITLE, news_get_news_article_name($_GET['aID'])) . '</td>' .
								'<td class="pageHeading" align="right">' . zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT) . '</td>' .
							'</tr>' .
						'</table>' .
					'</td>' .
				'</tr>' .
				'<tr>' . 
					'<td width="100%">' . 
						'<table border="0" width="100%" cellspacing="0" cellpadding="0">' .
							'<tr>' .
								'<td valign="top">' . 
									'<table border="0" width="100%" cellspacing="0" cellpadding="2">' .
										'<tr class="dataTableHeadingRow">' .
											'<td class="dataTableHeadingContent">' . TABLE_HEADING_COMMENTS_BY . '</td>' .
											'<td class="dataTableHeadingContent">' . TABLE_HEADING_SUBJECT . '</td>' .
											'<td class="dataTableHeadingContent">' . TABLE_HEADING_DATE_ADDED . '</td>' .
											'<td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_STATUS . '</td>' .
											'<td class="dataTableHeadingContent" align="right">' . TABLE_HEADING_ACTION . '&nbsp;</td>' .
										'</tr>';

  $comments_query_raw = "select nc.comments_id, nc.article_id, nc.customers_id, nc.customers_name, nc.date_added, nc.last_modified, nc.approved, ncd.comments_subject, ncd.comments_text from " . TABLE_NEWS_COMMENTS . " nc left join " . TABLE_NEWS_COMMENTS_DESCRIPTION . " ncd on (nc.comments_id = ncd.comments_id and ncd.language_id = '" . (int)$_SESSION['languages_id'] . "') where nc.article_id = '" . (int)$_GET['aID'] . "' order by nc.date_added DESC";
  $comments_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $comments_query_raw, $comments_query_numrows);
  $comments = $db->Execute($comments_query_raw);

  while (!$comments->EOF) {
    if (((!$_GET['cID']) || (@$_GET['cID'] == $comments->fields['comments_id'])) && (!$cInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $cInfo = new objectInfo($comments->fields);
    }

    if ( (is_object($cInfo)) && ($comments->fields['comments_id'] == $cInfo->comments_id) ) {
      echo '<tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id'] . '&action=edit') . '\'">';
    } else {
      echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id']) . '\'">';
    }

		echo
										'<td class="dataTableContent">' . $comments->fields['customers_name'] . '</td>' .
										'<td class="dataTableContent">' . $comments->fields['comments_subject'] . '</td>' .
										'<td class="dataTableContent">' . zen_datetime_short($comments->fields['date_added']) . '</td>' .
										'<td class="dataTableContent" align="center">';

		if ($comments->fields['approved'] == '1') {
			echo '<a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id'] . '&action=setflag&flag=0') . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
		} else {
			echo '<a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id'] . '&action=setflag&flag=1') . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
		}

		echo
										'</td>' .
										'<td class="dataTableContent" align="right">' .
											'<a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>&nbsp;' .
											'<a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>&nbsp;';

		if ( (is_object($cInfo)) && ($comments->fields['comments_id'] == $cInfo->comments_id) ) {
			echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif') . '&nbsp;';
		} else { 
			echo '<a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $comments->fields['article_id'] . '&cID=' . $comments->fields['comments_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>&nbsp;';
		}

		echo
										'</td>' .
									'</tr>';

		$comments->MoveNext();
  }

	echo
									'<tr>' .
										'<td colspan="6">' .
											'<table border="0" width="100%" cellspacing="0" cellpadding="2">' .
												'<tr>' .
													'<td class="smallText" valign="top">' . $comments_split->display_count($comments_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_COMMENTS) . '</td>' .
													'<td class="smallText" align="right">' . $comments_split->display_links($comments_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']) . '</td>' .
												'</tr>' .
											'</table>' .
										'</td>' .
									'</tr>';

	if ($_GET['action'] != 'new') {
		echo
									'<tr>' .
										'<td align="right" colspan="6" class="smallText"><a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a></td>' .
									'</tr>';
	}

	echo
								'</table>' .
							'</td>';

	$heading = array();
	$contents = array();
	switch ($_GET['action']) {
		case 'new':
			$heading[] = array('text' => '<strong>' . TEXT_HEADING_NEW_COMMENT . '</strong>');

			$contents = array('form' => zen_draw_form('new_comment', FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&query=add_comment&action=new', 'post', 'enctype="multipart/form-data"'));
			$contents[] = array('text' => TEXT_NEW_INTRO);
			$contents[] = array('text' => '<br>' . TEXT_COMMENTS_BY . '<br>' . zen_draw_input_field('customers_name', (($customers_name) ? $customers_name : '')));
			$contents[] = array('text' => '<br>' . TEXT_SUBJECT . '<br>' . zen_draw_input_field('comments_subject', (($comments_subject) ? $comments_subject : '')));
			$contents[] = array('text' => '<br>' . TEXT_COMMENTS . '<br>' . zen_draw_textarea_field('comments_text', 'soft', '30', '20', (($comments_text) ? $comments_text : ''), 'style="width: 100%;"'));

			$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
			break;

		case 'edit':
			$heading[] = array('text' => '<strong>' . TEXT_HEADING_EDIT_COMMENT . '</strong>');

			$contents = array('form' => zen_draw_form('update_comment', FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&cID=' . $cInfo->comments_id . '&query=update_comment&action=edit', 'post', 'enctype="multipart/form-data"'));
			$contents[] = array('text' => TEXT_EDIT_INTRO);
			$contents[] = array('text' => '<br>' . TEXT_COMMENTS_BY . '<br>' . zen_draw_input_field('customers_name', (($customers_name) ? $customers_name : $cInfo->customers_name)));
			$contents[] = array('text' => '<br>' . TEXT_SUBJECT . '<br>' . zen_draw_input_field('comments_subject', (($comments_subject) ? $comments_subject : $cInfo->comments_subject)));
			$contents[] = array('text' => '<br>' . TEXT_COMMENTS . '<br>' . zen_draw_textarea_field('comments_text', 'soft', '30', '20', (($comments_text) ? $comments_text : $cInfo->comments_text), 'style="width: 100%;"'));

			$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&cID=' . $cInfo->comments_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
			break;

		case 'delete':
			$heading[] = array('text' => '<strong>' . TEXT_HEADING_DELETE_COMMENT . '</strong>');

			$contents = array('form' => zen_draw_form('delete_author', FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&cID=' . $cInfo->comments_id . '&query=delete_comment&action=delete'));
			$contents[] = array('text' => TEXT_DELETE_INTRO);
			$contents[] = array('text' => '<br><strong>' . $cInfo->comments_subject . '</strong><br>' . $cInfo->customers_name);
			$contents[] = array('text' => '<br>' . $cInfo->comments_text);

			$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&cID=' . $cInfo->comments_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
			break;

		default:
			if (is_object($cInfo)) {
				$heading[] = array('text' => '<strong>' . TEXT_HEADING_COMMENT . '</strong>');

				$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&cID=' . $cInfo->comments_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_NEWS_COMMENTS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&cID=' . $cInfo->comments_id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
				$contents[] = array('text' => '<br><strong>' . $cInfo->comments_subject . '</strong><br>' . $cInfo->customers_name);
				$contents[] = array('text' => '<br>' . $cInfo->comments_text);
			}
			break;
	}

	if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
		$box = new box;

		echo '<td width="25%" valign="top">' . $box->infoBox($heading, $contents) . '</td>';
	}

	echo
							'</tr>' .
						'</table>' .
					'</td>' .
				'</tr>' .
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
'</body>'.
'</html>';

	require(DIR_WS_INCLUDES . 'application_bottom.php');
?>