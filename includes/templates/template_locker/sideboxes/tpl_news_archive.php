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
// $Id: tpl_news_archive.php v1.000 2005-02-04 dreamscape <dechantj@pop.belmont.edu>
//

  $content = '<div class="newsArchiveSideBox">';

	$newsDisplay = new newsDisplay();

	foreach ($newsArchiveList as $archive) {
		$newsDisplay->articleFooter(sprintf(BOX_NEWS_ARCHIVE_TEXT_ARCHIVE_LIST_HEADER, $archive['archiveDate']), $archive['archiveLinks'], false, false, false);
	}

	$content .= $newsDisplay->displayNewsPage(false);

  $content .= '</div>';
?>