<?php
/**
 * Page Template
 *
 * Loaded automatically by index.php?main_page=PRODUCTTAGS.<br />
 * Displays conditions page.
 *
 * @package templateSystem
 * @copyright Copyright 2003-2006 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_PRODUCTTAGS_default.php  v1.3 $
 */
 $breadcrumb->trail($_GET['letter']);
 ?>
<div class="centerColumn" id="checkoutPayment">

<?php
	if ($_GET['letter']=='0-9'){
		$producttags_split_sql = "select p.`products_id`,pd.`products_name` from ".TABLE_PRODUCTS." p,".TABLE_PRODUCTS_DESCRIPTION." pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) REGEXP '^[0-9]'";
	}else{
		$producttags_split_sql = "select p.`products_id`,pd.`products_name` from ".TABLE_PRODUCTS." p,".TABLE_PRODUCTS_DESCRIPTION." pd where p.`products_id` = pd.`products_id` AND LEFT(pd.`products_name`,1) LIKE '".strtolower($_GET['letter'])."'";
	}//print_r($producttags_split_sql);
	$producttags_split = new splitPageResults($producttags_split_sql, 40, 'p.products_id', 'page');
	$zco_notifier->notify('NOTIFY_MODULE_PRODUCT_LISTING_RESULTCOUNT', $producttags_split->number_of_rows);
	$producttags = $db->Execute($producttags_split->sql_query);
	//echo $producttags->RecordCount();
?>
<div class="mark">
    <h1 class="mark_tit">All <?php echo $_GET['letter'] ;?> Products</h1>
    <div class="mark_con">
        
		<?php
            if($producttags->RecordCount() > 0){?>
            <ul class="mark_list">
                <?php while (!$producttags->EOF){
                    echo '<li><a href="'.zen_href_link(zen_get_info_page($producttags->fields['products_id']),'cPath=' .zen_get_generated_category_path_rev($_GET['cPath']). '&products_id=' .$producttags->fields['products_id']).'" >'.$producttags->fields['products_name'].'</a>'; 
                    $producttags->MoveNext();
                }?>
            </ul>
            <?php }else{//exit;
                //if(!in_array($_GET['letter'],range('a', 'z')) && $_GET['letter'] != '0-9'){
                   // zen_redirect(zen_href_link(FILENAME_DEFINE_PAGE_NOT_FOUND));
                //}
                //zen_redirect(zen_href_link(FILENAME_DEFINE_PAGE_NOT_FOUND));
                echo '<div style="text-align:center;"><div class="error_box" style="width:300px;text-align:center; margin:0 auto; padding-top:15px;">Sorry,This is Tags "'.$_GET['letter'].'" no Container Products</div></div>';
            }
        ?>
    </div>
</div>		

<?php if (($producttags_split->number_of_rows > 0) && ((PREV_NEXT_BAR_LOCATION == '2') || (PREV_NEXT_BAR_LOCATION == '3')) ) {
?>
<div class="mavericks_rg"><?php echo TEXT_RESULT_PAGE . ' ' . $producttags_split->no_current_display_links(200, zen_get_all_get_params(array('page', 'info', 'x', 'y'))); ?></div>
<?php
  }
?>
<div class="clear margine_t"> </div>
<!--<ul class="letter_1px g_t_c big line_30px">
<?php
// display productTagList
/*foreach(range('a', 'z') as $letter) {
    echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/'.strtoupper($letter).'.html" >'.strtoupper($letter).'</a> | ';
}
echo '<a href="' . HTTP_SERVER.DIR_WS_CATALOG.'producttags/0-9.html" >0-9</a> ';
*/
?> 
</ul>-->
</div>
