<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: schinese.php 7440 2010-05-08 Jack $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

// FOLLOWING WERE moved to meta_tags.php
//define('TITLE', 'Zen Cart!');
//define('SITE_TAGLINE', 'The Art of E-commerce');
//define('CUSTOM_KEYWORDS', 'ecommerce, open source, shop, online shopping');
// END: moved to meta_tags.php

  define('FOOTER_TEXT_BODY', '版权所有 &copy; ' . date('Y') . ' <a href="' . zen_href_link(FILENAME_DEFAULT) . '" target="_blank">' . STORE_NAME . '</a>. Powered by <a href="http://www.zen-cart.cn" target="_blank">Zen Cart</a><br/>Designed by <a href="http://www.12leaves.com">12leaves.com</a>');

// look in your $PATH_LOCALE/locale directory for available locales..
// on RedHat try 'en_US'
// on FreeBSD try 'en_US.ISO_8859-1'
// on Windows try 'en', or 'English'
  setlocale(LC_TIME, 'zh_CN.UTF-8');
  define('DATE_FORMAT_SHORT', '%Y/%m/%d');  // this is used for strftime()
  define('DATE_FORMAT_LONG', ' %Y年 %m月 %d日'); // this is used for strftime()
  define('DATE_FORMAT', 'Y/m/d'); // this is used for date()
  define('DATE_TIME_FORMAT', DATE_FORMAT_SHORT . ' %H:%M:%S');

////
// Return date in raw format
// $date should be in format YYYY/mm/dd
// raw date is in format YYYYMMDD, or DDMMYYYY
  if (!function_exists('zen_date_raw')) {
    function zen_date_raw($date, $reverse = false) {
      if ($reverse) {
        return substr($date, 8, 2) . substr($date, 5, 2) . substr($date, 0, 4);
      } else {
        return substr($date, 0, 4) . substr($date, 5, 2) . substr($date, 8, 2);
      }
    }
  }


// if USE_DEFAULT_LANGUAGE_CURRENCY is true, use the following currency, instead of the applications default currency (used when changing language)
  define('LANGUAGE_CURRENCY', 'CNY');

// Global entries for the <html> tag
  define('HTML_PARAMS','dir="ltr" lang="zh"');

// charset for web pages and emails
  define('CHARSET', 'UTF-8');

// footer text in includes/footer.php
  define('FOOTER_TEXT_REQUESTS_SINCE', '浏览始于');

// Define the name of your Gift Certificate as Gift Voucher, Gift Certificate, Zen Cart Dollars, etc. here for use through out the shop
  define('TEXT_GV_NAME','礼券');
  define('TEXT_GV_NAMES','礼券');

// used for redeem code, redemption code, or redemption id
  define('TEXT_GV_REDEEM','兑现代码');

// used for redeem code sidebox
  define('BOX_HEADING_GV_REDEEM', TEXT_GV_NAME);
  define('BOX_GV_REDEEM_INFO', '兑现代码: ');

// top navigation menu text
  define('TOP_MENU_NEW_PRODUCTS', '新进商品');
  define('TOP_MENU_SPECIALS', '特价商品');
  define('TOP_MENU_VIEW_CART', '查看购物车');
  define('TOP_MENU_MY_ACCOUNT', '我的帐号');

// text for gender
  define('MALE', '先生');
  define('FEMALE', '女士');
  define('MALE_ADDRESS', '先生');
  define('FEMALE_ADDRESS', '女士');

// text for date of birth example
  define('DOB_FORMAT_STRING', 'yyyy/mm/dd');

//text for sidebox heading links
  define('BOX_HEADING_LINKS', '更多');

// categories box text in sideboxes/categories.php
  define('BOX_HEADING_CATEGORIES', '商品分类');

// manufacturers box text in sideboxes/manufacturers.php
  define('BOX_HEADING_MANUFACTURERS', '厂商列表');

// whats_new box text in sideboxes/whats_new.php
  define('BOX_HEADING_WHATS_NEW', '新进商品');
  define('CATEGORIES_BOX_HEADING_WHATS_NEW', '新进商品 ...');

  define('BOX_HEADING_FEATURED_PRODUCTS', '推荐商品');
  define('CATEGORIES_BOX_HEADING_FEATURED_PRODUCTS', '推荐商品 ...');
  define('TEXT_NO_FEATURED_PRODUCTS', '不久将会添加更多的推荐商品，请稍后再查询。');

  define('TEXT_NO_ALL_PRODUCTS', '即将推出更多商品，请稍后再查询。');
  define('CATEGORIES_BOX_HEADING_PRODUCTS_ALL', '所有商品 ...');

// quick_find box text in sideboxes/quick_find.php
  define('BOX_HEADING_SEARCH', '搜索');
  define('BOX_SEARCH_ADVANCED_SEARCH', '高级搜索');

// specials box text in sideboxes/specials.php
  define('BOX_HEADING_SPECIALS', '特价商品');
  define('CATEGORIES_BOX_HEADING_SPECIALS','特价商品 ...');

// reviews box text in sideboxes/reviews.php
  define('BOX_HEADING_REVIEWS', '商品评论');
  define('BOX_REVIEWS_WRITE_REVIEW', '发表评论');
  define('BOX_REVIEWS_NO_REVIEWS', '目前没有商品的评论');
  define('BOX_REVIEWS_TEXT_OF_5_STARS', '我对该商品的评价是%s星');

