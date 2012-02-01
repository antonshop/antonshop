<?php
/**
 * Override Template for common/tpl_main_page.php
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: sitemapxml.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */

$zen_SiteMapXML->message('<body id="sitemapxmlBody">');
$zen_SiteMapXML->message('<div id="mainWrapper">');
$zen_SiteMapXML->message('<div class="centerColumn" id="siteMapXML">');
$zen_SiteMapXML->message('<h1 id="siteMapXMLHeading">' . HEADING_TITLE . '</h1>');

if ($genxml) {
  foreach ($SiteMapXMLmodules as $module) {
    $zen_SiteMapXML->SitemapClose();
    include($module);
  }
}
$zen_SiteMapXML->GenerateSitemapIndex();

$time_end = explode (' ', microtime());
$total_time = $time_end[1]+$time_end[0]-$time_start[1]-$time_start[0];
?>
<div><?php echo TEXT_EXECUTION_TIME . ' ' . $zen_SiteMapXML->timefmt($total_time); ?></div>
</div>
</div>
</body>