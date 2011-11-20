<?php
/**
 * @package admin
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: language.php 17063 2010-07-29 18:27:27Z drbyte $
 */
if (!defined('IS_ADMIN_FLAG')) {
  die('Illegal Access');
}
/**
 * language Class.
 * Class to handle language settings for customer viewing
 *
 * @package classes
 */
  class language {
    var $languages, $catalog_languages, $browser_languages, $language;

    function language($lng = '') {
      global $db;

      $this->catalog_languages = array();
      $languages_query = "select languages_id, name, code, image, directory
                            from " . TABLE_LANGUAGES . "
                            order by sort_order";

      $languages = $db->Execute($languages_query);

      while (!$languages->EOF) {
        $this->catalog_languages[$languages->fields['code']] = array('id' => $languages->fields['languages_id'],
                                                             'name' => $languages->fields['name'],
                                                             'image' => $languages->fields['image'],
                                                             'code' => $languages->fields['code'],
                                                             'directory' => $languages->fields['directory']);
        $languages->MoveNext();
      }
      $this->browser_languages = '';
      $this->language = '';

      $this->set_language($lng);
    }

    function set_language($language) {
      if ( (zen_not_null($language)) && (isset($this->catalog_languages[$language])) ) {
        $this->language = $this->catalog_languages[$language];
      } else {
        $this->language = $this->catalog_languages[DEFAULT_LANGUAGE];
      }
    }

    function get_browser_language() {
      if (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
        $this->browser_languages = explode(',', $_SERVER['HTTP_ACCEPT_LANGUAGE']);
        for ($i=0, $n=sizeof($this->browser_languages); $i<$n; $i++) {
          $lang = explode(';', $this->browser_languages[$i]);
          if (strlen($lang[0]) == 2) {
            $code = $lang[0];
          } elseif (strpos($lang[0], '-') == 2 || strpos($lang[0], '_') == 2) {
            $code = substr($lang[0], 0, 2);
          } else {
            continue;
          }
          if (isset($this->catalog_languages[$code])) {
            $this->language = $this->catalog_languages[$code];
            break;
          }
        }
      }
    }
  }
