<?php
   /**
    * 
    *  Adaptation of standard block module to create header (top bar) menu buttons with drop down menus
    *   Created by ndg8f (2014-05-29)
    * 
    *     TODO: Is there a way to get the content of each block to be written (hidden) elsewhere on the page?
    * 
    **/
?>
<?php print $prev_markup; ?>
<?php if ($elements['#block']->delta == 'explore_menu_block'): ?>
	<?php if(isset($elements['#markup'])) { print $elements['#markup']; } ?>
<?php else: ?>
	<li class="dropdown <?php print $bs_class; ?> highlight" id="<?php print $block_html_id; ?>">  
	  <a href="#" class="dropdown-toggle" data-toggle="dropdown">
	    <?php if ($block->title): ?>
	        <span><?php print $block->title ?></span>
	    <?php endif;?>
	    <!-- $icon_class determines icon image -->
	    <span class="icon <?php print $icon_class; ?>"></span>
	   </a>
	  <?php if(isset($elements['#markup'])) { print $elements['#markup']; } ?>
	 </li>
<?php endif; ?>
<?php print $follow_markup; ?>	
  