<?php
/**
 * addOnModule Base Class
 *
 * @package addon_module_base
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Koji Sasaki
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Koji Sasaki <sasaki@liquidst.jp>
 * @version $Id: class.addOnModuleBase.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class addOnModuleBase extends base {
    var $code, $title, $description, $sort_order, $icon, $status, $enabled, $configuration_keys, $require_modules, $notifier;
    var $dir, $dir_templates, $dir_template, $dir_template_images, $dir_template_icons, $schema;

// class constructor
    function __construct() {
      global $template_dir;
      $this->code = get_class($this);
      $this->enabled = (($this->status  == 'true') ? true : false);

      $this->dir = DIR_WS_ADDON_MODULES . $this->code . '/';
      $this->dir_templates = $this->dir . 'templates/';
      $this->dir_template = $this->dir_templates . $template_dir . '/';
      $this->dir_template_images = $this->dir_template . 'images/';
      $this->dir_template_icons = $this->dir_template_images . 'icons/';
    }

    function addOnModuleBase() {
      $this->__construct();
    }

    function attachEvent() {
      if (!$this->enabled) {
        $this->notifier = array();
      }
      return $this->notifier;
    }

    function notifierUpdate($notifier) {
      return false;
    }

    function check() {
      global $db;
      if (!isset($this->_check)) {
        $check_query = $db->Execute("SELECT configuration_value FROM " . TABLE_CONFIGURATION . " WHERE configuration_key = '" . $this->configuration_keys[0]['configuration_key'] . "'");
        $this->_check = $check_query->RecordCount();
      }
      return $this->_check;
    }

    function keys() {
      $keys = array();
      foreach ($this->configuration_keys as $value) {
        $keys[] = $value['configuration_key'];
      }
      return $keys;
    }

    function install() {
      global $db, $messageStack;


      if ($this->code != 'addon_modules') {
        $installed_modules = zen_addOnModules_get_installed_modules();
        if (!in_array('addon_modules', $installed_modules)) {
          $messageStack->add_session(sprintf(WARNING_NOT_INSTALLED_CORE_MODULE), 'warning');
          $messageStack->add_session(sprintf(ERROE_MODULE_INSTALL_FAILED, $this->code), 'error');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $this->code, 'NONSSL'));
          exit();
        }
      }

      if ($this->_requireModules()) {
        $messageStack->add_session(sprintf(ERROE_MODULE_INSTALL_FAILED, $this->code), 'error');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $this->code, 'NONSSL'));
        exit();
      }

      for ($i = 0, $n = count($this->configuration_keys); $i < $n; $i++) {
        $sql_data_array = array(
          'configuration_title' => $this->configuration_keys[$i]['configuration_title'],
          'configuration_key' => $this->configuration_keys[$i]['configuration_key'],
          'configuration_value' => $this->configuration_keys[$i]['configuration_value'],
          'configuration_description' => $this->configuration_keys[$i]['configuration_description'],
          'configuration_group_id' => '6',
          'sort_order' => $i,
          'use_function' => $this->configuration_keys[$i]['use_function'],
          'set_function' => $this->configuration_keys[$i]['set_function'],
          'date_added' => 'now()'
        );
        zen_db_perform(TABLE_CONFIGURATION, $sql_data_array);
      }

      $this->_createTables();

      $this->_install();
    }

    function _createTables() {
      global $db, $messageStack;

      if (!empty($this->tables)) {
        foreach($this->tables as $table => $fields) {
          $check = $db->Execute("SHOW TABLES LIKE '$table';");
          if (!$check->RecordCount()) {

            $create_fields = array();
            $create_indexes = array();
            foreach ($fields as $field => $params) {
              if ($field == 'INDEXES') {
                $create_indexes = $this->_createIndexes($params);
              } else {
                $create_field = $this->_createField($field, $params);
                if ($create_field != '') {
                  $create_fields[] = $create_field;
                }
              }
            }

            if (count($create_fields) > 0) {
              $create_fields = array_merge($create_fields, $create_indexes);
              $query = "CREATE TABLE IF NOT EXISTS `$table` (" . "\n";
              $query .= implode(",\n", $create_fields) . "\n";
              $query .= ") TYPE=MyISAM;";
              $db->Execute($query);
              $messageStack->add_session(sprintf(SUCCESS_CREATE_TABLE, $table), 'success');
            }

          }
        }
      }


    }

    function _createIndexes($indexes) {
      $create_indexes = array();
      if (count($indexes['PRIMARY']) > 0) {
        $primary_key_fields = "";
        foreach($indexes['PRIMARY'] as $column) {
          if ($primary_key_fields != '') {
            $primary_key_fields .= ",";
          }
          $primary_key_fields .= "`$column`";
        }
        if ($primary_key_fields != '') {
          $create_indexes[] = "PRIMARY KEY  ($primary_key_fields)";
        }
      }

      if (count($indexes['UNIQUE']) > 0) {

        foreach($indexes['UNIQUE'] as $keys) {
          $unique_key_fields = "";
          $unique_key_name = "";
          foreach($keys as $column) {
            if ($unique_key_name != "") {
              $unique_key_name .= "_";
            } else {
              $unique_key_name .= "UNQ_";
            }
            $unique_key_name .= $column;

            if ($unique_key_fields != '') {
              $unique_key_fields .= ",";
            }
            $unique_key_fields .= "`$column`";
          }
          if ($unique_key_fields != '') {
            $create_indexes[] = "UNIQUE KEY `$unique_key_name` ($unique_key_fields)";
          }
        }
      }

      if (count($indexes['INDEX']) > 0) {

        foreach($indexes['INDEX'] as $keys) {
          $index_key_fields = "";
          $index_key_name = "";
          foreach($keys as $column) {
            if ($index_key_name != "") {
              $index_key_name .= "_";
            } else {
              $index_key_name .= "IDX_";
            }
            $index_key_name .= $column;

            if ($index_key_fields != '') {
              $index_key_fields .= ",";
            }
            $index_key_fields .= "`$column`";
          }
          if ($index_key_fields != '') {
            $create_indexes[] = "KEY `$index_key_name` ($index_key_fields)";
          }
        }
      }

      return $create_indexes;
    }

    function _createField($field, $params) {
      $create_field = "";
      $field_param = "";
      switch ($params['type']) {
        case 'integer':
        case 'int':
        case 'tinyint':
          if (empty($params['length'])) {
            $params['length'] = 11;
          }
          if ($params['length'] === 1 || $params['length'] === '1') {
            $field_param .= "TINYINT(1)";
          } else {
            $field_param .= "INT(" . (int)$params['length'] . ")";
          }
          break;

        case 'decimal':
          if (empty($params['length'])) {
            $params['length'] = '10,0';
          }
          $field_param .= "DECIMAL(" . $params['length'] . ")";
          break;

        case 'float':
          if (empty($params['length'])) {
            $field_param .= "FLOAT";
          } else {
            $field_param .= "FLOAT(" . $params['length'] . ")";
          }
          break;

        case 'string':
        case 'str':
        case 'varchar':
          if (empty($params['length']) || $params['length'] > 255) {
            $params['length'] = 255;
          }
          $field_param .= "VARCHAR(" . $params['length'] . ")";
          break;

        case 'text':
          $field_param .= "TEXT";
          break;

        case 'datetime':
          $field_param .= "DATETIME";
          break;

        case 'date':
          $field_param .= "DATE";

        case 'timestamp':
          $field_param .= "TIMESTAMP";
          break;

        case 'time':
          $field_param .= "TIME";
          break;

        case 'blob':
          $field_param .= "BLOB";
          break;

      }

      if ($field_param != '') {
        $create_field .= "`$field` $field_param";

        if ($params['null'] === true) {
          $create_field .= " NULL";
        } else {
          $create_field .= " NOT NULL";
        }

        if ($params['default'] !== false && !is_null($params['default'])) {
          if ($params['null'] === true && $params['default'] == 'NULL') {
            $create_field .= " DEFAULT NULL";
          } elseif ($params['type'] == 'timestamp' && $params['default'] == 'CURRENT_TIMESTAMP') {
            $create_field .= " DEFAULT CURRENT_TIMESTAMP";
          } else {
            $create_field .= " DEFAULT '" . $params['default'] . "'";
          }
        }

        if (($params['type'] == 'integer' ||$params['type'] == 'int' ) && $params['auto_increment'] === true) {
            $create_field .= " AUTO_INCREMENT";
        }
      }

      return $create_field;
    }

    function update() {
      $this->_update();
    }

    function remove() {
      global $db, $messageStack;

      if ($this->_dependModules()) {
        $messageStack->add_session(sprintf(ERROE_MODULE_REMOVE_FAILED, $this->code), 'error');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $this->code, 'NONSSL'));
        exit();
      }

      if ($this->code == 'addon_modules') {
        $installed_modules = zen_addOnModules_get_installed_modules();
        if (($index = array_search('addon_modules', $installed_modules)) !== false) {
          unset($installed_modules[$index]);
        }
        if (count($installed_modules) > 0) {
          $messageStack->add_session(sprintf(WARNING_CANNOT_REMOVE_CORE_MODULE), 'warning');
          $messageStack->add_session(sprintf(ERROE_MODULE_REMOVE_FAILED, $this->code), 'error');
          zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $this->code, 'NONSSL'));
          exit();
        }
      }

      // delete configurations
      $db->Execute("DELETE FROM " . TABLE_CONFIGURATION . " WHERE configuration_key IN ('" . implode("', '", $this->keys()) . "');");

      // delete layout data
      $db->Execute("DELETE FROM " . TABLE_BLOCKS . " WHERE module = '" . $this->code . "';");

      $this->_remove();
    }

    function tableExist() {
      global $db;

      $return = false;
      if (!empty($this->tables)) {
        foreach($this->tables as $table => $fields) {
          $check = $db->Execute("SHOW TABLES LIKE '$table';");
          if ($check->RecordCount()) {
            $return = true;
          }
        }
      }

      return $return;
    }

    function cleanUp() {
      global $messageStack;

      if ($this->check() > 0) {
        $messageStack->add_session(sprintf(ERROE_MODULE_CLEANUP_FAILED, $this->code), 'error');
        zen_redirect(zen_href_link(FILENAME_ADDON_MODULES, 'module=' . $this->code, 'NONSSL'));
        exit();
      }

      $this->_dropTables();
      $this->_cleanUp();
    }

    function _dropTables() {
      global $db, $messageStack;

      if (!empty($this->tables)) {
        foreach($this->tables as $table => $fields) {
          $db->Execute("DROP TABLE `$table`;");
          $messageStack->add_session(sprintf(SUCCESS_DROP_TABLE, $table), 'success');
        }
      }
    }

    function _requireModules() {
      global $messageStack;
      $error = false;
      for ($i = 0, $n = count($this->require_modules); $i < $n; $i++) {
        $module = null;
        $class = $this->require_modules[$i];
        $module_directory = DIR_FS_CATALOG_ADDON_MODULES;
        if (!is_object($GLOBALS[$class])) {
          if(zen_addOnModules_load_module_files($module_directory, $class)) {
            $GLOBALS[$class] = new $class;
          } else {
            $error = true;
            $messageStack->add_session(sprintf(ERROR_REQUIRE_MODULE, $class), 'error');
          }
        }
        if (!$GLOBALS[$class]->enabled && !$error) {
          $error = true;
          $messageStack->add_session(sprintf(WARNING_REQUIRE_MODULE, $class), 'warning');
        }
      }
      return $error;
    }

    function _dependModules() {
      global $messageStack;

      $module_directory = DIR_FS_CATALOG_ADDON_MODULES;
      $module_key = 'ADDON_MODULE_INSTALLED';

      eval('$module_installed = ' . $module_key . ';');

      if (defined($module_key) && zen_not_null($module_installed)) {
        $modules = explode(';', $module_installed);
        reset($modules);

        while (list(, $value) = each($modules)) {
          $module = null;
          $class = $value;
          if (!is_object($GLOBALS[$class])) {
            zen_addOnModules_load_module_files($module_directory, $class);
            $GLOBALS[$class] = new $class;
          }

          $require_modules = $GLOBALS[$class]->require_modules;
          for ($i = 0, $n = count($require_modules); $i < $n; $i++) {
            if ($require_modules[$i] == $this->code) {
              $error = true;
              $messageStack->add_session(sprintf(WARNING_DEPEND_MODULE, $class), 'warning');
            }
          }
        }
      }

      return $error;
    }

    function _install() {
    }

    function _remove() {
    }

    function _cleanup() {
    }

    function getStyle($page) {
      global $cPath;

      $return = false;
      $module = $this->code;

      ob_start();

      /**
       * load all template-specific stylesheets, named like "style*.css", alphabetically
       */
      $directory_array = $this->_getTemplatePart($this->_getTemplateDir('.css', $page,'css'), '/^style/', '.css');
      while(list ($key, $value) = each($directory_array)) {
        echo '<link rel="stylesheet" type="text/css" href="' . $this->_getTemplateDir('.css', $page,'css') . '/' . $value . '" />'."\n";
      }
      /**
       * load stylesheets on a per-page/per-language/per-product/per-manufacturer/per-category basis. Concept by JuxiJoza.
       */
      $manufacturers_id = (isset($_GET['manufacturers_id'])) ? $_GET['manufacturers_id'] : '';
      $tmp_products_id = (isset($_GET['products_id'])) ? (int)$_GET['products_id'] : '';
      $sheets_array = array('/^' . $_SESSION['language'] . '_stylesheet/' ,
                            '/^' . $page.'/',
                            '/^' . $_SESSION['language'] . '_' . $page .'/',
                            '/^c_' . (int)$cPath .'/',
                            '/^' . $_SESSION['language'] . '_c_' . (int)$cPath . '/',
                            '/^m_' . $manufacturers_id.'/',
                            '/^' . $_SESSION['language'] . '_m_' . (int)$manufacturers_id . '/',
                            '/^p_' . $tmp_products_id . '/',
                            '/^' . $_SESSION['language'] . '_p_' . $tmp_products_id . '/'
                            );
        while(list ($key, $value) = each($sheets_array)) {
      //echo "<--$value-->\n";
          $directory_array = $this->_getTemplatePart($this->_getTemplateDir('.css', $page,'css'), $value, '.css');
          sort($directory_array);
          while(list ($key2, $value2) = each($directory_array)) {
            echo '<link rel="stylesheet" type="text/css" href="' . $this->_getTemplateDir('.css', $page,'css') . '/' . $value2 .'" />'."\n";
          }
      }

      /**
       * load printer-friendly stylesheets -- named like "print*.css", alphabetically
       */
      $directory_array = $this->_getTemplatePart($this->_getTemplateDir('.css', $page,'css'), '/^print/', '.css');
      sort($directory_array);
      while(list ($key, $value) = each($directory_array)) {
        if (!preg_match('/^print_page|^print_block/', $value)) {
          echo '<link rel="stylesheet" type="text/css" media="print" href="' . $this->_getTemplateDir('.css', $page,'css') . '/' . $value . '" />'."\n";
        }
      }

      $return = ob_get_contents();
      ob_end_clean();

      return $return;
    }

    function getJScript($page) {
      $return = false;
      $module = $this->code;
      $page_directory = $this->dir . 'pages/' . $page;

      ob_start();

      /**
       * load all site-wide jscript_*.js files from includes/templates/YOURTEMPLATE/jscript, alphabetically
       */
      $directory_array = $this->_getTemplatePart($this->_getTemplateDir('.js', $page,'jscript'), '/^jscript_/', '.js');
      while(list ($key, $value) = each($directory_array)) {
        echo '<script type="text/javascript" src="' .  $this->_getTemplateDir('.js', $page,'jscript') . '/' . $value . '"></script>'."\n";
      }

      /**
       * load all page-specific jscript_*.js files from includes/modules/pages/PAGENAME, alphabetically
       */
      $directory_array = $this->_getTemplatePart($page_directory, '/^jscript_/', '.js');
      while(list ($key, $value) = each($directory_array)) {
        echo '<script type="text/javascript" src="' . $page_directory . '/' . $value . '"></script>' . "\n";
      }

      /**
       * load all site-wide jscript_*.php files from includes/templates/YOURTEMPLATE/jscript, alphabetically
       */
      $directory_array = $this->_getTemplatePart($this->_getTemplateDir('.php', $page,'jscript'), '/^jscript_/', '.php');
      while(list ($key, $value) = each($directory_array)) {
      /**
       * include content from all site-wide jscript_*.php files from includes/templates/YOURTEMPLATE/jscript, alphabetically.
       * These .PHP files can be manipulated by PHP when they're called, and are copied in-full to the browser page
       */
        require($this->_getTemplateDir('.php', $page,'jscript') . '/' . $value); echo "\n";
      }
      /**
       * include content from all page-specific jscript_*.php files from includes/modules/pages/PAGENAME, alphabetically.
       */
      $directory_array = $this->_getTemplatePart($page_directory, '/^jscript_/');
      while(list ($key, $value) = each($directory_array)) {
        /**
         * include content from all page-specific jscript_*.php files from includes/modules/pages/PAGENAME, alphabetically.
         * These .PHP files can be manipulated by PHP when they're called, and are copied in-full to the browser page
         */
        require($page_directory . '/' . $value); echo "\n";
      }

      $return = ob_get_contents();
      ob_end_clean();

      return $return;
    }

    function getPageStyle($page) {
      $return = false;

      if ($page == FILENAME_ADDON) {
        $perse_page_module = zen_addOnModules_persePageModule($_GET['module']);
        $page_class = $perse_page_module['class'];
        $page_method = $perse_page_module['method'];
      }

      if (method_exists($this, $page_method) && $page_class == $this->code) {
        $module = $this->code;

        $css = $this->_getTemplateDir($page_method . '.css', $page, 'css'). '/'. $page_method . '.css';
        $print_css = $this->_getTemplateDir('print_' . $block . '.css', $page, 'css') . '/print_'. $page_method . '.css';
        $css_php = $this->_getTemplateDir($page_method . '.php', $page, 'css') . '/'. $page_method . '.php';

        ob_start();

        if (file_exists($css)) {
          echo '<link rel="stylesheet" type="text/css" href="' . $css .'" />'."\n";
        }
        if (file_exists($print_css)) {
          echo '<link rel="stylesheet" type="text/css" media="print" href="' . $print_css .'" />'."\n";
        }
        if (file_exists($css_php)) {
          require($css_php);
        }

        $return = ob_get_contents();
        ob_end_clean();

      }

      return $return;
    }


    function getBlockStyles($block, $page) {
      $return = false;
      if (method_exists($this, $block)) {
        $module = $this->code;

        $css = $this->_getTemplateDir($block . '.css', $page, 'css'). '/'. $block . '.css';
        $print_css = $this->_getTemplateDir('print_' . $block . '.css', $page, 'css') . '/print_'. $block . '.css';
        $css_php = $this->_getTemplateDir($block . '.php', $page, 'css') . '/'. $block . '.php';

        ob_start();

        if (file_exists($css)) {
          echo '<link rel="stylesheet" type="text/css" href="' . $css .'" />'."\n";
        }
        if (file_exists($print_css)) {
          echo '<link rel="stylesheet" type="text/css" media="print" href="' . $print_css .'" />'."\n";
        }
        if (file_exists($css_php)) {
          require($css_php);
        }

        $return = ob_get_contents();
        ob_end_clean();

      }

      return $return;
    }

    function getPageJScript($page) {
      $return = false;

      if ($page == FILENAME_ADDON) {
        $perse_page_module = zen_addOnModules_persePageModule($_GET['module']);
        $page_class = $perse_page_module['class'];
        $page_method = $perse_page_module['method'];
      }

      if (method_exists($this, $page_method) && $page_class == $this->code) {
        $module = $this->code;

        $js = $this->_getTemplateDir($page_method . '.js', $page, 'jscript'). '/'. $page_method . '.js';
        $js_php = $this->_getTemplateDir($page_method . '.php', $page, 'jscript') . '/'. $page_method . '.php';

        ob_start();

        if (file_exists($js)) {
          echo '<script type="text/javascript" src="' . $js . '"></script>' . "\n";
        }
        if (file_exists($js_php)) {
          require($js_php);
        }

        $return = ob_get_contents();
        ob_end_clean();

      }

      return $return;
    }

    function getBlockJScripts($block, $page) {
      $return = false;
      if (method_exists($this, $block)) {
        $module = $this->code;

        $js = $this->_getTemplateDir($block . '.js', $page, 'jscript'). '/'. $block . '.js';
        $js_php = $this->_getTemplateDir($block . '.php', $page, 'jscript') . '/'. $block . '.php';

        ob_start();

        if (file_exists($js)) {
          echo '<script type="text/javascript" src="' . $js . '"></script>' . "\n";
        }
        if (file_exists($js_php)) {
          require($js_php);
        }

        $return = ob_get_contents();
        ob_end_clean();

      }

      return $return;
    }

    function getBlock($block, $page) {
      global $template;
      $return = false;
      if (method_exists($this, $block)) {
        $module = $this->code;

        $block_contents = $this->{$block}();
        if ($block_contents) {
          extract($block_contents);
          $block_module = $this;

          ob_start();
          require($this->_getTemplateDir($block . '.php', $page, 'templates'). '/'. $block . '.php');
          $content = ob_get_contents();
          ob_end_clean();

          if ($content != '') {
            ob_start();
            require($template->get_template_dir('tpl_block.php',DIR_WS_TEMPLATE, $page, 'common'). '/tpl_block.php');
            $return = ob_get_contents();
            ob_end_clean();
          }
        }
      }

      return $return;
    }

    function requirePageLanguages($template_dir, $page) {
      if (method_exists($this, $page)) {
        $module = $this->code;
        $language_page_directory = $this->dir . 'languages/' . $_SESSION['language'] . '/';

        // determine language or template language file
        if (file_exists($language_page_directory . $template_dir . '/' . $page . '.php')) {
          $template_dir_select = $template_dir . '/';
        } else {
          $template_dir_select = '';
        }

        // set language or template language file
        $directory_array = $this->_getTemplatePart($language_page_directory . $template_dir_select, '/^'.$page . '/');
        while(list ($key, $value) = each($directory_array)) {
          require($language_page_directory . $template_dir_select . $value);
        }

        // load master language file(s) if lang files loaded previously were "overrides" and not masters.
        if ($template_dir_select != '') {
          $directory_array = $this->_getTemplatePart($language_page_directory, '/^'.$page . '/');
          while(list ($key, $value) = each($directory_array)) {
            require($language_page_directory . $value);
          }
        }
      }
    }

    function getPageHeader($page) {
      $return = array();

      if (method_exists($this, $page)) {
        $return = $this->{$page}();
      }

      return $return;
    }

    function definePageMetaTags($page) {
      $method = '_' . $page . '_metatags';

      // mata tags define
      if (method_exists($this, $method)) {
        extract($this->{$method}());

        if (strlen(SITE_TAGLINE) > 1) {
          define('TAGLINE', TERTIARY_SECTION . SITE_TAGLINE);
        } else {
          define('TAGLINE', '');
        }

        if (zen_not_null($title)) {
          define('META_TAG_TITLE', $title . PRIMARY_SECTION . TITLE . TAGLINE);
        }
        if (zen_not_null($description)) {
          define('META_TAG_DESCRIPTION', $description . PRIMARY_SECTION . TITLE . TAGLINE);
        }
        if (zen_not_null($keywords)) {
          define('META_TAG_KEYWORDS', $keywords . ',' . (defined('NAVBAR_TITLE') ? NAVBAR_TITLE : ''));
        }
      }
    }

    function addPageBreadcrumb($page) {
      global $breadcrumb;

      $method = '_' . $page . '_breadcrumb';

      if (method_exists($this, $method)) {
        $titles = $this->{$method}();
        for ($i = 0, $n = count($titles); $i < $n; $i++) {
          $breadcrumb->add($titles[$i]['title'], $titles[$i]['link']);
        }
      }
    }

    function getTemplateVars($page) {
      $return = array();

      $method = '_' . $page . '_template_vars';
      if (method_exists($this, $method)) {
        $return = $this->{$method}();
      }

      return $return;
    }

    function getPageTemplate($page) {
      $return = false;
      if (method_exists($this, $page)) {
        $module = $this->code;
        $return = $this->_getTemplateDir($page . '.php', $page, 'templates'). '/'. $page . '.php';
      }

      return $return;
    }

    function getModuleTemplate($page, $module_method) {
      $return = false;
      if (method_exists($this, $module_method)) {
        $module = $this->code;
        $return = $this->_getTemplateDir($module_method . '.php', $page, 'templates'). '/'. $module_method . '.php';
      }

      return $return;
    }

    // Template functions
    function _getTemplatePart($page_directory, $template_part, $file_extension = '.php') {
      $directory_array = array();
      if ($dir = @dir($page_directory)) {
        while ($file = $dir->read()) {
          if (!is_dir($page_directory . $file)) {
            if (substr($file, strrpos($file, '.')) == $file_extension && preg_match($template_part, $file)) {
              $directory_array[] = $file;
            }
          }
        }

        sort($directory_array);
        $dir->close();
      }
      return $directory_array;
    }

    function _getTemplateDir($code, $page, $template_dir, $debug=false) {
      if ($this->_fileExists($this->dir_template . $page, $code)) {
        return $this->dir_template . $page . '/';
      } elseif ($this->_fileExists($this->dir_templates . 'template_default/' . $page, ereg_replace('/', '', $code), $debug)) {
        return $this->dir_templates . 'template_default/' . $page;
      } elseif ($this->_fileExists($this->dir_template . $template_dir, ereg_replace('/', '', $code), $debug)) {
        return $this->dir_template . $template_dir;
      } else {
        return $this->dir_templates . 'template_default/' . $template_dir;
      }
    }

    function _fileExists($file_dir, $file_pattern, $debug=false) {
      $file_found = false;
      if ($mydir = @dir($file_dir)) {
        while ($file = $mydir->read()) {
          if ( strstr($file, $file_pattern) ) {
            $file_found = true;
            break;
          }
        }
      }
      return $file_found;
    }

    function imageOLD($src, $alt = '', $width = '', $height = '', $parameters = '') {
      global $template_dir;

      //auto replace with defined missing image
      if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
        $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
      }

      if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
        return false;
      }

      // if not in current template switch to template_default
      if (!file_exists($src)) {
        $src = str_replace($this->dir_templates . $template_dir, $this->dir_templates . 'template_default', $src);
      }

      // alt is added to the img tag even if it is null to prevent browsers from outputting
      // the image filename as default
      $image = '<img src="' . zen_output_string($src) . '" alt="' . zen_output_string($alt) . '"';

      if (zen_not_null($alt)) {
        $image .= ' title=" ' . zen_output_string($alt) . ' "';
      }

      if ( (CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height)) ) {
        if ($image_size = @getimagesize($src)) {
          if (empty($width) && zen_not_null($height)) {
            $ratio = $height / $image_size[1];
            $width = $image_size[0] * $ratio;
          } elseif (zen_not_null($width) && empty($height)) {
            $ratio = $width / $image_size[0];
            $height = $image_size[1] * $ratio;
          } elseif (empty($width) && empty($height)) {
            $width = $image_size[0];
            $height = $image_size[1];
          }
        } elseif (IMAGE_REQUIRED == 'false') {
          return false;
        }
      }

      if (zen_not_null($width) && zen_not_null($height)) {
        $image .= ' width="' . zen_output_string($width) . '" height="' . zen_output_string($height) . '"';
      }

      if (zen_not_null($parameters)) $image .= ' ' . $parameters;

      $image .= ' />';

      return $image;
    }

    function image($src, $alt = '', $width = '', $height = '', $parameters = '') {
      global $template_dir;

      // soft clean the alt tag
      $alt = zen_clean_html($alt);

      // use old method on template images
      if (strstr($src, 'includes/templates') or strstr($src, 'includes/languages') or PROPORTIONAL_IMAGES_STATUS == '0') {
        return $this->imageOLD($src, $alt, $width, $height, $parameters);
      }

      //auto replace with defined missing image
      if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
        $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
      }

      if ( (empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
        return false;
      }

      // if not in current template switch to template_default
      if (!file_exists($src)) {
        $src = str_replace($this->dir_templates . $template_dir, $this->dir_templates . 'template_default', $src);
      }

      // alt is added to the img tag even if it is null to prevent browsers from outputting
      // the image filename as default
      $image = '<img src="' . zen_output_string($src) . '" alt="' . zen_output_string($alt) . '"';

      if (zen_not_null($alt)) {
        $image .= ' title=" ' . zen_output_string($alt) . ' "';
      }

      if ( ((CONFIG_CALCULATE_IMAGE_SIZE == 'true') && (empty($width) || empty($height))) ) {
        if ($image_size = @getimagesize($src)) {
          if (empty($width) && zen_not_null($height)) {
            $ratio = $height / $image_size[1];
            $width = $image_size[0] * $ratio;
          } elseif (zen_not_null($width) && empty($height)) {
            $ratio = $width / $image_size[0];
            $height = $image_size[1] * $ratio;
          } elseif (empty($width) && empty($height)) {
            $width = $image_size[0];
            $height = $image_size[1];
          }
        } elseif (IMAGE_REQUIRED == 'false') {
          return false;
        }
      }

      if (zen_not_null($width) && zen_not_null($height) and file_exists($src)) {
        // $image .= ' width="' . zen_output_string($width) . '" height="' . zen_output_string($height) . '"';
        // proportional images
        $image_size = @getimagesize($src);
        // fix division by zero error
        $ratio = ($image_size[0] != 0 ? $width / $image_size[0] : 1);
        if ($image_size[1]*$ratio > $height) {
          $ratio = $height / $image_size[1];
          $width = $image_size[0] * $ratio;
        } else {
          $height = $image_size[1] * $ratio;
        }
        // only use proportional image when image is larger than proportional size
        if ($image_size[0] < $width and $image_size[1] < $height) {
          $image .= ' width="' . $image_size[0] . '" height="' . $image_size[1] . '"';
        } else {
          $image .= ' width="' . $width . '" height="' . $height . '"';
        }
      } else {
        // override on missing image to allow for proportional and required/not required
        if (IMAGE_REQUIRED == 'false') {
          return false;
        } else {
          $image .= ' width="' . SMALL_IMAGE_WIDTH . '" height="' . SMALL_IMAGE_HEIGHT . '"';
        }
      }

      if (zen_not_null($parameters)) $image .= ' ' . $parameters;

      $image .= ' />';

      return $image;
    }

    function imageSubmit($image, $alt = '', $parameters = '', $sec_class = '') {
      global $current_page_base;

      if (strtolower(IMAGE_USE_CSS_BUTTONS) == 'yes' && strlen($alt)<30) return zenCssButton($image, $alt, 'submit', $sec_class /*, $parameters = ''*/ );

      $image_submit = '<input type="image" src="' . zen_output_string($this->_getTemplateDir($image, $current_page_base, 'buttons/' . $_SESSION['language'] . '/') . $image) . '" alt="' . zen_output_string($alt) . '"';

      if (zen_not_null($alt)) $image_submit .= ' title=" ' . zen_output_string($alt) . ' "';

      if (zen_not_null($parameters)) $image_submit .= ' ' . $parameters;

      $image_submit .= ' />';

      return $image_submit;
    }

    function imageButton($image, $alt = '', $parameters = '', $sec_class = '') {
      global $current_page_base;

      if (strtolower(IMAGE_USE_CSS_BUTTONS) == 'yes') return zenCssButton($image, $alt, 'button', $sec_class, $parameters = '');
      return $this->image($this->_getTemplateDir($image, $current_page_base, 'buttons/' . $_SESSION['language'] . '/') . $image, $alt, '', '', $parameters);
    }
  }
