<?php
require('includes/application_top.php');
//include(DIR_FS_CATALOG.'includes/functions/extra_functions/not_configuration_func.php');
$action = (isset($_GET['action']) ? $_GET['action'] : '');
if (zen_not_null($action)) {
    switch ($action) {
        case 'save':
        // demo active test
            if (zen_admin_demo()) {
                $_GET['action']= '';
                $messageStack->add_session(ERROR_ADMIN_DEMO, 'caution');
                zen_redirect(zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE, 'template_dir='.$_GET['template_dir'].'gID=' . $_GET['gID'] . '&cID=' . $cID));
            }
            $configuration_value = zen_db_prepare_input($_POST['configuration_value']);
            $cID = zen_db_prepare_input($_GET['cID']);
            $db->Execute("UPDATE " . TABLE_CONFIGURATION_FOREACH_TEMPLATE . "
                          SET configuration_value = '" . zen_db_input($configuration_value) . "',
                          last_modified = now() 
                          WHERE template_dir = '".$_GET['template_dir']."' AND configuration_key = '" .$_POST['cfg_key'] . "'");
               
            $configuration_query = 'SELECT configuration_key as cfgkey, configuration_value as cfgvalue
                                    from ' . TABLE_CONFIGURATION_FOREACH_TEMPLATE .
                                   ' WHERE template_dir ="'.$_GET['template_dir'].'"';
            $configuration = $db->Execute($configuration_query);
                
             //set the WARN_BEFORE_DOWN_FOR_MAINTENANCE to false if DOWN_FOR_MAINTENANCE = true
                
            if ( (WARN_BEFORE_DOWN_FOR_MAINTENANCE == 'true') && (DOWN_FOR_MAINTENANCE == 'true') ) {
                    $db->Execute("update " . TABLE_CONFIGURATION_FOREACH_TEMPLATE . "
                                  set configuration_value = 'false', last_modified = '" . NOW . "'
                                  where configuration_key = 'WARN_BEFORE_DOWN_FOR_MAINTENANCE'").
                                  'AND template_dir ="' .$_GET['template_dir']."'";     
            }
           zen_redirect(zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE,'template_dir='.$_GET['template_dir'] .'&gID=' . $_GET['gID'] . '&cID=' . $cID));
        break;
    }
}

if(isset($_POST['gID'])){
    $_GET['gID'] = $_POST['gID'];
}
if($_POST['checked']==3){
    zen_check_manage($_POST['select']);
}


function zen_templates_name_scrap(){
    $tmpls = zen_display_template_dir();
    foreach($tmpls as $key){
        $templates[] = $key['text'];
    }
    return $templates;
}
function zen_mysql_escape($param){
    return mysql_real_escape_string ($param);
}

