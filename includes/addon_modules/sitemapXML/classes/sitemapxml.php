<?php
/**
 * Sitemap XML
 *
 * @package Sitemap XML
 * @copyright Copyright 2005-2009, Andrew Berezin eCommerce-Service.com
 * @copyright Portions Copyright 2003-2008 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @link http://www.sitemaps.org/
 * @version $Id: sitemapxml.php, v 2.1.0 30.04.2009 10:35 AndrewBerezin $
 */
////////////////////////////////////////////////////////////////////////
// Sitemap Base Class
@define('MODULE_SITEMAPXML_MAX_ENTRYS', 50000);
@define('MODULE_SITEMAPXML_MAX_SIZE', 10485760);
class zen_SiteMapXML {
  var $filename;
  var $savepath;
  var $sitemapindex;
  var $base_url;
  var $submitFlag_url;
  var $duplicatedLinks;
  var $checkurl;
  var $languagesCodes = array();
  var $sitemapItems = array();
  var $submitFlag = true;
  var $inline = true;
  var $ping = false;
  var $rebuild = false;
  var $genxml = true;
  var $messageSilently = true;
  var $stylesheet = '';

  var $sitemapFileItems = 0;
  var $sitemapFileSize = 0;
  var $sitemapFileItemsTotal = 0;
  var $sitemapFileSizeTotal = 0;
  var $sitemapFileName;
  var $sitemapFileNameNumber = 0;
  var $sitemapFileFooter = '</urlset>';
  var $sitemapFileHeader;
  var $sitemapFileBuffer = '';
  var $sitemapxml_max_entrys;
  var $sitemapxml_max_size;

  var $fb_maxsize = 4096;
  var $fb = '';
  var $fp = null;
  var $fn = '';

  function zen_SiteMapXML($inline=false, $ping=false, $rebuild=false, $genxml=true, $path='') {
    global $db;
    $this->filename = "sitemap";
    $this->sitemapindex = "sitemapindex.xml";
    $this->duplicatedLinks = array();
    $this->sitemapItems = array();
    $this->savepath = DIR_FS_CATALOG . $path;
    $this->base_url = HTTP_SERVER . DIR_WS_CATALOG . $path;
    $this->submit_url = utf8_encode(urlencode($this->base_url . $this->sitemapindex));
    $this->submitFlag = true;
    $this->messageSilently = $inline;
    $this->inline = $inline;
    $this->ping = $ping;
    $this->rebuild = $rebuild;
    $this->checkurl = false;
    $this->genxml = $genxml;
    $this->sitemapFileFooter = '</urlset>';
    $this->sitemapFileHeader = $this->_SitemapXMLHeader('urlset');
    $this->sitemapFileBuffer = '';
    $this->sitemapxml_max_entrys = MODULE_SITEMAPXML_MAX_ENTRYS;
    $this->sitemapxml_max_size = MODULE_SITEMAPXML_MAX_SIZE-strlen($this->sitemapFileFooter);
    global $lng;
    if (!is_object($lng)) {
      $lng = new language();
    }
    foreach ($lng->catalog_languages as $language) {
      $this->languagesCodes[$language['id']] = $language['code'];
    }
    $this->sitemapItems = array();

//    $this->message('Save path - "' . $this->savepath . '"' . '<br />');

/*
    if (!($robots_txt = @file_get_contents($this->savepath . 'robots.txt'))) {
      $this->message('<b>File "robots.txt" not found in save path - "' . $this->savepath . 'robots.txt"</b>' . '<br />');
    } elseif (!preg_match("@Sitemap:\s*(.*)\n@i", $robots_txt . "\n", $m)) {
      $this->message('<b>Sitemap location don\'t specify in robots.txt</b>' . '<br />');
    } elseif (trim($m[1]) != $this->base_url . $this->sitemapindex) {
      $this->message('<b>Sitemap location specified in robots.txt "' . trim($m[1]) . '" another than "' . $this->base_url . $this->sitemapindex . '"</b>' . '<br />');
    }
*/
  }

  function SitemapOpen($file, $last_date) {
    if (strlen($this->sitemapFileBuffer) > 0) $this->SitemapClose();
    if (!$this->genxml) return false;
    $this->sitemapFile = $file;
    $this->sitemapFileName = $this->_getNameFileXML($file);
    if ($this->_checkFTimeSitemap($this->sitemapFileName, $last_date) == false) return false;
    if (!$this->_fileOpen($this->sitemapFileName)) return false;
    $this->_SitemapReSet();
    $this->sitemapFileBuffer .= $this->sitemapFileHeader;
    return true;
  }

