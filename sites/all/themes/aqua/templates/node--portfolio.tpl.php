<div id="node-<?php print $node->nid; ?>" class="<?php print $classes; ?> clearfix"<?php print $attributes; ?>>


  <?php
  $body_class = '';
  $node_image_class = '';
  $image_style = 'node_teaser';
  if ($page) {
    $body_class = 'five columns portfolio_description omega';
    $node_image_class = 'ten columns alpha';
    $image_style = 'portfolio_item';
  }
  ?> 




  <!-- // node portfolio teaser -->
  <?php if (!empty($content['field_image'])): ?>
    <div class="node-image <?php print $node_image_class; ?>">
      <?php
      hide($content['field_image']);
      $field_image = field_get_items('node', $node, 'field_image');
      if (!empty($field_image) && count($field_image) == 1):
        ?>

        <?php $image_view_url = file_create_url($field_image[0]['uri']); ?>


        <!-- single image -->
        <div class="pic">
          <?php if (!$page): ?>
            <a href="<?php print $node_url; ?>">
              <?php print theme('image_style', array('style_name' => $image_style, 'path' => $field_image[0]['uri'])); ?>
              <div class="img_overlay"></div>
            </a>
          <?php endif; ?>

          <?php if ($page): ?>
            <?php $img_view_full = file_create_url($field_image[0]['uri']); ?>
            <a rel="prettyPhoto" href="<?php print $img_view_full; ?>">
              <?php print theme('image_style', array('style_name' => $image_style, 'path' => $field_image[0]['uri'])); ?>
              <span class="img_overlay_zoom"></span>
            </a>
          <?php endif; ?>

        </div>
        <!-- single image -->
      <?php endif; ?>



      <?php if (!empty($field_image) && count($field_image) > 1): ?>
        <?php
        $post_icon = 'gallery';
        ?>
        <div class="flexslider">
          <ul class="slides">
            <?php foreach ($field_image as $img): ?>
              <li class="pic">
                <?php $img_view = file_create_url($img['uri']); ?>
                <a href="<?php print $img_view; ?>" rel="prettyPhoto[node-<?php $node->nid; ?>]" title="<?php print $node->title; ?>">
                  <?php print theme('image_style', array('style_name' => $image_style, 'path' => $img['uri'])); ?><span class="img_overlay_zoom"></span>
                </a>
              </li>
            <?php endforeach; ?>

          </ul>
        </div>

      <?php endif; ?>
    </div>

  <?php endif; ?>




  <?php print $user_picture; ?>

  <?php print render($title_prefix); ?>
  <?php if (!$page): ?>
    <h3<?php print $title_attributes; ?> class="post_title"><a href="<?php print $node_url; ?>"><?php print $title; ?></a></h3>
  <?php endif; ?>
  <?php print render($title_suffix); ?>

  <!-- // node portfolio teaser -->



  <?php if ($display_submitted): ?>
    <div class="submitted">
      <?php print $submitted; ?>
    </div>

  <?php endif; ?>



  <div class="content <?php print $body_class; ?>"<?php print $content_attributes; ?>>
    <?php
    // We hide the comments and links now so that we can render them later.
    hide($content['comments']);

    hide($content['links']);
    // we hide field_tags because it already shown on top
    hide($content['field_tags']);
    hide($content['field_portfolio_link']);
    print render($content);
    ?>
    <?php if (!empty($content['field_portfolio_link'])): ?>
      <?php
      $project_link = field_get_items('node', $node, 'field_portfolio_link');
      if (!empty($project_link)):
        $link = url($project_link[0]['value']);
        ?>
        <a class="button sm_button button_hilite" target="_blank" href="<?php print $link; ?>"><?php print t('Visit Website'); ?></a>
      <?php endif; ?>
    <?php endif; ?>
  </div>

  <?php
  if ($page) {
    print render($content['links']);
  }
  ?>

  <?php print render($content['comments']); ?>

</div>


<?php
$nids = db_query("SELECT n.nid FROM {node} n WHERE n.status = 1 AND n.type = :type AND n.nid <> :nid ORDER BY RAND() LIMIT 0,12", array(':type' => 'portfolio', ':nid' => $node->nid))->fetchCol();

$nodes = node_load_multiple($nids);
?>
<?php if (!empty($nodes)): ?>

  <div class="row">
    <h2 class="title"><span><?php print t('More Portfolio Items'); ?></span></h2>
    <div class="clear"></div>
    <div class="half_padded_block carousel_section">
      <div class='carousel_arrows_bgr'></div>
      <ul id="portfolio_carousel">

        <?php foreach ($nodes as $node) : ?>
          <?php $field_image = field_get_items('node', $node, 'field_image'); ?>
          <?php if (!empty($field_image)): ?>
            <li class="four columns portfolio_item">
              <a href="<?php print url('node/' . $node->nid); ?>" title="<?php print $node->title; ?>">
                <span class="pic"><?php print theme('image_style', array('style_name' => 'portfolio_item', 'path' => $field_image[0]['uri'])); ?><div class="img_overlay"></div></span>
                <h5><?php print $node->title; ?></h5>
              </a>
            </li>	
          <?php endif; ?>
        <?php endforeach; ?>
      </ul>
    </div>
  </div>
<?php endif; ?>