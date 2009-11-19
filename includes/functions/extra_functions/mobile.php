<?php
/**
 * $Id: mobile.php,v 1.7 2006/03/26 02:04:00 shida Exp $
 *
 * Zen Cart mobile module 0.9
 *  Copyright (C) 2006 by Zen Cart.JP
 *  http://zen-cart.jp
 *
 * Note: Original work copyright to 2006 ARK-Web co., ltd.
 *   http://www.ark-web.jp
 *
 * Zen Cart mobile module is free software; you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation; either version 2 of the License, or
 * (at your option) any later version.
 *
 * Zen Cart mobile module is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Shigeo; if not, write to the Free Software
 * Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307  USA
 */


    // find image for mobile
    // create mobile image if not exists or original image was updated.
    function mobile_find_image($org_src, $width){

      $mobile_src = mobile_get_image_path($org_src, $width);

      if( $mobile_src === false ){
        return false;
      }

      $mobile_src_fullpath = DIR_FS_CATALOG . $mobile_src;
      $org_src_fullpath = DIR_FS_CATALOG . $org_src;

      if( (!file_exists($mobile_src_fullpath)) || (filemtime($org_src_fullpath) > filemtime($mobile_src_fullpath)) ){
        mobile_create_resized_image($org_src_fullpath, $mobile_src_fullpath, $width);
      }
      return $mobile_src;
    }


    // create mobile image
    function mobile_create_resized_image($org_src, $new_src, $width, $mode = 0777){

      if( !file_exists($org_src) || !is_file($org_src) ){
        return false;
      }

      $pathinfo = pathinfo($new_src);
      if( ! file_exists($pathinfo['dirname']) ){
        if( ! recursive_mkdir($pathinfo['dirname'], $mode) ){
          return false;
        }
      }

      // get original image size, and calc new size
      list($org_width, $org_height) = getimagesize($org_src);
      $new_width = min($width, $org_width);
      $new_height = ceil($org_height * ($new_width / $org_width));

      // load orignal image
      $handle_org_img = mobile_load_image($org_src);
      if( !$handle_org_img ){
        return false;
      }

      // make new canvas for new image
      if( function_exists("imagecreatetruecolor") ){
        $handle_new_img = imagecreatetruecolor($new_width, $new_height);
      }else{
        $handle_new_img = imagecreate($new_width, $new_height);
      }
      if( !$handle_new_img ){
        return false;
      }

      // resize
      if( function_exists("imagecopyresampled") ){
        $result = imagecopyresampled($handle_new_img, $handle_org_img, 0, 0, 0, 0, $new_width, $new_height, $org_width, $org_height);
      }else{
        $result = imagecopyresized($handle_new_img, $handle_org_img, 0, 0, 0, 0, $new_width, $new_height, $org_width, $org_height);
      }
      if( !$result ){
        return false;
      }

      // save image file
      if( !mobile_save_image($handle_new_img, $new_src) ){
        return false;
      }
      chmod($new_src, $mode);

      // clear memory
      imagedestroy($handle_org_img);
      imagedestroy($handle_new_img);

      return true;
    }


    // generate mobile image path from normal image path
    function mobile_get_image_path($src, $width){

      if( preg_match('#^' . DIR_FS_CATALOG . DIR_WS_IMAGES . '(.*)$#', $src, $matches) ){
        $path = DIR_FS_CATALOG . DIR_WS_MOBILE_IMAGES . $width . 'px/' . $matches[1];
      }elseif( preg_match('#^' . DIR_WS_IMAGES . '(.*)$#', $src, $matches) ){
        $path = DIR_WS_MOBILE_IMAGES . $width . 'px/' . $matches[1];
      }else{
        return false;
      }

      $pathinfo = pathinfo($path);
      $dir = $pathinfo['dirname'];
      // first, remove extension. and then add MOBILE_IMAGES_EXTENSION.
      $basename = basename($pathinfo['basename'], '.' . $pathinfo['extension']) . MOBILE_IMAGES_EXTENSION;

      return $dir . '/' . $basename;
    }

    
    // load image
    function mobile_load_image($src){

      list($w, $h, $type) = getimagesize($src);

      $image = false;
      switch( $type ){
        case IMAGETYPE_GIF:
          if( function_exists("imagecreatefromgif") ){
            $image = imagecreatefromgif($src);
          }
          break;
        case IMAGETYPE_JPEG:
          if( function_exists("imagecreatefromjpeg") ){
            $image = imagecreatefromjpeg($src);
          }
          break;
        case IMAGETYPE_PNG:
          if( function_exists("imagecreatefrompng") ){
            $image = imagecreatefrompng($src);
          }
          break;
      }
      return $image;
    }


    // save image
    function mobile_save_image($handle_image, $filename){
      $pathinfo = pathinfo($filename);

      $result = false;
      switch( strtolower($pathinfo['extension']) ){
        case 'gif':
          if( function_exists("imagegif") ){
            $result = imagegif($handle_image, $filename);
          }
          break;
        case 'jpg':
        case 'jpeg':
          if( function_exists("imagejpeg") ){
            $result = imagejpeg($handle_image, $filename);
          }
          break;
        case 'png':
          if( function_exists("imagepng") ){
            $result = imagepng($handle_image, $filename);
          }
          break;
      }
      return $result;
    }


    // recursive mkdir
    function recursive_mkdir( $folder, $mode ){
        is_dir(dirname($folder)) || recursive_mkdir(dirname($folder), $mode);
        return is_dir($folder) || @mkdir($folder, $mode);
    }
    function get_number_pictgram_hexcode($i){
      switch($i){
          case 0:
            return 'E6EB';    
          break;
            
          case 1:
            return 'E6E2';    
          break;
            
          case 2:
            return 'E6E3';
          break;
          
          case 3:
            return 'E6E4';
          break;
          
          case 4:
            return 'E6E5';
          break;
          
          case 5:
            return 'E6E6';
          break;
          
          case 6:
            return 'E6E7';
          break;
          
          case 7:
            return 'E6E8';
          break;
          
          case 8:
            return 'E6E9';
          break;
          
          case 9:
            return 'E6EA';
          break;
          
          default:
            return 'E6EB';
          break;
      }
    }
    function get_number_pictgram($i){
        return "&#x".get_number_pictgram_hexcode($i).";";
    }
    function get_pictgram_accesskey($i){
         if(($i < 10) && ($i > 0)){    
             $access_key = get_number_pictgram($i).'<a accesskey="'.($i).'" '; 
         }else{
             $access_key = "<a ";
         }
         return $access_key;
    }
    // create all mobile images
    function mobile_create_all_image($src){

      if( !file_exists($src) ){
        return;
      }

      // create large image
      $large_file = mobile_get_image_path($src, MOBILE_IMAGES_WIDTH_LARGE);
      if( $large_file != '' ){
        mobile_create_resized_image($src, $large_file, MOBILE_IMAGES_WIDTH_LARGE);
      }
      // create small image
      $small_file = mobile_get_image_path($src, MOBILE_IMAGES_WIDTH_SMALL);
      if( $small_file != '' ){
        mobile_create_resized_image($src, $small_file, MOBILE_IMAGES_WIDTH_SMALL);
      }
    }

?>