// shopping_cart box text in sideboxes/shopping_cart.php
  define('BOX_HEADING_SHOPPING_CART', '购物车');
  define('BOX_SHOPPING_CART_EMPTY', '空');
  define('BOX_SHOPPING_CART_DIVIDER', '&nbsp;-&nbsp;');

// order_history box text in sideboxes/order_history.php
  define('BOX_HEADING_CUSTOMER_ORDERS', '快速重复订单');

// best_sellers box text in sideboxes/best_sellers.php
  define('BOX_HEADING_BESTSELLERS', '畅销商品');
  define('BOX_HEADING_BESTSELLERS_IN', '畅销商品在<br />&nbsp;&nbsp;');

// notifications box text in sideboxes/products_notifications.php
  define('BOX_HEADING_NOTIFICATIONS', '商品通知');
  define('BOX_NOTIFICATIONS_NOTIFY', '如有更新请通知我<br /><strong>%s</strong>');
  define('BOX_NOTIFICATIONS_NOTIFY_REMOVE', '不用通知我任何更新 <strong>%s</strong>');

// manufacturer box text
  define('BOX_HEADING_MANUFACTURER_INFO', '厂商信息');
  define('BOX_MANUFACTURER_INFO_HOMEPAGE', '%s 的主页');
  define('BOX_MANUFACTURER_INFO_OTHER_PRODUCTS', '其它商品');

// languages box text in sideboxes/languages.php
  define('BOX_HEADING_LANGUAGES', '语言');

// currencies box text in sideboxes/currencies.php
  define('BOX_HEADING_CURRENCIES', '货币');

// information box text in sideboxes/information.php
  define('BOX_HEADING_INFORMATION', '商店信息');
  define('BOX_INFORMATION_PRIVACY', '隐私声明');
  define('BOX_INFORMATION_CONDITIONS', '顾客须知');
  define('BOX_INFORMATION_SHIPPING', '发货付款');
  define('BOX_INFORMATION_CONTACT', '联系我们');
  define('BOX_BBINDEX', '论坛');
  define('BOX_INFORMATION_UNSUBSCRIBE', '电子商情');

  define('BOX_INFORMATION_SITE_MAP', '网站地图');

// information box text in sideboxes/more_information.php - were TUTORIAL_
  define('BOX_HEADING_MORE_INFORMATION', '更多信息');
  define('BOX_INFORMATION_PAGE_2', '第二页');
  define('BOX_INFORMATION_PAGE_3', '第三页');
  define('BOX_INFORMATION_PAGE_4', '第四页');

// tell a friend box text in sideboxes/tell_a_friend.php
  define('BOX_HEADING_TELL_A_FRIEND', '推荐给朋友');
  define('BOX_TELL_A_FRIEND_TEXT', '推荐该商品给朋友。');

// wishlist box text in includes/boxes/wishlist.php
  define('BOX_HEADING_CUSTOMER_WISHLIST', '我的购物单');
  define('BOX_WISHLIST_EMPTY', '您的购物单上没有物品');
  define('IMAGE_BUTTON_ADD_WISHLIST', '添加到购物单');
  define('TEXT_WISHLIST_COUNT', '目前有%s件物品在您的购物单上。');
  define('TEXT_DISPLAY_NUMBER_OF_WISHLIST', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>件物品在您的购物单上)');

//New billing address text
  define('SET_AS_PRIMARY' , '设为主要地址');
  define('NEW_ADDRESS_TITLE', '帐单地址');

