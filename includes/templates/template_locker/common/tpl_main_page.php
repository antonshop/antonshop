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
                	<div id="slider">
					<div class="coin-slider" id="coin-slider-coin-slider"><div id="coin-slider" style="width: 710px; height: 382px; position: relative; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); background-position: 0% 0%; ">
						<a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=1"><img src="./Zen Cart!, The Art of E-commerce_files/banner1.jpg" alt="" width="710" height="382" style="display: none; "></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=2"><img src="./Zen Cart!, The Art of E-commerce_files/banner2.jpg" alt="" width="710" height="382" style="display: none; "></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3"><img src="./Zen Cart!, The Art of E-commerce_files/banner3.jpg" alt="" width="710" height="382" style="display: none; "></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=4"><img src="./Zen Cart!, The Art of E-commerce_files/banner4.jpg" alt="" width="710" height="382" style="display: none; "></a>					<div class="cs-title" id="cs-title-coin-slider" style="position: absolute; bottom: 0px; left: 0px; z-index: 1000; opacity: 0; "></div><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider11" style="width: 33px; height: 382px; float: left; position: absolute; left: 0px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: 0px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider12" style="width: 33px; height: 382px; float: left; position: absolute; left: 33px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -33px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider13" style="width: 33px; height: 382px; float: left; position: absolute; left: 66px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -66px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider14" style="width: 33px; height: 382px; float: left; position: absolute; left: 99px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -99px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider15" style="width: 33px; height: 382px; float: left; position: absolute; left: 132px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -132px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider16" style="width: 33px; height: 382px; float: left; position: absolute; left: 165px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -165px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider17" style="width: 32px; height: 382px; float: left; position: absolute; left: 198px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -198px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider18" style="width: 32px; height: 382px; float: left; position: absolute; left: 230px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -230px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider19" style="width: 32px; height: 382px; float: left; position: absolute; left: 262px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -262px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider110" style="width: 32px; height: 382px; float: left; position: absolute; left: 294px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -294px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider111" style="width: 32px; height: 382px; float: left; position: absolute; left: 326px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 1; background-position: -326px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider112" style="width: 32px; height: 382px; float: left; position: absolute; left: 358px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 0.9676000000000001; background-position: -358px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider113" style="width: 32px; height: 382px; float: left; position: absolute; left: 390px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 0.8207888888888889; background-position: -390px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider114" style="width: 32px; height: 382px; float: left; position: absolute; left: 422px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 0.6359888888888888; background-position: -422px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider115" style="width: 32px; height: 382px; float: left; position: absolute; left: 454px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 0.3384888888888889; background-position: -454px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider116" style="width: 32px; height: 382px; float: left; position: absolute; left: 486px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner3.jpg); opacity: 0; background-position: -486px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider117" style="width: 32px; height: 382px; float: left; position: absolute; left: 518px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); opacity: 1; background-position: -518px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider118" style="width: 32px; height: 382px; float: left; position: absolute; left: 550px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); opacity: 1; background-position: -550px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider119" style="width: 32px; height: 382px; float: left; position: absolute; left: 582px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); opacity: 1; background-position: -582px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider120" style="width: 32px; height: 382px; float: left; position: absolute; left: 614px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); opacity: 1; background-position: -614px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider121" style="width: 32px; height: 382px; float: left; position: absolute; left: 646px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); opacity: 1; background-position: -646px 0px; " target=""></a><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=redirect&action=banner&goto=3" class="cs-coin-slider" id="cs-coin-slider122" style="width: 32px; height: 382px; float: left; position: absolute; left: 678px; top: 0px; background-image: url(http://livedemo00.template-help.com/zencart_35883/images/banner2.jpg); opacity: 1; background-position: -678px 0px; " target=""></a><div id="cs-navigation-coin-slider" style="display: none; "><a href="http://livedemo00.template-help.com/zencart_35883/#" id="cs-prev-coin-slider" class="cs-prev" style="position: absolute; z-index: 1001; line-height: 30px; ">prev</a><a href="http://livedemo00.template-help.com/zencart_35883/#" id="cs-next-coin-slider" class="cs-next" style="position: absolute; z-index: 1001; line-height: 30px; ">next</a></div></div>
                        <div id="cs-buttons-coin-slider" class="cs-buttons">
                        <a href="#" class="cs-button-coin-slider" id="cs-button-coin-slider-1">1</a>
                        <a href="#" class="cs-button-coin-slider" id="cs-button-coin-slider-2">2</a>
                        <a href="#" class="cs-button-coin-slider cs-active" id="cs-button-coin-slider-3">3</a>
                        <a href="#" class="cs-button-coin-slider" id="cs-button-coin-slider-4">4</a>
                        </div>
                    </div>
				</div>
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
															
<div class="ezpagesFooterCol col1" style="width: 14%">
<ul>
  <li><a href="./Zen Cart!, The Art of E-commerce_files/Zen Cart!, The Art of E-commerce.htm" class="activeILPage">Home</a></li>
</ul>
</div>
<div class="ezpagesFooterCol col2" style="width: 14%">
<ul>
  <li><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=products_new">New Products</a></li>
</ul>
</div>
<div class="ezpagesFooterCol col3" style="width: 14%">
<ul>
  <li><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=specials">Specials</a></li>
</ul>
</div>
<div class="ezpagesFooterCol col4" style="width: 14%">
<ul>
  <li><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=products_all">Products All</a></li>
</ul>
</div>
<div class="ezpagesFooterCol col5" style="width: 14%">
<ul>
  <li><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=reviews">Reviews</a></li>
</ul>
</div>
<div class="ezpagesFooterCol col6" style="width: 14%">
<ul>
  <li><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=contact_us">Contact Us</a></li>
</ul>
</div>
<div class="ezpagesFooterCol col7" style="width: 14%">
<ul>
  <li><a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=gv_faq">FAQs</a></li>
</ul>
</div><br class="clearBoth">										
				</div>
			</div>
			<!--eof-navigation display -->
		</td>
	</tr>
</tbody></table>
</div>




</div>
<!-- ========== FOOTER ========== -->



	<div id="footer">
		<div class="main-width">
			<div class="wrapper">
				<div class="copyright">
					<!-- ========== COPYRIGHT ========== -->
						Copyright © 2011 <a href="./Zen Cart!, The Art of E-commerce_files/Zen Cart!, The Art of E-commerce.htm" target="_blank">La Prima</a>. Powered by <a href="http://www.zen-cart.com/" target="_blank">Zen Cart</a> <a href="http://livedemo00.template-help.com/zencart_35883/index.php?main_page=privacy">Privacy Notice</a>
				
											<!-- =============================== -->
				</div>
								<div><!-- {%FOOTER_LINK} --></div>
							</div>
		</div>
	</div>


</div>

<!--LIVEDEMO_00 -->

<script type="text/javascript">
 var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-7078796-5']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();</script>

</body>