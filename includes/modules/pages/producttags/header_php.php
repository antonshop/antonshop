<?php


  $_SESSION['navigation']->remove_current_page();

  require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

// include template specific file name defines
  $define_page = zen_get_file_directory(DIR_WS_LANGUAGES . $_SESSION['language'] . '/html_includes/', FILENAME_DEFINE_PRODUCTTAGS, 'false');
  if (isset($_GET['letter'])){
  	$breadcrumb->add("Product tags " . $_GET['letter']);
  }else{
	  $breadcrumb->add(NAVBAR_TITLE);
  }
?>
