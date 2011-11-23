<?php
  // Display all header alerts via messageStack:
  if ($messageStack->size('header') > 0) {
    echo $messageStack->output('header');
  }
  if (isset($_GET['error_message']) && zen_not_null($_GET['error_message'])) {
  echo htmlspecialchars(urldecode($_GET['error_message']));
  }
  if (isset($_GET['info_message']) && zen_not_null($_GET['info_message'])) {
   echo htmlspecialchars($_GET['info_message']);
} else {

}
?>
<!-- ========== HEADER ========== -->

	<div id="header">
		<div class="wrapper">
			<div class="logo">
				<!-- ========== LOGO ========== -->
					<a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>"><img src="<?php echo DIR_WS_TEMPLATE;?>images/logo.jpg" alt="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>"/></a>
				<!-- ========================== -->
			</div>
			<div class="cart">
				<!-- ========== SHOPPING CART ========== -->
                <?php require($template->get_template_dir('tpl_shopping_cart_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_shopping_cart_header.php'); 
				echo $content;?>
			<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
				&nbsp;| <a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a>
			<?php }?>
				<!-- =================================== -->
			</div>
			<div class="header-right">
				<div class="lang">
					<!-- ========== LANGUAGES ========== -->
						<a href="index.php?main_page=index&language=en"><img src="./Zen Cart!, The Art of E-commerce_files/icon.gif" alt="English" title=" English " width="24" height="15" style="vertical-align:middle;"></a>					<!-- =============================== -->
				</div>
				<div class="search">
					<!-- ========== SEARCH ========== -->
							
                  <form name="quick_find_header" action="index.php?main_page=advanced_search_result" method="get" name="quick_find_header">
                    <input type="hidden" value="advanced_search_result" name="main_page">
                    <input type="hidden" value="1" name="search_in_description">
                    <input class="input1" name="keyword" type="text"  value="Search:" onFocus="if (this.value == 'Search:') this.value ='';" onBlur="if (this.value == '') this.value = 'Search:<?php //echo HEADER_SEARCH_DEFAULT_TEXT;?>';" />
                    <!--<input id="search_sub" class="sub" type="submit" value="" />-->
                </form>
					<!-- ============================ -->
				</div>
				<div class="navigation">
					<!-- ========== NAVIGATION LINKS ========== -->
                    <a href="">Home</a>&nbsp; | &nbsp; 
                    <a href="index.php?main_page=login">Log In</a>&nbsp; | &nbsp;
					<!--<a href="index.php?main_page=create_account">Register</a>-->
					<!-- ====================================== -->
				</div>
			</div>
		</div>
		<div class="box2">
			<div class="menu">
				<!-- ========== MENU ========== -->
				<div id="navEZPagesTop"> 
 				<ul>
                    <li class="selected  first"><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>">Home</a></li>
                    <li><a href="<?php echo zen_href_link('products_new', '', 'SSL'); ?>">NewsProducts</a></li>
                    <li><a href="<?php echo zen_href_link('featured_products', '', 'SSL'); ?>">Featured Products</a></li>
                    <li><a href="<?php echo zen_href_link('specials', '', 'SSL'); ?>">Specials</a></li>
                    <li><a href="<?php echo zen_href_link('create_account', '', 'SSL'); ?>">Register</a></li>
                    <li><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>blog">Blog</a></li>
     			</ul> 
			</div>
			<!-- ========================== -->
			</div>
			<div class="currencies">
				<!-- ========== CURRENCIES ========= -->
					<form name="currencies" action="" method="get" class="jqtransformdone">						<div>
						
                        <span class="label">Currencies: &nbsp;</span>
					
                        <div class="jqTransformSelectWrapper" style="z-index: 10; width: 124px; "><div><span style="width: 122px; ">US Dollar</span><a href="#" class="jqTransformSelectOpen"></a></div><ul style="width: 122px; height: 80px; overflow-x: hidden; overflow-y: hidden; display: none; visibility: visible; "><li><a href="#" index="0" class="selected">US Dollar</a></li><li><a href="#" index="1">Euro</a></li><li><a href="#" index="2">GB Pound</a></li><li><a href="#" index="3">Canadian Dollar</a></li><li><a href="#" index="4">Australian Dollar</a></li></ul><select name="currency" class="select jqTransformHidden" onchange="this.form.submit();" style="">
      <option value="USD" selected="selected">US Dollar</option>
      <option value="EUR">Euro</option>
      <option value="GBP">GB Pound</option>
      <option value="CAD">Canadian Dollar</option>
      <option value="AUD">Australian Dollar</option>
    </select></div>
    <input type="hidden" name="main_page" value="index">						</div>
					</form>
				<!-- ====================================== -->
			</div>
		</div>
	</div>
