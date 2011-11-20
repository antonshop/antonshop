<?php
/**
 * bmz_image_handler.php
 * english language definitions for image handler
 *
 * @author  Tim Kroeger <tim@breakmyzencart.com>
 * @author  Sam Lown
 * @copyright Copyright 2005-2006 breakmyzencart.com
 * @license http://www.gnu.org/licenses/gpl.txt GNU General Public License V2.0
 * @version $Id: bmz_image_handler.php,v 1.6 2006/05/01 12:13:12 tim Exp $
 */

define('BOX_TOOLS_IMAGE_HANDLER', '图像管理');
define('ICON_IMAGE_HANDLER','图像管理');
define('IH_VERSION_VERSION', '版本');
define('IH_VERSION_NOT_FOUND', '没有找到图像管理模块。');
define('IH_REMOVE', '删除图像管理模块');
define('IH_CONFIRM_REMOVE', '确定吗?');
define('IH_REMOVED', '成功删除图像管理模块。');
define('IH_UPDATE', '更新图像管理模块');
define('IH_UPDATED', '成功更新图像管理模块。');
define('IH_INSTALL', '安装图像管理模块');
define('IH_INSTALLED', '成功安装图像管理模块。');
define('IH_SCAN_FOR_ORIGINALS', '查找旧版的图像管理模块');
define('IH_CONFIRM_IMPORT', '确认要导入这些图像吗?<br /><strong>请先备份数据库和图像目录!</strong>');
define('IH_NO_ORIGINALS', '没有找到旧版的图像');
define('IH_IMAGES_IMPORTED', '导入图像。');
define('IH_CLEAR_CACHE', '清空图像缓存');
define('IH_CACHE_CLEARED', '图像缓存已清空。');

define('IH_SOURCE_TYPE', '源图像类型');
define('IH_SOURCE_IMAGE', '源图像');
define('IH_SMALL_IMAGE', '缺省图像');
define('IH_MEDIUM_IMAGE', '商品图像');

define('IH_ADD_NEW_IMAGE', '增加新图像');
define('IH_NEW_NAME_DISCARD_IMAGES', '使用新名称, 删除附加图像');
define('IH_NEW_NAME_COPY_IMAGES', '使用新名称, 复制附加图像');
define('IH_KEEP_NAME', '保存旧名称和附加图像');
define('IH_DELETE_FROM_DB_ONLY', '仅从数据库中删除图像链接');

define('IH_HEADING_TITLE', '图像管理');
define('IH_HEADING_TITLE_PRODUCT_SELECT','请选择要修改图像的商品。');

define('TABLE_HEADING_PHOTO_NAME', '图像名称');
define('TABLE_HEADING_DEFAULT_SIZE','缺省尺寸');
define('TABLE_HEADING_MEDIUM_SIZE', '中尺寸');
define('TABLE_HEADING_LARGE_SIZE','大尺寸');
define('TABLE_HEADING_ACTION', '操作');

define('TEXT_PRODUCT_INFO', '商品');
define('TEXT_PRODUCTS_MODEL', '型号');
define('TEXT_IMAGE_BASE_DIR', '图像目录');
define('TEXT_NO_PRODUCT_IMAGES', '本商品没有图像');
define('TEXT_CLICK_TO_ENLARGE', '点击放大');
define('TEXT_PRICED_BY_ATTRIBUTES', '按属性定价');
 
define('TEXT_INFO_IMAGE_INFO', '图像信息');
define('TEXT_INFO_NAME', '名称');
define('TEXT_INFO_FILE_TYPE', '文件类型');
define('TEXT_INFO_EDIT_PHOTO', '编辑图像');
define('TEXT_INFO_NEW_PHOTO', '新增图像');
define('TEXT_INFO_IMAGE_BASE_NAME', '图像名称(可选)');
define('TEXT_INFO_AUTOMATIC_FROM_DEFAULT', ' 自动 (根据缺省图像名称定义)');
define('TEXT_INFO_MAIN_DIR', '主目录');
define('TEXT_INFO_BASE_DIR', '图像目录');
define('TEXT_INFO_NEW_DIR', '给图像选择或设置新目录。');
define('TEXT_INFO_IMAGE_DIR', '图像目录');
define('TEXT_INFO_OR', '或');
define('TEXT_INFO_AUTOMATIC', '自动');
define('TEXT_INFO_IMAGE_SUFFIX', '图像后缀(可选)');
define('TEXT_INFO_USE_AUTO_SUFFIX','输入指定后缀，留空将自动生成后缀。');
define('TEXT_INFO_DEFAULT_IMAGE', '缺省图像文件');
define('TEXT_INFO_DEFAULT_IMAGE_HELP', '必须设置缺省图像。输入中图像或大图像时，缺省图像为小图像。');
define('TEXT_INFO_CONFIRM_DELETE', "确认删除");
define('TEXT_INFO_CONFIRM_DELETE_SURE', '您确认要删除该图像及其他大小的该图像吗?');
define('TEXT_INFO_SELECT_ACTION', '选择操作');
define('TEXT_INFO_CLICK_TO_ADD', '点击为该商品增加新图像');

