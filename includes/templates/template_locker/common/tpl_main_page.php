<?php
  if (in_array($current_page_base,explode(",",'list_pages_to_skip_all_right_sideboxes_on_here,separated_by_commas,and_no_spaces')) ) {
    $flag_disable_right = true;
  }

  $header_template = 'tpl_header.php';
  $footer_template = 'tpl_footer.php';
  $left_column_file = 'column_left.php';
  $right_column_file = 'column_right.php';
  $body_id = ($this_is_home_page) ? 'indexHome' : str_replace('_', '', $_GET['main_page']);
?>
<body>
    <div class="hd_long">
        <div class="hd_one">
                <!-- AddThis Button BEGIN -->
                <!--  -->
                <!-- AddThis Button END -->
            
                <div class="one_center">
                <?php if ($_SESSION['customer_id']) { ?>
                    <?php echo(TOP_MENU_HELLO);?> <a class="name_color" href="<?php echo zen_href_link(FILENAME_ACCOUNT, '', 'SSL'); ?>"><?php echo ($_SESSION['customer_first_name'].' '.$_SESSION['customer_last_name']);?></a>&nbsp;&nbsp;
                    <a href="<?php echo zen_href_link(FILENAME_LOGOFF, '', 'SSL'); ?>"><?php echo HEADER_TITLE_LOGOFF; ?></a>
                <?php }else{?>
                    Welcome. Please 
                    <a href="index.php?main_page=create_account" class="hd_color">create an account</a> or 
                    <a href="<?php echo zen_href_link(FILENAME_LOGIN, '', 'SSL'); ?>" class="hd_color">Sign in</a>
                <?php }?>
                <a class="account" href="<?php echo zen_href_link('account', '', 'SSL'); ?>">My Account</a>
                <a class="account" href="<?php echo zen_href_link('account', 'action=order', 'SSL'); ?>">My Order</a>
                <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>blog" class="account">Blog</a> 
            </div>
            <div class="addthis_toolbox addthis_default_style " style="float:right;width:138px;margin-top:8px;">
                    <a class="addthis_button_preferred_1"></a>
                    <a class="addthis_button_preferred_2"></a>
                    <a class="addthis_button_preferred_3"></a>
                    <a class="addthis_button_preferred_4"></a>
                    <a class="addthis_button_compact"></a>
                    <a class="addthis_counter addthis_bubble_style"></a>
                </div>
                <div class="curr_doll">
            	<em>Currencies:</em>
            <?php require($template->get_template_dir('tpl_header_currencies.php',DIR_WS_TEMPLATE, $current_page_base,'templates'). '/tpl_header_currencies.php');
                echo $content;?>
            </div>
                <script type="text/javascript" src="http://s7.addthis.com/js/250/addthis_widget.js#pubid=xa-4e40fdac6104affb"></script>
        </div>
    </div>
    <div class="home">
        <?php require($template->get_template_dir('tpl_header.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_header.php');?>
        <div class="conment">
        	<?php if ((DEFINE_BREADCRUMB_STATUS == '1' || DEFINE_BREADCRUMB_STATUS == '2') && !$this_is_home_page ) { ?>
                <div class="con_nav">
                    <?php echo $breadcrumb->trail(BREAD_CRUMBS_SEPARATOR); ?>
                </div>
            <?php } ?>
				<? 
                $checkout_page = array("shoppingcart","checkoutshipping","checkoutpayment","checkoutconfirmation","checkoutsuccess");
                if(!in_array($body_id, $checkout_page) ){
                ?>
                <div class="con_left">
                    <?php require(DIR_WS_MODULES . zen_get_module_directory('column_left.php'));?>
                    <!--left Ad start-->
                    <div class="ad_pic">
                        <a href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/pic_one.jpg" alt=""/></a>
                        <a class="pic_special" href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/pic_two.jpg" alt=""/></a>
                        <a href="###"><img src="<?php echo DIR_WS_TEMPLATE;?>images/pic_thr.jpg" alt=""/></a>
                    </div>
                    <!--left Ad end-->
                </div>
                <?	
                }
                ?>
                
				<?
                if(!in_array($body_id, $checkout_page)){
                ?>
                    <?php $_GET['main_page'] == 'index' && !isset($_GET['cPath']) ? $con_class = 'con_center' : $con_class = 'con_right';?>
                    <div class="<?php echo $con_class;?>">
                        <?php require($body_code);?>
                    </div>
                <?					
                }else{
				?>
					<?php require($body_code);?>
				<?	
				}
                ?>

            
        </div>
        <?php require($template->get_template_dir('tpl_footer.php',DIR_WS_TEMPLATE, $current_page_base,'common'). '/tpl_footer.php'); ?>
    </div>
</body>