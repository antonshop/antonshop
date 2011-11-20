SET @configuration_group_id=0;
SELECT (@configuration_group_id:=configuration_group_id) FROM configuration_group WHERE configuration_group_title= 'RSS Feed' LIMIT 1;
DELETE FROM configuration WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration_group WHERE configuration_group_id = @configuration_group_id AND configuration_group_id != 0;
DELETE FROM configuration WHERE configuration_key = 'RSS_FEED_VERSION';
	
INSERT INTO configuration_group (configuration_group_id, configuration_group_title, configuration_group_description, sort_order, visible) VALUES (NULL, 'RSS Feed', 'RSS Feed', '1', '1');
SET @configuration_group_id=last_insert_id();
UPDATE configuration_group SET sort_order = @configuration_group_id WHERE configuration_group_id = @configuration_group_id;

INSERT INTO configuration (configuration_id, configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added, use_function, set_function) VALUES (NULL, 'RSS 标题', 'RSS_TITLE', '', 'RSS 标题 (留空使用商店名称)', @configuration_group_id, 1, NOW(), NULL, NULL), (NULL, 'RSS 简介', 'RSS_DESCRIPTION', '', 'RSS 简介', @configuration_group_id, 2, NOW(), NULL, NULL), (NULL, 'RSS 图像', 'RSS_IMAGE', '', 'GIF、JPEG 或 PNG 图像', @configuration_group_id, 3, NOW(), NULL, NULL), (NULL, 'RSS 图像名称', 'RSS_IMAGE_NAME', '', 'RSS 图像名称 (留空使用商店名称)', @configuration_group_id, 4, NOW(), NULL, NULL), (NULL, 'RSS 版权', 'RSS_COPYRIGHT', '', 'RSS 版权 (留空使用店主姓名)', @configuration_group_id, 5, NOW(), NULL, NULL), (NULL, 'RSS 编辑器', 'RSS_MANAGING_EDITOR', '', 'RSS 编辑器 (留空使用店主邮件地址和姓名)', @configuration_group_id, 6, NOW(), NULL, NULL), (NULL, 'RSS 管理员', 'RSS_WEBMASTER', '', 'RSS 管理员(如果留空，将采用店主的邮件地址和姓名)', @configuration_group_id, 7, NOW(), NULL, NULL), (NULL, 'RSS 作者', 'RSS_AUTHOR', '', 'RSS 作者(如果留空，将采用店主的邮件地址和姓名)', @configuration_group_id, 8, NOW(), NULL, NULL), (NULL, 'RSS Feed 首页', 'RSS_HOMEPAGE_FEED', 'new_products', 'RSS Feed 首页', @configuration_group_id, 8, NOW(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),'), (NULL, 'RSS Feed 缺省', 'RSS_DEFAULT_FEED', 'new_products', 'RSS Feed 缺省', @configuration_group_id, 8, NOW(), NULL, 'zen_cfg_select_option(array(\'news\', \'new_products\', \'upcoming\', \'featured\', \'specials\', \'products\', \'categories\'),'), (NULL, '删除标签', 'RSS_STRIP_TAGS', 'false', '删除标签', @configuration_group_id, 20, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出简介', 'RSS_ITEMS_DESCRIPTION', 'true', '输出简介', @configuration_group_id, 21, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '简介长度', 'RSS_ITEMS_DESCRIPTION_MAX_LENGTH', '0', '简介显示多少字符？(0 代表无限制)', @configuration_group_id, 22, NOW(), NULL, NULL), (NULL, '更新时间', 'RSS_TTL', '1440', '更新时间 - 以分钟为单位的更新时间', @configuration_group_id, 23, NOW(), NULL, NULL), (NULL, '缺省商品限制', 'RSS_PRODUCTS_LIMIT', '100', '商品 Feed 的缺省限制', @configuration_group_id, 31, NOW(), NULL, NULL), (NULL, '添加商品图像', 'RSS_PRODUCTS_DESCRIPTION_IMAGE', 'true', '添加商品图像到商品描述标签', @configuration_group_id, 32, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '添加 "马上购买" 按钮', 'RSS_PRODUCTS_DESCRIPTION_BUYNOW', 'true', '添加 "马上购买" 按钮到商品描述标签', @configuration_group_id, 33, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '商品分类', 'RSS_PRODUCTS_CATEGORIES', 'master', '指定cPath参数时，商品选自 \'all\' 还是 \'master\' 主分类', @configuration_group_id, 23, NOW(), NULL, 'zen_cfg_select_option(array(\'master\', \'all\'),'), (NULL, '输出商品价格', 'RSS_PRODUCTS_PRICE', 'true', '输出商品价格(扩展标签 &lt;g:price&gt;)', @configuration_group_id, 90, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品编号', 'RSS_PRODUCTS_ID', 'true', '输出商品编号(扩展标签 &lt;g:id&gt;)', @configuration_group_id, 91, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品重量', 'RSS_PRODUCTS_WEIGHT', 'true', '输出商品重量(扩展标签 &lt;g:weight&gt;)', @configuration_group_id, 93, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品品牌', 'RSS_PRODUCTS_BRAND', 'true', '输出商品厂家(扩展标签 &lt;g:brand&gt;)', @configuration_group_id, 94, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品货币', 'RSS_PRODUCTS_CURRENCY', 'true', '输出商品货币(扩展标签 &lt;g:currency&gt;)', @configuration_group_id, 95, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品数量', 'RSS_PRODUCTS_QUANTITY', 'true', '输出商品数量(扩展标签 &lt;g:quantity&gt;)', @configuration_group_id, 96, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品型号', 'RSS_PRODUCTS_MODEL', 'true', '输出商品型号(扩展标签 &lt;g:model_number&gt;)', @configuration_group_id, 97, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品评价', 'RSS_PRODUCTS_RATING', 'true', '输出商品评价(扩展标签 &lt;g:rating&gt;)', @configuration_group_id, 98, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品图像', 'RSS_PRODUCTS_IMAGES', 'true', '输出商品图像(扩展标签 &lt;g:image_link&gt;)', @configuration_group_id, 98, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),'), (NULL, '输出商品图像大小', 'RSS_DEFAULT_IMAGE_SIZE', 'large', '输出图像的大小(扩展标签 &lt;g:image_link&gt;)', @configuration_group_id, 99, NOW(), NULL, 'zen_cfg_select_option(array(\'small\', \'medium\', \'large\'),'), (NULL, 'Feed 缓冲时间', 'RSS_CACHE_TIME', '10', '缓存时间(分钟)。如果不要缓存，设置为0', @configuration_group_id, 200, NOW(), NULL, 'zen_cfg_select_option(array(\'true\', \'false\'),');