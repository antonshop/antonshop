<?php
  $zc_show_specials = false;
  include(DIR_WS_MODULES . zen_get_module_directory(FILENAME_SPECIALS_INDEX));
?>
<?php if ($zc_show_specials == true) { ?>
<div class="new_pro">
    <h1 class="h1_tit"><?=$title?></h1>
    <div class="pro_con">
		<?php echo $list_box_contents; ?>
    </div>
</div>
<?php } ?>