// javascript messages
  define('JS_ERROR', '在处理您的表格过程中出错.\n\n请做以下修改:\n\n');

  define('JS_REVIEW_TEXT', '* 请多写些内容。评论字数不能少于' . REVIEW_TEXT_MIN_LENGTH . '个字符。');
  define('JS_REVIEW_RATING', '* 请对商品评级。');

  define('JS_ERROR_NO_PAYMENT_MODULE_SELECTED', '* 请选择支付方式。');

  define('JS_ERROR_SUBMITTED', '这个表格已经递交，请按确定并等待处理完成。');

  define('ERROR_NO_PAYMENT_MODULE_SELECTED', '请选择支付方式。');
  define('ERROR_CONDITIONS_NOT_ACCEPTED', '请点击以下方框以接受该订单的相应条款。');
  define('ERROR_PRIVACY_STATEMENT_NOT_ACCEPTED', '请点击以下方框以接受隐私声明。');

  define('CATEGORY_COMPANY', '公司资料');
  define('CATEGORY_PERSONAL', '个人资料');
  define('CATEGORY_ADDRESS', '地址');
  define('CATEGORY_CONTACT', '联系方式');
  define('CATEGORY_OPTIONS', '选项');
  define('CATEGORY_PASSWORD', '密码');
  define('CATEGORY_LOGIN', '登录');
  define('PULL_DOWN_DEFAULT', '请选择国家或地区');
  define('PLEASE_SELECT', '请选择 ...');
  define('TYPE_BELOW', '请在下面输入 ...');

  define('ENTRY_COMPANY', '公司名称：');
  define('ENTRY_COMPANY_ERROR', '请输入公司名称。');
  define('ENTRY_COMPANY_TEXT', '');
  define('ENTRY_GENDER', '称呼：');
  define('ENTRY_GENDER_ERROR', '请选择称呼。');
  define('ENTRY_GENDER_TEXT', '*');
  define('ENTRY_FIRST_NAME', '名字：');
  define('ENTRY_FIRST_NAME_ERROR', '名字输入正确吗？本系统要求名字不能少于' . ENTRY_FIRST_NAME_MIN_LENGTH . '个字符。');
  define('ENTRY_FIRST_NAME_TEXT', '*');
  define('ENTRY_LAST_NAME', '姓氏：');
  define('ENTRY_LAST_NAME_ERROR', '姓氏输入正确吗？本系统要求姓氏不能少于' . ENTRY_LAST_NAME_MIN_LENGTH . '个字符。');
  define('ENTRY_LAST_NAME_TEXT', '*');
  define('ENTRY_DATE_OF_BIRTH', '出生日期：');
  define('ENTRY_DATE_OF_BIRTH_ERROR', '出生日期输入正确吗？本系统要求出生日期的格式为:年/月/日 (例如 1970/05/21)');
  define('ENTRY_DATE_OF_BIRTH_TEXT', '* 例如 1970/05/21');
  define('ENTRY_EMAIL_ADDRESS', '电子邮件：');
  define('ENTRY_EMAIL_ADDRESS_ERROR', '电子邮件地址不能少于' . ENTRY_EMAIL_ADDRESS_MIN_LENGTH . '个字符。');
  define('ENTRY_EMAIL_ADDRESS_CHECK_ERROR', '电子邮件地址不正确。 - 请做必要的修改。');
  define('ENTRY_EMAIL_ADDRESS_ERROR_EXISTS', '电子邮件地址已经在我们的数据库中。请用该电子邮件地址登录，然后可以在我的帐号中修改邮件地址。');
  define('ENTRY_EMAIL_ADDRESS_TEXT', '*');
  define('ENTRY_NICK', '论坛昵称：');
  define('ENTRY_NICK_TEXT', '*'); // note to display beside nickname input field
  define('ENTRY_NICK_DUPLICATE_ERROR', '该昵称已经存在。');
  define('ENTRY_NICK_LENGTH_ERROR', '昵称不能少于' . ENTRY_NICK_MIN_LENGTH . '个字符。');
  define('ENTRY_STREET_ADDRESS', '详细地址：');
  define('ENTRY_STREET_ADDRESS_ERROR', '详细地址不能少于' . ENTRY_STREET_ADDRESS_MIN_LENGTH . '个字符。');
  define('ENTRY_STREET_ADDRESS_TEXT', '*');
  define('ENTRY_SUBURB', '');
  define('ENTRY_SUBURB_ERROR', '');
  define('ENTRY_SUBURB_TEXT', '');
  define('ENTRY_POST_CODE', '邮编：');
  define('ENTRY_POST_CODE_ERROR', '邮编不能少于' . ENTRY_POSTCODE_MIN_LENGTH . '个字符。');
  define('ENTRY_POST_CODE_TEXT', '*');
  define('ENTRY_CITY', '城市：');
  define('ENTRY_CUSTOMERS_REFERRAL', '推荐人代码：');

  define('ENTRY_CITY_ERROR', '城市不能少于' . ENTRY_CITY_MIN_LENGTH . '个字符。');
  define('ENTRY_CITY_TEXT', '*');
  define('ENTRY_STATE', '省份：');
  define('ENTRY_STATE_ERROR', '省份不能少于' . ENTRY_STATE_MIN_LENGTH . '个字符。');
  define('ENTRY_STATE_ERROR_SELECT', '请在下拉菜单中选择省份。');
  define('ENTRY_STATE_TEXT', '*');
  define('JS_STATE_SELECT', '-- 请选择 --');
  define('ENTRY_COUNTRY', '国家或地区：');
  define('ENTRY_COUNTRY_ERROR', '请在下拉菜单中选择国家或地区。');
  define('ENTRY_COUNTRY_TEXT', '*');
  define('ENTRY_TELEPHONE_NUMBER', '电话：');
  define('ENTRY_TELEPHONE_NUMBER_ERROR', '电话号码不能少于' . ENTRY_TELEPHONE_MIN_LENGTH . '个字符。');
  define('ENTRY_TELEPHONE_NUMBER_TEXT', '*');
  define('ENTRY_FAX_NUMBER', '传真：');
  define('ENTRY_FAX_NUMBER_ERROR', '');
  define('ENTRY_FAX_NUMBER_TEXT', '');
  define('ENTRY_NEWSLETTER', '电子商情：');
  define('ENTRY_NEWSLETTER_TEXT', '');
  define('ENTRY_NEWSLETTER_YES', '订阅');
  define('ENTRY_NEWSLETTER_NO', '退订');
  define('ENTRY_NEWSLETTER_ERROR', '');
  define('ENTRY_PASSWORD', '密码：');
  define('ENTRY_PASSWORD_ERROR', '密码不能少于' . ENTRY_PASSWORD_MIN_LENGTH . '个字符。');
  define('ENTRY_PASSWORD_ERROR_NOT_MATCHING', '两次输入的密码必须一致。');
  define('ENTRY_PASSWORD_TEXT', '* (至少' . ENTRY_PASSWORD_MIN_LENGTH . '个字符)');
  define('ENTRY_PASSWORD_CONFIRMATION', '确认密码：');
  define('ENTRY_PASSWORD_CONFIRMATION_TEXT', '*');
  define('ENTRY_PASSWORD_CURRENT', '当前密码：');
  define('ENTRY_PASSWORD_CURRENT_TEXT', '*');
  define('ENTRY_PASSWORD_CURRENT_ERROR', '密码不能少于' . ENTRY_PASSWORD_MIN_LENGTH . '个字符。');
  define('ENTRY_PASSWORD_NEW', '新密码：');
  define('ENTRY_PASSWORD_NEW_TEXT', '*');
  define('ENTRY_PASSWORD_NEW_ERROR', '新密码不能少于' . ENTRY_PASSWORD_MIN_LENGTH . '个字符。');
  define('ENTRY_PASSWORD_NEW_ERROR_NOT_MATCHING', '两次输入的密码必须一致。');
  define('PASSWORD_HIDDEN', '--隐藏--');

  define('FORM_REQUIRED_INFORMATION', '* 必填信息');
  define('ENTRY_REQUIRED_SYMBOL', '*');

