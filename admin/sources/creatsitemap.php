<?php	if(!defined('_source')) die("Error");

    SiteMap::Generate('http://phpgang.com/', NULL, 'php', 'admin', 'languages,plugins,upgrade,uploads,wp-includes', 'class.sitemap.php,wp-cron.php');

?>