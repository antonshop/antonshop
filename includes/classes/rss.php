<?php
/*
	Version 1.000

	A Class to output rss feed
		-- outputs valid rss 2.0

	Copyright (c) 2005 Joshua Dechant.  All Rights Reserved.

	Released under the GNU General Public License
*/

  class rssFeed {
		var $rss_feed;

    function rssFeed() {
			$this->reset();
    }

		function reset() {
			$this->rss_feed = '';
		}

		function rssBegin($encoding) {
			$this->rss_feed .= '<?xml version="1.0" encoding="' . $encoding . '"?>' . "\n";
			$this->rss_feed .= '<rss version="2.0">' . "\n";

			return true;
		}

		function rssBeginChannel($title, $link, $description, $language = false, $image = false, $copyright = false, $managingEditor = false, $webMaster = false, $category = false, $generator = 'PHP RSS Feed Class, (c) 2005 Joshua Dechant <dechantj@pop.belmont.edu>', $docs = 'http://feedvalidator.org/docs/rss2.html', $lastBuildDate = false) {
			$this->rss_feed .= '<channel>' . "\n";
			$this->rss_feed .= '<title>' . $this->cleanItem($title) . '</title>' . "\n";
			$this->rss_feed .= '<link>' . $this->cleanItem($link) . '</link>' . "\n";
			$this->rss_feed .= '<description>' . $this->cleanItem($description) . '</description>' . "\n";

			if ($image) {
				$this->rss_feed .= '<image>' . "\n";
				$this->rss_feed .= '<title>' . $this->cleanItem($title) . '</title>' . "\n";
				$this->rss_feed .= '<url>' . $this->cleanItem($image) . '</url>' . "\n";
				$this->rss_feed .= '<link>' . $this->cleanItem($link) . '</link>' . "\n";
				$this->rss_feed .= '</image>' . "\n";
			}

			if ($copyright) {
				$this->rss_feed .= '<copyright>' . $this->cleanItem($copyright) . '</copyright>' . "\n";
			}

			if ($managingEditor) {
				$this->rss_feed .= '<managingEditor>' . $this->cleanItem($managingEditor) . '</managingEditor>' . "\n";
			}

			if ($webMaster) {
				$this->rss_feed .= '<webMaster>' . $this->cleanItem($webMaster) . '</webMaster>' . "\n";
			}

			if ($category) {
				$this->rss_feed .= '<category>' . $this->cleanItem($category) . '</category>' . "\n";
			}

			if ($generator) {
				$this->rss_feed .= '<generator>' . $this->cleanItem($generator) . '</generator>' . "\n";
			}

			if ($docs) {
				$this->rss_feed .= '<docs>' . $docs . '</docs>' . "\n";
			}

			if ($lastBuildDate) {
				$this->rss_feed .= '<lastBuildDate>' . $lastBuildDate . '</lastBuildDate>' . "\n";
			} else {
				$this->rss_feed .= '<lastBuildDate>' . gmstrftime("%a, %d %b %Y %T %Z", time()) . '</lastBuildDate>' . "\n";
			}

			return true;
		}

		function rssItem($title, $link, $description, $author = false, $category = false, $comments = false, $guid = false, $pubDate = false) {
			$this->rss_feed .= '<item>' . "\n";
			$this->rss_feed .= '<title>' . $this->cleanItem($title) . '</title>' . "\n";
			$this->rss_feed .= '<link>' . $this->cleanItem($link) . '</link>' . "\n";
			$this->rss_feed .= '<description>' . $this->cleanItem($description) . '</description>' . "\n";

			if ($author) {
				$this->rss_feed .= '<author>' . $this->cleanItem($author) . '</author>' . "\n";
			}

			if ($category) {
				$this->rss_feed .= '<category>' . $this->cleanItem($category) . '</category>' . "\n";
			}

			if ($comments) {
				$this->rss_feed .= '<comments>' . $this->cleanItem($comments) . '</comments>' . "\n";
			}

			if ($guid) {
				$this->rss_feed .= '<guid>' . $this->cleanItem($guid) . '</guid>' . "\n";
			}

			if ($pubDate) {
				$this->rss_feed .= '<pubDate>' . $pubDate . '</pubDate>' . "\n";
			}

			$this->rss_feed .= '</item>' . "\n";

			return true;
		}

		function rssChannelEnd() {
			$this->rss_feed .= '</channel>' . "\n";

			return true;
		}

		function rssEnd() {
			$this->rss_feed .= '</rss>' . "\n";

			return true;
		}

		function cleanItem($item) {
			// Bad HTML entities not allowed in XML
			$item = str_replace('&hellip;', '. . .', $item);
			$item = str_replace('&copy;', '(c)', $item);

			// symbols
			$item = str_replace('&amp;', '&', $item);
			$item = str_replace('&lt;', '<', $item);
			$item = str_replace('&gt;', '>', $item);

			// fix them
			$item = str_replace('&', '&amp;', $item);
			$item = str_replace('<', '&lt;', $item);
			$item = str_replace('>', '&gt;', $item);

			return $item;
		}

		function displayRSS($type = 'xml', $direct_output = true) {
			if ($direct_output) {
				if ($type == 'xml') {
					$content_type = 'xml';
				} elseif ($type == 'rss') {
					$content_type = 'rss-xml';
				} else {
					return false;
				}

				header('Content-Type: application/' . $content_type);

				echo $this->rss_feed;

				return true;
			} else {
				return $this->rss_feed;
			}
		}

  }
?>