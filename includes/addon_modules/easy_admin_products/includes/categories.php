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

// categories¾ðÊó
$categories_column = array(
  'categories_id'                          => 0,
  'categories_image'                       => '',
  'parent_id'                              => 0,
  'sort_order'                             => 0,
  'date_added'                             => '',
  'last_modified'                          => '',
  'categories_status'                      => 0,
);

$categories_description_column = array(
  'language_id'                            => 0,
  'categories_name'                        => '',
  'categories_description'                 => '',
);

$meta_tags_categories_description_column = array(
  'language_id'                            => 0,
  'metatags_title'                         => '',
  'metatags_keywords'                      => '',
  'metatags_description'                   => '',
);
?>
