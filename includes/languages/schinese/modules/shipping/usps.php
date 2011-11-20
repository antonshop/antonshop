<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: usps.php 4867 2006-10-31 09:59:01Z drbyte $
 * Simplified Chinese version   http://www.zen-cart.cn
 */

define('MODULE_SHIPPING_USPS_TEXT_TITLE', '美国邮政USPS');
define('MODULE_SHIPPING_USPS_TEXT_DESCRIPTION', '要使用该模块，您需要在美国邮政网页<br /><br />USPS http://www.uspsprioritymail.com/et_regcert.html 上注册一个帐号<br /><br />注意USPS上的重量单位是磅');
define('MODULE_SHIPPING_USPS_TEXT_DESCRIPTION', 'United States Postal Service<br /><br />您需要在USPS注册一个网页工具帐号，请到<a href="http://www.usps.com/webtools/" target="_blank">USPS的网站</a>注册。<br /><br />USPS要求您<strong>使用磅为重量单位</strong>。' . ((MODULE_SHIPPING_USPS_USERID == 'NONE' || MODULE_SHIPPING_USPS_USERID == '' || MODULE_SHIPPING_USPS_SERVER == 'test') ? '<br /><br /><strong>新建一个帐号以使用USPS实时运费查询</strong><br />
1. <a href="http://www.usps.com/webtools/rate.htm" target="_blank">USPS资料和运费询价</a><br />
2. <a href="https://secure.shippingapis.com/registration/" target="_blank">新建一个USPS网页工具帐号</a><br />
3. 填写您的客户资料，然后发送<br />
4. 您会收到一封邮件包含USPS帐号的用户编号<br />
5. 在Zen Cart的USPS配送模块中输入网页工具的用户编号。<br />
6. 打电话到USPS 1-800-344-7779，让他们将您的帐号转到正式服务器上，或者发邮件到 icustomercare@usps.com, 附上您的网页工具的用户编号。<br />
7. 他们会给您发送确认邮件。将Zen Cart模块设置为正式启用。(而不是测试模式)': ''));
define('MODULE_SHIPPING_USPS_TEXT_OPT_PP', '邮递');
define('MODULE_SHIPPING_USPS_TEXT_OPT_PM', '加快');
define('MODULE_SHIPPING_USPS_TEXT_OPT_EX', '快递');
define('MODULE_SHIPPING_USPS_TEXT_ERROR', '无法根据您的地址计算USPS运费。<br />如果您要使用USPS发货，请联系我们。<br />(请检查您的邮编是否正确)');
define('MODULE_SHIPPING_USPS_TEXT_SERVER_ERROR', '计算USPS运费时出现错误。<br />如果您要使用USPS发货，请联系我们。');
define('MODULE_SHIPPING_USPS_TEXT_DAY', '天');
define('MODULE_SHIPPING_USPS_TEXT_DAYS', '天');
define('MODULE_SHIPPING_USPS_TEXT_WEEKS', '星期');
define('MODULE_SHIPPING_USPS_TEXT_TEST_MODE_NOTICE', '<br /><span class="alert">该帐号处于 测试模式。在启用正式服务前，不会显示实际运费。(1-800-344-7779)</span>');

?>