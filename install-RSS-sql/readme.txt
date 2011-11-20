Name
====
RSS Feed

Version Date
==============
v 2.1.4 14.02.2008 15:26

Author
======
Andrew Berezin http://eCommerce-Service.com

Description
===========
This Script generates an RSS Feed in RSS 2.0 format.
RSS 2.0 Specification - http://blogs.law.harvard.edu/tech/rss

Affected files
==============
/includes/templates/YOUR_TEMPLATE/common/html_header.php
/includes/templates/YOUR_TEMPLATE/common/tpl_footer.php

Affects DB
==========
Yes (creates new records into configuration_group and configuration tables)

DISCLAIMER
==========
Installation of this contribution is done at your own risk.
Backup your ZenCart database and any and all applicable files before proceeding.

Features:
=========
Generate RSS Feed for:
feed=categories - Categories;
feed=categories&cPath=<cPath> - Categories in <cPath>;
feed=products - All Products
feed=products - Products in category
feed=products - Product by ID
feed=products - Product by MODEL
feed=new_products - New products
feed=new_products&cPath=<cPath> - New products in category
feed=new_products_random - New products random
feed=new_products_random&cPath=<cPath> - New products random in category
feed=best_sellers - Best sellers
feed=best_sellers&cPath=<cPath> - Best sellers in category <cPath>
feed=best_sellers_random - Best sellers random
feed=best_sellers_random&cPath=<cPath> - Best sellers random in category <cPath>
feed=specials - Specials
feed=specials_random - Specials random
feed=featured - Featured
feed=featured_random - Featured random
feed=upcoming - Upcoming
feed=upcoming&cPath=<cPath> - Upcoming in category <cPath>
feed=upcoming_random - Upcoming random
feed=upcoming_random&cPath=<cPath> - Upcoming random in category <cPath>
feed=news - News from News & Articles contribution (http://www.zen-cart.com/forum/showthread.php?t=35342).

Addition parameters: 
- Parameter "limit" support for all feeds except "random".
- Parameter "ref". If you specify a parameter 'ref=' for the rss feed link, it will be automatically added to all internal links
   generated in the feed (links to products, categories, reviews, articles, buy now, etc.). 
   You can use it for affilation program.
- Google Analitycs parameters (link tags). If you specify a Google Analytics link tags for the rss feed link,
   they will be automatically added to all internal links generated in the feed
   (links to products, categories, reviews, articles, buy now, etc.).
   For more information please read article "How do I tag my links?" on Google Analytics Help Center -
   http://www.google.com/support/googleanalytics/bin/answer.py?answer=55518
- Parameter "imgsize". You can point to how size images generate links in <g:image_link> tag (small, medium, large).


Support additional Google Base tags (Base and Custom Namespaces) 
(http://base.google.com/support/bin/answer.py?answer=58085). 

Using cache.

Add product image and BuyNow button to product description.

RSS is a powerful marketing tool!!!

Install:
========
0. BACKUP! BACKUP! BACKUP! BACKUP! BACKUP! BACKUP!
1. Unzip and upload all new files to your store directory;
2. Go to Admin->Tools->Install SQL Patches and install install.sql (don't use upload - use copy/paste to install sql).
   (if you use Admin Profiles or Admin with Levels you must setting needed permission);
3. Go to Admin>Configuration>RSS Feed and setting up your RSS Feed configuration;
4. You can add to html_header.php somewhere beetwen <head> and </head> tags:
<?php echo rss_feed_link_alternate(); // RSS Feed ?>
5. You can add to tpl_footer.php or where you want:
<!--bof RSS Feed -->
<div id="RSSFeedLink"><?php echo rss_feed_link(RSS_ICON); ?></div>
<!--eof RSS Feed -->
6. The CSS/XSL files are sent from /includes/templates/YOUR_TEMPLATE/css/ to the browser in this order:
   (and alphabetically within each case of more than one match):
     rss*.css   // are always loaded and at least ONE should contain site-wide properties.
     rss*.xsl   // are always loaded and at least ONE should contain site-wide properties.

Tips
====
1. All about RSS feed you can read at http://en.wikipedia.org/wiki/Rss
2. Use http://www.feedreader.net/ or same agregators sites.
3. You can create EZ-page with description of all your RSS Channels
4. Use http://feedvalidator.org/ to validate your RSS-Channels.

History
=======
v 2.0.0 20.09.2007 13:08
Initial version
v 2.0.1 20.09.2007 13:08
1. Add product image to product description tag;
2. Add "buy now" button to product description tag;
v 2.0.2 27.09.2007 12:45
1. Bug fixes;
2. Add 'RSS Home Page Feed' and 'RSS Default Feed' admin parameters;
3. Add support to <cloud> sub-element;
4. Extract rss_feed class to file /classes/rss_feed.php.
v 2.0.3 28.09.2007 19:21
1. Bug fixes;
2. Code optimization;
v 2.0.4 18.10.2007 15:04
1. Bug fixes;
2. Code optimization;
v 2.0.5 20.10.2007 15:47
1. Bug fixes;
v 2.0.7 27.10.2007 17:52
1. Bug fixes (Thanks to Paulm);
2. Add more <link rel="alternate" type="application/rss+xml";
3. Add extended RSS-title (Thanks to Paulm for this idea);
v 2.0.8 28.10.2007 16:44
1. Add <atom:link href="xxxx" rel="self" type="application/rss+xml" />
2. Lot of little cosmetic changes, code optimization.
3. Some bugs fixed.
4. Add two functions: rss_feed_href() and rss_feed_name().
5. Bug fix in *.sql.
6. Clear html onmouseout and onmouseover in buynow button.
v 2.0.9 29.11.2007 13:28
1. Bug fix in function rss_feed_link();
2. Security bug fix;
3. Bug fix in function rss_feed_link_alternate();
v 2.0.10 23.01.2008 13:28
1. Remove php close tag '?>' from all included files;
v 2.1.0 18.01.2008 7:57
1. Add support for GET 'ref=' parameter. Now you can use it for affilation program.
   If you specify a parameter 'ref=' for the rss feed link, it will be automatically added to all internal links
   generated in the feed (links to products, categories, reviews, articles, buy now, etc.).
2. Add support for Google Analytics link tags. If you specify a Google Analytics link tags for the rss feed link,
   they will be automatically added to all internal links generated in the feed
   (links to products, categories, reviews, articles, buy now, etc.).
   For more information please read article "How do I tag my links?" on Google Analytics Help Center -
   http://www.google.com/support/googleanalytics/bin/answer.py?answer=55518
v 2.1.1 25.01.2008 14:40
1. Bugfix in rss_feed_title();
2. Add new language constant:
define('TEXT_RSS_BEST_SELLERS', 'RSS Best Sellers Feed');
3. Add 'best_sellers' feed to function rss_feed_link_alternate().
v 2.1.2 26.01.2008 18:32
1. Bugfix. Price - now use current currency.
2. Bugfix in zen_rss_products() with using $additionalURL.
3. Add support for GET 'imgsize=' parameter.
   You can point to how size images generate links in <g:image_link> tag (small, medium, large).
4. Bugfix: Generate google namespace tags only if Google namespace enable.
v 2.1.3 27.01.2008 16:37
1. Remove Enable/Disable Google namespace parameter. Already use Google namespace.
2. Add Google Custom Namespace Declaration.
3. Bugfix - add tax to price (use function zen_add_tax()).
4. Use cache for non random feeds.
v 2.1.4 14.02.2008 15:26
1. Fix typo in rss_feed_title();
2. Bugfix - fixed duplicated products;
3. Move all cache functions to rss_feed class.
4. Add cache files clear.