<?php
//
// +----------------------------------------------------------------------+
// |zen-cart Open Source E-commerce                                       |
// +----------------------------------------------------------------------+
// | Copyright (c) 2003 The zen-cart developers                           |
// |                                                                      |
// | http://www.zen-cart.com/index.php                                    |
// |                                                                      |
// | Portions Copyright (c) 2003 osCommerce                               |
// +----------------------------------------------------------------------+
// | This source file is subject to version 2.0 of the GPL license,       |
// | that is bundled with this package in the file LICENSE, and is        |
// | available through the world-wide-web at the following url:           |
// | http://www.zen-cart.com/license/2_0.txt.                             |
// | If you did not receive a copy of the zen-cart license and are unable |
// | to obtain it through the world-wide-web, please send a note to       |
// | license@zen-cart.com so we can mail you a copy immediately.          |
// +----------------------------------------------------------------------+
//  $Id: data_export.php 1969 2007-11-21 06:57:21Z sasaki $
//
define('DIR_SAVE_EXPORT_DATA', DIR_FS_BACKUP);
class dataExport {
  var $file_prefix = 'data-export-';
  var $file_date_format = 'Y-m-d-His';
  var $file_extension = 'txt';
  var $file_name = '';
  var $file_encode = 'SJIS';
  var $fileds_terminated = ',';
  var $fileds_enclosed = '"';
  var $fileds_escaped = '\\';
  var $lines_terminated = "\n";
  var $view_header = 0;
  var $save_dir = DIR_SAVE_EXPORT_DATA;
  var $save_file = false;

  var $fields;

  var $query = '';
  var $select = '';
  var $from = '';
  var $where = '';
  var $order_by = '';

  var $header = '';
  var $body = '';
  var $contents = '';

  function dataExport($export_config){
    $params = $export_config['params'];
    $fields = $export_config['fields'];
    $tables = $export_config['tables'];
    $conditions = $export_config['conditions'];
    $order_by = $export_config['order_by'];
    if (isset($params['file_prefix'])) $this->file_prefix = $params['file_prefix'];
    if (isset($params['file_date_format'])) $this->file_date_format = $params['file_date_format'];
    if (isset($params['file_extension'])) $this->file_extension = $params['file_extension'];
    if (isset($params['file_encode'])) $this->file_encode = $params['file_encode'];
    if (isset($params['fileds_terminated'])) $this->fileds_terminated = $params['fileds_terminated'];
    if (isset($params['fileds_enclosed'])) $this->fileds_enclosed = $params['fileds_enclosed'];
    if (isset($params['fileds_escaped'])) $this->fileds_escaped = $params['fileds_escaped'];
    if (isset($params['lines_terminated'])) $this->lines_terminated = $params['lines_terminated'];
    if (isset($params['view_header'])) $this->view_header = $params['view_header'];
    if (isset($params['save_dir'])) $this->save_dir = $params['save_dir'];
    if (isset($params['save_file'])) $this->save_file = $params['save_file'];
    if (count($fields) > 0) {
      $this->fields = $fields;
      $this->_parseFields($fields);
    }
    $this->_parseTables($tables);
    $this->_parseConditions($conditions);
    $this->_parseOrderBy($order_by);

  }

  function getFile() {
    $this->excute();

    if (strlen($this->body) > 0) {
      if ($this->save_file) {
        $fp = fopen($this->save_dir. $this->generateFileName(), "w");
        fwrite($fp, $this->convartEncodingContents());
        fclose($fp);
        return $this->save_dir. $this->generateFileName();

      } else {
        header('Content-type: plain');
        header('Content-disposition: attachment; filename=' . $this->generateFileName());
        if ($request_type== 'NONSSL'){
           header("Pragma: no-cache");

        } else {
           header("Pragma: ");

        }

        header("Expires: 0");
        echo $this->convartEncodingContents();
        return $this->generateFileName();

      }
    } else {
      return false;
    }
  }

