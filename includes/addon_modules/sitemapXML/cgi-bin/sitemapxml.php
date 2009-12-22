<?php
/**
 * Sitemap XML Feed
 *
 * @package Sitemap XML Feed
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @link http://www.sitemaps.org/
 * @version $Id: sitemapxml.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */
// php -f /home/XXXXXXX/domains/XXXX.ru/public_html/cgi-bin/sitemapxml.php rebuild=yes
chdir(dirname(__FILE__) . '/../../../../');

//var_dump($_GET, $_SERVER);
if (!isset($_GET) && isset($_SERVER["argc"]) && $_SERVER["argc"] > 1) {
  for($i=1;$i<$_SERVER["argc"];$i++) {
    list($key, $val) = explode('=', $_SERVER["argv"][$i]);
    $_GET[$key] = $_REQUEST[$key] = $val;
  }
}

$_SERVER["HTTP_USER_AGENT"] = 'Cron /usr/local/bin/php -f ';
$_SERVER["REQUEST_URI"] = $_SERVER["SCRIPT_NAME"];
$_SERVER["REMOTE_ADDR"] = '127.0.0.1';

$_GET['main_page'] = 'addon';
$_GET['module'] = 'sitemapXML';

function zen_sitemapxml_callback($buffer) {
  $buffer = preg_replace('@<title>.*</title>@si', '', $buffer);
  $buffer = strip_tags($buffer);
  $buffer = trim($buffer);
  return $buffer;
}

ob_start("zen_sitemapxml_callback");

include 'index.php';
