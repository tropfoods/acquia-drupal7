<?php
/**
 * @file
 * Default theme implementation to display the basic html structure of a single
 * Drupal page.
 *
 * Variables:
 * - $css: An array of CSS files for the current page.
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $rdf_namespaces: All the RDF namespace prefixes used in the HTML document.
 * - $grddl_profile: A GRDDL profile allowing agents to extract the RDF data.
 * - $head_title: A modified version of the page title, for use in the TITLE
 *   tag.
 * - $head_title_array: (array) An associative array containing the string parts
 *   that were used to generate the $head_title variable, already prepared to be
 *   output as TITLE tag. The key/value pairs may contain one or more of the
 *   following, depending on conditions:
 *   - title: The title of the current page, if any.
 *   - name: The name of the site.
 *   - slogan: The slogan of the site, if any, and if there is no title.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $page_top: Initial markup from any modules that have altered the
 *   page. This variable should always be output first, before all other dynamic
 *   content.
 * - $page: The rendered page content.
 * - $page_bottom: Final closing markup from any modules that have altered the
 *   page. This variable should always be output last, after all other dynamic
 *   content.
 * - $classes String of classes that can be used to style contextually through
 *   CSS.
 *
 * @see template_preprocess()
 * @see template_preprocess_html()
 * @see template_process()
 *
 * @ingroup themeable
 */
?><!DOCTYPE html>