  function SitemapSetMaxItems($maxItems) {
    $this->sitemapFileItemsMax = $maxItems;
    return true;
  }

  function SitemapWriteItem($loc, $lastmod='', $changefreq='') {
    if (!$this->genxml) return false;
    if (isset($this->duplicatedLinks[$loc])) return false;
    $this->duplicatedLinks[$loc] = true;
    if ($this->checkurl && !$this->_curlExecute($loc, 'header')) return false;
    $itemRecord  = '';
    $itemRecord .= ' <url>' . "\n";
    $itemRecord .= '  <loc>' . utf8_encode($loc) . '</loc>' . "\n";
    if (isset($lastmod) && zen_not_null($lastmod)) {
      $itemRecord .= '  <lastmod>' . $this->_LastModFormat($lastmod) . '</lastmod>' . "\n";
    }
    if (isset($changefreq) && zen_not_null($changefreq)) {
      $itemRecord .= '  <changefreq>' . $changefreq . '</changefreq>' . "\n";
    }
    if ($this->sitemapFileItemsMax > 0) {
      $itemRecord .= '  <priority>' . max(number_format((($this->sitemapFileItemsMax-$this->sitemapFileItemsTotal)/$this->sitemapFileItemsMax), 2, '.', ''), 0.10) . '</priority>' . "\n";
    }
    $itemRecord .= ' </url>' . "\n";

    if ($this->sitemapFileItems >= $this->sitemapxml_max_entrys || $this->sitemapFileSize+strlen($itemRecord) >= $this->sitemapxml_max_size) {
      $this->_SitemapCloseFile();

      $this->sitemapFileName = $this->_getNameFileXML($this->sitemapFile . substr('000' . $this->sitemapFileNameNumber, -3));
      if (!$this->_fileOpen($this->sitemapFileName)) return false;
      $this->_SitemapReSetFile();
      $this->sitemapFileBuffer .= $this->sitemapFileHeader;
    }
    $this->sitemapFileBuffer .= $itemRecord;
    $this->_fileWrite($this->sitemapFileBuffer);
    $this->sitemapFileSize += strlen($this->sitemapFileBuffer);
    $this->sitemapFileSizeTotal += strlen($this->sitemapFileBuffer);
    $this->sitemapFileItems++;
    $this->sitemapFileItemsTotal++;
    $this->sitemapFileBuffer = '';
    return true;
  }

