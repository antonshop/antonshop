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
//  $Id: _95epay.php v1.0 2008-03-20 Jack $
//

 class _95epay {
   var $code, $title, $description, $enabled;
  /**
   * order status setting for pending orders
   *
   * @var int
   */
   var $order_pending_status = 1;
  /**
   * order status setting for completed orders
   *
   * @var int
   */
   var $order_status =MODULE_PAYMENT_95EPAY_ORDER_STATUS_ID;

// class constructor
   function _95epay() {
     global $order;
       $this->code = '_95epay';
    if ($_GET['main_page'] != '') {
       $this->title = MODULE_PAYMENT_95EPAY_TEXT_CATALOG_TITLE; // Payment Module title in Catalog
    } else {
       $this->title = MODULE_PAYMENT_95EPAY_TEXT_ADMIN_TITLE; // Payment Module title in Admin
    }
       $this->description = MODULE_PAYMENT_95EPAY_TEXT_DESCRIPTION;
       $this->sort_order = MODULE_PAYMENT_95EPAY_SORT_ORDER;
       $this->enabled = ((MODULE_PAYMENT_95EPAY_STATUS == 'True') ? true : false);
       if ((int)MODULE_PAYMENT_95EPAY_ORDER_STATUS_ID > 0) {
         $this->order_status = MODULE_PAYMENT_95EPAY_ORDER_STATUS_ID;
       }
       if (is_object($order)) $this->update_status();
			//$this->form_action_url = MODULE_PAYMENT_95EPAY_HANDLER;注释了这一行才能产生订单！！

   }

// class methods
   function update_status() {
     global $order, $db;

     if ( ($this->enabled == true) && ((int)MODULE_PAYMENT_95EPAY_ZONE > 0) ) {
       $check_flag = false;
       $check_query = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_95EPAY_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
       while (!$check_query->EOF) {
         if ($check_query->fields['zone_id'] < 1) {
           $check_flag = true;
           break;
         } elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
           $check_flag = true;
           break;
         }
                 $check_query->MoveNext();
       }

       if ($check_flag == false) {
         $this->enabled = false;
       }
     }
   }

   function javascript_validation() {
     return false;
   }

   function selection() {
     return array('id' => $this->code,
                   'module' => MODULE_PAYMENT_95EPAY_TEXT_CATALOG_LOGO,
                   'icon' => MODULE_PAYMENT_95EPAY_TEXT_CATALOG_LOGO
                   );
   }

   function pre_confirmation_check() {
     return false;
   }

   function confirmation() {
      return array('title' => MODULE_PAYMENT_95EPAY_TEXT_DESCRIPTION);
   }
	

	
   function process_button() {
     global $db,$order, $currencies,$orders_id;
		
     $MD5key = MODULE_PAYMENT_95EPAY_MD5KEY;			//MD5私钥
     $MerNo = MODULE_PAYMENT_95EPAY_SELLER;				//商户号
	 
	 //$orders_query = "SELECT order_no FROM " . TABLE_ORDERS . " WHERE orders_id =".$orders_id;
	 //$orders = $db->Execute($orders_query);
	 //$order_no = $orders->fields['order_no']; //该顾客在商户网站中的最新订单号
	 $BillNo =$orders_id;							//订单号
	 //支付成功，返回信息显示用户支付金额
	//$DisAmount =number_format(($order->info['total']) * $currencies->get_value($_SESSION['currency']), 2, '.', '').'  '.$_SESSION['currency'];	
	//$_SESSION['DisAmount']=$DisAmount;
	//if(!empty($BillNo))
	//{
		//$sql = "insert into  95EPAY_SESSION(session_id,order_saved,real_order_no, saved_session, expiry) values ('" .zen_db_input(session_id()) . "','".base64_encode(serialize($order)). "','" . zen_db_input($orders_id) . "','" . base64_encode(serialize($_SESSION)) . "','" . (time() + (1*60*60*24*2)) . "')";
		//$db->Execute($sql);
	//}
	
	 

	 if (MODULE_PAYMENT_95EPAY_MONEYTYPE == 'USD') {//币种
			$Currency = '1';
		} else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'EUR'){
			$Currency = '2';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'GBP'){
			$Currency = '4';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'CNY'){
			$Currency = '3';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'HKD'){
			$Currency = '5';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'JPY'){
			$Currency = '6';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'AUD'){
			$Currency = '7';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'CAD'){
			$Currency = '8';
		}else if(MODULE_PAYMENT_95EPAY_MONEYTYPE == 'NOK'){
			$Currency = '9';
		}
		else{
			$Currency = '1';
		}
	 
	 $orders_query = "SELECT order_total FROM " . TABLE_ORDERS . " WHERE orders_id =".(int)$BillNo;
	 $orders = $db->Execute($orders_query);
	 $order_total = $orders->fields['order_total']; //该顾客在商户网站中的折扣后订单总金额
     $Amount =number_format($order_total* ($currencies->get_value(MODULE_PAYMENT_95EPAY_MONEYTYPE)), 2, '.', '');
     //$Amount = number_format(($order->info['total']) * $currencies->get_value(MODULE_PAYMENT_95EPAY_MONEYTYPE), 2, '.', '');	//金额
     //$DisAmount ==number_format(($order->info['total']) * $currencies->get_value($_SESSION['currency']), 2, '.', '').'  '.$_SESSION['currency'];								//外币金额
	 $DisAmount =number_format($order_total * ($currencies->get_value($_SESSION['currency'])), 2, '.', '').'  '.$_SESSION['currency'];
	 $_SESSION['DisAmount']=$DisAmount;
	 //FILENAME_CHECKOUT_PROCESS
     $ReturnURL = MODULE_PAYMENT_95EPAY_RETRUN_URL;//zen_href_link(FILENAME_CHECKOUT_PAYRESULT, '', 'SSL'); 			//返回地址
	 $Noticeurl=HTTP_SERVER.'/index.php?main_page=checkout_95epaynotice';
     //for ($i=0; $i<sizeof($order->products); $i++) {
        //$OrderDesc = $order->products[$i]["qty"] . ' x ' . $order->products[$i]["name"];
     //}
	 $MerWebsite=MODULE_PAYMENT_95EPAY_MERWEBSITE;//购物网站
     $Remark = MODULE_PAYMENT_95EPAY_REMARK;//$OrderDesc;  //备注
	 $Language = MODULE_PAYMENT_95EPAY_LANGUAGE;		//语言
     $md5src = $MerNo.$BillNo.$Currency.$Amount.$Language.$ReturnURL.$MD5key;		//校验源字符串
     $MD5info = strtoupper(md5($md5src));				//MD5检验结果
	 /////////////////////////////////////////////////////////////////////////////////////////////////
		$customer = $order->customer;
		$billing = $order->billing;
		//账单人姓
		$FirstName = empty ($billing['firstname']) ? $customer['firstname'] : $billing['firstname'];
		//账单人名
		$LastName = empty ($billing['lastname']) ? $customer['lastname'] : $billing['lastname'];
		//账单人email
		$Email = $customer['email_address'];
		//账单人电话
		$Phone = $customer['telephone'];
		//账单人邮编
		$ZipCode = empty ($billing['postcode']) ? $customer['postcode'] : $billing['postcode'];
		//账单地址
		$Address = empty ($billing['street_address']) ? $customer['street_address'] : $billing['street_address'];
		//账单人城市
		$City = empty ($billing['city']) ? $customer['city'] : $billing['city'];
		//账单人省或州
		$State = empty ($billing['state']) ? $customer['state'] : $billing['state'];
		$Country=empty($billing['country']['title'])?$customer['country']['title']:$billing['country']['title'];

		$delivery = $order->delivery;
		//收货人姓
		$DeliveryFirstName = empty ($delivery['firstname']) ? $customer['firstname'] : $delivery['firstname'];
		//收货人名
		$DeliveryLastName = empty ($delivery['lastname']) ? $customer['lastname'] : $delivery['lastname'];
		//收货人email
		$DeliveryEmail = empty ($delivery['email_address']) ? $customer['email_address'] : $delivery['email_address'];
		//收货人电话
		$DeliveryPhone = empty ($delivery['telephone']) ? $customer['telephone'] : $delivery['telephone'];
		//收货人邮编
		$DeliveryZipCode = empty ($delivery['postcode']) ? $customer['postcode'] : $delivery['postcode'];
		//收货人地址
		$DeliveryAddress = empty ($delivery['street_address']) ? $customer['street_address'] : $delivery['street_address'];
		//收货人城市
		$DeliveryCity = empty ($delivery['city']) ? $customer['city'] : $delivery['city'];
		//收货人省或州
		$DeliveryState = empty ($delivery['state']) ? $customer['state'] : $delivery['state'];
		//收货人国家
		$DeliveryCountry=empty($delivery['country']['title'])?$customer['country']['title']:$delivery['country']['title'];
	 ////////////////////////////////////////////////////////////////////////////////////////////////
		//zen_draw_hidden_field('DisAmount', $DisAmount) .
     $process_button_string = zen_draw_hidden_field('MerNo', $MerNo) .
                              zen_draw_hidden_field('Currency', $Currency) .
                              zen_draw_hidden_field('BillNo', $BillNo) .
                              zen_draw_hidden_field('Amount', $Amount) .
							  zen_draw_hidden_field('DisAmount', $DisAmount) .
                              zen_draw_hidden_field('ReturnURL', $ReturnURL) .
							  zen_draw_hidden_field('Noticeurl', $Noticeurl) .
                              zen_draw_hidden_field('Language', $Language) .
                              zen_draw_hidden_field('MD5info', $MD5info) .
							  zen_draw_hidden_field('MerWebsite', $MerWebsite).
                              zen_draw_hidden_field('Remark', $Remark).
							  zen_draw_hidden_field('FirstName', $FirstName).
							  zen_draw_hidden_field('LastName', $LastName) .
                              zen_draw_hidden_field('Email', $Email) .
                              zen_draw_hidden_field('Phone', $Phone) .
                              zen_draw_hidden_field('ZipCode', $ZipCode) .
                              zen_draw_hidden_field('Address', $Address) .
                              zen_draw_hidden_field('City', $City) .
                              zen_draw_hidden_field('State', $State) .
							  zen_draw_hidden_field('Country', $Country).
                              zen_draw_hidden_field('DeliveryFirstName', $DeliveryFirstName) .
							  zen_draw_hidden_field('DeliveryLastName', $DeliveryLastName) .
                              zen_draw_hidden_field('DeliveryEmail', $DeliveryEmail).
							  zen_draw_hidden_field('DeliveryPhone', $DeliveryPhone) .
                              zen_draw_hidden_field('DeliveryZipCode', $DeliveryZipCode) .
                              zen_draw_hidden_field('DeliveryAddress', $DeliveryAddress) .
                              zen_draw_hidden_field('DeliveryCity', $DeliveryCity) .
                              zen_draw_hidden_field('DeliveryState', $DeliveryState) .
							  zen_draw_hidden_field('DeliveryCountry', $DeliveryCountry) ;

	
     return $process_button_string;
   }

   function before_process() {
	
	return false;
   }

   function after_process() {
	
	return false;
   }

  function after_order_create($zf_order_id) {
    global $db, $order;
	unset($_SESSION['payment']);
  }

   function output_error() {
     return false;
   }

   function check() {
     global $db;
     if (!isset($this->_check)) {
       $check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_95EPAY_STATUS'");
       $this->_check = $check_query->RecordCount();
     }
     return $this->_check;
   }

   function install() {
      global $db, $language, $module_type;
		$this->remove();
	 /// for Preparing status
	  $check_query = $db->Execute("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Preparing [95epay Payment]' limit 1");

      if ($check_query->RecordCount()< 1) {
        $status_query = $db->Execute("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);

        $status_id =$status_query ->fields['status_id']+1;
        $languages = zen_get_languages();
        foreach ($languages as $lang) {
          $db->Execute("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $status_id . "', '" . $lang['id'] . "', 'Preparing [95epay Payment]')");
        }
      } else {
        $status_id = $check_query->fields['orders_status_id'];
      }
	///////


	

	   /// for pay_success status
	  $check_query = $db->Execute("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Pay_success [95epay Payment]' limit 1");

      if ($check_query->RecordCount()< 1) {
        $status_query = $db->Execute("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);

        $pay_success_status_id =$status_query ->fields['status_id']+1;
        $languages = zen_get_languages();
        foreach ($languages as $lang) {
          $db->Execute("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $pay_success_status_id . "', '" . $lang['id'] . "', 'Pay_success [95epay Payment]')");
        }
      } else {
        $pay_success_status_id = $check_query->fields['orders_status_id'];
      }
	///////

	  /// for pay_fail status
	  $check_query = $db->Execute("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Pay_fail [95epay Payment]' limit 1");

      if ($check_query->RecordCount()< 1) {
        $status_query = $db->Execute("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);

        $pay_fail_status_id =$status_query ->fields['status_id']+1;
        $languages = zen_get_languages();
        foreach ($languages as $lang) {
          $db->Execute("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $pay_fail_status_id . "', '" . $lang['id'] . "', 'Pay_fail [95epay Payment]')");
        }
      } else {
        $pay_fail_status_id = $check_query->fields['orders_status_id'];
      }

	   /// for Processing status
	  $check_query = $db->Execute("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Processing [95epay Payment]' limit 1");

      if ($check_query->RecordCount()< 1) {
        $status_query = $db->Execute("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);

        $status_processing_id =$status_query ->fields['status_id']+1;
        $languages = zen_get_languages();
        foreach ($languages as $lang) {
          $db->Execute("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $status_processing_id . "', '" . $lang['id'] . "', 'Processing [95epay Payment]')");
        }
      } else {
        $status_processing_id = $check_query->fields['orders_status_id'];
      }
	///////


	 /// for 95epay Declined status
	  $check_query = $db->Execute("select orders_status_id from " . TABLE_ORDERS_STATUS . " where orders_status_name = 'Declined [95epay Payment]' limit 1");

      if ($check_query->RecordCount()< 1) {
        $status_query = $db->Execute("select max(orders_status_id) as status_id from " . TABLE_ORDERS_STATUS);

        $status_95epaydeclined_id =$status_query ->fields['status_id']+1;
        $languages = zen_get_languages();
        foreach ($languages as $lang) {
          $db->Execute("insert into " . TABLE_ORDERS_STATUS . " (orders_status_id, language_id, orders_status_name) values ('" . $status_95epaydeclined_id . "', '" . $lang['id'] . "', 'Declined [95epay Payment]')");
        }
      } else {
        $status_95epaydeclined_id = $check_query->fields['orders_status_id'];
      }
	///////



      ////////$pay_fail_status_id
	 if (!defined('MODULE_PAYMENT_95EPAY_TEXT_CONFIG_1_1')) include(DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/' . $module_type . '/' . $this->code . '.php');

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_1_1 . "', 'MODULE_PAYMENT_95EPAY_STATUS', 'True', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_1_2 . "', '6', '0', 'zen_cfg_select_option(array(\'True\', \'False\'), ', now())");

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_2_1 . "', 'MODULE_PAYMENT_95EPAY_SELLER', '1002', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_2_2 . "', '6', '2', now())");

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_3_1 . "', 'MODULE_PAYMENT_95EPAY_MD5KEY', '12345678', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_3_2 . "', '6', '4', now())");

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_4_1 . "', 'MODULE_PAYMENT_95EPAY_MONEYTYPE', 'USD', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_4_2 . "', '6', '6', 'zen_cfg_select_option(array(\'USD\', \'EUR\',\'CNY\',\'GBP\',\'HKD\',\'JPY\',\'AUD\',\'CAD\',\'NOK\'), ', now())");

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_5_1 . "', 'MODULE_PAYMENT_95EPAY_LANGUAGE', 'en', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_5_2 . "', '6', '8', 'zen_cfg_select_option(array(\'en\', \'es\', \'fr\',\'it\', \'ja\',\'de\', \'zh\'), ', now())");

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, use_function, set_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_6_1 . "', 'MODULE_PAYMENT_95EPAY_ZONE', '0', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_6_2 . "', '6', '10', 'zen_get_zone_class_title', 'zen_cfg_pull_down_zone_classes(', now())");
	
	  $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_10_1 . "', 'MODULE_PAYMENT_95EPAY_RETRUN_URL', '".HTTP_SERVER."/index.php?main_page=checkout_payresult_95epay', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_10_2 . "', '6', '12', '', now())");
     

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_8_1 . "', 'MODULE_PAYMENT_95EPAY_SORT_ORDER', '0', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_8_2 . "', '6', '14', now())");

     $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order,  date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_9_1 . "', 'MODULE_PAYMENT_95EPAY_HANDLER', 'https://www.95epay.com/PayReduceRequestAction.action', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_9_2 . "', '6', '16',now())");
	

	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function, use_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_7_1 . "', 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_ID', '".$status_id."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_7_2 . "', '6', '18', 'zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function,use_function, date_added) values('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_12_1 . "', 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID', '".$pay_success_status_id."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_12_2 . "', '6', '20','zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function,use_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_13_1 . "', 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID', '".$pay_fail_status_id."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_13_2 . "', '6', '22','zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");

	 
	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function,use_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_14_1 . "', 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID', '".$status_processing_id."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_14_2 . "', '6', '24','zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");


	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, set_function,use_function, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_11_1 . "', 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_95EPAYDECLINED_ID', '".$status_95epaydeclined_id."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_11_2 . "', '6', '26','zen_cfg_pull_down_order_statuses(', 'zen_get_order_status_name', now())");
		
	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_16_1 . "', 'MODULE_PAYMENT_95EPAY_MERWEBSITE', '".HTTP_SERVER."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_16_2 . "', '6', '28', now())");
	 
	 
	 $db->Execute("insert into " . TABLE_CONFIGURATION . " (configuration_title, configuration_key, configuration_value, configuration_description, configuration_group_id, sort_order, date_added) values ('" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_15_1 . "', 'MODULE_PAYMENT_95EPAY_REMARK', '".HTTP_SERVER."', '" . MODULE_PAYMENT_95EPAY_TEXT_CONFIG_15_2 . "', '6', '30', now())");
	 $db->Execute("
		CREATE TABLE IF NOT EXISTS 95EPAY_SESSION(
		  unique_id int(11) NOT NULL auto_increment,
		  order_saved blob NOT NULL,
		  session_id text NOT NULL,
		  saved_session blob NOT NULL,
		  real_order_no text NOT NULL,
		  expiry int(17) NOT NULL default '0',
		  PRIMARY KEY  (unique_id),
		  KEY idx_session_id_zen ( session_id(36) )
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
		");
		$db->Execute("
		CREATE TABLE IF NOT EXISTS 95EPAY_EMAIL(
		  unique_id int(11) NOT NULL auto_increment,
		  has_send_email text,
		  to_name text,
		  to_address text NOT NULL,
		  email_subject text,
		  email_text text,
		  from_email_name text,
		  from_email_address text,
		  block blob NOT NULL,
		  real_order_no text NOT NULL,
		  PRIMARY KEY  (unique_id),
		  KEY idx_to_address_zen ( to_address(36) )
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
		");
		$db->Execute("
		CREATE TABLE IF NOT EXISTS 95EPAY_EXTRA_EMAIL(
		  unique_id int(11) NOT NULL auto_increment,
		  has_send_email text,
		  to_address text NOT NULL,
		  email_subject text,
		  email_text blob,
		  from_email_name text,
		  from_email_address text,
		  block blob NOT NULL,
		  real_order_no text NOT NULL,
		  PRIMARY KEY  (unique_id),
		  KEY idx_to_address_zen ( to_address(36) )
		) CHARACTER SET utf8 COLLATE utf8_general_ci;
		");	 
		
		
		}

   function remove() {
     global $db;
     $db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key LIKE  'MODULE_PAYMENT_95EPAY%'");
   }

   function keys() {
    return array(
         'MODULE_PAYMENT_95EPAY_STATUS',
         'MODULE_PAYMENT_95EPAY_SELLER',
         'MODULE_PAYMENT_95EPAY_MD5KEY',
         'MODULE_PAYMENT_95EPAY_ZONE',
		 'MODULE_PAYMENT_95EPAY_MONEYTYPE',
		 'MODULE_PAYMENT_95EPAY_LANGUAGE',
         'MODULE_PAYMENT_95EPAY_ORDER_STATUS_ID',
		 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID',
		 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID',
		 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID',
		 'MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_95EPAYDECLINED_ID',
         'MODULE_PAYMENT_95EPAY_SORT_ORDER',
         'MODULE_PAYMENT_95EPAY_HANDLER',
		 'MODULE_PAYMENT_95EPAY_RETRUN_URL',
		 'MODULE_PAYMENT_95EPAY_MERWEBSITE',
		 'MODULE_PAYMENT_95EPAY_REMARK'
         );
   }
 }
?>