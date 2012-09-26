<?php
/**
 * addon_modules Core Module
 *
 * @package addon_modules
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: module.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  /**
   *
   * @author Koji Sasaki
   *
   */
  class addon_modules extends addOnModuleBase {
    var $author = array('Yuki Shida',
                        'kohata',
                        'Koji Sasaki');
    var $author_email = 'info@zencart-sugu.jp';
    var $require_zen_cart_version = '1.3.0.2';
    var $require_addon_modules_version = '1.0.0';

    /**
     * Display modules title on admin.
     * @var string
     */
    var $title = MODULE_ADDON_MODULES_TITLE;

    /**
     * Display modules descriptionl on admin.
     * @var string
     */
    var $description = MODULE_ADDON_MODULES_DESCRIPTION;

    /**
     * Module version for addon module download manager.
     * @var string
     */
    var $version = "1.0.0";

    /**
     *
     * @var integer
     */
    var $sort_order = MODULE_ADDON_MODULES_SORT_ORDER;
    var $icon;
    var $status = MODULE_ADDON_MODULES_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_ADDON_MODULES_STATUS_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_STATUS',
            'configuration_value' => MODULE_ADDON_MODULES_STATUS_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\'), '
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_DISTRIBUTION_URL_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_DISTRIBUTION_URL',
            'configuration_value' => MODULE_ADDON_MODULES_DISTRIBUTION_URL_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_DISTRIBUTION_URL_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_textarea_small('
          ),
          array(
            'configuration_title' => MODULE_ADDON_MODULES_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_ADDON_MODULES_SORT_ORDER',
            'configuration_value' => MODULE_ADDON_MODULES_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_ADDON_MODULES_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
        );

    var $require_modules = array();

    var $notifier = array('NOTIFY_HEADER_ADDONMODULES_PRINT_LAYOUT_MAIN');

    var $tables = array(
      TABLE_BLOCKS => array(
        'id' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11, 'auto_increment' => true),
        'module' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'block' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'template' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'status' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
        'location' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 64),
        'sort_order' => array('type' => 'integer', 'null' => false, 'default' => NULL, 'length' => 11),
        'visible' => array('type' => 'integer', 'null' => false, 'default' => '0', 'length' => 1),
        'pages' => array('type' => 'text', 'null' => false),
        'css_selector' => array('type' => 'string', 'null' => false, 'default' => '', 'length' => 128),
        'insert_position' => array('type' => 'string', 'null' => false, 'default' => 'append', 'length' => 64),
        'INDEXES' => array(
          'PRIMARY' => array('id'),
          'UNIQUE' => array(
            array('module', 'block', 'template'),
            ),
          'INDEX' => array(
            array('module', 'template', 'status', 'location', 'sort_order'),
            ),
          ),
        ),
      );

    // class constructer for php4
    function addon_modules() {
      $this->__construct();
      if (IS_ADMIN_FLAG == 0) {
        require_once($this->dir . 'phpQuery/phpQuery.php');
      }
    }

    function notifierUpdate($notifier) {
      if ($notifier == 'NOTIFY_HEADER_ADDONMODULES_PRINT_LAYOUT_MAIN')
        $this->notify_header_addonmodules_print_layout_main();
    }

    function _install() {

    }

    function _update() {
    }

    function _remove() {
    }

    function _cleanUp() {
    }

    function replace_key($k) {
      return '<label id="phpQuery_'.$k.'"></label>';
    }

    function notify_header_addonmodules_print_layout_main() {
      global $main;
      global $addonmodules_print_layout_main_content;

      $addonmodules_print_layout_main_content = str_replace(CHARSET, "UTF-8", $addonmodules_print_layout_main_content);
      $addonmodules_print_layout_main_content = mb_convert_encoding($addonmodules_print_layout_main_content, "UTF-8", mb_internal_encoding());

      // DOMDocument‚ªjavascript‚ğ‚¤‚Ü‚­ˆ—‚Å‚«‚È‚¢‚Ì‚Å
      // “K“–‚É’u‚«Š·‚¦‚Ä‚İ‚é
      preg_match_all("/(<script.*?>.*?<\/script>)/is", $addonmodules_print_layout_main_content, $match);
      foreach($match[1] as $k => $v) {
        $addonmodules_print_layout_main_content = str_replace($v, self::replace_key($k), $addonmodules_print_layout_main_content);
      }
      $addonmodules_print_layout_main_content = str_replace("&nbsp;", "%NBSP%", $addonmodules_print_layout_main_content);

      $doc = phpQuery::newDocumentHTML($addonmodules_print_layout_main_content, "UTF-8");
      phpQuery::selectDocument($doc);

      if (is_array($main)) {
        foreach($main as $v) {
          $css_selector    = $v['css_selector'];
          $insert_position = $v['insert_position'];
          $contents        = $v['contents'];
          if ($css_selector != "") {
            if ($insert_position == "append")
              pq($css_selector)->append($contents);
            else if ($insert_position == "prepend")
              pq($css_selector)->prepend($contents);
            else if ($insert_position == "after")
              pq($css_selector)->after($contents);
            else if ($insert_position == "before")
              pq($css_selector)->before($contents);
            else if ($insert_position == "replaceWith")
              pq($css_selector)->replaceWith($contents);
          }
        }
      }

      $out = $doc->getDocument()->getDOMDocument()->saveHTML();

      // ’u‚«Š·‚¦‚½‚Ì‚ğ–ß‚·
      foreach($match[1] as $k => $v) {
        $out = str_replace(self::replace_key($k), $v, $out);
      }
      $out = str_replace("%NBSP%", "&nbsp;", $out);

      $out = str_replace("UTF-8", CHARSET, $out);
      $out = mb_convert_encoding($out, mb_internal_encoding(), "UTF-8");
      $addonmodules_print_layout_main_content = $out;
    }
  }
