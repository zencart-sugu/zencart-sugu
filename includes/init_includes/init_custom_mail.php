<?php
/**
 * $Id: init_custom_mail.php,v 1.2 2006/03/25 08:30:23 shida Exp $
 *
 * Zen Cart module 0.9
 *  Copyright (C) 2006 by Zen Cart.JP
 *  http://zen-cart.jp
 *
 * Note: Original work copyright to 2006 ARK-Web co., ltd.
 *   http://www.ark-web.jp
 *
 * Zen Cart mobile module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Zen Cart mobile module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Shigeo; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */

  require_once(DIR_WS_CLASSES . 'observers/ObserversCustomMail.php');

  $oObserversCustomMail = new ObserversCustomMail();
  $zco_notifier->attach($oObserversCustomMail, $oObserversCustomMail->getAllEventID());

?>
