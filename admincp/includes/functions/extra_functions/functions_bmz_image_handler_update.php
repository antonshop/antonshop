<?php
/**
 * bmz_image_handler_update.php
 * manage automatic patching of the database for image-handler
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: functions_bmz_image_handler_update.php,v 1.7 2006/05/01 12:12:08 tim Exp $
 */

global $messageStack;
global $db;

function remove_image_handler() {
	global $db;
	$error = false;
	
	$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'LARGE_IMAGE_MAX_WIDTH' OR " .
				"configuration_key = 'LARGE_IMAGE_MAX_HEIGHT' OR " .
				"configuration_key = 'SMALL_IMAGE_FILETYPE' OR " .
				"configuration_key = 'SMALL_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_SMALL_IMAGES' OR " .
				"configuration_key = 'ZOOM_SMALL_IMAGES' OR " .
        "configuration_key =  'SMALL_IMAGE_HOTZONE' OR " .
				"configuration_key = 'SMALL_IMAGE_QUALITY' OR " .
				"configuration_key = 'MEDIUM_IMAGE_FILETYPE' OR " .
				"configuration_key = 'MEDIUM_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_MEDIUM_IMAGES' OR " .
				"configuration_key = 'ZOOM_MEDIUM_IMAGES' OR " .
        "configuration_key =  'MEDIUM_IMAGE_HOTZONE' OR " .
				"configuration_key = 'MEDIUM_IMAGE_QUALITY' OR " .
				"configuration_key = 'LARGE_IMAGE_FILETYPE' OR " .
				"configuration_key = 'LARGE_IMAGE_BACKGROUND' OR " .
				"configuration_key = 'WATERMARK_LARGE_IMAGES' OR " .
				"configuration_key = 'LARGE_IMAGE_QUALITY' OR " .
				"configuration_key = 'WATERMARK_GRAVITY' OR " .
				"configuration_key = 'ZOOM_GRAVITY' OR " .
				"configuration_key = 'IH_RESIZE' OR " .
				"configuration_key = 'SHOW_UPLOADED_IMAGES';";
	$db->Execute($sql_query);
	$sql_query = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='REMOVED' WHERE configuration_key = 'IH_VERSION';";
	$db->Execute($sql_query);
	return $error;
}

