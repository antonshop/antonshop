<?php
/**
 * @package languageDefines
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: freeoptions.php 3830 2006-06-21 23:47:16Z ajeh $
 */

define('MODULE_SHIPPING_FREEOPTIONS_TEXT_TITLE', '免运费选择');
define('MODULE_SHIPPING_FREEOPTIONS_TEXT_DESCRIPTION', '
免运费选择用于在显示其他配送方式时，显示免运费选项。
可以基于: 总是显示，订单总额，订单重量 或 商品数量。
免运费模块显示时，不会显示免运费选择模块<br /><br />
设置总额为 >= 0.00 且 <= 无 (留空) 将设置本模块与其他除了免运费模块外的配送模块一起显示。<br /><br />
说明: 所有总额，种类和数量的设置都为空，将关闭本模块。<br /><br />
说明: 如果免运费是基于0重量，免运费选择模块将不会显示。 
见: 免运费模块
');
define('MODULE_SHIPPING_FREEOPTIONS_TEXT_WAY', '免运费');

?>