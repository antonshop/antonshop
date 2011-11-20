<?php
/**
 * USPS Module for Zen Cart v1.3.x
 * RateV3 Updates to: January 4, 2010
 *
 * @package shippingMethod
 * @copyright Copyright 2003-2010 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: usps.php 15881 2010-04-11 16:32:39Z wilt $
 */
/**
 * USPS Shipping Module class
 *
 */
class usps extends base {
  /**
   * Declare shipping module alias code
   *
   * @var string
   */
  var $code;
  /**
   * Shipping module display name
   *
   * @var string
   */
  var $title;
  /**
   * Shipping module display description
   *
   * @var string
   */
  var $description;
  /**
   * Shipping module icon filename/path
   *
   * @var string
   */
  var $icon;
  /**
   * Shipping module status
   *
   * @var boolean
   */
  var $enabled;
  /**
   * Shipping module list of supported countries (unique to USPS/UPS)
   *
   * @var array
   */
  var $countries;
  /**
   * Constructor
   *
   * @return usps
   */

// use USPS translations for US shops
   var $usps_countries;

  function usps() {
    global $order, $db, $template, $current_page_base;

    $this->code = 'usps';
    $this->title = MODULE_SHIPPING_USPS_TEXT_TITLE;
    $this->description = MODULE_SHIPPING_USPS_TEXT_DESCRIPTION;
    $this->sort_order = MODULE_SHIPPING_USPS_SORT_ORDER;
    $this->icon = $template->get_template_dir('shipping_usps.gif', DIR_WS_TEMPLATE, $current_page_base,'images/icons'). '/' . 'shipping_usps.gif';
    $this->tax_class = MODULE_SHIPPING_USPS_TAX_CLASS;
    $this->tax_basis = MODULE_SHIPPING_USPS_TAX_BASIS;

    // disable only when entire cart is free shipping
    if (zen_get_shipping_enabled($this->code)) {
      $this->enabled = ((MODULE_SHIPPING_USPS_STATUS == 'True') ? true : false);
    }

    if ($this->enabled) {
      // check MODULE_SHIPPING_USPS_HANDLING_METHOD is in
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_USPS_HANDLING_METHOD'");
      if ($check_query->EOF) {
        $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Handling Per Order or Per Box', 'MODULE_SHIPPING_USPS_HANDLING_METHOD', 'Box', 'Do you want to charge Handling Fee Per Order or Per Box?', '6', '0', 'zen_cfg_select_option(array(\'Order\', \'Box\'), ', now())");
      }
    }

    if ( ($this->enabled == true) && ((int)MODULE_SHIPPING_USPS_ZONE > 0) ) {
      $check_flag = false;
      $check = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_SHIPPING_USPS_ZONE . "' and zone_country_id = '" . $order->delivery['country']['id'] . "' order by zone_id");
      while (!$check->EOF) {
        if ($check->fields['zone_id'] < 1) {
          $check_flag = true;
          break;
        } elseif ($check->fields['zone_id'] == $order->delivery['zone_id']) {
          $check_flag = true;
          break;
        }
        $check->MoveNext();
      }

      if ($check_flag == false) {
        $this->enabled = false;
      }
    }

    $this->types = array('EXPRESS' => 'Express Mail',
        'FIRST CLASS' => 'First-Class Mail',
        'PRIORITY' => 'Priority Mail',
        'PARCEL' => 'Parcel Post',
        'MEDIA' => 'Media Mail',
        'BPM' => 'Bound Printed Matter',
        'LIBRARY' => 'Library'
        );

    $this->intl_types = array(
        'Global Express' => 'Global Express Guaranteed (GXG)',
        'Global Express Non-Doc Rect' => 'Global Express Guaranteed Non-Document Rectangular',
        'Global Express Non-Doc Non-Rect' => 'Global Express Guaranteed Non-Document Non-Rectangular',
        'Global Express Envelopes' => 'USPS GXG Envelopes',
        'Express Mail Int' => 'Express Mail International',
        'Express Mail Int Flat Rate Env' => 'Express Mail International Flat Rate Envelope',
        'Priority Mail International' => 'Priority Mail International',
        'Priority Mail Int Flat Rate Env' => 'Priority Mail International Flat Rate Envelope',
        'Priority Mail Int Flat Rate Box' => 'Priority Mail International Flat Rate Box',
        'Priority Mail Int Flat Rate Small Box' => 'Priority Mail International Small Flat Rate Box',
        'Priority Mail Int Flat Rate Med Box' => 'Priority Mail International Medium Flat Rate Box',
        'Priority Mail Int Flat Rate Lrg Box' => 'Priority Mail International Large Flat Rate Box',
        'First Class Mail Int Lrg Env' => 'First-Class Mail International Large Envelope',
        'First Class Mail Int Package' => 'First-Class Mail International Package',
        'First Class Mail Int Letter' => 'First-Class Mail International Letter'
        );


    $this->countries = $this->country_list();

// use USPS translations for US shops
    $this->usps_countries = $this->usps_translation();

  }

