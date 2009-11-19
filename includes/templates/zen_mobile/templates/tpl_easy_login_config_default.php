
<?php
echo $mobile->view_securepage_notice();
if (!$_SESSION['customer_id']) {
    $_SESSION['navigation']->set_snapshot();
    zen_redirect(zen_href_link(FILENAME_LOGIN, '', 'SSL'));
}
echo TEXT_EASY_LOGIN_CONFIG;
echo "<br>";
echo TEXT_EASY_LOGIN_DESC;
echo "<br>";
echo "<br>";
echo TEXT_CURRENT_SETTING;


?>
<font color=red>
<?php echo $current_config?>
</font>
<?php
 if($mobile->isDoCoMo()){
     echo "<form action=./index.php?main_page=".FILENAME_EASY_LOGIN_CONFIG."&guid=on method=post>";
 }else{
     echo zen_draw_form('easy_login_config', zen_href_link(FILENAME_EASY_LOGIN_CONFIG, '', 'SSL'));
}
if($conf_flg){
    echo  zen_draw_hidden_field('config', '0');
    echo '<input type="submit" value="'.TEXT_CONFIG_OFF .'">';
}else{
    echo  zen_draw_hidden_field('config', '1');
    echo '<input type="submit" value="'.TEXT_CONFIG_ON .'">';
}
?>
</form>
