<?php
/**
 * @package addon_modules
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 */

if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class mt_pages extends addOnModuleBase {
    var $version = "0.0.1";
    var $author = array("Yuki SHIDA",
                        "saito");
    var $author_email = "info@zencart-sugu.jp";
    var $require_zen_cart_version = "1.3.0.2";
    var $require_addon_modules_version = "0.1.1";
    var $title = MODULE_MT_PAGES_TITLE;
    var $description = MODULE_MT_PAGES_DESCRIPTION;
    var $sort_order = MODULE_MT_PAGES_SORT_ORDER;
    var $icon;
    var $status = MODULE_MT_PAGES_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_MT_PAGES_STATUS_TITLE,
            'configuration_key' => 'MODULE_MT_PAGES_STATUS',
            'configuration_value' => MODULE_MT_PAGES_STATUS_DEFAULT,
            'configuration_description' => MODULE_MT_PAGES_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_MT_PAGES_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_MT_PAGES_SORT_ORDER',
            'configuration_value' => MODULE_MT_PAGES_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_MT_PAGES_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );
    var $require_modules = array();
    var $notifier = array();

    // class constructer for php4
    function mt_pages() {
      $this->__construct();
    }

    function notifierUpdate($notifier) {
    }

    function _install() {
    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    function block() {
        global $zco_notifier;
        global $mt_pages_contents;

        if (isset($_GET['main_page']) && preg_match('/^([a-zA-Z0-9_-]*)$/', $_GET['main_page'], $matches)) {
            $page_file = $matches[1];
            if ($page_file == 'index' && 
                isset($_GET['cPath']) && 
                preg_match('/^([a-zA-Z0-9_-]*)$/', $_GET['cPath'], $matches)) {
                    $page_file = $page_file . '-' . $matches[1];
            }
            if(is_readable(MODULE_MT_PAGES_DIR_PAGES.$page_file.'-'.$_SESSION['languages_code'].'.php')) {
                $page_file = MODULE_MT_PAGES_DIR_PAGES.$page_file.'-'.$_SESSION['languages_code'].'.php';
            } else {
                $page_file = MODULE_MT_PAGES_DIR_PAGES.$page_file.'.php';
            }
            if (is_readable($page_file)) {
                require_once($page_file);
                $mt_pages_contents = 
                    htmlspecialchars_decode(
                        mb_convert_encoding(MT_PAGES_CONTENTS, mb_internal_encoding(), MT_PAGES_MT_CHARSET));
                $zco_notifier->notify('NOTIFY_MT_PAGES_BEFORE_RETURN_BLOCK');
                return array('mt_pages_contents' => $mt_pages_contents);
            }
            else {
                return array();
            }
        }
        return array();
    }

    function page() {
        global $zco_notifier;
        global $mt_pages_title;
        global $mt_pages_contents;

        if (isset($_GET['page']) && preg_match('/^([a-zA-Z0-9_-]*)$/', $_GET['page'])) {
            $page_file;
            if(is_readable(MODULE_MT_PAGES_DIR_PAGES.$_GET['page'].'-'.$_SESSION['languages_code'].'.php')) {
                $page_file = MODULE_MT_PAGES_DIR_PAGES.$_GET['page'].'-'.$_SESSION['languages_code'].'.php';
            } elseif(is_readable(MODULE_MT_PAGES_DIR_PAGES.$_GET['page'].'.php')) {
                $page_file = MODULE_MT_PAGES_DIR_PAGES.$_GET['page'].'.php';
            } else {
                zen_redirect(zen_href_link(FILENAME_PAGE_NOT_FOUND));
            }
            require_once($page_file);
            $mt_pages_title =
                htmlspecialchars_decode(
                    mb_convert_encoding(MT_PAGES_TITLE,
                                        mb_internal_encoding(),
                                        MT_PAGES_MT_CHARSET));
            $mt_pages_contents =
                htmlspecialchars_decode(
                    mb_convert_encoding(MT_PAGES_CONTENTS,
                                        mb_internal_encoding(),
                                        MT_PAGES_MT_CHARSET));
            $zco_notifier->notify('NOTIFY_MT_PAGES_BEFORE_RETURN_PAGE');
            $return = array('mt_pages_basename' => MT_PAGES_BASENAME,
                            'mt_pages_title'    => $mt_pages_title,
                            'mt_pages_contents' => $mt_pages_contents,
                            );

            return $return;
        }
    }
    
    function _page_metatags() {
        $return = array();
        $return['title'] = mb_convert_encoding(MT_PAGES_TITLE, mb_internal_encoding(), MT_PAGES_MT_CHARSET);
        $return['description'] = mb_convert_encoding(MT_PAGES_DESCRIPTION, mb_internal_encoding(), MT_PAGES_MT_CHARSET);
        $return['keywords'] = mb_convert_encoding(MT_PAGES_KEYWORD, mb_internal_encoding(), MT_PAGES_MT_CHARSET);
        return $return;
    }
    
    function _page_breadcrumb() {
        $return = array();
        $return[] = array('title' => mb_convert_encoding(MT_PAGES_TITLE, mb_internal_encoding(), MT_PAGES_MT_CHARSET), 'link' => null);
        return $return;
    }
  }
