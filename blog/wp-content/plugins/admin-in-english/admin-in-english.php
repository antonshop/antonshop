<?php 
/*
Plugin Name: Admin in English
Plugin URI: http://wordpress.org/extend/plugins/admin-in-english/
Description: Lets you have your backend administration panel in English, even if the rest of your blog is translated into another language.
Version: 1.1
Author: Nikolay Bachiyski
Author URI: http://nikolay.bg/
Tags: translation, translations, i18n, admin, english, localization, backend
*/

function admin_in_english_locale( $locale ) {
	if ( is_admin() || false !== strpos($_SERVER['REQUEST_URI'], '/wp-includes/js/tinymce/tiny_mce_config.php')
		|| false !== strpos($_SERVER['REQUEST_URI'], '/wp-login.php' ) ) {
		return 'zh_CN';
	}
	return $locale;
}
add_filter( 'locale', 'admin_in_english_locale' );

?>