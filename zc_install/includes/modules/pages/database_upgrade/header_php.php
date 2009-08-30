<?php
/**
 * @package Installer
 * @access private
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 3824 2006-06-21 17:07:09Z drbyte $
 */

/* 
 * Database Upgrade script
 * 1. Checks to be sure that the configure.php exists and can be read
 * 2. Uses info from configure.php to connect to database
 * 3. Queries database to determine whether settings unique to each upgrade level exist or not
 * 4. Presents a list of upgrade steps to be completed (checkboxes)
 * 5. If can connect to database, but cannot find the "configuration" table, only allows option to rename table prefixes
 * 6. Requires admin password in order to do upgrade steps
 * 7. Cycles through processing each upgrade SQL file in sequence, as selected.
 *    Won't process upgrades if prerequisites for prior step aren't already validated.
 *
 * @todo  Optimize routine to check for database permissions at the MySQL "user" level.
 *           Needs: SELECT, INSERT, UPDATE, DELETE, CREATE, ALTER, INDEX, DROP
 *        NEEDS TO WORK RELIABLY FOR BOTH well-configured and poorly-configured hosting configurations
 */

/////////////////////////////////////////////////////////////////////
//this is the latest database-version-level that this script knows how to inspect and upgrade to.
//it is used to determine whether to stay on the upgrade page when done, or continue to the finished page
$latest_version = '1.3.0.2-l10n-jp-1'; 

///////////////////////////////////
if (!isset($_GET['debug'])  && !zen_not_null($_POST['debug']))  define('ZC_UPG_DEBUG',false);
if (!isset($_GET['debug2']) && !zen_not_null($_POST['debug2'])) define('ZC_UPG_DEBUG2',false);
if (!isset($_GET['debug3']) && !zen_not_null($_POST['debug3'])) define('ZC_UPG_DEBUG3',false);

$is_upgrade = true; //that's what this page is all about!
$failed_entries=0;
$zc_install->error = false;
$zc_install->fatal_error = false;
$zc_install->error_list = array();

$configure_files_array = array('../includes/configure.php','../admin/includes/configure.php');
$database_tablenames_array=array('../includes/database_tables.php', '../includes/extra_datafiles/music_type_database_names.php');

define('DIR_WS_INCLUDES', '../includes/');
$zc_install->test_store_configure(ERROR_TEXT_STORE_CONFIGURE,ERROR_CODE_STORE_CONFIGURE);
if (ZC_UPG_DEBUG==true && $zc_install->fatal_error) echo 'FATAL ERROR-CONFIGURE FILE';

