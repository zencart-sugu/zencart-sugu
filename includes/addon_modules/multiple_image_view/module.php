<?php
/**
 * multiple_image_view Module
 *
 * @package Viewed_products
 * @copyright Copyright (C) 2009 Liquid System Technology, Inc.
 * @author Otsuji Takashi <ohtsuji@ark-web.jp>
 * @copyright Portions Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @author Otsuji Takashi <ohtsuji@ark-web.jp>
 * @version $Id: multiple_image_view.php $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}

  class multiple_image_view extends addOnModuleBase {

    var $author                        = "Otsuji Takashi";
    var $author_email                  = "info@zencart-sugu.jp";
    var $version                       = "0.1";
    var $require_zen_cart_version      = "1.3.0.2";
    var $require_addon_modules_version = "0.1";

    var $title = MODULE_MULTIPLE_IMAGE_VIEW_TITLE;
    var $description = MODULE_MULTIPLE_IMAGE_VIEW_DESCRIPTION;
    var $sort_order = MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER;
    var $icon;
    var $status = MODULE_MULTIPLE_IMAGE_VIEW_STATUS;
    var $enabled;
    var $configuration_keys = array(
          array(
            'configuration_title' => MODULE_MULTIPLE_IMAGE_VIEW_STATUS_TITLE,
            'configuration_key' => 'MODULE_MULTIPLE_IMAGE_VIEW_STATUS',
            'configuration_value' => MODULE_MULTIPLE_IMAGE_VIEW_STATUS_DEFAULT,
            'configuration_description' => MODULE_MULTIPLE_IMAGE_VIEW_STATUS_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'zen_cfg_select_option(array(\'true\', \'false\'), '
          ),
          array(
            'configuration_title' => MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER_TITLE,
            'configuration_key' => 'MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER',
            'configuration_value' => MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER_DEFAULT,
            'configuration_description' => MODULE_MULTIPLE_IMAGE_VIEW_SORT_ORDER_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH_TITLE,
            'configuration_key' => 'MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH',
            'configuration_value' => MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH_DEFAULT,
            'configuration_description' => MODULE_MULTIPLE_IMAGE_VIEW_THMB_WIDTH_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          ),
          array(
            'configuration_title' => MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT_TITLE,
            'configuration_key' => 'MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT',
            'configuration_value' => MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT_DEFAULT,
            'configuration_description' => MODULE_MULTIPLE_IMAGE_VIEW_THMB_HEIGHT_DESCRIPTION,
            'use_function' => 'null',
            'set_function' => 'null'
          )
        );
    var $require_modules = array('jquery');
    var $notifier = array();

    // class constructer for php4
    function multiple_image_view() {
      $this->__construct();
    }

    // blocks
    function block() {
        $return = array();
        $pid = $_GET['products_id'];
        if( empty($pid)){
            return $return;
        }

        $products_image = $this->get_products_image($pid);

        // create multi images array
        // set prodduct_image as first image
        $type_org = '0';
        $multi_image_product = $this->create_multi_images($products_image,$type_org);
        if(count($multi_image_product) > 0){
            $multi_images = array($multi_image_product);
        }

        // search additionl images
        $addtnl_images = $this->get_additional_images($products_image);
        if(count($addtnl_images) > 0){
            if(count($multi_images) == 0){
                $multi_images = $addtnl_images;
            }
            else{
                $multi_images = array_merge($multi_images ,$addtnl_images);
            }
        }
        $return['flg_btn']      =$this->isExpandButtonVisible($multi_images);
        $return['multi_images'] =$multi_images;
        return $return;
    }

    function block_expd() {
        $return = array();
        $pid = $_GET['products_id'];
        if( empty($pid)){
            return $return;
        }
        $products_image = $this->get_products_image($pid);

        // create multi images array
        // set prodduct_image as first image
        $type_org = '0';
        $multi_image_product = $this->create_multi_images($products_image,$type_org);
        if(count($multi_image_product) > 0){
            $multi_images = array($multi_image_product);
        }
        
        $return['flg_btn']      =$this->isExpandButtonVisible($multi_images);
        if(!$return['flg_btn']){
            $addtnl_images = $this->get_additional_images($products_image);
            $return['flg_btn'] = $this->isExpandButtonVisible($addtnl_images);
        }
        $return['multi_images'] =$multi_images;
        return $return;
    }

    function block_thmb() {
        return $this->block();
    }

    function get_products_image($pid){
        $db = $GLOBALS['db'];

        // get original image
        $sql    =   "select p.products_image
                    from   " . TABLE_PRODUCTS . " p
                    where   p.products_status = '1'
                    and     p.products_id = :productsID ";

        $sql = $db->bindVars($sql, ':productsID', $pid ,'integer');
        $product_info = $db->Execute($sql);
        $products_image = $product_info->fields['products_image'];

        return $products_image;
    }

    function insert_filename_suffix($filename, $suffix) {
        if(empty($filename)){
            return '';
        }
        $extension = substr($filename, strrpos($filename, '.'));
        return ereg_replace($extension ,$suffix . $extension ,$filename);
    }


    function create_multi_images($products_image,$flg_type){
        $tag_type = 'img_type'; // tag for image type(0:original/1:additional)
        $tag_thmb = 'img_thmb'; // tag for thmb image
        $tag_expd = 'img_expd'; // tag for expand image
        $tag_libx = 'img_libx'; // tag for LightBox image
        $tag_btn  = 'flg_btn';  // tag for LightBox button enable flag
        $pre_expd = 'medium/';  // filename prefix for expand image
        $pre_libx = 'large/';   // filename prefix for LightBox image
        $suf_expd = IMAGE_SUFFIX_MEDIUM;     // filename suffix for expand image
        $suf_libx = IMAGE_SUFFIX_LARGE;     // filename suffix for LightBox image

        $file_thmb = $products_image;
        $file_expd = $pre_expd . $this->insert_filename_suffix($products_image,$suf_expd);
        $file_libx = $pre_libx . $this->insert_filename_suffix($products_image,$suf_libx);

        // when missing thumb image,replace thumb image to no image.
        $flg_btn = true;
        if (!file_exists(DIR_WS_IMAGES . $file_thmb) || is_dir(DIR_WS_IMAGES . $file_thmb)) {
            if(PRODUCTS_IMAGE_NO_IMAGE_STATUS == 1){
                if ( (empty($file_thmb) || ($file_thmb == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false') ) {
                    return array();
                }
                else {
                    $file_thmb = PRODUCTS_IMAGE_NO_IMAGE;
                }
            }
            else{
                return array();
            }
        }
        // when missing expand image,replace expand image to thmb image.
        if (!file_exists(DIR_WS_IMAGES . $file_expd) || is_dir(DIR_WS_IMAGES . $file_expd)) {
            $file_expd = $file_thmb;
        }
        // when missing LightBox image,replace LightBox image to expand image.
        if (!file_exists(DIR_WS_IMAGES . $file_libx) || is_dir(DIR_WS_IMAGES . $file_libx)) {
            $file_libx = $file_expd;
            $flg_btn = false;
        }
        return  array(  $tag_type => $flg_type,
                        $tag_thmb => $file_thmb,
                        $tag_expd => $file_expd,
                        $tag_libx => $file_libx,
                        $tag_btn  => $flg_btn);
    }

    // return additionlimages
    function get_additional_images($products_image){
        // Check for additional matching images
        
        if(empty($products_image)){
            return array();
        }

        // prepare image name
        $products_image_extension = substr($products_image, strrpos($products_image, '.'));
        $products_image_base = ereg_replace($products_image_extension, '', $products_image);

        // if in a subdirectory
        if (strrpos($products_image, '/')) {
            $products_image_match = substr($products_image, strrpos($products_image, '/')+1);
            //echo 'TEST 1: I match ' . $products_image_match . ' - ' . $file . ' -  base ' . $products_image_base . '<br>';
            $products_image_match = ereg_replace($products_image_extension, '', $products_image_match) . '_';
            $products_image_base = $products_image_match;
        }

        $products_image_directory = ereg_replace($products_image, '', substr($products_image, strrpos($products_image, '/')));
        if ($products_image_directory != '') {
            $products_image_directory = DIR_WS_IMAGES . ereg_replace($products_image_directory, '', $products_image) . "/";
        } else {
            $products_image_directory = DIR_WS_IMAGES;
        }

        $file_extension = $products_image_extension;
        $products_image_match_array = array();
        $flg_add = '1';
        if ($dir = @dir($products_image_directory)){
            while ($file = $dir->read()) {
                if (!is_dir($products_image_directory . $file)) {
                    if (substr($file, strrpos($file, '.')) == $file_extension) {
                        if(preg_match("/" . $products_image_base . "/i", $file) == '1') {
                            if ($file != $products_image) {
                                if ($products_image_base . ereg_replace($products_image_base, '', $file) == $file) {
                                    //  echo 'I AM A MATCH ' . $file . '<br>';
                                    $tmp_images = $this->create_multi_images(ereg_replace('^' . DIR_WS_IMAGES ,'' ,$products_image_directory . $file),$flg_add);
                                    if(count($tmp_images) > 0){
                                        $images_array[] = $tmp_images;
                                    }
                                }
                            }
                        }
                    }
                }
            }
            if (sizeof($images_array)) {
                sort($images_array);
            }
            $dir->close();
        }
        return $images_array;
    }
    
    function isExpandButtonVisible($multi_images){
        $rtn = false;
        if(is_array($multi_images)){
            foreach($multi_images as $image){
                if($image['flg_btn']){
                    $rtn = true;
                    break;
                }
            }
        }
        return $rtn;
    }

  }
?>
