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
// $Id: tpl_news_default.php v2.100 2005-02-01 dreamscape <dechantj@pop.belmont.edu>
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
	if ($articlesNotFound == true) {

		// Oh no, no articles were found		
		$newsDisplay->articlesNotFound(sprintf(TEXT_NO_NEWS_ARTICLES, $newsCurrentDate));

		$newsDisplay->articleSplit();
	} else {
		//print_r($newsArticlesBlock);
		foreach ($newsArticlesBlock as $newsArticle) {

			// Set article heading
			$newsDisplay->articleHeading($newsArticle['articleName']);

			// Set by line
			//$newsDisplay->articleByLine(sprintf(TEXT_ARTICLE_BY_LINE, $newsArticle['articleAuthor']), $newsArticle['commentsURL'], (($newsArticle['comments'] > 0) ? sprintf(TEXT_POST_COMMENT_1, $newsArticle['comments']) : TEXT_POST_COMMENT_2));

			// Set article main text
			$newsDisplay->articleText($newsArticle['articleText'], $newsArticle['articleImage']);

			// Set article links
			$newsDisplay->articleLinksBlock($newsArticle['links']);
			

			$newsDisplay->articleSplit();
		}
	}

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
	

?>	<br class="clearBoth" />

<?php
  if (($products_new_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '1') || (PREV_NEXT_BAR_LOCATION == '3'))) {
?>
<div id="newProductsDefaultListingTopNumber" class="navSplitPagesResult back"><?php echo $products_new_split->display_count(TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW); ?></div>
<div id="newProductsDefaultListingTopLinks" class="navSplitPagesLinks forward"><?php echo TEXT_RESULT_PAGE . ' ' . $products_new_split->display_links(MAX_DISPLAY_PAGE_LINKS, zen_get_all_get_params(array('page', 'info', 'x', 'y', 'main_page'))); ?></div>
<?php
  }
?>