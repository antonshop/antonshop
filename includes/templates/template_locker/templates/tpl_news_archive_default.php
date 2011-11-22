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
// $Id: tpl_news_archive_default.php v2.000 2004-01-23 dreamscape <dechantj@pop.belmont.edu>
//
?>
<table  width="100%" border="0" cellspacing="2" cellpadding="2">
  <!--<tr>
    <td class="breadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></td>
  </tr>-->
</table>
<?php
	// Start the news display class
	$newsDisplay = new newsDisplay();

	// News header
	$newsDisplay->newsHeader(HEADING_TITLE, $newsDate, $newsHeaderLinks);

	// Did we find some articles to display?
	if ($noneFound == true) {

		// Oh no, no articles were found		
		$newsDisplay->articlesNotFound(sprintf(TEXT_NO_NEWS_ARTICLES, $newsCurrentDate));
		$newsDisplay->clearSplit();
	} else {
		foreach ($newsArticlesBlock as $articles) {
			$newsDisplay->articleFooter($articles['articlesDate'], $articles['articlesList'], $articles['articlesFooterDateURL'], sprintf(TEXT_NEWS_FOOTER_URL, $articles['articlesFooterDate']), false);
		}
	}

	// begin archive list
	$newsDisplay->archiveListBegin();

	// Archive list
	foreach ($newsArchiveList as $archive) {
		$newsDisplay->articleFooter(sprintf(TEXT_ARCHIVE_LIST_HEADER, $archive['archiveDate']), $archive['archiveLinks'], false, false, false);
	}

	// Display this news page
	// New page content is output in valid XHTML
	// You can change how it displays in the stylesheet_news.css file
	$newsDisplay->displayNewsPage();
?>