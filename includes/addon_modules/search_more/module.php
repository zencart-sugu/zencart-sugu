<?php
/**
 * search_more Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Ohtsuji Takashi
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: search_more.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
    die('Illegal Access');
}

class search_more extends addOnModuleBase {

    var $author                        = "Otsuji Takashi";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $title = MODULE_SEARCH_MORE_TITLE;
    var $description = MODULE_SEARCH_MORE_DESCRIPTION;
    var $sort_order = MODULE_SEARCH_MORE_SORT_ORDER;
    var $icon;
    var $status = MODULE_SEARCH_MORE_STATUS;
    var $enabled;
    var $configuration_keys = array(
            array(
                'configuration_title' => MODULE_SEARCH_MORE_STATUS_TITLE,
                'configuration_key' => 'MODULE_SEARCH_MORE_STATUS',
                'configuration_value' => MODULE_SEARCH_MORE_STATUS_DEFAULT,
                'configuration_description' => MODULE_SEARCH_MORE_STATUS_DESCRIPTION,
                'use_function' => 'null',
                'set_function'              => 'zen_cfg_select_option(array(\'true\', \'false\'),'
            ),
            array(
                'configuration_title' => MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_TITLE,
                'configuration_key' => 'MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME',
                'configuration_value' => MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_DEFAULT,
                'configuration_description' => MODULE_SEARCH_MORE_PAGE_MAX_LIST_NAME_DESCRIPTION,
                'use_function' => 'null',
                'set_function' => 'null'
            ),
            array(
                'configuration_title' => MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_TITLE,
                'configuration_key' => 'MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE',
                'configuration_value' => MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_DEFAULT,
                'configuration_description' => MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE_DESCRIPTION,
                'use_function' => 'null',
                'set_function' => 'null'
            ),
            array(
                'configuration_title' => MODULE_SEARCH_MORE_SORT_LIST_NAME_TITLE,
                'configuration_key' => 'MODULE_SEARCH_MORE_SORT_LIST_NAME',
                'configuration_value' => MODULE_SEARCH_MORE_SORT_LIST_NAME_DEFAULT,
                'configuration_description' => MODULE_SEARCH_MORE_SORT_LIST_NAME_DESCRIPTION,
                'use_function' => 'null',
                'set_function' => 'null'
            ),
            array(
                'configuration_title' => MODULE_SEARCH_MORE_SORT_ORDER_TITLE,
                'configuration_key' => 'MODULE_SEARCH_MORE_SORT_ORDER',
                'configuration_value' => MODULE_SEARCH_MORE_SORT_ORDER_DEFAULT,
                'configuration_description' => MODULE_SEARCH_MORE_SORT_ORDER_DESCRIPTION,
                'use_function' => 'null',
                'set_function' => 'null'
            ),
        );
    var $require_modules = array();
    var $notifier = array(
                        'NOTIFY_SEARCH_COLUMNLIST_STRING',
                        'NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT',
                        'NOTIFY_HEADER_START_INDEX_MAIN_TEMPLATE_VARS',
                        'NOTIFY_HEADER_START_ADVANCED_SEARCH_RESULTS'
                    );

    var $list_sorter;

    // class constructer for php4
    function search_more() {
        $this->__construct();
    }

    // update method selector
    function notifierUpdate($notifier) {
        switch($notifier) {
            case 'NOTIFY_SEARCH_COLUMNLIST_STRING':
                $this->updateSearchColumnListString();
                break;
            case 'NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT':
                $this->updateProductListingResultcount();
                break;
            case 'NOTIFY_HEADER_START_INDEX_MAIN_TEMPLATE_VARS':
                $this->updateHeaderStartIndexMainTemplateVars();
                break;
            case 'NOTIFY_HEADER_START_ADVANCED_SEARCH_RESULTS':
                $this->updateHeaderStartAdvancedSearchResults();
                break;
        }
    }

    // blocks
    
    // block default
    function block() {
        $rtn = array();
        $rtn = $this->createSearchFormBlockVars($rtn);
        $rtn = $this->createParPageBlockVars($rtn);
        $rtn = $this->createSortBlockVars($rtn);
        $rtn = $this->createHiddenFieldsVars($rtn);
        return $rtn;
    }
    
    // block search form
    function block_search_form() {
        $rtn = array();
        $rtn = $this->createSearchFormBlockVars($rtn);
        $rtn = $this->createHiddenFieldsVars($rtn);
        return $rtn;
    }
    
    // block par page
    function block_par_page() {
        $rtn = array();
        $rtn = $this->createParPageBlockVars($rtn);
        $rtn = $this->createHiddenFieldsVars($rtn);
        return $rtn;
    }
    
    // block sort
    function block_sort() {
        $rtn = array();
        $rtn = $this->createSortBlockVars($rtn);
        $rtn = $this->createHiddenFieldsVars($rtn);
        return $rtn;
    }
    
    /*
     * run at NOTIFY_SEARCH_COLUMNLIST_STRING
     * copy column list of sort target
     */
    function updateSearchColumnListString() {
        global $column_list;
        if(isset($column_list)){
            $this->list_sorter = $column_list;
        }
    }

    /*
     * run at NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT
     * reset number of products / page
     */
    function updateProductListingResultcount() {
        global $listing_sql;
        global $listing_split;
        // get param -> session param -> system default
        $per_page
            = is_numeric($_GET['per_page']) ? $_GET['per_page'] 
                : (is_numeric($_SESSION['addon_search_more_par_page']) ? $_SESSION['addon_search_more_par_page']  : MAX_DISPLAY_PRODUCTS_LISTING);
        $max_results = (PRODUCT_LISTING_LAYOUT_STYLE=='columns' && PRODUCT_LISTING_COLUMNS_PER_ROW>0) ? (PRODUCT_LISTING_COLUMNS_PER_ROW * (int)($per_page/PRODUCT_LISTING_COLUMNS_PER_ROW)) : $per_page;
        $listing_split = new splitPageResults($listing_sql, $max_results, 'p.products_id', 'page');
    }

    /*
     * run at NOTIFY_SEARCH_COLUMNLIST_STRING
     * set user selected sort target
     */
    function updateHeaderStartIndexMainTemplateVars() {
        global $_GET;
        global $_SESSION;
        if(empty($_GET['sort'])){
            $_GET['sort'] = $_SESSION['addon_search_more_sort'];
        }
    }

    /*
     * run at NOTIFY_HEADER_START_ADVANCED_SEARCH_RESULTS
     * set user selected sort target
     */
    function updateHeaderStartAdvancedSearchResults() {
        global $_GET;
        if(empty($_GET['cPath'])){
            $parent = array();
            zen_get_parent_categories($parent,$_GET['categories_id']);
            $parent = array_reverse($parent);
            $cPath  = implode('_', $parent);
            if(zen_not_null($cPath)) {
                $cPath .= '_';
            }
            $_GET['cPath'] = $cPath . $_GET['categories_id'];
        }
    }

    // create vars for block search form
    function createSearchFormBlockVars($search_more_vars) {
        $serach_form_vars = array();
        $serach_form_vars['keyword'              ] = zen_not_null($_GET['keyword']) ? $_GET['keyword'] : MODULE_SEARCH_MORE_KEYWORD_FORMAT_STRING;
        $serach_form_vars['search_in_description'] = zen_not_null($_GET['search_in_description']) ? true : false;
        if(zen_not_null($_GET['cPath'])) {
            $cid = $_GET['cPath'];
            $cid_sub_pos = strrpos($_GET['cPath'], '_');
            if($cid_sub_pos > 0){
                $cid = substr($_GET['cPath'], strrpos($_GET['cPath'], '_') + 1);
            }
            $serach_form_vars['categories_id'] = $cid;
            $serach_form_vars['inc_subcat'   ] = '1';
        } else {
            $serach_form_vars['categories_id'] = $_GET['categories_id'];
            $serach_form_vars['inc_subcat'   ] = zen_not_null($_GET['inc_subcat']) ? true : false;
        }
        $serach_form_vars['manufacturers_id'] = $_GET['manufacturers_id'];
        $serach_form_vars['pfrom'           ] = $_GET['pfrom'];
        $serach_form_vars['pto'             ] = $_GET['pto'];
        $serach_form_vars['dfrom'           ] = zen_not_null($_GET['dfrom']) ? $_GET['dfrom'] : DOB_FORMAT_STRING;
        $serach_form_vars['dto'             ] = zen_not_null($_GET['dto'  ]) ? $_GET['dto'  ] : DOB_FORMAT_STRING;
        
        $search_more_vars['form_vars'] = $serach_form_vars;
        return $search_more_vars;
    }
    
    // create vars for block par page
    function createParPageBlockVars($search_more_vars) {
        $cnt_option_tmp = split(",", MODULE_SEARCH_MORE_PAGE_MAX_LIST_VALUE);
        if($cnt_option_tmp != FALSE){
            $cnt_option = array();
            foreach($cnt_option_tmp as $cnt_val){
                $cnt_option[]=array('id'=>$cnt_val,'text'=>$cnt_val);
            }
        }
        $search_more_vars['opt_per_page'] = $cnt_option;
        return $search_more_vars;
    }
    
    // create vars for block sort
    function createSortBlockVars($search_more_vars){
        $srt_option = array();
        // if $list_sorter empty,then try to set it from global vars
        if(!is_array($this->list_sorter)){
            global $column_list;
            if(isset($column_list)){
                $this->list_sorter = $column_list;
            } else {
                $define_list = array('PRODUCT_LIST_MODEL' => PRODUCT_LIST_MODEL,
                                     'PRODUCT_LIST_NAME' => PRODUCT_LIST_NAME,
                                     'PRODUCT_LIST_MANUFACTURER' => PRODUCT_LIST_MANUFACTURER,
                                     'PRODUCT_LIST_PRICE' => PRODUCT_LIST_PRICE,
                                     'PRODUCT_LIST_QUANTITY' => PRODUCT_LIST_QUANTITY,
                                     'PRODUCT_LIST_WEIGHT' => PRODUCT_LIST_WEIGHT,
                                     'PRODUCT_LIST_IMAGE' => PRODUCT_LIST_IMAGE);

                asort($define_list);

                $column_list = array();
                reset($define_list);
                while (list($column, $value) = each($define_list)) {
                    if ($value) $column_list[] = $column;
                }
                $this->list_sorter = $column_list;
            }
        }
        
        // create sort target list
        if(is_array($this->list_sorter)) {
            $index = 0;
            //if not default sort order,insert default.
            if($_GET['sort'] != '20a'){
                $srt_option[]=array('id'=>'20a','text'=>PULL_DOWN_ALL_RESET);
            }
            foreach($this->list_sorter as $sort){
                $index++;
                switch($sort) {
                    case 'PRODUCT_LIST_MODEL':
                        $srt_option[]=array('id'=>($index.'a'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MODEL);
                        $srt_option[]=array('id'=>($index.'d'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MODEL_DESC);
                        break;
                    case 'PRODUCT_LIST_NAME':
                        $srt_option[]=array('id'=>($index.'a'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_NAME);
                        $srt_option[]=array('id'=>($index.'d'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_NAME_DESC);
                        break;
                    case 'PRODUCT_LIST_MANUFACTURER':
                        $srt_option[]=array('id'=>($index.'a'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MANUFACTURER);
                        $srt_option[]=array('id'=>($index.'d'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_MANUFACTURER_DESC);
                        break;
                    case 'PRODUCT_LIST_QUANTITY':
                        $srt_option[]=array('id'=>($index.'a'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_QUANTITY);
                        $srt_option[]=array('id'=>($index.'d'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_QUANTITY_DESC);
                        break;
                    case 'PRODUCT_LIST_WEIGHT':
                        $srt_option[]=array('id'=>($index.'a'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_WEIGHT);
                        $srt_option[]=array('id'=>($index.'d'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_WEIGHT_DESC);
                        break;
                    case 'PRODUCT_LIST_PRICE':
                        $srt_option[]=array('id'=>($index.'a'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_PRICE);
                        $srt_option[]=array('id'=>($index.'d'),'text'=>MODULE_SEARCH_MORE_TEXT_INFO_SORT_BY_PRODUCTS_PRICE_DESC);
                        break;
                }
            }
        }
        
        $search_more_vars['opt_sort']     = $srt_option;
        return $search_more_vars;
    }
    
    // create vars for hidden fields
    function createHiddenFieldsVars($search_more_vars){
        $field_hidden;
        $get_prms = array_keys($_GET);
        foreach($get_prms as $prm) {
            switch($prm){
                case 'main_page':
                case 'sort':
                case 'per_page':
                    continue;
                default:
                    if(zen_not_null($_GET[$prm])){
                        $field_hidden .= zen_draw_hidden_field($prm, $_GET[$prm]);
                    }
            }
        }
        
        $search_more_vars['sel_per_page'] 
            = is_numeric($_GET['per_page']) ? $_GET['per_page'] 
                : (is_numeric($_SESSION['addon_search_more_par_page']) ? $_SESSION['addon_search_more_par_page']  : MAX_DISPLAY_PRODUCTS_LISTING);
        $search_more_vars['sel_sort']
            = zen_not_null($_GET['sort']) ? $_GET['sort'] 
                : (zen_not_null($_SESSION['addon_search_more_sort']) ? $_SESSION['addon_search_more_sort'] : '20a');
        $_SESSION['addon_search_more_par_page'] = $search_more_vars['sel_per_page'];
        $_SESSION['addon_search_more_sort']     = $search_more_vars['sel_sort'];
        $search_more_vars['field_hidden'] = $field_hidden;
        return $search_more_vars;
    }

}
?>
