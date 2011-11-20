<?php
/**
 *
 */
if (isset ($zco_notifie))
	$zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_PAYRESULT');
//重置通知
$messageStack->reset();
require (DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));



////////////////////////////////////////////////////////////////////

//获得接口返回数据
$BillNo = $_POST['BillNo'];
$Currency = $_POST['Currency'];
$Amount = $_POST['Amount'];
$Succeed = $_POST['Succeed'];
$Result = $_POST['Result'];
$MD5info = $_POST['MD5info'];
$MD5key = MODULE_PAYMENT_ECPSS_MD5KEY;
$md5src = $BillNo . $Currency . $Amount . $Succeed . $MD5key;
$md5sign = strtoupper(md5($md5src));

//支付失败状态
$payment_declined=6;

//echo "<br/>md5sign:".$md5sign;
//基本验证
if ($MD5info == $md5sign) {
	//echo "<br/>md5sign:".$md5sign;
	if ($Currency == '1')
		$Currency = 'USD';
	else if($Currency=='2'){
		$Currency = 'EUR';
	}else if($Currency=='4'){
		$Currency = 'GBP';
	}else if($Currency=='3'){
		$Currency = 'CNY';
	}else{

	}
/*
	$orders_query = "SELECT * FROM " . TABLE_ORDERS . "
																					 WHERE customers_id = :customersID
																					 ORDER BY date_purchased DESC LIMIT 1";
	$orders_query = $db->bindVars($orders_query, ':customersID', $_SESSION['customer_id'], 'integer');
	$orders = $db->Execute($orders_query);
	$orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
	$curr = $orders->fields['currency']; //该订单的币种
	$orders_total = $orders->fields['order_total']; //该订单的总金额

	//判断用户最后一张订单是否是当前所支付的订单
	if ($orders_id == $BillNo && trim($curr) == $Currency && $Amount == $orders_total) {
*/
		//是否成功支付'88''19''1''9'表示支付成功
		if ($Succeed == '88' || $Succeed == '19' || $Succeed == '1' || $Succeed == '9') {
			$messageStack->add('checkout_payresult', '<br/>Your Order Number :' . $BillNo . '<br/>Amount:' . $_SESSION['CustomerAmount'] ." ".$_SESSION['currency'].'<br/>Payment Result:' . $Result, 'success');
			
			if($Succeed == '88'){
				$statebyecpss=MODULE_PAYMENT_ECPSS_ORDER_STATUS_FILISHED_ID;
			}else{
				$statebyecpss=MODULE_PAYMENT_ECPSS_ORDER_STATUS_ID;
			}

			$sql_data_array = array (
				'orders_status_id' => $statebyecpss,
				'date_added' => 'now()',
				'customer_notified' => 1
			);
			$sql_data_order=array(
				'orders_status'=>$statebyecpss
			);

			zen_db_perform(TABLE_ORDERS, $sql_data_order, 'update', 'orders_id=' . (int) $BillNo);
			//修改订单状态
			zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id=' . (int) $BillNo);	
			

			//重置购物车
			$_SESSION['cart']->reset(true);

			//清空订单id记录
			unset ($_SESSION['_ecpss_order_id']);
			unset ($_SESSION['sendto']);
			unset ($_SESSION['billto']);
			unset ($_SESSION['shipping']);
			unset ($_SESSION['payment']);
			unset ($_SESSION['comments']);
			//echo "end";
		} else {
			$messageStack->add('checkout_payresult', '<br/>Payment Result:' . $Result);

			$sql_data_array = array (
				'orders_status_id' => $payment_declined,
				'date_added' => 'now()',
				'customer_notified' => 0
			);
			$sql_data_order=array(
				'orders_status'=>$payment_declined
			);

			zen_db_perform(TABLE_ORDERS, $sql_data_order, 'update', 'orders_id=' . (int) $BillNo);

			//修改订单状态
			zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id=' . (int) $BillNo);

		}
} else {
	$messageStack->add('checkout_payresult', 'Pay result:verification failed');

	$sql_data_array = array (
				'orders_status_id' => $payment_declined,
				'date_added' => 'now()',
				'customer_notified' => 0
			);
	$sql_data_order=array(
				'orders_status'=>$payment_declined
			);

	zen_db_perform(TABLE_ORDERS, $sql_data_order, 'update', 'orders_id=' . (int) $BillNo);
	//修改订单状态
	zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id=' . (int) $BillNo);

}
?>