  function excute() {
    global $db;

    $this->query = $this->select . "\n" . $this->from . "\n" . $this->where . "\n" . $this->order_by . "\n";
    $result = $db->Execute($this->query);
    $this->body = '';
    while (!$result->EOF) {
      $line = '';
      $i = 0;
      foreach ($result->fields as $key => $values) {
        if (isset($this->fields[$i]['convert']) && function_exists($this->fields[$i]['convert'])) {
          $values = $this->fields[$i]['convert']($values);
        }
        if (!is_array($values)) {
          $values = array($values);
        }

        foreach ($values as $value) {
          if ($i > 0) {
            $line .= $this->fileds_terminated;
          }
          $line .= $this->escapeFiled($value);
          $i++;
        }
      }
      $line = $this->removeCRLF($line);
      $line = $line . $this->lines_terminated;
      $this->body .= $line;
      $result->MoveNext();
    }

    $this->contents = '';
    if ($this->view_header) {
      $this->contents .= $this->header;
    }
    $this->contents .= $this->body;

    return $this->contents;

  }

  function generateFileName() {
    $this->file_name = $this->file_prefix . date($this->file_date_format) . '.' . $this->file_extension;
    return $this->file_name;

  }

  function convartEncodingContents() {
    $this->contents = mb_convert_encoding($this->contents, $this->file_encode, mb_internal_encoding());
    return $this->contents;

  }

  function _parseFields($fields) {
    $this->header = '';
    $this->select = 'select distinct ';

    foreach ($fields as $key => $value) {
      $this->header .= $this->escapeFiled($value['header']) . $this->fileds_terminated;
      if ($value['table'] != '') {
        $this->select .= ' ' . $value['table'] . '.' . $value['field'] . ',';
      } else {
        $this->select .= ' ' . $value['field'] . ',';
      }
    }
    $this->header = trim($this->header, $this->fileds_terminated) . $this->lines_terminated;
    $this->select = trim($this->select, ',');
  }

  function _parseTables($tables) {
    $this->from = '';
    $this->where = '';

    foreach ($tables as $key => $value) {
      if ($value['join_type'] == false && $value['join_conditions'] == false ) {
        $this->from =  ' from ' . $value['table'];
        $this->where = '';
      } else {
        if ($value['join_type'] == 'left') {
          $this->from .=  ' left join ' . $value['table'] . ' on ' . $value['join_conditions'];

        } elseif ($value['join_type'] == 'inner') {
          $this->from .=  ' , ' . $value['table'];
          if (strlen($value['join_conditions']) > 1) {
            if (strlen($this->where) > 1) {
               $this->where .= ' and ' .  $value['join_conditions'];

            } else {
               $this->where .= ' where ' .  $value['join_conditions'];

            }
          }
        }
      }
    }
  }

  function _parseConditions($conditions = array()) {
    for ($i = 0; $i < count($conditions); $i++) {
      if (strlen($conditions[$i]) > 0) {
        if (strlen($this->where) > 1) {
           $this->where .= ' and ' .  $conditions[$i];

        } else {
           $this->where .= ' where ' .  $conditions[$i];

        }
      }
    }
  }

  function _parseOrderBy($order_by = array()) {
    for ($i = 0; $i < count($order_by); $i++) {
      if (strlen($order_by[$i]) > 0) {
        if (strlen($this->order_by) > 1) {
           $this->order_by .= ' , ' .  $order_by[$i];

        } else {
           $this->order_by .= ' order by ' .  $order_by[$i];

        }
      }
    }
  }

  function escapeFiled($string) {
    $enclose = false;
    $escape = false;
    if (strstr($string, $this->fileds_terminated)) {
      $enclose = true;
    }

    if ($enclose && strstr($string, $this->fileds_enclosed)) {
      $escape = true;
    }

    if ($escape) {
      $string = str_replace($this->fileds_enclosed, $this->fileds_escaped . $this->fileds_enclosed, $string);
    }

    if ($enclose) {
      $string = $this->fileds_enclosed . $string . $this->fileds_enclosed;
    }

    return $string;
  }

  function removeCRLF($string) {
    $string = str_replace("\n", "", $string);
    $string = str_replace("\r\n", "", $string);
    $string = str_replace("\r", "", $string);
    return $string;
  }
}
?>
