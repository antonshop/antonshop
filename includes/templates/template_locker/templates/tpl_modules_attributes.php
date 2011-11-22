<?php
echo '<label>Please Choose</label>';
for($i=0;$i<sizeof($options_name);$i++) {
	if ($options_comment[$i] != '' and $options_comment_position[$i] == '0') {
		echo $options_comment[$i]; 	
	}
	echo "<br /><br />".$options_name[$i].":";
	echo $options_menu[$i]."<br />";
    
	if ($options_comment[$i] != '' and $options_comment_position[$i] == '1') { 
		echo $options_comment[$i]; 
	}

	if ($options_attributes_image[$i] != '') {
		echo "".$options_attributes_image[$i];
	}
}
?>

<?php
	if ($show_onetime_charges_description == 'true') {
		echo TEXT_ONETIME_CHARGE_SYMBOL . TEXT_ONETIME_CHARGE_DESCRIPTION; 
	}
?>

<?php
  if ($show_attributes_qty_prices_description == 'true') {
?>
    <div class="wrapperAttribsQtyPrices"><?php echo zen_image(DIR_WS_TEMPLATE_ICONS . 'icon_status_green.gif', TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK, 10, 10) . '&nbsp;' . '<a href="javascript:popupWindowPrice(\'' . zen_href_link(FILENAME_POPUP_ATTRIBUTES_QTY_PRICES, 'products_id=' . $_GET['products_id'] . '&products_tax_class_id=' . $products_tax_class_id) . '\')">' . TEXT_ATTRIBUTES_QTY_PRICE_HELP_LINK . '</a>'; ?></div>
<?php } ?>
