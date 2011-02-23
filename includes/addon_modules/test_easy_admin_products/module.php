<?php
/**
 * @copyright Copyright (c) ark-web, Inc. All rights reserved.
 * @author Syuichi Kohata
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 */

if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class test_easy_admin_products extends addOnModuleBase {
    var $title       = MODULE_TEST_EASY_ADMIN_PRODUCTS_TITLE;
    var $description = MODULE_TEST_EASY_ADMIN_PRODUCTS_DESCRIPTION;
    var $version     = "1.0.0";
    var $sort_order  = MODULE_TEST_EASY_ADMIN_PRODUCTS_SORT_ORDER;
    var $status      = MODULE_TEST_EASY_ADMIN_PRODUCTS_STATUS;
    var $icon;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title'       => MODULE_TEST_EASY_ADMIN_PRODUCTS_STATUS_TITLE,
            'configuration_key'         => 'MODULE_TEST_EASY_ADMIN_PRODUCTS_STATUS',
            'configuration_value'       => MODULE_TEST_EASY_ADMIN_PRODUCTS_STATUS_DEFAULT,
            'configuration_description' => MODULE_TEST_EASY_ADMIN_PRODUCTS_STATUS_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'), '
            ),
          array(
            'configuration_title'       => MODULE_TEST_EASY_ADMIN_PRODUCTS_SORT_ORDER_TITLE,
            'configuration_key'         => 'MODULE_TEST_EASY_ADMIN_PRODUCTS_SORT_ORDER',
            'configuration_value'       => MODULE_TEST_EASY_ADMIN_PRODUCTS_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_TEST_EASY_ADMIN_PRODUCTS_SORT_ORDER_DESCRIPTION,
            'use_function'              => 'null',
            'set_function'              => 'null'
            ),
          );

    var $require_modules = array('easy_admin_products');
    var $notifier        = array('NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_SEARCH_FORM',
                                 'NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SEARCH',
                                 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_EDIT',
                                 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_VALIDATE_SAVE',
                                 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_VALIDATE_COPY',
                                 'NOTIFY_EASY_ADMIN_PRODUCTS_START_DELETE',
                                 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DELETE');

    // class constructer for php4
    function test_easy_admin_products() {
        global $zco_notifier;
        $this->__construct();
    }

    function __construct() {
        parent::__construct();
    }

    function notifierUpdate($notifier) {
        if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_SEARCH_FORM')
            $this->notify_easy_admin_products_finish_display_search_form();
        else if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_BEFORE_SEARCH')
            $this->notify_easy_admin_products_before_search();
        else if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DISPLAY_EDIT')
            $this->notify_easy_admin_products_finish_display_edit();
        else if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_VALIDATE_SAVE')
            $this->notify_easy_admin_products_finish_validate_save();
        else if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_VALIDATE_COPY')
            $this->notify_easy_admin_products_finish_validate_copy();
        else if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_START_DELETE')
            $this->notify_easy_admin_products_start_delete();
        else if ($notifier == 'NOTIFY_EASY_ADMIN_PRODUCTS_FINISH_DELETE')
            $this->notify_easy_admin_products_finish_delete();
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    // notifier
    function notify_easy_admin_products_finish_display_search_form() {
        global $html;
        global $easy_admin_products_search_form_html;

        $search_item = '<td align="right">金額以上</td>'."\n"
                     . '<td><input id="search_price" name="search_price" type="text" value="'.htmlspecialchars($_SESSION['search_price']).'" /></td>'."\n";
        $easy_admin_products_search_form_html = str_replace('%__SEARCH_EXTERNAL_ITEMS__%', $search_item, $easy_admin_products_search_form_html);
    }

    function notify_easy_admin_products_before_search() {
        global $easy_admin_products_searchs;
        global $easy_admin_products_search_where;
        global $easy_admin_products_search_join;

        $easy_admin_products_searchs = array('search_price');

        if ($_SESSION['search_price'] != "")
          $easy_admin_products_search_where = " and p.products_price > ".(int)$_SESSION['search_price'];
    }

    function notify_easy_admin_products_finish_display_edit() {
        global $html;
        global $easy_admin_products_product;
        global $easy_admin_products_edit_screent_html;
        global $easy_admin_products_validate;

        $add_items = '<tr>'."\n"
                   . $html->text("products_add1", '追加項目', $easy_admin_products_product['products_add1'])
                   . '</tr>'."\n"
                   . $html->error($easy_admin_products_validate, "products_add1");

        $easy_admin_products_edit_screent_html = str_replace('%__EDIT_EXTERNAL_ITEMS__%', $add_items, $easy_admin_products_edit_screent_html);

        $ext_items = '<tr>'."\n"
                   .   '<td>'.zen_draw_separator('pixel_trans.gif', 0, 20).'<td>'."\n"
                   . '</tr>'."\n"
                   . '<tr>'."\n"
                   .   '<td colspan="2">■拡張設定</td>'."\n"
                   .   '<td>'."\n"
                   .     '<a id="a_products_seo" href="javascript:void()" onclick="toggle_detail('."'products_ext1'".');">'."\n"
                   .       MODULE_EASY_ADMIN_PRODUCTS_OPEN
                   .     '</a>'."\n"
                   .   '</td>'."\n"
                   . '</tr>'."\n"
                   . '<tr id="tr_products_ext1" style="display:none;">'."\n"
                   .   '<td colspan="3">'."\n"
                   .     '<table border="0" width="100%" cellspacing="0" cellpadding="0">'."\n"
                   .       '<tr>'."\n"
                   .         $html->text("products_ext1", '拡張項目', $easy_admin_products_product['products_ext1'])
                   .       '</tr>'."\n"
                   .       $html->error($easy_admin_products_validate, "products_ext1")
                   .     '</table>'."\n"
                   .   '</td>'."\n"
                   . '</tr>'."\n";
        $easy_admin_products_edit_screent_html = str_replace('%__EDIT_EXTERNAL_EXPAND_ITEMS__%', $ext_items, $easy_admin_products_edit_screent_html);
    }

    function notify_easy_admin_products_finish_validate_save() {
        global $easy_admin_products_product;
        global $easy_admin_products_validate;

        if ($easy_admin_products_product['products_add1'] == "")
          $easy_admin_products_validate['products_add1'] = "空はだめだ";

        if ($easy_admin_products_product['products_ext1'] == "")
          $easy_admin_products_validate['products_ext1'] = "何か入れろ";
    }

    function notify_easy_admin_products_finish_validate_copy() {
        global $easy_admin_products_product;
        global $easy_admin_products_validate;
    }

    function notify_easy_admin_products_start_delete() {
        global $db;
        global $easy_admin_products_product;
        global $easy_admin_products_validate;
        global $easy_admin_products_product_id;
    }

    function notify_easy_admin_products_finish_delete() {
        global $db;
        global $easy_admin_products_product;
        global $easy_admin_products_validate;
        global $easy_admin_products_product_id;
    }
}
