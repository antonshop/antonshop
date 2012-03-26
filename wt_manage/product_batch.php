<?php
/**
 * @package product_export
 * Author Anton
 * 商品批量导入 csv
 * 
 */
 set_time_limit(0);
 ini_set('memory_limit', '-1');
//ini_set("max_execution_time", "18000");
require('includes/application_top.php');
//csv文件夹
$csvdir = DIR_FS_CATALOG . 'temp_csvfiles/';

$action = isset($_GET['action']) ? $_GET['action'] : '';
if($action == 'export'){
	$filename = isset($_POST['filename']) ? $_POST['filename'] : '';
	$charset = isset($_POST['charset']) ? $_POST['charset'] : '';
	
	if($filename && $charset){
		require('includes/classes/phpzip.php');
		$zip = new PHPZip;
		
		$sql = "select p.*, pd.*, mate.*
			  from " . TABLE_PRODUCTS . " p, " .
					   TABLE_PRODUCTS_DESCRIPTION . " pd, " .
					   TABLE_META_TAGS_PRODUCTS_DESCRIPTION . " mate 
			  where    p.products_id = pd.products_id AND mate.products_id = p.products_id";
		$product_info = $db->Execute($sql);
		
		$replace_foundarr = array("\r",'"',"\n");
		$replace_arr = array("",'""',"");
		/* 导出内容 */
		$product_arr = array(
			'products_id' => 0,
			'products_type' => 0,
			'products_quantity' => '""',
			'products_model' => '""',
			'products_image' => '""',
			'products_price' => 0,
			'products_virtual' => 0,
			'products_date_added' => 0,
			'products_last_modified' => 0,
			'products_date_available' => 0,
			'products_weight' => 0,
			'products_status' => 0,
			'products_tax_class_id ' => 0,
			'manufacturers_id ' => 0,
			'products_ordered' => 0,
			'products_quantity_order_min' => 0,
			'products_quantity_order_units' => 0,
			'products_priced_by_attribute' => 0,
			'product_is_free ' => 0,
			'product_is_call' => 0,
			'products_quantity_mixed' => 0,
			'product_is_always_free_shipping' => 0,
			'products_qty_box_status' => 0,
			'products_quantity_order_max' => 0,
			'products_sort_order ' => 0,
			'products_discount_type' => 0,
			'products_discount_type_from' => 0,
			'products_price_sorter' => 0,
			'master_categories_id' => 0,
			'products_mixed_discount_quantity' => 0,
			'metatags_title_status' => 0,
			'metatags_products_name_status' => 0,
			'metatags_model_status' => 0,
			'metatags_price_status' => 0,
			'metatags_title_tagline_status' => 0,
			'language_id' => 0,
			'products_name' => '""',
			'products_description' => '""',
			'products_url' => '""',
			'products_viewed' => 0,
			'metatags_title' => '""',
			'metatags_keywords' => '""',
			'metatags_description' => '""'
		);
		
		$content = '"' . implode('","', array_keys($product_arr)) . "\"\n";
		//while($row = mysql_fetch_array($product_info->resource)){
			$i = 0;
		while(!$product_info->EOF){
			$i++;
			//echo $row['products_id']."<br>";
			$row = $product_info->fields;	
			$product_arr['products_id'] = '"' . $row['products_id'] . '"';
			$product_arr['products_type'] = '"' . $row['products_type'] . '"';
			$product_arr['products_quantity'] = '"' . $row['products_quantity'] . '"';
			$product_arr['products_model'] = '"' . $row['products_model'] . '"';
			$product_arr['products_image'] = '"' . $row['products_image'] . '"';
			$product_arr['products_price'] = '"' . $row['products_price'] . '"';
			$product_arr['products_virtual'] = '"' . $row['products_virtual'] . '"';
			$product_arr['products_date_added'] = '"' . $row['products_date_added'] . '"';
			$product_arr['products_last_modified'] = '"' . $row['products_last_modified'] . '"';
			$product_arr['products_date_available'] = '"' . $row['products_date_available'] . '"';
			$product_arr['products_weight'] = '"' . $row['products_weight'] . '"';
			$product_arr['products_status'] = '"' . $row['products_status'] . '"';
			$product_arr['products_tax_class_id'] = '"' . $row['products_tax_class_id'] . '"';
			$product_arr['manufacturers_id'] = '"' . $row['manufacturers_id'] . '"';
			$product_arr['products_ordered'] = '"' . $row['products_ordered'] . '"';
			$product_arr['products_quantity_order_min'] = '"' . $row['products_quantity_order_min'] . '"';
			$product_arr['products_quantity_order_units'] = '"' . $row['products_quantity_order_units'] . '"';
			$product_arr['products_priced_by_attribute'] = '"' . $row['products_priced_by_attribute'] . '"';
			$product_arr['product_is_free '] = '"' . $row['product_is_free '] . '"';
			$product_arr['product_is_call'] = '"' . $row['product_is_call'] . '"';
			$product_arr['products_quantity_mixed'] = '"' . $row['products_quantity_mixed'] . '"';
			$product_arr['product_is_always_free_shipping'] = '"' . $row['product_is_always_free_shipping'] . '"';
			$product_arr['products_qty_box_status'] = '"' . $row['products_qty_box_status'] . '"';
			$product_arr['products_quantity_order_max'] = '"' . $row['products_quantity_order_max'] . '"';
			$product_arr['products_sort_order '] = '"' . $row['products_sort_order '] . '"';
			$product_arr['products_discount_type'] = '"' . $row['products_discount_type'] . '"';
			$product_arr['products_discount_type_from'] = '"' . $row['products_discount_type_from'] . '"';
			$product_arr['products_price_sorter'] = '"' . $row['products_price_sorter'] . '"';
			$product_arr['master_categories_id'] = '"' . $row['master_categories_id'] . '"';
			$product_arr['products_mixed_discount_quantity'] = '"' . $row['products_mixed_discount_quantity'] . '"';
			$product_arr['metatags_title_status'] = '"' . $row['metatags_title_status'] . '"';
			$product_arr['metatags_products_name_status'] = '"' . $row['metatags_products_name_status'] . '"';
			$product_arr['metatags_model_status'] = '"' . $row['metatags_model_status'] . '"';
			$product_arr['metatags_price_status'] = '"' . $row['metatags_price_status'] . '"';
			$product_arr['metatags_title_tagline_status'] = '"' . $row['metatags_title_tagline_status'] . '"';
			$product_arr['language_id'] = '"' . $row['language_id'] . '"';
			$product_arr['products_name'] = '"' . str_replace($replace_foundarr,$replace_arr,"{$row['products_name']}") . '"';
			$product_arr['products_description'] = '"' . str_replace($replace_foundarr,$replace_arr,"{$row['products_description']}") . '"';
			$product_arr['products_url'] = '"' . $row['products_url'] . '"';
			$product_arr['products_viewed'] = '"' . $row['products_viewed'] . '"';
			$product_arr['metatags_title'] = '"' . $row['metatags_title'] . '"';
			$product_arr['metatags_keywords'] = '"' . $row['metatags_keywords'] . '"';
			$product_arr['metatags_description'] = '"' . $row['metatags_description'] . '"';
	
			$content .= implode(",", $product_arr) . "\n";
			
			/* 压缩图片 */
			$img = explode(",", $row['products_image']);
			if(is_array($img)){
				foreach($img as $item){
					if (!empty($item) && is_file(DIR_FS_CATALOG . DIR_WS_IMAGES . $item))
					{
						$zip->add_file(file_get_contents(DIR_FS_CATALOG . DIR_WS_IMAGES . $item), $item);
					}
				}
			}
			$product_info->MoveNext();
			//print_r($product_info);
			//if($i>300)exit;
		}
		$charset = empty($charset) ? 'utf-8' : trim($charset);
		$content = iconv('utf-8', $charset, $content);
		$zip->add_file($content, $filename.'.csv');
	
		header("Content-Disposition: attachment; filename=". $filename .".zip");
		header("Content-Type: application/unknown");
		die($zip->file());
	}
}else if($action == 'import'){
	$charset = isset($_POST['charset']) ? $_POST['charset'] : '';
	$csvfilename = isset($_POST['csvfilename']) ? $_POST['csvfilename'] : '';
	class arrayiconv
	{
		static protected $in;
		static protected $out;
		/**
		  * 静态方法,该方法输入数组并返回数组
		  * @param unknown_type $array 输入的数组
		  * @param unknown_type $in 输入数组的编码
		  * @param unknown_type $out 返回数组的编码
		  * @return unknown 返回的数组
		  */
		static public function Conversion($array,$in,$out){
		  self::$in=$in;
		  self::$out=$out;
		  return self::arraymyicov($array);
		}
		/**
		  * 内部方法,循环数组
		  * @param unknown_type $array
		  * @return unknown
		  */
		static private function arraymyicov($array){
		  foreach ($array as $key=>$value){
		   $key=self::myiconv($key);
		   if (!is_array($value)) {
			$value=self::myiconv($value);
		   }else {
			$value=self::arraymyicov($value);
		   }
		   $temparray[$key]=$value;
		  }
		  return $temparray;
		}
		/**
		  * 替换数组编码
		  *
		  * @param unknown_type $str
		  * @return unknown
		  */
		static private function myiconv($str){
			if(self::$in==self::$out){
				return $str;
			}else{
				return iconv(self::$in,self::$out,$str);
			}
		}
	}

	if($_POST['import']){
		
		//取得上传的csv文件
		if($csvfilename) {
			$res = fopen($csvdir . $csvfilename,"r");
		} else {
			$res = fopen($_FILES['filename']['tmp_name'],"r");
		}
		//echo $csvfilename .'xxx';
		//exit;
		while ($arr2 = fgetcsv($res)) {
			$arr[]=$arr2;
		}
		array_shift($arr);
		$arrobj = new arrayiconv();
		$arr = $arrobj->Conversion($arr,$charset,"utf-8");
		foreach($arr as $item){
			$product_info=array(
				//'products_id'=>'',
				'products_type' 			=> $item[1],
				'products_quantity' 		=> $item[2],
				'products_model' 			=> $item[3],
				'products_image' 			=> $item[4],
				'products_price' 			=> $item[5],
				'products_virtual' 			=> $item[6],
				'products_date_added' 		=> $item[7],
				'products_last_modified'	=> $item[8],
				'products_date_available' 	=> $item[9],
				'products_weight' 			=> $item[10],
				'products_status' 			=> $item[11],
				'products_tax_class_id ' 	=> $item[12],
				'manufacturers_id ' 		=> $item[13],
				'products_ordered' 			=> $item[14],
				'products_quantity_order_min' => $item[15],
				'products_quantity_order_units' => $item[16],
				'products_priced_by_attribute' => $item[17],
				'product_is_free ' 			=> $item[18],
				'product_is_call' 			=> $item[19],
				'products_quantity_mixed' 	=> $item[20],
				'product_is_always_free_shipping' => $item[21],
				'products_qty_box_status' 	=> $item[22],
				'products_quantity_order_max' => $item[23],
				'products_sort_order ' 		=> $item[24],
				'products_discount_type' 	=> $item[25],
				'products_discount_type_from' => $item[26],
				'products_price_sorter' 	=> $item[27],
				'master_categories_id'		=> $item[28],
				'products_mixed_discount_quantity' => $item[29],
				'metatags_title_status' 	=> $item[30],
				'metatags_products_name_status' => $item[31],
				'metatags_model_status' 	=> $item[32],
				'metatags_price_status' 	=> $item[33],
				'metatags_title_tagline_status' => $item[34]
				
			);

			zen_db_perform(TABLE_PRODUCTS, $product_info);
			$insert_id = $db->Insert_ID();
			
			
			$product_desc = array(
				'products_id' => $insert_id,
				'language_id' => $item[35],
				'products_name' => $item[36],
				'products_description' => $item[37],
				'products_url' => $item[38],
				'products_viewed' => $item[39]
			);
			$insert_desc = zen_db_perform(TABLE_PRODUCTS_DESCRIPTION, $product_desc);
			
			$products_to_categories = array(
				'products_id' => $insert_id,
				'categories_id' => $product_info['master_categories_id']
			);
			$insert_ptoc = zen_db_perform(TABLE_PRODUCTS_TO_CATEGORIES, $products_to_categories);
			$products_mate = array(
				'products_id' => $insert_id,
				'language_id' => $product_desc['language_id'],
				'metatags_title' => $item[40],
				'metatags_keywords' => $item[41],
				'metatags_description' => $item[42],
			);
			$insert_mate = zen_db_perform(TABLE_META_TAGS_PRODUCTS_DESCRIPTION, $products_mate);
			//$desc_insert_id = $db->Insert_ID();
			//var_dump($insert_desc);
			//echo "<br>***".$insert_id."<br>***". $insert_desc . '<br>***' . $insert_ptoc;
			//print_r($product_info);exit;
		}
		if($insert_id && $insert_desc && $insert_ptoc && $insert_mate){
			$messageStack->add_session('导入成功', 'success');
			zen_redirect(zen_href_link('product_batch'));	
		} else {
			$messageStack->acc_session('导入失败', 'error');
			zen_redirect(zen_href_link('product_batch'));
		}
	}
	/* export magento style */
} else if ($action == 'export_tomagento') {
	$filename = isset($_POST['filename']) ? $_POST['filename'] : '';
	$charset = isset($_POST['charset']) ? $_POST['charset'] : '';
	
	if($filename && $charset){
		require('includes/classes/phpzip.php');
		$zip = new PHPZip;
		
		$sql = "select p.*, pd.*, mate.*
			  from " . TABLE_PRODUCTS . " p, " .
					   TABLE_PRODUCTS_DESCRIPTION . " pd, " .
					   TABLE_META_TAGS_PRODUCTS_DESCRIPTION . " mate 
			  where    p.products_id = pd.products_id AND mate.products_id = p.products_id";
		$product_info = $db->Execute($sql);
		
		$replace_foundarr = array("\r",'"',"\n");
		$replace_arr = array("",'""',"");
		/* 导出内容 */
		$product_arr = array(
			'websites' => '',
			'store' => '',
			'attribute_set' => '',
			'type' => '',
			'name' => '',
			'categories' => '',
			'sku' => '',
			'status' => '',
			'visibility' => '',
			'price' => 0,
			'short_description' => '"',
			'description ' => '',
			'weight ' => 0,
			'is_in_stock' => 0,
			'manage_stock' => 0,
			'qty' => 0,
			'tax_class_id' => '',
			'has_options ' => 0,
			'size:drop_down:1' => '',
			'image' => '',
			'small_image' => '',
			'thumbnail' => '',
			'gallery' => '',
			'meta_title ' => '',
			'meta_keyword' => '',
			'meta_description' => '',
		);
		
		$content = '"' . implode('","', array_keys($product_arr)) . "\"\n";
		//while($row = mysql_fetch_array($product_info->resource)){
			$i = 0;
		while(!$product_info->EOF){
			$i++;
			//echo $row['products_id']."<br>";
			$row = $product_info->fields;	
			$product_arr['websites'] 		= 'base';
			$product_arr['store'] 			= 'admin';
			$product_arr['attribute_set'] 	= 'Default';
			$product_arr['type'] 			= 'simple';
			$product_arr['name']			= '"' . $row['products_name'] . '"';
			$product_arr['categories'] 		= '';
			$product_arr['sku'] 			= '"' . strtolower(str_replace(" ", '-', $row['products_name'])) . '"';
			$product_arr['status'] 			= 'Enabled';
			$product_arr['visibility'] 		= 'Catalog, Search';
			$product_arr['price'] 			='"' . $row['products_price'] . '"';
			$product_arr['short_description'] 	= '"' . substr(str_replace($replace_foundarr,$replace_arr,"{$row['products_description']}"), 0, 30) . '"';
			$product_arr['description'] 	= '"' . str_replace($replace_foundarr,$replace_arr,"{$row['products_description']}") . '"';
			$product_arr['weight'] 			= '"' . $row['products_weight'] . '"';
			$product_arr['is_in_stock'] 	= '';
			$product_arr['manage_stock'] 	= '0';
			$product_arr['qty'] 			= '"' . $row['products_quantity'] . '"';
			$product_arr['tax_class_id'] 	= 'None';
			$product_arr['has_options'] 	= '';
			$product_arr['size:drop_down:1'] 	= '';
			$product_arr['image'] 			= '"' . $row['products_image'] . '"';
			$product_arr['small_image'] 	= '';
			$product_arr['thumbnail'] 		= '';
			$product_arr['gallery'] 		= '"' . $row['products_image'] . '"';
			$product_arr['meta_title']		= '"' . $row['metatags_title'] . '"';
			$product_arr['meta_keyword']	= '"' . $row['metatags_keywords'] . '"';
			$product_arr['meta_description']	= '"' . $row['metatags_description'] . '"';
	
			$content .= implode(",", $product_arr) . "\n";
			
			/* 压缩图片 */
			$img = explode(",", $row['products_image']);
			if(is_array($img)){
				foreach($img as $item){
					if (!empty($item) && is_file(DIR_FS_CATALOG . DIR_WS_IMAGES . $item))
					{
						$zip->add_file(file_get_contents(DIR_FS_CATALOG . DIR_WS_IMAGES . $item), $item);
					}
				}
			}
			$product_info->MoveNext();
			echo "<pre>";
			print_r($product_arr);
			echo "</pre>";
			exit;
		}
		$charset = empty($charset) ? 'utf-8' : trim($charset);
		$content = iconv('utf-8', $charset, $content);
		$zip->add_file($content, $filename.'.csv');
	
		header("Content-Disposition: attachment; filename=". $filename .".zip");
		header("Content-Type: application/unknown");
		die($zip->file());
	}
}
?>
<!doctype html public "-//W3C//DTD HTML 4.01 Transitional//EN">
<html <?php echo HTML_PARAMS; ?>>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo TITLE; ?></title>
<link rel="stylesheet" type="text/css" href="includes/stylesheet.css">
<link rel="stylesheet" type="text/css" href="includes/cssjsmenuhover.css" media="all" id="hoverJS">
<link rel="stylesheet" type="text/css" href="includes/product_batch.css">
<script language="javascript" src="includes/menu.js"></script>
<script language="javascript" src="includes/general.js"></script>
<script type="text/javascript">
  <!--
  function init()
  {
    cssjsmenu('navbar');
    if (document.getElementById)
    {
      var kill = document.getElementById('hoverJS');
      kill.disabled = true;
    }
  if (typeof _editor_url == "string") HTMLArea.replaceAll();
  }
  // -->
