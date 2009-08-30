<?
//You must enter YOUR email address ($myemail on line below).
$myemail ="YOUR_EMAIL_ADDRESS_GOES_HERE";

// ****************************************************************
// * TECHSUPP.PHP
// * v1.2f  June 22, 2005
// * 
// * Tech Support tool to collect server and Zen Cart config info 
// * Results can then be reported when requesting tech support on
// * the Zen Cart forums at www.zen-cart.com
// *
// * This file can be uploaded to /zencart and run directly 
// * as http://myserver.com/zencart/techsupp.php
// *   OR
// * This file can be uploaded to anywhere on your server, and it
// * will report system info, but will skip the Zen Cart specific items.
// *
// * Contributed by: DrByte 
// *****************************************************************
// * v1.2f- added ability to list suggested paths for specific Zen Cart configure.php parameters
// * v1.2e- minor bugfixes
// * v1.2d- minor bugfixes and code to prevent ZC info if running from zc_install folder
// * v1.2c- added support for testing emails via PHP
// * v1.2b- added support for checking numerous additional system var's
// * v1.2 - added support for checking additional system var's
// *        (these "may" give errors if safe_mode has ini_get disabled)
// * v1.1 - revised to work with or without Zen files available
// *      - added some CSS for easier reading
// *****************************************************************

// If the email you send is properly received, then your mailserver (PHP) configuration settings are fine.
// If the emails you send from this tool are "not" received, then you should check with your 
// webhosting provider to see whether there are special requirements for sending mail
// or perhaps you need to use an authentication method such as SMTPAUTH (which this tool cannot test).
// Further, you might check the mailserver logs to see what happens to your messages
// if they are not being received at the destination you entered in $myemail above.



// suppress errors
  error_reporting(E_ALL & ~E_NOTICE);
  if (!isset($PHP_SELF)) $PHP_SELF = $_SERVER['PHP_SELF'];

?>
<html><head>
<title>Technical Support  -- System Specs</title>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<style type="text/css">
<!--
h1 {
	color: #B56224;
}
h2 {
	color: #D67732;
}
h3 {
	color: #D67630;
}
.red {
	color: #FF0000;
	font-weight: bolder;
}
.green {color: #009900;
	font-weight: bolder;
}
-->
</style>
</head>

<body>
<?php if ($myemail !='YOUR_EMAIL_ADDRESS_GOES_HERE' && $myemail !='') { ?>
<form method="POST" action="<?php echo basename(__FILE__); ?>">

<!-- DO NOT change ANY of the php sections -->
<?php
$ipi = getenv("REMOTE_ADDR");
$httprefi = getenv ("HTTP_REFERER");
$httpagenti = getenv ("HTTP_USER_AGENT");
?>

<input type=hidden name="ip" value="<?php echo $ipi ?>">
<input type=hidden name="httpref" value="<?php echo $httprefi ?>">
<input type=hidden name="httpagent" value="<?php echo $httpagenti ?>">


Your Name: <input type=text name="visitor" size="35">
<br>
Your Email: <input type=text name="visitormail" size="35">
<br><br>
Mail Message:
<br>
<textarea name=notes rows=4 cols=40>You may optionally enter a message here.</textarea>
<br>
<input type=submit name="submit" VALUE="Send Mail">
</form>


<?php
if (!isset($visitormail)) echo "Please fill in the fields and click Send.<br>(No content to process yet.) $ip";

$todayis = date("l, F j, Y, g:i a");

$subject = "EMAIL SYSTEM -- This is a TEST MESSAGE";

$message = " $todayis \n
Message: $notes \n
From: $visitor ($visitormail)\n
Additional Info : IP = $ip \n
Browser Info: $httpagent \n
Referral : $httpref \n
";

$from = "From: $myemail\r\n";

if ($myemail != "" && isset($_POST['submit']) ) {
  mail($myemail, $subject, $message, $from);
}
?>

<p align=center><b>
Date: <?php echo $todayis ?>
<br>
Thank You : <?php echo $visitor ?> ( <?php echo $visitormail ?> )
<br>
<?php echo $ip ?></b>

<br><br>
<a href="<?php echo basename(__FILE__); ?>"> Send Another </a>
</p>
<?php
 } else {
echo '<span class=green><em>{if you wish to enable email-testing support, please edit this file ('.basename(__FILE__).') and enter your email address at the top on the 3rd line}</span></em><br />';
 }