if (!$zc_install->fatal_error) {
  if (ZC_UPG_DEBUG==true) echo 'configure.php file exists<br />';
  require(DIR_WS_INCLUDES . 'configure.php');
  require(DIR_WS_INCLUDES . 'classes/db/' . DB_TYPE . '/query_factory.php');

  //open database connection to run queries against it
  $db_test = new queryFactory;
  $db_test->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");

//check to see if a database_table_prefix has been defined.  If not, set it to blank.
  if (!defined('DB_PREFIX') || DB_PREFIX == 'DB_PREFIX' || "'".DB_PREFIX."'" == 'DB_PREFIX') {
    define('DB_PREFIX','');
  }

  // Now check the database for what version it's at, if found
  require('includes/classes/class.installer_version_manager.php');
  $dbinfo = new versionManager;

  $privs_array =  explode('|||',zen_check_database_privs('','',true));
  $db_priv_ok = $privs_array[0];
  $zdb_privs_list =  $privs_array[1];
  $privs_found_text='';
  if (ZC_UPG_DEBUG==true) echo 'privs_list_to_parse='.$db_priv_ok.'|||'.$zdb_privs_list;
  foreach(array('ALL PRIVILEGES','SELECT','INSERT','UPDATE','DELETE','CREATE','ALTER','INDEX','DROP') as $value) {
    if (in_array($value,explode(', ',$zdb_privs_list))) {
      $privs_found_text .= $value .', ';
    }
  }
  $zdb_privs=str_replace(',  ',' ',$privs_found_text.' ');
  if (!zen_not_null($zdb_privs)) $zdb_privs=$zdb_privs_list;
  if ($zdb_privs_list == 'Not Checked') $zdb_privs = $zdb_privs_list;

// Finished querying database for configuration info
  $db_test->Close();


// *** NOW DETERMINE REQUIRED UPDATES BASED ON TEST RESULTS

//display options based on what was found -- THESE SHOULD BE PROCESSED IN REVERSE ORDER, NEWEST VERSION FIRST... !
//that way only the "earliest-required" upgrade is suggested first.
    if ($dbinfo->version120jp3 && !$dbinfo->version1302jp1) {
      $sniffer =  ' upgrade v1.2.0-l10n-jp-3 to v1.3.0.2-l10n-jp-1';
      $needs_v1_3_0_2_jp_1_from_v1_2_0_0_jp_3=true;
    }
    if (!$dbinfo->version120jp3 && !$dbinfo->version1302jp1) {
      $sniffer =  ' upgrade v1.3.0.2 to v1.3.0.2-l10n-jp-1';
      $needs_v1_3_0_2_jp_1_from_v1_3_0_2=true;
    }
    if (!$dbinfo->version1302) {
      $sniffer =  ' upgrade v1.3.0.1 to v1.3.0.2';
      $needs_v1_3_0_2=true;
    }
    if (!$dbinfo->version1301) {
      $sniffer =  ' upgrade v1.3.0 to v1.3.0.1';
      $needs_v1_3_0_1=true;
    }
    if (!$dbinfo->version130) {
      $sniffer =  ' upgrade v1.2.7 to v1.3.0';
      $needs_v1_3_0=true;
    }
    if (!$dbinfo->version127) {
      $sniffer =  ' upgrade v1.2.6 to v1.2.7';
      $needs_v1_2_7=true;
    }
    if (!$dbinfo->version126) {
      $sniffer =  ' upgrade v1.2.5 to v1.2.6';
      $needs_v1_2_6=true;
    }
    if (!$dbinfo->version125) {
      $sniffer =  ' upgrade v1.2.4 to v1.2.5';
      $needs_v1_2_5=true;
    }
    if (!$dbinfo->version124) {
      $sniffer =  ' upgrade v1.2.3 to v1.2.4';
      $needs_v1_2_4=true;
    }
    if (!$dbinfo->version123) {
      $sniffer =  ' upgrade v1.2.2 to v1.2.3';
      $needs_v1_2_3=true;
    }
    if (!$dbinfo->version122) {
      $sniffer =  ' upgrade v1.2.1 to v1.2.2';
      $needs_v1_2_2=true;
    }
    if (!$dbinfo->version121) {
      $sniffer =  ' upgrade v1.2.0 to v1.2.1';
      $needs_v1_2_1=true;
    }
    if (!$dbinfo->version120jp3) {
      $sniffer =  ' upgrade v1.2.0 to v1.2.0-l10n-jp-3';
      $needs_v1_2_0_l10n_jp_3=true;
    }
    if (!$dbinfo->version120) {
      $sniffer =  ' upgrade v1.1.4 to v1.2.0';
      $needs_v1_2_0=true;
    }
    if (!$dbinfo->version1141) {
      $sniffer =  ' upgrade v1.1.4 to v1.1.4_patch1';
      $needs_v1_1_4_patch1=true;
    }
    if (!$dbinfo->version114) {
      $sniffer =  ' upgrade v1.1.2 or v1.1.3 to v1.1.4';
      $needs_v1_1_4=true;
    }
    if (!$dbinfo->version112) {
      $sniffer =  ' upgrade v1.1.1 to v1.1.2';
      $needs_v1_1_2=true;
    }
    if (!$dbinfo->version111) {
      $sniffer =  ' upgrade v1.1.0 to v1.1.1';
      $needs_v1_1_1=true;
    }
    if (!$dbinfo->version110) {
      $sniffer =  ' upgrade v1.04 to v.1.1.1';
      $needs_v1_1_0=true;
//    $needs_v1_1_1=false; // exclude the 1.1.0-to-1.1.1 update since it's included in this step if selected
    }


 if (!isset($sniffer) && empty($sniffer)) {
   $sniffer = ' &nbsp;*** No upgrade required ***';
   $sniffer_version = "";
   }

} // end if zc_install_error == false ....... and database schema checks