</script>
<?php if ($editor_handler != '') include ($editor_handler); ?>
<style type="text/css">
<!--
*{padding:0; margin:0;}
.dis {DISPLAY: block;}
.undis {DISPLAY: none;}
#NewsTop {CLEAR: both; MARGIN-BOTTOM: 16px;}
#NewsTop P {FLOAT: left; LINE-HEIGHT: 21px; CURSOR:pointer;}
#NewsTop P.topTit {FONT-WEIGHT: bold; WIDTH: 117px;}
#NewsTop P.topC0 {BACKGROUND: #dcdcdc; BORDER-LEFT: #f2f2f2 1px solid; padding:0px 20px; CURSOR:pointer;}
#NewsTop P.topC1 {BACKGROUND:#090; BORDER-LEFT: #f2f2f2 1px solid; padding:0px 20px; CURSOR:pointer; COLOR: #fff;}
#NewsTop #NewsTop_tit {BORDER-BOTTOM: #090 3px solid; HEIGHT: 21px;}
#NewsTop #NewsTop_cnt {PADDING-LEFT: 32px; BACKGROUND: url(http://www.popuni.com/attachments/month_0703/o2007320133249.gif) no-repeat 12px 13px; LINE-HEIGHT: 26px; PADDING-TOP: 7px; HEIGHT: 260px; TEXT-ALIGN: left;}
#NewsTop #NewsTop_cnt A {COLOR: #666; TEXT-DECORATION: none;}
#NewsTop #NewsTop_cnt A:hover {COLOR: #090; TEXT-DECORATION: underline;}
-->
</style>
</head>
<body marginwidth="0" marginheight="0" topmargin="0" bottommargin="0" leftmargin="0" rightmargin="0" bgcolor="#FFFFFF" onLoad="init()">
<div id="spiffycalendar" class="text"></div>
<!-- header //-->
<?php require(DIR_WS_INCLUDES . 'header.php'); ?>
<!-- header_eof //-->