// constants for use in zen_prev_next_display function
  define('TEXT_RESULT_PAGE', '');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>件商品)');
  define('TEXT_DISPLAY_NUMBER_OF_ORDERS', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>笔订单)');
  define('TEXT_DISPLAY_NUMBER_OF_REVIEWS', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>条评论)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_NEW', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>件新进商品)');
  define('TEXT_DISPLAY_NUMBER_OF_SPECIALS', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>件特价商品)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_FEATURED_PRODUCTS', '显示<strong>%d</strong>至<strong>%d</strong> (共 <strong>%d</strong>件推荐商品)');
  define('TEXT_DISPLAY_NUMBER_OF_PRODUCTS_ALL', '显示<strong>%d</strong>至<strong>%d</strong> (共<strong>%d</strong>件商品)');

  define('PREVNEXT_TITLE_FIRST_PAGE', '第一页');
  define('PREVNEXT_TITLE_PREVIOUS_PAGE', '前一页');
  define('PREVNEXT_TITLE_NEXT_PAGE', '下一页');
  define('PREVNEXT_TITLE_LAST_PAGE', '最后一页');
  define('PREVNEXT_TITLE_PAGE_NO', '第 %d 页');
  define('PREVNEXT_TITLE_PREV_SET_OF_NO_PAGE', '前 %d 页');
  define('PREVNEXT_TITLE_NEXT_SET_OF_NO_PAGE', '后 %d 页');
  define('PREVNEXT_BUTTON_FIRST', '&lt;&lt;最前');
  define('PREVNEXT_BUTTON_PREV', '[&lt;&lt;&nbsp;上一页]');
  define('PREVNEXT_BUTTON_NEXT', '[下一页&nbsp;&gt;&gt;]');
  define('PREVNEXT_BUTTON_LAST', '最后&gt;&gt;');

  define('TEXT_BASE_PRICE','价格:');

  define('TEXT_CLICK_TO_ENLARGE', '放大图像');

  define('TEXT_SORT_PRODUCTS', '商品排序 ');
  define('TEXT_DESCENDINGLY', '降序');
  define('TEXT_ASCENDINGLY', '升序');
  define('TEXT_BY', ' 排序字段 ');

  define('TEXT_REVIEW_BY', '评论人: %s');
  define('TEXT_REVIEW_WORD_COUNT', '%s 字');
  define('TEXT_REVIEW_RATING', '评价: %s [%s]');
  define('TEXT_REVIEW_DATE_ADDED', '评论日期: %s');
  define('TEXT_NO_REVIEWS', '该商品目前没有评论。');

  define('TEXT_NO_NEW_PRODUCTS', '不久将会添加更多的新商品，请稍后再光临。');

  define('TEXT_UNKNOWN_TAX_RATE', '销售税');

  define('TEXT_REQUIRED', '<span class="errorText">必填</span>');

  define('WARNING_INSTALL_DIRECTORY_EXISTS', '警告: 安装目录存在: %s，为了安全请删除该目录。');
  define('WARNING_CONFIG_FILE_WRITEABLE', '警告: 配置文件允许写入: %s，存在安全隐患 - 请设置正确的权限(通常设置为只读、CHMOD 644 或 444)。有些主机必须通过主机的控制面板修改文件权限，请咨询主机商。');
  define('ERROR_FILE_NOT_REMOVEABLE', '错误: 无法删除指定文件。由于主机权限设置的原因，可能要通过FTP来删除。');
  define('WARNING_SESSION_DIRECTORY_NON_EXISTENT', '警告: 该Session目录不存在：' . zen_session_save_path() . '。只有建立目录，Session才能工作。');
  define('WARNING_SESSION_DIRECTORY_NOT_WRITEABLE', '警告: 无法写入Session目录：' . zen_session_save_path() . '。请设置正确的权限，Session才能工作。');
  define('WARNING_SESSION_AUTO_START', '警告: session.auto_start已打开 - 请在php.ini中关闭该PHP功能，然后重新打＝开网站服务器。');
  define('WARNING_DOWNLOAD_DIRECTORY_NON_EXISTENT', '警告: 可下载商品目录不存在：' . DIR_FS_DOWNLOAD . '。除非该目录有效,可下载商品才能工作。');
  define('WARNING_SQL_CACHE_DIRECTORY_NON_EXISTENT', '警告: SQL缓存目录不存在：' . DIR_FS_SQL_CACHE . '。除非该目录已建成,SQL缓冲才能工作。');
  define('WARNING_SQL_CACHE_DIRECTORY_NOT_WRITEABLE', '警告: 无法写入SQL缓存目录：' . DIR_FS_SQL_CACHE . '。除非设置正确的使用权限,SQL缓冲才能工作。');
  define('WARNING_DATABASE_VERSION_OUT_OF_DATE','您的数据库需要升级。在 管理页面->工具->服务器/版本信息 中查看当前版本。');
  define('WARNING_COULD_NOT_LOCATE_LANG_FILE', '警告: 找不到语言文件: ');

  define('TEXT_CCVAL_ERROR_INVALID_DATE', '输入的信用卡有效期不正确。请检查日期再试。');
  define('TEXT_CCVAL_ERROR_INVALID_NUMBER', '输入的信用卡号不正确。请检查卡号再试。');
  define('TEXT_CCVAL_ERROR_UNKNOWN_CARD', '输入的以%s开头的信用卡号码不正确，或者是我们无法接受此类信用卡。请再试一次或使用另外一个信用卡。');

  define('BOX_INFORMATION_DISCOUNT_COUPONS', '优惠券查询');
  define('BOX_INFORMATION_GV', TEXT_GV_NAME . '问答');
  define('VOUCHER_BALANCE', TEXT_GV_NAME . '余额 ');
  define('BOX_HEADING_GIFT_VOUCHER', TEXT_GV_NAME . '帐号');
  define('GV_FAQ', TEXT_GV_NAME . '问答');
  define('ERROR_REDEEMED_AMOUNT', '恭喜, 您已兑现');
  define('ERROR_NO_REDEEM_CODE', '您没有输入' . TEXT_GV_REDEEM . '。');
  define('ERROR_NO_INVALID_REDEEM_GV', '无效' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM);
  define('TABLE_HEADING_CREDIT', '可用信用额');
  define('GV_HAS_VOUCHERA', '在您的' . TEXT_GV_NAME . '帐号里有资金。如果需要<br />
                          您可以传送资金，通过<a class="pageResults" href="');

  define('GV_HAS_VOUCHERB', '"><strong>发邮件</strong></a>给别人');
  define('ENTRY_AMOUNT_CHECK_ERROR', '您的资金不够传送该金额。');
  define('BOX_SEND_TO_FRIEND', '发送' . TEXT_GV_NAME . ' ');

  define('VOUCHER_REDEEMED',  TEXT_GV_NAME . '兑现');
  define('CART_COUPON', '优惠券：');
  define('CART_COUPON_INFO', '更多信息');
  define('TEXT_SEND_OR_SPEND','您的' . TEXT_GV_NAME . '帐号中还有余额。您可以自己使用或发送给朋友。要发送请点击下面的按钮。');
  define('TEXT_BALANCE_IS', '您的' . TEXT_GV_NAME . '余额为: ');
  define('TEXT_AVAILABLE_BALANCE', '您的' . TEXT_GV_NAME . '帐号');

// payment method is GV/Discount
  define('PAYMENT_METHOD_GV', '礼券/优惠券');
  define('PAYMENT_MODULE_GV', '礼券/优惠券');

  define('TABLE_HEADING_CREDIT_PAYMENT', '可用信用额');

  define('TEXT_INVALID_REDEEM_COUPON', '优惠券代码无效');
  define('TEXT_INVALID_REDEEM_COUPON_MINIMUM', '使用该优惠券要求订单金额不小于%s');
  define('TEXT_INVALID_STARTDATE_COUPON', '该优惠券还未生效');
  define('TEXT_INVALID_FINISHDATE_COUPON', '该优惠券已过期');
  define('TEXT_INVALID_USES_COUPON', '该优惠券只能使用');
  define('TIMES', '次。');
  define('TIME', '次。');
  define('TEXT_INVALID_USES_USER_COUPON', '您使用的优惠券代码为：%s，已超过每个客户允许使用的最多次数。');
  define('REDEEMED_COUPON', '每张优惠券价值 ');
  define('REDEEMED_MIN_ORDER', '最小订单额');
  define('REDEEMED_RESTRICTIONS', ' [在指定商品目录中适用]');
  define('TEXT_ERROR', '出错了');
  define('TEXT_INVALID_COUPON_PRODUCT', '该优惠券代码不适用于您购物车中的任何商品。');
  define('TEXT_VALID_COUPON', '恭喜您兑现了优惠券');
  define('TEXT_REMOVE_REDEEM_COUPON_ZONE', '输入的优惠券不适用您选择的地区。');

// more info in place of buy now
  define('MORE_INFO_TEXT','... 更多信息');

// IP Address
  define('TEXT_YOUR_IP_ADDRESS','您的IP地址是：');

//Generic Address Heading
  define('HEADING_ADDRESS_INFORMATION','地址信息');

// cart contents
  define('PRODUCTS_ORDER_QTY_TEXT_IN_CART','购物车内的数量：');
  define('PRODUCTS_ORDER_QTY_TEXT','购买数量：');

// success messages for added to cart when display cart is off
// set to blank for no messages
// for all pages except where multiple add to cart is used:
  define('SUCCESS_ADDED_TO_CART_PRODUCT', '成功添加商品到购物车 ...');
// only for where multiple add to cart is used:
  define('SUCCESS_ADDED_TO_CART_PRODUCTS', '成功添加选择的商品到购物车 ...');

  define('TEXT_PRODUCT_WEIGHT_UNIT','克');

// Shipping
  define('TEXT_SHIPPING_WEIGHT','克');
  define('TEXT_SHIPPING_BOXES', '箱');

// Discount Savings
  define('PRODUCT_PRICE_DISCOUNT_PREFIX','节省:&nbsp;');
  define('PRODUCT_PRICE_DISCOUNT_PERCENTAGE','% ');
  define('PRODUCT_PRICE_DISCOUNT_AMOUNT','&nbsp;');

// Sale Maker Sale Price
  define('PRODUCT_PRICE_SALE','售价:&nbsp;');

//universal symbols
  define('TEXT_NUMBER_SYMBOL', '# ');

// banner_box
  define('BOX_HEADING_BANNER_BOX','赞助商');
  define('TEXT_BANNER_BOX','请访问我们的赞助商...');

// banner box 2
  define('BOX_HEADING_BANNER_BOX2','您知道吗 ...');
  define('TEXT_BANNER_BOX2','马上去看看!');

// banner_box - all
  define('BOX_HEADING_BANNER_BOX_ALL','赞助商');
  define('TEXT_BANNER_BOX_ALL','请访问我们的赞助商 ...');

// boxes defines
  define('PULL_DOWN_ALL','请选择');
  define('PULL_DOWN_MANUFACTURERS','- 重置 -');
// shipping estimator
  define('PULL_DOWN_SHIPPING_ESTIMATOR_SELECT', '请选择');

// general Sort By
  define('TEXT_INFO_SORT_BY','排序：');

// close window image popups
  define('TEXT_CLOSE_WINDOW',' - 点击图像关闭');
// close popups
  define('TEXT_CURRENT_CLOSE_WINDOW','[ 关闭窗口 ]');

// iii 031104 added:  File upload error strings
  define('ERROR_FILETYPE_NOT_ALLOWED', '错误: 文件类型不允许。');
  define('WARNING_NO_FILE_UPLOADED', '警告: 没有文件上传。');
  define('SUCCESS_FILE_SAVED_SUCCESSFULLY', '成功: 文件存盘完成。');
  define('ERROR_FILE_NOT_SAVED', '错误: 文件未存盘。');
  define('ERROR_DESTINATION_NOT_WRITEABLE', '错误: 目标位置不可写入。');
  define('ERROR_DESTINATION_DOES_NOT_EXIST', '错误: 目标位置不存在。');
  define('ERROR_FILE_TOO_BIG', '警告: 文件太大，无法上传!<br />可以继续订单但请联系店主上传文件');
// End iii added

  define('TEXT_BEFORE_DOWN_FOR_MAINTENANCE', '通知: 网站维护, 预计关闭时间(日/月/年) (hh-hh)：');
  define('TEXT_ADMIN_DOWN_FOR_MAINTENANCE', '通知: 网站目前在维护中，对外关闭');

  define('PRODUCTS_PRICE_IS_FREE_TEXT','免费品!');
  define('PRODUCTS_PRICE_IS_CALL_FOR_PRICE_TEXT','价格面议');
  define('TEXT_CALL_FOR_PRICE','价格面议');

  define('TEXT_INVALID_SELECTION',' 您的选择无效：');
  define('TEXT_ERROR_OPTION_FOR',' 选项：');
  define('TEXT_INVALID_USER_INPUT', '要求用户输入<br />');

// product_listing
  define('PRODUCTS_QUANTITY_MIN_TEXT_LISTING','最少: ');
  define('PRODUCTS_QUANTITY_UNIT_TEXT_LISTING','单位: ');
  define('PRODUCTS_QUANTITY_IN_CART_LISTING','购物车内: ');
  define('PRODUCTS_QUANTITY_ADD_ADDITIONAL_LISTING','另外添加: ');

  define('PRODUCTS_QUANTITY_MAX_TEXT_LISTING','最多:');

  define('TEXT_PRODUCTS_MIX_OFF','*不允许混合');
  define('TEXT_PRODUCTS_MIX_ON','*允许混合');

  define('TEXT_PRODUCTS_MIX_OFF_SHOPPING_CART','<br />*本商品不能混合选项以满足最低数量要求*<br />');
  define('TEXT_PRODUCTS_MIX_ON_SHOPPING_CART','*混合选项开启<br />');

  define('ERROR_MAXIMUM_QTY','添加到购物车的商品数量已调整，因为超过最多购买数量，见商品: ');
  define('ERROR_CORRECTIONS_HEADING','请在下面修改: <br />');
  define('ERROR_QUANTITY_ADJUSTED', '添加到购物车的商品数量已调整，您需要的商品不零卖，商品数量: ');
  define('ERROR_QUANTITY_CHANGED_FROM', '，原数量: ');
  define('ERROR_QUANTITY_CHANGED_TO', ' 改为 ');

// Downloads Controller
  define('DOWNLOADS_CONTROLLER_ON_HOLD_MSG','注意: 只有付款确认后才可以下载');
  define('TEXT_FILESIZE_BYTES', ' 字节');
  define('TEXT_FILESIZE_MEGS', ' 兆');

// shopping cart errors
  define('ERROR_PRODUCT','商品：');
  define('ERROR_PRODUCT_STATUS_SHOPPING_CART','<br />很抱歉该商品已经不在数据库中。<br />该商品已经从购物车中删除。');
  define('ERROR_PRODUCT_QUANTITY_MIN','，... 最少购买数量错误 - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS',' ... 购买数量单位错误 - ');
  define('ERROR_PRODUCT_OPTION_SELECTION','<br /> ... 选择了无效的选项 ');
  define('ERROR_PRODUCT_QUANTITY_ORDERED','<br /> 您的订单总额是：');
  define('ERROR_PRODUCT_QUANTITY_MAX',' ... 最多购买数量错误 - ');
  define('ERROR_PRODUCT_QUANTITY_MIN_SHOPPING_CART','，有最少购买数量限制 - ');
  define('ERROR_PRODUCT_QUANTITY_UNITS_SHOPPING_CART',' ... 购买数量单位错误 - ');
  define('ERROR_PRODUCT_QUANTITY_MAX_SHOPPING_CART',' ... 最多购买数量错误 - ');

  define('WARNING_SHOPPING_CART_COMBINED', '提示: 为了方便购物，您当前购物车中的商品与您以前购物车中的商品合并了，结帐前请查看您的购物车。');

// error on checkout when $_SESSION['customers_id' does not exist in customers table
  define('ERROR_CUSTOMERS_ID_INVALID', '无法核对客户信息!<br />请登录或重新注册 ...');

  define('TABLE_HEADING_FEATURED_PRODUCTS','推荐商品');

  define('TABLE_HEADING_NEW_PRODUCTS', '%s新进商品');
  define('TABLE_HEADING_UPCOMING_PRODUCTS', '预售商品');
  define('TABLE_HEADING_DATE_EXPECTED', '预售日期');
  define('TABLE_HEADING_SPECIALS_INDEX', '%s特价商品');

  define('CAPTION_UPCOMING_PRODUCTS','这些商品很快会到货');
  define('SUMMARY_TABLE_UPCOMING_PRODUCTS','以下是预售商品清单以及预计到货时间');

// meta tags special defines
  define('META_TAG_PRODUCTS_PRICE_IS_FREE_TEXT','免费!');

// customer login
  define('TEXT_SHOWCASE_ONLY','与我们联系');
// set for login for prices
  define('TEXT_LOGIN_FOR_PRICE_PRICE','登录查看价格');
  define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE','请登录后查询价格');
// set for show room only
  define('TEXT_LOGIN_FOR_PRICE_PRICE_SHOWROOM', ''); // 在价格处留白或输入您自己的文本
  define('TEXT_LOGIN_FOR_PRICE_BUTTON_REPLACE_SHOWROOM','仅限展示');

// authorization pending
  define('TEXT_AUTHORIZATION_PENDING_PRICE', '审核后显示价格');
  define('TEXT_AUTHORIZATION_PENDING_BUTTON_REPLACE', '审核等待中');
  define('TEXT_LOGIN_TO_SHOP_BUTTON_REPLACE','登录购物');

// text pricing
  define('TEXT_CHARGES_WORD','计算出的费用：');
  define('TEXT_PER_WORD','<br />每个单词价格：');
  define('TEXT_WORDS_FREE',' 免费单词 ');
  define('TEXT_CHARGES_LETTERS','计算出的费用：');
  define('TEXT_PER_LETTER','<br />每个字的价格：');
  define('TEXT_LETTERS_FREE',' 免费字');
  define('TEXT_ONETIME_CHARGES','*基本费 = ');
  define('TEXT_ONETIME_CHARGES_EMAIL',"\t" . '*基本费 = ');
  define('TEXT_ATTRIBUTES_QTY_PRICES_HELP', '选项批量优惠');
  define('TABLE_ATTRIBUTES_QTY_PRICE_QTY','数量');
  define('TABLE_ATTRIBUTES_QTY_PRICE_PRICE','价格');
  define('TEXT_ATTRIBUTES_QTY_PRICES_ONETIME_HELP', '批量优惠基本费');

// textarea attribute input fields
  define('TEXT_MAXIMUM_CHARACTERS_ALLOWED','允许的最多字符');
  define('TEXT_REMAINING','剩余');

// Shipping Estimator
  define('CART_SHIPPING_OPTIONS', '运费估价：');
  define('CART_SHIPPING_OPTIONS_LOGIN', '请 <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">登录</span></a>后查看运费。');
  define('CART_SHIPPING_METHOD_TEXT','可选的配送方式：');
  define('CART_SHIPPING_METHOD_RATES','费率：');
  define('CART_SHIPPING_METHOD_TO','送货地址：');
  define('CART_SHIPPING_METHOD_TO_NOLOGIN', '送货地址: <a href="' . zen_href_link(FILENAME_LOGIN, '', 'SSL') . '"><span class="pseudolink">登录</span></a>');
  define('CART_SHIPPING_METHOD_FREE_TEXT','免费运输');
  define('CART_SHIPPING_METHOD_ALL_DOWNLOADS','- 下载');
  define('CART_SHIPPING_METHOD_RECALCULATE','重新计算');
  define('CART_SHIPPING_METHOD_ZIP_REQUIRED','true');
  define('CART_SHIPPING_METHOD_ADDRESS','地址：');
  define('CART_OT','总费用估计：');
  define('CART_OT_SHOW','是'); // set to false if you don't want order totals
  define('CART_ITEMS','已选商品数: ');
  define('CART_SELECT','选择');
  define('ERROR_CART_UPDATE', '<strong>请更新您的订单。</strong>');
  define('IMAGE_BUTTON_UPDATE_CART', '更新');
  define('EMPTY_CART_TEXT_NO_QUOTE', '噢! 您的连接超时了 ... 请更新购物车 ...');
  define('CART_SHIPPING_QUOTE_CRITERIA', '运费报价基于您选择的地址:');

// multiple product add to cart
  define('TEXT_PRODUCT_LISTING_MULTIPLE_ADD_TO_CART', '添加：');
  define('TEXT_PRODUCT_ALL_LISTING_MULTIPLE_ADD_TO_CART', '添加：');
  define('TEXT_PRODUCT_FEATURED_LISTING_MULTIPLE_ADD_TO_CART', '添加：');
  define('TEXT_PRODUCT_NEW_LISTING_MULTIPLE_ADD_TO_CART', '添加：');
  //moved SUBMIT_BUTTON_ADD_PRODUCTS_TO_CART to button_names.php as BUTTON_ADD_PRODUCTS_TO_CART_ALT

// discount qty table
  define('TEXT_HEADER_DISCOUNT_PRICES_PERCENTAGE', '批量优惠');
  define('TEXT_HEADER_DISCOUNT_PRICES_ACTUAL_PRICE', '批量优惠后的新价格');
  define('TEXT_HEADER_DISCOUNT_PRICES_AMOUNT_OFF', '批量优惠');
  define('TEXT_FOOTER_DISCOUNT_QUANTITIES', '* 基于以上选项,优惠也许会有不同');
  define('TEXT_HEADER_DISCOUNTS_OFF', '不提供批量优惠 ...');

// sort order titles for dropdowns
  define('PULL_DOWN_ALL_RESET','- 重置 - ');
  define('TEXT_INFO_SORT_BY_PRODUCTS_NAME', '名称升序');
  define('TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC', '名称降序');
  define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE', '价格从低到高');
  define('TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC', '价格从高到低');
  define('TEXT_INFO_SORT_BY_PRODUCTS_MODEL', '型号');
  define('TEXT_INFO_SORT_BY_PRODUCTS_DATE_DESC', '上架日期先新后旧');
  define('TEXT_INFO_SORT_BY_PRODUCTS_DATE', '上架日期先旧后新');
  define('TEXT_INFO_SORT_BY_PRODUCTS_SORT_ORDER', '默认显示');

// downloads module defines
  define('TABLE_HEADING_DOWNLOAD_DATE', '链接有效期');
  define('TABLE_HEADING_DOWNLOAD_COUNT', '剩余');
  define('HEADING_DOWNLOAD', '要下载您的文件，请点击下载按钮并在弹出窗口中选择“保存到磁盘”。');
  define('TABLE_HEADING_DOWNLOAD_FILENAME','文件名');
  define('TABLE_HEADING_PRODUCT_NAME','项目名称');
  define('TABLE_HEADING_BYTE_SIZE','文件大小');
  define('TEXT_DOWNLOADS_UNLIMITED', '无限');
  define('TEXT_DOWNLOADS_UNLIMITED_COUNT', '--- *** ---');

// misc
  define('COLON_SPACER', ':&nbsp;&nbsp;');

// table headings for cart display and upcoming products
  define('TABLE_HEADING_QUANTITY', '数量');
  define('TABLE_HEADING_PRODUCTS', '商品名称');
  define('TABLE_HEADING_TOTAL', '总额');

// create account - login shared
  define('TABLE_HEADING_PRIVACY_CONDITIONS', '隐私声明');
  define('TEXT_PRIVACY_CONDITIONS_DESCRIPTION', '请点击下面的方框表明您同意我们的隐私声明。该隐私声明在<a href="' . zen_href_link(FILENAME_PRIVACY, '', 'SSL') . '"><span class="pseudolink">这里</span></a>.');
  define('TEXT_PRIVACY_CONDITIONS_CONFIRM', '我已经阅读并同意该隐私声明。');
  define('TABLE_HEADING_ADDRESS_DETAILS', '详细地址');
  define('TABLE_HEADING_PHONE_FAX_DETAILS', '联系资料');
  define('TABLE_HEADING_DATE_OF_BIRTH', '个人资料');
  define('TABLE_HEADING_LOGIN_DETAILS', '登录资料');
  define('TABLE_HEADING_REFERRAL_DETAILS', '有人介绍您到我们的商店吗?');

  define('ENTRY_EMAIL_PREFERENCE','电子商情和邮件格式');
  define('ENTRY_EMAIL_HTML_DISPLAY','HTML');
  define('ENTRY_EMAIL_TEXT_DISPLAY','文本');
  define('EMAIL_SEND_FAILED','错误: 无法发送电子邮件到: "%s" <%s> 标题为: "%s"');

  define('DB_ERROR_NOT_CONNECTED', '错误 - 无法连接到数据库');

// EZ-PAGES Alerts
  define('TEXT_EZPAGES_STATUS_HEADER_ADMIN', '警告: 简易页面页眉 - On 仅限管理员IP');
  define('TEXT_EZPAGES_STATUS_FOOTER_ADMIN', '警告: 简易页面页脚 - On 仅限管理员IP');
  define('TEXT_EZPAGES_STATUS_SIDEBOX_ADMIN', '警告: 简易页面边框 - On 仅限管理员IP');

// extra product listing sorter
  define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER', '');
  define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES', '首字母为 ...');
  define('TEXT_PRODUCTS_LISTING_ALPHA_SORTER_NAMES_RESET', '-- 重置 --');

///////////////////////////////////////////////////////////
// include email extras
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_EMAIL_EXTRAS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_EMAIL_EXTRAS);

// include template specific header defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_HEADER)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_HEADER);

// include template specific button name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_BUTTON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_BUTTON_NAMES);

// include template specific icon name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_ICON_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_ICON_NAMES);

// include template specific other image name defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_OTHER_IMAGES_NAMES)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_OTHER_IMAGES_NAMES);

// credit cards
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_CREDIT_CARDS)) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select. FILENAME_CREDIT_CARDS);

// include template specific whos_online sidebox defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/' . FILENAME_WHOS_ONLINE . '.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . FILENAME_WHOS_ONLINE . '.php');

// include template specific meta tags defines
  if (file_exists(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir . '/meta_tags.php')) {
    $template_dir_select = $template_dir . '/';
  } else {
    $template_dir_select = '';
  }
  require_once(DIR_WS_LANGUAGES . $_SESSION['language'] . '/' . $template_dir_select . 'meta_tags.php');

// END OF EXTERNAL LANGUAGE LINKS
