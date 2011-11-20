
<h1 class="mark_tit">Log in or register</h1>
<?php if ($messageStack->size('login') > 0) echo $messageStack->output('login'); ?>
<div class="reg_con">
    <h3 class="reg_small_tit">I'm A Returning Customer</h3>
    <div class="enter_box">
        <?php echo zen_draw_form('login', zen_href_link(FILENAME_LOGIN, 'action=process', 'SSL'), 'post', 'id="loginForm"'); ?>
            <label class="reg_enter">Email address:</label>
            <?php echo zen_draw_input_field('email_address', '', 'class="reg_text" id="login-email-address"'); ?>
            <label class="reg_enter">Password:</label>
            <?php echo zen_draw_password_field('password', '', 'class="reg_pass" id="login-password"'); ?>
			<?php echo zen_draw_hidden_field('securityToken', $_SESSION['securityToken']); ?>
            <span class="reg_span">Remember,your password is case sensitive</span>
            <span class="reg_forget"><a href="<?php echo zen_href_link(FILENAME_PASSWORD_FORGOTTEN, '', 'SSL');?>">Forgot your password?</a></span>
            <input class="reg_sub" type="submit" value=""/>
        </form>
    </div>
    <h3 class="reg_small_tit reg_tit_two">I'm A Returning Customer</h3>
    <div class="prompt">
            <p class="prompt_p">Save time and stay informed:track your order online,view your order history,create your<br/>favorites wishlist,and more!</p>
            <a href="<?php echo zen_href_link('create_account', '', 'SSL');?>" class="prompt_sub"></a>
    </div>
</div>

