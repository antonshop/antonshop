<?php
/**
 * Page Template
 *
 * Main index page<br />
 * Displays greetings, welcome text (define-page content), and various centerboxes depending on switch settings in Admin<br />
 * Centerboxes are called as necessary
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_index_default.php 3464 2006-04-19 00:07:26Z ajeh $
 */
?>
<div class="active" id="getout">
    <div class="act_border">
        <table id="mm" cellspacing=0 cellpadding=0>
            <tr>
                <td><a href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/1.jpg" alt=""/></a></td>
                <td><a href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/2.jpg" alt=""/></a></td>
                <td><a href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/3.jpg" alt=""/></a></td>
                <td><a href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/4.jpg" alt=""/></a></td>
            </tr>
        </table>
        <div id="number" class="number">
            <a class="first"href="###">1</a>
            <a href="###">2</a>
            <a href="###">3</a>
            <a href="###">4</a>
        </div> 
    </div>
</div>
<script src="<?php echo DIR_WS_TEMPLATE;?>jscript/active.js" type="text/javascript"></script>
<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php require($template->get_template_dir('tpl_modules_specials_default.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_specials_default.php'); ?>
