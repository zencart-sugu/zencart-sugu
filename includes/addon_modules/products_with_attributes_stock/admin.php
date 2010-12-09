<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: products_with_attributes_stock.php 2999 2006-02-09 17:21:39Z drbyte $
//
require(DIR_WS_CLASSES . 'currencies.php');
require_once('../includes/addon_modules/products_with_attributes_stock/classes/products_with_attributes_stock.php');

$stock = new products_with_attributes_stock_class;

if(isset($_SESSION['languages_id'])){ $language_id = $_SESSION['languages_id'];} else { $language_id=1;}

if(isset($_GET['action']))
{
    $action = $_GET['action'];
}
else
{
    $action = '';
}

switch($action)
{
    case 'reset':
        $_SESSION['searchfilter'] = "";
        break;

    case 'add':
        if(isset($_GET['products_id']) and is_numeric((int)$_GET['products_id']))
        {
            $products_id = (int)$_GET['products_id'];
        }
        if(isset($_POST['products_id']) and is_numeric((int)$_POST['products_id']))
        {
            $products_id = (int)$_POST['products_id'];
        }

        if(isset($products_id))
        {

            if(zen_products_id_valid($products_id))
            {

                $product_name = zen_get_products_name($products_id);
                $product_attributes = $stock->get_products_attributes($products_id, $language_id);

            $hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
            }
            else
            {

                zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
            }
        }
        else
        {

            $query = 'SELECT DISTINCT
                        attrib.products_id, description.products_name
                      FROM 
                        '.TABLE_PRODUCTS_ATTRIBUTES.' attrib, '.TABLE_PRODUCTS_DESCRIPTION.' description
                      WHERE 
                        attrib.products_id = description.products_id and description.language_id='.(int)$language_id.' order by description.products_name';

            $products = $db->execute($query);
            while(!$products->EOF)
            {
                $products_array_list[] = array(
                'id' => $products->fields['products_id'],
                'text' => $products->fields['products_name']
                );
                $products->MoveNext();
            }
        }
        break;
    case 'edit':
        $hidden_form = '';
        if(isset($_GET['stock_id']) and is_numeric((int)$_GET['stock_id']))
        {
            $stock_id = (int)$_GET['stock_id'];
        }

        if(isset($_GET['products_id']) and is_numeric((int)$_GET['products_id']))
        {
            $products_id = (int)$_GET['products_id'];
        }

        if ($stock_id > 0 && $products_id > 0)
            ;
        else
        {
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
        }

        $query  = "select * from ".TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK." where stock_id=".(int)$stock_id;
        $result = $db->Execute($query);
        if ($result->EOF)
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));

        $attributes = explode(",", $result->fields['stock_attributes']);
        foreach($attributes as $attribute_id)
            $attributes_list[] = $stock->get_attributes_name($attribute_id, $_SESSION['languages_id']);
        $stock_id    = $result->fields['stock_id'];
        $products_id = $result->fields['products_id'];
        $attributes  = $result->fields['stock_attributes'];
        $qty         = $result->fields['quantity'];
        $skumodel    = $result->fields['skumodel'];

        break;

    case 'confirm':
        if(isset($_POST['products_id']) and is_numeric((int)$_POST['products_id']))
        {

            if(!isset($_POST['quantity']) || !is_numeric($_POST['quantity']))
            {
                zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
            }
            $products_id = $_POST['products_id'];
            $product_name = zen_get_products_name($products_id);
            if(is_numeric($_POST['quantity']))
            {
                $quantity = $_POST['quantity'];
            }
            $skumodel = $_POST['skumodel'];

            $attributes = $_POST['attributes'];
    
            foreach($attributes as $attribute_id)
            {
                $hidden_form .= zen_draw_hidden_field('attributes[]',$attribute_id)."\n";
                $attributes_list[] = $stock->get_attributes_name($attribute_id, $_SESSION['languages_id']);
            }
            $hidden_form .= zen_draw_hidden_field('products_id',$products_id)."\n";
            $hidden_form .= zen_draw_hidden_field('quantity',$quantity)."\n";
            $hidden_form .= zen_draw_hidden_field('skumodel',$skumodel)."\n";
            $s_mack_noconfirm  ="module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK."&";
            $s_mack_noconfirm .="products_id=" . $products_id . "&"; //s_mack:noconfirm
            $s_mack_noconfirm .="quantity=" . $quantity . "&"; //s_mack:noconfirm
            // なんでGETで渡すんだ orz
            $s_mack_noconfirm .="skumodel=" . urlencode(urlencode($skumodel)) . "&"; //s_mack:noconfirm

            if(sizeof($attributes) > 1)
            {
                sort($attributes);
                $stock_attributes = implode(',',$attributes);
            }
            else
            {
                $stock_attributes = $attributes[0];
            }
            $s_mack_noconfirm .='attributes=' . $stock_attributes . '&'; //kuroi: to pass string not array

            $query = 'select * from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where products_id = '.(int)$products_id.' and stock_attributes="'.zen_db_prepare_input($stock_attributes).'"';
            $stock_check = $db->Execute($query);

            if(!$stock_check->EOF)
            {
                $hidden_form .= zen_draw_hidden_field('add_edit','edit');
                $hidden_form .= zen_draw_hidden_field('stock_id',$stock_check->fields['stock_id']);
                $s_mack_noconfirm .="stock_id=" . $stock_check->fields['stock_id'] . "&"; //s_mack:noconfirm
                $s_mack_noconfirm .="add_edit=edit&"; //s_mack:noconfirm
                $add_edit = 'edit';
            }
            else
            {
                $hidden_form .= zen_draw_hidden_field('add_edit','add')."\n";
                $s_mack_noconfirm .="add_edit=add&"; //s_mack:noconfirm
            }

        }
        else
        {
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
        }
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, $s_mack_noconfirm . "action=execute", 'NONSSL')); //s_mack:noconfirm
        break;
    case 'execute':
        $attributes = $_POST['attributes'];
        if ($_GET['attributes']) { $attributes = $_GET['attributes']; } //s_mack:noconfirm

        $products_id = $_POST['products_id'];
        if ($_GET['products_id']) { $products_id = $_GET['products_id']; } //s_mack:noconfirm

        $quantity = $_POST['quantity']; //s_mack:noconfirm
        if ($_GET['quantity']) { $quantity = $_GET['quantity']; } //s_mack:noconfirm
        if(!is_numeric((int)$quantity)) //s_mack:noconfirm
        {
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
        }

        $skumodel = $_POST['skumodel']; //s_mack:noconfirm
        if ($_GET['skumodel']) { $skumodel = $_GET['skumodel']; } //s_mack:noconfirm
        if(trim($skumodel) == '') //s_mack:noconfirm
        {
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
        }
        $skumodel = zen_db_input(urldecode($skumodel));
        /*
        michael mcinally <mcinallym@picassofish.com>
        heavily modified version to allow inserting "ALL" attributes at once
        also should probably run this SQL command as well:
        ALTER TABLE `products_with_attributes_stock` ADD UNIQUE `products_id_stock_attributes` (`products_id`, `stock_attributes`);
        */
        if(($_POST['add_edit'] == 'add') || ($_GET['add_edit'] == 'add')) //s_mack:noconfirm
        {
            if (preg_match("/\|/", $attributes)) {

                $arrTemp = preg_split("/\,/", $attributes);
                $arrMain = array();
                $intCount = 0;
                for ($i = 0;$i < sizeof($arrTemp);$i++) {
                    $arrTemp1 = preg_split("/\|/", $arrTemp[$i]);
                    $arrMain[] = $arrTemp1;
                    if ($intCount) {
                        $intCount = $intCount * sizeof($arrTemp1);
                    } else {
                        $intCount = sizeof($arrTemp1);
                    }
                }
                $intVars = sizeof($arrMain);
                $arrNew = array();
                if ($intVars >= 1) {
                    eval('
                    for ($i = 0;$i < sizeof($arrMain[0]);$i++) {
                        if ($intVars >= 2) {
                            for ($j = 0;$j < sizeof($arrMain[1]);$j++) {
                                if ($intVars >= 3) {
                                    for ($k = 0;$k < sizeof($arrMain[2]);$k++) {
                                        if ($intVars >= 4) {
                                            for ($l = 0;$l < sizeof($arrMain[3]);$l++) {
                                                if ($intVars >= 5) {
                                                    for ($m = 0;$m < sizeof($arrMain[4]);$m++) {
                                                        if ($intVars >= 6) {
                                                            for ($n = 0;$n < sizeof($arrMain[5]);$n++) {
                                                                $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l], $arrMain[4][$m], $arrMain[5][$n]);
                                                            }
                                                        } else {
                                                            $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l], $arrMain[4][$m]);
                                                        }
                                                    }
                                                } else {
                                                    $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k], $arrMain[3][$l]);
                                                }
                                            }
                                        } else {
                                            $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j], $arrMain[2][$k]);
                                        }
                                    }
                                } else {
                                    $arrNew[] = array($arrMain[0][$i], $arrMain[1][$j]);
                                }
                            }
                        } else {
                            $arrNew[] = array($arrMain[0][$i]);
                        }
                    }
                    ');
                }
                for ($i = 0;$i < sizeof($arrNew);$i++) {
                    $strAttributes = implode(",", $arrNew[$i]);
                    $query = 'insert into `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` (`products_id`,`stock_attributes`,`quantity`,`skumodel`) values ('.(int)$products_id.',"'.zen_db_prepare_input($strAttributes).'",'.(float)$quantity.",'".zen_db_prepare_input($skumodel)."'".') ON DUPLICATE KEY UPDATE `stock_attributes` = "'.zen_db_prepare_input($strAttributes).'", `quantity` = '.(float)$quantity;
                    $db->Execute($query);
                }
            } else {
              $query = 'insert into `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` (`products_id`,`stock_attributes`,`quantity`,`skumodel`) values ('.(int)$products_id.',"'.zen_db_prepare_input($attributes).'",'.(float)$quantity.",'".zen_db_prepare_input($skumodel)."')";
                $db->Execute($query);
            }
        }
        elseif(($_POST['add_edit'] == 'edit') || ($_GET['add_edit'] == 'edit')) //s_mack:noconfirm
        {
            $stock_id = $_POST['stock_id']; //s_mack:noconfirm
            if ($_GET['stock_id']) { $stock_id = $_GET['stock_id']; } //s_mack:noconfirm
            if(!is_numeric((int)$stock_id)) //s_mack:noconfirm
            {
                zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, zen_get_all_get_params(array('action')), 'NONSSL'));
            }

            $query = 'update `'.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.'` set quantity='.(float)$quantity.",skumodel='".zen_db_prepare_input($skumodel)."' where stock_id=".(int)$stock_id.' limit 1';
            $db->Execute($query);
        }
        

        $stock->update_parent_products_stock($products_id);
        $messageStack->add_session(PWA_UPDATE_VARIANT_PROCESSED, 'success');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'NONSSL'));

        break;
    case 'delete':
        if(!isset($_POST['confirm']))
        {
            // do nothing
        }
        else
        {
            // delete it
            if($_POST['confirm'] == PWA_DELETE_VARIANT_YES){
                $query = 'delete from '.TABLE_PRODUCTS_WITH_ATTRIBUTES_STOCK.' where stock_id="'.(int)$_POST['stock_id'].'" limit 1';
                $db->Execute($query);
                $stock->update_parent_products_stock((int)$_POST['products_id']);
                $messageStack->add_session(PWA_DELETE_VARIANT_PROCESSED, 'failure');
                zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'NONSSL'));
            } else {
                zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'NONSSL'));
            }
        }
        break;

    case 'resync':
        if(is_numeric((int)$_GET['products_id'])){

            $stock->update_parent_products_stock((int)$_GET['products_id']);
            $messageStack->add_session(PWA_UPDATE_PARENT_PROCESSED, 'success');
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'NONSSL'));

        } else {
            zen_redirect(zen_href_link(FILENAME_ADDON_MODULES_ADMIN, 'module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'NONSSL'));
        }
        break;
    default:
        // Show a list of the products

        break;
}


?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<link rel="stylesheet" type="text/css" href="includes/javascript/spiffyCal/spiffyCal_v2_1.css">
<script language="JavaScript" src="includes/javascript/spiffyCal/spiffyCal_v2_1.js"></script>
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
<body onLoad="init()">
<!-- header //-->
<?php
require(DIR_WS_INCLUDES . 'header.php');
?>
<!-- header_eof //-->
<div style="padding: 20px;">

<!-- body_text_eof //-->
<!-- body_eof //-->
<?php

switch($action)
{
    case 'add':


        if(isset($products_id))
        {
            echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'&action=confirm', 'post', '', true)."\n";
            echo $hidden_form;

            echo '<table>'."\n";
            echo '<tr><td colspan="2"><p><strong>'.$product_name.'</strong></p></td></tr>'."\n";
            echo '<tr><td>&nbsp;</td></tr>'."\n";

            foreach($product_attributes as $option_name => $options)
            {
// MULTI
                $arrValues = array();
                if (is_array($options)) {
                    if (sizeof($options) > 0) {
                       foreach ($options as $k => $a) {
                            $arrValues[] = $a['id'];
                        }
                    }
                }
                
                echo '<tr>'."\n";
                echo '<td><p><strong>'.$option_name.'</strong></p></td>';
                echo '<td>'.zen_draw_pull_down_menu('attributes[]',$options).'</td>'."\n";
                echo '</tr>'."\n";
            }

            echo '<tr><td><p><strong>' . PWA_QUANTITY . '</strong></p></td><td>'.zen_draw_input_field('quantity').'</td>'."\n";
            echo '<tr><td><p><strong>' . PWA_SKUMODEL . '</strong></p></td><td>'.zen_draw_input_field('skumodel').'</td>'."\n";

            echo '</table>'."\n";
        }
        else
        {
            echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'&action=add', 'post', '', true)."\n";
            echo zen_draw_pull_down_menu('products_id',$products_array_list)."\n";
        }

