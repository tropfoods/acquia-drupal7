<div id="<?php print $block_html_id; ?>" class="<?php print $classes; ?>"<?php print $attributes; ?>>

  <?php print render($title_prefix); ?>
  <?php if ($block->subject): ?>
    <h4 class="title"><span><?php print $block->subject ?></span></h4>
  <?php endif; ?>
  <?php print render($title_suffix); ?>


  <div class="content"<?php print $content_attributes; ?>>
    <?php print $content ?>
  </div>
</div>