<?php
/**
 * Common Template - tpl_main_page.php
 *
 * Governs the overall layout of an entire page<br />
 * Normally consisting of a header, left side column. center column. right side column and footer<br />
 * For customizing, this file can be copied to /templates/your_template_dir/pagename<br />
 * example: to override the privacy page<br />
 * - make a directory /templates/my_template/privacy<br />
 * - copy /templates/templates_defaults/common/tpl_main_page.php to /templates/my_template/privacy/tpl_main_page.php<br />
 * <br />
 * to override the global settings and turn off columns un-comment the lines below for the correct column to turn off<br />
 * to turn off the header and/or footer uncomment the lines below<br />
 * Note: header can be disabled in the tpl_header.php<br />
 * Note: footer can be disabled in the tpl_footer.php<br />
 * <br />
 * $flag_disable_header = true;<br />
 * $flag_disable_left = true;<br />
 * $flag_disable_right = true;<br />
 * $flag_disable_footer = true;<br />
 * <br />
 * // example to not display right column on main page when Always Show Categories is OFF<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 * <br />
 * example to not display right column on main page when Always Show Categories is ON and set to categories_id 3<br />
 * <br />
 * if ($current_page_base == 'index' and $cPath == '' or $cPath == '3') {<br />
 *  $flag_disable_right = true;<br />
 * }<br />
 *
 * @package templateSystem
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_main_page.php 7085 2007-09-22 04:56:31Z ajeh $
 */

// the following IF statement can be duplicated/modified as needed to set additional flags
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }


  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'index' : str_replace('_', '', $_GET['main_page']);
?>
<body id="<?php echo $body_id . 'Body'; ?>"<?php if($zv_onload !='') echo ' onload="'.$zv_onload.'"'; ?>>

<!-- ========== IMAGE BORDER TOP ========== -->
<div class="wrapp">
<div class="main-width">

<?php require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>


<div class="extra">
<table border="0" cellspacing="0" cellpadding="0" width="100%" id="contentMainWrapper">
	<tbody><tr>
    
				
            <td id="column-left" style="width:230px;">
				<?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php')); ?>
            </td>
            <td id="column-center" valign="top">
                <div class="column-center-padding">
                	
	<!--content_center-->
<?php if ((DEFINE_BREADCRUMB_STATUS == '1' || DEFINE_BREADCRUMB_STATUS == '2') && !$this_is_home_page ) { ?>
<div id="navBreadCrumb"><?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?></div>
<?php } ?>

<?php
/**
* prepares and displays center column
*
*/
require($body_code); ?>                    
                
<div class="clear"></div>
                    
                    <!--eof content_center-->
                
                </div>
                
                
                <!-- BOF- BANNER #4 display -->
                                <!-- EOF- BANNER #4 display -->
							               
            </td>
			
		        
    </tr>
	<tr>
		<td colspan="2">
			<!--bof-navigation display -->
				<div id="navSuppWrapper">
					<div id="navSupp">
															
<div class="ezpagesFooterCol">
    <ul>
      <li class="cone"><a href="<?php zen_href_link('index');?>"<?php if($body_id == 'index'){?> class="activeILPage"<?php }?>>Home</a></li>

      <li><a href="<?php echo zen_href_link(FILENAME_CONDITIONS);?>"<?php if($body_id == 'conditions'){?> class="activeILPage"<?php }?>>Conditions of Use</a></li>

      <li><a href="<?php echo zen_href_link(FILENAME_SHIPPING);?>"<?php if($body_id == 'shippinginfo'){?> class="activeILPage"<?php }?>>Shipping & Returns</a></li>

      <li><a href="<?php echo zen_href_link(FILENAME_CONTACT_US);?>"<?php if($body_id == 'contactus'){?> class="activeILPage"<?php }?>>Contact Us</a></li>

      <li><a href="<?php echo zen_href_link('page', '&id=8&chapter=0' . '');?>"<?php if($body_id == 'page'){?> class="activeILPage"<?php }?>>About Us</a></li>
    </ul>
</div>
<br class="clearBoth">		
<div class="bottom_img">
	<img src="<?php echo DIR_WS_TEMPLATE;?>images/footer_icon.jpg" />
</div>								
				</div>
			</div>
			<!--eof-navigation display -->
		</td>
	</tr>
</tbody></table>
</div>

</div>
<!-- ========== FOOTER ========== -->
	<?php require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php'); ?>

</div>

</body>