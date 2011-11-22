<?php
if (is_array($list_box_contents) > 0 ) {
	for($row=0;$row<sizeof($list_box_contents);$row++) {
		
		$params = "";
		for($col=0;$col<sizeof($list_box_contents[$row]);$col++) {
			
			$r_params = "";
			if (isset($list_box_contents[$row][$col]['params'])) $r_params .= ' ' . (string)$list_box_contents[$row][$col]['params'];
			
			if (isset($list_box_contents[$row][$col]['text'])) {
				echo '<div' . $r_params . '>' . $list_box_contents[$row][$col]['text'] .  '</div>' . "\n";
			}
		}
	}
}
?>