?>
      <input type="submit" value="<?php echo PWA_SUBMIT ?>">
    </form>
<?php
    echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'post', '', true)."\n";
?>
      <input type="submit" value="<?php echo PWA_CANCEL ?>">
    </form>
<?php
break;
    case 'edit':

        echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'&action=confirm', 'post', '', true)."\n";

        echo zen_draw_hidden_field('stock_id',      $stock_id);
        echo zen_draw_hidden_field('products_id',   $products_id);
        echo zen_draw_hidden_field('attributes[]',  $attributes);

        echo '<table>'."\n";
        echo '<tr><td colspan="2"><h3>'.zen_get_products_name($products_id).'</h3></td></tr>';

        foreach($attributes_list as $attributes)
        {
            echo '<tr>'."\n";
            echo '<td><p><strong>'.$attributes['option'].'</strong></p>';
            echo '<td>'.$attributes['value'].'</td>';
            echo '</tr>'."\n";
        }

        echo $hidden_form;
        echo '<tr><td><p><strong>'.PWA_QUANTITY.'</strong></p></td><td>'.zen_draw_input_field('quantity', $qty).'</td>'."\n"; //s_mack:prefill_quantity
        echo '<tr><td><p><strong>'.PWA_SKUMODEL.'</strong></p></td><td>'.zen_draw_input_field('skumodel', $skumodel).'</td>'."\n";

        echo '</table>'."\n";
