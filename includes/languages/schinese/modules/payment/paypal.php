<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: paypal.php 15555 2010-02-22 06:12:26Z drbyte $
 * @Simplified Chinese version   http://www.zen-cart.cn
 */

  define('MODULE_PAYMENT_PAYPAL_TEXT_ADMIN_TITLE', 'PayPal Website Payments Standard - IPN');
  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_TITLE', 'PayPal');
  if (IS_ADMIN_FLAG === true) {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal Website Payments Standard (IPN)</strong> (PayPal基本方式)<br /><a href="https://www.paypal.com/mrb/mrb=R-4DM17246PS436904F&pal=GR5QUVVL9AFGN&MRB=R-4DM17246PS436904F" target="_blank">管理PayPal帐号。</a><br /><br /><font color="green">安装说明:</font><br />1. <a href="https://www.paypal.com/c2/mrb/pal=GR5QUVVL9AFGN&MRB=R-4DM17246PS436904F" target="_blank">注册PayPal帐号 - 点这里。</a><br />2. In your PayPal account, under "Profile",<ul><li>设置<strong>Instant Payment Notification Preferences</strong>的URL为:<br /><nobr><pre>'.str_replace('index.php?main_page=index','ipn_main_handler.php',zen_catalog_href_link(FILENAME_DEFAULT, '', 'SSL')) . '</pre></nobr><br />(如果已有URL，就不用修改。)<br /><span class="alert">确认IPN要选中！</span><br /><br /></li><li>在<strong>Website Payments Preferences</strong>中设置<strong>Automatic Return URL</strong>为:<br /><nobr><pre>'.zen_catalog_href_link(FILENAME_CHECKOUT_PROCESS, '', 'SSL',false).'</pre></nobr></li>' . (defined('MODULE_PAYMENT_PAYPALSTD_STATUS') ? '' : '<li>... 并点击"安装"打开PayPal模块... 选择"编辑"设置PayPal。</li>') . '</ul><font color="green"><hr /><strong>要求:</strong></font><br /><hr />*<strong>PayPal帐号</strong> (<a href="https://www.paypal.com/c2/mrb/pal=GR5QUVVL9AFGN&MRB=R-4DM17246PS436904F" target="_blank">点击注册</a>)<br />*<strong>*<strong>端口 80</strong>用于网关间双向通讯，必须在主机的路由器/防火墙上打开<br />*一定要按照上面的说明<strong>设置</strong>。' );
  } else {
    define('MODULE_PAYMENT_PAYPAL_TEXT_DESCRIPTION', '<strong>PayPal</strong>');
  }
  // to show the PayPal logo as the payment option name, use this:  https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif
  // to show CC icons with PayPal, use this instead:  https://www.paypal.com/en_US/i/bnr/horizontal_solution_PPeCheck.gif
  define('MODULE_PAYMENT_PAYPAL_MARK_BUTTON_IMG', 'https://www.paypal.com/en_US/i/logo/PayPal_mark_37x23.gif');
  define('MODULE_PAYMENT_PAYPAL_MARK_BUTTON_ALT', '通过PayPal付款');
  define('MODULE_PAYMENT_PAYPAL_ACCEPTANCE_MARK_TEXT', '无需提供私人账户信息付款，安全而且简单');

  define('MODULE_PAYMENT_PAYPAL_TEXT_CATALOG_LOGO', '<img src="' . MODULE_PAYMENT_PAYPAL_MARK_BUTTON_IMG . '" alt="' . MODULE_PAYMENT_PAYPAL_MARK_BUTTON_ALT . '" title="' . MODULE_PAYMENT_PAYPAL_MARK_BUTTON_ALT . '" /> &nbsp;' .
                                                    '<span class="smallText">' . MODULE_PAYMENT_PAYPAL_ACCEPTANCE_MARK_TEXT . '</span>');

  define('MODULE_PAYMENT_PAYPAL_ENTRY_FIRST_NAME', '名字:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_LAST_NAME', '姓氏:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_BUSINESS_NAME', '公司名称:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_NAME', '详细地址:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STREET', '');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_CITY', '城市:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATE', '省份:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_ZIP', '邮编:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_COUNTRY', '国家或地区:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EMAIL_ADDRESS', '付款人电子邮件:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EBAY_ID', 'Ebay 编号:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_ID', '付款人 编号:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYER_STATUS', '付款人状态:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_ADDRESS_STATUS', '地址状态:');

  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_TYPE', '付款类型:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_STATUS', '付款状态:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PENDING_REASON', '等待的原因:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_INVOICE', '发票:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_DATE', '付款日期:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_CURRENCY', '货币:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_GROSS_AMOUNT', '总金额:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PAYMENT_FEE', '付款手续费:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_EXCHANGE_RATE', '汇率:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_CART_ITEMS', '物品件数:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_TYPE', '交易类型:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_TXN_ID', '交易编号:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_PARENT_TXN_ID', '主交易编号:');
  define('MODULE_PAYMENT_PAYPAL_ENTRY_COMMENTS', '系统备注: ');


  define('MODULE_PAYMENT_PAYPAL_PURCHASE_DESCRIPTION_TITLE', STORE_NAME . '购物');
  define('MODULE_PAYMENT_PAYPAL_PURCHASE_DESCRIPTION_ITEMNUM', '商店收据');
  define('MODULES_PAYMENT_PAYPALSTD_LINEITEM_TEXT_ONETIME_CHARGES_PREFIX', '一次性收费用于');
  define('MODULES_PAYMENT_PAYPALSTD_LINEITEM_TEXT_SURCHARGES_SHORT', '其他费用');
  define('MODULES_PAYMENT_PAYPALSTD_LINEITEM_TEXT_SURCHARGES_LONG', '手续费和其他费用');
  define('MODULES_PAYMENT_PAYPALSTD_LINEITEM_TEXT_DISCOUNTS_SHORT', '优惠');
  define('MODULES_PAYMENT_PAYPALSTD_LINEITEM_TEXT_DISCOUNTS_LONG', '已付款，包括优惠券、礼券等');
