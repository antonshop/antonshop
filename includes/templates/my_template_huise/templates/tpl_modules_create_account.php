<div class="zhuce">
	<?php if ($messageStack->size('create_account') > 0) echo $messageStack->output('create_account'); ?>
    <h3 class="zhuce_tit"><span class="zhuce_span">Create your Account　* </span><em>indicates a required field</em></h3>
    
    <?php echo zen_draw_form('create_account', zen_href_link(FILENAME_CREATE_ACCOUNT, '', 'SSL'), 'post', 'onsubmit="return check_form(create_account);" class="zhuce_form"') . zen_draw_hidden_field('action', 'process') . zen_draw_hidden_field('email_pref_html', 'email_format'); ?>
        <table cellspacing=8>
            <tr>
                <td class="td_lf"><label>Email Address:</label></td>
                <td>
                <?php echo zen_draw_input_field('email_address', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_email_address', '40') . ' id="email-address"') . (zen_not_null(ENTRY_EMAIL_ADDRESS_TEXT) ? '<span class="alert"><em>' . ENTRY_EMAIL_ADDRESS_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>Password:</label></td>
                <td><?php echo zen_draw_password_field('password', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-new"  class="zhuce_text"') . (zen_not_null(ENTRY_PASSWORD_TEXT) ? '<span class="alert"><em>' . ENTRY_PASSWORD_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>Confirm Password:</label></td>
                <td><?php echo zen_draw_password_field('confirmation', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_password', '20') . ' id="password-confirm"') . (zen_not_null(ENTRY_PASSWORD_CONFIRMATION_TEXT) ? '<span class="alert"><em>' . ENTRY_PASSWORD_CONFIRMATION_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>First Name:</label></td>
                <td>
                <?php echo zen_draw_input_field('firstname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_firstname', '40') . ' id="firstname"') . (zen_not_null(ENTRY_FIRST_NAME_TEXT) ? '<span class="alert"><em>' . ENTRY_FIRST_NAME_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>Last Name:</label></td>
                <td><?php echo zen_draw_input_field('lastname', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_lastname', '40') . ' id="lastname"') . (zen_not_null(ENTRY_LAST_NAME_TEXT) ? '<span class="alert"><em>' . ENTRY_LAST_NAME_TEXT . '</em></span>': ''); ?>
                </td>
            </tr>
            <tr>
                <td class="td_lf"><label>Country:</label></td>
                    <td><?php echo zen_get_country_list('zone_country_id', $selected_country, 'id="country" ' . 'onchange="update_zone(this.form);"') . (zen_not_null(ENTRY_COUNTRY_TEXT) ? '<span class="alert"><em>' . ENTRY_COUNTRY_TEXT . '</em></span>': ''); ?></td>
                </tr>
                <tr>
                    <td class="td_lf"><label>State/Province:</label></td>
                    <td>
					<?php
					  echo zen_draw_pull_down_menu('zone_id', zen_prepare_country_zones_pull_down($selected_country), $zone_id, 'id="stateZone"');
					  if (zen_not_null(ENTRY_STATE_TEXT)) echo '<span class="alert"><em>' . ENTRY_STATE_TEXT . '</em></span>'; 					?>
                    <label class="inputLabel" for="state" id="stateLabel"></label>
				<?php
					echo zen_draw_input_field('state', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_state', '40') . ' id="state"');
					if (zen_not_null(ENTRY_STATE_TEXT)) echo '<span class="alert" id="stText"><em>' . ENTRY_STATE_TEXT . '</em></span>';
				?>
                	</td>
            </tr>
            <tr>
                <td class="td_lf"><label>City:</label></td>
                <td>
                <?php echo zen_draw_input_field('city', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_city', '40') . ' id="city"') . (zen_not_null(ENTRY_CITY_TEXT) ? '<span class="alert"><em>' . ENTRY_CITY_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>Street Address:</label></td>
                <td><?php echo zen_draw_input_field('street_address', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_street_address', '40') . ' id="street-address"') . (zen_not_null(ENTRY_STREET_ADDRESS_TEXT) ? '<span class="alert"><em>' . ENTRY_STREET_ADDRESS_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>Post/Zip Code:</label></td>
                <td><?php echo zen_draw_input_field('postcode', '', zen_set_field_length(TABLE_ADDRESS_BOOK, 'entry_postcode', '40') . ' id="postcode"') . (zen_not_null(ENTRY_POST_CODE_TEXT) ? '<span class="alert"><em>' . ENTRY_POST_CODE_TEXT . '</em></span>': ''); ?></td>
            </tr>
            <tr>
                <td class="td_lf"><label>Telephone:</label></td>
                <td><?php echo zen_draw_input_field('telephone', '', zen_set_field_length(TABLE_CUSTOMERS, 'customers_telephone', '40') . ' id="telephone"') . (zen_not_null(ENTRY_TELEPHONE_NUMBER_TEXT) ? '<span class="alert"><em>' . ENTRY_TELEPHONE_NUMBER_TEXT . '</em></span>': ''); ?></td>
            </tr>
        </table>
        <input class="zhuce_sub" type="submit" value=""/>
    </form>
</div>
<script type="text/javascript">update_zone(document.create_account);</script>

