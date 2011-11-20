<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: alert_page.php 17421 2010-08-31 00:23:52Z drbyte $
 */
require ('includes/application_top.php');
$adminDirectoryExists = $installDirectoryExists = FALSE;
if (substr(DIR_WS_ADMIN, -7) == '/admin/' || substr(DIR_WS_HTTPS_ADMIN, -7) == '/admin/')
{
   $adminDirectoryExists = TRUE;
}
$check_path = dirname($_SERVER['SCRIPT_FILENAME']) . '/../zc_install';
if (is_dir($check_path))
{
  $installDirectoryExists = TRUE;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Zen Cart!</title>
<meta name="robot" content="noindex, nofollow" />
</head>
<body>
	<div style="width:400px;margin:auto;margin-top:10%;border:5px red solid;padding:20px 50px 50px 50px;background-color:#FFAFAF;">
	<h1 style="text-align: center;font-size:40px;color:red;margin:0;"><?php echo HEADING_TITLE; ?></h1>
	<p style=""><?php echo ALERT_PART1; ?></p>
	<ul style="">
	<?php if ($installDirectoryExists) { ?>
	<li><?php echo ALERT_REMOVE_ZCINSTALL; ?><br /><br /></li>
	<?php  } ?>
	<?php if ($adminDirectoryExists) { ?>
	<li><?php echo ALERT_RENAME_ADMIN; ?><br /><a href="http://www.zen-cart.cn/forum/zen-cart-security-t11094.html" target="_blank"><?php echo ADMIN_RENAME_FAQ_NOTE; ?></a></li>
	<?php  } ?>
	</ul>
	<br />
	<p class=""><?php echo ALERT_PART2; ?></p>
	</div>
</body>
</html>
