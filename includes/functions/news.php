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
// $Id: news.php v2.110 2005-02-04 dreamscape <dechantj@pop.belmont.edu>
//
/**
 * @package News & Articles Manager functions
*/

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
  function news_date_archive($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = 1;
    $hour = 0;
    $minute = 0;
    $second = 0;

    return strftime(DATE_FORMAT_NEWS_ARCHIVE, mktime($hour,$minute,$second,$month,$day,$year));
  }

  function news_date_rss($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return gmstrftime("%a, %d %b %Y %T %Z", mktime($hour,$minute,$second,$month,$day,$year));
  }

////
// Output a raw date string in the selected locale date format
// $raw_date needs to be in this format: YYYY-MM-DD HH:MM:SS
  function news_date_time($raw_date) {
    if ( ($raw_date == '0000-00-00 00:00:00') || ($raw_date == '') ) return false;

    $year = (int)substr($raw_date, 0, 4);
    $month = (int)substr($raw_date, 5, 2);
    $day = (int)substr($raw_date, 8, 2);
    $hour = (int)substr($raw_date, 11, 2);
    $minute = (int)substr($raw_date, 14, 2);
    $second = (int)substr($raw_date, 17, 2);

    return strftime(DATE_FORMAT_NEWS, mktime($hour,$minute,$second,$month,$day,$year));
  }

////
// Creates a news summary from the regular content if the summary is blank
  function news_create_news_summary($content, $summary = false, $breaks = false, $html = true, $char_count = DISPLAY_NEWS_SUMMARY_LENGTH) {
    if (($summary) && ($summary != '')) {
      return stripslashes($summary);
    } else {
			if (($html) && ($breaks)) {
				$content = stripslashes($content);
			} elseif (($html) && (!$breaks)) {
				$content = _strip_html(stripslashes($content), array('p', 'br'), '');
			} else {
				$content = _strip_html(stripslashes($content));
			}
			
			// kill the carriage returns and tabs in the content, they're killing me!
			$content = preg_replace("/([\r\n]|[\r]|[\n]|[\t])/", " ", $content);

			// truncate content
      $content = preg_replace("/(^.{0,$char_count})(\W+.*$)/", "\${1}", $content);

      $content .= ' . . .';

      return $content;
    }
  }

////
// Strip specific HTML tags out of a string  
	function _strip_html($text, $tags = false, $replace = '') {
		if (!$tags) {
			return strip_tags($text);
		} else {
			if (!is_array($tags)) {
				$tags = array($tags);
			}

			foreach ($tags as $tag) {
				$text = preg_replace("/<[\/\!]*?" . $tag . "[^<>]*?>/si", $replace, $text);
			}

			return $text;
		}
	}

	function news_prepare_javascript_data($data) {
		$data = preg_replace('/\>\s+\</', '> <', $data);
		$data = preg_replace('/([\r\n]|[\r]|[\n])/', '', $data);
		$data = str_replace("'", "\'", $data);

		return $data;
	}

?>