<?php
/**
 * Zen Lightbox
 *
 * @author Alex Clarke (aclarke@ansellandclarke.co.uk)
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: zen_lightbox.php 2008-12-11 aclarke $
 */

function zen_lightbox($src, $alt = '', $width = '', $height = '', $parameters = '') {
  global $template_dir;
  
  //auto replace with defined missing image
  if ($src == DIR_WS_IMAGES and PRODUCTS_IMAGE_NO_IMAGE_STATUS == '1') {
    $src = DIR_WS_IMAGES . PRODUCTS_IMAGE_NO_IMAGE;
  }

  if ((empty($src) || ($src == DIR_WS_IMAGES)) && (IMAGE_REQUIRED == 'false')) {
    return false;
  }

  // if not in current template switch to template_default
  if (!file_exists($src)) {
    $src = str_replace(DIR_WS_TEMPLATES . $template_dir, DIR_WS_TEMPLATES . 'template_default', $src);
  }

  // hook for handle_image() function such as Image Handler etc
  if (function_exists('handle_image')) {
    $newimg = handle_image($src, $alt, $width, $height, $parameters);
    list($src, $alt, $width, $height, $parameters) = $newimg; 
  }

  $image = zen_output_string($src);

  return $image;
}

function zen_image_no_ih2scroll($src, $alt = '', $width = '', $height = '', $parameters = ''){
	global $template_dir;

    // soft clean the alt tag
    $alt = zen_clean_html($alt);

    // use old method on template images
    if (strstr($src, 'includes/templates') or strstr($src, 'includes/languages') or PROPORTIONAL_IMAGES_STATUS == '0') {
      return zen_image_OLD($src, $alt, $width, $height, $parameters);
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
      $src = str_replace(DIR_WS_TEMPLATES . $template_dir, DIR_WS_TEMPLATES . 'template_default', $src);
    }

    // hook for handle_image() function such as Image Handler etc
    if (function_exists('handle_image')) {
      $newimg = handle_image($src, $alt, $width, $height, $parameters);
      list($src, $alt, $width, $height, $parameters2) = $newimg; 
    }

    // Convert width/height to int for proper validation.
    // intval() used to support compatibility with plugins like image-handler
    $width = empty($width) ? $width : intval($width);
    $height = empty($height) ? $height : intval($height);

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
//      $image .= ' width="' . zen_output_string($width) . '" height="' . zen_output_string($height) . '"';
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
        $image .= ' width="' . $image_size[0] . '" height="' . intval($image_size[1]) . '"';
      } else {
        $image .= ' width="' . round($width) . '" height="' . round($height) . '"';
      }
    } else {
       // override on missing image to allow for proportional and required/not required
      if (IMAGE_REQUIRED == 'false') {
        return false;
      } else {
        $image .= ' width="' . intval(SMALL_IMAGE_WIDTH) . '" height="' . intval(SMALL_IMAGE_HEIGHT) . '"';
      }
    }

    // inject rollover class if one is defined. NOTE: This could end up with 2 "class" elements if $parameters contains "class" already.
    if (defined('IMAGE_ROLLOVER_CLASS') && IMAGE_ROLLOVER_CLASS != '') {
    	$parameters .= (zen_not_null($parameters) ? ' ' : '') . 'class="rollover"';
    }
    // add $parameters to the tag output
    if (zen_not_null($parameters)) $image .= ' ' . $parameters;

    $image .= ' />';

    return $image;
}
?>