define('TEXT_MSG_AUTO_BASE_ERROR', '没有缺省文件，不能自动选择基准。');
define('TEXT_MSG_INVALID_BASE_ERROR', '图像名称不对，或者无法找到缺省图像。');
define('TEXT_MSG_AUTO_REPLACE',  '自动替换名称中的无效字符，新名称为: ');
define('TEXT_MSG_INVALID_SUFFIX', '图像后缀无效。');
define('TEXT_MSG_IMAGE_TYPES_NOT_SAME_ERROR', '图像类型不同。');
define('TEXT_MSG_DEFAULT_REQUIRED_FOR_RESIZE', '自动调整大小需要缺省图像。');
define('TEXT_MSG_NO_DEFAULT', '没有指定缺省图像。');
define('TEXT_MSG_FILE_EXISTS', '文件已存在! 请修改名称或后缀。');
define('TEXT_MSG_INVALID_SQL', "无法执行SQL查询。");
define('TEXT_MSG_NOCREATE_IMAGE_DIR', "无法创建图像目录。");
define('TEXT_MSG_NOCREATE_MEDIUM_IMAGE_DIR', "无法创建中图像目录。");
define('TEXT_MSG_NOCREATE_LARGE_IMAGE_DIR', "无法创建大图像目录。");
define('TEXT_MSG_NOPERMS_IMAGE_DIR', "无法设置图像目录的权限。");
define('TEXT_MSG_NOPERMS_MEDIUM_IMAGE_DIR', "无法设置中图像目录的权限。");
define('TEXT_MSG_NOPERMS_LARGE_IMAGE_DIR', "无法设置大图像目录的权限。");

define('TEXT_MSG_NOUPLOAD_DEFAULT', "无法上传缺省图像文件。");
define('TEXT_MSG_NORESIZE', "无法调整图像大小");
define('TEXT_MSG_NOCOPY_LARGE', "无法复制大图像文件。");
define('TEXT_MSG_NOCOPY_MEDIUM', "无法复制中图像文件");
define('TEXT_MSG_NOCOPY_DEFAULT', "无法复制缺省图像文件。");
define('TEXT_MSG_NOPERMS_LARGE', "无法设置大图像文件的权限。");
define('TEXT_MSG_NOPERMS_MEDIUM', "无法设置中图像文件的权限。");
define('TEXT_MSG_NOPERMS_DEFAULT', "无法设置缺省图像文件的权限。");
define('TEXT_MSG_IMAGE_SAVED', '图像保存成功。');
define('TEXT_MSG_LARGE_DELETED', '大图像已删除。');
define('TEXT_MSG_NO_DELETE_LARGE', '无法删除大图像。');
define('TEXT_MSG_MEDIUM_DELETED', '中图像已删除');
define('TEXT_MSG_NO_DELETE_MEDIUM', '无法删除中图像。');
define('TEXT_MSG_DEFAULT_DELETED', '缺省图像已删除');
define('TEXT_MSG_NO_DELETE_DEFAULT', '无法删除缺省图像。');
define('TEXT_MSG_NO_DEFAULT_FILE_FOUND', "没有可删除的缺省图像。");

define('TEXT_MSG_IMAGE_DELETED', '删除图像成功。');
define('TEXT_MSG_IMAGE_NOT_FOUND', '找不到图像。');
define('TEXT_MSG_IMAGE_NOT_DELETED', '无法删除图像。');

define('TEXT_MSG_IMPORT_SUCCESS', '导入成功: ');
define('TEXT_MSG_IMPORT_FAILURE', '导入失败: ');
