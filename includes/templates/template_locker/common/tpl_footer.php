<?php
/**
 * Common Template - tpl_footer.php
 *
 * this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * make a directory /templates/my_template/privacy<br />
 * copy /templates/templates_defaults/common/tpl_footer.php to /templates/my_template/privacy/tpl_footer.php<br />
 * to override the global settings and turn off the footer un-comment the following line:<br />
 * <br />
 * $flag_disable_footer = true;<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_footer.php 15511 2010-02-18 07:19:44Z drbyte $
 */
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<div id="footer">
    <div class="main-width">
        <div class="wrapper">
            <div class="copyright">
                <!-- ========== COPYRIGHT ========== -->
                Copyright © 2011 <a href="<?php echo HTTP_SERVER . '';?>">Accessorieslocker</a>. Powered by <a href="http://www.zen-cart.com/">Accessorieslocker</a>
            </div>
        	<div><!-- {%FOOTER_LINK} --></div>
        </div>
    </div>
</div>