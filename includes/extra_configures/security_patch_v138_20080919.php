<?php
/** 
 * Security Patch v1.3.8 20080919
 * 
 * @package initSystem
 * @copyright Copyright 2003-2008 Zen Cart Development Team
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: security_patch_v138_20080919.php 9900 2008-09-22 21:39:12Z wilt $
 */
/**
 * Security Patch
 * 
 * Multiple Vulnerabilities
 * 
 * SQL Injection - $_POST['products_id'] 
 * SQL Injection - $_POST['id']
 * 
 * Please Note : This file should be placed in includes/extra_configures and will automatically load.
 *  
 */
if (isset($_POST['id']) && is_array($_POST['id']) && count($_POST['id']) > 0)
{
  $_POST['id'] = securityPatchSanitizePostVariableId($_POST['id']);
}
if (isset($_POST['products_id']) && is_array($_POST['products_id']) && count($_POST['products_id']) > 0)
{
  $_POST['products_id'] = securityPatchSanitizePostVariableProductsId($_POST['products_id']);
}
// -> #21373
if (isset($_POST['cart_quantity']) && is_array($_POST['cart_quantity']) && count($_POST['cart_quantity']) > 0)
{
  $_POST['cart_quantity'] = securityPatchSanitizePostVariableProductsId($_POST['cart_quantity']);
}
if (isset($_POST['cart_quantity']) && !is_array($_POST['cart_quantity'])) {
  $_POST['cart_quantity'] = mb_convert_kana($_POST['cart_quantity'], "a", "EUC-JP");
}
// <- #21373
function securityPatchSanitizePostVariableId ($arrayToSanitize)
{
  foreach ($arrayToSanitize as $key => $variableToSanitize)
  {
    {
      if (is_integer($key))
      {
        if (is_array($arrayToSanitize[$key]))
        {
          $arrayToSanitize[$key] = securityPatchSanitizePostVariableId($arrayToSanitize[$key]);
        }
        else 
        {
          $arrayToSanitize[$key] = (int) $variableToSanitize;
        }
      }
    }
    if (ereg_replace('[0-9a-zA-z:_]', '', $key) != '')
      unset($arrayToSanitize[$key]);
  }
  return $arrayToSanitize;
}
function securityPatchSanitizePostVariableProductsId ($arrayToSanitize)
{
  foreach ($arrayToSanitize as $key => $variableToSanitize)
  {
    {
// -> #21373
      $variableToSanitize = mb_convert_kana($variableToSanitize, "a", "EUC-JP");
// <- #21373
      $arrayToSanitize[$key] = ereg_replace('[^0-9a-fA-F:.]', '', $variableToSanitize);
    }
    if (ereg_replace('[0-9a-zA-z_]', '', $key) != '')
      unset($arrayToSanitize[$key]);
  }
  return $arrayToSanitize;
}
