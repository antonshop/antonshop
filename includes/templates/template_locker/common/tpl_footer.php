<?php
require(DIR_WS_MODULES . zen_get_module_directory('footer.php'));
?>

<div class="bottom">
    <div class="letter">
        <div class="letter_con">
            <span>Alphabetical Brand Index　#</span>
            <!-- bof productTags-->
            <?php
                // display productTagList
                foreach(range('a', 'z') as $letter) {
                    echo '<a  href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/'.strtoupper($letter).'.html" >'.strtoupper($letter).'</a>';
                }
                echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/0-9.html" >0-9</a>';
            ?>
            <!-- eof productTags-->
        </div>
    </div>
    <div class="ser_list">
        <div class="list_left">
            <dl class="list_one">
                <dt>SERVICE</dt>
                <dd><a href="<?php echo zen_href_link('contact_us', '' . '');?>">Contact Us</a></dd>
                <dd><a href="<?php echo zen_href_link('shippinginfo', '' . '');?>">Shipping & Returns</a></dd>
                <dd><a href="<?php echo zen_href_link('conditions', '' . '');?>">Conditions of Use</a></dd>
            </dl>
            <dl class="list_one">
                <dt>&nbsp;</dt>
                <dd><a href="<?php echo zen_href_link('page', '&id=8&chapter=0' . '');?>">about us</a></dd>
                <dd><a href="<?php echo zen_href_link('privacy', '' . '');?>">Privacy</a></dd>
                <dd><a href="<?php echo zen_href_link('gv_faq', '' . '');?>">Gift Certificate FAQ</a></dd>
            </dl>
            <dl class="list_one">
                <dt>FOLLOW</dt>
                <dd><a href="msnim:chat?contact=sunwin1968@hotmail.com">MSN</a></dd>
                <dd><a href="http://zh-cn.facebook.com/people/Lee-Linda/100002930497703">Facebook</a></dd>
                <dd><a href="http://twitter.com/#!/search/realtime/christinslee">Twitter</a></dd>
                <dd><a href="http://www.youtube.com/user/christinleeful?feature=mhsn">YouTube </a></dd>
            </dl>
        </div>
        <div class="list_right">
            <span class="friend">Tell a friend</span>
            <div class="fd_in">
            	<?php echo zen_draw_form('email_friend', zen_href_link(FILENAME_TELL_A_FRIEND, 'action=process')); ?>
                <input type="hidden" value="index" name="type">
                <input class="fd_text" type="text" name="to_email_address" /><input class="fd_sub" type="submit" value="" id="fd_submit"/></form>
            </div>
        </div>
    </div>
    <div class="pic_link">
        <div class="a_link">
        	<img src="<?php echo DIR_WS_TEMPLATE;?>images/a_one.gif" alt=""/>
            <img src="<?php echo DIR_WS_TEMPLATE;?>images/a_two.gif" alt=""/>
            <img src="<?php echo DIR_WS_TEMPLATE;?>images/a_thr.gif" alt=""/>
            <img src="<?php echo DIR_WS_TEMPLATE;?>images/a_for.gif" alt=""/>
        </div>
        <p class="p_word">
			<?php echo rss_feed_link(RSS_ICON) . rss_feed_link(); ?>
            <a href="<?php echo HTTP_SERVER . DIR_WS_CATALOG;?>sitemapindex.xml" class="bot_a">Site Map</a>
        </p>
        <p>Copyright&copy;2011  Powered by<a class="pic_a_link" href="www.abc.com">abcddd</a></p>
    </div>
</div>