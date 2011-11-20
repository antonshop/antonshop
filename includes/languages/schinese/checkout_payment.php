<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: checkout_payment.php 4087 2006-08-07 04:46:08Z drbyte $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

define('NAVBAR_TITLE_1', '结帐');
define('NAVBAR_TITLE_2', '支付方式');

define('HEADING_TITLE', '支付信息');

define('TABLE_HEADING_BILLING_ADDRESS', '帐单地址');
define('TEXT_SELECTED_BILLING_DESTINATION', '这是您的帐单地址，该帐单地址要与您的信用卡帐单地址一致。要修改帐单地址，请点击<em>修改地址</em>按钮。');
define('TITLE_BILLING_ADDRESS', '帐单地址: ');

define('TABLE_HEADING_PAYMENT_METHOD', '支付方式');
define('TEXT_SELECT_PAYMENT_METHOD', '请选择支付方式');
define('TITLE_PLEASE_SELECT', '请选择');
define('TEXT_ENTER_PAYMENT_INFORMATION', '');
define('TABLE_HEADING_COMMENTS', '订单附加说明');

define('TITLE_NO_PAYMENT_OPTIONS_AVAILABLE', '目前不可用');
define('TEXT_NO_PAYMENT_OPTIONS_AVAILABLE','<span class="alert">对不起，我们目前还不接受您所在地区的支付。</span><br />请联系我们采用其他方式。');

define('TITLE_CONTINUE_CHECKOUT_PROCEDURE', '<strong>继续第三步</strong>');
define('TEXT_CONTINUE_CHECKOUT_PROCEDURE', '- 确认订单');

define('TABLE_HEADING_CONDITIONS', '<span class="termsconditions">顾客须知</span>');
define('TEXT_CONDITIONS_DESCRIPTION', '<span class="termsdescription">请点击下面的方框表明您同意本店顾客须知中的条款。顾客须知请点<a href="' . zen_href_link(FILENAME_CONDITIONS, '', 'SSL') . '"><span class="pseudolink">这里</span></a>。');
define('TEXT_CONDITIONS_CONFIRM', '<span class="termsiagree">我已经阅读并同意本店的顾客须知中的条款。</span>');

define('TEXT_CHECKOUT_AMOUNT_DUE', '应付金额: ');
define('TEXT_YOUR_TOTAL','订单总额');
?>