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
<div class="head">
    <div class="hd_two">
        <div class="logo"><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>"><img src="<?php echo DIR_WS_TEMPLATE;?>images/logo.jpg" alt="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>"/></a></div>
        <div class="two_center">
            <div class="search">
                <form action="index.php?main_page=advanced_search_result" method="get" name="quick_find_header">
                    <input type="hidden" value="advanced_search_result" name="main_page">
                    <input type="hidden" value="1" name="search_in_description">
                    <input class="text" name="keyword" type="text"  value="<?php //echo HEADER_SEARCH_DEFAULT_TEXT;?>" onFocus="if (this.value == '<?php //echo HEADER_SEARCH_DEFAULT_TEXT;?>') this.value ='';" onBlur="if (this.value == '') this.value = '<?php //echo HEADER_SEARCH_DEFAULT_TEXT;?>';" />
                    <input id="search_sub" class="sub" type="submit" value="" />
                </form>
            </div>
        </div>
        <div class="hd_pic">
        	<img src="<?php echo DIR_WS_TEMPLATE;?>images/days.jpg" alt=""/>&nbsp;&nbsp;
            <img src="<?php echo DIR_WS_TEMPLATE;?>images/free.jpg" alt=""/>
        </div>
    </div>
                                                                    <!-- nav -->
    <div class="hd_nav">
        <div class="nav_left"><a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>">HOME</a></div>
        <?php require($template->get_template_dir('tpl_modules_category_dropdown.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_modules_category_dropdown.php'); ?>
        <div class="nav_right"><a href="javascript:;" id="strike">ALL CATEGORIES</a></div>
    </div>
    <div class="cate_list" id="memu">
        <ul>
        <?php if($category_parent){
				foreach($category_parent as $item){?>
            <li><a href="<?php echo zen_href_link(FILENAME_DEFAULT, "cPath=".$item['categories_id']."")?>" class="nav_a"> <?php echo $item['name'];?></a></li>
        <?php }}?>
        </ul>
    </div>


    <div class="hd_for">
        <span class="span_cart">
    		<?php require($template->get_template_dir('tpl_shopping_cart_header.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_shopping_cart_header.php'); 
				echo $content;?>
			<?php if ($_SESSION['cart']->count_contents() != 0) { ?>
				&nbsp;| <a href="<?php echo zen_href_link(FILENAME_CHECKOUT_SHIPPING, '', 'SSL'); ?>"><?php echo HEADER_TITLE_CHECKOUT; ?></a>
			<?php }?>
         </span>
    </div>
</div>
