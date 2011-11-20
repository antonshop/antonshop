<?php
class _ecpss {
	//
	var $code, $title, $description, $enabled, $sort_order, $form_action_url;
	//
	var $order_pending_status = 1;
	//
	var $order_status = 5;
	var $order_id, $Amount;
	//ecpss支付状态
	var $pay_status=array(array('1'=>"No Payment",'2'=>"未支付"),array('1'=>"Payment Declined",'2'=>"支付失败"));

	function _ecpss() {
		global $order;
		$this->refrech_status = 0;
		$this->code = '_ecpss';
		if ($_GET['main_page'] != '') {
			$this->title = MODULE_PAYMENT_ECPSS_TEXT_CATALOG_TITLE;

		} else {
			$this->title = MODULE_PAYMENT_ECPSS_TEXT_ADMIN_TITLE;
		}
		$this->description = MODULE_PAYMENT_ECPSS_TEXT_DESCRIPTION;
		$this->sort_order = MODULE_PAYMENT_ECPSS_SOTR_ORDER;
		$this->enabled = ((MODULE_PAYMENT_ECPSS_STATUS == 'True') ? true : false);
//		if ((int) MODULE_PAYMENT_ECPSS_ORDER_STATUS_ID > 0)
//			$this->order_status = MODULE_PAYMENT_ECPSS_ORDER_STATUS_ID;
		if (is_object($order)) {
			$this->update_status();
		}
		$this->form_action_url = MODULE_PAYMENT_ECPSS_HANDLER;
	}

