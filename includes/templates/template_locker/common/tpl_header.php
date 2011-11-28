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
				<!-- ========== LANGUAGES ========== -->
                <div class="lang">
					<!--<a href="index.php?main_page=index&language=en"><img src="" alt="English" title=" English "></a>-->					
				</div>
                <!-- =============================== -->
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
       				<?php if ($_SESSION['customer_id']) { ?>
						<?php echo(TOP_MENU_HELLO);?> <a class="name_color" href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo ($_SESSION['customer_first_name'].' '.$_SESSION['customer_last_name']);?></a>&nbsp; | &nbsp;
                        <a href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>">My Account</a>&nbsp; | &nbsp;
                        <a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a>
                    <?php }else{?>
                        <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>">Home</a>&nbsp; | &nbsp; 
                        <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>">Log In</a>&nbsp; | &nbsp;
                        <a href="<?php echo zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'); ?>">Sign Up</a>
                    <?php }?>                
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
        			<?php require($template->get_template_dir('tpl_modules_category_dropdown.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_dropdown.php'); ?>
     			</ul> 
			</div>
			<!-- ========================== -->
			</div><script type="text/javascript">
$(function(){
   $('.currencies form').jqTransform({imgPath:'jqtransformplugin/img/'});
});
</script>
			<div class="currencies">
				<?php require($template->get_template_dir('tpl_header_currencies.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_header_currencies.php');
                echo $content;?>
			</div>
		</div>
	</div>
