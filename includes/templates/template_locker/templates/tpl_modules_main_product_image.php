<?php
/**
 * Module Template
 *
 * @package templateSystem
 * @copyright Copyright 2003-2005 Zen Cart Development Team
 * @copyright Portions Copyright 2003 osCommerce
 * @license http://www.zen-cart.com/license/2_0.txt GNU Public License V2.0
 * @version $Id: tpl_modules_main_product_image.php 3208 2006-03-19 16:48:57Z birdbrain $
 */
?>
<?php require(DIR_WS_MODULES . zen_get_module_directory(FILENAME_MAIN_PRODUCT_IMAGE)); ?>
<?php require(DIR_WS_MODULES . zen_get_module_directory('sam_product_images.php'));?>

<script type="text/javascript" src="<?php echo DIR_WS_TEMPLATE;?>jscript/lytebox.js"></script>
<script type="text/javascript" src="<?php echo DIR_WS_TEMPLATE;?>jscript/fade.js"></script>

<div class="jersey_pic">
		<?
        if(count($images_array_contain_all)>0){
			$imgsize=getimagesize($images_array_contain_all[0]); 
        ?>
            <div class="div_one">
                <div class="top_one" id="jersey_one" style="display:none;">
				<?
				for($i=0;$i<count($images_array_contain_all);$i++){
					$arrimgsize=getimagesize($images_array_contain_all[$i]); 
					if($i == 0){
						echo '<script type="text/javascript">document.write(\'<img id="top_pic" class="top_pic" src="' . DIR_WS_CATALOG . $images_array_contain_all[$i].'"  w="'.$arrimgsize[0].'" h="'.$arrimgsize[1].'"/>\')</script>';
					}else{
						echo '<script type="text/javascript">document.write(\'<img  src="' . DIR_WS_CATALOG . $images_array_contain_all[$i].'" w="'.$arrimgsize[0].'" h="'.$arrimgsize[1].'"/>\')</script>';
					}
				}
				?>                
                
                </div>
                <div class="bottom_one">
                    <?
					count($images_array_contain_all) == 1? $one_img_style = 'width:230px; height:270px;' : $one_img_style = '' ;
					for($i=0;$i<count($images_array_contain_all);$i++){
						$arrimgsize=getimagesize($images_array_contain_all[$i]); 
						if(count($images_array_contain_all) == 1){
						/*if($i == 0){*/
							echo '<div class="thumbone"><a href="' . DIR_WS_CATALOG . $images_array_contain_all[$i].'" rel="lytebox[plants]"><img src="' . DIR_WS_CATALOG . $images_array_contain_all[$i].'" /></a></div>';
						}else{
							echo '<div class="thumbnail"><a href="' . DIR_WS_CATALOG . $images_array_contain_all[$i].'" rel="lyteshow[vacation]"><img src="' . DIR_WS_CATALOG . $images_array_contain_all[$i].'" w="'.$arrimgsize[0].'" h="'.$arrimgsize[1].'" class="latest_img" /></a><span class="smallzoomimg"></span></div>';
						}
					}
					?> 
                </div>
             </div>
		<?
        }
        ?>
        </div>