<!--[if IE 7 ]><html class="ie ie7" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>><![endif]-->
<!--[if IE 8 ]><html class="ie ie8" xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>><![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php print $language->language; ?>" version="XHTML+RDFa 1.0" dir="<?php print $language->dir; ?>"<?php print $rdf_namespaces; ?>><!--<![endif]-->

  <head profile="<?php print $grddl_profile; ?>">
    <?php print $head; ?>
    <title><?php print $head_title; ?></title>
    <?php print $styles; ?>	


      <!--[if lt IE 9]><link rel="stylesheet" type="text/css" media="screen" href="<?php print base_path().  path_to_theme(); ?>/stylesheets/sequencejs-theme.sliding-horizontal-parallax-ie.css" /><![endif]-->
      <?php print $scripts; ?>
      <!--[if lt IE 9]>
            <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
        <![endif]-->


      <?php
      $menu_style = theme_get_setting('menu_style', 'aqua');
      $menu_color = theme_get_setting('menu_color', 'aqua');
      if ($menu_style == 'custom'):
        ?>
        <!-- menu -->
        <style type="text/css">
          .custom_menu #menu,.custom_menu #menu > ul > li > a{
            background-color: <?php print $menu_color; ?>;
          }
        </style>
        <!-- // end menu -->
      <?php endif; ?>


      <!-- menu font -->
      <?php
      $menu_font = theme_get_setting('menu_font', 'aqua');
      $font_picked = $menu_font;

      $font_weight = false;
      $split_font_name = explode(':', $menu_font);

      if (count($split_font_name) > 1) {
        $font_picked = $split_font_name[0];
        $font_weight = $split_font_name[1];
      }
      ?>
      <style type="text/css">
        .custom_menu #menu > ul > li > a,#menu {
          font-family:<?php print $font_picked; ?>;
          <?php if ($font_weight) { ?>
            font-weight: <?php print $font_weight; ?>;
          <?php } ?>
        }
      </style>
      <!-- // menu font -->

      <!-- menu font size -->
      <?php
      $menu_font_size = theme_get_setting('menu_font_size', 'aqua');
      $menu_font_size_picked = $menu_font_size;
      $split_fontsize_int = explode('px', $menu_font_size);
      if ($split_fontsize_int > 0) {
        $split_fontsize_int = $split_fontsize_int[0];
      }
      ?>
      <style type="text/css">
        #menu > ul > li > a{
          font-size: <?php print $menu_font_size; ?> ;
        }
        #menu > ul > li ul > li > a{
          font-size: <?php print ($split_fontsize_int - 1); ?>px ;
        }
      </style>
      <!-- // menu font size -->


      <!-- main color -->
      <?php
      $main_color = theme_get_setting('main_color', 'aqua');
      ?>
      <style type="text/css">
        a:hover, a:focus{
          color: <?php print $main_color; ?> ;
        }
        .button:hover,
        a:hover.button,
        button:hover,
        input[type="submit"]:hover,
        input[type="reset"]:hover,	
        input[type="button"]:hover,
        .button_hilite, 
        a.button_hilite,
        .button_hilite,
        a.button_hilite{
          color: #FFF;
          background-color: <?php print $main_color; ?>;
        }
        .section_big_title h1 strong,
        .section_featured_texts h3 a:hover,
        .breadcrumb a:hover,
        .post_meta a:hover,
        #footer a:hover {
          color: <?php print $main_color; ?> ;
        }
        .portfolio_filter div.current,
        .next:hover,.prev:hover,
        .pagination .links a:hover,
        .info h2, 
        .h2.ls-s2,
        jcarousel-next-horizontal:hover, 
        .jcarousel-prev-horizontal:hover{
          background-color: <?php print $main_color; ?> ;
        }
        .footer_pic img:hover{
          border: 1px solid <?php print $main_color; ?>;
        }
      </style>
      <!-- // main color -->

      <!-- heading font -->
      <?php
      $title_font = theme_get_setting('title_font', 'aqua');
      $font_picked = $title_font;

      $font_weight = false;
      $split_font_name = explode(':', $title_font);

      if (count($split_font_name) > 1) {
        $font_picked = $split_font_name[0];
        $font_weight = $split_font_name[1];
      }
      ?>
      <style type="text/css">
        h1, h2, h3, h4, h5, .title, .section_big_title h1, .heading, #footer h3,
        .page_heading h1{
          font-family: <?php print $font_picked; ?>;
          <?php if ($font_weight): ?>
            font-weight:<?php print $font_weight; ?>;
          <?php endif; ?>
        }
      </style>
      <!-- heading font -->

      <!-- button font -->
      <?php
      $button_font = theme_get_setting('button_font', 'aqua');
      $font_picked = $button_font;

      $font_weight = false;
      $split_font_name = explode(':', $button_font);

      if (count($split_font_name) > 1) {
        $font_picked = $split_font_name[0];
        $font_weight = $split_font_name[1];
      }
      ?>
      <style type="text/css">
        .button, a.button,	button,	input[type="submit"], input[type="reset"], input[type="button"]{
          font-family: <?php print $font_picked; ?>;
          <?php if ($font_weight): ?>
            font-weight:<?php print $font_weight; ?>;
          <?php endif; ?>
        }
      </style>
      <!-- // button fonts -->

      <!-- body font -->
      <?php $body_font = theme_get_setting('body_font', 'aqua'); ?>
      <style typ="text/css">
        body{
          font-family: <?php print $body_font; ?>;
        }
      </style>
      <!-- // body font -->

      <!-- body background and color -->
      <?php
      $bg_image = theme_get_setting('bg_image', 'aqua');
      $bg_color = theme_get_setting('bg_color', 'aqua');
      ?>
      <style type="text/css">
        body{
          <?php
          if ($bg_image == 'none') {
            print 'background-image: none;';
            print 'background-color ' + $bg_color + ';';
          } else {
            print 'background-image: url(' . base_path() . path_to_theme() . '/styler/bgrs/' . $bg_image . ');';
          }
          ?>
        }
      </style>
      <!-- // body bg -->

  </head>
  <body class="<?php print $classes; ?>" <?php print $attributes; ?>>
    <div id="skip-link">
      <a href="#main-content" class="element-invisible element-focusable"><?php print t('Skip to main content'); ?></a>
    </div>
    <?php print $page_top; ?>
    <?php print $page; ?>
    <?php print $page_bottom; ?>


    <!--  Fonts  -->

   

  </body>
</html>
