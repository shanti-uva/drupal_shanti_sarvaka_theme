<?php
  /**
   *  Extends block.tpl.php for facetapi blocks. See https://api.drupal.org/api/drupal/modules!block!block.tpl.php/7
   *
   */
?>
<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>
<?php print render($title_prefix); ?>
<?php if ($block->subject): ?>
  <h2<?php print $title_attributes; ?>><?php print $block->subject ?>
    <input type="text" class="form-control facet-label-search" type="text" placeholder="Search <?php print $block->subject ?>" style="display: none; width: 0px;"/>
    <button class="toggle-facet-label-search">
      <span class="icon km-search" title="Find a <?php print $block->subject ?> facet"></span>
    </button>
  </h2>
<?php endif;?>
  <?php print render($title_suffix); ?>

  <div class="content"<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div>
</div>
