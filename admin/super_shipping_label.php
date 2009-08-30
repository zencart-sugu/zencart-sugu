<?php
/*
//////////////////////////////////////////////////////////
//  SUPER ORDERS                                        //
//                                                      //
//  By Frank Koehl (PM: BlindSide)                      //
//                                                      //
//  Powered by Zen-Cart (www.zen-cart.com)              //
//  Portions Copyright (c) 2005 The Zen-Cart Team       //
//                                                      //
//  Released under the GNU General Public License       //
//  available at www.zen-cart.com/license/2_0.txt       //
//  or see "license.txt" in the downloaded zip          //
//////////////////////////////////////////////////////////
//  DESCRIPTION:   Report that displays all income for  //
//  the given date range.  Report results come solely   //
//  from the Super Orders payment system.               //
//////////////////////////////////////////////////////////
// $Id: super_shipping_label.php 25 2006-02-03 18:55:56Z BlindSide $
*/

  require('includes/application_top.php');
  require(DIR_WS_CLASSES . 'currencies.php');
  $currencies = new currencies();

  $oID = zen_db_prepare_input($_GET['oID']);

  include(DIR_WS_CLASSES . 'order.php');
  $order = new order($oID);
?>

<HTML>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=<?php echo CHARSET; ?>">
<title><?php echo 'Shipping Label'; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF">

<!-- body_text //-->
<p>
    <TABLE border="0" width="100%" cellspacing="4" cellpadding="4">
      <TR>
        <TD>
          <TABLE border="0" width="100%" cellspacing="4" cellpadding="4">
            <TR>
              <TD class="main"><?php echo nl2br(STORE_NAME_ADDRESS); ?></TD>
            </TR>
           </TABLE>

          <TABLE border="0" width="100%" cellspacing="2" cellpadding="2">
            <TR>
              <TD valign="top">
                <TABLE width="100%" border="0" cellspacing="2" cellpadding="2">
                  
                   <TR>
                   <td width="20%"><?php echo $oID; ?></td>
                    <TD class="pageHeading"><?php echo zen_address_format($order->delivery['format_id'], $order->delivery, 1, '', '<br>'); ?></TD>
                  </TR>
                </TABLE>
              </TD>
              <? php
              ?>
            </TR>
          </TABLE>
        </TD>
      </TR>
    </TABLE>
  </BODY>
</HTML>