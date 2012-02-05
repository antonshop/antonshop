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
        	<div class="footer-menu">
        	<div id="navSupp">
                <div style="" class="ezpagesFooterCol col1">
                    <ul>
                      <li><a href="<?php zen_href_link('index');?>"<?php if($body_id == 'index'){?> class="activeILPage"<?php }?>>Home</a></li>
                    </ul>
                </div>
                <div style="" class="ezpagesFooterCol col2">
                    <ul>
                      <li><a href="<?php echo zen_href_link(FILENAME_CONDITIONS);?>"<?php if($body_id == 'conditions'){?> class="activeILPage"<?php }?>>Conditions of Use</a></li>
                    </ul>
                </div>
                <div style="" class="ezpagesFooterCol col3">
                    <ul>
                      <li><a href="<?php echo zen_href_link(FILENAME_SHIPPING);?>"<?php if($body_id == 'shippinginfo'){?> class="activeILPage"<?php }?>>Shipping & Returns</a></li>
                    </ul>
                </div>
                <div style="" class="ezpagesFooterCol col4">
                    <ul>
                      <li><a href="<?php echo zen_href_link(FILENAME_CONTACT_US);?>"<?php if($body_id == 'contactus'){?> class="activeILPage"<?php }?>>Contact Us</a></li>
                    </ul>
                </div>
                <div class="ezpagesFooterCol col6">
                    <ul>
                      <li><a href="<?php echo zen_href_link('page', '&id=8&chapter=0' . '');?>"<?php if($body_id == 'page'){?> class="activeILPage"<?php }?>>About Us</a></li>
                    </ul>
                </div>
                <br class="clearBoth">						
			</div>
            </div>
            <div class="copyright">
                <!-- ========== COPYRIGHT ========== -->
                Copyright © 2011 <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>">cashmere pants</a>. Powered by Accessorieslocker.com
            </div>
        	<div><!-- {%FOOTER_LINK} --></div>
        </div>
    </div>
</div>