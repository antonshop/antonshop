<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: ot_gv.php 6099 2007-04-01 10:22:42Z wilt $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

  define('MODULE_ORDER_TOTAL_GV_TITLE', TEXT_GV_NAMES);
  define('MODULE_ORDER_TOTAL_GV_HEADER', TEXT_GV_NAMES . '/优惠券');
  define('MODULE_ORDER_TOTAL_GV_DESCRIPTION', TEXT_GV_NAMES);
  define('SHIPPING_NOT_INCLUDED', ' [不含运费]');
  define('TAX_NOT_INCLUDED', ' [不含税]');
  define('MODULE_ORDER_TOTAL_GV_USER_PROMPT', '使用金额: ');
  define('MODULE_ORDER_TOTAL_GV_TEXT_ENTER_CODE', TEXT_GV_REDEEM);
  define('TEXT_INVALID_REDEEM_AMOUNT', '使用的金额与礼券余额不匹配，请再试一次。');
  define('MODULE_ORDER_TOTAL_GV_USER_BALANCE', '可用余额: ');
  define('MODULE_ORDER_TOTAL_GV_REDEEM_INSTRUCTIONS', '<p>要使用账户中的礼券，在\'使用金额\'方框中输入要使用的金额。需要选择一种支付方式，然后点击继续。</p><p>如果您是兑现一张<em>新的</em>礼券，请在兑现代码方框中输入号码。点击继续后，兑现的金额将加入到您的账户中。</p>');
  define('MODULE_ORDER_TOTAL_GV_INCLUDE_ERROR', ' 只有在重新计算 = None 时设置含税 = true');
?>