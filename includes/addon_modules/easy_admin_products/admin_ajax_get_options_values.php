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

$options_id = $_REQUEST['options_id'];

$model = new easy_admin_products_attribute_model();
$options_values = $model->get_options_values($options_id);
$data = array(
  "result"   => "ok",
  "message"  => "",
  "response" => array(),
);
while (!$options_values->EOF) {
  $data['response'][] = array(
    "id" => $options_values->fields['products_options_values_id'],
    "label" => mb_convert_encoding($options_values->fields['products_options_values_name'],'utf8'),
  );
  $options_values->MoveNext();
}
print $model->toJSON($data);
