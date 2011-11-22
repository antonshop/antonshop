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
// $Id: tpl_news_comments_default.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
//
?>
<table  width="100%" border="0" cellspacing="2" cellpadding="2">
  <!-- <tr>
    <td class="breadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></td>
  </tr> -->
  <tr>
    <td class="main">
<?php
	if ($messageStack->size('news_comments') > 0) {
		echo $messageStack->output('news_comments');
	}
?>
    </td>
  </tr>
</table>
<?php
	// Start the news display class
	$newsDisplay = new newsDisplay();

	// News header
	$newsDisplay->newsHeader(HEADING_TITLE, $newsDate, $newsHeaderLinks);

	// Back link to article
	$newsDisplay->articleBackLink($backButtonURL, $backButton);

	// Set article heading
	$newsDisplay->articleHeading($articleName);

	// Set by line
	//$newsDisplay->articleByLine(sprintf(TEXT_ARTICLE_BY_LINE, $articleAuthor));

	// Did we find some comments to display?
	if ($commentsNotFound == true) {

		// Oh no, no comments were found		
		$newsDisplay->commentsNotFound(TEXT_NO_NEWS_COMMENTS);
	} else {
		$newsDisplay->clearSplit();

		foreach ($commentsBlock as $comments) {
			$newsDisplay->splitSolid();

			$newsDisplay->articleComments($comments['customersName'], $comments['commentsText'], $comments['dateAdded'], $comments['commentsSubject']);
		}
	}

	// Comments input
	if ($mustLogin == true) {
		$newsDisplay->articleCommentsLogin(COMMENTS_FIELDSET_LEGEND, sprintf(TEXT_COMMENTS_MUST_LOGIN, zen_href_link(FILENAME_LOGIN, '', 'SSL')));
	} else {
		$newsDisplay->articleCommentsInput($formActionURL, COMMENTS_FIELDSET_LEGEND, COMMENTS_FIELDSET_NAME, $nameInput, COMMENTS_FIELDSET_SUBJECT, $subjectInput, COMMENTS_FIELDSET_COMMENTS, $commentsInput, $commentsSubmitButton);
	}

	// News SubFooter
	$newsDisplay->articleFooter(sprintf(TEXT_NEWS_FOOTER_OTHER, $newsSubFooterDate), $newsSubFooter, $newsSubFooterDateURL, sprintf(TEXT_NEWS_FOOTER_URL, $newsSubFooterDate));

	// News Footer
	$newsDisplay->articleFooter(sprintf(TEXT_NEWS_FOOTER, $newsFooterDate), $newsFooter, $newsFooterDateURL, sprintf(TEXT_NEWS_FOOTER_URL, $newsFooterDate));

	// Recent News Footer
	$newsDisplay->articleFooter(TEXT_RECENT_NEWS, $newsRecentFooter);

	// Archive link
	$newsDisplay->archiveLink(zen_href_link(FILENAME_NEWS_ARCHIVE), TEXT_NEWS_ARCHIVE_LINK);

	// Display this news page
	// New page content is output in valid XHTML
	// You can change how it displays in the stylesheet_news.css file
	$newsDisplay->displayNewsPage();
?>