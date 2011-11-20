<?php
$content = '';
$content .= '<ul class="cate_con li_a">';

$categories_query = "SELECT c.categories_id ,cd.categories_name as name  FROM categories as c,categories_description as cd where c.categories_id  = cd.categories_id and c.parent_id = 0 and c.categories_status=1 and cd.language_id=" . (int)$_SESSION['languages_id'] ." order by c.sort_order";
$categories = $db->Execute($categories_query);
while (!$categories->EOF)  {
	$content .= '
	<li class="li_tit">
	<a  href="' . zen_href_link(FILENAME_DEFAULT, "cPath=".$categories->fields['categories_id']."") . '">'.$categories->fields['name'].'</a>
	<ol class="cate_ol">
	';

	$categories_query_path = "SELECT c.categories_id ,cd.categories_name as name  FROM categories as c,categories_description as cd where c.categories_id  = cd.categories_id and c.parent_id != 0 and c.categories_status=1 and cd.language_id=" . (int)$_SESSION['languages_id'] ." and c.parent_id = ".$categories->fields['categories_id']." order by c.sort_order";
	$categories_path = $db->Execute($categories_query_path);
	$categories_path_count = $categories_path->RecordCount();
	$iclass = 1;
	while (!$categories_path->EOF)  {
		if($iclass == 1){
			$classstr = ' class="li_spe"';
		}else if($iclass == $categories_path_count){
			$classstr = ' class="li_last"';	
		}else{
			$classstr = '';		
		}
		$content .= '<li '.$classstr.'><a  href="' . zen_href_link(FILENAME_DEFAULT, "&cPath=".$categories->fields['categories_id']."_".$categories_path->fields['categories_id']."") . '">'.$categories_path->fields['name'].'</a></li>';
		$iclass++;
		$categories_path->MoveNext();
	}
	$content .= '
	</ol>
	</li>';
	$categories->MoveNext();
}
$content .= '</ul>';
?>