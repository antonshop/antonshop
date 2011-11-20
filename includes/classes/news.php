<?php
/*
	Version 1.100

	A Class to display news content
		-- Must get & format news content prior to sending to this class
		-- Generated news page is stored in variable $this->news_page 
				-- useful perhaps for caching news pages with a cache class
		-- Outputs valid XHTML

	Copyright © 2003-2005 Joshua Dechant.  All Rights Reserved.

	Released under the GNU General Public License
*/

  class newsDisplay {
		var $news_page;

    function newsDisplay() {
			$this->reset();
    }

		function reset() {
			$this->news_page = '';
		}

		function newsHeader($header, $date, $links_array = false) {
			$this->news_page .= '<h1 class="mav_tit"><strong>' . $header . '</strong></h1>' . "\n";
			$this->news_page .= '<div class="newsHeadlineText">' . $date;

			if ($links_array && is_array($links_array)) {
				foreach ($links_array as $link) {
					$this->news_page .= ' &nbsp; <a href="' . $link['link'] . '">' . $link['text'] . '</a>';
				}
			}

			$this->news_page .= '</div>' . "\n";

			$this->clearSplit();

			return true;
		}

		function articlesNotFound($not_found_text) {
			$this->news_page .= '<p>' . $not_found_text . '</p>' . "\n";

			return true;
		}

		function articleHeading($heading) {
			$this->news_page .= '<p class="articleHeading">' . $heading . '</p>' . "\n";

			return true;
		}

		function articleByLine($by_author_text, $comments_url =  false, $comments_url_text =  false) {
			$this->news_page .= '<p class="articleByLine"><span class="author">' . $by_author_text . '</span>';

			if ($comments_url && $comments_url_text) {
				$this->news_page .= ' | <span class="comments"><a href="' . $comments_url . '">' . $comments_url_text . '</a></span>';
			}

			$this->news_page .= '</p>' . "\n";

			return true;
		}

		function articleText($text, $image = '', $html_text = true, $clearbreak = true) {
			if ($image != '') {
				$this->news_page .= $image;
			}

			if ($html_text) {
				$this->news_page .= $text . "\n";
			} else {
				$this->news_page .= nl2br($text) . "\n";
			}

			if ($clearbreak) {
				$this->news_page .= '<div class="clearboth"><hr /></div>' . "\n";
			}

			return true;
		}

		function articleSummary($article_name, $article_summary_text, $article_url, $article_url_text, $image = false) {
			$this->news_page .= '<div class="articleSummary">' . "\n";

			if ($image && $image != '') {
				$this->news_page .= $image;
			}

			$this->news_page .= '  <p><span class="articleHeading"><a href="' . $article_url . '">' . $article_name . '</a></span><br />' . $article_summary_text . '</p>' . "\n";
			$this->news_page .= '  <ul class="archiveLinkList">' . "\n";
			$this->news_page .= '    <li><a href="' . $article_url . '">' . $article_url_text . '</a></li>' . "\n";
			$this->news_page .= '  </ul>' . "\n";
			$this->news_page .= '</div>' . "\n";

			return true;
		}

		function articleLinksBlock($links_block) {
			foreach ($links_block as $links) {
				$this->news_page .= '<ul class="articleLinkList">' . "\n";

				// Offsite Links
				foreach ($links['offsiteLinks'] as $thisLink) {
					$this->news_page .= '  <li><a href="' . $thisLink['link'] . '" target="_blank">' . $thisLink['text'] . '</a></li>' . "\n";
				}

				// Product Links
				foreach ($links['productLinks'] as $thisLink) {
					$this->news_page .= '  <li class="articleProductLink"><a href="' . $thisLink['link'] . '">' . $thisLink['text'] . '</a></li>' . "\n";
				}

				// On-site Store Links
				foreach ($links['storeLinks'] as $thisLink) {
					$this->news_page .= '  <li class="articleStoreLink"><a href="' . $thisLink['link'] . '">' . $thisLink['text'] . '</a></li>' . "\n";
				}

				$this->news_page .= '</ul>' . "\n";
			}

			return true;
		}

		function articleListing($article_array) {
			$this->news_page .= '<ul class="articleList">';

			foreach ($article_array as $thisArticle) {
				$this->news_page .= '<li><a href="' . self::seo_link($thisArticle['link']) . '">' . $thisArticle['text'] . '</a></li>';
			}

			$this->news_page .= '</ul>' . "\n";

			return true;
		}
		
		//anton 文章左侧列表
		function article_sidebar_list($article_array){
			//echo $article_array['link'];
			$this->news_page .= '<li><a href="' . self::seo_link($article_array['link']) . '">' . $article_array['news_article_name']."</a></li>";	
			return true;		
			
		}

		function articleFooter($heading, $footer_array, $footer_date_url = false, $footer_date_text = false, $split_after = true) {
			if (is_array($footer_array)) {
				$this->clearSplit();

				$this->articleHeading($heading);

				$this->news_page .= '<ul class="archiveLinkList">' . "\n";

				foreach ($footer_array as $thisFooter) {
					$this->news_page .= '  <li><a href="' . self::seo_link($thisFooter['link']) . '">' . $thisFooter['text'] . '</a></li>' . "\n";
				}

				$this->news_page .= '</ul>' . "\n";

				if ($footer_date_url && $footer_date_text) {
					$this->clearSplit();
					$this->news_page .= '<p class="articleText"><a href="' . self::seo_link($footer_date_url) . '">' . $footer_date_text . '</a></p>' . "\n";
				}

				$this->clearSplit();

				if ($split_after) {
					$this->splitSolid();
				}
			}

			return true;
		}

		function articleBackLink($link, $link_text) {
			$this->news_page .= '<p class="backLink"><a href="' . self::seo_link($link) . '">' . $link_text . '</a></p>' . "\n";

			return true;
		}

		function commentsNotFound($not_found_text) {
			$this->news_page .= '<p>' . $not_found_text . '</p>' . "\n";

			return true;
		}

		function articleComments($commentor, $comments, $date_added, $subject = false, $html_text = true) {
			$this->news_page .= '<div class="commentsHeading">' . "\n";
			$this->news_page .= '  <p class="commentsAuthor">';

			if ($subject) {
				$this->news_page .= '<span class="commentsSubject">' . $subject . '</span><br />';
			}

			$this->news_page .= $commentor . '</p>' . "\n";
			$this->news_page .= '  <p class="commentsDate"><span class="smallText">' . $date_added . '</span></p>' . "\n";
			$this->news_page .= '  <div class="clearboth"></div>' . "\n";
			$this->news_page .= '</div>' . "\n";
			$this->news_page .= '<div class="commentsBody">' . "\n";

			if ($html_text) {
				$this->news_page .= '  <p>' . $comments . '</p>' . "\n";
			} else {
				$this->news_page .= '  <p>' . nl2br($comments) . '</p>' . "\n";
			}

			$this->news_page .= '</div>' . "\n";

			return true;
		}

		function articleCommentsLogin($legend, $text) {
			$this->news_page .= '<fieldset class="commentsFieldSet">' . "\n";
			$this->news_page .= '  <legend>' . $legend . '</legend>' . "\n";
			$this->news_page .= '  <p>' . $text . '</p>' . "\n";
			$this->news_page .= '</fieldset>' . "\n";

			$this->articleSplit();

			return true;
		}

		function articleCommentsInput($form_url, $legend, $commentor_label, $commentor_input, $subject_label, $subject_input, $comments_label, $comments_input, $submit_input) {
			$this->news_page .= '<form name="post_comment" action="' . $form_url . '" method="post" onsubmit="return check_form(this);">' . "\n";
			$this->news_page .= '  <input type="hidden" name="action" value="process" />' . "\n";
			$this->news_page .= '  <fieldset class="commentsFieldSet">' . "\n";
			$this->news_page .= '    <legend>' . $legend . '</legend>' . "\n";
			$this->news_page .= '    <label for="customers_name">' . $commentor_label . ' ' . $commentor_input . '</label>' . "\n";
			$this->news_page .= '    <label for="comments_subject">' . $subject_label . ' ' . $subject_input . '</label>' . "\n";

			$this->clearSplit();

			$this->news_page .= '    <label for="comments_text">' . $comments_label . ' ' . $comments_input . '</label>' . "\n";
			$this->news_page .= '  </fieldset>' . "\n";
			$this->news_page .= '  <p class="commentsSubmit">' . $submit_input . '</p>' . "\n";
			$this->news_page .= '</form>' . "\n";

			$this->articleSplit();

			return true;
		}

		function archiveLink($archive_url, $archive_url_text) {
			$this->clearSplit();

			$this->news_page .= '<p class="articleText"><a href="' . self::seo_link($archive_url) . '">' . $archive_url_text . '</a></p>' . "\n";

			return true;
		}

		function archiveListBegin() {
			$this->clearSplit();

			$this->splitSolid();

			$this->news_page .= '<div class="clearSplit"><a name="archive"></a></div>' . "\n";

			return true;
		}

		function articleSplit() {
			$this->clearSplit();

			$this->splitSolid();

			$this->clearSplit();

			return true;
		}

		function clearSplit() {
			$this->news_page .= '<div class="clearSplit"></div>' . "\n";

			return true;
		}

		function splitSolid() {
			$this->news_page .= '<div class="splitSolidGray"></div>' . "\n";

			return true;
		}

		function displayNewsPage($direct_output = true) {
			if ($direct_output) {
				echo $this->news_page;

				return true;
			} else {
				return $this->news_page;
			}
		}
		//anton 新闻模块rewrite url
		function seo_link($url) {
			if(substr($url, -5) == '.html'){
				return $url;
			}
			$reg="/index\.php\?main\_page\=([a-zA-Z_]+)&amp;([a-zA-Z_]+)=([0-9a-zA-Z_-]+)/i";
			if(SEO_ENABLED == 'true') {
				preg_match($reg, $url, $matches);
				
				if(empty($matches)){
					preg_match("/index\.php\?main\_page\=([a-zA-Z_]+)/i", $url, $matches);
					//echo $url;print_r($matches);
					$temp_url = $matches[1] . '.html';
				}else{
					$temp_url = $matches[1];
					if(isset($matches[2]) && isset($matches[3])){
						$temp_url .= '-' . $matches[2] . '-' . $matches[3]; 
					}
					$temp_url .= '.html';
				}
				return $temp_url;
			} else {
				return $url;
			}
		}

  }
?>