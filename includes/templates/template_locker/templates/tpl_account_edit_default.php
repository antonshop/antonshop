<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=account_edit.<br />
 * View or change Customer Account Information
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_account_edit_default.php 3848 2006-06-25 20:33:42Z drbyte $
 * @copyright Portions Copyright 2003 osCommerce
 */
?>
<div class="centerColumn" id="accountEditDefault">
<?php echo zen_draw_form('account_edit', zen_href_link(FILENAME_ACCOUNT_EDIT, '', 'SSL'), 'post', 'onsubmit="return check_form(account_edit);"') . zen_draw_hidden_field('action', 'process'); ?>

<?php if ($messageStack->size('account_edit') > 0) echo $messageStack->output('account_edit'); ?>

<fieldset>
<legend><?php echo HEADING_TITLE; ?></legend>
<div class="alert forward"><?php echo FORM_REQUIRED_INFORMATION; ?></div>
<br class="clearBoth" />



<label class="inputLabel" for="firstname"><?php echo ENTRY_FIRST_NAME; ?></label>
<?php echo zen_draw_input_field('firstname', $account->fields['customers_firstname'], 'id="firstname"') . (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert">' . ENTRY_FIRST_NAME_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<label class="inputLabel" for="lastname"><?php echo ENTRY_LAST_NAME; ?></label>
<?php echo zen_draw_input_field('lastname', $account->fields['customers_lastname'], 'id="lastname"') . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert">' . ENTRY_LAST_NAME_TEXT . '</span>': ''); ?>
<br class="clearBoth" />



<label class="inputLabel" for="email-address"><?php echo ENTRY_EMAIL_ADDRESS; ?></label>
<?php echo zen_draw_input_field('email_address', $account->fields['customers_email_address'], 'id="email-address"') . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert">' . ENTRY_EMAIL_ADDRESS_TEXT . '</span>': ''); ?>
<br class="clearBoth" />

<label class="inputLabel" for="telephone"><?php echo ENTRY_TELEPHONE_NUMBER; ?></label>
<?php echo zen_draw_input_field('telephone', $account->fields['customers_telephone'], 'id="telephone"') . (zen_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="alert">' . ENTRY_TELEPHONE_NUMBER_TEXT . '</span>': ''); ?>
<br class="clearBoth" />


<?php
  if (CUSTOMERS_REFERRAL_STATUS == 2 and $customers_referral == '') {
?>
<label class="inputLabel" for="customers-referral"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
<?php echo zen_draw_input_field('customers_referral', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_referral', 15), 'id="customers-referral"'); ?>
<br class="clearBoth" />
<?php } ?>

<?php
  if (CUSTOMERS_REFERRAL_STATUS == 2 and $customers_referral != '') {
?>
<label for="customers-referral-readonly"><?php echo ENTRY_CUSTOMERS_REFERRAL; ?></label>
<?php echo $customers_referral; zen_draw_hidden_field('customers_referral', $customers_referral,'id="customers-referral-readonly"'); ?>
<br class="clearBoth" />
<?php } ?>
</fieldset>



<div class="buttonRow back"><?php echo '<a href="' . zen_href_link(FILENAME_ACCOUNT, '', 'SSL') . '">' . zen_image_button(BUTTON_IMAGE_BACK , BUTTON_BACK_ALT) . '</a>'; ?></div>
<div class="buttonRow forward"><?php echo zen_image_submit(BUTTON_IMAGE_UPDATE , BUTTON_UPDATE_ALT); ?></div>
<br class="clearBoth" />

</form>
</div>