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
<div id="slider">
					<div class="coin-slider" id="coin-slider-coin-slider">
                    <div id="coin-slider" style="width: 670px; height: 382px; position: relative; background-position: 0% 0%; ">
						<a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>scarf-c-5.html"><img src="images/banner6.jpg" alt="scarf" width="670" height="320" style=""></a>
                        <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>sweater-c-2.html"><img src="images/banner7.jpg" alt="sweater" width="670" height="320" style=""></a>
                        <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>bedding-c-1.html"><img src="images/banner8.jpg" alt="bedding" width="670" height="320" style=""></a>
                    </div>
                    <SCRIPT>$(document).ready(function() { $('#coin-slider').coinslider();});</SCRIPT>
				</div>
                </div>
<div class="centerColumn" id="indexDefault">
<!--<h1 id="indexDefaultHeading"><?php echo HEADING_TITLE; ?></h1>

<?php if (SHOW_CUSTOMER_GREETING == 1) { ?>
<h2 class="greeting"><?php echo zen_customer_greeting(); ?></h2>
<?php } ?>


<?php if (DEFINE_MAIN_PAGE_STATUS >= 1 and DEFINE_MAIN_PAGE_STATUS <= 2) { ?>
<?php
/**
 * get the Define Main Page Text
 */
?>
<div id="indexDefaultMainContent" class="content"><?php require($define_page); ?></div>
<?php } ?>-->

<?php
  $show_display_category = $db->Execute(SQL_SHOW_PRODUCT_INFO_MAIN);
  while (!$show_display_category->EOF) {
?>

<?php if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_FEATURED_PRODUCTS') { ?>
<?php
/**
 * display the Featured Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_featured_products.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_featured_products.php'); ?>
<?php } ?>


<?php if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_NEW_PRODUCTS') { ?>
<?php
/**
 * display the New Products Center Box
 */
?>
<?php require($template->get_template_dir('tpl_modules_whats_new.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_whats_new.php'); ?>
<?php } ?>

<?php if ($show_display_category->fields['configuration_key'] == 'SHOW_PRODUCT_INFO_MAIN_UPCOMING') { ?>
<?php
/**
 * display the Upcoming Products Center Box
 */
?>
<?php include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_UPCOMING_PRODUCTS)); ?><?php } ?>

<?php
  $show_display_category->MoveNext();
} // !EOF
?>
</div>