<?php
/**
 * create_account header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 4035 2006-07-28 05:49:06Z drbyte $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CREATE_ACCOUNT');


require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));
include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_CREATE_ACCOUNT));


//获取省份信息
$state_query = "SELECT * FROM " . TABLE_ZONES . " ORDER BY zone_id";

$state_info = $db->Execute($state_query);

$state_arr = array();
while(!$state_info->EOF){
	$state_arr[] = $state_info->fields;
	$state_info->MoveNext();
}
//print_r($state_arr);

$breadcrumb->add(NAVBAR_TITLE);

// This should be last line of the script:
$zco_notifier->notify('NOTIFY_HEADER_END_CREATE_ACCOUNT');
?>