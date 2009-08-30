<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: finished.php 3174 2006-03-12 17:10:55Z drbyte $
 */
/**
 * defining language components for the page
 */
  define('TEXT_MAIN',"<h2>Congratulations!</h2><h3>You have successfully installed Zen Cart&trade; on your system!</h3>
<h2>NEXT STEPS</h2>For security, you will need to reset your <strong>configure.php</strong> files located in the <strong>/admin/includes/</strong> and <strong>/includes/</strong> folders back to read-only mode before allowing people to access your store.<br /><br />
Additionally, you'll want to remove or rename the <strong>/zc_install</strong> folder so that someone can't re-install your shop again and wipe out your database!  Warnings will appear until the folder has been removed or renamed.
<h2>CONFIGURATION</h2>We encourage you to begin by <a href=\"http://www.zen-cart.com\"><strong>reading the FAQ's</strong> in our online support forums</a> for useful information to assist with configuring and customizing your online shop the way you wish it to look and operate. <br />
If you have questions, this is the first place to look! If you're stumped, feel free to post a question! We have a helpful, friendly, knowledgeable community who welcomes you.<br /><br /> 
It's also <strong>important</strong> that you check out the <strong>Documentation </strong>in the <strong><a href=\"../docs\" target=\"_blank\">/docs folder</a> </strong>of your site. <a href=\"../docs\" target=\"_blank\">Click here to view a listing.</a>
<h2>IMPORTANT READING</h2>The most important tool you'll use when customizing your site is the <strong>Developers Tool Kit</strong>, which is in the <strong>Admin area, under Tools</strong>. You can use it to search for almost anything you might like to customize or change, especially the text displayed on your site. <br /><br />
The most important concept you'll want to become familiar with in order to customize your site is our <em><strong>template system</strong></em>.  There are some very good articles on the template system in our <a href=\"http://www.zen-cart.com\">online FAQ section</a>.
<h2>ADDITIONAL READING</h2>
<p>The <a href=\"http://www.zen-cart.com/wiki\" target=\"_blank\">Zen Cart&trade; Wiki</a> is a helpful place to find tips and tricks and general use information. </p>
<p>In our <a href=\"http://www.zen-cart.com\" target=\"_blank\">online forums</a>, there is a section called '<strong>Downloads</strong>'.  Inside, there is a category called '<strong>Documentation</strong>', which contains the latest versions of manuals which cover the various aspects of managing your site.<br />
  <br />
  We're glad you chose Zen Cart&trade; to be your e-Commerce solution!<br />
  <br />
" . 
'<a href="http://www.zen-cart.com">Visit us online at www.zen-cart.com</a>' . '
</p>
' .
'<p>Press the <em>Store</em> button below to test out your store or press the <em>Admin</em> button to begin customizing your store.</p>');

  define('TEXT_PAGE_HEADING', 'Zen Cart&trade; Setup - Finished');
  define('STORE', 'Click here to go to the Store');
  define('ADMIN', 'Click here to open the Admin area');
?>