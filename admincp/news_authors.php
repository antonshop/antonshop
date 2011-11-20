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
//  $Id: news_authors.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//

  require('includes/application_top.php');

  require('includes/functions/news_general.php');

  if (isset($_GET['action'])) {
    switch ($_GET['action']) {
      case 'setflag':
        if (($_GET['flag'] == '0') || ($_GET['flag'] == '1')) {
          if (isset($_GET['aID']) && zen_not_null($_GET['aID'])) {
            $sql_data_array = array('status' => zen_db_prepare_input($_GET['flag']));

            zen_db_perform(TABLE_NEWS_AUTHORS, $sql_data_array, 'update', 'authors_id = \'' . (int)$_GET['aID'] . '\'');

            $messageStack->add(SUCCESS_STATUS, 'success');
          }
        }

      break;
    }
  }

  if ($_POST) {
    $authors_id = zen_db_prepare_input($_GET['aID']);
    $author_name = zen_db_prepare_input($_POST['author_name']);
    $author_email = zen_db_prepare_input($_POST['author_email']);
  }

  switch ($_GET['query']) {  
    case 'add_author':
      // Check if all fields are filled up
      if (!zen_not_null($author_name)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_AUTHOR_NAME, 'error');
      }

      if (!zen_not_null($author_email)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_AUTHOR_EMAIL, 'error');
      }

      // Check if user exists
      $user_exists = $db->Execute("select * from " . TABLE_NEWS_AUTHORS . " where author_name = '" . zen_db_input($author_name) . "'");
      if ($user_exists->RecordCount() > 0) {
        $error = true;
        $messageStack->add(ERROR_AUTHOR_EXISTS, 'error');
      }

      // Check if email exists
      $email_exists = $db->Execute("select * from " . TABLE_NEWS_AUTHORS . " where lower(author_email) = '" . strtolower(zen_db_input($author_email)) . "'");
      if ($email_exists->RecordCount() > 0) {
        $error = true;
        $messageStack->add(ERROR_EMAIL_EXISTS, 'error');
      }

      if (!$error) {
        $sql_data_array = array(
					'author_name' => $author_name,
					'author_email' => $author_email,
					'status' => '1',
				);

        zen_db_perform(TABLE_NEWS_AUTHORS, $sql_data_array);

        $new_authors_id = $db->Insert_ID();

        $messageStack->add_session(SUCCESS_NEW_AUTHOR, 'success');
        
        zen_redirect(zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $new_authors_id));
      }
    break;

    case 'delete_author':
			$has_articles = zen_db_prepare_input($_POST['has_articles']);
			$delete_articles = zen_db_prepare_input($_POST['delete_articles']);
			$new_authors_id = zen_db_prepare_input($_POST['new_authors_id']);

			if ($has_articles) {
				if (($delete_articles)) {
					$articles = $db->Execute("select article_id from " . TABLE_NEWS_ARTICLES . " where authors_id = '" . (int)$authors_id . "'");
					while (!$articles->EOF) {
						news_remove_article($articles->fields['article_id']);

						$articles->MoveNext();
					}

					$messageStack->add_session(SUCCESS_ARTICLES_DELETED, 'success');
				} else {
					if (!zen_not_null($new_authors_id)) {
						$error = true;
						$messageStack->add(ERROR_SELECT_AUTHOR, 'error');
						break;
					} else {
						$sql_data_array = array('authors_id' => $new_authors_id);
						if (zen_db_perform(TABLE_NEWS_ARTICLES, $sql_data_array, 'update', 'authors_id = \'' . (int)$authors_id . '\'')) {
							$messageStack->add_session(SUCCESS_ARTICLES_REASSIGNED, 'success');
						}	  
					} 
				}
			}
	  
			$db->Execute("delete from " . TABLE_NEWS_AUTHORS . " where authors_id = '" . (int)$authors_id . "'");
			
			$messageStack->add_session(SUCCESS_DELETE_AUTHOR, 'success');
	
			zen_redirect(zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . (($new_authors_id) ? '&aID=' . $new_authors_id : '')));
    break;

    case 'update_author':

      // Check if all fields are filled up
      if (!zen_not_null($author_name)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_AUTHOR_NAME, 'error');
      }

      if (!zen_not_null($author_email)) {
        $error = true;
        $messageStack->add(ERROR_BLANK_AUTHOR_EMAIL, 'error');
      }

      // Check if name exists
      $user_exists = $db->Execute("select * from " . TABLE_NEWS_AUTHORS . " where author_name = '" . zen_db_input($author_name) . "' and authors_id != '" . (int)$authors_id . "'");
      if ($user_exists->RecordCount() > 0) {
        $error = true;
        $messageStack->add(ERROR_AUTHOR_EXISTS, 'error');
      }

      // Check if email exists
      $email_exists = $db->Execute("select * from " . TABLE_NEWS_AUTHORS . " where lower(author_email) = '" . strtolower(zen_db_input($author_email)) . "' and authors_id != '" . (int)$authors_id . "'");
      if ($email_exists->RecordCount() > 0) {
        $error = true;
        $messageStack->add(ERROR_EMAIL_EXISTS, 'error');
      }

  	  if (!$error) {
        $sql_data_array = array(
					'author_name' => $author_name,
					'author_email' => $author_email,
				);

        zen_db_perform(TABLE_NEWS_AUTHORS, $sql_data_array, 'update', 'authors_id = \'' . (int)$authors_id . '\'');

				$messageStack->add_session(SUCCESS_UPDATE_AUTHOR, 'success');

				zen_redirect(zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $authors_id));
		  }
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
	'<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">' .
	'<script language="javascript" type="text/javascript" src="includes/general.js"></script>' .
	'<script language="javascript" type="text/javascript" src="includes/menu.js"></script>' .
	'<script language="javascript" type="text/javascript"><!--
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
//--></script>' .
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
								'<td class="pageHeading">' . HEADING_TITLE . '</td>' .
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
											'<td class="dataTableHeadingContent">' . TABLE_HEADING_AUTHOR . '</td>' .
											'<td class="dataTableHeadingContent">' . TABLE_HEADING_EMAIL . '</td>' .
											'<td class="dataTableHeadingContent" align="center">' . TABLE_HEADING_STATUS . '</td>' .
											'<td class="dataTableHeadingContent" align="right">' . TABLE_HEADING_ACTION . '&nbsp;</td>' .
										'</tr>';

	$authors_array = array(
		array(
			'id' => '',
			'text' => TEXT_PLEASE_SELECT,
		),
	);

  $authors_query_raw = "select * from " . TABLE_NEWS_AUTHORS . " order by authors_id";
  $authors_split = new splitPageResults($_GET['page'], MAX_DISPLAY_SEARCH_RESULTS, $authors_query_raw, $authors_query_numrows);
  $authors = $db->Execute($authors_query_raw);

  while (!$authors->EOF) {
    if (($_GET['aID'] != $authors->fields['authors_id']) && ($_GET['action'] == 'delete')) {
			$authors_array[] = array(
				'id' => $authors->fields['authors_id'],
				'text' => $authors->fields['author_name'],
			);
		}

    if (((!$_GET['aID']) || (@$_GET['aID'] == $authors->fields['authors_id'])) && (!$aInfo) && (substr($_GET['action'], 0, 3) != 'new')) {
      $authors_articles = $db->Execute("select count(*) as articles_count from " . TABLE_NEWS_ARTICLES . " where authors_id = '" . (int)$authors->fields['authors_id'] . "'");
		  $authors->fields = array_merge($authors->fields, $authors_articles->fields);
 
      $aInfo = new objectInfo($authors->fields);
    }

    if ( (is_object($aInfo)) && ($authors->fields['authors_id'] == $aInfo->authors_id) ) {
      echo '<tr class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $authors->fields['authors_id'] . '&action=edit') . '\'">';
    } else {
      echo '<tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $authors->fields['authors_id']) . '\'">';
    }

		echo
										'<td class="dataTableContent">' . $authors->fields['author_name'] . '</td>' .
										'<td class="dataTableContent"><a href="mailto:' . $authors->fields['author_email'] . '">&lt;' . $authors->fields['author_email'] . '&gt;</a></td>' .
										'<td class="dataTableContent" align="center">';

		if ($authors->fields['status'] == '1') {
			echo '<a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&action=setflag&flag=0&aID=' . $authors->fields['authors_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_green_on.gif', IMAGE_ICON_STATUS_ON) . '</a>';
		} else {
			echo '<a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&action=setflag&flag=1&aID=' . $authors->fields['authors_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_red_on.gif', IMAGE_ICON_STATUS_OFF) . '</a>';
		}

		echo
										'</td>' .
										'<td class="dataTableContent" align="right">' .
											'<a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $authors->fields['authors_id'] . '&action=edit') . '">' . zen_image(DIR_WS_IMAGES . 'icon_edit.gif', ICON_EDIT) . '</a>&nbsp;' .
											'<a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $authors->fields['authors_id'] . '&action=delete') . '">' . zen_image(DIR_WS_IMAGES . 'icon_delete.gif', ICON_DELETE) . '</a>&nbsp;';

		if ( (is_object($aInfo)) && ($authors->fields['authors_id'] == $aInfo->authors_id) ) {
			echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif') . '&nbsp;';
		} else { 
			echo '<a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $authors->fields['authors_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>&nbsp;';
		}

		echo
										'</td>' .
									'</tr>';

		$authors->MoveNext();
  }

	echo
									'<tr>' .
										'<td colspan="6">' .
											'<table border="0" width="100%" cellspacing="0" cellpadding="2">' .
												'<tr>' .
													'<td class="smallText" valign="top">' . $authors_split->display_count($authors_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, $_GET['page'], TEXT_DISPLAY_NUMBER_OF_AUTHORS) . '</td>' .
													'<td class="smallText" align="right">' . $authors_split->display_links($authors_query_numrows, MAX_DISPLAY_SEARCH_RESULTS, MAX_DISPLAY_PAGE_LINKS, $_GET['page']) . '</td>' .
												'</tr>' .
											'</table>' .
										'</td>' .
									'</tr>';

	if ($_GET['action'] != 'new') {
		echo
									'<tr>' .
										'<td align="right" colspan="6" class="smallText"><a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID'] . '&action=new') . '">' . zen_image_button('button_insert.gif', IMAGE_INSERT) . '</a></td>' .
									'</tr>';
	}

	echo
								'</table>' .
							'</td>';

	$heading = array();
	$contents = array();
	switch ($_GET['action']) {
		case 'new':
			$heading[] = array('text' => '<strong>' . TEXT_HEADING_NEW_AUTHOR . '</strong>');

			$contents = array('form' => zen_draw_form('new_author', FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id . '&query=add_author&action=new', 'post', 'enctype="multipart/form-data"'));
			$contents[] = array('text' => TEXT_NEW_INTRO);
			$contents[] = array('text' => '<br>' . TEXT_AUTHOR_NAME . '<br>' . zen_draw_input_field('author_name', (($author_name) ? $author_name : '')));
			$contents[] = array('text' => TEXT_AUTHOR_EMAIL . '<br>' . zen_draw_input_field('author_email', (($author_email) ? $author_email : '')));

			$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $_GET['aID']) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
			break;

		case 'edit':
			$heading[] = array('text' => '<strong>' . TEXT_HEADING_EDIT_AUTHOR . '</strong>');

			$contents = array('form' => zen_draw_form('edit_author', FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id . '&query=update_author&action=edit', 'post', 'enctype="multipart/form-data"'));
			$contents[] = array('text' => TEXT_EDIT_INTRO);
			$contents[] = array('text' => '<br>' . TEXT_AUTHOR_NAME . '<br>' . zen_draw_input_field('author_name', (($author_name) ? $author_name : $aInfo->author_name)));
			$contents[] = array('text' => TEXT_AUTHOR_EMAIL . '<br>' . zen_draw_input_field('author_email', (($author_email) ? $author_email : $aInfo->author_email)));

			$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_save.gif', IMAGE_SAVE) . ' <a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
			break;

		case 'delete':
			$heading[] = array('text' => '<strong>' . TEXT_HEADING_DELETE_AUTHOR . '</strong>');

			$contents = array('form' => zen_draw_form('delete_author', FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id . '&query=delete_author&action=delete'));
			$contents[] = array('text' => TEXT_DELETE_INTRO);
			$contents[] = array('text' => '<br><strong>' . $aInfo->author_name . '</strong>');
			if ($aInfo->articles_count > 0) {
				$contents[] = array('text' => zen_draw_hidden_field('has_articles', '1') . '<br>' . sprintf(TEXT_DELETE_ARTICLES_PRODUCTS, $aInfo->articles_count) . '<br>' . zen_draw_radio_field('delete_articles', '1') . ' ' . TEXT_DELETE_ARTICLES . '<br>' . zen_draw_radio_field('delete_articles', '0', true) . TEXT_REASSIGN_ARTICLES . ' ' . zen_draw_pull_down_menu('new_authors_id', $authors_array, (($new_authors_id) ? $new_authors_id : '')));
			} else {
			$contents[] = array('text' => zen_draw_hidden_field('has_articles', '0'));
		}

			$contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_delete.gif', IMAGE_DELETE) . ' <a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
			break;

		default:
			if (is_object($aInfo)) {
				$heading[] = array('text' => '<strong>' . $aInfo->author_name . '</strong>');

				$contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a> <a href="' . zen_href_link(FILENAME_NEWS_AUTHORS, 'page=' . $_GET['page'] . '&aID=' . $aInfo->authors_id . '&action=delete') . '">' . zen_image_button('button_delete.gif', IMAGE_DELETE) . '</a>');
				$contents[] = array('text' => '<br>' . TEXT_NO_OF_ARTICLES . ' ' . $aInfo->articles_count);
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