function install_image_handler() {
	global $db;
    global $ihConf;
  $sort_order_offset = 100;
	$i = 0;
	
	if (defined('IH_VERSION')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'IH_VERSION';";
		$db->Execute($sql_query);
	}

	//------------------------------
	// IH_RESIZE configuration entry
	//------------------------------
	$ih_resize = 'yes';
	if (defined('IMAGE_MANAGER_HANDLER')) {
		// ok, some image handler has been installed
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'IMAGE_MANAGER_HANDLER';";
		if (IMAGE_MANAGER_HANDLER == 'none') $ih_resize = 'no';
		$db->Execute($sql_query);
	}
	if (!defined('IH_RESIZE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 调整图像大小', 'IH_RESIZE', '$ih_resize', 'Zen-Cart的缺省设置为 ''no''，要打开自动调整图像大小，设置为 ''yes''。如果要使用ImageMagick，请在<em>includes/extra_configures/bmz_image_handler_conf.php</em>中指定<strong>convert binary</strong>的位置', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''yes'', ''no''),', now());";
		$db->Execute($sql_query);
		define(IH_RESIZE, $ih_resize);
	}
	

	//-----------------------------------------
	// SMALL_IMAGE_FILETYPE configuration entry
	//-----------------------------------------
	$sql_query = '';
	if (!defined('SMALL_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 小图像类型', 'SMALL_IMAGE_FILETYPE', 'no_change', '选择 ''jpg'', ''gif'' 或 ''png''。IE无法正常显示透明区域的png图像。透明背景的大图像最好设置为 ''gif'' 或 ''jpg''。 ''no_change'' 是zen-cart的缺省方式，小图像采用与上传的图像相同的后缀。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		define(SMALL_IMAGE_FILETYPE, 'no_change');
	}

	//-------------------------------------------
	// SMALL_IMAGE_BACKGROUND configuration entry
	//-------------------------------------------
	$sql_query = '';
	if (!defined('SMALL_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 小图像背景', 'SMALL_IMAGE_BACKGROUND', '255:255:255', '如果上传的是透明背景图像，该颜色将替代图片的透明部分。透明设置为''transparent''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		define(SMALL_IMAGE_BACKGROUND, '255:255:255');
	}

	//-------------------------------------------
	// WATERMARK_SMALL_IMAGES configuration entry
	//-------------------------------------------
	$watermark_small_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_SMALL_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_SMALL_IMAGES';";
		if (WATERMARK_SMALL_IMAGES == 'True') $watermark_small_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 水印小图像', 'WATERMARK_SMALL_IMAGES', '$watermark_small_images', '如果小图像要显示水印，设置为''yes''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

	//--------------------------------------
	// ZOOM_SMALL_IMAGES configuration entry
	//--------------------------------------
	$zoom_small_images = 'yes';
	$sql_query = '';
	if (defined('ZOOM_SMALL_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ZOOM_SMALL_IMAGES';";
		if (ZOOM_SMALL_IMAGES == 'yes') $zoom_small_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 放大小图像', 'ZOOM_SMALL_IMAGES', '$zoom_small_images', '如果要在鼠标移动到小图像上时，显示出放大的图像，设置为''yes''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

  //--------------------------------------
  // SMALL_IMAGE_HOTZONE configuration entry
  //--------------------------------------
  $small_image_hotzone = 'no';
  $sql_query = '';
  if (defined('SMALL_IMAGE_HOTZONE')) {
    $sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SMALL_IMAGE_HOTZONE';";
    if (SMALL_IMAGE_HOTZONE == 'yes') $small_image_hotzone = 'yes';
    $db->Execute($sql_query);
  }
  $sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
        "('IH 小图像焦点区', 'SMALL_IMAGE_HOTZONE', '$small_image_hotzone', '如果要在鼠标移动到小图像上某个区域时，显示出放大的图像，设置为''yes''。焦点区的位置是相对与图像的偏移量。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
  $db->Execute($sql_query);

	//----------------------------------------
	// SMALL_IMAGE_QUALITY configuration entry
	//----------------------------------------
	$small_image_quality = '85';
	$sql_query = '';
	if (defined('SMALL_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'SMALL_IMAGE_QUALITY';";
		$small_image_quality = SMALL_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 小图像压缩质量', 'SMALL_IMAGE_QUALITY', '$small_image_quality', '设定期望的JPG小图像质量，数字值从0到100。值越高图像质量越好，图像文件也越大。缺省为85，通常可以满足要求。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);


	//------------------------------------------
	// MEDIUM_IMAGE_FILETYPE configuration entry
	//------------------------------------------
	$sql_query = '';
	if (!defined('MEDIUM_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 中图像文件类型', 'MEDIUM_IMAGE_FILETYPE', 'no_change', '选项为 ''jpg'', ''gif'' 或 ''png''。IE无法正常显示透明背景的png图像。透明背景的图像最好选择''gif''而大图像最好选择''jpg''。''no_change''是zen-cart的缺省方式，中图像采用与上传的图像相同的后缀。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		define(MEDIUM_IMAGE_FILETYPE, 'no_change');
	}

	//--------------------------------------------
	// MEDIUM_IMAGE_BACKGROUND configuration entry
	//--------------------------------------------
	$sql_query = '';
	if (!defined('MEDIUM_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 中图像背景', 'MEDIUM_IMAGE_BACKGROUND', '255:255:255', '如果上传的是透明背景图像，该颜色将替代图片的透明部分。透明设置为''transparent''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		define(MEDIUM_IMAGE_BACKGROUND, '255:255:255');
	}

	//--------------------------------------------
	// WATERMARK_MEDIUM_IMAGES configuration entry
	//--------------------------------------------
	$watermark_medium_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_MEDIUM_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_MEDIUM_IMAGES';";
		if (WATERMARK_MEDIUM_IMAGES == 'True') $watermark_medium_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 水印中图像', 'WATERMARK_MEDIUM_IMAGES', '$watermark_medium_images', '如果中图像要显示水印，设置为''yes''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

	//---------------------------------------
	// ZOOM_MEDIUM_IMAGES configuration entry
	//---------------------------------------
	$zoom_medium_images = 'no';
	$sql_query = '';
	if (defined('ZOOM_MEDIUM_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ZOOM_MEDIUM_IMAGES';";
		if (ZOOM_MEDIUM_IMAGES == 'yes') $zoom_medium_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 放大中图像', 'ZOOM_MEDIUM_IMAGES', '$zoom_medium_images', '如果要在鼠标移动到中图像上时，显示出放大的图像，设置为''yes''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

  //-----------------------------------------
  // MEDIUM_IMAGE_HOTZONE configuration entry
  //-----------------------------------------
  $medium_image_hotzone = 'no';
  $sql_query = '';
  if (defined('MEDIUM_IMAGE_HOTZONE')) {
    $sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MEDIUM_IMAGE_HOTZONE';";
    if (MEDIUM_IMAGE_HOTZONE == 'yes') $medium_image_hotzone = 'yes';
    $db->Execute($sql_query);
  }
  $sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
        "('IH 中图像焦点区', 'MEDIUM_IMAGE_HOTZONE', '$medium_image_hotzone', '如果要在鼠标移动到中图像上某个区域时，显示出放大的图像，设置为''yes''。焦点区的位置是相对与图像的偏移量。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
  $db->Execute($sql_query);

	//-----------------------------------------
	// MEDIUM_IMAGE_QUALITY configuration entry
	//-----------------------------------------
	$medium_image_quality = '85';
	$sql_query = '';
	if (defined('MEDIUM_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'MEDIUM_IMAGE_QUALITY';";
		$medium_image_quality = MEDIUM_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 中图像压缩质量', 'MEDIUM_IMAGE_QUALITY', '$medium_image_quality', '设定期望的JPG中图像质量，数字值从0到100。值越高图像质量越好，图像文件也越大。缺省为85，通常可以满足要求。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);


	//-----------------------------------------
	// LARGE_IMAGE_FILETYPE configuration entry
	//-----------------------------------------
	$sql_query = '';
	if (!defined('LARGE_IMAGE_FILETYPE')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 大图像文件类型', 'LARGE_IMAGE_FILETYPE', 'no_change', '选项为''jpg'', ''gif'' 或 ''png''。IE无法正常显示透明背景的png图像。透明背景的图像最好选择''gif''而大图像最好选择''jpg''。''no_change''是zen-cart的缺省方式，大图像采用与上传的图像相同的后缀。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''gif'', ''jpg'', ''png'', ''no_change''),', now());";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_FILETYPE, 'no_change');
	}

	//-------------------------------------------
	// LARGE_IMAGE_BACKGROUND configuration entry
	//-------------------------------------------
	$sql_query = '';
	if (!defined('LARGE_IMAGE_BACKGROUND')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 大图像背景', 'LARGE_IMAGE_BACKGROUND', '255:255:255', '如果上传的是透明背景图像，该颜色将替代图片的透明部分。透明设置为''transparent''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_BACKGROUND, '255:255:255');
	}

	//-------------------------------------------
	// WATERMARK_LARGE_IMAGES configuration entry
	//-------------------------------------------
	$watermark_large_images = 'no';
	$sql_query = '';
	if (defined('WATERMARK_LARGE_IMAGES')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'WATERMARK_LARGE_IMAGES';";
		if (WATERMARK_LARGE_IMAGES == 'True') $watermark_large_images = 'yes';
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 水印大图像', 'WATERMARK_LARGE_IMAGES', '$watermark_large_images', '如果大图像要显示水印，设置为''yes''。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_option(array(''no'', ''yes''),', now());";
	$db->Execute($sql_query);

	//----------------------------------------
	// LARGE_IMAGE_QUALITY configuration entry
	//----------------------------------------
	$large_image_quality = '85';
	$sql_query = '';
	if (defined('LARGE_IMAGE_QUALITY')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'LARGE_IMAGE_QUALITY';";
		$large_image_quality = LARGE_IMAGE_QUALITY;
		$db->Execute($sql_query);
	}
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('IH 大图像压缩质量', 'LARGE_IMAGE_QUALITY', '$large_image_quality', '设定期望的JPG大图像质量，数字值从0到100。值越高图像质量越好，图像文件也越大。缺省为85，通常可以满足要求。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);


	//------------------------------------------
	// LARGE_IMAGE_MAX_WIDTH configuration entry
	//------------------------------------------
	$sql_query = '';
	$large_image_max_width = '750';
	if (!defined('LARGE_IMAGE_MAX_WIDTH')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 大图像最大宽度', 'LARGE_IMAGE_MAX_WIDTH', '" . $large_image_max_width . "', '设置大图像的最大宽度。如果宽度和高度为空或0，将不会自动调整大图像的大小。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now())";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_MAX_WIDTH, $large_image_max_width);
	}
	
	//-------------------------------------------
	// LARGE_IMAGE_MAX_HEIGHT configuration entry
	//-------------------------------------------
	$sql_query = '';
	$large_image_max_height = '550';
	if (!defined('LARGE_IMAGE_MAX_HEIGHT')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 大图像最大高度', 'LARGE_IMAGE_MAX_HEIGHT', '" . $large_image_max_height . "', '设置大图像的最大高度。如果宽度和高度为空或0，将不会自动调整大图像的大小。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_textarea_small(', now())";
		$db->Execute($sql_query);
		define(LARGE_IMAGE_MAX_HEIGHT, $large_image_max_height);
	}
	

	//--------------------------------------
	// WATERMARK_GRAVITY configuration entry
	//--------------------------------------
	$sql_query = '';
	if (!defined('WATERMARK_GRAVITY')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 水印位置', 'WATERMARK_GRAVITY', 'Center', '选择水印在图像中的位置。缺省为<strong>中央</Strong>。', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''左上''), array(''id''=>''North'', ''text''=>''上部''), array(''id''=>''NorthEast'', ''text''=>''右上''), array(''id''=>''West'', ''text''=>''左边''), array(''id''=>''Center'', ''text''=>''中央''), array(''id''=>''East'', ''text''=>''右边''), array(''id''=>''SouthWest'', ''text''=>''左下''), array(''id''=>''South'', ''text''=>''下部''), array(''id''=>''SouthEast'', ''text''=>''右下'')),', now());";
		$db->Execute($sql_query);
		define(WATERMARK_GRAVITY, 'Center');
	}


	//---------------------------------
	// ZOOM_GRAVITY configuration entry
	//---------------------------------
	$sql_query = '';
	if (!defined('ZOOM_GRAVITY')) {
		$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
					"('IH 放大位置', 'ZOOM_GRAVITY', 'SouthEast', '选择放大图像相对于原图像的位置。缺省为<strong>右下</Strong>.', 4, " . ($sort_order_offset + $i++) . ", 'zen_cfg_select_drop_down(array(array(''id''=>''NorthWest'', ''text''=>''左上''), array(''id''=>''North'', ''text''=>''上部''), array(''id''=>''NorthEast'', ''text''=>''右上''), array(''id''=>''West'', ''text''=>''左边''), array(''id''=>''Center'', ''text''=>''中央''), array(''id''=>''East'', ''text''=>''右边''), array(''id''=>''SouthWest'', ''text''=>''左下''), array(''id''=>''South'', ''text''=>''下部''), array(''id''=>''SouthEast'', ''text''=>''右下'')),', now());";
		$db->Execute($sql_query);
		define(ZOOM_GRAVITY, 'SouthEast');
	}


	//----------------------------------------------
	// ADDITIONAL_IMAGE_FILETYPE configuration entry
	//----------------------------------------------
	$sql_query = '';
	if (defined('ADDITIONAL_IMAGE_FILETYPE')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ADDITIONAL_IMAGE_FILETYPE';";
		$db->Execute($sql_query);
	}


	//------------------------------------------------
	// ADDITIONAL_IMAGE_BACKGROUND configuration entry
	//------------------------------------------------
	$sql_query = '';
	if (defined('ADDITIONAL_IMAGE_BACKGROUND')) {
		$sql_query = "DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = 'ADDITIONAL_IMAGE_BACKGROUND';";
		$db->Execute($sql_query);
	}

	// set to first image-handler version which supported automatic updates
	// and update database	
	$sql_query = "INSERT INTO " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) VALUES " .  
				"('图像管理模块版本', 'IH_VERSION', '" . $ihConf['version'] . "', '用于检查数据库版本是否与上传的文件版本一致。', 0, 100, 'zen_cfg_textarea_small(', now());";
	$db->Execute($sql_query);
  if (!defined('IH_VERSION')) define(IH_VERSION, $ihConf['version']);

}

// do we need to perform one or more updates?
function update_image_handler() {
  global $db;
	// check out what updates we need to perform starting
	// with old updates proceding to recent updates.
	
  // 2.0 UPDATE
  $version = '2.0';
  if (bmz_needs_update($version, IH_VERSION)) {
    $sql_query = "UPDATE " . TABLE_CONFIGURATION . " SET configuration_value='" . $version . "' WHERE configuration_key = 'IH_VERSION';";
    $db->Execute($sql_query);
  }
}
