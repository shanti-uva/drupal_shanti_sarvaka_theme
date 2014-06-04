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
<span id="<?php print $block_html_id; ?>-btn" class="menu-toggle menu-icon"> <!--  -->
  <a href="#"> 
    <?php if ($block->title): ?>
        <span><?php print $block->title ?></span>
        <i class="icon km-directions"></i>
    <?php else: ?>
      <i class="icon km-menu"></i>
    <?php endif;?>
   </a>
</span>
  