function zen_check_manage($cfg_key){
    global $db;
    $exists_key = array();
    $i = 0;
    while(isset($cfg_key[$i])){
        $insert_check = $db->Execute("SELECT configuration_key from ".TABLE_CONFIGURATION_FOREACH_TEMPLATE.
                                     " WHERE template_dir='".$_POST['template_dir']."' AND configuration_key='".$cfg_key[$i]."'");
        if(empty($insert_check->fields['configuration_key'])){
            $res = $db->Execute('SELECT * FROM '.TABLE_CONFIGURATION.' WHERE configuration_key="'.$cfg_key[$i].'"');
             if(!$res->EOF){
                $insertquery = 'insert into '.TABLE_CONFIGURATION_FOREACH_TEMPLATE.' values(
                                NULL'.
                                ',"'.zen_db_input($res->fields['configuration_title']).'"'.
                                ',"'.zen_db_input($res->fields['configuration_key']).'"'.
                                ',"'.zen_db_input($res->fields['configuration_value']).'"'.
                                ',"'.zen_db_input($res->fields['configuration_description']).'",'.
                                $res->fields['configuration_group_id'].',"'.
                                $_POST['template_dir'].'","'.
                                $res->fields['sort_order'].
                                '","'.$res->fields['last_modified'].'","'.
                                $res->fields['date_added'].
                                '","'.zen_db_input($res->fields['use_function']).'"'.
                                ',"'.zen_db_input($res->fields['set_function']).'")';
                $db->Execute($insertquery);
            }
        }
        $i++;
    }
    $res = $db->Execute('select configuration_key ,configuration_id from '.TABLE_CONFIGURATION_FOREACH_TEMPLATE.' 
            where configuration_group_id = '.$_POST['gID'].' and template_dir = "'.$_POST['template_dir'].'"');
    while(!$res->EOF){
        $exists_key[$res->fields['configuration_key']] = $res->fields['configuration_id'];
        $res->MoveNext();
    }
    for(;$i>=0;$i--){
       $del_array[] = $exists_key[$cfg_key[$i]];
    }
    next($del_array);
    while(current($del_array)){
        $del .= current($del_array);
        if(next($del_array)){
            $del .= ",";
        }else{
            $del .= current($del_array);
        }
    }
    
   if(empty($del)){
       $del = 0;
   }
    $res = $db->Execute('SELECT configuration_id FROM '.TABLE_CONFIGURATION_FOREACH_TEMPLATE.'
                         WHERE template_dir = "'.$_POST['template_dir'].'" AND configuration_group_id = '.$_POST['gID'].'
                         AND configuration_id NOT IN('.$del.')');
    
    while(!$res->EOF){
        $delid = $res->fields['configuration_id'];
        $db->Execute('delete from '.TABLE_CONFIGURATION_FOREACH_TEMPLATE.' where configuration_id = '.$delid); 
        $res->MoveNext();
    }
    zen_redirect(zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE,'template_dir='.$_POST['template_dir'].'&checked=2&gID='.$_POST['gID']));
}
function zen_get_template_dir(){
    global $db;
    $res = $db->Execute("select distinct template_dir from ".TABLE_TEMPLATE_SELECT);
    $tmpdir = array();
    while (!$res->EOF) {
        $tmpdir[] = array('id' =>$res->fields['template_dir'],
                          'text' =>$res->fields['template_dir']);
        $res->MoveNext();
    }
    return $tmpdir; 
}
function zen_get_cfg_group(){
    global $db;
    $res = $db->Execute('SELECT configuration_group_id AS cfg_gid ,configuration_group_title AS cfg_gt 
                         FROM '. TABLE_CONFIGURATION_GROUP .' where visible=1');
    $cfg_group = array();
    while(!$res->EOF){
        $cfg_group[] = array('id' => $res->fields['cfg_gid'],
                'title' => $res->fields['cfg_gt']);
        $res->MoveNext();
    }
    foreach($cfg_group as $key){
        $cfg_group_array[] = array('id' => $key['id'],'text' => $key['title']);
    }
    return $cfg_group_array;
}
$dir = @dir(DIR_FS_CATALOG_TEMPLATES);
if (!$dir) die('DIR_FS_CATALOG_TEMPLATES NOT SET');
while ($file = $dir->read()) {
    if (is_dir(DIR_FS_CATALOG_TEMPLATES . $file) && strtoupper($file) != 'CVS' && $file != 'template_default') {
	    if (file_exists(DIR_FS_CATALOG_TEMPLATES . $file . '/template_info.php')) {
	    require(DIR_FS_CATALOG_TEMPLATES . $file . '/template_info.php');
            $template_info[$file] = array('name' => $template_name,
                                         'version' => $template_version,
                                          'author' => $template_author,
                                          'description' => $template_description,
                                          'screenshot' => $template_screenshot);
        }
    }
}
?>

<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
<!--
function init()
{
cssjsmenu('navbar');
if (document.getElementById)
{
var kill = document.getElementById('hoverJS');
kill.disabled = true;
}
}

// -->
</script>
</head>
<body onload="init()">
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->

<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td class="pageHeading"><?php echo HEADING_TITLE . '&nbsp;' . $_SESSION['language']; ?> &nbsp;&nbsp;
        
        
        </td>
      </tr>
    </td>
  </tr>
</table>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
<tr>
<?php 
echo TEXT_INFO_SELECT_TEMPLATE.":";
$tmpdir = zen_get_template_dir();
?>
<form method='get'action=<?php echo $_SERVER['PHP_SELF'];?>>
<?php echo zen_draw_pull_down_menu('template_dir',$tmpdir,'','');?>
<input type='submit' value=<?php echo TEXT_SELECT;?>>
</form>
</tr><td>
<?php
if(isset($_GET['template_dir'])){
    echo "<form method='get' action= ".$_SERVER['PHP_SELF'].">";
    echo "<INPUT type='hidden' name='checked' value=1>";
    echo "<INPUT type='hidden' name='template_dir' value=".$_GET['template_dir'].">";
    echo "<INPUT type='submit' value=".TEXT_INFO_SELECT_CHANGEING_POSSIBLE.">";
    echo "</form>";
}

  $cfg_group = zen_get_cfg_group();
  $draw_html = "<tr><form method='get' action=".$_SERVER['PHP_SELF'].">".zen_draw_pull_down_menu('gID',$cfg_group,'','');
  $draw_html .= "<input type='hidden' value='2' name='checked'>";
  $draw_html .= "<input type='hidden' value=".$_GET['template_dir']." name='template_dir'><input type='submit' value=".TEXT_SELECT.">";
  $draw_html .= "</form></tr>";
  $buttom_back =  "<form method='get' action=".$_SERVER['PHP_SELF']."><INPUT TYPE='submit' value=".TEXT_BACK."><INPUT TYPE=hidden name='template_dir value=".$_GET['template_dir']."></form>";
?>


<?php 
if(isset($_GET['checked']) && isset($_GET['template_dir'])){
    $tmpl = $db->Execute('SELECT template_dir from '.TABLE_TEMPLATE_SELECT.' where template_dir="'.$_GET['template_dir'].'"');
?>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
<tbody>
<tr>
<p>
<tr><b><?php echo $tmpl->fields['template_dir'].TEXT_NECESSITY_SETTING_TEMPLATE;}?></b></tr>
<p>
<?php
if(($_GET['checked']==1)){
    echo $draw_html;
    echo $buttom_back;
}
if(($_GET['checked']==2)){
    echo $draw_html;
    echo $buttom_back;
    $group_title = $db->Execute('SELECT configuration_group_title from '.TABLE_CONFIGURATION_GROUP.' where configuration_group_id ='.$_GET['gID']);
?>    
        
<b><br><br><?php echo $group_title->fields['configuration_group_title'];?></b><br>
<td width="5%"><b><?php echo TEXT_CHECK;?></b></td>
<td width="30%"><b><?php echo TABLE_HEADING_CONFIGURATION_TITLE;?></b></td>
</tr>
<?php
    $cfg_grp = $db->Execute('SELECT configuration_title, configuration_key AS cfg_key FROM '.TABLE_CONFIGURATION .' WHERE '.zen_get_not_cfg_query('<>').' AND configuration_group_id='.$_GET['gID']);
    echo '<form method="POST" action="'.$_SERVER['PHP_SELF'].'">';
    while(!$cfg_grp->EOF){
        $res = $db->Execute("SELECT configuration_key as cfg_key FROM ".TABLE_CONFIGURATION_FOREACH_TEMPLATE." WHERE template_dir ='" . $_GET['template_dir'] . "' AND configuration_key = "."'".$cfg_grp->fields['cfg_key']."'");
        echo '<tr>';
        echo '<td align="center"><INPUT TYPE="checkbox" value="'.$cfg_grp->fields['cfg_key'].'" name="select[]"';
        if(isset($res->fields['cfg_key'])){ 
            echo 'checked="checked"';
        }
        echo '></td>';
        echo '<td>'.$cfg_grp->fields['configuration_title'].'</td>';
        $cfg_grp->MoveNext();
    }
    echo '<input type="hidden" name="template_dir" value='.$_GET['template_dir'].'>';
    echo '<input type="hidden" name="gID" value='.$_GET['gID'].'>';
    echo '<input type="hidden" name="checked" value="3">';
    echo '<td><input type="submit" value="'.TEXT_RENEW.'"></form></td>';
}    
?>
    </tbody>
</table>
 
</td>
<tr>
<?php
if(isset($_GET['template_dir'])){
    foreach($tmpdir as $value){
        if($value['id'] == $_GET['template_dir']){
            $select_tmpDir = $value['text'];
        }
    }
}
?>
<td>

<?php

if(isset($select_tmpDir)&&empty($_GET['checked'])){
    echo "[".$select_tmpDir."]".TEXT_INFO_SELECTED_TEMPLATE."<br/>"; 
    $cfg_groups = array();
    $cfg_groups[] = array('id' => -1, 'text' => TEXT_INFO_SELECT_FILE);
    $configuration_groups = $db->Execute("select configuration_group_id as cgID, 
                                                       configuration_group_title as cgTitle 
                                                from " . TABLE_CONFIGURATION_GROUP . " 
                                                where visible = '1' order by sort_order");
    while (!$configuration_groups->EOF) {
      $cfg_groups[]= array('id'=>$configuration_groups->fields['cgID'],'text' =>$configuration_groups->fields['cgTitle']);
      $configuration_groups->MoveNext();
    }
    echo zen_draw_form('select_setting',FILENAME_CONFIGURATION_FOREACH_TEMPLATE,'template_dir='.$_GET['template_dir']). '&nbsp;&nbsp;' . 
    zen_draw_pull_down_menu('gID', $cfg_groups, '0', 'onChange="this.form.submit();"') .
    zen_hide_session_id() . '&nbsp;&nbsp;</form>';
    if(isset($_GET['gID'])&&isset($_GET['template_dir'])){
        $set_cfg = $db->Execute("select configuration_key ,configuration_id,sort_order from " . TABLE_CONFIGURATION_FOREACH_TEMPLATE . "
                               where template_dir = '".$_GET['template_dir']."' and configuration_group_id = '" . (int)$_GET['gID'] . "'order by sort_order");
        while(!$set_cfg->EOF){
            $set_key[$set_cfg->fields['configuration_key']] = $set_cfg->fields['configuration_id']; 
            $set_cfg->MoveNext();
        }
        if(isset($set_key)){
            while(current($set_key)){
                $in .= current($set_key);
                if(next($set_key)){
                    $in .= ",";
                }
            }
        }
        if(empty($in)){
            $in = 0;
        }
    }
    $gID = (isset($_GET['gID'])) ? $_GET['gID'] : 1;
    $_GET['gID'] = $gID;
    $group_title = $db->Execute('SELECT configuration_group_title from '. TABLE_CONFIGURATION_GROUP. ' where  configuration_group_id='.$gID);
}
?>
<?php
if(isset($in)&&isset($_GET['template_dir'])&&isset($_GET['gID'])){
?>      <tr>
<table border="0" width="100%" cellspacing="2" cellpadding="2">
  <tr>
<!-- body_text //-->
    <td width="100%" valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
      <tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td class="pageHeading"><?php echo $group_title->fields['configuration_group_title']; ?></td>
            <td class="pageHeading" align="right"><?php echo zen_draw_separator('pixel_trans.gif', HEADING_IMAGE_WIDTH, HEADING_IMAGE_HEIGHT); ?></td>
          </tr>
        </table></td>
      </tr>
        <td><table border="0" width="100%" cellspacing="0" cellpadding="0">
          <tr>
            <td valign="top"><table border="0" width="100%" cellspacing="0" cellpadding="2">
              <tr class="dataTableHeadingRow">
                <td class="dataTableHeadingContent" width="55%"><?php echo TABLE_HEADING_CONFIGURATION_TITLE; ?></td>
                <td class="dataTableHeadingContent"><?php echo TABLE_HEADING_CONFIGURATION_VALUE; ?></td>
                <td class="dataTableHeadingContent" align="right"><?php echo TABLE_HEADING_ACTION; ?>&nbsp;</td>
              </tr>
<?php              
  $cfg = $db->Execute("SELECT configuration_id, configuration_title, configuration_value, configuration_key,use_function 
                       FROM " . TABLE_CONFIGURATION_FOREACH_TEMPLATE . "
                       WHERE template_dir = '".$_GET['template_dir']."' AND configuration_group_id = '" . (int)$_GET['gID'] . "'
                       AND configuration_id IN  (".$in.")order by sort_order ");
}
if(isset($cfg)){
    while(!$cfg->EOF){
        if (zen_not_null($cfg->fields['use_function'])) {
            $use_function = $cfg->fields['use_function'];
            if (ereg('->', $use_function)) {
                $class_method = explode('->', $use_function);
                if (!is_object(${$class_method[0]})) {
                    include(DIR_WS_CLASSES . $class_method[0] . '.php');
                    ${$class_method[0]} = new $class_method[0]();
                }
                $cfgValue = zen_call_function($class_method[1], $cfg->fields['configuration_value'], ${$class_method[0]});
            }else {
                $cfgValue = zen_call_function($use_function, $cfg->fields['configuration_value']);
            }
        }else {
            $cfgValue = $cfg->fields['configuration_value'];
        }
 
        if ((!isset($_GET['cID']) || (isset($_GET['cID']) && ($_GET['cID'] == $cfg->fields['configuration_id']))) && !isset($cInfo) && (substr($action, 0, 3) != 'new')) {
            $cfg_extra = $db->Execute("select configuration_key, configuration_description, date_added,
                         last_modified, use_function, set_function
                         from " . TABLE_CONFIGURATION_FOREACH_TEMPLATE . "
                         where template_dir = '".$_GET['template_dir']."' and configuration_id = '" . (int)$cfg->fields['configuration_id'] . "'");
            $cInfo_array = array_merge($cfg->fields, $cfg_extra->fields);
            $cInfo = new objectInfo($cInfo_array);
        }
        if ( (isset($cInfo) && is_object($cInfo)) && ($cfg->fields['configuration_id'] == $cInfo->configuration_id) ) {
            echo '                  <tr id="defaultSelected" class="dataTableRowSelected" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE,'template_dir='.$_GET['template_dir']. '&gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '\'">' . "\n";
        } else {
            echo '                  <tr class="dataTableRow" onmouseover="rowOverEffect(this)" onmouseout="rowOutEffect(this)" onclick="document.location.href=\'' . zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE, 'template_dir='.$_GET['template_dir']. '&gID=' . $_GET['gID'] . '&cID=' . $cfg->fields['configuration_id'] . '&action=edit') . '\'">' . "\n";
        }
  
?>
<td class="dataTableContent"><?php echo $cfg->fields['configuration_title']; ?></td>
<td class="dataTableContent"><?php echo htmlspecialchars($cfgValue); ?></td>
<td class="dataTableContent" align="right"><?php if ( (isset($cInfo) && is_object($cInfo)) && ($cfg->fields['configuration_id'] == $cInfo->configuration_id) ) { echo zen_image(DIR_WS_IMAGES . 'icon_arrow_right.gif', ''); } else { echo '<a href="' . zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE, 'gID=' . $_GET['gID'] . '&cID=' . $cfg->fields['configuration_id']) . '">' . zen_image(DIR_WS_IMAGES . 'icon_info.gif', IMAGE_ICON_INFO) . '</a>'; } ?>&nbsp;</td>
              </tr>
<?php

        $cfg->MoveNext();
    }
?>
            </table></td>   
    
<?php
    $heading = array();
    $contents = array();
    switch ($action) {
        case 'edit':
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');

        if ($cInfo->set_function) {
            eval('$value_field = ' . $cInfo->set_function . '"' . htmlspecialchars($cInfo->configuration_value) . '");');
        } else {
            $value_field = zen_draw_input_field('configuration_value', $cInfo->configuration_value, 'size="60"');
        }
        $contents = array('form' => zen_draw_form('configuration', FILENAME_CONFIGURATION_FOREACH_TEMPLATE, 'template_dir='.$_GET['template_dir'].'&gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=save'));
        if (ADMIN_CONFIGURATION_KEY_ON == 1) {
            $contents[] = array('text' => '<strong>Key: ' . $cInfo->configuration_key . '</strong><br />');
        }
        $contents[] = array('text' => TEXT_INFO_EDIT_INTRO);
        $contents[] = array('text' => '<br><b>' . $cInfo->configuration_title . '</b><br>' . $cInfo->configuration_description . '<br>' . $value_field);
        $contents[] = array('text'=>'<INPUT TYPE="hidden" name="cfg_key" value='. $cInfo->configuration_key.'>');
        $contents[] = array('align' => 'center', 'text' => '<br>' . zen_image_submit('button_update.gif', IMAGE_UPDATE) . '&nbsp;<a href="' . zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE,'template_dir='.$_GET['template_dir']. '&gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id) . '">' . zen_image_button('button_cancel.gif', IMAGE_CANCEL) . '</a>');
    break;
    default:
      if (isset($cInfo) && is_object($cInfo)) {
        $heading[] = array('text' => '<b>' . $cInfo->configuration_title . '</b>');
        if (ADMIN_CONFIGURATION_KEY_ON == 1) {
          $contents[] = array('text' => '<strong>Key: ' . $cInfo->configuration_key . '</strong><br />');
        }
        $contents[] = array('align' => 'center', 'text' => '<a href="' . zen_href_link(FILENAME_CONFIGURATION_FOREACH_TEMPLATE,'template_dir='.$_GET['template_dir'].  '&gID=' . $_GET['gID'] . '&cID=' . $cInfo->configuration_id . '&action=edit') . '">' . zen_image_button('button_edit.gif', IMAGE_EDIT) . '</a>');
        $contents[] = array('text' => '<br>' . $cInfo->configuration_description);
        $contents[] = array('text' => '<br>' . TEXT_INFO_DATE_ADDED . ' ' . zen_date_short($cInfo->date_added));
        if (zen_not_null($cInfo->last_modified)) $contents[] = array('text' => TEXT_INFO_LAST_MODIFIED . ' ' . zen_date_short($cInfo->last_modified));
      }
      break;
  }
  if ( (zen_not_null($heading)) && (zen_not_null($contents)) ) {
    echo '            <td width="25%" valign="top">' . "\n";
    $box = new box;
    
    echo $box->infoBox($heading, $contents);
    echo '            </td>' . "\n";
  }
}
    ?>
          </tr>
        </table></td>
      </tr>
    </table></td>

    

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>