  /**
   * Get quote from shipping provider's API:
   *
   * @param string $method
   * @return array of quotation results
   */
  function quote($method = '') {
    // BOF: UPS USPS
    global $order, $shipping_weight, $shipping_num_boxes, $transittime;

    if ( zen_not_null($method) && (isset($this->types[$method]) || in_array($method, $this->intl_types)) ) {
      $this->_setService($method);
    }


    // usps doesnt accept zero weight send 1 ounce (0.0625) minimum
    $usps_shipping_weight = ($shipping_weight <= 0.0 ? 0.0625 : $shipping_weight);
    $shipping_pounds = floor ($usps_shipping_weight);
    $shipping_ounces = (16 * ($usps_shipping_weight - floor($usps_shipping_weight)));
    // usps currently cannot handle more than 5 digits on international
    $shipping_ounces = zen_round($shipping_ounces, 3);
    // weight must be less than 35lbs and greater than 6 ounces or it is not machinable
    switch(true) {
      case ($shipping_pounds == 0 and $shipping_ounces < 6):
      // override admin choice too light
      $is_machinable = 'False';
      break;

      case ($usps_shipping_weight > 35):
      // override admin choice too heavy
      $is_machinable = 'False';
      break;

      default:
      // admin choice on what to use
      $is_machinable = MODULE_SHIPPING_USPS_MACHINABLE;
    }

    $this->_setMachinable($is_machinable);
    $this->_setContainer('None');
    $this->_setSize('REGULAR');
    $this->_setFirstClassType('FLAT');

    $this->_setWeight($shipping_pounds, $shipping_ounces);
    $uspsQuote = $this->_getQuote();

    if (is_array($uspsQuote)) {
      if (isset($uspsQuote['error'])) {
        $this->quotes = array('module' => $this->title,
                              'error' => $uspsQuote['error']);
      } else {

        // BOF: UPS USPS
        if (in_array('Display weight', explode(', ', MODULE_SHIPPING_USPS_OPTIONS))) {
          switch (SHIPPING_BOX_WEIGHT_DISPLAY) {
            case (0):
            $show_box_weight = '';
            break;
            case (1):
            $show_box_weight = ' (' . $shipping_num_boxes . ' ' . TEXT_SHIPPING_BOXES . ')';
            break;
            case (2):
            $show_box_weight = ' (' . number_format($usps_shipping_weight * $shipping_num_boxes,2) . TEXT_SHIPPING_WEIGHT . ')';
            break;
            default:
            $show_box_weight = ' (' . $shipping_num_boxes . ' x ' . number_format($usps_shipping_weight,2) . TEXT_SHIPPING_WEIGHT . ')';
            break;
          }
        }
        // EOF: UPS USPS

        // BOF: UPS USPS
        $this->quotes = array('id' => $this->code,
        'module' => $this->title . $show_box_weight);
        // EOF: UPS USPS

        $methods = array();
        $size = sizeof($uspsQuote);
        for ($i=0; $i<$size; $i++) {
          list($type, $cost) = each($uspsQuote[$i]);

          // BOF: UPS USPS
          $title = ((isset($this->types[$type])) ? $this->types[$type] : $type);
          if(in_array('Display transit time', explode(', ', MODULE_SHIPPING_USPS_OPTIONS)))    $title .= $transittime[$type];
          /*
          $methods[] = array('id' => $type,
          'title' => ((isset($this->types[$type])) ? $this->types[$type] : $type),
          'cost' => ($cost + MODULE_SHIPPING_USPS_HANDLING) * $shipping_num_boxes);
          */
          $cost = preg_replace('/[^0-9.]/', '',  $cost);
          $methods[] = array('id' => $type,
                             'title' => $title,
                             'cost' => ($cost * $shipping_num_boxes) + (MODULE_SHIPPING_USPS_HANDLING_METHOD == 'Box' ? MODULE_SHIPPING_USPS_HANDLING * $shipping_num_boxes : MODULE_SHIPPING_USPS_HANDLING) );

        }

        $this->quotes['methods'] = $methods;

        if ($this->tax_class > 0) {
          $this->quotes['tax'] = zen_get_tax_rate($this->tax_class, $order->delivery['country']['id'], $order->delivery['zone_id']);
        }
      }
    } elseif ($uspsQuote == -1) {
      $this->quotes = array('module' => $this->title,
                            'error' => MODULE_SHIPPING_USPS_TEXT_SERVER_ERROR . (MODULE_SHIPPING_USPS_SERVER=='test' ? MODULE_SHIPPING_USPS_TEXT_TEST_MODE_NOTICE : ''));
    } else {
      $this->quotes = array('module' => $this->title,
                            'error' => MODULE_SHIPPING_USPS_TEXT_ERROR . (MODULE_SHIPPING_USPS_SERVER=='test' ? MODULE_SHIPPING_USPS_TEXT_TEST_MODE_NOTICE : ''));
    }

    if (zen_not_null($this->icon)) $this->quotes['icon'] = zen_image($this->icon, $this->title);

    return $this->quotes;
  }
  /**
   * check status of module
   *
   * @return boolean
   */
  function check() {
    global $db;
    if (!isset($this->_check)) {
      $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_SHIPPING_USPS_STATUS'");
      $this->_check = $check_query->RecordCount();
    }
    return $this->_check;
  }
  /**
   * Install this module
   *
   */
  function install() {
    global $db;
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('打开USPS配送模块', 'MODULE_SHIPPING_USPS_STATUS', 'True', '您是否要采用USPS配送方式?', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('输入USPS网页工具的用户编号', 'MODULE_SHIPPING_USPS_USERID', 'NONE', '输入USPS给您的用于询价的用户ID。', '6', '0', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('使用的服务器', 'MODULE_SHIPPING_USPS_SERVER', 'production', 'USPS上的帐号连接的服务器', '6', '0', 'zen_cfg_select_option(array(\'test\', \'production\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('所有包裹都是标准的', 'MODULE_SHIPPING_USPS_MACHINABLE', 'False', '所有发货的包裹都符合标准C700包裹服务2.0 Nonmachinable PARCEL POST USPS 吗?<br /><br /><strong>提示: 非标准包裹运费较高。<br /><br />包裹重于35lbs的，或小于6 盎司 (.375)的，将被替代并设为False</strong>', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('手续费', 'MODULE_SHIPPING_USPS_HANDLING', '0', '该配送方式的手续费。', '6', '0', now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('手续费基于订单还是箱数', 'MODULE_SHIPPING_USPS_HANDLING_METHOD', 'Box', '手续费基于订单还是箱数？', '6', '0', 'zen_cfg_select_option(array(\'Order\', \'Box\'), ', now())");

    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('税率种类', 'MODULE_SHIPPING_USPS_TAX_CLASS', '0', '计算运费使用的税率种类。', '6', '0', 'zen_get_tax_class_title', 'zen_cfg_pull_down_tax_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('税率基准', 'MODULE_SHIPPING_USPS_TAX_BASIS', 'Shipping', '计算运费税的基准。选项为<br />Shipping - 基于客户的交货人地址<br />Billing - 基于客户的帐单地址<br />Store - 如果帐单地址/送货地区和商店地区相同，则基于商店地址', '6', '0', 'zen_cfg_select_option(array(\'Shipping\', \'Billing\', \'Store\'), ', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('送货地区', 'MODULE_SHIPPING_USPS_ZONE', '0', '如果选择了地区，仅该地区采用该配送方式。', '6', '0', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('排序顺序', 'MODULE_SHIPPING_USPS_SORT_ORDER', '0', '显示的顺序。', '6', '0', now())");
    // BOF: UPS USPS
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('国内配送方式', 'MODULE_SHIPPING_USPS_TYPES', 'EXPRESS, PRIORITY, FIRST CLASS, PARCEL, MEDIA, BPM, LIBRARY', '选择提供的国内配送服务:', '6', '14', 'zen_cfg_select_multioption(array(\'EXPRESS\', \'PRIORITY\', \'FIRST CLASS\', \'PARCEL\', \'MEDIA\', \'BPM\', \'LIBRARY\'), ',  now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('国际配送方式', 'MODULE_SHIPPING_USPS_TYPES_INTL', 'Global Express, Global Express Non-Doc Rect, Global Express Non-Doc Non-Rect, Global Express Envelopes, Express Mail Int, Express Mail Int Flat Rate Env, Priority Mail International, Priority Mail Int Flat Rate Env, Priority Mail Int Flat Rate Small Box, Priority Mail Int Flat Rate Med Box, Priority Mail Int Flat Rate Lrg Box, First Class Mail Int Lrg Env, First Class Mail Int Package, First Class Mail Int Letter', '选择提供的国际配送服务:', '6', '15', 'zen_cfg_select_multioption(array(\'Global Express\', \'Global Express Non-Doc Rect\', \'Global Express Non-Doc Non-Rect\', \'Global Express Envelopes\', \'Express Mail Int\', \'Express Mail Int Flat Rate Env\', \'Priority Mail International\', \'Priority Mail Int Flat Rate Env\', \'Priority Mail Int Flat Rate Small Box\', \'Priority Mail Int Flat Rate Med Box\', \'Priority Mail Int Flat Rate Lrg Box\', \'First Class Mail Int Lrg Env\', \'First Class Mail Int Package\', \'First Class Mail Int Letter\'), ',  now())");
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('USPS选项', 'MODULE_SHIPPING_USPS_OPTIONS', 'Display weight, Display transit time', '从下面选择USPS选项.', '6', '16', 'zen_cfg_select_multioption(array(\'Display weight\', \'Display transit time\'), ',  now())");
    // EOF: UPS USPS
    $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('Debug Mode', 'MODULE_SHIPPING_USPS_DEBUG_MODE', 'Off', 'Would you like to enable debug mode?  A complete detailed log of USPS quote results may be emailed to the store owner.', '6', '0', 'zen_cfg_select_option(array(\'Off\', \'Email\'), ', now())");
  }
  /**
   * Remove this module
   *
   */
  function remove() {
    global $db;
    $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE\_SHIPPING\_USPS\_%' ");
  }
  /**
   * Build array of keys used for installing/managing this module
   *
   * @return array
   */
  function keys() {
    $keys_list = array('MODULE_SHIPPING_USPS_STATUS', 'MODULE_SHIPPING_USPS_USERID', 'MODULE_SHIPPING_USPS_SERVER', 'MODULE_SHIPPING_USPS_HANDLING', 'MODULE_SHIPPING_USPS_HANDLING_METHOD', 'MODULE_SHIPPING_USPS_TAX_CLASS', 'MODULE_SHIPPING_USPS_TAX_BASIS', 'MODULE_SHIPPING_USPS_ZONE', 'MODULE_SHIPPING_USPS_SORT_ORDER', 'MODULE_SHIPPING_USPS_MACHINABLE', 'MODULE_SHIPPING_USPS_OPTIONS', 'MODULE_SHIPPING_USPS_TYPES', 'MODULE_SHIPPING_USPS_TYPES_INTL');
    $keys_list[]='MODULE_SHIPPING_USPS_DEBUG_MODE';
    return $keys_list;
  }
  /**
   * Set USPS service mode
   *
   * @param string $service
   */
  function _setService($service) {
    $this->service = $service;
  }
  /**
   * Set USPS weight for quotation collection
   *
   * @param integer $pounds
   * @param integer $ounces
   */
  function _setWeight($pounds, $ounces=0) {
    $this->pounds = $pounds;
    $this->ounces = $ounces;
  }
  /**
   * Set USPS container type
   *
   * @param string $container
   */
  function _setContainer($container) {
    $this->container = $container;
  }

  /**
   * Set USPS Firs Class type
   *
   * @param string $fctype
   */
  function _setFirstClassType($fctype) {
    $this->fctype = $fctype;
  }

  /**

   * Set USPS package size
   *
   * @param integer $size
   */
  function _setSize($size) {
    $this->size = $size;
  }
  /**
   * Set USPS machinable flag
   *
   * @param boolean $machinable
   */
  function _setMachinable($machinable) {
    $this->machinable = $machinable;
  }
  /**
   * Get actual quote from USPS
   *
   * @return array of results or boolean false if no results
   */
  function _getQuote() {
    // BOF: UPS USPS
    global $order, $transittime;
    if(in_array('Display transit time', explode(', ', MODULE_SHIPPING_USPS_OPTIONS))) $transit = TRUE;
    // EOF: UPS USPS

// translate for US Territories
//    if ($order->delivery['country']['id'] == SHIPPING_ORIGIN_COUNTRY) {
    if ($order->delivery['country']['id'] == SHIPPING_ORIGIN_COUNTRY || (SHIPPING_ORIGIN_COUNTRY == '223' && $this->usps_countries == 'US')) {
      $request  = '<RateV3Request USERID="' . MODULE_SHIPPING_USPS_USERID . '">';
      $services_count = 0;

      if (isset($this->service)) {
        $this->types = array($this->service => $this->types[$this->service]);
      }

      $dest_zip = str_replace(' ', '', $order->delivery['postcode']);
// translate for US Territories
      if ($order->delivery['country']['iso_code_2'] == 'US' || (SHIPPING_ORIGIN_COUNTRY == '223' && $this->usps_countries == 'US')) $dest_zip = substr($dest_zip, 0, 5);

      reset($this->types);
      // BOF: UPS USPS
      $allowed_types = explode(", ", MODULE_SHIPPING_USPS_TYPES);
      while (list($key, $value) = each($this->types)) {
        // BOF: UPS USPS
        if ( !in_array($key, $allowed_types) ) continue;
          //For Options list, go to page 6 of document: http://www.usps.com/webtools/_pdf/Rate-Calculators-v1-2.pdf
          //FIRST CLASS MAIL OPTIONS
          if ($key == 'FIRST CLASS') {
            $this->FirstClassMailType = '<FirstClassMailType>LETTER</FirstClassMailType>';
          } else {
            $this->FirstClassMailType = '';
          }
          //PRIORITY MAIL OPTIONS
          if ($key == 'PRIORITY'){
            $this->container = ''; // Blank, Flate Rate Envelope, or Flat Rate Box // Sm Flat Rate Box, Md Flat Rate Box and Lg Flat Rate Box

          }
          //EXPRESS MAIL OPTIONS
          if ($key == 'EXPRESS'){
            $this->container = '';  // Blank, or Flate Rate Envelope
          }
          //PARCEL POST OPTIONS
          if ($key == 'PARCEL'){
            $this->container = 'Regular';
            $this->machinable = 'true';
          }
          //BPM OPTIONS
          //MEDIA MAIL OPTIONS
          //LIBRARY MAIL OPTIONS
        $request .= '<Package ID="' . $services_count . '">' .
        '<Service>' . $key . '</Service>' .
        '<FirstClassMailType>' . $this->fctype . '</FirstClassMailType>' .
        '<ZipOrigination>' . SHIPPING_ORIGIN_ZIP . '</ZipOrigination>' .
        '<ZipDestination>' . $dest_zip . '</ZipDestination>' .
        '<Pounds>' . $this->pounds . '</Pounds>' .
        '<Ounces>' . $this->ounces . '</Ounces>' .
        '<Container>' . $this->container . '</Container>' .
        '<Size>' . $this->size . '</Size>' .
        '<Machinable>' . $this->machinable . '</Machinable>' .
        '</Package>';
        // BOF: UPS USPS
        if($transit){
          $transitreq  = 'USERID="' . MODULE_SHIPPING_USPS_USERID . '">' .
          '<OriginZip>' . STORE_ORIGIN_ZIP . '</OriginZip>' .
          '<DestinationZip>' . $dest_zip . '</DestinationZip>';

          switch ($key) {
            case 'EXPRESS':  $transreq[$key] = 'API=ExpressMail&XML=' .
            urlencode( '<ExpressMailRequest ' . $transitreq . '</ExpressMailRequest>');
            break;
            case 'PRIORITY': $transreq[$key] = 'API=PriorityMail&XML=' .
            urlencode( '<PriorityMailRequest ' . $transitreq . '</PriorityMailRequest>');
            break;
            case 'PARCEL':   $transreq[$key] = 'API=StandardB&XML=' .
            urlencode( '<StandardBRequest ' . $transitreq . '</StandardBRequest>');
            break;
            default:         $transreq[$key] = '';
            break;
          }
        }
        // EOF: UPS USPS
        $services_count++;
      }
      $request .= '</RateV3Request>';

      $request = 'API=RateV3&XML=' . urlencode($request);
    } else {
      $request  = '<IntlRateRequest USERID="' . MODULE_SHIPPING_USPS_USERID . '">' .
      '<Package ID="0">' .
      '<Pounds>' . $this->pounds . '</Pounds>' .
      '<Ounces>' . $this->ounces . '</Ounces>' .
      '<MailType>Package</MailType>' .
      '<Country>' . $this->countries[$order->delivery['country']['iso_code_2']] . '</Country>' .
      '</Package>' .
      '</IntlRateRequest>';

      $request = 'API=IntlRate&XML=' . urlencode($request);
    }

    switch (MODULE_SHIPPING_USPS_SERVER) {
      case 'production':
      $usps_server = 'production.shippingapis.com';
      $api_dll = 'shippingapi.dll';
      break;
      case 'test':
      default:
      $usps_server = 'testing.shippingapis.com';
      $api_dll = 'ShippingAPI.dll';
      break;
    }

    $body = '';

    $http = new httpClient();
    $http->timeout = 5;
    if ($http->Connect($usps_server, 80)) {
      $http->addHeader('Host', $usps_server);
      $http->addHeader('User-Agent', 'Zen Cart');
      $http->addHeader('Connection', 'Close');

      if ($http->Get('/' . $api_dll . '?' . $request)) $body = $http->getBody();
      if (MODULE_SHIPPING_USPS_DEBUG_MODE == 'Email') mail(STORE_OWNER_EMAIL_ADDRESS, 'Debug: USPS rate quote response', '(You can turn off this debug email by editing your USPS module settings in the admin area of your store.) ' . "\n\n" . $body, 'From: <' . EMAIL_FROM . '>');
      // BOF: UPS USPS

// translate for US Territories
//      if ($transit && is_array($transreq) && ($order->delivery['country']['id'] == STORE_COUNTRY)) {
      if ($transit && is_array($transreq) && ( ($order->delivery['country']['id'] == STORE_COUNTRY || (SHIPPING_ORIGIN_COUNTRY == '223' && $this->usps_countries == 'US') )) ) {
        while (list($key, $value) = each($transreq)) {
          if ($http->Get('/' . $api_dll . '?' . $value)) $transresp[$key] = $http->getBody();
        }
      }
      // EOF: UPS USPS

      $http->Disconnect();
    } else {
      return -1;
    }

    $response = array();
    while (true) {
      if ($start = strpos($body, '<Package ID=')) {
        $body = substr($body, $start);
        $end = strpos($body, '</Package>');
        $response[] = substr($body, 0, $end+10);
        $body = substr($body, $end+9);
      } else {
        break;
      }
    }

    $rates = array();

// translate for US Territories
//    if ($order->delivery['country']['id'] == SHIPPING_ORIGIN_COUNTRY) {
    if ($order->delivery['country']['id'] == SHIPPING_ORIGIN_COUNTRY  || (SHIPPING_ORIGIN_COUNTRY == '223' && $this->usps_countries == 'US')) {
      if (sizeof($response) == '1') {
        if (preg_match('/<Error>/i', $response[0])) {
          $number = preg_match('/<Number>(.*)<\/Number>/msi', $response[0], $regs);
          $number = $regs[1];
          $description = preg_match('/<Description>(.*)<\/Description>/msi', $response[0], $regs);
          $description = $regs[1];

          return array('error' => $number . ' - ' . $description);
        }
      }

      $n = sizeof($response);
      for ($i=0; $i<$n; $i++) {
        if (strpos($response[$i], '<Rate>')) {
          $service = preg_match('/<MailService>(.*)<\/MailService>/msi', $response[$i], $regs);
          $service = $regs[1];
          if (preg_match('/Express/i', $service)) $service = 'EXPRESS';
          if (preg_match('/Priority/i', $service)) $service = 'PRIORITY';
          if (preg_match('/First-Class Mail/i', $service)) $service = 'FIRST CLASS';
          if (preg_match('/Parcel/i', $service)) $service = 'PARCEL';
          if (preg_match('/Media/i', $service)) $service = 'MEDIA';
          if (preg_match('/Bound Printed/i', $service)) $service = 'BPM';
          if (preg_match('/Library/i', $service)) $service = 'LIBRARY';
          $postage = preg_match('/<Rate>(.*)<\/Rate>/msi', $response[$i], $regs);
          $postage = $regs[1];

          $rates[] = array($service => $postage);
          // BOF: UPS USPS
          if ($transit) {
            switch ($service) {
              case 'EXPRESS':     $time = preg_match('/<MonFriCommitment>(.*)<\/MonFriCommitment>/msi', $transresp[$service], $tregs);
              $time = $tregs[1];
              if ($time == '' || $time == 'No Data') {
                $time = '1 - 2 ' . MODULE_SHIPPING_USPS_TEXT_DAYS;
              } else {
                $time = 'Tomorrow by ' . $time;
              }
              break;
              case 'PRIORITY':    $time = preg_match('/<Days>(.*)<\/Days>/msi', $transresp[$service], $tregs);
              $time = $tregs[1];
              if ($time == '' || $time == 'No Data') {
                $time = '2 - 3 ' . MODULE_SHIPPING_USPS_TEXT_DAYS;
              } elseif ($time == '1') {
                $time .= ' ' . MODULE_SHIPPING_USPS_TEXT_DAY;
              } else {
                $time .= ' ' . MODULE_SHIPPING_USPS_TEXT_DAYS;
              }
              break;
              case 'PARCEL':      $time = preg_match('/<Days>(.*)<\/Days>/msi', $transresp[$service], $tregs);
              $time = $tregs[1];
              if ($time == '' || $time == 'No Data') {
                $time = '4 - 7 ' . MODULE_SHIPPING_USPS_TEXT_DAYS;
              } elseif ($time == '1') {
                $time .= ' ' . MODULE_SHIPPING_USPS_TEXT_DAY;
              } else {
                $time .= ' ' . MODULE_SHIPPING_USPS_TEXT_DAYS;
              }
              break;
              case 'FIRST CLASS': $time = '2 - 5 ' . MODULE_SHIPPING_USPS_TEXT_DAYS;
              break;


              default:            $time = '';
              break;
            }
            if ($time != '') $transittime[$service] = ' (' . $time . ')';
          }
          // EOF: UPS USPS
        }
      }
    } else {
      if (preg_match('/<Error>/i', $response[0])) {
        $number = preg_match('/<Number>(.*)<\/Number>/msi', $response[0], $regs);
        $number = $regs[1];
        $description = preg_match('/<Description>(.*)<\/Description>/msi', $response[0], $regs);
        $description = $regs[1];

        return array('error' => $number . ' - ' . $description);
      } else {
        $body = $response[0];
        $services = array();
        while (true) {
          if ($start = strpos($body, '<Service ID=')) {
            $body = substr($body, $start);
            $end = strpos($body, '</Service>');
            $services[] = substr($body, 0, $end+10);
            $body = substr($body, $end+9);
          } else {
            break;
          }
        }

        // BOF: UPS USPS
        $allowed_types = array();
        foreach( explode(", ", MODULE_SHIPPING_USPS_TYPES_INTL) as $value ) $allowed_types[$value] = $this->intl_types[$value];
        // EOF: UPS USPS

        $size = sizeof($services);
        for ($i=0, $n=$size; $i<$n; $i++) {
          if (strpos($services[$i], '<Postage>')) {
            $service = preg_match('/<SvcDescription>(.*)<\/SvcDescription>/msi', $services[$i], $regs);
            $service = $regs[1];
            $postage = preg_match('/<Postage>(.*)<\/Postage>/i', $services[$i], $regs);
            $postage = $regs[1];
            // BOF: UPS USPS
            $time = preg_match('/<SvcCommitments>(.*)<\/SvcCommitments>/msi', $services[$i], $tregs);
            $time = $tregs[1];
            $time = preg_replace('/Weeks$/', MODULE_SHIPPING_USPS_TEXT_WEEKS, $time);
            $time = preg_replace('/Days$/', MODULE_SHIPPING_USPS_TEXT_DAYS, $time);
            $time = preg_replace('/Day$/', MODULE_SHIPPING_USPS_TEXT_DAY, $time);

            if( !in_array($service, $allowed_types) ) continue;
            if ($_SESSION['cart']->total > 400 && strstr($services[$i], 'Priority Mail International Flat Rate Envelope')) continue; // skip value > $400 Priority Mail International Flat Rate Envelope
            // EOF: UPS USPS
            if (isset($this->service) && ($service != $this->service) ) {
              continue;
            }

            $rates[] = array($service => $postage);
            // BOF: UPS USPS
            if ($time != '') $transittime[$service] = ' (' . $time . ')';
            // EOF: UPS USPS
          }
        }
      }
    }
//echo 'RATE RESPONSE: ' . "\n" . print_r($rates);

    return ((sizeof($rates) > 0) ? $rates : false);
  }
  /**
   * USPS Country Code List
   * This list is used to compare the 2-letter ISO code against the order country ISO code, and provide the proper/expected
   * spelling of the country name to USPS in order to obtain a rate quote
   *
   * @return array
   */
  function country_list() {
    $list = array(
    'AF' => 'Afghanistan',
    'AL' => 'Albania',
    'AX' => 'Aland Island (Finland)',
    'DZ' => 'Algeria',
    'AD' => 'Andorra',
    'AO' => 'Angola',
    'AI' => 'Anguilla',
    'AG' => 'Antigua and Barbuda',
    'AR' => 'Argentina',
    'AM' => 'Armenia',
    'AW' => 'Aruba',
    'AU' => 'Australia',
    'AT' => 'Austria',
    'AZ' => 'Azerbaijan',
    'BS' => 'Bahamas',
    'BH' => 'Bahrain',
    'BD' => 'Bangladesh',
    'BB' => 'Barbados',
    'BY' => 'Belarus',
    'BE' => 'Belgium',
    'BZ' => 'Belize',
    'BJ' => 'Benin',
    'BM' => 'Bermuda',
    'BT' => 'Bhutan',
    'BO' => 'Bolivia',
    'BA' => 'Bosnia-Herzegovina',
    'BW' => 'Botswana',
    'BR' => 'Brazil',
    'VG' => 'British Virgin Islands',
    'BN' => 'Brunei Darussalam',
    'BG' => 'Bulgaria',
    'BF' => 'Burkina Faso',
    'MM' => 'Burma',
    'BI' => 'Burundi',
    'KH' => 'Cambodia',
    'CM' => 'Cameroon',
    'CA' => 'Canada',
    'CV' => 'Cape Verde',
    'KY' => 'Cayman Islands',
    'CF' => 'Central African Republic',
    'TD' => 'Chad',
    'CL' => 'Chile',
    'CN' => 'China',
    'CX' => 'Christmas Island (Australia)',
    'CC' => 'Cocos Island (Australia)',
    'CO' => 'Colombia',
    'KM' => 'Comoros',
    'CG' => 'Congo, Republic of the',
    'CD' => 'Congo, Democratic Republic of the',
    'CK' => 'Cook Islands (New Zealand)',
    'CR' => 'Costa Rica',
    'CI' => 'Cote d Ivoire (Ivory Coast)',
    'HR' => 'Croatia',
    'CU' => 'Cuba',
    'CY' => 'Cyprus',
    'CZ' => 'Czech Republic',
    'DK' => 'Denmark',
    'DJ' => 'Djibouti',
    'DM' => 'Dominica',
    'DO' => 'Dominican Republic',
    'EC' => 'Ecuador',
    'EG' => 'Egypt',
    'SV' => 'El Salvador',
    'GQ' => 'Equatorial Guinea',
    'ER' => 'Eritrea',
    'EE' => 'Estonia',
    'ET' => 'Ethiopia',
    'FK' => 'Falkland Islands',
    'FO' => 'Faroe Islands',
    'FJ' => 'Fiji',
    'FI' => 'Finland',
    'FR' => 'France',
    'GF' => 'French Guiana',
    'PF' => 'French Polynesia',
    'GA' => 'Gabon',
    'GM' => 'Gambia',
    'GE' => 'Georgia, Republic of',
    'DE' => 'Germany',
    'GH' => 'Ghana',
    'GI' => 'Gibraltar',
    'GB' => 'Great Britain and Northern Ireland',
    'GR' => 'Greece',
    'GL' => 'Greenland',
    'GD' => 'Grenada',
    'GP' => 'Guadeloupe',
    'GT' => 'Guatemala',
    'GN' => 'Guinea',
    'GW' => 'Guinea-Bissau',
    'GY' => 'Guyana',
    'HT' => 'Haiti',
    'HN' => 'Honduras',
    'HK' => 'Hong Kong',
    'HU' => 'Hungary',
    'IS' => 'Iceland',
    'IN' => 'India',
    'ID' => 'Indonesia',
    'IR' => 'Iran',
    'IQ' => 'Iraq',
    'IE' => 'Ireland',
    'IL' => 'Israel',
    'IT' => 'Italy',
    'JM' => 'Jamaica',
    'JP' => 'Japan',
    'JO' => 'Jordan',
    'KZ' => 'Kazakhstan',
    'KE' => 'Kenya',
    'KI' => 'Kiribati',
    'KW' => 'Kuwait',
    'KG' => 'Kyrgyzstan',
    'LA' => 'Laos',
    'LV' => 'Latvia',
    'LB' => 'Lebanon',
    'LS' => 'Lesotho',
    'LR' => 'Liberia',
    'LY' => 'Libya',
    'LI' => 'Liechtenstein',
    'LT' => 'Lithuania',
    'LU' => 'Luxembourg',
    'MO' => 'Macao',
    'MK' => 'Macedonia, Republic of',
    'MG' => 'Madagascar',
    'MW' => 'Malawi',
    'MY' => 'Malaysia',
    'MV' => 'Maldives',
    'ML' => 'Mali',
    'MT' => 'Malta',
    'MQ' => 'Martinique',
    'MR' => 'Mauritania',
    'MU' => 'Mauritius',
    'YT' => 'Mayotte (France)',
    'MX' => 'Mexico',
    'FM' => 'Micronesia, Federated States of',
    'MD' => 'Moldova',
    'MC' => 'Monaco (France)',
    'MN' => 'Mongolia',
    'MS' => 'Montserrat',
    'MA' => 'Morocco',
    'MZ' => 'Mozambique',
    'NA' => 'Namibia',
    'NR' => 'Nauru',
    'NP' => 'Nepal',
    'NL' => 'Netherlands',
    'AN' => 'Netherlands Antilles',
    'NC' => 'New Caledonia',
    'NZ' => 'New Zealand',
    'NI' => 'Nicaragua',
    'NE' => 'Niger',
    'NG' => 'Nigeria',
    'KP' => 'North Korea (Korea, Democratic People\'s Republic of)',
    'NO' => 'Norway',
    'OM' => 'Oman',
    'PK' => 'Pakistan',
    'PA' => 'Panama',
    'PG' => 'Papua New Guinea',
    'PY' => 'Paraguay',
    'PE' => 'Peru',
    'PH' => 'Philippines',
    'PN' => 'Pitcairn Island',
    'PL' => 'Poland',
    'PT' => 'Portugal',
    'QA' => 'Qatar',
    'RE' => 'Reunion',
    'RO' => 'Romania',
    'RU' => 'Russia',
    'RW' => 'Rwanda',
    'SH' => 'Saint Helena',
    'KN' => 'Saint Kitts (St. Christopher and Nevis)',
    'LC' => 'Saint Lucia',
    'PM' => 'Saint Pierre and Miquelon',
    'VC' => 'Saint Vincent and the Grenadines',
    'SM' => 'San Marino',
    'ST' => 'Sao Tome and Principe',
    'SA' => 'Saudi Arabia',
    'SN' => 'Senegal',
    'RS' => 'Serbia',
    'SC' => 'Seychelles',
    'SL' => 'Sierra Leone',
    'SG' => 'Singapore',
    'SK' => 'Slovak Republic',
    'SI' => 'Slovenia',
    'SB' => 'Solomon Islands',
    'SO' => 'Somalia',
    'ZA' => 'South Africa',
    'GS' => 'South Georgia (Falkland Islands)',
    'KR' => 'South Korea (Korea, Republic of)',
    'ES' => 'Spain',
    'LK' => 'Sri Lanka',
    'SD' => 'Sudan',
    'SR' => 'Suriname',
    'SZ' => 'Swaziland',
    'SE' => 'Sweden',
    'CH' => 'Switzerland',
    'SY' => 'Syrian Arab Republic',
    'TW' => 'Taiwan',
    'TJ' => 'Tajikistan',
    'TZ' => 'Tanzania',
    'TH' => 'Thailand',
    'TL' => 'East Timor (Indonesia)',
    'TG' => 'Togo',
    'TK' => 'Tokelau (Union) Group (Western Samoa)',
    'TO' => 'Tonga',
    'TT' => 'Trinidad and Tobago',
    'TN' => 'Tunisia',
    'TR' => 'Turkey',
    'TM' => 'Turkmenistan',
    'TC' => 'Turks and Caicos Islands',
    'TV' => 'Tuvalu',
    'UG' => 'Uganda',
    'UA' => 'Ukraine',
    'AE' => 'United Arab Emirates',
    'UY' => 'Uruguay',
    'UZ' => 'Uzbekistan',
    'VU' => 'Vanuatu',
    'VA' => 'Vatican City',
    'VE' => 'Venezuela',
    'VN' => 'Vietnam',
    'WF' => 'Wallis and Futuna Islands',
    'WS' => 'Western Samoa',
    'YE' => 'Yemen',
    'ZM' => 'Zambia',
    'ZW' => 'Zimbabwe'
    );

    return $list;
  }

// translate for US Territories
  function usps_translation() {
    global $order;
    if (SHIPPING_ORIGIN_COUNTRY == '223') {
      switch($order->delivery['country']['iso_code_2']) {
        case 'AS': // Samoa American
        case 'GU': // Guam
        case 'MP': // Northern Mariana Islands
        case 'PW': // Palau
        case 'PR': // Puerto Rico
        case 'VI': // Virgin Islands US
          return 'US';
          break;
// stays as original country
        case 'FM': // Micronesia, Federated States of
        default:
          return $order->delivery['country']['iso_code_2'];
          break;
      }
    } else {
      return $order->delivery['country']['iso_code_2'];
    }
  }
}