<!-- body //-->
<div class="maincontent">
    <div class="content">
        <DIV id="cntR">
            <DIV id="NewsTop">
                <DIV id="NewsTop_tit">
                    <P class="topTit">商品批量导入导出</P>
                    <P class="topC0">商品批量导入</P>
                    <P class="topC0">商品批量导出</P>
                    <P class="topC0">商品批量导出magento格式</P>
                </DIV>
            <DIV id="NewsTop_cnt">
            <SPAN></SPAN>
            <SPAN>
            <div class="product_export">
                <table>
                
                <form method="post" action="product_batch.php?action=import" enctype="multipart/form-data" onSubmit="return checkimpform(this)">
                    <tr>
                        <td class="txtright">导入文件名称：</td>
                        <td><input type="file" name="filename"></td>
                    </tr>
                    <tr>
                    	<td>导入已有文件</td>
                        <td>
                        <?php $temp_csvfiles = scandir($csvdir);?>
                        <select name="csvfilename">
                        	<?php foreach($temp_csvfiles as $value) {
								if($value !='.' && $value != '..') {
									echo '<option value="' . $value . '">' . $value . '</option>';
								}
							}?>
                        	
                        </select>
                        </td>
                    </tr>
                    <tr>
                        <td class="txtright">编码格式：</td>
                        <td><select name="charset">
                        <option value="utf-8">utf-8</option>
                        <option value="gb2312">gb2312</option>
                        <option value="gbk">gbk</option>
                        </select></td>
                    </tr>
                    <tr><td colspan="2" class="txtcenter"><input type="submit" name="import" value="导入"></td></tr>
                </form>
                </table>
            </div>
            </SPAN>
            <span>
            <div class="product_export">
                <table>
                <form method="post" action="product_batch.php?action=export" onSubmit="return checkexpform(this)">
                    <tr>
                        <td class="txtright">导出文件名称：</td>
                        <td><input type="text" name="filename"></td>
                    </tr>
                    <tr>
                        <td class="txtright">编码格式：</td>
                        <td><select name="charset">
                        <option value="utf-8">utf-8</option>
                        <option value="gb2312">gb2312</option>
                        <option value="gbk">gbk</option>
                        </select></td>
                    </tr>
                    <tr><td colspan="2" class="txtcenter"><input type="submit" value="导出"></td></tr>
                </form>
                </table>
            </div>
            </span>
            <span>
            <div class="product_export">
                <table>
                <form method="post" action="product_batch.php?action=export_tomagento" onSubmit="return checkexpform(this)">
                    <tr>
                        <td class="txtright">导出magento格式文件名称：</td>
                        <td><input type="text" name="filename"></td>
                    </tr>
                    <tr>
                        <td class="txtright">编码格式：</td>
                        <td><select name="charset">
                        <option value="utf-8">utf-8</option>
                        <option value="gb2312">gb2312</option>
                        <option value="gbk">gbk</option>
                        </select></td>
                    </tr>
                    <tr><td colspan="2" class="txtcenter"><input type="submit" value="导出"></td></tr>
                </form>
                </table>
            </div>
            </span>
            </div>
            <script>
            var Tags=document.getElementById('NewsTop_tit').getElementsByTagName('p'); 
            var TagsCnt=document.getElementById('NewsTop_cnt').getElementsByTagName('span'); 
            var len=Tags.length; 
            var flag=1;//修改默认值
            for(i=1;i<len;i++){
				Tags[i].value = i;
				Tags[i].onmouseover=function(){changeNav(this.value)}; 
				TagsCnt[i].className='undis'; 
            }
            Tags[flag].className='topC1';
            TagsCnt[flag].className='dis';
            function changeNav(v){ 
				Tags[flag].className='topC0';
				TagsCnt[flag].className='undis';
				flag=v; 
				Tags[v].className='topC1';
				TagsCnt[v].className='dis';
            }
            </script>
            </div>
        </div>
    </div>
    
</div>
<script type="text/javascript">
function checkimpform(fm){
	if(fm.filename.value == '' && fm.csvfilename == ''){
		alert('请选择导入的文件');
		return false;
	}
	var filename = fm.filename.value;
	if(filename.substring(filename.lastIndexOf('.'), filename.length) != '.csv'){
		//alert('文件格式不正确');
		//return false;
	}
	return true;
}
function checkexpform(fm){
	if(fm.filename.value == ''){
		alert('请输入导出的文件名');
		return false;
	}
	return true;
}
</script>

<!-- body_eof //-->

<!-- footer //-->
<?php require(DIR_WS_INCLUDES . 'footer.php'); ?>
<!-- footer_eof //-->
</body>
</html>
<?php require(DIR_WS_INCLUDES . 'application_bottom.php'); ?>