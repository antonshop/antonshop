<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: create_account.php 15405 2010-02-03 06:29:33Z drbyte $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

define('NAVBAR_TITLE', '建立帐号');

define('HEADING_TITLE', '我的帐号');

define('TEXT_ORIGIN_LOGIN', '<strong class="note">提示：</strong>如果您已有帐号，请点<a href="%s">这里</a>登录。');

// greeting salutation
define('EMAIL_SUBJECT', '欢迎光临' . STORE_NAME);
define('EMAIL_GREET_MR', '亲爱的%s先生,' . "\n\n");
define('EMAIL_GREET_MS', '亲爱的%s女士,' . "\n\n");
define('EMAIL_GREET_NONE', '亲爱的%s' . "\n\n");

// First line of the greeting
define('EMAIL_WELCOME', '欢迎光临<strong>' . STORE_NAME . '</strong>。');
define('EMAIL_SEPARATOR', '--------------------');
define('EMAIL_COUPON_INCENTIVE_HEADER', '恭喜! 为了您下次在这里购物更加超值，下面是专门为您准备的优惠券！' . "\n\n");
// 您的优惠券详情将在以下加入
define('EMAIL_COUPON_REDEEM', '要使用优惠券，在结帐时输入' . TEXT_GV_REDEEM . '代码：<strong>%s</strong>' . "\n\n");
define('TEXT_COUPON_HELP_DATE', '<p>优惠券有效期为%s至%s</p>');

define('EMAIL_GV_INCENTIVE_HEADER', '多谢惠顾，我们给您发了' . TEXT_GV_NAME . '作为%s！' . "\n");
define('EMAIL_GV_REDEEM', '本' . TEXT_GV_NAME . ' ' . TEXT_GV_REDEEM . '是：%s' . "\n\n" . '您结帐时输入' . TEXT_GV_REDEEM . '，然后在商店里选择。');
define('EMAIL_GV_LINK', '或者现在就可以按照下面的链接兑现：' . "\n");
// GV link will automatically be included before this line

define('EMAIL_GV_LINK_OTHER', TEXT_GV_NAME . '加到您的帐号后，可以自己使用或者发给朋友！' . "\n\n");

define('EMAIL_TEXT', '您可以使用我们提供的<strong>各项服务</strong>，服务包括:' . "\n\n<ul>" . '<li><strong>订单记录</strong> - 查看您的所有订单。' . "\n\n" . '<li><strong>永久购物车</strong> - 您在线购物车中的商品，一直保存到您删除它们或者结帐完成。' . "\n\n" . '<li><strong>地址簿</strong> - 我们可以发货到您的帐单地址或者您另外输入的送货地址！这很适合给您的朋友送生日礼物。' . "\n\n" . '<li><strong>商品评论</strong> - 和我们的其它客户分享您对某商品的看法。' . "\n\n</ul>");
define('EMAIL_CONTACT', '如果需要帮助，请发电子邮件到：<a href="mailto:' . STORE_OWNER_EMAIL_ADDRESS . '">'. STORE_OWNER_EMAIL_ADDRESS ." </a>\n\n");
define('EMAIL_GV_CLOSURE', "\n" . '谢谢,' . "\n\n" . STORE_OWNER . "\n商店管理员\n\n". '<a href="' . HTTP_SERVER . DIR_WS_CATALOG . '">'.HTTP_SERVER . DIR_WS_CATALOG ."</a>\n\n");

// email disclaimer - this disclaimer is seperate from all other email disclaimers
define('EMAIL_DISCLAIMER_NEW_CUSTOMER', '该电子邮件地址是您或某位客户给我们的. 如果您没有登记帐号, 或者您错误接收了该邮件, 请发邮件到%s');