if (ZC_UPG_DEBUG2==true) {
  echo '<br>110='.$dbinfo->version110;
  echo '<br>111='.$dbinfo->version111;
  echo '<br>112='.$dbinfo->version112;
  echo '<br>114='.$dbinfo->version114;
  echo '<br>1_1_4_patch1='.$dbinfo->version1141;
  echo '<br>120='.$dbinfo->version120;
  echo '<br>120jp3='.$dbinfo->version120jp3;
  echo '<br>121='.$dbinfo->version121;
  echo '<br>122='.$dbinfo->version122;
  echo '<br>123='.$dbinfo->version123;
  echo '<br>124='.$dbinfo->version124;
  echo '<br>125='.$dbinfo->version125;
  echo '<br>126='.$dbinfo->version126;
  echo '<br>127='.$dbinfo->version127;
  echo '<br>130='.$dbinfo->version130;
  echo '<br>1301='.$dbinfo->version1301;
  echo '<br>1302='.$dbinfo->version1302;
  echo '<br>1302jp1='.$dbinfo->version1302jp1;
  echo '<br>1302jp1from120jp3='.$dbinfo->version1302jp1from120jp3;
  echo '<br>';
  }

// IF FORM WAS SUBMITTED, CHECK SELECTIONS AND PERFORM THEM
  if (isset($_POST['submit'])) {
   $sniffer =  '';
   $sniffer_version = '';

   if (is_array($_POST['version'])) {
   if (ZC_UPG_DEBUG2==true) foreach($_POST['version'] as $value) { echo 'Selected: ' . $value.'<br />';}
     reset($_POST['version']);
     while (list(, $value) = each($_POST['version'])) {
     $sniffer_file = '';
      switch ($value) {
       case '1.0.4':  // upgrading from v1.0.4 to 1.1.1
          if ($dbinfo->version111) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_104_to_111.sql';
          if (ZC_UPG_DEBUG2==true) echo '<br>'.$sniffer_file.'<br>';
          $got_v1_1_1 = true;
          $db_upgraded_to_version='1.1.1';
          break;
       case '1.1.0':  // upgrading from v1.1.0 to 1.1.1
          if (!$dbinfo->version110 || $dbinfo->version111) continue; // if don't have prerequisite, or if already done this step
          $sniffer_file = '_upgrade_zencart_110_to_111.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_1_1 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.1.1';
          break;
       case '1.1.1':  // upgrading from v1.1.1 to 1.1.2
          if (!$dbinfo->version111 || $dbinfo->version112) continue;
          $sniffer_file = '_upgrade_zencart_110_to_112.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_1_2 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.1.2';
          break;
       case '1.1.2-or-1.1.3':  // upgrading from v1.1.2 or v.1.13  TO   1.1.4
          if (!$dbinfo->version112 || $dbinfo->version114) continue;
          $sniffer_file = '_upgrade_zencart_112_to_114.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_1_4 = true;
          $got_v1_1_4_patch1 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.1.4-1';
          break;
       case '1.1.4':  // upgrading from v1.1.4 to 1.1.4 patch1
          if (!$dbinfo->version114 || $dbinfo->version1141) continue;
          $sniffer_file = '_upgrade_zencart_114_patch1.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_1_4_patch1 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.1.4-1';
          break;
       case '1.1.4u':  // upgrading from v1.1.4 TO v1.2.0  ('u' implies "upgrade", rather than just the patch1)
          if (!$dbinfo->version114 || $dbinfo->version120) continue;
          $sniffer_file = '_upgrade_zencart_114_to_120.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_0 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.0';
          break;
       case '1.2.0jp':  // upgrading from 1.2.0-l10n-jp-1 or 1.2.0-l10n-jp-2 TO 1.2.0-l10n-jp-3
#          if (!$dbinfo->version120 || $dbinfo->version120jp3) continue;
          $sniffer_file = '_upgrade_zencart_120jp2_to_3.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_0 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.0-l10n-jp-3';
          break;
       case '1.2.0':  // upgrading from v1.2.0 TO v1.2.1
          if (!$dbinfo->version120 || $dbinfo->version121) continue;   // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_120_to_121.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_1 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.1';
          break;
       case '1.2.1':  // upgrading from v1.2.1 TO v1.2.2
//          if (!$dbinfo->version121 || $dbinfo->version122) continue;   // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_121_to_122.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_2 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.2';
          break;
       case '1.2.2':  // upgrading from v1.2.2 TO v1.2.3
//          if (!$dbinfo->version122 || $dbinfo->version123) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_122_to_123.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_3 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.3';
          break;
       case '1.2.3':  // upgrading from v1.2.3 TO v1.2.4
//          if (!$dbinfo->version123 || $dbinfo->version124) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_123_to_124.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_4 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.4';
          break;
       case '1.2.4':  // upgrading from v1.2.4 TO v1.2.5
//          if (!$dbinfo->version124 || $dbinfo->version125) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_124_to_125.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_5 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.5';
          break;
       case '1.2.5':  // upgrading from v1.2.5 TO v1.2.6
//          if (!$dbinfo->version125 || $dbinfo->version126) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_125_to_126.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_6 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.6';
          break;
       case '1.2.6':  // upgrading from v1.2.6 TO v1.2.7
//          if (!$dbinfo->version126 || $dbinfo->version127) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_126_to_127.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_2_7 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.2.7';
          break;
       case '1.2.7':  // upgrading from v1.2.7 TO v1.3.0
//          if (!$dbinfo->version127 || $dbinfo->version130) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_127_to_130.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_3_0 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.3.0';
          break;
       case '1.3.0':  // upgrading from v1.3.0 TO 1.3.0.1
//          if (!$dbinfo->version130 || $dbinfo->version1301) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_130_to_1301.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_3_0_1 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.3.0.1';
          break;
       case '1.3.0.1':  // upgrading from v1.3.0.1 TO 1.3.0.2
//          if (!$dbinfo->version1301 || $dbinfo->version1302) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_1301_to_1302.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_3_0_2 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.3.0.2';
          break;
       case '1.3.0.2jpfrom1.3.0.2':  // upgrading from v1.3.0.2 TO 1.3.0.2-l10n-jp-1
//          if (!$dbinfo->version1302 || $dbinfo->version1302jp1) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_1302_to_1302jp1.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_3_0_2_jp_1 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.3.0.2-l10n-jp-1';
          break;
       case '1.3.0.2jpfrom1.2.0jp3':  // upgrading from v1.2.0-l10n-jp-3 TO 1.3.0.2-l10n-jp-1
//          if (!$dbinfo->version1302 || $dbinfo->version1302jp1) continue;  // if prerequisite not completed, or already done, skip
          $sniffer_file = '_upgrade_zencart_120jp3_to_1302jp1.sql';
          if (ZC_UPG_DEBUG2==true) echo $sniffer_file.'<br>';
          $got_v1_3_0_2_jp_1_from_v1_2_0_jp_3 = true; //after processing this step, this will be the new version-level
          $db_upgraded_to_version='1.3.0.2-l10n-jp-1';
          break;
       default:
       $nothing_to_process=true;
       } // end while

       //check for errors
     $zc_install->test_store_configure(ERROR_TEXT_STORE_CONFIGURE,ERROR_CODE_STORE_CONFIGURE);
     if (!$zc_install->fatal_error) {
        require(DIR_WS_INCLUDES . 'configure.php');
//        require(DIR_WS_INCLUDES . 'classes/db/' . DB_TYPE . '/query_factory.php');
        $zc_install->fileExists(DB_TYPE . $sniffer_file, DB_TYPE . $sniffer_file . ' ' . ERROR_TEXT_DB_SQL_NOTEXIST.'<br />"'.DB_TYPE . $sniffer_file.'"' , ERROR_CODE_DB_SQL_NOTEXIST);
        $zc_install->functionExists(DB_TYPE, ERROR_TEXT_DB_NOTSUPPORTED, ERROR_CODE_DB_NOTSUPPORTED);
        $zc_install->dbConnect(DB_TYPE, DB_SERVER, DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, ERROR_TEXT_DB_CONNECTION_FAILED, ERROR_CODE_DB_CONNECTION_FAILED,ERROR_TEXT_DB_NOTEXIST, ERROR_CODE_DB_NOTEXIST);

// security check 
    if ((!isset($_POST['adminid']) && !isset($_POST['adminpwd'])) || (isset($_POST['adminid']) && ($_POST['adminid']=='' || $_POST['adminid']=='demo'))) {
      $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
    } else {
      $admin_name = zen_db_prepare_input($_POST['adminid']);
      $admin_pass = zen_db_prepare_input($_POST['adminpwd']);
      $sql = "select admin_id, admin_name, admin_pass from " . DB_PREFIX . "admin where admin_name = '" . zen_db_prepare_input($admin_name) . "'";

      //open database connection to run queries against it
      $db = new queryFactory;
      $db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");
      $result = $db->Execute($sql);
      $db->Close();
      if (!($admin_name == $result->fields['admin_name'])  || $admin_name=='demo') {
        $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
      }
      if (!zen_validate_password($admin_pass, $result->fields['admin_pass'])) {
        $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
      }
    }
// end admin verification
        } //end if !fatal_error

       if (ZC_UPG_DEBUG2==true) echo 'Processing ['.$sniffer_file.']...<br />';
       if ($zc_install->error == false && $nothing_to_process==false) {
        //open database connection to run queries against it 
        $db = new queryFactory;
        $db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");

          // load the upgrade.sql file(s) relative to the required step(s)
          $query_results = executeSql(DB_TYPE . $sniffer_file, DB_DATABASE, DB_PREFIX); 
           if ($query_results['queries'] > 0 && $query_results['queries'] != $query_results['ignored']) {
             $messageStack->add('upgrade',$query_results['queries'].' statements processed.', 'success');
           } else {
             $messageStack->add('upgrade','Failed: '.$query_results['queries'], 'error');
           }
           if (zen_not_null($query_results['errors'])) {
             foreach ($query_results['errors'] as $value) {
               $messageStack->add('upgrade-error-details','SKIPPED: '.$value, 'error');
             }
           }
           if ($query_results['ignored'] != 0) {
             $messageStack->add('upgrade','Note: '.$query_results['ignored'].' statements ignored. See "upgrade_exceptions" table for additional details.', 'caution');
           }
/*           if (zen_not_null($query_results['output'])) {
             foreach ($query_results['output'] as $value) {
echo 'CAUTION: '.$value.'<br />';
               if (zen_not_null($value)) $messageStack->add('INFO: '.$value, 'caution');
             }
           }
*/
          $failed_entries += $query_results['ignored'];
          $db->Close();
          } // end if "no error"
     } // end while - version loop
if ($failed_entries !=0) {
  $zc_install->setError('<span class="errors">NOTE: '.$failed_entries.'個のSQL文がスキップされました。<br />詳細はこのページ下部を参照してください。<br />(より詳細な情報は「upgrade_exceptions」テーブルに記録されています。)</span><br />Note: あなたのサイトには、すでにこれらのSQL文が実行されていた、などの理由により<br />ほとんどのケースで、今回の問題は無視することができます。<br />もし、すべての提案されたアップグレードのステップが完了したら、(no recommendations left), <br />アップグレードをスキップしてサイトの設定を続けることができます。','85', false);
  }
if (ZC_UPG_DEBUG2==true) {echo '<span class="errors">NOTE: Skipped upgrade statements: '.$failed_entries.'<br />See details at bottom of page for your inspection.<br />(Details also logged in the "upgrade_exceptions" table.)</span>';}
  } // end if-is-array-POST['version']




  // PREFIX-RENAME ROUTINE:
  // if database table-prefix 'change' has been requested, process it here:
  if (isset($_POST['newprefix'])) {
    $newprefix = $_POST['newprefix'];
    if (isset($_POST['db_prefix'])) { //use specified "old" prefix if entered
       $db_prefix_rename_from = $_POST['db_prefix'];
       } else {
       $db_prefix_rename_from = DB_PREFIX;
       }
    if ($newprefix != $db_prefix_rename_from) { // don't process prefix changes if same prefix selected
     $zc_install->test_admin_configure(ERROR_TEXT_ADMIN_CONFIGURE,ERROR_CODE_ADMIN_CONFIGURE);
     $zc_install->test_store_configure(ERROR_TEXT_STORE_CONFIGURE,ERROR_CODE_STORE_CONFIGURE);
     $zc_install->test_admin_configure_write(ERROR_TEXT_ADMIN_CONFIGURE_WRITE,ERROR_CODE_ADMIN_CONFIGURE_WRITE);
     $zc_install->test_store_configure_write(ERROR_TEXT_STORE_CONFIGURE_WRITE,ERROR_CODE_STORE_CONFIGURE_WRITE);
     $zc_install->functionExists(DB_TYPE, ERROR_TEXT_DB_NOTSUPPORTED, ERROR_CODE_DB_NOTSUPPORTED);
     $zc_install->dbConnect(DB_TYPE, DB_SERVER, DB_DATABASE, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, ERROR_TEXT_DB_CONNECTION_FAILED, ERROR_CODE_DB_CONNECTION_FAILED,ERROR_TEXT_DB_NOTEXIST, ERROR_CODE_DB_NOTEXIST);

// security check 
    if (!isset($_POST['adminid']) && !isset($_POST['adminpwd'])) {
      $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
    } elseif ($_POST['adminid']=='') {
      $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
    } else {
      $admin_name = zen_db_prepare_input($_POST['adminid']);
      $admin_pass = zen_db_prepare_input($_POST['adminpwd']);
      $sql = "select admin_id, admin_name, admin_pass from " . DB_PREFIX . "admin where admin_name = '" . zen_db_prepare_input($admin_name) . "'";
      $db = new queryFactory;
      $db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");
      $result = $db->Execute($sql);
      $db->Close();
      if (!($admin_name == $result->fields['admin_name'])  || $admin_name=='demo') {
        $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
      }
      if (!zen_validate_password($admin_pass, $result->fields['admin_pass'])) {
        $zc_install->setError(ERROR_TEXT_ADMIN_PWD_REQUIRED, ERROR_CODE_ADMIN_PWD_REQUIRED, true);
      }
    }
// end admin verification

     if (ZC_UPG_DEBUG2==true) echo 'Processing prefix updates...<br />';
     if ($zc_install->error == false && $nothing_to_process==false) {
       $db = new queryFactory;
       $db->Connect(DB_SERVER, DB_SERVER_USERNAME, DB_SERVER_PASSWORD, DB_DATABASE) or die("Unable to connect to database");

       $tables = $db->Execute("SHOW TABLES"); // get a list of tables to compare against
       $tables_list = array();
       while (!$tables->EOF) {
	  $tables_list[] = $tables->fields['Tables_in_' . DB_DATABASE];
       $tables->MoveNext();
       } //end while


      //read the "database_tables.php" files, and loop through the table names
      foreach($database_tablenames_array as $filename) {
       if (!file_exists($filename)) continue;
       $lines = file($filename);
       foreach ($lines as $line) {
         $line = trim($line);
         if (substr($line,0,1) != '<' && substr($line,0,2) != '?'.'>' && substr($line,0,2) != '//' && $line != '') {
//           echo 'line='.$line.'<br>';
             $def_string=array();
             $def_string=explode("'",$line);
             //define('TABLE_CONSTANT',DB_PREFIX.'tablename');
             //[1]=TABLE_CONSTANT
             //[2]=,DB_PREFIX.
             //[3]=tablename
             //[4]=);
             //[5]=
             //echo '[1]->'.$def_string[1].'<br>';
             //echo '[2]->'.$def_string[2].'<br>';
             //echo '[3]->'.$def_string[3].'<br>';
             //echo '[4]->'.$def_string[4].'<br>';
             //echo '[5]->'.$def_string[5].'<br>';
           if (strtoupper($def_string[1]) != 'DB_PREFIX' // the define of DB_PREFIX is not a tablename
               && str_replace('PHPBB','',strtoupper($def_string[1]) ) == strtoupper($def_string[1])  // this is not a phpbb table
               && str_replace(' ','',$def_string[2]) == ',DB_PREFIX.') { // this is a Zen Cart-related table (vs phpbb)
               $tablename_read = $def_string[3];
               foreach($tables_list as $existing_table) {
                 if ($tablename_read == str_replace($db_prefix_rename_from,'',$existing_table)) {
                  //echo $tablename_read.'<br>';
                  $sql_command = 'alter table '. $db_prefix_rename_from . $tablename_read . ' rename ' . $newprefix.$tablename_read;
                  //echo $sql_command .'<br>';
                  $db->Execute($sql_command);
                  $tables_updated++;
                  $tablename_read = '';
                  $sql_command = '';
                }//endif $tablename_read == existing
               }//end foreach $tables_list
              } //endif is "DEFINE"?
            } // endif substring not < or ? or // etc
          } //end foreach $lines
         }//end foreach $database_tablenames array

         $db->Close();
         } // end if zc_install-error

         //echo $tables_updated;
         if ($tables_updated <50) $zc_install->setError(ERROR_TEXT_TABLE_RENAME_INCOMPLETE, ERROR_CODE_TABLE_RENAME_INCOMPLETE, false);

         if ($tables_updated >50) {
           //update the configure.php files with the new prefix.
           $configure_files_updated = 0;
           foreach($configure_files_array as $filename) {
            $lines = file($filename);
            $full_file = '';
            foreach ($lines as $line) {
               $def_string=explode("'",$line);
               if (strtoupper($def_string[1]) == 'DB_PREFIX') {
                  // check to see if prefix found matches what we've been processing... for safety to be sure we have the right line
                  $old_prefix_from_file = $def_string[3];
                  if ($old_prefix_from_file == DB_PREFIX || $old_prefix_from_file == $db_prefix_rename_from) {
                       $line = '  define(\'DB_PREFIX\', \'' . $newprefix. '\');' . "\n";
                       $configure_files_updated++;
                  }
              } // endif DEFINE DB_PREFIX found;
              $full_file .= $line;
            } //end foreach $lines
            $fp = fopen($filename, 'w');
            fputs($fp, $full_file);
            fclose($fp);
            @chmod($filename, 0644);
           } //end foreach array to update configure.php files
         if ($configure_files_updated <2) $zc_install->setError(ERROR_TEXT_TABLE_RENAME_CONFIGUREPHP_FAILED, ERROR_CODE_TABLE_RENAME_CONFIGUREPHP_FAILED, false);
        } //endif $tables_updated count sufficient
      } //endif newprefix != DB_PREFIX
  } //endif prefix POST'd

// ?
  if (isset($_POST['upgrade'])) {
      header('location: index.php?main_page=system_setup&language=' . $language . '&sql_cache='.$suggested_cache . '&is_upgrade=1');
    exit;
  }


 if ($db_upgraded_to_version==$latest_version && $zc_install->error == false && $failed_entries==0) { 
  // if all db upgrades have been applied, go to the 'finished' page.
  header('location: index.php?main_page=finished&language=' . $language);
  exit;
  } else { //return for more upgrades
    if (!$zc_install->fatal_error && !$zc_install->error && $failed_entries==0 ) {
      header('location: index.php?main_page=database_upgrade&language=' . $language);
      exit;
    }
  }//endif
 } // end if POST==submit

 if (isset($_POST['skip'])) {
  header('location: index.php?main_page=finished&language=' . $language);
  exit;
 }
?>
