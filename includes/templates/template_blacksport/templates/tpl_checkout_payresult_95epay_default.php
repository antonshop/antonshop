<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=checkout_success.<br />
 * Displays confirmation details after order has been successfully processed.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_checkout_success_default.php 5407 2006-12-27 01:35:37Z drbyte $
 */
?>
<div class="centerColumn" id="checkoutSuccess">

<h3 id="checkoutSuccessHeading">
<?php if ($messageStack->size('checkout_payresult') > 0) echo $messageStack->output('checkout_payresult'); ?>
</h3>
<!--
<div id="checkoutSuccessOrderNumber"><?php echo 'Your Order Number is:' . $zv_orders_id; ?></div>
-->
<!--bof logoff-->
<div id="checkoutSuccessLogoff">

<div class="buttonRow forward"><a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo zen_image_button(BUTTON_IMAGE_LOG_OFF , BUTTON_LOG_OFF_ALT); ?></a></div>
</div>
<!--eof logoff-->
<h3 id="checkoutSuccessThanks" class="centeredContent"><?php echo 'Thanks for shopping with us online!'; ?></h3>
</div>