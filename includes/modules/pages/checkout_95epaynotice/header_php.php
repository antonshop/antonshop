<?
// $db->Execute("update ".TABLE_ORDERS." set
// orders_status=".MODULE_PAYMENT_95EPAY_ORDER_STATUS_FILISHED_IDS.",orders_date_finished=
// now() where orders_id =".(int)$BillNo);
// exit;
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

	// 支付平台流水号
	$TradeNo=$_POST["TradeNo"];// 供商户在支付平台查询订单时使用,请合理保存
	// 订单号
	$BillNo = $_POST["BillNo"];	
	// 币种
	$Currency = $_POST["Currency"];
	// 订单金额
	$Amount = $_POST["Amount"];
	// 支付结果
	$PaymentResult = $_POST["PaymentResult"];// 交易结果: 0 : 失败；1 : 成功
	
	// 取得的MD5校验信息
	$MD5info = $_POST["MD5info"]; 
	
	// MD5私钥
	$MD5key = MODULE_PAYMENT_95EPAY_MD5KEY;
	// $MD5key = "12345678";//从支付平台获取
	// 校验源字符串
	$md5src = $TradeNo.$BillNo.$Currency.$Amount.$PaymentResult.$MD5key;
	// MD5检验结果
	$md5sign = strtoupper(md5($md5src));
	
	
	if($MD5info==$md5sign){// 验证成功
		$sql = "select * from 95EPAY_EMAIL where real_order_no = '" . $BillNo . "'";
					$stored_email = $db->Execute($sql);
				    if ($stored_email->recordCount() < 1) {
				      $send_email=false;
				    }
					else
					{
						$send_email=true;
					}
				if($send_email){
					$block = unserialize(base64_decode($stored_email->fields['block']));
					$to_name=$stored_email->fields['to_name'];
					$to_address=$stored_email->fields['to_address'];
					$email_subject=$stored_email->fields['email_subject'];
					$email_text=$stored_email->fields['email_text'];
					$from_email_name=$stored_email->fields['from_email_name'];
					$from_email_address=$stored_email->fields['from_email_address'];
					$has_send_email=$stored_email->fields['has_send_email'];
				}
				
				//95EPAY_EXTRA_EMAIL
				$sql = "select * from 95EPAY_EXTRA_EMAIL where real_order_no = '" . $BillNo . "'";
					$stored_extra_email = $db->Execute($sql);
				    if ($stored_extra_email->recordCount() < 1) {
				      $send_extra_email=false;
				    }
					else{
						$send_extra_email=true;
					}
				if($send_extra_email){
					$block1 = unserialize(base64_decode($stored_extra_email->fields['block']));
					$to_address1=$stored_extra_email->fields['to_address'];
					$email_subject1=$stored_extra_email->fields['email_subject'];
					$email_text1=unserialize(base64_decode($stored_extra_email->fields['email_text']));
					$from_email_name1=$stored_extra_email->fields['from_email_name'];
					$from_email_address1=$stored_extra_email->fields['from_email_address'];
					$has_send_email1=$stored_extra_email->fields['has_send_email'];
				}
				
	
		if($PaymentResult=='1'){// 支付成功
				
				// 更新该订单对应的订单状态
				$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID,
										'orders_date_finished' => 'now()');
				zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);// 更新订单状态
				// 查看是否更新成功
				$orders_query = "SELECT * FROM " . TABLE_ORDERS . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_status = $orders->fields['orders_status']; // 该订单的状态
				

				
				// 更新历史订单状态
				$sql_data_array = array (
				'orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID,
				'date_added' => 'now()',
				'customer_notified' => 1
				);
				zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id=' . (int)$BillNo);
				// 查看是否更新成功
				$orders_query = "SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders_history = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_history_status = $orders_history->fields['orders_status_id']; // 该订单的状态

				if($orders_status==MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID && $orders_history_status==MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID){
					if($send_email){
						if($has_send_email!='1')
						{
							zen_mail($to_name, $to_address, $email_subject, $email_text, $from_email_name, $from_email_address, $block, $module='checkout');
							//zen_mail($to_name, $from_email_address, $email_subject, $email_text, $from_email_name, $from_email_address, $block, $module='checkout');
						$sql = "update 95EPAY_EMAIL set has_send_email='1'  where real_order_no = '" . $BillNo . "'";
							$stored_email = $db->Execute($sql);
						}				
					
					}
				
				if($send_extra_email){
					if($has_send_email1!='1')
					{
						zen_mail('', $to_address1, $email_subject1, $email_text1, $from_email_name1, $from_email_address1, $block1, $module='checkout_extra');
						$sql = "update 95EPAY_EXTRA_EMAIL set has_send_email='1'  where real_order_no = '" . $BillNo . "'";
							$db->Execute($sql);
					}
				}
				
					echo "payseccess_notice_success";
					log_result ("payment result:  succ	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
				}
				else{// 更新失败
					echo "payseccess_updateOrderStatus_failed";
					log_result ("payseccess_updateOrderStatus_failed		orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
				}
			
		}
		else if($PaymentResult=='0'){// 支付失败
				//查看是否处理中...
				$orders_query = "SELECT * FROM " . TABLE_ORDERS . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_status = $orders->fields['orders_status']; // 该订单的状态
				if($orders_status!=MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID)
				{
					echo "payfail_notice_success";
					exit;
				}
			
				// 更新该订单对应的订单状态
				$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID,
										'orders_date_finished' => 'now()');
				zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);// 更新订单状态
				// 查看是否更新成功
				$orders_query = "SELECT * FROM " . TABLE_ORDERS . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_status = $orders->fields['orders_status']; // 该订单的状态

				// 更新历史订单状态
				$sql_data_array = array (
				'orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID,
				'date_added' => 'now()',
				'customer_notified' => 1
				);
				zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id=' . (int)$BillNo);
				// 查看是否更新成功
				$orders_query = "SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders_history = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_history_status = $orders_history->fields['orders_status_id']; // 该订单的状态

				if($orders_status==MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID && $orders_history_status==MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID){
					echo "payfail_notice_success";
					log_result ("payment result:  fail	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
				}
				else{// 更新失败
					echo "payfail_updateOrderStatus_failed";
					log_result ("payfail_updateOrderStatus_failed	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
				}
			
				
		}
		else if($PaymentResult=='2'){// 处理中...
			
				// 更新该订单对应的订单状态
				$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID,
										'orders_date_finished' => 'now()');
				zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);// 更新订单状态
				// 查看是否更新成功
				$orders_query = "SELECT * FROM " . TABLE_ORDERS . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_status = $orders->fields['orders_status']; // 该订单的状态

				// 更新历史订单状态
				$sql_data_array = array (
				'orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID,
				'date_added' => 'now()',
				'customer_notified' => 1
				);
				zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id=' . (int)$BillNo);
				// 查看是否更新成功
				$orders_query = "SELECT * FROM " . TABLE_ORDERS_STATUS_HISTORY . " WHERE orders_id = :ordersID  LIMIT 1";
				$orders_query = $db->bindVars($orders_query, ':ordersID', $BillNo, 'integer');
				$orders_history = $db->Execute($orders_query);
				// $orders_id = $orders->fields['orders_id']; //该顾客在商户网站中的最新订单号
				$orders_history_status = $orders_history->fields['orders_status_id']; // 该订单的状态

				if($orders_status==MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID && $orders_history_status==MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID){
					if($send_email){
					if($has_send_email!='1')
					{
						zen_mail($to_name, $to_address, $email_subject, $email_text, $from_email_name, $from_email_address, $block, $module='checkout');
						//zen_mail($to_name, $from_email_address, $email_subject, $email_text, $from_email_name, $from_email_address, $block, $module='checkout');
					$sql = "update 95EPAY_EMAIL set has_send_email='1'  where real_order_no = '" . $BillNo . "'";
						$stored_email = $db->Execute($sql);
					}				
					
					}
				
				if($send_extra_email){
					if($has_send_email1!='1')
					{
						zen_mail('', $to_address1, $email_subject1, $email_text1, $from_email_name1, $from_email_address1, $block1, $module='checkout_extra');
						$sql = "update 95EPAY_EXTRA_EMAIL set has_send_email='1'  where real_order_no = '" . $BillNo . "'";
							$db->Execute($sql);
					}
				}
				
					echo "payprocess_notice_success";
					log_result ("payment result:  processing	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_EMBED95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
				}
				else{// 更新失败
					echo "payprocess_updateOrderStatus_failed";
					log_result ("payprocess_updateOrderStatus_failed	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_EMBED95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
				}
			
				
		}
		
	}
	else{// 验证失败
		echo "verification_failed";
		log_result ("verification_failed	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_95EPAY_MONEYTYPE."	95epay_tradeNo:".$TradeNo);
	}
	exit;

	// 日志消息,把支付平台反馈的参数记录下来
	function  log_result($word) {
		$fp = fopen("95epay_pay_result_notice_log.txt","a");	// log.txt请放在当前文件所在目录里
		flock($fp, LOCK_EX) ;
		fwrite($fp,$word."	time: ".date("Y-m-d h:i:s")."\r\n");
		flock($fp, LOCK_UN); 
		fclose($fp);
	}

	
?>