?>
       <input type="submit" value="<?php echo PWA_SUBMIT ?>">
    </form>
<?php
        echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK, 'post', '', true)."\n";
?>
       <input type="submit" value="<?php echo PWA_CANCEL ?>">
    </form>
<?php
break;
    case 'delete':
        if(!isset($_POST['confirm']))
        {

            echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'&action=delete', 'post', '', true)."\n";
            echo PWA_DELETE_VARIANT_CONFIRMATION;
            foreach($_GET as $key=>$value)
            {
                echo zen_draw_hidden_field($key,$value);
            }
?>
    <p><input type="submit" value="<?php echo PWA_DELETE_VARIANT_YES ?>" name="confirm"> * <input type="submit" value="<?php echo PWA_DELETE_VARIANT_NO ?>" name="confirm"></p>
    </form>
<?php  
        }
        break;
    case 'confirm':

        echo '<h3>Confirm '.$product_name.'</h3>';

        foreach($attributes_list as $attributes)
        {
            echo '<p><strong>'.$attributes['option'].': </strong>'.$attributes['value'].'</p>';
        }

        echo '<p><strong>Quantity</strong>'.$quantity.'</p>';
        echo zen_draw_form('final_refund_exchange', FILENAME_ADDON_MODULES_ADMIN, "module=".FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'&action=execute', 'post', '', true)."\n";
        echo $hidden_form;
?>
    <p><input type="submit" value="<?php echo PWA_SUBMIT ?>"></p>
    </form>

<?php   
break;
    default:
        $result = $stock->displayFilteredRows();
        echo '<div id="hugo1" style="background-color: green; padding: 2px 10px;"></div>';    
        echo '<form method="post" action="'.FILENAME_ADDON_MODULES_ADMIN.'.php?module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'" id="pwas-search" name="pwas-search">'.PWA_SEARCH.'<input id="pwas-filter" type="text" name="search" value="'.$_SESSION['searchfilter'].'"/>';
        echo '<input type="submit" value="'.PWA_SEARCH.'" id="searchbtn" name="searchbtn"/></form>';
        echo '<form method="post" action="'.FILENAME_ADDON_MODULES_ADMIN.'.php?module='.FILENAME_PRODUCTS_WITH_ATTRIBUTES_STOCK.'&action=reset" id="pwas-search" name="pwas-search">';
        echo '<input type="submit" value="'.PWA_RESET.'" id="resetbtn" name="resetbtn"/></form>';
        echo '<div id="pwa-table">';
        echo $result;
        echo '</div>';
break;
}
?>
<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
<br />
</div>
</body>
</html>
