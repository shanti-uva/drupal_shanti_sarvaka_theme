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
<ul class="nav navbar-nav navbar-right">
  <li class="dropdown <?php print $bs_class; ?> highlight" id="<?php print $block_html_id; ?>">  
      <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <?php if ($block->title): ?>
            <span><?php print $block->title ?></span>
        <?php endif;?>
        <!-- $icon_class determines icon image -->
        <i class="icon <?php print $icon_class; ?>"></i>
       </a>
      <?php print $elements['#markup']; ?>
   </li>
</ul>
<?php print $follow_markup; ?>
  