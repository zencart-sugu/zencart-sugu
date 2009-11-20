<?php
 /*
  * Copyright (C) 2006 NICOS_CONVENI INC.
  *
  * This program is free software; you can redistribute it and/or modify
  * it under the terms of the GNU General Public License as published by
  * the Free Software Foundation; either version 2 of the License, or
  * (at your option) any later version.
  *
  * This program is distributed in the hope that it will be useful,
  * but WITHOUT ANY WARRANTY; without even the implied warranty of
  * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
  * GNU General Public License for more details.
  *
  * You should have received a copy of the GNU General Public License
  * along with Shigeo; if not, write to the Free Software
  * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
  *
  * $Id$
  */
//

  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_TITLE', 'Settlement of Credit cart(Digitalcheck)');
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_DESCRIPTION', 'Digitalcheck:The function of the Credit card settlement is offered.<br/>'
                                                           .'<br/>'
                                                           .'Please contact the following me when you apply.<br/>'
                                                           .'¡¦·èºÑ´°Î»ÄÌÃÎURL<br/>'
                                                           .'¡¡'.HTTPS_SERVER.DIR_WS_HTTPS_CATALOG.'extras/digitalcheck_cc_finish_payment.php<br/>'
                                                           .'¡¦·èºÑ´°Î»»þÌá¤êÀèURL<br/>'
                                                           .'¡¡'.HTTP_SERVER.DIR_WS_HTTPS_CATALOG.'index.php?main_page=checkout_process<br/>'
                                                           .'¡¦¥­¥ã¥ó¥»¥ë»þÌá¤êÀèURL <br/>'
                                                           .'¡¡'.HTTP_SERVER.DIR_WS_HTTPS_CATALOG.'index.php?main_page=checkout_payment<br/>'
                                                           );
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_NOT_SUCCESS', 'The settlement completion notification of the credit card was not able to be acquired. ');
  define('MODULE_PAYMENT_DIGITALCHECK_CC_TEXT_TIMEOUT', 'Settlement time-out of credit card');
  define('MODULE_PAYMENT_DIGITALCHECK_CC_MAIL_TIMEOUT', "The following credit-card transactions are invalid according to the session time-out.\n"
                                                       ."Please process the cancellation.\n"
                                                       ."\n"
                                                       ."Customer ID:%d\n"
                                                       ."SID:%s");
?>