	function __construct() {
		$this->_ecpss();
	}
	/**
	 * 计算区域火柴和标志设置，以确定是否应显示模块的客户或不
	 */
	function update_status() {
		global $order, $db;

		if (($this->enabled == true) && ((int) MODULE_PAYMENT_ECPSS_ZONE > 0)) {
			$check_flag = false;
			$check_query = $db->Execute("select zone_id from " . TABLE_ZONES_TO_GEO_ZONES . " where geo_zone_id = '" . MODULE_PAYMENT_ECPSS_ZONE . "' and zone_country_id = '" . $order->billing['country']['id'] . "' order by zone_id");
			while (!$check_query->EOF) {
				if ($check_query->fields['zone_id'] < 1) {
					$check_flag = true;
					break;
				}
				elseif ($check_query->fields['zone_id'] == $order->billing['zone_id']) {
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

	/**
	 * JS验证它是否错误核对数据输入，如果这个模块是使用选定
	 *（数量，业主和静脉血液长度）
	 * @返回字符串
	 *
	 */
	function javascript_validation() {
		return false;
	}

	/**随着显示支付信用卡资料提交字段的方法名（如有）页上的结帐付款
	 *返回数组
	 */
	function selection() {
		return array (
			'id' => $this->code,
			'module' => MODULE_PAYMENT_ECPSS_TEXT_CATALOG_LOGO,
			'icon' => MODULE_PAYMENT_ECPSS_TEXT_CATALOG_LOGO
		);
	}
	/**pre_confirmation_check
	*通常评估验收的信用卡种类和信用卡号码和到期日期的有效性
	*(此方法在includes/modules/pages/check_confirmation/header_php.php调用)
	*/
	function pre_confirmation_check() {
		return false;
	}
	/**
	 *选择支付方式页面的继续结账按钮所调用的方法
	 *
	 */
	function confirmation($flag = '') {
		if ($flag == 'ok') {
			//生成订单
			/*
			if (isset ($_SESSION['_ecpss_order_id'])) {
				$this->delete_order($_SESSION['_ecpss_order_id']);
			}*/
			$this->create_order();
		}
	}
	/**
	 * 生成订单,及在相关表插入信息
	 */
	private function create_order() {
		global $order, $order_totals;
		$order->info['payment_method'] = MODULE_PAYMENT_ECPSS_TEXT_CATALOG_TITLE;
		$order->info['payment_module_code'] = $this->code;
		$order->info['order_status'] = $this->order_status;
//		echo $_SESSION['currency'].'<br/>';
//		echo MODULE_PAYMENT_ECPSS_MONEYTYPE;
		$order->info['currency'] = MODULE_PAYMENT_ECPSS_MONEYTYPE;
		//$order->info['currency'] = $_SESSION['currency'];
		$_SESSION['_ecpss_order_id'] = $order->create($order_totals, 2);
		//print_r($order_totals);
		$order->create_add_products($_SESSION['_ecpss_order_id']);
		/*
		try{
			$order->send_order_email($_SESSION['_ecpss_order_id'],2);
		}catch(Exception $e){

		}*/


	}
	/**
	 * 根据订单id删除订单及相关表
	 */
	private function delete_order($order_id) {
		global $db;
		$db->Execute("delete from " . TABLE_ORDERS . " where orders_id = '" . (int) $order_id . "'");
		$db->Execute("delete from " . TABLE_ORDERS_PRODUCTS . "
				                  where orders_id = '" . (int) $order_id . "'");

		$db->Execute("delete from " . TABLE_ORDERS_PRODUCTS_ATTRIBUTES . "
				                  where orders_id = '" . (int) $order_id . "'");

		$db->Execute("delete from " . TABLE_ORDERS_STATUS_HISTORY . "
						                  where orders_id = '" . (int) $order_id . "'");

		$db->Execute("delete from " . TABLE_ORDERS_TOTAL . "
						                  where orders_id = '" . (int) $order_id . "'");
	}

	/**根据订单id修改订单表、订单总额表、订单历史记录表的信息
	 *
	 */
	function update_order($order_id) {
		global $order, $order_totals;

	}

	/**
	 **建立数据处理和行动时的“提交”按钮，在订单确认屏幕的压力。
	 *此发送数据进行处理支付网关。
	 *（这是隐藏在结账确认页字段）
	 */
	function process_button() {
		$this->confirmation("ok");
		global $order, $currencies, $order_totals;

		//*/
		$customer=$order->customer;
		$billing=$order->billing;
		//账单人姓
		$FirstName=empty($billing['firstname'])?$customer['firstname']:$billing['firstname'];
		//账单人名
		$LastName=empty($billing['lastname'])?$customer['lastname']:$billing['lastname'];
		//账单人email
		$Email=$customer['email_address'];
		//账单人电话
		$Phone=$customer['telephone'];
		//账单人邮编
		$ZipCode=empty($billing['postcode'])?$customer['postcode']:$billing['postcode'];
		//账单地址
		$Address=empty($billing['street_address'])?$customer['street_address']:$billing['street_address'];
		//账单人城市
		$City=empty($billing['city'])?$customer['city']:$billing['city'];
		//账单人省或州
		$State=empty($billing['state'])?$customer['state']:$billing['state'];

		$delivery=$order->delivery;
		//收货人姓
		$DeliveryFirstName=empty($delivery['firstname'])?$FirstName:$delivery['firstname'];
		//收货人名
		$DeliveryLastName=empty($delivery['lastname'])?$LastName:$delivery['lastname'];
		//收货人email
		$DeliveryEmail=empty($delivery['email_address'])?$Email:$delivery['email_address'];
		//收货人电话
		$DeliveryPhone=empty($delivery['telephone'])?$Phone:$delivery['telephone'];
		//收货人邮编
		$DeliveryZipCode=empty($delivery['postcode'])?$ZipCode:$delivery['postcode'];
		//收货人地址
		$DeliveryAddress=empty($delivery['street_address'])?$Address:$delivery['street_address'];
		//收货人城市
		$DeliveryCity=empty($delivery['city'])?$City:$delivery['city'];
		//收货人省或州
		$DeliveryState=empty($delivery['state'])?$State:$delivery['state'];
		//收货人国家
		$DeliveryCountry=empty($delivery['country']['title'])?empty($billing['country']['title'])?$customer['country']['title']:$billing['country']['title']:$delivery['country']['title'];
		//物品信息
		for ($i=0; $i<sizeof($order->products); $i++) {
       		 $prouductsinfo = $OrderDesc.$order->products[$i]["qty"] . ' x ' . $order->products[$i]["name"];
     	}

		//商户号
		$MerNo = MODULE_PAYMENT_ECPSS_SELLER;
		//订单号(商户网站生成的订单号)
		$BillNo = $_SESSION['_ecpss_order_id'];

		//支付成功，返回信息显示用户支付金额
		//echo "大小:".count($order_totals);
		$_SESSION['CustomerAmount']=$order_totals[count($order_totals)-1]['text'];

		//交易金额
		$Amount = number_format(($order->info['total']) * $currencies->get_value(MODULE_PAYMENT_ECPSS_MONEYTYPE), 2, '.', '');
		   //$Amount = number_format(($order->info['total']) * $currencies->get_value($my_currency), 2, '.', '');
		//$Amount = $order_totals[count($order_totals) - 1]['value'];

		//商户密匙
		$MD5key = MODULE_PAYMENT_ECPSS_MD5KEY;
		//币种(只接受1代表USD)
		if (MODULE_PAYMENT_ECPSS_MONEYTYPE == 'USD') {
			$Currency = '1';
		} else if(MODULE_PAYMENT_ECPSS_MONEYTYPE == 'EUR'){
			$Currency = '2';
		}else if(MODULE_PAYMENT_ECPSS_MONEYTYPE == 'GBP'){
			$Currency = '4';
		}else if(MODULE_PAYMENT_ECPSS_MONEYTYPE == 'CNY'){
			$Currency = '3';
		}
		else{
			$Currency = '0';
		}
		//语言
		$Language = MODULE_PAYMENT_ECPSS_LANGUAGE;
		//返回地址
		$ReturnURL = MODULE_PAYMENT_ECPSS_RETURN_URL;
		//商户网站首页地址
		$Remark = HTTP_SERVER;
		//组合加密项
		$MD5src = $MerNo . $BillNo . $Currency . $Amount . $Language . $ReturnURL . $MD5key;
		//echo $MD5src;
		//加密组合项
		$MD5info = strtoupper(md5($MD5src));
		//订单备注
		$OrderDesc = '';
		$process_button_string = zen_draw_hidden_field('MerNo', $MerNo) .
		zen_draw_hidden_field('BillNo', $BillNo) .
		zen_draw_hidden_field('Amount', $Amount) .
		zen_draw_hidden_field('DispAmount', $Amount) .
		zen_draw_hidden_field('Currency', $Currency) .
		zen_draw_hidden_field('Language', $Language) .
		zen_draw_hidden_field('MD5info', $MD5info) .
		zen_draw_hidden_field('ReturnURL', $ReturnURL) .
		zen_draw_hidden_field('OrderDesc', $OrderDesc) .
		zen_draw_hidden_field('Remark', $Remark).
		zen_draw_hidden_field('firstname', $FirstName) .
		zen_draw_hidden_field('lastname', $LastName) .
		zen_draw_hidden_field('email', $Email) .
		zen_draw_hidden_field('phone', $Phone) .
		zen_draw_hidden_field('zipcode', $ZipCode) .
		zen_draw_hidden_field('address', $Address) .
		zen_draw_hidden_field('city', $City) .
		zen_draw_hidden_field('state', $State).
		zen_draw_hidden_field('country', $order->customer['country']['title']) .
		 
		zen_draw_hidden_field('shippingFirstName', $DeliveryFirstName) .
		zen_draw_hidden_field('shippingLastName', $DeliveryLastName) .
		zen_draw_hidden_field('shippingEmail', $DeliveryEmail) .
		zen_draw_hidden_field('shippingPhone', $DeliveryPhone) .
		zen_draw_hidden_field('shippingZipcode', $DeliveryZipCode) .
		zen_draw_hidden_field('shippingAddress', $DeliveryAddress) .
		zen_draw_hidden_field('shippingCity', $DeliveryCity) .
		zen_draw_hidden_field('shippingSstate', $DeliveryState).
		zen_draw_hidden_field('shippingCountry', $DeliveryCountry).
		zen_draw_hidden_field('products', $prouductsinfo);

		echo $process_button_string;
	}
	/**生成订单后执行的方法(第二执行方法)
	 *
	 *(这个方法在includes/modules/checkout_process.php页面调用)
	 */
	function after_order_create($insert_id) {

	}

	/**提交到支付页面首先调用的方法(第一执行方法)
	 *存储交易信息的秩序和进程的任何结果，来自支付网关回
	 *(这个方法在includes/modules/checkout_process.php页面调用)
	 */
	function before_process() {
		global $_POST, $order, $currencies, $messageStack;

		//订单实际支付金额
		$Amount = $_POST["Amount"];
		//订单实际支付币种
		$Currency = $_POST["Currency"];

		if (MODULE_PAYMENT_ECPSS_MONEYTYPE == 'USD') {
			$Currency = '1';
		} else if(MODULE_PAYMENT_ECPSS_MONEYTYPE == 'EUR'){
			$Currency = '2';
		}else if(MODULE_PAYMENT_ECPSS_MONEYTYPE == 'GBP'){
			$Currency = '4';
		}else if(MODULE_PAYMENT_ECPSS_MONEYTYPE == 'CNY'){
			$Currency = '3';
		}
		else{
			$Currency = '0';
		}


		$Amount_1 = number_format(($order->info['total']) * $currencies->get_value(MODULE_PAYMENT_ECPSS_MONEYTYPE), 2, '.', ''); //金额
		if (($Amount == $Amount_1) && ($Currency == $Currency_1)) {
			//用于写入Zen Cart后台订单历史记录中的数据
			$this->Amount = $Amount;
			return true; //订单成功
		} else {
			$messageStack->add_session('checkout_payment', 'Does not match the amount of.', 'error');
			zen_redirect(zen_href_link(FILENAME_CHECKOUT_PAYMENT, '', 'SSL', true, false));
		}

	}

	/**(第三执行的方法)
	 **后处理活动
	 *当从处理器订单的回报，如果秒是成功的，这家以成果地位的历史，并记录为今后参考的数据
	 * @返回布尔
	 */
	function after_process() {

		return false;
	}

	/**
	*检查引荐
	*zf_domain
	* @帕拉姆字符串$
	* @返回布尔
	*/
	function check_referrer($zf_domain) {
		return true;
	}

	/**
	**建设管理页组件
	* @帕拉姆廉政$ zf_order_id
	* @返回字符串
	  */
	function admin_notification($zf_order_id) {

	}

	/**
	 *用于显示错误信息的详细 
	 * @返回布尔
	 */
	function output_error() {
		return false;
	}

	/**安装模块
	 *
	 */
	function install() {
		global $db, $language, $module_type;
		if (!defined('MODULE_PAYMENT_ECPSS_TEXT_CONFIG_1_1')) {
			include (DIR_FS_CATALOG_LANGUAGES . $_SESSION['language'] . '/modules/' . $module_type . '/' . $this->code . '.php');
		}
		
		//支付地址(正式)
		$action_URL="https://security.sslepay.com/sslpayment";

//		SELECT max( `orders_status_id` ) FROM orders_status;
		$obj=$db->Execute("SELECT max( `orders_status_id` ) as maxid FROM ".TABLE_ORDERS_STATUS);
		$maxid=(int)$obj->fields['maxid'];
		$this->order_status = $maxid+1;
		foreach($this->pay_status as $val){
			$maxid++;
			$index=1;
			foreach($val as $val1){
				$db->Execute("insert into ".TABLE_ORDERS_STATUS."(orders_status_id,language_id,orders_status_name) values(".$maxid.",".$index.",'".$val1."')");
				$index++;
			}
			//$db->Execute("insert into ".TABLE_ORDERS_STATUS."(orders_status_id,language_id,orders_status_name) values(".$maxid.",".$index.",'".$val1."')");

		}
		//$db->Execute("insert into ".TABLE_ORDERS_STATUS."(orders_status_id,language_id,orders_status_name) values(5,1,'No Payment(ecpss)')");
		//$db->Execute("insert into ".TABLE_ORDERS_STATUS."(orders_status_id,language_id,orders_status_name) values(5,2,'未支付')");

		//模块安装状态
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,set_function,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_1_1 . "','MODULE_PAYMENT_ECPSS_STATUS','True','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_1_2 . "','6','0','zen_cfg_select_option(array(\'True\', \'False\'), ',now())");
		//商户编号
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_2_1 . "','MODULE_PAYMENT_ECPSS_SELLER','1002','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_2_2 . "','6','2',now())");
		//md5key
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_3_1 . "','MODULE_PAYMENT_ECPSS_MD5KEY','12345678','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_3_2 . "','6','4',now())");
		//币种
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,set_function,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_4_1 . "','MODULE_PAYMENT_ECPSS_MONEYTYPE','USD','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_4_2 . "','6','6','zen_cfg_select_option(array(\'USD\', \'EUR\',\'CNY\',\'GBP\'), ',now())");
		//语言
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,set_function,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_5_1 . "','MODULE_PAYMENT_ECPSS_LANGUAGE','2','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_5_2 . "','6','6','zen_cfg_select_option(array(\'1\', \'2\', \'3\',\'4\',\'5\'), ',now())");
		//区域
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,use_function,set_function,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_6_1 . "','MODULE_PAYMENT_ECPSS_ZONE','0','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_6_2 . "','6','6','zen_get_zone_class_title','zen_cfg_pull_down_zone_classes(',now())");
		//订单状态描述
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,set_function,use_function,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_7_1 . "','MODULE_PAYMENT_ECPSS_ORDER_STATUS_ID','1','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_7_2 . "','6','8','zen_cfg_pull_down_order_statuses(','zen_get_order_status_name',now())");
		//订单完成状态描述
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,set_function,use_function,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_11_1 . "','MODULE_PAYMENT_ECPSS_ORDER_STATUS_FILISHED_ID','2','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_11_2 . "','6','8','zen_cfg_pull_down_order_statuses(','zen_get_order_status_name',now())");
		//排序
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_8_1 . "','MODULE_PAYMENT_ECPSS_SOTR_ORDER','0','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_8_2 . "','6','10',now())");
		//支付接口
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_9_1 . "','MODULE_PAYMENT_ECPSS_HANDLER','".$action_URL."','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_9_2 . "','6','12',now())");
		//返回地址
		$db->Execute("insert into " . TABLE_CONFIGURATION .
		"(configuration_title,configuration_key,configuration_value," .
		"configuration_description,configuration_group_id,sort_order,date_added" .
		") values('" . MODULE_PAYMENT_ECPSS_TEXT_CONFIG_10_1 . "','MODULE_PAYMENT_ECPSS_RETURN_URL','" . HTTP_SERVER .DIR_WS_CATALOG. "index.php?main_page=checkout_payresult','" .
		MODULE_PAYMENT_ECPSS_TEXT_CONFIG_10_2 . "','6','12',now())");

	}

	/**卸载模块
	 *
	 */
	function remove() {
		global $db;
		$db->Execute("delete from " . TABLE_CONFIGURATION . " where configuration_key like 'MODULE_PAYMENT_ECPSS%'");
		//$db->Execute("delete from ".TABLE_ORDERS_STATUS." where ");
		foreach($this->pay_status as $val){
			foreach($val as $val1){
				$db->Execute("delete from ".TABLE_ORDERS_STATUS." where orders_status_name='".$val1."'");
			}
		}
	}

	/**检查是否已安装return 0 or 1
	 *
	 */
	function check() {
		global $db;
		if (!isset ($this->_check)) {
			$check_query = $db->Execute("select configuration_value from " . TABLE_CONFIGURATION . " where configuration_key = 'MODULE_PAYMENT_ECPSS_STATUS'");
			$this->_check = $check_query->RecordCount();
		}
		return $this->_check;
	}
	/**设置安装模块的coufiguration_key信息
	 *(*内部配置项列表的模块的配置使用
	 *@返回数组)
	 */
	function keys() {
		return array (
			'MODULE_PAYMENT_ECPSS_STATUS', //模块状态
			'MODULE_PAYMENT_ECPSS_SELLER', //商户账号
			'MODULE_PAYMENT_ECPSS_MD5KEY', //md5key
			'MODULE_PAYMENT_ECPSS_MONEYTYPE', //币种
			'MODULE_PAYMENT_ECPSS_ZONE', //区域
			'MODULE_PAYMENT_ECPSS_LANGUAGE', //语言
			'MODULE_PAYMENT_ECPSS_ORDER_STATUS_ID', //订单状态id
			'MODULE_PAYMENT_ECPSS_ORDER_STATUS_FILISHED_ID', //订单完成状态
			'MODULE_PAYMENT_ECPSS_SOTR_ORDER', //排序
			'MODULE_PAYMENT_ECPSS_HANDLER', //支付地址
			'MODULE_PAYMENT_ECPSS_RETURN_URL' //返回地址


		);
	}

}
?>
