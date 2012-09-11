<?php
/*
 * Copyright (C) 2005 MEDIA COMMUNICATION INC.
 *
 *   Portions Copyright (c) 2004 The zen-cart developers
 *   Portions Copyright (c) 2003 osCommerce
 *   Portions Copyright (c) 2002 Thomas Pl舅kers
 *                                http://www.oscommerce.at
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
 * $Id: ot_money_cod_fee.php,v 1.1 2005/12/11 02:22:41 shida Exp $
 * -> (https://media-com.ark-web.jp/pukiwiki/pukiwiki.php?%A5%B9%A5%C8%A1%BC%A5%EA%A1%BC%2F2)
 * 追加モジュール：合計金額による代金引換手数料
 */

  define('MODULE_ORDER_TOTAL_MONEY_COD_TITLE', '合計金額による代金引換手数料');
  define('MODULE_ORDER_TOTAL_MONEY_COD_DESCRIPTION', '合計金額による代金引換手数料');
  define('TEXT_INFO_ORDER_TOTAL_MONEY_COD_TITLE', '代金引換手数料');
  define('TEXT_INFO_TOTAL_MONEY_COD_FEES', '<strong>注意：</strong> 合計金額による代金引換手数料がかかります。');
  define('TEXT_INFO_COD_FEES', TEXT_INFO_TOTAL_MONEY_COD_FEES);
  define('TEXT_INFO_TOTAL_MONEY_COD_FEES_ERROR', '<font color="#ff0000">選択できません。</font>');
?>