?>

<h1>Server Configuration Details</h1>

<h2>Server Info</h2>
<ul>
<li><strong>Webserver: </strong><?=getenv("SERVER_SOFTWARE")?></li><br /><br />
<?php 
 $disk_freespaceGB=round(@diskfreespace(__FILE__)/1024/1024/1024,2);
 $disk_freespaceMB=round(@diskfreespace(__FILE__)/1024/1024,2);
?>
<li><?php echo '<strong>Server Free Disk Space Reported</strong> = '.$disk_freespaceGB; ?> GB</li><br /><br />
<li><?php echo '<strong>MySQL Version Reported </strong>= '. @mysql_get_server_info(); ?></li>
<li><?php echo '<strong>PHP MySQL Support</strong> = '.(function_exists( 'mysql_connect' ) ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP PostGres SQL Support</strong> = '.(function_exists( 'pg_connect' ) ? ON : OFF); ?></li>
</ul>

<h2>PHP Info</h2><ul>
<li><strong>PHP version: </strong>
<? if (phpversion()=="4.1.2") {
   echo "<span class='red'>".phpversion()." {You SHOULD upgrade this!}</span>";
   } else {
   echo phpversion();
   } ?></li>
<li><?php echo '<strong>PHP API version</strong>= '.@php_sapi_name(); ?></li>

<li><strong>PHP Safe Mode</strong>= 
<? if (ini_get("safe_mode")) {
   echo "<span class='red'>ON</span>";
   } else{
   echo "OFF";
   } ?></li>

<li><?php echo '<strong>PHP Register Globals</strong> = '.(ini_get('register_globals') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP set_time_limit</strong> (max execution time) = '.ini_get("max_execution_time"); ?></li>
<li><?php echo '<strong>PHP Disabled Functions </strong>= '.ini_get("disable_functions"); ?></li>
<li><?php echo '<strong>PHP open_basedir </strong>= '.ini_get("open_basedir"); ?></li>
<li><?php echo '<strong>PHP Sessions Support </strong>= '.(@extension_loaded('session') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP session.auto_start</strong> = '.(ini_get('session.auto_start') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP session.use_trans_sid</strong> = '.(ini_get('session.use_trans_sid') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP session.save_path = </strong>'.ini_get("session.save_path"); ?></li>
<li><?php echo '<strong>PHP Magic_Quotes_Runtime</strong> = '.(@get_magic_quotes_runtime() > 0 ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP GD Support</strong> = '.(@extension_loaded('gd')? ON : OFF); ?></li>
<li><?php echo '<strong>PHP ZLIB Support</strong> = '.(@extension_loaded('zlib')? ON : OFF); ?></li>
<li><?php echo '<strong>PHP OpenSSL Support</strong> = '.(@extension_loaded('openssl') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP CURL Support</strong> = '.(@extension_loaded('curl') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP File Uploads</strong> = '.(@ini_get('file_uploads') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP File Upload Max Size</strong> = '.@ini_get('upload_max_filesize'); ?></li>
<li><?php echo '<strong>PHP Post Max Size</strong> = '.@ini_get('post_max_size'); ?></li>
<li><?php echo '<strong>PHP File Upload TMP Dir</strong> = '.ini_get("upload_tmp_dir"); ?></li>
<li><?php echo '<strong>PHP XML Support </strong>= '.(function_exists('xml_parser_create') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP FTP Support</strong> = '.(@extension_loaded('ftp') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP PFPRO Support</strong> = '.(@extension_loaded('pfpro') ? ON : OFF); ?></li>
<li><?php echo '<strong>PHP Sendmail_FROM</strong> = '.ini_get("sendmail_from"); ?></li>
<li><?php echo '<strong>PHP Sendmail_PATH</strong> = '.ini_get("sendmail_path"); ?></li>
<li><?php echo '<strong>PHP SMTP Settings</strong> = '.ini_get("SMTP"); ?></li>
<li><?php echo '<strong>PHP include_path = </strong>'.ini_get("include_path"); ?></li>

</ul>
<h2>Webserver/Page Info</h2>
<ul>
<li><?php echo '<strong>HTTP_HOST= </strong>"'.$_SERVER['HTTP_HOST'].'"'; ?></li>
<li><?php echo '<strong>HTTPS= </strong>"'.$_SERVER['HTTPS'].'"'; ?></li>
<li><?php echo '<strong>HTTP_USER_AGENT= </strong>"'.$_SERVER['HTTP_USER_AGENT'].'"'; ?></li>
<li><?php echo '<strong>HTTP_REFERRER= </strong>"'.$_SERVER['HTTP_REFERRER'].'"'; ?></li>
<li><?php echo '<strong>HTTP_ACCEPT= </strong>"'.$_SERVER['HTTP_ACCEPT'].'"'; ?></li>
<li><?php echo '<strong>HTTP_ACCEPT_LANGUAGE= </strong>"'.$_SERVER['HTTP_ACCEPT_LANGUAGE'].'"'; ?></li>
<li><?php echo '<strong>HTTP_ACCEPT_CHARSET= </strong>"'.$_SERVER['HTTP_ACCEPT_CHARSET'].'"'; ?></li>
<li><?php echo '<strong>HTTP_KEEP_ALIVE</strong>= "'.$_SERVER['HTTP_KEEP_ALIVE'].'"'; ?></li>
<li><?php echo '<strong>HTTP_CONNECTION</strong>= "'.$_SERVER['HTTP_CONNECTION'].'"'; ?></li>
<li><?php echo '<strong>PATH</strong>= "'.$_SERVER['PATH'].'"'; ?></li>
<li><?php echo '<strong>SERVER_ADMIN</strong>= "'.$_SERVER['SERVER_ADMIN'].'"'; ?></li>
<li><?php echo '<strong>SERVER_SOFTWARE</strong>= "'.$_SERVER['SERVER_SOFTWARE'].'"'; ?></li>
<li><?php echo '<strong>SERVER_NAME</strong>= "'.$_SERVER['SERVER_NAME'].'"'; ?></li>
<li><?php echo '<strong>DOCUMENT_ROOT</strong>= "'.$_SERVER['DOCUMENT_ROOT'].'"'; ?></li>
<li><?php echo '<span class=red>REQUEST_URI= "'.$_SERVER['REQUEST_URI'].'"</span>'; ?></li>
<li><?php echo '<span class=red>SCRIPT_NAME= "'.$_SERVER['SCRIPT_NAME'].'"</span>'; ?></li>
<li><?php echo '<span class=red>PHP_SELF= "'.$_SERVER['PHP_SELF'].'"</span>'; ?></li>
<li><?php echo '<span class=red>SCRIPT_FILENAME= "'.$_SERVER['SCRIPT_FILENAME'].'"</span>'; ?></li>
<li><?php echo '<span class=red>PATH_TRANSLATED= "'.$_SERVER['PATH_TRANSLATED'].'"</span>'; ?></li>
<li><?php echo '<span class=red>PHP __FILE__: "'.__FILE__.'"</span>'; ?></li>
<li><?php echo '<span class=red>PHP basename: "'.basename($PHP_SELF).'"</span>'; ?></li>
<li><?php echo '<span class=red>PHP dirname(self): "'.dirname($PHP_SELF).'"</span>'; ?></li>
<li><?php echo '<strong>SERVER_ADDR</strong>= "'.$_SERVER['SERVER_ADDR'].'"'; ?></li>
<li><?php echo '<strong>SERVER_PORT</strong>= "'.$_SERVER['SERVER_PORT'].'"'; ?></li>
<li><?php echo '<strong>REMOTE_HOST</strong>= "'.$_SERVER['REMOTE_HOST'].'"'; ?></li>
<li><?php echo '<strong>REMOTE_ADDR</strong>= "'.$_SERVER['REMOTE_ADDR'].'"'; ?></li>
<li><?php echo '<strong>REMOTE_PORT</strong>= "'.$_SERVER['REMOTE_PORT'].'"'; ?></li>
<li><?php echo '<strong>HTTP_X_FORWARDED_FOR</strong>= "'.$_SERVER['HTTP_X_FORWARDED_FOR'].'"'; ?></li>
<li><?php echo '<strong>HTTP_CLIENT_IP</strong>= "'.$_SERVER['HTTP_CLIENT_IP'].'"'; ?></li>
<li><?php echo '<strong>GATEWAY_INTERFACE</strong>= "'.$_SERVER['GATEWAY_INTERFACE'].'"'; ?></li>
<li><?php echo '<strong>SERVER_PROTOCOL</strong>= "'.$_SERVER['SERVER_PROTOCOL'].'"'; ?></li>
<li><?php echo '<strong>REQUEST_METHOD</strong>= "'.$_SERVER['REQUEST_METHOD'].'"'; ?></li>
<li><?php echo '<strong>QUERY_STRING</strong>= "'.$_SERVER['QUERY_STRING'].'"'; ?></li>
<li><?php echo '<strong>SERVER_SIGNATURE</strong>= "'.$_SERVER['SERVER_SIGNATURE'].'"'; ?></li>
</ul>

<h2>Zen Cart SUGGESTED path settings</h2>
<ul><h3>/includes/configure.php</h3>
<ul>
<li><strong>HTTP_SERVER:     </strong>&nbsp;&nbsp;<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?></li>
<li><strong>HTTPS_SERVER:    </strong>&nbsp;&nbsp;<?php echo 'see Note...<span class=red>**</span>'; ?></li>
<li><strong>DIR_WS_CATALOG:  </strong>&nbsp;&nbsp;<?php echo dirname($PHP_SELF); ?>/</li>
<li><strong>DIR_FS_CATALOG:  </strong>&nbsp;&nbsp;<?php echo str_replace(basename($PHP_SELF),'',__FILE__); ?></li>
<li><strong>DIR_FS_SQL_CACHE:  </strong>&nbsp;&nbsp;<?php echo str_replace(basename($PHP_SELF),'',__FILE__); ?>cache/</li>
</ul>
<h3>/admin/includes/configure.php</h3>
<ul>
<li><strong>HTTP_SERVER:    </strong>&nbsp;&nbsp;<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?></li>
<li><strong>HTTPS_SERVER:   </strong>&nbsp;&nbsp;<?php echo 'see Note...<span class=red>**</span>'; ?></li>
<li><strong>HTTP_CATALOG_SERVER:  </strong>&nbsp;<?php echo 'http://'.$_SERVER['SERVER_NAME']; ?></li>
<li><strong>HTTPS_CATALOG_SERVER: </strong>&nbsp;<?php echo 'see Note...<span class=red>**</span>'; ?></li>
<li><strong>DIR_WS_ADMIN:   </strong>&nbsp;&nbsp;<?php echo dirname($PHP_SELF); ?>/admin/</li>
<li><strong>DIR_WS_CATALOG: </strong>&nbsp;&nbsp;<?php echo dirname($PHP_SELF); ?>/</li>
<li><strong>DIR_FS_ADMIN:   </strong>&nbsp;&nbsp;<?php echo str_replace(basename($PHP_SELF),'',__FILE__); ?>admin/</li>
<li><strong>DIR_FS_CATALOG: </strong>&nbsp;&nbsp;<?php echo str_replace(basename($PHP_SELF),'',__FILE__); ?></li>
<li><strong>DIR_FS_SQL_CACHE: </strong>&nbsp;&nbsp;<?php echo str_replace(basename($PHP_SELF),'',__FILE__); ?>cache/</li>
</ul>
<span class="red">**</span> NOTE: This depends on your hosting arrangements. Talk to your hosting company for how to configure SSL on your server.
<br /></ul>
<br />

<?php
// Report the Zen Cart System info, if available.
  if (file_exists('includes/application_top.php')) {
    $path = (substr_count(__FILE__,'zc_install') || file_exists('mysql_zencart.sql')) ? '../' : '';
?>
<h2>Zen Cart System Info:</h2><ul>
<h3>System Folder Checkup</h3><ul>
<?php
//check folders status
foreach (array('cache'=>'777 read/write/execute',
               'images'=>'777 read/write/execute (INCLUDE SUBDIRECTORIES TOO)',
               'includes/languages/english/html_includes'=>'777 read/write (INCLUDE SUBDIRECTORIES TOO)',
               'pub'=>'777 read/write/execute',
               'admin/backups'=>'777 read/write',
               'admin/images/graphs'=>'777 read/write/execute')
            as $folder=>$chmod) {
   $status = (@is_writable($path.$folder))? OK :(UNWRITABLE . ' ' . $chmod);
   echo '<li><strong>Folder:</strong> '.$path.$folder . ' <strong>' . $status .'</strong></li>';
} ?>
</ul>
<?php if (substr_count(__FILE__,'zc_install') <1 && !file_exists('mysql_zencart.sql') ) {
        if (headers_sent) echo 'YOU CAN SAFELY IGNORE THE FOLLOWING "Headers already sent" ERRORS:';
        include('includes/application_top.php'); ?>
<h3>From APPLICATION_TOP.PHP</h3><ul>
<li><strong>Version: </strong><? echo PROJECT_VERSION_NAME; ?></li><br />
<li><strong>Version Major: </strong><? echo PROJECT_VERSION_MAJOR; ?></li><br />
<li><strong>Version Minor: </strong><? echo PROJECT_VERSION_MINOR; ?></li>
</ul>

<h3>Settings from Zen Cart Database:</h3><ul>
<li><strong>Installed Payment Modules: </strong><? echo MODULE_PAYMENT_INSTALLED; ?></li><br />
<li><strong>Installed Order Total Modules: </strong><? echo MODULE_ORDER_TOTAL_INSTALLED; ?></li><br />
<li><strong>Installed Shipping Modules: </strong><? echo MODULE_SHIPPING_INSTALLED; ?></li><br />
<li><strong>Default Currency: </strong><? echo DEFAULT_CURRENCY; ?></li><br />
<li><strong>Default Language: </strong><? echo DEFAULT_LANGUAGE; ?></li><br />
<li><strong>Enable Downloads: </strong><? echo DOWNLOAD_ENABLED; ?></li><br />
<li><strong>Enable GZip Compression: </strong><? echo GZIP_LEVEL; ?></li><br />
<li><strong>Admin Demo Status: </strong><? echo ADMIN_DEMO; ?></li>
</ul>
<?php
        } //endif check if we're in zc_install
?>
</ul>
<?php
    }  //endif exists app_top
?>

<br /><strong><h2>PHP Modules:</h2></strong><ul>
<?
$le = get_loaded_extensions();
foreach($le as $module) {
    print "<li>$module</li>";
}
?>
</ul>
<h2>PHP Info</h2><?php phpinfo(); ?>

<?php
  echo "<br /><strong>SERVER variables:</strong><br />";  
    foreach($_SERVER as $key=>$value)  {
      echo "$key => $value<br />";
    }
    // now break it out into objects and arrays, if relevant
    foreach($_SERVER as $key=>$value)  {
      if (is_object($value)) {
        foreach($value as $subvalue) {
          if (is_object($subvalue) || is_array($subvalue)) {
            foreach($subvalue as $subvalue2) {
              echo $key.'['.$value.']['.$subvalue.'] => '.$subvalue2.'<br />';
            }
          } else {
            echo $key.'['.$value.'] => '.$subvalue.'<br />';
          }
        }
      } else if (is_array($value)) {
        foreach($value as $subvalue) {
          if (is_array($subvalue)) {
            foreach($subvalue as $subvalue2) {
              echo $key.'['.$value.']['.$subvalue.'] => '.$subvalue2.'<br />';
            }
          } else {
            echo $key.'['.$value.'] => '.$subvalue.'<br />';
          }
        }
      } else {
//        echo "$key => $value<br />";
      } 
    } 

?>

</body>
</html>