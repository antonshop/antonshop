<?php
/**
 * checkout_result header_php.php
 *
 * @package page
 * @copyright Copyright 2003-2007 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: header_php.php 6373 2007-05-25 20:22:34Z drbyte $
 */

// This should be first line of the script:
$zco_notifier->notify('NOTIFY_HEADER_START_CHECKOUT_PAYRESULT');
$messageStack->reset();
require(DIR_WS_MODULES . zen_get_module_directory('require_languages.php'));

	$BillNo = $_POST["BillNo"];
	$Currency = $_POST["Currency"];
	$Amount = $_POST["Amount"];
	$Succeed = $_POST["Succeed"];
	$Result = $_POST["Result"];
	$MD5info = $_POST["MD5info"]; 
    $MD5key = MODULE_PAYMENT_95EPAY_MD5KEY;
    $md5src = $BillNo.$Currency.$Amount.$Succeed.$MD5key;
	$md5sign = strtoupper(md5($md5src));
	
	if($MD5info==$md5sign){
			global $db,$_SESSION;			
				$sql = "select * from 95EPAY_SESSION where real_order_no = '" . $BillNo . "'";
					$stored_session = $db->Execute($sql);
				    if ($stored_session->recordCount() < 1) {
				      die();
				    }
				$_SESSION = unserialize(base64_decode($stored_session->fields['saved_session']));
				
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
				
				
				
				$orders_query = "SELECT order_total FROM ".TABLE_ORDERS."  WHERE orders_id =".(int)$BillNo;
				 $orders = $db->Execute($orders_query);
				 $order_total = $orders->fields['order_total']; //该顾客在商户网站中的折扣后订单总金额
			     $Amount =$order_total;
			     //$Amount = number_format(($order->info['total']) * $currencies->get_value(MODULE_PAYMENT_95EPAY_MONEYTYPE), 2, '.', '');	//金额
			     //$DisAmount ==number_format(($order->info['total']) * $currencies->get_value($_SESSION['currency']), 2, '.', '').'  '.$_SESSION['currency'];								//外币金额
				 $DisAmount =number_format($Amount * ($currencies->get_value($_SESSION['currency'])), 2, '.', '').'  '.$_SESSION['currency'];
			if ($Succeed == '88'){
				$messageStack->add('checkout_payresult', '<br/>Your Order Number :'.$BillNo.'<br/>Amount:'.$DisAmount.'<br/>Payment Result:'.$Result, 'success');
				$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID, 
										'orders_date_finished' => 'now()', 
										);
			zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态
			
				$sql_data_array = array('orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_SUCCESS_ID, 
										'date_added' => 'now()',
										'customer_notified' => 1);
			zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态历史
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
					
				
				
			}
			else if ($Succeed == '0'){
					$messageStack->add('checkout_payresult', '<br/>Your Order Number :'.$BillNo.'<br/>Amount:'.$DisAmount.'<br/>Payment Result:'.$Result, 'success');
					$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID, 
										'orders_date_finished' => 'now()', 
										);
			zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态
					$sql_data_array = array('orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_FAIL_ID, 
											'date_added' => 'now()',
											'customer_notified' => 1);
					zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态历史
				
			}
			else if ($Succeed == '19'){
					$messageStack->add('checkout_payresult', '<br/>Your Order Number :'.$BillNo.'<br/>Amount:'.$DisAmount.'<br/>Payment Result:'.$Result, 'success');
					$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID, 
										'orders_date_finished' => 'now()', 
										);
			zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态
					$sql_data_array = array('orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID, 
											'date_added' => 'now()',
											'customer_notified' => 1);
					zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态历史
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
				
			}
			else if ($Succeed == '1' || $Succeed == '9'){
					$messageStack->add('checkout_payresult', '<br/>Your Order Number :'.$BillNo.'<br/>Amount:'.$DisAmount.'<br/>Payment Result:'.$Result, 'success');
					$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID, 
										'orders_date_finished' => 'now()', 
										);
			zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态
					$sql_data_array = array('orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_PROCESSING_ID, 
											'date_added' => 'now()',
											'customer_notified' => 1);
					zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态历史
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
				
				
			}
			else{
					$messageStack->add('checkout_payresult', '<br/>Your Order Number :'.$BillNo.'<br/>Amount:'.$DisAmount.'<br/>Payment Result:'.$Result.$Succeed, 'error');
					$sql_data_array = array('orders_status' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_95EPAYDECLINED_ID, 
										'orders_date_finished' => 'now()', 
										);
			zen_db_perform(TABLE_ORDERS, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态
					$sql_data_array = array('orders_status_id' => MODULE_PAYMENT_95EPAY_ORDER_STATUS_PAY_95EPAYDECLINED_ID, 
											'date_added' => 'now()');
					zen_db_perform(TABLE_ORDERS_STATUS_HISTORY, $sql_data_array, 'update', 'orders_id = ' . (int)$BillNo);//更新订单状态历史
					
					log_result ("payment result:  ".$Result."	orderNo:".$BillNo."	Amount:".$Amount.' '.MODULE_PAYMENT_95EPAY_MONEYTYPE."	responseCode:".$Succeed);
					
			}		
			
	}
	else{
		$messageStack->add('checkout_payresult', 'pay result: verification failed'.$Succeed, 'error');
		log_result ("verification failed,please check yout md5key,thank you!");
	}


	 //日志消息,把支付平台反馈的参数记录下来
	function  log_result($word) {
		$fp = fopen("95epay_pay_error_log.txt","a");	//log.txt请放在当前文件所在目录里
		flock($fp, LOCK_EX) ;
		fwrite($fp,$word."	time: ".date("Y-m-d h:i:s")."\r\n");
		flock($fp, LOCK_UN); 
		fclose($fp);
	}
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

// unregister session variables used during checkout
$_SESSION['cart']->reset(true);
//unset($_SESSION['cart']);
unset($_SESSION['cartID']);
unset($_SESSION['orders_id']);
unset($_SESSION['order_summary']);
unset($_SESSION['order_number_created']);
unset($_SESSION['sendto']);
unset($_SESSION['billto']);
unset($_SESSION['shipping']);
unset($_SESSION['payment']);
unset($_SESSION['comments']); 
?>