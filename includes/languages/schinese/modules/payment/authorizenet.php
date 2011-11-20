<?php
/**
 * Authorize.net SIM Payment Module
 *
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * Simplified Chinese version   http://www.zen-cart.cn
 * @version $Id: authorizenet.php 15868 2010-04-11 01:14:50Z drbyte $
 */

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ADMIN_TITLE', 'Authorize.net (SIM)');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CATALOG_TITLE', '信用卡');  // Payment option title as displayed to the customer


  if (MODULE_PAYMENT_AUTHORIZENET_STATUS == 'True') {
    define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', '<a target="_blank" href="https://account.authorize.net/">Authorize.net商户登录</a>' . (MODULE_PAYMENT_AUTHORIZENET_TESTMODE != 'Production' ? '<br /><br />测试信息:<br /><b>自动批准的信用卡号码:</b><br />Visa#: 4007000000027<br />MC#: 5424000000000015<br />Discover#: 6011000000000012<br />AMEX#: 370000000000002<br /><br /><b>说明:</b> 这些卡号在正式运行模式下会被拒绝，在测试模式下可以通过。有效期可以是任何今后的日期，CVV校验码可以是任何3或4 (AMEX)位数字。<br /><br /><b>自动拒绝的信用卡号:</b><br /><br />Card #: 4222222222222<br /><br />这个卡号可用于测试接收拒绝通知。' : '') . '<br /><br /><strong>SETTINGS</strong><br /> Authorize.net商户档案中的"response"和"receipt"地址的设置可以为空，或者设置为 http://your_domain.com/foldername/index.php?main_page=checkout_payment');
  } else {
    define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DESCRIPTION', '<a target="_blank" href="http://reseller.authorize.net/application.asp?id=131345">点这里申请帐号</a><br /><br /><a target="_blank" href="https://account.authorize.net/">点击登录Authorize.net商户页面</a><br /><br /><strong>要求:</strong><br /><hr />*<strong>Authorize.net帐号</strong> (申请见上面的链接)<br />*<strong>Authorize.net用户名和交易密钥</strong>在商户页面');
  }

  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_TYPE', '类型:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_OWNER', '持卡人:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_NUMBER', '信用卡号:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CREDIT_CARD_EXPIRES', '信用卡有效期:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_CVV', 'CVV校验码:');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_POPUP_CVV_LINK', '说明');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_OWNER', '* 持卡人姓名最少要' . CC_OWNER_MIN_LENGTH . '个字符.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_NUMBER', '* 信用卡号码最少要' . CC_NUMBER_MIN_LENGTH . '个字符.\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_JS_CC_CVV', '* 3或4位数字CVV校验码在信用卡背面。\n');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR_MESSAGE', '处理您的信用卡时出现错误，请再试一次。');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_DECLINED_MESSAGE', '您的信用卡被拒绝了. 请用另一张卡试试或者联系您的信用卡公司.');
  define('MODULE_PAYMENT_AUTHORIZENET_TEXT_ERROR', '信用卡错误!');
  