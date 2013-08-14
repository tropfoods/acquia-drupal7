<?php

function aqua_form_system_theme_settings_alter(&$form, $form_state) {

  $path = drupal_get_path('theme', 'aqua');
  drupal_add_library('system', 'ui');
  drupal_add_library('system', 'farbtastic');

  drupal_add_js($path . '/js/aqua_admin.js');
  drupal_add_css($path . '/stylesheets/admin.css');

  $form['settings'] = array(
      '#type' => 'vertical_tabs',
      '#title' => t('Theme settings'),
      '#weight' => 2,
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );


  $form['settings']['header_contact'] = array(
      '#type' => 'fieldset',
      '#title' => t('Header contact info settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['header_contact']['header_contact_email'] = array(
      '#title' => t('Email address'),
      '#type' => 'textfield',
      '#default_value' => theme_get_setting('header_contact_email', 'aqua'),
  );
  $form['settings']['header_contact']['header_contact_phone'] = array(
      '#title' => t('Phone number'),
      '#type' => 'textfield',
      '#default_value' => theme_get_setting('header_contact_phone', 'aqua'),
  );

  $form['settings']['contact'] = array(
      '#type' => 'fieldset',
      '#title' => t('Contact form'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['contact']['contact_form_description'] = array(
      '#type' => 'textarea',
      '#title' => t('Contact header description'),
      '#default_value' => theme_get_setting('contact_form_description', 'aqua'),
  );
  $form['settings']['portfolio'] = array(
      '#type' => 'fieldset',
      '#title' => t('Portfolio settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['portfolio']['default_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Default portfolio display'),
      '#options' => array(
          '2c' => 'Portfolio - 2cols',
          '3c' => 'Portfolio - 3cols',
          '4c' => 'portfolio - 4cols',
      ),
      '#default_value' => theme_get_setting('default_portfolio', 'aqua'),
  );


  $form['settings']['portfolio']['default_nodes_portfolio'] = array(
      '#type' => 'select',
      '#title' => t('Number nodes show on portfolio page'),
      '#options' => drupal_map_assoc(array(2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 14, 15, 16, 17, 18, 19, 20, 25, 30, 31, 32, 33, 34, 35, 36, 37, 38, 39, 40, 41, 42, 43, 44, 45, 46, 47, 48, 49, 50, 51, 52, 53, 54, 55, 56, 57, 58, 59, 60, 100)),
      '#default_value' => theme_get_setting('default_nodes_portfolio', 'aqua'),
  );




  // social links

  $form['settings']['social_links'] = array(
      '#type' => 'fieldset',
      '#title' => t('Social links settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $social_links = array(
      'facebook' => t('Facebook URL'),
      'twitter' => t('Twitter URL'),
      'rss' => t('RSS URL'),
      'gplus' => t('Google+'),
      'pintrest' => t('Pintrest URL')
  );

  foreach ($social_links as $name => $label) {

    $form['settings']['social_links'][$name . '_url'] = array(
        '#type' => 'textfield',
        '#title' => $label,
        '#default_value' => theme_get_setting($name . '_url', 'aqua'),
    );
  }


  $form['settings']['footer'] = array(
      '#type' => 'fieldset',
      '#title' => t('Footer settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );

  $form['settings']['footer']['footer_copyright_message'] = array(
      '#type' => 'textarea',
      '#title' => t('Footer copyright message'),
      '#default_value' => theme_get_setting('footer_copyright_message', 'aqua'),
  );

  $form['settings']['skin'] = array(
      '#type' => 'fieldset',
      '#title' => t('Skin settings'),
      '#collapsible' => TRUE,
      '#collapsed' => FALSE,
  );
  $form['settings']['skin']['menu_style'] = array(
      '#type' => 'select',
      '#title' => t('Menu style'),
      '#options' => array(
          'dark' => t('Dark'),
          'light' => t('Light'),
          'custom' => t('Custom'),
      ),
      '#default_value' => theme_get_setting('menu_style', 'aqua'),
  );
  $form['settings']['skin']['menu_color'] = array(
      '#type' => 'textfield',
      '#title' => FALSE,
      '#default_value' => theme_get_setting('menu_color', 'aqua'),
      '#attributes' => array('class' => array('input color')),
      '#description' => t('default color is : #0AD1E5'),
  );

  $menu_font = array('Lato' => 'Default',
      'Allan' => 'Allan',
      'Arvo:400' => 'Arvo',
      'Cabin' => 'Cabin',
      'Cardo' => 'Cardo',
      'Chivo' => 'Chivo',
      'Courgette' => 'Courgette',
      'Cuprum' => 'Cuprum',
      'Dancing Script:700' => 'Dancing Script:700',
      'Droid Sans' => 'Droid Sans',
      'Droid Serif' => 'Droid Serif',
      'Dosis:500' => 'Dosis:500',
      'Lobster' => 'Lobster',
      'Lobster Two' => 'Lobster Two',
      'Mako' => 'Mako',
      'Merienda One' => 'Merienda One',
      'Miniver' => 'Miniver',
      'Molengo' => 'Molengo',
      'Open Sans' => 'Open Sans',
      'Oxygen' => 'Oxygen',
      'Playball' => 'Playball',
      'Pontano Sans' => 'Pontano Sans',
      'Philosopher' => 'Philosopher',
      'PT Sans' => 'PT Sans',
      'PT Sans Narrow' => 'PT Sans Narrow',
      'Radley' => 'Radley',
      'Rokkitt' => 'Rokkitt',
      'Salsa' => 'Salsa',
      'Vollkorn' => 'Vollkorn',
      'Ubuntu' => 'Ubuntu',
      'Yanone Kaffeesatz' => 'Yanone Kaffeesatz',
  );

  $form['settings']['skin']['menu_font'] = array(
      '#type' => 'select',
      '#title' => t('Menu font'),
      '#options' => $menu_font,
      '#default_value' => theme_get_setting('menu_font', 'aqua'),
  );
  $font_size = array('14px' => '14px', '15px' => '15px', '16px' => '16px', '17px' => '17px', '18px' => '18px', '19px' => '19px', '20px' => '20px');
  $form['settings']['skin']['menu_font_size'] = array(
      '#type' => 'select',
      '#title' => t('Menu font size'),
      '#options' => $font_size,
      '#default_value' => theme_get_setting('menu_font_size', 'aqua'),
  );

  $form['settings']['skin']['main_color'] = array(
      '#type' => 'textfield',
      '#title' => t('Main color'),
      '#default_value' => theme_get_setting('main_color', 'aqua'),
      '#attributes' => array('class' => array('input color')),
      '#description' => t('default color is: #0AD1E5')
  );

  $form['settings']['skin']['title_font'] = array(
      '#type' => 'select',
      '#title' => t('Heading font'),
      '#options' => $menu_font,
      '#default_value' => theme_get_setting('title_font', 'aqua'),
  );


  $form['settings']['skin']['button_font'] = array(
      '#type' => 'select',
      '#title' => t('Button font'),
      '#options' => $menu_font,
      '#default_value' => theme_get_setting('button_font', 'aqua'),
  );
  $form['settings']['skin']['body_font'] = array(
      '#type' => 'select',
      '#title' => t('Body font'),
      '#options' => array(
          'Open Sans' => t('Default'),
          'Arial' => t('Arial'),
          'Georgia' => t('Georgia'),
          'Tahoma' => t('Tahoma'),
          'Trebuchet MS' => t('Trebuchet MS'),
          'Times New Roman' => t('Times New Roman'),
          'Verdana' => t('Verdana'),
      ),
      '#default_value' => theme_get_setting('body_font', 'aqua'),
  );
  $form['settings']['skin']['wrapper_style'] = array(
      '#type' => 'select',
      '#title' => t('Wrapper style'),
      '#options' => array(
          'boxed' => t('Boxed'),
          'full' => t('Full-width'),
      ),
      '#default_value' => theme_get_setting('wrapper_style', 'aqua'),
  );

  $bg_imgs = array('main_bgr.png' => 'Default',
      '2.png' => 'Pattern 1',
      'a_diag.png' => 'Pattern 2',
      '1.png' => 'Pattern 3',
      'a_furley_bg.png' => 'Pattern 4',
      'a_hexellence.png' => 'Pattern 5',
      'a_light_toast.png' => 'Pattern 6',
      'a_lil_fiber.png' => 'Pattern 7',
      'a_plaid.png' => 'Pattern 8',
      'a_redox_01.png' => 'Pattern 9',
      'a_scribble_light.png' => 'Pattern 10',
      'a_small-crackle-bright.png' => 'Pattern 11',
      'a_small_tiles.png' => 'Pattern 12',
      'a_stacked_circles.png' => 'Pattern 13',
      'a_stripes.png' => 'Pattern 14',
      'a_diamonds.png' => 'Pattern 15',
      'a_vichy.png' => 'Pattern 16',
      'a_white_tiles.png' => 'Pattern 17',
      'bright_squares.png' => 'Pattern 18',
      'daimond_eyes.png' => 'Pattern 19',
      'dark_argyle.png' => 'Pattern 20',
      'dark_cartographer.png' => 'Pattern 21',
      'dark_linen.png' => 'Pattern 22',
      'dark_noise.png' => 'Pattern 23',
      'dark_pinstriped_suit.png' => 'Pattern 24',
      'dark_szigzag.png' => 'Pattern 25',
      'dark_wood.png' => 'Pattern 26',
      'purty_wood.png' => 'Pattern 27',
      'wood_pattern.png' => 'Pattern 28',
      'none' => 'No Image',
  );


  $form['settings']['skin']['bg_image'] = array(
      '#type' => 'select',
      '#title' => t('Background image pattern'),
      '#options' => $bg_imgs,
      '#default_value' => theme_get_setting('bg_image', 'aqua'),
  );
  $form['settings']['skin']['bg_color'] = array(
      '#type' => 'textfield',
      '#title' => t('Background color'),
      '#default_value' => theme_get_setting('bg_color', 'aqua'),
      '#attributes' => array('class' => array('input color')),
      '#description' => t('default color is: #F6F6F6')
  );
}
