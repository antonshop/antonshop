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
// $Id: gv_faq.php 4155 2006-08-16 17:14:52Z ajeh $
//

define('NAVBAR_TITLE', TEXT_GV_NAME . '问答');
define('HEADING_TITLE', TEXT_GV_NAME . '问答');

define('TEXT_INFORMATION', '<a name="Top"></a>
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=1','NONSSL').'">如何购买' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=2','NONSSL').'">如何发送' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=3','NONSSL').'">如何使用' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=4','NONSSL').'">如何兑换' . TEXT_GV_NAMES . '</a><br />
  <a href="'.zen_href_link(FILENAME_GV_FAQ,'faq_item=5','NONSSL').'">联系我们</a><br />
');
switch ($_GET['faq_item']) {
  case '1':
define('SUB_HEADING_TITLE','如何购买' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT', TEXT_GV_NAMES . '和其他商品一样购买。您可以使用一般的支付方式。<br />购买后，' . TEXT_GV_NAME . '会加入您的' . TEXT_GV_NAME . '帐号中。<br />如果您的' . TEXT_GV_NAME . '帐号中有资金，购物车栏会显示金额和链接，通过该链接您可以用电子邮件发送' . TEXT_GV_NAME . '给朋友。');
  break;
  case '2':
define('SUB_HEADING_TITLE','如何发送' . TEXT_GV_NAMES);
define('SUB_HEADING_TEXT','要发送' . TEXT_GV_NAME . '，请到发送' . TEXT_GV_NAME . '页面，在购物车方框中有链接。<br /><br />当您发送' . TEXT_GV_NAME . '时，需要填写以下信息。<br />接收' . TEXT_GV_NAME . '人的姓名<br />接收' . TEXT_GV_NAME . '人的电子邮件地址<br />您希望发送的金额(提示: 您不必发送' . TEXT_GV_NAME . '帐号上的全部金额)。<br /><br />一封短信会发到您的电子邮件中。请确认您正确输入所有信息，在电子邮件发出前可以修改。');
  break;
  case '3':
  define('SUB_HEADING_TITLE','如何使用' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','如果您的' . TEXT_GV_NAME . '帐号里有资金，您可以用这些资金购买其它商品。<br />在结帐时，会显示一个额外的对话框。输入要使用的' . TEXT_GV_NAME . '帐号里的金额。<br />请注意，如果您的' . TEXT_GV_NAME . '帐号里资金不足，需要另外选择一种支付方式。<br />如果您有足够的金额在' . TEXT_GV_NAME . '帐号里，余额将仍然留在您的' . TEXT_GV_NAME . '帐号中。');
  break;
  case '4':
  define('SUB_HEADING_TITLE','如何兑换' . TEXT_GV_NAMES);
  define('SUB_HEADING_TEXT','如果你通过电子邮件收到' . TEXT_GV_NAME . '，上面会注明是谁发送' . TEXT_GV_NAME . '给您。留言以及'. TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . '也写在邮件中。最好打印该电子邮件以备将来参考。<br /><br />您有两种方法兑现' . TEXT_GV_NAME . '。<br /><br />
  1. 最简单的方法就是点击电子邮件中的链接。该链接会转到网上商店的兑现' . TEXT_GV_NAME . '页面。您需要建立一个帐号，然后将' . TEXT_GV_NAME . '存放到您的' . TEXT_GV_NAME . '帐号里，就可以使用它了。<br /><br />
  2. 结帐的时候，在选择支付方式的页面，可以输入' . TEXT_GV_REDEEM . '。输入' . TEXT_GV_REDEEM . '后，点击兑现按钮。代码经核对后会加入您的' . TEXT_GV_NAME . '帐号，就可以用它在本网店购物了。');
  break;
  case '5':
  define('SUB_HEADING_TITLE','联系我们');
  define('SUB_HEADING_TEXT','有关' . TEXT_GV_NAME . '的任何疑问，请通过电子邮件'. STORE_OWNER_EMAIL_ADDRESS . '联系我们。请在电子邮件中尽可能写清详细情况。');
  break;
  default:
  define('SUB_HEADING_TITLE','');
  define('SUB_HEADING_TEXT','请从上面选择一项说明。');

  }

  define('TEXT_GV_REDEEM_INFO', '请输入您的' . TEXT_GV_NAME . '兑现代码: ');
  define('TEXT_GV_REDEEM_ID', '兑现代码:');
?>