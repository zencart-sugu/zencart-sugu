<?php
/**
 * Side Box Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_record_company_select.php 2982 2006-02-07 07:56:41Z birdbrain $
 */
  $content = "";
  $content .= '<div id="' . str_replace('_', '-', $box_id . 'Content') . '" class="sideBoxContent centeredContent">';
  $content.= zen_draw_form('record_company', zen_href_link(FILENAME_DEFAULT, '', 'NONSSL', false), 'get');
  $content .= zen_draw_pull_down_menu('record_company_id', $record_company_array, (isset($_GET['record_company_id']) ? $_GET['record_company_id'] : ''), 'onchange="this.form.submit();" size="' . MAX_RECORD_COMPANY_LIST . '" style="width: 90%; margin: auto;"') . zen_hide_session_id() .zen_draw_hidden_field('typefilter', 'record_company');
  $content .= zen_draw_hidden_field('main_page', FILENAME_DEFAULT) . '</form>';
  $content .= '</div>';
?>