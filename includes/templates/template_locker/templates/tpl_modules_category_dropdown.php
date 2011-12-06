<?php
$categories = $db->Execute("SELECT c.categories_id, c.parent_id, cd.categories_name as name FROM " . TABLE_CATEGORIES . " AS c, " . TABLE_CATEGORIES_DESCRIPTION . " AS cd WHERE categories_status=1 AND c.categories_id = cd.categories_id AND cd.language_id=" . (int)$_SESSION['languages_id'] . " order by c.sort_order");

$category_parent = array();
$category_subtemp = array();
$category_sub_byparent = array();

while (!$categories->EOF){
	if($categories->fields['parent_id'] == 0){
		$category_parent[] = $categories->fields;
	}else{
		$category_subtemp[] = $categories->fields;
	}
	$categories->MoveNext();
}
foreach($category_subtemp as $value){
	$category_sub_byparent[$value['parent_id']][] = $value;
}
$content = '';
//$content = '<ul class="nav">' . "\n";
if(count($category_parent)>6){
	$nav_num = 6;
}else{
	$nav_num = count($category_parent);
}
//$category_parent as $item
for($i=0; $i<$nav_num; $i++){
	$content .= '<li class="nav_li">';
	$content .= '<a href="' . zen_href_link(FILENAME_DEFAULT, "cPath=".$category_parent[$i]['categories_id']."") . '">' . $category_parent[$i]['name'] . '</a>';
	//if(count($category_sub_byparent[$category_parent[$i]['categories_id']]) > 0){
		if($i>1){
			$lic = ' li_' . $i;
		}else{
			$lic = '';
		}
		/*$content .= '<div class="li_one' . $lic . '">';
		if($category_sub_byparent[$category_parent[$i]['categories_id']]){
			$content .= '<ol class="nav_one">';
			foreach($category_sub_byparent[$category_parent[$i]['categories_id']] as $value){
				$content .= '<li><a href="' . zen_href_link(FILENAME_DEFAULT, "cPath=".$value['categories_id']."") . '">' . $value['name'] . '</a></li>';
			}
			$content .= '</ol>';
		}
		
		$content .= '</div>';*/
	//}
}

//$content .= '</ul>';

echo $content;
?>



