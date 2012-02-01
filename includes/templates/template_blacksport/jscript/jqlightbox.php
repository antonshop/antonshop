<script language="javascript" type="text/javascript"><!--

$(function() {
	$('a.jqlightbox').lightBox({
		overlayBgColor: '<?php echo JQLIGHTBOX_OVERLAYBGCOLOR; ?>',
		overlayOpacity: <?php echo JQLIGHTBOX_OVERLAYOPACITY; ?>,
		containerBorderSize: <?php echo JQLIGHTBOX_CONTAINERBORDERSIZE; ?>,
		containerResizeSpeed: <?php echo JQLIGHTBOX_CONTAINERRESIZESPEED; ?>,
		fixedNavigation: <?php echo JQLIGHTBOX_FIXEDNAVIGATION; ?>
		<?php if(defined('JQLIGHTBOX_TXTIMAGE')) { ?>
		,txtImage: '<?php echo JQLIGHTBOX_TXTIMAGE; ?>'
		<?php } ?>
		
		<?php if(defined('JQLIGHTBOX_TXTOF')) { ?>
		,txtOf: '<?php echo JQLIGHTBOX_TXTOF; ?>'
		<?php } ?>
	
});

})
//--></script>