  function SitemapClose() {
    $this->_SitemapCloseFile();
    if ($this->sitemapFileItemsTotal > 0) {
      $this->message(sprintf(TEXT_TOTAL_SITEMAP, ($this->sitemapFileNameNumber+1), $this->sitemapFileItemsTotal, $this->sitemapFileSizeTotal) . '<br />');
    }
    $this->_SitemapReSet();
  }

// generate sitemap index file
  function GenerateSitemapIndex() {
    if ($this->genxml) {
      $this->message('<h3>' . TEXT_HEAD_SITEMAP_INDEX . '</h3>');
      $content = $this->_SitemapXMLHeader('sitemapindex');
      $records_count = 0;
      $pattern = '/^' . $this->filename . '.*(\.xml' . (MODULE_SITEMAPXML_COMPRESS != 'true' ? '|\.xml\.gz' : '') . ')$/';
      if ($za_dir = @dir(rtrim($this->savepath, '/'))) {
        clearstatcache();
        while ($filename = $za_dir->read()) {
          if (preg_match($pattern, $filename) > 0 && $filename != $this->sitemapindex && filesize($this->savepath . $filename) > 0) {
            $this->message(TEXT_INCLUDE_FILE . $filename . ' (<a href="' . $this->base_url . basename($filename) . '" target="_blank">' . $this->base_url . basename($filename) . '</a>)' . '<br />');
            $content .= ' <sitemap>' . "\n";
            $content .= '  <loc>' . $this->base_url . basename($filename) . '</loc>' . "\n";
            $content .= '  <lastmod>' . $this->_LastModFormat(filemtime($this->savepath . $filename)) . '</lastmod>' . "\n";
            $content .= ' </sitemap>' . "\n";
            $records_count++;
          }
        }
      }
      $content .= '</sitemapindex>';
      $this->_SaveFileXML($content, 'index', $records_count);
    }

    if ($this->inline) {
      $this->_outputSitemapIndex();
    }

    if ($this->ping) {
      $this->_SitemapPing();
    }

    if ($this->inline) {
      die();
    }

  }

// retrieve full cPath from category ID
  function GetFullcPath($cID) {
    global $db;
    static $parent_cache = array();
    $cats = array();
    $cats[] = $cID;
    $parent = $db->Execute("SELECT parent_id, categories_id
                            FROM " . TABLE_CATEGORIES . "
                            WHERE categories_id=" . (int)$cID);
    while(!$parent->EOF && $parent->fields['parent_id'] != 0) {
      $parent_cache[(int)$parent->fields['categories_id']] = (int)$parent->fields['parent_id'];
      $cats[] = $parent->fields['parent_id'];
      if (isset($parent_cache[(int)$parent->fields['parent_id']])) {
        $parent->fields['parent_id'] = $parent_cache[(int)$parent->fields['parent_id']];
      } else {
        $parent = $db->Execute("SELECT parent_id, categories_id
                                FROM " . TABLE_CATEGORIES . "
                                WHERE categories_id=" . (int)$parent->fields['parent_id']);
      }
    }
    $cats = array_reverse($cats);
    $cPath = implode('_', $cats);
    return $cPath;
  }

  function setCheckURL($checkurl) {
    $this->checkurl = $checkurl;
  }

  function setStylesheet($stylesheet) {
    $this->stylesheet = $stylesheet;
    $this->sitemapFileHeader = $this->_SitemapXMLHeader('urlset');
  }

  function getLanguageParameter($language_id, $lang_parm='language') {
    $code = '';
    if (isset($this->languagesCodes[$language_id])) {
      if (($this->languagesCodes[$language_id] != DEFAULT_LANGUAGE && sizeof($this->languagesCodes[$language_id]) > 1) || MODULE_SITEMAPXML_USE_DEFAULT_LANGUAGE == 'true') {
        $code = '&' . $lang_parm . '=' . $this->languagesCodes[$language_id];
      }
    }
    return $code;
  }

  function message($msg='', $type='') {
    if ($this->messageSilently != true) {
      echo $msg . "\n";
    }
  }

/////////////////////////

  function _checkFTimeSitemap($filename, $last_date=0) {
// TODO: Multifiles
//var_dump($filename);echo '<br />';
    if ($this->rebuild == true) return true;
    if ($last_date == 0) return true;
    clearstatcache();
    if ( MODULE_SITEMAPXML_USE_EXISTING_FILES == 'true'
      && file_exists($this->savepath . $filename)
      && (filemtime($this->savepath . $filename) >= strtotime($last_date))
      && filesize($this->savepath . $filename) > 0) {
      $this->message('"' . $filename . '" ' . TEXT_FILE_NOT_CHANGED . '<br />');
      return false;
    }
    return true;
  }

  function _getNameFileXML($type) {
    if ($type == 'index') {
      $filename = $this->sitemapindex;
    } else {
      $compress = defined('MODULE_SITEMAPXML_COMPRESS') ? MODULE_SITEMAPXML_COMPRESS : 'false';
      $filename = $this->filename . $type . '.xml' . ($compress == 'true' ? '.gz' : '');
    }
    return $filename;
  }

// save the sitemap data to file as either .xml or .xml.gz format
  function _SaveFileXML($data, $type, $records=0, $skipped=0) {
    $ret = true;
    $filename = $this->_getNameFileXML($type);
//    $this->message('Output file: ' . $this->savepath . $filename . '<br />');
    if (substr($filename, -3) == '.gz') {
      if ($gz = gzopen($this->savepath . $filename,'wb9')) {
        gzwrite($gz, $data, strlen($data));
        gzclose($gz);
      } else {
        $ret = false;
      }
    } else {
      if ($fp = fopen($this->savepath . $filename, 'w+')) {
        fwrite($fp, $data, strlen($data));
        fclose($fp);
      } else {
        $ret = false;
      }
    }
    if (!$ret) {
      $this->message('<span style="font-weight: bold); color: red;"> ' . TEXT_FAILED_TO_OPEN . ' "' . $filename . '"!!!</span>' . '<br />');
      $this->submitFlag = false;
    } else {
      $this->message(TEXT_URL_FILE . '<a href="' . $this->base_url . $filename . '" target="_blank">' . $this->base_url . $filename . '</a>' . '<br />');
      $this->message(sprintf(TEXT_WRITTEN, $records, strlen($data), filesize($filename)) . '<br />');
    }
    return $ret;
  }

// format the LastMod field
  function _LastModFormat($date) {
    if (MODULE_SITEMAPXML_LASTMOD_FORMAT == 'full') {
      $timezone = date('O', $date);
      return gmdate('Y-m-d\TH:i:s', $date) . substr($timezone, 0, 3) . ":" . substr($timezone, 3, 2);
    } else {
      return gmdate('Y-m-d', $date);
    }
  }

  function _SitemapXMLHeader($tag) {
    $header = '';
    $header .= '<?xml version="1.0" encoding="UTF-8"?'.'>' . "\n";
    $header .= ($this->stylesheet != '' ? '<?xml-stylesheet type="text/xsl" href="' . $this->stylesheet . '"?'.'>' . "\n" : "");
    $header .= '<' . $tag . ' xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance"' . "\n";
    $header .= '        xsi:schemaLocation="http://www.sitemaps.org/schemas/sitemap/0.9' . "\n";
    $header .= '        http://www.sitemaps.org/schemas/sitemap/0.9/' . ($tag == 'urlset' ? 'sitemap' : 'siteindex') . '.xsd"' . "\n";
    $header .= '        xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
    $header .= '<!-- generator="Zen-Cart SitemapXML" ' . MODULE_SITEMAPXML_VERSION . ' -->' . "\n";
    return $header;
  }

  function _SitemapPing() {
    if ($this->submitFlag && MODULE_SITEMAPXML_PING_URLS !== '') {
      $this->message('<h3>' . TEXT_HEAD_PING . '</h3>');
      $pingURLs = explode(";", MODULE_SITEMAPXML_PING_URLS);
      foreach ($pingURLs as $pingURL) {
        $pingURLarray = explode("=>", $pingURL);
        if (!isset($pingURLarray[1])) $pingURLarray[1] = $pingURLarray[0];
        $pingURLarray[0] = trim($pingURLarray[0]);
        $pingURLarray[1] = trim($pingURLarray[1]);
        $pingFullURL = sprintf($pingURLarray[1], $this->submit_url);
        $this->message('<h4>' . TEXT_HEAD_PING . ' ' . $pingURLarray[0] . '</h4>');
        $this->message($pingFullURL);
        $this->message('<div style="background-color: #FFFFCC); border: 1px solid #000000; padding: 5px">');
        if ($info = $this->_curlExecute($pingFullURL, 'page')) {
          $this->message($this->_clearHTML($info['html_page']));
        }
        $this->message('</div>');
      }
    }
  }

  function _clearHTML($html) {
    $html = preg_replace('@<head>(.*)</'.'head>@si', '', $html);
    $html = preg_replace('@<script(.*)</'.'script>@si', '', $html);
    $html = preg_replace('@<title>(.*)</'.'title>@si', '', $html);
    $html = preg_replace('@<br\s*[/]*>|<p.*>|</p>@si', "\n", $html);
    $html = preg_replace("@\n\n+@", "\n", $html);
    $html = str_replace("&nbsp;", " ", $html);
    $html = preg_replace("@\s\s+@", " ", $html);
    $html = strip_tags($html);
    $html = trim($html);
    $html = nl2br($html);
    return $html;
  }

  function _outputSitemapIndex() {
    if ($this->submitFlag) {
      header('Last-Modified: ' . gmdate("r") . ' GMT');
      header("Content-Type: text/xml; charset=UTF-8");
      header("Content-Length: " . filesize($this->savepath . $this->sitemapindex));
  //    header("Content-disposition: inline; filename=" . $this->sitemapindex);
      echo file_get_contents($this->savepath . $this->sitemapindex);
    }
  }

  function _curlExecute($url, $read='page') {
    if (!function_exists('curl_init')) {
      $this->message(TEXT_ERROR_CURL_NOT_FOUND . '<br />', 'error');
      return false;
    }
    if (!$ch = curl_init()) {
      $this->message(TEXT_ERROR_CURL_INIT . '<br />', 'error');
      return false;
    }
    $url = str_replace('&amp;', '&', $url);
    curl_setopt($ch, CURLOPT_URL, $url);
    if ($read == 'page') {
      curl_setopt($ch, CURLOPT_HEADER, 0);
      curl_setopt($ch, CURLOPT_NOBODY, 0);
      @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
    } else {
      curl_setopt($ch, CURLOPT_HEADER, 1);
      curl_setopt($ch, CURLOPT_NOBODY, 1);
      @curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);
    }
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    curl_setopt($ch, CURLOPT_FRESH_CONNECT, 1);

    if (CURL_PROXY_REQUIRED == 'True') {
      $proxy_tunnel_flag = (defined('CURL_PROXY_TUNNEL_FLAG') && strtoupper(CURL_PROXY_TUNNEL_FLAG) == 'FALSE') ? false : true;
      curl_setopt($ch, CURLOPT_HTTPPROXYTUNNEL, $proxy_tunnel_flag);
      curl_setopt($ch, CURLOPT_PROXYTYPE, CURLPROXY_HTTP);
      curl_setopt($ch, CURLOPT_PROXY, CURL_PROXY_SERVER_DETAILS);
    }

    if (!$result = curl_exec($ch)) {
      $this->message(sprintf(TEXT_ERROR_CURL_EXEC, curl_error($ch), $url) . '<br />', 'error');
      return false;
    } else {
      $info = curl_getinfo($ch);
      curl_close($ch);
      if (empty($info['http_code'])) {
        $this->message(sprintf(TEXT_ERROR_CURL_NO_HTTPCODE, $url) . '<br />', 'error');
        return false;
      } elseif ($info['http_code'] != 200) {
//        $http_codes = @parse_ini_file('includes/http_responce_code.ini');
//        $this->message("cURL Error: Error http_code '<b>" . $info['http_code'] . " " . $http_codes[$info['http_code']] . "</b>' reading '" . $url . "'. " . '<br />', 'error');
        $this->message(sprintf(TEXT_ERROR_CURL_ERR_HTTPCODE, $info['http_code'], $url) . '<br />', 'error');
        return false;
      }
      if ($read == 'page') {
        if ($info['size_download'] == 0) {
          $this->message(sprintf(TEXT_ERROR_CURL_0_DOWNLOAD, $url) . '<br />', 'error');
          return false;
        }
        if (isset($info['download_content_length']) && $info['download_content_length'] > 0 && $info['download_content_length'] != $info['size_download']) {
          $this->message(sprintf(TEXT_ERROR_CURL_ERR_DOWNLOAD, $url, $info['size_download'], $info['download_content_length']) . '<br />', 'error');
          return false;
        }
        $info['html_page'] = $result;
      }
    }
    return $info;
  }

///////////////////////
  function _SitemapReSet() {
    $this->_SitemapReSetFile();
    $this->sitemapFileItemsTotal = 0;
    $this->sitemapFileSizeTotal = 0;
    $this->sitemapFileNameNumber = 0;
    $this->sitemapFileItemsMax = 0;
    return true;
  }

  function _SitemapReSetFile() {
    $this->sitemapFileBuffer = '';
    $this->sitemapFileItems = 0;
    $this->sitemapFileSize = 0;
    $this->sitemapFileNameNumber++;
    return true;
  }

  function _SitemapCloseFile() {
    if (!$this->_fileIsOpen()) return;
    if ($this->sitemapFileItems > 0) {
      $this->sitemapFileBuffer .= $this->sitemapFileFooter;
      $this->sitemapFileSizeTotal += strlen($this->sitemapFileBuffer);
      $this->_fileWrite($this->sitemapFileBuffer);
    }
    $this->_fileClose();
    $this->message(sprintf(TEXT_FILE_SITEMAP_INFO, $this->base_url . $this->sitemapFileName, $this->base_url . $this->sitemapFileName, $this->sitemapFileItems, $this->sitemapFileSize, filesize($this->sitemapFileName)) . '<br />');
  }

///////////////////////
  function _fileOpen($filename) {
    $this->fn = $filename;
    $this->fb = '';
    if (substr($this->fn, -3) == '.gz') {
      $this->fp = gzopen($this->savepath . $filename,'wb9');
    } else {
      $this->fp = fopen($this->savepath . $filename, 'w+');
    }
    if (!$this->fp) {
      $this->message('<span style="font-weight: bold); color: red;"> ' . TEXT_FAILED_TO_OPEN . ' "' . $filename . '"!!!</span>' . '<br />');
      $this->submitFlag = false;
    }
    return $this->fp;
  }

  function _fileIsOpen() {
    if (is_null($this->fp)) return false;
    return true;
  }

  function _fileWrite($data='') {
    $ret = true;
    if (strlen($this->fb) > $this->fb_maxsize || ($data == '' && strlen($this->fb) > 0)) {
      if (substr($this->fn, -3) == '.gz') {
        $ret = gzwrite($this->fp, $this->fb, strlen($this->fb));
      } else {
        $ret = fwrite($this->fp, $this->fb, strlen($this->fb));
      }
      $this->fb = '';
    }
    $this->fb .= $data;
    return $ret;
  }

  function _fileClose() {
    if (!$this->fp) return;
    if (strlen($this->fb) > 0) {
      $this->_fileWrite();
    }
    if (substr($this->fn, -3) == '.gz') {
      gzclose($this->fp);
    } else {
      fclose($this->fp);
    }
    $this->fp = null;
  }

  function timefmt($s) {
    $m = floor($s/60);
    $s = $s - $m*60;
    return $m . ":" . number_format($s, 4);
  }

}
