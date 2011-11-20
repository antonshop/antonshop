功能:
=========
给Zen Cart网店系统生成完善的 RSS Feed



安装说明:
========
0. 备份！ 备份！ 备份！ 备份！ 备份！ 备份！

1. 解压并上传所有新文件到商店目录;

2. 管理页面->工具->安装 SQL 脚本，执行 install.sql (不要用上传 - 用剪贴功能安装 sql 脚本)

3. 管理页面>商店设置>RSS Feed，并设置相应参数;

4. （可选）在 html_header.php 文件中的 <head> 和 </head> 之间加上:
<?php echo rss_feed_link_alternate(); // RSS Feed ?>

5. （可选）在 tpl_footer.php 或其他文件中加上RSS的链接:
<!--bof RSS Feed -->
<div id="RSSFeedLink"><?php echo rss_feed_link(RSS_ICON); ?></div>
<!--eof RSS Feed -->

—————————————————－
请访问Zen Cart中文论坛获取更多资料
http://www.zen-cart.cn
