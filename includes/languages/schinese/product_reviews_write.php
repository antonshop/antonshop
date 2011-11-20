<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
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
// | Simplified Chinese version   http://www.zen-cart.cn                  |
// +----------------------------------------------------------------------+
// $Id: product_reviews_write.php 1369 2005-05-14 01:17:19Z drbyte $
//

define('NAVBAR_TITLE', '商品评论');

define('SUB_TITLE_FROM', '评论人:');
define('SUB_TITLE_REVIEW', '请与大家分享您的看法，仅限与产品有关的内容。');
define('SUB_TITLE_RATING', '请评价本商品，五颗星代表最好。');

define('TEXT_NO_HTML', '<strong>提示:</strong> 不能使用HTML标签');
define('TEXT_BAD', '最差');
define('TEXT_GOOD', '最好');
define('TEXT_PRODUCT_INFO', '');

define('TEXT_APPROVAL_REQUIRED', '<strong>提示:</strong> 评论经审核后才显示');

define('EMAIL_REVIEW_PENDING_SUBJECT','等待审核的评论: %s');
define('EMAIL_PRODUCT_REVIEW_CONTENT_INTRO','商品%s有一个评论，正等待您的审核。'."\n\n");
define('EMAIL_PRODUCT_REVIEW_CONTENT_DETAILS','评论内容: %s');

?>